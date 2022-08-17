<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = lang(122).' | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    //require_once("../../public/client/Nav.php");
?>

<body class="auth-wrapper">
    <div class="all-wrapper menu-side with-pattern">
        <div class="auth-box-w">
            <div class="logo-w"><a href="<?=BASE_URL('');?>"><img alt="" width="100%"
                        src="<?=$CMSNT->site('logo');?>"></a></div>
            <h4 class="auth-header"><?=lang(122);?></h4>
            <form action="">
                <div id="thongbao"></div>
                <div class="form-group">
                    <label><?=lang(135);?></label>
                    <input type="email" class="form-control" id="email" placeholder="Nhập địa chỉ email">
                    <div class="pre-icon os-icon os-icon-email-2-at2"></div>
                </div>
                <div class="buttons-w"><button class="btn btn-primary btn-block" id="ForgotPassword"
                        type="submit"><?=lang(137);?></button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>




<script type="text/javascript">
$("#ForgotPassword").on("click", function() {

    $('#ForgotPassword').html('ĐANG XỬ LÝ').prop('disabled',
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
            type: 'ForgotPassword',
            email: $("#email").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#ForgotPassword').html(
                    '<?=lang(137);?>')
                .prop('disabled', false);
        }
    });
});
</script>


<?php 
    //require_once("../../public/client/Footer.php");
?>