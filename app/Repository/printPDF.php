<?php

namespace App\Repository;

use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;

class printPDF
{
    public function createPdf($data, $view, $format = 'A4', $storage_path)
    {
        $documentFileName = $data->id . '.pdf';
        // Create the mPDF document
        $document = new Mpdf([
            'autoArabic' => true,
            'mode' => 'utf-8',
            'format' => $format,
            'margin_header' => '0',
            'margin_top' => '10',
            'margin_bottom' => '0',
            'margin_footer' => '0',
        ]);
        // Set some header information for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        ];
        // Use Blade if you want
        $document->WriteHTML(view($view, compact('data')));
        $document->autoLangToFont = true;
        $document->autoScriptToLang = true;
        $document->autoLangToFont = true;
        // Save PDF on your public storage
        Storage::disk($storage_path)->put($documentFileName, $document->Output($documentFileName, "S"));
        $pdf = Storage::disk($storage_path)->download($documentFileName, 'Request', $header);
        return $pdf;
    }
}
