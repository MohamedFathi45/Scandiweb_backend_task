<?php


namespace App\Models;

use PDO;

class Furniture extends Product{
    protected static $attributes = array();
    protected static $map = array();
    function __construct($db , $types){
        $this->productTypes = $types;
        self::$table= "Furniture";
        $this->db = $db;
        $this->attribute_reader = new AttributeReader($this->productTypes[self::$table] ,$this->db);
    }

    function createProduct($type){
        
    }

}
?>