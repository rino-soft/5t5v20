
<div class="titulo_contenido"><?php
echo "$titulo";
?></div>


<div style="display: table; width: 95%">
    <div style="display: table-row">

        <div style="display: table-cell;">
            <div style="" class="alin_izq">
                <input class="fondobuscar300 alin_izq" id="search_prod_kardex" placeholder="B U S C A R  A R T I C U L O" onkeypress="search_kardex(event);">
                <br> Nro de Registros :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1); search_and_list_prod_kardex('lista_serv_prod');">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="500">500</option>
                </select>
                <input type="hidden" value="1" id="pagina_registros">
            </div>
        </div>
        
        <div style="display: table-cell; " class="alin_izq">
                Almacen:<select id="id_almacen" onchange="$('#pagina_registros').val(1); search_and_list_prod_kardex('lista_serv_prod');" ><option value="0">Todos...</option>
                    <?php
                    foreach ($almacen_datos->result() as $reg) {
                        if ($reg->id_almacen == $almacen)
                            echo "<option value='$reg->id_almacen' selected='selected'>$reg->nombre </option>";
                        else
                            echo "<option value='$reg->id_almacen'>$reg->nombre </option>";
                    }
                    ?>
                </select>
                <br>
                mostrar solo con saldo <input type="checkbox" id="saldo">
       </div>
         <div style="display: table-cell; " class="alin_izq">
                Categoria de Material: <select id="cate" onchange="$('#pagina_registros').val(1); search_and_list_prod_kardex('lista_serv_prod');">
                    <option value="0">Todos...</option>

            <?php
            foreach ($categoria->result() as $categ) {
                $cate="";
                if ($categ->id_categoria == $cate)
                    echo ' <option selected="selected" value="' . $categ->id_categoria . '">' . $categ->nombre . '</option>';

                else
                    echo ' <option value="' . $categ->id_categoria . '">' . $categ->nombre . '</option>';
            }
            ?>

        </select>
        </div>
      
</div>
    </div>

<div id="lista_serv_prod" style="display: block;"></div>
<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar container_20" style="height: 300px; width: 400px;">cargando...</div>
<script> search_and_list_prod_kardex('lista_serv_prod');</script>

  