<?php if($CMSNT->site('right_panel') == 'ON') { ?>
<div class="content-panel">
    <div class="content-panel-close"><i class="os-icon os-icon-close"></i></div>
    <div class="element-wrapper">
        <h6 class="element-header"><?=lang(38);?></h6>
        <div class="element-box-tp">
            <div class="profile-tile"><a class="profile-tile-box" href="<?=BASE_URL('Auth/Profile');?>">
                    <div class="pt-avatar-w"><img alt="" src="<?=BASE_URL('template/');?>img/avatar1.jpg"></div>
                    <div class="pt-user-name"><?=$getUser['username'];?></div>
                </a>
                <div class="profile-tile-meta">
                    <ul>
                        <li><?=lang(40);?>:<strong style="color: green;"><?=lang(39);?></strong></li>
                        <li><?=lang(41);?>:<strong style="color: red;"><?=$getUser['chietkhau'];?>%</strong></li>
                        <li><?=lang(31);?>:<strong><?=format_currency($getUser['money']);?></strong></li>
                        <li><?=lang(30);?>:<strong><?=format_currency($getUser['total_money']);?></strong>
                        </li>
                        <li><?=lang(32);?>:<strong><?=format_currency($getUser['used_money']);?></strong></li>
                    </ul>
                    <div class="pt-btn"><a class="btn btn-danger btn-block btn-sm"
                            href="<?=BASE_URL('Auth/Logout');?>"><?=lang(63);?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="element-wrapper">
        <h6 class="element-header"><?=lang(42);?></h6>
        <div class="element-box-tp">
            <div class="activity-boxes-w">
                <?php foreach($CMSNT->get_list("SELECT * FROM `orders` ORDER BY id DESC limit 10 ") as $orders) { ?>
                <div class="activity-box-w">
                    <div class="activity-time"><?=timeAgo($orders['time']);?></div>
                    <div class="activity-box">
                        ****<?=substr($orders['username'], 4);?> vừa mua <?=$orders['soluong'];?> tài khoản
                        <?=$orders['dichvu'];?>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<?php }?>
</div>
</div>
</div>

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



<?php if($getUser['phone'] == '') { ?>
<div id="thongbao"></div>
<div class="onboarding-modal modal fade animated" id="addphone" role="dialog" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=lang(138);?></h5>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"><?=lang(67);?>:</label>
                        <div class="col-sm-9">
                            <input type="text" id="phone" value="<?=$getUser['phone'];?>" placeholder="<?=lang(139);?>"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="add_phone">Lưu Ngay</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(e => {
        showaddphone()
    }, 0)
});

function showaddphone() {
    $('#addphone').modal({
        keyboard: true,
        show: true
    });
}
</script>
<script type="text/javascript">
$("#add_phone").on("click", function() {

    $('#add_phone').html('<?=lang(9);?>').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/add-phone.php");?>",
        method: "POST",
        data: {
            phone: $("#phone").val()
        },
        success: function(response)
        {
            $("#thongbao").html(response);
            $('#add_phone').html(
                    'Lưu Ngay')
                .prop('disabled', false);
        }
    });
});
</script>
<?php }?>



<?=$CMSNT->site('script');?>
<script src="<?=BASE_URL('template/');?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/popper.js/dist/umd/popper.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/moment/moment.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/chart.js/dist/Chart.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/ckeditor/ckeditor.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap-validator/dist/validator.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/dropzone/dist/dropzone.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/editable-table/mindmup-editabletable.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/tether/dist/js/tether.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/slick-carousel/slick/slick.min.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/util.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/alert.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/button.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/carousel.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/collapse.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/dropdown.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/modal.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/tab.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/tooltip.js"></script>
<script src="<?=BASE_URL('template/');?>bower_components/bootstrap/js/dist/popover.js"></script>
<script src="<?=BASE_URL('template/');?>js/main.js?version=4.5.0"></script>
<script src="<?=BASE_URL('template/');?>js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<script>
new ClipboardJS('.copy');
</script>
</body>

</html>