<?php

include_once APPPATH . 'helps/fpdf/fpdf.php';

include_once APPPATH . 'helps/barcode/php-barcode.php';

$this->pdf = new PDF(); //por defecto A4







$suma_total_final = 0;
$cantidad_total_final = 0;
$total_iva_final = 0;
$total_iue_serv = 0;
$total_iue_com = 0;
$total_it_serv = 0;
$total_it_com = 0;
$total_rc_iva = 0;
$total_neto_final = 0;
$dato_usuario_respo = $dato_usuario_resp->ap_paterno . " " . $dato_usuario_resp->ap_materno . " " . $dato_usuario_resp->nombre;




//if ($datos_rendicion_detalle_traA->num_rows() > 0) {
//cabecera
$this->pdf->AddPage();
$this->pdf->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 10, 10, 30, 'jpg');

$can_le = strlen($datos_solicitud->row()->id_sol_frendir . "");
$cero = substr("0000", $can_le);
$codigofr=$cero .$datos_solicitud->row()->id_sol_frendir;
////    bas code///
$fontSize = 6;
$marge = 0;   // between barcode and hri in pixel
$x = 105;  // barcode center
$y = 20;  // barcode center
$height = 6;   // barcode height in 1D ; module size in 2D
$width = 0.6;    // barcode height in 1D ; not use in 2D
$angle = 0;   // rotation in degrees

$code = 'FR.'.$codigofr; // barcode, of course ;)
$type = 'code39';
$black = '000000';

$data = Barcode::fpdf($this->pdf, $black, $x, $y, $angle, $type, array('code' => $code), $width, $height);
$this->pdf->SetFont('Arial', 'B', $fontSize);
$this->pdf->SetTextColor(0, 0, 0);
$len = $this->pdf->GetStringWidth($data['hri']);
Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
$this->pdf->SetTextColor(100, 100, 100);
$this->pdf->TextWithRotation($x + $xt, $y + $yt-4, '*' . $data['hri'] . '*', $angle);

////    bas code///
$this->pdf->SetY(12);
$this->pdf->SetTextColor(0, 0, 0);
$this->pdf->SetFont('Arial', 'B', 17);
$this->pdf->Cell(190, 4, 'SOLICITUD DE FONDOS A RENDIR', '', 0, 'C', '0');

$this->pdf->SetY(10);

date_default_timezone_set("Etc/GMT+4");
$this->pdf->SetFont('Arial', '', 6);
$this->pdf->Cell(160, 2, '', '', 0, 'C', '0');
$this->pdf->Cell(30, 2, "IMPRESION", '', 0, 'C', '0');

$this->pdf->Ln(2);
$this->pdf->Cell(160, 2, '', '', 0, 'C', '0');
$this->pdf->Cell(30, 2, "".date_format(new DateTime('now'), 'd/m/Y, H:i'), '', 0, 'C', '0');

$this->pdf->Ln(4);
$this->pdf->SetFont('Times', 'B', 16);
$this->pdf->Cell(160, 4, '', '', 0, 'C', '0');
$this->pdf->Cell(30, 4, 'N. ' .$codigofr, '', 0, 'C', '0');



$this->pdf->SetLineWidth(0.5);
$this->pdf->Ln(15);
$this->pdf->SetFont('Arial', '', 9);
$this->pdf->Cell(25, 7, 'Asignar a: ', 'LT', 0, '', '0');
$this->pdf->SetFont('Arial', 'B', 9);
$nombre_tecnico = $dato_usuario_tecnico->ap_paterno . " " . $dato_usuario_tecnico->ap_materno . " " . $dato_usuario_tecnico->nombre;
$this->pdf->Cell(100,7, $nombre_tecnico, 'T', 0, '', '0');


$this->pdf->SetFont('Arial', '', 9);
$this->pdf->Cell(30, 7, 'Fecha Solicitud : ', 'T', 0, '', '0');
$this->pdf->SetFont('Arial', 'B', 9);

$this->pdf->Cell(35, 7, "02/03/2020", 'TR', 0, '', '0');

$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', '', 9);
$this->pdf->Cell(25, 5, 'Cuenta : ', 'L', 0, '', '0');
$this->pdf->SetFont('Arial', 'B', 10);
$cuenta = "Banco Mercantil Santa Cruz S.A. cta: 1542959";
$this->pdf->Cell(100, 5, $cuenta, '', 0, '', '0');


$this->pdf->SetFont('Arial', '', 9);
$this->pdf->Cell(30, 5, 'Monto : ', '', 0, '', '0');
$this->pdf->SetFont('Arial', 'B', 11);

$this->pdf->Cell(35, 5, number_format($datos_solicitud->row()->monto, 2, '.', ','), 'R', 0, '', '0');
$this->pdf->Ln(5);

$this->pdf->SetFont('Arial', '', 9);
$this->pdf->Cell(25, 7, 'Referencia : ', 'LB', 0, '', '0');
$this->pdf->SetFont('Arial', 'B', 10);

