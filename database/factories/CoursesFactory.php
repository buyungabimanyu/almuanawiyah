<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CoursesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2,8)),
            'category_id' => mt_rand(1,3)
        ];
    }
}
