<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = lang(141).' | '.$CMSNT->site('tenweb');
    if($CMSNT->site('status_ref') != 'ON')
    { 
        die('Chức năng này đang bảo trì');
    }
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
?>
<?php
//$ref_yesterday = $CMSNT->num_rows("SELECT * FROM `users` WHERE `ref` = '".$getUser['id']."' AND `createdate` < DATE(NOW()) AND `createdate` >= DATE(NOW()) + INTERVAL -1 DAY ");
$ref_today = $CMSNT->num_rows("SELECT * FROM `users` WHERE `ref` = '".$getUser['id']."' AND `createdate` >= DATE(NOW()) AND `createdate` < DATE(NOW()) + INTERVAL 1 DAY ");
//$progress = $ref_today / $ref_yesterday * 100;
$ref_total = $CMSNT->num_rows("SELECT * FROM `users` WHERE `ref` = '".$getUser['id']."' ");
$total_hoahong = $CMSNT->get_row("SELECT SUM(`ref_money`) FROM `users` WHERE `ref` = '".$getUser['id']."' ")['SUM(`ref_money`)'];
?>

<div class="content-i">
    <div class="content-box">
        <div class="row pt-2">
            <div class="col-sm-4"><a class="element-box el-tablo centered trend-in-corner smaller" href="#">
                    <div class="label">Bạn bè giới thiệu hôm nay</div>
                    <div class="value"><?=format_cash($ref_today);?></div>
                </a></div>
            <div class="col-sm-4"><a class="element-box el-tablo centered trend-in-corner smaller" href="#">
                    <div class="label">Tổng bạn bè giới thiệu</div>
                    <div class="value"><?=format_cash($ref_total);?></div>
                </a></div>
            <div class="col-sm-4"><a class="element-box el-tablo centered trend-in-corner smaller" href="#">
                    <div class="label">Hoa hồng</div>
                    <div class="value"><?=format_currency($total_hoahong);?></div>
                </a></div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="cta-w orange text-center">
                    <div class="cta-content extra-padded">
                        <div class="highlight-header"><?=lang(141);?></div>
                        <h5 class="cta-header"><?=lang(142);?> <?=$CMSNT->site('ck_ref');?>%
                        </h5>
                        <div class="newsletter-field-w"><input id="urlRef"
                                value="<?=BASE_URL('?ref='.$getUser['id']);?>" readonly><button
                                class="btn btn-sm btn-primary copy" data-clipboard-target="#urlRef">COPY</button></div>
                        <i><?=lang(143);?></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="element-wrapper">
                    <div class="element-header"> <?=lang(144);?></div>
                    <div class="element-box">
                        <p><?=lang(145);?></p>
                        <p><?=lang(146);?></p>
                        <p><?=lang(147);?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 pt-5">
                <div class="element-wrapper">
                    <div class="element-header"> <?=lang(148);?></div>
                    <div class="element-box">
                        <div class="table-responsive">
                            <table id="datatable" width="100%" class="table table-striped table-lightfont">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?=lang(149);?></th>
                                        <th><?=lang(150);?></th>
                                        <th><?=lang(107);?></th>
                                        <th><?=lang(151);?></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th><?=lang(149);?></th>
                                        <th><?=lang(150);?></th>
                                        <th><?=lang(107);?></th>
                                        <th><?=lang(151);?></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i=0;foreach($CMSNT->get_list("SELECT * FROM `users` WHERE `ref` = '".$getUser['id']."' ") as $row) { ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><strong class="badge badge-primary"><?=$row['username'];?></strong></td>
                                        <td><strong class="badge badge-danger"><?=$row['createdate'];?></strong></td>
                                        <td><b style="color: blue;"><?=format_currency($row['total_money']);?></b></td>
                                        <td><b style="color:green;"><?=format_currency($row['ref_money']);?></b></td>
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