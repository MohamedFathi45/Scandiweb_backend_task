<?php

namespace App\Controllers;

use App\Config\MysqlDatabase;
use App\Models\Product;
use App\Models\ProductFactory;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->databaseController = new MysqlDatabase();
        $this->factory = new ProductFactory($this->databaseController);
    }

    public function deleteProducts($productsId)
    {
        Product::deleteProducts($this->databaseController, $productsId);
    }
    public function addProduct($product)
    {
        Product::addProduct($product, $this->databaseController, $this->factory);
    }
    public function getGeneralTypes()
    {
        return Product::getGeneralTypes($this->databaseController);
    }
    public function getProducts()
    {
        return Product::getProducts($this->databaseController, $this->factory);
    }
}
