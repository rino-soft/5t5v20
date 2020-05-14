<?php
$registro = $datosHorario->row();
if ($edit == 0)
{
    $id_pk=0;
    $titulo = "Nuevo Horario";
    $tit = '';
    $him = '00';
    $mim = '00';
    $hsm = '00';
    $msm = '00';
    $hit = '00';
    $mit = '00';
    $hst = '00';
    $mst = '00';
    $toleran = '00';
    $coment = '';
} else
{
    $id_pk = $id_horario;
    $titulo = "Editar Horario";
    $tit = $registro->NOMBRE;
    $him = $registro->hora_ing_ma;
    $mim = $registro->min_ing_ma;

    $hsm = $registro->hora_sal_ma;
    $msm = $registro->min_sal_ma;

    $hit = $registro->hora_ing_ta;
    $mit = $registro->min_ing_ta;

    $hst = $registro->hora_sal_ta;
    $mst = $registro->min_sal_ta;

    $coment = $registro->COMENTARIO;
    $toleran = $registro->tolerancia;
}
$horas = array('0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06', '7' => '07', '8' => '08', '9' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23');
$minutos = array('0' => '00', '1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06', '7' => '07', '8' => '08', '9' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23', '24' => '24', '25' => '25', '26' => '26', '27' => '27', '28' => '28', '29' => '29', '30' => '30', '31' => '31', '32' => '32', '33' => '33', '34' => '34', '35' => '35', '36' => '36', '37' => '37', '38' => '38', '39' => '39', '40' => '40', '41' => '41', '42' => '42', '43' => '43', '44' => '44', '45' => '45', '46' => '46', '47' => '47', '48' => '48', '49' => '49', '50' => '50', '51' => '51', '52' => '52', '53' => '53', '54' => '54', '55' => '55', '56' => '56', '57' => '57', '58' => '58', '59' => '59');
?>

<div class="grid_8 suffix_025 fondoplomoblanco bordeado1">
    <div class="grid_8 suffix_025 bordeado1 fondoazul blanco_text negrilla blanco_text esparriba espabajo centrartexto"> 
        <?php echo $titulo; ?>
        <input type="hidden" id="edicion_Horario" value="<?php echo $edit; ?>">
    </div>

    <div class="grid_2 negrilla negrocolor alinearDerecha  esparriba ">Nombre Horario:</div>
    <div class="grid_3  esparriba"> 
        <input type="text" class="textMedio" id="nombreHorario" value="<?php echo $tit; ?>"> 
    </div>
    <div class="grid_8 suffix_025">
        <div class="grid_2  esparriba negrilla negrocolor alinearDerecha">Hora Ingreso Mañana:
            <?php
            //SelectOptions_min_hora($him, $mim); 

            echo form_dropdown('lst_him', $horas, $him, 'id="lst_him"');
            echo'<span class="negrilla letra25">:</span>';
            echo form_dropdown('lst_mim', $minutos, $mim, 'id="lst_mim"');
            ?>     
        </div>    
        <div class="grid_2  esparriba negrilla negrocolor alinearDerecha">Hora Salida Mañana:
            <?php
            echo form_dropdown('lst_hsm', $horas, $hsm, 'id="lst_hsm"');
            echo'<span class="negrilla letra25">:</span>';
            echo form_dropdown('lst_msm', $minutos, $msm, 'id="lst_msm"');
            ?>
        </div>
        <div class="grid_2  esparriba negrilla negrocolor alinearDerecha">Hora Ingreso Tarde:
            <?php
            echo form_dropdown('lst_hit', $horas, $hit, 'id="lst_hit"');
            echo'<span class="negrilla letra25">:</span>';
            echo form_dropdown('lst_mit', $minutos, $mit, 'id="lst_mit"');
            ?>
        </div>
        <div class="grid_2  esparriba negrilla negrocolor alinearDerecha">Hora de Salida Tarde:
            <?php
            echo form_dropdown('lst_hst', $horas, $hst, 'id="lst_hst"');
            echo'<span class="negrilla letra25">:</span>';
            echo form_dropdown('lst_mst', $minutos, $mst, 'id="lst_mst"');
            ?>
        </div>
    </div>    
    <div class="grid_2 esparriba negrilla negrocolor alinearDerecha">Tolerancia Ingreso:</div>
    <div class="grid_5  esparriba"> 
        <?php echo form_dropdown('tolerancia_ingreso', $minutos, $toleran, 'id="tolerancia_ingreso"'); ?>
    </div>
    <div class="grid_2 esparriba negrilla negrocolor alinearDerecha" style="clear:left">Comentario</div>
    <div class="grid_4  esparriba centrartexto"> 
        <textarea style="overflow:auto;" id="txtcomentario" rows="2" cols="38" name="domicilio"><?php echo $coment; ?></textarea>
    </div>
    <div id="btnguardarModif" class="grid_3 centrartexto esparriba" style="float:right">
        <input type="button" value="Guardar" onclick="javascript:guardar_datos_horario(<?php echo $id_pk; ?>);">
    </div>
</div>

<div class="grid_5 bordeado1" id="mensaje">

</div>



