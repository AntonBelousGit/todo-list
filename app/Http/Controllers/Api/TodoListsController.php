<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiTodoListRequest;
use App\Http\Resources\ApiTodoListsResource;
use Symfony\Component\HttpFoundation\Response;
use App\Models\TodoList;


class TodoListsController extends Controller
{
    public function index()
    {
        $lists = auth()->user()->todo;
        return ApiTodoListsResource::collection($lists);
    }

    public function show(TodoList $todo_list)
    {
        return new ApiTodoListsResource($todo_list);
    }

    public function store(ApiTodoListRequest $request)
    {
        $todo_list = auth()->user()->todo()->create($request->validated());

        return new ApiTodoListsResource($todo_list);
    }

    public function destroy(TodoList $todo_list)
    {
        $todo_list->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }

    public function update(ApiTodoListRequest $request, TodoList $todo_list)
    {
        $todo_list->update($request->all());
        return new ApiTodoListsResource($todo_list);
    }

}
