function formulario_cobro(div_dialog, direccion)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve

//    inf=datos.split("|");
//    $("#" + div_dialog+" #ifa").html(id_factura);
//    $("#" + div_dialog+" #f").html(inf[0]);
//    $("#" + div_dialog+" #rs").html(inf[1]);
//    $("#" + div_dialog+" #n").html(inf[2]);
//    $("#" + div_dialog+" #cc").val($("#comentariooculto"+id_factura).val());
//    
//    $("#" + div_dialog+" #mf").val(montofac);
//    $("#" + div_dialog+" #p").val(penalidad);
//    $("#" + div_dialog+" #mc").val(montofac);

    $("#" + div_dialog).dialog({
        title: "Registrar Cobro",
        autoOpen: true,
        height: $(window).height(),
        width: 1050,
        modal: true,
        closeOnEscape: false,
        buttons: [
            {
                id: "Anular_cobro",
                text: "Anular Registro de Cobro",
                style: "background:#FF7A7E; color:#000000;",
                click: function () {
                    $("#bloqueo_pagina").removeClass("ocultar");
                    $('#save').button('disable');
                    $.post(burl + "factura_venta/registrar_cobro_factura/", {
                        'id_cobro': $("#id_cobro").val(),
                        'id_factura': $("#id_factura").val(),
                        'monto_factura': $("#monto_fac").val(),
                        'monto_penalidad': $("#monto_pen").val(),
                        'monto_cobrado': $("#monto_cob").val(),
                        'id_cliente': $("#id_cliente").val(),
                        'id_proyecto': $("#id_proyecto").val(),
                        'id_contrato': $("#id_contrato").val(),
                        'numero_oc': $("#num_oc").val(),
                        'fecha_registro': $("#fecha_cobro").val()

                    }
                    , function (data) {
                        $("#" + div_dialog + " #mensajes_respuestas").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Registrando Factura...</div>');
                        $("#" + div_dialog + " #mensajes_respuestas").html(data);//   dir=direccion.substring(0,(direccion.length)-2);
                        search_and_list_factura_venta('lista_oventa_prefacturas');
                    });
                }
            },
            {
                id: "cobro",
                text: "Guardar Registro de Cobro",
                style: "background:#2E6134; color:#FFFFFF;",
                click: function () {
                    $.post(burl + "factura_venta/registrar_cobro_factura/", {
                        'id_factura': id_factura,
                        'coment_gral': $("#comentariooculto" + id_factura).val() + " * A N U L A D O .- " + $("#" + div_dialog + " #comentario").val()
                    }
                    , function (data) {
                        $("#" + div_dialog + " #mensajes_respuestas").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Registrando Factura...</div>');
                        $("#" + div_dialog + " #mensajes_respuestas").html(data);//   dir=direccion.substring(0,(direccion.length)-2);
                        search_and_list_factura_venta('lista_oventa_prefacturas');
                    });
                }
            },
            {
                id: "close",
                text: "Cancelar",
                click: function () {
                    $(this).dialog("close");

                }
            }
        ]
    });


}
function qr_new()
{
     burl = $('#b_url').val();
    cod=$("#codigo_cre").val();
    $("#codigo_cre").val(parseInt(cod)+1);
    $.post(burl + "credenciales/qr_masivo_credencial/"+cod,{},function (data){});
    
}


