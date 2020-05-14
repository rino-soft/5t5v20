
//fuinciones referentes a Chequera electronica

function calendario(elemento)
{
    alert($("#b_url").val());
    $("#"+elemento).datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true,
        format: 'YYYY-MM-DD'
    });

}

function mostrar_fomrulario_cheques_sp(id_rend)
{
    //alert('form');
    burl = $('#b_url').val();
    this.cargar_contenido_html('formcheques', burl + 'e_chequera/form_cheques_sp/' + id_rend, 0);//modulo=0 no sirve
}
function mostrar_fomrulario_cheques_rend(id_rend)
{
    //alert('form');
    burl = $('#b_url').val();
    this.cargar_contenido_html('formcheques', burl + 'e_chequera/form_cheques_rend/' + id_rend, 0);//modulo=0 no sirve
}

function mostrar_fomrulario_fondos_rendir_cheque(id_rend)
{
    //alert('form');
    burl = $('#b_url').val();
    this.cargar_contenido_html('formcheques', burl + 'e_chequera/form_cheques_fr/' + id_rend, 0);//modulo=0 no sirve
}
function actualizar_cheques_sp()
{


    buscar = $("#solpago_busqueda").val();
    // alert(buscar);
    burl = $('#b_url').val();
    agrupar = "no";
    if ($("#agrupar").is(":checked"))
        agrupar = "si";
    //this.cargar_contenido_html('solpago', burl + 'e_chequera/obtenersolpagocheque/' + buscar, 0);//modulo=0 no sirve
    $.post(burl + "e_chequera/obtenersolpagocheque/", {
        'buscar': buscar,
        'inicial_cheque': $("#inicial_cheque").val(),
        'fecha_todos': $("#fecha_todos").val(),
        'comprobantes': $("#comprobantes_registrados").val(),
        'agrupar': agrupar
    }

    , function (data) {
        $("#solpago").html(data);
    });


}
function buscar_fr(event)
{

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {

        // alert("busqueda");
        // $("#pagina_registros").val(1);
        //search_and_list_cheques('lista_cheques');
        buscar = $("#solpago_busqueda").val();
        // alert(buscar);
        burl = $('#b_url').val();
        //this.cargar_contenido_html('solpago', burl + 'e_chequera/obtenersolpagocheque/' + buscar, 0);//modulo=0 no sirve
        agrupar = "no";
        if ($("#agrupar").is(":checked"))
            agrupar = "si";


        $.post(burl + "e_chequera/obtenerFondosRendircheque/", {
            'buscar': buscar,
            'inicial_cheque': $("#inicial_cheque").val(),
            'fecha_todos': $("#fecha_todos").val(),
            'comprobantes': $("#comprobantes_registrados").val(),
            'agrupar': agrupar
        }

        , function (data) {
            $("#solpago").html(data);
        });

    }
}
function actualizar_cheques_fr()
{


    buscar = $("#solpago_busqueda").val();
    // alert(buscar);
    burl = $('#b_url').val();
    agrupar = "no";
    if ($("#agrupar").is(":checked"))
        agrupar = "si";
    //this.cargar_contenido_html('solpago', burl + 'e_chequera/obtenersolpagocheque/' + buscar, 0);//modulo=0 no sirve
    $.post(burl + "e_chequera/obtenerFondosRendircheque/", {
        'buscar': buscar,
        'inicial_cheque': $("#inicial_cheque").val(),
        'fecha_todos': $("#fecha_todos").val(),
        'comprobantes': $("#comprobantes_registrados").val(),
        'agrupar': agrupar
    }

    , function (data) {
        $("#solpago").html(data);
    });


}
function actualizar_cheques_rend()
{


    buscar = $("#solpago_busqueda").val();
    // alert(buscar);
    burl = $('#b_url').val();
    agrupar = "no";
    if ($("#agrupar").is(":checked"))
        agrupar = "si";
    //this.cargar_contenido_html('solpago', burl + 'e_chequera/obtenersolpagocheque/' + buscar, 0);//modulo=0 no sirve
    $.post(burl + "e_chequera/obtenerRendcheque/", {
        'buscar': buscar,
        'inicial_cheque': $("#inicial_cheque").val(),
        'fecha_todos': $("#fecha_todos").val(),
        'comprobantes': $("#comprobantes_registrados").val(),
        'agrupar': agrupar
    }

    , function (data) {
        $("#solpago").html(data);
    });


}

