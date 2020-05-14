
function filtrar_proyecto_sfr(id_padre) {

    burl = $('#b_url').val();
    proyecto = $("#id_proyectototal :selected").val();
    redirigir(burl + "fondosRendir/index/" + id_padre + "/" + proyecto);
}
function del_registro_detalle(variable) {
    deldet = $('#dr' + variable + ' #id_det_rend').val();
    $('#det_delete').val($('#det_delete').val() + "," + deldet);
    $('#dr' + variable).remove();

    var dato = $('#items_select').val();
    dato = dato.replace(',' + variable, '');
    $('#items_select').val(dato);
    sumar_total_rend();
}

function mostrar_fomrulario_sol_fr(id_frend)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html('formuarioSolFR', burl + 'fondosRendir/nuevo_solFR/' + id_frend, 0);//modulo=0 no sirve

}
function proyecto_mismo()
{
    proyecto = $("#id_proy_sitio :selected").val();

    $(".proyecto_mismo_detalle option").removeAttr('selected'); //quita el atributo
    $(".proyecto_mismo_detalle option").prop('selected', false); // quita la vista de encima
    $(".proyecto_mismo_detalle option[value='" + proyecto + "']").attr('selected', "selected");//le da el atributo 
    $(".proyecto_mismo_detalle option[value='" + proyecto + "']").prop('selected', true);//refresca la vista en el select
    //alert("cambio");


}
function cargar_sitiosproyectodetalle(div)
{
    proy = $("#dr" + div + " #id_proy_sitio_detalle :selected").val();
    $.post(burl + "rendiciones/cargar_sitios_proyecto", {
        'proy': proy
                //'desc': $('#dialog_rechazo #comentario_rechazo_rendicion').val()
    }

    , function (data) {
        $("#dr" + div + " .sitioselect_carga").html(data);
    });
}
function cargar_sitiosproyectodetallesitio(div, sitio)
{
    proy = $("#dr" + div + " #id_proy_sitio_detalle :selected").val();
    $.post(burl + "rendiciones/cargar_sitios_proyecto_sitio", {
        'proy': proy,
        'sitio': sitio
                //'desc': $('#dialog_rechazo #comentario_rechazo_rendicion').val()
    }

    , function (data) {
        $("#dr" + div + " .sitioselect_carga").html(data);
    });
}
function guardar_sol_fondos_rendir()
{

    $('#save').button('disable');
    $('#fin_send').button('disable');
    $("#bloqueo_pagina").removeClass("ocultar");
    $(".border-red").removeClass('border-red');
    var items_select = $('#items_select').val();

    var id_det_dfr = "";
    //var id_tipo_gasto = "";
    //var id_tipo_gastos_directo = "";
    //var c_s_factura = "";
    var monto = "";
    var total = 0;
    var nro_fac = "";
    //var fecha_factura = "";
    var glosa_factura = "";
    //var placa_vehiculo = "";
    //var adjuntos = "";
    var id_proyecto = "";
    var estacion = "";
    var mensaje = "";
    var vector = items_select.split(",");
    //alert(vector.length);
    llave_paso = 1;
    for (i = 1; i < vector.length; i++)
    {
        id_det_dfr = id_det_dfr + $('#dr' + vector[i] + ' #id_det_rend').val() + ";";

        monto = monto + $('#dr' + vector[i] + ' #monto').val() + ';';
        if ($('#dr' + vector[i] + ' #monto').val() == 0 || $('#dr' + vector[i] + ' #monto').val() == "")
        {   //alert();
            $('#dr' + vector[i] + ' #monto').addClass('border-red');
            llave_paso = 0;
            mensaje += "Error Monto\n";
        }
        total = total + parseFloat($('#dr' + vector[i] + ' #monto').val());
        if ($('#dr' + vector[i] + ' #detalle_factura').val() == "")
        {
            $('#dr' + vector[i] + ' #detalle_factura').addClass('border-red');
            glosa_factura = glosa_factura + $('#dr' + vector[i] + ' #detalle_factura').val() + '*|*';
            llave_paso = 0;
            mensaje += "Error Descripcion\n";
        } else
        {
            glosa_factura = glosa_factura + $('#dr' + vector[i] + ' #detalle_factura').val() + '*|*';
        }

        estacion = estacion + $('#dr' + vector[i] + ' #id_sitio :selected').val() + ';';
        // placa_vehiculo = placa_vehiculo + $('#dr' + vector[i] + ' #placa_veh').val() + ';';
        if ($('#dr' + vector[i] + ' #id_proy_sitio_detalle :selected').val() == 0)
        {   //alert();
            $('#dr' + vector[i] + ' #id_proy_sitio_detalle').addClass('border-red');
            llave_paso = 0;
            mensaje += "Error en los Proyecto de los Items\n";
            // adjuntos = adjuntos + $('#dr' + vector[i] + ' #adjuntos_rutas' + vector[i]).val() + ';';
        }
        id_proyecto += $('#dr' + vector[i] + ' #id_proy_sitio_detalle :selected').val() + ";";
        //adjuntos = adjuntos + $('#dr' + vector[i] + ' #adjuntos_rutas' + vector[i]).val() + ';';
    }

    if ($('#tecnico_seleccionado :selected').val() == 0)
    {
        $('#tecnico_seleccionado').addClass('border-red');
        llave_paso = 0;
        mensaje += "Error En la seleccion del usuario\n";
    }
    if ($('#titulo').val() == "")
    {
        $('#titulo').addClass('border-red');
        llave_paso = 0;
        mensaje += "Error En la Titulo o Referencia de la Solicitud\n";
    }

    if (llave_paso == 1) {
        $.post(burl + "fondosRendir/guardar_nueva_sfr", {
            'id_sitio': $('#id_sitio :selected').val(),
            'id_det_factura': id_det_dfr,
            'ids_delete': $('#det_delete').val(),
            'titulo': $('#titulo').val(),
            'monto': monto,
            'total': total,
            'estado': $("#estado_solicitud").val(),
            'glo_f': glosa_factura,
            'id_rend': $('#id_rend').val(),
            'id_proy': id_proyecto,
            'id_usu': $('#tecnico_seleccionado :selected').val(),
            'id_cuenta': $('#cuenta_banco_usuario :selected').val(),
            'desc': $('#desc').val(),
            'estaciones_selec': estacion

        }

        , function (data) {

            $("#recuperacion").html(data);

            mostrar_fomrulario_sol_fr($("#ayudata").val());
            new PNotify({
                title: 'Registro Exitoso!',
                text: $("#mensajeayudata").val(),
                type: 'success',
                styling: 'bootstrap3'
            });
            setTimeout(function () {
                $("#bloqueo_pagina").addClass("ocultar");

            }, 3000);



            // }

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
function ocultar_fomrulario_sfr()
{
    $("#formuarioSolFR").html('');
    //borrarcontenidositio();

}
function Imp_sol_fr(id_rend)
{
    // alert (registro);
    //alert($("#burl").val());
    baseurl = $("#b_url").val() + 'impresiones_pdf/imp_form_solicitud_Fondos/' + id_rend;
    miven = window.open(baseurl, "mywindow", "menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");

}
function obtener_cuentas_usuario(cuenta)
{
    // alert($('#tecnico_seleccionado :selected').val()+".."+cuenta);
    burl = $('#b_url').val();
    $.post(burl + "usuario/obtener_cuentas_usuario", {
        'id_user': $('#tecnico_seleccionado :selected').val(),
        'id_sel': cuenta,
       

    }

    , function (data) {
        $("#cuenta_usuario").html(data);

    });
}

function form_cuenta_banco(espacio)
{
    banco=["Banco BISA S.A.",
"Banco de Crédito de Bolivia S.A.",
"Banco de Desarrollo Productivo S.A.M.",
"Banco de la Nación Argentina S. A.",
"Banco Económico S.A.",
"Banco Fassil S.A.",
"Banco Fortaleza S.A.",
"Banco Ganadero S.A.",
"Banco Mercantil Santa Cruz S.A.",
"Banco Nacional de Bolivia S.A.",
"Banco para el Fomento a Iniciativas Económicas S.A.",
"Banco Prodem S.A.",
"Banco PYME de la Comunidad S.A.",
"Banco PYME Ecofuturo S.A.",
"Banco Solidario S.A.",
"Banco Unión S.A."
];
codigosel="";
for (i=0;i<banco.length;i++)
{
    codigosel+="<option value="+banco[i]+">"+banco[i]+"</option>";
}
codigosel="<select id='banco' class='form-control'>"+codigosel+"</select>";
codigoin="<input type='text' id='nocta'>";

codigo_gral="<div class='col-md-4 col-sm-4 col-xs-12 alert alert-danger alert-dismissible fade in'> NOTA.- La cuenta debe ser estrictamente de la persona a solicitar </div>"+
"<div class='col-md-4 col-sm-4 col-xs-12'>Banco :"+codigosel+"</div>"+
"<div class='col-md-4 col-sm-4 col-xs-12'>Nro de Cuenta : "+codigoin+"</div>\n\
<button>Registrar Nueva Cuenta de Banco</button>";
$("#"+espacio).html(codigo_gral);


    
    
}



function enviar_sol_fondos_rendir()
{
    $("#estado_solicitud").val("Enviado");
    guardar_sol_fondos_rendir();
    enviar_correo_notificacion_fr("Enviado");

}
function enviar_correo_notificacion_fr(estado)
{
    burl = $('#b_url').val();
    
    $.post(burl + "notificaciones_correo/notificacion_solFR", {
        'fr_id': $('#id_rend').val(),
        'id_est': estado

    }

    , function (data) {
       1; //$("#cuenta_usuario").html(data);

    });
}