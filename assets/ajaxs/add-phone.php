<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if(empty($_POST['phone']))
    {
        msg_error2("Vui lòng nhập số điện thoại.");
    }
    if(!isset($_SESSION['username']))
    {
        msg_error2("Vui lòng đăng nhập.");
    }
    if(check_phone($_POST['phone']) != true)
    {
        msg_error2("Định dạng số điện thoại không hợp lệ.");
    }
    $phone = check_string($_POST['phone']);
    if($CMSNT->get_row("SELECT * FROM `users` WHERE `phone` = '$phone' "))
    {
        msg_error2("Số điện thoại này đã có trong hệ thống.");
    }
    $isUpdate = $CMSNT->update("users", [
        'phone' => $phone
    ], " `username` = '".$_SESSION['username']."' ");
    if($isUpdate)
    {
        msg_success("Cập nhật thông tin thành công !", "", 1000);
    }
    else
    {
        msg_error2("Không thể cập nhật dữ liệu.");
    }