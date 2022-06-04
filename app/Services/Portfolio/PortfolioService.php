<?php

namespace App\Services\Portfolio;


use App\Models\User;
use Illuminate\Http\Request;

class PortfolioService
{
    public function savePortfolio(Request $request)
    {
        return response()->json([
            'status' => true,
            'req' => $request
        ]);
        $userPortfolio = User::findOrFail(auth()->user()->id);
        $userPortfolio->portfolio = '';
    }

    public function getPortfolio()
    {
        return [];
    }
}
