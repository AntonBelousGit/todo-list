<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\TaskFilter;
use App\Http\Requests\ApiTaskRequest;
use App\Http\Requests\ApiTaskUpdateRequest;
use App\Http\Requests\ApiFilterRequest;
use App\Http\Resources\ApiTaskResource;
use App\Models\Task;
use App\Models\TodoList;
use App\Service\TaskService;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    use ApiResponser;

    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(TodoList $todo_list)
    {
        if (!Gate::allows('manage-list', $todo_list)) {
            return $this->error('Access denied', 403);
        }
        $tasks = $todo_list->tasks;
        return ApiTaskResource::collection($tasks);
    }

    public function search(TodoList $todo_list, ApiFilterRequest $request)
    {
        if (!Gate::allows('manage-list', $todo_list)) {
            return $this->error('Access denied', 403);
        }

        $data = $request->validated();
        $filter = app()->make(TaskFilter::class, ['queryParams' => array_filter($data)]);
        $tasks = $this->taskService->filter($filter, $todo_list->id);

        return ApiTaskResource::collection($tasks);
    }

    public function show(TodoList $todo_list, Task $task)
    {
        if (!Gate::allows('manage-list', $todo_list)) {
            return $this->error('Access denied', 403);
        }

        $show = $this->taskService->show($todo_list, $task);

        if (!$show) {
            return $this->error('Not found', 404);
        }

        return new ApiTaskResource($show);
    }

    public function store(ApiTaskRequest $request, TodoList $todo_list)
    {

        if (!Gate::allows('manage-list', $todo_list)) {
            return $this->error('Access denied', 403);
        }

        if ($todo_list->completed) {
            return $this->error('You cannot add a new task to a completed task-list', 403);
        }

        $task = $this->taskService->store($request->validated(), $todo_list);
        return new ApiTaskResource($task);
    }

    public function destroy(TodoList $todo_list, Task $task)
    {
        if (!Gate::allows('manage-list', $todo_list)) {
            return $this->error('Access denied', 403);
        }

        if ($todo_list->completed) {
            return $this->error('You cannot delete task to a completed task-list', 403);
        }

        if ($todo_list->id != $task->todo_list_id) {
            return $this->error('You are trying to delete a task from another task-list', 403);
        }

        $this->taskService->delete($task);

        return $this->success('', 'Task deleted successfully');
    }

    public function update(TodoList $todo_list, Task $task, ApiTaskUpdateRequest $request)
    {
        if (!Gate::allows('manage-list', $todo_list)) {
            return $this->error('Access denied', 403);
        }

        if ($request['status'] == 'done') {
            $check_done_subtask = $this->taskService->check_done_subtask($task);

            if ($check_done_subtask) {
                $task = $this->taskService->update($request->validated(), $task, now());
                return new ApiTaskResource($task);
            }
            return $this->error('You cannot change the status to done until the subtask is completed', 403);
        }

        $task = $this->taskService->update($request->validated(), $task);

        return new ApiTaskResource($task);
    }

}
