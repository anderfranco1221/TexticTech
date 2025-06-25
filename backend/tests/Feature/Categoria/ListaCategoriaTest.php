<?php

namespace Tests\Feature\Categoria;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListaCategoriaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetcha_single_category(){
        $categoria = Categoria::factory()->create();
        $response = $this->getJson(route('api.categoria.show', $categoria));
        $response->assertJsonApiResource($categoria,
            ["nombre" => $categoria->nombre, "descripcion" => $categoria->descripcion]
        );
    }


    /** @test */
    public function can_fech_all_categories(){
        $categorias = Categoria::factory()->count(3)->create();
        $response = $this->getJson(route("api.categoria.index"));

        $response->assertJsonApiResourceCollection($categorias,["nombre", "descripcion"]);
    }
}
