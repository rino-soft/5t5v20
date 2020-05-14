//funciones de almacen y movimiento almacen     


// funcion Dialog para editar ver los movimientos de almacen de tipo INGRESO 
// tiene botones de CERRAR y RECEPCIONAR MATERIAL
// se adiciona el boton de COPIAR a SALIDA
// se adiciona el boton y la accion de COPIAR A TRASPASO SALIDA **********

function dialog_nuevo_mov_alm1(div_dialog, direccion)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
    $("#" + div_dialog).dialog({
        title: "Ingreso de Material/Insumos/Herramientas",
        autoOpen: true,
        height: $(window).height(),
        width: 1050,
        modal: true,
        closeOnEscape: false,
        buttons: [
            {
                id: "copiar_traspaso_salida",
                text: "Copiar a Traspaso",
                click: function () {
                    // $(this).dialog("close");
                    //$("#mensaje").dialog
                    $("#" + div_dialog).dialog("close");
                    dialog_nuevo_mov_alm_retirotraspaso('div_formularios_dialog', burl + 'movimiento_almacen/almacen_copia_ingreso_retiro_traspaso/' + $("#id_send").val());
                    //location.reload();                
                    //$(this).dialog();
                }
            }
            , {
                id: "copiar_salida",
                text: "Copiar a Salida",
                click: function () {
                    // $(this).dialog("close");
                    //$("#mensaje").dialog
                    $("#" + div_dialog).dialog("close");
                    dialog_nuevo_mov_alm_retiro('div_formularios_dialog', burl + 'movimiento_almacen/almacen_copia_ingreso_retiro/' + $("#id_send").val());
                    //location.reload();                
                    //$(this).dialog();
                }
            },
            {
                id: "save1_mov",
                text: "Recepcionar Material",
                disabled: "true",
                click: function () {
                    ids = $("#ids_seleccionados").val();
                    // alert("entra ids"+ids);             
                    vec = ids.split(",");
                    data_ids = "";
                    data_idps = "";
                    data_ma = "";
                    data_cant = "";
                    data_comen = "";
                    cod_u = "";
                    tipo_m = "";
                    tipo_cup = "";
                    tipo_sn = "";

                    for (i = 1; i < vec.length; i++)
                    {
                        //alert("vec["+i+"]"+vec[i]);
                        data_ids += "|" + vec[i];
                        data_idps += "|" + $("#sel" + vec[i] + " #id_sp").val();
                        data_ma += "|" + $("#sel" + vec[i] + " #id_ma").val();
                        data_cant += "|" + $("#sel" + vec[i] + " #cant").val();
                        data_comen += "|" + $("#sel" + vec[i] + " #coment").val();
                        tipo_cup += "|" + $("#sel" + vec[i] + " #cp").val();
                        tipo_sn += "|" + $("#sel" + vec[i] + " #sn").val();

                    }
                    var tipo_proy = $('#id_proyecto :selected').val();
                    var tipo_almacen = $('#id_almacen :selected').val();
                    //alert("no funciona"+$('#select_proyecto :selected').val());                
                    //alert("aquii"+data_ids+","+data_idps+","+data_ma+","+data_cant+","+data_comen);

                    $.post(burl + "movimiento_almacen/movimiento_almacen_pro_serv_save", {
                        'id_mov_alm': $("#id_sendma").val(),
                        'ids': data_ids,
                        'r_idps': data_idps,
                        'r_ma': data_ma,
                        'r_cant': data_cant,
                        'r_coments': data_comen,
                        'r_cup': tipo_cup,
                        'r_sn': tipo_sn,
                        'cod_user': $("#id_personal :selected").val(),
                        'tipo_mov': "Ingreso",
                        'fh': $("#tim").val(),
                        'proyt': tipo_proy,
                        'cod_alm': tipo_almacen,
                        'estado': "Material Recepcionado",
                        'tipo_doc_o': "Movimiento Inventario",
                        'coment_gral': $("#comentario_general").val()
                    }
                    , function (data) {
                        $("#" + div_dialog + " #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                        $("#" + div_dialog + " #respuesta").html(data);
                        // alert($("#ayudata").val());
                        setTimeout(function () {
                            //cargar_contenido_html(div_dialog,direccion,0);
                            dir = this.quita_parametros(direccion, 1);
                            cargar_contenido_html(div_dialog, dir + $("#ayudata").val(), 0);

                        }, 1000);

                    });
                }
            },
            {
                id: "button-ok",
                text: "cerrar",
                click: function () {
                    // $(this).dialog("close");
                    //$("#mensaje").dialog
                    $(this).dialog("close");
                    location.reload();
                    //$(this).dialog();
                }
            }
        ]
    });
}




