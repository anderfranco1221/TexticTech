<?php

namespace Tests\Feature\Material;

use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListMaterialTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fech_a_single_material()
    {
        $material = Material::factory()->create();

        $response = $this->getJson(route("api.materials.show", $material));

        $response->assertJsonApiResource($material, [
            "codigo" => $material->codigo,
            "nombre" => $material->nombre,
            "descripcion" => $material->descripcion,
            "estado" => $material->estado,
            "stock" => $material->stock,
            "unidad" => $material->unidad
        ]);
    }

    /** @test */
    public function can_fech_all_materiales()
    {
        $materiales = Material::factory()->count(3)->create();

        $response = $this->getJson(route("api.materials.index"));

        $response->assertJsonApiResourceCollection($materiales, [
            "codigo", "nombre", "descripcion", "estado", "stock","unidad"
        ]);
    }
}
