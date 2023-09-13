<?php

namespace Database\Factories;

use App\Models\Productos;
use Illuminate\Database\Eloquent\Factories\Factory;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductosFactory extends Factory
{
    protected $model = Productos::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'nombre' => $this->faker->name(),
            'descripcion' => $this->faker->text(),
            'precio' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
