<?php


namespace App\Models;


class Furniture extends Product{
    static $table= "Furniture";
    protected static $attributes = array();
    protected static $map = array();
    function __construct($db){
        $this->db = $db;
        $this->type = self::$table;
        $this->attribute_reader = new AttributeReader(array_search(self::$table , ProductType::getInstance($this->db)->types) ,$this->db);
    }

    function readConreteAttribues(){
        $stmt = $this->db->readConreteAttribues($this->id);
        while($row = $stmt->fetch()){
            array_push($this->concreteAttributes , $row);
        }
    }
    function getDisplayString(){
        return 'Dimensions: ' .$this->concreteAttributes['length'].'x' . $this->concreteAttributes['width'] .'x'. $this->concreteAttributes['height'];
    }
    static function getClassName(){
        return self::$table;
    }
}
?>