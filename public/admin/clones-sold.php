<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'TÀI KHOẢN ĐÃ BÁN | '.$CMSNT->site('tenweb');
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

?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách tài khoản đã bán</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
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
                                        <th>ĐƠN HÀNG</th>
                                        <th>USERNAME</th>
                                        <th>CHI TIẾT</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($CMSNT->get_list(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `code` IS NOT NULL ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$row['id'];?></td>
                                        <td><a href="<?=BASE_URL('Order/');?><?=$row['code'];?>"><?=$row['code'];?></a></td>
                                        <td><?=$CMSNT->get_row("SELECT * FROM `orders` WHERE `code` = '".$row['code']."' ")['username'];?></td>
                                        <td width="50%" id="coypy<?=$row['id'];?>"><?=$row['chitiet'];?></td>
                                        <td>
                                            <button type="button" class="btn btn-info copy"
                                                data-clipboard-target="#coypy<?=$row['id'];?>">
                                                <span>COPY</span></button>
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