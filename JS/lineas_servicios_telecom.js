function dialog_registro_lineas(div_dialog, direccion)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
    $("#" + div_dialog).dialog({
        title: "Registrar Lineas o Servicios de Telecomunicaciones",
        autoOpen: true,
        height: 650,
        width: 525,
        modal: true,
        closeOnEscape: false,
        buttons: [
            {
                id: "save1_mov",
                text: "Registrar",
                click: function () {
                    aclaracon = $($("#id_personal :selected")).text();
                    user_id = $("#id_personal :selected").val();
                    if ($("#otro").is(':checked'))
                    {
                        aclaracon = $("#otro_name").val();
                        user_id = 0;
                    }

                    $.post(burl + "linea_servicio/guarda_registro_linea_servicio", {
                        "id_lin_servicio": $("#id_linea").val(),
                        "instacia": $("#instancia").val(),
                        "estado": $("#estado :selected").val(),
                        "voz": $("#pvoz").val(),
                        "datos": $("#pdatos").val(),
                        "win": $("#win").val(),
                        "pago": $("#pagols").val(),
                        "contrato": $("#no_contrato").val(),
                        "proveedor": $("#proveedor :selected").val(),
                        "tipo": $("#tipo_servicio").val(),
                        "ciudad": $("#ciudad_id :selected").val(),
                        "lugar": $("#lugar").val(),
                        "proyect": $("#id_proyecto :selected").val(),
                        "id_user": user_id,
                        "aclaracion": aclaracon,
                        "observaciones": $("#observaciones").val()
                    }
                    , function (data) {
                        $("#" + div_dialog + " #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                        $("#" + div_dialog + " #respuesta").html(data);
                        //alert($("#ayudata").val());
                        search_and_list_lineas_servicios('lista_lineas');
                        setTimeout(function () {
                            //cargar_contenido_html(div_dialog,direccion,0);
                            dir = this.quita_parametros(direccion, 1);
                            cargar_contenido_html(div_dialog, dir + $("#ayudata").val(), 0);

                        }, 500);

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
                    //   search_and_list_lineas_servicios('lista_lineas');
                    // location.reload();
                    //$(this).dialog();
                }
            }
        ]
    });
}
function search_lineas(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $('#pagina_registros').val(1);
        search_and_list_lineas_servicios('lista_lineas');
    }
}

function search_and_list_lineas_servicios(div_resultado)
{
    burl = $('#b_url').val();
    // buscar=$("#search_mov_alm1").val();
    cant = $("#cant_reg :selected").val();
    pagina = $("#pagina_registros").val();
    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl + "linea_servicio/encontrar_list_lineas", {
        'buscar': $('#search_lin').val(),
        'cant': $('#mostrarX :selected').val(),
        'pagina': $('#pagina_registros').val()
    }
    , function (data) {
        $("#" + div_resultado).html(data);
    });
}






