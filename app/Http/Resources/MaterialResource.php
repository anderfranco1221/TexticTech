<?php

namespace App\Http\Resources;

use App\JsonApi\Traits\JsonApiResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
{
    use JsonApiResource;

    public function toJsonApi(): array
    {
        return [
            "codigo" => $this->resource->codigo,
            "nombre" => $this->resource->nombre,
            "descripcion" => $this->resource->descripcion,
            "estado" => $this->resource->estado,
            "stock" => $this->resource->stock,
            "unidad" => $this->resource->unidad
        ];
    }
}
