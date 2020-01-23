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
    // Creates a Todo
    public function createTodo($todoId) 
    {
        $sqlStmt = 'INSERT INTO tasks(task, status) VALUES(:task, :status)';
        $result = $this->db->prepare($sqlStmt);
        $result->bindParam(':task', $todoId['task'], PDO::PARAM_STR);
        $result->bindParam(':id', $todoId['status'], PDO::PARAM_INT);
        $result->execute();
        return $this-getTodo($this->db->lastInsertId());
    }
}
