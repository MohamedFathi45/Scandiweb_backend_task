<?php


namespace App\Models;
use PDO;
class Book extends Product{

    static $table = 'Book';
    protected static $attributes = array();
    function __construct($db){
        $this->db = $db;
        $this->type = self::$table;
        $this->attribute_reader = new AttributeReader(array_search(self::$table , ProductType::getInstance($this->db)->types) ,$this->db);
        $this->concreteAttributeReader = new ConcreteAttributeReader();
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    function readConreteAttribues(){
        $this->concreteAttributes = $this->concreteAttributeReader->read_concrete_attributes($this);
    }
    function setProductAttributes($row){
        $this->concreteAttributes = $this->concreteAttributeReader->setProductAttributes($this ,$row);
    }
    static function getClassName(){
       return self::$table;
    }
    function setDisplayString(){
        $this->displayString =  'Weight :' .$this->concreteAttributes[0]['value'].' KG';
    }
}
?>