<?php
namespace App\Controllers;

use Interop\Container\ContainerInterface;

class TaskController
{
    protected $ci;

    public function __construct(ContainerInterface $ci) {
        $this->ci = $ci;
    }

    public function index($request, $response)
    {
        $tasks = $this->ci->TaskModel->all();
        $response = $this->ci->view->render($response, "task-list-html.php", ['tasks' => $tasks]);
        return $response;
    }

    public function store($request, $response)
    {
        $inputs = $request->getParsedBody();
        $stmt = $this->ci->Pdo->prepare("INSERT INTO tasks (name) VALUES (:name)");
        $stmt->execute([
            ':name' => $inputs['name']
        ]);

        return $response->withStatus(302)->withHeader('Location', '/tasks');
    }
}