<?php

namespace App\Views;

use App\Controllers\Controller;
use App\Controllers\ProductController;
use App\Models\Router;

class Store
{
    private static $instance = null;
    public Router $router;
    protected Controller $controller;
    private function __construct()
    {
        $this->router = new Router();
        $this->controller = new ProductController();
    }
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Store();
        }
        return self::$instance;
    }

    public function getProducts()
    {
        return $this->controller->getProducts();
    }
    public function getGeneralTypes()
    {
        return $this->controller->getGeneralTypes();
    }
    public function deleteProducts($productsId)
    {
        $this->controller->deleteProducts($productsId);
    }

    public function addProduct($product)
    { // product at this time is array
        $this->controller->addProduct($product);
    }
}
