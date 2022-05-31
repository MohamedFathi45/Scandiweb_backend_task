<?php


namespace App\Models;

use PDO;
class Furniture extends Product{
    static $table= "Furniture";
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
    function setDisplayString(){
        $height_value = $this->getProp('height');// iterating over the list O(n) "n most likely to be less than 50"
        $width_value = $this->getProp('width');
        $length_value = $this->getProp('length');
        
        $this->displayString =  'Dimensions: ' .$height_value.'x' . $width_value .'x'. $length_value.' CM';
    }
    static function getClassName(){
        return self::$table;
    }
    function getProp($prop){        
        foreach($this->concreteAttributes  as $element) {
            if($element['name'] == $prop){
                return $element['value'];
            }
        }
    }
    function setProductAttributes($row){
        $this->concreteAttributes = $this->concreteAttributeReader->setProductAttributes($this ,$row);
    }
}
?>