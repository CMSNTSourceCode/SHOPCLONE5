<?php
    require_once("../config/config.php");
    require_once("../config/function.php");
    
    $txtBody = file_get_contents('php://input');
    $jsonBody = json_decode($txtBody); //convert JSON into array
    if (!$txtBody || !$jsonBody)
    {
        echo "THUÊ CODE WEBSITE THEO YÊU CẦU VUI LÒNG LIÊN HỆ WWW.CMSNT.CO | ZALO: 0947838128 | GMAIL: NTT2001811@GMAIL.COM ";
        die();
    }
    if ($jsonBody->error != 0)
    {
        echo "Có lỗi xay ra ở phía Casso";
        die();
    }
    $headers = getHeader();
    if ( $headers['Secure-Token'] != $CMSNT->site('api_bank') )
    {
        echo("Thiếu Secure Token hoặc secure token không khớp");
        die(); 
    }
    if ($CMSNT->site('api_bank') == NULL)
    {
        echo("Chức năng không khả dụng!");
        die(); 
    }
    foreach ($jsonBody->data as $key => $transaction)
    {
        $des = $transaction->description;
        $amount = $transaction->amount;
        $id = parse_order_id($des);
        $file = @fopen('LogBank.txt', 'a');
        if ($file)
        {
            $data = "tid => $transaction->tid description => $des ($id) amount => $transaction->amount wen => $transaction->wen bank_sub_acc_id => $transaction->bank_sub_acc_id cusum_balance => $transaction->cusum_balance".PHP_EOL;
            fwrite($file, $data);
        }
        if ($id)
        {
            $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id' ");
            if($row['username'])
            {
                if($CMSNT->num_rows(" SELECT * FROM `bank_auto` WHERE `tid` = '$transaction->tid' ") == 0)
                {
                    /* GHI LOG BANK AUTO */
                    $create = $CMSNT->insert("bank_auto", array(
                        'tid' => $transaction->tid,
                        'description' => $des,
                        'amount' => $amount,
                        'time' => gettime(),
                        'bank_sub_acc_id' => $transaction->subAccId,
                        'username' => $row['username'],
                        'cusum_balance' => $transaction->cusum_balance
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
                                'noidung' => 'Nạp tiền tự động ngân hàng ('.$transaction->tid.')',
                                'username' => $row['username']
                            ));
                        }
                    }
                }
            }
        } 
    }
    echo "<div>Xử lý hoàn tất</div>";
    die();