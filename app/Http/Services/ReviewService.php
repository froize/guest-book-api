<?php

namespace App\Http\Services;

use App\Events\AnswerAdded;
use App\Events\ReviewAdded;
use App\Http\Resources\ReviewResource;
use App\Models\Review;

class ReviewService
{
    public function addReview(array $data, int $userId): ReviewResource
    {
        $data['user_id'] = $userId;
        $review = Review::create($data);
        ReviewAdded::dispatch($review);

        return new ReviewResource($review);
    }

    public function answer(array $data, int $userId, int $reviewId): ReviewResource
    {
        $review = Review::findOrFail($reviewId);
        $review->answer = $data['answer'];
        $review->answer_user_id = $userId;
        AnswerAdded::dispatchIf($review->save(), $review);

        return new ReviewResource($review);
    }
}
