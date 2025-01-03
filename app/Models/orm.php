<?php
namespace App\Models;

use App\config\Connection;
use PDO;

class ORM {
    private $table; 
    protected $connection;

    public function __construct() {
        $this->connection = Connection::connect();
    }

    public function setTable($table) {
        $this->table = $table; 
    }

    public function read() {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->connection->prepare($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
