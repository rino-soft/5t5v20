<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*echo "ok hasta aqui";

$this->phpexcel->getProperties()->setCreator("Ruben Payrumani ,Magali Poma")
        ->setLastModifiedBy("Ruben Payrumani ,Magali Poma")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");


// configuramos las propiedades del documento
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
*/

?>

<table>
    <tr>
        <th></th>  
        <th></th>  
        <th></th>  
        <th></th>  
        <th></th>  
        <th></th>  
        <th></th>  
    </tr>
    <?php echo 'este es count dddddd'.count($cod_props);
    for ($i=0;$i<count($cod_props);$i++) 
        {
        ?>
        <tr>
        <td> <?php echo $i; ?></td>
        <?php
            $mov=$vec_mov[$cod_props[$i]];
            $fila=$mov->row();?>

        <td><?php echo substr(str_replace("-", "/", $fila->fh_reg), 0, 10); ?></td>
        <td><?php echo $fila->nombre_titulo; ?></td>
        <td><?php echo $fila->cantidad; ?></td>
        <td><?php echo $fila->proyecto; ?></td>
        <td><?php echo $fila->nombre_subregion; ?></td>
        <td><?php echo $fila->nomcomp; ?></td>
        
        </tr>
        <?php } ?>
    
</table>
<table border="1">
    <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    
    
</table>    
