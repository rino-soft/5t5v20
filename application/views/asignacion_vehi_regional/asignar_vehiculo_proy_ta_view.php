<?php
$id_estado_vehi = "";
$estado_llantas="";
$estado_mecanico="";
$estado_carroceria="";
$observaciones="";

if($id_send!=0)
  {
   if($id_asignacion_dato==0){
        $telefono_celular="";
        $nombre_taller="";
        $nombre_tecnico="";
        $fecha_hora_asig="";
        $fecha_hora_dev="";
        $observaciones="";
        $estado_llantas=$estado_vehi->row(0)->estado_llantas;
        $estado_mecanico=$estado_vehi->row(0)->estado_mecanico;
        $estado_carroceria=$estado_vehi->row(0)->estado_carroceria;
        $id_estado_vehi=$estado_vehi->row(0)->id_estado_vehi;
        
  }else{
         $estado_llantas=$estado_vehi->row(0)->estado_llantas;
         $estado_mecanico=$estado_vehi->row(0)->estado_mecanico;
         $estado_carroceria=$estado_vehi->row(0)->estado_carroceria;
         $id_estado_vehi=$estado_vehi->row(0)->id_estado_vehi;
         
         $fecha_hora_asig=$datos_vehi_asig->fecha_hora_asig;
         $fecha_hora_dev=$datos_vehi_asig->fecha_hora_devolucion;
         $nombre_taller=$datos_vehi_asig->nombre_taller;
         $nombre_tecnico=$datos_vehi_asig->nombre_tecnico;
         $telefono_celular= $datos_vehi_asig->telefono_celular;
         $observaciones= $datos_vehi_asig->observaciones;
        }
  }
  
  
?>

<div id="respuesta"></div>

<input type="hidden" id="id_vehiculo_resp" value="<?php echo $id_send; ?>">
<input type="hidden" id="id_estado" value="<?php echo $id_estado_vehi; ?>">
<input type="hidden" id="id_asig_resp" value="<?php echo $id_asignacion_dato; ?>">
<input type="hidden" id="id_asig_regional" value="<?php echo $id_asignacion_dato; ?>">

<div class="grid_12 f10 negrilla espabajo10 fondocambiablem ">
    <div class="f10 grid_6 ">Tipo de Asignacion:
        <select id="tipo_asig" onchange="mostrarA_ocultarB('tipo_asig','opcion_taller','opcion_proyecto')">
            <option value="Taller">Taller</option>
            <option value="Proyecto">Proyecto</option>
        </select>
    </div>
    <script>mostrarA_ocultarB('tipo_asig','opcion_taller','opcion_proyecto');</script>
    
</div>
    



