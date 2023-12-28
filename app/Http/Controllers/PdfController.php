<?php

namespace App\Http\Controllers;

use ZanySoft\LaravelPDF\PDF;

class PdfController extends Controller
{
    public function pdf()
    {

        $data = [
            'name' => 'John Doe',
            'address' => '123 Main St.',
            'phone' => '123-456-7890',
            'body' => 'This is the body of the PDF file.',
        ];
        $pdf = new PDF();
        $pdf->loadView('pdf.document', $data);

        return $pdf->stream('document.pdf');
    }
}
