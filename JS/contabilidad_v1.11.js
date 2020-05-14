/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function registrar_nueva_cuenta() {
    {


        informacion = {
            /// "id_plan": $('#id_plan').val(),
            "codigo": $('#codigo').val(),
            "titulo": $('#titulo').val(),
            "imputable": $('#imputable :selected').val(),
            "id_padre": $('#id_padre').val(),
            "comentario": $('#comentario').val()
        };
        baseurl = $("#b_url").val();

        $.post(baseurl + "contabilidad_plan_cuentas/guardar_nuevo_registro_cuenta", informacion
                , function (data) {
                    alert("Los datos ha registrado correctamente");
                    location.reload();

                });
    }
}


////// rendiciion
function dialog_nuevo_for_rendicion(div_dialog, direccion, titulo) {
    //alert('funciona');
    burl = $('#b_url').val();
//    $("#" + div_dialog).html('<div class="cargando_circulo" ></div>');
    $('#' + div_dialog).html($("#cargando_grande").html());
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve alert('funciona');
    $("#" + div_dialog).dialog({
        title: titulo,
        autoOpen: true,
        height: $(window).height(),
        width: 1050,
        modal: true,
        closeOnEscape: false,
        buttons: [
            {
                id: "fin_send",
                text: "finalizar y Enviar",
                disabled: true,
                click: function ()
                {
                    var items_select = $('#items_select').val();

                    var id_tipo_gasto = "";
                    var id_tipo_gastos_directo = "";
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
                    llave_paso = 1;
                    for (i = 1; i < vector.length; i++)
                    {

                        id_tipo_gasto = id_tipo_gasto + $('#dr' + vector[i] + ' #tipo_gasto :selected').val() + ';';
                        if ($('#dr' + vector[i] + ' #tipo_gasto_for :selected').val() == -1)
                        {   //alert();
                            $('#dr' + vector[i] + ' #tipo_gasto_for').addClass('NO')
                            llave_paso = 0;
                        }
                        id_tipo_gastos_directo = id_tipo_gastos_directo + $('#dr' + vector[i] + ' #id_apropiacion').val() + ';';
                        monto = monto + $('#dr' + vector[i] + ' #monto').val() + ';';
                        if ($('#dr' + vector[i] + ' #monto').val() == 0 || $('#dr' + vector[i] + ' #monto').val() == "")
                        {   //alert();
                            $('#dr' + vector[i] + ' #monto').addClass('NO')
                            llave_paso = 0;
                        }
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
                        estacion = estacion + $('#dr' + vector[i] + ' #estacion_sitio').val() + ';';
                        placa_vehiculo = placa_vehiculo + $('#dr' + vector[i] + ' #placa_veh').val() + ';';
                        if ($('#dr' + vector[i] + ' #tipo_gasto_for :selected').val() == 1 || $('#dr' + vector[i] + ' #tipo_gasto_for :selected').val() == 3)
                        {   //alert();
                            if ($('#dr' + vector[i] + ' #placa_veh').val() == "")
                            {
                                $('#dr' + vector[i] + ' #placa_veh').addClass('NO')
                                llave_paso = 0;
                            }
                        }
                        adjuntos = adjuntos + $('#dr' + vector[i] + ' #adjuntos_rutas' + vector[i]).val() + ';';
                    }

                    if (llave_paso == 1) {




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
             <br><span class="colorRojo negrilla "> ¿ Esta usted seguro de finalizar y enviar el Formulario de rendici&oacute;n ? <br></span><span>Una vez enviado no podr&aacute; realizar adiciones ni modificaciones\n\
                <br><br>La rendicion sera enviada a <br><br></span>\n\
                                        <div id="men_load">\n\
                                        <div class="cargando_circulo" ></div>\n\
                                        </div>\n\
                                    </div>';

                        $("#mensaje_fin").html(codigo);
                        $("#dialog_finalizacion").dialog({
                            title: "Finalizar y enviar",
                            autoOpen: true,
                            open: function (event, ui) {
                                $(".ui-dialog-titlebar-close").hide();
                            },
                            height: 270,
                            width: 600,
                            modal: true,
                            closeOnEscape: false,
                            buttons: {
                                "Si, estoy seguro": function () {
                                    if (typeof (resp[0]) == "undefined" || resp[0] == "undefined" || resp[0] == "")
                                    {
                                        alert("Espere a que termine de cargar...por favor.");
                                    } else {

                                        var items_select = $('#items_select').val();
                                        var id_tipo_gasto = "";
                                        var id_tipo_gastos_directo = "";
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
                                        //alert(vector.length

                                        for (i = 1; i < vector.length; i++)
                                        {
                                            id_tipo_gasto = id_tipo_gasto + $('#dr' + vector[i] + ' #tipo_gasto :selected').val() + ';';
                                            id_tipo_gastos_directo = id_tipo_gastos_directo + $('#dr' + vector[i] + ' #id_apropiacion').val() + ';';
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
                                        if (typeof (resp[0]) != "undefined" || resp[0] != "undefined" || resp[0] != "") {


                                            $.post(burl + "rendiciones/guardar_nueva_rendicion", {
                                                'tipo': id_tipo_gastos_directo,
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
                                                'id_resp_destino': "|" + resp[0] + "|",
                                                'tipo_rend': $('#tipo_rendicion :selected').val(),
                                                'desc': $('#desc').val(),
                                                'fec_reg': $('#fechaS').val()

                                            }

                                            , function (data) {
                                                // alert ("entra ");
                                                $("#" + div_dialog + " #respuesta").html(data);
                                                if ($('#ayudata').val() != 0)
                                                {    //alert('se ha adicionado categoria , con nro de Id : '+$('#ayudata').val())
                                                    search_and_list_mis_rendiciones_te('lista_rendicion');
                                                    //aqui puedo hacer que envie el correo electronico al usuario superior
                                                    $.post(burl + "rendiciones/enviar_correo", {
                                                        'id_rendicion': $('#ayudata').val()
                                                    }
                                                    );
                                                }
                                                setTimeout(function () {
                                                    nuevadireccion = this.quita_parametros(direccion, 1);
                                                    //alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                                                    cargar_contenido_html(div_dialog, nuevadireccion + $('#ayudata').val(), 0);
                                                    $("#dialog_finalizacion").dialog("close");
                                                    $("#dialog_finalizacion").dialog('destroy').remove();
                                                    $("#" + div_dialog).dialog("close");

                                                }, 1000);//alert('funciona'); 


                                            });
                                        } else
                                        {
                                            alert(" UP's Sucedio algo inesperado!! \n\, Intentalo otra vez y si el problema continua comunicate con el administrador del sistema.");
                                            $("#dialog_finalizacion").dialog("close");
                                            $("#dialog_finalizacion").dialog('destroy').remove();
                                        }

                                    }
                                },
                                "No, quiero volver ": function () {

                                    $("#dialog_finalizacion").dialog('destroy').remove();
                                }
                            }
                        });
                    } else
                    {
                        alert("Se han encontrado errores en el formulario...\n Procure guardar el formulario antes de enviar \n los elementos del formulario resaltados en rojo, tienen error!");
                        $("#bloqueo_pagina").addClass("ocultar");
                        $('#save').button('enable');
                        $('#fin_send').button('enable');
                    }
                }
            }, {
                id: "save",
                text: "Guardar",
                disabled: true,
                click: function ()
                {
                    $('#save').button('disable');
                    $('#fin_send').button('disable');
                    $("#bloqueo_pagina").removeClass("ocultar");
                    var items_select = $('#items_select').val();

                    var id_tipo_gasto = "";
                    var id_tipo_gastos_directo = "";
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
                    llave_paso = 1;
                    for (i = 1; i < vector.length; i++)
                    {

                        id_tipo_gasto = id_tipo_gasto + $('#dr' + vector[i] + ' #tipo_gasto :selected').val() + ';';
                        if ($('#dr' + vector[i] + ' #tipo_gasto_for :selected').val() == -1)
                        {   //alert();
                            $('#dr' + vector[i] + ' #tipo_gasto_for').addClass('NO')
                            llave_paso = 0;
                        }
                        id_tipo_gastos_directo = id_tipo_gastos_directo + $('#dr' + vector[i] + ' #id_apropiacion').val() + ';';
                        monto = monto + $('#dr' + vector[i] + ' #monto').val() + ';';
                        if ($('#dr' + vector[i] + ' #monto').val() == 0 || $('#dr' + vector[i] + ' #monto').val() == "")
                        {   //alert();
                            $('#dr' + vector[i] + ' #monto').addClass('NO')
                            llave_paso = 0;
                        }
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
                        estacion = estacion + $('#dr' + vector[i] + ' #estacion_sitio').val() + ';';
                        placa_vehiculo = placa_vehiculo + $('#dr' + vector[i] + ' #placa_veh').val() + ';';
                        if ($('#dr' + vector[i] + ' #tipo_gasto_for :selected').val() == 1 || $('#dr' + vector[i] + ' #tipo_gasto_for :selected').val() == 3)
                        {   //alert();
                            if ($('#dr' + vector[i] + ' #placa_veh').val() == "")
                            {
                                $('#dr' + vector[i] + ' #placa_veh').addClass('NO')
                                llave_paso = 0;
                            }
                        }
                        adjuntos = adjuntos + $('#dr' + vector[i] + ' #adjuntos_rutas' + vector[i]).val() + ';';
                    }

                    // alert(adjuntos);


                    if (llave_paso == 1) {
                        $.post(burl + "rendiciones/guardar_nueva_rendicion", {
                            'tipo': id_tipo_gastos_directo,
                            'monto': monto,
                            'fac': nro_fac,
                            'f_s': c_s_factura,
                            'fec_f': fecha_factura,
                            'total': total,
                            'estado': "Guardado",
                            'glo_f': glosa_factura,
                            'pla_f': placa_vehiculo,
                            'cob_f': cobra_cliente,
                            'adj_f': adjuntos,
                            'id_rend': $('#id_rend').val(),
                            'id_proy': $('#proyecto_seleccionado :selected').val(),
                            'id_usu': $('#tecnico_seleccionado :selected').val(),
                            'id_resp_destino': 0,
                            'tipo_rend': $('#tipo_rendicion :selected').val(),
                            'desc': $('#desc').val(),
                            'fec_reg': $('#fechaS').val(),
                            'estaciones_selec': estacion

                        }

                        , function (data) {
                            // alert ("entra ");
                            $("#" + div_dialog + " #respuesta").html(data);
                            if ($('#ayudata').val() != 0) {
                                //alert('se ha adicionado categoria , con nro de Id : '+$('#ayudata').val())
                                // setTimeout(function () {
                                nuevadireccion = quita_parametros(direccion, 1);
                                //alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                                cargar_contenido_html(div_dialog, nuevadireccion + $('#ayudata').val(), 0);

                                //}, 500);//alert('funciona'); 
                                search_and_list_mis_rendiciones_te('lista_rendicion');
                                $("#bloqueo_pagina").addClass("ocultar");
                            }

                        });
                    } else
                    {
                        alert("Se han encontrado errores en el formulario...!");
                        $("#bloqueo_pagina").addClass("ocultar");
                        $('#save').button('enable');
                        $('#fin_send').button('enable');
                    }

                }
            },
            /*"Enviar":function(){
             $( this ).dialog( "close" );
             baseurl=$("#b_url").val()+'impresiones_pdf/imp_form_rendiciones/'+$('#id_rend').val();  
             miven=window.open (baseurl, "mywindow","menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");
             }
             ,*/{
                id: "close",
                text: "Cerrar",
                click: function () {

                    $(this).dialog("close");
                    // search_and_list_mis_rendiciones_te('lista_rendicion');
                    //location.reload();
                }
            }


        ]
    });
}
//generar reporte


function Imp_reporte_de_rendicion(id_rend)
{
    // alert (registro);
    //alert($("#burl").val());
    baseurl = $("#b_url").val() + 'impresiones_pdf/imp_form_rendiciones/' + id_rend;
    miven = window.open(baseurl, "mywindow", "menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");

}
function Imp_reporte_de_rendicion_asiento(id_rend)
{
    // alert (registro);
    //alert($("#b_url").val());
    baseurl = $("#b_url").val() + 'impresiones_pdf/imp_form_rendiciones_asiento/' + id_rend;
    miven = window.open(baseurl, "mywindow", "menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");

}


function add_registro() {
    var nd = parseInt($('#nro_reg').val()) + 1;
    $('#nro_reg').val(nd);
    $('#items_select').val($('#items_select').val() + ',' + nd);
    $('#muestra_cuenta').html(nd);

    var codigo = $('#grilla_modelo').html();
    codigo = codigo.replace(/XX/gi, nd);
    $('#add_nuevo_rendicion').append('<div id="dr' + nd + '" class="">' + codigo + '</div>');
    $("#fec_fact" + nd).datepicker();

}
/*function funcion_ayuda(){
 var nd= parseInt($('#nro_reg').val())+1;
 $('#nro_reg').val(nd);
 $('#items_select').val($('#items_select').val()+','+nd);
 
 var codigo= $('#grilla_modelo').html();
 codigo=codigo.replace(/XX/gi, nd);
 $('#add_nuevo_rendicion').append('<div id="dr'+nd+'" class="grid_15">'+codigo+'</div>');
 }*/
function carga_tipo_gasto(campo_parametro, campo_respuesta, bloque, seleccionado)
{
    //alert($('#'+campo_parametro+' :selected').val());
    $("#" + bloque).html('<div class="cargando_barra" ></div>');
    $.post(burl + "rendiciones/buscar_tipo_gasto", {
        'tipo_gasto': $('#' + campo_parametro + ' :selected').val(),
        'id_campo': campo_respuesta,
        'seleccionado': seleccionado,
        'campo_parametro': campo_parametro
    }
    , function (data) {
        // alert(data);
        $("#" + bloque).html(data);

    });
}
function del_registro_rendicion(variable) {
   deldet=$('#dr'+variable+' #id_det_rend').val();
    $('#det_delete').val($('#det_delete').val()+","+deldet);
    $('#dr' + variable).remove();

    var dato = $('#items_select').val();
    dato = dato.replace(',' + variable, '');
    $('#items_select').val(dato);
    sumar_total_rend();
}


//adicionando busqueda 8/12/15

function search_ren(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina_registros").val(1);
        search_and_list_rendicion('lista_rendicion');
    }

}
function search_and_list_rendicion(div_resultado)
{
    /// alert ("ingresando a la funcion!!!!!!!!!!");
    burl = $('#b_url').val();
    /* buscar=$("#search_ren").val();
     cant=$("#cant_reg :selected").val();
     pagina=$("#pagina_registros").val();*/
    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');

    $.post(burl + "rendiciones/busqueda_de_rendiciones", {
        'buscar': $('#search_rendicion').val(),
        'cant': $('#mostrarX :selected').val(),
        'pagina': $('#pagina_registros').val()
    }

    , function (data) {
        $("#" + div_resultado).html(data);
    });

}
/*function val_numero(evento){
 
 alert(String.fromCharCode(evento.which) );
 
 }*/
