<?php
$id_cont = 0;
$nom = "";
$cargo = "";
$tel = "";
$dir = $d_cliente->direccion;
if ($d_contacto->num_rows() > 0) {
    $id_cont = $d_contacto->row()->id_contacto;
    $nom = $d_contacto->row()->nom_comp;
    $cargo = $d_contacto->row()->cargo;
    $tel = $d_contacto->row()->telefonos;
    $dir = $d_contacto->row()->direccion;
    $est = $d_contacto->row()->estado;
}
?>
<div>
    <div id="respuesta"></div>

    <div >Datos de <span class="negrilla">CONTACTO</span> del cliente</div>
    <hr>
     <input type="hidden" value="<?php echo $d_cliente->id_cliente; ?>" id="id_cli">
     <input type="hidden" value="<?php echo $id_cont; ?>" id="id_cont">
    <div > <input class="input_redond_350" type="text" id="nom_com" placeholder="nombre completo de Contacto" value="<?php echo $nom; ?>"></div>
    <div class="f10 negrilla"> Nombre Completo</div>
    <div > <input class="input_redond_350" type="text" id="cargo" placeholder="cargo de contacto" value="<?php echo $cargo; ?>" ></div>
    <div class="f10 negrilla"> Cargo del Contacto</div>

    <div > <input class="input_redond_350" type="text" id="tel" placeholder="telefonos y celulares" value="<?php echo $tel;?>"></div>
    <div class="f10 negrilla"> Telefonos/internos/celulares</div>

    <div > <input class="input_redond_350" type="text" id="dir" placeholder="Direccion Oficina" 
                  value="<?php echo $dir; ?>"></div>
    <div class="f10 negrilla"> Direccion de oficina o lugar de trabajo</div>

    <div class="lista_contactos "><div class="alin_der espaciado"><span class="colorRojo f10 negrilla">Lista de Contactos del cliente <?php echo $d_cliente->razon_social; ?></span></div>
        <div class="espaciado">
            <?php
            $contac = $l_contactos;
            for ($i = 0; $i < count($contac); $i++) {
                ?>
                <div class="item_contactos milink" title="Cargo : <?php echo $contac[$i]['cargo']; ?>"
                     onclick="cargar_contenido_html('div_formularios_dialog','<?php echo base_url() . "cliente/contacto_nuevo/" . $d_cliente->id_cliente . "/" . $contac[$i]['id_contacto']; ?>',0)">
                    <span class="negrilla"><?php echo ($i+1) . "- " . $contac[$i]['nombre_c']; ?></span>
                    <span class="">(<?php echo $contac[$i]['tel']; ?>)</span>

                </div>
                <?php
            }
            ?>
            <!--<br>
            <div class="item_contactos milink alin_der"
                     onclick="cargar_contenido_html('div_formularios_dialog','<?php //echo base_url() . "cliente/contacto_nuevo/" . $d_cliente->id_cliente . "/0"  ?>',0)">
                    <span class="boton espaciado"><?php //echo " + Adicionar nuevo Contacto" ?></span>
                                    </div>-->
        </div>
    </div>
    


</div>