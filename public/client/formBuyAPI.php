<? if (!defined('IN_SITE')) die ('The Request Not Found'); ?>




<?php
            if($CMSNT->site('api_status') === 'ON'){
                foreach($CMSNT->get_list("SELECT * FROM `api_domains` ORDER BY id DESC ") as $list_api)
                {
                    $getCategory = curl_get($list_api['domain'].'/api/ListResource.php?username='.$list_api['username'].'&password='.$list_api['password']);
                    $getCategory = json_decode($getCategory, true);
                    if($getCategory['status'] == 'success')
                    {
                        foreach($getCategory['categories'] as $category)
                        { 
                            if($CMSNT->get_row("SELECT * FROM `hide_category_api` WHERE `category_id` = '".$category['id']."' AND `domain` = '".$list_api['domain']."' "))
                            {
                                continue;
                            }
            ?>

<div class="col-sm-12">
    <div class="element-wrapper">
        <h6 class="element-header"><?=strtoupper($category['name']);?></h6>
        <div class="element-box-tp">
            <div class="table-responsive">
                <table class="table table-padded">
                    <thead>
                        <tr>
                            <th><?=lang(77);?></th>
                            <th width="10%" class="text-center"><?=lang(85);?></th>
                            <th width="10%" class="text-center"><?=lang(78);?></th>
                            <th width="10%" class="text-center"><?=lang(74);?></th>
                            <th width="15%" class="text-center"><?=lang(79);?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                    foreach($category['accounts'] as $row)
                                    {
                                        if($CMSNT->get_row("SELECT * FROM `hide_product_api` WHERE `product_id` = '".$row['id']."' AND `domain` = '".$list_api['domain']."' "))
                                        {
                                            continue;
                                        }
                                        $row['price'] = $row['price'] + $row['price'] * $CMSNT->site('api_ck') / 100;
                                    ?>
                        <tr>
                            <td>
                                <b><img src="<?=$category['image'];?>" width="30px" title="<?=$category['name'];?>">
                                    <?=$row['name'];?></b>
                            </td>
                            <td class="text-center">
                                <?php if($row['country']) { ?>
                                <img width="40px" src="<?=BASE_URL('template/flag/'.$row['country'].'.svg');?>" />
                                <?php }?>
                            </td>
                            <td class="text-center">
                                <b style="color: red;;">
                                    <?=format_cash($row['amount']);?>
                                </b>
                            </td>
                            <td class="text-center">
                                <b style="color: blue;"><?=format_currency($row['price']);?></b>
                            </td>
                            <td class="text-center">

                                <?php if($row['amount'] != 0) { ?>

                                <button class="btn btn-outline-success btn-buy" conlai="<?=$row['amount'];?>"
                                    gia="<?=$row['price'];?>" data-id="<?=$row['id'];?>" data-type="api"
                                    api-id="<?=$list_api['id'];?>"
                                    mota="<?=$row['description'];?>"><?=lang(83);?></button>
                                <?php } else { ?>
                                <button class="btn btn-danger" disabled><?=lang(84);?></button>
                                <?php }?>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<?php } } } }?>