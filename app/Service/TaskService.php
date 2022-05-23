<?php


namespace App\Service;

use App\Models\Task;
use App\Repositories\TaskRepositories;

class TaskService
{

    protected $taskRepositories;

    public function __construct(TaskRepositories $taskRepositories)
    {
        $this->taskRepositories = $taskRepositories;
    }

    public function filter($filter, $id)
    {
        return $this->taskRepositories->filter($filter, $id);
    }

    public function store($data, $todo_list)
    {
        return $todo_list->tasks()->create($data);
    }

    public function show($todo_list, $task)
    {
        return $this->taskRepositories->show($todo_list, $task);
    }

    public function delete($task)
    {
        return $task->delete();
    }

    public function update($data, $task, $completed_at = null)
    {
        $task->update($data + ['completed_at' => $completed_at]);
        return $task;
    }

    public function check_done_subtask($task)
    {
        $check = $this->taskRepositories->check_done_subtask($task->id);

        if (is_null($check)) {
            return true;
        }
        return false;
    }

}
