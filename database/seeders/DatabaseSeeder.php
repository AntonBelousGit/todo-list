<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user1@test.com',
        ]);
//        'password' => 'password'
        User::factory()->create([
            'name' => 'Test User2',
            'email' => 'user2@test.com',
        ]);

        $this->call(TodoListSeeder::class);
        $this->call(TaskSeeder::class);
    }
}
