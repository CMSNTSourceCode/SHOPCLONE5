<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = 'NẠP TIỀN QUA VÍ MOMO | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
?>


<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-box text-center">
                        <img src="https://i.imgur.com/8ScNgvU.png" height="100px;" />
                        <br><br>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td style="text-align: right;">SDT: </td>
                                    <td style="text-align: left; color: #00cc99;">
                                        <b><?=$CMSNT->site('sdt_momo');?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">Chủ tài khoản:
                                    </td>
                                    <td style="text-align: left;">
                                        <b><?=$CMSNT->site('name_momo');?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">Nội dung chuyển tiền:
                                    </td>
                                    <td style="text-align: left;">
                                        <b id="copy" style="color:red;"><?=$CMSNT->site("noidung_naptien").$getUser['id'];?></b> <a class="copy" data-clipboard-target="#copy"><i class="os-icon os-icon-copy"></i></a>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan="2"><b><?=$CMSNT->site('momo_note');?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <h6 class="element-header">LỊCH SỬ NẠP MOMO</h6>
                    <div class="element-box">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-padded">
                                <thead>
                                    <tr>
                                        <th>Trạng thái</th>
                                        <th>Thời gian</th>
                                        <th>Nội dung</th>
                                        <th class="text-center">Mã GD</th>
                                        <th class="text-right">Số tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($CMSNT->get_list("SELECT * FROM `momo` WHERE `username` = '".$getUser['username']."' ") as $momo) { ?>
                                    <tr>
                                        <td class="nowrap"><span class="status-pill smaller green"></span><span>Hoàn
                                                thành</span>
                                        </td>
                                        <td><span><?=$momo['time'];?></span></td>
                                        <td class="cell-with-media"><?=$momo['comment'];?></td>
                                        <td class="text-center"><a class="badge badge-danger"
                                                href=""><?=$momo['tranId'];?></a></td>
                                        <td class="text-right bolder nowrap"><span class="text-success">+
                                                <?=format_cash($momo['amount']);?></span></td>
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





    <script>
    $(function() {
        $("#datatable").DataTable();
    });
    </script>


    <?php 
    require_once("../../public/client/Footer.php");
?>