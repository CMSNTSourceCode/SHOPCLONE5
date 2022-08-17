<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    CheckLogin();
    CheckAdmin();
    $title = 'DANH MỤC TÀI KHOẢN | '.$CMSNT->site('tenweb');
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");
    
    if(isset($_POST['XoaSanPham']) && $getUser['level'] == 'admin' )
    {
        $id = check_string($_POST['id']);
        if(!$row = $CMSNT->get_row("SELECT * FROM `dichvu` WHERE `id` = '$id' "))
        {
            msg_error2("ID cần xóa không tồn tại trong hệ thống !");
        }
        if($CMSNT->site('status_demo') == 'ON')
        {
            admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
        }
        // GHI LOG
        $file = @fopen('../../logs/XoaSanPham.txt', 'a');
        if ($file)
        {
            $data = "[LOG] Sản phẩm ID ".$row['id']." đã bị xóa khỏi hệ thống vào lúc ".gettime().PHP_EOL;
            fwrite($file, $data);
            fclose($file);
        }
        $CMSNT->remove("dichvu", " `id` = '$id' ");
        admin_msg_success("Xóa thành công !", "", 1000);
    }

?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh mục tài khoản</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH DANH MỤC</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                    <div id="thongbao"></div>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>DỊCH VỤ</th>
                                        <th>GIÁ</th>
                                        <th>CATEGORY</th>
                                        <th>HIỂN THỊ</th>
                                        <th>ĐÃ BÁN</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($CMSNT->get_list(" SELECT * FROM `dichvu` ORDER BY id DESC ") as $row){ ?>
                                    <tr>
                                        <td><?=$row['stt'];?></td>
                                        <td><b><?=$row['dichvu'];?></b></td>
                                        <td><span class="badge badge-danger"><?=format_cash($row['gia']);?></span></td>
                                        <td><?=display_loai($row['loai']);?></td>
                                        <td><?=display($row['display']);?></td>
                                        <td><span
                                                class="badge badge-warning"><?=format_cash($CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `code` IS NOT NULL "));?></span>
                                        </td>
                                        <td>
                                            <a type="button" href="<?=BASE_URL('Admin/XemClone');?>/<?=$row['id'];?>"
                                                class="btn btn-primary">
                                                <span>ĐANG BÁN
                                                    <?=format_cash($CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `code` IS NULL AND `trangthai` = 'LIVE' "));?>
                                                    LIVE /
                                                    <?=format_cash($CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `code` IS NULL AND `trangthai` = 'DIE' "));?>
                                                    DIE</span></a>

                                            <a type="button" href="<?=BASE_URL('public/admin/clones-sold.php?id=');?><?=$row['id'];?>"
                                                class="btn btn-success">
                                                <span>ĐÃ BÁN <?=format_cash($CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `code` IS NOT NULL "));?></span></a>

                                            <a type="button" href="<?=BASE_URL('Admin/ThemClone');?>/<?=$row['id'];?>"
                                                class="btn btn-info">
                                                <span>THÊM CLONE</span></a>

                                            <a type="button" href="<?=BASE_URL('Admin/XoaClone');?>/<?=$row['id'];?>"
                                                class="btn btn-danger">
                                                <span>XÓA CLONE</span></a>

                                            <a type="button" href="<?=BASE_URL('Admin/Danhmuc/Taikhoan/Edit/');?><?=$row['id'];?>"
                                                class="btn bg-black">
                                                <span>EDIT</span></a>

                                            <button class="btn btn-danger btnDelete" id="XoaSanPham" data-id="<?=$row['id'];?>"><i
                                                    class="fas fa-trash"></i>
                                                <span>DELETE</span>
                                            </button>
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
    </section>
</div>


<script type="text/javascript">
$(".btnDelete").on("click", function() {
    Swal.fire({
        title: 'Xác nhận xóa sản phẩm',
        text: "Bạn có chắc chắn xóa sản phẩm này không ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'XÓA NGAY',
        cancelButtonText: 'HỦY'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: "<?=BASE_URL("public/admin/DanhMucTaiKhoan.php");?>",
                method: "POST",
                data: {
                    XoaSanPham: true,
                    id: $(this).attr("data-id")
                },
                success: function(response) {
                    $("#thongbao").html(response);
                }
            });
        }
    })
});
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