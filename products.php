<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

use App\Models\Store;

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    $res = array(
        'status' =>'403',
        'message' =>'Forbidden'
    );
    echo json_encode($res);
    die();
}
require_once "vendor/autoload.php";

$store = Store::getInstance();
$products = $store->getGeneralTypes();

$ret['data'] = $products;
echo json_encode($ret);

?>