function dialog_nueva_credencial(div_dialog, direccion)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
   
    $("#" + div_dialog).dialog({
        title: "Factura de Venta",
        autoOpen: true,
        height: $(window).height(),
        width: 1050,
        modal: true,
        closeOnEscape: false,
        buttons: [
            {
                id: "new_reg",
                text: "Nuevo Registro en BLANCO",
                style: "background:#FFC162; color:#000000;",
                disabled: true,
                click: function () {
                    nuevadireccion = quita_parametros(direccion, 1);
                    //alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                    cargar_contenido_html(div_dialog, nuevadireccion + 0, 0);
                    $('#save').button('disable');
                    $('#print').button('disable');
                    $('#new_reg').button('disable');

                }
            },
            {
                id: "print",
                text: "Imprimir",
                style: "background:#043E94; color:#DDDDDD;",
                disabled: true,
                click: function () {
                    imp_nota_fiscal($('#id_ov_pf').val());

                }
            },
            {
                id: "save",
                text: "Guardar",
                disabled: "true",
                click: function () {
                    $("#bloqueo_pagina").removeClass("ocultar");
                    $('#save').button('disable');


                    validacion = 1;
                    ids = $("#items_select").val();
                    ids_dev = $("#items_select_dev").val();
                    vec = ids.split(",");
                    vec_dev = ids_dev.split(",");
                    data_des = "";
                    data_cant = "";
                    data_pu = "";
                    data_sub = "";
                    for (i = 1; i < vec.length; i++)
                    {
                        // alert("vec["+i+"]"+vec[i]);
                        //data_ids+="|"+vec[i];
                        //data_cod+="|"+$("#sel"+vec[i]+" #cod_ps").val();
                        //data_tit+="|"+$("#sel"+vec[i]+" #tit_ps").val();
                        data_des += "|" + $("#fila" + vec[i] + " #descripcion_f").val();
                        //data_comen+="|"+$("#sel"+vec[i]+" #coment").val();
                        data_cant += "|" + $("#fila" + vec[i] + " #cantidad_f").val();
                        //data_um+="|"+$("#sel"+vec[i]+" #um").val();
                        data_pu += "|" + $("#fila" + vec[i] + " #precio_unitario_f").val();
                        if ($("#fila" + vec[i] + " #precio_unitario_f").val() == 0)
                        {
                            validacion = 0;
                            $("#fila" + vec[i] + " #precio_unitario_f").addClass('NO');
                        } else
                        {
                            $("#fila" + vec[i] + " #precio_unitario_f").removeClass('NO');
                        }

                        data_sub += "|" + $("#fila" + vec[i] + " #subtotal_f").val();

                    }
                    // para los items de devolucion
                    data_des_dev = "";
                    data_cant_dev = "";
                    data_pu_dev = "";
                    data_sub_dev = "";
                    for (i = 1; i < vec_dev.length; i++)
                    {
                        // alert("vec["+i+"]"+vec[i]);
                        //data_ids+="|"+vec[i];
                        //data_cod+="|"+$("#sel"+vec[i]+" #cod_ps").val();
                        //data_tit+="|"+$("#sel"+vec[i]+" #tit_ps").val();
                        data_des_dev += "|" + $("#fila_dev" + vec_dev[i] + " #descripcion_f").val();
                        //data_comen+="|"+$("#sel"+vec[i]+" #coment").val();
                        data_cant_dev += "|" + $("#fila_dev" + vec_dev[i] + " #cantidad_f").val();
                        //data_um+="|"+$("#sel"+vec[i]+" #um").val();
                        data_pu_dev += "|" + $("#fila_dev" + vec_dev[i] + " #precio_unitario_f").val();
                        if ($("#fila_dev" + vec_dev[i] + " #precio_unitario_f").val() == 0)
                        {
                            validacion = 0;
                            $("#fila_dev" + vec_dev[i] + " #precio_unitario_f").addClass('NO');
                        } else
                        {
                            $("#fila_dev" + vec_dev[i] + " #precio_unitario_f").removeClass('NO');
                        }

                        data_sub_dev += "|" + $("#fila_dev" + vec_dev[i] + " #subtotal_f").val();

                    }
                    
                    if ($('#nit').val() + $('#rs').val() == "")
                    {
                        validacion = 0;
                        $('#nit').addClass('NO');
                        $('#rs').addClass('NO');
                        $('#id_cliente').addClass('NO');
                    } else
                    {
                        $('#nit').removeClass('NO');
                        $('#rs').removeClass('NO');
                        $('#id_cliente').removeClass('NO');
                    }
                   

                    //alert(ttrab);
                    if (validacion == 1) {
                        //alert(data_des + ", " + data_cant + " ," + data_pu + " ," + data_sub);
                        $.post(burl + "nota_fiscal/nota_fiscal_save", {
                            'id_ov_pf': $('#id_ov_pf').val(),
                            'id_cli': $('#id_cliente').val(),
                            'id_dosificacion': $('#id_actividad :selected').val(),
                            'lugar': $('#lugar :selected').val(),
                            'nit_cli': $('#nit').val(),
                            'id_proyecto': $('#id_proyecto :selected').val(),
                            'contrato': $('#id_contrato :selected').val(),
                            'razon_social': $('#rs').val(),
                           
                            'nro_fac_org': $('#nrofac_orig').val(),
                            'nro_autorizacion': $('#autorizacion_orig').val(),
                            'fecha_emision': $('#fecha_orig').val(),
                            
                            'descs': data_des,
                            'cants': data_cant,
                            'pus': data_pu,
                            'subs': data_sub,
                            'totalpf': $("#total_factura").val(),
                            'descs_dev': data_des_dev,
                            'cants_dev': data_cant_dev,
                            'pus_dev': data_pu_dev,
                            'subs_dev': data_sub_dev,
                            'totalpf_dev': $("#total_factura_dev").val(),
                            
                            'coment_gral': $("#comentario_general").val(),
                            
                        }
                        , function (data) {

                            // $("#" + div_dialog + " #mensajes_respuestas").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Registrando Factura...</div>');
                            $("#" + div_dialog + " #mensajes_respuestas").html(data);

                            nuevadireccion = quita_parametros(direccion, 1);
                            //alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);

                            cargar_contenido_html(div_dialog, nuevadireccion + $('#ayudata').val(), 0);

                            search_and_list_factura_venta('lista_oventa_prefacturas');
                            $("#bloqueo_pagina").addClass("ocultar");
                            $('#save').button('enable');
                            //$("#" + div_dialog).dialog("close");

                        });
                    } else
                    {
                        alert('Se han detectado ERRORES en el registro de la FACTURA corrigelos para Guardar\nGracias... :)');
                        $("#bloqueo_pagina").addClass("ocultar");
                        $('#save').button('enable');
                    }
                }
            },
            {
                id: "close",
                text: "cerrar",
                click: function () {
                    $("#" + div_dialog).dialog("close");

                }
            }
        ]
    });
}



