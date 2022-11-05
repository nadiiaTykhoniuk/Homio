<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class RequestsCRUDTest extends TestCase
{
    private $requestStructure = [
        'id',
        'refugee_id',
        'worker_id',
        'type',
        'title',
        'status',
        'description',
        'number_of_people',
        'with_pets',
        'created_at',
        'updated_at',
        'worker' => [
            'id',
            'name',
            'phone',
            'additional_phone',
            'moved_from_city',
            'moved_to_city',
            'email',
            'email_verified_at',
            'created_at',
            'updated_at'
        ]

    ];

    public function setUp(): void
    {
        parent::setUp();
        User::truncate();
        Request::truncate();
        $this->artisan('db:seed --class=AdminSeeder');
        $this->artisan('db:seed --class=RequestsSeeder');
    }

    /**
     * @test
     * Test that user can get list of requests.
     *
     * @return void
     */
    public function getAllRequestsTest()
    {
        $admin = User::first();
        $this->actingAs($admin);
        $token = JWTAuth::fromUser($admin);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get(route('requests.index'));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    $this->requestStructure
                ]
            ]);
    }

    /**
     * @test
     * Test that user can get one requests.
     *
     * @return void
     */
    public function getOneRequestTest()
    {
        $admin = User::first();
        $this->actingAs($admin);
        $token = JWTAuth::fromUser($admin);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->get(route('requests.show', [
            'request' => Request::first()
        ]));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => $this->requestStructure
            ]);
    }

    /**
     * @test
     * Test that an admin can create a request.
     *
     * @return void
     */
    public function createRequestAsAdminTest()
    {
        $admin = User::first();
        $this->actingAs($admin);
        $token = JWTAuth::fromUser($admin);

        $requestData = [
            'refugee_id' => 2,
            'type' => 'shelter',
            'title' => 'Need place to stay',
            'description' => 'We moved from Donetsk, ours place was bombed',
            'status' => 'pending',
            'number_of_people' => 2,
            'with_pets' => true
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->post(route('requests.store'), $requestData);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => $this->requestStructure
            ]);

        $worker = User::find($response->getData('data')['data']['worker']['id']);
        $this->assertTrue($worker->hasRole('admin'));
        $this->assertEquals($worker->id, $admin->id);
    }

    /**
     * @test
     * Test that a refugee can create a request.
     *
     * @return void
     */
    public function createRequestAsRefugeeTest()
    {
        $user = User::create([
            'name' => 'Lesia Igorivna',
            'email' => Str::random(5) . '@gmail.com',
            'password' => bcrypt('password'),
            'moved_from_city' => 'Donetsk',
            'moved_to_city' => 'Lviv'
        ]);
        $user->assignRole('refugee');
        $this->actingAs($user);
        $token = JWTAuth::fromUser($user);

        $requestData = [
            'worker_id' => 1,
            'type' => 'shelter',
            'title' => 'Need place to stay',
            'description' => 'We moved from Donetsk, ours place was bombed',
            'status' => 'pending',
            'number_of_people' => 2,
            'with_pets' => true
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->post(route('requests.store'), $requestData);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => $this->requestStructure
            ]);

        $refugee = User::find($response->getData('data')['data']['refugee_id']);
        $this->assertTrue($refugee->hasRole('refugee'));
        $this->assertEquals($refugee->id, $user->id);
    }

    /**
     * @test
     * Test that user cannot create a request with invalid data.
     *
     * @return void
     */
    public function createVillaWithInvalidDataTest()
    {
        $admin = User::first();
        $this->actingAs($admin);
        $token = JWTAuth::fromUser($admin);

        $requestData = [
            'refugee_id' => '2',
            'type' => 'shelter',
            'status' => 'pending',
            'number_of_people' => '2',
            'with_pets' => 'yes, have'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ])->post(route('requests.store'), $requestData);

        $response
            ->assertStatus(422);
    }
}
