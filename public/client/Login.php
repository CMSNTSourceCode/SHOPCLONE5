<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = lang(1).' | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
?>

<body class="auth-wrapper">
    <div class="all-wrapper menu-side with-pattern">
        <div class="auth-box-w">
            <div class="logo-w"><a href="<?=BASE_URL('');?>"><img alt="" width="100%"
                        src="<?=$CMSNT->site('logo');?>"></a></div>
            <h4 class="auth-header"><?=lang(4);?></h4>
            <form action="">
                <div id="thongbao"></div>
                <div class="form-group"><label for=""><?=lang(5);?></label><input class="form-control" id="username"
                        placeholder="<?=lang(7);?>">
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                </div>
                <div class="form-group"><label for=""><?=lang(6);?></label><input class="form-control" id="password"
                        placeholder="<?=lang(8);?>" type="password">
                    <div class="pre-icon os-icon os-icon-fingerprint"></div>
                </div>
                <?php 
                use Gregwar\Captcha\CaptchaBuilder;
                $builder = new CaptchaBuilder;
                $builder->build();
                $_SESSION['phrase'] = $builder->getPhrase();
                if($CMSNT->site('status_capchat') == "ON"){ ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for=""><?=lang(156);?></label>
                            <img width="100%" src="<?php echo $builder->inline(); ?>" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for=""><?=lang(157);?></label>
                        <input class="form-control" id="phrase"
                        placeholder="Nội dung bên trái" type="text"></div>
                    </div>
                </div>
                <?php }?>  
                <div class="form-group">
                    <label for=""><a href="<?=BASE_URL('Auth/ForgotPassword');?>"><?=lang(122);?></a></label>
                </div>
                <div class="buttons-w"><button class="btn btn-primary btn-block" id="Login"
                        type="button"><?=lang(1);?></button>
                    <a class="btn btn-danger btn-block" href="<?=BASE_URL('Auth/Register');?>"
                        type="button"><?=lang(2);?></a>
                </div>
            </form>
        </div>

        <?php if($CMSNT->site('display_list_login') == 'ON') { ?>
        <br><br>
        <?php foreach($CMSNT->get_list("SELECT * FROM `category` WHERE `display` = 'SHOW' ORDER BY `stt` ") as $category) { ?>
        <div class="element-wrapper">
            <h6 class="element-header"><?=$category['title'];?></h6>
            <div class="element-box">
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                    foreach($CMSNT->get_list("SELECT * FROM `dichvu` WHERE 
                                    `display` = 'SHOW' AND 
                                    `loai` = '".$category['title']."'  ORDER BY `stt` ASC ") as $row)
                                    {
                                        $conlai = $CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `trangthai` = 'LIVE' AND `code` IS NULL "); 
                                        $sold = $CMSNT->num_rows(" SELECT * FROM `taikhoan` WHERE `dichvu` = '".$row['id']."' AND `code` IS NOT NULL ");
                                    ?>
                            <tr>
                                <td><img src="<?=BASE_URL($category['img']);?>" width="30px"
                                        title="<?=$category['title'];?>">
                                    <b data-content="<?=$row['mota'];?>" data-toggle="popover"
                                        title="<?=$row['dichvu'];?>"><?=$row['dichvu'];?></b>
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
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <?php }?>
        <?php }?>


    </div>
</body>

</html>


<?php if(!isset($_SESSION['thongbaonoi'])) { $_SESSION['thongbaonoi'] = True;?>
<div class="onboarding-modal modal fade animated" id="thongbaonoi" role="dialog" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">THÔNG BÁO</h5>
            </div>
            <div class="modal-body">
                <?=$CMSNT->site('thongbao');?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(e => {
        showlog()
    }, 500)
});

function showlog() {
    $('#thongbaonoi').modal({
        keyboard: true,
        show: true
    });
}
</script>
<?php }?>
<?=$CMSNT->site('script');?>
<!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
<script type="text/javascript">
$("#Login").on("click", function() {

    $('#Login').html('<?=lang(9);?>').prop('disabled',
        true);
    Swal.fire({
        title: '<?=lang(111);?>',
        text: '',
        imageUrl: '<?=BASE_URL('assets/img/loading.gif');?>',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
    })
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
        method: "POST",
        data: {
            type: 'Login',
            username: $("#username").val(),
            password: $("#password").val(),
            phrase: $("#phrase").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#Login').html(
                    '<?=lang(1);?>')
                .prop('disabled', false);
        }
    });
});
</script>


<?php 
    //require_once("../../public/client/Footer.php");
?>