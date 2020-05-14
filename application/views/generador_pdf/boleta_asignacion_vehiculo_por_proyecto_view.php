<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of boleta_asignacion_vehiculo_por_proyecto_view  
 *
 * @author POMA RIVERO
 */
?>
<?php

include_once APPPATH . 'helps/fpdf/fpdf.php';
//  echo 'ingresa a la funcion de generar pdf';


$this->pdf = new PDF('L'); //por defecto A4
$titulos = array('Item', 'Depto', 'Subcentro', 'Placa', 'Modelo', 'Marca', 'Tipo','Color', 'Contrato','Estado' ,'Comentarios');
date_default_timezone_set("Etc/GMT+4");
$ahora = date("d/m/Y") . " , " . date("G:i:s");
if ($proyecto->num_rows() > 0) {
    foreach ($proyecto->result() as $reg) {
        $res_proyecto = $asignados_proyecto[$reg->id_proy];
        if ($res_proyecto->num_rows() > 0) {
            
            
            $this->pdf->AddPage('L');
            $this->pdf->Header_logo_izq_sup($ahora);
            $this->pdf->SetFont('Arial', '', 9);
            
            $this->pdf->Cell(275, 10, "Generado en el Sistema de Gestion OnLine en fecha ".$ahora , '0', 0, 'R');

            $this->pdf->Ln(10);
            $this->pdf->SetWidths(array(12, 25, 30, 18, 18, 28, 20, 18, 20, 17, 70));
            $this->pdf->SetAligns(array('C', 'J', 'J', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'J'));
            
            $this->pdf->SetTextColor(0, 0, 0);
            $this->pdf->SetFont('Arial', 'B', 14);
            $nom_proy = $reg->nombre;
            $this->pdf->Cell(275, 10, 'PROYECTO ' . $nom_proy, '0', 0, 'C', '0');
            $this->pdf->Ln(10);
            $this->pdf->SetFont('Arial', 'B', 12);
            $this->pdf->RowTitle($titulos, array(200, 200, 200), array(0, 0, 0), array(0, 0, 0));
            $i = 1;


            $this->pdf->SetFont('Arial', '', 10);
            foreach ($res_proyecto->result() as $reg2) {
                $estado='malo';
                 if( $reg2->suma_estado>3)
                 {
                     $estado='Regular';
                 }
                 if( $reg2->suma_estado>6)
                 {
                     $estado='Bueno';
                 }
                $datos = array(
                    $i,
                    $reg2->nom_ciudad,
                    $reg2->subcentro,
                    $reg2->placa,
                    $reg2->modelo.' '.$reg2->anio,
                    $reg2->marca,
                    $reg2->tipo,
                    $reg2->color,
                    $reg2->contrato,
                    $estado,
                    $reg2->observaciones
                );
                $i++;
                $this->pdf->RowBody($datos);
            } 
        }
    }
}
/*
  if ($asignados->num_rows() > 0) {
  $i_tot = 0;
  foreach ($asignados->result() as $fila) {

  $this->pdf->Ln(0);
  $this->pdf->Cell(190, 8, "", 'T', 0, 'J', '0');
  $this->pdf->Ln(0);
  //  $this->pdf->RowTitle($titulos, array(200, 200, 200), array(20, 20, 20), array(20, 20, 20));
  $this->pdf->SetFont('Arial', '', 8);
  $c++;
  /*if ("SN:" . $fila->SN . " CP:" . $fila->cod_prop_sts_equipo != "SN: CP:")
  $a = "SN:" . $fila->SN . "CP:" . $fila->cod_prop_sts_equipo;
  else
  $a = "no contiene el dato";
  $dato = array(
  //$c,
  $fila->placa,
  $fila->observaciones,
  $fila->cantidad,
  //$a
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
 */

$this->pdf->AliasNbPages();

$this->pdf->Output('OPssss', 'I');
?>
