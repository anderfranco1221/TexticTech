<?php

namespace App\JsonApi;
use Closure;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

    class JsonApiQueryBuilder
    {
        public function allowedSorts(): Closure
        {
            return function($allowedSorts){
                /** @var Builder $this */
                if(request()->filled('sort')){
                    $sortFields = explode(',',  request()->input('sort'));

                    $allowedSorts = ['title', 'content'];

                    foreach ($sortFields as $sortField) {

                        $sortDirection = Str::of($sortField)->startsWith('-') ? 'desc' : 'asc';

                        $sortField = ltrim($sortField, '-');

                        abort_unless(in_array($sortField, $allowedSorts),400);

                        $this->orderBy($sortField, $sortDirection);
                    }
                }

                return $this;
            };
        }

        public function allowedFilters(): Closure
        {
            return function($allowedFilters){
                /** @var Builder $this */
                foreach(request('filter', []) as $filter => $value){

                    if(! in_array($filter, $allowedFilters))
                        throw new BadRequestHttpException("The filter '{$filter}' is not in the '{$this->getResourceType()}' resource.");

                    $this->hasNamedScope($filter)
                        ? $this->{$filter}($value)
                        : $this->where($filter, 'LIKE',  '%' . $value . '%');

                }

                return $this;
            };
        }

        public function sparseFieldset(): Closure
        {
            return function(){
                /** @var Builder $this */
                if(request()->isNotFilled('fields')){
                    return $this;
                }

                $resorseType = $this->model->getResourceType();

                $fields = explode(',', request("fields.".$resorseType));
                $routeKeyName = $this->model->getRoutekeyName();

                if(! in_array($routeKeyName, $fields)){
                    $fields[] = $routeKeyName;
                }

                $fields[] = 'id';
                return $this->addSelect($fields);
            };
        }

        public function jsonPaginate(): Closure{

            return function(){
                /** @var Builder $this */
                return $this->paginate(
                    $perPage = request('page.size', 15),
                    $columns = ['*'],
                    $pageName = 'page[number]',
                    $page = request('page.number', 1)
                )->appends(request()->only('sort', 'filter', 'page.size'));
            };
        }

        public function getResourceType(): Closure
        {
            return function(){
                /** @var Builder $this */
                if(property_exists($this->model, 'resourceType')){
                    return $this->model->resourceType;
                }

                return  $this->model->getTable();
            };
        }
    }
