<?php
namespace App\Model;

class Todo 
{
    protected $db;

    public function __construct(\PDO $database)
    {
        $this->db = $database;
    }

    public function getTodos() 
    {
        $sqlStmt = 'SELECT * FROM tasks ORDER BY id';
        $result = $this->db->prepare($sqlStmt);
        $result->execute();
        return $result->fetchAll();
    }
}
