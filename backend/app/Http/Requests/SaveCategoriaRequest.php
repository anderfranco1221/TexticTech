<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCategoriaRequest extends FormRequest
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
            "data.attributes.nombre" => ["required"],
            "data.attributes.descripcion" => []
        ];
    }

    public function validated($key = "data.attributes", $default = null)
    {
        $data = parent::validated()["data"];
        $attributes = $data["attributes"];

        return $attributes;
    }
}
