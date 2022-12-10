<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'room_id' => 'required',
            'room_status' => 'required',
            'entry_time' => 'required',
            'exit_time' => 'required',
        ];
    }

    /**
     * Nombres de atributos
     */
    public function attributes()
    {
        return [
            'room_id' => 'ID de la sala',
            'room_status' => 'Estado de la sala',
            'entry_time' => 'Hora de entrada',
            'exit_time' => 'Hora de salida',
        ];
    }
}
