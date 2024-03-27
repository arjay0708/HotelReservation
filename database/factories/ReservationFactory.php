<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_code' => $this->faker->unique()->word,
            'user_id' => $this->faker->randomNumber(),
            'room_id' => $this->faker->randomNumber(),
            'start_dataTime' => $this->faker->dateTimeBetween('now', '+1 week'),
            'end_dateTime' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'status' => 'pending',
            'is_archived' => '0',
            'is_noted' => '0',
        ];
    }
}
