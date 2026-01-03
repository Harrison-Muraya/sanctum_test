<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if (!$user || ! Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' =>['The provided credentials are incorrect.']
           ]);
        }

        $user->tokens()->delete();

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'success'=>true,
            'message'=>'Login successful',
            'data'=>[
                'user'=>$user,
                'access_token'=>$token
            ]
        ]);

    }
    public function register(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        $token = $user->createToken('Api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'user created successfuly',
            'data' => [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        ],201);
    }
    public function logout(Request $request)
    {
        //
    }

}
