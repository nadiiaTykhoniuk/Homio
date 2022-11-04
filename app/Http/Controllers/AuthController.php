<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        $credentials = $request->only(['email', 'password']);

        if (! $token = JWTAuth::attempt($credentials, true)) {
            return response()->json(['errors' => ['Wrong email or password.']], 401);
        }

        return Response::json([
            'data' => $this->createNewToken($token)
        ], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'email:rfc,filter|required|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->assignRole('refugee');

        return Response::json([
            'data' => $this->login($request)->getData()->data
        ], 200);
    }

    public function logout() : JsonResponse
    {
        auth()->logout();
        return Response::json([
            'data' => ['message' => 'User successfully signed out']
        ], 200);
    }

    public function refresh() : JsonResponse
    {
        return Response::json([
            'data' => $this->createNewToken(auth()->refresh())
        ], 200);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return array
     */
    protected function createNewToken(string $token): array
    {
        return [
            'token' => $token,
            'user' => new UserResource(auth()->user())
        ];
    }
}
