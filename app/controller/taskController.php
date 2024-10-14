<?php
namespace App\Controller;

use App\Model\Task;

class TaskController {
    public function table() {
        require_once __DIR__ . '/../view/table.php';
    }

    public function data(){
        require_once __DIR__ . '/../model/Task.php';
        $tasks = Task::getAll();
        
        header('Content-type: application/json');
        echo $tasks;
    }
}
