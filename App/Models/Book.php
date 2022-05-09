<?php


namespace App\Models;

use PDO;

class Book extends Product{

    protected static $attributes = array();
    protected static $map = array();
    function __construct($db , $type){
        $this->productTypes = $type;
        self::$table= "Book";
        $this->db = $db;
        $this->attribute_reader = new AttributeReader($this->productTypes[self::$table] ,$this->db);
    }

    function createProduct($type){
        
    }


}
?>