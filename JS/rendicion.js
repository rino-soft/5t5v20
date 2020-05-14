/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 *///I started all of functions 18/03/16 :by Magali Poma Rivero
function search_rt(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina_registros").val(1);
        search_and_list_rendiciones_rt('lista_rendicion');
    }

}
function search_and_list_rendiciones_rt(div_resultado)
{
    /// alert ("ingresando a la funcion!!!!!!!!!!");
    burl = $('#b_url').val();
    /* buscar=$("#search_ren").val();
     cant=$("#cant_reg :selected").val();
     pagina=$("#pagina_registros").val();*/

    //$("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $('#' + div_resultado).html($("#cargando_grande").html());
    $.post(burl + "rendiciones/busqueda_de_rendiciones_rt",
            {
                'buscar': $('#search_rendicion').val(),
                'cant': $('#mostrarX :selected').val(),
                'pagina': $('#pagina_registros').val(),
                'proy': $('#id_proyecto :selected').val()
            }

    , function (data) {
        $("#" + div_resultado).html(data);
    });

}
// function jp
function search_jp(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina_registros").val(1);
        search_and_list_mis_rendiciones_jp('lista_rendicion');
    }

}
function search_and_list_mis_rendiciones_jp(div_resultado)
{
    /// alert ("ingresando a la funcion!!!!!!!!!!");
    burl = $('#b_url').val();
    /* buscar=$("#search_ren").val();
     cant=$("#cant_reg :selected").val();
     pagina=$("#pagina_registros").val();*/
    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');

    $.post(burl + "rendiciones/busqueda_de_rendiciones_jp", {
        'buscar': $('#search_rendicion').val(),
        'cant': $('#mostrarX :selected').val(),
        'pagina': $('#pagina_registros').val()
    }

    , function (data) {
        $("#" + div_resultado).html(data);
    });

}
//function tecnico
function search_te(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina_registros").val(1);
        search_and_list_mis_rendiciones_te('lista_rendicion');
    }

}
function search_and_list_mis_rendiciones_te(div_resultado)
{
    /// alert ("ingresando a la funcion!!!!!!!!!!");
    burl = $('#b_url').val();
    /* buscar=$("#search_ren").val();
     cant=$("#cant_reg :selected").val();
     pagina=$("#pagina_registros").val();*/
//    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $('#' + div_resultado).html($("#cargando_grande").html());
    $.post(burl + "rendiciones/busqueda_de_rendiciones_te", {
        'buscar': $('#search_rendicion').val(),
        'cant': $('#mostrarX :selected').val(),
        'pagina': $('#pagina_registros').val()
    }

    , function (data) {
        $("#" + div_resultado).html(data);
    });

}
function seleccionar_rendiciones(opcion) {
    //alert('seleccionar_rendiciones');
    if (opcion == 1)
    {
        $('.select_and_unselect').prop("checked", true);
        $('input:checkbox:checked').each(function ()
        {
            $('#cont_id_rend').val($('#cont_id_rend').val() + ";" + $(this).val());
        });


    } else {
        $('.select_and_unselect').prop("checked", false);
        $('#cont_id_rend').val('');
    }

}
/*function desmarcar_rendiciones(){
 alert('desmSarcar_rendiciones');
 }*/


// incio funciones 31/03/16
function Imp_reporte_de_rendicion_proy()
{
    ids = $('#cont_id_rend').val();
    baseurl = $("#b_url").val() + 'impresiones_pdf/imp_rendicion_por_proyecto/' + ids;
    miven = window.open(baseurl, "mywindow", "menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");

}
function acumula_rend(id_rend) {
    if ($('#div' + id_rend + ' #check_rend').is(':checked'))
    {
        $('#cont_id_rend').val($('#cont_id_rend').val() + ";" + id_rend);

    } else
    {
        $('#cont_id_rend').val($('#cont_id_rend').val().replace(";" + id_rend, ''));
    }



}
///// function addd 13/04/16

function Imp_reporte_de_rendicion_tecnico(id_rend)
{
    baseurl = $("#b_url").val() + 'impresiones_pdf/imp_form_rendiciones_tecnico/' + id_rend;
    miven = window.open(baseurl, "mywindow", "menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");

}


//// add 19/04/16
function search_rr(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina_registros").val(1);
        search_and_list_mis_rendiciones_rr('lista_rendicion');
    }

}
function search_and_list_mis_rendiciones_rr(div_resultado)
{
    alert("ingresando a la funcion!!!!!!!!!!");
    burl = $('#b_url').val();
    /* buscar=$("#search_ren").val();
     cant=$("#cant_reg :selected").val();
     pagina=$("#pagina_registros").val();*/
    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');

    $.post(burl + "rendiciones/busqueda_de_rendiciones_rr", {
        'buscar': $('#search_rendicion').val(),
        'cant': $('#mostrarX :selected').val(),
        'pagina': $('#pagina_registros').val()
    }

    , function (data) {
        $("#" + div_resultado).html(data);
    });

}

//// add 20/04/16
function search_recep_rr(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("#pagina_registros").val(1);
        search_and_list_mis_rendiciones_recep_rr('lista_rendicion');
    }

}
function search_and_list_mis_rendiciones_recep_rr(div_resultado)
{
    alert("ingresando a la funcion!!!!!!!!!!");
    burl = $('#b_url').val();
    $("#" + div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');

    $.post(burl + "rendiciones/busqueda_de_rendiciones_recep_rr", {
        'buscar': $('#search_rendicion').val(),
        'cant': $('#mostrarX :selected').val(),
        'pagina': $('#pagina_registros').val()
    }

    , function (data) {
        $("#" + div_resultado).html(data);
    });

}



