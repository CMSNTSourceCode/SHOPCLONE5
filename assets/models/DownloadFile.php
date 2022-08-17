<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");
 
    if(isset($_GET['DownloadFile']) && isset($_GET['code']) && isset($_SESSION['username']) )
    {
        $code = check_string($_GET['code']);

        $row = $CMSNT->get_row(" SELECT * FROM `orders` WHERE `code` = '$code'  ");
        if(!$row)
        {
            msg_error('Đơn hàng không hợp lệ', "", 2000);
        }
        $clone = 'DỊCH VỤ: '.$row['dichvu'].' SỐ LƯỢNG: '.$row['soluong'].' | GIÁ: '.format_cash($row['sotien']).'đ';
        $data = $CMSNT->get_list(" SELECT * FROM `taikhoan` WHERE `code` = '$code' ");
        if($_GET['DownloadFile'] == 'full')
        {
            foreach($data as $row1)
            {
                $clone = $clone.PHP_EOL.htmlspecialchars_decode($row1['chitiet']);
            }
        }
        else if($_GET['DownloadFile'] == 'uidpass')
        {
            foreach($data as $row1)
            {
                $a = explode("|", $row1['chitiet']);
                $clone = $clone.PHP_EOL.htmlspecialchars_decode($a[0].'|'.$a[1]);
            }
        }
        else
        {
            foreach($data as $row1)
            {
                $clone = $clone.PHP_EOL.htmlspecialchars_decode($row1['chitiet']);
            }
        }
        /* THÊM NHẬT KÝ */
        $CMSNT->insert("logs", [
            'username'  => $getUser['username'],
            'content'   => 'Tải xuống đơn hàng #'.$code,
            'createdate'=> gettime(),
            'time'      => time()
        ]);
        $file = $code.".txt";
        $txt = fopen($file, "w") or die("Unable to open file!");
        fwrite($txt, $clone);
        fclose($txt);
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        header("Content-Type: text/plain");
        readfile($file);
        unlink($code.".txt");
        
    }