function val_numero(campo)
{
    //  alert('entraaa');
    valor = $("#" + campo).val();
    c = valor.substring((valor.length) - 1);
    //alert("valor "+valor+" c= "+c);
    permitido = "0123456789"
    if (c == "," || c == ".")
    {
        valor_final = valor.substring(0, (valor.length) - 1) + ".";
    } else
    {
        //  alert("if : "+permitido.indexOf(c));
        if (permitido.indexOf(c) == -1)
        {
            valor_final = valor.substring(0, (valor.length) - 1);
        } else
            valor_final = valor;
    }
    $("#" + campo).val(valor_final);

}

//adicionado 18/02/16
function search_ren_jp(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina_registros").val(1);
        search_and_list_rendicion_jefe_proy('lista_rendicion');
    }

}
function search_and_list_rendicion_jefe_proy(div_resultado)
{
    /// alert ("ingresando a la funcion!!!!!!!!!!");
    burl = $('#b_url').val();
    /* buscar=$("#search_ren").val();
     cant=$("#cant_reg :selected").val();
     pagina=$("#pagina_registros").val();*/
    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');

    $.post(burl + "contabilidad_plan_cuentas/busqueda_de_rendiciones_jp", {
        'buscar': $('#search_rendicion').val(),
        'cant': $('#mostrarX :selected').val(),
        'pagina': $('#pagina_registros').val()
    }

    , function (data) {
        $("#" + div_resultado).html(data);
    });

}
//hasta aqui adicionado


