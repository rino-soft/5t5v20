/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



//funciones de CONFIGURACIONES SISTEMA
function dialog_contenidos_nuevo_menu(div_dialog,direccion,modulo,id_modulo)
{
    this.cargar_contenido_html(div_dialog,direccion,modulo);
    $( "#"+div_dialog ).dialog({
        title:"Nuevo menu en modulo '"+modulo+"'",
        autoOpen: true,
        height: 460,
        width: 405,
        modal: true,
        buttons: {
            "Reset":function(){
                $("input").val("");
            },
            "Guardar": function() {
            //alert("guardar");
            //$( this ).dialog( "close" );
                
            },
            "Cancelar": function() {
               
                $( this ).dialog( "close" );
            }
        }
    });
}
//fin funciones CONFIGURACION SISTEMA*********************************************************************************************************
//funciones de cliente
function cambios_form()
{
    $("input").change(function(){
        $('#cambios').val("si");
    });   
}

function dialog_contenidos_nuevo_usuario(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    // saber si es nuevo o es edicion
    
    d=direccion.split("/");
    dc=d.length-1
    titulo="Nuevo Usuario";
    if(d[dc]!=0)
        titulo="Modificacion de datos de Uusuario";
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 500,
        width: 405,
        modal: true,
        closeOnEscape: false,
        open: function(event, ui) {
            $(".ui-dialog-titlebar-close").hide();
        },
       
        buttons: {
            "Reset":function(){
                if(d[dc]!=0)
                    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
                else
                    $("input").val("");
            },
            "Guardar": function() {
                
                $.post(burl+"usuario/guardar_usuario",{
                    'id_user':$('#id_user').val(),
                    'nom':$('#nom').val(),
                    'app':$('#app').val(),
                    'apm':$('#apm').val(),
                    'ci':$('#ci').val(),
                    'user':$('#user').val(),
                    'pass':$('#pass').val(),
                    'est':$('#est').val(),
                    'fhr':$('#fhr').val()
                },function(data){
                    $("#"+div_dialog).html(data);
                    
                });
                setTimeout(function(){                  
                    if($('#proceso').val()!="UPDATE")
                    {
                        $( this ).dialog( "close" );
                        setTimeout(function(){                  
                            this.dialog_contenidos_nuevo_usuario(div_dialog,burl+'usuario/usuario_nuevo/'+$('#ayudata').val()+"/0");
                        }, 1000);
                    }
                    else
                        this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve  
                }, 1000);
                
                
            },
            "Cerrar": function() {
               
                $(this).dialog( "close" );
                
            }
        }
    });
}
function dialog_contenidos_nuevo_contacto(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:"Nuevo Contacto Cliente",
        autoOpen: true,
        height: 660,
        width: 405,
        modal: true,
        closeOnEscape: false,
        open: function(event, ui) {
            $(".ui-dialog-titlebar-close").hide();
        },
        buttons: {
            "Reset":function(){
                cargar_contenido_html(div_dialog,direccion,0);
            },
            "Guardar": function() {
                $.post(burl+"cliente/guardar_contacto_cliente_nuevo",{
                    
                    'id_cont':$('#id_cont').val(),
                    'nom_com':$('#nom_com').val(),
                    'cargo':$('#cargo').val(),
                    'tel':$('#tel').val(),
                    'dir':$('#dir').val(),  
                    'id_cli':$('#id_cli').val()
                }
                ,function(data){
                    $("#"+div_dialog +" #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        cargar_contenido_html(div_dialog,direccion,0);
                    }, 1000);
                    
                });
            },
            "Cerrar": function() {
               
                $( this ).dialog( "close" );
                location.reload();
            }
        }
    });
}
//fin funciones de cliente*********************************************************************************************************
//funciones para prefactura u orden de venta

function search_ingreso(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina").val(1);
        search_and_list_ov_al();
    }  
   
}
function search_detalle(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_and_list_detalle('lista_oventa_prefacturas');
    }  
   
}
function search_and_list_detalle(div_resultado)
{
    burl=$('#b_url').val();
    buscar=$("#search_detalle").val();
    cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl+"movimiento_almacen/busqueda_lista_al_detalle",{
                    
        'buscar':$('#search_detalle').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val()
    }
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
}
function dialog_nueva_prefac(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:"Nueva Orden de Venta / Pre-factura",
        autoOpen: true,
        height: 650,
        width: 1050,
        modal: true,
        closeOnEscape: false,
        buttons:[
        {
            id: "save",
            text: "Guardar",
            disabled:"true",
            click: function() {
                ids=$("#ids_seleccionados").val();
                vec=ids.split(",");
                data_ids="";
                data_cod="";
                data_tit="";
                data_des="";
                data_comen="";
                data_cant="";
                data_um="";
                data_pu="";
                data_sub="";
                for(i=1;i<vec.length;i++)
                { 
                    // alert("vec["+i+"]"+vec[i]);
                    data_ids+="|"+vec[i];
                    data_cod+="|"+$("#sel"+vec[i]+" #cod_ps").val();
                    data_tit+="|"+$("#sel"+vec[i]+" #tit_ps").val();
                    data_des+="|"+$("#sel"+vec[i]+" #desc_ps").val();
                    data_comen+="|"+$("#sel"+vec[i]+" #coment").val();
                    data_cant+="|"+$("#sel"+vec[i]+" #cantidad").val();
                    data_um+="|"+$("#sel"+vec[i]+" #um").val();
                    data_pu+="|"+$("#sel"+vec[i]+" #pu").val();
                    data_sub+="|"+$("#sel"+vec[i]+" #subtotal").val();
                    
                }
                $.post(burl+"oventa_prefactura/ov_pf_save",{
                    
                    'ids':data_ids,
                    'cods':data_cod,
                    'tits':data_tit,
                    'descs':data_des,
                    'coments':data_comen,
                    'cants':data_cant,
                    'ums':data_um,
                    'pus':data_pu,
                    'subs':data_sub,
                    'totalpf':$("#total_calculo").val(),
                    'coment_gral':$("#comentario_general").val()
                }
                ,function(data){
                    $("#"+div_dialog +" #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        cargar_contenido_html(div_dialog,direccion,0);
                    }, 1000);
                    
                });
            }
        },
        {
            id: "disable-guardar",
            text: "noguardar",
            click: function() {
                $("#button-ok").button("disable");
            }
        },
        {
            id: "enable-guardar",
            text: "siguardar",
            click: function() {
                $("#button-ok").button("enable");
            }
        },
        {
            id: "button-ok",
            text: "cerrar",
            click: function() {
                // $(this).dialog("close");
                $("#mensaje").dialog({
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
                
            //$(this).dialog();
            }
        }
        ]
    });
}
function search(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina").val(1);
        busqueda_prod_serv();
    }  
   
}
function busqueda_prod_serv()
{
   // alert("ingresa aqui"); 
    $("#resultado_busqueda").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Buscando...</div>');
    buscar=$("#in_search").val();
    if(buscar!=""){
        $.post(burl+"producto_servicio/busqueda_prod_serv",{
                    
            'busqueda':buscar,
            'selecionados':$("#ids_seleccionados").val(),
            'cant':$("#mostrar_X :selected").val(),
            'pag':$("#pagina").val()
                    
        }
        ,function(data){
            $("#resultado_busqueda").html(data);
                    
        });
    }
    else
        $("#resultado_busqueda").html('');
}
function cambiarpagina(pagina)
{
    $("#pagina").val(pagina)
    busqueda_prod_serv();
}
function cambiarpagina_art(pagina)
{
    $("#pagina_art").val(pagina)
    search_art();
}

