<?php

namespace App\Services\Portfolio;


use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PortfolioService
{
    public function savePortfolio(Request $request): JsonResponse
    {
        $postData = $request->all();

        $userPortfolio = User::findOrFail(auth()->user()->id);
        $userPortfolio->portfolio = json_encode($postData['contentValue'], JSON_UNESCAPED_UNICODE);
        $userPortfolio->save();

        return response()->json([
            'status' => true
        ]);
    }

    public function getPortfolio(): JsonResponse
    {
        $userPortfolio = User::findOrFail(auth()->user()->id);

       return response()->json([
           'status' => true,
           'contentPortfolio' => json_decode($userPortfolio->portfolio)
       ]);
    }
}
