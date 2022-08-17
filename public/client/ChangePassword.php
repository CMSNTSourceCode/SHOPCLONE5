<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'THAY ĐỔI MẬT KHẨU | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
?>

<body class="auth-wrapper">
    <div class="all-wrapper menu-side with-pattern">
        <div class="auth-box-w">
            <div class="logo-w"><a href="<?=BASE_URL('');?>"><img alt="" width="100%"
                        src="<?=$CMSNT->site('logo');?>"></a></div>
            <h4 class="auth-header"><?=lang(125);?></h4>
            <form action="">
                <div id="thongbao"></div>
                <div class="form-group"><label for=""><?=lang(123);?></label><input class="form-control" id="otp"
                        placeholder="<?=lang(123);?>">
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                </div>
                <div class="form-group"><label for=""><?=lang(6);?></label><input class="form-control" id="password"
                        placeholder="<?=lang(8);?>" type="password">
                    <div class="pre-icon os-icon os-icon-fingerprint"></div>
                </div>
                <div class="form-group"><label for=""><?=lang(124);?></label><input class="form-control" id="repassword"
                        placeholder="<?=lang(124);?>" type="password">
                    <div class="pre-icon os-icon os-icon-fingerprint"></div>
                </div>
                <div class="buttons-w"><button class="btn btn-primary btn-block" id="ChangePassword" type="submit">ĐỔI
                        MẬT KHẨU</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>



<script type="text/javascript">
$("#ChangePassword").on("click", function() {

    $('#ChangePassword').html('ĐANG XỬ LÝ').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
        method: "POST",
        data: {
            type: 'ChangePassword',
            otp: $("#otp").val(),
            password: $("#password").val(),
            repassword: $("#repassword").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#ChangePassword').html(
                    'Đổi mật khẩu')
                .prop('disabled', false);
        }
    });
});
</script>


<?php 
    //require_once("../../public/client/Footer.php");
?>