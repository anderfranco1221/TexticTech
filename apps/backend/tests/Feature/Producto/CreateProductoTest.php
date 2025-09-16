<?php

namespace Tests\Feature\Producto;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateProductoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_can_create_productos(){
        $categoria = Categoria::factory()->create();

        $response = $this->postJson(route("api.productos.store"),[
            "codigo" => 'PRO-001',
            "nombre" => "Produucto de prueba",
            "descripcion" => "Descripcion del producto",
            "stock" => 0,
            "_relationships" => [
                "categoria" => $categoria
            ]
        ])->assertCreated();

        $producto = Producto::first();

        $response->assertJsonApiResource($producto, [
            "codigo" => 'PRO-001',
            "nombre" => "Produucto de prueba",
            "descripcion" => "Descripcion del producto",
            "stock" => 0,
        ]);

        $this->assertDatabaseHas("producto", [
            "codigo" => 'PRO-001',
            "id_categoria" => $categoria->id
        ]);
    }

    /** @test */
    public function codigo_is_required()
    {
        $categoria = Categoria::factory()->create();

        $response = $this->postJson(route("api.productos.store"),[
            "nombre" => "Produucto de prueba",
            "descripcion" => "Descripcion del producto",
            "stock" => 0,
            "_relationships" => [
                "categoria" => $categoria
            ]
        ]);

        $response->assertJsonApiValidationErrors("codigo");
    }

    /** @test */
    public function nombre_is_required()
    {
        $categoria = Categoria::factory()->create();

        $response = $this->postJson(route("api.productos.store"),[
            "codigo" => 'PRO-001',
            "descripcion" => "Descripcion del producto",
            "stock" => 0,
            "_relationships" => [
                "categoria" => $categoria
            ]
        ]);

        $response->assertJsonApiValidationErrors("nombre");
    }
/*

    public function category_is_required()
    {
        //$categoria = Categoria::factory()->create();

        $response = $this->postJson(route("api.productos.store"),[
            "codigo" => 'PRO-001',
            "nombre" => "Produucto de prueba",
            "descripcion" => "Descripcion del producto",
            "stock" => 0,
        ]);

        $response->dump()->assertJsonApiValidationErrors("categoria");
    } */
}
