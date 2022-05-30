<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function createPortfolio($data)
    {
        $portfolio = Portfolio::create([
            'user_id' => auth()->user(),
            'data' => $data
        ]);

        return response()->json([
            'status' => true
        ]);
    }
}
