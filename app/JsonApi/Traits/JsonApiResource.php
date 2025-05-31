<?php

namespace App\JsonApi\Traits;

use App\JsonApi\Document;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

trait JsonApiResource
{

    abstract public function toJsonApi(): array;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //* Agrega las relaciones del objeto
        if($request->filled('included'))
            $this->with['included'] = $this->getIncludes();

        //Estructura de la respuesta segun el objeto
        //* Parte entendible y ajustable
        return Document::type($this->getResourceType())
                ->id($this->resource->getRouteKey())
                ->attributes($this->filterAttributes($this->toJsonApi()))
                //->relationshipsLinks($this->getRelationshipLinks())
                ->links([
                    'self' => route('api.' . $this->resource->getResourceType() . '.show', $this->resource)
                ])->get('data');
    }

    public function getIncludes(): array
    {
        return [];
    }

    public function getRelationshipLinks(): array
    {
        return [];
    }

    /**
     * Envia los headers en el objeto de respuesta
     */
    public function withResponse($request, $response)
    {

        //Forma 1
        $response->header(
            'Location',
            route('api.' . $this->getResourceType() . '.show', $this->resource)
        );
    }

    /**
     * Filtra por los atributos indicados en la url
     */
    public function filterAttributes(array $attributes): array
    {

        //dd($attributes);
        return array_filter($attributes,  function($value)
            {
                if(request()->isNotFilled('fields'))
                    return true;

                $fields = explode(',', request('fields.'.$this->getResourceType()));

                if($value === $this->getRoutekey())
                    return in_array($this->getRoutekeyName(), $fields);


                return $value;
            }
        );
    }

    /**
     * Obtiene los links en las coleciones
     */
    public static function collection($resource): AnonymousResourceCollection
    {
        $collection = parent::collection($resource);

        $collection->with['links'] = ['self' => $resource->path()];

        return $collection;
    }
}
