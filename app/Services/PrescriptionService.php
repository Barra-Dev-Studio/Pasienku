<?php

namespace App\Services;

use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionService
{
    public function get($registration_id = null)
    {
        return Prescription::where('registration_id', $registration_id)->with('item')->get();
    }

    public function store(Request $request, $index)
    {
        return Prescription::create(
            [
                'registration_id'   => $request->registration_id,
                'item_id'           => $request->item_id[$index],
                'name'              => $request->name[$index],
                'use'               => $request->use[$index],
                'when'              => $request->when[$index],
                'total'              => $request->total[$index]
            ]
        );
    }

    public function delete(Request $request)
    {
        return Prescription::where('id', $request->id)->delete();
    }

    public function deleteFromRegistration(Request $request)
    {
        return Prescription::where('registration_id', $request->registration_id)->delete();
    }

    public function getAllData()
    {
        return Prescription::latest()->get();
    }
}
