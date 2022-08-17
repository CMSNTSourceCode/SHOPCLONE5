<!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
<!DOCTYPE html>
<html lang="vi" dir="ltr">
<!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$CMSNT->site('tenweb');?></title>
    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
    <meta name="description" content="<?=$CMSNT->site('mota');?>">
    <meta name="keywords" content="<?=$CMSNT->site('tukhoa');?>">
    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
    <!-- Open Graph data -->
    <meta property="og:title" content="<?=$CMSNT->site('tenweb');?>">
    <meta property="og:type" content="Website">
    <meta property="og:url" content="<?=BASE_URL('');?>">
    <meta property="og:image" content="<?=$CMSNT->site('anhbia');?>">
    <meta property="og:description" content="<?=$CMSNT->site('mota');?>">
    <meta property="og:site_name" content="<?=$CMSNT->site('tenweb');?>">
    <meta property="article:section" content="<?=$CMSNT->site('mota');?>">
    <meta property="article:tag" content="<?=$CMSNT->site('tukhoa');?>">
    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="<?=$CMSNT->site('anhbia');?>">
    <meta name="twitter:site" content="CMSNT">
    <meta name="twitter:title" content="<?=$CMSNT->site('tenweb');?>">
    <meta name="twitter:description" content="<?=$CMSNT->site('mota');?>">
    <meta name="twitter:creator" content="CMSNT">
    <meta name="twitter:image:src" content="<?=$CMSNT->site('anhbia');?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=$CMSNT->site('favicon');?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=$CMSNT->site('favicon');?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=$CMSNT->site('favicon');?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?=$CMSNT->site('favicon');?>">
    <meta name="theme-color" content="#ffffff">
    <link href="<?=BASE_URL('page/Trafalgar/');?>assets/css/theme.css" rel="stylesheet" />
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=281459696201789&autoLogAppEvents=1"
        nonce="Zqk3CX9Z"></script>
</head>
<!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->

