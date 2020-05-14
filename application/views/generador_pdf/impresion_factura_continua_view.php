<?php

include_once APPPATH . 'helps/fpdf/fpdf.php';

$this->pdf = new PDF('P', 'mm', array($ancho, $alto)); //por defecto A4
$this->pdf->SetMargins(3, 3, 3);
$this->pdf->SetAutoPageBreak(true, 3);
$this->pdf->AddPage('P', array($ancho, $alto));

//cabecera
$this->pdf->SetFont('Courier', 'B', 11);
$this->pdf->MultiCell(66, 3, utf8_decode('COMPUTER DIGITAL'), '0', 'C', '0');
$this->pdf->SetFont('Courier', 'B', 7);
$this->pdf->MultiCell(66, 3, utf8_decode('De: Junior Angel Valencia Sarmiento'), '0', 'C', '0');
$this->pdf->Ln(2);

$this->pdf->SetFont('Courier', '', 7);
$this->pdf->MultiCell(66, 3, utf8_decode('CASA MATRIZ'), '0', 'C', '0');

$this->pdf->MultiCell(66, 3, utf8_decode('CALLE HEBARISTO VALLE Nro 150 EDIFICIO HERIBA PISO 3.'), '0', 'C', '0');
$this->pdf->MultiCell(66, 3, utf8_decode('TELF.: 9823789, 298373323'), '0', 'C', '0');
$this->pdf->MultiCell(66, 3, utf8_decode('LA PAZ - BOLIVIA'), '0', 'C', '0');
$this->pdf->SetFont('Courier', 'B', 12);
$this->pdf->Ln(2);
$this->pdf->MultiCell(66, 3, utf8_decode('FACTURA'), 'B', 'C', '0');

$this->pdf->SetFont('Courier', 'B', 8);
$this->pdf->MultiCell(66, 3, utf8_decode('NIT:' . $datos_dosificacion->row()->NIT), '0', 'L', '0');
$can_le = strlen($dato_factura->num_factura . "");
$cero = substr("0000", $can_le);
$this->pdf->MultiCell(66, 3, utf8_decode('Nro FACTURA:' . $cero . $dato_factura->num_factura . ""), '0', 'L', '0');
$this->pdf->MultiCell(66, 3, utf8_decode('Nro AUTORIZACION:' . $datos_dosificacion->row()->nro_autorizacion), '0', 'L', '0');

$this->pdf->SetFont('Courier', '', 8);
$this->pdf->MultiCell(66, 3, utf8_decode('Actividad Economica:' . $datos_dosificacion->row()->actividad), 'B', 'C', '0');

$this->pdf->Ln(2);
$fecha = $dato_factura->fh_registro;
$h = substr($fecha, 11, 5);
$d = substr($fecha, 8, 2);
$m = substr($fecha, 5, 2);
$a = substr($fecha, 0, 4);


$this->pdf->SetFont('Courier', 'B', 8);
$this->pdf->MultiCell(66, 3, utf8_decode('FECHA: ' . $d . "/" . $m . "/" . $a . '    HORA:' . $h), '0', 'L', '0');
$this->pdf->MultiCell(66, 3, utf8_decode('NIT:' . $dato_factura->NIT_cliente), '0', 'L', '0');
$this->pdf->MultiCell(66, 3, utf8_decode('NOMBRE:' . $dato_factura->razon_social), 'B', 'L', '0');

//$this->pdf->Image(base_url() . 'imagenesweb/factura_venta_QR/1000_738_20161216_1535.png', 21, null, 27, 'png');

$this->pdf->SetFont('Courier', 'B', 8);


$this->pdf->SetWidths(array(15, 17, 17, 17));
$this->pdf->SetAligns(array('C', 'C', 'C', 'C'));


$datos = array('', 'CANT.', 'P.UNIT', 'SUBTOTAL');
$this->pdf->RowBodyFactura($datos, 4);
$this->pdf->Cell(66, 0, '', 'B', 0, 'C', '0');
$this->pdf->Ln(2);
$this->pdf->SetFont('Courier', '', 7);




$this->pdf->SetWidths(array(15, 17, 17, 17));
$this->pdf->SetAligns(array('L', 'R', 'R', 'R'));

foreach ($detalle_factura->result() as $reg) {
    $this->pdf->SetFont('Courier', '', 7);
    $this->pdf->MultiCell(66, 3, utf8_decode('* '.$reg->detalle_ps), '0', 'L', '0');
$this->pdf->SetFont('Courier', 'B', 7);
    $datos = array('', number_format($reg->cantidad, 2, '.', ','), number_format($reg->precio, 2, '.', ','), number_format($reg->importe, 2, '.', ','));
    $this->pdf->RowBodyFactura($datos, 3);
}
$this->pdf->SetFont('Courier', '', 7);


