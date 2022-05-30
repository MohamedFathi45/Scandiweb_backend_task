<?php


namespace App\Models;

use PDO;
class Furniture extends Product{
    static $table= "Furniture";
    protected static $attributes = array();
    protected static $map = array();
    function __construct($db){
        $this->db = $db;
        $this->type = self::$table;
        $this->attribute_reader = new AttributeReader(array_search(self::$table , ProductType::getInstance($this->db)->types) ,$this->db);
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    function readConreteAttribues(){
        $stmt = $this->db->readConreteAttribues($this->id);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $row['name'] = $this->attribute_reader->getTypeAttributes()[$row['attribute_id']];
            array_push($this->concreteAttributes , $row);
        }
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
        foreach($this->attribute_reader->getTypeAttributes() as $attribute){
            $row[$attribute];
            $attribute_id = array_search($attribute , $this->attribute_reader->getTypeAttributes());
            $attribute_value = $row[$attribute];
            $r = array();
            $r['attribute_id'] = $attribute_id;
            $r['value'] = $attribute_value;
            array_push($this->concreteAttributes , $r);
        }
    }
}
?>