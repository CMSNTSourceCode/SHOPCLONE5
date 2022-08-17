<?php
    require_once("../config/config.php");
    require_once("../config/function.php");

 
    /** CALLBACK */
    if(isset($_GET['request_id']) && isset($_GET['callback_sign'])){
        $status = check_string($_GET['status']);
        $message = check_string($_GET['message']);
        $request_id = check_string($_GET['request_id']); // request id
        $declared_value = check_string($_GET['declared_value']); //Giá trị khai báo
        $value = check_string($_GET['value']); //Giá trị thực của thẻ
        $amount = check_string($_GET['amount']); //Số tiền nhận được
        $code = check_string($_GET['code']);
        $serial = check_string($_GET['serial']);
        $telco = check_string($_GET['telco']);
        $trans_id = check_string($_GET['trans_id']); //Mã giao dịch bên chúng tôi
        $callback_sign = check_string($_GET['callback_sign']);

        if($callback_sign != md5($CMSNT->site('partner_key_card').$code.$serial)){
            die('callback_sign_error');
        }
        if(!$row = $CMSNT->get_row(" SELECT * FROM `cards` WHERE `code` = '$request_id' AND `status` = 'xuly' ")){
            die('request_id_error');
        }
        if($status == 1){
            if($CMSNT->site('ck_card') == 0){
                $thucnhan = $amount;
            }else{
                $thucnhan = $value - $value * $CMSNT->site('ck_card') / 100;
            }
            /* CẬP NHẬT TRẠNG THÁI THẺ CÀO */
            $CMSNT->update("cards", array(
                'status'    => 'thanhcong',
                'thucnhan'  => $thucnhan
            ), " `id` = '".$row['id']."' ");
            $getUser = $CMSNT->get_row(" SELECT * FROM `users` WHERE `username` = '".$row['username']."' ");
            /* CỘNG TIỀN USER */
            $CMSNT->cong("users", "money", $thucnhan, " `id` = '".$getUser['id']."' ");
            $CMSNT->cong("users", "total_money", $thucnhan, " `id` = '".$getUser['id']."' ");
            /* GHI LOG DÒNG TIỀN */
            $CMSNT->insert("dongtien", array(
                'sotientruoc'   => $getUser['money'],
                'sotienthaydoi' => $thucnhan,
                'sotiensau'     => $getUser['money'] + $thucnhan,
                'thoigian'      => gettime(),
                'noidung'       => 'Nạp tiền tự động qua thẻ cào seri ('.$row['seri'].')',
                'username'      => $getUser['username']
            ));
            die('payment.success');
        }
        else{
              /* CẬP NHẬT TRẠNG THÁI THẺ CÀO */
            $CMSNT->update("cards", array(
                'status'    => 'thatbai',
                'thucnhan'  => '0'
            ), " `id` = '".$row['id']."' ");
            exit('payment.error');
        }
    }




 