/*function quitaritem(id_prod,indice)
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
        
    if(cont<=1)
    {
        $('#check'+id_prod).attr('checked', false);
        $("#"+id_prod).removeClass("seleccionado");
    }
    $("#ids_seleccionados").val($("#ids_seleccionados").val().replace(','+id_prod+'-'+indice,''))
    $("#sel"+id_prod+"-"+indice).remove();
    c=parseInt($("#cant_item").val())-1;
    $("#cant_item").val(c);
    if(parseInt($("#cant_item").val())>0 && parseInt($("#total_calculo").val())>0)
        $("#save").button('enable');
    else
        $("#save").button('disable');
}

function mostrar_quitar_coment(id_p,indice,opcion){
    if(opcion==1)
    {
        $("#sel"+id_p+"-"+indice+" #coment").removeClass("ocultar");
        $("#sel"+id_p+"-"+indice+" #oculta").removeClass("\n\
");
        $("#sel"+id_p+"-"+indice+" #ver").addClass("ocultar");
    }
    else
    {
        $("#sel"+id_p+"-"+indice+" #coment").addClass("ocultar");
        $("#sel"+id_p+"-"+indice+" #coment").val("");
        $("#sel"+id_p+"-"+indice+" #oculta").addClass("ocultar");
        $("#sel"+id_p+"-"+indice+" #ver").removeClass("ocultar");
    }
}*/
function mostrar_quitar_list_sel(id_p,indice,opcion){
    if(opcion==1)
    {
        $("#sel"+id_p+"-"+indice+" #serial_old"+id_p+"-"+indice).removeClass("ocultar");
       
        
    }
    else
    {
        $("#sel"+id_p+"-"+indice+" #serial_old"+id_p+"-"+indice).addClass("ocultar");
        $("#sel"+id_p+"-"+indice+" #serial_old"+id_p+"-"+indice).val("ocultar");
   
    }
}
function mostrar_quitar_obs(id_p,indice,opcion){
    if(opcion==1)
    {
        $("#sel"+id_p+"-"+indice+" #obs"+id_p+"-"+indice).removeClass("ocultar");
       
        
    }
    else
    {
        $("#sel"+id_p+"-"+indice+" #obs"+id_p+"-"+indice).addClass("ocultar");
        $("#sel"+id_p+"-"+indice+" #obs"+id_p+"-"+indice).val("ocultar");
   
    }
}


//funciones para movimiento de almacen*********************************************************************************************************

//funciones para movimiento de almacen*********************************************************************************************************
function ver_mov_alm(div_destino)
{
    //alert("holaaaa");
    
 
    $("#resultado_busqueda").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Buscando...</div>');
    buscar=$("#in_search").val();
    
    if(buscar!=""){
        $.post(burl+"movimiento_almacen/ver_mov_alm",{
                    
            'busqueda':buscar,
            'selecionados':$("#ids_seleccionados").val(),
            'cant':$("#mostrar_X :selected").val(),
            'pag':$("#pagina").val()
                    
        }
        ,function(data){
            $("#resultado_busqueda").html(data);
                    
        });
    }
    else
        $("#resultado_busqueda").html('');
}

function dialog_contenidos_nuevo_alm_mov1(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:"Nuevo Movimiento de Almacen",
        autoOpen: true,
        height: 660,
        width: 405,
        modal: true,
        closeOnEscape: false,
        open: function(event, ui) {
            $(".ui-dialog-titlebar-close").hide();
        },
        buttons: {
            "Reset":function(){
                cargar_contenido_html(div_dialog,direccion,0);
            },
            "Guardar": function() {
                $.post(burl+"movimiento_almacen/guardar_mov_alm_nuevo",{
                    
                    'ids':$('#ids').val(),
                    'fhr':$('#fhr').val(),
                    'tm':$('#tm').val(),
                    'proy':$('#proy').val(),
                    'com':$('#com').val(),  
                    'tdo':$('#tdo').val()
                }
                ,function(data){
                    $("#"+div_dialog +" #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        cargar_contenido_html(div_dialog,direccion,0);
                    }, 1000);
                    
                });
            },
            "Cerrar": function() {
               
                $( this ).dialog( "close" );
                location.reload();
            }
        }
    });
}

function dialog_contenidos_nuevo_alm_mov(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:"Nuevo Movimiento de Almacen",
        autoOpen: true,
        height: 660,
        width: 405,
        modal: true,
        closeOnEscape: false,
        open: function(event, ui){
            $(".ui-dialog-titlebar-close").hide();
        },
        buttons:
        {
            
            "Reset":function(){
                cargar_contenido_html(div_dialog,direccion,0);
            },
            "Guardar": function() {
                $.post(burl+"movimiento_almacen/mov_alm_save",{
                    
                    'idma':$('#idma').val(),
                    'fhr':$('#fhr').val(),
                    'tm':$('#tm').val()
                    
                }
                ,function(data){
                    $("#"+div_dialog +" #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        cargar_contenido_html(div_dialog,direccion,0);
                    }, 1000);
                    
                });
            },
            "Cerrar": function() {
               
                $( this ).dialog( "close" );
                location.reload();
            }
        }
       
       
    
    });
}

function dialog_contenidos_nuevo_ingreso(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    // saber si es nuevo o es edicion
    
    d=direccion.split("/");
    dc=d.length-1
    titulo="Ingreso";
    if(d[dc]!=0)
        titulo="Momiento de Almacen";
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 500,
        width: 405,
        modal: true,
        closeOnEscape: false,
        open: function(event, ui) {
            $(".ui-dialog-titlebar-close").hide();
        },
       
        buttons: {
            "Reset":function(){
                if(d[dc]!=0)
                    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
                else
                    $("input").val("");
            },
            "Guardar": function() {
                // alert("holaaaa");
                    
                $.post(burl+"movimiento_almacen/guardar_ingreso",{
                    'id_i':$('#id_i').val(),
                    'fhr':$('#fhr').val(),
                    'tm':$('#tm').val(),
                    'proy':$('#proy').val(),
                    'com':$('#com').val(),
                    'tdo':$('#tdo').val(),
                    'dr':$('#dr').val()
                    
                },function(data){
                    alert("holaaaa");
                    $("#"+div_dialog +" #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        cargar_contenido_html(div_dialog,direccion,0);
                    }, 1000);
                    
                });
              
                
                
            },
            "Cerrar": function() {
             
                $( this ).dialog( "close" );
                location.reload();
                
            }
        }
    });
}

function dialog_contenidos_nuevo_ingreso1(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    // saber si es nuevo o es edicion
    
    d=direccion.split("/");
    dc=d.length-1
    titulo="Ingreso";
    if(d[dc]!=0)
        titulo="Momiento de Almacen";
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 500,
        width: 405,
        modal: true,
        closeOnEscape: false,
        open: function(event, ui) {
            $(".ui-dialog-titlebar-close").hide();
        },
       
        buttons: {
            "Reset":function(){
                if(d[dc]!=0)
                    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
                else
                    $("input").val("");
            },
            "Guardar": function() {
                // alert("holaaaa");
                    
                $.post(burl+"movimiento_almacen/guardar_ingreso",{
                    'id_i':$('#id_i').val(),
                    'fhr':$('#fhr').val(),
                    'tm':$('#tm').val(),
                    'proy':$('#proy').val(),
                    'com':$('#com').val(),
                    'tdo':$('#tdo').val(),
                    'dr':$('#dr').val()
                    
                },function(data){
                    alert("holaaaa");
                    $("#"+div_dialog +" #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        cargar_contenido_html(div_dialog,direccion,0);
                    }, 1000);
                    
                });
              
                
                
            },
            "Cerrar": function() {
             
                $( "#"+div_dialog ).dialog( "close" );
            // location.reload();
                
            }
        }
    });
}
function dialog_contenidos_nuevo_ingreso_detalle(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);
    d=direccion.split("/");
    dc=d.length-1
    titulo="Detalle";
    if(d[dc]!=0)
        titulo="Momiento de Almacen";
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 480,
        width: 800,
        modal: true,
        closeOnEscape: false,
        buttons: {
           
            "Cerrar": function() {
             
                $( "#"+div_dialog).dialog( "close" );
            // location.reload();
                
            }
        }
    });
}

