<?php

namespace App\Http\Controllers;

use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function getListPatients(Request $request, PatientService $patientService)
    {
        $data = $this->_toSelect2Format($patientService->search($request->search)->toArray(), ['text' => 'name', 'identification_number' => 'identification_number']);
        return response()->json($data);
    }

    public function getPatient(Request $request, PatientService $patientService)
    {
        return response()->json($patientService->get($request));
    }

    private function _toSelect2Format($data = [], $column = [])
    {
        $formatedSelect2 = [];

        for ($indexData = 0, $countData = count($data); $indexData < $countData; $indexData++) {
            $formatedSelect2[$indexData] = ['id' => $data[$indexData]['id'], 'text' => $data[$indexData][$column['text']], 'identification_number' => $data[$indexData][$column['identification_number']]];
        }

        return $formatedSelect2;
    }
}
