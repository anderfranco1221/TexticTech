<?php

namespace Tests\Feature\Material;

use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilterMaterialTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_filter_materiales_by_nombre(){
        Material::factory()->create([
            "nombre" => "Material 1"
        ]);

        Material::factory()->create([
            "nombre" => "Otro material"
        ]);

        $url = route("api.materials.index", [
            "filter" => [
                "nombre"=> "1"
            ]
        ]);

        $this->getJson($url)
            ->assertJsonCount(1, "data")
            ->assertSee("Material 1")
            ->assertDontSee("Otro material");
    }

    /** @test */
    public function cannot_filter_materiales_by_unkown_filters()
    {
        Material::factory()->count(2)->create();

        $url = route("api.materials.index", [
            'filter' =>[
                'unkown' => 'unkown'
            ]
        ]);

        $this->getJson($url)->assertJsonApiError(
            title: "Bad Request",
            detail: "The filter 'unkown' is not in the 'materials' resource.",
            status: "400"
        );
    }
    /* "codigo" => $this->faker->numerify('INO-###'),
    "nombre" => $this->faker->words(2, true),
    "descripcion" => $this->faker->sentence,
    "estado" => true,
    "stock" => 0,
    "unidad" => $this->faker->currencyCode() */
}
