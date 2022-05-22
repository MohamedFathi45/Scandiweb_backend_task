<?php


namespace App\Models;

class DVD extends Product{

    static $table = 'DVD';
    protected static $map = array();
    protected static $attributes = array();
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

    static function getClassName(){
        return self::$table;
    }
    
}
?>