function anular_fac(div_dialog, id_factura)
{
    burl = $('#b_url').val();
    //this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
    $("#" + div_dialog).dialog({
        title: "Anular Factura",
        autoOpen: true,
        height: 255,
        width: 530,
        modal: true,
        closeOnEscape: false,
        buttons: [
            {
                id: "anular",
                text: "Anular",
                click: function () {
                    $.post(burl + "factura_venta/anular_factura_comentario/", {
                        'id_factura': id_factura,
                        'coment_gral': $("#comentariooculto" + id_factura).val() + " * A N U L A D O .- " + $("#" + div_dialog + " #comentario").val()
                    }
                    , function (data) {
                        $("#" + div_dialog + " #mensajes_respuestas").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Registrando Factura...</div>');
                        $("#" + div_dialog + " #mensajes_respuestas").html(data);//   dir=direccion.substring(0,(direccion.length)-2);
                        search_and_list_factura_venta('lista_oventa_prefacturas');
                    });
                }
            },
            {
                id: "close",
                text: "Cancelar",
                click: function () {
                    $(this).dialog("close");

                }
            }
        ]
    });
}








function add_fila_devolucion() {
    var nd = parseInt($('#nro_reg').val()) + 1;
    $('#nro_reg').val(nd);
    $('#items_select').val($('#items_select').val() + ',' + nd);

    var codigo = $('#modelo_fila').html();
    codigo = codigo.replace(/XXX/gi, nd);
    $('#detalle_factura_venta').append('<div id="fila' + nd + '" class="grid_20">' + codigo + '</div>');
    
    
    var nd = parseInt($('#nro_reg_dev').val()) + 1;
    $('#nro_reg_dev').val(nd);
    $('#items_select_dev').val($('#items_select_dev').val() + ',' + nd);

    var codigo = $('#modelo_fila_dev').html();
    codigo = codigo.replace(/XXX/gi, nd);
    $('#detalle_devolucion').append('<div id="fila_dev' + nd + '" class="grid_20">' + codigo + '</div>');
}



