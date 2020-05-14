<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// configuramos las propiedades del documento
$this->phpexcel->getProperties()->setCreator("Ruben Payrumani ,Magali Poma")
        ->setLastModifiedBy("Ruben Payrumani ,Magali Poma")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Lista de personal ")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");


//$this->phpexcel->getActiveSheet()->getHeaderFooter()->setOddHeader("&L&9&\"Arial Narrow\"UNIVESIDAD MAYOR DE SAN ANDRÉS\nFACULTAD DE CIENCIAS ECONÓMICAS Y FINANCIERAS\n&B&11CARRERA DE ECONOMÍA&B&R&G");
$this->phpexcel->getActiveSheet()->getHeaderFooter()->setOddHeader("&L&9&\"Arial Narrow\"Listado de Personal &B&R&G");
$this->phpexcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&IGenerado por SFV_STS V 1.0 el ' . date("d/m/Y") . '&I&RPágina &P de &N');
//imagen en excel
/*
  $this->dra = new PHPExcel_Worksheet_HeaderFooterDrawing();
  $this->dra->setName('sts');//echo "se jodio".base_url().'imagenesweb/recursos/logosts.jpg';
  //$objDrawing->setPath(base_url().'imagenesweb/recursos/logosts.jpg');
  $this->dra->setPath('img/logosts.jpg');
  $this->dra->setHeight(60);

  $this->phpexcel->getActiveSheet()->getHeaderFooter()->addImage($this->dra, PHPExcel_Worksheet_HeaderFooter::IMAGE_HEADER_RIGHT);
 */

$this->phpexcel->getActiveSheet()->mergeCells('A1:M1');
$this->phpexcel->getActiveSheet()->setCellValue('A1', "Listado de Personal");
$this->phpexcel->getActiveSheet()->mergeCells('A2:M2');
//if ($b == "_")
//$b = 'Ninguno';
//$this->phpexcel->getActiveSheet()->setCellValue('A2', 'Periodo: del  al  , Terminos de busqueda: ');
//
$styleArray = array(
    'font' => array('name' => 'Arial', 'size' => 14, 'bold' => true, 'color' => array('rgb' => '002651'),),
    'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
);
$this->phpexcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);

$styleArray = array(
    'font' => array('name' => 'Arial', 'size' => 11, 'bold' => true, 'color' => array('rgb' => '002651')),
    'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
);
$this->phpexcel->getActiveSheet()->getStyle('A2')->applyFromArray($styleArray);

$this->phpexcel->setActiveSheetIndex(0);
$this->phpexcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$this->phpexcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
$this->phpexcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$this->phpexcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$this->phpexcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);






$punt = 3;
$this->phpexcel->setActiveSheetIndex(0)
        
        ->setCellValue('A' . $punt, 'COD')
        ->setCellValue('B' . $punt, 'CEDULA')
        ->setCellValue('C' . $punt, 'PATERNO')
        ->setCellValue('D' . $punt, 'MATERNO')
        ->setCellValue('E' . $punt, 'NOMBRE')
        ->setCellValue('F' . $punt, 'FECHA NACIMIENTO')
        ->setCellValue('G' . $punt, 'EDAD')
        ->setCellValue('H' . $punt, 'FECHA INGRESO')
        ->setCellValue('I' . $punt, 'ANT. AÑOS')
        ->setCellValue('J' . $punt, 'ANT. MESES')
        ->setCellValue('K' . $punt, 'DEPARTAMENTO')
        ->setCellValue('L' . $punt, 'V.CALCULADAS')
        ->setCellValue('M' . $punt, 'V.UTILIZADAS')
        ->setCellValue('N' . $punt, 'V.SALDO')
        ->setCellValue('O' . $punt, 'TELEFONO')
        ->setCellValue('P' . $punt, '');

// $this->phpexcel->getFont()->setBold(false);

$this->phpexcel->getActiveSheet()->getStyle('A' . $punt . ':P' . $punt)->applyFromArray(
        array(
            'font' => array(
                'bold' => true,
                'size' => 9,
                'name' => 'calibri',
                'color' => array('rgb' => 'FFFFFF')
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '363947')
            )
        )
);
$this->phpexcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 4); //para repetir titulos en las hojas

$this->phpexcel->getActiveSheet()->getStyle('A' . $punt . ':P' . $punt)->getAlignment()->setWrapText(true);
//$this->phpexcel->getActiveSheet()->getStyle('H:I')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
//$this->phpexcel->getColumnDimension('A')->setWidth(40);
// La librería puede manejar la codificación de caracteres UTF-8
//$this->phpexcel->setActiveSheetIndex(0)
//        ->setCellValue('A' . $punt, 'No')
//        ->setCellValue('B' . $punt, 'FECHA DE FACTURA')
//        ->setCellValue('C' . $punt, 'NUMERO DE FACTURA')
//        ->setCellValue('M' . $punt, 'COMENTARIO GENERAL');

$punt = 4;

$style_ok = array(
    'font' => array(
        'size' => 9,
        'name' => 'calibri',
        'color' => array('rgb' => '000000')
    ),
    'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_NONE,
    )
);
$style_no = array(
    'font' => array(
        'size' => 9,
        'name' => 'calibri',
        'color' => array('rgb' => '7C0000')
    ),
    'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FFC0C0')
    )
);

$sumador = 0;

//for ($i=0;$i<count($cod_props);$i++) {

