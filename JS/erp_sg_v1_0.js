//functiones ayuda
function redirigir(direccion)
{
    window.location.href = direccion;
}
function cargar_en_div_html(div_destino, url_cargar)
{
    $.post(url_cargar, {}, function (data) {
        $("#" + div_destino).html(data)
    });
}
function quita_parametros(cadena, cant_parametros)
{
    contador = 0;
    for (i = cadena.length - 1; i >= 0; i--)
    {
        if (cadena.charAt(i) == "/")
        {
            contador++;
            if (contador >= cant_parametros)
            {
                var pos = i;
                break;
            }
        }

    }
    nueva_cadena = cadena.substring(0, pos + 1);
    return(nueva_cadena);
}
function duplicar_iterm(div_contenedor, div_append, id_prod, cont_act)
{
    contenido = $("#" + div_contenedor).html();
    ids = $("#ids_seleccionados").val();
    vec = ids.split(",");
    cont = 1;
    for (i = 1; i < vec.length; i++)
    {
        inf = vec[i].split("-");

        if (inf[0] == id_prod)
        {
            //cont=parseInt(inf[1])+1;
            cont++;
        }

    }
    $("#ids_seleccionados").val($("#ids_seleccionados").val() + ',' + id_prod + "-" + cont);
    c = parseInt($("#cant_item").val()) + 1;
    $("#cant_item").val(c);
    //alert("duplicar_iterm(\"sel"+id_prod+"-"+cont_act+"\",\"detalle_sol_mat\",\""+id_prod+"\",\""+cont_act+"\")");
    //alert("duplicar_iterm(\"sel"+id_prod+"-"+cont+"\",\"detalle_sol_mat\",\""+id_prod+"\",\""+cont+"\")");
    // alert("contenido Inicial :"+contenido);
    contenido = contenido.replace("quitaritem(" + id_prod + "," + cont_act + ")", "quitaritem(" + id_prod + "," + cont + ")");
    //contenido = contenido.replace("quitaritem(" + id_prod + "," + cont_act + ")", "quitaritem(" + id_prod + "," + cont + ")");
    //alert(">>"+contenido.indexOf("duplicar_iterm(\"sel"+id_prod+"-"+cont_act+"\",\"detalle_sol_mat\",\""+id_prod+"\",\""+cont_act+"\")"));
    //alert(">>"+contenido.indexOf("duplicar_iterm(&quot;sel"+id_prod+"-"+cont_act+"&quot;,&quot;detalle_sol_mat&quot;,&quot;"+id_prod+"&quot;,&quot;"+cont_act+"&quot;)"));
    contenido = contenido.replace("duplicar_iterm(&quot;sel" + id_prod + "-" + cont_act + "&quot;,&quot;detalle_sol_mat&quot;,&quot;" + id_prod + "&quot;,&quot;" + cont_act + "&quot;)", "duplicar_iterm(&quot;sel" + id_prod + "-" + cont + "&quot;,&quot;detalle_sol_mat&quot;,&quot;" + id_prod + "&quot;,&quot;" + cont + "&quot;)");
    contenido = contenido.replace("duplicar_iterm(&quot;sel" + id_prod + "-" + cont_act + "&quot;,&quot;detalle_ov_pf&quot;,&quot;" + id_prod + "&quot;,&quot;" + cont_act + "&quot;)", "duplicar_iterm(&quot;sel" + id_prod + "-" + cont + "&quot;,&quot;detalle_ov_pf&quot;,&quot;" + id_prod + "&quot;,&quot;" + cont + "&quot;)");
    //alert("duplicar_iterm(&quot;sel" + id_prod + "-" + cont_act + "&quot;,&quot;detalle_sol_mat&quot;,&quot;" + id_prod + "&quot;,&quot;" + cont_act + "&quot;)"+ "-----duplicar_iterm(&quot;sel" + id_prod + "-" + cont + "&quot;,&quot;detalle_sol_mat&quot;,&quot;" + id_prod + "&quot;,&quot;" + cont + "&quot;)");
    contenido = contenido.replace("seriales_registradas_in(" + id_prod + "," + cont_act, "seriales_registradas_in(" + id_prod + "," + cont);
    contenido = contenido.replace("seriales_registradas_in(&quot;" + id_prod + "&quot;,&quot;" + cont_act, "seriales_registradas_in(&quot;" + id_prod + "&quot;,&quot;" + cont);
    contenido = contenido.replace("genera_otra_opcion(&quot;otra_opcion" + id_prod + "-" + cont_act + "&quot; , &quot;" + id_prod + "&quot;, 0," + cont_act, "genera_otra_opcion(&quot;otra_opcion" + id_prod + "-" + cont + "&quot; , &quot;" + id_prod + "&quot;, 0," + cont);
    contenido = contenido.replace("genera_otra_opcion(&quot;otra_opcion" + id_prod + "-" + cont_act + "&quot; , &quot;" + id_prod + "&quot;, 0," + cont_act, "genera_otra_opcion(&quot;otra_opcion" + id_prod + "-" + cont + "&quot; , &quot;" + id_prod + "&quot;, 0," + cont);
    contenido = contenido.replace("mostrar_quitar_list_sel(" + id_prod + "," + cont_act, "mostrar_quitar_list_sel(" + id_prod + "," + cont);
    contenido = contenido.replace("mostrar_quitar_coment(" + id_prod + "," + cont_act, "mostrar_quitar_coment(" + id_prod + "," + cont);
    contenido = contenido.replace("mostrar_quitar_coment(" + id_prod + "," + cont_act, "mostrar_quitar_coment(" + id_prod + "," + cont);
    // genera_otra_opcion(&quot;otra_opcion509-1&quot; , &quot;509&quot;, 0,1)
    contenido = contenido.replace("" + id_prod + "-" + cont_act, "" + id_prod + "-" + cont);
    contenido = contenido.replace("" + id_prod + "-" + cont_act, "" + id_prod + "-" + cont);
    contenido = contenido.replace("" + id_prod + "-" + cont_act, "" + id_prod + "-" + cont);
    contenido = contenido.replace("" + id_prod + "-" + cont_act, "" + id_prod + "-" + cont);
    contenido = contenido.replace("" + id_prod + "-" + cont_act, "" + id_prod + "-" + cont);
    contenido = contenido.replace("" + id_prod + "-" + cont_act, "" + id_prod + "-" + cont);
    contenido = contenido.replace("" + id_prod + "-" + cont_act, "" + id_prod + "-" + cont);
    contenido = contenido.replace("" + id_prod + "-" + cont_act, "" + id_prod + "-" + cont);
    contenido = contenido.replace("" + id_prod + "-" + cont_act, "" + id_prod + "-" + cont);
    contenido = contenido.replace("" + id_prod + "-" + cont_act, "" + id_prod + "-" + cont);
    contenido = contenido.replace("" + id_prod + "-" + cont_act, "" + id_prod + "-" + cont);
    contenido = contenido.replace("" + id_prod + "-" + cont_act, "" + id_prod + "-" + cont);
    contenido = contenido.replace("" + id_prod + "-" + cont_act, "" + id_prod + "-" + cont);
    //alert(contenido);
    contenido = "<div id='sel" + id_prod + "-" + cont + "' class='grid_20 fondo_amarillo bordeado'>" + contenido + "</div>";

    $("#" + div_append).append(contenido);
}

// fin funciones ayuda***********************************************************************************



//funciones de CONFIGURACIONES SISTEMA
function cargar_contenido_html(div_destino, direccion, modulo)
{

    $("#" + div_destino).html($("#cargando_grande").html());
    $.post(direccion, {
        'modulo': modulo
    }, function (data) {
        $("#" + div_destino).html(data);
    });

}
function dialog_contenidos_nuevo_menu(div_dialog, direccion, modulo, id_modulo)
{
    this.cargar_contenido_html(div_dialog, direccion, modulo);
    $("#" + div_dialog).dialog({
        title: "Nuevo menu en modulo '" + modulo + "'",
        autoOpen: true,
        height: 460,
        width: 405,
        modal: true,
        buttons: {
            "Reset": function () {
                $("input").val("");
            },
            "Guardar": function () {
                //alert("guardar");
                //$( this ).dialog( "close" );

            },
            "Cancelar": function () {

                $(this).dialog("close");
            }
        }
    });
}
function cambiar_dialog_mensaje_ok()
{

}

//fin funciones CONFIGURACION SISTEMA*********************************************************************************************************
//funciones de cliente
function cambios_form()
{
    $("input").change(function () {
        $('#cambios').val("si");
    });
}

