<div class="titulo_contenido"><?php
echo "$titulo";
?></div>
<div class="azulmarino f14 negrilla alin_der espder20">Estimado/a <?php echo $this->session->userdata('nombres')." ".$this->session->userdata('apellidos');?></div>
<div class="alin_der espder20 NO f12 esparriba10 espabajo10"><span class="f18 negrilla">IMPORTANTE!!!</span>, usted debe registrar todos los estudios realizados de su formación académica, para el file personal en RRHH.</div>

<div class="espaciado10"><div class="boton centrartexto" style="width: 200px" onclick="dialog_form_logro_academico('formulario_logro','<?php echo base_url()."estudios_personal/form_logro_acad/0"?>');">Adicionar logro Academico</div></div>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="formulario_logro" class="ocultar container_20" >
    
</div>
<div id="pregunta"></div>

<div class="" id="lista_estudios">
    
</div>
<script> cargar_contenido_html("lista_estudios",'<?php echo base_url()."estudios_personal/lista_logros_academicos"?>',0);
</script>

