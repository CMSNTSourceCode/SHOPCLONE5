<?php 
    /**
     * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
     * WEBSITE: https://www.cmsnt.co/
     * PATH: assets/ajaxs/admin/domain-api-delete.php
     */
    require_once __DIR__.'/../../../config/config.php';
    require_once __DIR__.'/../../../config/function.php';
    require_once __DIR__.'/../../../includes/login-admin.php';

    $CMSNT->update("options", [
        'value' => $CMSNT->site('darkmode') == 'light' ? 'dark' : 'light'
    ], " `name` = 'darkmode' ");
    $data = [
        'msg' => 'Thay đổi trạng thái dark mode thành công!',
        'status' => 'success'
    ];
    die(json_encode($data));