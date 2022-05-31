<?php
namespace App\Models;

abstract class Attribute{
    protected $type_id;
    protected $db;
    protected $attributes;
    abstract function read_type_attributes(); 

    function getTypeAttributes(){
        return $this->attributes;
    }
}


?>