<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = strtoupper(lang(43)).' | '.$CMSNT->site('tenweb');

    if($CMSNT->site('status_is_change_password') == 'ON'){
        if(isset($getUser) && $getUser['change_password'] == 0){
            redirect(base_url('Auth/IsChangePassword'));
        }
    }
    
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
    define("IN_SITE", true);
?>


<div class="content-i">
    <div class="content-box">
        <?php if(empty($getUser['email'])){ ?>
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            Vui lòng <a href="<?=BASE_URL('Auth/Profile');?>">cập nhật</a> địa chỉ Email để bảo mật tài khoản.
        </div>
        <?php }?>
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper compact pt-4">
                    <div class="element-actions"><a class="btn btn-primary btn-sm" href="<?=BASE_URL('History');?>"><i
                                class="os-icon os-icon-rotate-cw"></i><span><?=lang(36);?></span></a></div>
                    <h6 class="element-header"><?=lang(35);?></h6>
                    <div class="element-box-tp">
                        <div class="row">
                            <div class="col-lg-12 col-xxl-12">
                                <div class="element-balances">
                                    <div class="balance">
                                        <div class="balance-title"><?=lang(30);?></div>
                                        <div class="balance-value">
                                            <?=format_currency($getUser['total_money']);?></div>
                                        <div class="balance-link"><a class="btn btn-link btn-underlined"
                                                href="<?=BASE_URL('Auth/Profile');?>"><span><?=lang(34);?></span><i
                                                    class="os-icon os-icon-arrow-right4"></i></a></div>
                                    </div>
                                    <div class="balance">
                                        <div class="balance-title"><?=lang(31);?></div>
                                        <div class="balance-value"><?=format_currency($getUser['money']);?>
                                        </div>
                                        <div class="balance-link"><a class="btn btn-link btn-underlined"
                                                href="<?=BASE_URL('Auth/Profile');?>"><span><?=lang(34);?></span><i
                                                    class="os-icon os-icon-arrow-right4"></i></a></div>
                                    </div>
                                    <div class="balance">
                                        <div class="balance-title"><?=lang(32);?></div>
                                        <div class="balance-value danger">
                                            <?=format_currency($getUser['used_money']);?></div>
                                        <div class="balance-link"><a class="btn btn-link btn-underlined btn-gold"
                                                data-target=".bd-example-modal-lg"
                                                data-toggle="modal"><span><?=lang(33);?></span><i
                                                    class="os-icon os-icon-arrow-right4"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xxl-12">
                                <div class="alert alert-warning borderless">
                                    <?=$CMSNT->site('thongbao');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div aria-hidden="true" aria-labelledby="myLargeModalLabel" class="modal fade bd-example-modal-lg"
                role="dialog" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?=lang(102);?></h5><button
                                aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                    aria-hidden="true">
                                    &times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <?php if($CMSNT->site('api_card') != '') { ?>
                                <div class="col-sm-12">
                                    <a class="mr-2 mb-2 btn btn-primary btn-lg btn-block"
                                        href="<?=BASE_URL('Recharge-Card');?>" type="button"> NẠP THẺ CÀO TỰ ĐỘNG</a>
                                </div>
                                <?php }?>
                                <?php if($CMSNT->site('status_cron_momo') == 'ON') { ?>
                                <div class="col-sm-12">
                                    <a class="mr-2 mb-2 btn btn-warning btn-lg btn-block"
                                        href="<?=BASE_URL('Recharge-Momo');?>" type="button"> NẠP QUA VÍ MOMO TỰ
                                        ĐỘNG</a>
                                </div>
                                <?php }?>
                                <?php if($CMSNT->site('status_zalopay') == 'ON') { ?>
                                <div class="col-sm-12">
                                    <a class="mr-2 mb-2 btn btn-danger btn-lg btn-block"
                                        href="<?=BASE_URL('Recharge-ZaloPay');?>" type="button"> NẠP QUA VÍ ZALO PAY TỰ
                                        ĐỘNG</a>
                                </div>
                                <?php }?>
                                <?php if($CMSNT->site('tk_tsr') != '' && $CMSNT->site('mk_tsr') != '') { ?>
                                <div class="col-sm-12">
                                    <a class="mr-2 mb-2 btn btn-danger btn-lg btn-block"
                                        href="<?=BASE_URL('Recharge-Thesieure');?>" type="button"> NẠP QUA
                                        THESIEURE.COM</a>
                                </div>
                                <?php }?>
                                <div class="col-sm-12">
                                    <a class="mr-2 mb-2 btn btn-success btn-lg btn-block"
                                        href="<?=BASE_URL('Recharge-Bank');?>" type="button"> NẠP QUA NGÂN HÀNG</a>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"><button class="btn btn-secondary" data-dismiss="modal" type="button">
                                Đóng</button></div>
                    </div>
                </div>
            </div>

                                                


            <?php 
            if($CMSNT->site('api_stt') == 0)
            {
                require_once(__DIR__.'/formBuyAPI.php');
                require_once(__DIR__.'/formBuy.php');
            }
            else
            {
                require_once(__DIR__.'/formBuy.php');
                require_once(__DIR__.'/formBuyAPI.php');
            }
            ?>


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
                            <input type="hidden" value="" readonly class="form-control" id="modal-type">
                            <input type="hidden" value="" readonly class="form-control" id="modal-api-id">
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
                        <textarea id="modal-type-name" class="form-control" rows="5" readonly contenteditable></textarea>
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
            $("#modal-type").val(btn.attr("data-type"));
            $("#modal-api-id").val(btn.attr("api-id"));
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
        var ck_discount = <?=$getUser['chietkhau'];?>;
        var total = 0;
        total = qty * price;
        total = total - total * ck_discount / 100;
        $("#modal-total").val(total.toString().replace(/(.)(?=(\d{3})+$)/g, '$1.'));
    });
    $('#btn-buy-now').on('click', function(e) {
        var soluong = $("#modal-soluong").val();
        var avaiable = $("#modal-available-amount").val();
        var id_dichvu = $("#modal-type-id").val();
        var type_api = $("#modal-type").val();
        var api_id = $("#modal-api-id").val();
        $('#btn-buy-now').addClass('btn btn-info').html(
            '  <span class="spinner-grow spinner-grow-sm"></span> <?=lang(81);?>').prop('disabled',
            true);
        Swal.fire({
            title: '<?=lang(111);?>',
            text: 'Hệ thống đang thực hiện check live tài khoản',
            imageUrl: '<?=BASE_URL('assets/img/loading.gif');?>',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
        $.ajax({
            url: "<?=BASE_URL("assets/ajaxs/Buy.php");?>",
            method: "POST",
            data: {
                type: type_api,
                api_id: api_id,
                value: soluong,
                dichvu: id_dichvu
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