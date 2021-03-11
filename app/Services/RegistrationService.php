<?php

namespace App\Services;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Services\PatientService;

class RegistrationService
{
    private $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function registerNewPatient(Request $request)
    {
        $registerPatient = $this->patientService->store($request);
        $patient_id      = $registerPatient->id;

        return $this->_register($request, $patient_id);
    }

    public function registerOldPatient(Request $request)
    {
        $patientData = $this->patientService->get($request);
        $patient_id  = $patientData->id;

        return $this->_register($request, $patient_id);
    }

    public function updateRegistration(Request $request)
    {
        return Registration::where('id', $request->id)->update(
            [
                'diagnosis' => $request->diagnosis
            ]
        );
    }

    public function updateRegistrationStatus(Request $request, $status = 'ONGOING')
    {
        return Registration::where('id', $request->id)->update(
            [
                'status' => $status
            ]
        );
    }

    public function getDataWithPatient($id)
    {
        return Registration::where('id', $id)->with(['patient', 'diagnose', 'billing.detail.prescription.item'])->first();
    }

    public function getAllData()
    {
        return Registration::with('patient')->latest()->get();
    }

    public function getHistory($patient_id)
    {
        return Registration::where('patient_id', $patient_id)->get();
    }

    public function finalize(Request $request)
    {
        return Registration::where('id', $request->registration_id)->update(
            [
                'status' => 'SUCCESS'
            ]
        );
    }

    private function _register(Request $request, $patient_id)
    {
        return Registration::create(
            [
                'patient_id' => $patient_id,
                'registration_number' => $this->_createRegistrationNumber(),
                'diagnosis' => $request->diagnosis
            ]
        );
    }

    private function _createRegistrationNumber()
    {
        $getTotalRegisteredPatientToday = Registration::where('created_at', date('Y-m-d'))->count();
        $registrationNumber = date('Ymd') . '-' . ($getTotalRegisteredPatientToday + 1);

        return $registrationNumber;
    }
}
