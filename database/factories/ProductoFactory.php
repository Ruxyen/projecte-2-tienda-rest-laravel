<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Producto;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        return [
            'nom_producto' => $this->faker->word,
            'descripcion' => $this->faker->sentence,
            'precio' => $this->faker->randomFloat(2, 1, 100),
            'categoria' => $this->faker->word,
            'talla' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
        ];
    }
}