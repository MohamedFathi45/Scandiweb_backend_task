<?php

namespace App\Models;
use PDO;

 abstract class Product{

    protected static $products = array();
    public $db;
    protected $id;
    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    protected $concreteAttributes = array();
    protected $attribute_reader;
 
    static function getProducts($db , $factory){
        $stmt = $db->read_products();
        while($row = $stmt->fetch(  PDO::FETCH_ASSOC  )){
            extract($row);
            $product = $factory->getProduct(ProductType::getInstance($db)->types[$row['product_type_id']] , $row);
            array_push(self::$products , $product);
        }

        return self::$products;
    }

    function getConcreteAttributes(){
        return $this->concreteAttributes;
    }
    function getId(){return $this->id;}
    function getName(){return $this->name;}
    function getSku(){return $this->sku;}
    function getPrice(){return $this->price;}
    function getType(){return $this->type;}



    function setId($id){$this->id = $id;}
    function setSku($sku){$this->sku = $sku;}
    function setName($name){$this->name = $name;}
    function setPrice($price){$this->price = $price;}
    abstract static function getClassName();
    abstract function readConreteAttribues();
    //abstract function getDisplayString();   // every product should have attributes to display (ie size , weight ,...etc)
}

?>