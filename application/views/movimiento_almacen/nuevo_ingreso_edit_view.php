<html>
    <head>
       <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
       
        <script type="text/javascript">
            //función encargada de procesar la solicitud al pulsar el botón pasar_edicion
            function saltar(id_mov_alm){
                $("#editar").load("movimiento_almacen/mostrar_datos_ingreso", { id_mov_alm: id_mov_alm });
                $("#editar").fadeIn('2000');
            }
        </script>
    </head>
 
    <body>
        <table>
            <tr>
                <th>fh Registro</th>
                <th>Tipo Movimiento</th>
                <th>Proyecto</th>
                <th>Comentario</th>
                <th>Tipo Documento Origen</th>
                <th>Documento Respaldo</th>
            </tr>
            <?php
            foreach ($movimiento_almacen as $fila):
                $id_mov_alm = $fila->id_mov_alm;
                //creamos el botón que debe colocar los datos dentro de los campos
                //del formulario que se creará con la función saltar($id) que le pasamos
                //la id del mensaje
                $boton = array(
                    'name' => 'pasar_edicion',
                    'id_mov_alm' => 'pasar_edicion',
                    'onclick' =>'saltar($id_mov_alm)'
                );
                ?>
                <tr>
                    <td><?= $fila->fh_reg ?></td>
                    <td><?= $fila->tipo_movimiento ?></td>
                    <td><?= $fila->proyecto ?></td>
                    <td><?= $fila->comentario ?></td>
                    <td><?= $fila->tipo_doc_origen ?></td>
                    <td><?= $fila->doc_respaldo ?></td>
                    <td><?= form_button($boton, 'Editar') ?></td>
                    
                   
            
                    
                </tr>
                <?php
            endforeach;
            ?>
            <?php
            //si se hace la actualización mostramos el mensaje que contiene
            //la sesión flashdata actualizado que hemos creado en el controlado
            $actualizar = $this->session->flashdata('actualizado');
            if ($actualizar) {
                ?>
                <tr>
                    <td colspan="5" id="actualizadoCorrectamente"><?= $actualizar ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <div id="editar">            
        </div>
    </body>
</html>

<script>cambios_form();</script>