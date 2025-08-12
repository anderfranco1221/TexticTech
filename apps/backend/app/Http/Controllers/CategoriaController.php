<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCategoriaRequest;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $categorias = Categoria::jsonPaginate();
        return CategoriaResource::collection($categorias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveCategoriaRequest $request): CategoriaResource
    {
        $categoria = Categoria::create($request->validated());
        
        return CategoriaResource::make($categoria);
    }

    /**
     * Display the specified resource.
     */
    public function show($category): JsonResource
    {
        $categoria = Categoria::where("id", $category)->firstOrFail();
        return CategoriaResource::make($categoria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Categoria $category, SaveCategoriaRequest $request): CategoriaResource
    {
        $category->update($request->validated());
        return CategoriaResource::make($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
