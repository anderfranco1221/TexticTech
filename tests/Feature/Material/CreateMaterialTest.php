<?php

namespace Tests\Feature\Material;

use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateMaterialTest extends TestCase
{
    use RefreshDatabase;

    //TODO: creacion de materiales donde respecte el codigo unico
    //TODO:

    /** @test */
    public function can_create_materiales()
    {
        $response = $this->postJson(route("api.materiales.store"), [
            "codigo" => "INO-001",
            "nombre" => "Material",
            "descripcion" => "Descripcion del material",
            "estado" => true,
            "stock" => 0,
            "unidad" => "cm3"
        ])->assertCreated();

        $material = Material::firstWhere("codigo", "INO-001");

        $response->assertJsonApiResource($material, [
            "codigo" => "INO-001",
            "nombre" => "Material",
            "descripcion" => "Descripcion del material",
            "unidad" => "cm3"
        ]);
    }

    /** @test */
    public function codigo_is_required()
    {
        $response = $this->postJson(route("api.materiales.store"), [
            "nombre" => "Material",
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
        $response = $this->postJson(route("api.materiales.store"), [
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
        $response = $this->postJson(route("api.materiales.store"), [
            "codigo" => "INO-001",
            "nombre" => "Material",
            "descripcion" => "Descripcion del material",
            "estado" => true,
            "stock" => 0
        ]);

        $response->assertJsonApiValidationErrors("unidad");
    }


    /** @test */
    public function codigo_must_only_contain_letters_numbers_and_dashes()
    {
        $response = $this->postJson(route('api.materiales.store'), [
            "codigo" => '$#$$?)(&%$%#""',
            "nombre" => "Material",
            "descripcion" => "Descripcion del material",
            "estado" => true,
            "stock" => 0,
            "unidad" => "cm3"
        ]);

        $response->assertJsonApiValidationErrors('codigo');

    }

     /** @test */
    public function codigo_must_not_contain_underscores()
    {
        $response = $this->postJson(route('api.materiales.store'), [
            "codigo" => 'holla_as',
            "nombre" => "Material",
            "descripcion" => "Descripcion del material",
            "estado" => true,
            "stock" => 0,
            "unidad" => "cm3"
        ])->assertSee(trans('validation.no_underscore', ['attribute' => 'data.attributes.codigo']));

        $response->assertJsonApiValidationErrors('codigo');

    }

     /** @test */
    public function slug_must_not_start_with_dashes()
    {
        $response = $this->postJson(route('api.materiales.store'), [
                "codigo" => '-starts-with-dashe',
                "nombre" => "Material",
                "descripcion" => "Descripcion del material",
                "estado" => true,
                "stock" => 0,
                "unidad" => "cm3"
        ])->assertSee(trans('validation.no_starting_dashes', ['attribute' => 'data.attributes.codigo']));

        $response->assertJsonApiValidationErrors('codigo');

    }

     /** @test */
    public function slug_must_not_finish_with_dashes()
    {
        $response = $this->postJson(route('api.materiales.store'), [
                "codigo" => 'finish-with-dashe-',
                "nombre" => "Material",
                "descripcion" => "Descripcion del material",
                "estado" => true,
                "stock" => 0,
                "unidad" => "cm3"
        ])->assertSee(trans('validation.no_ending_dashes', ['attribute' => 'data.attributes.codigo']));

        $response->assertJsonApiValidationErrors('codigo');

    }
}
