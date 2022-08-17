<?php
    require_once("../config/config.php");
    require_once("../config/function.php");
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(!isset($_GET['username']) && !isset($_GET['password'])){
            die(json_encode([
                'status'    => 'error',
                'msg'       => 'Vui lòng nhập thông tin đăng nhập'
            ]));
        }
        $username = check_string($_GET['username']);
        $password = TypePassword(check_string($_GET['password']));
        if(!$getUser = $CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' AND `level` = 'admin'  ") )
        {
            die(json_encode([
                'status'    => 'error',
                'msg'       => 'Thông tin đăng nhập không chính xác'
            ]));
        }
        if(isset($_GET['product']) && isset($_GET['account'])){  
            if($CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `chitiet` = '".check_string($_GET['account'])."' ") == 0){
                $isAdd = $CMSNT->insert("taikhoan", array(
                    'chitiet' => check_string($_GET['account']),
                    'dichvu' => check_string($_GET['product']),
                    'trangthai' => 'LIVE'
                ));
                if($isAdd){
                    die(json_encode([
                        'status'    => 'success',
                        'msg'       => 'Thêm tài thành công!'
                    ]));
                }else{
                    die(json_encode([
                        'status'    => 'error',
                        'msg'       => 'Thêm tài khoản thất bại'
                    ]));
                }
            }
            else{
                $row_taikhoan = $CMSNT->get_row(" SELECT * FROM `taikhoan` WHERE `chitiet` = '".check_string($_GET['account'])."' ");
                $isUpdate = $CMSNT->update("taikhoan", array(
                    'chitiet' => check_string($_GET['account']),
                    'dichvu' => check_string($_GET['product']),
                    'trangthai' => 'LIVE'
                ), " `id` = '".$row_taikhoan['id']."' ");
                if($isUpdate){
                    die(json_encode([
                        'status'    => 'success',
                        'msg'       => 'Cập nhật tài khoản thành công!'
                    ]));
                }else{
                    die(json_encode([
                        'status'    => 'error',
                        'msg'       => 'Cập nhật tài khoản thất bại'
                    ]));
                }
            }
        }
        die(json_encode([
            'status'    => 'error',
            'msg'       => 'Thiếu product & account'
        ]));
    }
   

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!isset($_POST['username']) && !isset($_POST['password'])){
            die(json_encode([
                'status'    => 'error',
                'msg'       => 'Vui lòng nhập thông tin đăng nhập'
            ]));
        }
        $username = check_string($_POST['username']);
        $password = TypePassword(check_string($_POST['password']));
        if(!$getUser = $CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' AND `level` = 'admin' ") )
        {
            die(json_encode([
                'status'    => 'error',
                'msg'       => 'Thông tin đăng nhập không chính xác'
            ]));
        }
        if(isset($_POST['product']) && isset($_POST['account'])){  
            if($CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `chitiet` = '".check_string($_POST['account'])."' ") == 0){
                $isAdd = $CMSNT->insert("taikhoan", array(
                    'chitiet' => check_string($_POST['account']),
                    'dichvu' => check_string($_POST['product']),
                    'trangthai' => 'LIVE'
                ));
                if($isAdd){
                    die(json_encode([
                        'status'    => 'success',
                        'msg'       => 'Thêm tài thành công!'
                    ]));
                }else{
                    die(json_encode([
                        'status'    => 'error',
                        'msg'       => 'Thêm tài khoản thất bại'
                    ]));
                }
            }
            else{
                $row_taikhoan = $CMSNT->get_row(" SELECT * FROM `taikhoan` WHERE `chitiet` = '".check_string($_POST['account'])."' ");
                $isUpdate = $CMSNT->update("taikhoan", array(
                    'chitiet' => check_string($_POST['account']),
                    'dichvu' => check_string($_POST['product']),
                    'trangthai' => 'LIVE'
                ), " `id` = '".$row_taikhoan['id']."' ");
                if($isUpdate){
                    die(json_encode([
                        'status'    => 'success',
                        'msg'       => 'Cập nhật tài khoản thành công!'
                    ]));
                }else{
                    die(json_encode([
                        'status'    => 'error',
                        'msg'       => 'Cập nhật tài khoản thất bại'
                    ]));
                }
            }
        }
        die(json_encode([
            'status'    => 'error',
            'msg'       => 'Thiếu product & account'
        ]));
    }