function dialog_contenidos_nuevo_cliente(div_dialog, direccion)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
    // saber si es nuevo o es edicion

    d = direccion.split("/");
    dc = d.length - 1
    titulo = "Nuevo Cliente";
    if (d[dc] != 0)
        titulo = "Modificacion de datos de Cliente";
    $("#" + div_dialog).dialog({
        title: titulo,
        autoOpen: true,
        height: 500,
        width: 405,
        modal: true,
        closeOnEscape: false,
        open: function (event, ui) {
            $(".ui-dialog-titlebar-close").hide();
        },
        buttons: {
            "Reset": function () {
                if (d[dc] != 0)
                    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
                else
                    $("input").val("");
            },
            "Guardar": function () {
                // alert('guardar');
                $.post(burl + "cliente/guardar_cliente", {
                    'id_cli': $('#id_cli').val(),
                    'rs': $('#rs').val(),
                    'nit': $('#nit').val(),
                    'tel': $('#tel').val(),
                    'dir': $('#dir').val(),
                    'rub': $('#rub').val()
                }, function (data) {
                    // alert(data);
                    $("#" + div_dialog + " #respuesta").html(data);
                    //alert('----'+$("#" + div_dialog + " #respuesta").html());
                    if ($("#respuesta #proceso").val() == "INSERT")
                    {
                        setTimeout(function () {
                            nuevadireccion = this.quita_parametros(direccion, 1);
                            //cargar_contenido_html(div_dialog, burl + 'cliente/contacto_nuevo/'+$('#ayudata').val()+"/0", 0);
                            dialog_contenidos_nuevo_contacto(div_dialog, burl + 'cliente/contacto_nuevo/' + $('#ayudata').val() + "/0");
                        }, 1000);
                    } else//Update
                    {
                        setTimeout(function () {
                            nuevadireccion = this.quita_parametros(direccion, 1);
                            cargar_contenido_html(div_dialog, nuevadireccion + $('#ayudata').val(), 0);
                        }, 1000);
                    }
                });
                /* setTimeout(function () {
                 if ($('#proceso').val() != "UPDATE")
                 {
                 $(this).dialog("close");
                 setTimeout(function () {
                 this.dialog_contenidos_nuevo_contacto(div_dialog, burl + 'cliente/contacto_nuevo/' + $('#ayudata').val() + "/0");
                 }, 1000);burl
                 } else
                 this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve  
                 }, 1000);
                 
                 */
            },
            "Cerrar": function () {

                $(this).dialog("close");

            }
        }
    });
}
function dialog_contenidos_nuevo_contacto(div_dialog, direccion)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
    $("#" + div_dialog).dialog({
        title: "Nuevo Contacto Cliente",
        autoOpen: true,
        height: 660,
        width: 405,
        modal: true,
        closeOnEscape: false,
        open: function (event, ui) {
            $(".ui-dialog-titlebar-close").hide();
        },
        buttons: {
            "Reset": function () {
                cargar_contenido_html(div_dialog, direccion, 0);
            },
            "Guardar": function () {
                $.post(burl + "cliente/guardar_contacto_cliente_nuevo", {
                    'id_cont': $('#id_cont').val(),
                    'nom_com': $('#nom_com').val(),
                    'cargo': $('#cargo').val(),
                    'tel': $('#tel').val(),
                    'dir': $('#dir').val(),
                    'id_cli': $('#id_cli').val()
                }
                , function (data) {
                    $("#" + div_dialog + " #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function () {
                        cargar_contenido_html(div_dialog, direccion, 0);
                    }, 1000);

                });
            },
            "Cerrar": function () {

                $(this).dialog("close");
                location.reload();
            }
        }
    });
}

function search_client_mini(div_resultado)
{
    //alert('ingrsa a la funcion');
    $("#" + div_resultado).html('<div class="cargando_circulo" style="height:40px;background-size: 10%;" ></div><div></div><div class="f10 alin_cen">Buscando...</div>');
    nit = $("#nit").val();
    emp = $("#rs").val();
    if (nit != "" || emp != "") {
        $.post(burl + "cliente/busqueda_cliente_mini", {
            'nit': nit,
            'emp': emp
        }
        , function (data) {
            $("#" + div_resultado).html(data);
        });
    } else
        $("#" + div_resultado).html('clientes');

}
function asig_val(campo, valor)
{
    $("#" + campo).val(valor);
}

function search_client(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina_registros").val(1);
        busca_lista_cliente('lista_clientes');
    }

}
function busca_lista_cliente(div_resultado)
{
    burl = $('#b_url').val();
    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl + "cliente/busqueda_lista_cliente", {
        'buscar': $('#search').val(),
        'cant': $('#mostrarX :selected').val(),
        'pagina': $('#pagina_registros').val()
    }

    , function (data) {
        $("#" + div_resultado).html(data);
    });

}


//fin funciones de cliente*********************************************************************************************************
//funciones para prefactura u orden de venta
function search_ov_pf(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina_registros").val(1);
        search_and_list_ov_pf('lista_oventa_prefacturas');
    }

}
function search_and_list_ov_pf(div_resultado)
{
    burl = $('#b_url').val();
    buscar = $("#search_ov_pf").val();
    cant = $("#cant_reg :selected").val();
    pagina = $("#pagina_registros").val();
    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl + "oventa_prefactura/busqueda_lista_pf_ov", {
        'buscar': $('#search_ov_pf').val(),
        'cant': $('#mostrarX :selected').val(),
        'pagina': $('#pagina_registros').val()
    }
    , function (data) {
        $("#" + div_resultado).html(data);
    });
}



function dialog_nueva_prefac(div_dialog, direccion)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
    $("#" + div_dialog).dialog({
        title: "Nueva Orden de Venta / Pre-factura",
        autoOpen: true,
        height: 650,
        width: 1050,
        modal: true,
        closeOnEscape: false,
        buttons: [
            {
                id: "save",
                text: "Guardar",
                disabled: "true",
                click: function () {
                    ids = $("#ids_seleccionados").val();
                    vec = ids.split(",");
                    data_ids = "";
                    data_cod = "";
                    data_tit = "";
                    data_des = "";
                    data_comen = "";
                    data_cant = "";
                    data_um = "";
                    data_pu = "";
                    data_sub = "";
                    for (i = 1; i < vec.length; i++)
                    {
                        // alert("vec["+i+"]"+vec[i]);
                        data_ids += "|" + vec[i];
                        data_cod += "|" + $("#sel" + vec[i] + " #cod_ps").val();
                        data_tit += "|" + $("#sel" + vec[i] + " #tit_ps").val();
                        data_des += "|" + $("#sel" + vec[i] + " #desc_ps").val();
                        data_comen += "|" + $("#sel" + vec[i] + " #coment").val();
                        data_cant += "|" + $("#sel" + vec[i] + " #cantidad").val();
                        data_um += "|" + $("#sel" + vec[i] + " #um").val();
                        data_pu += "|" + $("#sel" + vec[i] + " #pu").val();
                        data_sub += "|" + $("#sel" + vec[i] + " #subtotal").val();

                    }
                    $.post(burl + "oventa_prefactura/ov_pf_save", {
                        'id_ov_pf': $('#id_ov_pf').val(),
                        'id_cli': $('#id_cliente').val(),
                        'ids': data_ids,
                        'cods': data_cod,
                        'tits': data_tit,
                        'descs': data_des,
                        'coments': data_comen,
                        'cants': data_cant,
                        'ums': data_um,
                        'pus': data_pu,
                        'subs': data_sub,
                        'totalpf': $("#total_calculo").val(),
                        'coment_gral': $("#comentario_general").val()
                    }
                    , function (data) {
                        $("#" + div_dialog + " #mensajes_respuestas").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                        $("#" + div_dialog + " #mensajes_respuestas").html(data);
                        //if($('#ayudata').val()!=0)
                        //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                        setTimeout(function () {

                            dir = direccion.substring(0, (direccion.length) - 2);
                            // alert(dir +" , "+direccion );
                            cargar_en_div_html(div_dialog, dir + $("#respuesta_id").val());
                        }, 5000);

                    });
                }
            },
            {
                id: "close",
                text: "cerrar",
                click: function () {
                    $("#" + div_dialog).dialog("close");
                    /* $("#mensaje").dialog({
                     title:"Nueva Orden de Venta / Pre-factura",
                     autoOpen: true,
                     height: 650,
                     width: 400,
                     modal: true,
                     closeOnEscape: false,
                     buttons:{
                     "Cerrar": function() {
                     
                     $( "#mensaje" ).dialog( "close" );
                     //$("#"+div_dialog).dialog();
                     //location.reload();
                     }
                     }
                     });
                     */
                    //$(this).dialog();
                }
            }
        ]
    });
}

