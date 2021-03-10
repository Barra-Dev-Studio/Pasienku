<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrescriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => ['required_unless:item_id'],
            'use'   => ['required'],
            'when'  => ['required']
        ];
    }

    /**
     * Get Messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'name.required_unless'  => 'Kolom nama tidak boleh kosong jika tidak ada item yang ditambahkan',
            'use.required'          => 'Penggunaan obat tidak boleh kosong',
            'when'                  => 'Waktu penggunaan obat tidak boleh kosong'
        ];
    }
}
