<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if($_POST['type'] == 'ChangeLanguage')
    {
        $lang = check_string($_POST['lang']);
        $_SESSION['lang'] = $lang;

    }