<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $birthday = $this->faker->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d');
        $age = (int)round(now()->diffInYears($birthday));

        return [
            'photos' => $this->faker->imageUrl(),
            'lastname' => $this->faker->lastName,
            'firstname' => $this->faker->firstName,
            'middlename' => $this->faker->lastName,
            'email' => $this->faker->unique()->userName . '@gmail.com',
            'phoneNumber' => '+639' . $this->faker->unique()->numerify('##########'), // Generates a random phone number with the +639 prefix
            'birthday' => $birthday,
            'age' => $age,
            'password' => bcrypt('password'),
            'is_active' => $this->faker->boolean,
            'is_admin' => $this->faker->boolean,
            'email_verified' => $this->faker->boolean,
        ];
    }
}