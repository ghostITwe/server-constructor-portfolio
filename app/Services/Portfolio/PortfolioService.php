<?php

namespace App\Services\Portfolio;


use App\Models\User;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use function Symfony\Component\String\u;

class PortfolioService
{
    public function savePortfolio($request): JsonResponse
    {
        $postData = $request->all();

        $userPortfolio = User::findOrFail(auth()->user()->id);
        $userPortfolio->portfolio = json_encode($postData['contentValue'], JSON_UNESCAPED_UNICODE);
        $userPortfolio->save();

        return response()->json([
            'status' => true
        ]);
    }

    public function getPortfolio($request, $username): JsonResponse
    {
       $userPortfolio = User::query()->where('username', $username)->first();

       if (!$userPortfolio) {
           return response()->json([
               'status' => false,
               'errors' => [
                   'message' => [
                       'Портфолио не найдено'
                   ]
               ]
           ])->setStatusCode(404);
       }

       return response()->json([
           'status' => true,
           'contentPortfolio' => json_decode($userPortfolio->portfolio),
           'editAccess' => $this->checkEditStatusAccess($request, $username)
       ]);
    }

    private function checkEditStatusAccess($request, $username): bool
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());

        if (!$token) return false;

        $currentUser = User::query()->find($token->tokenable_id, 'username');
        $ownerUser = User::query()->where('username', $username)->first('username');

        return $currentUser->username === $ownerUser->username;
    }
}
