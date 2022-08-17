<div id="thongbao"></div>

<footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
        Phiên bản <b style="color:green;"><?=$config['version'];?></b>
    </div>
    <strong>Copyright &copy; 2019-2021 <a href="https://www.cmsnt.co/" target="_blank">CMSNT.CO</a>.</strong> All rights
    reserved.
</footer>
</div>
<!-- jQuery -->
<script src="<?=BASE_URL('template/');?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=BASE_URL('template/');?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=BASE_URL('template/');?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?=BASE_URL('template/');?>plugins/chart.js/Chart.min.js"></script>

<!-- JQVMap -->
<script src="<?=BASE_URL('template/');?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?=BASE_URL('template/');?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=BASE_URL('template/');?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?=BASE_URL('template/');?>plugins/moment/moment.min.js"></script>
<script src="<?=BASE_URL('template/');?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=BASE_URL('template/');?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
</script>
<!-- Summernote -->
<script src="<?=BASE_URL('template/');?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=BASE_URL('template/');?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=BASE_URL('template/');?>dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=BASE_URL('template/');?>dist/js/pages/dashboard.js"></script>
<!-- Ekko Lightbox -->
<script src="<?=BASE_URL('template/');?>plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- DataTables -->
<script src="<?=BASE_URL('template/');?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=BASE_URL('template/');?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=BASE_URL('template/');?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=BASE_URL('template/');?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<script>
new ClipboardJS('.copy');
</script>
</body>
</html>

<script type="text/javascript">
$.ajax({
    url: "<?=BASE_URL('Update.php');?>",
    type: "GET",
    dateType: "text",
    data: {},
    success: function(result) {
            
    }
});
</script>