<?php

namespace App\Http\Controllers;

use App\Services\BillingDetailService;
use App\Services\BillingService;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function updateMultiple(Request $request, BillingDetailService $billingDetailService, BillingService $billingService)
    {
        for ($index = 0, $totalData = count($request->id); $index < $totalData; $index++) {
            $act = $billingDetailService->updateMultiple($request, $index);
            $updateBilling = $billingService->updatePrice($request, $index);
        }


        if ($act) {
            return back()->with('success', 'Detail pembayaran berhasil disimpan');
        } else {
            return back()->with('error', 'Detail pembayaran gagal disimpan');
        }
    }
}
