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
        $result->bindParam(':id', $todoId);
        $result->execute();
        return $result->fetch();
    }
    // Create a Todo
    public function createTodo($todo) 
    {
        $sqlStmt = 'INSERT INTO tasks(task, status) VALUES(:task, :status)';
        $result = $this->db->prepare($sqlStmt);
        $result->bindParam(':task', $todo['task']);
        $result->bindParam(':id', $todo['status'],);
        $result->execute();
        return $this->getTodo($this->db->lastInsertId());
    }
    // Update a Todo
    public function updateTodo($todo) 
    {
        $sqlStmt = 'UPDATE tasks SET task = :task, status = :status WHERE id = :id';
        $result = $this->db->prepare($sqlStmt);
        $result->bindParam(':id', $todo['id']);
        $result->bindParam(':task', $todo['task']);
        $result->bindParam(':id', $todo['status']);
        $result->execute();
        return $this->getTodo($todo['id']);
    }
    // Delete a Todo
    public function deleteTodo($todoId) 
    {
        $sqlStmt = 'DELETE FROM tasks WHERE id = :id';
        $result = $this->db->prepare($sqlStmt);
        $result->bindParam(':id', $todoId);
        $result->execute();
        return ['message' => 'That item has been removed from the list'];
    }
}
