<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once("../../class/verifyEmaill.php");

    if(isset($_GET['uid']))
    {
        $uid = check_string($_GET['uid']);
        if(explode("|", $uid))
        {
            $uid = explode("|", $uid)[0];
        }
        if(CheckLiveEmail('YAHOO', $uid) == 'DIE')
        {
           die('DIE');
        }
        else
        {
            die('LIVE');
        }
    }
    
    