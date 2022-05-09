<?php
namespace App\Models;


use PDO;
abstract class Attribute{
    protected $type_id;
    protected $db;
    protected $attributes;
    protected static $map = array();
    abstract function read_type_attributes(); 
}


?>