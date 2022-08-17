<?php
    require_once("../config/config.php");
    require_once("../config/function.php");


    /* ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO 0947838128 | FB.COM/NTGTANETWORK */
    if($CMSNT->site('status_cron_bank') != 'ON')
    {
        die('Chức năng đang tắt.');
    }
    if($CMSNT->site('api_bank') == '')
    {
        die('Thiếu API');
    }
    if(time() - $CMSNT->site('check_time_cron_bank') < 10)
    {
        die('Thao tác quá nhanh, vui lòng đợi');
    }
    $CMSNT->update("options", [
        'value' => time()
    ], " `name` = 'check_time_cron_bank' ");
    $token = $CMSNT->site('api_bank');
    $stk = $CMSNT->site('stk_bank');
    $mk = $CMSNT->site('mk_bank');



    if($CMSNT->site('type_bank') == 'Vietcombank')
    {
        $result = curl_get("https://api.web2m.com/historyapivcb/$mk/$stk/$token");
        $result = json_decode($result, true);
        if($result['status'] != true)
        {
            die('Lấy dữ liệu thất bại');
        }
        foreach($result['data']['ChiTietGiaoDich'] as $data)
        {
            $des = $data['MoTa'];
            $amount = str_replace(',' ,'', $data['SoTienGhiCo']);
            $tid = $data['SoThamChieu'];
            $id = parse_order_id($des);
            if($amount < $CMSNT->site('recharge_min'))
            {
                continue;
            }
            if ($id)
            {
                $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id' ");
                if($row['username'])
                {
                    if($CMSNT->num_rows(" SELECT * FROM `bank_auto` WHERE `tid` = '$tid' AND `description` = '$des' ") == 0)
                    {
                        /* GHI LOG BANK AUTO */
                        $create = $CMSNT->insert("bank_auto", array(
                            'tid' => $tid,
                            'description' => $des,
                            'amount' => $amount,
                            'time' => gettime(),
                            'username' => $row['username']
                            ));
                        if ($create)
                        {
                            $real_amount = $amount + $amount * $CMSNT->site('ck_bank') / 100;
                            $isCheckMoney = $CMSNT->cong("users", "money", $real_amount, " `username` = '".$row['username']."' ");
                            if($isCheckMoney)
                            {
                                $CMSNT->cong("users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                                /* GHI LOG DÒNG TIỀN */
                                $CMSNT->insert("dongtien", array(
                                    'sotientruoc' => $row['money'],
                                    'sotienthaydoi' => $real_amount,
                                    'sotiensau' => $row['money'] + $real_amount,
                                    'thoigian' => gettime(),
                                    'noidung' => 'Nạp tiền tự động ngân hàng ('.$des.')',
                                    'username' => $row['username']
                                ));
                                // Cộng tiền khuyến mãi
                                add_promotion($row['username'], $real_amount, $des);   
                                // Trừ tiền ghi nợ
                                debit_processing($row['username']);
                            }
                        }
                        
                    }
                }
            }    
        }
        die();
    }
    if($CMSNT->site('type_bank') == 'Techcombank')
    {
        $result = curl_get("https://api.web2m.com/historyapitcb/$mk/$stk/$token");
        $result = json_decode($result, true);
        if($result['success'] != true)
        {
            die('Lấy dữ liệu thất bại');
        }
        foreach($result['transactions'] as $data)
        {
            $des = $data['Description'];
            $amount = str_replace(',' ,'', $data['Amount']);
            $tid = explode('\\', $data['TransID'])[0];
            $id = parse_order_id($des);
            if($amount < $CMSNT->site('recharge_min'))
            {
                continue;
            }
            $file = @fopen('LogBank.txt', 'a');
            if ($file)
            {
                $data = "tid => $tid description => $des ($id) amount => $amount ".PHP_EOL;
                fwrite($file, $data);
            }
            if ($id)
            {
                $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id' ");
                if($row['username'])
                {
                    if($CMSNT->num_rows(" SELECT * FROM `bank_auto` WHERE `tid` = '$tid' AND `description` = '$des' ") == 0)
                    {
                        /* GHI LOG BANK AUTO */
                        $create = $CMSNT->insert("bank_auto", array(
                            'tid' => $tid,
                            'description' => $des,
                            'amount' => $amount,
                            'time' => gettime(),
                            'username' => $row['username']
                            ));
                        if ($create)
                        {
                            $real_amount = $amount + $amount * $CMSNT->site('ck_bank') / 100;
                            $isCheckMoney = $CMSNT->cong("users", "money", $real_amount, " `username` = '".$row['username']."' ");
                            if($isCheckMoney)
                            {
                                $CMSNT->cong("users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                                /* GHI LOG DÒNG TIỀN */
                                $CMSNT->insert("dongtien", array(
                                    'sotientruoc' => $row['money'],
                                    'sotienthaydoi' => $real_amount,
                                    'sotiensau' => $row['money'] + $real_amount,
                                    'thoigian' => gettime(),
                                    'noidung' => 'Nạp tiền tự động ngân hàng (Techcombank | '.$tid.')',
                                    'username' => $row['username']
                                ));
                                // Cộng tiền khuyến mãi
                                add_promotion($row['username'], $real_amount, $tid);   
                                // Trừ tiền ghi nợ
                                debit_processing($row['username']);
                            }
                        }
                    }
                }
            }    
        }
        die();
    }

    if($CMSNT->site('type_bank') == 'ACB')
    {
        $result = curl_get("https://api.web2m.com/historyapiacb/$mk/$stk/$token");
        $result = json_decode($result, true);
        if($result['message'] != 'Success')
        {
            die('Lấy dữ liệu thất bại');
        }
        foreach($result['transactions'] as $data)
        {
            $des = $data['description'];
            $amount = $data['amount'];
            $tid = $data['transactionNumber'];
            $id = parse_order_id($des);
            if($amount < $CMSNT->site('recharge_min'))
            {
                continue;
            }
            if ($id)
            {
                $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id' ");
                if($row['username'])
                {
                    if($CMSNT->num_rows(" SELECT * FROM `bank_auto` WHERE `tid` = '$tid' AND `description` = '$des' ") == 0)
                    {
                        /* GHI LOG BANK AUTO */
                        $create = $CMSNT->insert("bank_auto", array(
                            'tid' => $tid,
                            'description' => $des,
                            'amount' => $amount,
                            'time' => gettime(),
                            'username' => $row['username']
                            ));
                        if ($create)
                        {
                            $real_amount = $amount + $amount * $CMSNT->site('ck_bank') / 100;
                            $isCheckMoney = $CMSNT->cong("users", "money", $real_amount, " `username` = '".$row['username']."' ");
                            if($isCheckMoney)
                            {
                                $CMSNT->cong("users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                                /* GHI LOG DÒNG TIỀN */
                                $CMSNT->insert("dongtien", array(
                                    'sotientruoc' => $row['money'],
                                    'sotienthaydoi' => $real_amount,
                                    'sotiensau' => $row['money'] + $real_amount,
                                    'thoigian' => gettime(),
                                    'noidung' => 'Nạp tiền tự động ngân hàng (ACB | '.$tid.')',
                                    'username' => $row['username']
                                ));
                                // Cộng tiền khuyến mãi
                                add_promotion($row['username'], $real_amount, $tid);   
                                // Trừ tiền ghi nợ
                                debit_processing($row['username']);
                            }
                        }
                    }
                }
            }    
        }
        die();
    }

    if($CMSNT->site('type_bank') == 'MBBank')
    {
        $result = curl_get("https://api.web2m.com/historyapimb/$mk/$stk/$token");
        $result = json_decode($result, true);
        if($result['success'] != true)
        {
            die('Lấy dữ liệu thất bại');
        }
        foreach($result['data'] as $data)
        {
            $des = $data['description'];
            $amount = $data['creditAmount'];
            $tid = explode('\\', $data['refNo'])[0];
            $id = parse_order_id($des);
            if($amount < $CMSNT->site('recharge_min'))
            {
                continue;
            }
            $file = @fopen('LogBank.txt', 'a');
            if ($file)
            {
                $data = "tid => $tid description => $des ($id) amount => $amount ".PHP_EOL;
                fwrite($file, $data);
            }
            if ($id)
            {
                $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id' ");
                if($row['username'])
                {
                    if($CMSNT->num_rows(" SELECT * FROM `bank_auto` WHERE `tid` = '$tid' AND `description` = '1.4.0$des' ") == 0)
                    {
                        /* GHI LOG BANK AUTO */
                        $create = $CMSNT->insert("bank_auto", array(
                            'tid' => $tid,
                            'description' => '1.4.0'.$des,
                            'amount' => $amount,
                            'time' => gettime(),
                            'username' => $row['username']
                            ));
                        if ($create)
                        {
                            $real_amount = $amount + $amount * $CMSNT->site('ck_bank') / 100;
                            $isCheckMoney = $CMSNT->cong("users", "money", $real_amount, " `username` = '".$row['username']."' ");
                            if($isCheckMoney)
                            {
                                $CMSNT->cong("users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                                /* GHI LOG DÒNG TIỀN */
                                $CMSNT->insert("dongtien", array(
                                    'sotientruoc' => $row['money'],
                                    'sotienthaydoi' => $real_amount,
                                    'sotiensau' => $row['money'] + $real_amount,
                                    'thoigian' => gettime(),
                                    'noidung' => 'Nạp tiền tự động ngân hàng (MB Bank | '.$tid.')',
                                    'username' => $row['username']
                                ));
                                // Cộng tiền khuyến mãi
                                add_promotion($row['username'], $real_amount, $tid);    
                                // Trừ tiền ghi nợ
                                debit_processing($row['username']);
                            }
                        }
                    }
                }
            }    
        }
        die();
    }

    if($CMSNT->site('type_bank') == 'TBBank' || $CMSNT->site('type_bank') == 'TPBank')
    {
        $result = curl_get("https://api.web2m.com/historyapitpb/$token");
        $result = json_decode($result, true);
        if($result['error'] == true)
        {
            die($result['msg']);
        }
        foreach($result['transactionInfos'] as $data)
        {
            $des = $data['description'];
            $amount = $data['amount'];
            $tid = $data['reference'];
            $id = parse_order_id($des);
            if($amount < $CMSNT->site('recharge_min'))
            {
                continue;
            }
            if ($id)
            {
                $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id' ");
                if($row['username'])
                {
                    if($CMSNT->num_rows(" SELECT * FROM `bank_auto` WHERE `tid` = '$tid' AND `description` = '$des' ") == 0)
                    {
                        /* GHI LOG BANK AUTO */
                        $create = $CMSNT->insert("bank_auto", array(
                            'tid' => $tid,
                            'description' => '1.4.0'.$des,
                            'amount' => $amount,
                            'time' => gettime(),
                            'username' => $row['username']
                            ));
                        if ($create)
                        {
                            $real_amount = $amount + $amount * $CMSNT->site('ck_bank') / 100;
                            $isCheckMoney = $CMSNT->cong("users", "money", $real_amount, " `username` = '".$row['username']."' ");
                            if($isCheckMoney)
                            {
                                $CMSNT->cong("users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                                /* GHI LOG DÒNG TIỀN */
                                $CMSNT->insert("dongtien", array(
                                    'sotientruoc' => $row['money'],
                                    'sotienthaydoi' => $real_amount,
                                    'sotiensau' => $row['money'] + $real_amount,
                                    'thoigian' => gettime(),
                                    'noidung' => 'Nạp tiền tự động ngân hàng (TPBank | '.$tid.')',
                                    'username' => $row['username']
                                ));
                                // Cộng tiền khuyến mãi
                                add_promotion($row['username'], $real_amount, $tid);    
                                // Trừ tiền ghi nợ
                                debit_processing($row['username']);
                            }
                        }
                    }
                }
            }    
        }
        die();
    }

    echo "Cập nhật lịch sử bank thành công!";



    curl_get(BASE_URL("cron/cron.php"));
    curl_get(BASE_URL("cron/deleteorders.php"));