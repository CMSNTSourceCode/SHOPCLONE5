<!DOCTYPE html>
<html lang="en-US" dir="ltr">

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
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0&appId=281459696201789&autoLogAppEvents=1"
        nonce="Zqk3CX9Z"></script>
    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="<?=BASE_URL('page/JoBest/');?>assets/css/theme.css" rel="stylesheet" />

</head>


<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 backdrop"
            data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand d-flex align-items-center fw-bolder fs-2 fst-italic" href="#">
                    <img class="d-inline-block me-3" src="<?=$CMSNT->site('logo');?>" alt="" width="200px" />
                </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto pt-2 pt-lg-0">
                        <li class="nav-item px-2"><a class="nav-link fw-medium active" aria-current="page"
                                href="<?=BASE_URL('');?>"><?=lang(120);?></a></li>
                        <li class="nav-item px-2"><a class="nav-link fw-medium"
                                href="<?=BASE_URL('Auth/ForgotPassword');?>"><?=lang(122);?></a></a></li>
                    </ul>
                    <form class="ps-lg-5">
                        <a class="btn btn-lg btn-primary rounded-pill bg-gradient order-0" type="button"
                            href="<?=BASE_URL('Dashbroad');?>"><?=lang(1);?></a>
                    </form>
                </div>
            </div>
        </nav>
        <section class="py-0" id="home">
            <div class="bg-holder d-none d-sm-block"
                style="background-image:url(<?=BASE_URL('page/JoBest/');?>assets/img/illustrations/hero-bg.png);background-position:right top;background-size:contain;">
            </div>
            <!--/.bg-holder-->

            <div class="bg-holder d-sm-none"
                style="background-image:url(<?=BASE_URL('page/JoBest/');?>assets/img/illustrations/hero-bg.png);background-position:right top;background-size:contain;">
            </div>
            <!--/.bg-holder-->

            <div class="container">
                <div class="row align-items-center min-vh-75 min-vh-md-100">
                    <div class="col-md-7 col-lg-6 py-6 text-sm-start text-center">
                        <h1 class="mt-6 mb-sm-4 display-2 fw-semi-bold lh-sm fs-4 fs-lg-6 fs-xxl-8"><?=lang(112);?></h1>
                        <p class="mb-4 fs-1"><?=lang(113);?></p>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <div class="bg-holder"
                style="background-image:url(<?=BASE_URL('page/JoBest/');?>assets/img/illustrations/bg.png);background-position:left top;background-size:initial;margin-top:-180px;">
            </div>
            <!--/.bg-holder-->

            <div class="container">
                <div class="row flex-center">
                    <div class="col-md-5 order-md-0 text-center text-md-start"><img class="img-fluid mb-4"
                            src="<?=BASE_URL('page/JoBest/');?>assets/img/illustrations/passion.png" width="450"
                            alt="" /></div>
                    <div class="col-md-5 text-center text-md-start">
                        <h6 class="fw-bold fs-2 fs-lg-3 display-3 lh-sm"><?=lang(114);?></h6>
                        <p class="my-4 pe-xl-8"><?=lang(115);?></p>
                    </div>
                </div>
            </div>
        </section>


        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-8">

            <div class="container">
                <div class="row flex-center">
                    <div class="col-md-5 order-md-1 text-center text-md-end"><img class="img-fluid mb-4"
                            src="<?=BASE_URL('page/JoBest/');?>assets/img/illustrations/feature.png" width="450"
                            alt="" /></div>
                    <div class="col-md-5 text-center text-md-start">
                        <h6 class="fw-bold fs-2 fs-lg-3 display-3 lh-sm"><?=lang(117);?></h6>
                        <p class="my-4 pe-xl-8"><?=lang(118);?></p>
                    </div>
                </div>
            </div>
            <!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->


        <section class="py-0 bg-primary-gradient">
            <div class="bg-holder"
                style="background-image:url(<?=BASE_URL('page/JoBest/');?>assets/img/illustrations/footer-bg.png);background-position:center;background-size:cover;">
            </div>
            <!--/.bg-holder-->

            <div class="container">
                <div class="row flex-center py-8">
                    <div class="col-lg-6 mb-4 text-center">
                        <h1 class="text-white"><?=$CMSNT->site('tenweb');?></h1>
                    </div>
                </div>
                <div class="row justify-content-lg-between">
                    <div class="col-6 col-sm-4 col-lg-auto mb-3">
                        <h5 class="mb-5 text-white"><?=lang(121);?> </h5>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <?php foreach($CMSNT->get_list(" SELECT * FROM `category` WHERE `display` = 'SHOW' LIMIT 6 ") as $row){ ?>
                            <li class="mb-3"><a class="text-light text-decoration-none"
                                    href="<?=BASE_URL('Dashbroad');?>"><?=$row['title'];?></a></li>
                            <?php }?>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-auto mb-3">
                        <h5 class="mb-5 text-white"><?=lang(127);?> </h5>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <li class="mb-3"><a class="text-light text-decoration-none" target="_blank"
                                    href="https://www.cmsnt.co/">CMSNT.CO</a></li>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-auto mb-3">
                        <h5 class="mb-5 text-white">Fanpage </h5>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                        <div class="fb-page" data-href="<?=$CMSNT->site('fanpage');?>" data-tabs="timeline"
                            data-width="" data-height="200" data-small-header="false" data-adapt-container-width="false"
                            data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="<?=$CMSNT->site('fanpage');?>" class="fb-xfbml-parse-ignore"><a
                                    href="<?=$CMSNT->site('fanpage');?>">CMSNT.CO</a></blockquote>
                        </div>
                        </ul>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-auto mb-2">
                        <p class="mb-0 fs--1 text-white my-2 text-center">&copy; Đơn vị thiết kế web <a class="text-white" href="https://cmsnt.co/"
                                target="_blank">CMSNT.CO </a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <?=$CMSNT->site('script');?>
    <script src="<?=BASE_URL('page/JoBest/');?>vendors/@popperjs/popper.min.js"></script>
    <script src="<?=BASE_URL('page/JoBest/');?>vendors/bootstrap/bootstrap.min.js"></script>
    <script src="<?=BASE_URL('page/JoBest/');?>vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="<?=BASE_URL('page/JoBest/');?>assets/js/theme.js"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400&amp;display=swap"
        rel="stylesheet">
</body>

</html>