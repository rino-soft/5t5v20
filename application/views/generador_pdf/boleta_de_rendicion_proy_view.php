
<?php 
include_once APPPATH . 'helps/fpdf/fpdf.php';
$this->pdf = new PDF(); //por defecto A4
//$this->pdf->AddPage();
//cabecera
//$this->pdf->Image(base_url() . 'imagenesweb/recursos/LOGOSTS.jpg', 5, 5, 30, 'jpg');





$this->pdf->Ln(4);
$this->pdf->SetFont('Arial', 'B', 12);
$this->pdf->Cell(180, 5, 'REEMBOLSO', '', 0, 'C', '0');

//$titulos=array('');
date_default_timezone_set("Etc/GMT+4");
$ahora = date("d/m/Y") . " , " . date("G:i:s");
//VARIABLES
$suma_total_final=0;
$cantidad_total_final=0;
$total_iva_final=0;
$total_iue_serv=0;
$total_iue_com=0;
$total_it_serv=0;
$total_it_com=0;
$total_rc_iva=0;
$total_neto_final=0;

//






if ($proyecto->num_rows() > 0) {
    foreach ($proyecto->result() as $reg){
        //foreach()
        $rendicion_proy=$rendiciones_proyecto[$reg->id_proy];
        if($rendicion_proy->num_rows()>0){
            $this->pdf->AddPage('L');
            $this->pdf->Header_logo_izq_sup($ahora);
            $this->pdf->SetFont('Arial', '', 9);
            $this->pdf->Cell(275, 10, "Generado en el Sistema de Gestion OnLine en fecha ".$ahora , '0', 0, 'R');  
            $this->pdf->Ln(4);
            $this->pdf->SetFont('Arial', 'B', 14);
            $this->pdf->Cell(180, 5, 'REEMBOLSO', '', 0, 'C', '0');
            $this->pdf->Ln(3);
            $this->pdf->SetTextColor(0, 0, 0);
            $this->pdf->SetFont('Arial', 'B', 14);
            $nom_proy = $reg->nombre;
            $this->pdf->Cell(275, 10, 'PROYECTO ' . $nom_proy, '0', 0, 'C', '0');
             
            /*$this->pdf->Ln(3);
            $this->pdf->Cell(30, 5, 'Pertenenciente a : ', '', 0, '', '0');
            $this->pdf->SetFont('Arial', '', 10);
            $dato_usuario = $reg2->ap_paterno . " " . $reg2->ap_materno . " " . $reg2->nombre;
            $this->pdf->Cell(65, 5, $dato_usuario, '', 0, '', '0');
            */
            //$this->pdf->SetFont(S'Arial', 'B', 10);
            foreach($rendicion_proy->result() as $reg2)
            {
                 $this->pdf->Ln(3);
                 $this->pdf->Cell(30, 5, 'Pertenenciente a : ', '', 0, '', '0');
                 $this->pdf->SetFont('Arial', '', 10);
                 $dato_usuario = $reg2->ap_paterno . " " . $reg2->ap_materno . " " . $reg2->nombre;
                 $this->pdf->Cell(65, 5, $dato_usuario, '', 0, '', '0');
                
                 
                 
            }
            

        }
        
    
    }
    

    
}










///final

$this->pdf->AliasNbPages();
$this->pdf->Output('OPssss', 'I');
?>