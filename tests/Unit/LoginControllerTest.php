<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Str;

class LoginControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function user_can_login()
    {
        $response = $this->postJson(route('auth.login'), [
            'email' => 'test@gmail.com',
            'password' => 'admin12345'
        ]);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'user',
                    'token'
                ]
            ]);
    }



    /** @test */
    public function user_can_not_login()
    {
        $response = $this->postJson(route('auth.login'), [
            'email' => 'random@gmail.com',
            'password' => Str::random()
        ]);
        $response->assertStatus(400)
            ->assertJsonStructure([
                'status',
                'message',
                'data'
            ]);
    }
}
