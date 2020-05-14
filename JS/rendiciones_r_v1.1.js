//funciones JS para rendiciones

function ver_campo_nro_factura(origen, div_efecto)
{
    if ($('#' + origen).is(":checked"))
    {
        $('#' + div_efecto).removeClass('ocultar')
    } else
    {
        $('#' + div_efecto).addClass('ocultar')
    }
}


function mostrar_edit_ocultar_datos(fila, estado)
{
    if (estado)
    {
        $('#dr' + fila).removeClass('oculto');
        $('#drdatos' + fila).addClass('oculto');
    } else
    {
        $('#dr' + fila).addClass('oculto');
        $('#drdatos' + fila).removeClass('oculto');
    }
}



function sumar_total_rend()
{//alert('entra');
    //
    sec = $("#items_select").val();
    vec_Sec = sec.split(",");
    // alert(vec_Sec.length);
    sumador = 0;
    for (i = 1; i < vec_Sec.length; i++)
    {
        // alert(vec_Sec[i]+"  --  "+$("#dr" + vec_Sec[i] + " #monto").val());
        if ($("#dr" + vec_Sec[i] + " #monto").val() != "")
            sumador += parseFloat($("#dr" + vec_Sec[i] + " #monto").val());
    }
    $("#monto_total_rendicion").html(sumador.toFixed(2));
}

function subir_archivo_rend(fila)
{


    var formData = new FormData($("#fileform" + fila)[0]);
    //formData.append('destino', $("#" + div_destino + " #dest").val());
    // formData.append('file_name', $("#" + div_destino + " #nombre_file").val());
//    var dimensiones = $("#" + div_destino + " #dimensiones").val()
    //  dim = dimensiones.split("|");
    var ruta = $("#b_url").val() + 'upload_archivo/subir_archivo_rendicion';
    // $("#" + div_destino + " #image_load").html('<div class="cargando_circulo" ></div><div></div><div class="f12 alin_cen">Guardando...</div>');

    // $("#men_load_" + fila).html('');
    //$("#name_arch" + fila).val('');

    codigo = '<div id="dialog_nom_arch' + fila + '" class="centrartexto">\n\
            <span class="f16 negrilla colorAzul">Atención</span> \n\
             <br><span class="colorRojo negrilla f10">el archivo a Subir debe ser de tipo JPG/PNG/GIF ,  \n\
             las dimensiones no deben superar los limites de 2000px x 2000px y el \n\
             tamaño del archivo no debe superar los 3Mb</span> <br> Nombre del archivo \n\
 <input type="text" id="name_arch' + fila + '" class="input_redond_300">\n\
                                        <div id="men_load_' + fila + '">\n\
                                        </div>\n\
                                    </div>';
    $("#dialog_div_upload" + fila).html(codigo);
    //nomarch="";
    $("#dialog_nom_arch" + fila).dialog({
        title: "Carga de Archivos",
        autoOpen: true,
        height: 255,
        width: 530,
        modal: true,
        closeOnEscape: false,
        buttons: [
            {
                id: "guardar",
                text: "Subir archivo",
                click: function () {
                    $("#men_load_" + fila).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>0');
                    if ($("#dialog_nom_arch" + fila + " #name_arch" + fila).val() != "")
                    {

                        nomarch = ($("#dialog_nom_arch" + fila + " #name_arch" + fila).val()).replace(/ /g, "_");
                        formData.append('file_name', nomarch);
                        $.ajax({
                            url: ruta,
                            data: formData,
                            cache: false,
                            contentType: false, //'multipart/form-data' se ha quitado esta opcion es algo raro la verda :o!!!
                            processData: false,
                            type: 'POST',
                            success: function (data) {
                                vec_data = data.split("|");
                                if (vec_data[0] == "OK")
                                {
                                    $("#adjuntos_rutas" + fila).val($("#adjuntos_rutas" + fila).val() + "|" + vec_data[1]);
                                    rutas = $("#adjuntos_rutas" + fila).val();
                                    $("#men_load_" + fila).html("<div class='OK'>El Archivo fue cargado con exito!!</div>");

                                    $("#adjuntos" + fila).append("<div id='" + vec_data[1].replace(".", "") + "dmd'><div class='milinktextm' style='float:right;' onclick='ver_archivo(\"uploads/doc_rendicion/" + vec_data[1] + "\",\"" + vec_data[1] + "\" )'>" + vec_data[1].substring(1, 20) + "</div ><div onclick='del_arch_adj(\"" + vec_data[1] + "\",\"" + fila + "\")' class='negrilla colorRojo t14 milinktext' style='float:left; margin:0 5 0 5;' title='quitar Adjunto' >X</div></div>");

                                    setTimeout(function () {
                                        $("#dialog_nom_arch" + fila).dialog('destroy').remove();
                                    }, 1000);//alert('funciona'); 


                                } else
                                {
                                    $("#men_load_" + fila).html("<div class='NO'>se ha ocacionado un error en la carga:" + vec_data[1] + "</div>");
                                    setTimeout(function () {
                                        $("#dialog_nom_arch" + fila).dialog('destroy').remove();
                                    }, 3000);//alert('funciona'); 
                                }


//alert(data);
                                // carga OK

                            }
                        });
                    } else
                        alert("El archivo debe tener un nombre");


                }
            },
            {
                id: "close",
                text: "Cancelar",
                click: function () {
                    $("#dialog_nom_arch" + fila).dialog('destroy').remove();
                    $("#dialog_nom_arch" + fila).dialog("close");

                }
            }
        ]
    });
}

