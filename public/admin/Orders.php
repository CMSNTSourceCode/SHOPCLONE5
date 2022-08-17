<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'DANH SÁCH ĐƠN HÀNG | '.$CMSNT->site('tenweb');
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý đơn hàng</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH ĐƠN HÀNG</h3>
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
                            <th>MÃ GD</th>
                            <th>USERNAME</th>
                            <th>DỊCH VỤ</th>
                            <th>SỐ LƯỢNG</th>
                            <th>THANH TOÁN</th>
                            <th>LOẠI</th>
                            <th>THỜI GIAN</th>
                            <th>THAO TÁC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach($CMSNT->get_list(" SELECT * FROM `orders`  ORDER BY id DESC ") as $row){
                        ?>
                        <tr>
                            <td><?=$i++;?></td>
                            <td><?=$row['code'];?></td>
                            <td><a href="<?=BASE_URL('Admin/User/Edit/'.$CMSNT->getUser($row['username'])['id']);?>"><?=$row['username'];?></a></td>
                            <td><?=$row['dichvu'];?></td>
                            <td><?=format_cash($row['soluong']);?></td>
                            <td><?=format_cash($row['sotien']);?>đ</td>
                            <td><?=display_loai($row['loai']);?></td>
                            <td><span class="badge badge-dark"><?=$row['thoigian'];?></span></td>
                            <td>
                                <form action="" method="POST">
                                    <a type="button" target="_blank" href="<?=BASE_URL('Order/');?><?=$row['code'];?>"
                                        class="btn btn-outline-info">
                                        <span><i class="fas fa-search"></i> XEM NGAY</span></a>

                                    <a type="button"
                                        href="<?=BASE_URL('assets/models/DownloadFile.php?DownloadFile=True&code='.$row['code']);?>"
                                        target="_blank" class="btn btn-outline-danger">
                                        <span><i class="fas fa-file-download"></i> TẢI VỀ</span></a>
                                </form>
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