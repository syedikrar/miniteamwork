<?php

namespace Tests\Feature;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class TaskTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateTask()
    {
        $user = User::factory()->create();

        $token = $user->createToken('API Token')->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'name' => 'Lorem',
            'description' => 'Ipsum',
            'completed_flag' => 'inprogress',
            'created_at' => now(),
            'updated_at' => now(),
            'id' => 1
        ];

        $this->json('POST', '/api/task/store', $payload, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
              "task" => [
                  'id',
                  'name',
                  'description',
                  'completed_flag',
                  'created_at',
                  'updated_at',
              ],
               "message"
            ]);
    }
}
