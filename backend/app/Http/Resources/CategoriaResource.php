<?php

namespace App\Http\Resources;

use App\JsonApi\Traits\JsonApiResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\Node\Stmt\Return_;

class CategoriaResource extends JsonResource
{

    use JsonApiResource;

    public function toJsonApi(): array
    {
        return [
            "nombre" => $this->resource->nombre,
            "descripcion" => $this->resource->descripcion
        ];
    }
}
