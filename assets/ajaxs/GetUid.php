<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if(isset($_POST['type']))
    {
        if(!isset($_SESSION['username']))
        {
            msg_error2(lang(86));
        }
        if(empty($_POST['url']))
        {
            msg_error2("Vui lòng nhập URL");
        }
        if($CMSNT->num_rows("SELECT * FROM `token` ") == 0)
        {
            msg_error2("Hệ thống không thể get UID vào lúc này do Admin chưa thêm Token!");
        }
        ini_set('max_execution_time', 0);
        $access_token =  $CMSNT->get_row(" SELECT * FROM `token` ")['token'];
        $token        =  $access_token;
        $url          = trim($_POST['url']);
        preg_match_all('/(?<=profile\.php\?id\=)([0-9]+)|(?:(?<=\.com)|(?<=\.me)|(?<=\.co)|(?<=\.us))(?:(?:\/groups\/|\/)(?!profile\.php)([\w\.\_]+))/', $url, $array, PREG_SET_ORDER);
        $array_new = array();
        $array_name = array();
        foreach ($array as $key => $child_array) {
            $array_new[end($child_array)] = 0;
        }
        $total_import    = count($array_new);
        $page_limit      = 50;
        $num_page        = ceil($total_import/$page_limit);
        for($page=0; $page<$num_page; $page++) {
            $offset  = $page*$page_limit;
            $fbmaped = array_slice($array_new, $offset, $page_limit);
            $index   = array_keys($fbmaped);
            $ids     = implode(",", $index);
            $link    = "https://graph.facebook.com/?ids=$ids&fields=id,name&access_token=$token";
            $curl    = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$link",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $data     = json_decode($response,JSON_UNESCAPED_UNICODE);
            foreach ($data as $key => $each) {
                $array_new_id[$key] = $each['id'];
                $array_name[$key]   = $each['name'];
            }
        }
        $CMSNT->insert("logs", [
            'username'  => $getUser['username'],
            'content'   => 'Dùng chức năng tìm UID Facebook',
            'createdate'=> gettime(),
            'time'      => time()
        ]);
        msg_success2($array_new_id[$key]);

    }