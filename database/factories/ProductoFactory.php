<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{

    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "codigo" => $this->faker->numerify('PRO-###'),
            "nombre" => $this->faker->words(2, true),
            "descripcion" => $this->faker->sentence,
            "estado" => true,
            "stock" => 0,
            "estado" => true,
            "id_categoria" => Categoria::factory(),
            "id_usuario" => 0,
        ];
    }
}
