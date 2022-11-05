<?php

namespace Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;

class LoginUserTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * @test
     * Test that user can login
     *
     * @return void
     */
    public function loginWithValidDataTest()
    {
        $userLoginData = [
            'email' => $this->user->email,
            'password' => 'password',
            'remember' => true
        ];

        $response = $this->post(route('login'), $userLoginData);
        $response
            ->assertOk();
    }

    /**
     * @test
     * Test that user cannot login with wrong email or password
     *
     * @return void
     */
    public function loginWithInvalidDataTest()
    {
        $invalidLoginData = [
            'email' => $this->user->email,
            'password' => Str::random(10)
        ];

        $response = $this->post(route('login'), $invalidLoginData);
        $response
            ->assertStatus(401)
            ->assertJsonStructure([
                'errors' => [
                ]
            ]);
    }
}