function search(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina").val(1);
        busqueda_prod_serv();
    }

}
function search_tipo_grilla(event, tipogrilla)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina").val(1);
        busqueda_prod_serv_tipo_grilla(tipogrilla);
    }
}
function busqueda_prod_serv_tipo_grilla(tipogrilla)
{
    $("#resultado_busqueda").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Buscando...</div>');
    buscar = $("#in_search").val();
    if (buscar != "") {
        $.post(burl + "producto_servicio/busqueda_prod_serv_tipo_grilla", {
            'busqueda': buscar,
            'selecionados': $("#ids_seleccionados").val(),
            'cant': $("#mostrar_X :selected").val(),
            'pag': $("#pagina").val(),
            'vista_solicitada': tipogrilla

        }
        , function (data) {
            $("#resultado_busqueda").html(data);

        });
    } else
        $("#resultado_busqueda").html('');
}
function busqueda_prod_serv()
{
    $("#resultado_busqueda").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Buscando...</div>');
    buscar = $("#in_search").val();
    if (buscar != "") {
        $.post(burl + "producto_servicio/busqueda_prod_serv", {
            'busqueda': buscar,
            'selecionados': $("#ids_seleccionados").val(),
            'cant': $("#mostrar_X :selected").val(),
            'pag': $("#pagina").val()

        }
        , function (data) {
            $("#resultado_busqueda").html(data);

        });
    } else
        $("#resultado_busqueda").html('');
}
function cambiarpagina(pagina)
{
    $("#pagina").val(pagina)
    busqueda_prod_serv();
}

/*function seleccionar_producto(id_prod){
 alert('funcion principal');
 if($("#check"+id_prod).is(':checked'))
 {
 ids=$("#ids_seleccionados").val();
 vec=ids.split(",");
 cont=1;
 for(i=1;i<vec.length;i++)
 { 
 inf=vec[i].split("-");
 
 if(inf[0]==id_prod)
 {
 cont=parseInt(inf[1])+1;
 
 }
 
 }
 //id_prod=id_prod;
 
 
 $("#"+id_prod).addClass("seleccionado");
 $("#ids_seleccionados").val($("#ids_seleccionados").val()+','+id_prod+"-"+cont);
 c=parseInt($("#cant_item").val())+1;
 $("#cant_item").val(c);
 codigo="<div class='grid_20 fondo_amarillo bordeado ' id='sel"+id_prod+"-"+cont+"' >\n\
 <div class='grid_2 negrilla'>"+"-"+$("#"+id_prod+" #cod_p").val()+" <input type='hidden' id='cod_ps' value='"+$("#"+id_prod+" #cod_p").val()+"'></div>\n\
 <div class='grid_8'>\n\
 <div class='grid_8'>"+$("#"+id_prod+" #tit_p").val()+" <input type='hidden' id='tit_ps' value='"+$("#"+id_prod+" #tit_p").val()+"'></div>\n\
 <div class='grid_8'>"+$("#"+id_prod+" #desc_p").val()+" <input type='hidden' id='desc_ps' value='"+$("#"+id_prod+" #desc_p").val()+"'></div>\n\
 <div class='grid_8'><textarea placeholder='Escriba su comentario aqui' id='coment' class='textarea_redond_450x50 ocultar'></textarea></div>\n\
 </div>\n\
 <div class='grid_1'>\n\
 <div id='ver' class='comentario milink' title='Adicionar comentario' onclick='mostrar_quitar_coment("+id_prod+","+cont+",1)'></div>\n\
 <div id='oculta' class='nocomentario milink ocultar' title='Quitar comentario' onclick='mostrar_quitar_coment("+id_prod+","+cont+",0)'></div>\n\
 </div>\n\
 <div class='grid_2'><input title='cantidad' id='cantidad' type='text' class='input_redond_100 alin_cen margin_cero' placeholder='Cantidad' onkeyup='calcular_importe()' ></div>\n\
 <div class='grid_2'><input title='Unidad Medida' id='um' type='text' class='input_redond_100 alin_cen margin_cero' placeholder='Unidad Medida' value='"+$("#"+id_prod+" #um_p").val()+"'></div>\n\
 <div class='grid_2'><input title='Precio Unitario' id='pu' type='text' class='input_redond_100 alin_cen margin_cero' placeholder='Precio Unitario' onkeyup='calcular_importe()' value='"+$("#"+id_prod+" #prec_p").val()+"'></div>\n\
 <div class='grid_2'><input title='Subtotal' id='subtotal' type='text' class='input_redond_100 alin_cen margin_cero' placeholder='subtotal' readonly='readonly'></div>\n\
 <div class='grid_1'>\n\
 <div style='float:rigth;' id='duplicar' class='duplicarItem milink' title='Duplicar Item' onclick='duplicar_iterm(\"sel"+id_prod+"-"+cont+"\",\"detalle_ov_pf\",\""+id_prod+"\",\""+cont+"\")'></div>\n\
 <div style='float:rigth;' id='quitar' class='quitarItem milink' title='Quitar Item' onclick='quitaritem("+id_prod+","+cont+");'></div>\n\
 </div>\n\
 </div>";
 $("#detalle_ov_pf").append(codigo);
 }
 else
 {
 ids=$("#ids_seleccionados").val();
 vec=ids.split(",");
 cont=0;
 for(i=1;i<vec.length;i++)
 { 
 inf=vec[i].split("-");
 
 if(inf[0]==id_prod)
 {
 cont++; 
 
 }
 
 }
 var key = true; 
 if(cont>1)
 {
 key = confirm("Se borraran los Items con este ID usted tiene "+cont +" items con el ID : "+id_prod+"!\n\
 * Si desea elimiar todos lo items clic en OK \n\
 * Si desea eliminar solo un ITEM clic en CANCEL y clic en X del item a eliminar.");
 }
 if(key){ 
 cont=0;
 for(i=1;i<vec.length;i++)
 { 
 inf=vec[i].split("-");
 
 if(inf[0]==id_prod)
 {
 cont++; 
 $("#sel"+id_prod+'-'+inf[1]).remove();
 $("#ids_seleccionados").val($("#ids_seleccionados").val().replace(','+id_prod+'-'+inf[1],''))
 }
 
 }
 
 $("#"+id_prod).removeClass("seleccionado");
 //$("#ids_seleccionados").val($("#ids_seleccionados").val().replace(','+id_prod,''))
 
 c=parseInt($("#cant_item").val())-cont;
 $("#cant_item").val(c);
 
 }
 else
 $('#check'+id_prod).attr('checked', 'checked');
 }
 if(parseInt($("#cant_item").val())>0 && parseInt($("#total_calculo").val())>0)
 $("#save").button('enable');
 else
 $("#save").button('disable');
 }
 */
function quitaritem(id_prod, indice)
{
    ids = $("#ids_seleccionados").val();
    vec = ids.split(",");
    cont = 0;
    for (i = 1; i < vec.length; i++)
    {
        inf = vec[i].split("-");

        if (inf[0] == id_prod)
        {
            cont++;

        }

    }

    if (cont <= 1)
    {
        $('#check' + id_prod).attr('checked', false);
        $("#" + id_prod).removeClass("seleccionado");
    }
    $("#ids_seleccionados").val($("#ids_seleccionados").val().replace(',' + id_prod + '-' + indice, ''))
    $("#sel" + id_prod + "-" + indice).remove();
    c = parseInt($("#cant_item").val()) - 1;
    $("#cant_item").val(c);
//if(parseInt($("#cant_item").val())>0 && parseInt($("#total_calculo").val())>0)
//  $("#save").button('enable');
//else
//  $("#save").button('disable');
}


function mostrar_quitar_coment(id_p, indice, opcion) {
    if (opcion == 1)
    {
        $("#sel" + id_p + "-" + indice + " #coment").removeClass("ocultar");
        $("#sel" + id_p + "-" + indice + " #oculta").removeClass("ocultar");
        $("#sel" + id_p + "-" + indice + " #ver").addClass("ocultar");
    } else
    {
        $("#sel" + id_p + "-" + indice + " #coment").addClass("ocultar");
        $("#sel" + id_p + "-" + indice + " #coment").val("");
        $("#sel" + id_p + "-" + indice + " #oculta").addClass("ocultar");
        $("#sel" + id_p + "-" + indice + " #ver").removeClass("ocultar");
    }



}
function calcular_importe()
{
    ids = $("#ids_seleccionados").val();
    vec = ids.split(",");
    total = 0;

    for (i = 1; i < vec.length; i++)
    {
        //alert("veci2 "+vec[i])
        $("#sel" + vec[i] + " #cantidad").val($("#sel" + vec[i] + " #cantidad").val().replace(',', '.'));
        $("#sel" + vec[i] + " #pu").val($("#sel" + vec[i] + " #pu").val().replace(',', '.'));
        //$(campo).val($(campo).val().replace(',','.'));
        if ($("#sel" + vec[i] + " #cantidad").val() != "" && $("#sel" + vec[i] + " #pu").val() != "")//verifica que el producto no tenfa vacios NaN
        {
            cant = parseFloat($("#sel" + vec[i] + " #cantidad").val()).toFixed(2);
            precio = parseFloat($("#sel" + vec[i] + " #pu").val()).toFixed(2);
            //alert(cant+"<---cant , precio u --->"+precio);
            subtotal = cant * precio;
            //alert("subtotal "+i+".-"+subtotal);
            $("#sel" + vec[i] + " #subtotal").val(subtotal.toFixed(2));
            total += subtotal;
        } else
            $("#sel" + vec[i] + " #subtotal").val("0.00");
    }
    // alert("total"+total);
    $("#total_calculo").val(total.toFixed(2));

    if (parseInt($("#cant_item").val()) > 0 && parseInt($("#total_calculo").val()) > 0 && $("#id_cliente").val() != "")
        $("#save").button('enable');
    else
        $("#save").button('disable');
}

