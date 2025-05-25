<?php

namespace Tests\Feature\Categoria;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCategoriaTest extends TestCase
{

    //TODO:Crear categoria
    //TODO:Validacion de formularios
    //TODO: Validacion de permisos ?

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
