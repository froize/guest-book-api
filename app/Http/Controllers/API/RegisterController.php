<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Services\RegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class RegisterController extends BaseController
{
    public function __construct(private RegistrationService $service)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $resource = $this->service->register($request->validated());

            return $this->success('User successfully registered', [$resource]);
        } catch (\Throwable $exception) {
            return $this->error('Failed to create user', ['exception' => $exception]);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $token = $this->service->login($request->validated());

            return $this->success('User successfully logged in', ['token' => $token]);
        } catch (\Throwable $exception) {
            return $this->error('Unable to login', ['exception' => $exception], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
