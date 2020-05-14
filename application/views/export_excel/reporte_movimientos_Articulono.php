<?php
$this->phpexcel->getProperties()->setCreator("Ruben Payrumani ,Magali Poma")
        ->setLastModifiedBy("Ruben Payrumani ,Magali Poma")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");

$this->phpexcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nombre')
            ->setCellValue('B1', 'E-mail')
            ->setCellValue('C1', 'Twitter')
            ->setCellValue('A2', 'David')
            ->setCellValue('B2', 'dvd@gmail.com')
            ->setCellValue('C2', '@davidvd');

$this->phpexcel->getActiveSheet()->setTitle('Usuarios');
$this->phpexcel->setActiveSheetIndex(0);

$this->phpexcel->getActiveSheet()->setTitle('Usuarios');
$this->phpexcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');
 
$objWriter=PHPExcel_IOFactory::createWriter($this->phpexcel,'Excel5');
$objWriter->save('php://output');
exit;

?>
