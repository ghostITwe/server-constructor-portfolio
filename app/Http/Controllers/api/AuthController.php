<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function auth(AuthRequest $request): JsonResponse
    {
        return $this->authService->auth($request);
    }

    public function registration(RegisterRequest $request): JsonResponse
    {
        return $this->authService->registration($request);
    }

    public function logout(): JsonResponse
    {
        return $this->authService->logout();
    }
}
