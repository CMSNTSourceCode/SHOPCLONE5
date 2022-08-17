<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = 'NẠP TIỀN QUA NGÂN HÀNG | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
?>


<div class="content-i">
    <div class="content-box">
        <div class="row">
            <?php foreach($CMSNT->get_list(" SELECT * FROM `bank` ") as $bank) { ?>
            <div class="col-sm-6">
                <div class="element-wrapper">
                    <div class="element-box text-center">
                        <img src="<?=$bank['logo'];?>" height="100px;" />
                        <br><br>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td style="text-align: right;"><?=lang(61);?>: </td>
                                    <td style="text-align: left; color: #00cc99;">
                                        <b><?=$bank['stk'];?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;"><?=lang(59);?>:
                                    </td>
                                    <td style="text-align: left;">
                                        <b><?=$bank['bank_name'];?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;"><?=lang(60);?>:
                                    </td>
                                    <td style="text-align: left;">
                                        <b style="color:red;" id="copy<?=$bank['id'];?>"><?=$CMSNT->site("noidung_naptien").$getUser['id'];?></b> <a class="copy" data-clipboard-target="#copy<?=$bank['id'];?>"><i class="os-icon os-icon-copy"></i></a>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan="2"><b><?=$bank['ghichu'];?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <h6 class="element-header"><?=strtoupper(lang(100));?></h6>
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
                                    <?php foreach($CMSNT->get_list("SELECT * FROM `bank_auto` WHERE `username` = '".$getUser['username']."' ") as $bank_auto) { ?>
                                    <tr>
                                        <td class="nowrap"><span class="status-pill smaller green"></span><span>Hoàn
                                                thành</span>
                                        </td>
                                        <td><span><?=$bank_auto['time'];?></span></td>
                                        <td class="cell-with-media"><?=$bank_auto['description'];?></td>
                                        <td class="text-center"><a class="badge badge-danger"
                                                href=""><?=$bank_auto['tid'];?></a></td>
                                        <td class="text-right bolder nowrap"><span class="text-success">+
                                                <?=format_cash($bank_auto['amount']);?></span></td>
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