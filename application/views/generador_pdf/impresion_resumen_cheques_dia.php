<?php

include_once APPPATH . 'helps/fpdf/fpdf.php';
$this->pdf = new PDF(); //por defecto A4
//if ($datos_rendicion_detalle_traA->num_rows() > 0) {
//cabecera
$this->pdf->AddPage();
$this->pdf->SetFont('Arial', 'B', 20);
$this->pdf->Cell(190, 10, 'Resumen Cheques Generados ', '', 0, 'L', '0');

//$this->pdf->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 5, 5, 30, 'jpg');
$this->pdf->SetFont('Arial', '', 14);
$this->pdf->Ln(12);
$this->pdf->Cell(190, 4, $fecha_sol, '', 0, 'L', '0');

$this->pdf->Ln(7);
$this->pdf->SetFont('Arial', 'B', 12);
$x1 = $this->pdf->getX();
$y1 = $this->pdf->getY();
$this->pdf->SetLineWidth(.7);
$this->pdf->line($x1, $y1, 190, $y1);

foreach ($cheque->result() as $fila) {
    $this->pdf->SetWidths(array(35, 90, 30, 20));
    $this->pdf->SetAligns(array('J', 'J', 'R', 'J'));
    $x1 = $this->pdf->getX();
    $y1 = $this->pdf->getY();
    //  number_format($number);
    $datos = array($fila->nombre, utf8_decode($fila->dirigido), number_format($fila->monto, 2, '.', ','), $fila->tipo_cheque);
    $tam_font = array(8, 8, 11, 7);
    $format_font = array('','','','');
    $this->pdf->RowBodyResumen($datos, 5, $tam_font,$format_font,0);
     $datos = array("Titular:", "**" . utf8_decode($fila->detalle_dirigido_a)."**","","");
  $format_font = array('','BI','','');
  $this->pdf->SetAligns(array('R', 'J', 'R', 'J'));
    $this->pdf->RowBodyResumen($datos, 5, $tam_font,$format_font,1);
    $y2 = $this->pdf->getY();
    // $this->pdf->line($x1, $y1, $x1, $y2);
    //$this->pdf->line(168, $y1, 168, $y2);
    //$this->pdf->line(200, $y1, 200, $y2);
}

// }   


$this->pdf->AliasNbPages();
$this->pdf->Output('rend_rembolso', 'I');
?>