<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'QUẢN LÝ TÍCH HỢP | '.$CMSNT->site('tenweb');
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");
?>
<?php

if(isset($_GET['hide_product_api']) && isset($_GET['domain']) && $getUser['level'] == 'admin')
{
    $id = check_string($_GET['hide_product_api']);
    $domain = check_string($_GET['domain']);
    if($row = $CMSNT->get_row("SELECT * FROM `hide_product_api` WHERE `product_id` = '$id' AND `domain` = '$domain' ") )
    {
        $CMSNT->remove("hide_product_api", " `id` = '".$row['id']."' ");
        admin_msg_success('Hiển thị thành công.', BASE_URL('public/admin/tich-hop.php'), 500);
    }
    else
    {
        $CMSNT->insert("hide_product_api", [
            'product_id'    => $id,
            'domain'        =>  $domain,
            'time'          => gettime()
        ]);
        admin_msg_success('Ẩn thành công.', BASE_URL('public/admin/tich-hop.php'), 500);
    }
}
if(isset($_GET['hide_category_api']) && isset($_GET['domain']) && $getUser['level'] == 'admin')
{
    $id = check_string($_GET['hide_category_api']);
    $domain = check_string($_GET['domain']);
    if($row = $CMSNT->get_row("SELECT * FROM `hide_category_api` WHERE `category_id` = '$id' AND `domain` = '$domain' ") )
    {
        $CMSNT->remove("hide_category_api", " `id` = '".$row['id']."' ");
        admin_msg_success('Hiển thị thành công.', BASE_URL('public/admin/tich-hop.php'), 500);
    }
    else
    {
        $CMSNT->insert("hide_category_api", [
            'category_id'    => $id,
            'domain'        =>  $domain,
            'time'          => gettime()
        ]);
        admin_msg_success('Ẩn thành công.', BASE_URL('public/admin/tich-hop.php'), 500);
    }
}
if(isset($_POST['btnSaveOption']) && $getUser['level'] == 'admin')
{
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    if(!empty($_POST['list_domain']))
    {
        foreach(explode(PHP_EOL, $_POST['list_domain']) as $a)
        {
            $b = explode("|", $a);
            if($row2 = $CMSNT->get_row("SELECT * FROM `api_domains` WHERE `domain` = '".$b[0]."' "))
            {
                $CMSNT->update("api_domains", [
                    'username'  => $b[1],
                    'password'  => $b[2],
                    'time'      => gettime()
                ], " `id` = '".$row2['id']."' ");
            }
            else
            {
                $CMSNT->insert("api_domains", [
                    'domain'    => $b[0],
                    'username'  => $b[1],
                    'password'  => $b[2],
                    'time'      => gettime()
                ]);
            }
        }
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
                    <h1>Cấu hình thông tin kết nối website</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <section class="col-lg-6 connectedSortable pt-5">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH KẾT NỐI</h3>
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
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">ON/OFF Kết nối
                                    website</label>
                                <div class="col-sm-9">
                                    <select class="custom-select" name="api_status">
                                        <option value="ON" <?=$CMSNT->site('api_status') == 'ON' ? 'selected' : '';?>>ON
                                        </option>
                                        <option value="OFF" <?=$CMSNT->site('api_status') == 'OFF' ? 'selected' : '';?>>
                                            OFF</option>
                                    </select>
                                    <i>Khi bạn chọn OFF, hệ thống sẽ tắt tính năng kết nối.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thêm website cần kết nối</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="list_domain"
                                            placeholder="Định dạng: https//:domain...|USERNAME|PASSWORD 1 dòng 1 website"></textarea>
                                    </div>
                                    <i>Vui lòng nhập link web cần kết nối và thông tin tài khoản đăng nhập của bạn trong
                                        website đó.</i>
                                    <i>Web cần đấu phải sử dụng code <b>SHOPCLONE V5</b> phiên bản <b
                                            style="color: red;">1.7.0</b> trở lên.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Chiết khấu lãi sản phẩm</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="api_ck"
                                            placeholder="Nhập chiết khấu giá cần tăng lên khi kết nối sản phẩm của site mẹ"
                                            value="<?=$CMSNT->site('api_ck');?>" class="form-control">
                                    </div>
                                    <i>VD bạn để 10, giá sản phẩm khi kết nối sẽ tăng lên 10% của giá gốc.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Hiển thị sản phẩm API</label>
                                <div class="col-sm-9">
                                    <select class="custom-select" name="api_stt">
                                        <option value="0" <?=$CMSNT->site('api_stt') == 0 ? 'selected' : '';?>>Trước sản phẩm gốc
                                        </option>
                                        <option value="1" <?=$CMSNT->site('api_stt') == 1 ? 'selected' : '';?>>Sau sản phẩm gốc</option>
                                    </select>
                                    <i>Hiển thị vị trí sản phẩm API.</i>
                                </div>
                            </div>
                            <button type="submit" name="btnSaveOption" class="btn btn-primary btn-block">
                                <span>LƯU</span></button>
                        </form>
                    </div>
                </div>
            </section>
            <section class="col-lg-6 connectedSortable pt-5">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH API ĐANG KẾT NỐI</h3>
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
                        <div class="table-responsive">
                            <table id="datatable1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Domain</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <?php if($CMSNT->site('api_status') == 'ON'){?>
                                        <th>Money</th>
                                        <?php }?>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i=0; foreach($CMSNT->get_list("SELECT * FROM `api_domains` ORDER BY id DESC ") as $row) { ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$row['domain'];?></td>
                                        <td><?=$row['username'];?></td>
                                        <td><?=$row['password'];?></td>
                                        <?php if($CMSNT->site('api_status') == 'ON'){?>
                                        <td><?=file_get_contents($row['domain'].'/api/GetBalance.php?username='.$row['username'].'&password='.$row['password']);?>
                                        </td>
                                        <?php }?>
                                        <td><button aria-label="" style="color:white;" data-id="<?=$row['id'];?>"
                                                class="btn btn-danger btn-icon-left m-b-10 delete" type="button">
                                                <i class="fas fa-trash-alt mr-1"></i><span class="">Delete</span>
                                            </button></td>
                                    </tr>
                                    <?php }?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <?php if($CMSNT->site('api_status') == 'ON'){?>
            <section class="col-lg-12 connectedSortable pt-5">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH DANH MỤC</h3>
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
                        <div class="table-responsive">
                            <table id="datatable2" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>TÊN DANH MỤC</th>
                                        <th width="10%">THAO TÁC</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-lg-12 connectedSortable pt-5">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH SẢN PHẨM</h3>
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
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>API</th>
                                        <th>SẢN PHẨM</th>
                                        <th>CHI TIẾT</th>
                                        <th>GIÁ BÁN</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <?php }?>                                
        </div>
        <!-- /.row -->
    </section>

</div>



<script type="text/javascript">
$(".delete").on("click", function(e) {

    Swal.fire({
        title: 'Xác nhận xoá domain!',
        text: "Bạn có đồng ý xoá domain này ra khỏi hệ thống không?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?=BASE_URL('assets/ajaxs/admin/domain-api-delete.php');?>",
                method: "POST",
                dataType: "JSON",
                data: {
                    id: $(this).data('id')
                },
                success: function(respone) {
                    if (respone.status == 'success') {
                        Swal.fire(
                            'Thành công!',
                            respone.msg,
                            'success'
                        );
                        location.reload();
                    } else {
                        Swal.fire(
                            'Thất bại!',
                            respone.msg,
                            'error'
                        );
                    }
                },
                error: function() {
                    alert(html(response));
                    location.reload();
                }
            });
        }
    })

});
</script>
<script>
$(function() {
    // Summernote
    $('.textarea').summernote()
})
</script>
<script>
$(function() {
    $("#datatable").DataTable({
        ajax: '<?=base_url('assets/ajaxs/admin/listProductApi.php');?>',
        dataSrc: 'data',
        columns: [
            { data: 'stt' },
            { data: 'domain' },
            { data: 'product' },
            { data: 'description' },
            { data: 'price' },
            { data: 'action' }
        ]
    });
    $("#datatable2").DataTable({
        ajax: '<?=base_url('assets/ajaxs/admin/listCategoryApi.php');?>',
        dataSrc: 'data',
        columns: [
            { data: 'stt' },
            { data: 'name' },
            { data: 'action' }
        ]
    });
});
</script>
<script>
$(function() {
    $("#datatable1").DataTable({
        "responsive": false,
        "autoWidth": false,
    });
});
</script>


<?php 
    require_once("../../public/admin/Footer.php");
?>