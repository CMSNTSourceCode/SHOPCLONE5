<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = 'Check live UID | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
?>


<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-header">
                        Công Cụ Check LIVE UID VIA/CLONE Facebook
                    </div>
                    <div class="element-box">
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="textarea" class="control-label font-bold">Danh Sách UID Facebook <span
                                            class="badge badge-default font-bold" id="count_total">0</span></label>
                                    <textarea name="" id="list" class="form-control" rows="7" required="required"
                                        onkeyup="countTotal();"
                                        placeholder="Nhập vào danh sách UID cần check, mỗi dòng 1 ID"></textarea><br>
                                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="run(0);"
                                        id="btn">Kiểm Tra</button>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <label for="textarea" class="control-label font-bold text-success">Danh Sách UID LIVE
                                    <span class="badge badge-success font-bold" id="count_uid_live">0</span></label>
                                <textarea name="" id="uid_live" class="form-control" rows="10" required="required"
                                    disabled="" placeholder=" Kết quả sẽ ở đây sau khi check"></textarea>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <label for="textarea" class="control-label font-bold text-danger">Danh Sách UID DEAD
                                    <span class="badge badge-danger font-bold" id="count_uid_dead">0</span></label>
                                <textarea name="" id="uid_dead" class="form-control" rows="10" required="required"
                                    disabled="" placeholder=" Kết quả sẽ ở đây sau khi check"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript">

    var uid_live = 0,
        uid_dead = 0;

    function countTotal() {
        var list = $("#list").val().trim().split("\n");
        $("#count_total").text(list.length);
    }

    function run(index) {
        uid_live = 0, uid_dead = 0;
        $("#uid_live").empty();
        $("#uid_dead").empty();
        $("#btn").attr('disabled', true);
        $("#btn").html(
            '<img src="<?=BASE_URL('template/img/yellow-loading-wheel.gif');?>" width="20" height="20" alt="Image"> Đang check...'
        );
        checkxmdn(index);
    }

    function checkxmdn(index) {
        var list = $("#list").val().trim().split("\n");
        if (index >= list.length) {
            $.toast({
                heading: 'Message!',
                text: 'Hoàn Thành',
                showHideTransition: 'plain',
                icon: 'success'
            });
            $("#btn").attr('disabled', false);
            $("#btn").html('Hoàn Tất!');
            return;
        }
        var id = list[index].trim();
        $.post('<?=BASE_URL('assets/ajaxs/checkliveuid.php');?>', {
            uid: id,
        }).done(function(d) {
            d = JSON.parse(d);
            if (d.error == 'success') {
                $("#uid_live").append(id + "\n");
                ++uid_live;
                $("#count_uid_live").text(uid_live);
                $.toast({
                    heading: 'Message!',
                    text: d.uid + ' ~> LIVE',
                    showHideTransition: 'plain',
                    icon: 'success'
                });
            } else {
                $("#uid_dead").append(id + "\n");
                ++uid_dead;
                $("#count_uid_dead").text(uid_dead);
                $.toast({
                    heading: 'Message!',
                    text: d.uid + ' ~> DEAD',
                    showHideTransition: 'plain',
                    icon: 'error'
                });
            }
        }).always(function(d) {
            checkxmdn(index + 1);
        });
    }
    </script>


    <?php 
    require_once("../../public/client/Footer.php");
?>