<?php
    require_once("../config/config.php");
    require_once("../config/function.php");

   
    function parse_order_id1($des)
    {
        $MEMO_PREFIX = 'Naptien';
        $re = '/'.$MEMO_PREFIX.'\d+/im';
        preg_match_all($re, $des, $matches, PREG_SET_ORDER, 0);
        if (count($matches) == 0 )
            return null;
        // Print the entire match result
        $orderCode = $matches[0][0];
        $prefixLength = strlen($MEMO_PREFIX);
        $orderId = intval(substr($orderCode, $prefixLength ));
        return $orderId ;
    }

    /*
    foreach($CMSNT->get_list("SELECT * FROM `bank_auto` WHERE `cusum_balance` = 0 ") as $row)
    {
        $des = $row['description'];
        $amount = $row['amount'];
        $id = parse_order_id1($des);

        $create = $CMSNT->remove("bank_auto", " `id` = '".$row['id']."' ");

        $getUser = $CMSNT->get_row(" SELECT * FROM `users` WHERE `username` = '".$row['username']."' ");
        if ($create)
        {
            $real_amount = $amount;
            $isCheckMoney = $CMSNT->tru("users", "money", $real_amount, " `username` = '".$row['username']."' ");
            if($isCheckMoney)
            {
                $CMSNT->tru("users", "used_money", $real_amount, " `username` = '".$row['username']."' ");
                $CMSNT->insert("dongtien", array(
                    'sotientruoc' => $getUser['money'],
                    'sotienthaydoi' => $real_amount,
                    'sotiensau' => $getUser['money'] - $real_amount,
                    'thoigian' => gettime(),
                    'noidung' => 'Thu hồi tự động giao dịch ('.$des.')',
                    'username' => $getUser['username']
                ));
            }
        }
    }
*/

 