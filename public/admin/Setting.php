<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login-admin.php");
    //require_once(__DIR__."/../../includes/ioncube.php");
    $title = 'CẤU HÌNH | '.$CMSNT->site('tenweb');
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");
?>
<?php
if(isset($_POST['btnSaveOption']) && $getUser['level'] == 'admin')
{
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    foreach ($_POST as $key => $value)
    {
        if(!$CMSNT->get_row("SELECT * FROM `options` WHERE `name` = '$key' "))
        {
            $CMSNT->insert("options", [
                'name'  => $key,
                'value' => $value
            ]);
        }
        $CMSNT->update("options", array(
            'value' => $value
        ), " `name` = '$key' ");
    }
    admin_msg_success('Lưu thành công', '', 500);
}

?>


<style>

</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cấu hình</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH THÔNG TIN WEBSITE</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên website</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="tenweb" value="<?=$CMSNT->site('tenweb');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mô tả website</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="mota" value="<?=$CMSNT->site('mota');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Từ khóa tìm kiếm</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="tukhoa" value="<?=$CMSNT->site('tukhoa');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Logo website</label>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" name="logo" value="<?=$CMSNT->site('logo');?>"
                                            class="form-control">
                                    </div>
                                    <i>Upload ảnh lên <a target="_blank" href="https://imgur.com/upload?beta">đây</a>,
                                        sau đó copy địa chỉ hình ảnh dán vào ô trên.</i>
                                </div>
                                <div class="col-sm-5">
                                    <img width="200px" src="<?=$CMSNT->site('logo');?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Favicon website</label>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" name="favicon" value="<?=$CMSNT->site('favicon');?>"
                                            class="form-control">
                                    </div>
                                    <i>Upload ảnh lên <a target="_blank" href="https://imgur.com/upload?beta">đây</a>,
                                        sau đó copy địa chỉ hình ảnh dán vào ô trên.</i>
                                </div>
                                <div class="col-sm-5">
                                    <img width="200px" src="<?=$CMSNT->site('favicon');?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ảnh giới thiệu website</label>
                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <input type="text" name="anhbia" value="<?=$CMSNT->site('anhbia');?>"
                                            class="form-control">
                                    </div>
                                    <i>Upload ảnh lên <a target="_blank" href="https://imgur.com/upload?beta">đây</a>,
                                        sau đó copy địa chỉ hình ảnh dán vào ô trên.</i>
                                </div>
                                <div class="col-sm-5">
                                    <img width="200px" src="<?=$CMSNT->site('anhbia');?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Gmail SMTP [<a
                                        href="https://www.youtube.com/watch?v=aiMScMCqMIg&list=PLylqe6Lzq69-TzmQ6kLzTg8ZkrxJxxtZm&index=4"
                                        target="_blank">HƯỚNG DẪN</a>]</label>
                                <div class="col-sm-9">
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" placeholder="Nhập Email"
                                                        name="email" value="<?=$CMSNT->site('email');?>"
                                                        placeholder="col-sm-6" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control"
                                                        placeholder="Nhập mật khẩu Email" name="pass_email"
                                                        value="<?=$CMSNT->site('pass_email');?>"
                                                        placeholder="col-sm-6" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Theme color</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input class="form-control" type="color"
                                            value="<?=$CMSNT->site('theme_color');?>" name="theme_color">
                                    </div>
                                    <i>Điều chỉnh màu của website.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Theme Home Page</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="theme">
                                        <option value="<?=$CMSNT->site('theme');?>"><?=$CMSNT->site('theme');?>
                                        </option>
                                        <option value="Trafalgar">Trafalgar</option>
                                        <option value="JoBest">JoBest</option>
                                        <option value="">Tắt</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Fanpage</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="url" name="fanpage" value="<?=$CMSNT->site('fanpage');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thời gian xóa dữ liệu (tính bằng giây)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="time_delete"
                                            value="<?=$CMSNT->site('time_delete');?>" class="form-control">
                                    </div>
                                    <i>Thời gian xóa dữ liệu đã mua, thời gian tính từ ngày thanh toán.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thời gian lưu phiên đăng nhập (tính bằng giây)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="session_login"
                                            value="<?=$CMSNT->site('session_login');?>" class="form-control">
                                    </div>
                                    <i>Thời gian lưu phiên đăng nhập của khách hàng, không tính Admin.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Panel bên phải</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="right_panel" required>
                                        <option <?=$CMSNT->site('right_panel') == "ON" ? "selected" : '';?> value="ON">ON</option>
                                        <option <?=$CMSNT->site('right_panel') == "OFF" ? "selected" : '';?> value="OFF">OFF</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Capchat đăng ký</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status_capchat">
                                        <option <?=$CMSNT->site('status_capchat') == "ON" ? "selected" : '';?> value="ON">ON</option>
                                        <option <?=$CMSNT->site('status_capchat') == "OFF" ? "selected" : '';?> value="OFF">OFF</option>
                                    </select>
                                    <i>Khi chọn OFF, capchat xác minh khi đăng ký sẽ được tắt.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Hiển thị bảng giá trước khi login</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="display_list_login">
                                        <option <?=$CMSNT->site('display_list_login') == "ON" ? "selected" : '';?> value="ON">ON</option>
                                        <option <?=$CMSNT->site('display_list_login') == "OFF" ? "selected" : '';?> value="OFF">OFF</option>
                                    </select>
                                    <i>Khi bạn chọn ON, bảng giá tài khoản đang bán sẽ hiện ra bên ngoài trang đăng
                                        nhập.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Hiển thị tài nguyên đã bán</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="display_sold">
                                        <option value="<?=$CMSNT->site('display_sold');?>">
                                            <?=$CMSNT->site('display_sold');?>
                                        </option>
                                        <option value="ON">ON</option>
                                        <option value="OFF">OFF</option>
                                    </select>
                                    <i>Khi bạn chọn ON, tài nguyên đã bán sẽ hiến thị kế số lượng còn lại.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Tạo giao dịch ảo</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="stt_giaodichao" required>
                                        <option value="<?=$CMSNT->site('stt_giaodichao');?>">
                                            <?=$CMSNT->site('stt_giaodichao');?>
                                        </option>
                                        <option value="ON">ON</option>
                                        <option value="OFF">OFF</option>
                                    </select>
                                    <i>Hệ thống tự tạo giao dịch mua tài khoản ảo để tạo uy tín cho website.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Referral</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status_ref" required>
                                        <option value="<?=$CMSNT->site('status_ref');?>">
                                            <?=$CMSNT->site('status_ref');?>
                                        </option>
                                        <option value="ON">ON</option>
                                        <option value="OFF">OFF</option>
                                    </select>
                                    <i>Nếu bạn chọn OFF, chức năng ctv giới thiệu liên kết ăn hoa hồng sẽ tắt.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hoa hồng Referral</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" placeholder="VD: 10" name="ck_ref"
                                            value="<?=$CMSNT->site('ck_ref');?>" class="form-control">
                                    </div>
                                    <i>Chiết khấu hoa hồng liên kết giới thiệu.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Top nạp tiền</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status_top_nap" required>
                                        <option value="<?=$CMSNT->site('status_top_nap');?>">
                                            <?=$CMSNT->site('status_top_nap');?>
                                        </option>
                                        <option value="ON">ON</option>
                                        <option value="OFF">OFF</option>
                                    </select>
                                    <i>Nếu bạn chọn OFF, trang top nạp tiền sẽ bị ẩn.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Website</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="baotri" required>
                                        <option value="<?=$CMSNT->site('baotri');?>"><?=$CMSNT->site('baotri');?>
                                        </option>
                                        <option value="ON">ON</option>
                                        <option value="OFF">OFF</option>
                                    </select>
                                    <i>Khi chọn OFF website sẽ bật chế độ bảo trì.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Type Password <i>(Vui lòng không thay đổi tránh
                                        hậu quả đáng tiếc)</i></label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="TypePassword">
                                        <option value="<?=$CMSNT->site('TypePassword');?>">
                                            <?=$CMSNT->site('TypePassword');?>
                                        </option>
                                        <option value="md5">md5</option>
                                        <option value="sha1">sha1</option>
                                        <option value="">không mã hóa</option>
                                    </select>
                                    <i>Không tự ý thay đổi khi chưa có sự đồng ý của nhà phát triển/</i>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ON/OFF Change Password định kỳ</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status_is_change_password" required>
                                        <option value="<?=$CMSNT->site('status_is_change_password');?>"><?=$CMSNT->site('status_is_change_password');?>
                                        </option>
                                        <option value="ON">ON</option>
                                        <option value="OFF">OFF</option>
                                    </select>
                                    <i>Khi chọn OFF website tắt chế độ thay pass định kỳ</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Chèn JavaScripts (Live Chat, Hiệu ứng website
                                    v.v)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="script"
                                            rows="6"><?=$CMSNT->site('script');?></textarea>
                                    </div>
                                    <i>Có thể chèn đoạn sciprt quảng cáo, live chat, css trang trí website...</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thông báo</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="thongbao"
                                            rows="6"><?=$CMSNT->site('thongbao');?></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Điều khoản sử dụng</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="chinhsach"
                                            rows="6"><?=$CMSNT->site('chinhsach');?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Chế độ bảo hành</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="chinhsach_baohanh"
                                            rows="6"><?=$CMSNT->site('chinhsach_baohanh');?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Liên hệ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="contact"
                                            rows="6"><?=$CMSNT->site('contact');?></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnSaveOption" class="btn btn-primary btn-block">
                                <span>LƯU</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(function() {
    // Summernote
    $('.textarea').summernote()
})
</script>

<?php 
    require_once("../../public/admin/Footer.php");
?>