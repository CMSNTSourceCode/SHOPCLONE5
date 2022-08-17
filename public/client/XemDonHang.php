<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = 'XEM ĐƠN HÀNG | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
?>
<?php 
if(isset($_GET['code']))
{
    $code = check_string($_GET['code']);

    $orders = $CMSNT->get_row(" SELECT * FROM `orders` WHERE `code` = '$code' ");
    if(!$orders)
    {
        msg_error("Đơn hàng không tồn tại", BASE_URL(''), 500);
    }
}
else
{
    msg_error("Đơn hàng không tồn tại", BASE_URL(''), 0);
}
?>




<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-4 col-xxxl-3">
                        <a class="element-box el-tablo" href="#">
                            <div class="label"><?=strtoupper(lang(46));?></div>
                            <div class="value" style="font-size: 15px;"><?=format_currency($orders['sotien']);?></div>
                        </a>
                    </div>
                    <div class="col-sm-4 col-xxxl-3">
                        <a class="element-box el-tablo" href="#">
                            <div class="label"><?=strtoupper(lang(51));?></div>
                            <div class="value" style="font-size: 15px;"><?=timeAgo($orders['time']);?></div>
                        </a>
                    </div>
                    <div class="col-sm-4 col-xxxl-3">
                        <a class="element-box el-tablo" href="#">
                            <div class="label"><?=strtoupper(lang(52));?></div>
                            <div class="value" style="font-size: 15px;"><?=$orders['loai'];?></div>
                        </a>
                    </div>
                    <div class="col-sm-4 col-xxxl-3">
                        <a class="element-box el-tablo" href="#">
                            <div class="label"><?=strtoupper(lang(53));?></div>
                            <div class="value" style="font-size: 15px;"><?=$orders['code'];?></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-header"> <?=strtoupper(lang(54));?></div>
                    <div class="alert alert-warning borderless">
                        <?=$CMSNT->get_row("SELECT * FROM `dichvu` WHERE `dichvu` = '".$orders['dichvu']."'  ")['luuy'];?>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="os-tabs-w">
                    <div class="os-tabs-controls">
                        <ul class="nav nav-tabs upper">
                            <li class="nav-item">
                                <a class="nav-link active" id="list-tab" data-toggle="tab" href="#list" role="tab"
                                    aria-controls="list" aria-selected="true"><?=lang(155);?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="box-tab" data-toggle="tab" href="#box" role="tab"
                                    aria-controls="box" aria-selected="false"><?=lang(154);?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="box" role="tabpanel" aria-labelledby="box-tab">
                            <div class="element-box">
                                <center><button class="btn btn-danger btn-lg copy"
                                        data-clipboard-target="#coypyBox">Copy All</button></center><br>
                                <textarea id="coypyBox" class="form-control" rows="20"
                                    readonly><?php foreach($CMSNT->get_list(" SELECT * FROM `taikhoan` WHERE `code` = '".$orders['code']."' ORDER BY id DESC ") as $taikhoan){echo $taikhoan['chitiet'].PHP_EOL;}?></textarea>
                            </div>
                        </div>


                        <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
                            <div class="element-box">
                                <div class="table-responsive">
                                    <table id="datatable" width="100%" class="table table-padded">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>CHI TIẾT</th>
                                                <th>THAO TÁC</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; foreach($CMSNT->get_list(" SELECT * FROM `taikhoan` WHERE `code` = '".$orders['code']."' ORDER BY id DESC ") as $taikhoan){ ?>
                                            <tr>
                                                <td width="5%"><?=$i++;?></td>
                                                <td><textarea id="coypy<?=$taikhoan['id'];?>" class="form-control"
                                                        readonly><?=$taikhoan['chitiet'];?></textarea></td>
                                                <td width="10%">
                                                    <button type="button" class="btn btn-primary copy"
                                                        data-clipboard-target="#coypy<?=$taikhoan['id'];?>">
                                                        <span><?=strtoupper(lang(55));?></span></button>

                                                    <a type="button" target="_blank"
                                                        href="<?=BASE_URL('backup/index.php?uid='.explode("|", $taikhoan['chitiet'])[0]).'&code='.$orders['code'];?>"
                                                        class="btn btn-danger">
                                                        <span>
                                                            <?=lang(56);?>
                                                        </span>
                                                    </a>

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
            </div>


        </div>
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
    require_once("../../public/client/Footer.php");
?>