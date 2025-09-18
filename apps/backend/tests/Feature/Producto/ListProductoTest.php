<?php

namespace Tests\Feature\Producto;

use Tests\TestCase;
use App\Models\Producto;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListProductoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fech_a_single_producto()
    {
        $producto = Producto::factory()->create();

        $response = $this->getJson(route("api.productos.show", $producto));

        $response->assertJsonApiResource($producto, [
            "codigo" => $producto->codigo,
            "nombre" => $producto->nombre,
            "descripcion" => $producto->descripcion,
            "estado" => $producto->estado,
            "precio" => $producto->precio,
        ])->assertJsonApiRelationshipLinks($producto, ['categoria']);
    }

    /** @test */
    public function can_fech_all_productos()
    {
        $productos = Producto::factory()->count(3)->create();

        $response = $this->getJson(route("api.productos.index"));

        $response->assertJsonApiResourceCollection($productos, [
            "codigo", "nombre", "descripcion", "estado", "precio"
        ]);
    }
}
