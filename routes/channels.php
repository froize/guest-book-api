<?php

use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('answer.{reviewId}', function (User $user, int $reviewId) {
    return $user->id === Review::findOrNew($reviewId)->user_id;
});
