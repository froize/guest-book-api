<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Review\NewReviewRequest;
use App\Http\Requests\Review\ReviewAnswerRequest;
use App\Http\Services\ReviewService;
use Illuminate\Http\JsonResponse;

class ReviewController extends BaseController
{
    public function __construct(private ReviewService $service)
    {
    }

    public function add(NewReviewRequest $request): JsonResponse
    {
        try {
            $resource = $this->service->addReview(
                $request->validated(),
                $request->user()->id
            );

            return $this->success('Review created successfully.', [$resource]);
        } catch (\Throwable $exception) {
            return $this->error('Failed to create review', ['exception' => $exception]);
        }
    }

    public function answer(ReviewAnswerRequest $request, int $id): JsonResponse
    {
        try {
            $resource = $this->service->answer(
                $request->validated(),
                $request->user()->id,
                $id
            );

            return $this->success('Answer successfully updated', [$resource]);
        } catch (\Throwable $exception) {
            return $this->error('Failed to answer to review', ['exception' => $exception]);
        }
    }
}
