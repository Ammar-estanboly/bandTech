<?php

namespace Database\Factories\products;

use App\Models\products\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => ['normal' =>  $this->faker->numberBetween(400, 600),
                        'gold' =>  $this->faker->numberBetween(100, 200),
                        'silver' =>  $this->faker->numberBetween(200, 400)], // حقل السعر
            'slug' => $this->faker->unique()->slug(),
            'is_active' => $this->faker->boolean,

        ];
    }
}
