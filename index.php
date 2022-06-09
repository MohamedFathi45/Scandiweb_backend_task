<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

use App\Views\Store;

require_once "vendor/autoload.php";

$app = Store::getInstance();
$app->router->get('/scandiweb_task/index.php', function () use ($app){
    $app->getProducts();
});

$app->router->get('/scandiweb_task/index.php/products', function ()use ($app) {
    $app->getGeneralTypes();
});
$app->router->post('/scandiweb_task/index.php/addproduct', function ()use ($app) {
    $input = file_get_contents("php://input");
    $app->addProduct($input);
});
$app->router->post('/scandiweb_task/index.php/deleteproduct', function ()use ($app) {
    $input = file_get_contents("php://input");
    $app->deleteProducts($input);
});

$app->router->run();
