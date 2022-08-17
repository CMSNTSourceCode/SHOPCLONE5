<?php
    require_once("../config/config.php");
    require_once("../class/verifyEmaill.php");
    require_once("../config/function.php");
    

    if(!isset($_GET['username']) && !isset($_GET['password']))
    {
        die(json_encode([
            'status'    => 'error',
            'msg'       => 'Vui lòng nhập thông tin đăng nhập'
        ]));
    }
    $username = check_string($_GET['username']);
    $password = TypePassword(check_string($_GET['password']));
    if(!$getUser = $CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'  ") )
    {
        die(json_encode([
            'status'    => 'error',
            'msg'       => 'Thông tin đăng nhập không chính xác'
        ]));
    }



    if(!isset($_GET['id']))
    {
        die(json_encode([
            'status'    => 'error',
            'msg'       => 'Vui lòng nhập id sản phẩm cần mua'
        ]));
    }
    if(!isset($_GET['amount']))
    {
        die(json_encode([
            'status'    => 'error',
            'msg'       => 'Vui lòng nhập số lượng tài nguyên cần mua'
        ]));
    }
    $dichvu = check_string($_GET['id']);
    $value = check_string($_GET['amount']);
    $token = $getUser['token'];
    if(!$row = $CMSNT->get_row(" SELECT * FROM `dichvu` WHERE `id` = '$dichvu' AND `display` = 'SHOW' "))
    {
        die(json_encode([
            'status'    => 'error',
            'msg'       => 'Sản phẩm bạn cần mua không tồn tại trong hệ thống.'
        ]));
    }
    $loai = $row['loai'];
    $ten_dv = $row['dichvu'];
    if($value <= 0)
    {
        die(json_encode([
            'status'    => 'error',
            'msg'       => 'Số lượng mua không hợp lệ.'
        ]));
    }
    if($value > $row['mua_toi_da'])
    {
        die(json_encode([
            'status'    => 'error',
            'msg'       => 'Số lượng mua tối đa 1 lần là '.$row['mua_toi_da']
        ]));
    }
    if($value < $row['mua_toi_thieu'])
    {
        die(json_encode([
            'status'    => 'error',
            'msg'       => 'Số lượng mua tối thiểu 1 lần là '.$row['mua_toi_thieu']
        ]));
    }
    if($CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '$dichvu' AND `trangthai` = 'LIVE' AND `code` IS NULL ") < $value)
    {
        die(json_encode([
            'status'    => 'error',
            'msg'       => 'Số lượng còn lại trong hệ thống không đủ'
        ]));
    }
    $giatien = $row['gia'] * $value;
    $giatien = $giatien - $giatien * $getUser['chietkhau'] / 100;
    if($getUser['money'] < $giatien)
    {
        die(json_encode([
            'status'    => 'error',
            'msg'       => 'Số dư tài khoản api không đủ, vui lòng liên hệ admin.'
        ]));
    }

    if($row['check_live'] == 'VIA' || $row['check_live'] == 'CLONE'){
        $data = $CMSNT->get_list(" SELECT * FROM `taikhoan` WHERE `dichvu` = '$dichvu' AND `code` IS NULL AND `trangthai` = 'LIVE' ");
        $i = 0;
        foreach($data as $row1)
        {
            if($i < $value)
            {
                $tk = explode("|", $row1['chitiet']);
                if(CheckLiveClone($tk[0]) == 'DIE')
                {
                    $CMSNT->update("taikhoan", array(
                        'trangthai' => 'DIE'
                    ), " `id` = '".$row1['id']."' ");
                }
                else
                {
                    $i++;
                }
            }
            else
            {
                break;
            }
        }
    }
    else if($row['check_live'] == 'GMAIL' || $row['check_live'] == 'HOTMAIL' || $row['check_live'] == 'YAHOO'){
        $data = $CMSNT->get_list(" SELECT * FROM `taikhoan` WHERE `dichvu` = '$dichvu' AND `code` IS NULL AND `trangthai` = 'LIVE' ");
        $i = 0;
        foreach($data as $row1)
        {
            if($i < $value)
            {
                $tk = explode("|", $row1['chitiet']);
                if(CheckLiveEmail($row['check_live'], $tk[0]) == 'DIE')
                {
                    $CMSNT->update("taikhoan", array(
                        'trangthai' => 'DIE'
                    ), " `id` = '".$row1['id']."' ");
                }
                else
                {
                    $i++;
                }
            }
            else
            {
                break;
            }
        }
    }
    else{
        $i = $value;
    }
    if($i >= $value)
    {
        if($getUser['money'] < $giatien)
        {
            die(json_encode([
                'status'    => 'error',
                'msg'       => 'Số dư tài khoản api không đủ, vui lòng liên hệ admin.'
            ]));
        }
        $isCheckMoney = $CMSNT->query(" UPDATE `users` SET `money` = `money` - '$giatien' WHERE `username` = '".$getUser['username']."' ");
        if($isCheckMoney)
        {
            /* CỘNG CHI TIÊU */
            $CMSNT->cong("users", "used_money", $giatien, " `username` = '".$getUser['username']."' ");

            $getMoneyUser = $CMSNT->get_row("SELECT * FROM `users` WHERE `token` = '".$token."' ")['money'];
            if ($getMoneyUser < 0)
            {
                die(json_encode([
                    'status'    => 'error',
                    'msg'       => 'Số dư tài khoản api không đủ, vui lòng liên hệ admin.'
                ]));
            }
            $ma_giaodich = random("QWERTYUIOPASDFGHJKLZXCVBNM0123456789", 4).time();
            /* CẬP NHẬT DÒNG TIỀN */
            $CMSNT->insert("dongtien", array(
                'sotientruoc' => $getUser['money'],
                'sotienthaydoi' => $giatien,
                'sotiensau' => $getUser['money'] - $giatien,
                'thoigian' => gettime(),
                'noidung' => 'Thanh toán đơn hàng (#'.$ma_giaodich.')',
                'username' => $getUser['username']
            ));
            /* CẬP NHẬT CLONE */
            $CMSNT->update_value("taikhoan", array(
                'code'          => $ma_giaodich,
                'thoigianmua'   => gettime()
            ), " `dichvu` = '$dichvu' AND `code` IS NULL AND `trangthai` = 'LIVE'", $value); 
            /* TẠO ĐƠN HÀNG */
            $CMSNT->insert("orders", array(
                'code'      => $ma_giaodich,
                'username'  => $getUser['username'],
                'seller'    => $row['username'],
                'dichvu'    => $ten_dv,
                'loai'      => $loai,
                'soluong'   => $value,
                'sotien'    => $giatien,
                'ip'        => myip(),
                'thoigian'  => gettime(),
                'time'      => time()
            ));
            /* THÊM NHẬT KÝ */
            $CMSNT->insert("logs", [
                'username'  => $getUser['username'],
                'content'   => 'Thanh toán đơn hàng #'.$ma_giaodich,
                'createdate'=> gettime(),
                'time'      => time()
            ]);

            /* XỬ LÝ HOA HỒNG CHO CTV */
            if($CMSNT->site('status_ref') == 'ON')
            {
                if($getUser['ref'] != NULL)
                {
                    $getRef = $CMSNT->get_row("SELECT * FROM `users` WHERE `id` = '".$getUser['ref']."' ");
                    if($getRef)
                    {
                        $hoahong = $giatien * $CMSNT->site('ck_ref') / 100;
                        /* CỘNG HOA HỒNG */
                        $CMSNT->cong("users", "money", $hoahong, " `username` = '".$getRef['username']."' ");
                        $CMSNT->cong("users", "ref_money", $hoahong, " `username` = '".$getRef['username']."' ");
                        /* CẬP NHẬT DÒNG TIỀN */
                        $CMSNT->insert("dongtien", array(
                            'sotientruoc' => $getRef['money'],
                            'sotienthaydoi' => $hoahong,
                            'sotiensau' => $getRef['money'] + $hoahong,
                            'thoigian' => gettime(),
                            'noidung' => 'Hoa hồng từ bạn bè ('.$getUser['username'].')',
                            'username' => $getRef['username']
                        ));
                    }
                }
            }
            $accounts = [];
            foreach($CMSNT->get_list("SELECT * FROM `taikhoan` WHERE `code` = '$ma_giaodich' ") as $taikhoan)
            {
                $accounts[] = 
                [
                    'account'   => $taikhoan['chitiet']
                ];

            }
            die(json_encode([
                'status'    => 'success',
                'msg'       => 'Thanh toán đơn hàng thành công.',
                'data'      => 
                [
                    'trans_id'  => $ma_giaodich,
                    'category'  => $loai,
                    'name'      => $row['dichvu'],
                    'amount'    => $value,
                    'time'      => time(),
                    'lists'     => $accounts
                ]
            ]));
        }
        else
        {
            die(json_encode([
                'status'    => 'error',
                'msg'       => 'Số dư tài khoản api không đủ, vui lòng liên hệ admin.'
            ]));
        }
    }
    else
    {
        die(json_encode([
            'status'    => 'error',
            'msg'       => 'Số lượng còn lại trong hệ thống không đủ'
        ]));
    }