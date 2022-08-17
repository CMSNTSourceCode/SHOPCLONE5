<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */
require_once __DIR__.'/../../../config/config.php';
require_once __DIR__.'/../../../config/function.php';
require_once __DIR__.'/../../../includes/login-admin.php';

$data = [];
$i = 0;
foreach($CMSNT->get_list("SELECT * FROM `api_domains` ORDER BY id DESC ") as $list_api)
{
    $getCategory = curl_get($list_api['domain'].'/api/ListResource.php?username='.$list_api['username'].'&password='.$list_api['password']);
    $getCategory = json_decode($getCategory, true);
    foreach($getCategory['categories'] as $row)
    {
        $data[] = [
            'stt' => $i++,
            'name' => $row['name'],
            'action' => 
            $CMSNT->get_row("SELECT * FROM `hide_category_api` WHERE `category_id` = '".$row['id']."' AND `domain` = '".$list_api['domain']."' ") ? 
            '<a href="'.BASE_URL('public/admin/tich-hop.php?hide_category_api='.$row['id'].'&domain='.$list_api['domain']).'" class="btn btn-success btn-sm"><i class="fas fa-eye mr-1"></i>Hiển Thị</a>' : 
            '<a href="'.BASE_URL('public/admin/tich-hop.php?hide_category_api='.$row['id'].'&domain='.$list_api['domain']).'" class="btn btn-danger btn-sm"><i class="fas fa-eye mr-1"></i>Ẩn</a>'
        ];
    }
} 


echo json_encode(['data' => $data], JSON_PRETTY_PRINT);