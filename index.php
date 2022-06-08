<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

use App\Views\Store;

require_once "vendor/autoload.php";

$app = Store::getInstance();
$app->router->get('/scandiweb_task', function () {
    $store = Store::getInstance();
    $products = $store->getProducts();
    $obj = json_encode($products);
    echo $obj;
});

$app->router->get('/scandiweb_task/products', function () {
    $store = Store::getInstance();
    $products = $store->getGeneralTypes();
    $ret['data'] = $products;
    echo json_encode($ret);
});
$app->router->post('/scandiweb_task/addproduct', function () {
    $input = file_get_contents("php://input");
    $obj = json_decode($input); //obj is array of feilds
    $row = json_decode(json_encode($obj), true);
    $store = Store::getInstance();
    $store->addProduct($row);
});
$app->router->post('/scandiweb_task/deleteproduct', function () {
    $input = file_get_contents("php://input");
    $obj = json_decode($input);
    $store = Store::getInstance();
    $store->deleteProducts($obj->data);
});

$app->router->run();
