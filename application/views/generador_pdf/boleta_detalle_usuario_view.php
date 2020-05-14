<?php
//echo 'INGRESA AL PDF';
include_once APPPATH . 'helps/fpdf/fpdf.php';
$this->pdf = new PDF(); //por defecto A4
//echo 'se ha generado el pdf';

$this->pdf->SetTitle("INFORMACION PERSONAL", false);
$this->pdf->AddPage();
$this->pdf->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 10, 10, 90, 'jpg');

//echo 'fotografia_actual'.$d_usuario->fotografia_actual;

if ($d_usuario->fotografia_actual != ""){
    $fot= explode("/",$d_usuario->fotografia_actual ); 
    $this->pdf->Image(base_url().$fot[1]."/".$fot[2]."/".$fot[3], 120, 30, 60, 'jpg');
    }
else
{
    $this->pdf->Image(base_url() . 'imagenesweb/recursos/perfil.jpg', 120, 30, 60,70, 'jpg');
} 
$this->pdf->SetFont('Times', 'B', 12);
date_default_timezone_set("Etc/GMT+4");
$this->pdf->Ln(0);
$this->pdf->SetFont('Arial', '', 10);
$this->pdf->Cell(190, 4, date_format(new DateTime('now'), 'd/m/Y, H:i'), '', 0, 'R', '0');

$this->pdf->Ln(60);
$this->pdf->SetFont('Arial', '', 20);
$this->pdf->Cell(15, 5,utf8_decode( $d_usuario->nombre), '', 0, 'L', '0');
$this->pdf->Ln(7);
$this->pdf->SetFont('Arial', '', 20);
$this->pdf->Cell(30,7, utf8_decode($d_usuario->ap_paterno . " " . $d_usuario->ap_materno), '', 0, '', '0');
//(largo, alto , valor, , , , ,)


$this->pdf->Ln(10);
$this->pdf->SetFont('Arial', 'B', 12);
$this->pdf->Cell(60, 7, 'CI: ', '', 0, 'L', '0');
$this->pdf->SetFont('Arial', '', 12);
if($d_usuario->ci!="")
{
$this->pdf->Cell(25, 7, $d_usuario->ci, '', 0, 'L', '0');
}
if($d_usuario->exp!=""&&$d_usuario->exp!='0')
{
$this->pdf->Cell(20, 7,$d_usuario->exp, '', 0, 'L', '0');
}

    
$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', 'B', 12);
$this->pdf->Cell(60, 7, 'FECHA DE NACIMIENTO:', '', 0, 'L', '0');
$this->pdf->SetFont('Arial', '', 12);
$this->pdf->Cell(65, 7, $d_usuario->fecha_nacimiento, '', 0, '', '0');

$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', 'B', 12);
$this->pdf->Cell(60, 7, 'NACIONALIDAD:', '', 0, 'L', '0');
$this->pdf->SetFont('Arial', '', 12);
$this->pdf->Cell(65, 7, $d_usuario->nacionalidad, '', 0, 'L', '0');

$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', 'B', 12);
$this->pdf->Cell(60, 7, 'ESTADO CIVIL:', '', 0, 'L', '0');
$this->pdf->SetFont('Arial', '', 12);
$this->pdf->Cell(65, 7, $d_usuario->estado_civil, '', 0, 'L', '0');

$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', 'B', 12);
$this->pdf->Cell(60, 7, 'PROFESION/OCUPACION:', '', 0, 'L', '0');
$this->pdf->SetFont('Arial', '', 12);
$this->pdf->Cell(65, 7, utf8_decode($d_usuario->cargo_actual), '', 0, 'L', '0');

$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', 'B', 12);
$this->pdf->Cell(60, 7, 'TELEFONOS', '', 0, 'L', '0');
$this->pdf->SetFont('Arial', '', 12);
if ($d_usuario->telefonos != ""){
    $telf= explode(";",$d_usuario->telefonos ); 
    $this->pdf->Cell(38, 7, ucfirst($telf[0]), '', 0, 'L', '0');
    $this->pdf->Ln(5);
     $this->pdf->Cell(60, 7, '', '', 0, 'L', '0');
    $this->pdf->Cell(35, 7,ucfirst($telf[1]), '', 0, 'L', '0');
    }
$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', 'B', 12);
$this->pdf->Cell(60, 7, 'CATEGORIA DE LICENCIA:', '', 0, 'L', '0');
$this->pdf->SetFont('Arial', '', 12);
if($d_usuario->cat_licencia_conducir!=0)
{
$this->pdf->Cell(65, 7, $d_usuario->cat_licencia_conducir, '', 0, 'L', '0');
}
$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', 'B', 12);
$this->pdf->Cell(60, 7, 'CORREO PERSONAL:', '', 0, 'L', '0');
$this->pdf->SetFont('Arial', '', 12);
$this->pdf->Cell(65, 7, $d_usuario->correo_per, '', 0, 'L', '0');

