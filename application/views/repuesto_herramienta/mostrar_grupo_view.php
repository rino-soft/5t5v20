<div class="grid_20">
<div class="fondo_azul colorBlanco colorAmarillo f14 alin_cen negrilla" style="width: 99%; display: block; padding: 5px; ">
     
           PERTENECIENTES AL GRUPO :
         <?php echo $cant_registro->row(0)->id_grupo; ?>
</div>
<div class="fondo_plomo_claro_areas" style="height: 60px" >
          
          <div class="grid_20">
            <div class="" style="height: 80px">   
                <div class="f12 grid_5"style="display: block-inline;  width: 200px; float: left">
                <div style="display: block; "><span class="negrilla  colorGuindo">Codigo</span></div>  
                <div style="display: block; "><span class="negrilla"><?php echo $cant_registro->row(1)->cod_propio; ?></span></div>
                </div>
                <div class="f12 grid_5"style="display: block-inline;  width: 300px; float: left">
                <div style="display: block; "><span class="negrilla  colorGuindo">Nombre</span></div>  
                <div style="display: block; "><span class="negrilla"><?php echo $cant_registro->row(2)->nombre; ?></span></div>
                </div>
                <div class="f12 grid_10" style="display: block-inline; width: 400px; float: left">
                <div style="display: block; "><span class="negrilla  colorGuindo">Descripción</span></div>               
                <div style="display: block; "><span class="negrilla"><?php echo $cant_registro->row(3)->descripcion_grupo; ?></span></div>
                 </div>           
            </div>
          </div> 
    </div> 


<!-- aqui se muestra los titulos generales -->

<div class='fondo_azul div1152 colorAmarillo negrilla borde_abajo borde_arriba borde_der borde_izq espabajo alin_cen ' style="width: 100%;" >
<div class="grid_20">
<div style="clear:both;height: 10px;"></div>

<div class="f12 grid_2"style="display: block-inline;  width: 80px; float: left">
   <div style="display: block; "><span class="negrilla">ID </span></div>             
</div>

<div class="f12 grid_5" style="display: block-inline;  width: 200px; float: left;">
    <div style="display: block; "><span class="negrilla  ">Herramienta</span></div>              
</div>

<div class="f12 grid_3"style="display: block-inline;  width: 100px; float: left">
    <div style="display: block; "><span class="negrilla  ">Cantidad</span></div>  
</div>

<div class="f12 grid_3"style="display: block-inline;  width: 120px; float: left">
    <div style="display: block; "><span class="negrilla  ">Unidad de Medida</span></div>  

</div>
<div class="f12 grid_2"style="display: block-inline;  width: 100px; float: left">
    <div style="display: block; "><span class="negrilla  ">P_N</span></div>  

</div>
<div class="f12 grid_2"style="display: block-inline;  width: 100px; float: left">
    <div style="display: block; "><span class="negrilla   ">S_N</span></div>  

</div>
<div class="f12 grid_3"style="display: block-inline;  width: 150px; float: left">
    <div style="display: block; "><span class="negrilla   ">Tipo</span></div>  

</div>
<div class="f12 grid_3"style="display: block-inline;  width: 100px; float: left">
    <div style="display: block; "><span class="negrilla  ">Precio Unitario</span></div>  

</div>
</div>
</div>


<!-- aqui se muestra los registros con un foreach -->

    <?php foreach ($cant_registro->result() as $reg) { ?>
       
      
            
           
    
          <div class="grid_20 borde_abajo cambiar">
            
             <div class="f12 grid_2 alin_cen" style="display: block-inline;  width: 80px; float: left">  
                <div style="display: block; "><span class="negrilla colorGuindo"><?php if($reg->id_serv_pro!="") echo $reg->id_serv_pro; else echo "&nbsp;"?></span></div>
            </div>
            <div class="f12 grid_5"style="display: block-inline;  width: 200px; float: left"> 
                <div style="display: block; "><span class="negrilla"><?php if($reg->nombre_titulo!="") echo $reg->nombre_titulo;else echo "&nbsp;" ?></span></div>
                <div class="f10" style="display: block; "><span><?php if($reg->descripcion!="") echo $reg->descripcion;else echo "&nbsp;" ?></span></div>
            </div>
            <div class="f12 grid_3 alin_cen"style="display: block-inline;  width: 100px; float: left"> 
                <div style="display: block; "><span class="negrilla"><?php if($reg->cantidad!="") echo $reg->cantidad; else echo "&nbsp;"?></span></div>
            </div>
            <div class="f12 grid_3 alin_cen"style="display: block-inline;  width: 120px; float: left"> 
                <div style="display: block; "><span class="negrilla"><?php if($reg->unidad_medida!="") echo $reg->unidad_medida; else echo "&nbsp;"?></span></div>
            </div>
            <div class="f12 grid_2 alin_cen"style="display: block-inline;  width: 100px; float: left"> 
                <div style="display: block; "><span class="negrilla"><?php if($reg->P_N!="") echo $reg->P_N; else echo "&nbsp;"?></span></div>
            </div>
            <div class="f12 grid_2 alin_cen"style="display: block-inline;  width: 100px; float: left">  
                <div style="display: block; "><span class="negrilla"><?php if($reg->S_N!="") echo $reg->S_N; else echo "&nbsp;"?></span></div>
            </div>
            <div class="f12 grid_3 alin_cen"style="display: block-inline;  width: 150px; float: left"> 
                <div style="display: block; "><span class="negrilla"><?php if($reg->tipo!="") echo $reg->tipo; else echo "&nbsp;" ?></span></div>
            </div>
               <div class="f12 grid_3 alin_cen"style="display: block-inline;  width: 100px; float: left"> 
                <div style="display: block; "><span class="negrilla"><?php if($reg->precio_unitario!="") echo $reg->precio_unitario; else echo "&nbsp;" ?></span></div>
            </div>
       </div>
 


</div>

    

    <?php } ?>


      