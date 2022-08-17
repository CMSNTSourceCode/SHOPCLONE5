<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once("../../includes/login-admin.php");
    require_once("../../config/UsageServer.php");

    $data = json_encode([
        'getServerMemoryUsage'  => explode('.',getServerMemoryUsage(true))[0].'%',
        'getServerLoad'         => explode('.',getServerLoad())[0].'%',
        'disk_free_space'       => explode('.', (disk_total_space(".") - disk_free_space(".")) / disk_total_space(".") * 100)[0].'%',
        'total_money'           => format_cash($CMSNT->get_row("SELECT SUM(`money`) FROM `users` ")['SUM(`money`)']).'đ',
        'total_users'           => $CMSNT->num_rows("SELECT * FROM `users` "),
        'total_accounts'        => format_cash($CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `trangthai` = 'LIVE' AND `code` IS NULL ")),
        'total_sold'            => format_cash($CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE  `code` IS NOT NULL ")),
        'doanh_thu_ban_tai_khoan_hom_nay' => format_cash($CMSNT->get_row("SELECT SUM(`sotien`) FROM `orders` WHERE `thoigian` >= DATE(NOW()) AND `thoigian` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`sotien`)']),
        'tai_khoan_da_ban_hom_nay' => format_cash($CMSNT->num_rows("SELECT * FROM `taikhoan` WHERE `thoigianmua` >= DATE(NOW()) AND `thoigianmua` < DATE(NOW()) + INTERVAL 1 DAY ")),
        'thanh_vien_dang_ky_hom_nay'  => format_cash($CMSNT->num_rows("SELECT * FROM `users` WHERE `createdate` >= DATE(NOW()) AND `createdate` < DATE(NOW()) + INTERVAL 1 DAY ")),
        'tong_tien_nap_hom_nay' => format_cash(
            $CMSNT->get_row("SELECT SUM(`amount`) FROM `bank_auto` WHERE `time` >= DATE(NOW()) AND `time` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`amount`)'] + 
            $CMSNT->get_row("SELECT SUM(`amount`) FROM `momo` WHERE `time` >= DATE(NOW()) AND `time` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`amount`)'] +
            $CMSNT->get_row("SELECT SUM(`thucnhan`) FROM `cards` WHERE `status` = 'thanhcong' AND `createdate` >= DATE(NOW()) AND `createdate` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`thucnhan`)']
            )

    ]);
    die($data);

?>