<div style="float: left;width: 600px; " id="opcion_taller">
    <div class="fondo_azul alin_cen colorAmarilloma negrilla f10" style="width: 99%; display: block; padding: 3px;  display: inline-block">D a t o s - d e l - T a l l e r</div><div  class="grid_10 f10" ></div>
    <div class="grid_12 f10 fondo_plomo_claro_areas ">
        <div class="grid_6">
            <input class="input_redond_180" style="margin: 5;" type="text" id="nom_taller" placeholder="Escriba el nombre del Taller" value="<?php echo $nombre_taller?>">
            <div class="f10 negrilla">Nombre del Taller:</div>
        </div>
        <div class="grid_6">
            <input class="input_redond_180" style="margin: 5;" type="text" id="nom_tec" placeholder="Introduzca nombre" value="<?php echo $nombre_tecnico?>">
            <div class="f10 negrilla">Nombre del tecnico</div>
        </div>
    </div>
    <div class="grid_12 fondo_plomo_claro_areas esparriba5 espabajo5">
        <div class="grid_6">
            <select id="reemplazo" onchange="mostrarA_ocultarP('reemplazo','opcion_alquilado','opcion_propio')">
                <option value="Alquilado" >Alquilado</option>
                <option value="Propio" >Propio</option>
                <option value="Sin_reemplazo">Sin reemplazo</option>
            </select> 
        <div class="negrilla f10"> Reemplazar por:</div>
        </div>
        
        <script>mostrarA_ocultarP('reemplazo','opcion_alquilado','opcion_propio');</script>
       <div class="grid_6">
            <div class="" id="opcion_alquilado">
                <select id="alquilado_sel">
                   <?php 
                    foreach($lista_vehi_alqu->result() as $lista_alq)
                    {
                       /* if($lista_alq->placa == $lista_vehi_selec)
                               echo'<option selected="selected" value="'. $lista_alq-> placa. '">' . $lista_alq-> placa .'</option>';
                        else*/
                            echo '<option value="'. $lista_alq-> placa. '">' . $lista_alq-> placa .'</option>'; 
                    }
                   ?> 
                    
                </select>
                <div class="negrilla f10"> Placa :</div>
            </div>
            <div class="" id="opcion_propio">
                <select id="propio_sel">
                   <?php 
                    foreach ($lista_vehi_prop->result() as $lista_prop)
                     {
                        /*if($lista_prop->placa == $lista_prop_selec)
                            echo'<option selected="selected" value="'. $lista_prop-> placa. '">' . $lista_prop-> placa .'</option>';
                        else*/
                        echo '<option value="'. $lista_prop-> placa. '">' . $lista_prop-> placa . '</option>';
                    }
                  
                   
                   ?> 
                    
                </select>
                <div class="negrilla f10"> Placa :</div>
            </div>
         </div>
         

    </div>
    
 
    
    <div class="grid_12 f10 fondo_plomo_claro_areas ">
        <div class="grid_6">
            <input class="input_redond_180" style="margin: 5;" type="text" id="telefono" placeholder="Nro. de telefono " value="<?php echo $telefono_celular?>">
            <div class="f10 negrilla">Telefonos/Celular:</div>
        </div>
        <div class="grid_6 esparriba5">
            <select id="ciudad_asigado" onchange=""> 
                <option value="-1">seleccione departamento...</option>
                 <?php
                foreach ($selec_ciudad->result() as $ciudad) {
                if ($ciudad->codciudad_pk == $ciudad_asig)
                    echo '<option selected="selected" value="' . $ciudad-> codciudad_pk. '">' . $ciudad->nombre . '</option>';
                else
                    echo ' <option value="' . $ciudad->codciudad_pk . '">' . $ciudad->nombre . '</option>';
                }
            ?>  
            </select>
          <div class="f10 negrilla">Departamento:</div>
        </div>
        
    </div>
        
</div>


<div style="float: left;width: 600px; " id="opcion_proyecto">
    <div class="fondo_azul alin_cen colorAmarilloma negrilla f10" style="width: 99%; display: block; padding: 3px;  display: inline-block">D a t o s - d e l - P r o y e c t o</div><div  class="grid_10 f10" > </div>
    <div class="grid_12 f10 fondo_plomo_claro_areas ">
        
        <div class="grid_5 esparriba5">
            <select id="proyecto_seleccionado">
                 <?php
                foreach ($selec_proyecto->result() as $dato) {
                    if ($dato->id_proy == $asig)
                        echo '<option selected="selected" value="' . $dato->id_proy . '">' . $dato->nombre . '</option>';
                    else
                        echo ' <option value="' . $dato->id_proy . '">' . $dato->nombre . '</option>';
                }
                ?>

            </select>
            <div class="f10 negrilla">Seleccionar proyecto:</div>
        </div>
        <div class="grid_5 esparriba5">
            <select id="asignado" onchange=""> 

                <?php
                foreach ($per_a_asignar->result() as $usuario) {
                    if ($usuario->cod_user == $asignado)
                        echo '<option selected="selected" value="' . $usuario->cod_user . '">' . $usuario->ap_paterno ." ". $usuario->ap_materno . $usuario->nombre . '</option>';
                    else
                        echo ' <option value="' . $usuario->cod_user . '">' . $usuario->ap_paterno ." ". $usuario->ap_materno .", ". $usuario->nombre . '</option>';
                }
                ?>

            </select>
            <div class="f10 negrilla">Personal a asignar:</div>
        </div>
         
        
    </div>

    <div class="grid_12 f10 fondo_plomo_claro_areas espabajo10 ">
       
        <div class="grid_5 esparriba5">
            <select id="ciudad_asigado" onchange="carga_subcentro('opcion_proyecto #ciudad_asigado','selec_subcentro','centro_bloque',0);"> 
                <option value="-1">seleccione departamento...</option>
                 <?php
                foreach ($selec_ciudad->result() as $ciudad) {
                if ($ciudad->codciudad_pk == $ciudad_asignar)
                    echo '<option selected="selected" value="' . $ciudad-> codciudad_pk. '">' . $ciudad->nombre . '</option>';
                else
                    echo ' <option value="' . $ciudad->codciudad_pk . '">' . $ciudad->nombre . '</option>';
                }
            ?>  
            </select>
          <div class="f10 negrilla">Departamento:</div>
        </div>
        
        <div id="centro_bloque" class="grid_5 f10 negrilla espabajo10 ">
            <select id="selec_subcentro" onchange=""> 
                <option value="0">seleccione Subcentro...</option>
            </select>
            <script>carga_subcentro('opcion_proyecto #ciudad_asigado','selec_subcentro','centro_bloque',0);</script>
            
            <div class="f10 negrilla">Subcentro:</div>
        </div>

    </div>
     <div class="grid_12 fondo_plomo_claro_areas" >
            <input class="input_redond_150 " style="margin: 5;"type="text" id="telefono" placeholder="Nro. de telefono" value="<?php echo $telefono_celular;?>">
            <div class="f10 negrilla">Telefonos/Celular del encargado:</div>
     </div>
    