$this->pdf->Cell(165, 7, $datos_solicitud->row()->titulo, 'BR', 0, '', '0');

$this->pdf->SetLineWidth(0.2);

$this->pdf->Ln(10);
$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->SetTextColor(255, 255, 255);
$this->pdf->Cell(190, 7, ' Detalle Fondos a Rendir', 'B', 0, 'C', '1');
$this->pdf->SetTextColor(0, 0, 0);
$this->pdf->Ln(8);

// add 16/02/2018
//$this->pdf->Cell(20, 5,count($datos_rendicion_detalle_traA) , 'B', 0, 'C', '1');
//-- aqui termina


$this->pdf->SetFont('Arial', 'B', 8);

$this->pdf->SetFillColor(200, 200, 200);
$this->pdf->Cell(10, 5, 'item ', 'B', 0, 'L', '1');
$this->pdf->Cell(150, 5, ' Detalle', 'B', 0, 'C', '1');
$this->pdf->Cell(30, 5, ' Monto', 'B', 0, 'C', '1');
// $this->pdf->Cell(20, 5, ' IVA', 'B', 0, 'C', '1');
// $this->pdf->Cell(20, 5, ' Valor Neto', 'B', 0, 'C', '1');


$this->pdf->Ln(5);
$cant = 0;
$bruto = 0;
$iva = 0;
$neto = 0;
$item=1;
foreach ($detalle_solicitud->result() as $tr) {

//
//    $this->pdf->SetFont('Arial', '', 10);
//    $this->pdf->Cell(10, 5, '1 ', 'LTB', 0, 'L', '0');
//    $this->pdf->Cell(150, 5, 'laksjd ljasldkj alsk djlsa', 'BTR', 0, 'C', '0');
//    $this->pdf->Cell(30, 5, (number_format(2541, 2, '.', ',')), 'BTR', 0, 'C', '0');


    $this->pdf->SetWidths(array(10, 150, 30));
    $this->pdf->SetAligns(array('C', 'J', 'R'));
    $this->pdf->SetLineWidth(0.1);
    $this->pdf->SetDrawColor(100, 100, 100);
    $x1 = $this->pdf->getX();
    $y1 = $this->pdf->getY();
    //  number_format($number);
    $datos = array($item, $tr->detalle."\n * Proyecto:".$tr->id_proy." \n * Sitio :".$tr->sitio ,number_format($tr->monto_detalle, 2, '.', ','));
    $tam_font = array(9, 9, 10);
    $this->pdf->RowBodyRendicion($datos, 4, $tam_font);
    $y2 = $this->pdf->getY();
    $this->pdf->line($x1, $y1, $x1, $y2);
    $this->pdf->line(168, $y1, 168, $y2);
    $this->pdf->line(200, $y1, 200, $y2);
    $item++;
    $bruto+=$tr->monto_detalle;

//    $valor_neto = number_format($tr->total - $tr->IVA_calc, 2, '.', ',');
//
//    $cant+=$tr->cantidad;
//    $bruto+=$tr->total;
//    $iva+=$tr->IVA_calc;
//    $neto+=$valor_neto;
//    $suma_total_final+=$tr->total;
//    $cantidad_total_final+=$tr->cantidad;
//    $total_iva_final+=$tr->IVA_calc;
//    $total_neto_final+=$tr->total;
//    $this->pdf->Ln(5);
//
//    $this->pdf->Cell(6, 5, '', 'L', 0, 'C', '');
//    $this->pdf->SetFont('Arial', 'B', 8);
//    $this->pdf->SetFillColor(230, 230, 230);
//    $this->pdf->Cell(15, 5, 'Nro.Fact. ', '', 0, 'C', '1');
//    $this->pdf->Cell(20, 5, 'Fecha Fact. ', '', 0, 'L', '1');
//    //$this->pdf->Cell(25, 5,' Nro .Fact.' , 'B', 0, 'C', '1');
//    //$this->pdf->Cell(25, 5,' Nit .Fact.' , 'B', 0, 'C', '1');
//    //$this->pdf->Cell(20, 5,' Fecha Fact.' , 'B', 0, 'C', '1');
//
//    $this->pdf->Cell(39, 5, ' Glosa', '', 0, 'C', '1');
//    $this->pdf->Cell(38, 5, ' Estacion', '', 0, 'C', '1');
//    $this->pdf->Cell(20, 5, ' Placa', '', 0, 'C', '1');
//    $this->pdf->Cell(20, 5, ' Monto (Bs)', '', 0, 'C', '1');
//    $this->pdf->Cell(32, 5, ' ', 'LR', 0, 'C', '');
//    $this->pdf->Ln(5);
//
//    foreach ($datos_rendicion_detalle_traA[$tr->id_tipo_gasto]->result() as $fila) {
//        $this->pdf->SetWidths(array(6, 15, 20, 39, 38, 20, 20, 25));
//        $this->pdf->SetAligns(array('', 'C', 'J', 'J', 'J', 'J', 'R', ''));
//        $x1 = $this->pdf->getX();
//        $y1 = $this->pdf->getY();
//        //  number_format($number);
//        $datos = array('', $fila->nro_fac, $fila->fecha_factura, utf8_decode($fila->glosa), $fila->estacion, $fila->placa_vehiculo, number_format($fila->monto, 2, '.', ','), '');
//        $tam_font = array('', 8, 8, 7, 7, 8, 8, '');
//        $this->pdf->RowBodyRendicion($datos, 3.5, $tam_font);
//        $y2 = $this->pdf->getY();
//        $this->pdf->line($x1, $y1, $x1, $y2);
//        $this->pdf->line(168, $y1, 168, $y2);
//        $this->pdf->line(200, $y1, 200, $y2);
//    }
    $this->pdf->Cell(190, 0, ' ', 'T', 0, 'C', '');
    $this->pdf->Ln(0);
}