function del_fila_factura_venta_doble(variable) {
    $('#fila' + variable).remove();
    var dato = $('#items_select').val();
    dato = dato.replace(',' + variable, '');
    $('#items_select').val(dato);
    
    $('#fila_dev' + variable).remove();
    var dato = $('#items_select_dev').val();
    dato = dato.replace(',' + variable, '');
    $('#items_select_dev').val(dato);
}
function del_fila_factura_venta_dev(variable) {
    $('#fila_dev' + variable).remove();
    var dato = $('#items_select_dev').val();
    dato = dato.replace(',' + variable, '');
    $('#items_select_dev').val(dato);
}
function igualar_fila(variable) {
    //alert('iguala');
    $('#fila_dev' + variable+" #cantidad_f").val($('#fila' + variable+" #cantidad_f").val());
    $('#fila_dev' + variable+" #descripcion_f").val($('#fila' + variable+" #descripcion_f").val());
    $('#fila_dev' + variable+" #precio_unitario_f").val($('#fila' + variable+" #precio_unitario_f").val());
    $('#fila_dev' + variable+" #subtotal_f").val($('#fila' + variable+" #subtotal_f").val());
    
    $('#total_factura_dev').val($('#total_factura').val());
    
}

function calculo_fila_dev(fila)
{
    pu = $("#fila" + fila + " #precio_unitario_f").val();
    sbt = parseFloat(pu) * parseFloat($("#fila" + fila + " #cantidad_f").val());
    $("#fila" + fila + " #subtotal_f").val(sbt);
    pu = $("#fila_dev" + fila + " #precio_unitario_f").val();
    sbt = parseFloat(pu) * parseFloat($("#fila_dev" + fila + " #cantidad_f").val());
    $("#fila_dev" + fila + " #subtotal_f").val(sbt);
}
function calcular_total_doble()
{
    items = $('#items_select').val();
    vec_items = items.split(',');
    tot = 0;
    // alert("cant: "+vec_items.length);
    for (i = 1; i < vec_items.length; i++)
    {
        tot += parseFloat($("#fila" + vec_items[i] + " #subtotal_f").val());
    }
    $("#total_factura").val(tot);
    
    items = $('#items_select_dev').val();
    vec_items = items.split(',');
    tot = 0;
    // alert("cant: "+vec_items.length);
    for (i = 1; i < vec_items.length; i++)
    {
        tot += parseFloat($("#fila_dev" + vec_items[i] + " #subtotal_f").val());
    }
    $("#total_factura_dev").val(tot);
}
function calcular_total_dev()
{
    items = $('#items_select_dev').val();
    vec_items = items.split(',');
    tot = 0;
    // alert("cant: "+vec_items.length);
    for (i = 1; i < vec_items.length; i++)
    {
        tot += parseFloat($("#fila_dev" + vec_items[i] + " #subtotal_f").val());
    }
    $("#total_factura_dev").val(tot);
}

function search_and_list_nota_fiscal(div_resultado)
{
    burl = $('#b_url').val();

    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl + "nota_fiscal/busqueda_lista_nota_fiscal", {
        'buscar': $('#search_ov_pf').val(),
        'cant': $('#mostrarX :selected').val(),
        'pagina': $('#pagina_registros').val(),
        'desde': $('#desdeb').val(),
        'hasta': $('#hastab').val()
    }
    , function (data) {
        $("#" + div_resultado).html(data);
    });
}

function imp_nota_fiscal(id_fac)
{
    // alert (registro);
    //alert($("#burl").val());
    aleatorio = Math.round(Math.random() * (100 - 1) + 1);
    baseurl = $("#b_url").val() + 'impresiones_pdf/nota_fiscal_impresion/' + id_fac;
    // alert(baseurl);
    miven = window.open(baseurl, aleatorio + id_fac, "menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");
//alert("ok");
}

