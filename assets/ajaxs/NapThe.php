<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    $loaithe = check_string($_POST['loaithe']);
    $menhgia = check_string($_POST['menhgia']);
    $seri = check_string($_POST['seri']);
    $pin = check_string($_POST['pin']);

    if($CMSNT->site('status_card') != 'ON'){
        msg_error2("Chức năng này đang được bảo trì");
    }
    if(empty($_SESSION['username'])){
        msg_error("Vui lòng đăng nhập ", BASE_URL(''), 2000);
    }
    if(empty($loaithe)){
        msg_error2("Vui lòng chọn loại thẻ");
    }
    if(empty($menhgia)){
        msg_error2("Vui lòng chọn mệnh giá");
    }
    if(empty($seri)){
        msg_error2("Vui lòng nhập seri thẻ");
    }
    if(empty($pin)){
        msg_error2("Vui lòng nhập mã thẻ");
    }
    $rs_checkFormatCard = checkFormatCard($loaithe, $seri, $pin);
    if($rs_checkFormatCard['status'] != true){
        msg_error2($rs_checkFormatCard['msg']);
    }
    $code = random('qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM', 32);
    $data = card24h($loaithe, $menhgia, $seri, $pin, $code);
    if($data['status'] == 99){
        /* THÊM NHẬT KÝ */
        $CMSNT->insert("logs", [
            'username'  => $getUser['username'],
            'content'   => 'Thực hiện nạp thẻ',
            'createdate'=> gettime(),
            'time'      => time()
        ]);
        $CMSNT->insert("cards", array(
            'code' => $code,
            'seri' => $seri,
            'pin'  => $pin,
            'loaithe' => $loaithe,
            'menhgia' => $menhgia,
            'thucnhan' => '0',
            'username' => $getUser['username'],
            'status' => 'xuly',
            'note' => '',
            'createdate' => gettime()
        ));
        msg_success("Gửi thẻ thành công, vui lòng đợi kết quả", "", 2000);
    }
    else{
        msg_error2($data['message']);
    }
