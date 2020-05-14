<?php

include_once APPPATH . 'helps/fpdf/fpdf.php';
//require (APPPATH . 'helps/fpdf/PDF_JavaScript.php');
//
//class PDF_AutoPrint extends PDF_JavaScript
//{
//    function AutoPrint($printer='')
//    {
//        // Open the print dialog
//        if($printer)
//        {
//            $printer = str_replace('\\', '\\\\', $printer);
//            $script = "var pp = getPrintParams();";
//            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
//            $script .= "pp.printerName = '$printer'";
//            $script .= "print(pp);";
//        }
//        else
//            $script = 'print(true);';
//        $this->IncludeJS($script);
//    }
//}
//$cheque->x

$this->pdf = new PDF('L', 'mm', array(198, 47.5)); //por defecto A4
$this->pdf->SetMargins(10, 1, 10);
$this->pdf->SetAutoPageBreak(true, 10);
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
foreach ($cheques->result() as $cheque) {
    if ($cheque->monto > 0) {
        $this->pdf->AddPage('L', array(198, 47.5));

        // $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $this->pdf->SetFont('Courier', '', 6);
        $this->pdf->Cell(180, 10, '', '0', 0, 'R', '0');
        $this->pdf->Cell(9, 10, strtoupper(substr($cheque->name, 0, 3)), '0', 0, 'R', '0');
        $this->pdf->Ln(5);
        $this->pdf->Cell(180, 10, '', '0', 0, 'R', '0');
        $this->pdf->Cell(9, 10, strtoupper(substr($cheque->name, 0, 3)), '0', 0, 'R', '0');
        $this->pdf->Ln(4);
        $this->pdf->SetFont('Helvetica', '', 11);


        $fecha = $cheque->fecha_cheque;
//$fechaV=explode("-", $fecha);

        $dia = date("d", strtotime($fecha));
        $mes = date("m", strtotime($fecha));
        $anio = date("Y", strtotime($fecha));
        $this->pdf->SetXY(10, 10);
        $this->pdf->Cell(97, 10, '', '0', 0, 'C', '0');
        $this->pdf->Cell(23, 10, 'La Paz', '0', 0, 'C', '0');
        $this->pdf->Cell(15, 10, $dia, '0', 0, 'C', '0');
        $this->pdf->Cell(27, 10, utf8_decode($meses[$mes - 1]), '0', 0, 'C', '0');
        $this->pdf->Cell(15, 10, $anio, '0', 0, 'C', '0');

        $this->pdf->Ln(10);

//$this->pdf->Cell(27, 7, "", '0', 0, 'R', '0');

        $dirigidosep = explode(":", $cheque->dirigido);
        $cantidad = count($dirigidosep);
        if ($cantidad <= 1) {

            $this->pdf->SetXY(37, 21);
            $this->pdf->SetFont('Helvetica', 'B', 10);

            $this->pdf->Cell(110, 7, utf8_decode($cheque->dirigido), '0', 0, 'L', '0');
        } else {
            $this->pdf->SetFont('Helvetica', 'B', 8);
            //$this->pdf->Cell(110, 7, utf8_decode($dirigidosep[0]), '0', 0, 'L', '0');
            $this->pdf->SetXY(37, 19.5);
            $this->pdf->Write(7, $dirigidosep[0] . ":");
            $xdir = $this->pdf->GetX();
            $this->pdf->SetXY($xdir, 19);
            $this->pdf->SetFont('Helvetica', 'B', 12);
            //$this->pdf->Cell(0, 7, utf8_decode($dirigidosep[1]), '0', 0, 'L', '0');
            $this->pdf->Write(7, $dirigidosep[1]);
//$this->pdf->text($xdir, 24, "XXXXXXXXXXXXX");
        }
        $this->pdf->SetFont('Helvetica', 'B', 12);
//$this->pdf->Cell(110, 7, "", '0', 0, 'R', '0');
//$this->pdf->Cell(5, 0, "", '0', 0, 'R', '0');
        $this->pdf->SetXY(152, 20);
        $this->pdf->Cell(35, 7, number_format($cheque->monto, 2, ",", "."), '0', 0, 'C', '0');

        $this->pdf->SetFont('Helvetica', '', 5);
        $this->pdf->Cell(3, 10, '', '0', 0, 'R', '0');
        $this->pdf->Cell(9, 10, $cheque->id_cheque, '0', 0, 'R', '0');




        $this->pdf->Ln(4);
        $this->pdf->Cell(27, 10, "", '0', 0, 'R', '0');
        $this->pdf->SetFont('Helvetica', '', 10);
        $this->pdf->Cell(140, 10, utf8_decode($literal[$cheque->id_cheque]), '0', 0, 'L', '0');
        $this->pdf->SetFont('Helvetica', '', 5);
        $this->pdf->Cell(13, 10, '', '0', 0, 'R', '0');
        $this->pdf->Cell(9, 10, $cheque->id_cheque, '0', 0, 'R', '0');
    }
}



$this->pdf->AliasNbPages();
$this->pdf->Output('cheques_STS_', 'I');
?>