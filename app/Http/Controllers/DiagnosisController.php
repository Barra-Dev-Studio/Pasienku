<?php

namespace App\Http\Controllers;

use App\Services\DiagnosisService;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function updateOrCreate(Request $request, DiagnosisService $diagnosisService)
    {
        $act = $diagnosisService->updateOrCreate($request);

        if ($act) {
            return redirect()->back()->with('success', 'Berhasil menyimpan data diagnosis');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data diagnosis');
        }
    }
}
