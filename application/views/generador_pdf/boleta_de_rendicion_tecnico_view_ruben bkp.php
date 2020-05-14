<?php 

include_once APPPATH . 'helps/fpdf/fpdf.php';
$this->pdf = new PDF(); //por defecto A4
$this->pdf->AddPage();

//cabecera
$this->pdf->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 5, 5, 30, 'jpg');

date_default_timezone_set("Etc/GMT+4");
$this->pdf->SetFont('Arial', '', 8);
$this->pdf->Cell(190, 4, date_format(new DateTime('now'), 'd/m/Y, H:i'), '', 0, 'R', '0');
$can_le=strlen($datos_rendicion->row()->idreg_ren."");
$cero=substr("000000", $can_le);
$this->pdf->Ln(4);
$this->pdf->SetFont('Times', 'B', 16);
$this->pdf->Cell(190, 4, 'N. '.$cero.$datos_rendicion->row()->idreg_ren, '', 0, 'R', '0');

$this->pdf->Ln(4);
$this->pdf->SetFont('Arial', 'B', 12);
$this->pdf->Cell(180, 5, 'Rendiciones', '', 0, 'C', '0');
$this->pdf->Ln(1);
$this->pdf->SetFont('Times', 'B', 12);
$this->pdf->Cell(190, 5, 'REEMBOLSO', '', 0, 'R', '0');


$this->pdf->Ln(8);
$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->Cell(40, 5, 'Perteneciente a : ', '', 0, '', '0');
$this->pdf->SetFont('Arial', '', 10);
$nombre_tecnico = $dato_usuario_tecnico->row()->ap_paterno . " " . $dato_usuario_tecnico->row()->ap_materno . " " . $dato_usuario_tecnico->row()->nombre;
$this->pdf->Cell(65, 5, $nombre_tecnico, '', 0, '', '0');
$this->pdf->SetFont('Arial', 'B', 10);
$this->pdf->Cell(30, 5, 'Proyecto : ', '', 0, '', '0');
$this->pdf->SetFont('Arial', '', 10);
$this->pdf->Cell(65, 5, $datos_rendicion->row()->nom_proy, '', 0, '', '0');
$this->pdf->Ln(8);
 $this->pdf->SetTextColor(200,50,0);
$this->pdf->SetFont('Arial','B',16);

$this->pdf->MultiCell(180, 5, utf8_decode('Este documento solo es valido para respaldo personal, imprima en caso de ser necesario') , '0', 'C', '0');
 $this->pdf->SetTextColor(0,0,0);
/*$this->pdf->SetFont('Arial','',10);
$this->pdf->Cell(65,3,'xxx','',0,'','0');
$this->pdf->SetFont('Arial','B',10);
$this->pdf->Cell(30,3,'Resp. Regional :','',0,'','0');
$this->pdf->SetFont('Arial','',10);
$this->pdf->Cell(65,3,'xxx','',0,'','0');*/


 $suma_total_final=0;
 $cantidad_total_final=0;
 $total_iva_final=0;
 $total_iue_serv=0;
 $total_iue_com=0;
 $total_it_serv=0;
 $total_it_com =0;
 $total_rc_iva =0;
 $total_neto_final=0;
 



