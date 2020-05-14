
<div class="titulo_contenido"><?php
echo "$titulo";
?></div>

<!--Adicionando para la parte grafica--->



<!---//probandooo --->
<nav id="menu_gral" class="f10 ">
    <ul>
        <li ><a href="#">Datos Estadisticos</a>
            <ul>
                <li>
                <!---<div class="estadistica milink"  onclick="ver_archivo('generar_grafica_estadisticas/estadistica','Asignación por departamento')">Asignación por departamento</div>-->
                </li><li>  <div class="estadistica milink "  onclick="ver_archivo('generar_grafica_estadisticas/asignacion_proyecto','Asignación por Proyecto')">Asignación por Proyecto</div>
                </li><li>  <div class="estadistica milink"  onclick="ver_archivo('generar_grafica_estadisticas/alquilado_propio','Vehículos Alquilados/Propios')">Vehículos Alquilados/Propios</div>
                </li><li>  <div  class="esta_curvas milink" onclick="ver_archivo('generar_grafica_estadisticas/vehiculos_alqui_prop/0/0','Vehículos Alquilados/Propios cronograma')">Alquilado/Propio/empresa</div>
                </li><li>  <div  class="estadistica milink" onclick="ver_archivo('generar_grafica_estadisticas/asig_proyecto_alquilado_propio','AsignacionProyecto/propio-alquilado')">Por proyecto/ propio-alquilado</div>
                </li><li>  <div  class="estadistica milink" onclick="ver_archivo('generar_grafica_estadisticas/asig_depar_por_proyecto','AsignacionDepart/por Proyecto')">Por Departamento/ por Proyecto</div>
                </li><li>  <div  class="reporte_vehiculo milink" onclick="Imp_asignacion_de_vehiculos_proyecto()">Reporte Vehiculos por Proyecto</div>
                </li><li>  <div  class="reporte_vehiculo milink" onclick="Imp_asignacion_de_vehiculos_proyecto_2()">Reporte Vehiculos por Proyecto excel</div>
                </li>

            </ul>
        </li>
    </ul>
</nav>


<!----//comienza otra vista--->


<div style="display: table; width: 95%">
    <div style="display: table-row">
         <div style="display: table-cell;">
        <div  style="height: 35px ;display: table-cell; padding:5px 5% 5px 5px; float: left">

            <div class="boton milink"  style="float: left; display: table-cell" 
                 onclick="dialog_nuevo_vehiculo_adicionar('div_formularios_dialog','<?php echo base_url() . "vehiculo/adicionar_nuevo_vehiculo/0/0"; ?>','Adicionar nuevo vehiculo')">
                Adicionar nuevo vehículo
            </div>
            

        </div></div>
        <div style="display: table-cell;">
        <div style="float:right; display: table-cell; " class="alin_der">
            <input class="fondobuscar300" id="search_ov_pf" placeholder="B U S C A R  V E H I C U L O" onkeypress="search_vn(event);">
           
        </div>

    </div>
    </div>

</div>
<div class=" f12"style="width: 1150px; margin-left: 15px;">
     <div class="fondo_plomo_claro_areas"  style="display: table-cell;width: 575px">
      <div class="negrilla colorAzul alin_cen"></div> 
      <div class="negrilla colorAzul">Total vehiculos : <span class="colorGuindo" id="t_vehi"></span></div> 
      <div class="negrilla colorAzul">Total Alquilados : <span class="colorGuindo" id="t_alq"></span></div> 
      <div class="negrilla colorAzul">Total Propios : <span class="colorGuindo" id="t_pro"></span></div> 
      <div class="negrilla colorAzul">Total Activos Propios : <span class="colorGuindo" id="t_act_pro"></span></div> 
      <div class="negrilla colorAzul">Total Inactivos Propios :<span class="colorGuindo" id="t_inac_pro"></span></div> 
    </div>
    <div class="fondo_verde_cla OK" style="display: table-cell; padding-left: 15px;width: 575px" >
        <div class="negrilla colorAzul alin_cen"></div> 
        <div class="negrilla colorAzul ">Cantidad de vehiculos buenos : <span class="colorGuindo" id="t_bueno"></span></div> 
        <div class="negrilla colorAzul ">Cantidad de vehiculos regulares :<span class="colorGuindo" id="t_reg"></span></div> 
        <div class="negrilla colorAzul ">Cantidad de vehiculos pesimos :<span class="colorGuindo" id="t_pesi"></span></div> 
    </div>
</div>

<div id="lista_vehiculo" style="display: block;"></div>

<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar container_20" style="height: 300px; width: 400px;">cargando...</div>

<script> search_and_list_vehiculo('lista_vehiculo');</script>

