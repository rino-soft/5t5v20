<?php

include_once APPPATH . 'helps/fpdf/fpdf.php';
//  echo 'ingresa a la funcion de generar pdf';
$this->pdf = new PDF(); //por defecto A4
//echo 'se ha generado el pdf';
// $this->pdf->SetTitle("Solicitud dead", false);
// Carga de datos
$this->pdf->AddPage();

//cabecera
$this->pdf->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 5, 5, 30, 'jpg');

$this->pdf->SetFont('Times', 'B', 12);

if ($id_ma < 10)
    ;$zero = "0000";
if ($id_ma >= 10 and $id_ma < 100)
    $zero = "000";
if ($id_ma >= 100 and $id_ma < 1000)
    $zero = "00";
if ($id_ma >= 1000 and $id_ma < 10000)
    $zero = "0";
if ($id_ma >= 10000 and $id_ma < 100000)
    $zero = "";



if ($registros1->num_rows() > 0)
    $sol = $registros1->row();

$this->pdf->Ln(0);
$this->pdf->SetFont('Arial', 'B', 12);
$this->pdf->Cell(180, 5, 'Movimiento Inventario', '', 0, 'C', '0');
$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', 'B', 12);
$tipo_mov = $sol->tipo_movimiento;
//$this->pdf->Cell(30, 5, 'Tipo:', 'LB', 0, 'L', '0') 
$this->pdf->Cell(180, 5, $tipo_mov, '', 0, 'C', '0');



if ($registros2->num_rows() > 0)
    $consulta = $registros2->row();
$this->pdf->Ln(1);
$this->pdf->Cell(150, 5);
$this->pdf->Cell(40, 5, 'Nro ' . $zero . $id_ma, '1', 0, 'C', '0');


date_default_timezone_set("Etc/GMT+4");
$this->pdf->Ln(7);
$this->pdf->SetFont('Arial', '', 10);
$this->pdf->Cell(190, 4, date_format(new DateTime('now'), 'd/m/Y, H:i'), '', 0, 'R', '0');

$this->pdf->Ln(8);
$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->Cell(30, 5, 'Entregado por : ', 'TL', 0, 'L', '0');
$this->pdf->SetFont('Times', '', 12);
$nombre = $consulta->ap_paterno . " " . $consulta->ap_materno . " " . $consulta->nombre;
$this->pdf->Cell(65, 5, $nombre, 'T', 0, 'L', '0');

$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->Cell(30, 5, 'Asignado a :', 'T', 0, 'L', '0');
//$this->pdf->Ln(0);
$this->pdf->SetFont('Times', '', 12);
$nombre = $sol->ap_paterno . " " . $sol->ap_materno . " " . $sol->nombre;
$this->pdf->Cell(65, 5, $nombre, 'TR', 0, 'L', '0');

$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->Cell(30, 5, 'Almacen:', 'L', 0, 'L', '0');
$this->pdf->SetFont('Times', '', 12);
$nombre = $consulta->nombre_almacen;
$this->pdf->Cell(65, 5, $nombre, '', 0, 'L', '0');

//$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->Cell(30, 5, 'Proyecto:', '', 0, 'L', '0');
$this->pdf->SetFont('Arial', '', 10);
$nombre_proy = $sol->nombre_proy;
$this->pdf->Cell(65, 5, $nombre_proy, 'R', 0, 'L', '0');


$this->pdf->Ln(5);
//$this->pdf->Cell(150, 5);
$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->Cell(30, 5, 'Fecha Registro:', 'LB', 0, 'L', '0');
$fecha = date("d/M/y , h:i", strtotime($sol->fh_registro));
$this->pdf->Cell(160, 5, $fecha, 'BR', 0, 'L', '0');

$this->pdf->Ln(6);
$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->SetLineWidth(.2);
$this->pdf->SetFillColor(0, 0, 0);
$this->pdf->SetTextColor(255, 255, 255);


