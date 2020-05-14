function filtrar_proyecto_rendiciones(id_padre) {

    burl = $('#b_url').val();
    proyecto = $("#id_proyectototal :selected").val();
    redirigir(burl + "rendiciones/index_terceros/" + id_padre + "/" + proyecto);
}
function mostrar_fomrulario_nueva_rendicion_terceros(id_rend)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html('formulario_rendicion', burl + 'rendiciones/nueva_rendicion_tercero/' + id_rend, 0);//modulo=0 no sirve

}
function mostrar_fomrulario_nueva_rendicion_mio(id_rend, tipo, id_doc,usuario)
{
    burl = $('#b_url').val();
    this.cargar_contenido_html('formulario_rendicion', burl + 'rendiciones/nueva_rendicion_mio/' + id_rend + '/' + tipo + '/' + id_doc+'/'+usuario, 0);//modulo=0 no sirve

}

function cargar_sitiosproyecto()
{
    proy = $("#id_proy_sitio :selected").val();
    $.post(burl + "rendiciones/cargar_sitios_proyecto", {
        'proy': proy
                //'desc': $('#dialog_rechazo #comentario_rechazo_rendicion').val()
    }

    , function (data) {
        $(".sitioselect_carga").html(data);
    });
}
function obtener_estado_cuentas(resultado1, resultado2)
{
    //tipo=$("#tipo_rendicion :selected").val();
    usuario = $("#tecnico_seleccionado :selected").val();
    burl = $('#b_url').val();
    $("#relacion_documento").removeClass("ocultar");
    $.post(burl + "rendiciones/obtener_estado_cuentas_usuario", {
        'tipo': 'Reembolso',
        'usuario': usuario
                //'desc': $('#dialog_rechazo #comentario_rechazo_rendicion').val()
    }

    , function (data) {

        $("#" + resultado1).html(data);
    });

    $.post(burl + "rendiciones/obtener_estado_cuentas_usuario", {
        'tipo': 'Rendicion',
        'usuario': usuario
                //'desc': $('#dialog_rechazo #comentario_rechazo_rendicion').val()
    }

    , function (data) {

        $("#" + resultado2).html(data);

    });
}