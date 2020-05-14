<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registro_asiento_view
 *
 * @author POMA RIVERO
 */
//echo 'registro cuenta';
?>





<div class="container_20">
    <div class="grid_20  bordeado">
       
            <input class="input_redond_200" type="hidden" id="id_plan"  value="<?php //echo $datos_cuenta->id_plan_cuenta; ?>">
            <div class=" grid_20 colorcel negrilla alin_cen">REGISTRAR ASIENTO CONTABLE</div> 
           
                <div class="grid_20 esparriba10">
                    <div class="grid_3 espizq10 alin_izq letraChica espder10 ">
                        Tipo de Transacción
                    </div>
                    <div class="grid_10">
                        <select id="tipo_transaccion">
                        <option value="1" <?php /// if ($imputable == "si") echo "selected='selected' " ?>>INGRESO</option>
                        <option value="2" <?php // if ($imputable == "no") echo "selected='selected' " ?>>EGRESO</option>
                        <option value="3" <?php // if ($imputable == "no") echo "selected='selected' " ?>>TRASPASO</option>
                        </select> 
                    </div>
                </div>
            
                <div class="grid_20">
                       <div class="grid_3 espizq10 alin_izq letraChica espder10 " style="padding-top: 17px;">
                           Fecha del Sistema
                       </div> 
                       <div class="grid_10">
                          <input class="input_redond_200" type="text" id="fechaS" readonly="readonly" value=" <?php echo date("Y-m-d H:i:s");?>" placeholder="">  
                      
                       </div>
                </div> 
            
                 <div class="grid_20 espabajo5 espder5 ">
                     <div class="grid_3 espizq10 alin_izq letraChica espder10 " id="" style="padding-top: 17px;" >
                         Fecha de Contabilización
                     </div>
                     
                     <div class="grid_4"> 
                         <input class="input_redond_200" type="text" id="fe_conta"  value="<?php // echo $codigo; ?>" placeholder="2015-09-28">
                      <script>$("#fe_conta").datepicker({yearRange:"-100:+0"});</script>
                     </div>
                     <div class="grid_3 espizq10 alin_der letraChica espder10 negrilla colorGuindo" style="padding-top: 17px;">
                         Tipo de cambio
                     </div>
                     <div class="grid_4">
                         <input class="input_redond_100" type="text" id="fechaS"  value="<?php  echo 6.96; ?>" placeholder="6.96">
                     </div>
                 </div>
                  
                      
                      
                      <div class="f12 negrilla  borde_der borde_izq borde_abajo fondo_plomo_atras grid_20 esparriba5" style="width: 100%;" >
                        <div class="grid_2 borde_der_c alin_cen"style="display: block-inline; ">Codigo</div>
                        <div class="grid_4 borde_der_c alin_cen"style="display: block-inline; ">Descripción</div>
                        <div class="grid_2 borde_der_c alin_cen" style="display: block-inline; ">Debe</div>
                        <div class="grid_2 borde_der_c alin_cen" style="display: block-inline; ">Haber</div>
                         <div class="grid_4 borde_der_c alin_cen" style="display: block-inline;">Comentario</div>
                         <div class="grid_4 borde_der_c alin_cen" style="display: block-inline; ">Dimensión</div>
                         <div class="grid_1 alin_cen" style="display: block-inline; ">---</div>
                      </div>
            
                      <div class="grid_20" id ="asientos">
                        <div id="grilla_modelo" class="oculto">
                            <div class="grid_20">
                                <div class="grid_2">
                                    <input type="text" id="codigo" class="input_redond_100_c" placeholder="">
                                </div>
                                <div class="grid_4 ">
                                    <input type="text" id="descrip" class="input_redond_200_c " placeholder="">
                                </div>
                                <div class="grid_2">
                                   <input type="text" id="debe" class="input_redond_100_c "  placeholder="">
                                </div>
                                <div class="grid_2">
                                   <input type="text" id="haber" class="input_redond_100_c "  placeholder="">
                                </div>
                                <div class="grid_4">
                                   <input type="text" id="coment" class="input_redond_200_c "  placeholder="">
                                </div>
                                <div class="grid_4">
                                   <input type="text" id="dim" class="input_redond_200_c "  placeholder="">
                                </div>
                                 <div class="grid_1">
                                  <div class="boton2 centrartexto f10" onclick="add_registros()">cargar</div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="nro_registros" value="1">
                        <div id="datos_dep1">
                            <div class="grid_20 borde_der_c ">
                                <div class="grid_2">
                                    <input type="text" id="codigo" class="input_redond_100_c" placeholder="">
                                </div>
                                <div class="grid_4">
                                    <input type="text" id="descrip" class="input_redond_200_c "  placeholder="">
                                </div>
                                <div class="grid_2">
                                   <input type="text" id="debe" class="input_redond_100_c "  placeholder="">
                                </div>
                                <div class="grid_2">
                                   <input type="text" id="haber" class="input_redond_100_c "  placeholder="">
                                </div>
                                <div class="grid_4 ">
                                   <input type="text" id="coment" class="input_redond_200_c"  placeholder="">
                                </div>
                                <div class="grid_4 ">
                                   <input type="text" id="dim" class="input_redond_200_c "  placeholder="">
                                </div>
                                 <div class="grid_1 ">
                                  <div class="boton2 centrartexto f10" onclick="add_registros()">cargar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                
               
                  <div class="grid_20">
                     <!---<div class="negrilla grid_6 f12">Buscar Cuenta</div>-->
                     <div class="grid_3 espizq10 alin_izq letraChica espder10" style="padding-top: 17px;">
                         Seleccione cuenta
                     </div>
                     <div class="grid_16 esparriba10">
                        <select id="selec_cuenta">
                          <?php echo $datos_cuenta_select ;?> 
                        </select>
                      </div>
                  </div>  
             
                  <div class="grid_20">
                        <div class="grid_3 espizq10 alin_izq letraChica espder10" style="padding-top: 17px;">
                            Escriba la Glosa
                        </div>
                       <div class="grid_10 esparriba10"> 
                           <textarea class="textarea_redond_382x65" type="text" id="comentario" placeholder="" ><?php //echo $comentario; ?></textarea>
                         
                       </div>
                  </div>  
              
        
             <div class="grid_16 esparriba10 espabajo20">
                <div class="grid_3 espizq10 centrartexto" >
                    <div class="boton f10 milink" onclick="guardar_registro_contable()">
                        Guardar
                    </div>
                </div>
                
            </div>
   
        </div>
   

 
    </div> 
</div>