<body>
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand d-flex align-items-center fw-bold fs-2"
                    href="<?=BASE_URL('');?>"><img class="d-inline-block me-3" src="<?=$CMSNT->site('logo');?>" alt=""
                        width="200px" /></a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto pt-2 pt-lg-0">
                        <li class="nav-item"><a class="nav-link fw-bold active" aria-current="page"
                                href="<?=BASE_URL('');?>"><?=lang(120);?></a></li>
                        <li class="nav-item"><a class="nav-link" href="#sanpham"><?=lang(119);?></a></li>
                        <li class="nav-item"><a class="nav-link" href="<?=BASE_URL('Dashbroad');?>"><?=lang(1);?></a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                href="<?=BASE_URL('Auth/ForgotPassword');?>"><?=lang(122);?></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="py-0">
            <div class="bg-holder"
                style="background-image:url(<?=BASE_URL('page/Trafalgar/');?>assets/img/illustrations/dot.png);background-position:left;background-size:auto;margin-top:-105px;">
            </div>
            <div class="container position-relative">
                <div class="row align-items-center">
                    <div class="col-md-5 col-lg-6 order-md-1 pt-8"><img class="img-fluid"
                            src="<?=BASE_URL('page/Trafalgar/');?>assets/img/illustrations/hero-header.png" alt="" />
                    </div>
                    <div class="col-md-7 col-lg-6 text-center text-md-start pt-5 pt-md-9">
                        <h1 class="mb-4 display-3 fw-bold"><?=lang(112);?></h1>
                        <p class="mt-3 mb-4 fs-1"><?=lang(113);?></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-8" id="sanpham">
            <div class="bg-holder"
                style="background-image:url(<?=BASE_URL('page/Trafalgar/');?>assets/img/illustrations/services-bg.png);background-position:center left;background-size:auto;">
            </div>
            <div class="bg-holder"
                style="background-image:url(<?=BASE_URL('page/Trafalgar/');?>assets/img/illustrations/dot-2.png);background-position:center right;background-size:auto;margin-left:-180px;margin-top:20px;">
            </div>
            <div class="container-lg">
                <div class="row justify-content-center">
                    <div class="col-3 text-center">
                        <h2 class="fw-bold"><?=lang(114);?></h2>
                        <hr class="w-25 mx-auto text-dark" style="height:2px;" />
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-9 col-xl-8 text-center">
                        <p><?=lang(115);?></p>
                    </div>
                </div>
                <div class="row justify-content-center h-100 pt-7 g-4">
                    <?php foreach($CMSNT->get_list(" SELECT * FROM `category` WHERE `display` = 'SHOW' LIMIT 6 ") as $row){ ?>
                    <div class="col-sm-9 col-md-4">
                        <div class="card h-100 w-100 shadow rounded-lg p-3 p-md-2 p-lg-3 p-xl-5">
                            <div class="card-body text-center text-md-start">
                                <div class="py-3"><img class="img-fluid" src="<?=BASE_URL($row['img']);?>" width="70"
                                        alt="" /></div>
                                <div class="py-3">
                                    <h4 class="fw-bold card-title"><?=$row['title'];?></h4>
                                    <p class="card-text">
                                        <b><?=$CMSNT->num_rows("SELECT * FROM `dichvu` WHERE `loai` = '".$row['title']."' ");?></b>
                                        <?=lang(126);?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <div class="text-center py-4">
                        <a class="btn btn-lg btn-outline-primary rounded-pill" type="button"
                            href="<?=BASE_URL('Dashbroad');?>"><?=lang(116);?></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-6 py-lg-8" id="about">
            <div class="bg-holder"
                style="background-image:url(<?=BASE_URL('page/Trafalgar/');?>assets/img/illustrations/dot.png);background-position:right bottom;background-size:auto;margin-top:50px;">
            </div>
            <div class="container">
                <div class="row g-xl-0 align-items-center">
                    <div class="col-md-6"><img class="img-fluid mb-5 mb-md-0"
                            src="<?=BASE_URL('page/Trafalgar/');?>assets/img/illustrations/about-1.png" width="480"
                            alt="" /></div>
                    <div class="col-md-6 text-center text-md-start">
                        <h2 class="fw-bold lh-base"><?=lang(117);?></h2>
                        <hr class="text-dark mx-auto mx-md-0" style="height:2px;width:50px" />
                        <p class="pt-3"><?=lang(118);?></p>
                        <div class="py-3">
                            <a class="btn btn-lg btn-outline-primary rounded-pill" type="button"
                                href="<?=BASE_URL('Dashbroad');?>"><?=lang(116);?></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="py-6 pt-7 bg-primary-gradient">
            <div class="bg-holder"
                style="background-image:url(<?=BASE_URL('page/Trafalgar/');?>assets/img/illustrations/dot.png);background-position:left bottom;background-size:auto;filter:contrast(1.5);">
            </div>
            <!--/.bg-holder-->

            <div class="bg-holder"
                style="background-image:url(<?=BASE_URL('page/Trafalgar/');?>assets/img/illustrations/dot-2.png);background-position:right top;background-size:auto;margin-top:-75px;">
            </div>
            <!--/.bg-holder-->

            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-4 order-0 order-sm-0 pe-6"><a class="text-decoration-none" href="#"><img
                                class="img-fluid me-2" src="<?=$CMSNT->site('logo');?>" width="200px" alt="" /></a>
                        <p class="mt-3 text-white"><?=$CMSNT->site('mota');?></p>
                    </div>
                    <div class="col-4 col-md-4 col-lg mb-3 order-2 order-sm-1">
                        <h6 class="lh-lg fw-bold text-light"><?=lang(121);?></h6>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <?php foreach($CMSNT->get_list(" SELECT * FROM `category` WHERE `display` = 'SHOW' LIMIT 6 ") as $row){ ?>
                            <li class="lh-lg"><a class="text-light fs--1 text-decoration-none"
                                    href="<?=BASE_URL('Dashbroad');?>"><?=$row['title'];?></a></li>
                            <?php }?>
                        </ul>
                    </div>
                    <div class="col-4 col-md-4 col-lg mb-3 order-3 order-sm-2">
                        <h6 class="lh-lg fw-bold text-light"> <?=lang(127);?> </h6>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <li class="lh-lg"><a class="text-light fs--1 text-decoration-none" target="_blank"
                                    href="https://www.cmsnt.co/">CMSNT.CO</a></li>
                        </ul>
                    </div>
                    <div class="col-4 col-md-4 col-lg mb-3 order-1 order-sm-3">
                        <h6 class="lh-lg fw-bold text-light">Fanpage </h6>
                        <div class="fb-page" data-href="<?=$CMSNT->site('fanpage');?>" data-tabs="timeline"
                            data-width="" data-height="200" data-small-header="false" data-adapt-container-width="false"
                            data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="<?=$CMSNT->site('fanpage');?>" class="fb-xfbml-parse-ignore"><a
                                    href="<?=$CMSNT->site('fanpage');?>">CMSNT.CO</a></blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <p class="mb-0">&copy; Đơn vị thiết kế website
                                <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="#458FF6" viewBox="0 0 16 16">
                                    <path
                                        d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z">
                                    </path>
                                </svg>&nbsp;<a class="text-black" href="https://www.cmsnt.co/" target="_blank">CMSNT.CO
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?=$CMSNT->site('script');?>
    <script src="<?=BASE_URL('page/Trafalgar/');?>vendors/@popperjs/popper.min.js"></script>
    <script src="<?=BASE_URL('page/Trafalgar/');?>vendors/bootstrap/bootstrap.min.js"></script>
    <script src="<?=BASE_URL('page/Trafalgar/');?>vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="<?=BASE_URL('page/Trafalgar/');?>assets/js/theme.js"></script>
    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
    <link
        href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500&amp;display=swap"
        rel="stylesheet">
</body>

</html>