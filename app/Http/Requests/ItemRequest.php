<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => ['required', 'unique:items,name']
        ];
    }

    /**
     * Get message
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Kolom nama item tidak boleh kosong',
            'name.unique' => 'Item sudah tersedia, gunakan nama lain'
        ];
    }
}