function buscar_sp(event)
{

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {

        // alert("busqueda");
        // $("#pagina_registros").val(1);
        //search_and_list_cheques('lista_cheques');
        buscar = $("#solpago_busqueda").val();
        // alert(buscar);
        burl = $('#b_url').val();
        //this.cargar_contenido_html('solpago', burl + 'e_chequera/obtenersolpagocheque/' + buscar, 0);//modulo=0 no sirve
        agrupar = "no";
        if ($("#agrupar").is(":checked"))
            agrupar = "si";


        $.post(burl + "e_chequera/obtenersolpagocheque/", {
            'buscar': buscar,
            'inicial_cheque': $("#inicial_cheque").val(),
            'fecha_todos': $("#fecha_todos").val(),
            'comprobantes': $("#comprobantes_registrados").val(),
            'agrupar': agrupar
        }

        , function (data) {
            $("#solpago").html(data);
        });

    }
}
function buscar_rend(event)
{

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {

        // alert("busqueda");
        // $("#pagina_registros").val(1);
        //search_and_list_cheques('lista_cheques');
        buscar = $("#solpago_busqueda").val();
        // alert(buscar);
        burl = $('#b_url').val();
        //this.cargar_contenido_html('solpago', burl + 'e_chequera/obtenersolpagocheque/' + buscar, 0);//modulo=0 no sirve
        agrupar = "no";
        if ($("#agrupar").is(":checked"))
            agrupar = "si";


        $.post(burl + "e_chequera/obtenerRendcheque/", {
            'buscar': buscar,
            'inicial_cheque': $("#inicial_cheque").val(),
            'fecha_todos': $("#fecha_todos").val(),
            'comprobantes': $("#comprobantes_registrados").val(),
            'agrupar': agrupar
        }

        , function (data) {
            $("#solpago").html(data);
        });

    }
}


function quitar_cheque(id_cheque)
{
    cheque = id_cheque.split("_");

    $("#cheque" + id_cheque).remove();
    // $('#quitar_cheque').replace(id_cheque,"");
    for (i = 0; i < cheque.length; i++) {
        $("#solpago_busqueda").val($('#solpago_busqueda').val().replace(cheque[i], ""));

    }
    $("#sp_encontrados").val($('#sp_encontrados').val().replace(id_cheque, ""));
    $("#actualizar_busqueda").click();

}


