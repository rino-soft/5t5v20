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
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");

/* $styleArray = array(
  'borders' => array(
  'allborders' => array(
  'style' => PHPExcel_Style_Border::BORDER_THIN
  )

  )
  );
  $this->phpexcel->getDefaultStyle()->applyFromArray($styleArray); */
// agregamos información a las celdas
// $this->phpexcel->getFont()->setBold(true);
$this->phpexcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'ESPECIFICACION')
        ->setCellValue('B1', 'No')
        ->setCellValue('C1', 'FECHA DE FACTURA')
        ->setCellValue('D1', 'NUMERO DE FACTURA')
        ->setCellValue('E1', 'NUMERO DE AUTORIZACION')
        ->setCellValue('F1', 'ESTADO')
        ->setCellValue('G1', 'NIT CLIENTE')
        ->setCellValue('H1', 'NOMBRE O RAZON SOCIAL')
        ->setCellValue('I1', 'IMPORTE TOTAL DE LA VENTA      A')
        ->setCellValue('J1', 'IMPORTE ICE/IEHD/TASAS   B')
        ->setCellValue('K1', 'EXPORTACIONES Y OPERACIONES EXCENTAS             C')
        ->setCellValue('L1', 'VENTAS GRABADAS A TASA CERO               D')
        ->setCellValue('M1', 'SUB TOTAL             E=A-B-C-D')
        ->setCellValue('N1', 'DESCUENTO, BONIFICACIONES Y REBAJAS OTORGADAS           F')
        ->setCellValue('o1', 'IMPORTE BASE PARA DEBITO FISCAL   G=E-F')
        ->setCellValue('p1', 'DEBITO FISCAL H=G*13%')
        ->setCellValue('q1', 'CODIGO DE CONTROL');
// $this->phpexcel->getFont()->setBold(false);