function del_arch_adj(arch, fila)
{
    $("#adjuntos_rutas" + fila).val($("#adjuntos_rutas" + fila).val().replace("|" + arch, ""));
    arch1 = arch.replace(".", "");
    $("#adjuntos" + fila + " #" + arch1 + "dmd").remove();

}

function dialog_rendicion_revision_regional(div_dialog, direccion, titulo) {
    //alert('funciona');
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve alert('funciona');
    $("#" + div_dialog).dialog({
        title: titulo,
        autoOpen: true,
        height: $(window).height(),
        width: 1050,
        modal: true,
        closeOnEscape: false,
        buttons: [
            {id: "vB",
                text: "Visto Bueno",
                click: function ()
                {
                    resp = "";
                    //alert (data_encargado+" proyecto"+$('#proyecto_seleccionado :selected').val());
                    $.post(burl + "rendiciones/obtener_superior_permiso_proyecto", {
                        'id_proy': $('#proyecto_seleccionado :selected').val()
                    }
                    , function (data) {
                        resp = data.split("|");

                        codigo = "<div class='centrartexto'><span class='f16 negrilla'>" + resp[3] + " " + resp[4] + " " + resp[5] + "</span><br>\n\
                                    <span class='f12 negrilla '>" + resp[1] + " " + resp[2] + "</span>" + "</div>";
                        $("#men_load").html(codigo);
                        // alert(data);
                        //location.reload();
                    });

                    codigo = '<div id="dialog_finalizacion" class="centrartexto">\n\
                                    <span class="f20 negrilla colorAzul">Atenci&oacute;n</span> \n\
                                       <br><span class="colorRojo negrilla ">¿ Esta usted seguro de dar su Visto Bueno a la  rendici&oacute;n / reembolso ? <br></span><span>Una vez visado no podr&aacute; realizar modificaciones\n\
                                       <br><br>La rendicion sera enviada a <br><br></span>\n\
                                        <div id="men_load">\n\
                                        <div class="cargando_circulo" ></div>\n\
                                        </div>\n\
                                    </div>';

                    /* codigo = '<div id="dialog_finalizacion" class="centrartexto">\n\
                     <span class="f20 negrilla colorAzul">Atenci&oacute;n</span> \n\
                     <br><span class="colorRojo negrilla ">Ãƒâ€šÃ‚Â¿ Esta usted seguro de dar su Visto Bueno al Formulario de rendici&oacute;n ? <br></span><span>Una vez dado su VoBo no podr&aacute; realizar modificaciones\n\
                     </span>  </div>';
                     */
                    $("#mensaje_fin").html(codigo);
                    $("#dialog_finalizacion").dialog({
                        title: "Atención!!",
                        autoOpen: true,
                        height: 270,
                        width: 600,
                        modal: true,
                        closeOnEscape: false,
                        buttons: {
                            "VoBo": function () {

                                var items_select = $('#items_select').val();
                                var id_tipo_gasto = "";
                                var c_s_factura = "";
                                var monto = "";
                                var total = 0;
                                var nro_fac = "";
                                var fecha_factura = "";
                                var glosa_factura = "";
                                var placa_vehiculo = "";
                                var adjuntos = "";
                                var cobra_cliente = "";
                                var estacion = "";
                                var vector = items_select.split(",");

                                //alert(vector.length);
                                for (i = 1; i < vector.length; i++)
                                {
                                    id_tipo_gasto = id_tipo_gasto + $('#dr' + vector[i] + ' #tipo_gasto :selected').val() + ';';
                                    monto = monto + $('#dr' + vector[i] + ' #monto').val() + ';';
                                    total = total + parseFloat($('#dr' + vector[i] + ' #monto').val());
                                    if ($('#dr' + vector[i] + ' #fac').is(':checked'))
                                        c_s_factura = c_s_factura + '1;';
                                    else
                                        c_s_factura = c_s_factura + '0;';

                                    if ($('#dr' + vector[i] + ' #cobrar_cliente').is(':checked'))
                                        cobra_cliente = cobra_cliente + '1;';
                                    else
                                        cobra_cliente = cobra_cliente + '0;';

                                    nro_fac = nro_fac + $('#dr' + vector[i] + ' #nro_fact').val() + ';';
                                    fecha_factura = fecha_factura + $('#fec_fact' + vector[i]).val() + ';';
                                    glosa_factura = glosa_factura + $('#dr' + vector[i] + ' #detalle_factura').val() + ';';
                                    placa_vehiculo = placa_vehiculo + $('#dr' + vector[i] + ' #placa_veh').val() + ';';
                                    estacion = estacion + $('#dr' + vector[i] + ' #estacion_sitio').val() + ';';
                                    adjuntos = adjuntos + $('#dr' + vector[i] + ' #adjuntos_rutas' + vector[i]).val() + ';';
                                }

                                // alert(adjuntos);



                                $.post(burl + "rendiciones/VoBo_rendicion", {
                                    'tipo': id_tipo_gasto,
                                    'monto': monto,
                                    'fac': nro_fac,
                                    'f_s': c_s_factura,
                                    'fec_f': fecha_factura,
                                    'total': total,
                                    'estado': "Enviado a  " + resp[1] + ":" + resp[3] + " " + resp[4] + " " + resp[5],
                                    'glo_f': glosa_factura,
                                    'pla_f': placa_vehiculo,
                                    'cob_f': cobra_cliente,
                                    'adj_f': adjuntos,
                                    'estaciones_selec': estacion,
                                    'id_rend': $('#id_rend').val(),
                                    'id_proy': $('#proyecto_seleccionado :selected').val(),
                                    'id_usu': $('#tecnico_seleccionado :selected').val(),
                                    'id_resp_destino': $("#ids_responsables").val() + "|" + resp[0] + "|",
                                    'ids_vobos': $("#ids_vobos").val() + "|" + $("#mi_id").val() + "|",
                                    'tipo_rend': $('#tipo_rendicion :selected').val(),
                                    'desc': $('#desc').val(),
                                    'fec_reg': $('#fechaS').val()

                                }

                                , function (data) {
                                    // alert ("entra ");
                                    $("#" + div_dialog + " #respuesta").html(data);
                                    if ($('#ayudata').val() != 0)
                                    {     //alert('se ha adicionado categoria , con nro de Id : '+$('#ayudata').val()) 
                                        search_and_list_rendiciones_rt('lista_rendicion');
                                        $.post(burl + "rendiciones/enviar_correo_vobo", {
                                            'id_rendicion': $('#ayudata').val()
                                        }
                                        );
                                    }
                                    setTimeout(function () {
                                        //nuevadireccion = this.quita_parametros(direccion, 1);
                                        //alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                                        //cargar_contenido_html(div_dialog, nuevadireccion + $('#ayudata').val(), 0);


                                        $("#dialog_finalizacion").dialog("close");
                                        $("#dialog_finalizacion").dialog('destroy').remove();
                                        $("#" + div_dialog).dialog("close");

                                    }, 500);//alert('funciona'); 


                                });
                            },
                            "Cancelar": function () {

                                $("#dialog_finalizacion").dialog('destroy').remove();
                            }
                        }});
                }}, {
                id: "save_reg",
                text: "Guardar",
                click: function ()
                {

                    var items_select = $('#items_select').val();

                    var id_tipo_gasto = "";
                    var c_s_factura = "";
                    var monto = "";
                    var total = 0;
                    var nro_fac = "";
                    var fecha_factura = "";
                    var glosa_factura = "";
                    var placa_vehiculo = "";
                    var adjuntos = "";
                    var cobra_cliente = "";
                    var vector = items_select.split(",");
                    //alert(vector.length);
                    for (i = 1; i < vector.length; i++)
                    {
                        id_tipo_gasto = id_tipo_gasto + $('#dr' + vector[i] + ' #tipo_gasto :selected').val() + ';';
                        monto = monto + $('#dr' + vector[i] + ' #monto').val() + ';';
                        total = total + parseFloat($('#dr' + vector[i] + ' #monto').val());
                        if ($('#dr' + vector[i] + ' #fac').is(':checked'))
                            c_s_factura = c_s_factura + '1;';
                        else
                            c_s_factura = c_s_factura + '0;';

                        if ($('#dr' + vector[i] + ' #cobrar_cliente').is(':checked'))
                            cobra_cliente = cobra_cliente + '1;';
                        else
                            cobra_cliente = cobra_cliente + '0;';

                        nro_fac = nro_fac + $('#dr' + vector[i] + ' #nro_fact').val() + ';';
                        fecha_factura = fecha_factura + $('#fec_fact' + vector[i]).val() + ';';
                        glosa_factura = glosa_factura + $('#dr' + vector[i] + ' #detalle_factura').val() + ';';
                        placa_vehiculo = placa_vehiculo + $('#dr' + vector[i] + ' #placa_veh').val() + ';';
                        adjuntos = adjuntos + $('#dr' + vector[i] + ' #adjuntos_rutas' + vector[i]).val() + ';';
                    }

                    alert(total + "  -  " + monto);



                    $.post(burl + "rendiciones/guardar_nueva_rendicion", {
                        'tipo': id_tipo_gasto,
                        'monto': monto,
                        'fac': nro_fac,
                        'f_s': c_s_factura,
                        'fec_f': fecha_factura,
                        'total': total,
                        'estado': "Modificado Responsable",
                        'glo_f': glosa_factura,
                        'pla_f': placa_vehiculo,
                        'cob_f': cobra_cliente,
                        'adj_f': adjuntos,
                        'id_rend': $('#id_rend').val(),
                        'id_proy': $('#proyecto_seleccionado :selected').val(),
                        'id_usu': $('#tecnico_seleccionado :selected').val(),
                        'tipo_rend': $('#tipo_rendicion :selected').val(),
                        'desc': $('#desc').val(),
                        'fec_reg': $('#fechaS').val()

                    }

                    , function (data) {
                        // alert ("entra ");
                        $("#" + div_dialog + " #respuesta").html(data);
                        if ($('#ayudata').val() != 0)
                            //alert('se ha adicionado categoria , con nro de Id : '+$('#ayudata').val())
                            setTimeout(function () {
                                nuevadireccion = this.quita_parametros(direccion, 1);
                                //alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                                cargar_contenido_html(div_dialog, nuevadireccion + $('#ayudata').val(), 0);
                            }, 1000);//alert('funciona'); 

                    });
                }},
            /*"Enviar":function(){
             $( this ).dialog( "close" );
             baseurl=$("#b_url").val()+'impresiones_pdf/imp_form_rendiciones/'+$('#id_rend').val();  
             miven=window.open (baseurl, "mywindow","menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");
             }
             ,*/{id: "close",
                text: "Cerrar",
                click: function () {

                    $(this).dialog("close");
                    //location.reload();
                }
            }


        ]
    });
}



