<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterNewPatientRequest extends FormRequest
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
            'name'                  => ['required'],
            'identification_number' => ['required', 'unique:patients'],
            'birthdate'             => ['required', 'before:tomorrow'],
            'gender'                => ['required'],
            'address'               => ['required'],
            'diagnosis'             => ['required'],
            'contact'               => ['required']
        ];
    }

    /**
     * Return message
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'                  => 'Nama pasien tidak boleh kosong',
            'identification_number.required' => 'No identifikasi tidak boleh kosong',
            'identification_number.unique'   => 'No identifikasi sudah terdaftar, daftarkan pasien dari menu pasien lama',
            'birthdate.required'             => 'Tanggal lahir pasien tidak boleh kosong',
            'birthdate.before'               => 'Tanggal lahir pasien tidak boleh melebihi hari ini',
            'gender.required'                => 'Jenis kelamin pasien tidak boleh kosong',
            'address.required'               => 'Alamat pasien tidak boleh kosong',
            'diagnosis.required'             => 'Diagnosis awal pasien tidak boleh kosong',
            'contact.required'               => 'Kontak pasien tidak boleh kosong',
        ];
    }
}
