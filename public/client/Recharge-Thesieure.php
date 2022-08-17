<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = 'NẠP TIỀN BẰNG THẺ SIÊU RẺ | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
?>


<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-warning borderless">
                    <?=$CMSNT->site('luuy_tsr');?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="element-wrapper">
                    <div class="element-box text-center">
                        <img src="https://thesieure.com/storage/userfiles/images/logo_thesieurecom.png"
                            height="80px;" />
                        <br><br>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td style="text-align: right;">TÀI KHOẢN NHẬN TIỀN: </td>
                                    <td style="text-align: left; color: #00cc99;">
                                        <b><?=$CMSNT->site('sdt_thesieure');?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">TÊN CHỦ TÀI KHOẢN: </td>
                                    <td style="text-align: left; color: blue;">
                                        <b><?=$CMSNT->site('name_thesieure');?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">Nội dung chuyển tiền:
                                    </td>
                                    <td style="text-align: left;">
                                        <b style="color:red;"
                                            id="copy"><?=$CMSNT->site("noidung_naptien").$getUser['id'];?></b> <a
                                            class="copy" data-clipboard-target="#copy"><i
                                                class="os-icon os-icon-copy"></i></a>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan="2"><b>Nhập đúng nội dung, cộng tiền ngay.</b></td>
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
                    <h6 class="element-header">LỊCH SỬ NẠP THESIEURE</h6>
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
                                    <?php foreach($CMSNT->get_list("SELECT * FROM `thesieure` WHERE `username` = '".$getUser['username']."' ") as $momo) { ?>
                                    <tr>
                                        <td class="nowrap"><span class="status-pill smaller green"></span><span>Hoàn
                                                thành</span>
                                        </td>
                                        <td><span><?=$momo['time'];?></span></td>
                                        <td class="cell-with-media"><?=$momo['noidung'];?></td>
                                        <td class="text-center"><a class="badge badge-danger"
                                                href=""><?=$momo['magiaodich'];?></a></td>
                                        <td class="text-right bolder nowrap"><span class="text-success">+
                                                <?=format_currency($momo['sotien']);?></span></td>
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


    <?php 
    require_once("../../public/client/Footer.php");
?>