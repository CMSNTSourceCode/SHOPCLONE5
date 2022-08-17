<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once("../../class/thesieure.php");
    
    if(empty($_SESSION['username']))
    {
        msg_error("Vui lòng đăng nhập ", BASE_URL(''), 2000);
    }
    if(empty($_POST['magiaodich']))
    {
        msg_error2("Vui lòng nhập mã giao dịch");
    }
    if($CMSNT->site('tk_tsr') == '' && $CMSNT->site('mk_tsr') == '')
    {
        msg_error2("Chức năng này đang được bảo trì");
    }
    $magiaodich = check_string($_POST['magiaodich']);
    if($CMSNT->get_row("SELECT * FROM `thesieure` WHERE `magiaodich` = '$magiaodich' "))
    {
        msg_error2("Mã giao dịch này đã được sử dụng");
    }

    
    
    $tsr = new Thesieure();
    $tsr->username = $CMSNT->site('tk_tsr');
    $tsr->password = $CMSNT->site('mk_tsr');
    $tsr->passwordc2 = $CMSNT->site('mk2_tsr');
    $tsr->noidungnap = $CMSNT->site('noidung_naptien');
    $data = json_decode($tsr->Naptien($magiaodich), true);

    if($data['status'] != true)
    {
        msg_error2("Mã giao dịch không tồn tại.");
    }
    $json_magiaodich = $data['data']['magiaodich'];
    if($CMSNT->get_row("SELECT * FROM `thesieure` WHERE `magiaodich` = '$json_magiaodich' "))
    {
        $CMSNT->update("users", array(
            'banned' => 1
        ), "username = '".$_SESSION['username']."' ");
        msg_error2("Bug cái con khỉ?");
    }
    $isCong = $CMSNT->cong("users", "money", $data['data']['sotien'], " `username` = '".$getUser['username']."' ");
    if($isCong)
    {
        $CMSNT->cong("users", "total_money", $data['data']['sotien'], " `id` = '".$getUser['id']."' ");
        $CMSNT->insert("thesieure", [
            'username'      => $getUser['username'],
            'magiaodich'    => $data['data']['magiaodich'],
            'sotien'        => $data['data']['sotien'],
            'noidung'       => $data['data']['noidung'],
            'time'          => $data['data']['time'],
            'message'       => $data['message'],
            'status'        => $data['status']
        ]);
        /* GHI LOG DÒNG TIỀN */
        $CMSNT->insert("dongtien", array(
            'sotientruoc'   => $getUser['money'],
            'sotienthaydoi' => $data['data']['sotien'],
            'sotiensau'     => $getUser['money'] + $data['data']['sotien'],
            'thoigian'      => gettime(),
            'noidung'       => 'Nạp tiền tự động qua thẻ siêu rẻ (MÃ GD '.$data['data']['magiaodich'].')',
            'username'      => $getUser['username']
        ));

        /* THÊM NHẬT KÝ */
        $CMSNT->insert("logs", [
            'username'  => $getUser['username'],
            'content'   => 'Thực hiện nạp tiền qua thẻ siêu rẻ',
            'createdate'=> gettime(),
            'time'      => time()
        ]);
    }
    msg_success($data['message'], "", 2000);
