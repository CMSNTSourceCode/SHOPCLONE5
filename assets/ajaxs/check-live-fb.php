<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if(isset($_GET['uid']))
    {
        $uid = check_string($_GET['uid']);
        if(explode("|", $uid))
        {
            $uid = explode("|", $uid)[0];
        }
        if(CheckLiveClone($uid) == 'DIE')
        {
           die('DIE');
        }
        else
        {
            die('LIVE');
        }
    }
    