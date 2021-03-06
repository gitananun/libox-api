<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'name' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->email(),
            'email_verified_at' => $this->faker->dateTime(),
            'date_of_birth' => $this->faker->dateTime('-5 years'),
            'password' => Hash::make($this->faker->password()),
            'role' => $this->faker->randomElement(User::ROLES),
        ];
    }
}