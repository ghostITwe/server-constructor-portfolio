<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
                    'message' => [
                        'Неправильно введена почта или пароль.'
                    ]
                ]
            ])->setStatusCode(401);
        }

        return response()->json([
            'status' => true,
            'nickName' => auth()->user()->nickName,
            'token' => auth()->user()->createToken('auth')->plainTextToken
        ]);
    }

    public function registration(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'email' => $validated['email'],
            'username' => Str::random(10),
            'password' => Hash::make($validated['password'])
        ]);

        return response()->json([
            'status' => true,
            'nickName' => $user->nickName,
            'token' => $user->createToken('registration')->plainTextToken
        ]);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->currentAcceessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Token revoked'
        ]);
    }
}
