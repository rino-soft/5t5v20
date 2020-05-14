<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="<?php echo base_url(); ?>CSS/style.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>CSS/jquery-ui.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>CSS/erp_sg_v1_0.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>CSS/1000_20_0_0.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>CSS/paula.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>CSS/magali.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>CSS/styles_propios_rrhh.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>CSS/styles_propios.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>CSS/1008.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>CSS/style_sav.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>CSS/esqueleto_.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>CSS/botonesImages.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url(); ?>JS/jquery-1.9.1.js"></script>
   <script src="<?php echo base_url(); ?>JS/erp_sg_v1_0.js"></script>
   
<div class="container_20"><input type="hidden" value="<?php echo base_url(); ?>" id="b_url">
    <div class="grid_20 alin_cen f16 negrilla ">
        KARDEX PRODUCTO
    </div>
    <div class="grid_20 bordeado1">
        <div class="grid_20 ">
            <div class="grid_3 negrilla f10 alin_cen">Codigo  </div>
            <div class="grid_5 negrilla f10 alin_cen">Nombre titulo  </div>
            <div class="grid_5 negrilla f10 alin_cen">Descripcion  </div>
            <div class="grid_3 negrilla f10 alin_cen">id articulo  </div>
            <div class="grid_4 negrilla f10 alin_cen">almacen  </div>
            <div class="grid_3 f12 alin_cen"><?php echo $datos_articulo->cod_serv_prod; ?>  </div>
            <div class="grid_5 f12 "><?php echo $datos_articulo->nombre_titulo; ?>  </div>
            <div class="grid_5 f12 "><?php echo $datos_articulo->descripcion; ?>  </div>
            <div class="grid_3 f12 alin_cen"><?php echo $datos_articulo->id_serv_pro; ?>  </div>
            <div class="grid_4 f12 alin_cen"><?php echo $datos_almacen->row()->nombre; ?>  </div>

        </div>

    </div>
    <div class="grid_20 esparrib10 bordeAbajo"><div class="grid_2 negrilla f12 alin_cen">idmov</div>
        <div class="grid_2 negrilla f12 alin_cen">fecha hora  </div>
        <div class="grid_5 negrilla f12 alin_cen">Descripcion  </div>
        <div class="grid_1 negrilla f12 alin_cen">Cant </div>
        <div class="grid_2 negrilla f12 alin_cen">Mov</div>
        <div class="grid_1 negrilla f12 alin_cen">Ing</div>
        <div class="grid_1 negrilla f12 alin_cen">Ret</div>
        <div class="grid_1 negrilla f12 alin_cen">Saldo</div>

        <div class="grid_2 negrilla f12 alin_cen">comentario</div>
    </div>
    <div class="grid_20">
        <?php
        foreach ($kardex_inf->result() as $dat) {
            ?>
            <div class="grid_20 borde_abajo">
                <div class="grid_2  f12 alin_cen negrilla "><span class="milinktext " onclick="Imp_detalle_movimiento_almacen(<?php echo $dat->id_mov_alm; ?>)"><?php echo "*".$dat->id_mov_alm."*"; ?></span></div>
                <div class="grid_2  f12 alin_cen"><?php echo $dat->fh_registro ?> </div>
                <div class="grid_5  f12 alin_cen"><?php
                    if ($dat->observaciones != "") {
                        echo $dat->observaciones . "<br>";
                    }
                    if ($dat->SN != "" and $dat->cod_prop_sts_equipo != "") {
                        echo "<span class='negrilla'> SN:" . $dat->SN . ", Cod:" . $dat->cod_prop_sts_equipo . " </span> <br>";
                    }
                    echo "Entregado por :" . $dat->nombreComp;
                    ?></div>
                <div class="grid_1  f12 alin_cen"><?php echo $dat->cantidad; ?> </div>
                <?php $estil="verdecolor"; if ($dat->tipo_mov=="Salida") $estil="rojoText";?>
                <div class="grid_2  f14 alin_cen negrilla <?php echo $estil;?>"><?php echo $dat->tipo_mov; ?></div>
                <div class="grid_1  f12 alin_cen"><?php echo $dat->cant_ingreso; ?></div>
                <div class="grid_1  f12 alin_cen"><?php echo $dat->cant_salida; ?></div>
                <div class="grid_1  f14 negrilla  rojoText alin_cen"><?php echo $dat->saldo; ?></div>
                <div class="grid_5  f10 "><?php echo $dat->comentario; ?></div>

            </div>

            <?php
        }
        ?>
    </div>  

</div>

