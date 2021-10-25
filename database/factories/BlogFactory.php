<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // dd(User::inRandomOrder()->first()->id);
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->text(300),
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}