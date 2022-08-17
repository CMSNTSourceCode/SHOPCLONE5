<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'XEM TÀI KHOẢN | '.$CMSNT->site('tenweb');
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");
?>
<?php 
if(isset($_GET['id']))
{
    $row = $CMSNT->get_row(" SELECT * FROM `dichvu` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row)
    {
        admin_msg_error("Dịch vụ không hợp lệ", BASE_URL(''), 500);
    }
}
else
{
    admin_msg_error("Dịch vụ không hợp lệ", BASE_URL(''), 0);
}

if(isset($_GET['id']) && isset($_GET['delete']))
{
    $dichvu = check_string($_GET['id']);
    $delete = check_string($_GET['delete']);
    if($CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '$dichvu' AND `id` = '$delete' ") == 0)
    {
        admin_msg_error("Tài khoản này không tồn tại trong hệ thống", BASE_URL("Admin/XemClone/".$dichvu), 1000);
    }
    $CMSNT->remove("taikhoan", " `id` = '$delete' ");
    echo '<script type="text/javascript">Swal.fire("Thành công", "Xóa thành công " ,"success");</script>';
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách tài khoản chưa bán</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <section class="col-lg-6 connectedSortable">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            LIST LIVE <span class="badge bg-success"><?=$CMSNT->num_rows("SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `code` IS NULL AND `trangthai` = 'LIVE'");?></span>
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" id="listLive" rows="10" readonly>
<?php foreach($CMSNT->get_list(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `code` IS NULL AND `trangthai` = 'LIVE' ORDER BY id DESC ") as $live){ ?>
<?=$live['chitiet'];?>

<?php }?></textarea>
                    </div>
                    <div class="card-footer clearfix">
                        <button type="button" class="btn btn-info copy" data-clipboard-target="#listLive">
                            <span>COPY</span></button>
                    </div>
                </div>
            </section>
            <section class="col-lg-6 connectedSortable">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            LIST DIE <span class="badge bg-danger"><?=$CMSNT->num_rows("SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `code` IS NULL AND `trangthai` = 'DIE'");?></span>
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" id="listdie" rows="10" readonly>
<?php foreach($CMSNT->get_list(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `code` IS NULL AND `trangthai` = 'DIE' ORDER BY id DESC ") as $die){ ?>
<?=$die['chitiet'];?>

<?php }?></textarea>
                    </div>
                    <div class="card-footer clearfix">
                        <button type="button" class="btn btn-info copy" data-clipboard-target="#listdie">
                            <span>COPY</span></button>
                    </div>
                </div>
            </section>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">XEM TÀI KHOẢN</h3>
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
                                        <th>ID</th>
                                        <th>DỊCH VỤ</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>CHI TIẾT</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($CMSNT->get_list(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `code` IS NULL ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$row['id'];?></td>
                                        <td><?=$CMSNT->get_row(" SELECT * FROM `dichvu` WHERE `id` = '".$row['dichvu']."' ")['dichvu'];?>
                                        </td>
                                        <td><?=livefb($row['trangthai']);?></td>
                                        <td width="50%" id="coypy<?=$row['id'];?>"><?=$row['chitiet'];?></td>
                                        <td>
                                            <button type="button" class="btn btn-info copy"
                                                data-clipboard-target="#coypy<?=$row['id'];?>">
                                                <span>COPY</span></button>
                                            <a type="button"
                                                href="<?=BASE_URL('public/admin/XemClone.php?id='.$_GET['id'].'&delete='.$row['id']);?>"
                                                class="btn btn-danger"><span>XÓA NGAY</span></a>
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