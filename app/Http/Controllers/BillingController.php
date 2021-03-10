<?php

namespace App\Http\Controllers;

use App\Services\BillingDetailService;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function updateMultiple(Request $request, BillingDetailService $billingDetailService)
    {
        for ($index = 0, $totalData = count($request->id); $index < $totalData; $index++) {
            $act = $billingDetailService->updateMultiple($request, $index);
        }

        if ($act) {
            return back()->with('success', 'Resep berhasil disimpan');
        } else {
            return back()->with('error', 'Resep gagal disimpan');
        }
    }
}