$this->pdf->SetFillColor(90, 90, 90);
$this->pdf->SetLineWidth(0.1);
$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->SetTextColor(240, 240, 240);
// $this->pdf->Ln(5);
$this->pdf->Cell(140, 7, 'TOTAL Bs.-', '', 0, 'R', '1');
$this->pdf->SetFont('Arial', 'B', 12);
$this->pdf->Cell(50, 7, number_format($bruto, 2, '.', ','), '', 0, 'R', '1');
//$this->pdf->Cell(20, 5, $iva, 'T', 0, 'C', '1');
//$this->pdf->Cell(20, 5, $neto, 'T', 0, 'C', '1');
$this->pdf->SetFillColor(240, 240, 240);
$this->pdf->Ln(10);
    $this->pdf->SetFont('Arial', 'BU', 10);
    $this->pdf->SetTextColor(0, 0, 0);
    $this->pdf->MultiCell(190, 5, utf8_decode('Son :'.$literal . ' Bolivianos'), '', 'R', '1');
    
$this->pdf->SetLineWidth(0.5);
$this->pdf->SetFillColor(230, 230, 230);

$this->pdf->Ln(3);



$this->pdf->SetFont('Arial', '', 10);
$this->pdf->SetTextColor(0, 0, 0);

$this->pdf->SetLineWidth(0);
// $this->pdf->Ln(5);
$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->Cell(190, 5, "Aclaraciones y Observaciones", 'LTR', 0, 'C', '1');
$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', '', 8);
$this->pdf->MultiCell(190, 6, utf8_decode($datos_solicitud->row()->comentario_global), 'LRB', 'J', '0');
////////desde aqui perteneces despues del comentario de asiento

$this->pdf->SetLineWidth(0.2);
$this->pdf->SetDrawColor(100, 100, 100);
$this->pdf->Ln(5);
// $this->pdf->Ln(5);
$this->pdf->Cell(63, 20, ' ', 'LT', 0, 'L', '0');
$this->pdf->Cell(63, 20, ' ', 'LT', 0, 'L', '0');
$this->pdf->Cell(64, 20, ' ', 'LTR', 0, 'L', '0');

$this->pdf->Ln(20);

$this->pdf->SetFont('Arial', 'B', 8);
$this->pdf->Cell(63, 4, 'Solicitado por:', 'L', 0, 'C', '1');
//$this->pdf->Cell(58, 5, 'ELABORADO POR:' .$nombre, 'LBR', 0, 'C', '0');
$this->pdf->Cell(63, 4, 'Autorizado por', 'L', 0, 'C', '1');
$this->pdf->Cell(64, 4, 'Pago Autorizado por', 'LR', 0, 'C', '1');

$this->pdf->Ln(4);


$this->pdf->SetFont('Arial', 'B', 8);
$this->pdf->Cell(63, 4, $dato_usuario_respo, 'LB', 0, 'C', '1');
$this->pdf->Cell(63, 4, '', 'BL', 0, 'C', '1');
$this->pdf->SetFont('Arial', 'B', 14);
$this->pdf->Cell(64, 4, '/          /', 'LBR', 0, 'C', '1');

// }   


$y = $this->pdf->GetY()+15;  // barcode center


$data = Barcode::fpdf($this->pdf, $black, $x, $y, $angle, $type, array('code' => $code), $width, $height);
$this->pdf->SetFont('Arial', 'B', $fontSize);
$this->pdf->SetTextColor(0, 0, 0);
$len = $this->pdf->GetStringWidth($data['hri']);
Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
$this->pdf->SetTextColor(100, 100, 100);
$this->pdf->TextWithRotation($x + $xt, $y + $yt - 12, '*' . $data['hri'] . '*', $angle);






$this->pdf->AliasNbPages();
$this->pdf->Output('rend_rembolso', 'I');
?>