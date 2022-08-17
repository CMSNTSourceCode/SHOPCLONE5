<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'QUẢN LÝ NẠP THẺ | '.$CMSNT->site('tenweb');
    CheckLogin();
    CheckAdmin();
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
    require_once(__DIR__."/../../includes/checkLicense.php");
?>
<?php

if(isset($_POST['btnSaveOption']) && $getUser['level'] == 'admin')
{
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
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
                    <h1>Nạp qua thesieure.com</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CẤU HÌNH THESIEURE</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số điện thoại nhận</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="sdt_thesieure" placeholder="Sdt thesieure nhận tiền" value="<?=$CMSNT->site('sdt_thesieure');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên chủ ví</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="name_thesieure"  value="<?=$CMSNT->site('name_thesieure');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Token THESIEURE</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="token_thesieure" value="<?=$CMSNT->site('token_thesieure');?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">ON/OFF Auto TSR</label>
                                <div class="col-sm-9">
                                    <select class="custom-select" name="status_thesieure">
                                        <option value="ON" <?=$CMSNT->site('status_thesieure') == 'ON' ? 'selected' : '';?> >ON</option>
                                        <option value="OFF" <?=$CMSNT->site('status_thesieure') == 'OFF' ? 'selected' : '';?> >OFF</option>
                                    </select>
                                    <i>Khi bạn chọn OFF, hệ thống sẽ tạm dừng quá trình Auto THESIEURE.</i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Lưu ý</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea"
                                            name="luuy_tsr"><?=$CMSNT->site('luuy_tsr');?></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnSaveOption" class="btn btn-primary btn-block">
                                <span>LƯU</span></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">LỊCH SỬ NẠP THESIEURE</h3>
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
                                        <th>USERNAME</th>
                                        <th>MÃ GIAO DỊCH</th>
                                        <th>SỐ TIỀN NẠP</th>
                                        <th>THỜI GIAN</th>
                                        <th>GHI CHÚ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; foreach($CMSNT->get_list(" SELECT * FROM `thesieure` WHERE `username` IS NOT NULL ORDER BY id DESC ") as $row){ ?>
                                    <tr>
                                        <td><?=$i;?> <?php $i++;?></td>
                                        <td><a
                                                href="<?=BASE_URL('Admin/User/Edit/'.$CMSNT->getUser($row['username'])['id']);?>"><?=$row['username'];?></a>
                                        </td>
                                        <td><?=$row['magiaodich'];?></td>
                                        <td><?=format_cash($row['sotien']);?></td>
                                        <td><span class="badge badge-dark"><?=$row['time'];?></span></td>
                                        <td><?=$row['message'];?></td>
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
    // Summernote
    $('.textarea').summernote()
})
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