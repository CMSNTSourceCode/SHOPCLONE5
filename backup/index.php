<?php 
    require_once("../config/config.php");
    require_once("../config/function.php");
 
    if(isset($_GET['uid']) && isset($_SESSION['username']) && isset($_GET['admin']))
    {
        if($getUser['level'] != 'admin')
        {
            die('Bạn không có quyền tải backup này.');
        }
        //$code = check_string($_GET['code']);
        $uid = check_string($_GET['uid']);
        $file = $uid.".html";
        if(!file_exists($file))
        { 
            die('Đơn hàng này không có backup để tải về.');
        }
        else
        {
            /* THÊM NHẬT KÝ */
            $CMSNT->insert("logs", [
                'username'  => $getUser['username'],
                'content'   => 'Tải xuống file backup '.$uid,
                'createdate'=> gettime(),
                'time'      => time()
            ]);
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file");
            header("Content-Type: application/html");
            header("Content-Transfer-Encoding: binary");
            readfile($file);
        }
        die();
    }
    if(isset($_GET['uid']) && isset($_GET['code']) && isset($_SESSION['username']) )
    {
        $code = check_string($_GET['code']);
        $uid = check_string($_GET['uid']);
        $row = $CMSNT->get_row(" SELECT * FROM `orders` WHERE `code` = '$code'  ");
        if(!$row)
        {
            die('Đơn hàng không tồn tại trong hệ thống');
        }
        $file = $uid.".html";
        if(!file_exists($file))
        { 
            die('Đơn hàng này không có backup để tải về.');
        }
        else
        {
            /* THÊM NHẬT KÝ */
            $CMSNT->insert("logs", [
                'username'  => $getUser['username'],
                'content'   => 'Tải xuống file backup '.$uid,
                'createdate'=> gettime(),
                'time'      => time()
            ]);
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file");
            header("Content-Type: application/html");
            header("Content-Transfer-Encoding: binary");
            readfile($file);
        }
    }
