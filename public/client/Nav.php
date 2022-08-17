<?php CheckLogin();?>

<body class="menu-position-side menu-side-left full-screen with-content-panel">
    <div class="all-wrapper with-side-panel solid-bg-all">
        <div class="layout-w">
            <div class="menu-mobile menu-activated-on-click color-scheme-dark"
                style="background: <?=$CMSNT->site('theme_color');?>;">
                <div class="mm-logo-buttons-w"><a class="mm-logo" href="<?=BASE_URL('Dashbroad');?>"><img
                            src="<?=$CMSNT->site('logo');?>"><span><?=$CMSNT->site('tenweb');?></span></a>
                    <div class="mm-buttons">
                        <div class="content-panel-open">
                            <div class="os-icon os-icon-grid-circles"></div>
                        </div>
                        <div class="mobile-menu-trigger">
                            <div class="os-icon os-icon-hamburger-menu-1"></div>
                        </div>
                    </div>
                </div>
                <div class="menu-and-user">
                    <div class="logged-user-w">
                        <div class="avatar-w"><img alt="" src="<?=BASE_URL('template/');?>img/avatar1.jpg"></div>
                        <div class="logged-user-info-w">
                            <div class="logged-user-name"><?=strtoupper($getUser['username']);?></div>
                            <div class="logged-user-role"><?=daily($getUser['chietkhau']);?></div>
                        </div>
                    </div>
                    <ul class="main-menu">
                        <li class=""><a href="<?=BASE_URL('Dashbroad');?>">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-layout"></div>
                                </div><span><?=lang(43);?></span>
                            </a>
                        </li>
                        <li class="has-sub-menu"><a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-newspaper"></div>
                                </div><span><?=lang(129);?></span>
                            </a>
                            <ul class="sub-menu">
                                <?php foreach($CMSNT->get_list("SELECT * FROM `category` WHERE `display` = 'SHOW' ") as $category) { ?>
                                <li><a href="<?=BASE_URL('Category/'.$category['id']);?>"><?=$category['title'];?></a>
                                </li>
                                <?php }?>
                            </ul>
                        </li>
                        <li class=""><a href="<?=BASE_URL('History');?>">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-rotate-cw"></div>
                                </div><span><?=lang(36);?></span>
                            </a>
                        </li>
                        <li class="has-sub-menu"><a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-dollar-sign"></div>
                                </div><span><?=lang(37);?></span>
                            </a>
                            <ul class="sub-menu">
                                <?php if($CMSNT->site('status_card') == 'ON') { ?>
                                <li><a href="<?=BASE_URL('Recharge-Card');?>"><img src="<?=BASE_URL('assets/img/the-cao.png');?>" width="30px"> Thẻ cào <strong
                                            class="badge badge-danger">Auto</strong></a></li>
                                <?php }?>
                                <?php if($CMSNT->site('status_cron_momo') != 'OFF') { ?>
                                <li><a href="<?=BASE_URL('Recharge-Momo');?>"><img src="https://upload.wikimedia.org/wikipedia/vi/f/fe/MoMo_Logo.png" width="50px"> MOMO <strong
                                            class="badge badge-danger">Auto</strong></a></li>
                                <?php }?>
                                <?php if($CMSNT->site('status_zalopay') != 'OFF') { ?>
                                <li><a href="<?=BASE_URL('Recharge-ZaloPay');?>"><img src="https://i.imgur.com/fccfZ9o.png" width="30px"> Zalo Pay <strong
                                            class="badge badge-danger">Auto</strong></a></li>
                                <?php }?>
                                <?php if($CMSNT->site('status_thesieure') == 'ON') { ?>
                                <li><a href="<?=BASE_URL('Recharge-Thesieure');?>">THESIEURE <strong
                                            class="badge badge-danger">Auto</strong></a></li>
                                <?php }?>
                                <li><a href="<?=BASE_URL('Recharge-Bank');?>"><img src="<?=BASE_URL('assets/img/bank-icon.png');?>" width="30px"> <?=lang(62);?> <strong
                                            class="badge badge-danger">Auto</strong></a></li>
                            </ul>
                        </li>
                        <?php if($CMSNT->site('status_ref') == 'ON') { ?>
                        <li class=""><a href="<?=BASE_URL('Referral');?>">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-users"></div>
                                </div><span><?=lang(141);?></span>
                            </a>
                        </li>
                        <?php }?>
                        <?php if($CMSNT->site('status_top_nap') == 'ON') { ?>
                        <li class=""><a href="<?=BASE_URL('Top/Nap-tien');?>">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-bar-chart-down"></div>
                                </div><span><?=lang(104);?></span>
                            </a>
                        </li>
                        <?php }?>
                        <?php if($CMSNT->site('chinhsach_baohanh') != '') { ?>
                        <li class=""><a href="<?=BASE_URL('Policy');?>">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-file-text"></div>
                                </div><span><?=lang(99);?></span>
                            </a>
                        </li>
                        <?php }?>
                        <?php if($CMSNT->site('chinhsach') != '') { ?>
                        <li class=""><a href="<?=BASE_URL('Rules');?>">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-file-text"></div>
                                </div><span><?=lang(128);?></span>
                            </a>
                        </li>
                        <?php }?>
                        <li class="has-sub-menu"><a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-delivery-box-2"></div>
                                </div><span><?=lang(101);?></span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="<?=BASE_URL('tool/check-live-fb');?>">Check Live Facebook <strong
                                            class="badge badge-danger">Free</strong></a></li>
                                <li><a href="<?=BASE_URL('tool/check-live-gmail');?>">Check Live Gmail <strong
                                            class="badge badge-danger">Free</strong></a></li>
                                <li><a href="<?=BASE_URL('tool/check-live-hotmail');?>">Check Live Hotmail <strong
                                            class="badge badge-danger">Free</strong></a></li>
                                <li><a href="<?=BASE_URL('tool/check-live-yahoo');?>">Check Live Yahoo <strong
                                            class="badge badge-danger">Free</strong></a></li>
                                <li><a href="<?=BASE_URL('Tool/Get-2fa');?>">2FA Tool <strong
                                            class="badge badge-danger">Free</strong></a></li>
                                <li><a href="<?=BASE_URL('Tool/Get-Uid');?>">Find UID <strong
                                            class="badge badge-danger">Free</strong></a></li>
                            </ul>
                        </li>
                        <?php if($CMSNT->site('contact') != '') { ?>
                        <li class=""><a href="<?=BASE_URL('Contact');?>">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-phone"></div>
                                </div><span><?=lang(130);?></span>
                            </a>
                        </li>
                        <?php }?>
                        <?php if($getUser['level'] == 'admin') { ?>
                        <li class=""><a href="<?=BASE_URL('Admin');?>">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-settings"></div>
                                </div><span>Quản Trị Website</span>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
            <div class="menu-w color-scheme-dark color-style-bright menu-position-side menu-side-left menu-layout-full sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover menu-has-selected-link"
                style="background: <?=$CMSNT->site('theme_color');?>;">
                <div class="logo-w"><a class="logo" href="<?=BASE_URL('Dashbroad');?>">
                        <div class="logo-element"></div>
                        <div class="logo-label"><?=$CMSNT->site('tenweb');?></div>
                    </a></div>

                <div class="logged-user-w avatar-inline">
                    <div class="logged-user-i">
                        <div class="avatar-w"><img alt="" src="<?=BASE_URL('template/');?>img/avatar1.jpg"></div>
                        <div class="logged-user-info-w">
                            <div class="logged-user-name"><?=strtoupper($getUser['username']);?></div>
                            <div class="logged-user-role"><?=daily($getUser['chietkhau']);?></div>
                        </div>
                        <div class="logged-user-toggler-arrow">
                            <div class="os-icon os-icon-chevron-down"></div>
                        </div>
                        <div class="logged-user-menu color-style-bright">
                            <div class="logged-user-avatar-info">
                                <div class="avatar-w"><img alt="" src="<?=BASE_URL('template/');?>img/avatar1.jpg">
                                </div>
                                <div class="logged-user-info-w">
                                    <div class="logged-user-name"><?=strtoupper($getUser['username']);?></div>
                                    <div class="logged-user-role"><?=daily($getUser['chietkhau']);?></div>
                                </div>
                            </div>
                            <div class="bg-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                            <ul>
                                <li><a href="<?=BASE_URL('Auth/Profile');?>"><i
                                            class="os-icon os-icon-user-male-circle2"></i><span><?=lang(3);?></span></a>
                                </li>
                                <li><a href="<?=BASE_URL('Auth/Logout');?>"><i
                                            class="os-icon os-icon-signs-11"></i><span><?=lang(63);?></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <h1 class="menu-page-header">Page Header</h1>
                <ul class="main-menu">
                    <li class="sub-header"><span>CLIENT</span></li>
                    <li class="selected"><a href="<?=BASE_URL('Dashbroad');?>">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layout"></div>
                            </div><span><?=lang(43);?></span>
                        </a>
                    </li>
                    <li class="has-sub-menu"><a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-newspaper"></div>
                            </div><span><?=lang(129);?></span>
                        </a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header"><?=lang(129);?></div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <?php foreach($CMSNT->get_list("SELECT * FROM `category` WHERE `display` = 'SHOW' ") as $category) { ?>
                                    <li><a
                                            href="<?=BASE_URL('Category/'.$category['id']);?>"><?=$category['title'];?></a>
                                    </li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class=""><a href="<?=BASE_URL('History');?>">
                            <div class="icon-w">
                                <div class="os-icon os-icon-rotate-cw"></div>
                            </div><span><?=lang(36);?></span>
                        </a>
                    </li>
                    <li class="has-sub-menu"><a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-dollar-sign"></div>
                            </div><span><?=lang(37);?></span>
                        </a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header"><?=lang(37);?></div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <?php if($CMSNT->site('status_card') == 'ON') { ?>
                                    <li><a href="<?=BASE_URL('Recharge-Card');?>"><img src="<?=BASE_URL('assets/img/the-cao.png');?>" width="30px"> Thẻ cào <strong
                                                class="badge badge-danger">Auto</strong></a></li>
                                    <?php }?>
                                    <?php if($CMSNT->site('status_cron_momo') != 'OFF') { ?>
                                    <li><a href="<?=BASE_URL('Recharge-Momo');?>"><img src="https://upload.wikimedia.org/wikipedia/vi/f/fe/MoMo_Logo.png" width="30px"> MOMO <strong
                                                class="badge badge-danger">Auto</strong></a></li>
                                    <?php }?>
                                    <?php if($CMSNT->site('status_zalopay') != 'OFF') { ?>
                                    <li><a href="<?=BASE_URL('Recharge-ZaloPay');?>"><img src="https://i.imgur.com/fccfZ9o.png" width="30px"> Zalo Pay <strong
                                                class="badge badge-danger">Auto</strong></a></li>
                                    <?php }?>
                                    <?php if($CMSNT->site('status_thesieure') == 'ON') { ?>
                                    <li><a href="<?=BASE_URL('Recharge-Thesieure');?>">THESIEURE <strong
                                                class="badge badge-danger">Auto</strong></a></li>
                                    <?php }?>
                                    <li><a href="<?=BASE_URL('Recharge-Bank');?>"><img src="<?=BASE_URL('assets/img/bank-icon.png');?>" width="30px"> <?=lang(62);?> <strong
                                                class="badge badge-danger">Auto</strong></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <?php if($CMSNT->site('status_ref') == 'ON') { ?>
                    <li class=""><a href="<?=BASE_URL('Referral');?>">
                            <div class="icon-w">
                                <div class="os-icon os-icon-users"></div>
                            </div><span><?=lang(141);?></span>
                        </a>
                    </li>
                    <?php }?>
                    <li class=""><a href="<?=BASE_URL('Top/Nap-tien');?>">
                            <div class="icon-w">
                                <div class="os-icon os-icon-bar-chart-down"></div>
                            </div><span><?=lang(104);?></span>
                        </a>
                    </li>
                    <li class=""><a target="_blank" href="https://documenter.getpostman.com/view/9826758/TzzANcVu">
                            <div class="icon-w">
                                <div class="os-icon os-icon-file-text"></div>
                            </div><span><?=lang(152);?></span>
                        </a>
                    </li>
                    <?php if($CMSNT->site('chinhsach_baohanh') != '') { ?>
                    <li class=""><a href="<?=BASE_URL('Policy');?>">
                            <div class="icon-w">
                                <div class="os-icon os-icon-file-text"></div>
                            </div><span><?=lang(99);?></span>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($CMSNT->site('chinhsach') != '') { ?>
                    <li class=""><a href="<?=BASE_URL('Rules');?>">
                            <div class="icon-w">
                                <div class="os-icon os-icon-file-text"></div>
                            </div><span><?=lang(128);?></span>
                        </a>
                    </li>
                    <?php }?>
                    <li class="has-sub-menu"><a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-delivery-box-2"></div>
                            </div><span><?=lang(101);?></span>
                        </a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header"><?=lang(101);?></div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-layers"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="<?=BASE_URL('tool/check-live-fb');?>">Check Live Facebook <strong
                                                class="badge badge-danger">Free</strong></a></li>
                                    <li><a href="<?=BASE_URL('tool/check-live-gmail');?>">Check Live Gmail <strong
                                                class="badge badge-danger">Free</strong></a></li>
                                    <li><a href="<?=BASE_URL('tool/check-live-hotmail');?>">Check Live Hotmail <strong
                                                class="badge badge-danger">Free</strong></a></li>
                                    <li><a href="<?=BASE_URL('tool/check-live-yahoo');?>">Check Live Yahoo <strong
                                                class="badge badge-danger">Free</strong></a></li>
                                    <li><a href="<?=BASE_URL('Tool/Get-2fa');?>">2FA Tool <strong
                                                class="badge badge-danger">Free</strong></a></li>
                                    <li><a href="<?=BASE_URL('Tool/Get-Uid');?>">Find UID <strong
                                                class="badge badge-danger">Free</strong></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <?php if($CMSNT->site('contact') != '') { ?>
                    <li class=""><a href="<?=BASE_URL('Contact');?>">
                            <div class="icon-w">
                                <div class="os-icon os-icon-phone"></div>
                            </div><span><?=lang(130);?></span>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($getUser['level'] == 'admin') { ?>
                    <li class="sub-header"><span>Admin</span></li>
                    <li class="selected"><a href="<?=BASE_URL('Admin');?>">
                            <div class="icon-w">
                                <div class="os-icon os-icon-settings"></div>
                            </div><span>Quản Trị Website</span>
                        </a>
                    </li>
                    <?php }?>
                </ul>
            </div>
            <div class="content-w">
                <div class="top-bar color-scheme-bright" style="background-color: <?=$CMSNT->site('theme_color');?>;">
                    <div class="fancy-selector-w">
                        <?php if(isset($_SESSION['lang'])){ if($_SESSION['lang'] == 'en') {?>
                        <div class="fancy-selector-current" style="background: #1e62eb00;">
                            <div class="fs-img shadowless" style="background: #1e62eb00;"><img alt=""
                                    src="<?=BASE_URL('template/img/flags-icons/en.png');?>" style="width:30px;"></div>
                            <div class="fs-selector-trigger" style="background: #1e62eb00;"><i
                                    class="os-icon os-icon-arrow-down4"></i></div>
                        </div>
                        <?php } else { ?>
                        <div class="fancy-selector-current" style="background: #1e62eb00;">
                            <div class="fs-img shadowless" style="background: #1e62eb00;"><img alt=""
                                    src="<?=BASE_URL('template/img/flags-icons/vn.png');?>" style="width:30px;"></div>
                            <div class="fs-selector-trigger" style="background: #1e62eb00;"><i
                                    class="os-icon os-icon-arrow-down4"></i></div>
                        </div>
                        <?php }  } else  { ?>
                        <div class="fancy-selector-current" style="background: #1e62eb00;">
                            <div class="fs-img shadowless" style="background: #1e62eb00;"><img alt=""
                                    src="<?=BASE_URL('template/img/flags-icons/vn.png');?>" style="width:30px;"></div>
                            <div class="fs-selector-trigger" style="background: #1e62eb00;"><i
                                    class="os-icon os-icon-arrow-down4"></i></div>
                        </div>
                        <?php } ?>
                        <div class="fancy-selector-options" style="background: <?=$CMSNT->site('theme_color');?>;">
                            <div class="fancy-selector-option" id="trans-en">
                                <div class="fs-img shadowless" style="background: #1e62eb00;"><img alt=""
                                        src="<?=BASE_URL('template/img/flags-icons/en.png');?>"></div>
                            </div>
                            <div class="fancy-selector-option" id="trans-vn">
                                <div class="fs-img shadowless" style="background: #1e62eb00;"><img alt=""
                                        src="<?=BASE_URL('template/img/flags-icons/vn.png');?>"></div>
                            </div>
                        </div>
                    </div>
                    <div class="top-menu-controls">
                        <div class="logged-user-w">
                            <div class="logged-user-i">
                                <div class="avatar-w"><img alt="" src="<?=BASE_URL('template/');?>img/avatar1.jpg">
                                </div>
                                <div class="logged-user-menu color-style-bright">
                                    <div class="logged-user-avatar-info">
                                        <div class="avatar-w"><img alt=""
                                                src="<?=BASE_URL('template/');?>img/avatar1.jpg"></div>
                                        <div class="logged-user-info-w">
                                            <div class="logged-user-name"><?=$getUser['username'];?></div>
                                            <div class="logged-user-role"><?=daily($getUser['chietkhau']);?></div>
                                        </div>
                                    </div>
                                    <div class="bg-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                                    <ul>
                                        <li><a href="<?=BASE_URL('Auth/Profile');?>"><i
                                                    class="os-icon os-icon-user-male-circle2"></i><span><?=lang(3);?></span></a>
                                        </li>
                                        <li><a href="<?=BASE_URL('Auth/Logout');?>"><i
                                                    class="os-icon os-icon-signs-11"></i><span><?=lang(63);?></span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
                <script type="text/javascript">
                $("#trans-en").on("click", function() {
                    $.ajax({
                        url: "<?=BASE_URL("assets/ajaxs/Lang.php");?>",
                        method: "POST",
                        data: {
                            type: 'ChangeLanguage',
                            lang: 'en'
                        },
                        success: function(response) {
                            setTimeout(function() {
                                location.href = ""
                            }, 0);
                        }
                    });
                });
                </script>
                <script type="text/javascript">
                $("#trans-vn").on("click", function() {
                    $.ajax({
                        url: "<?=BASE_URL("assets/ajaxs/Lang.php");?>",
                        method: "POST",
                        data: {
                            type: 'ChangeLanguage',
                            lang: 'vn'
                        },
                        success: function(response) {
                            setTimeout(function() {
                                location.href = ""
                            }, 0);
                        }
                    });
                });
                </script>

                <?php
        if(isset($_SESSION['username']))
        {
            if($getUser['banned'] == 1)
            {
                session_destroy();
                msg_warning("Tài khoản của bạn đã bị khóa.", "", 5000);
            }
            if($getUser['level'] != 'admin')
            {
                if($CMSNT->site('baotri') == 'OFF')
                {
                    msg_warning("Hệ thống đang bảo trì định kỳ", "", 10000);
                }
            }
        }
        else
        {
            if($CMSNT->site('baotri') == 'OFF')
            {
                msg_warning("Hệ thống đang bảo trì định kỳ", "", 10000);
            }
        }
        