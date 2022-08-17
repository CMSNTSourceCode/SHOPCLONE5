<?php
    require_once("../config/config.php");
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
            'msg'       => 'Thiếu ID sản phẩm cần lấy thông tin'
        ]));
    }
    $id = check_string($_GET['id']);
    if(!$row = $CMSNT->get_row("SELECT * FROM `dichvu` WHERE  `display` = 'SHOW' AND `id` = '$id'  ORDER BY `stt` ASC "))
    {
        die(json_encode([
            'status'    => 'error',
            'msg'       => 'ID sản phẩm không hợp lệ'
        ]));
    }

    $conlai = $CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `trangthai` = 'LIVE' AND `code` IS NULL "); 
    $conlai = $conlai ? $conlai : 0;

    $list_dichvu = [];
    $list_dichvu = 
    [
        'id'            => $row['id'],
        'name'          => $row['dichvu'],
        'price'         => $row['gia'],
        'amount'        => $conlai,
        'country'       => $row['quocgia'],
        'description'   => $row['mota']
    ];


    die(json_encode([
        'status'    => 'success',
        'msg'       => 'Lấy thông tin sản phẩm thành công',
        'data'      => $list_dichvu
    ]));


    echo json_encode($data, JSON_PRETTY_PRINT);