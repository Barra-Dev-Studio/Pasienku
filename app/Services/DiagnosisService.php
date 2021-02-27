<?php

namespace App\Services;

use App\Models\Diagnosis;
use Illuminate\Http\Request;

class DiagnosisService
{
    public function store(Request $request)
    {
        return Diagnosis::create(
            [
                'registration_id' => $request->registration_id,
                'blood_pressure' => $request->blood_pressure,
                'further_diagnosis' => $request->further_diagnosis
            ]
        );
    }

    public function update(Request $request)
    {
        return Diagnosis::where('id', $request->id)->update(
            [
                'blood_pressure' => $request->blood_pressure,
                'further_diagnosis' => $request->further_diagnosis
            ]
        );
    }

    public function delete(Request $request)
    {
        return Diagnosis::where('id', $request->id)->delete();
    }

    public function updateOrCreate(Request $request)
    {
        return Diagnosis::updateOrCreate(
            ['registration_id' => $request->registration_id],
            [
                'registration_id' => $request->registration_id,
                'blood_pressure' => $request->blood_pressure,
                'further_diagnosis' => $request->further_diagnosis
            ]
        );
    }
}
