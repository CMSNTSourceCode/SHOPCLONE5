<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = 'FIND UID FACEBOOK | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
?>


<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-header">
                        LƯU Ý
                    </div>
                    <div class="element-box">
                        <p>Cộng cụ miễn phí giúp bạn lấy UID Facebook 1 cách nhanh chóng.</p>
                        <p>Cộng cụ hiện tại chỉ hỗ trợ tìm UID Profile Facebook hoặc Fanpage Facebook.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-header">
                        TÌM UID FACEBOOK
                    </div>
                    <div class="element-box">
                        <div id="thongbao"></div>
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nhập link Facebook:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="url" class="form-control"
                                        placeholder="https://www.facebook.com/cmsntthanh/">
                                </div>
                            </div>
                            <button type="button" id="GetUid" class="btn btn-primary btn-rounded">
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
    $("#GetUid").on("click", function() {
        $('#GetUid').html('<?=lang(111);?>').prop('disabled',
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
            url: "<?=BASE_URL("assets/ajaxs/GetUid.php");?>",
            method: "POST",
            data: {
                type: 'GetUid',
                url: $("#url").val()
            },
            success: function(response) {
                $("#thongbao").html(response);
                $('#GetUid').html(
                        'SUBMIT')
                    .prop('disabled', false);
            }
        });
    });
    </script>
    <?php 
    require_once("../../public/client/Footer.php");
?>