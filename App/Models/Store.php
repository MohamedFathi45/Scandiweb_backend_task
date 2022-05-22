<?php

namespace App\Models;


class Store{
    private $databaseController;
    public function __construct($dp){
        $this->databaseController = $dp;
    }
    public function getProducts(){
        $factory = new ProductFactory($this->databaseController);
        return Product::getProducts($this->databaseController ,$factory);
    }
}


?>