function dialog_contenidos_nuevo_ingreso_detalle1(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);
    d=direccion.split("/");
    dc=d.length-1
    titulo="Detalle";
    if(d[dc]!=0)
        titulo="Momiento de Almacen";
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 500,
        width: 800,
        modal: true,
        closeOnEscape: false,
        open: function(event, ui) {
            $(".ui-dialog-titlebar-close").hide();
        },
       
        buttons: {
           
            "Cerrar": function() {
             
                $( "#"+div_dialog ).dialog( "close" );
            //location.reload();
                
            }
        }
    });
}
function dialog_contenidos_baja_ingreso(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    // saber si es nuevo o es edicion
    
    d=direccion.split("/");
    dc=d.length-1
    titulo="Eliminar";
    if(d[dc]!=0)
        titulo="Momiento de Almacen";
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 500,
        width: 405,
        modal: true,
        closeOnEscape: false,
        open: function(event, ui) {
            $(".ui-dialog-titlebar-close").hide();
        },
       
        buttons: {
            "Reset":function(){
                if(d[dc]!=0)
                    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
                else
                    $("input").val("");
            },
            "Guardar": function() {
                // alert("holaaaa");
                    
                $.post(burl+"movimiento_almacen/guardar_ingreso",{
                    'id_i':$('#id_i').val(),
                    'fhr':$('#fhr').val(),
                    'tm':$('#tm').val(),
                    'proy':$('#proy').val(),
                    'com':$('#com').val(),
                    'tdo':$('#tdo').val(),
                    'dr':$('#dr').val()
                    
                },function(data){
                    alert("holaaaa");
                    $("#"+div_dialog +" #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        cargar_contenido_html(div_dialog,direccion,0);
                    }, 1000);
                    
                });
              
                
                
            },
            "Eliminar": function() {
             
                $.post(burl+"movimiento_almacen/eliminar_ingreso",{
                    'id_i':$('#id_i').val(),
                    'fhr':$('#fhr').val(),
                    'tm':$('#tm').val(),
                    'proy':$('#proy').val(),
                    'com':$('#com').val(),
                    'tdo':$('#tdo').val(),
                    'dr':$('#dr').val()
                    
                },function(data){
                    alert("holaaaa");
                    $("#"+div_dialog +" #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        cargar_contenido_html(div_dialog,direccion,0);
                    }, 1000);
                    
                });
                
            },
            "Cerrar": function() {
             
                $( this ).dialog( "close" );
                location.reload();
                
            }
        }
    });
}
function dialog_contenidos_mostrar_alm(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:"Mostrar Movimiento de Almacen",
        autoOpen: true,
        height: 660,
        width: 405,
        modal: true,
        closeOnEscape: false,
        open: function(event, ui){
            $(".ui-dialog-titlebar-close").hide();
        },
        buttons:
        {
            
            "Reset":function(){
                cargar_contenido_html(div_dialog,direccion,0);
            },
            "Guardar": function() {
                $.post(burl+"movimiento_almacen/almacen_ver",{
                    
                    'idma':$('#idma').val(),
                    'fhr':$('#fhr').val(),
                    'tm':$('#tm').val()
                    
                }
                ,function(data){
                    $("#"+div_dialog +" #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        cargar_contenido_html(div_dialog,direccion,0);
                    }, 1000);
                    
                });
            },
            "Cerrar": function() {
               
                $( this ).dialog( "close" );
                location.reload();
            }
        }
       
       
    
    });
}
function dialog_nuevo_mov_alm(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:"Nuevo Ingreso de Material/Insumos/Herramientas",
        autoOpen: true,
        height: 650,
        width: 1050,
        modal: true,
        closeOnEscape: false,
        buttons:[
        {
            id: "save",
            text: "Guardar",
            disabled:"true",
            click: function() {
                idma=$("#idma_seleccionados").val();
                vec=idma.split(",");
                data_idma="";
                data_tm="";
                data_proy="";
                data_comen="";
                data_cant="";
                data_um="";
                data_pu="";
                data_sub="";
               
                for(i=1;i<vec.length;i++)
                { 
                    // alert("vec["+i+"]"+vec[i]);
                    data_idma+="|"+vec[i];
                    data_tm+="|"+$("#sel"+vec[i]+" #cod_ma").val();
                    data_proy+="|"+$("#sel"+vec[i]+" #proy").val();
                    data_comen+="|"+$("#sel"+vec[i]+" #coment").val();
                    data_cant+="|"+$("#sel"+vec[i]+" #cantidad").val();
                    data_um+="|"+$("#sel"+vec[i]+" #um").val();
                    data_pu+="|"+$("#sel"+vec[i]+" #pu").val();
                    data_sub+="|"+$("#sel"+vec[i]+" #subtotal").val();
                    
                    
                }
                $.post(burl+"movimiento_almacen/mov_alm_save",{
                    
                    'idma':data_idma,
                    'tm':data_tm,
                    'proy':data_proy,
                    'comen':data_coment,
                    'coments':data_comen,
                    'cants':data_cant,
                    'ums':data_um,
                    'pus':data_pu,
                    'subs':data_sub,
                    'totalpf':$("#total_calculo").val(),
                    'coment_gral':$("#comentario_general").val()
                }
                ,function(data){
                    $("#"+div_dialog +" #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        cargar_contenido_html(div_dialog,direccion,0);
                    }, 1000);
                    
                    
                    
                });
            }
        },
        {
            id: "disable-guardar",
            text: "noguardar",
            click: function() {
                $("#button-ok").button("disable");
            }
        },
        {
            id: "enable-guardar",
            text: "siguardar",
            click: function() {
                $("#button-ok").button("enable");
            }
        },
        {
            id: "button-ok",
            text: "cerrar",
            click: function() {
                // $(this).dialog("close");
                //$("#mensaje").dialog
                $( this ).dialog( "close" );
                location.reload();
                
            //$(this).dialog();
            }
        }
        ]
    });
}

function dialog_nuevo_mov_alm1(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:"Ingreso de Material/Insumos/Herramientas",
        autoOpen: true,
        height: 650,
        width: 1050,
        modal: true,
        closeOnEscape: false,
        buttons:[
        {
            id: "save1_mov",
            text: "Recepcionar Material",
            disabled:"true",
            click: function() {
                ids=$("#ids_seleccionados").val();
                // alert("entra ids"+ids);             
                vec=ids.split(",");
                data_ids="";
                data_idps="";
                data_ma="";
                data_cant="";
                data_comen="";
                cod_u="";
                tipo_m="";
                tipo_cup="";
                tipo_sn="";
                 
                for(i=1;i<vec.length;i++)
                { 
                    //alert("vec["+i+"]"+vec[i]);
                    data_ids+="|"+vec[i];
                    data_idps+="|"+$("#sel"+vec[i]+" #id_sp").val();
                    data_ma+="|"+$("#sel"+vec[i]+" #id_ma").val();
                    data_cant+="|"+$("#sel"+vec[i]+" #cant").val();
                    data_comen+="|"+$("#sel"+vec[i]+" #coment").val();
                    tipo_cup+="|"+$("#sel"+vec[i]+" #cp").val();
                    tipo_sn+="|"+$("#sel"+vec[i]+" #sn").val();
                 
                }
                var tipo_proy= $('#id_proyecto :selected').val();
                var tipo_almacen= $('#id_almacen :selected').val();
                //alert("no funciona"+$('#select_proyecto :selected').val());                
                //alert("aquii"+data_ids+","+data_idps+","+data_ma+","+data_cant+","+data_comen);
                
                $.post(burl+"movimiento_almacen/movimiento_almacen_pro_serv_save",{
                    'id_mov_alm':$("#id_sendma").val(),
                    'ids':data_ids,
                    'r_idps':data_idps,
                    'r_ma':data_ma,
                    'r_cant':data_cant,
                    'r_coments':data_comen,
                    'r_cup':tipo_cup,
                    'r_sn':tipo_sn,
                   
                    'cod_user':$("#id_personal :selected").val(),
                    'tipo_mov':"Ingreso",
                    'fh':$("#tim").val(),
                    'proyt':tipo_proy,
                    'cod_alm':tipo_almacen,
                    'estado':"Material Recepcionado",
                    'tipo_doc_o':"Movimiento Inventario",
                    'coment_gral':$("#comentario_general").val()
                }                
                ,function(data){
                    $("#"+div_dialog +" #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    $("#"+div_dialog +" #respuesta").html(data);
                   // alert($("#ayudata").val());
                    setTimeout(function(){
                        //cargar_contenido_html(div_dialog,direccion,0);
                        dir=this.quita_parametros(direccion,1);
                        cargar_contenido_html(div_dialog,dir+$("#ayudata").val(),0);
                        
                    }, 1000);
                
                });
            }
        },
        {
            id: "button-ok",
            text: "cerrar",
            click: function() {
                // $(this).dialog("close");
                //$("#mensaje").dialog
                $( this ).dialog( "close" );
                location.reload();                
            //$(this).dialog();
            }
        }
        ]
    });
}

function search_ingreso(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina").val(1);
        search_and_list_ov_al();
    }  
   
}

function search_tipo_ingreso(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_tipo('lista_oventa_prefacturas');
    }  
   
}
function search_add(div_resultado , vara)
{
    burl=$('#b_url').val();
    cant=$("#cant_reg :selected").val();
    opc2=$("#id_personal :selected").val();
    pagina=$("#pagina_registros").val();

    $.post(burl+"movimiento_almacen/add_articulo" ,{
        // 'buscar':opc2,
        'buscar':vara,
        'selecionados':$("#ids_seleccionados").val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val()
      
    }
    ,function(data){          
        $("#"+div_resultado).append(data);
    });
}

