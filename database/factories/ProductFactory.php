<?php

namespace Database\Factories;


use App\Models\Blog;
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
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->text,
            'category_id' => 5,
            'photo' => 'images/cars/cima_1912_top_01.jpg.ximg.l_full_m.smart.jpg',
        ];
    }
}
