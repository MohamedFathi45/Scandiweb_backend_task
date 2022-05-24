<?php


namespace App\Models;
use PDO;
class Book extends Product{

    static $table = 'Book';
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
    static function getClassName(){
       return self::$table;
    }
}
?>