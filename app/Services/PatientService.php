<?php

namespace App\Services;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientService
{
    public function store(Request $request)
    {
        return Patient::create(
            [
                'name' => $request->name,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'identification_number' => $request->identification_number,
                'address' => $request->address,
                'contact' => $request->contact,
            ]
        );
    }

    public function update(Request $request)
    {
        return Patient::where('id', $request->id)->update(
            [
                'name' => $request->name,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'identification_number' => $request->identification_number,
                'address' => $request->address,
                'contact' => $request->contact,
            ]
        );
    }

    public function get(Request $request)
    {
        return Patient::where('id', $request->id)->first();
    }

    public function delete(Request $request)
    {
        return Patient::where('id', $request->id)->delete();
    }

    public function getAllData()
    {
        return Patient::order_by('name', 'asc')->get();
    }

    public function getAllDataWithCredential($credential = null)
    {
        return Patient::where($credential)->orderby('name', 'asc')->get();
    }

    public function search($key = null)
    {
        return Patient::where('name', 'like', "%$key%")->orwhere('identification_number', 'like', "%$key%")->orderby('name', 'asc')->get();
    }
}
