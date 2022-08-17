<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'CHỈNH SỬA THÀNH VIÊN | '.$CMSNT->site('tenweb');
    require_once(__DIR__."/../../includes/login-admin.php");
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");
?>
<?php
/* BẢN QUYỀN THUỘC VỀ CMSNT.CO | NTTHANH LEADER NT TEAM */
if(isset($_GET['id']) && $getUser['level'] == 'admin')
{
    $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row)
    {
        admin_msg_error("Người dùng này không tồn tại", BASE_URL(''), 500);
    }
}
else
{
    admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}

if(isset($_POST['btnCongTien']) && isset($_POST['value']) && isset($row['username']) && $getUser['level'] == 'admin')
{
    $value = check_string($_POST['value']);
    $ghichu = check_string($_POST['ghichu']);
    $wallte = check_string($_POST['wallte']);

    if($value <= 0)
    {
        admin_msg_error("Vui lòng nhập số tiền hợp lệ", "", 2000);
    }
    if(!$wallte)
    {
        admin_msg_error("Vui lòng chọn ví", "", 2000);
    }
    
    $create = $CMSNT->insert("dongtien", [
        'sotientruoc' => $row['money'],
        'sotienthaydoi' => $value,
        'sotiensau' => $row['money'] + $value,
        'thoigian' => gettime(),
        'noidung' => 'Admin cộng tiền vào số dư khả dụng ('.$ghichu.')',
        'username' => $row['username']
    ]);
 
    if($create){
        if($wallte == 2)
        {
            $CMSNT->cong("users", "debit_amount", $value, " `username` = '".$row['username']."' ");
        }
        $CMSNT->cong("users", "money", $value, " `username` = '".$row['username']."' ");
        $CMSNT->cong("users", "total_money", $value, " `username` = '".$row['username']."' ");
        admin_msg_success("Cộng tiền thành công!", "", 2000);
    }
    else{
        admin_msg_error("Vui lòng liên hệ kỹ thuật Zalo 0947838128", "", 12000);
    }


    
}

