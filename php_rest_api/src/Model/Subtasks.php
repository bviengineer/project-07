<?php
namespace App\Model;

class Subtasks 
{
    protected $db;

    public function __construct(\PDO $database)
    {
        $this->db = $database;
    }
    // Retrieves all Todos
    public function getSubtasks() 
    {
        $sqlStmt = 'SELECT * FROM subtasks ORDER BY id';
        $result = $this->db->prepare($sqlStmt);
        $result->execute();
        return $result->fetchAll();
    }
    // Retrieves a single subtask
    public function getSubtask($taskId) 
    {
        $sqlStmt = 'SELECT * FROM tasks WHERE task_id = :taskId';
        $result = $this->db->prepare($sqlStmt);
        $result->bindParam(':taskId', $taskId, \PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }
    // Create a subtask
    public function createSubtask($subtask) 
    {
        $sqlStmt = 'INSERT INTO subtasks(name, status) VALUES(:name, :status)';
        $result = $this->db->prepare($sqlStmt);
        $result->bindParam(':name', $subtask['name'], \PDO::PARAM_STR);
        $result->bindParam(':status', $subtask['status'], \PDO::PARAM_INT);
       // $result->bindParam(':taskId', $subtask['task_id'], \PDO::PARAM_INT);
        $result->execute();
        return $this->getSubtask($this->db->lastInsertId());
    }
    // Update a Todo
    // public function updateTodo($todo) 
    // {
    //     $sqlStmt = 'UPDATE tasks SET task = :task, status = :status WHERE id = :id';
    //     $result = $this->db->prepare($sqlStmt);
    //     $result->bindParam(':id', $todo['id'], \PDO::PARAM_INT);
    //     $result->bindParam(':task', $todo['task'], \PDO::PARAM_STR);
    //     $result->bindParam(':status', $todo['status'], \PDO::PARAM_INT);
    //     $result->execute();
    //     return $this->getTodo($todo['id']);
    // }
    // // Delete a Todo
    // public function deleteTodo($todoId) 
    // {
    //     $sqlStmt = 'DELETE FROM tasks WHERE id = :id';
    //     $result = $this->db->prepare($sqlStmt);
    //     $result->bindParam(':id', $todoId, \PDO::PARAM_INT);
    //     $result->execute();
    //     return ['message' => 'That item has been removed from the list'];
    // }
}
