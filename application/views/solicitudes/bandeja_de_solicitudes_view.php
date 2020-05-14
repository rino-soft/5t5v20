

<div class="container_12">
<input type="hidden" value="<?php echo base_url(); ?>" id="burl">
<div class="prefix_05 grid_10 esparriba"><h5>SOLICITUDES DE PERMISO,JUSTIFICACIONES DE MARCADO, VACACIONES y BAJAS MEDICAS</h5></div>
<div class="grid_7">
    <fieldset class="fieldset_mod">
        <legend>Opciones de busqueda</legend>
        <div class="grid_7">ver autorizaciones y solicitudes de mis dependientes <input type="checkbox" id="dep" onclick="cargar_solicitudes_justificaciones();"></div>
        <div class=" grid_7 oculto" id="masconfiguraciones">
            <div class="grid_1 negrilla alinearDerecha letrachica negrocolor">mostrar :</div>
            <div class="grid_6 letrachica negrocolor"> Justificaciones<input type="checkbox" checked="true" id="jus">
                Vacaciones o permisos a c/vacacion<input type="checkbox" checked="true" id="vac">
                Bajas Medicas<input type="checkbox" checked="true" id="baj">
                Licencias<input type="checkbox" checked="true" id="lic">
            </div>
            <div class="grid_1 negrilla alinearDerecha letrachica negrocolor">estados :</div>
            <div class="grid_6 letrachica negrocolor"Enviados<input type="checkbox" checked="true" id="env">
                Leidos<input type="checkbox" checked="true" id="lei">
                Aceptados<input type="checkbox" checked="true" id="ace">
                Autorizados<input type="checkbox" checked="true" id="aut">
                Rechazados<input type="checkbox" checked="true" id="rec">

            </div>
        </div>
        <div class="class_7 letramuyChica alinearDerecha negrilla "> 
            <span class="milink link oculto" id="menosconf" onclick="$('#masconfiguraciones').css({'display':'none'});
                  $('#menosconf').css({'display':'none'});$('#masconf').css({'display':'block'}); $('#masconfiguraciones :checkbox').prop('checked', true);">
                opciones por defecto
            </span>
            <span class="milink link" id="masconf" onclick="$('#masconfiguraciones').css({'display':'block'});$('#menosconf').css({'display':'block'});$('#masconf').css({'display':'none'});">
                mas opciones
            </span>
        </div>
    </fieldset>

</div>
<div class="grid_5 alinearDerecha"> <div class="grid_5 esparriba espderecha">
        <input type="text" class="fondobuscar" id="quebuscar" onkeypress="letras(event)" >
        <input type="button" class="botonbuscar" value="Buscar" onclick="">
    </div>
</div>
<!--<div class="grid_11 alinearDerecha"> 1 , 2 , 3 , 4 , 5 , 6 , 7 , 8 , 9 , 10 </div>todavia no!!!! -->
<div class="grid_10" id="div_lista_justificaciones">
    Cargando...
</div>
<script type="text/javascript"> cargar_solicitudes_justificaciones();</script>
</div>