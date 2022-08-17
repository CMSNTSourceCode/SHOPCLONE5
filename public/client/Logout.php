<?php
require_once("../../config/config.php");
require_once("../../config/function.php");



setcookie("token", "", time()-$CMSNT->site('session_login'));

session_destroy();
header("location:".BASE_URL('Auth/Login'));
exit();