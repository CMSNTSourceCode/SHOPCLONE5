<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = lang(109).' | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
?>


<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-6">
                <div class="element-wrapper">
                    <div class="element-header">
                        <?=lang(109);?>
                    </div>
                    <div class="element-box">
                        <div id="thongbao"></div>
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Secret Key:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="key" class="form-control" placeholder="<?=lang(110);?>">
                                </div>
                            </div>
                            <button type="button" id="Get2fa" class="btn btn-primary btn-rounded">
                                <span>SUBMIT</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
    <script type="text/javascript">
    $("#Get2fa").on("click", function() {
        $('#Get2fa').html('<?=lang(111);?>').prop('disabled',
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
            url: "<?=BASE_URL("assets/ajaxs/Get2fa.php");?>",
            method: "POST",
            data: {
                type: 'Get2fa',
                key: $("#key").val()
            },
            success: function(response) {
                $("#thongbao").html(response);
                $('#Get2fa').html(
                        'SUBMIT')
                    .prop('disabled', false);
            }
        });
    });
    </script>
    <?php 
    require_once("../../public/client/Footer.php");
?>