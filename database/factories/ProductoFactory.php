<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;
use App\Models\Producto;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition(): array
    {
        return [
            'categoria_id' => Categoria::factory(),
            'nombre' => $this->faker->unique()->words(3, true),
            'sku' => strtoupper($this->faker->unique()->bothify('SKU-#####')),
            'stock' => $this->faker->numberBetween(0, 200),
            'precio' => $this->faker->randomFloat(2, 1, 500),
            'activo' => $this->faker->boolean(90),
        ];
    }
}
