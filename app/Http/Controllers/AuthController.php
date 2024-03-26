<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\Auth\AuthRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function authenticate(AuthRequest $authRequest)
    {
        $authResponse = $this->authService->createTokens($authRequest);
        Log::notice(__CLASS__ . '=>' . __FUNCTION__ . ": " . $authResponse);
        if (!$authResponse) {
            throw new CustomException('ESP0015', __('errorMessage.ESP0015'), Response::HTTP_UNAUTHORIZED);
        }
        dd($authResponse);
    }
}
