<?php
    require_once("../config/config.php");
    require_once("../config/function.php");

    if(isset($_GET['username']) && isset($_GET['password'])){
        $money = format_currency($CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '".check_string($_GET['username'])."' AND `password` = '".TypePassword(check_string($_GET['password']))."'  ")['money']);
        die($money);
    }else{
        die('Vui lòng nhập thông tin đăng nhập để kiểm tra số dư');
    }