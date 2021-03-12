<?php

namespace App\Services;

use PDF;

class PdfService
{
    public function download($filename, $view, $data)
    {
        $pdf = PDF::loadView($view, ['data' => $data]);

        return $pdf->download($filename . '.pdf');
    }

    public function show($filename, $view, $data)
    {
        $pdf = PDF::loadView($view, ['data' => $data]);
        $pdf->setPaper('A4', 'potrait');

        return $pdf->stream($filename . '.pdf');
    }
}
