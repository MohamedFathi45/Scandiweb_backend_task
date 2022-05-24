<?php
namespace App\Config;

use PDO;
use PDOException;
class MysqlDatabase extends Database{       // mysql database controller


    function __construct()
    {
        $this->connect();
    }

    public function connect() {
        
        $this->conn = null;
        try{
            $this->conn = new PDO('mysql:host=localhost;dbname=scandiweb_task', 'root', '');
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES ,true);
            $this->conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY , true);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

            
        } catch(PDOException $e){
            echo 'Connection Error!' . $e->getMessage();
        }
        
    }


    
    function read_products()
    {
        $query = 'SELECT * FROM product ';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt; 
    }

    function read_types()
    {
        $query = 'SELECT * FROM product_type';   
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }



    public function read_type_attributes($id){   //id for the type;
        $query = "SELECT * FROM attributes WHERE id = ANY(SELECT attribute_id FROM attribute_type_matching WHERE type_id =:id)";   
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);   
        return $stmt; 
    }

    public function readConreteAttribues($id){
       
        $query = "SELECT * FROM attribute_values WHERE id = ANY(select attribute_value_id from product_details where product_id = :id)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);   
        return $stmt; 
    }

}

?>