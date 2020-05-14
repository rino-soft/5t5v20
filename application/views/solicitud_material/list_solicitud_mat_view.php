<div style="display: table; width: 95%">
    
    <div style="display: table-row">
        <div style="display: block;">Solicitudes de Materiales</div>
        <div class='div1150 fondo_plomo borde_abajo borde_arriba borde_der borde_izq espabajo alin_cen ' >         
            <div class="f12" style="display: block-inline;width: 80px;float: left ">
                <div style="display: block; ">
                    Estado:
                </div>               
            </div>

        </div>
        <div>
           
            <?php foreach ($consul1->result() as $reg) { ?>
                <div class='div1150_1 borde_abajo  cambio_fondo esparriba10 alin_cen' >
                    <div class="f12  " style="display: block-inline;width: 80px;float: left; ">
                        <div style="display: block; ">
                            <?php echo $reg->estado; ?>
                        </div>               
                    </div>

                    <div style="display: block-inline; width: 100px; float: left; " >               
                        <div style="display: block; ">
                            <div class="boton2 f12" onclick="dialog_nuevo_solicitud_mat('detalles_movimiento_entrega_material','<?php echo base_url() . "solicitud_material/entregar_sol_mat/$reg->id_solicitud_mat"; ?> ')"><?php echo "Entregar"; ?></div>                                                                
                        </div> 
                    </div>
                </div>
            </div>         
        <div>
                <input type="hidden" value="1" id="pagina">    
                <input type="hidden" value="0" id="cant_item" >
                
        </div>
        <?php } ?>
    </div>
</div>

