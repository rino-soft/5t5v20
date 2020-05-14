function informacion_presupuestos(div_dialog,tipo,proyecto)
{
    burl = $('#b_url').val();
     $("#" + div_dialog).html('<div class="cargando_barra" style="height:150px; width:auto;"  ></div>');
    $.post(burl + "centro_costos/grafica_presupuesto", {'proyecto': 1,'div':div_dialog}
    , function (data) {
       $("#" +div_dialog).html(data);
    });
}
function informacion_historicos_economicos(div_dialog,tipo,proyecto)
{
    burl = $('#b_url').val();
     $("#" + div_dialog).html('<div class="cargando_barra" style="height:150px; width:auto;"  ></div>');
    $.post(burl + "centro_costos/grafica_historicos", {'proyecto': 1,'div':div_dialog}
    , function (data) {
       $("#" +div_dialog).html(data);
    });
}




function rescatar_informacion_centro_costos(menu,graficas,proyecto)
{
    burl = $('#b_url').val();
    $("#bloqueo_pagina").removeClass("ocultar");
    idproy=$("#"+proyecto+" :selected").val();
    $.post(burl + "centro_costos/resumen_proyectos_botones/"+idproy,{}
    , function (data) {
       $("#" +menu).html(data);
       
    });
    $.post(burl + "centro_costos/graficas_proyecto/"+idproy,{}
    , function (data) {
       $("#" +graficas).html(data);
       $("#bloqueo_pagina").addClass("ocultar");
    });
    
    
     
}