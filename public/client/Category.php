<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = $_GET['title'].' | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
    //CheckLogin();
?>
<?php 
    if(isset($_GET['title']))
    {
        $category = $CMSNT->get_row("SELECT * FROM `category` WHERE `id` = '".check_string($_GET['title'])."' AND `display` = 'SHOW' ");
    }
    else
    {
        die('URL không tồn tại');
    }
?>
<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper compact pt-4">
                    <div class="element-actions"><a class="btn btn-primary btn-sm" href="<?=BASE_URL('History');?>"><i
                                class="os-icon os-icon-rotate-cw"></i><span><?=lang(36);?></span></a><a
                            class="btn btn-success btn-sm" href="<?=BASE_URL('Recharge-Bank');?>"><i
                                class="os-icon os-icon-dollar-sign"></i><span><?=lang(37);?></span></a></div>
                    <h6 class="element-header"><?=lang(54);?></h6>
                    <div class="element-box-tp">
                        <div class="row">
                            <div class="col-lg-12 col-xxl-12">
                                <div class="alert alert-warning borderless">
                                    <?=$CMSNT->site('thongbao');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <h6 class="element-header"><?=strtoupper($category['title']);?></h6>
                    <div class="element-box-tp">
                        <div class="table-responsive">
                            <table class="table table-padded">
                                <thead>
                                    <tr>
                                        <th><?=lang(77);?></th>
                                        <th width="10%" class="text-center"><?=lang(85);?></th>
                                        <th width="10%" class="text-center"><?=lang(52);?></th>
                                        <th width="10%" class="text-center"><?=lang(78);?></th>
                                        <th width="10%" class="text-center"><?=lang(74);?></th>
                                        <th width="15%" class="text-center"><?=lang(79);?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($CMSNT->get_list("SELECT * FROM `dichvu` WHERE `display` = 'SHOW' AND `loai` = '".$category['title']."'  ORDER BY `gia` ASC ") as $row){ ?>
                                    <?php $conlai = $CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `trangthai` = 'LIVE' AND `code` IS NULL "); ?>
                                    <tr>
                                        <td><img src="<?=BASE_URL($category['img']);?>" width="30px"
                                                title="<?=$category;?>">
                                            <b data-content="<?=$row['mota'];?>" data-toggle="popover"
                                                title="<?=$row['dichvu'];?>"><?=$row['dichvu'];?></b>
                                        </td>
                                        <td class="text-center">
                                            <?php if($row['quocgia']) { ?>
                                            <img width="40px"
                                                src="<?=BASE_URL('template/flag/'.$row['quocgia'].'.svg');?>" />
                                            <?php }?>
                                        </td>
                                        <td class="text-center">
                                            <b><?=display_loai($row['loai']);?></b>
                                        </td>
                                        <td class="text-center">
                                            <b style="color: red;;">
                                                <?=format_cash($conlai);?>
                                            </b>
                                        </td>
                                        <td class="text-center">
                                            <b style="color: blue;"><?=format_currency($row['gia']);?></b>
                                        </td>
                                        <td class="text-center">
                                            <?php if($conlai != 0) { ?>
                                            <button class="btn btn-outline-success btn-buy" conlai="<?=$conlai;?>"
                                                gia="<?=$row['gia'];?>" data-id="<?=$row['id'];?>"
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
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body">
                    <div id="thongbao"></div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01"><?=lang(45);?></label>
                            </div>
                            <input type="number" min="1" value="1" class="form-control" id="modal-soluong"
                                style="font-size: 16px;font-weight: bold;text-align: right;">
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="modal-gia"><?=lang(74);?></label>
                            </div>
                            <input type="text" value="" readonly class="form-control" id="modal-gia"
                                style="font-size: 16px;font-weight: bold;text-align: right;">
                            <input type="hidden" value="" readonly class="form-control" id="modal-available-amount">
                            <input type="hidden" value="" readonly class="form-control" id="modal-type-id">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="modal-gia"><?=lang(41);?></label>
                            </div>
                            <input type="text" value="<?=$getUser['chietkhau'];?>%" readonly class="form-control"
                                style="font-size: 16px;font-weight: bold;text-align: right;">
                            <input type="hidden" value="" readonly class="form-control" id="modal-available-amount">
                            <input type="hidden" value="" readonly class="form-control" id="modal-type-id">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="modal-gia"><?=lang(75);?></label>
                            </div>
                            <input type="text" value="" readonly class="form-control" id="modal-total"
                                style="font-size: 16px;color: red;font-weight: bold;text-align: right;">
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea readonly class="form-control" id="modal-type-name"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btn-buy-now"><?=lang(46);?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=lang(76);?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->


    <script type="text/javascript">
    $('.btn-buy').on('click', function(e) {
        var btn = $(this);
        if ($(this).attr("conlai") > 0) {
            $("#modal-soluong").val(1);
            $("#modal-gia").val(parseFloat(btn.attr("gia")));
            $("#modal-type-name").val(btn.attr("mota"));
            $("#modal-available-amount").val(btn.attr("conlai"));
            $("#modal-type-id").val(btn.attr("data-id"));
            $("#modal-total").val(parseFloat(btn.attr("gia")));
            $("#staticBackdrop").modal();
        } else {
            alert("<?=lang(82);?> !");
        }
        return false;
    });
    $('#modal-soluong').on("keyup", function() {
        var price = $("#modal-gia").val();
        var qty = $("#modal-soluong").val();
        var avaiable = $("#modal-available-amount").val();
        if (qty > avaiable) {
            //$("#modal-soluong").val(avaiable);
            //qty = avaiable;
        }
        var ck_discount = <?=$getUser['chietkhau'];?>;
        var total = 0;
        total = qty * price;
        total = total - total * ck_discount / 100;
        $("#modal-total").val(total);


    });
    $('#btn-buy-now').on('click', function(e) {
        var qty = $("#modal-soluong").val();
        var avaiable = $("#modal-available-amount").val();
        var typeid = $("#modal-type-id").val();
        $('#btn-buy-now').addClass('btn btn-info').html(
            '  <span class="spinner-grow spinner-grow-sm"></span> <?=lang(81);?>').prop('disabled',
            true);

        $.ajax({
            url: "<?=BASE_URL("assets/ajaxs/Buy.php");?>",
            method: "POST",
            data: {
                value: qty,
                dichvu: typeid
            },
            success: function(response) {
                $("#thongbao").html(response);
                $('#btn-buy-now').html('<?=lang(46);?>').prop(
                    'disabled', false);
            }
        });
        return false;
    });
    </script>
    <script>
    $(function() {
        $("#datatable").DataTable();
    });
    </script>


    <?php 
    require_once("../../public/client/Footer.php");
?>