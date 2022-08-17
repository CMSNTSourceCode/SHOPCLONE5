<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = 'Thay đổi mật khẩu | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
?>


<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-header"> THAY ĐỔI MẬT KHẨU</div>
                    <div class="element-box">
                        <div id="thongbao"></div>
                        <form>
                        <div class="alert bg-white alert-danger" role="alert">
                                <div class="iq-alert-icon">
                                    <i class="ri-information-line"></i>
                                </div>
                                <div class="iq-alert-text">
                                    <p><b>Lưu ý:</b></p>
                                    <p>Thông tin tài khoản và mật khẩu trên website này không được giống thông tin các website khác trên thị trường.
                                    </p>
                                    <p class="mb-3">
                                        Hãy chắc chắn bạn chỉ dùng 1 mật khẩu này cho chính website này (vui lòng lưu mật khẩu về điện thoại hoặc trình duyệt, bạn không cần phải nhớ chúng).
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?=lang(70);?></label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="password" id="password" placeholder="Vui lòng nhập mật khẩu" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?=lang(71);?></label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="password" id="repassword" placeholder="Vui lòng nhập lại mật khẩu mới" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="ChangeProfile" class="btn btn-primary btn-rounded">
                                <span><?=lang(73);?></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
    <script type="text/javascript">
    $("#ChangeProfile").on("click", function() {
        $('#ChangeProfile').html('ĐANG XỬ LÝ').prop('disabled',
            true);
        $.ajax({
            url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
            method: "POST",
            data: {
                type: 'IsChangePassword',
                password: $("#password").val(),
                repassword: $("#repassword").val()
            },
            success: function(response) {
                $("#thongbao").html(response);
                $('#ChangeProfile').html(
                        '<?=lang(73);?>')
                    .prop('disabled', false);
            }
        });
    });
    </script>



    <?php 
    require_once("../../public/client/Footer.php");
?>