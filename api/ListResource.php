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
    $data = [];
    $list_category = [];
    foreach($CMSNT->get_list("SELECT * FROM `category` WHERE `display` = 'SHOW' ORDER BY `stt` ") as $category)
    {

        $list_dichvu = [];
        foreach($CMSNT->get_list("SELECT * FROM `dichvu` WHERE  `display` = 'SHOW' AND `loai` = '".$category['title']."'  ORDER BY `stt` ASC ") as $row)
        {
            $conlai = $CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `trangthai` = 'LIVE' AND `code` IS NULL "); 
            $conlai = $conlai ? $conlai : 0;
            $sold = $CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `code` IS NOT NULL ");
            $list_dichvu[] = 
            [
                'id'            => $row['id'],
                'name'          => $row['dichvu'],
                'price'         => $row['gia'],
                'amount'        => $conlai,
                'country'       => $row['quocgia'],
                'description'   => $row['mota']
            ];
        }

        $list_category[] = 
        [
            'id'    => $category['id'],
            'name'  => $category['title'],
            'image' => BASE_URL($category['img']),
            'accounts'  => $list_dichvu
        ];
        
    }

    $data = 
    [
        'status'    => 'success',
        'categories'  => $list_category
    ];
    echo json_encode($data, JSON_PRETTY_PRINT);