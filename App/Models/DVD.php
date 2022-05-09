<?php


namespace App\Models;

use PDO;

class DVD extends Product{

    protected static $map = array();
    protected static $attributes = array();
    function __construct($db , $types){
        $this->productTypes = $types;
        $this->db = $db;
        self::$table = "DVD";
        $this->attribute_reader = new AttributeReader($this->productTypes[self::$table] ,$this->db);
    }
    function createProduct($type){
        
    }



}
?>