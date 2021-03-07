<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterOldPatientRequest extends FormRequest
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
            'id'        => ['required', 'exists:patients,id'],
            'diagnosis' => ['required']
        ];
    }

    /**
     * Get messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'id.required'        => 'Pilih nama pasien terlebih dahulu',
            'id.exists'          => 'Pasien tidak ditemukan di dalam data sistem, lakukan pendaftaran pasien baru terlebih dahulu',
            'diagnosis.required' => 'Diagnosis awal pasien tidak boleh kosong'
        ];
    }
}
