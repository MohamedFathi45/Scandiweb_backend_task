<?php

namespace App\Models;

use PDO;

class ProductType{


    public $types = array();
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
        $stmt = $this->db->read_types();
        $this->destructure_types($stmt);
    }
    public function destructure_types($arr){
        while ($row = $arr->fetch(PDO::FETCH_NUM)) {
            $this->types[$row[1]] = $row[0];
          }
    }

}

?>