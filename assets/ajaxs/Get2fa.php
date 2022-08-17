<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once("../../class/GoogleAuthenticator.php");

    if (isset($_POST['key']))
    {
        if(!isset($_SESSION['username']))
        {
            msg_error2(lang(86));
        }
        $key = trim($_POST['key']);
        if(empty($key))
        {
            msg_error2("Vui lòng nhập Secret Key");
        }
        $ga = new PHPGangsta_GoogleAuthenticator();
        $code = $ga->getCode($key);
        $CMSNT->insert("logs", [
            'username'  => $getUser['username'],
            'content'   => 'Dùng chức năng Get 2FA',
            'createdate'=> gettime(),
            'time'      => time()
        ]);
        msg_success2($code);
    }
