<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'text' => $this->faker->text(),
            'user_id' => $this->faker->randomNumber(),
            'answer' => $this->faker->word(),
            'answer_user_id' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
