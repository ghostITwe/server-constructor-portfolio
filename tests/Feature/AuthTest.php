<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{

    public function test_registration()
    {
        $response = $this->postJson('api/registration', [
            'email' => 'test@test.ru',
            'password' => 'testPassword',
            'password_confirmation' => 'testPassword'
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'token'
        ]);
    }

    public function test_login()
    {
        $response = $this->postJson('api/auth',
            [
            'email' => 'test@test.ru',
            'password' => 'testPasswor'
            ]);

        $response->assertStatus(200)->assertJsonStructure([
            'status',
            'token'
        ]);
    }
}
