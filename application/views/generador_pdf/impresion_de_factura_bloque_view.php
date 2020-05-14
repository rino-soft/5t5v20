<?php

include_once APPPATH . 'helps/fpdf/fpdf.php';
$this->pdf = new PDF('P', 'mm', 'A4'); //por defecto A4
$this->pdf->SetMargins(10, 1, 10);
$this->pdf->SetAutoPageBreak(true, 10);
$copias = array("ORIGINAL", "COPIA", "COPIA CONTABILIDAD");
foreach ($datos_factura->result() as $facturadata) {

    $datos_dosificacion = $dosificaciones[$facturadata->id_factura];
    $detalle_factura = $detalles[$facturadata->id_factura];
    $literal = $literales[$facturadata->id_factura];
    $proy = $proyectos[$facturadata->id_factura];
    $cont = $contratos[$facturadata->id_factura];
    for ($i = 0; $i <= 2; $i++) {
        $this->pdf->AddPage();

//cabecera
        $this->pdf->Image(base_url() . 'imagenesweb/recursos/mosaico.png', 10, 60, 190, 'png'); // 5, 5, 30, 'jpg'
        $this->pdf->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 20, 3, 40, 'jpg');

        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->SetTextColor(0, 0, 0);
        $this->pdf->SetFillColor(250, 250, 250);
        $this->pdf->Cell(120, 4, ' ', '', 0, 'R', '0');
        $this->pdf->Cell(35, 5, 'NIT:', 'LT', 0, 'R', '1');
        $this->pdf->SetFont('Times', 'B', 12);
        $this->pdf->SetTextColor(141, 0, 40);
        $this->pdf->Cell(35, 5, $datos_dosificacion->row()->NIT, 'TR', 0, 'L', '0');
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->SetTextColor(0, 0, 0);
        $this->pdf->Ln(5);
        $this->pdf->Cell(120, 4, ' ', '', 0, 'R', '0');
        $this->pdf->Cell(35, 5, utf8_decode('FACTURA N°:'), 'L', 0, 'R', '1');
        $this->pdf->SetFont('Times', 'B', 12);
        $this->pdf->SetTextColor(141, 0, 40);
        $can_le = strlen($facturadata->num_factura . "");
        $cero = substr("0000", $can_le);
        $this->pdf->Cell(35, 5, $cero . $facturadata->num_factura, 'R', 0, 'L', '0');
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->SetTextColor(0, 0, 0);
        $this->pdf->Ln(5);
        $this->pdf->Cell(120, 4, ' ', '', 0, 'R', '0');
        $this->pdf->Cell(35, 5, utf8_decode('AUTORIZACIÓN N°:'), 'LB', 0, 'R', '1');
        $this->pdf->SetFont('Times', 'B', 12);
        $this->pdf->SetTextColor(141, 0, 40);
        $this->pdf->Cell(35, 5, $datos_dosificacion->row()->nro_autorizacion, 'BR', 0, 'L', '0');
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->SetTextColor(0, 0, 0);
        $this->pdf->Ln(6);
        $this->pdf->SetTextColor(200, 0, 0);
        $this->pdf->Cell(120, 4, ' ', '', 0, 'R', '');
        $this->pdf->Cell(70, 4, utf8_decode($copias[$i]), '0', 0, 'C', '0');
        $this->pdf->SetTextColor(0, 0, 0);
        $this->pdf->Ln(4);
        $this->pdf->Cell(120, 4, ' ', '', 0, 'R', '');
        $this->pdf->Cell(70, 4, utf8_decode('Actividad Económica'), '0', 0, 'C', '0');
        $this->pdf->Ln(4);
        $this->pdf->Cell(120, 4, ' ', '', 0, 'R', '');
        $this->pdf->SetFont('Arial', '', 8);
//->MultiCell($w, $alto, $data[$i], 0, $a, false);
        $this->pdf->MultiCell(70, 3, utf8_decode($datos_dosificacion->row()->actividad), '0', 'C', '0');
        $this->pdf->SetFont('Arial', 'B', 10);

        date_default_timezone_set("Etc/GMT+4");
        $this->pdf->Ln(1);
        $this->pdf->setY(27);
        $this->pdf->SetFont('Arial', '', 6);
        $this->pdf->Cell(60, 4, 'CASA MATRIZ - 0', '', 0, 'C', '0');
        $this->pdf->SetFont('Arial', 'B', 20);
        $this->pdf->Cell(70, 5, 'FACTURA', '', 0, 'C', '0');
        $this->pdf->Ln(3);

        $this->pdf->SetFont('Arial', '', 6);
        $this->pdf->Cell(60, 3, 'Av. Mariscal Santa Cruz S/N (esq. Yanacocha) ', '', 0, 'C', '0');
        $this->pdf->Ln(3);
        $this->pdf->Cell(60, 3, 'Edif. Hansa Piso:4 (Todo el piso) Depto. Zona Central', '', 0, 'C', '0');
        $this->pdf->Ln(3);
        $this->pdf->Cell(60, 3, 'Telf.:2406667 Fax:501-2-2406707', '', 0, 'C', '0');




        $this->pdf->setY(33);
        $this->pdf->Ln(10);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(25, 5, 'Lugar y Fecha:', '', 0, 'L', '0');
        $this->pdf->SetFont('Arial', 'B', 10);
//date_default_timezone_set("Etc/GMT+4");
// genera la fecha de emision******************************

        $mes = array(" de Enero de ", " de febrero de ", " de marzo de ", " de abril de ", " de mayo de ", " de junio de ", " de Julio de ", " de agosto de ", " de septiembre de ", " de octubre de ", "de noviembre de ", "de diciembre de ");
        $fecha = $facturadata->fh_registro;
        $d = substr($fecha, 8, 2);
        $m = substr($fecha, 5, 2);
        $a = substr($fecha, 0, 4);
//*********************************************************
        $this->pdf->Cell(140, 5, 'La Paz ' . $d . " " . $mes[($m - 1)] . $a, '', 0, 'L', '0'); ///// arreglar esta parte pra la fecha x dia..

        $this->pdf->Ln(6);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(20, 5, utf8_decode('Señor(es):'), '', 0, 'L', '0');
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(110, 5, utf8_decode($facturadata->razon_social), '', 0, 'L', '0');
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(15, 5, 'NIT/CI:', '', 0, 'L', '0');
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(35, 5, $facturadata->NIT_cliente, '', 0, 'L', '0');
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Ln(7);
//$this->pdf->Cell(15, 4,' ' , '', 0, 'R', '0');
        $this->pdf->SetLineWidth(.5);

        $this->pdf->Cell(190, 2, ' ', 'T', 0, 'R', '0');
        $this->pdf->Ln(1);
        $this->pdf->SetLineWidth(.2);
        $this->pdf->SetFont('Arial', 'B', 9);
        $this->pdf->SetFillColor(230, 230, 230);
        $this->pdf->Cell(20, 4, 'CANT.', '', 0, 'C', '1');
        $this->pdf->Cell(115, 4, utf8_decode('D E S C R I P C I Ó N'), '', 0, 'C', '1');
        $this->pdf->Cell(25, 4, 'PRECIO', '', 0, 'C', '1');
        $this->pdf->Cell(30, 4, 'SUBTOTAL', '', 0, 'C', '1');
        $this->pdf->Ln(4);
        $this->pdf->Cell(20, 4, ' ', 'B', 0, 'C', '1');
        $this->pdf->Cell(115, 4, ' ', 'B', 0, 'C', '1');
        $this->pdf->Cell(25, 4, 'UNITARIO ', 'B', 0, 'C', '1');
        $this->pdf->Cell(30, 4, ' ', 'B', 0, 'C', '1');
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
            $this->pdf->RowBodyFactura($datos, 4);
        }