foreach ($registros as $fila) {

    //$mov=$vec_mov[$cod_props[$i]];
    //$fila=$mov->row();
    /*
      if ($proy_fac[$reg->id_factura]->num_rows() > 0)
      $p = $proy_fac[$reg->id_factura]->row()->nombre;
      else
      $p = "Sin proyecto";

      if ($cont_fac[$reg->id_factura]->num_rows() > 0)
      $c = $cont_fac[$reg->id_factura]->row()->nro_contrato . " .- " . $cont_fac[$reg->id_factura]->row()->objeto;
      else
      $c = "Sin contrato";
     */
    $date1 = new DateTime();
    $date2 = new DateTime($fila->fecha_nacimiento);
    $diff = $date1->diff($date2);
    $dias = $diff->days;
    $anio_happy = floor($diff->days / 365);
    $date2 = new DateTime($fila->fecha_inicio);
    $diff = $date1->diff($date2);
    $dias = $diff->days;
    $anio = floor($diff->days / 365);
    $meses = floor((($diff->days - ($anio * 365)) / 365) * 12);
    
    $vac=  explode("|", $vacaciones[$fila->cod_user]);
    
    

    $this->phpexcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $punt, '1')
            ->setCellValue('A' . $punt, $fila->cod_user)
            // ->setCellValue('C'.$punt, PHPExcel_Shared_Date::PHPToExcel( $reg->fec_reg ))
            ->setCellValue('B' . $punt, $fila->ci)
            ->setCellValue('C' . $punt, $fila->ap_paterno)
            ->setCellValue('D' . $punt, $fila->ap_materno)
            ->setCellValue('E' . $punt, $fila->nombre)
            ->setCellValue('F' . $punt, substr(str_replace("-", "/", $fila->fecha_nacimiento), 0, 10))
            ->setCellValue('G' . $punt, $anio_happy)
            ->setCellValue('H' . $punt, substr(str_replace("-", "/", $fila->fecha_inicio), 0, 10))
            ->setCellValue('I' . $punt, $anio)
            ->setCellValue('J' . $punt, $meses)
            ->setCellValue('K' . $punt, $fila->departamento)
            ->setCellValue('L' . $punt,$vac[2])
            ->setCellValue('M' . $punt, $vac[0])
            ->setCellValue('N' . $punt, $vac[1])
            ->setCellValue('O' . $punt, "****")
            ->setCellValue('P' . $punt, "*****")
            ->setCellValue('Q' . $punt, "******");
    // $this->phpexcel->getActiveSheet()->getStyle('C'.$punt)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);

    /* $this->phpexcel->getActiveSheet()->getCell('M' . $punt)->getCalculatedValue();
      $this->phpexcel->getActiveSheet()->getCell('O' . $punt)->getCalculatedValue();
      $this->phpexcel->getActiveSheet()->getCell('P' . $punt)->getCalculatedValue();
     */
    //  $this->phpexcel->getActiveSheet()->getStyle('A' . $punt . ':M' . $punt)->applyFromArray($style_ok);
    /* if ($reg->est_factura != 'Valido') {
      $this->phpexcel->getActiveSheet()->getStyle('A' . $punt . ':M' . $punt)->applyFromArray($style_no);
      $this->phpexcel->setActiveSheetIndex(0)
      ->setCellValue('H' . $punt, '0')
      ->setCellValue('I' . $punt, '=H' . $punt . '*0.13')
      ->setCellValue('J' . $punt, '');
      } */
    $this->phpexcel->getActiveSheet()->getStyle('A' . $punt . ':P' . $punt)->getAlignment()->setWrapText(true);
    $punt++;
}
// Renombramos la hoja de trabajo
$this->phpexcel->getActiveSheet()->getColumnDimension('a')->setWidth(7);
$this->phpexcel->getActiveSheet()->getColumnDimension('b')->setWidth(10);
$this->phpexcel->getActiveSheet()->getColumnDimension('c')->setWidth(20);
$this->phpexcel->getActiveSheet()->getColumnDimension('d')->setWidth(20);
$this->phpexcel->getActiveSheet()->getColumnDimension('e')->setWidth(25);
$this->phpexcel->getActiveSheet()->getColumnDimension('f')->setWidth(13);
$this->phpexcel->getActiveSheet()->getColumnDimension('g')->setWidth(7);
$this->phpexcel->getActiveSheet()->getColumnDimension('h')->setWidth(13);
$this->phpexcel->getActiveSheet()->getColumnDimension('i')->setWidth(7);
$this->phpexcel->getActiveSheet()->getColumnDimension('j')->setWidth(7);
$this->phpexcel->getActiveSheet()->getColumnDimension('k')->setWidth(15);
$this->phpexcel->getActiveSheet()->getColumnDimension('l')->setWidth(15);
$this->phpexcel->getActiveSheet()->getColumnDimension('m')->setWidth(15);
$this->phpexcel->getActiveSheet()->getColumnDimension('n')->setWidth(15);
$this->phpexcel->getActiveSheet()->getColumnDimension('o')->setWidth(20);
$this->phpexcel->getActiveSheet()->getColumnDimension('p')->setWidth(30);

$this->phpexcel->getActiveSheet()->setTitle('personal');


// configuramos el documento para que la hoja
// de trabajo número 0 sera la primera en mostrarse
// al abrir el documento
$this->phpexcel->setActiveSheetIndex(0);





// redireccionamos la salida al navegador del cliente (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="personal.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
$objWriter->save('php://output');
?>