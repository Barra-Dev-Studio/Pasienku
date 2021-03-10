<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Http\Request;
use DataTables;

class PatientController extends Controller
{
    public function index()
    {
        return view('patient.index');
    }

    public function show($id)
    {
        $detail = Patient::where('id', $id)->first();

        return view('patient.show', compact('detail'));
    }

    public function list(PatientService $patientService)
    {
        $data = $patientService->getAllData();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return "<div class='btn-group'>
                        <a class='btn btn-primary btn-sm' href='" . route('patient_show', $data->id) . "'>
                            <i class='anticon anticon-search'></i>
                        </a>
                    </div>";
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function update(PatientRequest $request, PatientService $patientService)
    {
        $act = $patientService->update($request);

        if ($act) {
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
    }

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
