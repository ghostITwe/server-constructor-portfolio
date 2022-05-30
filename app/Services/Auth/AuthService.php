<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function auth(AuthRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if (!auth()->attempt([
            'email' => $validated['email'],
            'password' => $validated['password']
        ])) {
            return response()->json([
                'status' => false,
                'errors' => [
                    'Неправильный логин или пароль.'
                ]
            ]);
        }

        return response()->json([
            'status' => true,
            'token' => auth()->user()->createToken('auth')->plainTextToken
        ]);
    }

    public function registration(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        return response()->json([
            'status' => true,
            'token' => $user->createToken('registration')->plainTextToken
        ]);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Token revoked'
        ]);
    }
}
