<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\User;
use App\Services\Portfolio\PortfolioService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    private PortfolioService $portfolioService;

    public function __construct(PortfolioService $portfolioService)
    {
        $this->portfolioService = $portfolioService;
    }

    public function savePortfolio(Request $request): JsonResponse
    {
        return $this->portfolioService->savePortfolio($request);
    }

    public function getPortfolio(Request $request, $username)
    {
        return $this->portfolioService->getPortfolio($request, $username);
    }
}