if(isset($_POST['btnTruTien']) && isset($_POST['value']) && isset($row['username']) && $getUser['level'] == 'admin')
{
    $value = check_string($_POST['value']);
    $ghichu = check_string($_POST['ghichu']);
    $wallte = check_string($_POST['wallte']);
    if($value <= 0)
    {
        admin_msg_error("Vui lòng nhập số tiền hợp lệ", "", 2000);
    }
    if(!$wallte)
    {
        admin_msg_error("Vui lòng chọn ví", "", 2000);
    }
    $create = $CMSNT->insert("dongtien", [
        'sotientruoc' => $row['money'],
        'sotienthaydoi' => $value,
        'sotiensau' => $row['money'] - $value,
        'thoigian' => gettime(),
        'noidung' => 'Admin trừ tiền ('.$ghichu.')',
        'username' => $row['username']
    ]);
    if($create)
    {
        if($wallte == 2)
        {
            $CMSNT->tru("users", "debit_amount", $value, " `username` = '".$row['username']."' ");
        }
        $CMSNT->tru("users", "money", $value, " `username` = '".$row['username']."' ");
        $CMSNT->tru("used_money", "money", $value, " `username` = '".$row['username']."' ");
        admin_msg_success("Trừ tiền thành công!", "", 2000);
    }
    else
    {
        admin_msg_error("Vui lòng liên hệ kỹ thuật Zalo 0947838128", "", 12000);
    }
    
}
if(isset($_POST['btnSaveUser']) && isset($_GET['id']) && $getUser['level'] == 'admin')
{
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $token = check_string($_POST['token']);
    $otp = check_string($_POST['otp']);
    $money = check_string($_POST['money']);
    $level = check_string($_POST['level']);
    $banned = check_string($_POST['banned']);
    $password = check_string($_POST['password']);
    $chietkhau = check_string($_POST['chietkhau']);
    if($row['money'] != $money)
    {
        $CMSNT->insert("dongtien", array(
            'sotientruoc'   => $row['money'],
            'sotienthaydoi' => $money - $row['money'],
            'sotiensau'     => $money,
            'thoigian'      => gettime(),
            'noidung'       => 'Admin thay đổi số dư ',
            'username'      => $row['username']
        ));
    }
    $CMSNT->update("users", array(
        'email'         => check_string($_POST['email']),
        'phone'         => check_string($_POST['phone']),
        'total_money'   => check_string($_POST['total_money']),
        'reason_banned'   => check_string($_POST['reason_banned']),
        'password'      => $password,
        'otp'           => $otp,
        'token'         => $token,
        'chietkhau'     => $chietkhau,
        'money'         => $money,
        'debit_amount'   => check_string($_POST['debit_amount']),
        'level'         => $level,
        'banned'        => $banned
    ), " `id` = '".$row['id']."' ");
    admin_msg_success("Thay đổi user thành công", "", 1000);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa thành viên</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CHỈNH SỬA THÀNH VIÊN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="inputEmail3"
                                            value="<?=$row['username'];?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="password"
                                            value="<?=$row['password'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="mail" class="form-control" id="inputPassword3" name="email"
                                            value="<?=$row['email'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="inputPassword3" name="phone"
                                            value="<?=$row['phone'];?>">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="inputEmail3" value="<?=$row['username'];?>"
                                name="username" required>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Token</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="token"
                                            value="<?=$row['token'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Chiết khấu giảm giá</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="chietkhau" value="<?=$row['chietkhau'];?>"
                                            placeholder="0 nếu muốn mặc định">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Ví khả dụng</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="number" class="form-control" id="inputPassword3" name="money"
                                            value="<?=$row['money'];?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Ví ghi nợ</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="number" class="form-control" id="inputPassword3" name="debit_amount"
                                            value="<?=$row['debit_amount'];?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Tổng tiền nạp</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="number" class="form-control" id="inputPassword3" name="total_money"
                                            value="<?=$row['total_money'];?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Cấp độ</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="level" value="<?=$row['level'];?>"
                                            placeholder="Nếu muốn đưa lên Admin thì ghi: admin">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">OTP</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="otp" value="<?=$row['otp'];?>"
                                            placeholder="Mã OTP">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Trạng thái</label>
                                <div class="col-sm-10">
                                    <select class="custom-select" name="banned">
                                        <option value="<?=$row['banned'];?>">
                                            <?php
                                                if($row['banned'] == "0"){ echo 'Hoạt động';}
                                                if($row['banned'] == "1"){ echo 'Banned';}
                                                ?>
                                        </option>
                                        <option value="0">Hoạt động</option>
                                        <option value="1">Banned</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Lý do banned</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control"
                                            value="<?=$row['reason_banned'];?>" name="reason_banned">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">IP đăng nhập</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control"
                                            value="<?=$row['ip'];?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Trình duyệt đăng nhập</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control"
                                            value="<?=$row['UserAgent'];?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Ngày đăng ký</label>
                                <div class="col-sm-10">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="inputEmail3"
                                            value="<?=$row['createdate'];?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnSaveUser" class="btn btn-primary btn-block waves-effect">
                                <span>LƯU</span>
                            </button>
                            <a type="button" href="<?=BASE_URL('Admin/Users');?>"
                                class="btn btn-danger btn-block waves-effect">
                                <span>TRỞ LẠI</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">CỘNG TIỀN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-4 col-form-label">Chọn ví</label>
                                <div class="col-sm-8">
                                    <select class="custom-select" name="wallte" required>
                                        <option value="">Chọn ví</option>
                                        <option value="1">Ví khả dụng</option>
                                        <option value="2">Ví ghi nợ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Số tiền cộng</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="value" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Ghi chú</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <textarea class="form-control" name="ghichu" rows="3"
                                            placeholder="Nhập ghi chú cộng tiền nếu có"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnCongTien" class="btn btn-primary btn-block waves-effect">
                                <span>XÁC NHẬN</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title">TRỪ TIỀN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-4 col-form-label">Chọn ví</label>
                                <div class="col-sm-8">
                                    <select class="custom-select" name="wallte" required>
                                        <option value="">Chọn ví</option>
                                        <option value="1">Ví khả dụng</option>
                                        <option value="2">Ví ghi nợ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Số tiền trừ</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="value" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Ghi chú</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <textarea class="form-control" name="ghichu" rows="3"
                                            placeholder="Nhập ghi chú trừ tiền nếu có"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnTruTien" class="btn btn-primary btn-block waves-effect">
                                <span>XÁC NHẬN</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DÒNG TIỀN</h3>
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
                                        <th>SỐ TIỀN TRƯỚC</th>
                                        <th>SỐ TIỀN THAY ĐỔI</th>
                                        <th>SỐ TIỀN HIỆN TẠI</th>
                                        <th>THỜI GIAN</th>
                                        <th>NỘI DUNG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($CMSNT->get_list(" SELECT * FROM `dongtien` WHERE `username` = '".$row['username']."' ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=format_cash($row['sotientruoc']);?></td>
                                        <td><?=format_cash($row['sotienthaydoi']);?></td>
                                        <td><?=format_cash($row['sotiensau']);?></td>
                                        <td><span class="badge badge-dark px-3"><?=$row['thoigian'];?></span></td>
                                        <td><?=$row['noidung'];?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>SỐ TIỀN TRƯỚC</th>
                                        <th>SỐ TIỀN THAY ĐỔI</th>
                                        <th>SỐ TIỀN HIỆN TẠI</th>
                                        <th>THỜI GIAN</th>
                                        <th>NỘI DUNG</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



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