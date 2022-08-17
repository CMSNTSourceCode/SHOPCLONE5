<? if (!defined('IN_SITE')) die ('The Request Not Found'); ?>

<?php foreach($CMSNT->get_list("SELECT * FROM `category` WHERE `display` = 'SHOW' ORDER BY `stt` ") as $category) { ?>
<div class="col-sm-12">
    <div class="element-wrapper">
        <h6 class="element-header"><?=strtoupper($category['title']);?></h6>
        <div class="element-box-tp">
            <?php if($CMSNT->site('type_buy') == 'LIST'){ ?>
            <div class="table-responsive">
                <table class="table table-padded">
                    <thead>
                        <tr>
                            <th><?=lang(77);?></th>
                            <th width="10%" class="text-center"><?=lang(85);?></th>
                            <th width="10%" class="text-center"><?=lang(78);?></th>
                            <?php if($CMSNT->site('display_sold') == 'ON') { ?>
                            <th width="10%" class="text-center"><?=lang(140);?></th>
                            <?php }?>
                            <th width="10%" class="text-center"><?=lang(74);?></th>
                            <th width="15%" class="text-center"><?=lang(79);?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                    foreach($CMSNT->get_list("SELECT * FROM `dichvu` WHERE 
                                    `display` = 'SHOW' AND 
                                    `loai` = '".$category['title']."'  ORDER BY `stt` ASC ") as $row)
                                    {
                                        $conlai = $CMSNT->get_row(" SELECT COUNT(id) FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `trangthai` = 'LIVE' AND `code` IS NULL ")['COUNT(id)']; 
                                        $sold = $CMSNT->get_row(" SELECT COUNT(id) FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `code` IS NOT NULL ")['COUNT(id)'];
                                    ?>
                        <tr>
                            <td><img src="<?=BASE_URL($category['img']);?>" width="30px"
                                    title="<?=$category['title'];?>">
                                <b> <?=$row['dichvu'];?></b>
                            </td>
                            <td class="text-center">
                                <?php if($row['quocgia']) { ?>
                                <img width="40px" src="<?=BASE_URL('template/flag/'.$row['quocgia'].'.svg');?>" />
                                <?php }?>
                            </td>
                            <td class="text-center">
                                <b style="color: red;;">
                                    <?=format_cash($conlai);?>
                                </b>
                            </td>
                            <?php if($CMSNT->site('display_sold') == 'ON') { ?>
                            <td class="text-center">
                                <b style="color: green;;">
                                    <?=format_cash($sold);?>
                                </b>
                            </td>
                            <?php }?>
                            <td class="text-center">
                                <b style="color: blue;"><?=format_currency($row['gia']);?></b>
                            </td>
                            <td class="text-center">

                                <?php if($conlai != 0) { ?>
                                <button class="btn btn-outline-success btn-buy" conlai="<?=$conlai;?>"
                                    gia="<?=$row['gia'];?>" data-id="<?=$row['id'];?>" api-id=""
                                    mota="<?=$row['mota'];?>"><?=lang(83);?></button>
                                <?php } else { ?>
                                <button class="btn btn-danger" disabled><?=lang(84);?></button>
                                <?php }?>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>



            <?php } else if($CMSNT->site('type_buy') == 'BOX') {?>

            <div class="row">
                <?php foreach($CMSNT->get_list("SELECT * FROM `dichvu` WHERE `display` = 'SHOW' AND `loai` = '".$category['title']."'  ORDER BY `stt` ASC ") as $row){ ?>
                <?php $conlai = $CMSNT->get_row(" SELECT COUNT(id) FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `trangthai` = 'LIVE' AND `code` IS NULL ")['COUNT(id)']; ?>
                <div class="col-sm-6 col-xl-6 ">
                    <div class="element-box el-tablo">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="text-center"><?=$row['dichvu'];?></h5>
                                <hr>

                            </div>
                            <div class="col-lg-12">
                                <div class="alert alert-warning">
                                    <?=$row['mota'];?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="btn btn-danger btn-block">GIÁ:
                                    <?=format_currency($row['gia']);?></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="btn btn-success btn-block">CÒN LẠI: <?=format_cash($conlai);?>
                                </div>
                            </div>
                            <div class="col-lg-12"><br>
                                <button class="btn btn-info btn-block btn-lg btn-buy" style="color: white;"
                                    conlai="<?=$conlai;?>" gia="<?=$row['gia'];?>" data-type=""
                                    data-id="<?=$row['id'];?>" mota="<?=$row['mota'];?>">MUA NGAY</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>


            <?php }?>
        </div>
    </div>
</div>
<?php }?>