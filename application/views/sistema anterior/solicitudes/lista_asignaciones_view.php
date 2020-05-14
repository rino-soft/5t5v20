
<h4><?php echo $proyNombre; ?></h4>

<div class="fondoplomoblanco">
    <table border = "0" cellspacing="2" class="letrachica">
        <thead>
            <tr>
                <th class="fondoazul negrilla blanco_text">FECHA</th>
                <th class="fondoazul negrilla blanco_text">NOMBRE</th>
                <th class="fondoazul negrilla blanco_text">PLACA</th>
                <th class="fondoazul negrilla blanco_text">BS</th>
                <th class="fondoazul negrilla blanco_text">OBSERVACIONES</th>
            </tr>
        </thead>
        <tbody>
             <?php
            $p=0;
            foreach ($datos as $registro) {
                $f=$registro->fecha;
                ?>
                <tr>
                    <td class="bordeArriba espaciadochico"><?php echo substr($f,8,2)."/".substr($f,5,2); ?></td> 
                   <td title="ci : <?php echo $ci_s[$p]; ?>" class=" bordeArriba espaciadochico"><label class="milink" onclick="ColocarCIcampo('<?php echo $ci_s[$p]; ?>','<?php echo $registro->NomComp; ?>')"><?php echo $registro->NomComp; ?></label></td>
                    <td class="bordeArriba espaciadochico negrilla"><?php echo $registro->placa; ?></td>
                    <td class="centrartexto bordeArriba espaciadochico negrilla rojo"><?php echo $registro->monto; ?></td>
                    <td class="bordeArriba espaciadochico"><?php echo $registro->observacion; ?></td>
                </tr>
   <?php $p++;} ?>
        </tbody>
    </table>
</div>

