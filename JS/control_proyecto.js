
function filtrar_proyecto_sitio(id_padre) {

    burl = $('#b_url').val();
    proyecto = $("#id_proyectototal :selected").val();
    redirigir(burl + "control_proyecto/ordecompra/" + id_padre + "/" + proyecto);
}
function filtrar_proyecto_sitio_reporte(id_padre) {

    burl = $('#b_url').val();
    proyecto = $("#id_proy_sitio :selected").val();
    sitio = $("#id_sitio :selected").val();
    rango = $("#rango :selected").val();
    redirigir(burl + "control_proyecto/reporte_control_sitio/" + id_padre + "/" + proyecto+ "/" +sitio+ "/" +rango);
}

function filtrar_proyecto_sitio_reporte_rendicion() {

    burl = $('#b_url').val();
   
     $.post(burl + "control_proyecto/reporte_rendicion_info", {
        'id_proyecto': $("#id_proy_sitio :selected").val(),
        'id_usuario': $("#tecnico_seleccionado :selected").val(),
        'id_sitio': $("#id_sitio :selected").val(),
        'rango': $("#rango :selected").val()
    }
    , function (data) {
        //cargarl   
        //  alert(data);

        //  p=data.split(",");
        //var availableTags = p;
        $("#informacion_consulta").html(data);
       
        //source: availableTags
    }

    );
    //redirigir(burl + "control_proyecto/reporte_control_sitio/" + id_padre + "/" + proyecto);
}



function mostrar_fomrulario()
{
    $("#formuarioSitio").removeClass('ocultar');
    borrarcontenidositio();
}
function ocultar_fomrulario()
{
    $("#formuarioSitio").addClass('ocultar');
    borrarcontenidositio();

}

function add_registroitem() {
    var nd = parseInt($('#nro_reg').val()) + 1;
    // alert(nd);
    $('#nro_reg').val(nd);
    $('#itemsdetalle').val($('#itemsdetalle').val() + ',' + nd);
    //$('#muestra_cuenta').html(nd);

    var codigo = $('#grilla_modelo').html();
    codigo = codigo.replace(/XX/gi, nd);
    $('#detalle_items_po').append('<div id="detpo' + nd + '" class="">' + codigo + '</div>');
    //$("#fec_fact" + nd).datepicker();

}
function quitar_item_po(item)
{
    $id_det = $("#detpo" + item + " #id_det_po").val();
    $("#ids_borrados").val($("#ids_borrados").val() + "," + $id_det);

    items = $("#itemsdetalle").val();
    items = items.replace("," + item, "");
    $("#itemsdetalle").val(items);
    $("#detpo" + item).remove();
    sumadetalle();
}

