<body class="hold-transition <?=$CMSNT->site('darkmode');?>-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-<?=$CMSNT->site('darkmode');?>">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?=BASE_URL('');?>" class="nav-link">HOME</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="https://www.cmsnt.co/" target="_blank" class="nav-link">LIÊN HỆ</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="https://zalo.me/g/idapcx933" target="_blank" class="nav-link">HỖ TRỢ ZALO</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="https://www.youtube.com/playlist?list=PLylqe6Lzq69-TzmQ6kLzTg8ZkrxJxxtZm" target="_blank"
                        class="nav-link">HƯỚNG DẪN YOUTUBE</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a type="button" onclick="DarkMode()" id="DarkMode" class="nav-link"><?=$CMSNT->site('darkmode') == 'light' ? 'BẬT GIAO DIỆN TỐI' : 'BẬT GIAO DIỆN SÁNG';?></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <script type="text/javascript">
        $("#DarkMode").on("click", function() {
            $('#DarkMode').html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled',
                true);
            $.ajax({
                url: "<?=base_url('assets/ajaxs/admin/darkmode.php');?>",
                method: "GET",
                dataType: "JSON",
                data: {},
                success: function(respone) {
                    if (respone.status == 'success')
                    {
                        setTimeout("location.href = '';", 100);
                    } else {
                        alert(respone.msg);
                    }
                },
                error: function() {
                    
                }
            });
        });
        </script>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="<?=BASE_URL('Admin/Home');?>" class="brand-link">
                <center><img src="https://i.imgur.com/DdqzQYA.png" alt="CMSNT.CO" width="100%"></center>
            </a>
            <div class="sidebar">
            <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview menu-open">
                            <a href="<?=BASE_URL('Admin/Home');?>" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">QUẢN LÝ</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-bars"></i>
                                <p>
                                    Quản lý khách hàng
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=BASE_URL('Admin/Users');?>" class="nav-link">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>
                                            Thành viên
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=BASE_URL('Admin/Orders');?>" class="nav-link">
                                        <i class="nav-icon fas fa-shopping-cart"></i>
                                        <p>
                                            Đơn hàng
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=BASE_URL('Admin/Promotion');?>" class="nav-link">
                                        <i class="nav-icon fas fa-percentage"></i>
                                        <p>
                                            Khuyến mãi
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">SẢN PHẨM</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-bars"></i>
                                <p>
                                    Danh mục
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?=BASE_URL('Admin/Category');?>" class="nav-link">
                                        <i class="nav-icon fas fa-folder-open"></i>
                                        <p>
                                            Category
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=BASE_URL('Admin/Danhmuc/Add');?>" class="nav-link">
                                        <i class="nav-icon fas fa-folder-plus"></i>
                                        <p>
                                            Thêm sản phẩm
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?=BASE_URL('Admin/Danhmuc/Taikhoan');?>" class="nav-link">
                                        <i class="nav-icon fas fa-folder-open"></i>
                                        <p>
                                            Quản lý sản phẩm
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">LƯU TRỮ</li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Storage');?>" class="nav-link">
                                <i class="nav-icon fas fa-cloud-upload-alt"></i>
                                <p>
                                    Upload backup
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">THANH TOÁN</li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Bank');?>" class="nav-link">
                                <i class="nav-icon fas fa-university"></i>
                                <p>
                                    Ngân hàng
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Nap-The');?>" class="nav-link">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>
                                    Nạp thẻ
                                </p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Thesieure');?>" class="nav-link">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>
                                    Thẻ siêu rẻ
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">CÀI ĐẶT</li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('public/admin/tich-hop.php');?>" class="nav-link">
                                <i class="nav-icon fas fa-wifi"></i>
                                <p>
                                    Kết nối
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Language');?>" class="nav-link">
                                <i class="nav-icon fas fa-language"></i>
                                <p>
                                    Ngôn ngữ
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Setting');?>" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Cấu hình
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>