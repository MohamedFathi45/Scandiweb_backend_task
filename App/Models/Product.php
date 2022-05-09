<?php

namespace App\Models;


 abstract class Product{

    public $db;
    public static $table = 'Product';
    protected $id;
    protected $sku;
    protected $name;
    protected $price;
    protected $productTypes;
    protected $attribute_reader;

    abstract function createProduct($type);
    
}

?>