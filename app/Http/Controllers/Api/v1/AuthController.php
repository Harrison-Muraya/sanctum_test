<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        //
    }

    public function register(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());
        $access_token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'access_token' => $access_token,
                'token_type' => 'Bearer',
            ],
        ], 201);
    }

    public function logout(Request $request)
    {
        //
    }

    public function user(Request $request)
    {
        //
    }

}