$this->pdf->Ln(0);
$this->pdf->SetWidths(array(10, 60, 40, 18, 62));
$this->pdf->SetAligns(array('C', 'J', 'J', 'C', 'J'));

$titulos = array('Nro', utf8_decode('Descripción'), 'Comentario', 'Cantidad', 'SN / Codigo Propio');
$this->pdf->RowTitle($titulos, array(200, 200, 200), array(20, 20, 20), array(20, 20, 20));
$user = 0;
$sw = 0;
$c = 0;

if ($registros1->num_rows() > 0) {
    $i_tot = 0;
    foreach ($registros1->result() as $fila) {

        $this->pdf->Ln(0);
        $this->pdf->Cell(190, 8, "", 'T', 0, 'J', '0');
        $this->pdf->Ln(0);
        //  $this->pdf->RowTitle($titulos, array(200, 200, 200), array(20, 20, 20), array(20, 20, 20));
        $this->pdf->SetFont('Arial', '', 8);
        $c++;
        if ("SN:" . $fila->SN . " CP:" . $fila->cod_prop_sts_equipo != "SN: CP:")
            $a = "SN:" . $fila->SN . "CP:" . $fila->cod_prop_sts_equipo;
        else
            $a = "no contiene el dato";
        $dato = array(
            $c,
            $fila->cod_serv_prod . " / " . $fila->nombre_titulo . " - " . $fila->descripcion,
            $fila->observaciones,
            $fila->cantidad,
            $a
        );
        $this->pdf->RowBody($dato);
    }

    $this->pdf->Cell(190, 2, "", 'T', 0, 'J', '0');
    // $sol->comentario;
    $this->pdf->Ln(0);
    $this->pdf->SetFont('Arial', '', 10);
    $comentario = $sol->comentario;
    $this->pdf->Cell(190, 8, $comentario, 'LTR', 0, 'L', '0');
    
    $this->pdf->Ln(5);
    $this->pdf->Cell(190, 8,' ', 'LR', 0, 'L', '0');
    $this->pdf->Ln(5);
    $this->pdf->Cell(190, 8,' ', 'LR', 0, 'L', '0');
    $this->pdf->Ln(5);
    $this->pdf->Cell(190, 8,' ', 'LR', 0, 'L', '0');
    $this->pdf->Ln(5);
    $this->pdf->Cell(190, 8,' ', 'LR', 0, 'L', '0');
    $this->pdf->Ln(5);
    //$fecha = date("d/M/y , h:i", strtotime($sol->fh_registro));
   // $this->pdf->Cell(160, 5, $fecha, 'BR', 0, 'L', '0');
    $this->pdf->SetFont('Arial', 'B', 9);
    $this->pdf->Cell(70, 8, 'ELABORADO POR', 'LB', 0, 'L', '0');
    
    //$this->pdf->Ln(5);
   // $fecha = date("d/M/y , h:i", strtotime($sol->fh_registro));
   // $this->pdf->Cell(160, 5, $fecha, 'BR', 0, 'L', '0');
    $this->pdf->SetFont('Arial', 'B', 9);
    $this->pdf->Cell(70, 8, 'ENTREGADO POR', 'B', 0, 'L', '0');
    
    //$this->pdf->Ln(5);
    //$fecha = date("d/M/y , h:i", strtotime($sol->fh_registro));
    //$this->pdf->Cell(160, 5, $fecha, 'BR', 0, 'L', '0');
    $this->pdf->SetFont('Arial', 'B', 9);
    $this->pdf->Cell(50, 8, 'RECIBIDO POR', 'BR', 0, 'L', '0');
} else {
    $this->pdf->Ln(4);
    $this->pdf->Cell(190, 4, ' no se han encontrado registros para reportar ', '', 0, 'J', '0');
    $this->pdf->Ln(4);
}


$this->pdf->AliasNbPages();

$this->pdf->Output('OPssss', 'I');
?>