//////////////////////////////////////*********************************************///////////////////
function buscar_datos_cuentas()
{
    //lert("entra a la funcion");
    burl = $('#b_url').val();
    $("#resultado_busqueda_cheque").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl + "e_chequera/busqueda_cuentas", {
        'buscar': $('#busqueda_cuentas').val(),
        'tipo': $('input:radio[name=tipo_cheque]:checked').val()
    }

    , function (data) {
        $("#resultado_busqueda_cheque").html(data);
    });
}
function guardar_imprimir_cheque()
{

    $("#botonguardar").addClass('ocultar');
    burl = $('#b_url').val();
    //$("#resultado_busqueda_cheque").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    encontrados = $("#sp_encontrados").val();
    encontradosvec = encontrados.split(",");
    console.log(encontradosvec);
    dirigido_a = "";
    monto = "";
    fechas = "";
    comentario = "";
    detalle_dirigido = "";
    nro_cheques = "";
    comprobantes = "";
    id_documentos = "";
    error = "";
    sw = 1;
    llave = 1;
    for (i = 0; i < encontradosvec.length; i++) {
        if (sw == 0)
        {
            dirigido_a += "|";
            monto += "|";
            fechas += "|";
            //fechas=$("#cheque"+encontradosvec[i]+" #fec_cheque").val();
            comentario += "|";
            detalle_dirigido += "|";
            nro_cheques += "|";
            comprobantes += "|";
            id_documentos += "|";
        }
        sw = 0;

        dirigido_a += $("#cheque" + encontradosvec[i] + " #dirigido_a").val();
        monto += $("#cheque" + encontradosvec[i] + " #monto").val() + "";
        // alert($("#cheque" + encontradosvec[i] + " #fec_cheque").val());
        if ($("#cheque" + encontradosvec[i] + " #fec_cheque").val() == "")
        {
            llave = "0";
            error = "alguno de los cheques no contiene fecha , revisa por favor";

        }
        fechas += $("#cheque" + encontradosvec[i] + " #fec_cheque").val();
        //fechas=$("#cheque"+encontradosvec[i]+" #fec_cheque").val();
        comentario += $("#cheque" + encontradosvec[i] + " #comentario").val();
        detalle_dirigido += $("#cheque" + encontradosvec[i] + " #det_dirigido").val();
        nro_cheques += $("#cheque" + encontradosvec[i] + " #nro_cheque").val();
        comprobantes += $("#cheque" + encontradosvec[i] + " #comprobante").val();
        id_documentos += $("#cheque" + encontradosvec[i] + " #id_docu").val();
    }
    console.log(encontradosvec);
    console.log(dirigido_a);
    console.log(monto);
    console.log(fechas);
    console.log(comentario);
    console.log(detalle_dirigido);
    if (llave == 1) {
        $.post(burl + "e_chequera/registrar_cheques_varios", {
            'dirigido_a': dirigido_a,
            'monto': monto,
            'fecha_cheque': fechas,
            'comentario': comentario,
            'detalle_dirigido': detalle_dirigido,
            'nro_cheque': nro_cheques,
            'comprobante': comprobantes,
            'ids_documentos': id_documentos,
            'documento': $("#documento").val(),
            'tipo': $("#tipo").val()
                    //'tipo': $('input:radio[name=tipo_cheque]:checked').val()
        }

        , function (data) {
//        $("#resultado_busqueda_cheque").html(data);
//        ayudata = $("#ayudata").val();
//
            direccion = burl + 'impresiones_pdf/imprimir_cheque_varios/' + data;
            miven = window.open(direccion, "cheque" + data, "menubar=0,location=1,status=1,scrollbars=0, width=900,height=600");
            //  $("#botonguardar").removeClass('ocultar');
            //  search_and_list_cheques('lista_cheques');
            location.reload();
        });
    } else
        alert(error);

}
function comprobantesHist(id_div)
{

    hist = $("#comprobantes_registrados").val();
    historial = '';
    vechis = hist.split("*");
    sw = 0;
    for (i = 0; i < vechis.length; i++)
    {
        if (vechis[i] != "") {
            comp = vechis[i].split("|");
            if (comp[0] == id_div) {
                comp[1] = $("#cheque" + id_div + " #comprobante").val();
                sw = 1;
            }
            historial += comp[0] + "|" + comp[1] + "*";
        }

    }
    if (sw == 0) {
        registro = $("#cheque" + id_div + " #comprobante").val();
        //    alert("registro" + registro);
        $("#comprobantes_registrados").val(historial + id_div + "|" + registro + "*");
    } else
    {
        $("#comprobantes_registrados").val(historial);
    }
}

function imprimir_cheque(id_cheque)
{
    burl = $('#b_url').val();
    direccion = burl + 'impresiones_pdf/imprimir_cheque/' + id_cheque;
    miven = window.open(direccion, "cheque" + id_cheque, "menubar=0,location=1,status=1,scrollbars=0, width=900,height=600");

}