function dialog_registro_contratos_alquiler(div_dialog, direccion)
{

    $("#" + div_dialog).html($("#cargando_grande").html());
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
    $("#" + div_dialog).dialog({
        title: "Registrar Contratos de Alquiler",
        autoOpen: true,
        height: $(window).height(),
        width: 1040,
        modal: true,
        closeOnEscape: false,
        buttons: [
            {
                id: "registrar_contrato",
                text: "Registrar",
                click: function () {
                                        
                    $("#bloqueo_pagina").removeClass("ocultar");
                    cadena_relacion="";
                    ids = $('#id_proys').val();
                    id_p = ids.split(',');
                    for (i = 1; i < id_p.length; i++)
                    {
                        cadena_relacion+=";"+id_p[i]+"|"+$('#prorrateo' + id_p[i] + ' #porce_prorrateo').val()+"|"+$('#prorrateo' + id_p[i] + ' #costo_prorrateo').val();
                        
                    }
                    agua='no';
                    lu='no';
                    inte='no';
                    telfo='no';
                    if($("#agua").is(':checked'))
                        agua='si';
                    if($("#luz").is(':checked'))
                        lu='si';
                    if($("#inter").is(':checked'))
                        inte='si';
                    if($("#telfo").is(':checked'))
                        telfo='si';
                    
                    //alert(cadena_relacion);

                    $.post(burl + "linea_servicio/guarda_registro_contrato_alquiler", {
                        "id_contrato_alq": $("#id_contrato").val(),
                        "departamento": $("#departamento").val(),
                        "provincia": $("#provincia").val(),
                        "latitud": $("#Latitud").val(),
                        "longitud": $("#Longitud").val(),
                        "direccion_obj": $("#direccion").val(),
                        "descripcion_obj": $("#descripcion").val(),
                        "propietario": $("#Nombre_completo").val(),
                        "ci_prop": $("#ci_propietario").val(),
                        "telefono": $("#Telefono").val(),
                        "Celular": $("#Celular").val(),
                        "direccion_prop": $("#direccionProp").val(),
                        "fec_ini": $("#fecini").val(),
                        "duracion": $("#duracion").val(),
                        "fec_fin": $("#fecfin").val(),
                        "monto_garantia": $("#garantia").val(),
                        "monto_mes": $("#pago_mes").val(),
                        "monto_previsto": $("#total_previsto").val(),
                        "estado": $("#estado_contrato").val(),
                        "agua": agua,
                        "luz": lu,
                        "telefonia":telfo,
                        "internet": inte,
                        "cheque_dato": $("#pagoa").val(),
                        "cadena_relacion_proyecto_contrato": cadena_relacion

                    }
                    , function (data) {
                        $("#" + div_dialog + " #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                        $("#" + div_dialog + " #respuesta").html(data);
                        //alert($("#ayudata").val());
                        search_and_list_lineas_servicios('lista_lineas');
                        setTimeout(function () {
                            //cargar_contenido_html(div_dialog,direccion,0);
                            dir = this.quita_parametros(direccion, 1);
                            cargar_contenido_html(div_dialog, dir + $("#ayudata").val(), 0);$("#bloqueo_pagina").addClass("ocultar");
                            search_and_list_contrato_alquiler('lista_contratos');
                        }, 500);
                        

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
                    //   search_and_list_lineas_servicios('lista_lineas');
                    // location.reload();
                    //$(this).dialog();
                }
            }
        ]
    });
}


function adicionar_proyecto_prorrateo(proyecto_select)
{
    idproy = $('#' + proyecto_select + ' :selected').val();
    
    if (idproy != 0)
    {
        proy = $('#' + proyecto_select + ' :selected').text();
        cant = parseInt($('#c_proy').val());

        $('#c_proy').val(cant + 1);
        $('#id_proys').val($('#id_proys').val() + ',' + idproy);

        codigohtml = "<div class='grid_16 negrilla centrartexto filas_ama' id='prorrateo" + idproy + "'>\n\
                <div class='grid_6 alin_izq esparriba5'>" + proy + "</div>\n\
                <div class='grid_3'><input type='text' style='width: 100px;' value='0' id='porce_prorrateo' onchange='calculo_prorrateo_contrato()'></div> \n\
                <div class='grid_3'><input type='text' style='width: 100px;' value='0.00' id='costo_prorrateo' readonly='readonly'></div>\n\
                <div class='grid_2'><span class='milinktext' onclick='quitar_proyecto_contrato(\"id_proyecto_select\"," + idproy + ");'>Quitar</span></div>\n\
               </div>";
        $('#prorrateo_proy').append(codigohtml);
        $("#" + proyecto_select).find("option[value='" + idproy + "']").prop("disabled", true);
        $("#" + proyecto_select).val(0);
    }


}

function calculo_prorrateo_contrato()
{
    ids = $('#id_proys').val();
    id_p = ids.split(',');
    porcentajeTotal = 0;
    calculadoTotal = 0;
    for (i = 1; i < id_p.length; i++)
    {
        calculado = 0;
        prorrat = parseFloat($('#prorrateo' + id_p[i] + ' #porce_prorrateo').val()) / 100;
        calculado = prorrat * parseFloat($('#pago_mes').val());
        $('#prorrateo' + id_p[i] + ' #costo_prorrateo').val(calculado);
        calculadoTotal += calculado;
        porcentajeTotal += prorrat;
    }
    $("#porcent_total").html((porcentajeTotal * 100));
    $("#costo_total").html(calculadoTotal);
    if (porcentajeTotal == 1 && calculadoTotal == $('#pago_mes').val())
        $("#validacion").html("<span class='verdecolor'> Correcto </span>");
    else
        $("#validacion").html("<span class='colorRojo'> No cuadra </span>");

}
function calcular_monto_previsto_contrato()
{
    cantidad = parseFloat($('#duracion').val());
    pago_mes = parseFloat($('#pago_mes').val());
    $("#total_previsto").val(cantidad * pago_mes);

}
function quitar_proyecto_contrato(proyecto_select, id_proy)
{
    cant = parseInt($('#c_proy').val());
    $('#c_proy').val(cant - 1);
    $('#id_proys').val($('#id_proys').val().replace(',' + id_proy, ''));
    $('#prorrateo' + id_proy).remove();
    $("#" + proyecto_select).find("option[value='" + id_proy + "']").prop("disabled", false);
}

function calcula_fecha(fecini, fec_fin, meses)
{
    c_mes = parseInt($("#" + meses).val());
    fec_ini = $("#" + fecini).val();
    fechavec = fec_ini.split("/");
    var fecha = new Date(fechavec[0], fechavec[1], fechavec[2]); // crea el Date
    mes = fecha.getMonth() + c_mes;

    while (mes > 12)
    {
        fecha.setFullYear(fecha.getFullYear() + 1);
        mes = mes - 12;
    }
    fecha.setMonth(mes);
    res = fecha.getFullYear() + '/' + fecha.getMonth() + '/' + fecha.getDate();
    $("#" + fec_fin).val(res);
}

function subir_archivo_contrato_alquiler(div_dialog, div_destino)
{


    var formData = new FormData($("#" + div_destino + " #fileform")[0]);
    formData.append('destino', $("#" + div_destino + " #dest").val());
    formData.append('file_name', $("#" + div_destino + " #nombre_file").val());
    formData.append('titulo', $("#" + div_destino + " #titulo").val());
    formData.append('id_contrato', $("#" + div_destino + " #id_contrato_alquiler").val());

    var ruta = $("#b_url").val() + 'upload_archivo/subir_archivo_contrato_alquiler';
    $.ajax({
        url: ruta,
        data: formData,
        cache: false,
        contentType: false, //'multipart/form-data' se ha quitado esta opcion es algo raro la verda :o!!!
        processData: false,
        type: 'POST',
        success: function (data) {
                       buscar_archivos_relacionados('area_archivos_contratos',$("#" + div_destino + " #id_contrato_alquiler").val())
        }
    });
}


function search_contratos_alquiler(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $('#pagina_registros').val(1);
        search_and_list_contrato_alquiler('lista_contratos');
    }
}

function search_and_list_contrato_alquiler(div_resultado)
{
    burl = $('#b_url').val();
    // buscar=$("#search_mov_alm1").val();
    cant = $("#cant_reg :selected").val();
    pagina = $("#pagina_registros").val();
    
    $("#" + div_resultado).html($("#cargando_grande").html());
    $.post(burl + "linea_servicio/encontrar_contrato_alquiler", {
        'buscar': $('#search_lin').val(),
        'proyecto': $('#id_proyecto :selected').val(),
        'cant': $('#mostrarX :selected').val(),
        'pagina': $('#pagina_registros').val()
    }
    , function (data) {
        $("#" + div_resultado).html(data);
    });
}


function buscar_archivos_relacionados(mostrar_resultado,id_contrato_busqueda)
{
    $('#'+mostrar_resultado).html($("#cargando_grande").html());
    $.post(burl + "linea_servicio/obtener_archivos_contrato_alquiler/"+id_contrato_busqueda, {}
    , function (data) {
        $("#" + mostrar_resultado).html(data);
    });
}