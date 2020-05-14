<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of experiencia_lab_principal_view
 *
 * @author POMA RIVERO
 */


?>
<div class="titulo_contenido"><?php
echo "$titulo";
?></div>

<div class="azulmarino f14 negrilla alin_der espder20">Estimado/a <?php echo $this->session->userdata('nombres')." ".$this->session->userdata('apellidos');?></div>
<div class="alin_der espder20 NO f12 esparriba10 espabajo10"><span class="f18 negrilla">IMPORTANTE!!!</span>, usted debe registrar su trayectoria laboral, para el file personal en RRHH.</div>


<div style="display: table; width: 95%">
    <div style="display: table-row">
        <div  style="height: 35px ;display: table-cell; padding:5px 5% 5px 5px; float: left">

            <div class="boton milink"  style="float: left; display: table-cell" 
                 onclick="dialog_adicionar_experiencia_laboral('div_formularios_dialog','<?php echo base_url() . "experiencia_laboral/adicionar_nueva_experiencia_laboral/0"; ?>','Adicionar experiencia laboral')">
                Adicionar experiencia laboral
            </div>

        </div>
    </div>
    <!--- <div class="impresionDoc milink" title="Imprimir PDF" onclick="Imp_asignacion_de_vehiculos_proyecto()"></div>--->

    


</div>



<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar container_20" style="height: 300px; width: 400px;">cargando...</div>

<div id="pregunta"></div>

<div class="" id="lista_experiencia"></div>

<script> cargar_contenido_html("lista_experiencia",'<?php echo base_url()."experiencia_laboral/lista_experiencia_laboral"?>',0);
</script>