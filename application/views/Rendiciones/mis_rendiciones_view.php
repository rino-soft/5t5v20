
<!--<script src="<?php echo base_url(); ?>JS/rendiciones_r.js"></script>-->



<div class="col-md-12 col-sm-12 col-xs-12  ">
    <div class="titulo_contenido col-md-8 col-sm-8 col-xs-12"><?php
        echo "$titulo";
        ?>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12">
        Seleccione el Proyecto a filtrar:
        <select class = "form-control col-md-6 col-sm-6 col-xs-12 alin_der " tabindex = "0" id = "id_proyectototal" onchange="filtrar_proyecto_rendiciones('<?= $padre ?>')" >
            <option value = "0">Todos los Proyectos</option>
            <?php
            foreach ($proyectos->result() as $pr) {
                $sel = "";
                if ($pr->id_proy == $proy_selec)
                    $sel = " selected='selected' ";
                echo "<option value='$pr->id_proy' $sel>$pr->nombre ($pr->nombre_contable) </option>";
            }
            ?>

        </select>
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 tile_count">
    <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> <span style="color:red" class="negrilla">Efectivo</span> Caja chica</span>
        <div class="count"><?= 1; //$registros->num_rows()     ?></div>

    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top f16"><i class="fa fa-money"></i> <span style="color:blue" class="negrilla">Transito</span>Caja Chica</span>
        <div class="count green"  id="totalregsitio"><?= number_format(1, 2, ",", "."); ?></div>

    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> <span style="color:red" class="negrilla">Efectivo</span>Fondos a Rendir</span>
        <div class="count aero "><?= number_format(1, 2, ",", "."); ?></div>

    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> <span style="color:blue" class="negrilla">Transito</span>Fondos a Rendir</span>
        <div class="count blue"><?= number_format(1, 2, ",", "."); ?></div>

    </div>

</div>
<div class="x_panel">
    <div class="x_title negrilla f16 bg-green">
        Seleccione una opcion para Rendir
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 ">
        <div class="col-md-6 col-sm-6  col-xs-12 ">
            <div class="x_panel" id="" atyle="color:#FF0000 ">
                <?= $caja_chica ?>
            </div> 
        </div> 
        <div class="col-md-6 col-sm-6  col-xs-12 ">

            <div class="x_panel" id="" atyle="color:#FF0000 ">
                <?= $fondos_rendir ?>
            </div>   

        </div>
    </div>
</div>



<div id="recuperacion"class="ocultar"></div>

<div class="row formulario_nuevo_menu" id="formulario_rendicion">

</div>


<div id="lista_rendiciones"class="f10 row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <spam class='f20 negrilla'>Lista de Rendiciones registradas al sitio </spam> 
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <table id="datatable" data-order='[[0 , "desc" ]]' class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>-</th>
                            <th>proy</th>
                            <th>usuario</th>
                            <th>Fecha Registro</th>
                            <th>tipo_rend</th>
                            <th>Monto</th>
                            <th>estado</th>
                            <th>observaciones</th>

                        </tr>
                    </thead>


                    <tbody class ="f12">
                        <?php
                        $suma_registros = 0;
                        foreach ($registros_rend->result() as $reg) {
                            ?>

                            <tr>
                                <td><?php echo $reg->idreg_ren; ?></td>
                                <td> <a class='btn btn-warning btn-xs' onclick="mostrar_fomrulario_nueva_rendicion_terceros('<?= $reg->idreg_ren ?>')">editar</a><br>
                                <td><?php echo $reg->nombreproy; ?></td>
                                <td><?php echo $reg->nomcompleto; ?></td>
                                <td><?php echo $reg->fh_registro; ?></td>
                                <td><?php echo $reg->tipo_rend; ?></td>
                                <td class='f16 negrilla alin_der'><?php echo number_format($reg->monto, 2, ",", "."); ?></td>

                                <td><?php echo $reg->estado ?></td>
                                <td><?php echo $reg->observacion; ?></td>

                            </tr>

                            <?php
                            $suma_registros+=$reg->monto;
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>



<!--




<div style="display: table; width: 95%">
    <div style="display: table-row">
       
         <div  style="height: 35px ;display: table-cell; padding:5px 5% 5px 5px; float: left">
             
            <div class="boton milink negrilla"  style="float: left; display: table-cell" 
                 onclick="dialog_nuevo_for_rendicion('div_formularios_dialog','<?php // echo // base_url() . "rendiciones/nueva_rendicion/0";           ?>','Nuevo registro de Rendicion/reembolso')">
               Nuevo registro rendicion
            </div>
             <div class="help_rend milink fondo_help" title="Ayuda" style="height: 32px;width: 32px"
                  onclick="ver_archivo('imagenesweb/recursos/mrr_tec.pdf','Información')">
                 
             </div>
             <div class="help_foto milink link f10 negrilla botonResalta" style="height: 30px;width: 150px; float: left; margin: 0 0 0 30px;" title="Ayuda para Reducir fotografias e imagenes" 
                  onclick="ver_archivo('imagenesweb/recursos/FOTOSIZER.rar','Información')"> Programa para reducir imagenes y fotografias
                 
             </div>
         </div>
        
        <div style="display: table-cell;">
            <div style="float:right; display: table-cell; " class="alin_der">
                <input class="fondobuscar300" id="search_rendicion" placeholder="B U S C A R" onkeypress="search_te(event);">
                 <br> Nro de Registros :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1);  search_and_list_mis_rendiciones_te('lista_rendicion');">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="500">500</option>
                </select>
                <input type="hidden" value="1" id="pagina_registros">
            </div>

        </div>
    </div>
   
    
</div>

<div id="lista_rendicion" style="display: block;"></div>
         


<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar container_20" style="height: 300px; width: 400px;">cargando...</div>




<script> search_and_list_mis_rendiciones_te('lista_rendicion');</script>-->
