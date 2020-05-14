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
$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->Cell(190, 5, 'MOVIMIENTO INVENTARIO', '', 0, 'C', '0');
$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', 'B', 16);
$tipo_mov = $sol->tipo_movimiento;
//$this->pdf->Cell(30, 5, 'Tipo:', 'LB', 0, 'L', '0') 
$this->pdf->Cell(190, 5, $tipo_mov, '', 0, 'C', '0');



if ($registros2->num_rows() > 0)
    $consulta = $registros2->row();
$this->pdf->Ln(1);
$this->pdf->SetFont('Times', 'B', 12);
$this->pdf->Cell(150, 5);
$this->pdf->Cell(40, 5, 'Nro ' . $zero . $id_ma, '1', 0, 'C', '0');


date_default_timezone_set("Etc/GMT+4");
$this->pdf->Ln(5);
$this->pdf->SetFont('Times', '', 8);
//$this->pdf->Cell(100, 5, 'Fecha de impresion', '', 0, 'R', '0');
$this->pdf->Cell(190, 4, 'Fecha de impresion: '.date_format(new DateTime('now'), 'd/m/Y, H:i'), '', 0, 'C', '0');

if($sol->tipo_movimiento=='Ingreso')
{
    $this->pdf->Ln(8);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(30, 5, 'Ingresado por : ', 'TL', 0, 'L', '0');
    $this->pdf->SetFont('Arial', '', 9);
    $nombre = utf8_decode($consulta->ap_paterno . " " . $consulta->ap_materno . " " . $consulta->nombre);
    $this->pdf->Cell(75, 5, $nombre, 'T', 0, 'L', '0');
}else{
    $this->pdf->Ln(8);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(30, 5, 'Entregado por : ', 'TL', 0, 'L', '0');
    $this->pdf->SetFont('Arial', '', 9);
    $nombre = utf8_decode($consulta->ap_paterno . " " . $consulta->ap_materno . " " . $consulta->nombre);
    $this->pdf->Cell(75, 5, $nombre, 'T', 0, 'L', '0');
}



$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->Cell(20, 5, 'Almacen:', 'T', 0, 'L', '0');
$this->pdf->SetFont('Arial', '', 10);
$nombre = $consulta->nombre_almacen;
$this->pdf->Cell(65, 5, $nombre, 'TR', 0, 'L', '0');

 if($sol->cod_user!='')
 { 
     $this->pdf->Ln(5);
     $this->pdf->SetFont('Arial', 'B', 10);
     $this->pdf->Cell(30, 5, 'Asignado a :', 'L', 0, 'L', '0');
//$this->pdf->Ln(0);
     $this->pdf->SetFont('Arial', '', 9);
     $nombre = utf8_decode($sol->ap_paterno . " " . $sol->ap_materno . " " . $sol->nombre);
     $this->pdf->Cell(160, 5, $nombre, 'R', 0, 'L', '0');
  }
    





$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->Cell(30, 5, 'Proyecto:', 'LB', 0, 'L', '0');
$this->pdf->SetFont('Arial', '', 10);
$nombre_proy = $sol->nombre_proy;
$this->pdf->Cell(75, 5, $nombre_proy, 'B', 0, 'L', '0');



//$this->pdf->Cell(150, 5);
$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->Cell(30, 5, 'Fecha Registro:', 'B', 0, 'L', '0');
$this->pdf->SetFont('Arial', '', 10);
$fecha = date("d/M/y , h:i", strtotime($sol->fecha_registro_mov));
$this->pdf->Cell(55, 5, $fecha, 'BR', 0, 'L', '0');

$this->pdf->Ln(6);
$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->SetLineWidth(.2);
$this->pdf->SetFillColor(0, 0, 0);
$this->pdf->SetTextColor(255, 255, 255);


$this->pdf->Ln(0);
$this->pdf->SetWidths(array(10, 60, 40, 18, 62));
$this->pdf->SetAligns(array('C', 'J', 'J', 'C', 'J'));

$titulos = array('Nro', utf8_decode('Descripción'), utf8_decode('Observaciones'), 'Cantidad', utf8_decode('SN / Codigo Propio'));
$this->pdf->RowTitle($titulos, array(200, 200, 200), array(20, 20, 20), array(20, 20, 20));
$user = 0;
$sw = 0;
$c = 0;

