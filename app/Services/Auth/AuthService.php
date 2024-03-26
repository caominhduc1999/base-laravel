<?php

namespace App\Services\Auth;

use App\Repositories\User\UserRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AuthService extends BaseService
{
    public function __construct(private UserRepositoryInterface $userRepositoryInterface)
    {
    }

    public function createTokens($credentials)
    {
        $email = $credentials['email'];
        $password = $credentials['password'];

        $response = Http::asForm()->post('http://localhost/oauth/token', [
            'grant_type' => 'password',
            'client_id'     => config('passport.passport_client_id'),
            'client_secret' => config('passport.passport_secret_id'),
            'username'      => $email,
            'password'      => $password,
            'scope' => '*',
        ]);

        dd($response->json());
    }

    public function refreshAccessTokenByRefreshToken($refreshToken)
    {
        $request = Request::create('/oauth/token', 'POST', [
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id'     => config('passport.passport_client_id'),
            'client_secret' => config('passport.passport_secret_id'),
        ]);
        Log::info("[request]:" . $request);

        $response = json_decode(app()->handle($request)->getContent(), true);

        return !empty($response['access_token']) ? $response : false;
    }
}