function show_ovpf(div_destino, id_ver)
{
    burl = $('#b_url').val();
    cargar_en_div_html(div_destino, burl + 'oventa_prefactura/ver_ovpf/' + id_ver);

    $("#" + div_destino).dialog({
        title: "Orden de Venta / Pre-factura",
        autoOpen: true,
        height: 650,
        width: 1050,
        modal: true,
        closeOnEscape: false,
        buttons: [
            {
                id: "save",
                text: "Guardar",
                disabled: "true",
                click: function () {

                }
            },
            {
                id: "edit",
                text: "Editar",
                disabled: false,
                click: function () {

                }
            },
            {
                id: "print",
                text: "Imprimir PDF",
                click: function () {

                }
            },
            {
                id: "close",
                text: "cerrar",
                click: function () {

                }
            }
        ]
    });


}

//funciones para prefactura u orden de venta*********************************************************************************************************
//Funciones para Solicitud de materiales
function busca_lista_mi_sol_mat(div_resultado)
{
    burl = $('#b_url').val();
    buscar = $("#campo_busqueda").val();
    cant = $("#mostrarX :selected").val();
    pagina = $("#pagina_registros").val();
    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');

    $.post(burl + "solicitud_material/busqueda_lista_sol_mat", {
        'buscar': buscar,
        'cant': cant,
        'pagina': pagina
    }
    , function (data) {
        $("#" + div_resultado).html(data);
    });
}

function busca_lista_mi_sol_mat_enviada(div_resultado)
{
    burl = $('#b_url').val();
    buscar = $("#campo_busqueda").val();
    cant = $("#mostrarX :selected").val();
    pagina = $("#pagina_registros").val();
    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');

    $.post(burl + "solicitud_material/busqueda_lista_sol_mat_enviada", {
        'buscar': buscar,
        'cant': cant,
        'pagina': pagina
    }
    , function (data) {
        $("#" + div_resultado).html(data);
    });
}
function busca_lista_devolucion_material(div_resultado)
{
    burl = $('#b_url').val();
    buscar = $("#campo_busqueda").val();
    cant = $("#mostrarX :selected").val();
    pagina = $("#pagina_registros").val();
    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');

    $.post(burl + "solicitud_material/busqueda_lista_devoluciones", {
        'buscar': buscar,
        'cant': cant,
        'pagina': pagina
    }
    , function (data) {
        $("#" + div_resultado).html(data);
    });
}





function dialog_nueva_sol_mat(div_dialog, direccion)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
    $("#" + div_dialog).dialog({
        title: "Nueva Solicitud de Material",
        autoOpen: true,
        height: 650,
        width: 1050,
        modal: true,
        closeOnEscape: false,
        buttons: [{
                id: "send",
                text: "Enviar Solicitud",
                disabled: true,
                click: function () {
                    $.post(burl + "solicitud_material/cambiar_estado_sol_mat", {
                        'id_sol_mat': $('#id_sol_mat').val(),
                        'estado': "Enviado a Almacen"

                    }
                    , function (data) {
                        $("#" + div_dialog + " #mensajes_respuestas").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                        $("#" + div_dialog + " #mensajes_respuestas").html(data);
                        //if($('#ayudata').val()!=0)
                        //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                        setTimeout(function () {

                            dir = this.quita_parametros(direccion, 1);
                            cargar_en_div_html(div_dialog, dir + $('#id_sol_mat').val());
                        }, 2000);

                    });
                }
            },
            {
                id: "save",
                text: "Guardar",
                //disabled:"false",
                click: function () {
                    ids = $("#ids_seleccionados").val();
                    vec = ids.split(",");
                    data_ids = "";
                    data_comen = "";
                    data_cant = "";
                    data_um = "";

                    for (i = 1; i < vec.length; i++)
                    {
                        // alert("vec["+i+"]"+vec[i]);
                        data_ids += "|" + vec[i];
                        data_comen += "|" + $("#sel" + vec[i] + " #coment").val();
                        data_cant += "|" + $("#sel" + vec[i] + " #cantidad").val();
                        data_um += "|" + $("#sel" + vec[i] + " #um").val();


                    }
                    $.post(burl + "solicitud_material/guardar_sol_mat", {
                        'id_sol_mat': $('#id_sol_mat').val(),
                        'id_proyecto': $('#id_proyecto :selected').val(),
                        'id_per_resp': $('#id_per_resp :selected').val(),
                        'tipo_trabajo': $('#ttrab :selected').val(),
                        'titulo_sm': $('#tit_sm').val(),
                        'resp_alm_envio': $('#id_personal_responsable :selected').val(),
                        //detalles
                        'ids': data_ids,
                        'coments': data_comen,
                        'cants': data_cant,
                        'ums': data_um,
                        'coment_gral': $("#comentario_general").val()
                    }
                    , function (data) {
                        $("#" + div_dialog + " #mensajes_respuestas").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                        $("#" + div_dialog + " #mensajes_respuestas").html(data);
                        //if($('#ayudata').val()!=0)
                        //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                        setTimeout(function () {

                            dir = this.quita_parametros(direccion, 1);
                            cargar_en_div_html(div_dialog, dir + $("#ayudata").val());
                        }, 2000);

                    });
                }
            },
            {
                id: "close",
                text: "cerrar",
                click: function () {
                    setTimeout(function () {
                        search_and_sm('lista_movimiento_sm');

                    }, 2000);
                    $("#" + div_dialog).dialog("close");
                }
            }
        ]
    });
}
function seleccionar_producto_sm(id_prod) {

    if ($("#check" + id_prod).is(':checked'))
    {
        ids = $("#ids_seleccionados").val();
        vec = ids.split(",");
        cont = 1;
        for (i = 1; i < vec.length; i++)
        {
            inf = vec[i].split("-");

            if (inf[0] == id_prod)
            {
                cont = parseInt(inf[1]) + 1;

            }

        }
        //seleccionar_producto("+id_prod+");duplicar_iterm(div_contenedor,div_append,id_prod,cont_act)
        //id_prod=id_prod;


        $("#" + id_prod).addClass("seleccionado");
        $("#ids_seleccionados").val($("#ids_seleccionados").val() + ',' + id_prod + "-" + cont);
        c = parseInt($("#cant_item").val()) + 1;
        $("#cant_item").val(c);
        //alert(c);

        codigo = "<div class='grid_20 fondo_amarillo bordeado ' id='sel" + id_prod + "-" + cont + "' >\n\
                <div class='grid_2 negrilla'>" + "-" + $("#" + id_prod + " #cod_p").val() + " <input type='hidden' id='cod_ps' value='" + $("#" + id_prod + " #cod_p").val() + "'></div>\n\
                <div class='grid_8'>\n\
                    <div class='grid_8'>" + $("#" + id_prod + " #tit_p").val() + " <input type='hidden' id='tit_ps' value='" + $("#" + id_prod + " #tit_p").val() + "'></div>\n\
                    <div class='grid_8'>" + $("#" + id_prod + " #desc_p").val() + " <input type='hidden' id='desc_ps' value='" + $("#" + id_prod + " #desc_p").val() + "'></div>\n\
                </div>\n\
                <div class='grid_6'><textarea placeholder='Escriba su comentario aqui' id='coment' class='textarea_redond_300x45'></textarea></div>\n\
                <div class='grid_3'><input title='cantidad Solicitada' id='cantidad' type='text' class='input_redond_50 alin_cen margin_cero' placeholder='Cantidad' >" + $("#" + id_prod + " #um_p").val() + "</div>\n\
                <div class='grid_1'>\n\
                        <div style='float:rigth;' id='duplicar' class='duplicarItem milink' title='Duplicar Item' onclick='duplicar_iterm(\"sel" + id_prod + "-" + cont + "\",\"detalle_sol_mat\",\"" + id_prod + "\",\"" + cont + "\")'></div>\n\
                        <div style='float:rigth;' id='quitar' class='quitarItem milink' title='Quitar Item' onclick='quitaritem(" + id_prod + "," + cont + ");'></div>\n\
</div>\n\
                </div>";
        $("#detalle_sol_mat").append(codigo);
    } else
    {
        ids = $("#ids_seleccionados").val();
        vec = ids.split(",");
        cont = 0;
        for (i = 1; i < vec.length; i++)
        {
            inf = vec[i].split("-");

            if (inf[0] == id_prod)
            {
                cont++;

            }

        }
        var key = true;
        if (cont > 1)
        {
            key = confirm("Se borraran los Items con este ID usted tiene " + cont + " items con el ID : " + id_prod + "!\n\
    * Si desea elimiar todos lo items clic en OK \n\
    * Si desea eliminar solo un ITEM clic en CANCEL y clic en X del item a eliminar.");
        }
        if (key) {
            cont = 0;
            for (i = 1; i < vec.length; i++)
            {
                inf = vec[i].split("-");

                if (inf[0] == id_prod)
                {
                    cont++;
                    $("#sel" + id_prod + '-' + inf[1]).remove();
                    $("#ids_seleccionados").val($("#ids_seleccionados").val().replace(',' + id_prod + '-' + inf[1], ''))
                }

            }

            $("#" + id_prod).removeClass("seleccionado");
            //$("#ids_seleccionados").val($("#ids_seleccionados").val().replace(','+id_prod,''))

            c = parseInt($("#cant_item").val()) - cont;
            $("#cant_item").val(c);

        } else
            $('#check' + id_prod).attr('checked', 'checked');
    }

}
function search_sol_mat(event, div_resultado)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina").val(1);
        busca_lista_mi_sol_mat(div_resultado);
    }

}
function search_sol_mat_env(event, div_resultado)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina").val(1);
        busca_lista_mi_sol_mat_enviada(div_resultado);
    }

}

