<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once(__DIR__."/../../includes/login.php");
    $title = lang(104).' | '.$CMSNT->site('tenweb');
    require_once("../../public/client/Header.php");
    if($CMSNT->site('status_top_nap') != 'ON')
    {
        die('Chức năng này đang bảo trì !');
    }
    require_once("../../public/client/Nav.php");
?>


<div class="content-i">
    <div class="content-box">
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-header"> <?=lang(105);?></div>
                    <div class="element-box-tp">
                        <div class="table-responsive">
                            <table class="table table-padded">
                                <thead>
                                    <tr>
                                        <th><?=lang(108);?></th>
                                        <th><?=lang(106);?></th>
                                        <th><?=lang(107);?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; foreach($CMSNT->get_list(" SELECT * FROM `users`  ORDER BY `total_money` DESC LIMIT 10 ") as $row){?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><b style="color: blue;">****<?=substr($row['username'], 4);?></b></td>
                                        <td><b style="color: red;"><?=format_cash($row['total_money']);?></b></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
    $(function() {
        $("#datatable").DataTable();
    });
    </script>


    <?php 
    require_once("../../public/client/Footer.php");
?>