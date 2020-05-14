<?php
$cod = "";
$tipo = "";
$cate = "";
$nom = "";
$desc = "";
$palbus = "";
$uni_med = "";
$preref = "";
$llave = "";
$respuesta = 0;

if ($id_send != 0) {


    $cod = $d_serv_prod->cod_serv_prod;
    $tipo = $d_serv_prod->tipo;
    $cate = $d_serv_prod->id_categoria;
    $nom = $d_serv_prod->nombre_titulo;
    $desc = $d_serv_prod->descripcion;
    $palbus = $d_serv_prod->palabras_clave;
    $uni_med = $d_serv_prod->unidad_medida;
    $preref = $d_serv_prod->precio_unitario;
    $respuesta = $d_serv_prod->respuesta;
    $llave = "disabled='disabled'";
}
?>

<div class="">

     <div id="respuesta"></div>
    <input id="id_serv" type="hidden" value="<?php echo $id_send; ?>">

    <div class="grid_8 f11 negrilla colorAzul" style="padding-top: 10px"> Categoria:
        <select id="cate"  <?php echo $llave; ?> onchange="codigo_generado('cod','cate');mostrar_subcategoria('cate','subcatecampo');">

            <?php
            foreach ($categoria->result() as $categ) {
                if ($categ->id_categoria == $cate)
                    echo ' <option selected="selected" value="' . $categ->id_categoria . '">' . $categ->nombre . '</option>';

                else
                    echo ' <option value="' . $categ->id_categoria . '">' . $categ->nombre . '</option>';
            }
            ?>

        </select>
    </div> 
	<div class="grid_8 f11 negrilla colorAzul " id="subcatecampo" style="padding-top: 10px"> Subcategoria:
        
    </div>
    <div class="grid_8"> 
        <span class="f11 negrilla colorAzul">Codigo : </span><input class="input_redond_300 " type="text" name="codigo_generado" id="cod" readonly="readonly" placeholder="Codigo autogenerado"value="<?php echo $cod; ?>"/>
        
    </div>

    <div class="grid_8 " >
        <div class="f11 negrilla colorAzul"> <br>Tipo articulo :
            <select id="tipo" onchange="otra_opcion_tipo('otro_tipo');">

                <?php
                foreach ($producto_servi->result() as $vartipo) {
                    if ($vartipo->tipo == $tipo)
                        echo '<option selected="selected" value="' . $vartipo->tipo . '">' . $vartipo->tipo . '</option>';
                    else
                        echo ' <option value="' . $vartipo->tipo . '">' . $vartipo->tipo . '</option>';
                }
                ?>
                <option value="otroo">otro</option>
            </select><span class="f10 ">(servicio/fisico/otro)</span>
        </div>
    </div>
    <div class="grid_8 esparriba5"  id="otro_tipo"></div>

    <div class="grid_8 " >
        <input class="input_redond_370" type="text" id="nom" <?php //echo $rs_llave;?>  placeholder="Escriba nombre del Producto/Servicio" value="<?php echo $nom; ?>" onkeyup="$(this).val($(this).val().toUpperCase());">
        <div class="f11 negrilla colorAzul"> Nombre</div>
    </div>
    <div class="grid_8">
        <div class="grid_5">
            <div class="f11 negrilla colorAzul"> <br> Minima unidad de medida :<br>
                
                <select id="uni_med" onchange="otra_opcion_medida('otra_opcion');">

                    <?php
                    foreach ($unidad_medida->result() as $uni_medida) {
                        if ($uni_medida->nombre_unidad == $uni_med)
                            echo'<option selected="selected" value="' . $uni_medida->nombre_unidad . '">' . $uni_medida->nombre_unidad . '</option>';
                        else
                            echo ' <option value="' . $uni_medida->nombre_unidad . '">' . $uni_medida->nombre_unidad . '</option>';
                    }
                    ?>
                    <option value="otro">Otra Unidad de medida</option>
                </select>
            </div>
             <div class="grid_5  " id="otra_opcion" ></div>
        </div>
        <div class="grid_3">
            <div class="f11 negrilla colorAzul esparriba5">Precio Referencial</div>
            <input class="input_redond_100" type="text" id="preref" <?php //echo $rs_llave;                      ?>  placeholder="Precio referencial" value="<?php echo $preref; ?>">

        </div>

        <!---<div class="grid_3 esparriba20">
            <div class="" style="display: block;float: right" >
                <div class="boton2 alin_cen f12 " onclick=""><?php echo"Adicionar"; ?></div>
            </div> 
        </div>-->
    </div>
    <div class="grid_4">
        <div class="f11 negrilla colorAzul"  >El Articulo contiene campos de Series,y/o numeros unicos? </div>

        SI <input type="radio" name="resp" <?php if($respuesta==1)echo "checked='checked'"; ?> value="1" >
        NO <input type="radio" name="resp" <?php if($respuesta==0)echo "checked='checked'"; ?> value="0"  >

    </div>
   


    <div class="grid_8" style="padding-top: 20px" >
        <textarea  class="textarea_redond_380x37" type="text" id="palbus" <?php ?>  placeholder="Escriba una palabra clave"><?php echo $palbus; ?></textarea>  
        <div class="f11 negrilla colorAzul"> Palabras claves de busqueda</div>
    </div>


    <div class="grid_8 "style="padding-top: 20px" >
        <textarea class="textarea_redond_382x65" type="text" id="desc" placeholder="Escriba una descripción del Producto/Servicio" <?php //echo $rs_llave;                      ?>  placeholder="Escriba una descripción" ><?php echo $desc; ?></textarea>
        <div class="f11 negrilla colorAzul"> Descripción</div>
    </div>

  
    <script>cambios();</script>
</div>
