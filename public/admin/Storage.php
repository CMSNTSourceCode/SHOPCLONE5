<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    CheckLogin();
    CheckAdmin();
    $title = 'LƯU TRỮ | '.$CMSNT->site('tenweb');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");

    if(isset($_POST['type']) && $getUser['level'] == 'admin')
    {
        if($CMSNT->site('status_demo') == 'ON')
        {
            admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
        }
        if($_POST['type'] == 'Delete' && isset($_POST['path']))
        {
            $isDelete = unlink(check_string($_POST['path']));
            if($isDelete)
            {
                admin_msg_success("Xóa thành công", '', 500);
            }
            else
            {
                admin_msg_warning("Xóa thất bại", "", 2000);
            }
        }
    }
    
?>

<?php
if(isset($_POST['UploadBackup']) && $getUser['level'] == 'admin')
{
    $type = check_string($_POST['type']);
    if($CMSNT->site('status_demo') == 'ON')
    {
        admin_msg_error("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    if($_FILES['listbacup']['name'])
    {
        foreach($_FILES['listbacup']['name'] as $name => $value)
        {
            if($type == 1)
            {
                $uid = explode("_", $value)[1];
                $uid = explode(".", $uid)[0];
            }
            else if($type == 2)
            {
                $uid = explode(".", $value)[0];
            }
            else if($type == 3)
            {
                $uid = explode("_", $value)[0];
            }
            else if($type == 4)
            {
                $uid = explode("-", $value)[0];
            }
            else if($type == 5)
            {
                $uid = explode("-", $value)[1];
                $uid = explode(".", $uid)[0];
            }
            $uploads_dir = '../../backup';
            $tmp_name = $_FILES['listbacup']['tmp_name'][$name];
            $url_img = "/".$uid.".html";
            move_uploaded_file($tmp_name, $uploads_dir.$url_img);
        }
    }
    admin_msg_success("Tải lên thành công !", '', 500);
}
?>
<div class="content-wrapper">
    <div id="thongbao"></div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lưu trữ</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-dark">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <p>Để tăng số lượng <b>max_file_uploads</b> vui lòng liên hệ bên cung cấp Host.</p>
                    <p>max_file_uploads hiện tại của máy chủ bạn là: <b style="color: yellow;"><?=ini_get('max_file_uploads');?></b></p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH FILE BACKUP</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                data-target="#modal-default">
                                Tải backup lên
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="10px">STT</th>
                                        <th>FILE NAME</th>
                                        <th>SIZE</th>
                                        <th>CREATEDATE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = COUNT(dirToArray('../../backup/')); foreach(dirToArray('../../backup/') as $row){ ?>
                                    <tr>
                                        <td><?=$i--;?></td>
                                        <td style="font-size: 20px;"><i class="fas fa-file-<?php echo getFileType($row); ?> mr-1"></i><?=$row;?></td>
                                        <td>
                                            <b><?=FileSizeConvert(realFileSize('../../backup/'.$row));?></b>
                                        </td>
                                        <td>
                                            <i><?=timeAgo(GetCorrectMTime('../../backup/'.$row));?></i>
                                        </td>
                                        <td>
                                            <a type="button" target="_blank"
                                                href="<?=BASE_URL('backup/index.php?uid='.explode(".html", $row)[0].'&admin=mlem');?>"
                                                class="btn btn-primary">
                                                DOWNLOAD
                                            </a>
                                            <button class="btn btn-danger Delete"
                                                data-path="../../backup/<?=$row;?>">DELETE</button>
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


<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload File Backup</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label">Chọn danh sách backup</label>
                        <div class="col-sm-7">
                            <div class="form-line">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="form-control" id="exampleInputFile" name="listbacup[]"
                                            multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label">Chọn loại backup</label>
                        <div class="col-sm-7">
                            <div class="form-line">
                                <select class="form-control" name="type">
                                    <option value="1">name_uid.html</option>
                                    <option value="2">uid.html</option>
                                    <option value="3">uid_name.html</option>
                                    <option value="4">uid-name.html</option>
                                    <option value="5">name-uid.html</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <i>Số lượng tải lên tối đa 1 lần của server bạn là <b
                            style="color: red;"><?=ini_get('max_file_uploads');?></b> file backup.</i>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ĐÓNG</button>
                    <button type="submit" name="UploadBackup" class="btn btn-primary">TẢI LÊN</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<script type="text/javascript">
$(".Delete").on("click", function() {
    Swal.fire({
        title: 'Xóa tệp',
        text: "Bạn có đồng ý xóa tệp này không?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa ngay',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            $('.Delete').html('ĐANG XỬ LÝ').prop('disabled',
                true);
            $.ajax({
                url: "<?=BASE_URL("public/admin/Storage.php");?>",
                method: "POST",
                data: {
                    type: 'Delete',
                    path: $(this).attr("data-path")
                },
                success: function(response) {
                    $("#thongbao").html(response);
                    $('.Delete').html('DELETE').prop('disabled', false);
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
    require_once(__DIR__."/Footer.php");
?>