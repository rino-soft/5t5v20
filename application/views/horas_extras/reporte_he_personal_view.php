<?php
$meses = Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$mes = (int) date("n");
$ano = (int) date("o");
$cod_ano = "<option  value='" . ((int)$ano - 1) . "'>" . ((int)$ano - 1) . "</option> <option value='" . ((int)$ano ) . "' selected='selected'>" . ((int)$ano ). "</option>";

$cod = "";


for ($i = 1; $i <= count($meses); $i++) {
    //echo "<script> alert('".$mes."== ". $i ."');</script>";
    if ((int)$mes == $i ) {
        $cod.= "<option value='$i' selected='selected' >" . $meses[$i-1] . "</option>";
    }
    else
        $cod.= "<option  value='$i'>" . $meses[$i-1] . "</option>";
}
?>
<div class="container_12">
<input type="hidden" id="burl" value="<?php echo base_url(); ?>">
<div class="grid_12">
    <div class="grid_6"><span class="negrilla letra35">Reportes</span>Horas extra por personal. </div>
    <div class="grid_5 esparriba alinearDerecha"> 
        <select id="mes_actual" onchange="carga_reporte_pdf_he_personal();"><?php echo $cod; ?> </select>
        <select id="ano_actual" onchange="carga_reporte_pdf_he_personal();"><?php echo $cod_ano ?> </select>
        
    </div>
    
</div>

<div id="contenido_de_carga" class="grid_12" style ="height: 500px;"  >
    cargando...
</div>
<script >
 carga_reporte_pdf_he_personal();
</script>
</div>



