<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveMaterialRequest;
use App\Http\Resources\MaterialResource;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $materiales = Material::query()
            ->allowedFilters(["codigo", "nombre", "estado"])
            ->allowedSorts(["codigo", "nombre"])
            ->sparseFieldset()
            ->jsonPaginate();

        return MaterialResource::collection($materiales);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveMaterialRequest $request): MaterialResource
    {
        $material = Material::create($request->validated());
        return MaterialResource::make($material);
    }

    /**
     * Display the specified resource.
     */
    public function show($idMaterial): JsonResource
    {
        $material = Material::where("id", $idMaterial)
        ->sparseFieldset()
        ->firstOrFail();

        return MaterialResource::make($material);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Material $materiale, SaveMaterialRequest $request): MaterialResource
    {
        $materiale->update($request->validated());
        return MaterialResource::make($materiale);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
