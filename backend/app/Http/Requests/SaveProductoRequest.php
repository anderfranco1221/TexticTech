<?php

namespace App\Http\Requests;

use App\Models\Categoria;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SaveProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "data.attributes.codigo" => ["required"],
            "data.attributes.nombre" => ["required"],
            "data.attributes.descripcion" => [],
            "data.attributes.estado" => [],
            "data.attributes.stock" => [],
            "data.attributes.precio" => [],
            'data.relationships.categoria.data.id' => [
                Rule::requiredIf(! $this->route("productos")),
                Rule::exists("categoria", "id")
            ],
            'data.relationships.usuario' => []

        ];
    }

    public function validated($key = "data.attributes", $default = null)
    {
        
        $data = parent::validated()["data"];
        $attributes = $data["attributes"];
        
        if(isset($data['relationships'])){
            $relationships = $data['relationships'];

            foreach($relationships as $key => $relationshp){
                $attributes = array_merge($attributes, $this->{$key}($relationshp));
            }
        }

        $attributes["precio"] = $attributes["precio"] ?? 0;
        $attributes["estado"] = $attributes["estado"] ?? true;
        $attributes["id_usuario"] = 1;

        return $attributes;
    }

    public function categoria($relationship): array
    {
        $categoriaId = $relationship['data']['id'];
        
        $category = Categoria::where("id", $categoriaId)->first();
        return ['id_categoria' =>  $category->id];
    }
}