if ($registros1->num_rows() > 0) {
    $i_tot = 0;
    foreach ($registros1->result() as $fila) 
    {
        $this->pdf->Cell(190, 8, "", 'T', 0, 'J', '0');
        $this->pdf->Ln(0);
        //  $this->pdf->RowTitle($titulos, array(200, 200, 200), array(20, 20, 20), array(20, 20, 20));
        $this->pdf->SetFont('Arial', '', 8);
        $c++;
        if ("  SN:" . $fila->SN . " CP:" . $fila->cod_prop_sts_equipo != "  SN: CP:")
            $a = "  SN:" . $fila->SN . "  CP:" . $fila->cod_prop_sts_equipo;
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

    if($sol->comentario!='')
    { 
        $this->pdf->MultiCell(190, 2, "", 'T', 'L', '0');
        // $sol->comentario;
        $this->pdf->Ln(0);
        $this->pdf->SetFont('Arial', '', 9);
        $comentario = $sol->comentario;
        
        $this->pdf->MultiCell(190, 6, 'Comentario:'.utf8_decode(trim($comentario)), 'LTRB', 'J',0); 
    } 
    /*
     * 
     $this->pdf->MultiCell(180, 5, utf8_decode('Este documento solo es valido para respaldo personal, imprima en caso de ser necesario') , '0', 'C', '0');

    $this->pdf->Cell(190, 2, "", 'T', 0, 'J', '0');
    // $sol->comentario;
    $this->pdf->Ln(0);
    $this->pdf->SetFont('Arial', '', 10);
    $comentario = $sol->comentario;
    $this->pdf->Cell(190, 8, utf8_decode($comentario), 'LTRB', 0, 'L', '0');
   */
    
    $this->pdf->Ln(10);
   
    //$fecha = date("d/M/y , h:i", strtotime($sol->fh_registro));
   // $this->pdf->Cell(160, 5, $fecha, 'BR', 0, 'L', '0');
    
    if($sol->tipo_movimiento=='Salida'){
         $this->pdf->SetFont('Arial', 'B', 9);
         $this->pdf->Cell(70, 8, 'ELABORADO POR', '', 0, 'C', '0');

            //$this->pdf->Ln(5);
           // $fecha = date("d/M/y , h:i", strtotime($sol->fh_registro));
           // $this->pdf->Cell(160, 5, $fecha, 'BR', 0, 'L', '0');
         $this->pdf->SetFont('Arial', 'B', 9);
         $this->pdf->Cell(70, 8, 'ENTREGADO POR', '', 0, 'C', '0');

            //$this->pdf->Ln(5);
            //$fecha = date("d/M/y , h:i", strtotime($sol->fh_registro));
            //$this->pdf->Cell(160, 5, $fecha, 'BR', 0, 'L', '0');
          $this->pdf->SetFont('Arial', 'B', 9);
          $this->pdf->Cell(50, 8, 'RECIBIDO POR', '', 0, 'C', '0');
    }else{
         $this->pdf->SetFont('Arial', 'B', 9);
            $this->pdf->Cell(70, 8, 'ENTREGADO POR', '', 0, 'C', '0');

            //$this->pdf->Ln(5);
           // $fecha = date("d/M/y , h:i", strtotime($sol->fh_registro));
           // $this->pdf->Cell(160, 5, $fecha, 'BR', 0, 'L', '0');
        // $this->pdf->SetFont('Arial', 'B', 9);
        // $this->pdf->Cell(70, 8, 'ENTREGADO POR', '', 0, 'C', '0');

            //$this->pdf->Ln(5);
            //$fecha = date("d/M/y , h:i", strtotime($sol->fh_registro));
            //$this->pdf->Cell(160, 5, $fecha, 'BR', 0, 'L', '0');
          $this->pdf->SetFont('Arial', 'B', 9);
          $this->pdf->Cell(170, 8, 'RECIBIDO POR', '', 0, 'C', '0');
    }
      $this->pdf->Ln(10);
      $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->Cell(190, 4, 'NOTA.- Las Notas deben ser firmadas y devueltas al almacen de procedencia, guarde una copia para su respaldo , Gracias...', '', 0, 'J', '0');
   
    
    
    
    
} else {
    $this->pdf->Ln(4);
    $this->pdf->Cell(190, 4, ' no se han encontrado registros para reportar ', '', 0, 'J', '0');
    $this->pdf->Ln(4);
}


$this->pdf->AliasNbPages();

$this->pdf->Output('OPssss', 'I');
?>