if($traA->num_rows()>0)
{   $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 11);
    $this->pdf->SetFont('Arial','',11);
    $this->pdf->Cell(145, 5,' Formulario transportes respaldo con facturas' , 'B', 0, 'L', '0');
    $this->pdf->Cell(45, 5,' TRA08 - A' , 'B', 0, 'R', '0');
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->SetFillColor(230,230,230);
    $this->pdf->SetTextColor(255,255,255);
    $this->pdf->Cell(70, 5,'Tipo de Gasto ' , 'B', 0, 'L', '1');
    $this->pdf->Cell(20, 5,' Cantidad' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' Valor Bruto' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' IVA' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' Valor Neto' , 'B', 0, 'C', '1');
    $this->pdf->Cell(40, 5,' ' , 'B', 0, 'C', '1');
  
    $this->pdf->Ln(5);
    $cant=0;
    $bruto=0;
    $iva=0;
    $neto=0;
    foreach ($traA->result() as $tr)
    {
        
        
      $this->pdf->SetFont('Arial', '', 10);
      $this->pdf->Cell(70, 5, ucwords(strtolower($tr->descripcion_tra)) , 'B', 0, 'L', '0');   
      $this->pdf->Cell(20, 5, $tr->cantidad , 'B', 0, 'C', '0');   
      $this->pdf->Cell(20, 5, $tr->total , 'B', 0, 'C', '0');  
     
        $valor_neto=  number_format($tr->total-$tr->IVA_calc,2 );
        $this->pdf->Cell(20, 5, $tr->IVA_calc , 'B', 0, 'C', '0'); 
        $this->pdf->Cell(20, 5, $valor_neto , 'B', 0, 'C', '0'); 
        $this->pdf->Cell(40, 5, '' , 'B', 0, 'C', '0'); 
        $cant+=$tr->cantidad;
        $bruto+=$tr->total;
        $iva+=$tr->IVA_calc;
        $neto+=$valor_neto;
        $suma_total_final+=$tr->total;
        $cantidad_total_final+=$tr->cantidad;
        $total_iva_final+=$tr->IVA_calc;
        $total_neto_final+=$tr->total;
      $this->pdf->Ln(5);
    }
    $this->pdf->SetFillColor(245,245,245);
    $this->pdf->SetLineWidth(0.5);
    $this->pdf->SetFont('Arial', 'B', 10);
     $this->pdf->Cell(70, 5,'SUBTOTAL Bs.-' , 'T', 0, 'R', '1');
    $this->pdf->Cell(20, 5,$cant , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$bruto , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$iva , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$neto , 'T', 0, 'C', '1');
    $this->pdf->Cell(40, 5,' ' , 'T', 0, 'C', '1');
    $this->pdf->SetLineWidth(0.2);
    $this->pdf->SetFillColor(230,230,230);
}
 $this->pdf->Ln(7);
if($sgrA->num_rows()>0)
{
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 11);
        $this->pdf->Cell(145, 5,' Formulario de gastos respaldado con facturas' , 'B', 0, 'L', '0');

    $this->pdf->Cell(45, 5, 'SGR17 - A' , 'B', 0, 'R', '0');
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 10);
  //  $this->pdf->SetFillColor(200,200,200);
    $this->pdf->SetTextColor(255,255,255);
    $this->pdf->Cell(70, 5,'Tipo de Gasto ' , 'B', 0, 'L', '1');
    $this->pdf->Cell(20, 5,' Cantidad' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' Valor Bruto' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' IVA' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' Valor Neto' , 'B', 0, 'C', '1');
    $this->pdf->Cell(40, 5,' ' , 'B', 0, 'C', '1');
 $this->pdf->SetTextColor(0,0,0);
    $cant=0;
    $bruto=0;
    $iva=0;
    $neto=0;

    $this->pdf->Ln(5);
    foreach ($sgrA->result() as $tr)
    {
      $this->pdf->SetFont('Arial', '', 10);
      $this->pdf->Cell(70, 5, ucwords(strtolower($tr->descripcion_tra)) , 'B', 0, 'L', '0');   
      $this->pdf->Cell(20, 5, $tr->cantidad , 'B', 0, 'C', '0');   
      $this->pdf->Cell(20, 5, $tr->total , 'B', 0, 'C', '0');   
      $valor_neto=  number_format($tr->total-$tr->IVA_calc,2 );
      $this->pdf->Cell(20, 5, $tr->IVA_calc , 'B', 0, 'C', '0'); 
      $this->pdf->Cell(20, 5, $valor_neto , 'B', 0, 'C', '0'); 
      $this->pdf->Cell(40, 5, '' , 'B', 0, 'C', '0'); 
      $this->pdf->Ln(5);
       $cant+=$tr->cantidad;
        $bruto+=$tr->total;
        $iva+=$tr->IVA_calc;
        $neto+=$valor_neto;
        $suma_total_final+=$tr->total;
        $cantidad_total_final+=$tr->cantidad;
        $total_iva_final+=$tr->IVA_calc;
         $total_neto_final+=$tr->total;

    }
    $this->pdf->SetFillColor(245,245,245);
    $this->pdf->SetLineWidth(0.5);
    $this->pdf->SetFont('Arial', 'B', 10);
     $this->pdf->Cell(70, 5,'SUBTOTAL Bs.-' , 'T', 0, 'R', '1');
    $this->pdf->Cell(20, 5,$cant , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$bruto , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$iva , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$neto , 'T', 0, 'C', '1');
    $this->pdf->Cell(40, 5,' ' , 'T', 0, 'C', '1');
    $this->pdf->SetLineWidth(0.2);
    $this->pdf->SetFillColor(230,230,230);
}
//con recibo sgr and tra
 $this->pdf->Ln(7);
