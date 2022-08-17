<?php
    require_once(__DIR__."/config/config.php");
    require_once(__DIR__."/config/function.php");

    if(isset($_GET['ref']) )
    {
        if($CMSNT->get_row("SELECT * FROM `users` WHERE `id` = '".$_SESSION['ref']."' ")['ip'] != myip())
        {
            $_SESSION['ref'] = check_string($_GET['ref']);
        }
        else
        {
            $_SESSION['ref'] = NULL;
        }
    }
    if(empty($_SESSION['ref']))
    {
        $_SESSION['ref'] = NULL;
    }
    /* ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO 0947838128 | FB.COM/NTGTANETWORK */
    if($CMSNT->site('theme') != '')
    {
        require_once(__DIR__."/page/".$CMSNT->site('theme')."/index.php");
    }
    else
    {
        header("location:".BASE_URL('Dashbroad'));
        exit();
    }
