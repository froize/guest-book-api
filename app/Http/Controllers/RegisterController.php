<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegisterController extends BaseController
{
    public function register(Request $request): Response
    {
        return Http::localhost()->post('/api/register', [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'c_password' => $request->get('c_password'),
        ]);
    }

    public function login(Request $request): Response
    {
        return Http::localhost()->post('/api/login', [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ]);
    }

    public function logout(): Response
    {
        return Http::localhost()->get('/api/logout');
    }
}
