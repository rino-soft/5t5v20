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

    $this->pdf->SetFont('Times', 'B', 15);

    if ($id_jus < 10)
        ;$zero = "0000";
    if ($id_jus >= 10 and $id_jus < 100)
        $zero = "000";
    if ($id_jus >= 100 and $id_jus < 1000)
        $zero = "00";
    if ($id_jus >= 1000 and $id_jus < 10000)
        $zero = "0";
    if ($id_jus >= 10000 and $id_jus < 100000)
        $zero = "";
    $this->pdf->Cell(150, 5);
    $this->pdf->Cell(40, 5, 'Nro ' . $zero . $id_jus, '', 0, 'C', '0');

    $this->pdf->Ln(3);

    $this->pdf->SetFont('Arial', 'B', 15);
    $this->pdf->Cell(190, 5, 'SOLICITUD DE PERMISO / VACACIONES ', '', 0, 'C', '0');



    $this->pdf->Ln(3);
    $this->pdf->SetFont('Arial', 'B', 12);
    $this->pdf->Cell(150, 5);
    $this->pdf->Cell(40, 5, 'F-SGR-03 ', 'TRBL', 0, 'C', '0');

    $this->pdf->Ln(1);
    $this->pdf->SetFont('Arial', 'B', 2);
    $ssts = "LIVIALTDASTSBO";
    for ($i = 0; $i <= 3; $i++) {
        $ssts.=$ssts;
    }
    $this->pdf->Cell(190, 4, $ssts . "LIVIALTDA", '', 0, 'C', '0');

    $this->pdf->Ln(10);
// fin de cabecera
//obtencion de datos 
//
//

    if ($rs_datos->num_rows() > 0)
        $sol = $rs_datos->row();
//$mes=  array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","AGO","SEP","OCT","NOV","DIC");
//set_locale(LC_ALL,"es_ES@euro","es_ES","esp");
    $fecha = date("d/M/y , h:i", strtotime($sol->fecha_elaborado));
    $dir_solic = "";
    $dir_acep_rec = "";
    if ($rs_historial_datos->num_rows() > 0) {
        foreach ($rs_historial_datos->result() as $reg) {
            if ($reg->estado == "Enviado") {
                $datos1 = explode('?', $reg->codigoQR, 2);
            }
            if ($reg->estado == "Aceptado") {
                $datos2 = explode('?', $reg->codigoQR, 2);
            }
        }
    }

//
//
//fin obtencion de datos  str_replace("-", "_", $datos1[0])
//$this->pdf->Image(base_url() . 'imagenesweb/icono/tijeras.png',5,125,3,'png');

    $this->pdf->Image(base_url() . 'imagenesweb/firmas_QR/' . $datos1[0] . '.png', 10, 64, 25, 'png');
    $this->pdf->Image(base_url() . 'imagenesweb/firmas_QR/' . $datos2[0] . '.png', 10, 90, 25, 'png');


    $this->pdf->SetFont('Arial', 'B', 12);
    $this->pdf->Cell(65, 4, $sol->ap_paterno . ',' . $sol->nombre, '', 0, 'C', '0');
    $this->pdf->Cell(2, 4);

    $this->pdf->Cell(38, 4, $sol->ci . ' ' . $sol->exp, '', 0, 'C', '0');
    $this->pdf->Cell(2, 4);
    $this->pdf->Cell(48, 4, $fecha, '0', 0, 'C', '0');
    $this->pdf->Cell(2, 4);
    $this->pdf->Cell(33, 4, "calcular_total_dias", '0', 0, 'C', '0');
    $this->pdf->Ln(4);
    $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->SetFillColor(230, 230, 230);
    $this->pdf->Cell(65, 4, "Apellidos y Nombres de Solicitante", 'T', 0, 'C', '1');
    $this->pdf->Cell(2, 4, "", '', 0, 'C', '1');
    $this->pdf->Cell(38, 4, "Cedula de Identidad", 'T', 0, 'C', '1');
    $this->pdf->Cell(2, 4, "", '', 0, 'C', '1');
    $this->pdf->Cell(48, 4, "Fecha solicitud", 'T', 0, 'C', '1');
    $this->pdf->Cell(2, 4, "", '', 0, 'C', '1');
    $this->pdf->Cell(33, 4, "Total Dias Permiso", 'T', 0, 'C', '1');

    $this->pdf->Ln(6);

    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(105, 4, $sol->tipo . '.- ' . $sol->titulo_jp, '', 0, 'L', '1');
    $this->pdf->Ln(4);
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->MultiCell(105, 4, utf8_decode($sol->comentario_jp), 'B', 'J');
    $this->pdf->SetXY(117, 37);
    $this->pdf->Cell(30, 4, 'Comienza : ', '', 0, 'L', '1');
    $this->pdf->Cell(50, 4, date("d/M/y , H:i", strtotime($sol->fecha_inicio)), '', 0, 'L', '0');
    $this->pdf->Ln(4);
    $this->pdf->Cell(107, 4);
    $this->pdf->Cell(30, 4, 'Termina : ', '', 0, 'L', '1');
    $this->pdf->Cell(50, 4, date("d/M/y , H:i", strtotime($sol->fecha_fin)), '', 0, 'L', '0');
    $this->pdf->SetXY(10, 65);

    $this->pdf->Cell(26, 4);
    $this->pdf->SetFont('Arial', 'B', 12);
    $this->pdf->Cell(165, 4, $datos1[0], '', 0, 'L', '1');


    $this->pdf->Ln(5);
    $this->pdf->Cell(26, 4);
    $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->MultiCell(120, 3, $datos1[1], '', 'J');

    $this->pdf->SetXY(125, 80);
    $this->pdf->Cell(26, 4);
    $this->pdf->SetFont('Arial', '', 6);
    $this->pdf->Cell(45, 3, "Firma de " . $sol->nombre . " " . $sol->ap_paterno, 'T', 0, 'C', '0');
    $this->pdf->Ln(10);
    $this->pdf->SetFont('Arial', 'B', 12);
    $this->pdf->Cell(25, 4);
    $this->pdf->Cell(165, 4, $datos2[0], '', 0, 'L', '1');
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', '', 8);
    $this->pdf->Cell(26, 4);
    $this->pdf->MultiCell(165, 3, $datos2[1], '', 'J');



    $this->pdf->SetXY(10, 120);
    $this->pdf->SetFont('Arial', '', 6);

    setlocale(LC_ALL, 'Spanish');
    $ahora = ""; //strftime("%A %d de %B del %Y");
    date_default_timezone_set("Etc/GMT+4");
    $ahora = date("d/m/Y") . " , " . date("G:i:s");


    $this->pdf->Cell(0, 1, "Generado en el Sistema de RRHH v.1.0 en fecha " . $ahora . " ,impresion nro : X por el usuario :" , '0', 0, 'L');
    $this->pdf->Ln(3);
//$this->pdf->Image(base_url() . 'imagenesweb/firmas_QR/1_35_632_2014-06-17_231212.png', 5, 105, 30, 'png');
    $lineadeCorte = "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ";
    $this->pdf->Cell(0, 1, $lineadeCorte . $lineadeCorte, '0', 0, 'L');
    $this->pdf->Image(base_url() . 'imagenesweb/recursos/logo1.png', 140, 80, 60, 'png'); // 5, 5, 30, 'jpg'

    $this->pdf->AliasNbPages();

    $this->pdf->Output('OPssss', 'I');
    ?>
