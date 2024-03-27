<?php

namespace Database\Factories;

use App\Models\ReasonBackOut;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReasonBackOutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReasonBackOut::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reservation_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 5),
            'reason' => $this->faker->sentence,
            'set_by_admin' => $this->faker->boolean, // Assuming set_by_admin is a boolean field
        ];
    }
}