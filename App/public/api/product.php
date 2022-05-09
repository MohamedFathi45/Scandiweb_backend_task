<?php

require_once "vendor/autoload.php";


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"] == "OPTIONS") exit();

$path = $_SERVER['PATH_INFO'];
if($path){
   
}

?>