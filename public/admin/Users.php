<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'QUẢN LÝ THÀNH VIÊN | '.$CMSNT->site('tenweb');
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");
?>

<?php
if(isset($_GET['login']) && $getUser['level'] == 'admin')
{
    $username = check_string($_GET['login']);
    $_SESSION['username'] = $username;
    admin_msg_success("Đăng nhập tài khoản thành công !", BASE_URL(''), 2000);
}
if(isset($_POST['btnCongTien']) && isset($_POST['value']) && isset($row['username']) && $getUser['level'] == 'admin')
{
    $value = check_string($_POST['value']);
    $id = check_string($_POST['id']);
    $tranId = check_string($_POST['tranId']);
    if($value <= 0)
    {
        admin_msg_error("Vui lòng nhập số tiền hợp lệ", "", 2000);
    }
    if($CMSNT->num_rows(" SELECT * FROM `momo` WHERE `tranId` = '$tranId' ") != 0)
    {
        admin_msg_error("Mã giao dịch này đã được cộng tiền rồi !", "", 2000);
    } 
    $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id'  ");
    if(!$row)
    {
        admin_msg_error("Người dùng này không tồn tại", BASE_URL(''), 500);
    }
    $create = $CMSNT->insert("momo", array(
        'tranId'        => $tranId,
        'username'      => $row['username'],
        'comment'       => '',
        'time'          => gettime(),
        'partnerId'     => '',
        'amount'        => $value,
        'partnerName'   => ''
    ));
    if($create)
    {
        $CMSNT->insert("dongtien", [
            'sotientruoc' => $row['money'],
            'sotienthaydoi' => $value,
            'sotiensau' => $row['money'] + $value,
            'thoigian' => gettime(),
            'noidung' => 'Admin cộng tiền ('.$ghichu.')',
            'username' => $row['username']
        ]);
        $CMSNT->cong("users", "money", $value, " `username` = '".$row['username']."' ");
        $CMSNT->cong("users", "total_money", $value, " `username` = '".$row['username']."' ");
        admin_msg_success("Cộng tiền thành công!", "", 2000);
    }
    else
    {
        admin_msg_error("Vui lòng liên hệ kỹ thuật Zalo 0947838128", "", 12000);
    }
    
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý thành viên</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH THÀNH VIÊN</h3>
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
                                        <th width="5%">ID</th>
                                        <th>INFO</th>
                                        <th>WALLET</th>
                                        <th>ONLINE</th>
                                        <th>CREATE DATE</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($CMSNT->get_list(" SELECT * FROM `users` WHERE `username` IS NOT NULL ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$row['id'];?></td>
                                        <td>
                                            <ul>
                                                <li>Tên đăng nhập: <b><?=$row['username'];?></b></li>
                                                <li>Người giới thiệu: <b><?=$row['ref'] != NULL ? $CMSNT->get_row("SELECT * FROM `users` WHERE `id` = '".$row['ref']."' ")['username'] : '';?></b></li>
                                                <li>Số điện thoại: <b><?=$row['phone'];?></b></li>
                                                <li>Email: <b><?=$row['email'];?></b></li>
                                                <li>IP: <b><?=$row['ip'];?></b></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>Số dư khả dụng: <b style="color:blue;"><?=format_currency($row['money']);?></b></li>
                                                <li>Số dư ghi nợ: <b style="color: red;"><?=format_currency($row['debit_amount']);?></b></li>
                                                <li>Số dư đã sử dụng: <b style="color: green;"><?=format_currency($row['used_money']);?></b></li>
                                                <li>Hoa hồng: <b><?=format_currency($row['ref_money']);?></b></li>
                                                <li>Tổng nạp: <b><?=format_currency($row['total_money']);?></b></li>
                                                <li>Chiết khấu giảm: <b><?=$row['chietkhau'];?>%</b></li>
                                            </ul>
                                        </td>
                                        <td><?=display_online($row['time_session']);?></td>
                                        <td><span class="badge badge-dark"><?=$row['createdate'];?></span></td>
                                        <td><?=display_banned($row['banned']);?></td>
                                        <td>
                                            <a type="button" href="<?=BASE_URL('Admin/User/Edit/');?><?=$row['id'];?>"
                                                class="btn btn-primary"><i class="fas fa-edit"></i>
                                                <span>EDIT</span></a>
                                            <a type="button" href="<?=BASE_URL('public/admin/Users.php?login=');?><?=$row['username'];?>"
                                                class="btn btn-danger"><i class="fas fa-sign-in-alt"></i>
                                                <span>LOGIN</span></a>
                                        </td>
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
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>



<?php 
    require_once("../../public/admin/Footer.php");
?>