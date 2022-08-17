<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'THÊM DANH MỤC TÀI KHOẢN | '.$CMSNT->site('tenweb');
    require_once("../../public/admin/Header.php");
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");
?>
<?php
if(isset($_POST['btnSubmit']) && isset($_POST['dichvu']) && isset($_POST['loai']) && isset($_POST['gia']) && $getUser['level'] == 'admin')
{
    if($getUser['level'] != 'admin')
    {
        admin_msg_error('Chức năng này chỉ dành cho Admin.', '', 2000);
    }
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
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
    $create = $CMSNT->insert("dichvu", array(
        'username'      => $getUser['username'],
        'dichvu'        => $dichvu,
        'gia'           => $gia,
        'check_live'    => check_string($_POST['check_live']),
        'loai'          => $loai,
        'stt'           => check_string($_POST['stt']),
        'quocgia'       => check_string($_POST['quocgia']),
        'mua_toi_thieu' => check_string($_POST['mua_toi_thieu']),
        'thoigian'      => gettime(),
        'mota'          => $mota,
        'luuy'          => $_POST['luuy'],
        'mua_toi_da'    => $mua_toi_da,
        'display'       => 'SHOW'
    ));
    if($create)
    {
        admin_msg_success("Tạo dịch vụ thành công", BASE_URL('Admin/Danhmuc/Taikhoan'), 1000);
    }
    else
    {
        admin_msg_error("Không thể thêm dịch vụ, vui lòng thử lại sau.", "", 2000);
    }
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm danh mục tài khoản</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM DANH MỤC</h3>
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
                                        <input type="number" name="stt" placeholder="Nhập số thứ tự" class="form-control">
                                    </div>
                                    <i>Số thứ tự ưu tiên hiển thị.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên sản phẩm</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control h-150px" placeholder="VD: Nick VIA 2018..." name="dichvu" rows="1"
                                            required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Quốc gia (<a type="button" href="#"
                                        data-toggle="modal" data-target="#Listflag">Danh
                                        sách quốc gia
                                    </a>)</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="quocgia" value="vn" placeholder="Ví dụ: vn"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="gia" placeholder="Đơn giá tài khoản"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mua tối đa 1 lần</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" value="100" name="mua_toi_da"
                                            placeholder="Nếu có check live khi mua thì nên để giới hạn 100 nick 1 lần"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mua tối thiểu 1 lần</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" value="1" name="mua_toi_thieu"
                                            placeholder="Số lượng tối thiểu khi mua"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Chọn category</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="loai" required>
                                        <option value="">* Chọn loại dịch vụ</option>
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
                                        <textarea class="form-control h-150px"
                                            placeholder="Mô tả chi tiết dịch vụ, có thể sử dụng icon" name="mota"
                                            rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Lưu ý</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="luuy"
                                            rows="6">Nhập lưu ý hoặc hướng dẫn cho sản phẩm này (xuất hiện khi mua)</textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnSubmit" class="btn btn-primary btn-block waves-effect">
                                <span>THÊM NGAY</span>
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