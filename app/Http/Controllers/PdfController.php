<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZanySoft\LaravelPDF\PDF;

class PdfController extends Controller
{

    function pdf()
    {

        $data = [
            'foo' => 'bar'
        ];
        $pdf = new PDF();
        $pdf->loadView('pdf.document', $data);
        return $pdf->stream('document.pdf');
    }
}
