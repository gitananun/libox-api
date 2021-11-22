<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'rating' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->numberBetween(0, 100),
            'length' => $this->faker->numberBetween(1, 45),
            'language' => $this->faker->languageCode(),
            'description' => $this->faker->text(),
            'last_updated' => $this->faker->dateTime(),
            'likes' => $this->faker->numberBetween(0, 300),
            'user_id' => User::factory()->create()->id,
        ];
    }
}