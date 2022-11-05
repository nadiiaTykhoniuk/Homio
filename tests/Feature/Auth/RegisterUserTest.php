<?php

namespace Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    private $userData = [
        'name' => 'Test User',
        'email' => 'testuser@gmail.com',
        'password' => 'secret',
        'password_confirmation' => 'secret'
    ];

    private $invalidUserData = [
        'name' => 'Test User',
        'email' => 'testuser',
        'password' => 'secret',
        'password_confirmation' => 'missmatch'
    ];

    public function setUp(): void
    {
        parent::setUp();
        User::truncate();
    }

    /**
     * @test
     * Test that user can register
     *
     * @return void
     */
    public function registerWithValidDataTest()
    {
        $response = $this->post(route('register'), $this->userData);
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'token',
                    'user'
                ]
            ]);
    }

    /**
     * @test
     * Test that user cannot register if the email is in use
     *
     * @return void
     */
    public function registerWithExistingEmail()
    {
        $user = User::factory()->create([
            'name' => 'Nadia Tykhoniuk',
            'email' => 'matsonka02@gmail.com',
            'password' => 'secret'
        ]);
        $userData = $user->toArray();

        unset($userData['updated_at']);
        unset($userData['created_at']);
        unset($userData['id']);
        $userData['password'] = 'secret';
        $userData['password_confirmation'] = 'secret';

        $response = $this->post(route('register'), $userData);
        $response->assertStatus(422);
        $this->assertStringContainsString("The email has already been taken.", $response->getData()->errors[0]);
    }

    /**
     * @test
     * Test that user cannot register with invalid email
     *
     * @return void
     */
    public function registerWithInvalidDataTest()
    {
        $response = $this->post(route('register'), $this->invalidUserData);
        $response->assertStatus(422);
        $this->assertStringContainsString("The email must be a valid email address", $response->getData()->errors[0]);
    }
}
