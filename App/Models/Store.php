<?php

namespace App\Models;

class Store{
    private $databaseController;
    private $productTypes;
    public function __construct($dp){
        $this->databaseController = $dp;
        $this->productTypes = new ProductType($dp);
        //$book = new Book($this->databaseController  ,$this->productTypes->types); 
        //$dvd = new DVD($this->databaseController  ,$this->productTypes->types);
        $furniture = new Furniture($this->databaseController  ,$this->productTypes->types);
    }

}


?>