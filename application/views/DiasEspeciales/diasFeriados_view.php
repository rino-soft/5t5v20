<div class="grid_7">
    <?php
    $i = 0;
    $estilo="";
    foreach ($fechas as $fila)
    {
        $i++;
        if($estilo!="")
            $estilo="";
        else
            $estilo="fondoplomoblanco";
        ?>
    <div class="grid_7 filas <?php echo $estilo; ?>">
        <div class="grid_05 centrartexto"> <?php echo $i; ?>.-</div>
        <div class="grid_3"> <?php echo $fila->nombre; ?></div>
        <div class="grid_1"> <?php echo $fila->fecha; ?></div>
        <div class="grid_1"> <?php echo $fila->region; ?></div>
        <div class="grid_05"> <?php echo $fila->tipo; ?> h</div>
        <div class="grid_05 milinktext negrilla negrocolor">Borrar</div>
        
        
        </div>
        <?php
    }
    ?>
</div>