function search_and_list_cheques(div_resultado)
{
    burl = $('#b_url').val();

    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl + "e_chequera/busqueda_lista_chequera", {
        'buscar': $('#search_ov_pf').val(),
        'cant': $('#mostrarX :selected').val(),
        'pagina': $('#pagina_registros').val()
    }
    , function (data) {
        $("#" + div_resultado).html(data);
    });
}
function search_cheque_enter(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina_registros").val(1);
        search_and_list_cheques('lista_cheques');
    }

}
function borrar_datos_cheque()
{
    $('#dirigido_a').val("");
    $('#monto_cheque').val("");
    $('#comentario_cheque').val("");
    $('#det_dirigido').val("");
    $('#busqueda_cuenta').val("");
    $('#resultado_busqueda_cheque').html("");
}
function busca_lista_cuentas_empresa(div_resultado)
{
    burl = $('#b_url').val();

    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl + "e_chequera/busqueda_lista_cuentas_empresa", {
        'buscar': $('#search_cuenta').val(),
        'cant': $('#mostrarX :selected').val(),
        'pagina': $('#pagina_registros').val()
    }
    , function (data) {
        $("#" + div_resultado).html(data);
    });
}

function search_cuenta_empresa_enter(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina_registros").val(1);
        busca_lista_cuentas_empresa('lista_cuentas');
    }

}

function dialog_adicionar_cuenta_empresa_personal(div_dialog, direccion, id_usuario)
{
    burl = $('#b_url').val();
    $("#" + div_dialog).html('<div class="cargando_circulo" ></div>');
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve alert('funciona');
    $("#" + div_dialog).dialog({
        title: "Cuentas personales",
        autoOpen: true,
        height: $(window).height(),
        width: 1050,
        modal: true,
        closeOnEscape: false,
        buttons: [
            {
                id: "close",
                text: "Cerrar",
                click: function () {
                    $(this).dialog("close");
                    busca_lista_cuentas_empresa('lista_cuentas');
                }
            }


        ]
    });
}

function guardar_registro_cuenta_personal()
{
    burl = $('#b_url').val();

    // $("#ensima").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $("#guardar").attr("disabled", 'true');
    $.post(burl + "e_chequera/guardar_registro_cuenta", {
        'id_cuenta': $('#id_cuenta').val(),
        'banco': $('#bank').val(),
        'cuenta': $('#cuenta').val(),
        'usuario': $('#id_user').val(),
        'estado': $("input:radio[name=estado]:checked").val(),
        'comentario': $('#comentario').val()
    }
    , function (data) {
        alert(data);
        cargar_contenido_html('div_formularios_dialog', burl + 'e_chequera/form_add_cuenta_banco/' + $('#id_user').val(), 0);
    });
}
function cargar_datos_editar(id_cuenta, banco, cuenta, estado, comentario)
{
    $("#id_cuenta").val(id_cuenta);
    $("#bank").val(banco);
    $("#cuenta").val(cuenta);

    $("input:radio[name=estado][value=" + estado + "]").attr('checked', true);
    $("#comentario").val(comentario);
}

function eliminar_registro_cuenta_empresa(id_cuenta)
{
    var r = confirm("seguro que desea Eliminar el registro!!");
    if (r == true) {
        baseurl = $("#b_url").val();
        $.post(baseurl + "e_chequera/eliminar_cuenta_empresa/" + id_cuenta, {
        }
        , function (data) {

            cargar_contenido_html('div_formularios_dialog', baseurl + 'e_chequera/form_add_cuenta_banco/' + $('#id_user').val(), 0);

        });
    }


}
function imp_resumen_dia()
{
    burl = $('#b_url').val();
    fec=$("#fecha_resumen").val();
    direccion = burl + 'impresiones_pdf/imprimir_cheque_resumen/' + fec;
    miven = window.open(direccion, "resumen" + fec, "menubar=0,location=1,status=1,scrollbars=0, width=900,height=600");

}