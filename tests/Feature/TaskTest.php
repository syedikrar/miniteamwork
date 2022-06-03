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

    public function testEditTask()
    {
      $user = User::factory()->create();
      $token = $user->createToken('API Token')->plainTextToken;
      $headers = ['Authorization' => "Bearer $token"];

      $task = Task::factory()->create();

      $payload = [
          'name' => 'Lorem',
          'description' => 'Ipsum',
          'completed_flag' => 'inprogress',
      ];

      $this->json('PUT', '/api/task/update/'.$task->id, $payload, $headers)
          ->assertStatus(200)
          ->assertJsonStructure([
            "details",
             "message"
          ]);
    }

    public function testGetAllTasks()
    {
        $user = User::factory()->create();

        $token = $user->createToken('API Token')->plainTextToken;
        $headers = ['Accept' => 'application/json', 'Authorization' => "Bearer $token"];
        $payload = [];
        $this->json('GET', '/api/task/get/all', $payload, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
              "task" => [],
            ]);

            $this->assertAuthenticated();
    }

    public function testDeleteTask()
    {
      $user = User::factory()->create();

      $token = $user->createToken('API Token')->plainTextToken;
      $headers = ['Accept' => 'application/json', 'Authorization' => "Bearer $token"];
      $task = Task::factory()->create();
      $payload = [];
      $this->json('DELETE', '/api/task/delete/'.$task->id, $payload, $headers)
          ->assertStatus(200)
          ->assertJsonStructure([
            "details",
             "message"
          ]);
    }
}
