<?php

$CMSNT = new CMSNT;
$MEMO_PREFIX        = $CMSNT->site('noidung_naptien');
$site_gmail_momo    = $CMSNT->site('email');
$site_pass_momo     = $CMSNT->site('pass_email');
require_once(__DIR__.'/../vendor/autoload.php');

$config = [
    'project'   => 'CLONEV5',
    'version'   => '2029'
];


function checkFormatCard($type, $seri, $pin){
    $seri = strlen($seri);
    $pin = strlen($pin);
    $data = [];
    if($type == 'Viettel' || $type == "viettel" || $type == "VT" || $type == "VIETTEL"){
        if($seri != 11 && $seri != 14){
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if($pin != 13 && $pin != 15){
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if($type == 'Mobifone' || $type == "mobifone" || $type == "Mobi" || $type == "MOBIFONE"){
        if($seri != 15){
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if($pin != 12){
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if($type == 'VNMB' || $type == "Vnmb" || $type == "VNM" || $type == "VNMOBI"){
        if($seri != 16){
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if($pin != 12){
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if($type == 'Vinaphone' || $type == "vinaphone" || $type == "Vina" || $type == "VINAPHONE"){
        if($seri != 14){
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if($pin != 14){
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if($type == 'Garena' || $type == "garena" || $type == "GARENA"){
        if($seri != 9){
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if($pin != 16){
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if($type == 'Zing' || $type == "zing" || $type == "ZING"){
        if($seri != 12){
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if($pin != 9){
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if($type == 'Vcoin' || $type == "VTC" || $type == "VCOIN"){
        if($seri != 12){
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if($pin != 12){
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    $data = [
        'status'    => true,
        'msg'       => 'Jss'
    ];
    return $data;
}
// cộng khuyến mãi
function add_promotion($username, $money, $tid)
{
    global $CMSNT;
    if($CMSNT->num_rows(" SELECT * FROM `promotion` WHERE `min` <= '$money' ") > 0)
    {
        // lấy mốc cao nhất 
        foreach($CMSNT->get_list("SELECT * FROM `promotion` WHERE `min` <= '$money' ORDER BY `min` DESC ") as $row)
        {
            // tính số tiền khuyến mãi
            $amount = $money * $row['bonus'] / 100;
            $getUser = $CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '$username' ");
            $isCheckMoney = $CMSNT->cong("users", "money", $amount, " `username` = '$username' ");
            if($isCheckMoney)
            {
                $CMSNT->cong("users", "total_money", $amount, " `username` = '$username' ");
                /* GHI LOG DÒNG TIỀN */
                $CMSNT->insert("dongtien", array(
                    'sotientruoc' => $getUser['money'],
                    'sotienthaydoi' => $amount,
                    'sotiensau' => $getUser['money'] + $amount,
                    'thoigian' => gettime(),
                    'noidung' => 'Khuyến mãi nạp tiền ('.$tid.')',
                    'username' => $username
                ));
            }
            break;
        } 
    }
}
// trừ tiền ghi nợ
function debit_processing($username)
{
    global $CMSNT; 
    // Trừ tiền ghi nợ
    $getUser = $CMSNT->get_row(" SELECT * FROM `users` WHERE `username` = '".$username."'  ");
    if($getUser['debit_amount'] > 0)
    {
        if($getUser['money'] >= $getUser['debit_amount'])
        {
            // xử lý trường hợp đủ tiền trả nợ
            $CMSNT->tru("users", "money", $getUser['debit_amount'], " `username` = '".$getUser['username']."' ");
            $CMSNT->tru("users", "debit_amount", $getUser['debit_amount'], " `username` = '".$getUser['username']."' ");
            $CMSNT->insert("dongtien", array(
                'sotientruoc'   => $getUser['money'],
                'sotienthaydoi' => $getUser['debit_amount'],
                'sotiensau'     => $getUser['money'] - $getUser['debit_amount'],
                'thoigian'      => gettime(),
                'noidung'       => 'Thanh toán số dư ghi nợ',
                'username'      => $getUser['username']
            ));
        }
        else
        {
            // xử lý trường hợp không đủ tiền trả nợ
            $CMSNT->tru("users", "money", $getUser['money'], " `username` = '".$getUser['username']."' ");
            $CMSNT->tru("users", "debit_amount", $getUser['money'], " `username` = '".$getUser['username']."' ");
            $CMSNT->insert("dongtien", array(
                'sotientruoc'   => $getUser['money'],
                'sotienthaydoi' => $getUser['money'],
                'sotiensau'     => $getUser['money'] - $getUser['money'],
                'thoigian'      => gettime(),
                'noidung'       => 'Thanh toán số dư ghi nợ',
                'username'      => $getUser['username']
            ));
        }
    }
}

function display_online($time)
{
    if(time() - $time <= 300)
    {
        return '<span class="badge badge-success">Online</span>';
    }
    else
    {
        return '<span class="badge badge-danger">Offline</span>';
    } 
}
function insert_options($name, $value)
{
    global $CMSNT;
    if(!$CMSNT->get_row("SELECT * FROM `options` WHERE `name` = '$name' "))
    {
        $CMSNT->insert("options", [
            'name'  => $name,
            'value' => $value
        ]);
    }
}
function insert_lang($id, $vn, $en)
{
    global $CMSNT;
    if(!$CMSNT->get_row("SELECT * FROM `lang` WHERE `id` = '$id' "))
    {
        $CMSNT->insert("lang", [
            'id'    => $id,
            'vn'    => $vn,
            'en'    => $en
        ]);
    }
}
function format_currency($amount)
{
    if(isset($_SESSION['lang']))
    {
        if($_SESSION['lang'] == 'en')
        {
            return '$'.number_format($amount / 23000, 2, '.', '');
        }
        else
        {
            return format_cash($amount, 'đ');
        }
    }
    else
    {
        return format_cash($amount, 'đ');
    }
}
function lang($id)
{   
    global $CMSNT;
    if(isset($_SESSION['lang']))
    {
        if($_SESSION['lang'] == 'en')
        {
            return $CMSNT->get_row("SELECT * FROM `lang` WHERE `id` = '$id' ")['en'];
        }
        else
        {
            return $CMSNT->get_row("SELECT * FROM `lang` WHERE `id` = '$id' ")['vn'];
        }
    }
    else
    {
        return $CMSNT->get_row("SELECT * FROM `lang` WHERE `id` = '$id' ")['vn'];
    }
}
function format_date($time){
    return date("H:i:s d/m/Y", $time);
}
function card24h($telco, $amount, $serial, $pin, $trans_id){
    global $CMSNT;
    $partner_id = $CMSNT->site('partner_id_card');
    $partner_key = $CMSNT->site('partner_key_card');
    $url = base64_decode('aHR0cHM6Ly9jYXJkMjRoLmNvbS9jaGFyZ2luZ3dzL3YyP3NpZ249').md5($partner_key.$pin.$serial).'&telco='.$telco.'&code='.$pin.'&serial='.$serial.'&amount='.$amount.'&request_id='.$trans_id.'&partner_id='.$partner_id.'&command=charging';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    return json_decode($data, true);
}

function loai()
{
    /* BÁN GÌ THÌ THÊM Ở ĐÂY NHÉ, <option value="MÃ SẢN PHẨM">TÊN SẢN PHẨM</option> */
    $html = '
    <option value="CLONE">CLONE</option>
    <option value="VIA">VIA</option>
    <option value="GMAIL">GMAIL</option>
    <option value="BM">BM</option>
    <option value="KHÁC">KHÁC</option>

    ';
    return $html;
}
function livefb($data)
{
    if ($data == 'DIE')
    {
        $show = '<span class="badge bg-danger">DIE</span>';
    }
    else if ($data == 'LIVE')
    {
        $show = '<span class="badge bg-success">LIVE</span>';
    }
    return $show;
}
function display_loai($data)
{
    if ($data == 'FACEBOOK')
    {
        $show = '<span class="badge badge-primary">FACEBOOK</span>';
    }
    else if ($data == 'GMAIL')
    {
        $show = '<span class="badge badge-warning">GMAIL</span>';
    }
    else if ($data == 'HOTMAIL')
    {
        $show = '<span class="badge badge-warning">HOTMAIL</span>';
    }
    else if ($data == 'ZALO')
    {
        $show = '<span class="badge badge-primary">ZALO</span>';
    }
    else if ($data == 'TWITTER')
    {
        $show = '<span class="badge badge-info">TWITTER</span>';
    }
    else if ($data == 'MAILEDU')
    {
        $show = '<span class="badge badge-info">MAIL EDU</span>';
    }
    else if ($data == 'BM')
    {
        $show = '<span class="badge badge-primary">BM</span>';
    }
    else
    {
        $show = '<span class="badge badge-dark">'.$data.'</span>';
    }
    return $show;
}
function daily($ck)
{
    if($ck == 0)
    {
        return lang(64);
    }
    else if($ck > 0)
    {
        return lang(65);
    }
}
function trangthai($data)
{
    if($data == 'xuly')
    {
        return 'Đang xử lý';
    }
    else if($data == 'hoantat')
    {
        return 'Hoàn tất';
    }
    else if($data == 'thanhcong')
    {
        return 'Thành công';
    }
    else if($data == 'huy')
    {
        return 'Hủy';
    }
    else if($data == 'thatbai')
    {
        return 'Thất bại';
    }
    else
    {
        return 'Khác';
    }
}
/* CMSNT.CO TEAM LEADER - NTTHANH - DEV PHP */
function CheckLiveBM($bmid)
{
    global $CMSNT;
    $access_token = $CMSNT->get_row(" SELECT * FROM `token` ORDER BY RAND() LIMIT 1 ")['token'];
    $json = json_decode(curl_get('https://graph.facebook.com/v7.0/'.$bmid.'?access_token='.$access_token.'&_index=0&_reqName=object:brand&_reqSrc=BrandResourceRequests.brands&date_format=U&fields=[%22id%22,%22name%22,%22verification_status%22,%22sharing_eligibility_status%22,%22allow_page_management_in_www%22,%22can_create_ad_account%22]&locale=vi_VN&method=get'), true);
    
    if ($json['allow_page_management_in_www'] == false)
    {
        return 'DIE';
    }
    else if ($json['allow_page_management_in_www'] == true)
    {
        return 'LIVE';
    }
}
function CheckLiveClone($uid)
{
    //$json = json_decode(curl_get("https://graph.facebook.com/".$uid."/picture?redirect=false"), true);
    $json = json_decode(curl_get("https://graph2.facebook.com/v3.3/".$uid."/picture?redirect=0"), true);
    if($json['data'])
    {
        if(empty($json['data']['height']) && empty($json['data']['width']))
        {
            return 'DIE';
        }
        else
        {
            return 'LIVE';
        }
    }
    else
    {
        return 'LIVE';
    }
}
function CheckLiveEmail($type, $email)
{
    if($type === 'GMAIL')
    {
        $vmail = new verifyEmail();
        if ($vmail->check($email))
        {
            return 'LIVE';
        } 
        else if (verifyEmail::validate($email))
        {
            return 'DIE';
        } 
        return 'LIVE';
    }
    if($type === 'YAHOO')
    {
        /* CẢM ƠN API-MAIL-VIP CUNG CẤP API */
        $result = json_decode(curl_get('https://api-mail-vip.000webhostapp.com/yahoo.php?email='.$email), true);
        if($result['code'] == 200)
        {
            return 'DIE';
        }
        return 'LIVE';
    }
    if($type === 'HOTMAIL')
    {
        /* CẢM ƠN API-MAIL-VIP CUNG CẤP API */
        $result = json_decode(curl_get('https://api-mail-vip.000webhostapp.com/hotmail.php?email='.$email), true);
        if($result['code'] == 200)
        {
            return 'DIE';
        }
        return 'LIVE';
    }
}
function loaithe($data)
{
    if ($data == 'VIETTEL' || $data == 'viettel')
    {
        $show = 'https://i.imgur.com/xFePMtd.png';
    }
    else if ($data == 'VINAPHONE' || $data == 'vinaphone')
    {
        $show = 'https://i.imgur.com/s9Qq3Fz.png';
    }
    else if ($data == 'MOBIFONE' || $data == 'mobifone')
    {
        $show = 'https://i.imgur.com/qQtcWJW.png';
    }
    else if ($data == 'VNMOBI' || $data == 'vietnamobile')
    {
        $show = 'https://i.imgur.com/IHm28mq.png';
    }
    else if ($data == 'ZING' || $data == 'zing')
    {
        $show = 'https://i.imgur.com/xkd7kQ0.png';
    }
    else if ($data == 'GARENA' || $data == 'garena')
    {
        $show = 'https://i.imgur.com/BLkY5qm.png';
    }
    return '<img style="text-align: center;" src="'.$show.'" width="70px" />';
}

function sendCSM($mail_nhan,$ten_nhan,$chu_de,$noi_dung,$bcc)
{
    global $site_gmail_momo, $site_pass_momo;
        // PHPMailer Modify
        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail ->Debugoutput = "html";
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $site_gmail_momo; // GMAIL STMP
        $mail->Password = $site_pass_momo; // PASS STMP
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom($site_gmail_momo, $bcc);
        $mail->addAddress($mail_nhan, $ten_nhan);
        $mail->addReplyTo($site_gmail_momo, $bcc);
        $mail->isHTML(true);
        $mail->Subject = $chu_de;
        $mail->Body    = $noi_dung;
        $mail->CharSet = 'UTF-8';
        $send = $mail->send();
        return $send;
}
function parse_order_id($des)
{
    global $MEMO_PREFIX;
    $re = '/'.$MEMO_PREFIX.'\d+/im';
    preg_match_all($re, $des, $matches, PREG_SET_ORDER, 0);
    if (count($matches) == 0 )
        return null;
    // Print the entire match result
    $orderCode = $matches[0][0];
    $prefixLength = strlen($MEMO_PREFIX);
    $orderId = intval(substr($orderCode, $prefixLength ));
    return $orderId ;
}
$domain_block = [
    'trumbanclone.pw',
    'blog.sieuthicode.net',
    'sieuthidark.com',
    'xubymon36.com',
    'viatrau.me',
    'shopmailco.com',
    'clonebysun.net',
    'phongxu.com',
    'minhclone.com',
    'rdsieuvip.com',
    'sellviaxu.com',
    'autordff.com',
    'huyclone.com',
    'clonengoaiviet.com'
];
// Hàm redirect
function redirect($url)
{
    header("Location: {$url}");
    exit();
}
function base_url($url = '')
{
    global $domain_block;
    $a = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
    if ($a == 'http://localhost') {
        $a = 'http://localhost/CMSNT.CO/SHOPCLONE5';
    }
    foreach($domain_block as $domain){
        if($domain == $_SERVER['HTTP_HOST']){
            return redirect(base64_decode('aHR0cHM6Ly93d3cuY21zbnQuY28v'));
        }
    }
    return $a.'/'.$url;
}

function gettime()
{
    return date('Y/m/d H:i:s', time());
}
function check_string($data)
{
    return trim(htmlspecialchars(addslashes($data)));
    //return str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($data))));
}

function format_cash($number, $suffix = '') {
    return number_format($number, 0, ',', '.') . "{$suffix}";
}
function curl_get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    
    curl_close($ch);
    return $data;
}
function random($string, $int)
{  
    return substr(str_shuffle($string), 0, $int);
}
function pheptru($int1, $int2)
{
    return $int1 - $int2;
}
function phepcong($int1, $int2)
{
    return $int1 + $int2;
}
function phepnhan($int1, $int2)
{
    return $int1 * $int2;
}
function phepchia($int1, $int2)
{
    return $int1 / $int2;
}
function check_img($img)
{
    $filename = $_FILES[$img]['name'];
    $ext = explode(".", $filename);
    $ext = end($ext);
    $valid_ext = array("png","jpeg","jpg","PNG","JPEG","JPG","gif","GIF");
    if(in_array($ext, $valid_ext))
    {
        return true;
    }
}
/*
function msg_success2($text)
{
    return die('<div class="alert alert-success alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div>');
}
function msg_error2($text)
{
    return die('<div class="alert alert-danger alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div>');
}
function msg_warning2($text)
{
    return die('<div class="alert alert-warning alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div>');
}
function msg_success($text, $url, $time)
{
    return die('<div class="alert alert-success alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div><script type="text/javascript">setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_error($text, $url, $time)
{
    return die('<div class="alert alert-danger alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div><script type="text/javascript">setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_warning($text, $url, $time)
{
    return die('<div class="alert alert-warning alert-dismissible error-messages">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div><script type="text/javascript">setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
*/
function msg_success2($text)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(96).'", "'.$text.'","success");</script>');
}
function msg_error2($text)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(95).'", "'.$text.'","error");</script>');
}
function msg_warning2($text)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(97).'", "'.$text.'","warning");</script>');
}
function msg_success($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(96).'", "'.$text.'","success");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_error($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(95).'", "'.$text.'","error");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function msg_warning($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(97).'", "'.$text.'","warning");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}

function admin_msg_success($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(96).'", "'.$text.'","success");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function admin_msg_error($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(95).'", "'.$text.'","error");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function admin_msg_warning($text, $url, $time)
{
    return die('<script type="text/javascript">Swal.fire("'.lang(97).'", "'.$text.'","warning");
    setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
}
function display_banned($data)
{
    if ($data == 1)
    {
        $show = '<span class="badge badge-danger">Banned</span>';
    }
    else if ($data == 0)
    {
        $show = '<span class="badge badge-success">Hoạt động</span>';
    }
    return $show;
}
function display_loaithe($data)
{
    if ($data == 0)
    {
        $show = '<span class="label label-warning">Bảo trì</span>';
    }
    else 
    {
        $show = '<span class="label label-success">Hoạt động</span>';
    }
    return $show;
}
function display_ruttien($data)
{
    if ($data == 'xuly')
    {
        $show = '<span class="label label-info">Đang xử lý</span>';
    }
    else if ($data == 'hoantat')
    {
        $show = '<span class="label label-success">Đã thanh toán</span>';
    }
    else if ($data == 'huy')
    {
        $show = '<span class="label label-danger">Hủy</span>';
    }
    return $show;
}
function XoaDauCach($text)
{
    return trim(preg_replace('/\s+/',' ', $text));
}
function display($data)
{
    if ($data == 'HIDE')
    {
        $show = '<span class="badge badge-danger">ẨN</span>';
    }
    else if ($data == 'SHOW')
    {
        $show = '<span class="badge badge-success">HIỂN THỊ</span>';
    }
    return $show;
}
function status($data)
{
    if ($data == 'xuly'){
        $show = '<span class="label label-info">Đang xử lý</span>';
    }
    else if ($data == 'hoantat'){
        $show = '<span class="label label-success">Hoàn tất</span>';
    }
    else if ($data == 'thanhcong'){
        $show = '<span class="label label-success">Thành công</span>';
    }
    else if ($data == 'success'){
        $show = '<span class="label label-success">Success</span>';
    }
    else if ($data == 'thatbai'){
        $show = '<span class="label label-danger">Thất bại</span>';
    }
    else if ($data == 'error'){
        $show = '<span class="label label-danger">Error</span>';
    }
    else if ($data == 'loi'){
        $show = '<span class="label label-danger">Lỗi</span>';
    }
    else if ($data == 'huy'){
        $show = '<span class="label label-danger">Hủy</span>';
    }
    else if ($data == 'dangnap'){
        $show = '<span class="label label-warning">Đang đợi nạp</span>';
    }
    else if ($data == 2){
        $show = '<span class="label label-success">Hoàn tất</span>';
    }
    else if ($data == 1){
        $show = '<span class="label label-info">Đang xử lý</span>';
    }
    else{
        $show = '<span class="label label-warning">Khác</span>';
    }
    return $show;
}
function getHeader(){
    $headers = array();
    $copy_server = array(
        'CONTENT_TYPE'   => 'Content-Type',
        'CONTENT_LENGTH' => 'Content-Length',
        'CONTENT_MD5'    => 'Content-Md5',
    );
    foreach ($_SERVER as $key => $value) {
        if (substr($key, 0, 5) === 'HTTP_') {
            $key = substr($key, 5);
            if (!isset($copy_server[$key]) || !isset($_SERVER[$key])) {
                $key = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', $key))));
                $headers[$key] = $value;
            }
        } elseif (isset($copy_server[$key])) {
            $headers[$copy_server[$key]] = $value;
        }
    }
    if (!isset($headers['Authorization'])) {
        if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            $headers['Authorization'] = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        } elseif (isset($_SERVER['PHP_AUTH_USER'])) {
            $basic_pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
            $headers['Authorization'] = 'Basic ' . base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $basic_pass);
        } elseif (isset($_SERVER['PHP_AUTH_DIGEST'])) {
            $headers['Authorization'] = $_SERVER['PHP_AUTH_DIGEST'];
        }
    }
    return $headers;
}

function check_username($data)
{
    if (preg_match('/^[a-zA-Z0-9_-]{3,16}$/', $data, $matches))
    {
        return True;
    }
    else
    {
        return False;
    }
}
function check_email($data)
{
    if (preg_match('/^.+@.+$/', $data, $matches))
    {
        return True;
    }
    else
    {
        return False;
    }
}
function check_phone($data)
{
    if (preg_match('/^\+?(\d.*){3,}$/', $data, $matches))
    {
        return True;
    }
    else
    {
        return False;
    }
}
function check_url($url)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_HEADER, 1);
    curl_setopt($c, CURLOPT_NOBODY, 1);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_FRESH_CONNECT, 1);
    if(!curl_exec($c))
    {
        return false;
    }
    else
    {
        return true;
    }
}
function check_zip($img)
{
    $filename = $_FILES[$img]['name'];
    $ext = explode(".", $filename);
    $ext = end($ext);
    $valid_ext = array("zip","ZIP");
    if(in_array($ext, $valid_ext))
    {
        return true;
    }
}
function TypePassword($string)
{
    global $CMSNT;
    if($CMSNT->site('TypePassword') == 'md5')
    {
        return md5($string);
    }
    else if($CMSNT->site('TypePassword') == 'sha1')
    {
        return sha1($string);
    }
    else if($CMSNT->site('TypePassword') == '')
    {
        return $string;
    }
    else
    {
        return md5($string);
    }
}
function phantrang($url, $start, $total, $kmess)
{
    $out[] = '<nav aria-label="Page navigation example"><ul class="pagination pagination-lg">';
    $neighbors = 2;
    if ($start >= $total) $start = max(0, $total - (($total % $kmess) == 0 ? $kmess : ($total % $kmess)));
    else $start = max(0, (int)$start - ((int)$start % (int)$kmess));
    $base_link = '<li class="page-item"><a class="page-link" href="' . strtr($url, array('%' => '%%')) . 'page=%d' . '">%s</a></li>';
    $out[] = $start == 0 ? '' : sprintf($base_link, $start / $kmess, '<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>');
    if ($start > $kmess * $neighbors) $out[] = sprintf($base_link, 1, '1');
    if ($start > $kmess * ($neighbors + 1)) $out[] = '<li class="page-item"><a class="page-link">...</a></li>';
    for ($nCont = $neighbors;$nCont >= 1;$nCont--) if ($start >= $kmess * $nCont) {
        $tmpStart = $start - $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    $out[] = '<li class="page-item active"><a class="page-link">' . ($start / $kmess + 1) . '</a></li>';
    $tmpMaxPages = (int)(($total - 1) / $kmess) * $kmess;
    for ($nCont = 1;$nCont <= $neighbors;$nCont++) if ($start + $kmess * $nCont <= $tmpMaxPages) {
        $tmpStart = $start + $kmess * $nCont;
        $out[] = sprintf($base_link, $tmpStart / $kmess + 1, $tmpStart / $kmess + 1);
    }
    if ($start + $kmess * ($neighbors + 1) < $tmpMaxPages) $out[] = '<li class="page-item"><a class="page-link">...</a></li>';
    if ($start + $kmess * $neighbors < $tmpMaxPages) $out[] = sprintf($base_link, $tmpMaxPages / $kmess + 1, $tmpMaxPages / $kmess + 1);
    if ($start + $kmess < $total)
    {
        $display_page = ($start + $kmess) > $total ? $total : ($start / $kmess + 2);
        $out[] = sprintf($base_link, $display_page, '<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
        ');
    }
    $out[] = '</ul></nav>';
    return implode('', $out);
}
function myip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))     
    {  
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];  
    }  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))    
    {  
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
    else  
    {  
        $ip_address = $_SERVER['REMOTE_ADDR'];  
    }
    return check_string($ip_address);
}
function timeAgo($time_ago)
{
    $time_ago   = date("Y-m-d H:i:s", $time_ago);
    $time_ago   = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60)
    {
        return "$seconds giây trước";
    }
    //Minutes
    else if($minutes <= 60)
    {
        return "$minutes phút trước";
    }
    //Hours
    else if($hours <= 24)
    {
        return "$hours tiếng trước";
    }
    //Days
    else if($days <= 7)
    {
        if($days == 1)
        {
            return "Hôm qua";
        }
        else
        {
            return "$days ngày trước";
        }
    }
    //Weeks
    else if($weeks <= 4.3)
    {
        return "$weeks tuần trước";
    }
    //Months
    else if($months <=12)
    {
        return "$months tháng trước";
    }
    //Years
    else
    {
        return "$years năm trước";
    }
}
function dirToArray($dir) {
  
    $result = array();
 
    $cdir = scandir($dir);
    foreach ($cdir as $key => $value)
    {
       if (!in_array($value,array(".","..")))
       {
          if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
          {
             $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
          }
          else
          {
             $result[] = $value;
          }
       }
    }
   
    return $result;
 }

 function realFileSize($path)
{
    if (!file_exists($path))
        return false;

    $size = filesize($path);
   
    if (!($file = fopen($path, 'rb')))
        return false;
   
    if ($size >= 0)
    {//Check if it really is a small file (< 2 GB)
        if (fseek($file, 0, SEEK_END) === 0)
        {//It really is a small file
            fclose($file);
            return $size;
        }
    }
   
    //Quickly jump the first 2 GB with fseek. After that fseek is not working on 32 bit php (it uses int internally)
    $size = PHP_INT_MAX - 1;
    if (fseek($file, PHP_INT_MAX - 1) !== 0)
    {
        fclose($file);
        return false;
    }
   
    $length = 1024 * 1024;
    while (!feof($file))
    {//Read the file until end
        $read = fread($file, $length);
        $size = bcadd($size, $length);
    }
    $size = bcsub($size, $length);
    $size = bcadd($size, strlen($read));
   
    fclose($file);
    return $size;
}
function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}
function GetCorrectMTime($filePath)
{

    $time = filemtime($filePath);

    $isDST = (date('I', $time) == 1);
    $systemDST = (date('I') == 1);

    $adjustment = 0;

    if($isDST == false && $systemDST == true)
        $adjustment = 3600;
   
    else if($isDST == true && $systemDST == false)
        $adjustment = -3600;

    else
        $adjustment = 0;

    return ($time + $adjustment);
}
function DownloadFile($file) { // $file = include path
    if(file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
}
function getFileType(string $url):string{
    $filename=explode('.',$url);
    $extension=end($filename);

    switch($extension){
        case 'pdf':
            $type=$extension;
            break;
        case 'docx':
        case 'doc':
            $type='word';
            break;
        case 'xls':
        case 'xlsx':
            $type='excel';
            break;
        case 'mp3':
        case 'ogg':
        case 'wav':
            $type='audio';
            break;
        case 'mp4':
        case 'mov':
            $type='video';
            break;
        case 'zip':
        case '7z':
        case 'rar':
            $type='archive';
            break;
        case 'jpg':
        case 'jpeg':
        case 'png':
            $type='image';
            break;
        default:
            $type='alt';
    }

    return $type;
}
/* CMSNT.CO TEAM LEADER - NTTHANH - DEV PHP */