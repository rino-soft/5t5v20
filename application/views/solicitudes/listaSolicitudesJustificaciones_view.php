<!--<div class="grid_12  "><h2>Solicitudes de uso vehicular </h2></div>-->
<!-- <input type="button" onclick="javascript:cargarMisSolicitudes();">-->
<div class="grid_12 " id="BusquedaSolicitud"> 
    <div class="grid_12 fondoazul blanco_text">
        <div class="grid_1">&nbsp;</div>
        <div class=" grid_1 centrartexto negrilla omega blanco_text fondoazul"> Fecha Solicitud  </div>
        <div class="grid_05 centrartexto negrilla"> Nro </div>
        <div class="grid_6 suffix_05 negrilla blanco_text fondoazul"> Descripcion  </div>
        <div class="grid_3 negrilla blanco_text fondoazul centrartexto"> Estado </div>
    </div>
    <div class="clear"></div>
    <?php
    $i = 0;
    //$matriz = $this->basicauth->datosSession();
    foreach ($mostrar_datos->result() as $Registro) {
        $i++;
        $eestilo = "";
        $onclick = "tomarAcciones('" . base_url() . "', $i,'$Registro->id_jus')";
        $clase = "tomaraccion ";
        $titulo = "Tomar Accion";
        $comentario = "Apropiarse de las solicitudes de los dependientes";

        if ($Registro->id_user_destino == $this->session->userdata('id_admin')) {
            $onclick = "verSolicitud('" . base_url() . "', $i,'$Registro->id_jus');";
            $clase = 'verSolicitud';
            $titulo = 'Ver Solicitud';
            $comentario = "Leer la Solicitud enviada";
            //$eestilo = $eestilo . ' milink ';

            if ($Registro->estado == "Enviado") {
                $eestilo = "negrilla fondoplomoclaro ";
            }

            if ($Registro->estado == "Rechazado") {
                $eestilo = "fondo_rojo_claro";
            }
            if ($Registro->estado == "Aceptado") {
                $eestilo = "fondo_verde_claro";
            }
            
        } else {
            if ($Registro->estado == "Enviado" or $Registro->estado == "Leido") {
                $eestilo = " letramuyChica fondo_amarillo_claro ";
            }

            if ($Registro->estado == "Rechazado") {
                $eestilo = " letramuyChica fondo_rojo_claro";
                 $onclick = "verSolicitud('" . base_url() . "', $i,'$Registro->id_jus');";
            $clase = 'verSolicitud';
            $titulo = 'Ver Solicitud';
            $comentario = "Ver la Solicitud";
            }

            if ($Registro->estado == "Aceptado") {
                $eestilo = " letramuyChica fondo_verde_claro";
                $onclick = "verSolicitud('" . base_url() . "', $i,'$Registro->id_jus');";
            $clase = 'verSolicitud';
            $titulo = 'Ver Solicitud';
            $comentario = "Ver la Solicitud";
            }
        }
        ?>
        <div id="contenidotitulo<?php echo $i; ?>" class="filas negrocolor grid_12  <?php echo $eestilo; ?>" 
             >   
            <div class=" grid_1 letrachica controles link milink">
                <div class="<?php echo $clase ?> " onclick="<?php echo $onclick; ?>" title="<?php echo $comentario; ?>"> <?php echo $titulo; ?></div>

            </div>
            <div class="grid_1 centrartexto"><?php echo $Registro->fecha_elaborado; ?></div>
            <div class="grid_05 centrartexto negrilla"><?php echo $Registro->id_jus; ?></div>
            <div class="grid_6 suffix_05 ">
    <?php echo "<span class='azulmarino'>" . $Registro->nombre . " " . $Registro->ap_paterno . " .- </span>" . $Registro->tipo; ?> ( <?php echo $Registro->titulo_jp . ""; ?>)</div>
            <div class="grid_3 centrartexto" id="Div_estado<?php echo $i; ?>"> <?php echo $Registro->estado . '<br><span class="letramuyChica"> Ultimo Historial Ej. leido por XXX</span>'; ?></div>
            <script>actualizar_estado(<?php echo $i ?>,<?php echo $Registro->id_jus ?>); </script>
        </div>
        <div class="grid_12 contenidoJustificacion oculto" id="contenido<?php echo $i; ?>"></div>
        <div class="clear"></div>

<?php } ?>
</div>
<div id="confirmacion_tomaraaciones" class="container_12 oculto">
    <div class="atencionimage"></div> <div class="grid_4 centrartexto mensaje">Esta Seguro que desea tomar accion de esta Solicitud que fue enviada a uno de sus Dependientes</div>
</div>
<div id="confirmacion_Aceptar" class="container_12 oculto">
    <div class="atencionimage"></div> <div class="grid_4 centrartexto mensaje">Esta Seguro que desea Aceptar esta Solicitud </div>
</div>
<div id="confirmacion_Rechazar" class="container_12 oculto">
    <div class="atencionimage"></div> <div class="grid_4 centrartexto mensaje">Esta Seguro que desea Rechazar esta Solicitud </div>
</div>

