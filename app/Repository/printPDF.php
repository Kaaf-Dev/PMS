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


        // Use Blade view
        $html = view($view, compact('data'))->render();
        $document->WriteHTML($html);

        return $document->Output('', "S");

        // Output PDF to browser
    }

    static public function createContractPdf($data, $view, $format = 'A4', $isContract = false)
    {
        // Create the mPDF document
        $document = new Mpdf([
            'format' => $format,
            'margin_top' => '45',  // Adjusted margin to prevent text overlapping the header
            'margin_bottom' => '50', // Adjusted margin to prevent text overlapping the footer
            'margin_left' => '0',
            'margin_right' => '0',
        ]);

        $document->autoScriptToLang = true;
        $document->autoLangToFont = true;
        $document->useAdobeCJK = true;

        // Add header if it's a contract
        if ($isContract) {
            $headerHtml = '<div class="header" style="text-align: center;">
            <img src="' . public_path('admin-assets/media/imgs/contract-header.png') . '" alt="Contract Header" style="width: 100%;">
        </div>';
            $document->SetHTMLHeader($headerHtml, 'O'); // 'O' ensures it appears on every page

            $footerHtml = '<div class="footer" style="text-align: center;">
            <img src="' . public_path('admin-assets/media/imgs/contract-footer.png') . '" alt="Contract Footer" style="width: 100%;">
        </div>';
            $document->SetHTMLFooter($footerHtml, 'O');
        }

        // Render the Blade view
        $html = view($view, compact('data'))->render();
        $document->WriteHTML($html);

        return $document->Output('', "S"); // Output PDF as a string
    }

}
