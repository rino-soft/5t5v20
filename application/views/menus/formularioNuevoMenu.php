<?php
if ($ind == 0) {
    $t = "Nuevo Menu";
    $tit = "";
    $cont = "";
    $meto ="";
    $pa = "";
    $act = "";
} else {
    $t = "Editar menu";
    $tit = $menu_datos->titulo;
    $cont = $menu_datos->controlador;
    $meto = $menu_datos->metodo;
    $pa = $menu_datos->padre;
    $act = $menu_datos->estado;
}
?>

<ol><li><div class="grid_4 fondoplomoblanco bordeado1">
            <div class="grid_4 fondoazul blanco_text negrilla blanco_text esparriba espabajo centrartexto"> <?php echo $t; ?> <input type="hidden" id="adicion_edicion_menu" value="<?php echo $ind; ?>"></div>
            <div class="grid_1 negrilla negrocolor alinearDerecha  esparriba ">Titulo:</div>
            <div class="grid_3  esparriba"> 
                <input type="text" class="textMedio" id="titulomenu" value="<?php echo $tit; ?>"> 
            </div>
            <div class="grid_1  esparriba negrilla negrocolor alinearDerecha">Controlador:</div>
            <div class="grid_3  esparriba"> 
                <input type="text" class="textMedio" id="controladormenu" value="<?php echo $cont; ?>">
            </div>
            <div class="grid_4 letrachica azulmarino centrartexto">Si el MENU es padre no llene este Campo</div>
            <div class="grid_1  esparriba negrilla negrocolor alinearDerecha">Metodo:</div>
            <div class="grid_3  esparriba"> 
                <input type="text" class="textMedio" id="metodomenu" value="<?php echo $meto; ?>" >
            </div>
            <div class="grid_4 letrachica azulmarino centrartexto">Si el MENU es padre no llene este Campo</div>
            <div class="grid_1  esparriba negrilla negrocolor alinearDerecha">Depende de:</div>
            <div class="grid_3  esparriba"> 
                <select id="padremenu">
                    <option value="">seleccione un padre</option>
                    <option value="0" <?php  if($pa==0) echo 'selected'; ?>>Este MENU es PADRE</option>
<?php
foreach ($padreslista as $padres) {
    if($pa==$padres->id)
        echo "<option value='$padres->id' selected>$padres->titulo</option>";
    else
        echo "<option value='$padres->id' >$padres->titulo</option>";
}
?>
                </select> </div>

            <div class="grid_1 esparriba negrilla negrocolor alinearDerecha">Estado</div>
            <div class="grid_3 esparriba"> <select id="estadomenu">
                    <option value="Activo" <?php  if($act=="activo") echo 'selected'; ?>>Activo</option>
                    <option value="Inactivo" <?php  if($act=='inactivo') echo 'selected'; ?>>Inactivo</option>

                </select> </div>
            <div class="grid_4 centrartexto esparriba"><input type="button" value="Guardar" onclick="javascript:adicionar_editar_menu();" ></div>



        </div>
    </li></ol>



