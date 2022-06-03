<?php

namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetUsers()
    {
      $user = User::factory()->create();

      $token = $user->createToken('API Token')->plainTextToken;
      $headers = ['Accept' => 'application/json', 'Authorization' => "Bearer $token"];
      $payload = [];
      $this->json('GET', '/api/auth/getUsers', $payload, $headers)
          ->assertStatus(200)
          ->assertJsonStructure([
            "details" => [],
          ]);

          $this->assertAuthenticated();
    }

    public function testDeleteUsers()
    {
      $user = User::factory()->create();

      $token = $user->createToken('API Token')->plainTextToken;
      $headers = ['Accept' => 'application/json', 'Authorization' => "Bearer $token"];
      $payload = [];
      $this->json('DELETE', '/api/user/delete/'.$user->id, $payload, $headers)
          ->assertStatus(200)
          ->assertJsonStructure([
            "details" => [],
            "message"
          ]);

          $this->assertAuthenticated();
    }
}
