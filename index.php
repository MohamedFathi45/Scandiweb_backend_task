<?php


header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

use App\Models\Store;

// if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
//     $res = array(
//         'status' =>'403',
//         'message' =>'Forbidden'
//     );
//     echo json_encode($res);
//     die();
// }

require_once "vendor/autoload.php";


$path = $_SERVER['PATH_INFO'];
if($path != null){
    $path_params = $path_params = explode (DIRECTORY_SEPARATOR, $path);
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(count($path_params) == 2 && $path_params[count($path_params)-1] == ""){
            $store = Store::getInstance();
            $products = $store->getProducts();
            $obj = json_encode($products);
            echo $obj;
        }
        else if(count($path_params) == 2 && $path_params[count($path_params)-1] == "products"){
            $store = Store::getInstance();
            $products = $store->getGeneralTypes();
            $ret['data'] = $products;
            echo json_encode($ret);
        }
        else{
            $res = array(
                'status' =>'403',
                'message' =>'Forbidden'
            );
            echo json_encode($res);
            die();
        }
    }
    else if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(count($path_params) == 2 && $path_params[count($path_params)-1] == "deleteproduct"){
            $input = file_get_contents("php://input");
            $obj = json_decode($input);
            $store = Store::getInstance();
            $store->deleteProducts($obj->data);
        }
        else if(count($path_params) == 2 && $path_params[count($path_params)-1] == "addproduct"){
            $input = file_get_contents("php://input");
            $obj = json_decode($input); //obj is array of feilds
            $row = json_decode(json_encode($obj), true);  
            $store = Store::getInstance();
            $store->addProduct($row);
        }
        else{
            $res = array(
                'status' =>'403',
                'message' =>'Forbidden'
            );
            echo json_encode($res);
            die();
        }
    }
    else{
        $res = array(
            'status' =>'403',
            'message' =>'Forbidden'
        );
        echo json_encode($res);
        die();
    }
}

?>