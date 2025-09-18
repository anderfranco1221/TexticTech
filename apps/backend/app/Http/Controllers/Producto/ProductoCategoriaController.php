<?php

namespace App\Http\Controllers\Producto;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;

class ProductoCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Producto $producto)
    {
        return CategoriaResource::identifier($producto->categoria);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return CategoriaResource::make($producto->categoria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Producto $producto, Request $request)
    {
        $request->validate([
            "data.id" => ["required", "exists:categorias,id"]
        ]);

        $categoria = Categoria::find($request->input("data.id"));
        $producto->update([
            "id_categoria" => $categoria->id
        ]);

        return CategoriaResource::identifier($producto->categoria);
    }
}