function registrar_sitio()
{
    $("#bloqueo_pagina").removeClass("ocultar");
    $(".border-red").removeClass('border-red');
    burl = $('#b_url').val();
    llave = 1;
    mensaje = "";
    if ($("#duid").val() == "")
    {
        $('#duid').addClass('border-red');
        llave = 0;
        mensaje += "Error en la DUID \n";
    } else
    {
        if ($("#duplicadoDUID").val() == 1)
        {
            if ($("#duplicidad").is(":checked"))
            {
                1;
            } else
            {
                llave = 0;
                mensaje += "el DIUD esta duplicado y ha indicado que no permitira duplicidad \n";
            }
        }
    }
    if ($("#titulo").val() == "")
    {
        $('#titulo').addClass('border-red');
        llave = 0;
        mensaje += "Error en el titulo del sitio \n";
    }
    if ($("#id_proyecto :selected").val() == 0)
    {
        $('#id_proyecto').addClass('border-red');
        llave = 0;
        mensaje += "Error en la seleccion del proyecto del sitio  \n";
    }
    if ($("#proyinterno :selected").val() == "seleccione") {
        $('#proyinterno').addClass('border-red');
        llave = 0;
        mensaje += "Error en seleccionar el proyecto interno \n";

    }
    if ($("#proyinternoinput").val() == "")
    {
        $('#proyinternoinput').addClass('border-red');
        llave = 0;
        mensaje += "Error en llenar el Proyecto Interno \n";
    }
    if ($("#comentario").val() == "")
    {
        $('#comentario').addClass('border-red');
        llave = 0;
        mensaje += "Error en llenar el comentario del sitio \n";
    }

    if (llave == 1) {

        $.post(burl + "control_proyecto/guardar_registro_sitio", {
            'idsitio': $("#id_sitio").val(),
            // 'nroPO': $("#nropo").val(),
            'DUID': $("#duid").val(),
            'titulo': $("#titulo").val(),
            'id_proy': $("#id_proyecto :selected").val(),
            'id_proy_interno': $("#proyinternoinput").val(),
            //'duracion': $("#duracion").val(),
            //'posible_fecha': $("#fechainicial").val(),
            // 'usuario_asignado': $("#id_personal :selected").val(),
            'comentario': $("#comentario").val()

        }
        , function (data) {
            //  $("#" + div_dialog + " #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
            //$("#" + div_dialog + " #respuesta").html(data);
            // alert($("#ayudata").val());
            setTimeout(function () {
                //cargar_contenido_html(div_dialog,direccion,0);
                // dir = this.quita_parametros(direccion, 1);

                // cargar_contenido_html(div_dialog, dir + $("#ayudata").val(), 0);
                // cargarlistar_orden_compra("lista_ordenCompra");
                new PNotify({
                    title: 'Registro Exitoso!',
                    text: $("#mensajeayudata").val(),
                    type: 'success',
                    styling: 'bootstrap3'
                });
                borrarcontenidositio();

                $("#bloqueo_pagina").addClass("ocultar");
                location.reload();

            }, 3000);

        });
    } else
    {
        // alert("Se han encontrado errores en el formulario...!");
        new PNotify({
            title: 'ERROR!!!!',
            text: 'Se han encontrado errores en el formulario...!\n' + mensaje,
            type: 'error',
            styling: 'bootstrap3'
        });

        $("#bloqueo_pagina").addClass("ocultar");
        $('#save').button('enable');
        $('#fin_send').button('enable');
    }

}
function consultar_proyint()
{
    if ($("#id_proyecto :selected").val() != 0) {
        pint = $("#proyinterno :selected").val();
        // alert(pint);
        if (pint == "otro_nuevo") {
            $("#otropint").removeClass("ocultar");
            $("#proyinternoinput").val("");
        } else
        {
            $("#otropint").addClass("ocultar");
            $("#proyinternoinput").val(pint);
        }
    } else
    {
        alert("por favor seleeciona un proyecto antes!!");
    }
}

function cargar_proy_interno(apinte)
{
    burl = $('#b_url').val();
    // alert($("#id_proyecto :selected").val());
    $.post(burl + "control_proyecto/obtener_proyinterno", {
        'idproyecto': $("#id_proyecto :selected").val(),
        'idproyinte': apinte
    }
    , function (data) {
        //cargarl   
        //  alert(data);

        //  p=data.split(",");
        //var availableTags = p;
        $("#proyinterno").html(data);
        $("#otropint").addClass("ocultar");
        $("#proyinternoinput").val("");
        //source: availableTags
    }

    );

}

function editar_sitio(sitio)
{
    mostrar_fomrulario();
    burl = $('#b_url').val();
    $.post(burl + "control_proyecto/obtener_sitio/" + sitio, {}
    , function (data) {
        $("#recuperacion").html(data);
        //   aproy = $("#Aproy").val();
        // alert(aproy);

        $("#id_sitio").val($("#AidSitio").val());
        $("#duid").val($("#Aduid").val());
        $("#titulo").val($("#Anombre").val());
        //$("#id_personal :selected").val();
        $("#comentario").val($("#coment").val());
        apinte = $("#Apinte").val();

        aproy = $("#Aproy").val();
        //  alert(aproy);
        $("#id_proyecto option").attr("selected", false);
        $("#id_proyecto option[value='" + aproy + "']").attr("selected", "selected");
        cargar_proy_interno(apinte);
    });

}

function borrarcontenidositio()
{
    // alert ("se borraron los Datos");
    // $("#id_proyecto option").attr("selected", false);
    // $("#id_proyecto option[value='0']").attr("selected", "selected");
    $("#proyinterno option").attr("selected", false);
    $("#proyinterno option[value='0']").attr("selected", "selected");
    $("#duid").val("");
    $("#duplicadoDUID").val(0);
    $("#titulo").val("");
    //$("#id_personal :selected").val();
    //$('#id_proyecto option:eq(0)').attr("selected", "selected");
    $("#comentario").val("");
    $("#proyinternoint").val("");
    cargar_proy_interno(0);
    $("#proyinterno option").attr("selected", false);
    $("#proyinterno option[value='seleccione']").attr("selected", "selected");
}

/////PO registro


function mostrar_form_po(id_po)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html('formulario_ordencompra', burl + 'control_proyecto/form_po_register/' + id_po, 0);//modulo=0 no sirve
}
function ocultar_form_po()
{
    $('#formulario_ordencompra').html("");
}

