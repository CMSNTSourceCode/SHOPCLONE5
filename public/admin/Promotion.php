<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    CheckLogin();
    CheckAdmin();
    $title = 'QUẢN LÝ KHUYẾN MÃI | '.$CMSNT->site('tenweb');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");

    if(isset($_POST['RemovePromotion']) && $getUser['level'] == 'admin' )
    {
        $id = check_string($_POST['id']);
        $row = $CMSNT->get_row("SELECT * FROM `promotion` WHERE `id` = '$id' ");
        if(!$row)
        {
            msg_error2("ID cần xóa không tồn tại trong hệ thống !");
        }
        if($CMSNT->site('status_demo') == 'ON')
        {
            admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
        }
        $CMSNT->remove("promotion", " `id` = '$id' ");
        admin_msg_success("Xóa thành công !", "", 1000);
    }
?>

<?php
if(isset($_POST['AddPromotion']) && $getUser['level'] == 'admin' )
{
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $CMSNT->insert("promotion", array(
        'min'       => check_string($_POST['min']),
        'bonus'     => check_string($_POST['bonus']),
        'createdate'   => gettime()
    ));
    admin_msg_success("Thêm thành công", '', 500);
}

if(isset($_POST['SavePromotion']) && $getUser['level'] == 'admin' )
{
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $CMSNT->update("promotion", array(
        'min'       => check_string($_POST['min']),
        'bonus'     => check_string($_POST['bonus'])
    ), " `id` = '".check_string($_POST['id'])."' ");
    admin_msg_success("Lưu thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Khuyến mãi</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">TẠO MỐC KHUYẾN MÃI</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Số tiền nạp 1 lúc tối thiểu</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <input type="number" name="min" class="form-control"
                                            placeholder="Nhập mốc nạp muốn bonus" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Chiết khấu khuyến mãi khi đủ mốc</label>
                                <div class="col-sm-8">
                                    <div class="form-line">
                                        <input type="text" name="bonus" class="form-control"
                                            placeholder="Nhập chiết khấu khuyến mãi" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <p>Hệ thống sẽ ưu tiên mốc cao nhất ví dụ Mốc 5tr và mốc 10tr, khách nạp 10tr chỉ thưởng
                                    mốc 10tr. </p>
                            </div>
                            <button type="submit" name="AddPromotion" class="btn btn-primary btn-block">
                                <span>THÊM NGAY</span></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH MỐC KHUYẾN MÃI</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="thongbao"></div>
                        <div class="table-responsive">
                            <table id="datatable1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">STT</th>
                                        <th>MIN</th>
                                        <th>BONUS</th>
                                        <th>CREATE DATE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0; foreach($CMSNT->get_list(" SELECT * FROM `promotion` ORDER BY id DESC ") as $row){ ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=format_currency($row['min']);?></td>
                                        <td><?=$row['bonus'];?>%</td>
                                        <td><?=$row['createdate'];?></td>
                                        <td>
                                            <button class="btn btn-primary btnEdit" data-min="<?=$row['min'];?>"
                                                data-bonus="<?=$row['bonus'];?>" data-id="<?=$row['id'];?>"><i
                                                    class="fas fa-edit"></i>
                                                <span>EDIT</span>
                                            </button>
                                            <button class="btn btn-danger btnDelete" data-id="<?=$row['id'];?>"><i
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
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>



<!-- Modal -->
<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">EDIT MỐC KHUYẾN MÃI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Số tiền nạp 1 lúc tối thiểu</label>
                        <div class="col-sm-6">
                            <div class="form-line">
                                <input type="number" name="min" id="min" class="form-control"
                                    placeholder="Nhập mốc nạp muốn bonus" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Chiết khấu khuyến mãi khi đủ mốc</label>
                        <div class="col-sm-6">
                            <div class="form-line">
                                <input type="text" name="bonus" id="bonus" class="form-control"
                                    placeholder="Nhập chiết khấu khuyến mãi" required>
                                <input type="hidden" name="id" id="id" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <p>Hệ thống sẽ ưu tiên mốc cao nhất ví dụ Mốc 5tr và mốc 10tr, khách nạp 10tr chỉ thưởng mốc
                            10tr. </p>
                        <p>Khuyến mãi áp dụng cho nạp tiền tự động qua Bank, MOMO, Zalo Pay</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="SavePromotion" class="btn btn-danger">Lưu ngay</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->


<script type="text/javascript">
$(".btnDelete").on("click", function() {
    Swal.fire({
        title: 'Xác nhận xóa mốc khuyến mãi',
        text: "Bạn có chắc chắn xóa mốc này không ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'XÓA NGAY',
        cancelButtonText: 'HỦY'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: "<?=BASE_URL("public/admin/Promotion.php");?>",
                method: "POST",
                data: {
                    RemovePromotion: true,
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

<script type="text/javascript">
$('.btnEdit').on('click', function(e) {
    var btn = $(this);
    $("#min").val(btn.attr("data-min"));
    $("#bonus").val(btn.attr("data-bonus"));
    $("#id").val(btn.attr("data-id"));
    $("#staticBackdrop").modal();
    return false;
});
</script>
<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $("#datatable1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $("#datatable2").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>



<?php 
    require_once(__DIR__."/Footer.php");
?>