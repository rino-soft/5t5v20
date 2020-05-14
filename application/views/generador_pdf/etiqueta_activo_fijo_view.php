<?php

include_once APPPATH . 'helps/fpdf/fpdf.php';
include_once APPPATH . 'helps/barcode/php-barcode.php';

$this->pdf = new PDF('L', 'pt', 'A4'); //por defecto A4
/* $this->pdf->SetMargins(10, 1, 10);
  $this->pdf->SetAutoPageBreak(true, 10); */
$this->pdf->AddPage('L');
 //$this->pdf->Cell(150, 15, 'Fecha Registro : ', '', 0, 'J', '0');
if ($datos_salida->num_rows() > 0) {
    $fila = $datos_salida->row();
    if ($fila->SN != "") {

       // $this->pdf->Cell(150, 15, 'Fecha Registro : ', '', 0, 'J', '0');
        $fontSize = 10;
        $marge = 10;   // between barcode and hri in pixel
        $x = 150;  // barcode center
        $y = 16;  // barcode center
        $height = 10;   // barcode height in 1D ; module size in 2D
        $width = 1.3;    // barcode height in 1D ; not use in 2D
        $angle = 0;   // rotation in degrees

        $code = $fila->SN; // barcode, of course ;)
        $type = 'code39';
        $black = '000000'; // color in hexa
// -------------------------------------------------- //
//            ALLOCATE FPDF RESSOURCE
// -------------------------------------------------- //
// $pdf = new eFPDF('P', 'pt');
// $pdf->AddPage();
// -------------------------------------------------- //
//                      BARCODE
// -------------------------------------------------- //
        $this->pdf->Image(base_url() . 'imagenesweb/recursos/logogrande3.jpg', 4, 87, 290);
        $data = Barcode::fpdf($this->pdf, $black, $x, $y, $angle, $type, array('code' => $code), $width, $height);

// -------------------------------------------------- //
//                      HRI
// -------------------------------------------------- //

        $this->pdf->SetFont('Arial', 'B', $fontSize);
        $this->pdf->SetTextColor(0, 0, 0);
        $len = $this->pdf->GetStringWidth($data['hri']);
        Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
        $this->pdf->TextWithRotation($x + $xt - 35, $y + $yt - 46, 'SN : *' . $data['hri'] . '*', $angle);
        $fontSize = 50;
        $marge = 10;   // between barcode and hri in pixel
        $x = 150;  // barcode center
        $y = 62;  // barcode center
        $height = 30;   // barcode height in 1D ; module size in 2D	
        $width = 1.6;    // barcode height in 1D ; not use in 2D
        $angle = 0;   // rotation in degrees

        $code = $fila->cod_prop_sts_equipo; // barcode, of course ;)
        $type = 'code39';
        $black = '000000'; // color in hexa

        $data = Barcode::fpdf($this->pdf, $black, $x, $y, $angle, $type, array('code' => $code), $width, $height);

        $this->pdf->SetFont('Arial', 'B', $fontSize);
        $this->pdf->SetTextColor(0, 0, 0);
        $len = $this->pdf->GetStringWidth($data['hri']);
        Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
        $this->pdf->TextWithRotation($x + $xt - 70, $y + $yt - 45, "*".$fila->sigla_region." ".$fila->sigla_subregion." ".$fila->tipo_proyecto." ".$fila->id_proy."*" . $data['hri'] . "*", $angle);
    } else {
        $this->pdf->Image(base_url() . 'imagenesweb/recursos/logogrande3.jpg', 4, 87, 290);
        $fontSize = 50;
        $marge = 10;   // between barcode and hri in pixel
        $x = 150;  // barcode center
        $y = 40;  // barcode center
        $height = 60;   // barcode height in 1D ; module size in 2D	
        $width = 1.6;    // barcode height in 1D ; not use in 2D
        $angle = 0;   // rotation in degrees

        $code = $fila->cod_prop_sts_equipo; // barcode, of course ;)
        $type = 'code39';
        $black = '000000'; // color in hexa

        $data = Barcode::fpdf($this->pdf, $black, $x, $y, $angle, $type, array('code' => $code), $width, $height);

        $this->pdf->SetFont('Arial', 'B', $fontSize);
        $this->pdf->SetTextColor(0, 0, 0);
        $len = $this->pdf->GetStringWidth($data['hri']);
        Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
        $this->pdf->TextWithRotation($x + $xt - 70, $y + $yt - 45,"*".$fila->sigla_region." ".$fila->sigla_subregion." ".$fila->tipo_proyecto." ".$fila->id_proy."*" . $data['hri'] . "*", $angle);
    }


// $pdf->SetTextColor(255, 255, 255);

    $this->pdf->SetY(79);
//$pdf->Cell(150, 25, 'Ingreso Nro: 10042', '', 0, 'J', '0');
    $this->pdf->Ln(20);
    $this->pdf->SetX(105);
    $this->pdf->SetFont('Arial', 'B', 37);
    $this->pdf->Cell(150, 15, 'Fecha Registro : '.date('d/m/Y',  strtotime($fila->fh_reg)), '', 0, 'J', '0');

    $this->pdf->Ln(14);
    $this->pdf->SetX(105);
    $this->pdf->SetFont('Arial', 'B', 25);
    $this->pdf->Cell(150, 20, 'Sistema de Gestion Online *GO!* ', '', 0, 'J', '0');
    $this->pdf->Ln(10);
    $this->pdf->SetX(105);

    $this->pdf->SetFont('Arial', 'B', 20);
    $this->pdf->Cell(150, 15, 'Depto. de Almacenes y control de Activos Fijos ', '', 0, 'J', '0');
    $this->pdf->Ln(7);
    $this->pdf->SetX(105);
    $this->pdf->SetFont('Arial', 'B', 15);
    $this->pdf->Cell(180, 15, 'by D-TIC STS Bolivia Ltda', '', 0, 'R', '0');
}




$this->pdf->AliasNbPages();
$this->pdf->Output('ticketActivosFijo_', 'I');
?>