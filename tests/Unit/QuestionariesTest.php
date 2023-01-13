<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class QuestionariesTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        //initializing user
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    //test questionaries list to list all questions
    public function test_questionaries_list_questions()
    {
        $response = $this->getJson(route('admin.test.list'));
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data'
            ]);
    }

    public function test_questionaries_add_questions()
    {

        $response = $this->postJson(route('admin.test.list'), [
            'title' => 'hello worlds',
            'expiry_date' => '2024-01-02'
        ]);
        // dd($response->getContent());
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'title',
                    'expire',
                    'mail',
                    'mailCode'
                ]
            ]);
    }


    public function test_questionaries_invalid_add_questions()
    {

        $response = $this->postJson(route('admin.test.list'));
        // dd($response->getContent());
        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'title',
                    'expiry_date'
                ]
            ]);
    }
}
