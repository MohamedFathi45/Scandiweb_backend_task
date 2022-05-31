<?php

namespace App\Models;

use JsonSerializable;
use PDO;

 abstract class Product implements JsonSerializable{

    protected static $products = array();
    public $db;
    protected $id;
    protected $sku;
    protected $name;
    protected $price;
    protected $type;
    protected $displayString;
    protected $concreteAttributeReader;
    protected $concreteAttributes = array();
    public $attribute_reader;
 
    static function getProducts($db , $factory){
        $stmt = $db->read_products();
        while($row = $stmt->fetch(  PDO::FETCH_ASSOC  )){
            extract($row);
            $product = $factory->getProduct(ProductType::getInstance($db)->types[$row['product_type_id']] , $row);
            array_push(self::$products , $product);
        }
        $arr['data'] = self::$products;
        return $arr;
    }

    static function getGeneralTypes($db){
        $products = array();
        foreach(ProductType::getInstance($db)->types as $productKey => $productValue){
            $calssName = 'App\\Models\\'. ($productValue);
            $product = new $calssName($db);
            
            $products[$productValue] = array();
            foreach ($product->attribute_reader->getTypeAttributes() as $attributeKey =>$attributeValue){
                array_push($products[$productValue] , $attributeValue);
            }
        }
        return $products;
    }

    static function addProduct($row , $db , $factory){       // product is array of product attributes
        $product = $factory->setProduct($row['type'] , $row);
        //echo json_encode($product);
        $db->addProduct($product);
    }

    static function deleteProducts($db ,$productsId){ 
         $stmt = $db->deleteProducts($productsId);
    }

    

    function getConcreteAttributes(){return $this->concreteAttributes;}
    function getId(){return $this->id;}
    function getName(){return $this->name;}
    function getSku(){return $this->sku;}
    function getPrice(){return $this->price;}
    function getType(){return $this->type;}

    function setId($id){$this->id = $id;}
    function setSku($sku){$this->sku = $sku;}
    function setName($name){$this->name = $name;}
    function setPrice($price){$this->price = $price;}
    function setType($type){$this->type =  $type;}
    
    abstract static function getClassName();
    abstract function readConreteAttribues();
    abstract function setProductAttributes($row);
    abstract function setDisplayString();   // every product should have attributes to display (ie size , weight ,...etc)
}

?>