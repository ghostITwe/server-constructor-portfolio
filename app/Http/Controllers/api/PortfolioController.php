<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function savePortfolio(Request $request)
    {
        $portfolio = User::findOrFail($request->user()->id);

        dd($request->portfolio);

        return response()->json([
            'status' => true
        ]);
    }
}