function search_tipo2(div_resultado)
{
    burl=$('#b_url').val();
    //search_and_list_ov_al
    buscar=$("#search_tipo_ingreso").val();
    cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    opc1=$("#os1 :selected").val();
    
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');    
   // alert("hiiiiiiiii"+opc1);   
    $.post(burl+"movimiento_almacen/find_selected",{
                    
        'buscar':$('#search_tipo_ingreso').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val(),
        'opc1':$("#os1 :selected").val()
                    
                   
    }
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
}

function search_ingreso1(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina").val(1);
        busqueda_mih();
    }  
   
}
function busqueda_mih()
{
    $("#resultado_busqueda").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Buscando...</div>');
    buscar=$("#in_search").val();
    if(buscar!=""){
        $.post(burl+"movimiento_almacen/busqueda_mih_detalle",{
                    
            'busqueda':buscar,
            'selecionados':$("#ids_seleccionados").val(),
            'cant':$("#mostrar_X :selected").val(),
            'pag':$("#pagina").val()
                    
        }
        ,function(data){
            $("#resultado_busqueda").html(data);
                    
        });
    }
    else
        $("#resultado_busqueda").html('');
}
function search_p(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_personal('lista_personal');
    }  
   
}
function search_personal(div_resultado)
{
    burl=$('#b_url').val();
    id_usuario=$("#id_personal :selected").val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl+"usuario/busqueda_usuario",{
        'id_usuario':id_usuario
    }
    ,function(data){          
        $("#"+div_resultado).html(data);
    });
}


function insertar_detalle_movimiento(id_mov,div_resultado)
{
    
    burl=$('#b_url').val();
    $.post(burl+"movimiento_almacen/obtener_detalle_movimiento",{
        'id_mov':id_mov,
        'selecionados':$("#ids_seleccionados").val()
    },function(data){          
        $("#"+div_resultado).append(data); 
    });
}
function insertar_dm(div_resultado)
{
    
    burl=$('#b_url').val();
    $.post(burl+"movimiento_almacen/salidas_u",{
         
        },function(data){          
            $("#"+div_resultado).html(data); 
          
        });
   
}

function list_personal(div_resultado)
{
    burl=$('#b_url').val();
    // buscar=$("#search_mov_alm1").val();
    cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl+"movimiento_almacen/find_list_personal",{
                    
        'buscar':$('#search_mov_alm1').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val()
    }
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
}

function add_fun(id_mov)
{
    burl=$('#b_url').val();
    
    $.post(burl+"movimiento_almacen/find_art",{          
        'id_mov':id_mov,
        'buscar':$('#search_mov_alm1').val()
    }
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
}

function search_mov_alm1(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_and_list_ov_al('lista_movimiento_almacen');
    }  
}
function search_tipo(div_resultado)
{
    burl=$('#b_url').val();
    opc=$("#os :selected").val();
    if(opc=='1')
    {
        $.post(burl+"movimiento_almacen/listar_usuario_mov",{
            
            },function(data){          
                $("#"+div_resultado).html(data);
            }
            );
    }
    else
    {
        resopc=0
        ayuda="search_tipo2('area_cargo_selecctivo')";
        $("#"+div_resultado).html('<div ><select id="os1" onchange="'+ayuda+'";><option value="1" >ruben</option><option value="2">jorge mendoza</option></select></div>');
    }
}
function lista_mov_usuario()
{
    //alert('user'+$("#id_personal :selected").val()+" proy"+$("#select_proyecto :selected").val());
    burl=$('#b_url').val();
    id_user=$("#id_personal :selected").val();
    id_proyecto=$("#select_proyecto :selected").val();
    cant=$("#mostrar_cant_mov_alm_usuario :selected").val();
    pagina=$("#pagina_reg_mov_alm_usuario").val();
    $.post(burl+"movimiento_almacen/salidas_usuario",{
        'id_usuario':id_user,
        'id_proyecto':id_proyecto,
        'cant':cant,
        'pagina':pagina
    },function(data){          
        $("#lista_movimiento").html(data); 
    }
    );
}
function lista_mov_usuario_proy()
{
    burl=$('#b_url').val();
    id_user=$("#id_personal :selected").val();
    //alert($("#select_proyecto :selected").val());
    id_proyecto=$("#select_proyecto :selected").val();
    cant=$("#mostrar_cant_mov_alm_usuario :selected").val();
    pagina=$("#pagina_reg_mov_alm_usuario").val();
    $.post(burl+"movimiento_almacen/salidas_usuario_sel",{
        'id_usuario':id_user,
        'id_proyecto':id_proyecto,
        'cant':cant,
        'pagina':pagina
    },function(data){          
        $("#lista_movimiento").html(data); 
    }
    );
}
function lista_mov_usuario2()
{
    burl=$('#b_url').val();
    id_user=$("#id_personal :selected").val();
    cant=$("#mostrar_cant_mov_alm_usuario :selected").val();
    pagina=$("#pagina_reg_mov_alm_usuario").val();
    $.post(burl+"movimiento_almacen/salidas_usuario",{
        'id_usuario':id_user,
        'cant':cant,
        'pagina':pagina
    },function(data){          
        $("#lista_movimiento").html(data); 
    }
    );
}
function cambiarpag(pagina)
{
    $("#pagina").val(pagina)
    lista_mov_usuario();
}
function cambiarpagina_mov(ele,pagina)
{
    $("#"+ele).val(pagina);
}

