<?php

include_once APPPATH . 'helps/fpdf/fpdf.php';
$this->pdf = new PDF('P', 'mm', 'A4'); //por defecto A4
$this->pdf->SetMargins(10, 1, 10);
$this->pdf->SetAutoPageBreak(true, 10);

//$this->pdf->Image(base_url() . 'imagenesweb/recursos/mosaico.png', 10, 60, 190, 'png');
//
//$this->pdf->Image(base_url() . 'imagenesweb/recursos/mosaico.png', 10, 60, 190, 'png'); // 5, 5, 30, 'jpg'
//$this->pdf->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 20, 3, 40, 'jpg');
//
//$this->pdf->Cell(120, 4, 'hola mundo', '', 0, 'C', '0');
//
$resultado = $reporte[0];
$this->pdf->AddPage();
$this->pdf->HeaderViaticUserReport();
foreach ($resultado->result()as $usuario) {
    

    $this->pdf->Image(base_url() . 'imagenesweb/recursos/membretadonuevo.png', 0, 3, 210, 'jpg');
    $this->pdf->Image(base_url() . 'imagenesweb/recursos/fondoagua.png', 30, 153,150, 'jpg');
    $this->pdf->Ln(9);
    $this->pdf->SetFont('Arial', 'B', 13);
    $this->pdf->SetTextColor(240, 240, 240);
    $this->pdf->Cell(150, 4, ' SOLICITUD DE VIATICOS SUPERVISION (PROYECTOS) ', '', 0, 'C', '0');
    $this->pdf->Ln(10);
    $this->pdf->SetTextColor(50, 50, 50);
    $this->pdf->SetFont('Arial', 'B', 6);
    $this->pdf->SetLineWidth(0.01);
    $this->pdf->Cell(100, 3, 'Proyecto', 'TL', 0, 'L', '');
    $this->pdf->Cell(20, 3, 'Mes', 'T', 0, 'C', '');
    $this->pdf->Cell(20, 3, utf8_decode('Año'), 'T', 0, 'C', '');
    $this->pdf->Cell(50, 3, utf8_decode('Fecha y hora de Impresión'), 'TR', 0, 'C', '');
    $this->pdf->Ln(3);
    $this->pdf->SetFont('Arial', 'B', 10);

    $this->pdf->Cell(100, 5, $usuario->nombre, 'LB', 0, 'L', '');
    $this->pdf->Cell(20, 5, 'Junio', 'B', 0, 'C', '');
    $this->pdf->Cell(20, 5, '2018', 'B', 0, 'C', '');
     date_default_timezone_set("Etc/GMT+4");
    $this->pdf->SetFont('Arial', '', 8);
 
    $this->pdf->Cell(50, 5, date_format(new DateTime('now'), 'd/m/Y, H:i'), 'BR', 0, 'C', '');
    //$this->pdf->SetFont('Courier', 'B', 14);
    //$this->pdf->Cell(35, 5, '00014', '', 0, 'C', '');


    //$this->pdf->Cell(35, 3, utf8_decode('codigo Impresión:'), '', 0, 'C', '');


    $consulta = $reporte[$usuario->cod_user];
    $this->pdf->Ln(2);
    $this->pdf->SetLineWidth(0.7);
    $this->pdf->SetDrawColor(0, 75, 146);
    $this->pdf->Cell(190, 4, '', 'B', 0, 'C', '');
    $this->pdf->Ln(5);
    $cont = 1;
    $acumulador = 0;
    foreach ($consulta->result() as $viatico) {
        $this->pdf->SetDrawColor(160, 160, 160);
        $this->pdf->SetLineWidth(0.02);
        $this->pdf->SetFont('Arial', '', 6);
        $this->pdf->Cell(160, 2.5, 'Registro', '', 0, 'L', '');
        $this->pdf->Cell(30, 2.5, utf8_decode('ID Viatico Supervisión'), 'LRT', 0, 'C', '');
        $this->pdf->Ln(2.5);
        $this->pdf->SetFont('Arial', 'B', 8);

        $this->pdf->Cell(160, 3, $cont, '', 0, 'L', '');
        $this->pdf->SetFont('Arial', 'B', 11);
        $this->pdf->SetTextColor(0, 74, 146);
        $can_le = strlen($viatico->id_viatico_extra . "");
        $cero = substr("00000", $can_le);
        
        $this->pdf->Cell(30, 3, 'ID:VE'.$cero . $viatico->id_viatico_extra, 'RL', 0, 'C', '');
        $this->pdf->Ln(3);

        $this->pdf->SetFont('Arial', '', 6);
        $this->pdf->SetTextColor(60, 60, 60);
        $this->pdf->SetDrawColor(160, 160, 160);
        $this->pdf->SetLineWidth(0.02);
        $this->pdf->Cell(70, 3, 'Personal Solicitante', 'TL', 0, 'L', '');
        $this->pdf->Cell(20, 3, 'CI Personal', 'TR', 0, 'C', '');
        
        $this->pdf->Cell(20, 3, 'Dias', 'T', 0, 'C', '');
        
        $this->pdf->Cell(20, 3, 'Horas', 'T', 0, 'C', '');
        
        $this->pdf->Cell(30, 3, 'Monto Liquido(Bs)', 'T', 0, 'C', '');
        $this->pdf->Cell(30, 3, 'Monto Total(Bs)', 'R', 0, 'C', '');

        $this->pdf->Ln(3);

        $this->pdf->SetLineWidth(0.05);

        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->SetTextColor(60, 60, 60);

        $this->pdf->Cell(70, 4, $viatico->ap_paterno . " " . $viatico->ap_materno . "," . $viatico->nombre, 'LB', 0, 'L', '');
        $this->pdf->Cell(20, 4, $viatico->ci, 'RB', 0, 'C', '');
        $this->pdf->SetFont('Arial', '', 12);
        $this->pdf->SetTextColor(149, 0, 30);
     
        $this->pdf->Cell(20, 4,number_format(($viatico->monto_calculado/150),0), '', 0, 'C', '');
        $this->pdf->Cell(20, 4, number_format($viatico->cantidad_horas,2,',','.') , '', 0, 'C', '');
        $this->pdf->Cell(30, 4, number_format($viatico->monto_calculado,2,',','.'), '', 0, 'C', '');
        $this->pdf->SetFont('Arial', 'B', 14);
        $this->pdf->Cell(30, 4, number_format(($viatico->monto_calculado/0.87),2,',','.'), 'R', 0, 'C', '');

        $this->pdf->Ln(4);

        $this->pdf->SetTextColor(60, 60, 60);
        $this->pdf->SetFont('Arial', '', 6);
        $this->pdf->SetLineWidth(0.2);
        //$this->pdf->SetDrawColor(0, 75, 141);
        $this->pdf->Cell(90, 3, 'Comentario', 'LR', 0, 'J', '');
        $this->pdf->Cell(100, 3, '', 'R', 0, 'J', '');
        $this->pdf->Ln(3);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(90, 6, 'Tiempo de Supervision de ' . number_format(($viatico->monto_calculado/150),0) . ' dias o equivalente a '.number_format($viatico->cantidad_horas,2,',','.').' horas', 'LBR', 0, 'J', '');
        $this->pdf->SetTextColor(0, 0, 0);
        $this->pdf->SetFont('Arial', 'UB', 8);
        $this->pdf->Cell(7, 6, 'SON:', 'B', 0, 'J', '');

        $this->pdf->Cell(93, 6, utf8_decode($literales[$viatico->id_viatico_extra]), 'RB', 0, 'J', '');
        $this->pdf->SetTextColor(60, 60, 60);
        $this->pdf->Ln(6);

        $this->pdf->SetLineWidth(0.5);
        $this->pdf->SetDrawColor(0, 75, 146);

        $this->pdf->Cell(190, 1, '', 'B', 0, 'C', '');
        $this->pdf->Ln(4);
        $cont++;
        $acumulador+=$viatico->monto_calculado;
    }
    $this->pdf->SetFont('Arial', '', 6);
    $this->pdf->SetLineWidth(0.1);
    $this->pdf->SetDrawColor(60, 60, 60);

    $this->pdf->Cell(100, 4, utf8_decode('Resumen'), 'TLR', 0, 'L', '');
    $this->pdf->Cell(45, 4, 'Elaborado por:', 'TL', 0, 'C', '');
    $this->pdf->Cell(45, 4, 'Autorizado por:', 'TR', 0, 'C', '');
    $this->pdf->Ln(4);
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->Cell(80, 4, utf8_decode('Cantidad de viaticos de Supervición:'), 'L', 0, 'R', '');
    $this->pdf->SetFont('Arial', 'B', 9);
    $this->pdf->Cell(20, 4, ($cont-1), 'R', 0, 'L', '');
    $this->pdf->Cell(90, 4, '', 'LR', 0, 'C', '');
    $this->pdf->Ln(4);
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->Cell(80, 4, utf8_decode('Liquido acumulado en viaticos de Supervision:'), 'L', 0, 'R', '');
    $this->pdf->SetFont('Arial', 'B', 9);
    $this->pdf->Cell(20, 4, number_format($acumulador,2,',','.'), 'R', 0, 'L', '');
    $this->pdf->Cell(90, 4, '', 'LR', 0, 'C', '');
    
    $this->pdf->Ln(4);
$this->pdf->SetFont('Arial', '', 9);
    $this->pdf->Cell(80, 4, utf8_decode('Monto Total Acumulado en viaticos de Supervision:'), 'BL', 0, 'R', '');
    $this->pdf->SetFont('Arial', 'B', 9);
    $this->pdf->Cell(20, 4, number_format(($acumulador/0.87),2,',','.'), 'BR', 0, 'L', '');
    $this->pdf->Cell(90, 4, '', 'LRB', 0, 'C', '');
    $this->pdf->SetFont('Arial', '', 9);
  
    $this->pdf->Ln(4);
}


$this->pdf->AliasNbPages();
$this->pdf->Output('reporte_vextra_proyecto', 'I');
?>