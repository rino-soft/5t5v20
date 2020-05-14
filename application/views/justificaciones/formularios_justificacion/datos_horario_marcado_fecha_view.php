<div class="grid_7 bordeado1">
    <div class="grid_7 fondoplomoclaro">
        <div class="grid_1 alinearDerecha negrilla">Dia :</div><div class="grid_2"><?php echo $horario_asignado->dia_semana;?></div>
        <div class="grid_1 alinearDerecha negrilla">horario :</div><div class="grid_2"><?php echo $horario_asignado->NOMBRE;?></div>
    </div>
    <div class="grid_7">

        <div class="prefix_1 grid_2 negrilla">Descripcion</div>
        <div class="grid_2 negrilla azulmarino">Horario</div>
        <div class="grid_2 negrilla azulmarino">Marcados</div>

        <div class="grid_1 negrilla"> Manana </div>
        <div class="grid_2"> 
            <div class="grid_2 azulmarino">Ingreso</div>
            <div class="grid_2 azulmarino">Salida</div>  
        </div>
        <div class="grid_2"> 
            <div class="grid_2"><?php if($horario_asignado->Hora_ingreso_ma!="00:00:00") echo $horario_asignado->Hora_ingreso_ma; else echo "---"; ?></div>
            <div class="grid_2"><?php if($horario_asignado->hora_salida_ma!="00:00:00") echo $horario_asignado->hora_salida_ma; else echo "---"; ?></div>  
        </div>
        <div class="grid_2"> 
            <div class="grid_2"><?php echo $marcados[0]['marcado']." , ". $marcados[0]['multa']; ?> </div>
            <div class="grid_2"><?php echo $marcados[1]['marcado']." , ". $marcados[1]['multa'];; ?></div>  
        </div>
        <div class="grid_1 negrilla"> Tarde </div>
        <div class="grid_2"> 
            <div class="grid_2 azulmarino">Ingreso</div>
            <div class="grid_2 azulmarino">Salida</div>  
        </div>
        <div class="grid_2"> 
            <div class="grid_2"><?php if($horario_asignado->hora_ingreso_ta!="00:00:00")  echo $horario_asignado->hora_ingreso_ta; else echo "---"; ?></div>
            <div class="grid_2"><?php  if($horario_asignado->hora_salida_ta!="00:00:00") echo $horario_asignado->hora_salida_ta; else echo "---"; ?></div>  
        </div>
        <div class="grid_2"> 
            <div class="grid_2"><?php echo $marcados[2]['marcado']." , ". $marcados[2]['multa'];; ?> </div>
            <div class="grid_2"><?php echo $marcados[3]['marcado']." , ". $marcados[3]['multa'];; ?> </div>  
        </div>
    </div>
</div>