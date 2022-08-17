<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'QUẢN LÝ NẠP THẺ | '.$CMSNT->site('tenweb');
    CheckLogin();
    CheckAdmin();
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



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nạp thẻ cào</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH NẠP THẺ</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2bs4" name="status_card">
                                        <option <?=$CMSNT->site('status_card') == 'OFF' ? 'selected' : '';?>
                                            value="OFF">
                                            OFF
                                        </option>
                                        <option <?=$CMSNT->site('status_card') == 'ON' ? 'selected' : '';?> value="ON">
                                            ON
                                        </option>
                                    </select>
                                    <i>Chọn OFF hệ thống sẽ tạm dừng auto nạp thẻ.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Partner ID </label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <input type="text" name="partner_id_card"
                                            value="<?=$CMSNT->site('partner_id_card');?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Partner Key </label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <input type="text" name="partner_key_card"
                                            value="<?=$CMSNT->site('partner_key_card');?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Phí nạp thẻ</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <input type="text" name="ck_card" value="<?=$CMSNT->site('ck_card');?>"
                                            class="form-control">
                                    </div>
                                    <i>Để phí = 0 nếu quý khách muốn cộng cho user giống thực nhận tại hệ thống
                                        card24h.com</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Lưu ý nạp tiền</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <textarea class="textarea"
                                            name="luuy_naptien"><?=$CMSNT->site('luuy_naptien');?></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnSaveOption" class="btn btn-primary btn-block">
                                <span>LƯU</span></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">HƯỚNG DẪN KẾT NỐI API NẠP THẺ</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Bước 1: Truy cập vào <a target="_blank"
                                    href="https://card24h.com/account/login">https://card24h.com/account/login</a>
                                <b>đăng ký</b> tài khoản và <b>đăng nhập</b>.</li>
                            <li>Bước 2: Truy cập vào <a target="_blank" href="https://card24h.com/merchant/list">đây</a>
                                để tiến hành tạo API mới.</li>
                            <li>Bước 3: Nhập lần lượt như sau:</li>
                            <b>Tên mô tả:</b> => <i><?=check_string($_SERVER['SERVER_NAME']);?> - SHOPCLONE5</i><br>
                            <b>Chọn ví giao dịch:</b> => <i>VND</i><br>
                            <b>Kiểu:</b> => <i>GET</i><br>
                            <b>Đường dẫn nhận dữ liệu (Callback Url):</b> => <i><?=BASE_URL('api/card.php');?></i><br>
                            <b>Địa chỉ IP (không bắt buộc):</b> => <i></i><br>
                            <li>Bước 4: Thêm thông tin kết nối và <a target="_blank"
                                    href="https://zalo.me/0947838128">inbox</a> ngay cho Admin để duyệt API.</li>
                            <li>Bước 5: Copy Partner ID dán vào ô Partner ID trên hệ thống.</li>
                            <li>Bước 6: Copy Partner Key dán vào ô Partner Key trên hệ thống.</li>
                        </ul>
                        <h4 class="text-center">Chúc quý khách thành công <img
                                src="https://i.pinimg.com/736x/c4/2c/98/c42c983e8908fdbd6574c2135212f7e4.jpg"
                                width="45px;"></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">LỊCH SỬ NẠP THẺ</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>USERNAME</th>
                                        <th>SERI</th>
                                        <th>PIN</th>
                                        <th>LOẠI THẺ</th>
                                        <th>MỆNH GIÁ</th>
                                        <th>THỰC NHẬN</th>
                                        <th>THỜI GIAN</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>GHI CHÚ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($CMSNT->get_list(" SELECT * FROM `cards` WHERE `username` IS NOT NULL ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$i;?> <?php $i++;?></td>
                                        <td><a
                                                href="<?=BASE_URL('Admin/User/Edit/'.$CMSNT->getUser($row['username'])['id']);?>"><?=$row['username'];?></a>
                                        </td>
                                        <td><?=$row['seri'];?></td>
                                        <td><?=$row['pin'];?></td>
                                        <td><?=loaithe($row['loaithe']);?></td>
                                        <td><?=format_cash($row['menhgia']);?></td>
                                        <td><?=format_cash($row['thucnhan']);?></td>
                                        <td><span class="badge badge-dark"><?=$row['createdate'];?></span></td>
                                        <td><?=status($row['status']);?></td>
                                        <td><?=$row['note'];?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>




<script>
$(function() {
    // Summernote
    $('.textarea').summernote()
})
</script>
<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>



<?php 
    require_once("../../public/admin/Footer.php");
?>