$this->phpexcel->getActiveSheet()->getStyle('A1:Q1')->applyFromArray(
        array(
            'font' => array(
                'bold' => true,
                'size' => 9,
                'name' => 'calibri'
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        )
);

$this->phpexcel->getActiveSheet()->getStyle('A1:Q1')->getAlignment()->setWrapText(true);
$this->phpexcel->getActiveSheet()->getStyle('I:P')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
//$this->phpexcel->getColumnDimension('A')->setWidth(40);
/*  $this->phpexcel->getActiveSheet()->getStyle('B1')->getAlignment()->setWrapText(true);
  $this->phpexcel->getActiveSheet()->getStyle('C1')->getAlignment()->setWrapText(true);
  $this->phpexcel->getActiveSheet()->getStyle('D1')->getAlignment()->setWrapText(true);
  $this->phpexcel->getActiveSheet()->getStyle('E1')->getAlignment()->setWrapText(true);
  $this->phpexcel->getActiveSheet()->getStyle('F1')->getAlignment()->setWrapText(true);
  $this->phpexcel->getActiveSheet()->getStyle('G1')->getAlignment()->setWrapText(true);
  $this->phpexcel->getActiveSheet()->getStyle('H1')->getAlignment()->setWrapText(true);
  $this->phpexcel->getActiveSheet()->getStyle('I1')->getAlignment()->setWrapText(true);
  $this->phpexcel->getActiveSheet()->getStyle('J1')->getAlignment()->setWrapText(true);
  $this->phpexcel->getActiveSheet()->getStyle('K1')->getAlignment()->setWrapText(true);
  $this->phpexcel->getActiveSheet()->getStyle('L1')->getAlignment()->setWrapText(true);
  $this->phpexcel->getActiveSheet()->getStyle('M1')->getAlignment()->setWrapText(true);
  $this->phpexcel->getActiveSheet()->getStyle('N1')->getAlignment()->setWrapText(true);
  $this->phpexcel->getActiveSheet()->getStyle('O1')->getAlignment()->setWrapText(true);
  $this->phpexcel->getActiveSheet()->getStyle('P1')->getAlignment()->setWrapText(true);
  $this->phpexcel->getActiveSheet()->getStyle('Q1')->getAlignment()->setWrapText(true);
 */



// La librería puede manejar la codificación de caracteres UTF-8

$style_no = array(
    'font' => array(
        'size' => 9,
        'name' => 'calibri',
        'color' => array('rgb' => '7C0000')
    ),
    'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
);


$punt = 2;


foreach ($registros->result() as $reg) {
    $estado="V";
    if($reg->est_factura=="Anulado")
        $estado="A";
    if($reg->est_factura=="Extraviado")
        $estado="E";
    if($reg->est_factura=="No Utilizado")
        $estado="N";
    $fechha=date("d/m/Y",  strtotime("$reg->fec_reg")); 
    $this->phpexcel->setActiveSheetIndex(0)->getStyle('E')->getNumberFormat()->setFormatCode('#0');
    $this->phpexcel->setActiveSheetIndex(0)->getStyle('G')->getNumberFormat()->setFormatCode('#0');
    $this->phpexcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $punt, '1')
            ->setCellValue('B' . $punt, ($punt - 1))
            // ->setCellValue('C'.$punt, PHPExcel_Shared_Date::PHPToExcel( $reg->fec_reg ))
            //->setCellValue('C'.$punt,  substr( str_replace("-", "/",$reg->fec_reg),0,10))
            ->setCellValue('C'.$punt,  $fechha)
            ->setCellValue('D' . $punt, $reg->num_factura)
            ->setCellValue('E' . $punt, "" . $reg->nro_autorizacion)
            ->setCellValue('F' . $punt, $estado)
            ->setCellValue('G' . $punt, "" . $reg->NIT_cliente)
            ->setCellValue('H' . $punt, $reg->razon_social)
            ->setCellValue('I' . $punt, $reg->monto_total_bs)
            ->setCellValue('J' . $punt, '0')
            ->setCellValue('K' . $punt, '0')
            ->setCellValue('L' . $punt, '0')
            ->setCellValue('M' . $punt, '=I'.$punt.'-J'.$punt.'-K'.$punt.'-L'.$punt)
            ->setCellValue('N' . $punt, '0')
            ->setCellValue('O' . $punt, '=M'.$punt.'-N'.$punt)
            ->setCellValue('P' . $punt, '=O'.$punt.'*0.13')
            ->setCellValue('Q' . $punt, $reg->codigo_control);
    // $this->phpexcel->getActiveSheet()->getStyle('C'.$punt)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
    
     /* $this->phpexcel->getActiveSheet()->getCell('M' . $punt)->getCalculatedValue();
      $this->phpexcel->getActiveSheet()->getCell('O' . $punt)->getCalculatedValue();
      $this->phpexcel->getActiveSheet()->getCell('P' . $punt)->getCalculatedValue();
    */
   
    
    if ($reg->est_factura != 'Valido') {
        $this->phpexcel->getActiveSheet()->getStyle('A' . $punt . ':Q' . $punt)->applyFromArray($style_no);
        $this->phpexcel->setActiveSheetIndex(0)
                ->setCellValue('I' . $punt, '0')
               // ->setCellValue('M' . $punt, '=I' . $punt . '*0.13')
                ->setCellValue('q' . $punt, '');
    }
   $this->phpexcel->getActiveSheet()->getStyle('L' . $punt . ':M' . $punt)->getAlignment()->setWrapText(true);

    $punt++;
}
// Renombramos la hoja de trabajo
$this->phpexcel->getActiveSheet()->getColumnDimension('a')->setWidth(13);
$this->phpexcel->getActiveSheet()->getColumnDimension('b')->setWidth(10);
$this->phpexcel->getActiveSheet()->getColumnDimension('c')->setWidth(13);
$this->phpexcel->getActiveSheet()->getColumnDimension('d')->setWidth(10);
$this->phpexcel->getActiveSheet()->getColumnDimension('e')->setWidth(17);
$this->phpexcel->getActiveSheet()->getColumnDimension('f')->setWidth(10);
$this->phpexcel->getActiveSheet()->getColumnDimension('g')->setWidth(15);
$this->phpexcel->getActiveSheet()->getColumnDimension('h')->setWidth(25);
$this->phpexcel->getActiveSheet()->getColumnDimension('i')->setWidth(13);
$this->phpexcel->getActiveSheet()->getColumnDimension('j')->setWidth(13);
$this->phpexcel->getActiveSheet()->getColumnDimension('k')->setWidth(13);
$this->phpexcel->getActiveSheet()->getColumnDimension('m')->setWidth(13);
$this->phpexcel->getActiveSheet()->getColumnDimension('n')->setWidth(13);
$this->phpexcel->getActiveSheet()->getColumnDimension('o')->setWidth(13);
$this->phpexcel->getActiveSheet()->getColumnDimension('p')->setWidth(13);
$this->phpexcel->getActiveSheet()->getColumnDimension('q')->setWidth(15);

$this->phpexcel->getActiveSheet()->setTitle('LibroVentasFacilito');


// configuramos el documento para que la hoja
// de trabajo número 0 sera la primera en mostrarse
// al abrir el documento
$this->phpexcel->setActiveSheetIndex(0);


// redireccionamos la salida al navegador del cliente (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="LibroVentasFacilito.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
$objWriter->save('php://output');
?>