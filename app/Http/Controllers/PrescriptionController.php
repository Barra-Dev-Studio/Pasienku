<?php

namespace App\Http\Controllers;

use App\Services\BillingDetailService;
use App\Services\ItemService;
use App\Services\PdfService;
use App\Services\PrescriptionService;
use App\Services\RegistrationService;
use Illuminate\Http\Request;
use DB;

class PrescriptionController extends Controller
{
    public function store(Request $request, PrescriptionService $prescriptionService, ItemService $itemService, BillingDetailService $billingDetailService)
    {
        try {
            DB::beginTransaction();

            $prescriptionService->deleteFromRegistration($request);
            $billingDetailService->deleteFromRegistration($request);

            for ($index = 0, $totalData = count($request->item_id); $index < $totalData; $index++) {
                $act = $prescriptionService->store($request, $index);
                $prescriptionId = $act->id;

                $billingDetailService->storeMultiple($request, $prescriptionId, $index);
            }

            DB::commit();

            if ($act) {
                return back()->with('success', 'Resep berhasil disimpan');
            } else {
                return back()->with('error', 'Resep gagal disimpan');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan. Resep gagal disimpan');
            // print_r($e->getMessage());
        }
    }

    public function download($id, RegistrationService $registrationService, PdfService $pdfService)
    {
        $data = $registrationService->getDataWithPatient($id);

        return $pdfService->show('Resep_Obat_' . $data->registration_number, 'download.prescription_info', $data);
    }
}
