<?php

namespace Database\Factories;

use App\Models\UserVerify;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserVerifyFactory extends Factory
{
    protected $model = UserVerify::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'token' => $this->faker->uuid,
        ];
    }
}
