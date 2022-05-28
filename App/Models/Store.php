<?php

namespace App\Models;

use App\Config\MysqlDatabase;



class Store{
    private static $instance = null;
    private $databaseController;
    protected $factory;
    private function __construct(){
        $this->databaseController =  new MysqlDatabase();
        $this->factory = new ProductFactory($this->databaseController);
    }
    public function getProducts(){
      
        return Product::getProducts($this->databaseController ,$this->factory);
    }
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new Store();
        }
        return self::$instance;
    }

    public function getGeneralTypes(){
        $products = Product::getGeneralTypes($this->databaseController);
        return $products;
    }
    public function deleteProducts($productsId){
        Product::deleteProducts($this->databaseController,$productsId);
    }

    public function addProduct($product){       // product at this time is array
        //Product::addProduct($product);
    }
}


?>