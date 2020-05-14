<?php

include_once APPPATH . 'helps/fpdf/fpdf.php';
//  echo 'ingresa a la funcion de generar pdf';

$this->pdf = new PDF(); //por defecto A4
//echo 'se ha generado el pdf';
// $this->pdf->SetTitle("Solicitud dead", false);
// Carga de datos
$this->pdf->AddPage('L', 'A4');

//cabecera
$this->pdf->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 260, 5, 30, 'jpg');

$this->pdf->Ln(0);

$this->pdf->SetFont('Arial', 'UB', 11);
$this->pdf->Cell(150, 5, 'Reporte de Horas extra del Personal' , 'LT', 0, 'J', '0');
$this->pdf->Cell(95, 5, '', 'RT', 0, 'J', '0');
$this->pdf->SetFont('Arial', '', 9);

$this->pdf->Ln(5);
$this->pdf->Cell(110, 4, 'Responsable de proyecto :' . $datos_usuario->nomComp, 'LR', 0, 'J', '0');
$this->pdf->SetFont('Arial', 'B', 9);
if ($totales_tipo_trabajo->num_rows() > 0) {
    $div = (110 / $totales_tipo_trabajo->num_rows());
    for ($j = 0; $j < $totales_tipo_trabajo->num_rows(); $j++) {
        $dato = $totales_tipo_trabajo->row($j);
        $this->pdf->Cell($div, 4, $dato->tipo_trabajo, 'LTR', 0, 'C', '0');
    }
} else {
    $this->pdf->Cell(110, 4, 'no se encontro tipo de trabajos', 'LTR', 0, 'C', '0');
}
$this->pdf->Cell(25, 4, 'Total', 'TLR', 0, 'C', '0');
$this->pdf->SetFont('Arial', '', 9);
$this->pdf->Ln(4);
$mes_ant = 0;
$anio_ant = 0;
if ($mes == 1) {
    $mes_ant = 12;
    $anio_ant = $anio - 1;
} else {
    $mes_ant = $mes - 1;
    $anio_ant = $anio;
}
$this->pdf->Cell(110, 4, 'Periodo :' . $mes . " / " . $anio . "(26/" . $mes_ant . "/" . $anio_ant . " - 25/" . $mes . "/" . $anio . ")", 'LR', 0, 'J', '0');
$sumar_horas=0;
if ($totales_tipo_trabajo->num_rows() > 0) {
    $div = (110 / $totales_tipo_trabajo->num_rows());
    for ($j = 0; $j < $totales_tipo_trabajo->num_rows(); $j++) {
        $dato = $totales_tipo_trabajo->row($j);
        $sumar_horas+=$dato->horas_sc;
        date_default_timezone_set("Etc/GMT+4");
        $this->pdf->Cell($div, 4, number_format($dato->horas_sc,2,",","."), 'LTR', 0, 'C', '0');
    }
} else {
    $this->pdf->Cell(110, 4, 'no se encontro datos', 'LTR', 0, 'C', '0');
}
$this->pdf->Cell(25, 4, $sumar_horas, 'TLR', 0, 'C', '0');


$this->pdf->Ln(4);
$this->pdf->Cell(110, 4, 'Generado '.date_format(new DateTime('now'), 'd/m/Y, H:i'), 'LRB', 0, 'J', '0');

$porcentaje=0;
if ($totales_tipo_trabajo->num_rows() > 0) {
    $div = (110 / $totales_tipo_trabajo->num_rows());
    for ($j = 0; $j < $totales_tipo_trabajo->num_rows(); $j++) {
        $dato = $totales_tipo_trabajo->row($j);
        $porcent=($dato->horas_sc*100)/$sumar_horas;
        $this->pdf->Cell($div, 4, number_format($porcent,2,",",".")." %" , 'LTBR', 0, 'C', '0');
    }
} else {
    $this->pdf->Cell(110, 4, 'no se encontro datos', 'LBTR', 0, 'C', '0');
}
$this->pdf->Cell(25, 4, "100 %", 'BTLR', 0, 'C', '0');




$user = 0;
$sw = 0;

$this->pdf->SetWidths(array(10, 10, 100, 100, 18, 18, 9, 15));
$this->pdf->SetAligns(array('J', 'J', 'J', 'J', 'J', 'J', 'J', 'J'));

