<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if (!$_SESSION['username']) {
        $return['error'] = 'error';
        $return['msg']   = 'Vui Lòng Đăng Nhập';
        die(json_encode($return));
    }
    $uid = trim($_POST['uid']);
    $aruid = explode("|", $uid);
    foreach ($aruid as $uid) {
        if (is_numeric($uid)) break;
    }
    if ($uid)
    {
        $export = '';
        $return['uid'] = $uid;
        if(CheckLiveClone($uid) == 'DIE')
        {
            $return['error']   = 'error';
        }
        else
        {
            $return['error']   = 'success';
        }
        die(json_encode($return));
    }