$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', 'B', 12);
$this->pdf->Cell(60, 7, 'CORREO CORPORATIVO:', '', 0, 'L', '0');
$this->pdf->SetFont('Arial', '', 12);
$this->pdf->Cell(65, 7, $d_usuario->correo_corp, '', 0, 'L', '0');

$this->pdf->Ln(7);
$this->pdf->SetFont('Arial', 'B', 12);
$this->pdf->Cell(60, 7, 'PERSONAS DEPENDIENTES:', '', 0, 'L', '0');
$this->pdf->SetFont('Arial', '', 12);
if ($d_usuario->dependientes != ""){
    $dep= explode("|",$d_usuario->dependientes ); 
    for($i=0;$i<count($dep);$i++)
    {
    $this->pdf->Ln(4);
    $this->pdf->Cell(60, 7, "", '', 0, 'L', '0');
    $this->pdf->Cell(65, 7, ucwords($dep[$i]), '', 0, 'L', '0');
}
}
///////////////////////////////////////////////////////////////////////////////////////

$this->pdf->AddPage();
//TR ARRIBA Y DERECHA
//B abajo

$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', 'B', 12);
$this->pdf->Cell(180, 5, '-CURRICULUM VITAE-', '', 0, 'C', '0');
$this->pdf->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 10, 5, 30, 'jpg');

if ($d_usuario->fotografia_actual != ""){
    $fot= explode("/",$d_usuario->fotografia_actual ); 
    $this->pdf->Image(base_url().$fot[1]."/".$fot[2]."/".$fot[3], 130, 35, 40, 'jpg');
    }
$this->pdf->Ln(10);
$this->pdf->SetFont('Arial', '', 12);
$this->pdf->Cell(190, 5, 'DATOS PERSONALES', 'B', 0, 'L', '0');
    
$this->pdf->Ln(7);
$this->pdf->SetFont('Arial', '', 12);
$this->pdf->Cell(50, 5, 'Apellidos', '', 0, 'L', '0');
$this->pdf->Cell(50, 5, $d_usuario->ap_paterno . " " . $d_usuario->ap_materno , '', 0, 'L', '0');
$this->pdf->Ln(5);
$this->pdf->SetFont('Arial', '', 12);
$this->pdf->Cell(50,5, 'Nombre', '', 0, '', '0');
$this->pdf->Cell(50,5,  utf8_decode($d_usuario->nombre), '', 0, '', '0');
//(largo, alto , valor, , , , ,)


$this->pdf->Ln(7);
$this->pdf->SetFont('Arial', '', 12);
$this->pdf->Cell(50, 7, 'Fecha de Nacimiento: ', '', 0, 'L', '0');
$this->pdf->SetFont('Times', '', 12);
$this->pdf->Cell(65, 7, $d_usuario->fecha_nacimiento, '', 0, 'L', '0');

$this->pdf->Ln(7);
$this->pdf->SetFont('Arial', '', 12);
$this->pdf->Cell(50, 7, 'Nacionalidad:', '', 0, 'L', '0');
$this->pdf->Cell(65, 7, $d_usuario->nacionalidad, '', 0, 'L', '0');

$this->pdf->Ln(7);
$this->pdf->SetFont('Arial', '', 12);
$this->pdf->Cell(50, 7, 'Numero', '', 0, 'L', '0');
if ($d_usuario->telefonos != ""){
    $telf= explode(";",$d_usuario->telefonos ); 
    if($telf[1]!=""){
    $this->pdf->Cell(60, 7, ucfirst($telf[1]), '', 0, 'L', '0');
    }
    if($telf[0]!="")
    {
    $this->pdf->Ln(4);
    $this->pdf->Cell(50, 7, '', '', 0, 'L', '0');
    $this->pdf->Cell(60, 7, ucfirst($telf[0]), '', 0, 'L', '0');
    }
    }
$this->pdf->Ln(7);
$this->pdf->SetFont('Arial', '', 12);
$this->pdf->Cell(50, 7, 'E-mail', '', 0, 'L', '0');
$this->pdf->Cell(65, 7, $d_usuario->correo_per, '', 0, 'L', '0');
$this->pdf->Ln(4);
$this->pdf->Cell(50, 7, '', '', 0, 'L', '0');
$this->pdf->Cell(65, 7, $d_usuario->correo_corp, '', 0, 'L', '0');


//ESTUDIOS PERSONALES
$this->pdf->Ln(10);
$this->pdf->SetFont('Arial', 'B', 14);
$this->pdf->SetTextColor(180,180, 180);
$this->pdf->Cell(190, 7, 'FORMACION ACADEMICA', 'B', 0, 'R', '0');
$this->pdf->Ln(10);
$this->pdf->SetFont('Arial', '', 10);
//$this->pdf->SetLineWidth(.2);
$this->pdf->SetFillColor(0, 0, 0);
$this->pdf->SetTextColor(100,100, 100);


$this->pdf->Ln(0);
$this->pdf->SetWidths(array(50,139));
$this->pdf->SetAligns(array('J','J'));

