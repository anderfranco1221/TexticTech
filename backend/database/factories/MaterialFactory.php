<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{

    protected $model = Material::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "codigo" => $this->faker->numerify('INO-###'),
            "nombre" => $this->faker->words(2, true),
            "descripcion" => $this->faker->sentence,
            "estado" => true,
            "stock" => 0,
            "unidad" => $this->faker->currencyCode()
        ];
    }
}
