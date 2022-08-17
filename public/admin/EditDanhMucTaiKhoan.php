<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'CHỈNH SỬA DANH MỤC TÀI KHOẢN | '.$CMSNT->site('tenweb');
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");
?>
<?php 
if(isset($_GET['id']) && $getUser['level'] == 'admin')
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

if( isset($_POST['btnSubmit']) && isset($_POST['dichvu']) && isset($_POST['loai']) && isset($_POST['gia']) )
{
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    if($getUser['level'] != 'admin')
    {
        admin_msg_error('Chức năng này chỉ dành cho Admin.', '', 1000);
    }
    $row = $CMSNT->get_row(" SELECT * FROM `dichvu` WHERE `id` = '".check_string($_GET['id'])."' ");
    if(!$row)
    {
        admin_msg_error("Dịch vụ không hợp lệ", BASE_URL(''), 500);
    }
    $mua_toi_da = check_string($_POST['mua_toi_da']);
    if($mua_toi_da <= 0)
    {
        admin_msg_error("Số lượng mua tối đa không hợp lệ", '', 1000);
    }
    $dichvu = $_POST['dichvu'];
    $loai = check_string($_POST['loai']);
    $gia = check_string($_POST['gia']);
    $mota = check_string($_POST['mota']);
    $display = check_string($_POST['display']);
    $create = $CMSNT->update("dichvu", array(
        'dichvu'    => $dichvu,
        'gia'       => $gia,
        'loai'      => $loai,
        'check_live'    => check_string($_POST['check_live']),
        'stt'       => check_string($_POST['stt']),
        'quocgia'   => check_string($_POST['quocgia']),
        'mua_toi_thieu'   => check_string($_POST['mua_toi_thieu']),
        'capnhat'   => gettime(),
        'mota'      => $mota,
        'luuy'      => $_POST['luuy'],
        'mua_toi_da'=> $mua_toi_da,
        'display'   => $display
    ), " `id` = '".check_string($_GET['id'])."' ");
    if($create)
    {
        admin_msg_success("Thay đổi thông tin dịch vụ thành công", "", 1000);
    }
    else
    {
        admin_msg_error("Không thể lưu, vui lòng thử lại sau.", "", 2000);
    }
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa danh mục tài khoản</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">EDIT DANH MỤC</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số thứ tự</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="stt" value="<?=$row['stt'];?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên sản phẩm</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control h-150px" name="dichvu" rows="1"
                                            required><?=$row['dichvu'];?></textarea>
                                    </div>
                                    <i>Tên sản phẩm cần bán, có thể sử dụng icon.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Quốc gia (<a type="button" href="#"
                                        data-toggle="modal" data-target="#Listflag">Danh
                                        sách quốc gia
                                    </a>)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="quocgia" value="<?=$row['quocgia'];?>"
                                            placeholder="Ví dụ: vn" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="gia" value="<?=$row['gia'];?>" placeholder="VD: 0" class="form-control"
                                            required>
                                    </div>
                                    <i>Đơn giá sản phẩm.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mua tối đa 1 lần</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="mua_toi_da" value="<?=$row['mua_toi_da'];?>"
                                            placeholder="Nếu có check live khi mua thì nên để giới hạn 100 nick 1 lần"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mua tối thiểu 1 lần</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="mua_toi_thieu" value="<?=$row['mua_toi_thieu'];?>"
                                            placeholder="Số lượng tối thiểu khi mua" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Chọn category</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="loai" required>
                                        <option value="<?=$row['loai'];?>"><?=$row['loai'];?></option>
                                        <?php foreach($CMSNT->get_list("SELECT * FROM `category`") as $category) { ?>
                                        <option value="<?=$category['title'];?>"><?=$category['title'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Check live khi mua</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="check_live" required>
                                        <option value="<?=$row['check_live'];?>"><?=$row['check_live'];?></option>
                                        <option value="OFF">OFF</option>
                                        <option value="CLONE">CLONE</option>
                                        <option value="VIA">VIA</option>
                                        <option value="GMAIL">GMAIL</option>
                                        <option value="HOTMAIL">HOTMAIL</option>
                                        <option value="YAHOO">YAHOO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mô tả</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control h-150px" name="mota"
                                            rows="6"><?=$row['mota'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Lưu ý</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="luuy" rows="6"><?=$row['luuy'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Hiển thị</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="display" required>
                                        <option value="<?=$row['display'];?>"><?=$row['display'];?></option>
                                        <option value="SHOW">SHOW</option>
                                        <option value="HIDE">HIDE</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="btnSubmit" class="btn btn-primary btn-block waves-effect">
                                <span>LƯU</span>
                            </button>
                            <a type="button" href="<?=BASE_URL('Admin/Danhmuc/Taikhoan');?>"
                                class="btn btn-danger btn-block waves-effect">
                                <span>TRỞ LẠI</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<div class="modal fade" id="Listflag" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">DANH SÁCH QUỐC GIA</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>FLAG</th>
                                <th>FILE NAME</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = COUNT(dirToArray('../../template/flag/')); foreach(dirToArray('../../template/flag/') as $row){ ?>
                            <?php $path_parts = pathinfo('../../template/flag/'.$row); ?>
                            <tr>
                                <td><?=$i--;?></td>
                                <td><img width="40px" src="<?=BASE_URL('template/flag/'.$row);?>" />
                                </td>
                                <td><?=$path_parts['filename'];?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect"
                    data-dismiss="modal"><span>ĐÓNG</span></button>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>

<script>
$(function() {
    // Summernote
    $('.textarea').summernote()
})
</script>
<?php 
    require_once("../../public/admin/Footer.php");
?>