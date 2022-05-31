<?php


use App\Models\Store;

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');



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

$obj = json_decode($input);

$store = Store::getInstance();
$store->deleteProducts($obj->data);



?>