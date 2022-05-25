<?php

namespace App\Models;


abstract class Factory{

    public function getProduct($type , $row){
        $product = $this->createProduct($type);
        extract($row);
        $product->setId($id);
        $product->setName($name);
        $product->setSku($sku);
        $product->setPrice($price);
        $product->readConreteAttribues();
        $product->setDisplayString();
        return $product;
    }

    abstract function createProduct($type);    

}

?>