function imp_factura_venta_bloque()
{
    // alert (registro);
    //alert($("#burl").val());
    bloque = $("#input_bloque_impresion").val();
    baseurl = $("#b_url").val() + 'impresiones_pdf/factura_venta_impresion_bloque/' + bloque;
    // alert(baseurl);
    miven = window.open(baseurl, "impresion_bloque", "menubar=0,location=1,status=1,scrollbars=1, width=1100,height=600");
    $("#input_bloque_impresion").val("");
    $('input').filter(':checkbox').removeAttr('checked');
//alert("ok");
}


function search_nota_fiscal(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina_registros").val(1);
        search_and_list_nota_fiscal('lista_notas_fiscales');
    }

}
//funcion para limitar la escritura en la factura

function limitar_glosa_factura(fila)
{
    contador_disponible = 2772;
    total = $("#total_filas_factura").val();
    filas_actual = $("#fila" + fila + " #filas_texto").val();
    calculado = parseInt(total) - parseInt(filas_actual);


    texA = $("#fila" + fila + " #descripcion_f").val();
    //texA=$("#"+fila+" #descripcion_f").val();
    contador = 0;
    lineas = 1;
    //caracteres="";
    if (total < 43)
    {
        for (i = 0; i < texA.length; i++)
        {
            a = texA.charAt(i);
            aaa = texA.charCodeAt(i);
            //  caracteres+=a+"=>"+aaa+",";
            if (aaa == 10)
            {
                //alert("enter");
                lineas++;
                contador = 0;
            } else {
                contador++;
                if (contador > 67)
                {
                    lineas++;
                    contador = 0;
                }
            }
        }//alert(caracteres);
        $("#fila" + fila + " #filas_texto").val(lineas);
        $("#fila" + fila + " #caracter_texto").val(contador);
        $("#total_filas_factura").val(calculado + lineas);
        contnuevo = contador_disponible - ((total * 66) + contador);
        // alert(contnuevo+"="+contador_disponible+"-"+"(("+calculado+"*66)+"+contador+")");
        $(".contador_caracteres").html(contnuevo);
    } else
    {
        for (i = 0; i < texA.length; i++)
        {
            a = texA.charAt(i);
            aaa = texA.charCodeAt(i);
            //  caracteres+=a+"=>"+aaa+",";
            if (aaa == 10)
            {
                //alert("enter");
                lineas++;
                contador = 0;
            } else {
                contador++;
                if (contador > 67)
                {
                    lineas++;
                    contador = 0;
                }
            }
        }//alert(caracteres);
        $("#fila" + fila + " #filas_texto").val(lineas);
        $("#fila" + fila + " #caracter_texto").val(contador);
        $("#total_filas_factura").val(calculado + lineas);
        contnuevo = contador_disponible - ((total * 67) + contador);


        $(".contador_caracteres").html(contnuevo);
        $("#fila" + fila + " #descripcion_f").val(texA.substring(-1, (texA.length) - 1));
        alert("se ha cumplido el total de filas en la factura no se puede escribir mas!!");
    }
}

function listar_proy_contr(origen, destino_proyecto, p_seleccionado)
{
    id_cli = $("#" + origen + " :selected").val();
    burl = $('#b_url').val();
    $.post(burl + "proyecto/lista_proyecto_cliente", {
        'id_cliente': id_cli,
        'p_seleccionado': p_seleccionado
    }
    , function (data) {
        $("#" + destino_proyecto).html("<select style='width:250px' id='id_proyecto' onchange='listar_contr_proy(\"id_proyecto\",\"contrato_div\",0)'>" + data + "</select>");

    });

}

function listar_contr_proy(origen, destino_proyecto, c_seleccionado)
{
    id_pro = $("#" + origen + " :selected").val();
    //alert(id_pro);
    burl = $('#b_url').val();
    $.post(burl + "proyecto/lista_contrato_proyecto", {
        'proyecto': id_pro,
        'c_seleccionado': c_seleccionado
    }
    , function (data) {
        $("#" + destino_proyecto).html('<select id="id_contrato" style="width:350px">' + data + '</select>');
    });


}