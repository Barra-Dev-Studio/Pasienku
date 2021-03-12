<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterNewPatientRequest;
use App\Http\Requests\RegisterOldPatientRequest;
use App\Services\BillingService;
use App\Services\ItemService;
use App\Services\PdfService;
use App\Services\PrescriptionService;
use App\Services\RegistrationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use DB;

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
        try {

            DB::beginTransaction();

            $act = $registrationService->registerNewPatient($request);
            $registrationId = $act->id;
            $billing = $billingService->storeByRegistrationId($registrationId);

            DB::commit();

            if ($act) {
                return redirect("registration/$registrationId/detail")->with('success', 'Pendaftaran berhasil');
            } else {
                return back()->with('error', 'Pendaftaran gagal');
            }
        } catch (\Exception $error) {
            DB::rollback();
            return back()->with('error', 'Pendaftaran gagal');
        }
    }

    public function registerOldPatient(RegisterOldPatientRequest $request, RegistrationService $registrationService, BillingService $billingService)
    {
        try {
            DB::beginTransaction();

            $act = $registrationService->registerOldPatient($request);
            $registrationId = $act->id;
            $billing = $billingService->storeByRegistrationId($registrationId);

            DB::commit();

            if ($act) {
                return redirect("registration/$registrationId/detail")->with('success', 'Pendaftaran berhasil');
            } else {
                return back()->with('error', 'Pendaftaran gagal');
            }
        } catch (\Exception $error) {
            DB::rollback();
            return back()->with('error', 'Pendaftaran gagal');
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

    public function finalize(Request $request, RegistrationService $registrationService, BillingService $billingService, PrescriptionService $prescriptionService, ItemService $itemService)
    {
        try {
            DB::beginTransaction();

            $act = $registrationService->finalize($request);
            $completeBilling = $billingService->updatePayment($request);

            $prescriptionsData = $prescriptionService->get($request->registration_id);

            foreach ($prescriptionsData as $data) {
                $takeAStock = $itemService->useMultiple($request->registration_id, $data->item_id, $data->total);
            }

            DB::commit();

            if ($takeAStock) {
                return back()->with('success', 'Pendaftaran berhasil difinalisasi');
            } else {
                return back()->with('error', 'Pendaftaran gagal difinalisasi');
            }
        } catch (\Exception $error) {
            DB::rollback();
            return back()->with('error', 'Pendaftaran gagal difinalisasi');
        }
    }

    public function download($id, RegistrationService $registrationService, PdfService $pdfService)
    {
        $data = $registrationService->getDataWithPatient($id);

        return $pdfService->show('Billing_ ' . $data->registration_number, 'download.registration_info', $data);
    }
}