$titulos = array('Fec', 'Id', 'Falla', 'Intervencion', 'Inicio', 'Fin', 'Hrs', 'Tipo');
//$this->pdf->RowTitle($titulos);



if ($reporte->num_rows() > 0) {
    $i_tot = 0;
    foreach ($reporte->result() as $fila) {
        if ($sw == 0) {
            $this->pdf->Ln(6);
            $user = $fila->id_usuario;
            $tot_rep = $totales_reporte->row($i_tot);
            $i_tot++;
            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->SetLineWidth(.2);
            $this->pdf->SetFillColor(0, 0, 0);
            $this->pdf->SetTextColor(255, 255, 255);
            $this->pdf->Cell(240, 4, $fila->apellidos . "," . $fila->nombre, 'B', 0, 'J', '1');
            $this->pdf->Cell(40, 4, "total Hrs. " . $tot_rep->horas_sc, 'B', 0, 'J', '1');
           // $this->pdf->Cell(80, 4, $fila->apellidos . "," . $fila->nombre, 'B', 0, 'J', '1');
            $this->pdf->Ln(4);

            $this->pdf->RowTitle($titulos, array(200, 200, 200), array(20, 20, 20), array(20, 20, 20));
            $this->pdf->SetFont('Arial', '', 6.5);
            $dato = array(date_format(new DateTime($fila->fhatencion), 'd/m'),
                $fila->id_he,
                $fila->falla,
                $fila->intervencion,
                date_format(new DateTime($fila->fhatencion), 'd/m H:i'),
                date_format(new DateTime($fila->fhconclusion), 'd/m H:i'),
                $fila->cantidad_horas_s_c,
                $fila->tipo_trabajo);
            $this->pdf->RowBody($dato);
            $sw = 1;
        } else {
            if ($user != $fila->id_usuario) {
                $this->pdf->Cell(280, 2, "", 'T', 0, 'J', '0');
                $user = $fila->id_usuario;
                $tot_rep = $totales_reporte->row($i_tot);
                $i_tot++;

                $this->pdf->Ln(4);
                $this->pdf->SetFont('Arial', 'B', 10);
                $this->pdf->SetFillColor(0, 0, 0);
                $this->pdf->SetTextColor(255, 255, 255);
                $this->pdf->Cell(240, 4, $fila->apellidos . "," . $fila->nombre, '', 0, 'J', '1');
                $this->pdf->Cell(40, 4, "total Hrs. " . $tot_rep->horas_sc, 'B', 0, 'J', '1');
               // $this->pdf->Cell(80, 4, $fila->apellidos . "," . $fila->nombre, 'B', 0, 'J', '1');

                $this->pdf->Ln(4);
                $this->pdf->RowTitle($titulos, array(200, 200, 200), array(20, 20, 20), array(20, 20, 20));
                $this->pdf->SetFont('Arial', '', 6.5);
                $dato = array(date_format(new DateTime($fila->fhatencion), 'd/m'),
                    $fila->id_he ,
                    $fila->falla,
                    $fila->intervencion,
                    date_format(new DateTime($fila->fhatencion), 'd/m H:i'),
                    date_format(new DateTime($fila->fhconclusion), 'd/m H:i'),
                    $fila->cantidad_horas_s_c,
                    $fila->tipo_trabajo);
                $this->pdf->RowBody($dato);
            } else {
                $dato = array(date_format(new DateTime($fila->fhatencion), 'd/m'),
                    $fila->id_he ,
                    $fila->falla,
                    $fila->intervencion,
                    date_format(new DateTime($fila->fhatencion), 'd/m H:i'),
                    date_format(new DateTime($fila->fhconclusion), 'd/m H:i'),
                    $fila->cantidad_horas_s_c,
                    $fila->tipo_trabajo);
                $this->pdf->RowBody($dato);
            }
        }
    }
    $this->pdf->Cell(280, 2, "", 'T', 0, 'J', '0');
} else {
    $this->pdf->Ln(4);
    $this->pdf->Cell(190, 4, ' no se han encontrado registros para reportar ', '', 0, 'J', '0');
    $this->pdf->Ln(4);
}



$this->pdf->Ln(10);
$this->pdf->MultiCell(105, 4, $reporteSQL, '', 'J');


// fin de cabecera
// 
// 
//obtencion de datos 
//
//



$this->pdf->AliasNbPages();

$this->pdf->Output('OPssss', 'I');
?>