function sumadetalle()
{
    itemsdetalle = $("#itemsdetalle").val().split(",");
    console.log(itemsdetalle);
    suma = 0;
    for (i = 1; i < itemsdetalle.length; i++)
    {
        suma += parseInt($("#detpo" + itemsdetalle[i] + " #montoItem").val());

    }
    $("#monto").val(suma);
}

function registrar_po()
{
    $("#bloqueo_pagina").removeClass("ocultar");
    burl = $('#b_url').val();
    item = "";
    npos = "";
    id_det = "";
    desc = "";
    mont = "";
    id_us = "";
    itemsdetalle = $("#itemsdetalle").val().split(",");
    for (i = 1; i < itemsdetalle.length; i++)
    {
        id_det += $("#detpo" + itemsdetalle[i] + " #id_det_po").val() + "|";
        npos += $("#detpo" + itemsdetalle[i] + " #nropo").val() + "|";

        desc += $("#detpo" + itemsdetalle[i] + " #comentariodet").val() + "*|*";
        mont += $("#detpo" + itemsdetalle[i] + " #montoItem").val() + "|";
        id_us += $("#detpo" + itemsdetalle[i] + " #id_personal :selected").val() + "|";

    }
    console.log(item + "***" + desc + "***" + mont);

    $.post(burl + "control_proyecto/guardar_items_po", {
        'npo': npos,
        // 'nroPO': $("#nropo").val(),
        'DUID': $("#idduid").val(),
        'proyecto': $("#id_proyecto_sitio").val(),
        'sitio': $("#id_sitio").val(),
        //'posible_fecha': $("#fechainicial").val(),
        'usuario_asignado': id_us,
        ///detalle
        'id_eetalle': id_det,
        'mes_corresp': $("#mes_registro :selected").val(),
        'desc_item': desc,
        'monto_desc': mont,
        'eliminados': $("#ids_borrados").val()

    }
    , function (data) {
        //  $("#" + div_dialog + " #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
        //$("#" + div_dialog + " #respuesta").html(data);
        // alert($("#ayudata").val());
        //alert(data);
        datas = data.split('*');
        info = "";
        for ($j = 1; $j < datas.length; $j++) {
            info += "\n " + datas[$j];
        }
        new PNotify({
            title: 'Registro Exitoso!',
            text: info,
            type: 'success',
            styling: 'bootstrap3'
        });
        setTimeout(function () {

            $("#bloqueo_pagina").addClass("ocultar");
            location.reload();

        }, 3000);

    });

}
function eliminar_item_po(id_po)
{

    burl = $('#b_url').val();
    var r = confirm("Estas seguro que desea ELIMINAR este registro");
    if (r == true) {
        $("#bloqueo_pagina").removeClass("ocultar");

        $.post(burl + "control_proyecto/eliminar_items_po", {
            'item': id_po
        }
        , function (data) {
            //  $("#" + div_dialog + " #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
            //$("#" + div_dialog + " #respuesta").html(data);
            // alert($("#ayudata").val());
            //alert(data);
            datos = data.replace("\n", "");
            new PNotify({
                title: 'Eliminado Exitosamente!',
                text: datos,
                styling: 'bootstrap3'
            });
            setTimeout(function () {

                $("#bloqueo_pagina").addClass("ocultar");
                location.reload();

            }, 3000);

        });
    }


}

function borrarcontenidoPO()
{
    // alert ("se borraron los Datos");
    $("#nropo").val("");
    $("#tituloPO").val("");
    $("#monto").val("");
    $("#duracion").val("");
    $("#id_personal :selected").val();
    $("#comentario").val("");
    $("#proyinterno").val("");
    $("#itemsdetalle").val("");
    $("#nro_reg").val(0);

}
function editar_po(po)
{

    burl = $('#b_url').val();
    $.post(burl + "control_proyecto/obtener_PO/" + po, {}
    , function (data) {
        $("#recuperacion").html(data);


        $("#idpo").val($("#Aidpo").val());
        $("#nropo").val($("#Anropo").val());
        $("#tituloPO").val($("#Atitulo").val());
        $("#monto").val($("#Amonto").val());
        //$("#duracion").val($("#").val());
        //$("#id_personal :selected").val();
        $("#comentario").val($("#Aobservaciones").val());



    });

}

function mostrar_fomrulario_nueva_rendicion(id_rend)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html('formulario_rendicion', burl + 'rendiciones/nueva_rendicion/' + id_rend, 0);//modulo=0 no sirve

}