//nuevo movimiento almacen retiro recibe 0 para nuevo y id para edicion y copia de ingreso
function dialog_nuevo_mov_alm_retiro(div_dialog, direccion)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
    $("#" + div_dialog).dialog({
        title: "Retiro de Material/Insumos/Herramientas",
        autoOpen: true,
        height: $(window).height(),
        width: 1050,
        modal: true,
        //closeOnEscape: false,

        buttons: [
        {
            id: "entregar",
            text: "Entregar",
            disabled: "true",
            click: function () {

                var id_ma = $("#id_send").val();
                dialog_padre = div_dialog;
                direccion_nueva = quita_parametros(direccion, 1) + $("#id_send").val();
                genera_cod_ma("c_ope", burl + "movimiento_almacen/codigo_ope_sol_mat_ru/" + id_ma, direccion_nueva, dialog_padre);

            }
        },
        {
            id: "save_retiro",
            text: "Guardar",
            click: function () {
                ids = $("#ids_seleccionados").val();
                // alert("entra ids"+ids);             
                vec = ids.split(",");
                data_ids = "";
                data_idps = "";
                data_ma = "";
                data_cant = "";
                data_comen = "";
                data_sn = "";
                data_cp = "";
                cod_u = "";
                tipo_m = "";

                for (i = 1; i < vec.length; i++)
                {
                    //alert("vec["+i+"]"+vec[i]);
                    data_ids += "|" + vec[i];
                    data_idps += "|" + $("#sel" + vec[i] + " #id_ps").val();
                    //data_ma+="|"+$("#sel"+vec[i]+" #id_ma").val();
                    data_cant += "|" + $("#sel" + vec[i] + " #cantidad").val();
                    data_comen += "|" + $("#sel" + vec[i] + " #coment").val();
                    data_sn += "|" + $("#sel" + vec[i] + " #sn").val();
                    data_cp += "|" + $("#sel" + vec[i] + " #cp").val();

                }
                //alert("no funciona"+$("#c_u").val());                
                //alert("aquii"+data_ids+","+data_idps+","+data_ma+","+data_cant+","+data_comen);
                alert("id_oficina"+$("#id_oficina :selected").val());
                $.post(burl + "movimiento_almacen/save_mov_alm_retiro_directo", {
                    'id_mov_alm': $("#id_send").val(),
                    'ids': data_ids,
                    'r_idps': data_idps,
                    'r_ma': data_ma,
                    'r_cant': data_cant,
                    'r_coments': data_comen,
                    'r_sn': data_sn,
                    'r_cp': data_cp,
                    'cod_user': $("#id_personal :selected").val(),
                    'tipo_mov': 'Salida',
                    'proyt': $("#id_proyecto :selected").val(),
                    'almacen': $("#id_almacen :selected").val(),
                    'id_oficina': $("#id_oficina :selected").val(),
                    'tipo_doc_o': "movimiento inventario",
                    'coment_gral': $("#comentario_general").val()
                }
                , function (data) {
                    $("#" + div_dialog + " #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    $("#entregar").button("enable");
                    // $("#save_retiro").button("enable");
                    $("#" + div_dialog + " #respuesta").html(data);

                    // alert(direccion);
                    // alert($("#ayudata").val());
                    setTimeout(function () {
                        dir = this.quita_parametros(direccion, 1);
                        dir=burl+"movimiento_almacen/almacen_retiro_directo/";
                        cargar_contenido_html(div_dialog, dir + $("#ayudata").val(), 0);
                    }, 1000);

                });
            }
        },
        {
            id: "button-ok",
            text: "cerrar",
            click: function () {
                // $(this).dialog("close");
                //$("#mensaje").dialog
                $(this).dialog("close");
                location.reload();
            //$(this).dialog();
            }
        }
        ]
    });
}