////fin solicitud_de materiales
//
/// funciones de movimiento de invetario RPI**************************************************************************************************



function search_buscar_retiro(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina").val(1);
        busqueda_material_activo();

    }
}
function busqueda_material_activo()
{
    $("#resultado_busqueda").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Buscando...</div>');
    buscar = $("#in_search").val();
    if (buscar != "") {
        $.post(burl + "producto_servicio/busqueda_prod_serv", {
            'busqueda': buscar,
            'selecionados': $("#ids_seleccionados").val(),
            'cant': $("#mostrar_X :selected").val(),
            'pag': $("#pagina").val()

        }
        , function (data) {
            $("#resultado_busqueda").html(data);

        });
    } else
        $("#resultado_busqueda").html('');
}

function seriales_registradas(id_prod, cont, tipo_requerido, id_almacen, sn)
{
    informacion = "";
    //alert(" prod"+id_prod),
    $.post(burl + "movimiento_almacen/seriales_registradas_tipo", {
        'id_sp': id_prod,
        'tipo_requerido': tipo_requerido,
        'almacen': id_almacen,
        'cont': cont,
        'seleccionado': sn
    }
    , function (data) {
        $("#serial_old" + id_prod + "-" + cont).html(data);
        //  alert("vive"+informacion);                              
    });
}
//ERP_SG_v1 JAVA SCRIPT

////fin solicitud_de materiales
//
/// funciones de movimiento de invetario RPI**************************************************************************************************
/*dialog_nuevo_mov_alm_retiro
 * function dialog_nuevo_mov_alm_retiro(div_dialog, direccion)
 {
 burl = $('#b_url').val();
 this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
 $("#" + div_dialog).dialog({
 title: "Nuevo Retiro de Material/Insumos/Herramientas",
 autoOpen: true,
 height: 650,
 width: 1050,
 modal: true,
 closeOnEscape: false,
 buttons: [
 {
 id: "button-entregar",
 text: "Entregar",
 click: function () {
 
 var id_ma = $("#id_send").val()
 genera_cod_ma("c_op", burl + "movimiento_almacen/codigo_ope_sol_mat_ru/" + id_ma);
 cargar_contenido_html(div_dialog, direccion, 0);
 }
 },
 {
 id: "save",
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
 cod_u = "";
 tipo_m = "";
 
 for (i = 1; i < vec.length; i++)
 {
 //alert("vec["+i+"]"+vec[i]);
 data_ids += "|" + vec[i];
 data_idps += "|" + $("#sel" + vec[i] + " #id_sp").val();
 data_ma += "|" + $("#sel" + vec[i] + " #id_ma").val();
 data_cant += "|" + $("#sel" + vec[i] + " #cant").val();
 data_comen += "|" + $("#sel" + vec[i] + " #coment").val();
 tipo_cup+="|"+$("#sel"+vec[i]+" #cp").val();
 tipo_sn+="|"+$("#sel"+vec[i]+" #sn").val();
 
 }
 //alert("no funciona"+$("#c_u").val());                
 //  alert("aquii"+data_ids+","+data_idps+","+data_ma+","+data_cant+","+data_comen);
 $.post(burl + "movimiento_almacen/pro_serv_save", {
 'ids': data_ids,
 'r_idps': data_idps,
 'r_ma': data_ma,
 'r_cant': data_cant,
 'r_coments': data_comen,
 'r_cup':tipo_cup,
 'r_sn':tipo_sn,
 'cod_user': $("#c_u").val(),
 'tipo_mov': $("#t_m").val(),
 'fh': $("#tim").val(),
 'proyt': $("#pro").val(),
 'almacen': $("#id_almacen :selected").val(),
 'subregion_oficina': $("#id_oficina").val(),
 'tipo_doc_o': "movimiento inventario",
 'coment_gral': $("#comentario_general").val()
 }
 , function (data) {
 $("#" + div_dialog + " #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
 
 setTimeout(function () {
 cargar_contenido_html(div_dialog, direccion, 0);
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
 
 */




function genera_cod_ma(div_dialog, direccion, direccion_padre, dialog_padre)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
    $("#" + div_dialog).dialog({
        title: "Clave Operacional",
        autoOpen: true,
        height: 300,
        width: 350,
        modal: true,
        closeOnEscape: false,
        buttons: [
            {
                id: "button-recepcionar",
                text: "Entregar material",
                click: function () {
                    cod_user = $("#cod_operacional").val();
                    cod_intro = $("#cod_ope").val();
                    if (cod_user == cod_intro)
                    {
                        $.post(burl + "movimiento_almacen/cambiar_estado_retiro", {
                            'estado': 'Material Entregado',
                            //'id_detalle_dev':$("#id_dev_mat").val()
                            'id_ma': $("#id_send").val()
                        }

                        , function (data) {
                            $("#ayuda_menaje").html("<div class='OK'>El codigo operacional es CORRECTO!!</div>")
                            setTimeout(function () {

                                $("#" + div_dialog).dialog("close");
                                //alert("porcargar contenido padre dpadre:"+dialog_padre+" diPadre :"+direccion_padre);

                                cargar_contenido_html(dialog_padre, direccion_padre, 0);
                                // alert("carg contenido padre");
                            }, 2000);


                        });
                    } else
                    {
                        $("#ayuda_menaje").html("<div class='NO'>Codigo Operacional Incorrecto ,Verifique el bloqueo de mayusculas e intentelo nuevamente!!</div>")
                    }
                }
            },
            {
                id: "button-ok",
                text: "Salir",
                click: function () {
                    // $(this).dialog("close");
                    //$("#mensaje").dialog
                    $("#" + div_dialog).dialog("close");

                    //$( this ).dialog( "close" );
                    // location.reload();                
                    //$(this).dialog();

                }
            }
        ]
    });
}



function search_buscar_retiro(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina").val(1);
        busqueda_material_activo();

    }
}
function busqueda_material_activo()
{
    $("#resultado_busqueda").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Buscando...</div>');
    buscar = $("#in_search").val();
    if (buscar != "") {
        $.post(burl + "producto_servicio/busqueda_prod_serv_almacen", {
            'busqueda': buscar,
            'selecionados': $("#ids_seleccionados").val(),
            'cant': $("#mostrar_X :selected").val(),
            'pag': $("#pagina").val(),
            'id_almacen': $("#id_almacen").val()

        }
        , function (data) {
            $("#resultado_busqueda").html(data);

        });
    } else
        $("#resultado_busqueda").html('');
}
function proy_generar(campo_parametro, campo_respuesta, bloque, selecionado)//obtProyectoUser
{
    // alert('ingresa a la funcion');
    $.post(burl + "usuario/respuesta_propyecto_por_usuario", {
        'id_usuario': $('#' + campo_parametro + ' :selected').val(),
        'id_campo': campo_respuesta,
        'seleccionado': selecionado
    }
    , function (data) {
        // alert(data);
        $("#" + bloque).html(data);

    });
}

// adicionado 01/02/17

function forzar_proy()
{
    if ($("#forzar").prop('checked')) {
        //   alert('checked');
        $.post(burl + "proyecto/listar_proyecto_select", {
        }
        , function (data) {
            // alert(data);
            $("#proy_bloque").html(data);

        });

    } else {

        //    alert('no checked');
        proy_generar('id_personal', 'id_proyecto', 'proy_bloque', 0);
    }
}
// fin de la funcion


