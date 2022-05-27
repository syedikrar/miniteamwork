<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
class AuthenticationTest extends TestCase
{
    // use RefreshDatabase;
    public function testsRegistersSuccessfully()
     {
         $payload = [
             'first_name' => 'John',
             'last_name' => 'lee',
             'email' => 'ikrar@gmail.com',
             'password' => '12345678',
             'password_confirmation' => '12345678',
         ];

         $this->json('post', 'api/auth/register', $payload, ['Accept' => 'application/json'])
             ->assertStatus(201)
             ->assertJsonStructure([
                 'user' => [
                     'id',
                     'first_name',
                     'last_name',
                     'email',
                     'created_at',
                     'updated_at',

                 ],
                 'token',
                 'message'
             ]);;
     }

    public function testMustEnterEmailAndPassword()
    {
        $this->json('POST', 'api/auth/login', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    'email' => ["The email field is required."],
                    'password' => ["The password field is required."],
                ]
            ]);
    }

     public function testSuccessfulLogin()
     {

        $loginData = ['email' => 'admin@test.com', 'password' => '12345678'];

        $this->json('POST', 'api/auth/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
               "user" => [
                   'id',
                   'first_name',
                   'last_name',
                   'email',
                   'email_verified_at',
                   'created_at',
                   'updated_at',
               ],
                "token",
                "message"
            ]);

        $this->assertAuthenticated();
     }
}
