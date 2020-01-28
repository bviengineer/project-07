<?php
namespace App\Model;

class Subtasks 
{
    protected $db;

    public function __construct(\PDO $database)
    {
        $this->db = $database;
    }
    // Retrieves all subtasks for a specific todo
    public function getSubtasks($taskId) 
    {
        $sqlStmt = 'SELECT * FROM subtasks WHERE task_id = :taskId ORDER BY id';
        $result = $this->db->prepare($sqlStmt);
        $result->bindParam(':taskId', $taskId, \PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll();
    }
    // Retrieves a single subtask based on task_id which matched the todo id
    // public function getSubtask($taskId) 
    // {
    //     $sqlStmt = 'SELECT * FROM subtasks WHERE task_id = :taskId';
    //     $result = $this->db->prepare($sqlStmt);
    //     $result->bindParam(':taskId', $taskId, \PDO::PARAM_INT);
    //     $result->execute();
    //     return $result->fetch();
    // }
    // Get a subtask for a todo by the subtask id
    public function getSubtaskById($id) 
    {
        $sqlStmt = 'SELECT * FROM subtasks WHERE id = :id';
        $result = $this->db->prepare($sqlStmt);
        $result->bindParam(':id', $id, \PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }
    // Create a subtask
    public function createSubtask($subtask) 
    {
        $sqlStmt = 'INSERT INTO subtasks(name, status, task_id) VALUES(:name, :status, :task_id)';
        $result = $this->db->prepare($sqlStmt);
        // $result->bindParam(':id', $subtask['id'], \PDO::PARAM_INT);
        $result->bindParam(':name', $subtask['name'], \PDO::PARAM_STR);
        $result->bindParam(':status', $subtask['status'], \PDO::PARAM_INT);
        $result->bindParam(':task_id', $subtask['task_id'], \PDO::PARAM_INT);
        $result->execute();
        return $this->getSubtaskById($this->db->lastInsertId());
    }
    // Update a subtask based on the subtask's id
    public function updateSubtask($subtask) 
    {
        $sqlStmt = 'UPDATE subtasks SET name = :name, status = :status, task_id = :taskId WHERE id = :id';
        $result = $this->db->prepare($sqlStmt);
        $result->bindParam(':id', $subtask['id'], \PDO::PARAM_INT);
        $result->bindParam(':name', $subtask['name'], \PDO::PARAM_STR);
        $result->bindParam(':status', $subtask['status'], \PDO::PARAM_INT);
        $result->bindParam(':taskId', $subtask['task_id'], \PDO::PARAM_INT);
        $result->execute();
        return $this->getSubtaskById($subtask['id']);
    }
    // Delete a subtask
    public function deleteSubtask($id) 
    {
        $sqlStmt = 'DELETE FROM subtasks WHERE id = :id';
        $result = $this->db->prepare($sqlStmt);
        $result->bindParam(':id', $id, \PDO::PARAM_INT);
        $result->execute();
        return ['message' => 'That item has been removed from the list'];
    }
}