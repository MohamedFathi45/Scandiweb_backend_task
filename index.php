<?php

use App\Config\MysqlDatabase;
use App\Models\Store;

require_once "vendor/autoload.php";


$mySql = new MysqlDatabase();
$store = new Store($mySql);

$products = $store->getProducts();



?>