function search_alm(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_art").val(1);
        search_art();
    }  
   
}
function search_art()
{
    burl=$('#b_url').val();
    buscar=$("#a_search").val();
    id_mov=$("#id_sendma").val();
    $("#resultado_busqueda").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Buscando...</div>');
    if(buscar!=""&&"#lista_movimiento"!=""){
        $.post(burl+"movimiento_almacen/busqueda_lista_art",{
                    
            'busqueda':buscar,
            'selecionados':$("#ids_seleccionados").val(),
            'cant':$("#mostrar_X :selected").val(),
            'pag':$("#pagina_art").val(),
            'id_mov':id_mov
                    
        }
        ,function(data){
            $("#resultado_busqueda").html(data);
                    
        });
    }
    else{
       
        $("#resultado_busqueda").html('');
        
    }
}
function seleccionar_producto2(id_prod){
    if($("#check"+id_prod).is(':checked'))
    {
        ver_list_detalle_sel();
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
        alm=$("#id_almacen :selected").val();
        respuesta="Este articulo no necesita series";
      //  alert($("#"+id_prod+" #res").val());
        if($("#"+id_prod+" #res").val()==1)
            {
    
            respuesta=" <div id='serial_old"+id_prod+"-"+cont+"'  style='margin-top:15px'></div><script>seriales_registradas_in("+id_prod+","+cont+",'Ingreso',"+alm+"); seriales_obtenidos_max("+id_prod+","+cont+",'Ingreso',"+alm+");</script>";
            }
        //alert("res"+respuesta);
        
        $("#"+id_prod).addClass("seleccionado");
        $("#ids_seleccionados").val($("#ids_seleccionados").val()+','+id_prod+"-"+cont);
        
        c=parseInt($("#cant_item").val())+1;
        $("#cant_item").val(c);
        //alert("c:"+c+"citem"+$("#cant_item").val(c));
        
        codigo="<div class='grid_20 fondo_amarillo bordeado ' id='sel"+id_prod+"-"+cont+"' >\n\
                   <div class='grid_1'>\n\
                            <div style='float:rigth;' id='duplicar' class='duplicarItem milink' title='Duplicar Item' onclick='duplicar_iterm(\"sel"+id_prod+"-"+cont+"\",\"detalle_ov_pf\",\""+id_prod+"\",\""+cont+"\")'></div>\n\
                            <div style='float:rigth;' id='quitar' class='quitarItem milink' title='Quitar Item' onclick='quitaritem("+id_prod+","+cont+");'></div>\n\
                            <div id='ver' class='comentario milink' title='Adicionar comentario' onclick='mostrar_quitar_coment("+id_prod+","+cont+",1)'></div>\n\
                            <div id='oculta' class='nocomentario milink ocultar' title='Quitar comentario' onclick='mostrar_quitar_coment("+id_prod+","+cont+",0)'></div>\n\
                            <input type='hidden' id='id_sp' value='"+$("#"+id_prod+" #id_sp").val()+"'>\n\
                    </div>\n\
                    <div class='grid_6'>\n\
                        <div class='grid_6 negrilla f11'>"+"-"+$("#"+id_prod+" #cod_p").val()+" <input type='hidden' id='cod_ps' value='"+$("#"+id_prod+" #cod_p").val()+"'></div>\n\
                        <div class='grid_6 f10'>"+$("#"+id_prod+" #tit_p").val()+" <input type='hidden' id='tit_ps' value='"+$("#"+id_prod+" #tit_p").val()+"'></div>\n\
                        <div class='grid_6 f10'>"+$("#"+id_prod+" #desc_p").val()+" <input type='hidden' id='desc_ps' value='"+$("#"+id_prod+" #desc_p").val()+"'></div>\n\
                        <div class='grid_6 f10'><textarea placeholder='Escriba una Observacion aqui' id='coment' class='textarea_redond_300x50 ocultar'></textarea></div>\n\
                   </div>\n\
                   <div class='grid_5'>\n\
                        <div class='grid_2 espizq10'><input title='cantidad' id='cant' onkeyup='validarSiNumero(\"cant\")' type='text' class='grid_2 alin_cen margin_cero input_redond_20' placeholder='Cantidad'></input></div>\n\
                        <div class='grid_2 espizq10 espder10 negrilla' style='margin-top:15px'>"+$("#"+id_prod+" #um_p").val()+"</div>\n\
                    </div>\n\
                    <div class='grid_8'>"+respuesta+"\n\
                        <div id='otra_opcion"+id_prod+"-"+cont+"' class='ocultar'>\n\
                            <div class='grid_5'>\n\
                                <div class='grid_2 espizq10'><input title='codigo propio' id='cp' type='text' class='grid_2 alin_cen margin_cero input_redond_20' placeholder='Codigo Propio'></div>\n\
                                <div class='grid_2 espizq10 espder10'><input title='serial number' id='sn' type='text' class='grid_2 alin_cen margin_cero input_redond_20' placeholder='Serial Number'></div>\n\
                            </div>\n\
                            <div class='grid_1'>\n\
                                <div id='verlist' class='comentario milink' title='Ver Lista Seleccion' onclick='seriales_registradas_in(\""+id_prod+"\",\""+cont+"\",\"Ingreso\","+alm+");genera_otra_opcion(\"otra_opcion"+id_prod+"-"+cont+"\" , \""+id_prod+"\", 0,"+cont+"); mostrar_quitar_list_sel("+id_prod+","+cont+",1)'></div>\n\
                            </div>\n\
                            <div class='grid_6'>\n\
                                    <div class='espizq10 f10'id='serial_last"+id_prod+"-"+cont+"'></div>\n\
                            </div>\n\
                         </div>\n\
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
}
//traslado de erp_sg
function asigna_serial_codprop(origen,serial,codprod,div_padre)
{
    var cadena="";
    cadena = $("#"+origen+" :selected").val();
    vec=cadena.split("* SN: ");
    
    $("#sel"+div_padre+" #"+serial).val(vec[0]);
    $("#sel"+div_padre+" #"+codprod).val(vec[1]);
    
}


function genera_otra_opcion(div_resultado,id_pro,op,cant)
{ //alert('entra'+div_resultado+","+id_pro+","+op);
    // alert($("#seriales"+id_pro+"-"+cant+" :selected").val());
    opc=$("#seriales"+id_pro+"-"+cant+" :selected").val();
    //alert(opc);
    if(op==1){
        if(opc=='SN')
        {
            $("#"+div_resultado).removeClass("ocultar");
            $("#serial_old"+id_pro+"-"+cant).addClass("ocultar"); 
        }
        else
        {
            $("#"+div_resultado).addClass("ocultar");
        }
    }else
    {
        $("#"+div_resultado).addClass("ocultar");
        $("#serial_old"+id_pro+"-"+cant).removeClass("ocultar");
    }
}//hasta aqui
function seriales_obtenidos_max(id_prod,cant,tipo_requerido,id_almacen)
{
    informacion="";
    //alert(" prod"+id_prod),
    $.post(burl+"movimiento_almacen/seriales_obtenidos_tipo",{
        'id_sp':id_prod,
        'tipo_requerido':tipo_requerido,
        'almacen':id_almacen, 
        'cant':cant
    }
    ,function(data){
        $("#serial_last"+id_prod+"-"+cant).html(data);
    //  alert("vive"+informacion);                              
    });                 
}
// MOVIMIENTO DE INVENTARIO INGRESO
function search_and_list_ov_al(div_resultado)
{
    burl=$('#b_url').val();
    buscar=$("#search_mov").val();
    cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl+"movimiento_almacen/busqueda_lista_al_ov",{
                    
        'buscar':$('#search_mov').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val()
    }
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
}
function cambia_list(){
  
    $("#lista_movimiento_almacen_usuario").addClass("ocultar");
    $("#lista_movimiento_almacen_usuario_sel").removeClass("ocultar");   
}

function ver_list_detalle_sel(div_padre){
    
    $("#detalle_ov_pf").removeClass("ocultar");
    $("#"+div_padre+" #adicionar_art").addClass("ocultar");
    
}
function seriales_registradas_in(id_prod,cont,tipo_requerido,id_almacen)
{
    informacion="";
    //alert(" prod"+id_prod),seriales_registradas_tipo_in
    $.post(burl+"movimiento_almacen/seriales_registradas_tipo_in",{
        'id_sp':id_prod,
        'tipo_requerido':tipo_requerido,
        'almacen':id_almacen,
        'cont':cont
    }
    ,function(data){
        $("#serial_old"+id_prod+"-"+cont).html(data);
    //  alert("vive"+informacion);                              
    });              
}
//Solicitud material
function search_and_sm(div_resultado)
{
    burl=$('#b_url').val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl+"solicitud_material/obt_solicitud_mat_estado",{
        }
        ,function(data){          
            $("#"+div_resultado).html(data);                    
        });
}
function genera_sol_mat(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:"Clave Operacional",
        autoOpen: true,
        height: 210,
        width:300,
        modal: true,
        closeOnEscape: false,
        buttons:[ 
        {
            id: "button-recepcionar",
            text: "Recepcionar",
            click: function() {
               
                // var c_a= $('#id_almacen :selected').val();
                $.post(burl+"solicitud_material/cambiar_estado_sm",{
                   
                    'estado':'Solicitud Entregado111',
                    //'id_detalle_dev':$("#id_dev_mat").val()
                    'id_sm': $("#id_sm").val(),
                    'id_ma':$("#id_ma").val()
                } 
                              
                ,function(data){
                    $("#"+div_dialog +" #ayuda" ).html(data); 
                    
                    $("#"+div_dialog +" #ayuda" ).append($("#mensaje" ).val());
                    if($("#llave" ).val()==1){
                        setTimeout(function(){
                            $( "#"+div_dialog).dialog( "close" );
                         
                        }, 5000);
                    }                
                });      
            }
        },
        {
            id: "button-ok",
            text: "Salir",
            click: function() {                
                // $(this).dialog("close");
                //$("#mensaje").dialog
                $( "#"+div_dialog).dialog( "close" );
            //$( this ).dialog( "close" );
            // location.reload();                
            //$(this).dialog();
            
            }
        }        
        ]
    });
}

