<div class="f12 container_20" style="width: 95% ">
<?php if ($asignaciones->num_rows() > 0) { ?>
    
    <?php foreach ($asignaciones->result() as $reg) { ?>
        <div class='grid_20  borde_abajo  cambio_fondo esparriba10 alin_izq f11 ' style="width: 100%"  >
                <div class="" style="display: block-inline;width: 40%;float: left ">
                    <span class="colorRojo negrilla"> ID : <span class=" f14"><?php echo $reg->id_mov_alm; ?></span></span><br>
                    <span class="colorAzul"> Almacen : </span><span class=""><?php if($reg->nombre != "") echo $reg->nombre; else echo "&nbsp;"; ?></span><br>
                    <span class="colorAzul"> Fecha-Hora Registro : </span><span class=""><?php echo $reg->fh_reg; ?></span><br>
                    <span class="colorAzul"> Comentario : </span><span class=""><?php if ($reg->comentario != "") echo $reg->comentario;else echo " &nbsp;" ?></span><br>
                    <span class="colorGuindo"> Estado : </span><span class="colorVerde_claro"><?php if ($reg->estado != "") echo $reg->estado;else echo " &nbsp;" ?></span><br>
                </div>
                <div class="" style="display: block-inline;width: 40%;float: left ">
                    <span class="colorverde negrilla f12 alin_cen">Detalles de Asignacion</span><br>
                    <span class="f10" style="display: block-inline;width: 40%;float: left; ">
                      <?php $detalle=$detalle_mat_asignados[$reg->id_mov_alm];
                            if($detalle->num_rows()>0){
                                foreach ($detalle->result()as $dato){
                                    
                                 ?>
                                  <?php 
                                  $fondo_amarillo='';
                                    if($dato->respuesta=='1'){
                                        $fondo_amarillo='fondoAmarillo_estado';  
                                           ?>
                                   <div class=" grid_11 alin_izq <?php echo $fondo_amarillo ;?>" > 
                                       <span class="f12  alin_izq colorGuindo negrilla" ><?php if ($dato->id_articulo != "") echo $dato->id_articulo;else echo " &nbsp;" ?>;</span>
                                       <span class="f10 colorAzul" ><?php if ($dato->cod_serv_prod != "") echo $dato->cod_serv_prod;else echo " &nbsp;" ?>;</span>
                                       <span class="f10 colorAzul" ><?php if ($dato->nombre_titulo != "") echo $dato->nombre_titulo;else echo " &nbsp;" ?>--</span>
                                       <span class="f10 colorAzul" ><span class="colorcel">Cantidad : </span><?php if ($dato->cantidad != "") echo $dato->cantidad;else echo " &nbsp;" ?></span><br>
                                       <span class="f10 colorAzul" ><?php if ($dato->SN != "") echo '<span class="colorcel">Serial : </span>'.$dato->SN;else echo " &nbsp;" ?></span>
                                       <span class="f10 colorAzul" ><?php if ($dato->cod_prop_sts_equipo != "") echo '<span class="colorcel">Codigo propio STS : </span>'.$dato->cod_prop_sts_equipo;else echo " No tiene seriales" ?></span>
                                   </div>
                                   <?php   }else { ?>
                                      <div class=" grid_11 alin_izq " > 
                                       <span class="f12  alin_izq colorGuindo negrilla" ><?php if ($dato->id_articulo != "") echo $dato->id_articulo;else echo " &nbsp;" ?>;</span>
                                       <span class="f10 colorAzul " ><?php if ($dato->cod_serv_prod != "") echo $dato->cod_serv_prod;else echo " &nbsp;" ?>;</span>
                                       <span class="f10 colorAzul" ><?php if ($dato->nombre_titulo != "") echo $dato->nombre_titulo;else echo " &nbsp;" ?>--</span>
                                       <span class="f10 colorAzul" ><span class="colorcel">Cantidad : </span><?php if ($dato->cantidad != "") echo $dato->cantidad;else echo " &nbsp;" ?></span><br>                    
                                   </div>    
                               <?php } 
                                }
                            }
                            else{
                                echo 'No tiene asignaciones';
                            }
                       ?>
                     </span>
                </div>
                <div style="width: 10%;float: left; " class=" espabajo5">
		         <div style="width: 110px; float: right;">
						<div class="boton2 f12 negrilla" onclick="dialog_devolucion_material('div_formularios_dialog','<?php echo base_url() . "devolucion_material/solicitud_devolucion_listado/$reg->id_mov_alm/".$sol_dev[$reg->id_mov_alm]; ?> ')"><?php echo "Devoluciones"; ?></div>  
			 </div>   
	        </div> 
        </div>
    <?php } ?> 
       <div>
            <input type="hidden" value="1" id="pagina">    
            <input type="hidden" value="0" id="cant_item" >

        </div>
     </div>
    <?php
}else {
    echo 'no se encontro ningun registro';
}
?>
    
    <!---
    <div class="fondo_azul colorAmarillo borde_abajo borde_arriba  negrilla f11 alin_cen negrilla" style="display: block-inline;float: left ; width: 100%; height: ">   
            <div class="" style="display: block-inline;width: 5%;float: left ">
                <span> ID</span><br>
              
            </div>
            <div class="" style="display: block-inline;width: 15%;float: left ">Almacen</div>
            <div class="" style="display: block-inline;width: 10%;float: left ">Fecha - Hora</div>
            <div class="" style="display: block-inline;width: 20%;float: left ">Comentario</div>
            <div class="" style="display: block-inline;width: 9%;float: left ">Estado</div>               
            <div class="" style="display: block-inline;width: 30%;float: left ">Detalles de asignaciones</div>               
     </div>
    
    
    

        <?php /*foreach ($asignaciones->result() as $reg) { ?>
            <div class='grid_20  borde_abajo  cambio_fondo esparriba10 alin_cen' style="width: 100%"  >
                
                <div class="f14 colorRojo negrilla  " style="display: block-inline;width: 5%;float: left; "><?php echo $reg->id_mov_alm; ?></div>
	        
                <div class="f12 alin_izq " style="display: block-inline;width: 15%;float: left; "><?php if($reg->nombre != "") echo $reg->nombre; else echo "&nbsp;"; ?></div>
                
                <div class="f12  " style="display: block-inline;width: 10%;float: left; "><?php echo $reg->fh_reg; ?></div>
                
                <div class="f12 alin_izq " style="display: block-inline;width: 20%;float: left; "><?php if ($reg->comentario != "") echo $reg->comentario;else echo " &nbsp;" ?></div>
               
                <div class="f12 colorVerde_claro  " style="display: block-inline;width: 9%;float: left; "><?php if ($reg->estado != "") echo $reg->estado;else echo " &nbsp;" ?></div>
                
                <div class="f10" style="display: block-inline;width: 10%;float: left; ">
               <?php $detalle=$detalle_mat_asignados[$reg->id_mov_alm];
                     if($detalle->num_rows()>0){
                         foreach ($detalle->result()as $dato){
                          ?>
                            <div class="grid_8 alin_izq"> 
                                <span class="f11 colorRojo " ><?php if ($dato->cod_serv_prod != "") echo $dato->cod_serv_prod;else echo " &nbsp;" ?>;</span>
                                <span class="f10 colorAzul" ><?php if ($dato->nombre_titulo != "") echo $dato->nombre_titulo;else echo " &nbsp;" ?></span>
                                <span class="f10 colorAzul" ><?php if ($dato->nombre_titulo != "") echo $dato->nombre_titulo;else echo " &nbsp;" ?></span>
                            </div>
                              <?php   
                         }
                     }
                     else{
                         echo 'falso';
                     }
                ?>
                </div>
                
                
                <div style="width: 30%;float: left; " class=" espabajo5">
					
					<div style="width: 110px; float: right;">
						<div class="boton2 f12 negrilla" onclick="dialog_devolucion_material('div_formularios_dialog','<?php echo base_url() . "devolucion_material/solicitud_devolucion_listado/$reg->id_mov_alm/".$sol_dev[$reg->id_mov_alm]; ?> ')"><?php echo "Devoluciones"; ?></div>  
					</div>   
	        </div>  
            </div>
               
       
    <?php } ?> <div>
            <input type="hidden" value="1" id="pagina">    
            <input type="hidden" value="0" id="cant_item" >

        </div>
    </div>
    <?php
}else {
    echo 'no se encontro ningun registro';
}
?>--->