function seleccionar_producto_salida_directa(id_prod) {
    if ($("#check" + id_prod).is(':checked'))
    {
        ids = $("#ids_seleccionados").val();
        vec = ids.split(",");
        cont = 1;
        for (i = 1; i < vec.length; i++)
        {
            inf = vec[i].split("-");

            if (inf[0] == id_prod)
            {
                cont = parseInt(inf[1]) + 1;

            }

        }
        //id_prod=id_prod;
        //seriales_registradas(id_prod,"salida",1);//1 id_almacen
        // codigo_series=$("#variableayuda").val()
        // alert("muere"+codigo_series);
        alm = $("#id_almacen :selected").val();
        resp = "este articulo no necesita series";
        if ($("#" + id_prod + " #respuesta").val() == 1)
            resp = "<div id='serial_old" + id_prod + "-" + cont + "'></div><script>seriales_registradas(" + id_prod + "," + cont + ",'Salida'," + alm + ",\"" + 0 + "\");</script>";

        $("#" + id_prod).addClass("seleccionado");
        $("#ids_seleccionados").val($("#ids_seleccionados").val() + ',' + id_prod + "-" + cont);
        c = parseInt($("#cant_item").val()) + 1;
        $("#cant_item").val(c);

        codigo = "<div class='grid_20 fondo_amarillo bordeado ' id='sel" + id_prod + "-" + cont + "' >\n\
                <div class='grid_1'>\n\
                        <div style='float:rigth;' id='duplicar' class='duplicarItem milink' title='Duplicar Item' onclick='duplicar_iterm(\"sel" + id_prod + "-" + cont + "\",\"detalle_mov_alm_salida\",\"" + id_prod + "\",\"" + cont + "\")'></div>\n\
                        <div style='float:rigth;' id='quitar' class='quitarItem milink' title='Quitar Item' onclick='quitaritem(" + id_prod + "," + cont + ");'></div>\n\
                        <div id='ver' class='comentario milink' title='Adicionar comentario' onclick='mostrar_quitar_coment(" + id_prod + "," + cont + ",1)'></div>\n\
                        <div id='oculta' class='nocomentario milink ocultar' title='Quitar comentario' onclick='mostrar_quitar_coment(" + id_prod + "," + cont + ",0)'></div>\n\
                </div>\n\
                 <div class='grid_8'>\n\
                    <span class='negrilla'>" + $("#" + id_prod + " #cod_p").val() + " </span><input type='hidden' id='cod_ps' value='" + $("#" + id_prod + " #cod_p").val() + "'>\n\
                    <input type='hidden' id='id_ps' value='" + $("#" + id_prod + " #id_sp").val() + "'>\n\
                    <div class='grid_8'>" + $("#" + id_prod + " #tit_p").val() + " <input type='hidden' id='tit_ps' value='" + $("#" + id_prod + " #tit_p").val() + "'></div>\n\
                    <div class='grid_8'>" + $("#" + id_prod + " #desc_p").val() + " <input type='hidden' id='desc_ps' value='" + $("#" + id_prod + " #desc_p").val() + "'></div>\n\
                    <div class='grid_8'><textarea placeholder='Escriba su comentario aqui' id='coment' class='textarea_redond_450x50 ocultar'></textarea></div>\n\
                </div>\n\
                <div class='grid_2'><input title='cantidad' id='cantidad' type='text' class='input_redond_100 alin_cen margin_cero' placeholder='Cantidad'  ></div>\n\
                <div class='grid_2 negrilla alin_cen'>" + $("#" + id_prod + " #um_p").val() + "</div>\n\
                <div class='grid_4'>" + resp + "<div class='ocultar'><input type='text' id='sn' value=''><input type='text' id='cp' value=''></div></div>\n\
                </div>";
        $("#detalle_mov_alm_salida").append(codigo);
    } else
    {
        ids = $("#ids_seleccionados").val();
        vec = ids.split(",");
        cont = 0;
        for (i = 1; i < vec.length; i++)
        {
            inf = vec[i].split("-");

            if (inf[0] == id_prod)
            {
                cont++;

            }

        }
        var key = true;
        if (cont > 1)
        {
            key = confirm("Se borraran los Items con este ID usted tiene " + cont + " items con el ID : " + id_prod + "!\n\
    * Si desea elimiar todos lo items clic en OK \n\
    * Si desea eliminar solo un ITEM clic en CANCEL y clic en X del item a eliminar.");
        }
        if (key) {
            cont = 0;
            for (i = 1; i < vec.length; i++)
            {
                inf = vec[i].split("-");

                if (inf[0] == id_prod)
                {
                    cont++;
                    $("#sel" + id_prod + '-' + inf[1]).remove();
                    $("#ids_seleccionados").val($("#ids_seleccionados").val().replace(',' + id_prod + '-' + inf[1], ''))
                }

            }

            $("#" + id_prod).removeClass("seleccionado");
            //$("#ids_seleccionados").val($("#ids_seleccionados").val().replace(','+id_prod,''))

            c = parseInt($("#cant_item").val()) - cont;
            $("#cant_item").val(c);

        } else
            $('#check' + id_prod).attr('checked', 'checked');
    }
}