//
        $this->pdf->SetTextColor(0, 0, 0);
        $this->pdf->SetFillColor(240, 240, 240);
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->SetLineWidth(.4);
        $this->pdf->Cell(135, 6, '', 'T', 0, 'R', '1');
        $this->pdf->Cell(25, 6, ' TOTAL Bs.-', 'T', 0, 'R', '1');
        $this->pdf->Cell(30, 6, number_format($facturadata->monto_total_bs, 2, '.', ','), 'T', 0, 'R', '1');
        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial', 'BU', 10);
        $this->pdf->SetTextColor(0, 0, 0);
        $this->pdf->Cell(15, 6, 'Son : ', '', 0, 'R', '1');
        $this->pdf->MultiCell(175, 6, utf8_decode($literal) . ' Bolivianos', '', 'L', '1');

//$this->pdf->Ln(3);
        /* $this->pdf->setY(242); */
        $this->pdf->SetLineWidth(.5);

        $this->pdf->Cell(190, 2, ' ', 'T', 0, 'R', '0');
        $this->pdf->Ln(2);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(35, 5, utf8_decode('CÓDIGO DE CONTROL:'), '', 0, 'L', '');
        $this->pdf->Cell(55, 5, $facturadata->codigo_control, '', 0, 'L', '');
        $fecha = $datos_dosificacion->row()->fl_emision;
        $d = substr($fecha, 8, 2);
        $m = substr($fecha, 5, 2);
        $a = substr($fecha, 0, 4);
        $this->pdf->Cell(73, 5, utf8_decode('FECHA LIMITE DE EMISIÓN: ' . $d . "/" . $m . "/" . $a), '', 0, 'L', '');
        $this->pdf->Image(base_url() . 'imagenesweb/factura_venta_QR/' . $facturadata->codigo_qr_name . '.png', null, null, 27, 'jpg');
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
            if ($facturadata->id_proyecto > 0) {
                $this->pdf->Cell(150, 4, 'Proyecto:' . $proy->nombre, '', 0, 'L', '0'); //proyecto
                $this->pdf->Ln(5);
            } else {
                $this->pdf->Cell(150, 4, 'Proyecto: ', '', 0, 'L', '0'); //proyecto
                $this->pdf->Ln(5);
            }
            if ($facturadata->id_contrato > 0) {
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

        $this->pdf->SetTextColor(250, 250, 250);
        $this->pdf->SetFillColor(10, 0, 50);
        $this->pdf->SetFont('Arial', 'B', 7);
        $this->pdf->Cell(190, 4, utf8_decode('"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS. EL USO ILÍCITO DE ESTA SANCIONADO DE ACUERDO A LEY":'), '', 0, 'C', '1');
        $this->pdf->Ln(3);
        $this->pdf->Cell(190, 4, utf8_decode($datos_dosificacion->row()->leyenda_factura), '', 0, 'C', '1');

        
        }
    }




    $this->pdf->AliasNbPages();
    $this->pdf->Output('Factura_STS_bloque', 'I');
?>