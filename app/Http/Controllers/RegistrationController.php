<?php

namespace App\Http\Controllers;

use App\Services\RegistrationService;
use Illuminate\Http\Request;
use DataTables;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('registration.index');
    }

    public function show($id, RegistrationService $registrationService)
    {
        $detail = $registrationService->getDataWithPatient($id);

        return view('registration.show', compact('detail'));
    }

    public function indexlist()
    {
        return view('registration.list');
    }

    public function list(RegistrationService $registrationService)
    {
        $data = $registrationService->getAllData();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return "<div class='btn-group'>
                        <a class='btn btn-primary btn-sm detailButton' href='" . route('registration_show', $data->id) . "'>
                            <i class='anticon anticon-search'></i>
                        </a>
                    </div>";
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function registerNewPatient(Request $request, RegistrationService $registrationService)
    {
        $act = $registrationService->registerNewPatient($request);
        $registrationId = $act->id;

        if ($act) {
            return redirect("registration/$registrationId/detail")->with('success', 'Pendaftaran berhasil');
        } else {
            return redirect()->back()->with('error', 'Pendaftaran gagal');
        }
    }

    public function registerOldPasien(Request $request, RegistrationService $registrationService)
    {
        $act = $registrationService->registerOldPasien($request);
        $registrationId = $act->id;

        if ($act) {
            return redirect("registration/$registrationId/detail")->with('success', 'Pendaftaran berhasil');
        } else {
            return redirect()->back()->with('error', 'Pendaftaran gagal');
        }
    }
}
