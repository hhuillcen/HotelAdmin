<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetailRequest extends FormRequest
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
            'invoice_id' => 'required',
            'item_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ];
    }

    /**
     * Nombres de atributos
     */
    public function attributes()
    {
        return [
            'invoice_id' => 'Factura',
            'item_id' => 'Producto',
            'price' => 'Precio',
            'quantity' => 'Cantidad',
        ];
    }
}
