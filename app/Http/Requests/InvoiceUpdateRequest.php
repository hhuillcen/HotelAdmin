<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceUpdateRequest extends FormRequest
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
            'status' => 'required',
            'description' => 'nullable',
            'price' => 'nullable|numeric',
        ];
    }

    /**
     * Nombres de atributos
     */
    public function attributes()
    {
        return [
            'status' => 'Estado del pedido',
            'description' => 'Descripción',
            'price' => 'Precio',
        ];
    }

}
