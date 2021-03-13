<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
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
            'user_id' => 1,
            'name' => $this->faker->name,
            'code' => $this->faker->ean13,
            'price' => $this->faker->numberBetween(1000, 1000000), // vnd
            'quantity' => $this->faker->numberBetween(0, 100),
            'description'=> $this->faker->realText($maxNbChars = 200, $indexSize = 2) ,
            'images'=> $this->faker->imageUrl($width = 640, $height = 480) ,
            'rate'=>$this->faker->numberBetween(1, 5),
            'weight'=>$this->faker->numberBetween(1, 100000), // gram
            'status'=>$this->faker->numberBetween(0,1),
        ];
    }
}
