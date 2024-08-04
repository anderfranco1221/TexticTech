<?php

namespace App\Http\Resources;

use App\JsonApi\Traits\JsonApiResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    use JsonApiResource;

    public function toJsonApi():array
    {
        return [
            'title' => $this->resource->title,
            'slug' => $this->resource->slug,
            'content' => $this->resource->content
        ];
    }

    public function getRelationshipLinks(): array
    {
        return ['category'];
    }

    public function getIncludes(): array
    {
        return [
            CategoryResource::make($this->resource->category)
        ];
    }

/*
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     *
    public function toArray($request)
    {
        return [
            'type' => $this->getResourceType(),
            'id'    => (string) $this->resource->getRouteKey(),
            'attributes' => $this->filterAttributes($this->toJsonApi()),
            'links' => [
                'self' => route('api.v1.' . $this->getResourceType() . '.show', $this->resource)
            ]

        ];
    }

    public function withResponse($request, $response)
    {
        $response->header(
            'Location',
            route('api.v1.' . $this->getResourceType() . '.show', $this->resource)
        );

        /* return parent::toResponse($request)->withHeaders([
            'Location' => route('api.v1.'.$this->getResourceType().'.show', $this->resource)
        ]); *
    }

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
    } */
}
