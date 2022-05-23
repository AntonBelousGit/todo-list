<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_register()
    {

        $this->postJson(route('auth.register'),[
            'name' => "Anton",
            'email' => 'antonbelouswork@gmail.com',
            'password' => '12345678',
        ])->assertOk();

        $this->assertDatabaseHas('users',['name' => 'Anton']);
    }
}
