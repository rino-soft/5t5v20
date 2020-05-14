<?php

include_once APPPATH . 'helps/fpdf/fpdf.php';
$this->pdf = new PDF('P', 'mm', 'A4'); //por defecto A4
$this->pdf->SetMargins(10, 1, 10);
$this->pdf->SetAutoPageBreak(true, 10);
//$this->pdf->AddPage();
$copias = array("ORIGINAL", "COPIA", "COPIA CONTABILIDAD");
for ($i = 0; $i <= 2; $i++) {
    $this->pdf->AddPage();

///cabecera
    $this->pdf->Image(base_url() . 'imagenesweb/recursos/mosai1.jpg', -20, 45, 250, 'png'); // 5, 5, 30, 'jpg'
    $this->pdf->Image(base_url() . 'imagenesweb/recursos/arriba.png', -146, 8, 350, 'jpg');
    $this->pdf->Image(base_url() . 'imagenesweb/recursos/abajo.png', -5, 285, 150, 'jpg');

    
    $this->pdf->Line(10,49,10,246);
    $this->pdf->Line(200,49,200,246);
    $this->pdf->Line(170,49,170,235);
    
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->setY(15);
    $this->pdf->SetFillColor(250, 250, 250);
    $this->pdf->Cell(120, 4, ' ', '', 0, 'R', '0');
    $this->pdf->Cell(40, 4, 'NIT:', '', 0, 'R', '0');
    $this->pdf->SetFont('Arial', 'B', 9);
    // $this->pdf->SetTextColor(141, 0, 40);
    $this->pdf->Cell(30, 4, $datos_dosificacion->row()->NIT, '', 0, 'R', '0');
    $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->SetTextColor(0, 0, 0);
    $this->pdf->Ln(4);
    $this->pdf->Cell(120, 4, ' ', '', 0, 'R', '0');
    $this->pdf->Cell(40, 4, utf8_decode('FACTURA N°:'), '', 0, 'R', '0');
    $this->pdf->SetFont('Arial', 'B', 9);
    //$this->pdf->SetTextColor(141, 0, 40);
    $can_le = strlen($dato_factura->num_factura . "");
    $cero = substr("000000", $can_le);
    $this->pdf->Cell(30, 4, $cero . $dato_factura->num_factura, '', 0, 'R', '0');
    $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->SetTextColor(0, 0, 0);
    $this->pdf->Ln(4);
    $this->pdf->Cell(120, 4, ' ', '', 0, 'R', '0');
    $this->pdf->Cell(40, 4, utf8_decode('AUTORIZACIÓN N°:'), '', 0, 'R', '0');
    $this->pdf->SetFont('Arial', 'B', 9);
    $this->pdf->Cell(30, 4, $datos_dosificacion->row()->nro_autorizacion, '', 0, 'R', '0');
    $this->pdf->Ln(5);
      $this->pdf->SetTextColor(0, 45, 176);
    $this->pdf->Cell(190, 4, utf8_decode($copias[$i]), '', 0, 'R', '0');
      $this->pdf->SetTextColor(0,0, 0);

    $this->pdf->setY(21);
    $this->pdf->SetTextColor(0, 45, 176);
    $this->pdf->SetFont('Arial', 'B', 9);
    $this->pdf->Cell(60, 4, 'STS BOLIVIA LTDA.', '', 0, 'L', '0');
    $this->pdf->SetTextColor(0, 0, 0);
    $this->pdf->Ln(3);
    $this->pdf->SetFont('Arial', 'B', 7);
    $this->pdf->Cell(60, 4, 'CASA MATRIZ - 0', '', 0, 'L', '0');
    $this->pdf->Ln(3);
    $this->pdf->SetFont('Arial', '', 6);
    $direccion="Av. Mariscal Santa Cruz S/N (esq. Yanacocha), Edif. Hansa Piso:4 (Todo el piso) Depto La Paz. Zona Central \n, Telf.:2406667 Fax:591-2-2406707";
    
    $this->pdf->MultiCell(60, 2.5, utf8_decode($direccion), '0', 'L', '0');
 
    $this->pdf->SetFont('Arial', 'B', 7);
    $this->pdf->Cell(60, 4, utf8_decode('ACTIVIDAD ECONÓMICA'), '', 0, 'L', '0');
    $this->pdf->Ln(3);
    $this->pdf->SetFont('Arial', '', 6);
    $this->pdf->MultiCell(60, 2.5, utf8_decode($datos_dosificacion->row()->actividad), '0', 'L', '0');


    date_default_timezone_set("Etc/GMT+4");
    $this->pdf->Ln(1);
    $this->pdf->setY(30);
      $this->pdf->SetFont('Arial', 'B', 18);
    $this->pdf->Cell(190, 5, 'FACTURA', '', 0, 'C', '0');
    $this->pdf->Ln(5);

    

    
//date_default_timezone_set("Etc/GMT+4");
// genera la fecha de emision******************************

    $mes = array(" de Enero de ", " de febrero de ", " de marzo de ", " de abril de ", " de mayo de ", " de junio de ", " de Julio de ", " de agosto de ", " de septiembre de ", " de octubre de ", "de noviembre de ", "de diciembre de ");
    $fecha = $dato_factura->fh_registro;
    $d = substr($fecha, 8, 2);
    $m = substr($fecha, 5, 2);
    $a = substr($fecha, 0, 4);
//*********************************************************
    $this->pdf->setY(37);
    $this->pdf->Cell(65, 5, '', '', 0, 'L', '0');
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->Cell(25, 5, 'Lugar y Fecha:', '', 0, 'L', '0');
    $this->pdf->SetFont('Arial', 'B', 9);
     ///// arreglar esta parte pra la fecha x dia..
    $this->pdf->Cell(95, 5, 'La Paz , ' . $d . " " . $mes[($m - 1)] . $a, '', 0, 'L', '0'); ///// arreglar esta parte pra la fecha x dia..

    $this->pdf->Ln(4);
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->Cell(65, 5, '', '', 0, 'L', '0');
    $this->pdf->Cell(10, 5, 'NIT/CI:', '', 0, 'L', '0');
    $this->pdf->SetFont('Arial', 'B', 9);
    $this->pdf->Cell(20, 5, $dato_factura->NIT_cliente, '', 0, 'L', '0');
    $this->pdf->SetFont('Arial', '', 9);
    
    $this->pdf->Cell(15, 5, utf8_decode('Señor(es):'), '', 0, 'L', '0');
    $this->pdf->SetFont('Arial', 'B', 9);
     $this->pdf->MultiCell(80, 5, utf8_decode($dato_factura->razon_social), '0', 'L', '0');
    
    $this->pdf->SetFont('Arial', '', 9);
    
    $this->pdf->Ln(2);
//$this->pdf->Cell(15, 4,' ' , '', 0, 'R', '0');
    //$this->pdf->SetLineWidth(.5);

   // $this->pdf->Cell(190, 2, ' ', 'T', 0, 'R', '0');
    $this->pdf->Ln(1);
    $this->pdf->SetLineWidth(.2);
    $this->pdf->SetFont('Arial', 'B', 9);
    $this->pdf->SetFillColor(230, 230, 230);
    $this->pdf->Cell(20, 7, 'Cantidad', 'TB', 0, 'C', '1');
    $this->pdf->Cell(115, 7, utf8_decode('Descripción'), 'TB', 0, 'C', '1');
    $this->pdf->Cell(25, 7, 'Precio Unitario', 'TB', 0, 'C', '1');
    $this->pdf->Cell(30, 7, 'Subtotal', 'TB', 0, 'C', '1');
    $this->pdf->Ln(7);
   
    /* $this->pdf->Ln(4);
      $this->pdf->Cell(20, 5,' ' , '', 0, 'C', '');
      $this->pdf->Cell(115, 5,' ' , '', 0, 'C', '');
     */
    /* $this->pdf->SetTextColor(255,255,255);
      $this->pdf->Ln(5);$this->pdf->SetFont('Arial', 'B', 12); */


////poner la sentencia foreach para el recorrido
    $this->pdf->SetWidths(array(20, 115, 25, 30));
    $this->pdf->SetAligns(array('C', 'J', 'R', 'R'));
    $this->pdf->SetFont('Arial', '', 8);


    $this->pdf->Ln(4);
    foreach ($detalle_factura->result() as $reg) {
        $datos = array(number_format($reg->cantidad, 2, '.', ','), utf8_decode($reg->detalle_ps), number_format($reg->precio, 2, '.', ','), number_format($reg->importe, 2, '.', ','));
        $this->pdf->RowBodyFactura($datos, 4.2);
    }

//
  $this->pdf->SetY(235);
    $this->pdf->SetTextColor(0, 0, 0);
    $this->pdf->SetFillColor(240, 240, 240);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->SetLineWidth(.1);
    $this->pdf->Cell(135, 6, '', 'T', 0, 'R', '1');
    $this->pdf->Cell(25, 6, ' TOTAL Bs.-', 'T', 0, 'R', '1');
    $this->pdf->Cell(30, 6, number_format($dato_factura->monto_total_bs, 2, '.', ','), 'T', 0, 'R', '1');
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->SetTextColor(0, 0, 0);
    $this->pdf->Cell(15, 6, 'Son : ', '', 0, 'R', '1');
    $this->pdf->MultiCell(175, 6, utf8_decode($literal) . ' Bolivianos', '', 'L', '1');

//$this->pdf->Ln(3);
    /* $this->pdf->setY(242); */
    $this->pdf->SetLineWidth(.2);

    $this->pdf->Cell(190, 2, ' ', 'T', 0, 'R', '0');
    $this->pdf->Ln(2);
    $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->Cell(25, 5, utf8_decode('Código de Control:'), '', 0, 'L', '');
    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(55, 5, $dato_factura->codigo_control, '', 0, 'L', '');
    $fecha = $datos_dosificacion->row()->fl_emision;
    $d = substr($fecha, 8, 2);
    $m = substr($fecha, 5, 2);
    $a = substr($fecha, 0, 4);
    $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->Cell(35, 5, utf8_decode('Fecha Límite de Emisión:' ), '', 0, 'L', '');
    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(45, 5, utf8_decode($d . "/" . $m . "/" . $a), '', 0, 'L', '');
    
    $this->pdf->Image(base_url() . 'imagenesweb/factura_venta_QR/' . $dato_factura->codigo_qr_name . '.png', null, null, 27, 'jpg');
    $this->pdf->Ln(-23);

    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Ln(5);
//$this->pdf->SetFillColor(230,230,230);
    if ($i == 0) {
        $this->pdf->Cell(20, 4, '', '', 0, 'C', '0'); //proyecto
        $this->pdf->Ln(5);
        $this->pdf->Cell(25, 4, '', '', 0, 'C', '0'); //contrato
        $this->pdf->Ln(5);
        $this->pdf->Cell(30, 4, '', '', 0, 'C', '0'); //pedido de compra
        $this->pdf->Ln(4);
    } else {
        if ($dato_factura->id_proyecto > 0) {
            $this->pdf->Cell(150, 4, 'Proyecto:' . $proy->nombre, '', 0, 'L', '0'); //proyecto
            $this->pdf->Ln(5);
        } else {
            $this->pdf->Cell(150, 4, 'Proyecto: ', '', 0, 'L', '0'); //proyecto
            $this->pdf->Ln(5);
        }
        if ($dato_factura->id_contrato > 0) {
            $this->pdf->Cell(150, 4, 'Contrato:' . $cont->nro_contrato, '', 0, 'L', '0'); //contrato
            $this->pdf->Ln(5);
        } else {
            $this->pdf->Cell(150, 4, 'Contrato:', '', 0, 'L', '0'); //contrato
            $this->pdf->Ln(5);
        }
        $this->pdf->Cell(150, 4, "", '', 0, 'L', '0'); //pedido de compra
        $this->pdf->Ln(4);
    }
    $this->pdf->Ln(5);
    $this->pdf->Ln(1);

    $this->pdf->SetTextColor(0, 0, 0);
    
    $this->pdf->SetFont('Arial', '', 7);
    $this->pdf->Cell(190, 4, utf8_decode('"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS. EL USO ILÍCITO DE ESTA SANCIONADO DE ACUERDO A LEY"'), '', 0, 'L', '0');
    $this->pdf->Ln(3);
    $this->pdf->Cell(190, 4, utf8_decode($datos_dosificacion->row()->leyenda_factura), '', 0, 'L', '0');
}





$this->pdf->AliasNbPages();
$this->pdf->Output('Factura_STS_' . $dato_factura->num_factura, 'I');
?>