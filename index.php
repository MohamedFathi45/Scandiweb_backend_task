<?php


header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

use App\Models\Router;
use App\Models\Store;


require_once "vendor/autoload.php";

$router = new Router();
$router->get('/' , function (){
    $store = Store::getInstance();
    $products = $store->getProducts();
    $obj = json_encode($products);
    echo $obj;
});

$router->get('/products' , function (){
    $store = Store::getInstance();
    $products = $store->getGeneralTypes();
    $ret['data'] = $products;
    echo json_encode($ret);
});
$router->post('/addproduct' , function(){
    $input = file_get_contents("php://input");
    $obj = json_decode($input); //obj is array of feilds
    $row = json_decode(json_encode($obj), true);  
    $store = Store::getInstance();
    $store->addProduct($row);
});
$router->post('/deleteproduct' , function(){
    $input = file_get_contents("php://input");
    $obj = json_decode($input);
    $store = Store::getInstance();
    $store->deleteProducts($obj->data);
});


$router->run();


?>