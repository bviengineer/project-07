<?php
namespace App\Model;

class Todo 
{
    protected $db;

    public function __construct(\PDO $database)
    {
        $this->db = $database;
    }
    // Retrieves all Todos
    public function getTodos() 
    {
        $sqlStmt = 'SELECT * FROM tasks ORDER BY id';
        $result = $this->db->prepare($sqlStmt);
        $result->execute();
        return $result->fetchAll();
    }
    // Retrieves a single Todo
    public function getTodo($todoId) 
    {
        $sqlStmt = 'SELECT * FROM tasks WHERE id = :id';
        $result = $this->db->prepare($sqlStmt);
        $result->bindParam(':id', $todoId, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }
}
