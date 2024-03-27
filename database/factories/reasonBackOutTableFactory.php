<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class reasonBackOutTableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reservation_id' => $this->faker->randomNumber(),
            'user_id' => $this->faker->randomNumber(),
            'reason' => $this->faker->sentence(),
            'set_by_admin' => $this->faker->boolean(),
        ];
    }
}
