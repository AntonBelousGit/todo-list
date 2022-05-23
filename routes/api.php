<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TodoListsController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function () {
        return auth()->user();
    });

    Route::apiResource('todo-list', TodoListsController::class);
    Route::apiResource('todo-list.task', TaskController::class);

    Route::get('todo-list/{todo_list}/search', [TaskController::class, 'search'])->name('todo-list.search');

    Route::post('/auth/logout', [AuthController::class, 'logout']);
});
