<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'THÊM TOKEN | '.$CMSNT->site('tenweb');
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");
?>
<?php 

if(isset($_POST['btnSubmit']) )
{
    $value_add = 0;
    $value_update = 0;
    if($getUser['level'] != 'admin')
    {
        admin_msg_error('Chức năng này chỉ dành cho Admin.', '', 1000);
    }

    $list = check_string($_POST['list']);
    $list = explode(PHP_EOL, $list);
    foreach($list as $token)
    {
        if($CMSNT->num_rows(" SELECT * FROM `token` WHERE `token` = '$token' ") == 0)
        {
            $isAdd = $CMSNT->insert("token", array(
                'token' => $token
            ));

            if($isAdd)
            {
                $value_add++;
            }
        }
        else
        {
            $row_taikhoan = $CMSNT->get_row(" SELECT * FROM `token` WHERE `token` = '$token' ");
            $isUpdate = $CMSNT->update("token", array(
                'token' => $token
            ), " `id` = '".$row_taikhoan['id']."' ");

            if($isUpdate)
            {
                $value_update++;
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
                    <h1>Thêm token</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM TOKEN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nhập danh sách token</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="form-control" name="list" rows="12"
                                            placeholder="1 dòng 1 token" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnSubmit" class="btn btn-primary btn-block waves-effect">
                                <span>THÊM NGAY</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH TOKEN LIVE</h3>
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
                                        <th width="5%">STT</th>
                                        <th>TOKEN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; foreach($CMSNT->get_list(" SELECT * FROM `token` ") as $row){ ?>
                                    <tr>
                                        <td width="5%"><?=$i++;?></td>
                                        <td><?=$row['token'];?></td>
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