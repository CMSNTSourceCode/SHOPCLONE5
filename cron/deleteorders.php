<?php
    require_once("../config/config.php");
    require_once("../config/function.php");

    // XÓA ĐƠN HÀNG KHI MUA TRONG 30 NGÀY
    foreach($CMSNT->get_list("SELECT * FROM `orders` WHERE ".time()." - `time` >= ".$CMSNT->site('time_delete')." ") as $orders){
        // XÓA TÀI NGUYÊN
        $CMSNT->remove("taikhoan", " `code` = '".$orders['code']."' ");
        // XÓA ĐƠN HÀNG
        $CMSNT->remove("orders", " `code` = '".$orders['code']."' ");
        // GHI LOG
        $file = @fopen('../logs/XoaDonHang.txt', 'a');
        if ($file){
            $data = "[LOG] Đơn hàng #".$orders['code']." đã bị xóa khỏi hệ thống vào lúc ".gettime().PHP_EOL;
            fwrite($file, $data);
            fclose($file);
        }
    }