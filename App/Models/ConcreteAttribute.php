<?php
namespace App\Models;

abstract class ConcreteAttribute{

    abstract function read_concrete_attributes($product);
    abstract function setProductAttributes($product , $row);
}


?>