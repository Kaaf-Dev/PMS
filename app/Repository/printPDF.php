<?php

namespace App\Repository;

use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;

class printPDF
{
   static public function createPdf($data, $view, $format = 'A4')
    {
        // Create the mPDF document
        $document = new Mpdf([
            'format' => $format,
            'margin_header' => '0',
            'margin_top' => '0',
            'margin_left' => '0',
            'margin_right' => '0',
            'margin_bottom' => '0',
            'margin_footer' => '0',
        ]);

        $document->autoScriptToLang = true;
        $document->autoLangToFont = true;
        $document->useAdobeCJK = true;

        // Use Blade if you want
        $document->WriteHTML(view($view, compact('data')));

        return $document->Output('', "S");

        // Output PDF to browser
    }
}
