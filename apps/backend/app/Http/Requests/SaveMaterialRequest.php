<?php

namespace App\Http\Requests;

use App\Rules\Codigo;
use Illuminate\Foundation\Http\FormRequest;

class SaveMaterialRequest extends FormRequest
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
            "data.attributes.codigo" => ["required", "alpha_dash", new Codigo()],
            "data.attributes.nombre" => ["required"],
            "data.attributes.descripcion" => [],
            "data.attributes.estado" => [],
            "data.attributes.stock" => [],
            "data.attributes.unidad" => ["required"]
        ];
    }

    public function validated($key = 'data.attributes', $default = null)
    {
        $data = parent::validated()['data'];
        $attributes = $data['attributes'] ;

        return $attributes;
    }
}
