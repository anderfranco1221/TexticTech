<?php

namespace Tests\Feature\Material;

use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateMaterialTest extends TestCase
{
    use RefreshDatabase;

     /** @test */
    public function can_update_articles()
    {
        $material = Material::factory()->create();

        $response = $this->patchJson(route('api.materials.update', $material), [
            "codigo" => $material->codigo,
            "nombre" => "Material actualizado",
            "descripcion" => "Descripcion del material",
            "estado" => true,
            "stock" => 0,
            "unidad" => "cm3"
        ])->assertOk();

        $material = Material::first();

        $response->assertJsonApiResource($material, [
            "codigo" => $material->codigo,
            "nombre" => "Material actualizado",
            "descripcion" => "Descripcion del material",
            "estado" => true,
            "stock" => 0,
            "unidad" => "cm3"
        ]);
    }

    /** @test */
    public function codigo_is_required()
    {
        $material = Material::factory()->create();

        $response = $this->patchJson(route('api.materials.update', $material), [
                "nombre" => "Material actualizado",
                "descripcion" => "Descripcion del material",
                "estado" => true,
                "stock" => 0,
                "unidad" => "cm3"
        ]);

        $response->assertJsonApiValidationErrors("codigo");

    }

        /** @test */
    public function nombre_is_required()
    {
        $material = Material::factory()->create();

        $response = $this->patchJson(route('api.materials.update', $material), [
            "codigo" => "INO-001",
            "descripcion" => "Descripcion del material",
            "estado" => true,
            "stock" => 0,
            "unidad" => "cm3"
        ]);

        $response->assertJsonApiValidationErrors("nombre");
    }

    /** @test */
    public function unidad_is_required()
    {
        $material = Material::factory()->create();

        $response = $this->patchJson(route('api.materials.update', $material), [
            "codigo" => "INO-001",
            "nombre" => "Material",
            "descripcion" => "Descripcion del material",
            "estado" => true,
            "stock" => 0
        ]);

        $response->assertJsonApiValidationErrors("unidad");
    }

}
