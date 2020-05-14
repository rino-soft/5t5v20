<?php

include_once APPPATH . 'helps/fpdf/fpdf.php';
include_once APPPATH . 'helps/barcode/php-barcode.php';

$this->pdf = new PDF('', 'pt', 'A4'); //por defecto A4
/* $this->pdf->SetMargins(10, 1, 10);
  $this->pdf->SetAutoPageBreak(true, 10); */
$this->pdf->AddPage('');
//$this->pdf->Cell(150, 15, 'Fecha Registro : ', '', 0, 'J', '0');










$fontSize = 9;
$marge = 1;   // between barcode and hri in pixel
$x = 30;  // barcode center
$y = 10;  // barcode center
$height = 6;   // barcode height in 1D ; module size in 2D	
$width = 0.4;    // barcode height in 1D ; not use in 2D
$angle = 0;   // rotation in degrees

$code = 100381; // barcode, of course ;)

for ($i = 1; $i <= 26; $i++) {
    for ($j = 1; $j <= 4; $j++) {

        $type = 'code39';
        $black = '000000'; // color in hexa

        $data = Barcode::fpdf($this->pdf, $black, $x, $y, $angle, $type, array('code' => $code), $width, $height);

        $this->pdf->SetFont('Arial', 'B', $fontSize);
        $this->pdf->SetTextColor(0, 0, 0);
        $len = $this->pdf->GetStringWidth($data['hri']);
        Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
        $this->pdf->TextWithRotation($x + $xt, $y + $yt - 7, "*" . $code . "*", $angle);

        $x = $x + 50;
        $code++;
		$code++;
        if ($code == 100242) {
            $this->pdf->AddPage();
            $x = 30;  // barcode center
            $y = 10;
        }
    }
    $x = 30;
    $y = $y + 15;
}






$this->pdf->AliasNbPages();
$this->pdf->Output('ticketActivosFijo_', 'I');
?>