function seriales_registradas(id_prod, cont, tipo_requerido, id_almacen, sn)
{
    informacion = "";
    //alert(" prod"+id_prod),
    $.post(burl + "movimiento_almacen/seriales_registradas_tipo", {
        'id_sp': id_prod,
        'tipo_requerido': tipo_requerido,
        'almacen': id_almacen,
        'cont': cont,
        'seleccionado': sn
    }
    , function (data) {
        $("#serial_old" + id_prod + "-" + cont).html(data);
        //  alert("vive"+informacion);                              
    });

}
function dialog_nuevo_mov_alm_retiro_editar(div_dialog, direccion)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
    $("#" + div_dialog).dialog({
        title: "Retiro de Material/Insumos/Herramientas",
        autoOpen: true,
        height: 650,
        width: 1050,
        modal: true,
        //closeOnEscape: false,

        buttons: [
            {
                id: "entregar",
                text: "Entregar",
                click: function () {
                    var id_ma = $("#id_send").val();
                    dialog_padre = div_dialog;
                    direccion_nueva = quita_parametros(direccion, 1) + $("#id_send").val();
                    genera_cod_ma("c_ope", burl + "movimiento_almacen/codigo_ope_sol_mat_ru/" + id_ma, direccion_nueva, dialog_padre);
                }
            },
            {
                id: "save_retiro",
                text: "Editar",
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
                    //  alert("id_proyecto"+$("#id_proyecto :selected").val());
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
function select_personal_dep(id_origen, id_resultado, id_elemento, seleccionado)
{
    $.post(burl + "usuario/select_personal_dependiente", {
        'proy': $('#' + id_origen + ' :selected').val(),
        'id_elemento': id_elemento,
        'seleccionado': seleccionado
    }
    , function (data) {
        // alert(data);
        $("#" + id_resultado).html(data);
    });
}
//adicionando funciones para las impresiones
//functiones para mostrar impresiones PDF

function Imp_detalle_movimiento_almacen(registro)
{
    // alert (registro);
    //alert($("#burl").val());
    baseurl = $("#b_url").val() + 'impresiones_pdf/imprimir_detalle_boleta_movimiento_almacen/' + registro;
    miven = window.open(baseurl, "movimiento" + registro, "menubar=0,location=1,status=1,scrollbars=0, width=900,height=600");
}
function Imp_ticket_activo_fijo(id_salida, id_detalle)
{
    // alert (registro);
    //alert($("#burl").val());
    baseurl = $("#b_url").val() + 'impresiones_pdf/imp_etiqueta_activos/' + id_salida + "/" + id_detalle;
    miven = window.open(baseurl, "mywindow" + id_detalle, "menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");
}

function ver_kardex_almacen(iD_prod, idalm)
{
    //alert($("#burl").val());
    baseurl = $("#b_url").val() + 'kardex_almacen/ver_kardex_producto_almacen_detalle/' + iD_prod + "/" + idalm;
    miven = window.open(baseurl, "kardex" + iD_prod + "-" + idalm, "menubar=0,location=1,status=1,scrollbars=1, width=1100,height=600");
}


//////////////////////////////////////////////////////////////////funciones para horas extras ////////////////////////

/////////////////funciones para mis datos

/*function subir_archivo_servidor(div_destino)
 {
 
 
 var formData= new FormData($("#fileform")[0]);
 var ruta = $("#b_url").val()+'upload_archivo/subir_archivo';
 $.ajax({
 url: ruta,
 data: formData,
 cache: false,
 contentType: false,//'multipart/form-data' se ha quitado esta opcion es algo raro la verda :o!!!
 processData: false,
 type: 'POST',
 success: function(data){
 
 $("#image_load").html("<img src="+$("#b_url").val()+"uploads/fotouser/"+data+" style='width: 130px;height: 130px; margin: 10px'><div class='grid_3' style='position: absolute;left: 105px;bottom: 0px; '> \n\
 <form id='fileform' enctype='multipart/form-data' method='POST'>\n\
 <input type='file' id='userfile'  name='userfile'  class='edit_simple milink' style='padding-left: 30px' title='Subir Archivo' onchange='subir_archivo_servidor()'>\n\
 </form>\n\
 </div>");
 
 }
 });
 }*/ // BACKUP
function subir_archivo_servidor(div_destino, accion)
{


    var formData = new FormData($("#" + div_destino + " #fileform")[0]);
    formData.append('destino', $("#" + div_destino + " #dest").val());
    formData.append('file_name', $("#" + div_destino + " #nombre_file").val());

    var dimensiones = $("#" + div_destino + " #dimensiones").val()
    dim = dimensiones.split("|");
    var ruta = $("#b_url").val() + 'upload_archivo/subir_archivo';
    $("#" + div_destino + " #image_load").html('<div class="cargando_circulo" ></div><div></div><div class="f12 alin_cen">Guardando...</div>');
    $.ajax({
        url: ruta,
        data: formData,
        cache: false,
        contentType: false, //'multipart/form-data' se ha quitado esta opcion es algo raro la verda :o!!!
        processData: false,
        type: 'POST',
        success: function (data) {

            //alert(data);
            $("#" + div_destino + " #image_load").html("<img src=" + $("#b_url").val() + data + " style='width: " + dim[0] + "px;height: " + dim[1] + "px;'>");
            if (accion == "cifront")
            {
                datos = {
                    'campo': 'ruta_ci_fron',
                    'valor': data
                };

            }

            if (accion == "citra")
            {
                datos = {
                    'campo': 'ruta_ci_tra',
                    'valor': data
                };
            }

            if (accion == "foto_user")
            {
                datos = {
                    'campo': 'fotografia_actual',
                    'valor': data
                };
            }

            if (accion == "licen_user")
            {
                datos = {
                    'campo': 'adj_licencia',
                    'valor': data
                };
            }
            if (accion == "firma_user")
            {
                datos = {
                    'campo': 'adj_firma',
                    'valor': data
                };
            }
            $.post($("#b_url").val() + "usuario/actualizar_rutas_adjuntas", datos, function (data) {
                // alert("la imagen se ha subido")
            });


        }
    });
}

function subir_archivo_servidor_vehiculo(div_dialog, div_destino)
{


    var formData = new FormData($("#" + div_destino + " #fileform")[0]);
    formData.append('destino', $("#" + div_destino + " #dest").val());
    formData.append('file_name', $("#" + div_destino + " #nombre_file").val());
    formData.append('titulo', $("#" + div_destino + " #titulo").val());
    formData.append('id_vehiculo', $("#" + div_destino + " #id_vehiculo").val());

    //  alert ('Subir archivo?');
    //var dimensiones=$("#"+div_destino+" #dimensiones").val()
    //dim=dimensiones.split("|");
    var ruta = $("#b_url").val() + 'upload_archivo/subir_archivo_vehiculo';
    $.ajax({
        url: ruta,
        data: formData,
        cache: false,
        contentType: false, //'multipart/form-data' se ha quitado esta opcion es algo raro la verda :o!!!
        processData: false,
        type: 'POST',
        success: function (data) {
            // alert($("#direccion_load").val());
            // alert(div_dialog);
            cargar_contenido_html(div_dialog, $("#direccion_load").val(), $("#direccion_load").val());
            // alert('doc cargado');
            //  $("#"+div_dialog +" #respuesta").html(data);
            //  alert(data);
            //$("#"+div_destino+" #image_load").html("<img src="+$("#b_url").val()+data+" style='width: "+dim[0]+"px;height: "+dim[1]+"px;'>");
            //");//<form id='fileform' enctype='multipart/form-data' method='POST'>\n\
            // <input type='file' id='userfile'  name='userfile'  class='edit_simple milink' style='padding-left: 30px' title='Subir Archivo' onchange='subir_archivo_servidor()'>\n\
            //</form>\n\
            //</div>

        }
    });
}

function add_dep() {
    var nd = parseInt($('#dependientes #nrodep').val()) + 1;
    $('#dependientes #nrodep').val(nd);
    $('#dependientes').append('<div id="datos_dep' + nd + '">' + $('#dependientes #grilla_modelo').html() + '</div>');
}


function guardar_informacion_personal()
{
    dependientes = "";
    for (i = 1; i <= $("#dependientes #nrodep").val(); i++)
    {
        nomdep = $("#dependientes #datos_dep" + i + " #nomdep").val();
        if (nomdep != "") {
            teldep = $("#dependientes #datos_dep" + i + " #teldep").val();
            parentesco = $("#dependientes #datos_dep" + i + " #tipdep :selected").val();

            dependientes += nomdep + "(" + parentesco + ") telefono : " + teldep + " | ";
        }

    }
    emergencia = $("#contacto_p_emergencia").val() + "; Telefono: " + $("#telefono_pers_emergencia").val();
    informacion = {
        "ap_pat": $('#ap_pat').val(),
        "ap_mat": $('#ap_mat').val(),
        "nom": $('#nom').val(),
        "ci": $('#ci').val(),
        "exp": $('#exp :selected').val(),
        "fec_naci": $('#fec_nac').val(),
        "nacio": $('#nacionalidad').val(),
        "gen": $('#gen :selected').val(),
        "est_civ": $('#estado_civil :selected').val(),
        "tel_dom": $('#telf_dom').val(),
        "telf_per": $('#telf_pers').val(),
        "email_p": $('#email_pers').val(),
        "email_c": $('#email_corp').val(),
        "afp_emp": $('#afp_emp :selected').val(),
        "nua_cua": $('#nuacua').val(),
        "depto": $('#departamento :selected').val(),
        "direccion": $('#direccion').val(),
        "dependientes": dependientes,
        "emergencia": emergencia,
        "user_name": $('#user_name').val(),
        "contrasenia": $('#contrasenia').val(),
        "clave_opera": $('#clave_operacional').val(),
        "camisa": $('#camisa').val(),
        "pantalon": $('#pantalon').val(),
        "botin": $('#botin').val(),
        "chaleco": $('#chaleco').val(),
        "ov_pilo": $('#overol_piloto').val(),
        "ov_term": $('#overol_termico').val(),
        "parka": $('#parka').val(),
        "ropa_agua": $('#ropa_agua').val(),
        "proy_actu": $('#proy_actual :selected').val(),
        "cargo_actu": $('#cargo_actual').val(),
        "funciones_actu": $('#funcion_actual').val(),
        "cate_licencia": $('#cate_cond :selected').val()
    };
    baseurl = $("#b_url").val();

    $.post(baseurl + "usuario/actualizar_informacion_faltante", informacion
            , function (data) {
                alert("Los datos han sido guardado correctamente");
                location.reload();

            });
}
///////////////////////////////////////////////////////////////////////////////////////////////////////ruben ////////////////////////////////////////////////////////  

function dialog_form_logro_academico(div_dialog, direccion)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
    $("#" + div_dialog).dialog({
        title: "Estudios Realizados",
        autoOpen: true,
        height: 620,
        width: 415,
        modal: true,
        buttons: [
            {
                id: "entregar",
                text: "Registrar Datos",
                click: function () {

                    var formData = new FormData($("#fileform")[0]);
                    formData.append('file_name', $("#upfile").val());
                    formData.append('id_logro', $("#id_logro").val());
                    formData.append('nivel', $("#nivel_acad").val());
                    formData.append('institucion', $("#nom_institucion").val());
                    formData.append('carrera', $("#carrera").val());
                    formData.append('mencion', $("#mencion").val());
                    formData.append('nro_reg', $("#reg_prof").val());
                    formData.append('fec_ini', $("#fec_ini").val());
                    formData.append('fec_fin', $("#fec_fin").val());
                    formData.append('desc_logro', $("#des_logro").val());


                    //  alert ('Subir archivo?');
                    //var dimensiones=$("#"+div_destino+" #dimensiones").val()
                    //dim=dimensiones.split("|");
                    cod = '<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Espere por favor...</div>';
                    $("#" + div_dialog).html(cod);
                    var ruta = burl + 'estudios_personal/guardar_registro_upload_file';
                    $.ajax({
                        url: ruta,
                        data: formData,
                        cache: false,
                        contentType: false, //'multipart/form-data' se ha quitado esta opcion es algo raro la verda :o!!!
                        processData: false,
                        type: 'POST',
                        success: function (data) {
                            // alert($("#direccion_load").val());
                            //  alert(data);
                            resultado = data.split("|");
                            //   alert(resultado[0]+"----"+resultado[1]+"----"+resultado[2]);
                            cod = "<div class='" + resultado[2] + "'>" + resultado[1] + "</div>";
                            $("#" + div_dialog).html(cod);
                            setTimeout(function () {
                                dir = quita_parametros(direccion, 1);
                                cargar_contenido_html(div_dialog, dir + resultado[0], 0);
                            }, 1000);
                            cargar_contenido_html("lista_estudios", burl + "estudios_personal/lista_logros_academicos", 0);


                        }
                    });
                }
            },
            {
                id: "nuevo",
                text: "Nuevo Registro",
                click: function () {
                    dir = quita_parametros(direccion, 1);
                    cargar_contenido_html(div_dialog, dir + "0", 0);
                }
            },
            {
                id: "button-ok",
                text: "cerrar",
                click: function () {
                    cargar_contenido_html("lista_estudios", burl + "estudios_personal/lista_logros_academicos", 0);
                    $(this).dialog("close");

                }
            }
        ]

    });
}
function del_reg_estu(div_dialog, reg)
{
    burl = $('#b_url').val();
    $("#" + div_dialog).html("<div class='centrartexto f14'> Seguro que desea eliminar el Registro ?</div>")
    $("#" + div_dialog).dialog({
        title: "Confirmar",
        autoOpen: true,
        height: 150,
        width: 350,
        modal: true,
        buttons: [
            {
                id: "si",
                text: "SI",
                click: function () {
                    $.post(burl + "estudios_personal/del_reg/" + reg, {}, function (data) {
                        cargar_contenido_html("lista_estudios", burl + "estudios_personal/lista_logros_academicos", 0);
                        $("#" + div_dialog).dialog("close");
                    });
                }
            },
            {
                id: "no",
                text: "NO",
                click: function () {
                    $(this).dialog("close");
                }
            }
        ]
    });
}
////////functio elaborada para Rino P1_v1
function dialog_form_permisos(div_dialog, direccion)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve
    // saber si es nuevo o es edicion

    titulo = "Permisos";

    $("#" + div_dialog).dialog({
        title: titulo,
        autoOpen: true,
        height: 550,
        width: 415,
        modal: true,
        closeOnEscape: false,
        /*   open: function(event, ui) {
         $(".ui-dialog-titlebar-close").hide();
         },
         */
        buttons: {
            "Reset": function () {
                cargar_contenido_html(div_dialog, direccion, 0);//alert('funciona');
            },
            "Guardar": function () {
                if ($('#guardar_perfil').is(':checked'))
                {
                    $.post(burl + "perfiles/perfiles_menu_save", {
                        'nombre_perfil': $('#nomperfil').val(),
                        'menus_selec': $('#menus_selec').val(),
                        'control_selec': $('#control_selec').val()

                    }, function (data) {});
                }
                $.post(burl + "perfiles/guardar_permisos_usuario", {
                    'id_user': $('#id_usuario_selec').val(),
                    'menus_selec': $('#menus_selec').val(),
                    'control_selec': $('#control_selec').val()

                }
                , function (data) {
                    //
                    cod = '<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>';
                    $("#" + div_dialog).html(cod);

                    setTimeout(function () {
                        cargar_contenido_html(div_dialog, direccion, 0);
                        alert('se han adicionado los permisos de forma EXITOSA!');

                    }, 1000);


                });
            },
            "Cerrar": function () {

                $(this).dialog("close");
                // location.reload();

            }
        }
    });
}

function mostrar_ocultar(origen, salida)
{
    if ($("#" + origen).is(':checked'))
        $("#" + salida).removeClass('ocultar');
    else
        $("#" + salida).addClass('ocultar');
}

function seleccionar_items_seleccionados(menu, control)
{
    $(".nocheck").prop('checked', false);
    menus = $("#" + menu).val().split(",");
    controles = $("#" + control).val().split(",");
    for (i = 1; i < menus.length; i++)
    {
        $("#c" + menus[i]).prop('checked', true);
    }
    for (i = 1; i < controles.length; i++)
    {
        $("#co" + controles[i]).prop('checked', true);
    }
}

function cargar_config_perfil(campo)
{
    burl = $('#b_url').val();
    perfil = $("#" + campo + " :selected").val();
    $.post(burl + "perfiles/obtener_perfil/" + perfil, {}
    , function (data) {
        campos = data.split("|");
        $("#menus_selec").val(campos[0]);
        $("#control_selec").val(campos[1]);
        seleccionar_items_seleccionados("menus_selec", "control_selec");
    });



}
//adicionando esta funcion en 18/12/15

/*function Imp_factura_oventa_prefactura(id_ovpf)
 {
 // alert (registro);
 //alert($("#burl").val());
 baseurl=$("#b_url").val()+'impresiones_pdf/imp_oventa_prefactura/'+id_ovpf;  
 miven=window.open (baseurl, "mywindow","menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");
 
 }
 */

///// adicionando para dosificacion
function dialog_nueva_dosificacion(div_dialog, direccion) {

    //alert('entras a la funcion dialog_nueva_dosid');
    burl = $('#b_url').val();
    this.cargar_contenido_html(div_dialog, direccion, 0);//modulo=0 no sirve alert('funciona');
    $("#" + div_dialog).dialog({
        title: 'Nueva dosificacion',
        autoOpen: true,
        height: 610,
        width: 490,
        modal: true,
        closeOnEscape: false,
        buttons:
                {
                    "Reset": function () {
                        cargar_contenido_html(div_dialog, direccion, 0);//alert('funciona');
                    },
                    "Guardar": function ()
                    {
                        $("#bloqueo_pagina").removeClass("ocultar");
                        $.post(burl + "dosificaciones/guardar_nueva_dosificacion", {
                            'id_dosificacion': $('#id_dosificacion').val(),
                            'nro_autorizacion': $('#nro_auto').val(),
                            'NIT': $('#num_nit').val(),
                            'actividad': $('#actividad').val(),
                            'llave_cod_control': $('#llave').val(),
                            'fl_emision': $('#f_emision').val(),
                            'nro_inicial': $('#nro_inicial').val(),
                            'nro_actual': $('#nro_actual').val(),
                            'fecha_inicial': $('#f_inicial').val(),
                            'fecha_final': $('#f_final').val(),
                            'estado': $('#estado :selected').val(),
                            'tipo_dosificacion': $('#tipo_dosificacion :selected').val(),
                            'leyenda': $('#leyenda').val()

                        }

                        , function (data) {
                            $("#" + div_dialog + " #respuesta").html(data);
                            //if($('#ayudata').val()!=0)
                            setTimeout(function () {
                                nuevadireccion = this.quita_parametros(direccion, 1);
                                cargar_contenido_html(div_dialog, nuevadireccion + $('#ayudata').val(), 0);
                                search_and_list_dosificacion('lista_dosificaciones');
                                $("#bloqueo_pagina").addClass("ocultar");
                            }, 500);

                        });
                    },
                    "Cerrar": function () {

                        $(this).dialog("close");
                        // location.reload();
                    }
                }



    });
}
function search_dosificacion(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina_registros").val(1);
        search_and_list_dosificacion('lista_dosificaciones');
    }

}
function search_and_list_dosificacion(div_resultado)
{
    burl = $('#b_url').val();
    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl + "dosificaciones/busqueda_de_dosificaciones", {
        'buscar': $('#search_dosificacion').val(),
        'cant': $('#mostrarX :selected').val(),
        'pagina': $('#pagina_registros').val()
    }

    , function (data) {
        $("#" + div_resultado).html(data);
    });

}