/*
  $this->pdf->MultiCell(66, 3, utf8_decode('Laptop Hp 245 Core i7 HDD 1TB Ram 16GB 17Pulg'), '0', 'L', '0');
  $datos = array('','195.00', '1500,00', '887500,00');
  $this->pdf->RowBodyFactura($datos, 3);
  $this->pdf->MultiCell(66, 3, utf8_decode('Impresora Epson l220'), '0', 'L', '0');
  $datos = array('','195.00', '1500,00', '887500,00');
  $this->pdf->RowBodyFactura($datos, 3);
  $this->pdf->MultiCell(66, 3, utf8_decode('Impresora Epson l220'), '0', 'L', '0');
  $datos = array('','195.00', '1500,00', '887500,00');
  $this->pdf->RowBodyFactura($datos, 3);
  $this->pdf->MultiCell(66, 3, utf8_decode('Impresora Epson l220'), '0', 'L', '0');
  $datos = array('','195.00', '1500,00', '887500,00');
  $this->pdf->RowBodyFactura($datos, 3);
  $this->pdf->MultiCell(66, 3, utf8_decode('Impresora Epson l220'), '0', 'L', '0');
  $datos = array('','195.00', '1500,00', '887500,00');
  $this->pdf->RowBodyFactura($datos, 3);
  $this->pdf->MultiCell(66, 3, utf8_decode('Impresora Epson l220'), '0', 'L', '0');
  $datos = array('','195.00', '1500,00', '887500,00');
  $this->pdf->RowBodyFactura($datos, 3);
  $this->pdf->MultiCell(66, 3, utf8_decode('Impresora Epson l220'), '0', 'L', '0');
  $datos = array('','195.00', '1500,00', '887500,00');
  $this->pdf->RowBodyFactura($datos, 3);
  $this->pdf->MultiCell(66, 3, utf8_decode('Impresora Epson l220'), '0', 'L', '0');
  $datos = array('','195.00', '1500,00', '887500,00');
  $this->pdf->RowBodyFactura($datos, 3);
  $this->pdf->MultiCell(66, 3, utf8_decode('Impresora Epson l220'), '0', 'L', '0');
  $datos = array('','195.00', '1500,00', '887500,00');
  $this->pdf->RowBodyFactura($datos, 3); */
$this->pdf->Cell(66, 0, '', 'B', 0, 'C', '0');
$this->pdf->Ln(0);


$this->pdf->SetFont('Courier', 'B', 9);
$this->pdf->SetWidths(array(5, 36, 25));
$this->pdf->SetAligns(array('C', 'R', 'R'));


$datos = array('', 'TOTAL.-', number_format($dato_factura->monto_total_bs, 2, '.', ','));
$this->pdf->RowBodyFactura($datos, 4);
$this->pdf->SetFont('Courier', '', 8);
$this->pdf->MultiCell(66, 3, 'SON:' . utf8_decode(strtoupper($literal)) . ' BOLIVIANOS', 'BU', 'L', '0');

$this->pdf->SetFont('Courier', 'B', 8);
$this->pdf->MultiCell(66, 3, utf8_decode('Codigo de control:' . $dato_factura->codigo_control), '0', 'C', '0');
$fecha = $datos_dosificacion->row()->fl_emision;
$d = substr($fecha, 8, 2);
$m = substr($fecha, 5, 2);
$a = substr($fecha, 0, 4);

$this->pdf->MultiCell(66, 3, utf8_decode('Fecha límite de Emisión : ' . $d . "/" . $m . "/" . $a), '0', 'C', '0');

$this->pdf->Image(base_url() . 'imagenesweb/factura_venta_QR/' . $dato_factura->codigo_qr_name . '.png', 21, null, 27, 'png');

$this->pdf->SetFont('Courier', '', 7);
$this->pdf->MultiCell(66, 3, utf8_decode('"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS. EL USO ILÍCITO DE ESTA SANCIONADO DE ACUERDO A LEY"'), '0', 'C', '0');
$this->pdf->Ln(2);
$this->pdf->MultiCell(66, 3, utf8_decode($datos_dosificacion->row()->leyenda_factura), '0', 'C', '0');




$this->pdf->AliasNbPages();
$this->pdf->Output('factura_', 'I');
?>