function
        enviar_baul_rechazados(id_rechazado, cont)
{
    burl = $('#b_url').val();
    codigo = '<div id="dialog_baul" class="centrartexto">\n\
                                    <span class="f20 negrilla colorAzul">Atenci&oacute;n</span> \n\
             <br><span class="colorRojo negrilla "> ¿Esta usted seguro de rechazar este Registro? <br></span>adicione un comentario del motivo del rechazo \n\
                <div> <textarea style="heigth:100px;width:300px" id="comentario_eliminacion"></textarea> </div>\n\
             </div>';
    $("#mensaje_fin").html(codigo);
    $("#dialog_baul").dialog({
        title: "Rechazar Registro",
        autoOpen: true,
        height: 230,
        width: 370,
        modal: true,
        closeOnEscape: false,
        buttons: {
            "Rechazar Registro": function () {

                $.post(burl + "rendiciones/mover_a_baul_rechazados", {
                    'id_det': id_rechazado,
                    'obs_rechazo': $("#comentario_eliminacion").val()
                }
                , function (data) {
                    $("#dialog_baul").dialog("close");
                    $("#dialog_baul").dialog('destroy').remove();
                });
                del_registro_rendicion(cont);
                del_registro_rendicion('datos' + cont);
            },
            "Cancelar": function () {
                $("#dialog_baul").dialog('destroy').remove();
            }
        }});
}

