<?php

namespace App\app_interfaces;
use PDF;

interface pdfInterface{
    public function generate_pdf($data);
}

class PdfDoc implements pdfInterface  {

    
    function generate_pdf($data)
    {
        $pdf = PDF::loadView('reports.salesActivityReport', $data);
	    $pdf->save(public_path().'/Reports/'.time().'.pdf');
    }
    
}

//App::bind('pdfInterface', 'pdfDoc');

?>