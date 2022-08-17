<?php
    require_once("../config/config.php");
    require_once("../config/function.php");

    /* ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO 0947838128 | FB.COM/NTGTANETWORK */
    if($CMSNT->site('status_zalopay') != 'ON')
    {
        die('Chức năng đang tắt.');
    }
    if($CMSNT->site('token_zalopay') == '')
    {
        die('Thiếu Token Zalo Pay');
    }
    if(time() - $CMSNT->site('check_time_cron_zalopay') < 10)
    {
        die('Thao tác quá nhanh, vui lòng đợi');
    }
    $CMSNT->update("options", [
        'value' => time()
    ], " `name` = 'check_time_cron_zalopay' ");
    
    $token = $CMSNT->site('token_zalopay');
    $result = curl_get("https://api.web2m.com/historyapizalopay/$token");
    $result = json_decode($result, true);
    if($result['code'] != 200)
    {
        die($result['message']);
    }
    foreach($result['data'] as $data)
    {
        $comment        = $data['description'];             // NỘI DUNG CHUYỂN TIỀN
        $tranId         = $data['transid'];                 // MÃ GIAO DỊCH
        $id_momo        = parse_order_id($comment);         // TÁCH NỘI DUNG CHUYỂN TIỀN
        $amount         = $data['amount'];

        if($amount < $CMSNT->site('recharge_min'))
        {
            //BỎ QUA GIAO DỊCH NẾU SỐ TIỀN NẠP THẤP HƠN MIN NẠP MÀ ADMIN ĐIỀU CHỈNH
            continue;
        }
        if($data['sign'] != 1)
        {
            // BỎ QUA GIAO DỊCH NẾU PHÁT HIỆN GIAO DỊCH NÀY LÀ GIAO DỊCH NHẬN TIỀN
            continue;
        }
        if ($id_momo)
        {
            $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id_momo' ");
            if($row['id'])
            {
                if($CMSNT->num_rows(" SELECT * FROM `zalo_pay` WHERE `transid` = '$tranId' ") == 0)
                {
                    $create = $CMSNT->insert("zalo_pay", array(
                        'transid'        => $tranId,
                        'username'      => $row['username'],
                        'description'       => $comment,
                        'time'          => gettime(),
                        'amount'        => $amount
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
                                'noidung'       => 'Nạp tiền tự động qua ví Zalo Pay ('.$tranId.')',
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
 
    echo "Cập nhật lịch sử zalo pay thành công!";