function dialog_nuevo_solicitud_mat(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:"Entregar Solicitud Material",
        autoOpen: true,
        height: 650,
        width: 1050,
        modal: true,
        closeOnEscape: false,
        buttons:[
        {
            id: "buttonenviar",
            text: "Entregar",
            disabled:"true",
            click: function() {
                
                var id_sm=$("#id_sm").val();
                var id_ma=$("#id_mov_alm").val();
               // genera_sol_mat("c_op",burl+"solicitud_material/codigo_ope_sol_mat/"+id_sm+"/"+id_ma); 
                $.post(burl+"solicitud_material/cambiar_estado_sm",{
                   
                    'estado':'Material Entregado',
                    'id_ma':$("#id_mov_alm").val()   
                }
                
                ,function(data){
                   // alert(direccion);
                   $("#"+div_dialog+" #respuesta").html(data);
                   setTimeout(function(){
                    nuevadireccion=this.quita_parametros(direccion,1);
                     // alert(nuevadireccion+$('#ayudata').val());
                      cargar_contenido_html(div_dialog,nuevadireccion+$("#id_mov_alm").val(),0);
                
               /*  $("#save_sm").button('disable');
                 $("#button-enviar").button('disable');
                 */}, 2000);
                });
            }
        },
        {
            id: "save_sm",
            text: "Guardar",
            click: function() {
                ids=$("#ids_seleccionados").val();
                // alert("entra ids"+ids);             
                vec=ids.split(",");
                data_ids="";
                data_idps="";
                data_sm="";
                data_cant="";
                data_comen="";
                cod_u="";
                tipo_m="";
                 
                for(i=1;i<vec.length;i++)
                { 
                    // alert("vec["+i+"]"+vec[i]);
                    data_ids+="|"+vec[i];
                    data_idps+="|"+$("#sel"+vec[i]+" #id_sp").val();
                    data_sm+="|"+$("#sel"+vec[i]+" #id_sm").val();
                    data_cant+="|"+$("#sel"+vec[i]+" #cant_e").val();
                    data_comen+="|"+$("#sel"+vec[i]+" #coment").val();
                 
                } 
                var c_a= $('#id_almacen :selected').val();
                // var c_e= $('#per_e :selected').val();
                //alert("no funciona"+$("#id_sm").val());                
                //alert("aquii"+data_ids+","+data_idps+","+data_sm+","+data_cant+","+data_comen);
                $.post(burl+"solicitud_material/guardar_solicitud_ma",{
                    
                    
                    'id_sol_material':$("#id_sm").val(),
                    'id_mov_almacen':$("#id_mov_alm").val(),
                    'ids':data_ids,
                    'r_idps':data_idps,
                    'r_sm':data_sm,
                    'r_cant':data_cant,
                    'r_coments':data_comen,
                    
                    'id_almacen':c_a,
                    'cod_er':$("#per_e").val(),
                    'cod_user':$("#c_u").val(),
                    'tipo_mov':"Salida",
                    'cod_sm':$("#cod_s_m").val(),
                    'nom_cod_sm':"solicitud material",
                    // 'tipo_mov':$("#t_m1").val(),
                    // 'fh':$("#tim").val(),
                    'proyt':$("#c_p").val(),
                    'coment_gral':$("#comentario_general").val()
                //'id_sol_mat':$("#id_sm").val()
                }                
                ,function(data){
                     $("#"+div_dialog +" #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    $("#"+div_dialog +" #respuesta").html(data);
                   // alert('ayudata >>>>>>'+ $("#ayudata").val());
                   // $("#button-enviar").button('enable');
                    
                    setTimeout(function(){
                      nuevadireccion=this.quita_parametros(direccion,1);
                     // alert(nuevadireccion+$('#ayudata').val());
                      cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val());
                    }, 1000);
                
                });
            }           
        },
        {
            id: "button-ok",
            text: "Salir",
            click: function() {
                // $(this).dialog("close");
                //$("#mensaje").dialog
                $( this ).dialog( "close" );
                //location.reload();                
            //$(this).dialog();
            }
        }
        ]
    });
}
function lista_almacen()
{
    burl=$('#b_url').val();
    id_alm=$("#id_almacen :selected").val();
    $.post(burl+"solicitud_material/salidas_almacen",{
        'id_almacen':id_alm
    },function(data){          
        $("#lista_movimiento").html(data); 
    }
    );
}
function list_alm(div_resultado)
{
    burl=$('#b_url').val();
    opc=$("#id_almacen :selected").val();
    if(opc=='otroo')
    {   
        
        $("#"+div_resultado).html('<div ><input class="input_redond_200" type="text" id="nueva_opcion_tipo" placeholder="escriba nuevo tipo" value=""></div>');
    }
}
function insertar_detalle_materiales(id_mov,div_resultado)
{
    burl=$('#b_url').val();
    $.post(burl+"solicitud_material/obtener_detalle_solicitud_material",{
        'id_mov':id_mov,
    
       
        'selecionados':$("#ids_seleccionados").val()
    },function(data){          
        $("#"+div_resultado).append(data); 
    });
}
function dialog_contenidos_nuevo_adicion_materiales(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);
    d=direccion.split("/");
    dc=d.length-1
    titulo="Detalle";
    if(d[dc]!=0)
        titulo="Momiento de Almacen";
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 480,
        width: 800,
        modal: true,
        closeOnEscape: false,
        buttons: {
            "Cerrar": function() {
             
                $( "#"+div_dialog).dialog( "close" );
            // location.reload();
            }
        }
    });
}
function insertar_detalle_sol_mat(id_mov,div_resultado)
{
    
    burl=$('#b_url').val();
    $.post(burl+"solicitud_material/ver_lista_sol_mat_detalle",{
        'id_mov':id_mov,
    
       
        'selecionados':$("#ids_seleccionados").val()
    },function(data){          
        $("#"+div_resultado).html(data); 
    });
}
function seleccionar_producto_solicitud(id_prod){
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
        $("#"+id_prod).addClass("seleccionado");
        $("#ids_seleccionados").val($("#ids_seleccionados").val()+','+id_prod+"-"+cont);
        c=parseInt($("#cant_item").val())+1;
        $("#cant_item").val(c);
        codigo="<div class='grid_20 fondo_amarillo bordeado ' id='sel"+id_prod+"-"+cont+"' >\n\
                <div class='grid_2 negrilla'>"+"-"+$("#"+id_prod+" #cod_p").val()+" <input type='hidden' id='cod_ps' value='"+$("#"+id_prod+" #cod_p").val()+"'></div>\n\
               <div class='grid_6'>\n\
                    <div class='grid_6'>"+$("#"+id_prod+" #tit_p").val()+" <input type='hidden' id='tit_ps' value='"+$("#"+id_prod+" #tit_p").val()+"'></div>\n\
                    <div class='grid_6'>"+$("#"+id_prod+" #desc_p").val()+" <input type='hidden' id='desc_ps' value='"+$("#"+id_prod+" #desc_p").val()+"'></div>\n\
                                    </div>\n\
                <div class='grid_7 espder10'>\n\
                <div class='grid_6 espder10'><textarea placeholder='Escriba una Observacion aqui' id='coment' class='textarea_redond_300x50'></textarea></div>\n\
                </div>\n\
                <div class = ''>"+" <input type='hidden' id='id_sp' value='"+$("#"+id_prod+" #id_sp").val()+"'></div>   \n\
                <div class='grid_1 espder10'><input title='cantidad' id='cant' type='text' class='grid_1 alin_cen margin_cero input_redond_20' placeholder='C' ></input></div>\n\
                <div class='grid_1 espder10'><input title='cantidad entregada' id='cant_e' type='text' class='grid_1 alin_cen margin_cero input_redond_20' placeholder='CE' ></input></div>\n\
                <div class='grid_1'>\n\
                    <div style='float:rigth;' id='duplicar' class='duplicarItem milink' title='Duplicar Item' onclick='duplicar_iterm(\"sel"+id_prod+"-"+cont+"\",\"lista_movimiento\",\""+id_prod+"\",\""+cont+"\")'></div>\n\
                    <div style='float:rigth;' id='quitar' class='quitarItem milink' title='Quitar Item' onclick='quitaritem("+id_prod+","+cont+");'></div>\n\
                </div>\n\
                </div>";
        $("#lista_movimiento").append(codigo);
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
    
 
}
function search_alm2_art(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_art_alm_u();
    }  
   
}
function search_art_alm_u()
{
    burl=$('#b_url').val();
    buscar=$("#a_search_sm").val();
    $("#resultado_busqueda").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Buscando...</div>');
    if(buscar!=""&&"#lista_movimiento"!=""){
        $.post(burl+"solicitud_material/busqueda_lista_art2",{
                    
            'busqueda':buscar,
            'selecionados':$("#ids_seleccionados").val(),
            'cant':$("#mostrar_X :selected").val(),
            'pag':$("#pagina_registros").val()
                    
        }
        ,function(data){
            $("#resultado_busqueda").html(data);
                    
        });
    }
    else{
       
        $("#resultado_busqueda").html('');
        
    }
}
function search_and_asignacones_personal(div_resultado)
{
    burl=$('#b_url').val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl+"asignaciones_personal/obt_mov_alm_per",{
        }
        ,function(data){          
            $("#"+div_resultado).html(data);                    
        });
}
//funciones para perfiles
function search_perfiles(div_resultado)
{
    burl=$('#b_url').val();
    // buscar=$("#search_mov").val();
    cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl+"perfiles/listar_perfiles",{
                    
        //'id_usuario':id_u,
        //'buscar':$('#search_mov').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val()
    }
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
}
/*kkk*/
function search_perfiles_detalles(div_resultado)
{
    burl=$('#b_url').val();
    // buscar=$("#search_mov").val();
    cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl+"perfiles/listar_perfiles",{
                    
        //'buscar':$('#search_mov').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val()
    }
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
}
function insertar_detalle_perfiles(id_p,campo)
{
    //alert("inserta_detalle_perfiles")
    
    burl=$('#b_url').val();
    // alert("ss"+id_p);
    $.post(burl+"perfiles/obtener_detalle_perfiles",{
        'id_pe':id_p
    //  'selecionados':$("#ids_seleccionados").val()
    },function(data){          
        $("#"+campo).val(data); 
        $("#np").removeClass("ocultar");
        
    });
}
function search_usuarios(id_u)
{
    
    burl=$('#b_url').val();
    // alert("ss"+id_p);
    $.post(burl+"perfiles/obtener_usuarios_perfiles",{
        'id_pe':id_p
    //  'selecionados':$("#ids_seleccionados").val()
    },function(data){          
        $("#"+div_resultado).html(data); 
    });
}
function dialog_nuevo_perfiles(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:"Nuevo Perfil",
        autoOpen: true,
        height: 210,
        width:300,
        modal: true,
        closeOnEscape: false,
        
        buttons:[ 
        {
            id: "button-crear_nuevo_perfil",
            text: "Crear Perfil",
            click: function() {
                ids=$("#ids_seleccionados").val();
                //alert("entra ids"+ids);             
                vec=ids.split(",");
                data_ids="";
                data_idps="";
                // data_idmp="";
                for(i=1;i<vec.length;i++)
                { 
                    //alert("vec["+i+"]"+vec[i]);
                    data_ids+="|"+vec[i];
                    data_idps+="|"+$(" #id_menu").val();
                //  data_idmp+="|"+$("#sel"+vec[i]+" #id_perfil").val();
                } 
                //alert("save"+$("#id_perfil"). val()+" "+$("#nom_p").val()+" "+$("#des_p").val());
                $.post(burl+"perfiles/perfiles_menu_save",{
                    'ids':data_ids,
                    'r_idps':data_idps,

                    'id_perf':$("#id_perfil").val(),
                    'n_perfil':$("#nom_p").val(),
                    'd_perfil':$("#des_p").val()
                    
          
                }                
                ,function(data){
                    setTimeout(function(){
                        $( "#"+div_dialog).dialog( "close" );
                         
                    }, 100);
                    location.reload();
                    $("#ids_seleccionados").val("");
                    
                                    
                }
                );      
            }
        },
        {
            id: "button-ok",
            text: "Salir",
            click: function() {                
                // $(this).dialog("close");
                //$("#mensaje").dialog
                
                $( "#"+div_dialog).dialog( "close" );
            //$( this ).dialog( "close" );
            // location.reload();                
            //$(this).dialog();
            
            }
        }        
        ]
    });
}
function search_detalle_menu(cod_user, padre)
{
    burl=$('#b_url').val();
    $.post(burl+"perfiles/listar_perfiles_detalle",{
        'id_user':cod_user, 
        'padre':padre    
    }
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
}
function seleccionar_menu(id_sp){
    //alert(id_sp+":"+$("#c"+id_sp).is(':checked'));
    if($("#c"+id_sp).is(':checked'))
    {
        ids=$("#ids_seleccionados").val();
        vec=ids.split(",");   
        $("#ids_seleccionados").val($("#ids_seleccionados").val()+','+$("#c"+id_sp).val());
        c=parseInt($("#cant_item").val())+1;
        $("#cant_item").val(c);            
    } 
    else
    {
        ids=$("#ids_seleccionados").val();
        $("#ids_seleccionados").val($("#ids_seleccionados").val().replace(','+$("#c"+id_sp).val(),''))    
        c=parseInt($("#cant_item").val())-1;
        $("#cant_item").val(c);   
    }
 
}
function mostrar_nuevo_perfil(){
  
    $("#np").removeClass("ocultar");
    $("#gp").removeClass("ocultar");
    $("#oculta").addClass("ocultar");   
}
function mostrar_perfil(){
  
    $("#gp").addClass("ocultar");
    $("#oculta").addClass("ocultar");
//  $("#np").addClass("ocultar");  
}
function seleccionar_perfiles(){
 
    //alert("seleccionar_perfiles");
    ids=$("#ids_seleccionados").val(); 
    
    vec=ids.split(",");
    //alert(ids);
    
    $(".nocheck").prop('checked',false); 
    $(".nocheckdiv").removeClass('fondo_amarillo');  
    //alert("ingresa al for, "+ vec.length);
    //alert("ingresa al for, "+ vec[0]);
    a=vec.length;
    for(i=0;i<a-1 ;i++)
    {
        //alert((vec[i])); 
        $("#c"+vec[i]).prop('checked',true);  
        $("#menu"+vec[i]).addClass('fondo_amarillo');  
       
    }  
}
function search_usuario(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_and_list_user('lista_usuarios');
    }  
   
}
function search_and_list_user(div_resultado)
{
    burl=$('#b_url').val();
    buscar=$("#search_u").val();
    //alert("entra");
    //$("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    if(buscar!=""&&"#lista_usuarios"!=""){
        // alert("entra2");
        $.post(burl+"perfiles/busqueda_lista_usuario",{
                    
            'buscar':buscar,
            'selecionados':$("#ids_seleccionados_user").val(),
            'cant':$("#mostrar_u :selected").val(),
            'pagina':$("#pagina_registros").val()
                    
        }
        ,function(data){
            $("#resultado_busqueda_user").html(data);
                    
        });
    }
    else{
       
        $("#resultado_busqueda_user").html('');
        
    }
}
function search_art2()
{
    if(buscar!=""&&"#lista_movimiento"!=""){
        $.post(burl+"solicitud_material/busqueda_lista_art2",{
                    
            'busqueda':buscar,
            'selecionados':$("#ids_seleccionados").val(),
            'cant':$("#mostrar_X :selected").val(),
            'pag':$("#pagina_art").val()
                    
        }
        ,function(data){
            $("#resultado_busqueda").html(data);
                    
        });
    }
    else{
       
        $("#resultado_busqueda").html('');
        
    }
}
function seleccionar_usuarios(id_u){
    if($("#percheck"+id_u).is(':checked'))
    {
        ids_u=$("#ids_seleccionados_user").val();
        vec=ids_u.split(",");
        cont=1;
      
        $("#"+id_u).addClass("seleccionado");
        $("#ids_seleccionados_user").val($("#ids_seleccionados_user").val()+','+id_u);
        c=parseInt($("#cant_item_user").val())+1;
        $("#cant_item_user").val(c);
        codigo="<div class='ancho100 fondo_amarillo bordeado ' id='sel"+id_u+"' >\n\
                    <div class='ancho100'>\n\
                    <div class='ancho20 negrilla alin_cen'>"+$("#div"+id_u+" #id_us").val()+" <input type='hidden' id='id_user' value='"+$("#"+id_u+" #id_us").val()+"'></div>\n\
                    <div class='ancho20'>"+$("#div"+id_u+" #nom").val()+" <input type='hidden' id='noms' value='"+$("#"+id_u+" #nom").val()+"'></div>\n\
                    <div class='ancho20'>"+$("#div"+id_u+" #pat").val()+" <input type='hidden' id='pats' value='"+$("#"+id_u+" #pat").val()+"'></div>\n\
                    <div class='ancho20'>"+$("#div"+id_u+" #mat").val()+" <input type='hidden' id='mats' value='"+$("#"+id_u+" #mat").val()+"'></div>\n\
                </div>\n\
                \n\
                <div class = ''>"+" <input type='hidden' id='id_us' value='"+$("#"+id_u+" #id_us").val()+"'></div>\n\
                </div>";
        $("#lista_movimiento_usuarios").append(codigo);
    }
    else
    {
        $( "#sel"+id_u ).remove();
        ids_u=$("#ids_seleccionados_user").val();
        vec=ids_u.split(",");
        
        cont++;
        $("#ids_seleccionados_user").val($("#ids_seleccionados_user").val().replace(','+id_u,''))
        c=parseInt($("#cant_item_user").val())-1;
        $("#cant_item_user").val(c);  
    }
}
function seleccionar_perfiles_user(id_p){
    //alert(id_sp+":"+$("#c"+id_sp).is(':checked'));
    if($("#selc_perfiles"+id_p).is(':checked'))
    {
        ids=$("#ids_seleccionados_perfiles").val();
        vec=ids.split(",");   
        $("#ids_seleccionados_perfiles").val(','+$("#selc_perfiles"+id_p).val());
        //$("#ids_seleccionados_perfiles").val(','+$("#selc_perfiles"+id_p).val());
        //c=parseInt($("#cant_item_perfiles").val())+1;
        //$("#cant_item_perfiles").val(c);
        $("#cant_item_perfiles").val(1);
    } 
    else
    {
    /* ids=$("#ids_seleccionados_perfiles").val();
        $("#ids_seleccionados_perfiles").val($("#ids_seleccionados_perfiles").val().replace(','+$("#selc_perfiles"+id_p).val(),''))    
        c=parseInt($("#cant_item_perfiles").val())-1;
        $("#cant_item_perfiles").val(c);   */
    }
 
}
function mostrar_asignacion_perfil_usuarios(id_u){
    if($("#percheck"+id_u).is(':checked'))
    {
        $("#ver_permiso").removeClass("ocultar"); 
    // alert("true");
    }
    else
    {
        if($("#cant_item_user").val()>1)
        {
            $("#ver_permiso").removeClass("ocultar");
        //   alert("true1");
        }
        else
        {
            $("#ver_permiso").addClass("ocultar");
        // alert("false");
        }
    } 
}
function insertar_permisos(div_resultado)
{
    idsp=$("#ids_seleccionados_perfiles").val();
    idsu=$("#ids_seleccionados_user").val();
    idsm=$("#ids_seleccionados").val();
    //alert("entra idsp"+idsp+"entra idsu"+idsu+"entra idsm"+idsm);            
    vec=idsp.split(",");
    data_idsp="";
    
    vec1=idsu.split(",");
    data_idsu="";
    
    vec2=idsm.split(",");
    data_idsm="";
    
    for(i=1;i<vec.length;i++)
    { 
        // alert("vec["+i+"]"+vec[i]);
        data_idsp+="|"+vec[i];
    }
    for(f=1;f<vec1.length;f++)
    { 
        // alert("vec1["+f+"]"+vec1[f]);
        data_idsu+="|"+vec1[f];
    }
    for(j=0;j<vec2.length-1;j++)
    { 
        // alert("vec2["+j+"]"+vec2[j]);
        data_idsm+="|"+vec2[j];
    }
    $.post(burl+"perfiles/perfiles_asignar_permiso_save",{
        'idsp':data_idsp,
        'idsu':data_idsu,
        'idsm':data_idsm
    }                
    ,function(){
        $("#ids_seleccionados_user").val("");
        location.reload();
                                    
    }
    );    
}
function insertar_detalle_perfiles_menu(id_p,campo)
{
    //alert("inserta_detalle_perfiles")
    
    burl=$('#b_url').val();
    // alert("ss"+id_p);
    $.post(burl+"perfiles/obtener_detalle_perfiles",{
        'id_pe':id_p
    //  'selecionados':$("#ids_seleccionados").val()
    },function(data){          
        $("#"+campo).val(data); 
       
        
    });
}
//** MOVIMIENTO DE ALMACEN NUEVO INGRESO PARAMETRO ID;ID_DEV_MAT

