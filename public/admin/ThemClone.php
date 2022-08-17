<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'THÊM TÀI KHOẢN | '.$CMSNT->site('tenweb');
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");
?>
<?php 
if(isset($_GET['id']))
{
    $row = $CMSNT->get_row(" SELECT * FROM `dichvu` WHERE `id` = '".check_string($_GET['id'])."' ");
    if(!$row)
    {
        admin_msg_error("Dịch vụ không hợp lệ", BASE_URL(''), 500);
    }
}
else
{
    admin_msg_error("Dịch vụ không hợp lệ", BASE_URL(''), 0);
}

if(isset($_POST['btnSubmit']) && isset($_POST['list']) && isset($_GET['id']) )
{
    $value_add = 0;
    $value_update = 0;
    if($getUser['level'] != 'admin')
    {
        admin_msg_error('Chức năng này chỉ dành cho Admin.', '', 1000);
    }
    $row = $CMSNT->get_row(" SELECT * FROM `dichvu` WHERE `id` = '".check_string($_GET['id'])."' ");
    if(!$row)
    {
        admin_msg_error("Dịch vụ không hợp lệ", BASE_URL(''), 500);
    }
    $list = check_string($_POST['list']);
    $list = explode(PHP_EOL, $list);
    foreach($list as $clone)
    {
        if($CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `chitiet` = '$clone' ") == 0)
        {
            $isAdd = $CMSNT->insert("taikhoan", array(
                'chitiet' => $clone,
                'dichvu' => check_string($_GET['id']),
                'trangthai' => 'LIVE'
            ));

            if($isAdd)
            {
                $value_add++;
            }
        }
        else
        {
            $row_taikhoan = $CMSNT->get_row(" SELECT * FROM `taikhoan` WHERE `chitiet` = '$clone' ");
            if(isset($_POST['filter']) && $_POST['filter'] == 1)
            {
                $isUpdate = $CMSNT->update("taikhoan", array(
                    'chitiet' => $clone,
                    'dichvu' => check_string($_GET['id']),
                    'trangthai' => 'LIVE'
                ), " `id` = '".$row_taikhoan['id']."' ");
                if($isUpdate)
                {
                    $value_update++;
                }
            }
            else
            {
                $isUpdate = $CMSNT->update("taikhoan", array(
                    'chitiet' => $clone,
                    'dichvu' => check_string($_GET['id']),
                    'trangthai' => 'LIVE',
                    'code'  => null,
                    'username'  => null,
                    'thoigianmua' => null
                ), " `id` = '".$row_taikhoan['id']."' ");
                if($isUpdate)
                {
                    $value_add++;
                }
            }   
        }
    }
    echo '<script type="text/javascript">Swal.fire("Thành Công", "Thêm '.$value_add.' | Cập nhật '.$value_update.' thành công" ,"success");</script>';
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm tài khoản</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM CLONE</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Dịch vụ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" value="<?=$row['dichvu'];?>" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nhập danh sách tài khoản</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="list" rows="12"
                                            placeholder="1 dòng 1 tài khoản" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Lọc trùng tài nguyên</label>
                                <div class="col-sm-9">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="filter" value="1"
                                            id="target" checked>
                                        <label for="target" class="custom-control-label">Nếu bạn huỷ tích, hệ thống sẽ không lọc các tài nguyên đã bán, chỉ nhập tài nguyên chưa bán.</label>
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





<?php 
    require_once("../../public/admin/Footer.php");
?>