////*******************************************************************************************************
function alerta(inform)
{
    alert(inform);
}

function  cargarlistar_orden_compra(div_resultado)
{
    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post($('#b_url').val() + "control_proyecto/lista_orden_compra", {}
    , function (data) {
        $("#" + div_resultado).html(data);
    });
}

function search_orden_compra(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina_registros").val(1);
        search_and_list_orden_compra('lista_movimiento_almacen');//(div resultado)
    }
}




function  buscarlistar_orden_compra(div_resultado)
{
    //alert("funcionara?");
    burl = $('#b_url').val();
    buscar = $("#search_mov").val();
    cant = $("#cant_reg :selected").val();
    pagina = $("#pagina_registros").val();
    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl + "control_proyecto/busqueda_lista_orden_compra", {
        'buscar': $('#search_mov').val(),
        'cant': $('#mostrarX :selected').val(),
        'pagina': $('#pagina_registros').val()
    }
    , function (data) {
        $("#" + div_resultado).html(data);
    });
}



function dialog_nuevo_orden_compra(div_dialog, direccion)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
    $("#" + div_dialog).dialog({
        title: "Registro Ordenes de Compra *control de proyectos*",
        autoOpen: true,
        height: $(window).height(),
        width: 700,
        modal: true,
        closeOnEscape: false,
        buttons: [
            {
                id: "save1_mov",
                text: "Registrar",
                //disabled: "false",
                click: function () {
                    $("#bloqueo_pagina").removeClass("ocultar");

                    $.post(burl + "control_proyecto/guardar_registro_orden_compra", {
                        'idordencompra': $("#idordencompra").val(),
                        'nroPO': $("#nropo").val(),
                        'DUID': $("#duid").val(),
                        'titulo': $("#titulo").val(),
                        'monto': $("#monto").val(),
                        'duracion': $("#duracion").val(),
                        'posible_fecha': $("#fechainicial").val(),
                        'usuario_asignado': $("#id_personal :selected").val()

                    }
                    , function (data) {
                        $("#" + div_dialog + " #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                        $("#" + div_dialog + " #respuesta").html(data);
                        // alert($("#ayudata").val());
                        setTimeout(function () {
                            //cargar_contenido_html(div_dialog,direccion,0);
                            dir = this.quita_parametros(direccion, 1);

                            cargar_contenido_html(div_dialog, dir + $("#ayudata").val(), 0);
                            cargarlistar_orden_compra("lista_ordenCompra");
                            $("#bloqueo_pagina").addClass("ocultar");

                        }, 3000);

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

function verificar_duid()
{
    duid = $("#duid").val();
    $.post(burl + "control_proyecto/obtener_sitio_duid/" + duid, {}
    , function (data) {
        $("#recuperacion").html(data);
        if ($("#AidSitio").val() != 0) {
            // alert("el DIUID ya fue registrado, por favor reviza el campo ingresado");
            // var txt;
            var r = confirm("El DIUID ya fue registrado, por favor revisa el campo ingresado, deseas continuar con el mismo DIUID, seguramente habra problemas en el Futuro");
            if (r == true) {
                $("#duplicidad").prop('checked', true);
            } else {
                $("#duplicidad").removeAttr('checked');
            }
            $("#duplicadoDUID").val(1);
        }
//
//        $("#id_sitio").val($("#AidSitio").val());
//        $("#duid").val($("#Aduid").val());
//        $("#titulo").val($("#Anombre").val());
//        //$("#id_personal :selected").val();
//        $("#comentario").val($("#coment").val());
//        apinte = $("#Apinte").val();
//
//        aproy = $("#Aproy").val();
//        //  alert(aproy);
//        $("#id_proyecto option").attr("selected", false);
//        $("#id_proyecto option[value='" + aproy + "']").attr("selected", "selected");
//        cargar_proy_interno(apinte);
    });

}
function cargar_grafica(div_res)
{
    burl = $('#b_url').val();
    meses = $("#gmeses").val();
   // $("#" + div_res).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl + "chars/reporte_rend_sitios", {
        'meses': meses,
        'poS': $("#gposm").val(),
        'rend': $("#grendm").val(),
        'util': $("#gutim").val()
    }
    , function (data) {
        $("#" + div_res).html(data);
    });
}
function grafica_stack(div_res)
{alert ('ingresa');
     burl = $('#b_url').val();
    $.post(burl + "chars/colum_stack", {
        
    }
    , function (data) {
        $("#" + div_res).html(data);
    });
    
}