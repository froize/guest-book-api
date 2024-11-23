<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Http;

class ReviewController extends BaseController
{
    public function index(Request $request): Response
    {
        return Http::localhost()
            ->withToken($request->get('token'))
            ->get(route('api_reviews_index', absolute: false), [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ]);
    }

    public function add(Request $request): Response
    {
        return Http::localhost()
            ->withToken($request->get('token'))
            ->post(route('api_reviews_add', absolute: false), [
            'text' => $request->get('text'),
        ]);
    }

    public function answer(Request $request, Review $review): Response
    {
        return Http::localhost()
            ->withToken($request->get('token'))
            ->patch(route('api_reviews_answer', ['id' => $review->id], false), [
            'answer' => $request->get('answer'),
        ]);
    }
}
