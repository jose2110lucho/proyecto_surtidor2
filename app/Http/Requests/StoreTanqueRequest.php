<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTanqueRequest extends FormRequest
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
            'codigo' => 'required | max:30 | min:1',
            'combustible' => 'required | max:30 | min:1',
            'capacidad_max' => 'required',
            'estado' => 'required',
            'cantidad_disponible' => 'required'
        ];
    }
}