$titulos = array();
$this->pdf->RowTitle($titulos, array(200, 200, 200), array(20, 20, 20), array(20, 20, 20));



if ($est_usuario->num_rows() > 0) {
   
    foreach ($est_usuario->result() as $fila) {
        
     //   echo 'Esto es una prueba2';
        $this->pdf->SetFont('Arial', '', 12);
        
        $dato = array(
        strtoupper($fila->nivel_formacion),
        utf8_decode($fila->institucion." \n\n".$fila->carrera." \n\n".$fila->Mension." \n\n".$fila->descripcion_estudio));
        
        $this->pdf->RowBody($dato);
    }
}
//EXPERIENCIA LABORAL
$this->pdf->Ln(10);
$this->pdf->SetFont('Arial', 'B', 14);
$this->pdf->SetTextColor(180, 180, 180);
$this->pdf->Cell(190, 7, 'EXPERIENCIA PROFESIONAL', 'B', 0, 'R', '0');
$this->pdf->Ln(10);
$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->SetLineWidth(.2);
$this->pdf->SetFillColor(0, 0, 0);
$this->pdf->SetTextColor(100, 100, 100);

$this->pdf->Ln(0);
$this->pdf->SetWidths(array(50, 139));
$this->pdf->SetAligns(array('C', 'J'));

$titulos = array();
$this->pdf->RowTitle($titulos, array(200, 200, 200), array(20, 20, 20), array(20, 20, 20));


if ($exp_usuario->num_rows() > 0) {
    foreach ($exp_usuario->result() as $fila) {
        /*$this->pdf->Ln(0);
        $this->pdf->MultiCell(190, 5,"",0,'R',true);
        $this->pdf->Ln(0);*/
        $this->pdf->SetFont('Arial', '', 12);
        
        $dato = array(
            $fila->fecha_inicio." - ".$fila->fecha_fin,
             utf8_decode($fila->institucion."\n\n Cargo desempeñado \n\n".$fila->actividades),            
        );
        $this->pdf->RowBody($dato);
    }
} 
$this->pdf->AddPage();

if ($d_usuario->ruta_ci_fron != ""){
    $this->pdf->Ln(4);
    $this->pdf->Cell(190, 4, ' CEDULA DE IDENTIDAD', '', 0, 'J', '0');
    $this->pdf->Ln(4);
    $fot= explode("/",$d_usuario->ruta_ci_fron ); 
       $this->pdf->Image(base_url().$fot[1]."/".$fot[2]."/".$fot[3], 50, 20, 100, 'jpg');
    }
if ($d_usuario->ruta_ci_tra != ""){
    $fot= explode("/",$d_usuario->ruta_ci_tra ); 
       $this->pdf->Image(base_url().$fot[1]."/".$fot[2]."/".$fot[3], 50, 90, 100, 'jpg');
    }
if ($d_usuario->adj_licencia != ""){
    $this->pdf->Ln(145);
    $this->pdf->Cell(190, 4, 'LICENCIA DE CONDUCIR ', '', 0, 'J', '0');
    $this->pdf->Ln(4);
    $fot= explode("/",$d_usuario->adj_licencia ); 
       $this->pdf->Image(base_url().$fot[1]."/".$fot[2]."/".$fot[3], 50, 170, 100, 'jpg');
    }
////////////////////////ADJUNTOS DE ESTUDIOS PERSONALES////////////////////////////////
   if ($est_usuario->num_rows() > 0) {
    foreach ($est_usuario->result() as $fila) {
        
        if($fila->documento_adjunto!="")
        { 
            $this->pdf->AddPage();
            $this->pdf->Ln(0);
            $this->pdf->Ln(4);
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->cell(190,4,utf8_decode(strtoupper($fila->nivel_formacion)." ".$fila->descripcion_estudio),'', 0, 'J', '0');
            $this->pdf->Ln(4);
            $fot= substr($fila->documento_adjunto,2 ); 
            $this->pdf->Image(base_url().$fot, 15, 20, 180);
        }
    }
}

///////////////////////ADJUNTOS DE EXPERIENCIA PERSONAL/////////////////////

    if ($exp_usuario->num_rows() > 0) {
      foreach ($exp_usuario->result() as $fila) {
        
        if($fila->documento_adjunto!="")
                   {            
                    $this->pdf->AddPage();
                    $this->pdf->Ln(4);
                    $this->pdf->SetFont('Arial', '', 10);
                    $this->pdf->Cell(190, 4,utf8_decode(strtoupper($fila->institucion)." ".ucfirst($fila->rubro_institucion." ".$fila->cargo)), '', 0, 'J', '0');
                    $this->pdf->Ln(4);
                    $fot= substr($fila->documento_adjunto,2 ); 
                    $this->pdf->Image(base_url().$fot, 15, 20, 180);
        }
  
}
    }


$this->pdf->AliasNbPages();

$this->pdf->Output('CURRICULUM_VITAE_'.$d_usuario->ci, 'I');
?>
