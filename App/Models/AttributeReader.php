<?php
namespace App\Models;

use PDO;
class AttributeReader extends Attribute{

    function __construct($id , $db){
        $this->type_id = $id;
        $this->db = $db;
        $this->read_type_attributes();
    }

    function read_type_attributes(){
        $stmt =$this->db->read_type_attributes($this->type_id);
        $this->destructure_attributes($stmt);
    }

    public function destructure_attributes($arr){
        while ($row = $arr->fetch(PDO::FETCH_NUM)) {
            $this->attributes[$row[1]] = $row[0];
            echo ( $row[1]);
            array_push(self::$map , $row[1]);
          }
    }
}

?>