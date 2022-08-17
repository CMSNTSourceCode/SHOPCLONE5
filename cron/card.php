<?php
    require_once("../config/config.php");
    require_once("../config/function.php");
    
    if(time() - $CMSNT->site('check_time_cron_card') < 5){
        die('Thao tác quá nhanh, vui lòng đợi');
    }
    $CMSNT->update("options", [
        'value' => time()
    ], " `name` = 'check_time_cron_card' ");
    if($CMSNT->site('api_card') == ''){
        die('Chức năng đang bảo trì');
    }
    $result = curl_get("https://card24h.com/api/transaction.php?APIKey=".$CMSNT->site('api_card'));
    $result = json_decode($result, true);
    foreach($result['data'] as $data){
        $content = check_string($data['content']);
        $pin = check_string($data['pin']);
        if($row = $CMSNT->get_row("SELECT * FROM `cards` WHERE `status` = 'xuly' AND `code` = '$content' AND `pin` = '$pin' ")){
            if($data['trangthai'] == 'thatbai'){
                /* CẬP NHẬT TRẠNG THÁI THẺ CÀO */
                $CMSNT->update("cards", array(
                    'status'    => 'thatbai',
                    'thucnhan'  => '0'
                ), " `id` = '".$row['id']."' ");
                echo '[-] Xử lý thẻ serial '.check_string($data['seri']).' thành công!<br>';
            }
            else if($data['trangthai'] == 'hoantat'){
                $thucnhan = check_string($data['menhgia']) - check_string($data['menhgia']) * $CMSNT->site('ck_card') / 100;
                /* CẬP NHẬT TRẠNG THÁI THẺ CÀO */
                $CMSNT->update("cards", array(
                    'status'    => 'thanhcong',
                    'thucnhan'  => $thucnhan
                ), " `id` = '".$row['id']."' ");
                $getUser = $CMSNT->get_row(" SELECT * FROM `users` WHERE `username` = '".$row['username']."' ");
                /* CỘNG TIỀN USER */
                $CMSNT->cong("users", "money", $thucnhan, " `id` = '".$getUser['id']."' ");
                $CMSNT->cong("users", "total_money", $thucnhan, " `id` = '".$getUser['id']."' ");
                /* GHI LOG DÒNG TIỀN */
                $CMSNT->insert("dongtien", array(
                    'sotientruoc'   => $getUser['money'],
                    'sotienthaydoi' => $thucnhan,
                    'sotiensau'     => $getUser['money'] + $thucnhan,
                    'thoigian'      => gettime(),
                    'noidung'       => 'Nạp tiền tự động qua thẻ cào seri ('.$row['seri'].')',
                    'username'      => $getUser['username']
                ));

                echo '[-] Xử lý thẻ serial '.check_string($data['seri']).' thành công!<br>';
            }
        }
    }