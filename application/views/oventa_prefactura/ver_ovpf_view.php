
<div class="container_20">
    <div class="grid_20">



        <div class="grid_20 fondo_plomo_claro_areas">
            <div class="grid_15">
                <div class="grid_15">
                    <div class="grid_10 f10 colorAzul">ususario</div>
                    <div class="grid_5 f10 colorAzul">fecha y hora de registro</div>
                </div>
                <div class="grid_15">
                    <div class="grid_10 f12 negrilla"><?php echo $datos_ovpf->ap_paterno . " " . $datos_ovpf->ap_materno . ", " . $datos_ovpf->nombre; ?></div>
                    <div class="grid_5 f12 negrilla"><?php echo $datos_ovpf->fh_registro; ?></div>
                </div>
            </div>
            <div class="grid_5  fondo_amarillo">
                <div class="grid_5 alin_cen f10 colorAzul">id orden de venta / prefactura</div>
                <div class="grid_5 f20 colorRojo negrilla alin_cen "><?php echo $datos_ovpf->id_ovpf; ?></div>

            </div>
            <div class="clear"></div>
            <div class="grid_20">
                <div class="grid_20">
                    <div class="grid_15 f10 colorAzul">cliente</div>
                    <div class="grid_5 f10 colorAzul fondo_amarillo alin_cen">NIT</div>
                </div>
                <div class="grid_20">
                    <div class="grid_15">
                    <div class="grid_15 f12 negrilla">
                        <?php echo $datos_ovpf->razon_social; ?>
                    </div>
                    <div class="grid_15 f10">
                        <?php echo "Telefonos:".$datos_ovpf->telefonos; ?>
                    </div>
                    <div class="grid_15 f10">
                        <?php echo "Direccion:".$datos_ovpf->direccion; ?>
                    </div>
                        
                    </div>
                    <div class="grid_5 f20 colorAzul negrilla alin_cen fondo_amarillo "><?php echo $datos_ovpf->nit; ?></div>
                </div>
            </div>
                
        </div>

        <div class="grid_20 f12 negrilla colorRojo"> Detalle de orden de venta / prefactura</div>

        <div class="grid_20">
            <div class="grid_20 fondo_azul colorBlanco negrilla f10 alin_cen">
                <div class="grid_1">Item</div>
                <div class="grid_6">Cod/Nombre/descripcion</div>
                <div class="grid_5">Comentario</div>
                <div class="grid_2">Precio Unitario</div>
                <div class="grid_2">Cantidad</div>
                <div class="grid_2">unidad de Medida</div>
                <div class="grid_2">Subtotal BS</div>            
            </div>
            <?php
            foreach ($detalle_ovpf->result() as $det) {
                ?>
                <div class="grid_20 borde_abajo f10">
                    <div class="grid_1 alin_cen"><?php echo $det->item; ?></div>
                    <div class="grid_6"><?php echo "<span class='negrilla colorRojo'>" . $det->cod_ps . "</span> / <span class='negrilla colorAzul'>" . $det->titulo_ps . "</span> / " . $det->desc_ps; ?></div>
                    <div class="grid_5"><?php if ($det->comentario != "") echo $det->comentario;else echo "-"; ?></div>
                    <div class="grid_2 alin_cen"><?php echo $det->precio_u_ps; ?></div>
                    <div class="grid_2 alin_cen"><?php echo $det->cantidad_ps; ?></div>
                    <div class="grid_2 alin_cen"><?php echo "GLB"; ?></div>
                    <div class="grid_2 alin_der negrilla colorRojo"><?php echo $det->importe_bs; ?></div>


                </div>

                <?php
            }
            ?>
            <div class="grid_20 borde_arriba fondo_amarillo negrilla">
                <div class="grid_17 alin_der ">TOTAL Bs.- </div>
                <div class="grid_3 alin_der "><?php echo $datos_ovpf->monto_total; ?></div>

            </div>
        </div>
        <div class="grid_20">
            <div class="grid_20 negrilla colorRojo">Comentario:  </div>
            <div class="grid_20 f12">
                <?php echo $datos_ovpf->comentario; ?>
            </div>
            
        </div>