function dialog_nuevo_mov_alm_ingreso(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:"Ingreso de Material/Insumos/Herramientas",
        autoOpen: true,
        height: 650,
        width: 1025,
        modal: true,
        closeOnEscape: false,
        buttons:[
        {
            id: "rep",
            text: "Recepcionar",
            enable:"true",
            click: function() {
                ids=$("#ids_seleccionados_en").val();
                // alert("entra ids"+ids);             
                vec=ids.split(",");
                data_ids="";
                data_idps="";
                data_ma="";
                data_cant="";
                data_comen="";
                cod_u="";
                tipo_m="";
                tipo_cup="";
                tipo_sn="";
                 
                for(i=1;i<vec.length;i++)
                { 
                    //alert("vec["+i+"]"+vec[i]);
                    data_ids+="|"+vec[i];
                    data_idps+="|"+$("#sel"+vec[i]+" #id_sp").val();
                    data_ma+="|"+$("#sel"+vec[i]+" #id_ma").val();
                    data_cant+="|"+$("#sel"+vec[i]+" #cant_dev").val();
                    data_comen+="|"+$("#sel"+vec[i]+" #coment").val();
                    tipo_cup+="|"+$("#sel"+vec[i]+" #cp").val();
                    tipo_sn+="|"+$("#sel"+vec[i]+" #sn").val();
                 
                }
                var c_user= $('#c_u').val();
                var tipo_proy= $('#c_p').val();
                var tipo_almacen= $('#select_almacen :selected').val();
                //alert("no funciona"+$('#select_proyecto :selected').val());                
                //alert("aquii"+data_ids+","+data_idps+","+data_ma+","+data_cant+","+data_comen);
                $.post(burl+"movimiento_almacen/pro_serv_save",{
                    
                    'ids':data_ids,
                    'r_idps':data_idps,
                    'r_ma':data_ma,
                    'r_cant':data_cant,
                    'r_coments':data_comen,
                    'r_cup':tipo_cup,
                    'r_sn':tipo_sn,
                   
                    'cod_user':c_user,
                    'tipo_mov':"Ingreso",
                    'proyt':tipo_proy,
                    'cod_alm':tipo_almacen,
                    'estado':"Enviado",
                    'tipo_doc_o':"movimiento inventario",
                    'coment_gral':$("#comentario_general").val()
                }                
                ,function(data){
                    $("#"+div_dialog +" #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    
                    setTimeout(function(){
                        cargar_contenido_html(div_dialog,direccion,0);
                    }, 1000);
                
                });
            }
        },    
        /*{
            id: "save1",
            text: "Guardar",
            enable:"true",
            click: function() {
                ids=$("#ids_seleccionados_en").val();
                // alert("entra ids"+ids);             
                vec=ids.split(",");
                data_ids="";
                data_idps="";
                data_ma="";
                data_cant="";
                data_comen="";
                cod_u="";
                tipo_m="";
                tipo_cup="";
                tipo_sn="";
                 
                for(i=1;i<vec.length;i++)
                { 
                    //alert("vec["+i+"]"+vec[i]);
                    data_ids+="|"+vec[i];
                    data_idps+="|"+$("#sel"+vec[i]+" #id_sp").val();
                    data_ma+="|"+$("#sel"+vec[i]+" #id_ma").val();
                    data_cant+="|"+$("#sel"+vec[i]+" #cant_dev").val();
                    data_comen+="|"+$("#sel"+vec[i]+" #coment").val();
                    tipo_cup+="|"+$("#sel"+vec[i]+" #cp").val();
                    tipo_sn+="|"+$("#sel"+vec[i]+" #sn").val();
                 
                }
                var c_user= $('#c_u').val();
                var tipo_proy= $('#c_p').val();
                var tipo_almacen= $('#select_almacen :selected').val();
                //alert("no funciona"+$('#select_proyecto :selected').val());                
                //alert("aquii"+data_ids+","+data_idps+","+data_ma+","+data_cant+","+data_comen);
                $.post(burl+"movimiento_almacen/pro_serv_save",{
                    
                    'ids':data_ids,
                    'r_idps':data_idps,
                    'r_ma':data_ma,
                    'r_cant':data_cant,
                    'r_coments':data_comen,
                    'r_cup':tipo_cup,
                    'r_sn':tipo_sn,
                   
                    'cod_user':c_user,
                    'tipo_mov':"Ingreso",
                    'proyt':tipo_proy,
                    'cod_alm':tipo_almacen,
                    'estado':"Guardado",
                    'tipo_doc_o':"movimiento inventario",
                    'coment_gral':$("#comentario_general").val()
                }                
                ,function(data){
                    $("#"+div_dialog +" #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    
                    setTimeout(function(){
                        cargar_contenido_html(div_dialog,direccion,0);
                    }, 1000);
                
                });
            }
        }*/
        {
            id: "button-ok",
            text: "cerrar",
            click: function() {
                // $(this).dialog("close");
                //$("#mensaje").dialog
                $( this ).dialog( "close" );
                location.reload();                
            //$(this).dialog();
            }
        }
        ]
    });
}


