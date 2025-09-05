<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveProductoRequest;
use App\Http\Resources\ProductoResource;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Producto::query()
            ->allowedFilters(["codigo", "nombre", "estado"])
            ->allowedSorts(["codigo", "nombre"])
            ->sparseFieldset()
            ->jsonPaginate();

        return ProductoResource::collection($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveProductoRequest $request): ProductoResource
    {
        $producto = Producto::create($request->validated());
        return ProductoResource::make($producto);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResource
    {
        $producto = Producto::where("id", $id)
            ->allowedIncludes(["categoria"])
            ->sparseFieldset()
            ->firstOrFail();

        return $producto;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
