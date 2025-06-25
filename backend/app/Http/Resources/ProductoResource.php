<?php

namespace App\Http\Resources;

use App\JsonApi\Traits\JsonApiResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ProductoResource extends JsonResource
{

    use JsonApiResource;
    
    public function toJsonApi(): array
    {
        return [
            "codigo" => $this->resource->codigo,
            "nombre" => $this->resource->nombre,
            "descripcion" => $this->resource->descripcion,
            "stock" => $this->resource->stock
        ];
    }

    public function getRelationshipLinks(): array
    {
        return ["categoria"];
    }

    public function getIncludes(): array
    {
        return [CategoriaResource::make($this->whenLoaded("categoria"))];
    }
}
