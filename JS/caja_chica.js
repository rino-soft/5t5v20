function obtenercajas_chicas()
{
     burl = $('#b_url').val();
    $.post(burl + "caja_chica/obtener_cajas_chicas_usuario", {
        'id_user': $('#tecnico_seleccionado :selected').val()
        
       

    }

    , function (data) {
        $("#cajasrelacionadas").html(data);

    });
}
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

function mostrar_fomrulario_cc(id_cc)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html('formuarioSolFR', burl + 'caja_chica/nuevo_cc/' + id_cc, 0);//modulo=0 no sirve

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
function guardar_sol_cc()
{

    $('#save').button('disable');
   
    $("#bloqueo_pagina").removeClass("ocultar");
    $("#estado_solicitud").val("Guardado");
   llave_paso=1;
    if (llave_paso == 1) {
        $.post(burl + "caja_chica/guardar_nueva_cc", {
            //'id_sitio': $('#id_sitio :selected').val(),
           // 'id_det_factura': id_det_dfr,
           // 'ids_delete': $('#det_delete').val(),
            //'titulo': $('#titulo').val(),
            'monto': $("#monto").val(),
            //'total': total,
            'estado': $("#estado_solicitud").val(),
            //'glo_f': glosa_factura,
            'id_cc': $('#id_cc').val(),
            'id_proy':$("#id_proy_sitio").val(),
            'id_usu': $('#tecnico_seleccionado :selected').val(),
            'id_cuenta': $('#cuenta_banco_usuario :selected').val(),
            'desc': $('#desc').val()
            //'estaciones_selec': estacion

        }

        , function (data) {

            $("#recuperacion").html(data);

            mostrar_fomrulario_cc($("#ayudata").val());
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
        'id_sel': cuenta

    }

    , function (data) {
        $("#cuenta_usuario").html(data);

    });
  
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