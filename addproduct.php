<?php


header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

use App\Models\Store;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $res = array(
        'status' =>'403',
        'message' =>'Forbidden'
    );
    echo json_encode($res);
    die();
}

require_once "vendor/autoload.php";

$input = file_get_contents("php://input");
$product =  json_decode($input , true);
$store = Store::getInstance();
$store->addProduct($product);

?>