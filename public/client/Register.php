<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = lang(131).' | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    //require_once("../../public/client/Nav.php");
?>

<body class="auth-wrapper">
    <div class="all-wrapper menu-side with-pattern">
        <div class="auth-box-w">
            <div class="logo-w"><a href="<?=BASE_URL('');?>"><img alt="" width="100%"
                        src="<?=$CMSNT->site('logo');?>"></a></div>
            <h4 class="auth-header"><?=lang(131);?></h4>
            <form action="">
                <div id="thongbao"></div>
                <div class="form-group"><label for=""><?=lang(5);?></label><input class="form-control" id="username"
                        placeholder="<?=lang(7);?>">
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group"><label for=""> <?=lang(6);?></label><input class="form-control" id="password"
                        placeholder="<?=lang(8);?>" type="password">
                            <div class="pre-icon os-icon os-icon-fingerprint"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group"><label for=""><?=lang(132);?></label><input class="form-control" id="repassword"
                        placeholder="<?=lang(133);?>" type="password"></div>
                    </div>
                </div>
                <?php 
                use Gregwar\Captcha\CaptchaBuilder;
                $builder = new CaptchaBuilder;
                $builder->build();
                $_SESSION['phrase'] = $builder->getPhrase();
                if($CMSNT->site('status_capchat') == "ON"){ ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for=""><?=lang(156);?></label>
                            <img width="100%" src="<?php echo $builder->inline(); ?>" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for=""><?=lang(157);?></label>
                        <input class="form-control" id="phrase"
                        placeholder="Nội dung bên trái" type="text"></div>
                    </div>
                </div>
                <?php }?>   
                <div class="buttons-w">
                    <button class="btn btn-danger btn-block" id="Register" type="button"><?=lang(2);?></button>
                    <a class="btn btn-primary btn-block" href="<?=BASE_URL('Auth/Login');?>"
                        type="button"><?=lang(1);?></a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
<script type="text/javascript">
$("#Register").on("click", function() {

    $('#Register').html('<?=lang(9);?>').prop('disabled',
        true);
    Swal.fire({
        title: '<?=lang(111);?>',
        text: '',
        imageUrl: '<?=BASE_URL('assets/img/loading.gif');?>',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
    })
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
        method: "POST",
        data: {
            type: 'Register',
            username: $("#username").val(),
            password: $("#password").val(),
            repassword: $("#repassword").val(),
            phrase: $("#phrase").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#Register').html(
                    '<?=lang(2);?>')
                .prop('disabled', false);
        }
    });
});
</script>