//funcion para COPIA a RETIRO TRASPASO ******
function dialog_nuevo_mov_alm_retirotraspaso(div_dialog, direccion)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
    $("#" + div_dialog).dialog({
        title: "Retiro TRASPASO de Material/Insumos/Herramientas",
        autoOpen: true,
        height: $(window).height(),
        width: 1050,
        modal: true,
        //closeOnEscape: false,

        buttons: [
        {
            id: "enviar",
            text: "Traspasar Material",
            disabled: "true",
            click: function () {

                var id_ma = $("#id_send").val();
                dialog_padre = div_dialog;
                direccion_nueva = quita_parametros(direccion, 1) + $("#id_send").val();
                genera_cod_ma("c_ope", burl + "movimiento_almacen/codigo_ope_sol_mat_ru/" + id_ma, direccion_nueva, dialog_padre);

            }
        },
        {
            id: "save_retiro",
            text: "Guardar",
            click: function () {
                ids = $("#ids_seleccionados").val();
                // alert("entra ids"+ids);             
                vec = ids.split(",");
                data_ids = "";
                data_idps = "";
                data_ma = "";
                data_cant = "";
                data_comen = "";
                data_sn = "";
                data_cp = "";
                cod_u = "";
                tipo_m = "";

                for (i = 1; i < vec.length; i++)
                {
                    //alert("vec["+i+"]"+vec[i]);
                    data_ids += "|" + vec[i];
                    data_idps += "|" + $("#sel" + vec[i] + " #id_ps").val();
                    //data_ma+="|"+$("#sel"+vec[i]+" #id_ma").val();
                    data_cant += "|" + $("#sel" + vec[i] + " #cantidad").val();
                    data_comen += "|" + $("#sel" + vec[i] + " #coment").val();
                    data_sn += "|" + $("#sel" + vec[i] + " #sn").val();
                    data_cp += "|" + $("#sel" + vec[i] + " #cp").val();

                }
                //alert("no funciona"+$("#c_u").val());                
                //alert("aquii"+data_ids+","+data_idps+","+data_ma+","+data_cant+","+data_comen);
                alert("id_oficina"+$("#id_oficina :selected").val());
                $.post(burl + "movimiento_almacen/save_mov_alm_retiro_directo", {
                    'id_mov_alm': $("#id_send").val(),
                    'ids': data_ids,
                    'r_idps': data_idps,
                    'r_ma': data_ma,
                    'r_cant': data_cant,
                    'r_coments': data_comen,
                    'r_sn': data_sn,
                    'r_cp': data_cp,
                    'cod_user': $("#id_personal :selected").val(),
                    'tipo_mov': 'Salida',
                    'proyt': $("#id_proyecto :selected").val(),
                    'almacen': $("#id_almacen :selected").val(),
                    'id_oficina': $("#id_oficina :selected").val(),
                    'tipo_doc_o': "movimiento inventario",
                    'coment_gral': $("#comentario_general").val()
                }
                , function (data) {
                    $("#" + div_dialog + " #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    $("#entregar").button("enable");
                    // $("#save_retiro").button("enable");
                    $("#" + div_dialog + " #respuesta").html(data);

                    // alert(direccion);
                    // alert($("#ayudata").val());
                    setTimeout(function () {
                        dir = this.quita_parametros(direccion, 1);
                        dir=burl+"movimiento_almacen/almacen_retiro_directo/";
                        cargar_contenido_html(div_dialog, dir + $("#ayudata").val(), 0);
                    }, 1000);

                });
            }
        },
        {
            id: "button-ok",
            text: "cerrar",
            click: function () {
                // $(this).dialog("close");
                //$("#mensaje").dialog
                $(this).dialog("close");
                location.reload();
            //$(this).dialog();
            }
        }
        ]
    });
}