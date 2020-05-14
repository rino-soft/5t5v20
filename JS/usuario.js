///USUARIOS
function search_user(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_list_user('list_user_system');
    }  
   
}
function search_list_user(div_resultado)
{
    burl=$('#b_url').val();
    buscar=$("#search_user").val();
    //  cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    conbajas="no";
    if ($('#conbajas').is(':checked'))
        conbajas="si";
    //alert(conbajas);
   // $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
   $("#" + div_resultado).html($("#cargando_grande").html());
    // alert("1p"+$('#search_user').val()+"2p"+$('#mostrarX :selected').val()+"3p"+$('#pagina_registros').val());
    $.post(burl+"usuario/find_list_user",{
                    
        'buscar':$('#search_user').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val(),
        'conbajas':conbajas
    }
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
}


function search_list_user_proyectos(div_resultado)
{
    burl=$('#b_url').val();
    buscar=$("#search_user").val();
    //  cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    
    
    //$("#"+div_resultado).html('<div class="cargando_circulo"></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $("#" + div_resultado).html($("#cargando_grande").html());
    // alert("1p"+$('#search_user').val()+"2p"+$('#mostrarX :selected').val()+"3p"+$('#pagina_registros').val());
    $.post(burl+"usuario/find_list_user_proyecto",{                    
        'buscar':$('#search_user').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val(),
        'id_proyecto':$('#id_proyecto_busqueda :selected').val()
    }
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
}
function search_user_responsable(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_list_user_proyectos('list_user_system');
    }  
   
}

function mostrar_cuadro_dias_vacacion(div_resultado,usuario)
{
    burl=$('#b_url').val();
       
    $("#"+div_resultado).html('<div class="cargando_barra" ></div>');
    $.post(burl+"usuario/calculo_vacaciones",{
       user:usuario
    }
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
}


function search_list_user_apropiacion(div_resultado)
{
    burl=$('#b_url').val();
    buscar=$("#search_user").val();
    //  cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    conbajas="no";
    if ($('#conbajas').is(':checked'))
        conbajas="si";
    //alert(conbajas);
    //$("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
      $("#" + div_resultado).html($("#cargando_grande").html());
    // alert("1p"+$('#search_user').val()+"2p"+$('#mostrarX :selected').val()+"3p"+$('#pagina_registros').val());
    $.post(burl+"usuario/find_list_user_apropiacion",{
                    
        'buscar':$('#search_user').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val(),
        'conbajas':conbajas
    }
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
}