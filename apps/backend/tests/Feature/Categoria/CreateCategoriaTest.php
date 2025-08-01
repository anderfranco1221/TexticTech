<?php

namespace Tests\Feature\Categoria;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCategoriaTest extends TestCase
{
    use RefreshDatabase;

    //TODO: Validacion de permisos ?
    /** @test */
    public function can_create_category()
    {
        $response = $this->postJson(route("api.categories.store"), [
            "nombre" => "Prueba 1",
            "descripcion" => "Descripcion de la categoria"
        ])->assertCreated();

        $categoria = Categoria::first();

        $response->assertHeader(
            "Location",
            route("api.categories.show", $categoria)
        );
    }

    /** @test */
    public function name_is_requered()
    {
        $response = $this->postJson(route("api.categories.store"), [
            "descripcion" => "descripcion de la categoria"
        ]);

        $response->assertJsonApiValidationErrors("nombre");
    }
}
