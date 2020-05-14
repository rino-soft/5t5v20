<?php

include_once APPPATH . 'helps/fpdf/fpdf.php';
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
$dato_usuario_respo = $dato_usuario_resp->row()->ap_paterno . " " . $dato_usuario_resp->row()->ap_materno . " " . $dato_usuario_resp->row()->nombre;



if ($traA->num_rows() > 0) {
    //if ($datos_rendicion_detalle_traA->num_rows() > 0) {
    //cabecera
    $this->pdf->AddPage();
    $this->pdf->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 5, 5, 30, 'jpg');

    date_default_timezone_set("Etc/GMT+4");
    $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->Cell(190, 4, date_format(new DateTime('now'), 'd/m/Y, H:i'), '', 0, 'R', '0');
    $can_le = strlen($datos_rendicion->row()->idreg_ren . "");
    $cero = substr("000000", $can_le);
    $this->pdf->Ln(4);
    $this->pdf->SetFont('Times', 'B', 16);
    $this->pdf->Cell(190, 4, 'N. ' . $cero . $datos_rendicion->row()->idreg_ren, '', 0, 'R', '0');

    $this->pdf->Ln(4);
    $this->pdf->SetFont('Arial', 'B', 12);
    $this->pdf->Cell(180, 5, '', '', 0, 'C', '0');
    $this->pdf->Ln(1);
    $this->pdf->SetFont('Times', 'B', 12);
    $this->pdf->Cell(190, 5, strtoupper($datos_rendicion->row()->tipo_rend), '', 0, 'R', '0');


    $this->pdf->Ln(8);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(35, 5, 'Nombre del Tecnico: ', '', 0, '', '0');
    $this->pdf->SetFont('Arial', '', 8);
    $nombre_tecnico = $dato_usuario_tecnico->row()->ap_paterno . " " . $dato_usuario_tecnico->row()->ap_materno . " " . $dato_usuario_tecnico->row()->nombre;
    $this->pdf->Cell(80, 5, $nombre_tecnico, '', 0, '', '0');
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(30, 5, 'Proyecto : ', '', 0, '', '0');
    $this->pdf->SetFont('Arial', '', 10);

    $this->pdf->Cell(65, 5, $datos_rendicion->row()->nom_proy, '', 0, '', '0');


    $this->pdf->Ln(10);
    $this->pdf->SetFont('Arial', 'B', 11);
    $this->pdf->Cell(145, 5, ' Formulario transportes respaldo con facturas', 'B', 0, 'L', '0');
    $this->pdf->Cell(45, 5, ' TRA08 - A', 'B', 0, 'R', '0');
    $this->pdf->Ln(8);

    // add 16/02/2018
    //$this->pdf->Cell(20, 5,count($datos_rendicion_detalle_traA) , 'B', 0, 'C', '1');
    //-- aqui termina

    
    $this->pdf->SetFont('Arial', 'B', 10);

    $this->pdf->SetFillColor(200, 200, 200);
    $this->pdf->Cell(90, 5, 'Tipo de Gasto ', 'B', 0, 'L', '1');
    $this->pdf->Cell(68, 5, ' Cantidad de Facturas', 'B', 0, 'C', '1');
    $this->pdf->Cell(32, 5, ' Total Factura', '', 0, 'C', '1');
    // $this->pdf->Cell(20, 5, ' IVA', 'B', 0, 'C', '1');
    // $this->pdf->Cell(20, 5, ' Valor Neto', 'B', 0, 'C', '1');
  

    $this->pdf->Ln(5);
    $cant = 0;
    $bruto = 0;
    $iva = 0;
    $neto = 0;
   
    foreach ($traA->result() as $tr) {
    

        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(90, 5, ucwords(strtolower($tr->descripcion_tra)), 'LTB', 0, 'L', '0');
        $this->pdf->Cell(68, 5, $tr->cantidad, 'BTR', 0, 'C', '0');
        $this->pdf->Cell(32, 5, (number_format($tr->total,2,'.',',')), 'BTR', 0, 'C', '0');

        $valor_neto = number_format($tr->total - $tr->IVA_calc, 2,'.',',');
    
        $cant+=$tr->cantidad;
        $bruto+=$tr->total;
        $iva+=$tr->IVA_calc;
        //$neto+=$valor_neto;
        $suma_total_final+=$tr->total;
        $cantidad_total_final+=$tr->cantidad;
        $total_iva_final+=$tr->IVA_calc;
        $total_neto_final+=$tr->total;
        $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 'L', 0, 'C', '');
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->SetFillColor(230, 230, 230);
            $this->pdf->Cell(15, 5, 'Nro.Fact. ', '', 0, 'C', '1');
            $this->pdf->Cell(20, 5, 'Fecha Fact. ', '', 0, 'L', '1');
            //$this->pdf->Cell(25, 5,' Nro .Fact.' , 'B', 0, 'C', '1');
            //$this->pdf->Cell(25, 5,' Nit .Fact.' , 'B', 0, 'C', '1');
            //$this->pdf->Cell(20, 5,' Fecha Fact.' , 'B', 0, 'C', '1');
           
            $this->pdf->Cell(39, 5, ' Glosa', '', 0, 'C', '1');
            $this->pdf->Cell(38, 5, ' Estacion', '', 0, 'C', '1');
            $this->pdf->Cell(20, 5, ' Placa', '', 0, 'C', '1');
            $this->pdf->Cell(20, 5, ' Monto (Bs)', '', 0, 'C', '1');
            $this->pdf->Cell(32, 5, ' ', 'LR', 0, 'C', '');
        $this->pdf->Ln(5);
            
         foreach ($datos_rendicion_detalle_traA[$tr->id_tipo_gasto]->result() as $fila) {
            $this->pdf->SetWidths(array(6,15, 20, 39, 38, 20,20,25 ));
            $this->pdf->SetAligns(array('','C', 'J', 'J', 'J','J','R',''));
            $x1=$this->pdf->getX();
            $y1=$this->pdf->getY();
          //  number_format($number);
           $datos=array('',$fila->nro_fac,$fila->fecha_factura,  utf8_decode($fila->glosa),$fila->sitio,$fila->placa_vehiculo,  number_format($fila->monto,2,'.',','),'' );
           $tam_font=array('',8,8,7,7,8,8,'');
           $this->pdf->RowBodyRendicion($datos, 3.5,$tam_font); 
           $y2=$this->pdf->getY();
           $this->pdf->line($x1,$y1,$x1,$y2);
           $this->pdf->line(168,$y1,168,$y2);
           $this->pdf->line(200,$y1,200,$y2);
         
         
        }
        $this->pdf->Cell(190, 5, ' ', 'T', 0, 'C', '');
        $this->pdf->Ln(3);
    }
    
    $this->pdf->SetFillColor(90, 90, 90);
    $this->pdf->SetLineWidth(0.5);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->SetTextColor(240, 240, 240);
     // $this->pdf->Ln(5);
    $this->pdf->Cell(65, 5,'', '', 0, 'C', '1');
    $this->pdf->Cell(33, 5,'Cantidad Total.-', '', 0, 'C', '1');
     $this->pdf->Cell(10, 5, $cant, '', 0, 'C', '1');
    $this->pdf->Cell(50, 5, 'SUBTOTAL Bs.-', '', 0, 'R', '1');
   
    $this->pdf->Cell(32, 5, number_format($bruto,2,'.',','), '', 0, 'C', '1');
    //$this->pdf->Cell(20, 5, $iva, 'T', 0, 'C', '1');
    //$this->pdf->Cell(20, 5, $neto, 'T', 0, 'C', '1');
   
    $this->pdf->SetLineWidth(0.2);
    $this->pdf->SetFillColor(230, 230, 230);

    $this->pdf->Ln(7);



    $this->pdf->SetFont('Arial', '', 12);
    $this->pdf->SetTextColor(0, 0, 0);


    // $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 11);
    $this->pdf->Cell(190, 5, "Aclaraciones y Observaciones", 'LTR', 0, 'C', '0');
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->MultiCell(190, 4,  utf8_decode($datos_rendicion->row()->observacion) , 'LRB', 'J', '0');
    ////////desde aqui perteneces despues del comentario de asiento


    $this->pdf->SetDrawColor(0, 0, 0);
    $this->pdf->Ln(5);
    // $this->pdf->Ln(5);
    $this->pdf->Cell(58, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(46, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(46, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(40, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Ln(20);

    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(58, 4, 'ELABORADO POR:', 'LTR', 0, 'C', '0');
    //$this->pdf->Cell(58, 5, 'ELABORADO POR:' .$nombre, 'LBR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Cell(40, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Ln(4);


    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(58, 4, $dato_usuario_respo, 'LBR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'RESP. REGIONAL', 'BR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'RESP. PROYECTO', 'BR', 0, 'C', '0');
    $this->pdf->Cell(40, 4, 'Vo. Bo...', 'BR', 0, 'C', '0');

    // }   
}

$this->pdf->Ln(7);
if ($sgrA->num_rows() > 0) {
    //cabecera
    $this->pdf->AddPage();
    $this->pdf->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 5, 5, 30, 'jpg');

    date_default_timezone_set("Etc/GMT+4");
    $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->Cell(190, 4, date_format(new DateTime('now'), 'd/m/Y, H:i'), '', 0, 'R', '0');
    $can_le = strlen($datos_rendicion->row()->idreg_ren . "");
    $cero = substr("000000", $can_le);
    $this->pdf->Ln(4);
    $this->pdf->SetFont('Times', 'B', 16);
    $this->pdf->Cell(190, 4, 'N. ' . $cero . $datos_rendicion->row()->idreg_ren, '', 0, 'R', '0');

    $this->pdf->Ln(4);
    $this->pdf->SetFont('Arial', 'B', 12);
    $this->pdf->Cell(180, 5, '', '', 0, 'C', '0');
    $this->pdf->Ln(1);
    $this->pdf->SetFont('Times', 'B', 12);
    $this->pdf->Cell(190, 5, strtoupper($datos_rendicion->row()->tipo_rend), '', 0, 'R', '0');


    $this->pdf->Ln(8);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(35, 5, 'Nombre del Tecnico: ', '', 0, '', '0');
    $this->pdf->SetFont('Arial', '', 8);
    $nombre_tecnico = $dato_usuario_tecnico->row()->ap_paterno . " " . $dato_usuario_tecnico->row()->ap_materno . " " . $dato_usuario_tecnico->row()->nombre;
    $this->pdf->Cell(80, 5, $nombre_tecnico, '', 0, '', '0');
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(30, 5, 'Proyecto : ', '', 0, '', '0');
    $this->pdf->SetFont('Arial', '', 10);

    $this->pdf->Cell(65, 5, $datos_rendicion->row()->nom_proy, '', 0, '', '0');
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 11);
    $this->pdf->Cell(145, 5, ' Formulario de gastos respaldado con facturas', 'B', 0, 'L', '0');

    $this->pdf->Cell(45, 5, 'SGR17 - A', 'B', 0, 'R', '0');
    $this->pdf->Ln(8);
   
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->SetFillColor(200, 200, 200);
    $this->pdf->Cell(90, 5, 'Tipo de Gasto ', 'B', 0, 'L', '1');
    $this->pdf->Cell(68, 5, ' Cantidad de Facturas', 'B', 0, 'C', '1');
    $this->pdf->Cell(32, 5, ' Total Factura', '', 0, 'C', '1');
    //$this->pdf->Cell(20, 5, ' IVA', 'B', 0, 'C', '1');
    //$this->pdf->Cell(20, 5, ' Valor Neto', 'B', 0, 'C', '1');
   

    $cant = 0;
    $bruto = 0;
    $iva = 0;
    $neto = 0;

    $this->pdf->Ln(5);
    foreach ($sgrA->result() as $tr) {
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(90, 5, ucwords(strtolower($tr->descripcion_tra)), 'LTB', 0, 'L', '0');
        $this->pdf->Cell(68, 5, $tr->cantidad, 'BTR', 0, 'C', '0');
        $this->pdf->Cell(32, 5, (number_format($tr->total,2,'.',',')), 'BTR', 0, 'C', '0');
      //  $valor_neto = number_format($tr->total - $tr->IVA_calc, 2,'.',',');
        //comentado por error no se para que sirve
    
        // $this->pdf->Cell(20, 5, $tr->IVA_calc, 'B', 0, 'C', '0');
        //$this->pdf->Cell(20, 5, $valor_neto, 'B', 0, 'C', '0');

        $cant+=$tr->cantidad;
        $bruto+=$tr->total;
        $iva+=$tr->IVA_calc;
//        $neto+=$valor_neto;
        $suma_total_final+=$tr->total;
        $cantidad_total_final+=$tr->cantidad;
        $total_iva_final+=$tr->IVA_calc;
        $total_neto_final+=$tr->total;
        
         $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 'L', 0, 'C', '');
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->SetFillColor(230, 230, 230);
            $this->pdf->Cell(15, 5, 'Nro.Fact. ', '', 0, 'C', '1');
            $this->pdf->Cell(20, 5, 'Fecha Fact. ', '', 0, 'L', '1');
            //$this->pdf->Cell(25, 5,' Nro .Fact.' , 'B', 0, 'C', '1');
            //$this->pdf->Cell(25, 5,' Nit .Fact.' , 'B', 0, 'C', '1');
            //$this->pdf->Cell(20, 5,' Fecha Fact.' , 'B', 0, 'C', '1');
           
            $this->pdf->Cell(59, 5, ' Glosa', '', 0, 'C', '1');
            $this->pdf->Cell(38, 5, ' Estacion', '', 0, 'C', '1');
           // $this->pdf->Cell(20, 5, ' Placa', '', 0, 'C', '1');
            $this->pdf->Cell(20, 5, ' Monto (Bs)', '', 0, 'C', '1');
            $this->pdf->Cell(32, 5, ' ', 'LR', 0, 'C', '');
         $this->pdf->Ln(5);
         foreach ($datos_rendicion_detalle_sgrA[$tr->id_tipo_gasto]->result() as $fila) {
            $this->pdf->SetWidths(array(6,15, 20, 59, 38, 20,25 ));
            $this->pdf->SetAligns(array('','L', 'J', 'J', 'J','R','R',''));
            $x1=$this->pdf->getX();
            $y1=$this->pdf->getY();
         
           $datos=array('',$fila->nro_fac,$fila->fecha_factura,  utf8_decode($fila->glosa),$fila->sitio,  number_format($fila->monto,2,'.',','),'' );
           $tam_font=array('',8,8,7,7,8,'');
           $this->pdf->RowBodyRendicion($datos, 3.5,$tam_font); 
           $y2=$this->pdf->getY();
           $this->pdf->line($x1,$y1,$x1,$y2);
           $this->pdf->line(168,$y1,168,$y2);
           $this->pdf->line(200,$y1,200,$y2);
         }
          $this->pdf->Cell(190, 5, ' ', 'T', 0, 'C', '');
          $this->pdf->Ln(3);
    }
    
    $this->pdf->SetFillColor(90, 90, 90);
    $this->pdf->SetLineWidth(0.5);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->SetTextColor(240, 240, 240);
    $this->pdf->Cell(65, 5,'', '', 0, 'C', '1');
    $this->pdf->Cell(33, 5,'Cantidad Total.-', '', 0, 'C', '1');
     $this->pdf->Cell(10, 5, $cant, '', 0, 'C', '1');
    $this->pdf->Cell(50, 5, 'SUBTOTAL Bs.-', '', 0, 'R', '1');  
    $this->pdf->Cell(32, 5, number_format($bruto,2,'.',','), '', 0, 'C', '1');
    $this->pdf->SetLineWidth(0.2);
    $this->pdf->SetFillColor(230, 230, 230);
    $this->pdf->Ln(7);
    $this->pdf->SetFont('Arial', '', 12);
    $this->pdf->SetTextColor(0, 0, 0);
    // $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 11);
    $this->pdf->Cell(190, 5, "Aclaraciones y Observaciones", 'LTR', 0, 'C', '0');
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->MultiCell(190, 4,  utf8_decode($datos_rendicion->row()->observacion) , 'LRB', 'J', '0');
    ////////desde aqui perteneces despues del comentario de asiento
    ////////desde aqui perteneces despues del comentario de asiento


    $this->pdf->SetDrawColor(0, 0, 0);
    $this->pdf->Ln(5);
    // $this->pdf->Ln(5);
    $this->pdf->Cell(58, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(46, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(46, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(40, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Ln(20);

    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(58, 4, 'ELABORADO POR:', 'LTR', 0, 'C', '0');
    //$this->pdf->Cell(58, 5, 'ELABORADO POR:' .$nombre, 'LBR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Cell(40, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Ln(4);


    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(58, 4, $dato_usuario_respo, 'LBR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'RESP. REGIONAL', 'BR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'RESP. PROYECTO', 'BR', 0, 'C', '0');
    $this->pdf->Cell(40, 4, 'Vo. Bo...', 'BR', 0, 'C', '0');
}
//con recibo sgr and tra
$this->pdf->Ln(7);
if ($traB->num_rows() > 0) {
    // if ($datos_rendicion_detalle_traB->num_rows() > 0) {
    $this->pdf->AddPage();
    $this->pdf->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 5, 5, 30, 'jpg');

    date_default_timezone_set("Etc/GMT+4");
    $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->Cell(190, 4, date_format(new DateTime('now'), 'd/m/Y, H:i'), '', 0, 'R', '0');
    $can_le = strlen($datos_rendicion->row()->idreg_ren . "");
    $cero = substr("000000", $can_le);
    $this->pdf->Ln(4);
    $this->pdf->SetFont('Times', 'B', 16);
    $this->pdf->Cell(190, 4, 'N. ' . $cero . $datos_rendicion->row()->idreg_ren, '', 0, 'R', '0');

    $this->pdf->Ln(4);
    $this->pdf->SetFont('Arial', 'B', 12);
    $this->pdf->Cell(180, 5, '', '', 0, 'C', '0');
    $this->pdf->Ln(1);
    $this->pdf->SetFont('Times', 'B', 12);
    $this->pdf->Cell(190, 5, strtoupper($datos_rendicion->row()->tipo_rend), '', 0, 'R', '0');


    $this->pdf->Ln(8);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(35, 5, 'Nombre del Tecnico: ', '', 0, '', '0');
    $this->pdf->SetFont('Arial', '', 8);
    $nombre_tecnico = $dato_usuario_tecnico->row()->ap_paterno . " " . $dato_usuario_tecnico->row()->ap_materno . " " . $dato_usuario_tecnico->row()->nombre;
    $this->pdf->Cell(80, 5, $nombre_tecnico, '', 0, '', '0');
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(30, 5, 'Proyecto : ', '', 0, '', '0');
    $this->pdf->SetFont('Arial', '', 10);

    $this->pdf->Cell(65, 5, $datos_rendicion->row()->nom_proy, '', 0, '', '0');

    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 11);
    $this->pdf->Cell(145, 5, ' Formulario transportes respaldo con recibos', 'B', 0, 'L', '0');
    $this->pdf->Cell(45, 5, 'TRA08 - B', 'B', 0, 'R', '0');

    $this->pdf->Ln(8);
     $this->pdf->SetFillColor(200,200,200);
    $this->pdf->Cell(110, 5, 'Tipo de Gasto ', 'B', 0, 'L', '1');
    $this->pdf->Cell(30, 5, ' Cantidad', 'B', 0, 'C', '1');
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(27, 5, ' Liq. Pagable', 'B', 0, 'C', '1');
    $this->pdf->Cell(24, 5, ' Total recibo', 'B', 0, 'C', '1');
    $this->pdf->SetFont('Arial', 'B', 11);
    $this->pdf->Ln(5);

    $cant = 0;
    $bruto = 0;
    $IUE = 0;
    $IT = 0;
    $RC_IVA = 0;
    $neto = 0;

    $title = 'dato';
    foreach ($traB->result() as $tr) {
        if ($title != $tr->tipo_factura) {
            $title = $tr->tipo_factura;
            $this->pdf->SetFont('Arial', '', 7);
            $this->pdf->Cell(190, 3, $title, 'B', 0, 'L', '0');
            $this->pdf->Ln(3);
        }


        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(110, 5, ucwords(strtolower($tr->descripcion_tra)), 'LB', 0, 'L', '0');
        $this->pdf->Cell(39, 5, $tr->cantidad, 'BR', 0, 'C', '0');
        $this->pdf->Cell(20, 5, (number_format($tr->total,2,'.',',')), 'B', 0, 'C', '0');
        $this->pdf->Cell(21, 5, $tr->Neto, 'BR', 0, 'J', '0');
        //$this->pdf->Cell(20, 5, $tr->IUE_calc, 'B', 0, 'C', '0');
        //$this->pdf->Cell(20, 5, $tr->IT_calc, 'B', 0, 'C', '0');
        //$this->pdf->Cell(20, 5, $tr->RC_IVA_calc, 'B', 0, 'C', '0');
        
        $this->pdf->Ln(5);

        $cant+=$tr->cantidad;
        $bruto+=$tr->Neto;
        $IUE+=$tr->IUE_calc;
        $IT+=$tr->IT_calc;
        $RC_IVA+=$tr->RC_IVA_calc;
        $neto+= $tr->total;
        $suma_total_final+=$tr->total;
        $cantidad_total_final+=$tr->cantidad;
        $total_neto_final+=$tr->Neto;

        if ($tr->tipo_factura == 'servicio') {
            $total_iue_serv+=$tr->IUE_calc;
            $total_it_serv+=$tr->IT_calc;
        }
        if ($tr->tipo_factura == 'compra') {
            $total_iue_com+=$tr->IUE_calc;
            $total_it_com+=$tr->IT_calc;
        }
        if ($tr->tipo_factura == 'alquiler') {
            $total_rc_iva+=$tr->RC_IVA_calc;
        }
        
         $this->pdf->Cell(6, 5, '', 'L', 0, 'C', '');
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->SetFillColor(230, 230, 230);
           // $this->pdf->Cell(15, 5, 'Nro.Fact. ', '', 0, 'C', '1');
            $this->pdf->Cell(20, 5, 'Fecha Recibo ', '', 0, 'L', '1');
            //$this->pdf->Cell(25, 5,' Nro .Fact.' , 'B', 0, 'C', '1');
            //$this->pdf->Cell(25, 5,' Nit .Fact.' , 'B', 0, 'C', '1');
            //$this->pdf->Cell(20, 5,' Fecha Fact.' , 'B', 0, 'C', '1');
           
            $this->pdf->Cell(40, 5, ' Detalle', '', 0, 'C', '1');
            $this->pdf->Cell(28, 5, ' Estacion', '', 0, 'C', '1');
            $this->pdf->Cell(15, 5, ' Placa', '', 0, 'C', '1');
            $this->pdf->Cell(20, 5, ' Total Recibo', '', 0, 'R', '1');
            $this->pdf->Cell(20, 5, ' Liq. pagable', '', 0, 'R', '1');
            $this->pdf->Cell(41, 5, ' ', 'LR', 0, 'C', '');
        $this->pdf->Ln(5);
        foreach ($datos_rendicion_detalle_traB[$tr->id_tipo_gasto]->result() as $fila) {
            $this->pdf->SetWidths(array(6, 20, 40, 28, 15,20,20,25 ));
            $this->pdf->SetAligns(array('','C', 'J', 'J', 'J','R','R',''));
            $x1=$this->pdf->getX();
            $y1=$this->pdf->getY();
          //  number_format($number);
           $datos=array('',$fila->fecha_factura,  utf8_decode($fila->glosa),$fila->sitio,$fila->placa_vehiculo,  number_format($fila->liq_pagable,2,'.',','),  number_format($fila->monto,2,'.',','),'');
           $tam_font=array('',8,8,7,7,8,8,8,'');
           $this->pdf->RowBodyRendicion($datos, 3.5,$tam_font); 
           $y2=$this->pdf->getY();
           $this->pdf->line($x1,$y1,$x1,$y2);
           $this->pdf->line(159,$y1,159,$y2);
           $this->pdf->line(200,$y1,200,$y2);

        }
        $this->pdf->Cell(190, 5, ' ', 'T', 0, 'C', '');
        $this->pdf->Ln(3);
        
    }
    $this->pdf->SetFillColor(90, 90, 90);
    $this->pdf->SetLineWidth(0.5);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->SetTextColor(240, 240, 240);
    $this->pdf->Cell(50, 5,'', '', 0, 'C', '1');
    $this->pdf->Cell(28, 5,'Cantidad Total.-', '', 0, 'C', '1');
    $this->pdf->Cell(15, 5, $cant, '', 0, 'C', '1');
      $this->pdf->SetFillColor(10, 10, 10);
    $this->pdf->Cell(55, 5, 'SUBTOTALES Bs.-', '', 0, 'R', '1');
  
    $this->pdf->Cell(22, 5, number_format($neto,2,'.',','), '', 0, 'C', '1');
    $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->SetFillColor(90, 90, 90);
    $this->pdf->Cell(20, 5, number_format($bruto,2,'.',','), '', 0, 'C', '1');
    $this->pdf->SetLineWidth(0.2);
    $this->pdf->SetFillColor(230, 230, 230);

    $this->pdf->Ln(7);
    
    $this->pdf->SetFont('Arial', '', 12);
    $this->pdf->SetTextColor(0, 0, 0);


    // $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 11);
    $this->pdf->Cell(190, 5, "Aclaraciones y Observaciones", 'LTR', 0, 'C', '0');
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->MultiCell(190, 4,  utf8_decode($datos_rendicion->row()->observacion) , 'LRB', 'J', '0');
    ////////desde aqui perteneces despues del comentario de asiento


    $this->pdf->SetDrawColor(0, 0, 0);
    $this->pdf->Ln(5);
    // $this->pdf->Ln(5);
    $this->pdf->Cell(58, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(46, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(46, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(40, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Ln(20);

    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(58, 4, 'ELABORADO POR:', 'LTR', 0, 'C', '0');
    //$this->pdf->Cell(58, 5, 'ELABORADO POR:' .$nombre, 'LBR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Cell(40, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Ln(4);


    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(58, 4, $dato_usuario_respo, 'LBR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'RESP. REGIONAL', 'BR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'RESP. PROYECTO', 'BR', 0, 'C', '0');
    $this->pdf->Cell(40, 4, 'Vo. Bo...', 'BR', 0, 'C', '0');
    // } 
}
$this->pdf->Ln(7);
if ($sgrB->num_rows() > 0) {
    $this->pdf->AddPage();
    $this->pdf->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 5, 5, 30, 'jpg');

    date_default_timezone_set("Etc/GMT+4");
    $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->Cell(190, 4, date_format(new DateTime('now'), 'd/m/Y, H:i'), '', 0, 'R', '0');
    $can_le = strlen($datos_rendicion->row()->idreg_ren . "");
    $cero = substr("000000", $can_le);
    $this->pdf->Ln(4);
    $this->pdf->SetFont('Times', 'B', 16);
    $this->pdf->Cell(190, 4, 'N. ' . $cero . $datos_rendicion->row()->idreg_ren, '', 0, 'R', '0');

    $this->pdf->Ln(4);
    $this->pdf->SetFont('Arial', 'B', 12);
    $this->pdf->Cell(180, 5, '', '', 0, 'C', '0');
    $this->pdf->Ln(1);
    $this->pdf->SetFont('Times', 'B', 12);
    $this->pdf->Cell(190, 5, strtoupper($datos_rendicion->row()->tipo_rend), '', 0, 'R', '0');


    $this->pdf->Ln(8);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(35, 5, 'Nombre del Tecnico: ', '', 0, '', '0');
    $this->pdf->SetFont('Arial', '', 8);
    $nombre_tecnico = $dato_usuario_tecnico->row()->ap_paterno . " " . $dato_usuario_tecnico->row()->ap_materno . " " . $dato_usuario_tecnico->row()->nombre;
    $this->pdf->Cell(80, 5, $nombre_tecnico, '', 0, '', '0');
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(30, 5, 'Proyecto : ', '', 0, '', '0');
    $this->pdf->SetFont('Arial', '', 10);

    $this->pdf->Cell(65, 5, $datos_rendicion->row()->nom_proy, '', 0, '', '0');
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 11);
    $this->pdf->Cell(145, 5, ' Formulario de gastos respaldo con recibos', 'B', 0, 'L', '0');
    $this->pdf->Cell(45, 5, 'SGR17 - B', 'B', 0, 'R', '0');
   
      $this->pdf->Ln(8);
    $this->pdf->SetFillColor(200,200,200);
    $this->pdf->Cell(110, 5, 'Tipo de Gasto ', 'B', 0, 'L', '1');
    $this->pdf->Cell(27, 5, ' Cantidad', 'B', 0, 'C', '1');
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(29, 5, ' Liq. Pagable', 'B', 0, 'C', '1');
    $this->pdf->Cell(24, 5, ' Total recibo', 'B', 0, 'C', '1');
    $this->pdf->SetFont('Arial', 'B', 11);
    $this->pdf->Ln(5);


    $cant = 0;
    $bruto = 0;
    $IUE = 0;
    $IT = 0;
    $RC_IVA = 0;
    $neto = 0;

    $title = 'dato';
    foreach ($sgrB->result() as $tr) {
        if ($title != $tr->tipo_factura) {
            $title = $tr->tipo_factura;

            $this->pdf->SetFont('Arial', '', 7);
            $this->pdf->Cell(190, 3, $title, 'B', 0, 'L', '0');
            $this->pdf->Ln(3);
        }


        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(110, 5, ucwords(strtolower($tr->descripcion_tra)), 'B', 0, 'L', '0');
        $this->pdf->Cell(39, 5, $tr->cantidad, 'B', 0, 'C', '0');
        $this->pdf->Cell(20, 5, (number_format($tr->total,2,'.',',')), 'B', 0, 'C', '0');
        $this->pdf->Cell(21, 5, $tr->Neto, 'B', 0, 'C', '0');
        // $this->pdf->Cell(20, 5, $tr->IUE_calc, 'B', 0, 'C', '0');
        //$this->pdf->Cell(20, 5, $tr->IT_calc, 'B', 0, 'C', '0');
        //$this->pdf->Cell(20, 5, $tr->RC_IVA_calc, 'B', 0, 'C', '0');
        
        $this->pdf->Ln(5);


        $cant+=$tr->cantidad;
        $bruto+=$tr->Neto;
        $IUE+=$tr->IUE_calc;
        $IT+=$tr->IT_calc;
        $RC_IVA+=$tr->RC_IVA_calc;
        $neto+= $tr->total;
        $suma_total_final+=$tr->total;
        $cantidad_total_final+=$tr->cantidad;
        $total_neto_final+=$tr->Neto;

        if ($tr->tipo_factura == 'servicio') {
            $total_iue_serv+=$tr->IUE_calc;
            $total_it_serv+=$tr->IT_calc;
        }
        if ($tr->tipo_factura == 'compra') {
            $total_iue_com+=$tr->IUE_calc;
            $total_it_com +=$tr->IT_calc;
        }
        if ($tr->tipo_factura == 'alquiler') {
            $total_rc_iva+=$tr->RC_IVA_calc;

            $total_it_serv +=$tr->IT_calc;
        }
        $this->pdf->Cell(6, 5, '', 'L', 0, 'C', '');
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->SetFillColor(230, 230, 230);
           // $this->pdf->Cell(15, 5, 'Nro.Fact. ', '', 0, 'C', '1');
            $this->pdf->Cell(20, 5, 'Fecha Recibo ', '', 0, 'L', '1');
            //$this->pdf->Cell(25, 5,' Nro .Fact.' , 'B', 0, 'C', '1');
            //$this->pdf->Cell(25, 5,' Nit .Fact.' , 'B', 0, 'C', '1');
            //$this->pdf->Cell(20, 5,' Fecha Fact.' , 'B', 0, 'C', '1');
           
            $this->pdf->Cell(40, 5, ' Detalle', '', 0, 'C', '1');
            $this->pdf->Cell(28, 5, ' Estacion', '', 0, 'C', '1');
            $this->pdf->Cell(15, 5, ' Placa', '', 0, 'C', '1');
            $this->pdf->Cell(20, 5, ' Total Recibo', '', 0, 'C', '1');
            $this->pdf->Cell(20, 5, ' Liq. pagable', '', 0, 'C', '1');
            $this->pdf->Cell(41, 5, ' ', 'LR', 0, 'C', '');
        $this->pdf->Ln(5);
        foreach ($datos_rendicion_detalle_sgrB[$tr->id_tipo_gasto]->result() as $fila) {
            $this->pdf->SetWidths(array(6, 20, 40, 28, 15,20,20,25 ));
            $this->pdf->SetAligns(array('','C', 'J', 'J', 'J','R','R',''));
            $x1=$this->pdf->getX();
            $y1=$this->pdf->getY();
          //  number_format($number);
           $datos=array('',$fila->fecha_factura,  utf8_decode($fila->glosa),$fila->sitio,$fila->placa_vehiculo,  number_format($fila->liq_pagable,2,'.',','),  number_format($fila->monto,2,'.',','),'');
           $tam_font=array('',8,8,7,7,8,8,8,'');
           $this->pdf->RowBodyRendicion($datos, 3.5,$tam_font); 
           $y2=$this->pdf->getY();
           $this->pdf->line($x1,$y1,$x1,$y2);
           $this->pdf->line(159,$y1,159,$y2);
           $this->pdf->line(200,$y1,200,$y2);

        }
        $this->pdf->Cell(190, 5, ' ', 'T', 0, 'C', '');
        $this->pdf->Ln(3); 
        
    }
    $this->pdf->SetFillColor(90, 90, 90);
    $this->pdf->SetLineWidth(0.5);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->SetTextColor(240, 240, 240);
    $this->pdf->Cell(50, 5,'', '', 0, 'C', '1');
    $this->pdf->Cell(28, 5,'Cantidad Total.-', '', 0, 'C', '1');
    $this->pdf->Cell(15, 5, $cant, '', 0, 'C', '1');
    
   $this->pdf->SetFillColor(10, 10, 10);
    $this->pdf->Cell(55, 5, 'SUBTOTALES Bs.-', '', 0, 'R', '1');
  
    $this->pdf->Cell(22, 5, number_format($neto,2,'.',','), '', 0, 'C', '1');
    $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->SetFillColor(90, 90, 90);
    $this->pdf->Cell(20, 5, number_format($bruto,2,'.',','), '', 0, 'C', '1');
    $this->pdf->SetLineWidth(0.2);
    $this->pdf->SetFillColor(230, 230, 230);
    
    
    

    $this->pdf->Ln(7);
    
    $this->pdf->SetFont('Arial', '', 12);
    $this->pdf->SetTextColor(0, 0, 0);


    // $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 11);
    $this->pdf->Cell(190, 5, "Aclaraciones y Observaciones", 'LTR', 0, 'C', '0');
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->MultiCell(190, 4,  utf8_decode($datos_rendicion->row()->observacion) , 'LRB', 'J', '0');
    ////////desde aqui perteneces despues del comentario de asiento


    $this->pdf->SetDrawColor(0, 0, 0);
    $this->pdf->Ln(5);
    // $this->pdf->Ln(5);
    $this->pdf->Cell(58, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(46, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(46, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(40, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Ln(20);

    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(58, 4, 'ELABORADO POR:', 'LTR', 0, 'C', '0');
    //$this->pdf->Cell(58, 5, 'ELABORADO POR:' .$nombre, 'LBR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Cell(40, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Ln(4);


    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(58, 4, $dato_usuario_respo, 'LBR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'RESP. REGIONAL', 'BR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'RESP. PROYECTO', 'BR', 0, 'C', '0');
    $this->pdf->Cell(40, 4, 'Vo. Bo...', 'BR', 0, 'C', '0');
    // } 
}
$this->pdf->Ln(7);
if ($sgrC->num_rows() > 0) {
    $this->pdf->AddPage();
    $this->pdf->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 5, 5, 30, 'jpg');

    date_default_timezone_set("Etc/GMT+4");
    $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->Cell(190, 4, date_format(new DateTime('now'), 'd/m/Y, H:i'), '', 0, 'R', '0');
    $can_le = strlen($datos_rendicion->row()->idreg_ren . "");
    $cero = substr("000000", $can_le);
    $this->pdf->Ln(4);
    $this->pdf->SetFont('Times', 'B', 16);
    $this->pdf->Cell(190, 4, 'N. ' . $cero . $datos_rendicion->row()->idreg_ren, '', 0, 'R', '0');

    $this->pdf->Ln(4);
    $this->pdf->SetFont('Arial', 'B', 12);
    $this->pdf->Cell(180, 5, '', '', 0, 'C', '0');
    $this->pdf->Ln(1);
    $this->pdf->SetFont('Times', 'B', 12);
    $this->pdf->Cell(190, 5, strtoupper($datos_rendicion->row()->tipo_rend), '', 0, 'R', '0');


    $this->pdf->Ln(8);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(35, 5, 'Nombre del Tecnico: ', '', 0, '', '0');
    $this->pdf->SetFont('Arial', '', 8);
    $nombre_tecnico = $dato_usuario_tecnico->row()->ap_paterno . " " . $dato_usuario_tecnico->row()->ap_materno . " " . $dato_usuario_tecnico->row()->nombre;
    $this->pdf->Cell(80, 5, $nombre_tecnico, '', 0, '', '0');
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(30, 5, 'Proyecto : ', '', 0, '', '0');
    $this->pdf->SetFont('Arial', '', 10);

    $this->pdf->Cell(65, 5, $datos_rendicion->row()->nom_proy, '', 0, '', '0');

    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 11);
    $this->pdf->Cell(145, 5, ' Formulario de gastos telefonia respaldado con facturas', 'B', 0, 'L', '0');

    $this->pdf->Cell(45, 5, 'SGR17 - C', 'B', 0, 'R', '0');
    
    $this->pdf->Ln(8);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Ln(8);
    $this->pdf->SetFillColor(200, 200, 200);
    $this->pdf->Cell(90, 5, 'Tipo de Gasto ', 'B', 0, 'L', '1');
    $this->pdf->Cell(68, 5, ' Cantidad de Facturas', 'B', 0, 'C', '1');
    $this->pdf->Cell(32, 5, ' Total Factura', '', 0, 'C', '1');
    // $this->pdf->Cell(20, 5, ' IVA', 'B', 0, 'C', '1');
    // $this->pdf->Cell(20, 5, ' Valor Neto', 'B', 0, 'C', '1');
    $cant = 0;
    $bruto = 0;
    $iva = 0;
    $neto = 0;

    $this->pdf->Ln(5);
    foreach ($sgrC->result() as $tr) {
        
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(90, 5, ucwords(strtolower($tr->descripcion_tra)), 'LTB', 0, 'L', '0');
        $this->pdf->Cell(68, 5, $tr->cantidad, 'BTR', 0, 'C', '0');
        $this->pdf->Cell(32, 5, (number_format($tr->total,2,'.',',')), 'BTR', 0, 'C', '0');

        $valor_neto = number_format($tr->total - $tr->IVA_calc, 2);
        // $this->pdf->Cell(20, 5, $tr->IVA_calc, 'B', 0, 'C', '0');
        //$this->pdf->Cell(20, 5, $valor_neto, 'B', 0, 'C', '0');
        
     
        $cant+=$tr->cantidad;
        $bruto+=$tr->total;
        $iva+=$tr->IVA_calc;
       // $neto+=$valor_neto;
        $suma_total_final+=$tr->total;
        $cantidad_total_final+=$tr->cantidad;
        $total_neto_final+=$tr->total;
        $total_iva_final+=$tr->IVA_calc;
       
        $this->pdf->Ln(5);

            $this->pdf->Cell(6, 5, '', 'L', 0, 'C', '');
            $this->pdf->SetFont('Arial', 'B', 8);
            $this->pdf->SetFillColor(230, 230, 230);
            $this->pdf->Cell(15, 5, 'Nro.Fact. ', '', 0, 'C', '1');
            $this->pdf->Cell(17, 5, 'Fecha Fact. ', '', 0, 'L', '1');
            //$this->pdf->Cell(25, 5,' Nro .Fact.' , 'B', 0, 'C', '1');
            //$this->pdf->Cell(25, 5,' Nit .Fact.' , 'B', 0, 'C', '1');
            //$this->pdf->Cell(20, 5,' Fecha Fact.' , 'B', 0, 'C', '1');
           
            $this->pdf->Cell(45, 5, ' Glosa', '', 0, 'C', '1');
            $this->pdf->Cell(40, 5, ' Estacion', '', 0, 'C', '1');
            $this->pdf->Cell(17, 5, ' Nro. Celular', '', 0, 'C', '1');
            $this->pdf->Cell(18, 5, ' Monto (Bs)', '', 0, 'C', '1');
            $this->pdf->Cell(32, 5, ' ', 'LR', 0, 'C', '');
        $this->pdf->Ln(5); 
        foreach ($datos_rendicion_detalle_sgrC[$tr->id_tipo_gasto]->result() as $fila) {
            $this->pdf->SetWidths(array(6,15, 17, 45, 40,17, 18,32 ));
            $this->pdf->SetAligns(array('','C', 'J', 'J', 'J','J','R',''));
            $x1=$this->pdf->getX();
            $y1=$this->pdf->getY();
         
           $datos=array('',$fila->nro_fac,$fila->fecha_factura,  utf8_decode($fila->glosa),$fila->sitio, $fila->placa_vehiculo, number_format($fila->monto,2,'.',','),'' );
           $tam_font=array('',8,8,7,7,8,8,'');
           $this->pdf->RowBodyRendicion($datos, 3.5,$tam_font); 
           $y2=$this->pdf->getY();
           $this->pdf->line($x1,$y1,$x1,$y2);
           $this->pdf->line(168,$y1,168,$y2);
           $this->pdf->line(200,$y1,200,$y2);
         
        }
        $this->pdf->Cell(190, 5, ' ', 'T', 0, 'C', '');
        $this->pdf->Ln(3);

    }
    $this->pdf->SetFillColor(90, 90, 90);
    $this->pdf->SetLineWidth(0.5);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->SetTextColor(240, 240, 240);
     // $this->pdf->Ln(5);
    $this->pdf->Cell(65, 5,'', '', 0, 'C', '1');
    $this->pdf->Cell(30, 5,'Cantidad Total.-', '', 0, 'C', '1');
     $this->pdf->Cell(10, 5, $cant, '', 0, 'C', '1');
    $this->pdf->Cell(54, 5, 'SUBTOTAL Bs.-', '', 0, 'R', '1');
   
    $this->pdf->Cell(31, 5, number_format($bruto,2,'.',','), '', 0, 'C', '1');
    
   
    $this->pdf->SetLineWidth(0.2);
    $this->pdf->SetFillColor(230, 230, 230);

    $this->pdf->Ln(7);



    $this->pdf->SetFont('Arial', '', 12);
    $this->pdf->SetTextColor(0, 0, 0);


    // $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 11);
    $this->pdf->Cell(190, 5, "Aclaraciones y Observaciones", 'LTR', 0, 'C', '0');
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->MultiCell(190, 4, utf8_decode($datos_rendicion->row()->observacion), 'LRB', 'J', '0');
    ////////desde aqui perteneces despues del comentario de asiento


    $this->pdf->SetDrawColor(0, 0, 0);
    $this->pdf->Ln(5);
    // $this->pdf->Ln(5);
    $this->pdf->Cell(58, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(46, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(46, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(40, 20, ' ', 'LTR', 0, 'L', '0');
    $this->pdf->Ln(20);

    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(58, 4, 'ELABORADO POR:', 'LTR', 0, 'C', '0');
    //$this->pdf->Cell(58, 5, 'ELABORADO POR:' .$nombre, 'LBR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Cell(40, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Ln(4);


    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(58, 4, $dato_usuario_respo, 'LBR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'RESP. REGIONAL', 'BR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'RESP. PROYECTO', 'BR', 0, 'C', '0');
    $this->pdf->Cell(40, 4, 'Vo. Bo...', 'BR', 0, 'C', '0');

    // }   
}




/*
  $this->pdf->Ln(-20);
  $this->pdf->SetFillColor(50,50,50);
  $this->pdf->SetTextColor(255,255,255);
  $this->pdf->Ln(5);$this->pdf->SetFont('Arial', 'B', 12);
  $this->pdf->Cell(90, 5,' TOTAL REEMBOLSO : Bs.- '.$suma_total_final , 'T', 0, 'L', '1');$this->pdf->Ln(5);
  $this->pdf->Ln(5);$this->pdf->SetFont('Arial', '', 9);
  $this->pdf->SetTextColor(0,0,0);
  $this->pdf->SetDrawColor(240,240,240);

  $this->pdf->Cell(90, 5,' TOTAL NETO : Bs.- '.$total_neto_final , 'T', 0, 'L', '0');$this->pdf->Ln(5);
  $this->pdf->SetFont('Arial', '', 9);
  $this->pdf->Cell(90, 5,' Recibos y Facturas Registradas : '.$cantidad_total_final , 'T', 0, 'L', '0');
  $this->pdf->Ln(4);    $this->pdf->Cell(90, 4,' IVA (13%) :' .$total_iva_final , 'T', 0, 'L', '0');
  $this->pdf->Ln(4);    $this->pdf->Cell(90, 4,' IUE Servicios (12,5%) : ' .$total_iue_serv, 'T', 0, 'L', '0');
  $this->pdf->Ln(4);    $this->pdf->Cell(90, 4,' IUE Compras (5%) : ' .$total_iue_com, 'T', 0, 'L', '0');
  $this->pdf->Ln(4);    $this->pdf->Cell(90, 4,' IT Servicios (3%) : ' .$total_it_serv, 'T', 0, 'L', '0');
  $this->pdf->Ln(4);    $this->pdf->Cell(90, 4,' IT Compras (3%) : ' .$total_it_com , 'T', 0, 'L', '0');
  $this->pdf->Ln(4);    $this->pdf->Cell(90, 4,' RC-IVA (13%)  : ' .$total_rc_iva , 'T', 0, 'L', '0');


  $this->pdf->SetDrawColor(0,0,0);
  $this->pdf->Ln(5);
  // $this->pdf->Ln(5);
  $this->pdf->Cell(58, 20,' ', 'LTR', 0, 'L', '0');
  $this->pdf->Cell(46, 20,' ', 'LTR', 0, 'L', '0');
  $this->pdf->Cell(46, 20,' ', 'LTR', 0, 'L', '0');
  $this->pdf->Cell(40, 20,' ', 'LTR', 0, 'L', '0');
  $this->pdf->Ln(20);

  $this->pdf->SetFont('Arial', 'B', 8);
  $this->pdf->Cell(58, 4, 'ELABORADO POR:', 'LTR', 0, 'C', '0');
  //$this->pdf->Cell(58, 5, 'ELABORADO POR:' .$nombre, 'LBR', 0, 'C', '0');
  $this->pdf->Cell(46, 4, 'Firma', 'TR', 0, 'C', '0');
  $this->pdf->Cell(46, 4, 'Firma', 'TR', 0, 'C', '0');
  $this->pdf->Cell(40, 4, 'Firma', 'TR', 0, 'C', '0');
 */



$this->pdf->AliasNbPages();
$this->pdf->Output('rend_rembolso', 'I');
?>