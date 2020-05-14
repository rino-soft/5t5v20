<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registro_asiento_view
 *
 * @author POMA RIVERO
 */
?>

<div class="titulo_contenido"><?php
    echo "$titulo";
    ?></div>


<div style="display: table; width: 95%">
    <div style="display: table-row">

        <div style="display: table-cell;">
            <div style="float:right; display: table-cell; " class="alin_der">
                <input class="fondobuscar300" id="search_rendicion" placeholder="B U S C A R" onkeypress="search_rt(event);">
                <br> Nro de Registros :
                <select id="mostrarX" onchange="$('#pagina_registros').val(1);  search_and_list_rendiciones_rt('lista_rendicion');">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="500">500</option>
                </select>
                <input type="hidden" value="1" id="pagina_registros">
            </div>
            <div style="float:right; display: table-cell; " class="alin_der">
                <select id="id_proyecto"  style=" width: 250px; height: 35px; font-size: 16px; font-weight: bold; margin: 0 10px 0 0;" onchange="$('#pagina_registros').val(1);  search_and_list_rendiciones_rt('lista_rendicion');">
                    <option value="0"  selected="selected">TODOS LOS PROYECTOS</option>                   
                    <?php
                    
                    foreach ($lista_proyectos->result() as $proy) {
                        ?>
                        <option  value="<?php echo $proy->id_proy; ?>"><?php echo $proy->nombre; ?></option>
                    <?php }
                    ?>
                </select>
            </div>

        </div>
    </div>


</div>

<div id="lista_rendicion" style="display: block;"></div>



<div id="div_formularios_dialog" class="formulario_nuevo_menu ocultar container_20" style="height: 300px; width: 400px;">cargando...</div>
<div id="div_anuncio" class="ocultar container_20" style="height: 300px; width: 400px;">
    <img class="milink" src="<?php echo base_url() . "/imagenesweb/recursos/anunciocorreo.png" ?>" height="300px" onclick="redirigir('<?php echo base_url()."usuario/file_personal_form/44/77"; ?>')">
</div>




<script> search_and_list_rendiciones_rt('lista_rendicion');</script>

<?php if($this->session->userdata('email')==""){?>
<script> $("#div_anuncio").dialog({
        title: "Notificación",
        autoOpen: true,
        height: 405,
        width: 700,
        modal: true,
        closeOnEscape: true,
        buttons: {
            "cerrar": function () {
                $("#div_anuncio").dialog("close");
            }}
    });
</script>
<?php } ?>




