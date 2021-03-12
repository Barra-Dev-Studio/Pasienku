<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewUserRequest extends FormRequest
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
            'name' => ['required', 'min:4'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed']
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
            'name.required' => 'Kolom nama tidak boleh kosong',
            'name.min' => 'Nama minimal memiliki panjang 4 karakter',
            'email.required' => 'Kolom email tidak boleh kosong',
            'email.email' => 'Email harus diisi dengan benar',
            'email.unique' => 'Email sudah digunakan, gunakan email lain',
            'password.required' => 'Kolom password tidak boleh kosong',
            'password.min' => 'Password minimal memiliki panjang 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai'
        ];
    }
}
