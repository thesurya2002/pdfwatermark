<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

class ImageFileController extends Controller
{
    //
    public function imageFileUpload(Request $request)
    {

        $pdf = new \setasign\Fpdi\Fpdi();
        $image = $request->file('file');
        // dd($pdf);
        $pdf = new \setasign\Fpdi\Fpdi();

        $fileInput = $image->getRealPath();
        $pages_count = $pdf->setSourceFile($fileInput);
        for ($i = 1; $i <= $pages_count; $i ++) {
            $pdf->AddPage();
            $tplIdx = $pdf->importPage($i);
            $pdf->useTemplate($tplIdx, 0, 0);
            $pdf->SetFont('Times', 'B', 20);
            $pdf->SetTextColor(192, 192, 192);
            $watermarkText = 'SURYA';
            $this->addWatermark(140, 80, $watermarkText, 45, $pdf);
            $this->addWatermark(200, 120, $watermarkText, 45, $pdf);
            $this->addWatermark(260, 160, $watermarkText, 45, $pdf);

            $this->addWatermark(100, 160, $watermarkText, 45, $pdf);
            $this->addWatermark(160, 200, $watermarkText, 45, $pdf);
            $this->addWatermark(220, 240, $watermarkText, 45, $pdf);

            $this->addWatermark(60, 240, $watermarkText, 45, $pdf);
            $this->addWatermark(110, 280, $watermarkText, 45, $pdf);
            $this->addWatermark(170, 320, $watermarkText, 45, $pdf);

            $pdf->SetXY(25, 25);
        }
        $pdf->Output();
    }
        public function addWatermark($x, $y, $watermarkText, $angle, $pdf)
    {
        $angle = $angle * M_PI / 180;
        $c = cos($angle);
        $s = sin($angle);
        $cx = $x * 1;
        $cy = (300 - $y) * 1;
        $pdf->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, - $s, $c, $cx, $cy, - $cx, - $cy));
        $pdf->Text($x, $y, $watermarkText);
        $pdf->_out('Q');
    }
}
