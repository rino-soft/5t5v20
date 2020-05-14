//funciones de ayuda
function quita_parametros(cadena,cant_parametros)
{
    contador=0;
    for(i=cadena.length-1;i>=0;i--)
    {
        if(cadena.charAt(i)=="/" )
        {
            contador++;
            if(contador>=cant_parametros)
            {
                var pos=i;
                break;
            }   
        }
        
    }
    nueva_cadena=cadena.substring(0,pos+1);
    return(nueva_cadena);
}

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
function cambiar_dialog_mensaje_ok()
{
   
}

//fin funciones CONFIGURACION SISTEMA*********************************************************************************************************
//funciones de cliente
function cambios_form()
{
    $("input").change(function(){
        $('#cambios').val("si");
    });   
}

/*function dialog_contenidos_nuevo_cliente(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    // saber si es nuevo o es edicion
    
    d=direccion.split("/");
    dc=d.length-1
    titulo="Nuevo Cliente";
    if(d[dc]!=0)
        titulo="Modificacion de datos de Cliente";
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
                
                $.post(burl+"cliente/guardar_cliente",{
                    'id_cli':$('#id_cli').val(),
                    'rs':$('#rs').val(),
                    'nit':$('#nit').val(),
                    'tel':$('#tel').val(),
                    'dir':$('#dir').val(),
                    'rub':$('#rub').val()
                },function(data){
                    $("#"+div_dialog+" #respuesta").html(data);
                    
                });
                setTimeout(function(){                  
                    if($('#proceso').val()!="UPDATE")
                    {
                        $( this ).dialog( "close" );
                        setTimeout(function(){                  
                            this.dialog_contenidos_nuevo_contacto(div_dialog,burl+'cliente/contacto_nuevo/'+$('#ayudata').val()+"/0");
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
}*/
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
function search_ov_pf(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_and_list_ov_pf('lista_oventa_prefacturas');
    }  
   
}
function search_and_list_ov_pf(div_resultado)
{
        burl=$('#b_url').val();
        buscar=$("#search_ov_pf").val();
        cant=$("#cant_reg :selected").val();
        pagina=$("#pagina_registros").val();
        $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
         $.post(burl+"oventa_prefactura/busqueda_lista_pf_ov",{
                    
                    'buscar':$('#search_ov_pf').val(),
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
            disable:"true",
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

function seleccionar_producto(id_prod){
   // alert('funcion anterior');
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
                        <div style='float:rigth;' id='duplicar' class='duplicarItem milink' title='Duplicar Item' onclick='seleccionar_producto("+id_prod+");calcular_importe();'></div>\n\
                        <div style='float:rigth;' id='quitar' class='quitarItem milink' title='Quitar Item' onclick='quitaritem("+id_prod+","+cont+");calcular_importe();'></div>\n\
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
function quitaritem(id_prod,indice)
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
        $("#sel"+id_p+"-"+indice+" #oculta").removeClass("ocultar");
        $("#sel"+id_p+"-"+indice+" #ver").addClass("ocultar");
    }
    else
    {
        $("#sel"+id_p+"-"+indice+" #coment").addClass("ocultar");
        $("#sel"+id_p+"-"+indice+" #coment").val("");
        $("#sel"+id_p+"-"+indice+" #oculta").addClass("ocultar");
        $("#sel"+id_p+"-"+indice+" #ver").removeClass("ocultar");
    }
        
    
    
}
function calcular_importe()
{
    ids=$("#ids_seleccionados").val();
    vec=ids.split(",");
    total=0;
    
    for(i=1;i<vec.length;i++)
    { 
        //alert("veci2 "+vec[i])
        $("#sel"+vec[i]+" #cantidad").val($("#sel"+vec[i]+" #cantidad").val().replace(',','.'));
        $("#sel"+vec[i]+" #pu").val($("#sel"+vec[i]+" #pu").val().replace(',','.'));
        //$(campo).val($(campo).val().replace(',','.'));
        if($("#sel"+vec[i]+" #cantidad").val()!="" && $("#sel"+vec[i]+" #pu").val()!="")//verifica que el producto no tenfa vacios NaN
        {
            cant=parseFloat($("#sel"+vec[i]+" #cantidad").val()).toFixed(2);
            precio=parseFloat($("#sel"+vec[i]+" #pu").val()).toFixed(2);
            //alert(cant+"<---cant , precio u --->"+precio);
            subtotal=cant*precio;
            //alert("subtotal "+i+".-"+subtotal);
            $("#sel"+vec[i]+" #subtotal").val(subtotal.toFixed(2));
            total+=subtotal;
        }
        else
            $("#sel"+vec[i]+" #subtotal").val("0.00"); 
    }
    // alert("total"+total);
    $("#total_calculo").val(total.toFixed(2));
    
    if(parseInt($("#cant_item").val())>0 && parseInt($("#total_calculo").val())>0)
        $("#save").button('enable');
    else
        $("#save").button('disable');
}


//funciones para prefactura u orden de venta*********************************************************************************************************
//
