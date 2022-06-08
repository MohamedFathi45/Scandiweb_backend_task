<?php

namespace App\Models;

class ProductFactory extends Factory
{

    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createProduct($type)
    { //returns product
        if (strcmp($type, DVD::getClassName()) == 0) {
            return new DVD($this->db);
        } else if (strcmp($type, Furniture::getClassName()) == 0) {
            return new Furniture($this->db);
        } else if (strcmp($type, Book::getClassName()) == 0) {
            return new Book($this->db);
        }
    }

}
