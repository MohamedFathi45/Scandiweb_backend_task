<?php
namespace App\Config;
abstract class Database{
    private $host = 'localhost';
    private $db_name = 'scandiweb_task';
    private $username = 'root';
    private $password = '';
    public $conn;

    abstract public function connect();
    abstract public function read_products();
    abstract public function read_types();
    abstract public function read_type_attributes($id );

    public function get_db_name(){
        return $this->db_name;
    }
    public function get_dp_host(){
        return $this->host;
    }
    public function get_dp_username(){
        return $this->username;
    }
    public function get_dp_password(){
        return $this->password;
    }
}

?>