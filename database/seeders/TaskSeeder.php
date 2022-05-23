<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::factory(2)->create(['todo_list_id'=> 1])
            ->each(function ($task) {
                Task::factory(3)->create(['task_id' => $task->id,'todo_list_id'=> 1])
                    ->each(function ($child_task) {
                        Task::factory(3)->create(['task_id' => $child_task->id,'todo_list_id'=> 1]);
                    });
            });

        Task::factory(2)->create(['todo_list_id'=> 2])
            ->each(function ($task) {
                Task::factory(3)->create(['task_id' => $task->id,'todo_list_id'=> 2])
                    ->each(function ($child_task) {
                        Task::factory(3)->create(['task_id' => $child_task->id,'todo_list_id'=> 2]);
                    });
            });
    }
}
