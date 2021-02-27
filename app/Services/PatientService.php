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
}
