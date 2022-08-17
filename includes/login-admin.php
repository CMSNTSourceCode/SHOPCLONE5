<?php
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 * PATH: includes\login-admin.php
 */


if(isset($_SESSION['username']))
{
    $getUser = $CMSNT->get_row(" SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."' AND `level` = 'admin' ");
    if(!$getUser)
    {
        header("location: ".BASE_URL('Auth/Logout'));
        exit();
    }
    if($getUser['banned'] != 0)
    {
        echo 'Tài khoản của bạn đã bị khóa bởi quản trị viên !';
        //header("location:".BASE_URL('banned.php'));
        exit();
    }
    if($getUser['money'] < 0)
    {
        $CMSNT->update("users", array(
            'banned' => 1
        ), "username = '".$getUser['username']."' ");
        die('Tài khoản của bạn đã bị khóa tự động bởi hệ thống');
    }
    /* ONLINE */
    $CMSNT->update("users", [
        'time_session'  => time()
    ], " `id` = '".$getUser['id']."' ");
}
else
{
    header("location: ".BASE_URL('Auth/Login'));
    exit();
}