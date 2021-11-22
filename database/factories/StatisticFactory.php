<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Statistic;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatisticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Statistic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => Statistic::CATEGORY_TYPE,
            'record' => $this->faker->numberBetween(0, 500),
            'statisticable_id' => Category::factory()->create()->id,
        ];
    }
}