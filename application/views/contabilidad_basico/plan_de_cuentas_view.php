<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of plan_de_cuentas_view
 *
 * @author POMA RIVERO
 */
//echo 'empezando con contabilidad'
?>
<?php 
$codigo="";$titulo="";$id_padre="";$comentario=""; $imputable="";
if($id_plan_cuenta!=0){

    $codigo=$datos_cuenta->codigo;
    $titulo=$datos_cuenta->titulo;
    $imputable=$datos_cuenta->imputable;
    $fh_registro=$datos_cuenta->fh_registro;
    $comentario=$datos_cuenta->comentario;
}



?>


<div class="container_20">
    <div class="grid_20  bordeado">
        <div class="grid_16">
            <div class="grid_18 prefix_1 suffix_1 fondo_azul centrartexto letraMediana colorBlanco bordeAbajo negrilla">PLAN DE CUENTAS</div>
            <input class="input_redond_200" type="hidden" id="id_plan"  value="<?php echo $datos_cuenta->id_plan_cuenta; ?>">

                 <div class="grid_16 esparriba10 espabajo10">
                    <div class="grid_2 espizq10 alin_izq letraChica espder10">Padre</div>
                     <select id="id_padre" onchange="generar_codigo('id_padre')">
                    <?php echo $datos_cuenta_select;?>
                    </select>
                 </div>
                <div class="grid_16">
                    <div class="grid_5">
                       <div class="grid_2 espizq10 alin_izq letraChica espder10">Código</div>
                       <input class="input_redond_200" type="text" id="codigo"  value="<?php // echo $codigo; ?>" placeholder="Codigo de la cuenta">
                    </div>
                    <div class="grid_8">
                         <div class="grid_2 espizq10 alin_izq letraChica espder10">Comentario</div>
                        <textarea class="textarea_redond_382x65" type="text" id="comentario" placeholder="Escriba un comentario...." ><?php //echo $comentario; ?></textarea>
                        
                    </div>
                    
                </div>
                <div class="grid_16">
                    <input class="input_redond_200" type="text" id="titulo" value="<?php //echo $titulo; ?>" placeholder="Titulo de la cuenta">
                    <div class="grid_2 centrartexto letraChica">Título</div>
                </div>
               
              
            <!--- CARGAR DESDE LA BASE-->
               
  
            <!--- HASTA AQUI--->
                <div class="grid_16 esparriba10">
                    <select id="imputable">
                    <option value="si" <?php /// if ($imputable == "si") echo "selected='selected' " ?>>SI</option>
                    <option value="no" <?php // if ($imputable == "no") echo "selected='selected' " ?>>NO</option>
                    </select>
                    <div class="grid_2 centrartexto letraChica">Imputable</div>
                </div>
      
            
            
             <div class="grid_16 esparriba10 espabajo20">
                <div class="grid_3 espizq10 centrartexto" >
                    <div class="boton f10 milink" onclick="registrar_nueva_cuenta()">
                        Registrar cuenta
                    </div>
                </div>
                 <div class="grid_3 espizq10 centrartexto">
                     <div class="boton f10 milink" onclick="reset_formulario()">
                        Reset
                    </div>
                     
                 </div>
            </div>
            
           <!---  <div class="boton milink"  style="float: left; display: table-cell" 
                 onclick="dialog_nuevo_vehiculo_adicionar('div_formularios_dialog','<?php //echo base_url() . "vehiculo/adicionar_nuevo_vehiculo/0/0"; ?>','Adicionar nuevo vehiculo')">
                Adicionar nuevo vehículo
            </div>!--->
            
            
            <div class="grid_18 prefix_1 suffix_1 bordeAbajo bordeArriba  fondo_plomo centrartexto letraMediana  bordeAbajo negrilla">Cuenta Contable</div>
     
            
            
        </div>
   
<div class="" id="mostrar_cuentas"></div>
  <div class="grid_20">

                <?php  echo $arbol_cuentas; ?>

  </div>
    </div> 
</div>
<!--- desde aca para el arbol--->

            <input class="input_redond_200" type="hidden" id="id_pm"  value="<?php echo $padre; ?>">

