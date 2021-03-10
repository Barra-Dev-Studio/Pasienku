<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterNewPatientRequest;
use App\Http\Requests\RegisterOldPatientRequest;
use App\Services\BillingService;
use App\Services\PrescriptionService;
use App\Services\RegistrationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('registration.index');
    }

    public function show($id, RegistrationService $registrationService, PrescriptionService $prescriptionService)
    {
        $detail = $registrationService->getDataWithPatient($id);
        $prescriptions = $prescriptionService->get($id);

        return view('registration.show', compact('detail', 'prescriptions'));
    }

    public function indexlist()
    {
        return view('registration.list');
    }

    public function list(RegistrationService $registrationService)
    {
        $data = $registrationService->getAllData();
        return DataTables::of($data)
            ->addColumn('date', function ($data) {
                return Carbon::parse($data->created_at)->format('d-m-Y H:i');
            })
            ->addColumn('action', function ($data) {
                return "<div class='btn-group'>
                        <a class='btn btn-primary btn-sm detailButton' href='" . route('registration_show', $data->id) . "'>
                            <i class='anticon anticon-search'></i>
                        </a>
                    </div>";
            })
            ->rawColumns(['action', 'date'])
            ->addIndexColumn()
            ->make(true);
    }

    public function registerNewPatient(RegisterNewPatientRequest $request, RegistrationService $registrationService, BillingService $billingService)
    {
        $act = $registrationService->registerNewPatient($request);
        $registrationId = $act->id;
        $billing = $billingService->storeByRegistrationId($registrationId);

        if ($act) {
            return redirect("registration/$registrationId/detail")->with('success', 'Pendaftaran berhasil');
        } else {
            return redirect()->back()->with('error', 'Pendaftaran gagal');
        }
    }

    public function registerOldPatient(RegisterOldPatientRequest $request, RegistrationService $registrationService, BillingService $billingService)
    {
        $act = $registrationService->registerOldPatient($request);
        $registrationId = $act->id;
        $billing = $billingService->storeByRegistrationId($registrationId);

        if ($act) {
            return redirect("registration/$registrationId/detail")->with('success', 'Pendaftaran berhasil');
        } else {
            return redirect()->back()->with('error', 'Pendaftaran gagal');
        }
    }

    public function history(Request $request, RegistrationService $registrationService)
    {
        $data = $registrationService->getHistory($request->id);

        return DataTables::of($data)
            ->addColumn('date', function ($data) {
                return Carbon::parse($data->created_at)->format('d-m-Y');
            })
            ->addColumn('action', function ($data) {
                return "<div class='btn-group'>
                        <a class='btn btn-primary btn-sm' href='" . route('registration_show', $data->id) . "'>
                            <i class='anticon anticon-search'></i>
                        </a>
                    </div>";
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
