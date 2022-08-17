<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = strtoupper(lang(36)).' | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
?>


<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-header"> <?=strtoupper(lang(36));?></div>
                    <div class="element-box">
                        <div class="table-responsive">
                            <table id="datatable" width="100%" class="table table-padded">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?=strtoupper(lang(53));?></th>
                                        <th><?=strtoupper(lang(77));?></th>
                                        <th><?=strtoupper(lang(45));?></th>
                                        <th><?=strtoupper(lang(46));?></th>
                                        <th><?=strtoupper(lang(52));?></th>
                                        <th><?=strtoupper(lang(51));?></th>
                                        <th><?=strtoupper(lang(79));?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; foreach($CMSNT->get_list(" SELECT * FROM `orders` WHERE `username` = '".$getUser['username']."' ORDER BY id DESC ") as $row){ ?>
                                    <tr>
                                        <td width="5%"><?=$i++;?></td>
                                        <td><i><?=$row['code'];?></i></td>
                                        <td><b><?=$row['dichvu'];?></b></td>
                                        <td style="color: red;"><?=format_cash($row['soluong']);?></td>
                                        <td style="color: blue;"><?=format_currency($row['sotien']);?></td>
                                        <td><?=display_loai($row['loai']);?></td>
                                        <td><span class="badge badge-dark"><?=$row['thoigian'];?></span></td>
                                        <td>
                                            <a type="button" href="<?=BASE_URL('Order/');?><?=$row['code'];?>"
                                                class="btn btn-primary btn-block"><?=lang(47);?></a>
                                            <button type="button" data-toggle="modal"
                                                data-target="#modal-taive-<?=$row['id'];?>"
                                                class="btn btn-danger btn-block"><?=lang(48);?></button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-taive-<?=$row['id'];?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?=lang(49);?></h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <a type="button"
                                                        href="<?=BASE_URL('assets/models/DownloadFile.php?DownloadFile=full&code='.$row['code']);?>"
                                                        target="_blank" class="btn btn-danger btn-lg">FULL</a>
                                                    <a type="button"
                                                        href="<?=BASE_URL('assets/models/DownloadFile.php?DownloadFile=uidpass&code='.$row['code']);?>"
                                                        target="_blank" class="btn btn-primary btn-lg">UID | PASS</a>
                                                </div>
                                                <div class="modal-footer"><button class="btn btn-secondary"
                                                        data-dismiss="modal" type="button"> Đóng</button></div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
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