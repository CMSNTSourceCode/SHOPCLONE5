<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = lang(38).' | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
?>


<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-header"> <?=lang(38);?></div>
                    <div class="element-box">
                        <div id="thongbao"></div>
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?=lang(5);?>:</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="readonly" class="form-control"
                                        value="<?=$getUser['username'];?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?=lang(66);?></label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="email" id="email" value="<?=$getUser['email'];?>" placeholder="Nhập địa chỉ Email để xác minh" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?=lang(67);?></label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" id="phone" value="<?=$getUser['phone'];?>" placeholder="Nhập số điện thoại liên hệ" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?=lang(68);?></label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" id="fullname" value="<?=$getUser['fullname'];?>" placeholder="Nhập họ và tên" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?=lang(31);?></label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="readonly" class="form-control"
                                        value="<?=format_cash($getUser['money']);?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?=lang(69);?></label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="readonly" class="form-control"
                                        value="<?=$getUser['createdate'];?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?=lang(70);?></label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="password" id="password" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?=lang(71);?></label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="password" id="repassword" class="form-control" required>
                                    </div>
                                    <i><?=lang(72);?>.</i>
                                </div>
                            </div>
                            <button type="button" id="ChangeProfile" class="btn btn-primary btn-rounded">
                                <span><?=lang(73);?></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-header"> <?=strtoupper(lang(57));?></div>
                    <div class="element-box">
                        <div class="table-responsive">
                            <table id="datatable" width="100%" class="table table-padded">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>SỐ TIỀN TRƯỚC</th>
                                        <th>SỐ TIỀN THAY ĐỔI</th>
                                        <th>SỐ TIỀN HIỆN TẠI</th>
                                        <th>THỜI GIAN</th>
                                        <th>NỘI DUNG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($CMSNT->get_list(" SELECT * FROM `dongtien` WHERE `username` = '".$getUser['username']."' ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><b style="color: blue;"><?=format_cash($row['sotientruoc']);?></b></td>
                                        <td><b style="color: red;"><?=format_cash($row['sotienthaydoi']);?></b></td>
                                        <td><b style="color: green;"><?=format_cash($row['sotiensau']);?></b></td>
                                        <td><span class="badge badge-dark"><?=$row['thoigian'];?></span></td>
                                        <td><?=$row['noidung'];?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-header"> NHẬT KÝ HOẠT ĐỘNG</div>
                    <div class="element-box">
                        <div class="table-responsive">
                            <table id="datatable1" width="100%" class="table table-padded">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>HÀNH ĐỘNG</th>
                                        <th>THỜI GIAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($CMSNT->get_list(" SELECT * FROM `logs` WHERE `username` = '".$getUser['username']."' ORDER BY id DESC ") as $logs){
                                    ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$logs['content'];?></td>
                                        <td><span class="badge badge-dark"><?=$logs['createdate'];?></span></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
    <script type="text/javascript">
    $("#ChangeProfile").on("click", function() {
        $('#ChangeProfile').html('ĐANG XỬ LÝ').prop('disabled',
            true);
        $.ajax({
            url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
            method: "POST",
            data: {
                type: 'ChangeProfile',
                email: $("#email").val(),
                phone: $("#phone").val(),
                fullname: $("#fullname").val(),
                password: $("#password").val(),
                repassword: $("#repassword").val()
            },
            success: function(response) {
                $("#thongbao").html(response);
                $('#ChangeProfile').html(
                        '<?=lang(73);?>')
                    .prop('disabled', false);
            }
        });
    });
    </script>
    <script>
    $(function() {
        $("#datatable").DataTable();
        $("#datatable1").DataTable();
    });
    </script>


    <?php 
    require_once("../../public/client/Footer.php");
?>