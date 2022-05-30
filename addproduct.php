<?php


header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

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
$obj = json_decode($input); //obj is array of feilds
$row = json_decode(json_encode($obj), true);

 $store = Store::getInstance();
 $store->addProduct($row);



?>