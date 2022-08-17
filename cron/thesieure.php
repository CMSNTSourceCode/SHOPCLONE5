<?php
    require_once("../config/config.php");
    require_once("../config/function.php");

    /* ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO 0947838128 | FB.COM/NTGTANETWORK */
    if($CMSNT->site('status_thesieure') != 'ON')
    {
        die('Chức năng đang tắt.');
    }
    if($CMSNT->site('token_thesieure') == '')
    {
        die('Thiếu API');
    }
    if(time() - $CMSNT->site('check_time_cron_tsr') < 10)
    {
        die('Thao tác quá nhanh, vui lòng đợi');
    }
    $CMSNT->update("options", [
        'value' => time()
    ], " `name` = 'check_time_cron_tsr' ");
    
    $token = $CMSNT->site('token_thesieure');
    $result = curl_get("https://api.web2m.com/historyapithesieure/$token");
    $result = json_decode($result, true);
    foreach($result['tranList'] as $data)
    {

        $partnerId      = $data['username'];                    // SỐ ĐIỆN THOẠI CHUYỂN
        $comment        = $data['description'];                 // NỘI DUNG CHUYỂN TIỀN
        $tranId         = $data['transId'];                     // MÃ GIAO DỊCH
        $amount         = str_replace(',', '', $data['amount']);
        $amount         = str_replace('đ', '', $amount);               // SỐ TIỀN CHUYỂN
        $id_momo        = parse_order_id($comment);         // TÁCH NỘI DUNG CHUYỂN TIỀN


        if($amount < $CMSNT->site('recharge_min'))
        {
            continue;
        }
        if ($id_momo)
        {
            $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id_momo' ");
            if($row['id'])
            {
                if($CMSNT->num_rows(" SELECT * FROM `thesieure` WHERE `magiaodich` = '$tranId' ") == 0)
                {
                    $create = $CMSNT->insert("thesieure", array(
                        'magiaodich'        => $tranId,
                        'username'      => $row['username'],
                        'noidung'       => $comment,
                        'time'          => gettime(),
                        'sotien'        => $amount
                    ));
                    if ($create)
                    {
                        $real_amount = $amount;
                        $isCheckMoney = $CMSNT->cong("users", "money", $real_amount, " `username` = '".$row['username']."' ");

                        if($isCheckMoney)
                        {
                            $CMSNT->cong("users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                            $CMSNT->insert("dongtien", array(
                                'sotientruoc'   => $row['money'],
                                'sotienthaydoi' => $real_amount,
                                'sotiensau'     => $row['money'] + $real_amount,
                                'thoigian'      => gettime(),
                                'noidung'       => 'Nạp tiền tự động qua THESIEURE ('.$tranId.')',
                                'username'      => $row['username']
                            ));
                            // Cộng tiền khuyến mãi
                            add_promotion($row['username'], $real_amount, $tranId);   
                            // Trừ tiền ghi nợ
                            debit_processing($row['username']);
                        }
                    }
                }
            }
        }         
    }
    echo "Cập nhật lịch sử thesieure thành công!";
 
    curl_get(BASE_URL("cron/cron.php"));
    curl_get(BASE_URL("cron/deleteorders.php"));