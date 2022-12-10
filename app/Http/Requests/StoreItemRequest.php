<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'price' => 'required|numeric',
            'type' => 'required',
            'category_id' => 'nullable|array|exists:categories,id',
            'trailer' => 'nullable',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Nombre',
            'description' => 'Descripción',
            'image' => 'Imagen',
            'price' => 'Precio',
            'type' => 'Tipo',
            'category_id' => 'Categoría',
            'trailer' => 'Trailer',
        ];
    }
}
