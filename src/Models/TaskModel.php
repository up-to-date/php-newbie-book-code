<?php
namespace App\Models;

class TaskModel
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}