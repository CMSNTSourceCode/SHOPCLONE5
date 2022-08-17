<?php
    require_once("../config/config.php");
    require_once("../config/function.php");

    // TẠO GIAO DỊCH ẢO
    if($CMSNT->site('stt_giaodichao') == 'ON')
    {
        $int_rand = rand(0, 20);
        if($int_rand == 20)
        {
            // LẤY DANH SÁCH DỊCH VỤ
            $dichvu = $CMSNT->get_row("SELECT * FROM `dichvu` WHERE `display` = 'SHOW' ORDER BY RAND() LIMIT 1  ");
            // TẠO MÃ GIAO DỊCH ẢO
            $ma_giaodich = random("0123456789D", 6);
            // LẤY NGẪU NHIÊN 1 TÊN USERNAME
            $array_username = 
            [
                '0989798568', 
                '0798987985', 
                '01254989498', 
                'phanxichlo', 
                'toitenla', 
                'nguyentrinh', 
                'buihien', 
                'phong9899', 
                'phat1412', 
                'conlaollll', 
                'hotnek2', 
                'hocgioigioihoc', 
                'toite132', 
                '0989897986', 
                '984659864', 
                '97986599', 
                '065498989', 
                '019898985', 
                'giaosuhaykhoc', 
                'thanhpro', 
                'shopaka', 
                'huyenngoc', 
                'lamka231',
                'lehuyz23',
                'tranhuycg',
                'kimlongA5',
                '0989798555',
                '0165989975',
                '0942132659',
                '03788988655'
            ];
            // CHỌN NGẪU NHIÊN SỐ LƯỢNG
            $soluong = rand(1, 50);
            // TÍNH TỔNG TIỀN
            $sotien = $dichvu['gia'] * $soluong;
            /* TẠO ĐƠN HÀNG */
            $CMSNT->insert("orders", array(
                'code'      => $ma_giaodich,
                'username'  => $array_username[rand(0, count($array_username))],
                'seller'    => $dichvu['username'],
                'dichvu'    => $dichvu['dichvu'],
                'loai'      => $dichvu['loai'],
                'soluong'   => $soluong,
                'sotien'    => $sotien,
                'ip'        => '',
                'thoigian'  => gettime(),
                'time'      => time()
            ));
        }
    }

    //CHECK LIVE TOKEN
    if($CMSNT->num_rows("SELECT * FROM `token` ") > 0)
    {
        foreach($CMSNT->get_list("SELECT * FROM `token` ") as $row)
        {
            $token = $row['token'];
            $data = json_decode(curl_get('https://graph.facebook.com/100038641389494/?access_token='.$token),true);
            if(!isset($data['id']))
            {
                $CMSNT->remove("token", " `id` = '".$row['id']."' ");
            }
        }
    }
    