if($traB->num_rows()>0)
{
    
    
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 11);
    $this->pdf->Cell(145, 5,' Formulario transportes respaldo con recibos' , 'B', 0, 'L', '0');
    $this->pdf->Cell(45, 5, 'TRA08 - B', 'B', 0, 'R', '0');
    $this->pdf->Ln(5);
    
    $this->pdf->SetFont('Arial', 'B', 10);
   // $this->pdf->SetFillColor(200,200,200);
    $this->pdf->Cell(70, 5,'Tipo de Gasto ' , 'B', 0, 'L', '1');
    $this->pdf->Cell(20, 5,' Cantidad' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' Valor Bruto' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' IUE' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' IT' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' RC-IVA' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' Valor Neto' , 'B', 0, 'C', '1');

    $this->pdf->Ln(5);
    
    $cant=0;
    $bruto=0;
    $IUE=0;
    $IT=0;
    $RC_IVA=0;
    $neto=0;
    
    $title='dato';
    foreach ($traB->result() as $tr)
    {
        if($title!=$tr->tipo_factura)
        {
            $title=$tr->tipo_factura;
            
            $this->pdf->SetFont('Arial', '', 7);
            $this->pdf->Cell(190, 3, $title, 'B', 0, 'L', '0');   
            $this->pdf->Ln(3);
        }
     
            
             $this->pdf->SetFont('Arial', '', 10);
                $this->pdf->Cell(70, 5, ucwords(strtolower($tr->descripcion_tra)) , 'B', 0, 'L', '0');   
                $this->pdf->Cell(20, 5, $tr->cantidad , 'B', 0, 'C', '0');   
                $this->pdf->Cell(20, 5, $tr->Neto , 'B', 0, 'C', '0');  
                $this->pdf->Cell(20, 5, $tr->IUE_calc , 'B', 0, 'C', '0');   
                $this->pdf->Cell(20, 5, $tr->IT_calc , 'B', 0, 'C', '0'); 
                $this->pdf->Cell(20, 5, $tr->RC_IVA_calc , 'B', 0, 'C', '0'); 
                $this->pdf->Cell(20, 5, $tr->total , 'B', 0, 'C', '0');
                
                $this->pdf->Ln(5);
            
        $cant+=$tr->cantidad;
        $bruto+=$tr->Neto;
        $IUE+=$tr->IUE_calc;
        $IT+=$tr->IT_calc;
        $RC_IVA+=$tr->RC_IVA_calc;
        $neto+= $tr->total;
        $suma_total_final+=$tr->total;
        $cantidad_total_final+=$tr->cantidad;
         $total_neto_final+=$tr->Neto;
        
        if($tr->tipo_factura=='servicio'){
            $total_iue_serv+=$tr->IUE_calc; 
            $total_it_serv+=$tr->IT_calc;
        }
        if($tr->tipo_factura=='compra'){
            $total_iue_com+=$tr->IUE_calc; 
            $total_it_com+=$tr->IT_calc;
        }
        if($tr->tipo_factura=='alquiler'){
            $total_rc_iva+=$tr->RC_IVA_calc;
        }
    
    }
    $this->pdf->SetFillColor(245,245,245);
    $this->pdf->SetLineWidth(0.5);
    $this->pdf->SetFont('Arial', 'B', 10);
     $this->pdf->Cell(70, 5,'SUBTOTAL Bs.-' , 'T', 0, 'R', '1');
    $this->pdf->Cell(20, 5,$cant , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$bruto , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$IUE , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$IT , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$RC_IVA , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$neto , 'T', 0, 'C', '1');
   // $this->pdf->Cell(40, 5,' ' , 'T', 0, 'C', '1');
    $this->pdf->SetLineWidth(0.2);
    $this->pdf->SetFillColor(230,230,230);
}
$this->pdf->Ln(7);
if($sgrB->num_rows()>0)
{
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 11);
    $this->pdf->Cell(145, 5,' Formulario de gastos respaldo con recibos' , 'B', 0, 'L', '0');
    $this->pdf->Cell(45, 5, 'SGR17 - B' , 'B', 0, 'R', '0');
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 10);
   // $this->pdf->SetFillColor(200,200,200);
    $this->pdf->Cell(70, 5,'Tipo de Gasto ' , 'B', 0, 'L', '1');
    $this->pdf->Cell(20, 5,' Cantidad' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' Valor Bruto' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' IUE' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' IT' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' RC-IVA' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' Valor Neto' , 'B', 0, 'C', '1');

    $this->pdf->Ln(5);
    
    $cant=0;
    $bruto=0;
    $IUE=0;
    $IT=0;
    $RC_IVA=0;
    $neto=0;
    
    $title='dato';
    foreach ($sgrB->result() as $tr)
    {
        if($title!=$tr->tipo_factura)
        {
            $title=$tr->tipo_factura;
            
            $this->pdf->SetFont('Arial', '', 7);
            $this->pdf->Cell(190, 3, $title, 'B', 0, 'L', '0');   
            $this->pdf->Ln(3);
        }
       
            
             $this->pdf->SetFont('Arial', '', 10);
                $this->pdf->Cell(70, 5, ucwords(strtolower($tr->descripcion_tra)) , 'B', 0, 'L', '0');   
                $this->pdf->Cell(20, 5, $tr->cantidad , 'B', 0, 'C', '0');   
                $this->pdf->Cell(20, 5, $tr->Neto , 'B', 0, 'C', '0'); 
                $this->pdf->Cell(20, 5,  $tr->IUE_calc , 'B', 0, 'C', '0');   
                $this->pdf->Cell(20, 5, $tr->IT_calc , 'B', 0, 'C', '0'); 
                $this->pdf->Cell(20, 5, $tr->RC_IVA_calc , 'B', 0, 'C', '0'); 
                $this->pdf->Cell(20, 5, $tr->total , 'B', 0, 'C', '0');   
                $this->pdf->Ln(5);
            
    
        $cant+=$tr->cantidad;
        $bruto+=$tr->Neto;
        $IUE+=$tr->IUE_calc;
        $IT+=$tr->IT_calc;
        $RC_IVA+=$tr->RC_IVA_calc;
        $neto+= $tr->total;
        $suma_total_final+=$tr->total;
        $cantidad_total_final+=$tr->cantidad;
        $total_neto_final+=$tr->Neto;
        
         if($tr->tipo_factura=='servicio'){
            $total_iue_serv+=$tr->IUE_calc;
            $total_it_serv+=$tr->IT_calc;
        }
        if($tr->tipo_factura=='compra'){
            $total_iue_com+=$tr->IUE_calc; 
            $total_it_com +=$tr->IT_calc;
        }
        if($tr->tipo_factura=='alquiler'){
            $total_rc_iva+=$tr->RC_IVA_calc;
             
            $total_it_serv +=$tr->IT_calc;
        }
    
    }
    $this->pdf->SetFillColor(245,245,245);
    $this->pdf->SetLineWidth(0.5);
    $this->pdf->SetFont('Arial', 'B', 10);
     $this->pdf->Cell(70, 5,'SUBTOTAL Bs.-' , 'T', 0, 'R', '1');
    $this->pdf->Cell(20, 5,$cant , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$bruto , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$IUE , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$IT , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$RC_IVA , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$neto , 'T', 0, 'C', '1');
   // $this->pdf->Cell(40, 5,' ' , 'T', 0, 'C', '1');
    $this->pdf->SetLineWidth(0.2);
    $this->pdf->SetFillColor(230,230,230);
}
$this->pdf->Ln(7);
if($sgrC->num_rows()>0)
{
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 11);
        $this->pdf->Cell(145, 5,' Formulario de gastos telefonia respaldado con facturas' , 'B', 0, 'L', '0');

    $this->pdf->Cell(45, 5, 'SGR17 - C' , 'B', 0, 'R', '0');
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 10);
  //  $this->pdf->SetFillColor(200,200,200);
    $this->pdf->Cell(70, 5,'Tipo de Gasto ' , 'B', 0, 'L', '1');
    $this->pdf->Cell(20, 5,' Cantidad' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' Valor Bruto' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' IVA' , 'B', 0, 'C', '1');
    $this->pdf->Cell(20, 5,' Valor Neto' , 'B', 0, 'C', '1');
    $this->pdf->Cell(40, 5,' ' , 'B', 0, 'C', '1');

    $cant=0;
    $bruto=0;
    $iva=0;
    $neto=0;

    $this->pdf->Ln(5);
    foreach ($sgrC->result() as $tr)
    {
      $this->pdf->SetFont('Arial', '', 10);
      $this->pdf->Cell(70, 5, ucwords(strtolower($tr->descripcion_tra)) , 'B', 0, 'L', '0');   
      $this->pdf->Cell(20, 5, $tr->cantidad , 'B', 0, 'C', '0');   
      $this->pdf->Cell(20, 5, $tr->total , 'B', 0, 'C', '0'); 
      
      $valor_neto=  number_format($tr->total-$tr->IVA_calc,2 );
      $this->pdf->Cell(20, 5, $tr->IVA_calc , 'B', 0, 'C', '0'); 
      $this->pdf->Cell(20, 5, $valor_neto , 'B', 0, 'C', '0'); 
      $this->pdf->Cell(40, 5, '' , 'B', 0, 'C', '0'); 
      $this->pdf->Ln(5);
      $cant+=$tr->cantidad;
      $bruto+=$tr->total;
      $iva+=$tr->IVA_calc;
      $neto+=$valor_neto;
      $suma_total_final+=$tr->total;
      $cantidad_total_final+=$tr->cantidad;
        $total_neto_final+=$tr->total;
         $total_iva_final+=$tr->IVA_calc;

    }
    $this->pdf->SetFillColor(245,245,245);
    $this->pdf->SetLineWidth(0.5);
    $this->pdf->SetFont('Arial', 'B', 10);
    $this->pdf->Cell(70, 5,'SUBTOTAL Bs.-' , 'T', 0, 'R', '1');
    $this->pdf->Cell(20, 5,$cant , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$bruto , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$iva , 'T', 0, 'C', '1');
    $this->pdf->Cell(20, 5,$neto , 'T', 0, 'C', '1');
    $this->pdf->Cell(40, 5,' ' , 'T', 0, 'C', '1');
    $this->pdf->SetLineWidth(0.2);
    $this->pdf->SetFillColor(230,230,230);
}




