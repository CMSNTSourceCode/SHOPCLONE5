<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = 'CHECK LIVE HOTMAIL | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
?>


<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-header">
                        CHECK LIVE HOTMAIL
                    </div>
                    <div class="element-box">
                        <div id="thongbao"></div>
                        <form class="form-horizontal" role="form" method='post' name='cms_form' novalidate>
                            <div id='loading_box' style='display:none;'>
                                <center><img src='https://i.imgur.com/qaIBNyQ.gif' /></center>
                            </div>
                            <div id='form_box'>
                                <div class="form-group">
                                    <label class="col-sm-12 control-label" style='text-align:left'>Nhập Danh Sách HOTMAIL</label>
                                    <div class="col-sm-12">
                                        <textarea style='height:150px;white-space:pre;overflow-wrap:normal;'
                                            class="form-control" id='fb_ids' placeholder="Mỗi dòng 1 HOTMAIL, có thể nhập full định dạng như: HOTMAIL|PASS|..." value=''></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <span onClick='check_live_account()'
                                            class="btn btn-warning btn_control_box btn-block">Bắt đầu</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 control-label text-success" style='text-align:left'>Nick Live
                                    <span class='badge badge-success px-3' style="background-color:#4caf50;"><span
                                            id='total_live'>0</span> / <span id='total_fb_id1'>0</span></span></label>
                                <div class="col-sm-12">
                                    <textarea style='height:150px;white-space:pre;overflow-wrap:normal;'
                                        class="form-control" id='live_fb_ids'></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 control-label text-error" style='text-align:left'>Nick Die <span
                                        class='badge badge-danger px-3' style="background-color:#f44336;"><span
                                            id='total_die'>0</span> / <span id='total_fb_id2'>0</span></span></label>
                                <div class="col-sm-12">
                                    <textarea style='height:150px;white-space:pre;overflow-wrap:normal;'
                                        class="form-control" id='die_fb_ids'></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script language='javascript'>
    function check_live_account() {
        $('#live_fb_ids').val('');
        $('#die_fb_ids').val('');
        $('#total_live').html('0');
        $('#total_die').html('0');
        $('#total_fb_id1').html('0');
        $('#total_fb_id2').html('0');
        if ($("#fb_ids").val()) {
            var fb_ids = [];
            var list_duplicate = {};
            var cur_fb_ids = $("#fb_ids").val();
            var temp_fb_ids = cur_fb_ids.toString().split("\n");
            for (var i = 0; i < temp_fb_ids.length; i++) {
                if (temp_fb_ids[i] && temp_fb_ids[i].toString().trim()) {
                    if (!list_duplicate[temp_fb_ids[i].toString().trim()]) {
                        fb_ids.push(temp_fb_ids[i].toString().trim());
                        list_duplicate[temp_fb_ids[i].toString().trim()] = 1;
                    }
                }
            }
            $("#loading_box").show();
            $('#total_fb_id1').html(fb_ids.length);
            $('#total_fb_id2').html(fb_ids.length);
            check_live_nick(fb_ids, 0, function() {
                $("#loading_box").hide();
            });
        }
    }

    function check_live_nick(fb_ids, counter, callback) {
        if (counter < fb_ids.length) {
            var limit = 20;
            var done = 0;
            var call = 0;
            var list_done = [];
            var next_limit = counter + limit;
            next_limit = next_limit > fb_ids.length ? fb_ids.length : next_limit;
            for (var i = counter; i < next_limit; i++) {
                call++;
                check_live_one_nick(fb_ids[i], function(response) {
                    list_done.push(response);
                    done++;
                    if (done >= call) {
                        check_live_nick(fb_ids, next_limit, callback);
                    }
                });
            }
        } else {
            callback();
        }
    }

    function check_live_one_nick(fb_id, callback) {
        $.get("<?=BASE_URL('assets/ajaxs/check-live-hotmail.php?uid=');?>" + fb_id, function(data, status) {
            if (data == 'LIVE') {
                $("#total_live").html(parseInt($("#total_live").html()) + 1);
                if ($("#live_fb_ids").val()) {
                    $("#live_fb_ids").val($("#live_fb_ids").val() + "\n" + fb_id);
                } else {
                    $("#live_fb_ids").val(fb_id);
                }
            } else {
                $("#total_die").html(parseInt($("#total_die").html()) + 1);
                if ($("#die_fb_ids").val()) {
                    $("#die_fb_ids").val($("#die_fb_ids").val() + "\n" + fb_id);
                } else {
                    $("#die_fb_ids").val(fb_id);
                }
            }
            callback();
        });
    }
    </script>
    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->

    <?php 
    require_once("../../public/client/Footer.php");
?>