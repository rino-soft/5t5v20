
    <div class="grid_5">LISTA DE DESTINOS</div>
<?php $i=0;
    
    foreach ($destinos_SUV->result() as $Registro) {$i++; ?>
    <div class="grid_5  omega">
        <div class="omega grid_5 esparriba negrilla">
            <img heigth="10" src="<?php echo base_url();?>imagenesweb/icono/trash-empty.png" onclick="javascript:eliminarLugares('<?php echo base_url();?>','<?php echo $Registro->id_L;?>');">
               <?php echo "$i.- ".$Registro->Dep." , ".$Registro->prov.' , '.$Registro->esp ;?>  
        </div>
    <div class="grid_5 omega fondoplomoclaro"><?php echo $Registro->act; ?></div></div>
<?php } ?>