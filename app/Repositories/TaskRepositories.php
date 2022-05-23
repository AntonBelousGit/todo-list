<?php


namespace App\Repositories;

use App\Models\Task as Model;

/**
 * Class ProductRepositories
 * @package App\Repositories
 */
class TaskRepositories extends CoreRepository
{
    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function filter($filter, $id)
    {
        return $this->startCondition()->filter($filter)->where('todo_list_id', $id)->get();
    }

    public function show($todo_list, $task)
    {
        return $this->startCondition()->where(['todo_list_id' => $todo_list->id, 'id' => $task->id])->first();
    }

    public function check_done_subtask($id)
    {
        return $this->startCondition()->whereHas('subtask', function ($q) {
            $q->where('status', 'todo');
        })
            ->find($id);
    }
}