/////funciones de facturacion

function directo_o_personal(variable)
{
    //alert('var '+variable);
    if (variable == "directo")
    {
        //alert('disabled');
        $("#id_personal").val(0);
        $("#id_personal").attr('disabled', 'disabled');
        $.post(burl + "proyecto/listar_proyecto_select", {
        }
        , function (data) {
            // alert(data);
            $("#proy_bloque").html(data);

        });
    }
    if (variable == "personal")
    {
        $("#id_personal").removeAttr('disabled');
        proy_generar('id_personal', 'id_proyecto', 'proy_bloque', 0);
    }
}


//funcion que muestra lista de subcategorias de una catedoria adicionada poor Ruben 12/10/2016

function mostrar_subcategoria(origen, salida)
{
    $("#" + salida).html('<div class="cargando_barra" ></div>');
    id_categoria = $("#" + origen + " :selected").val();
    burl = $('#b_url').val();
    $.post(burl + "categoria/obtener_subcategoria_lista", {
        'subcategoria': id_categoria
    }
    , function (data) {
        $("#" + salida).html('Subcategoria:<select id="id_subcategoria">' + data + '</select>');
    });

    //Subcategoria:

}

//funcion que ayuda a la impresion en bloque ingresa los checkeds en un input para luego enviarlo en un imprimir
function insert_input(input, valor)
{
    if ($("#imp" + valor).is(":checked"))
    {
        $("#" + input).val($("#" + input).val() + "-" + valor);
    } else
    {
        $("#" + input).val($("#" + input).val().replace("-" + valor, ""));
    }
    //alert ("se cambio el imput");
    if ($("#" + input).val() == "")
    {
        $("#botonbloqueimp").addClass("ocultar");
    } else
    {
        $("#botonbloqueimp").removeClass("ocultar");
    }
}