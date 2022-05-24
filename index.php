<?php


header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

use App\Config\MysqlDatabase;
use App\Models\Store;

require_once "vendor/autoload.php";


$mySql = new MysqlDatabase();
$store = new Store($mySql);

$products = $store->getProducts();

$obj = json_encode($products);
echo $obj;


?>