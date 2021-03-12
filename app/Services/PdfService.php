<?php

namespace App\Services;

use PDF;

class PdfService
{
    public function download($filename, $view, $data)
    {
        $pdf = PDF::loadView($view, $data);

        return $pdf->download($filename . '.pdf');
    }

    public function show($filename, $view, $data)
    {
        $pdf = PDF::loadView($view, $data);

        return $pdf->stream($filename . '.pdf');
    }
}
