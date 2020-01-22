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
        $results = $this->db->prepare($sqlStmt);
        $results->execute();
        return $results->fetchAll();
    }
}
