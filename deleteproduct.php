<?php

use App\Models\Store;

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    $res = array(
        'status' =>'403',
        'message' =>'Forbidden'
    );
    echo json_encode($res);
    die();
}

require_once "vendor/autoload.php";

$input = file_get_contents("php://input");
$productsId =  json_decode($input , true);
$store = Store::getInstance();
$store->deleteProducts($productsId);

?>