//Nueva Funcion Ruben 


function mostrar_placa_numero(origen, campo, valor)
{
    valororigen = $('#' + origen + " :selected").val();
    //alert($('#'+dplaca).html());
    //alert(valororigen);
    if (valororigen == 1)
    {
        $('#' + campo).html('<input class="input_redond_100_c" style="padding:1px;margin-top:0px; width:95px" type="text" id="placa_veh" value="' + valor + '" placeholder="Placa Vehiculo" title="ingrese la placa del vehiculo">');
    } else
    {
        if (valororigen == 3)
        {
            $('#' + campo).html('<input class="input_redond_100_c" style="padding:1px; margin-top:0px; width:95px" type="text" id="placa_veh" value="' + valor + '" placeholder="Nro Telefono" title="ingrese Nro de telefono">');
        } else {
            $('#' + campo).html('<input type="hidden" id="placa_veh" value="">');
        }
    }
}

function carga_estaciones_proy(ele_proyecto, campo)
{
    burl = $('#b_url').val();
    proy = $('#' + ele_proyecto + ' :selected').val();
    $.post(burl + "rendiciones/obtener_estaciones_proyecto", {
        'id_proy': proy
    }
    , function (data) {
        // alert(data);
        $("#" + campo).html(data);
        $(".estsit").autocomplete({source: etiquetas});
    });

}



