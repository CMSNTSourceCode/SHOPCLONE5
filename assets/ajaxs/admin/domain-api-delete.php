<?php 
    /**
     * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
     * WEBSITE: https://www.cmsnt.co/
     * PATH: assets/ajaxs/admin/domain-api-delete.php
     */
    require_once __DIR__.'/../../../config/config.php';
    require_once __DIR__.'/../../../config/function.php';
    require_once __DIR__.'/../../../includes/login-admin.php';

    if(isset($_POST['id']))
    {
        if($CMSNT->site('status_demo') == 'ON')
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Chức năng này không thể sử dụng trên trang web demo.'
            ]);
            die($data);
        }
        $id = check_string($_POST['id']);
        $row = $CMSNT->get_row("SELECT * FROM `api_domains` WHERE `id` = '$id' ");
        if(!$row)
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Dữ liệu không tồn tại trong hệ thống'
            ]);
            die($data);
        }
        $isRemove = $CMSNT->remove("api_domains", " `id` = '$id' ");
        if($isRemove)
        {
            $data = json_encode([
                'status'    => 'success',
                'msg'       => 'Xoá tên domain api thành công.'
            ]);
            die($data);
        }
    }
    else
    {
        $data = json_encode([
            'status'    => 'error',
            'msg'       => 'Dữ liệu không hợp lệ'
        ]);
        die($data);
    }