$this->pdf->Ln(5);


    
    
    
    
  
    
    // $this->pdf->Ln(5);
    
    
    $this->pdf->Ln(2);
    $this->pdf->SetFillColor(50,50,50);
    $this->pdf->SetTextColor(255,255,255);
    $this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', 'B', 12);
    $this->pdf->Cell(90, 5,' TOTAL REEMBOLSO : Bs.- '.$suma_total_final , 'T', 0, 'L', '1');
    
     $this->pdf->Ln(10); $this->pdf->SetTextColor(0,0,0);
     $this->pdf->SetFont('Arial', 'B', 11);
     $this->pdf->Cell(135, 5,' Aclaraciones y Observaciones' , 'LTR', 0, 'L', '0');
     $this->pdf->Ln(5);
      $this->pdf->SetFont('Arial', '', 11);
     $this->pdf->MultiCell(135, 5,$datos_rendicion->row()->observacion, 'LRB', 'J', '0');
    
    
    
    /*$this->pdf->Ln(5);$this->pdf->SetFont('Arial', '', 9);
    $this->pdf->SetTextColor(0,0,0);
    $this->pdf->SetDrawColor(240,240,240);
    
    $this->pdf->Cell(90, 5,' TOTAL NETO : Bs.- '.$total_neto_final , 'T', 0, 'L', '0');$this->pdf->Ln(5);
    $this->pdf->SetFont('Arial', '', 9);
    $this->pdf->Cell(90, 5,' Recibos y Facturas Registradas : '.$cantidad_total_final , 'T', 0, 'L', '0');
   $this->pdf->Ln(4);    $this->pdf->Cell(90, 4,' IVA (13%) :' .$total_iva_final , 'T', 0, 'L', '0');
   $this->pdf->Ln(4);    $this->pdf->Cell(90, 4,' IUE Servicios (12,5%) : ' .$total_iue_serv, 'T', 0, 'L', '0');
   $this->pdf->Ln(4);    $this->pdf->Cell(90, 4,' IUE Compras (5%) : ' .$total_iue_com, 'T', 0, 'L', '0');
   $this->pdf->Ln(4);    $this->pdf->Cell(90, 4,' IT Servicios (3%) : ' .$total_it_serv, 'T', 0, 'L', '0');
   $this->pdf->Ln(4);    $this->pdf->Cell(90, 4,' IT Compras (3%) : ' .$total_it_com , 'T', 0, 'L', '0');
   $this->pdf->Ln(4);    $this->pdf->Cell(90, 4,' RC-IVA (13%)  : ' .$total_rc_iva , 'T', 0, 'L', '0');
 
   
   $this->pdf->SetDrawColor(0,0,0);
    $this->pdf->Ln(5);
    // $this->pdf->Ln(5);
    $this->pdf->Cell(58, 20,' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(46, 20,' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(46, 20,' ', 'LTR', 0, 'L', '0');
    $this->pdf->Cell(40, 20,' ', 'LTR', 0, 'L', '0');
    $this->pdf->Ln(20);
    
    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(58, 4, 'ELABORADO POR:', 'LTR', 0, 'C', '0');
    //$this->pdf->Cell(58, 5, 'ELABORADO POR:' .$nombre, 'LBR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'Firma', 'TR', 0, 'C', '0');
    $this->pdf->Cell(40, 4, 'Firma', 'TR', 0, 'C', '0');
    
     $this->pdf->Ln(4);
    $dato_usuario_resp = $dato_usuario_resp->row()->ap_paterno . " " . $dato_usuario_resp->row()->ap_materno . " " . $dato_usuario_resp->row()->nombre;

    $this->pdf->SetFont('Arial', 'B', 8);
    $this->pdf->Cell(58, 4, $dato_usuario_resp, 'LBR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'RESP. REGIONAL', 'BR', 0, 'C', '0');
    $this->pdf->Cell(46, 4, 'RESP. PROYECTO', 'BR', 0, 'C', '0');
    $this->pdf->Cell(40, 4, 'Vo. Bo...', 'BR', 0, 'C', '0');
*/

$this->pdf->AliasNbPages();
$this->pdf->Output('OPssss', 'I');



?>