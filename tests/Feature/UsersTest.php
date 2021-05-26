<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    public function testDefaultUserCanAuthenticateSuccessfully()
    {
        $user = User::factory()->create();
        $payload = [
            'password' => 'password',
            'email' => $user->email
        ];
        $response = $this->post('/api/authenticate', $payload);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testRetailerUserCanAuthenticateSuccessfully()
    {
        $user = User::factory()->create([
            'is_retailer' => true
        ]);

        $payload = [
            'password' => 'password',
            'email' => $user->email
        ];
        $response = $this->post('/api/authenticate', $payload);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testDefaultUserCantAuthenticateWithWrongCredentials()
    {
        User::factory()->create();

        $payload = [
            'password' => 'cant_login',
            'email' => 'email@email.com'
        ];

        $headers = [
            'Accept' => 'content/json'
        ];

        $response = $this->post('/api/authenticate', $payload, $headers);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $response->assertJson([
            'message' => 'Unable to Authenticate User'
        ]);
    }

    public function testRetailerUserCantAuthenticateWithWrongCredentials()
    {
        User::factory()->create([
            'is_retailer' => true
        ]);

        $payload = [
            'password' => $this->faker->password,
            'email' => $this->faker->email
        ];

        $headers = [
            'Accept' => 'content/json'
        ];

        $response = $this->post('/api/authenticate', $payload, $headers);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $response->assertJson([
            'message' => 'Unable to Authenticate User'
        ]);
    }

    public function testDefaultUserCanRegisterSuccessfully()
    {
        $payload = [
            'name' => 'Testing User',
            'email' => 'email@email.com',
            'password' => 'password',
            'document' => '000.000.000-00'
        ];

        $response = $this->post('/api/register', $payload);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonFragment([
            'data' => [
                'name' => 'Testing User',
                'email' => 'email@email.com',
                'document' => '000.000.000-00'
            ]
        ]);
    }

    public function testRetailerUserCanRegisterSuccessfully()
    {
        $payload = [
            'name' => 'Testing User',
            'email' => 'email@email.com',
            'password' => 'password',
            'document' => '000.000.000-00',
            'is_retailer' => true
        ];

        $response = $this->post('/api/register', $payload);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonFragment([
            'data' => [
                'name' => 'Testing User',
                'email' => 'email@email.com',
                'document' => '000.000.000-00'
            ]
        ]);
    }

    public function testUserCantRegisterUsingNonuniqueEmail()
    {
        User::factory()->create([
            'email' => 'email@email.com'
        ]);

        $payload = [
            'name' => 'Testing User',
            'email' => 'email@email.com',
            'password' => 'password',
            'document' => '000.000.000-00'
        ];

        $headers = [
            'Accept' => 'content/json'
        ];

        $response = $this->post('/api/register', $payload, $headers);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'email' => [
                    'The email has already been taken.'
                ]
            ]
        ]);
    }

    public function testUserCantRegisterUsingNonuniqueDocument()
    {
        User::factory()->create([
            'document' => '000.000.000-00'
        ]);

        $payload = [
            'name' => 'Testing User',
            'email' => 'email@email.com',
            'password' => 'password',
            'document' => '000.000.000-00'
        ];

        $headers = [
            'Accept' => 'content/json'
        ];

        $response = $this->post('/api/register', $payload, $headers);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'document' => [
                    'The document has already been taken.'
                ]
            ]
        ]);
    }
}
