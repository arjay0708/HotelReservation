<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'photos' => $this->faker->imageUrl(),
            'room_number' => $this->faker->numberBetween(100, 999),
            'floor' => $this->faker->numberBetween(1, 10),
            'type_of_room' => $this->faker->randomElement(['Single', 'Double', 'Suite']),
            'number_of_bed' => $this->faker->numberBetween(1, 4),
            'details' => $this->faker->text,
            'max_person' => $this->faker->numberBetween(1, 6),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'is_available' => $this->faker->boolean(80), // 80% chance of being available
        ];
    }
}
