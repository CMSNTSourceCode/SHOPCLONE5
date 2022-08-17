<!-- MÃ NGUỒN SHOPCLONE5 PHIÊN BẢN <?=$config['version'];?> ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <link rel="icon" type="image/png" href="<?=$CMSNT->site('favicon');?>">
    <title><?=$title;?></title>
    <meta name="description" content="<?=$CMSNT->site('mota');?>">
    <meta name="keywords" content="<?=$CMSNT->site('tukhoa');?>">
    <!-- Open Graph data -->
    <meta property="og:title" content="<?=$CMSNT->site('tenweb');?>">
    <meta property="og:type" content="Website">
    <meta property="og:url" content="<?=BASE_URL('');?>">
    <meta property="og:image" content="<?=$CMSNT->site('anhbia');?>">
    <meta property="og:description" content="<?=$CMSNT->site('mota');?>">
    <meta property="og:site_name" content="<?=$CMSNT->site('tenweb');?>">
    <meta property="article:section" content="<?=$CMSNT->site('mota');?>">
    <meta property="article:tag" content="<?=$CMSNT->site('tukhoa');?>">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="<?=$CMSNT->site('anhbia');?>">
    <meta name="twitter:site" content="CMSNT">
    <meta name="twitter:title" content="<?=$CMSNT->site('tenweb');?>">
    <meta name="twitter:description" content="<?=$CMSNT->site('mota');?>">
    <meta name="twitter:creator" content="CMSNT">
    <meta name="twitter:image:src" content="<?=$CMSNT->site('anhbia');?>">
    <link href="<?=BASE_URL('template/');?>cssapi/487b73f1-c2d1-43db-8526-db577e4c822b.css" rel="stylesheet">
    <link href="<?=BASE_URL('template/');?>bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="<?=BASE_URL('template/');?>bower_components/bootstrap-daterangepicker/daterangepicker.css"
        rel="stylesheet">
    <link href="<?=BASE_URL('template/');?>bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="<?=BASE_URL('template/');?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"
        rel="stylesheet">
    <link href="<?=BASE_URL('template/');?>bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="<?=BASE_URL('template/');?>bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css"
        rel="stylesheet">
    <link href="<?=BASE_URL('template/');?>bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="<?=BASE_URL('template/');?>css/main.css?version=4.5.0" rel="stylesheet">
    <link rel="stylesheet" href="<?=BASE_URL('template/');?>sweetalert2/default.css">
    <script src="<?=BASE_URL('template/');?>sweetalert2/sweetalert2.js"></script>
    <script src="<?=BASE_URL('template/');?>jquery.min.js"></script>
    <style>
    .menu-w.sub-menu-style-over .sub-menu-w{background-color:<?=$CMSNT->site('theme_color');?>;}
    .top-bar .logged-user-w .logged-user-menu{background:<?=$CMSNT->site('theme_color');?>;}
    .menu-w .logged-user-menu.color-style-bright{background-color:<?=$CMSNT->site('theme_color');?>;}

    
    </style>
</head>