</div>
<div class="grid_12 esparriba10 alin_cen borde_abajo borde_arriba borde_der borde_izqm fondo_amarillo">
    <div class="f10 negrilla grid_4 "> Estado Mecanico</div>
    <div class="f10 negrilla grid_4 alin_cen"> Estado Carroceria</div>
    <div class="f10 negrilla grid_4 alin_cen"> Estado llantas</div>
</div>
<div class="grid_12 alin_cen esparriba10 borde_abajo borde_arriba borde_der borde_izq">
    <div id="est_mecanico" style="display: block;" class="grid_4 espizq10"><?php echo $estado_mecanico; ?></div>
    <div id="est_carroceria" style="display: block;" class="grid_3 espizq10"><?php echo $estado_carroceria; ?></div>
    <div id="est_llantas" style="display: block;" class="grid_4 espizq10"><?php echo $estado_llantas; ?></div>
</div>
<div class="grid_10 espabajo10 esparriba10" >
    <div class=" grid_2 boton2 f10 negrilla alin_cen " style="width: 95px; " onclick="dialog_nuevo_estado_vehiculo('ayudita_estado','<?php echo base_url() . "vehiculo/nuevo_estado_vehiculo/$id_send"; ?>/0')"><?php echo "Nuevo estado"; ?></div>
</div>
<div class="grid_12 fondo_plomo_claro_areas" style="">

    <div class="grid_6 alin_cen" style="">
        <input class="input_redond_180" id="fecha_hora_asig" placeholder="Escriba la fecha de Adquisición" value="<?php echo $fecha_hora_asig; ?>">
        <div class="f10 negrilla">Fecha de asignación</div>
        <script>$("#fecha_hora_asig").datepicker();</script>
    </div>
    <div class="grid_6 alin_cen" style="" >
        <input class="input_redond_180 " id="fecha_hora_dev" placeholder="Escriba la fecha de Adquisición" value="<?php echo $fecha_hora_dev; ?>">
        <div class="f10 negrilla">Fecha de devolución</div>
        <script>$("#fecha_hora_dev").datepicker();</script>
    </div>
</div>
<div class="grid_10 esparriba10" >
    <textarea class="textarea_redond_356x100" type="text" id="observaciones" placeholder="Observaciones del vehiculo"  ><?php echo $observaciones; ?></textarea>
    <div class="f10 negrilla"> Observaciones</div>
</div>

<div id="ayudita_estado"></div>

<script>cambios();</script>