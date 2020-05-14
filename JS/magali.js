

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



//funciones de CONFIGURACIONES SISTEMA
function alerta(inform)
{
    alert (inform);
}

function cargar_contenido_html(div_destino,direccion,modulo)
{
    $("#"+div_destino).html($("#cargando_grande").html());
    $.post(direccion,{
        'modulo':modulo
    },function(data){
        $("#"+div_destino).html(data)   
    });
}
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

function cambios_form()
{
    $("input").change(function(){
        $('#cambios').val("si");
    });   
}

//fin funciones de busqueda de producto servicio en la tabla. para grupo*********************************************************************************************************

function search_para_grupo(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina").val(1);
        search_and_list_grupo_serv();
    }  
   
}
function cambiarpaginacion(pagina)
{
    $("#pagina").val(pagina)
    search_and_list_grupo_serv();
}
function search_and_list_grupo_serv()
{
    //alert ("hola maga esto no funciona");
         
    $("#resultado_busqueda").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Buscando...</div>');
    buscar=$("#in_search").val();
    if(buscar!=""){
        $.post(burl+"producto_servicio/busqueda_lista_detalle_serv",{
                    
            'busqueda':buscar,
            'selecionados':$("#ids_seleccionados").val(),
            'cant':$("#mostrar_J :selected").val(),
            'pag':$("#pagina").val()
                    
        }
        ,function(data){
            $("#resultado_busqueda").html(data);
                    
        });
    }
    else
        $("#resultado_busqueda").html('');
                
}



function dialog_nueva_prod_serv(div_dialog,direccion,titulo)
{
    //alert('funciona');
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve alert('funciona');
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 632,
        width: 450,
        modal: true,
        closeOnEscape: false,
       
        buttons:
        {
        
            
            "Reset":function(){
                cargar_contenido_html(div_dialog,direccion,0);//alert('funciona');
            },
            "Guardar": function() {
                // alert ("entra"+$('#uni_med :selected').val());
                var tipo= $('#tipo :selected').val();
                if(tipo=="otroo")
                    tipo= $('#nueva_opcion_tipo').val();
               
               
                var nombre_unidad = $('#uni_med :selected').val();
                if(nombre_unidad=="otro")
                    nombre_unidad= $('#nueva_opcion').val();
               
               
                $.post(burl+"producto_servicio/guardar_serv_pro",{
                  
                    'id_serv':$('#id_serv').val(),
                    'cod':$('#cod').val(),
                    'tipo':tipo,
                    'cate':$('#cate :selected').val(),
                    'subcate':$('#id_subcategoria :selected').val(),
                    'nom':$('#nom').val(),
                    'desc':$('#desc').val(),
                    'palbus':$('#palbus').val(),
                    'uni_med':nombre_unidad,
                    'preref':$('#preref').val(),
                    'resp':$('input:radio[name=resp]:checked').val()
                    
                }
                
                ,function(data){
                    // alert ("entra ");
                    $("#"+div_dialog +" #respuesta").html(data);
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado categoria , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        nuevadireccion=this.quita_parametros(direccion,1);
                        //alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                        cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val(),0);
                        search_and_list_serv_prod('lista_serv_prod');
                    }, 1000);//alert('funciona'); 
                    
                });
            },
            "Cerrar": function() {
               
                $( this ).dialog( "close" );
                //location.reload();
                //search_and_list_serv_prod('lista_serv_prod');
            }
        }
       
       
    
    });
}
function dialog_cat_serv_prod(div_dialog,direccion,titulo)
{
 
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 450,
        width: 390,
        modal: true,
        closeOnEscape: false,
        
        buttons:
        {
        
            
            "Reset":function(){
                cargar_contenido_html(div_dialog,direccion,0); 
            },
            "Guardar": function() {
               
                $.post(burl+"categoria/guardar_categoria",{
                    
                    'id_cate':$('#id_cate').val(),
                    'nom':$('#nom').val(),
                    'desc':$('#desc').val(),
                    'cod_pro':$('#cod_pro').val()
                    
                    
                }
                
                ,function(data){
                    // alert ("entra ");
                    $("#"+div_dialog +" #respuesta").html(data);
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado categoria , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        nuevadireccion=this.quita_parametros(direccion,1);
                       // alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                        cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val(),0);
                    }, 1000);//alert('funciona'); 
                    
                });
            },
            "Cerrar": function() {
               
                $( this ).dialog( "close" );
                location.reload();//alert('funciona'); 
            }
        }
       
       
    
    });
}


function dialog_nuevo_equipo_repuesto(div_dialog,direccion)

{

    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:"Nuevo Grupo Equipo Repuesto Herramienta",
        autoOpen: true,
        height: 650,
        width: 1050,
        modal: true,
        closeOnEscape: false,
        
        buttons:[
        {
            id: "reset",
            text: "Reset",
            enable:"true",
            click: function() {
                
                cargar_contenido_html(div_dialog,direccion,0); 
            
            }
         
        },{
            id: "save",
            text: "Guardar",
            enable:"true",
            click: function() {
                ids=$("#ids_seleccionados").val();
                vec=ids.split(",");
                data_ids="";
                // data_cod="";
                // data_tit="";
                // data_des="";
                data_comen="";
                data_unimed="";
                data_cant="";
                data_pn="";
                data_sn="";
                for(i=1;i<vec.length;i++)
                { 
                    //alert('funciona');
                    data_ids+="|"+vec[i];
                    //data_cod+="|"+$("#sel"+vec[i]+" #cod_ps").val();
                    //data_tit+="|"+$("#sel"+vec[i]+" #tit_ps").val();
                    //data_des+="|"+$("#sel"+vec[i]+" #desc_ps").val();
                    data_comen+="|"+$("#sel"+vec[i]+" #coment").val();
                    data_unimed+="|"+$("#sel"+vec[i]+" #unidad_medida").val();
                    data_cant+="|"+$("#sel"+vec[i]+" #cantidad").val();
                    data_pn+="|"+$("#sel"+vec[i]+" #p_n").val();
                    data_sn+="|"+$("#sel"+vec[i]+" #s_n").val();
                    
                }
                $.post(burl+"grupo_herramienta/nuevo_grupo_save",{
                    
                    'ids':data_ids,
                    //'cods':data_cod,
                    //'tits':data_tit,
                    // 'descs':data_des,
                    'coments':data_comen,
                    'umeds':data_unimed,
                    'cants':data_cant,
                    'pns':data_pn,
                    'sns':data_sn,
                    'cod_pro':$("#nom").val(),
                    'nomb':$("#cod").val(),
                    'descrip':$("#descr").val()
                }
                ,function(data){
                    $("#"+div_dialog +" #respuesta").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        cargar_contenido_html(div_dialog,direccion,0);
                    }, 1000);
                    
                })//;alert('funciona');
            }
             
           
            
        },{
            id: "cerrar",
            text: "Cerrar",
            enable:"true",
            click: function() {
                $( this ).dialog( "close" );
                location.reload();//alert('funciona');
         
            }
        }
      
       
        ]
    
    });
}


function cambios()
{
    $("input").change(function(){
        $('#cambios').val("si");
    });   
}
function dialog_detalle_servicio_producto(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    // saber si es nuevo o es edicion
    
    d=direccion.split("/");
    dc=d.length-1
    titulo="Detalle Servicio Producto";
    if(d[dc]!=0)
        titulo="Detalle Servicio / Producto";
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 550,
        width: 457,
        modal: true,
        closeOnEscape: false,
        
     
        buttons: {
            
            
          
            "Cerrar": function() {
               
                $(this).dialog( "close" );
                
            }
        }
    });
}


function otra_opcion_medida(div_resultado)
{
    burl=$('#b_url').val();
    opc=$("#uni_med :selected").val();
    if(opc=='otro')
    {   
        
        $("#"+div_resultado).html('<div class="grid_5 espabajo5" ><input class="input_redond_250 NO" type="text" id="nueva_opcion" placeholder="Escriba la nueva unidad de medida" value=""><span class=" negrilla colorGuindo">Nueva Unidad de Medida</span></div>');
    }

}
function otra_opcion_tipo(div_resultado)
{
    
    burl=$('#b_url').val();
    opc=$("#tipo :selected").val();
    if(opc=='otroo')
    {   
        
        $("#"+div_resultado).html('<div class="grid_8" ><input class="input_redond_370 NO" type="text" id="nueva_opcion_tipo" placeholder="Escriba otro tipo de articulo o servicio" value=""><br><span class="negrilla colorGuindo">Nuevo Tipo Articulo o Servicio</span></div>');
    }
    else
        $("#"+div_resultado).html('');

}

function search_sp(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_and_list_serv_prod('lista_serv_prod');
    }  
   
}

function search_kardex(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_and_list_prod_kardex('lista_serv_prod');
    }  
   
}
function search_vn(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_and_list_vehiculo('lista_vehiculo');
    }  
   
}
function search_and_list_vehiculo(div_resultado)
{
    //alert ("hola maga esto no funciona");
    burl=$('#b_url').val();
    buscar=$("#search_vn").val();
    cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    selec_depar=0;
    por_proyecto=0;
    //alert(selec_depar);
    if($("#ciudad_asig").length)
        selec_depar=$("#ciudad_asig :selected").val();
   // alert(selec_depar);
     if($("#proyecto_date").length)
        por_proyecto=$("#proyecto_date :selected").val();
    
    asignado=$("#asignado_a").val();
   // por_proyecto=$("#por_proyecto").val();
    
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    //   alert (selec_depar);
    $.post(burl+"vehiculo/busqueda_lista_vehiculo",{
                    
        'buscar':$('#search_ov_pf').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val(),
        'selec_depar':selec_depar,
        'asignado_a':asignado,
        'proyecto':por_proyecto
    }
                
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
                
}
function search_and_list_prod_kardex(div_resultado)
{
    //alert ("hola maga esto no funciona"+$('#b_url').val());
    burl=$('#b_url').val();
    buscar=$("#search_prod_kardex").val();
    almacen=$("#id_almacen :selected").val();
    cate=$("#cate :selected").val();
    cant=$("#mostrarX :selected").val();
    pagina=$("#pagina_registros").val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
       
    $.post(burl+"kardex_almacen/busqueda_producto_kardex_almacen",{
                    
        'buscar':buscar,
        'almacen':almacen,
        'categoria':cate,    
        'cant':cant,
        'pagina':pagina
    }
                
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
                
}

function search_and_list_serv_prod(div_resultado)
{
    //alert ("hola maga esto no funciona");
    burl=$('#b_url').val();
    alert(burl);
    buscar=$("#search_sp").val();
    cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
       
    $.post(burl+"producto_servicio/busqueda_lista_serv_prod",{
                    
        'buscar':$('#search_ov_pf').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val()
    }
                
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
                
}

function search_ca(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_categoria_list_serv_prod('lista_cate');
    }  
   
}
function search_categoria_list_serv_prod(div_resultado)
{
       
    burl=$('#b_url').val();
    buscar=$("#search_ca").val();
    cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
        
    $.post(burl+"categoria/busqueda_categoria_lista_detalle_serv",{
                    
        'buscar':$('#search_cate').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val()
    }
                
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    }); //alert ("hola maga esto no funciona");
                
}

function search_he(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_herramienta_list_serv_prod('lista_herra');
    }  
   
}
function search_herramienta_list_serv_prod(div_resultado)
{
       
    burl=$('#b_url').val();
    buscar=$("#search_he").val();
    cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
        
    $.post(burl+"grupo_herramienta/busqueda_grupo_de_herramienta",{
                    
        'buscar':$('#search_herra').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val()
    }
                
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    }); //alert ("hola maga esto no funciona");
                
}
function dialog_detalle_grupo(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    // saber si es nuevo o es edicion
    
    d=direccion.split("/");
    dc=d.length-1
    titulo="Detalle Grupo";
    if(d[dc]!=0)
        titulo="Detalle Grupo";
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 600,
        width: 1000,
        modal: true,
        closeOnEscape: false,
        
     
        buttons: {
            
            
          
            "Cerrar": function() {
               
                $(this).dialog( "close" );
                
            }
        }
    });
}
function codigo_generado(destino,origen)
{
    burl=$('#b_url').val();
    $.post(burl+"categoria/obtener_codigo_generado",{
        'id_cat':$('#'+origen+' :selected').val()
      
    }
    ,function(data){
        $("#"+destino).val(data);
                   
                    
    });
    
}
function seleccionar_producto_herramienta(id_prod){
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
        codigo="<div class='grid_20 fondo_verde bordeado ' id='sel"+id_prod+"-"+cont+"' >\n\
                <div class='grid_2 negrilla'>"+" "+$("#"+id_prod+" #cod_p").val()+" <input type='hidden' id='cod_ps' value='"+$("#"+id_prod+" #cod_p").val()+"'></div>\n\
                \n\
                <div class='grid_8'>\n\
                    <div class='grid_8'>"+$("#"+id_prod+" #tit_p").val()+" <input type='hidden' id='tit_ps' value='"+$("#"+id_prod+" #tit_p").val()+"'></div>\n\
                    <div class='grid_8'>"+$("#"+id_prod+" #desc_p").val()+" <input type='hidden' id='desc_ps' value='"+$("#"+id_prod+" #desc_p").val()+"'></div>\n\
                    <div class='grid_8'><textarea placeholder='Escriba su comentario aqui' id='coment' class='textarea_redond_450x50 ocultar'></textarea></div>\n\
                </div>\n\
                 <div class='grid_1'>\n\
                    <div id='oculta' class='nocomentario1 milink ocultar' title='Quitar comentario' onclick='mostrar_quitar_coment("+id_prod+","+cont+",0)'></div>\n\
                    <div id='ver' class='comentario1 milink' title='Adicionar comentario' onclick='mostrar_quitar_coment("+id_prod+","+cont+",1)'></div>\n\
                </div>\n\
               <div class='grid_2'><input title='Unidad Medida' id='unidad_medida' type='text' class='input_redond_100 alin_cen margin_cero' placeholder='Unidad Medida' value='"+$("#"+id_prod+" #um_p").val()+"'></div>\n\
               <div class='grid_2'><input title='cantidad' id='cantidad' type='text' class='input_redond_100 alin_cen margin_cero' placeholder='Cantidad' ></div>\n\
                <div class='grid_2'><input title='P_N' id='p_n' type='text' class='input_redond_100 alin_cen margin_cero' placeholder='P_N' ></div>\n\
                <div class='grid_2'><input title='S_N' id='s_n' type='text' class='input_redond_100 alin_cen margin_cero' placeholder='S_N' ></div>\n\
                <div class='grid_1'>\n\
                        <div style='float:rigth;' id='duplicar' class='duplicar_Item milink' title='Duplicar Item' onclick='seleccionar_producto_herramienta("+id_prod+");'></div>\n\
                        <div style='float:rigth;' id='quitar' class='quitar_Item milink' title='Quitar Item' onclick='quitar_item("+id_prod+","+cont+");'></div>\n\
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
    * Si desea eliminar todos lo items clic en ACEPTAR \n\
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
  
    
//NO ES NECESARIO


}
function quitar_item(id_prod,indice)
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
    if(parseInt($("#cant_item").val())>0 && parseInt($("#total_calculo").val())>0)//NO ES NECESARIO
        $("#save").button('enable');                                            //NO ES NECESARIO
    else//NO ES NECESARIO
        $("#save").button('disable');                                               //NO ES NECESARIO
}

function calcular_cantidades()
{
    var cad=$("#ids_selec").val();
    ids = cad.split(",");
    //alert(ids);
    for(i=1;i < ids.length;i++){
        //alert()
        if($("#"+ids[i]+" #can_uti").val()!="")//verifica que el producto no tenfa vacios NaN
        {
            cantidad_asignada=parseFloat($("#"+ids[i]+" #can_asig").val()).toFixed(0);
            cantidad_utilizada=parseFloat($("#"+ids[i]+" #can_uti").val()).toFixed(0);
            //alert(cant+"<---cant , precio u --->"+precio);
            cantidad_total=cantidad_asignada-cantidad_utilizada;
            //alert("subtotal "+i+".-"+subtotal);
            $("#"+ids[i]+" #cantidad_total").val(cantidad_total.toFixed(0));
        //alert(cantidad_total);
             
            
        //total+=cantidad_total;
        }
        else
            $("#"+ids[i]+" #cantidad_total").val("0"); 
    }
        
        
        
//alert(cantidad_total);
        
}

function genera_devolucion(div_dialog,direccion)

{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    // saber si es nuevo o es edicion
    
    d=direccion.split("/");
    dc=d.length-1
    titulo="Listado de solicitud";
    if(d[dc]!=0)
        titulo="Listado de solicitud";
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 557,
        width: 700,
        modal: true,
        closeOnEscape: false,
        
     
        buttons: {
            
            
          
            "Cerrar": function() {
               
                $(this).dialog( "close" );
                
            }
        }
    });
}

function validarSiNumero(campo){
    numero=$("#"+campo).val();
    //alert("num"+numero);
    nnew="";     
    for( i=0;i<numero.length;i++)
    {
        if(/^([0-9])*$/.test(numero.charAt(i)))
        {
            nnew+=numero.charAt(i);    
        }
    }
    $("#"+campo).val(nnew); 
    if($("#"+campo).val()=="")
        $("#"+campo).val(0);
}


function dialog_nuevo_grupo_editado(div_dialog,direccion,titulo)
{
    burl=$('#b_url').val();
  
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 600,
        width: 500,
        modal: true,
        closeOnEscape: false,
        
     
       buttons: {
            
              
         "Reset":function(){
                cargar_contenido_html(div_dialog,direccion,0); 
            },
            "Duplicar":function(){
                $('#id_grup').val(0);
                $('#cod').val("");
                $('#sn').val("");                
            },
            "Guardar": function() {
               
                $.post(burl+"grupo_de_herramienta_nuevo/guardar_grupo_editado",{
                    
                    'id_grup':$('#id_grup').val(),
                    'codigo_grupo':$('#cod').val(),
                    'Nombre_grupo':$('#nom').val(),
                    'Descripcion':$('#descr').val(),
                    'cant_total_pieza':$('#total').val(),
                    'SN':$('#sn').val()
                    
                    
                }
                
                ,function(data){
                  //  alert ("entra ");
                    $("#"+div_dialog +" #respuesta").html(data);
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado categoria , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        nuevadireccion=this.quita_parametros(direccion,1);
                      //alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion+$('#ayudata').val());
                        cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val(),0);
                    }, 1000);//alert('funciona'); 
                    
                });
            },
            "Cerrar": function() {
               
                $( this ).dialog( "close" );
                location.reload();//alert('funciona'); 
            }
        }
    });
}
function search_gru(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_grupo_listado('lista_grupo');
                        }  
   
}
function search_grupo_listado(div_resultado)
{
       
        burl=$('#b_url').val();
        buscar=$("#search_gru").val();
        cant=$("#cant_reg :selected").val();
        pagina=$("#pagina_registros").val();
        $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
        
        $.post(burl+"grupo_de_herramienta_nuevo/busqueda_grupo_de_herramienta",{
                    
                    'buscar':$('#search_grupo').val(),
                    'cant':$('#mostrarX :selected').val(),
                    'pagina':$('#pagina_registros').val()
                }
                
                ,function(data){          
                    $("#"+div_resultado).html(data);                    
                }); //alert ("hola maga esto no funciona");
                
}


function dialog_devolucion_material(div_dialog,direccion)
{
 
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:"Devolucion Material",
        autoOpen: true,
        height: 650,
        width: 1070,
        modal: true,
        closeOnEscape: false,
        
        buttons:[
        {
            
            id: "button-enviar",
            text: "Enviar",
            disabled:"true",
            click: function() {
                 $.post(burl+"devolucion_material/cambiar_estado_devolucion",{
                   
                   'id_detalle_dev':$("#id_dev_mat").val(), 
                    'estado':"Enviado a Almacen"
                      
                }
                
                ,function(data){
                    $("#"+div_dialog +" #respuestas_ayuda").html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Guardando...</div>');
                    $("#"+div_dialog+" #respuestas_ayuda").html(data);
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado al contacto , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                       
                        dir=this.quita_parametros(direccion,1);
                       
                        cargar_en_div_html(div_dialog,dir+$('#ayudata').val());
                    }, 2000);
                    
                });
                //var id_sm=$("#id_sm").val()
                // genera("c_o",burl+"solicitud_material/codigo_ope_sol_mat/"+id_sm); 
               // genera_devolucion("listado",burl+"devolucion_material/cambiar_estado_devolucion/");            
            }
        },
        
        {
            id: "save",
            text: "Guardar",
            enable:"true",
            click: function() {
                ids=$("#ids_selec").val();
                //alert (ids);
                data_ids="";
                vec=ids.split(",");
               // data_id_grup="";
                data_can_asig="";
                data_can_uti="";
                data_cantidad_total="";
                data_just="";
                data_sn="";
                data_cn="";
                data_obser="";
               /// data_proy="";
                for(i=1;i<vec.length;i++)
                { 
                    
                    data_ids+="|"+vec[i];
                  //  data_id_grup+="|"+$("#"+vec[i]+" #id_grup").val();
                    data_can_asig+="|"+$("#"+vec[i]+" #can_asig").val();
                    data_can_uti+="|"+$("#"+vec[i]+" #can_uti").val();
                    data_cantidad_total+="|"+$("#"+vec[i]+" #cantidad_total").val();
                    data_just+="|"+$("#"+vec[i]+" #just").val();
                    data_sn+="|"+$("#"+vec[i]+" #sn").val();
                    data_cn+="|"+$("#"+vec[i]+" #cn").val();
                    //data_proy+="|"+$("#"+vec[i]+" #proy").val();
                    data_obser+="|"+$("#"+vec[i]+" #obser").val()
                }  
                //alert('can_asig'+data_can_asig);
                //alert("no funciona"+$("#c_u").val());                
                //  alert("aquii"+data_ids+","+data_idps+","+data_ma+","+data_cant+","+data_comen);
                //alert($("#id_dev_mat").val());
                $.post(burl+"devolucion_material/guardar_solicitud",{
                    
                    'id_devolucion':$("#id_dev_mat").val(),
                    'ids':data_ids,
                    'can_a':data_can_asig,
                    'can_u':data_can_uti,
                    'can_t':data_cantidad_total,
                    'jus':data_just,
                    'sn':data_sn,
                    'cn':data_cn,
                    
                    'obser':data_obser,
                   // 'id_grup':data_id_grup,
                   'encar':$('#alm :selected').val(),
                    'comenta':$("#coment").val(),
                    'codigo_user':$("#cod_user").val(),
                    'id_mov':$("#id_mov").val(),
                    'proy':$("#proy").val()
           
                //'id_grup':$("#id_grup").val()
                    
                }                
                ,function(data){ 
                    $("#"+div_dialog +" #respuestas_ayuda").html(data);
                    //alert('ayudata >>>>>>'+ $("#ayudata").val());
                    //$("#button-enviar").button('enable');
                    setTimeout(function(){
                        nuevadireccion=this.quita_parametros(direccion,1);
                       
                        cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val());
                    }, 1000);//alert('funciona')no esta funcionado bien en los button de envia
                    //this.cargar_contenido_html(div_dialog,direccion,0);
                    
                   
                // /$("#ayudata").val()
                /*
                    setTimeout(function(){
                        $("#"+div_dialog).dialog("close");
                        
                    }, 500);
                */
                });
            }
        },
       
        
        {
            id: "button-ok",
            text: "Cerrar",
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




//estoy aumentando 
function dialog_detalle_solicitud_devolucion(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    // saber si es nuevo o es edicion
    
    d=direccion.split("/");
    dc=d.length-1
    titulo="Detalle Devolucion";
    if(d[dc]!=0)
        titulo="Detalle Devolucion";
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 600,
        width: 1000,
        modal: true,
        closeOnEscape: false,
        
     
        buttons: {
            
            
          
            "Cerrar": function() {
               
                $(this).dialog( "close" );
                
            }
        }
    });
}


function search_dm(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_and_devoluciones('lista_devoluciones');
    }  
   
}

function search_and_devoluciones(div_resultado)
{
    //alert ("hola maga esto no funciona");
    burl=$('#b_url').val();
    buscar=$("#search_dm").val();
    cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
       
    $.post(burl+"devolucion_material/busqueda_lista_devoluciones",{
                    
        'buscar':$('#search_ov_pf').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val()
    }
                
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
                
}
function dialog_detalle_solicitud_devolucion_final(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    // saber si es nuevo o es edicion
    
    d=direccion.split("/");
    dc=d.length-1
    titulo="Detalle Devolucion";
    if(d[dc]!=0)
        titulo="Detalle Devolucion";
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 600,
        width: 1000,
        modal: true,
        closeOnEscape: false,
        
     
        buttons: {
            
            
          
            "Cerrar": function() {
               
                $(this).dialog( "close" );
                
            }
        }
    });
}
function dialog_nuevo_vehiculo_adicionar(div_dialog,direccion,titulo){
   
  //alert('funciona');
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve alert('funciona');
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 632,
        width: 437,
        modal: true,
        closeOnEscape: false,
       
        buttons:
        {
        
            
            "Reset":function(){
                cargar_contenido_html(div_dialog,direccion,0);//alert('funciona');
            },
            "Guardar": function() {
                // alert ("entra"+$('#uni_med :selected').val());
               /* var ubi= $('#ubi :selected').val();
                if(ubi=="otroo")
                    ubi= $('#nueva_opcion_tipo').val();*/
                var id_vehiculo=$('#id_vehi').val(); 
               // alert(id_vehiculo);
                 opc=$("#esta_general :selected").val();
                 if(opc=='Activo')
                  {
                     var motivo=$('#opcion_activa #motivo').val();
                     
                  } 
                else{
                    var motivo=$('#opcion_inactiva #motivo').val();
                }
                   
               
                $.post(burl+"vehiculo/guardar_nuevo_vehiculo",{
                    
                    'id_vehi':id_vehiculo,
                    'placa':$('#placa').val(),
                    'marca':$('#marca').val(),
                    'anio':$('#anio :selected').val(),
                    'mod':$('#mod').val(),
                    'tipo_vehi':$('#tipo_vehi :selected').val(),
                    'color':$('#color').val(),
                    'motor':$('#motor').val(),
                    'chasis':$('#chasis').val(),
                    'traccion':$('#traccion :selected').val(),
                    'cap_per':$('#cap_per :selected').val(),
                    'fecha_ad':$('#fecha_ad').val(),
                    'accesorios':$('#accesorios').val(),
                    'contrato':$('#contrato :selected').val(),
                    'med_llanta':$('#llanta').val(),
                    'cilin':$('#cilin').val(),
                    'estado':$('#esta_general :selected').val(),
                    //adicionando nueva tabla
                    'id_actividad':$('#id_actividad').val(),
                    'fecha_inicio':$('#fecha_ini').val(),
                    'fecha_cierre':$('#fecha_cie').val(),
                    'motivo':motivo
                    
              
                }
                
                ,function(data){
                    // alert ("entra ");
                    $("#"+div_dialog +" #respuesta").html(data);
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado categoria , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        nuevadireccion=this.quita_parametros(direccion,1);
                        //alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                        cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val(),0);
                    }, 1000);//alert('funciona');
                    
                });
            },
            "Cerrar": function() {
               
                $( this ).dialog( "close" );
                location.reload();
            }
        }
       
       
    
    });

}
function dialog_asignar_responsable_vehiculo(div_dialog,direccion,titulo)
{
 
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 450,
        width: 540,
        modal: true,
        closeOnEscape: false,
        
        buttons:
        {
        
            
            "Reset":function(){
                cargar_contenido_html(div_dialog,direccion,0); 
            },
            "Guardar": function() {
               
                $.post(burl+"vehiculo/guardar_vehiculo_asignado_responsable",{
                   'id_asig':$('#id_asig').val(),
                   'id_asig_responsable':$('#id_asig_responsable').val(),
                    'id_vehiculo_resp':$('#id_vehiculo_resp').val(),
                    'fecha_hora_asig':$('#fecha_hora_asig').val(),
                    'fecha_hora_dev':$('#fecha_hora_dev').val(),
                    'id_estado_asig':$('#id_estado').val(),
                    'id_responsable':$('#asignado').val(),
                    'ciudad_asig':$('#ciudad_asignar :selected').val(),
                    'observaciones':$('#observaciones').val(),
                    'tipo_asignacion':"Responsable",
                    'estado_registro':"Activo"
                    
                    
                }
                
                ,function(data){
                    // alert ("entra ");
                    $("#"+div_dialog +" #respuesta").html(data);
                    //if($('#ayudata').val()!=0)
                    
                    setTimeout(function(){
                        nuevadireccion=this.quita_parametros(direccion,1);
                       // alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                        cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val(),0);
                    }, 1000);//alert('funciona'); 
                    
                });
            },
            "Cerrar": function() {
               
                $( this ).dialog( "close" );
               location.reload();//alert('funciona'); 
            }
        }
       
       
    
    });
}
function dialog_asignar_vehiculo_taller_proyecto(div_dialog,direccion)
{
   
 
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:'Asignacion de Vehiculo',
        autoOpen: true,
        height: 530,
        width: 640,
        modal: true,
        closeOnEscape: false,
        
        buttons:[
            {
            id: "guardar",
            text: "Guardar",
           
            click: function() {
                
                var tipo= $('#selec_subcentro :selected').val();
                if(tipo=="otro")
                    tipo= $('#otro_tipo_subcentro').val();
               opc=$("#tipo_asig :selected").val();
                if(opc=='Taller')
                  { var telefono=$('#opcion_taller #telefono').val();
                   var ciudad_asig=$('#opcion_taller #ciudad_asigado :selected').val();}
                else
                  { var telefono=$('#opcion_proyecto #telefono').val();
                    var ciudad_asig=$('#opcion_proyecto #ciudad_asigado :selected').val();}
               
                if($("#reemplazo :selected").val()=="Alquilado")
                    placarem='Alquilado :'+$("#alquilado_sel :selected").val()
                else
                    placarem='propio :'+$("#propio_sel :selected").val()
                if($("#reemplazo :selected").val()=="Sin_reemplazo")
                    placarem="Sin Reemplazo";
                $.post(burl+"asignacion_vehiculo_regional/guardar_vehiculo_taller_proyecto",{
                    'id_asig':$('#id_asig').val(),
                    'id_asig_responsable':$('#id_asig_resp').val(),
                    'id_vehiculo_resp':$('#id_vehiculo_resp').val(),
                    'fecha_hora_asig':$('#fecha_hora_asig').val(),
                    'fecha_hora_dev':$('#fecha_hora_dev').val(),
                    'id_estado_asig':$('#id_estado').val(),
                    'id_responsable':$('#asignado :selected').val(),//not
                    'ciudad_asig':ciudad_asig,
                    'selec_subcentro':tipo,
                    'observaciones':$('#observaciones').val(),//add datos
                    'tipo_asignacion':$('#tipo_asig :selected').val(),
                    'id_proyecto':$('#proyecto_seleccionado :selected').val(),
                    'nombre_taller':$('#nom_taller').val(),
                    'nombre_tecnico':$('#nom_tec').val(),
                    'reemplazo':placarem,
                    'telefono':telefono, 
                    'estado_registro':"Activo"
                    
                }
                
                ,function(data){
                    // alert ("entra ");
                    $("#"+div_dialog +" #respuesta").html(data);
                    //if($('#ayudata').val()!=0)
                    
                    setTimeout(function(){
                        nuevadireccion=this.quita_parametros(direccion,1);
                       // alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                        cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val(),0);
                    }, 1000);//alert('funciona'); 
                    
                });}
            },
            {
            id: "button-ok",
            text: "Cerrar",
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

function dialog_nuevo_estado_vehiculo(div_dialog,direccion)
{
 
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:'Nuevo estado de vehiculo',
        autoOpen: true,
        height: 340,
        width: 380,
        modal: true,
        closeOnEscape: false,
        
        buttons:
        {
        
            
            "Reset":function(){
                cargar_contenido_html(div_dialog,direccion,0); 
            },
            "Guardar": function() {
               
                $.post(burl+"vehiculo/guardar_nuevo_estado_vehiculo",{
                   // 'id_esta':$('#id_esta').val(),
                    'id_vehi':$('#id_vehic').val(),
                    'est_mec':$('#est_mec').val(),
                    'est_carr':$('#est_carr').val(),
                    'est_llan':$('#est_llan').val(),
                    'kilom':$('#kilom').val(),
                    'obser_estado':$('#obser_estado').val()
                    
                }
                
                ,function(data){
                    // alert ("entra ");
                    $("#"+div_dialog +" #respuesta").html(data);
                    //if($('#ayudata').val()!=0)
                    //alert('se ha adicionado categoria , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        nuevadireccion=this.quita_parametros(direccion,1);
                       // alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                      
                        cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val(),0);
                       $('#est_mecanico').html($('#est_mec').val());
                       $('#est_carroceria').html($('#est_carr').val());
                       $('#est_llantas').html($('#est_llan').val());
                       $('#id_estado').val($('#ayudata').val());
                    }, 1000);//alert('funciona'); 
                    
                });
            },
            "Cerrar": function() {
               
                $( this ).dialog( "close" );
             //location.reload();//alert('funciona'); 
            }
        }
       
       
    
    });
}

function mostrarA_ocultarB(condicion,div_mostrar,div_ocultar)
{
   burl=$('#b_url').val();
    opc=$("#"+condicion+" :selected").val();
    //alert(opc);
    //alert(div_ocultar+"----"+div_mostrar+"----- opc"+opc)
    if(opc=='Taller')
    {   
   // alert("taller");
       $("#"+div_ocultar).addClass("ocultar");
       $("#"+div_mostrar).removeClass("ocultar");
    }else{
      //  alert(' no taller');
       $("#"+div_mostrar).addClass("ocultar");
       $("#"+div_ocultar).removeClass("ocultar");//alert('funciona');
    }


}
// view Regional


///new
function search_vr(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_and_asignaciones_regional('lista_asig_regional');
    }  
   
}
function search_and_asignaciones_regional(div_resultado)
{
    burl=$('#b_url').val();
    buscar=$("#search_vn").val();
    cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    
    selec_depar=0;
     if($("#ciudad_asig").length)
        selec_depar=$("#ciudad_asig :selected").val();
   // alert(selec_depar);
    
    por_proyecto=0;
     if($("#proyecto_date").length)
        por_proyecto=$("#proyecto_date :selected").val();
    
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl+"asignacion_vehiculo_regional/obtener_asignados_regional",{
        'buscar':$('#search_ov_pf').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val(),
        'selec_depar':selec_depar,
        'proyecto':por_proyecto
        }
        ,function(data){          
            $("#"+div_resultado).html(data);                    
        });
}


////add new // Edita o devolucion//formulario
function dialog_edita_devolucion_asignar_responsable_vehiculo(div_dialog,direccion,titulo)
{
// alert('entra');
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 500,
        width: 630,
        modal: true,
        closeOnEscape: false,
        
        buttons:[
            {
            id: "editar",
            text: "Guardar editar",
            disabled:"true",
            click: function() {
               
                $.post(burl+"vehiculo/guardar_vehiculo_asignado_responsable_editado",{
                   'id_asig':$('#id_asig').val(),
                 //  'id_asig_responsable':$('#id_asig_responsable').val(),
                    //'id_vehiculo_resp':$('#id_vehiculo_resp').val(),
                   // 'fecha_hora_asig':$('#fecha_hora_asig').val(),
                    'fecha_hora_dev':$('#fecha_hora_dev').val(),
                    'estado_registro':"Activo",
                    //'id_estado_asig':$('#id_estado_asig').val(),
                   // 'id_responsable':$('#asignado').val(),
                   // 'ciudad_asig':$('#ciudad_asig :selected').val(),
                    'observaciones':$('#observaciones').val()
                    
                    
                }
                
                ,function(data){
                    // alert ("entra ");
                    $("#"+div_dialog +" #respuesta").html(data);
                    //if($('#ayudata').val()!=0)
                    
                    setTimeout(function(){
                        nuevadireccion=this.quita_parametros(direccion,1);
                       // alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                        cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val(),0);
                    }, 1000);//alert('funciona'); 
                    
                });}
            },
            {
                id: "devolucion",
                text: "Guardar devolucion",
                disabled:"true",
                click: function() {
                 $.post(burl+"vehiculo/guardar_vehiculo_asignado_responsable_devolucion",{
                   'id_asig':$('#id_asig').val(),
                   //'id_asig_responsable':$('#id_asig_responsable').val(),
                    'id_vehiculo_resp':$('#id_vehiculo_resp').val(),
                   // 'fecha_hora_asig':$('#fecha_hora_asig').val(),
                    'fecha_hora_dev':$('#fecha_hora_dev').val(),
                    'id_estado_asig':$('#id_estado').val(),
                    'id_devolucion_veh':$('#id_asig').val(),
                    'estado_registro':"Inactivo",
                    'tipo_asignacion':"Devolucion",
                    'id_responsable':$('#asignado').val(),
                   // 'ciudad_asig':$('#ciudad_asig :selected').val(),
                    'observaciones':$('#observaciones').val()
                    
                    
                }
                
                ,function(data){
                    // alert ("entra ");
                    $("#"+div_dialog +" #respuesta").html(data);
                    //if($('#ayudata').val()!=0)
                    
                    setTimeout(function(){
                        nuevadireccion=this.quita_parametros(direccion,1);
                       // alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                        cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val(),0);
                    }, 1000);
                    location.reload();  //alert('funciona'); 
                    
                }); }
            },
           {
            id: "button-ok",
            text: "Cerrar",
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

////add new // Edita o devolucion//formulario//de asignacionde vehiculo regional
function dialog_edita_devolucion_asignar_vehiculo(div_dialog,direccion,titulo)
{
 
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 500,
        width: 630,
        modal: true,
        closeOnEscape: false,
        
        buttons:[
            {
            id: "editar",
            text: "Guardar editar",
            disabled:"true",
            click: function() {
               
                $.post(burl+"asignacion_vehiculo_regional/guardar_vehiculo_asignado_editando",{
                   'id_asig':$('#id_asig').val(),
                 //  'id_asig_responsable':$('#id_asig_responsable').val(),
                    'id_vehiculo_resp':$('#id_vehiculo_resp').val(),
                   // 'fecha_hora_asig':$('#fecha_hora_asig').val(),
                    'fecha_hora_dev':$('#fecha_hora_dev').val(),
                    'estado_registro':"Activo",
                    //'id_estado_asig':$('#id_estado_asig').val(),
                   // 'id_responsable':$('#asignado').val(),
                   // 'ciudad_asig':$('#ciudad_asig :selected').val(),
                    'observaciones':$('#observaciones').val()
                    
                    
                }
                
                ,function(data){
                    // alert ("entra ");
                    $("#"+div_dialog +" #respuesta").html(data);
                    //if($('#ayudata').val()!=0)
                    
                    setTimeout(function(){
                        nuevadireccion=this.quita_parametros(direccion,1);
                       // alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                        cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val(),0);
                    }, 1000);//alert('funciona'); 
                    
                });}
            },
            {
                id: "devolucion",
                text: "Guardar devolucion",
                disabled:"true",
                click: function() {
                 $.post(burl+"vehiculo/guardar_vehiculo_asignado_responsable_devolucion",{
                   'id_asig':$('#id_asig').val(),
                   //'id_asig_responsable':$('#id_asig_responsable').val(),
                    'id_vehiculo_resp':$('#id_vehiculo_resp').val(),
                   // 'fecha_hora_asig':$('#fecha_hora_asig').val(),
                    'fecha_hora_dev':$('#fecha_hora_dev').val(),
                    'id_estado_asig':$('#id_estado').val(),
                    'id_devolucion_veh':$('#id_asig').val(),
                    'estado_registro':"Inactivo",
                    'tipo_asignacion':"Devolucion",
                    'id_responsable':$('#asignado').val(),
                   // 'ciudad_asig':$('#ciudad_asig :selected').val(),
                    'observaciones':$('#observaciones').val()
                    
                    
                }
                
                ,function(data){
                    // alert ("entra ");
                    $("#"+div_dialog +" #respuesta").html(data);
                    //if($('#ayudata').val()!=0)
                    
                    setTimeout(function(){
                        nuevadireccion=this.quita_parametros(direccion,1);
                       // alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                        cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val(),0);
                    }, 1000);
                    location.reload();  //alert('funciona'); 
                    
                }); }
            },
           {
            id: "button-ok",
            text: "Cerrar",
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
function carga_subcentro(campo_parametro,campo_respuesta,bloque,seleccionado){
//alert($('#'+campo_parametro+' :selected').val());
  $.post(burl+"asignacion_vehiculo_regional/respuesta_centro_por_ciudad",{                    
        'id_ciudad':$('#'+campo_parametro+' :selected').val(),
        'id_campo':campo_respuesta,
        'seleccionado':seleccionado
    }
    ,function(data){
        // alert(data);
        $("#"+bloque).html(data);
                    
    });
}

function genera_otro(div_resultado)
{
    
    burl=$('#b_url').val();
    opc=$("#selec_subcentro :selected").val();
    if(opc=='otro')
    {   
        
        $("#"+div_resultado).html('<div class="grid_3"><input class="input_redond_150 margin_cero" type="text"\n\
 id="otro_tipo_subcentro" placeholder="Escriba Subcentro" value=""></div>\n\
                                                        <div class="f10 negrilla">Nuevo subcentro</div>');
    }

}
function dialog_subir_archivos_vehiculo(div_dialog,direccion)
{
 
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,direccion);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:'Archivos del vehiculo',
        autoOpen: true,
        height: 480,
        width: 789,
        modal: true,
        closeOnEscape: false,
        
        buttons:
        {
        
            "Cerrar": function() {
               
                $( this ).dialog( "close" );
             //location.reload();//alert('funciona'); 
            }
        }
       
       
    
    });
}
/////ultima edicion
function dialog_historial_de_asignaciones_vehiculo(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    
    d=direccion.split("/");
    dc=d.length-1
    titulo="Historial de asignaciones";
    if(d[dc]!=0)
        titulo="Historial de asignaciones";
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 600,
        width: 1000,
        modal: true,
        closeOnEscape: false,
        
     
        buttons: {
            
            
          
            "Cerrar": function() {
               
                $(this).dialog( "close" );
                
            }
        }
    });
}


//generar reporte
function Imp_asignacion_de_vehiculos_proyecto()
{
    // alert (registro);
    //alert($("#burl").val());
    baseurl=$("#b_url").val()+'impresiones_pdf/imprimir_asignacion_vehiculo_proyecto';  
    miven=window.open (baseurl, "mywindow","menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");
    
}
function Imp_asignacion_de_vehiculos_proyecto_2()
{
    // alert (registro);
    //alert($("#burl").val());
    baseurl=$("#b_url").val()+'impresiones_pdf/imprimir_asignacion_vehiculo_proyecto_2';  
    miven=window.open (baseurl, "mywindow","menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");
    
}

function ver_archivo(ruta,titulo)
{
   //  alert (registro);
   
   //alert($("#b_url").val()+ruta);
    baseurl=$("#b_url").val()+ruta;  
    //alert(baseurl);
    miven=window.open (baseurl, titulo,"menubar=0,location=1,status=1,scrollbars=1, width=1000,height=500");
    
}
// ultimo  adicionado// cambiar estado

function cambiar_estado_vehiculo(condicion,opcion_inactiva,opcion_activa,ant_estado)
{
    burl=$('#b_url').val();
    opc=$("#"+condicion+" :selected").val();
  //alert(opc);
   // alert(opcion_elegida);
   if(ant_estado!= opc){
       
    if(opc=='Activo')
      {   
       //alert("activo");

        $("#"+opcion_inactiva).addClass("ocultar");
        $("#"+opcion_activa).removeClass("ocultar");
      }else{
         // alert("Inactivo");
         $("#"+opcion_activa).addClass("ocultar");
         $("#"+opcion_inactiva).removeClass("ocultar");
      }
   }
   else
       { $("#"+opcion_inactiva).addClass("ocultar");
        $("#"+opcion_activa).addClass("ocultar");}

}



// adicionando... para la experiencia laboral


function dialog_adicionar_experiencia_laboral(div_dialog,direccion,titulo)
{
 
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 620,
        width: 415,
        modal: true,
        closeOnEscape: false,
        
       buttons:[
        {
            id: "entregar",
            text: "Registrar Datos",
            click: function() {
                
                var formData= new FormData($("#fileform")[0]);
                formData.append ('file_name',$("#upfile").val());
                formData.append ('id_expe',$("#id_expe").val());
                formData.append ('cant_pe',$("#cant_pe :selected").val());
                formData.append ('nom_inst',$("#nom_inst").val());
                formData.append ('rubro',$("#rubro").val());
                formData.append ('area',$("#area").val());
                formData.append ('nom_puesto',$("#nom_puesto").val());
                formData.append ('fe_ini',$("#fe_ini").val());
                formData.append ('fe_fin',$("#fe_fin").val());
                formData.append ('nomb_ref',$("#nomb_ref").val());
                formData.append ('num_ref',$("#num_ref").val());
                formData.append ('actividades',$("#actividades").val());
              
    
                //  alert ('Subir archivo?');
                //var dimensiones=$("#"+div_destino+" #dimensiones").val()
                //dim=dimensiones.split("|");
                cod='<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Espere por favor...</div>';
                $("#"+div_dialog).html(cod);
                var ruta = burl+'experiencia_laboral/guardar_experiencia_laboral_upload_file';
                $.ajax({
                    url: ruta,
                    data: formData,
                    cache: false,
                    contentType: false,//'multipart/form-data' se ha quitado esta opcion es algo raro la verda :o!!!
                    processData: false,
                    type: 'POST',
                    success: function(data){
                        // alert($("#direccion_load").val());
                    //    alert(data);
                        resultado=data.split("|");
                     //   alert(resultado[0]+"----"+resultado[1]+"----"+resultado[2]);
                        cod="<div class='"+resultado[2]+"'>"+resultado[1]+"</div>";
                        $("#"+div_dialog).html(cod);
                        setTimeout(function(){
                            dir=quita_parametros(direccion,1);
                            cargar_contenido_html(div_dialog,dir+resultado[0],0);
                        }, 1000);
                        cargar_contenido_html("lista_experiencia",burl+"experiencia_laboral/lista_experiencia_laboral",0);
                   
             
                    }
                });
            }
        },
        {
            id: "nuevo",
            text: "Nuevo Registro",
            click: function() {  
                dir=quita_parametros(direccion,1);
                cargar_contenido_html(div_dialog,dir+"0",0);
            }
        },
        {
            id: "button-ok",
            text: "cerrar",
            click: function() {
                cargar_contenido_html("lista_experiencia",burl+"experiencia_laboral/lista_experiencia_laboral",0);
                $( this ).dialog( "close" );
           
            }
        }
        ]
        
    });
}
function del_reg_experiencia(div_dialog,reg)
{
    burl=$('#b_url').val();
    $( "#"+div_dialog ).html("<div class='centrartexto f14'> Seguro que desea eliminar el Registro ?</div>")
    $( "#"+div_dialog ).dialog({
        title:"Confirmar",
        autoOpen: true,
        height: 150,
        width: 350,
        modal: true,
        buttons:[
        {
            id: "si",
            text: "SI",
            click: function() {
                $.post(burl+"experiencia_laboral/del_reg/"+reg,{},function(data){
                    cargar_contenido_html("lista_experiencia",burl+"experiencia_laboral/lista_experiencia_laboral",0);
                    $( "#"+div_dialog).dialog( "close" );
                });
            }
        },
        {
            id: "no",
            text: "NO",
            click: function() {
                $( this ).dialog( "close" );                   
            }
        }        
        ]
    });
}
// UTIMO
function mostrarA_ocultarP(condicion,div_mostrar,div_ocultar)
{
   burl=$('#b_url').val();
    opc=$("#"+condicion+" :selected").val();
    //alert(opc);
    //alert(div_ocultar+"----"+div_mostrar+"----- opc"+opc)
    if(opc=='Alquilado')
    {   
  
       $("#"+div_ocultar).addClass("ocultar");
       $("#"+div_mostrar).removeClass("ocultar");
    }else{
      
       $("#"+div_mostrar).addClass("ocultar");
       $("#"+div_ocultar).removeClass("ocultar");//alert('funciona');
    }
    if(opc=='Sin_reemplazo'){$("#"+div_mostrar).addClass("ocultar");
       $("#"+div_ocultar).addClass("ocultar");}


}
//// adicionando para proyecto...... 4/1/16
function search_proyecto(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
       search_and_list_proyecto('lista_proyecto');
    }  
   
}
function search_and_list_proyecto(div_resultado)
{
    burl=$('#b_url').val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
    $.post(burl+"proyecto/busqueda_de_proyecto",{
                    
        'buscar':$('#search_proyecto').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val() 
    }
                
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
                
}
function dialog_nueva_proyecto(div_dialog,direccion){

    //alert('entras a la funcion dialog_nueva_dosid');
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve alert('funciona');
    $( "#"+div_dialog ).dialog({
        title:'Nueva Proyecto',
        autoOpen: true,
        height: 600,
        width: 1020,
        modal: true,
        closeOnEscape: false,
       
        buttons:
        {
        
            
            "Reset":function(){
                cargar_contenido_html(div_dialog,direccion,0);//alert('funciona');
            },
            "Guardar": function() 
            {
               
               
               
                $.post(burl+"proyecto/guardar_nuevo_proyecto",{
                  
                    'id_proy':$('#id_proy').val(),
                    'nombre':$('#nom_proy').val(),
                    'descripcion':$('#desc_proy').val(),
                    'estado':$('#estado :selected').val(),
                    'fh_activo':$('#fh_vigencia').val()
                   
					
               
                }
                
                ,function(data){
                    $("#"+div_dialog +" #respuesta").html(data);
                    //if($('#ayudata').val()!=0)
                    setTimeout(function(){
                        nuevadireccion=this.quita_parametros(direccion,1);
                        cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val(),0);
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
// actualmente utilizado 130116
function dialog_contenidos_nuevo_proyecto(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    $( "#"+div_dialog ).dialog({
        title:"Registro Proyecto/Contrato",
        autoOpen: true,
        height: 600,
        width: 1080,
        modal: true,
        closeOnEscape: false,
       /* open: function(event, ui) {
            $(".ui-dialog-titlebar-close").hide();
        },*/
        buttons: 
                {
            "Reset":function(){
                cargar_contenido_html(div_dialog,direccion,0);
            },
            "Guardar": function() 
            {
                 var items_select = $('#items_select').val();
                 var vector=items_select.split(",");
                 
                 var ids_contrato="";
                 var nro_contrato="";
                 var gestion="";
                 var provision="";
                 var moneda_pro="";
                 var importe="";
                 var moneda_imp="";
                 var vigencia="";
                 var etapa="";
                 var objeto="";
                 var nro_licitacion="";
                 var estado_contrato="";
                 var id_encargado="";
                 var t_contrato="";
                 var observacion_contrato="";
                // var id_cliente_contrato="";
                
                for(i=1;i<vector.length;i++)
                {
                    ids_contrato=ids_contrato+$('#dr'+vector[i]+' #id_contrato').val()+';';
                    nro_contrato=nro_contrato+$('#dr'+vector[i]+' #nro_contrato').val()+';';
                    gestion=gestion+$('#dr'+vector[i]+' #gestion').val()+';';
                    provision=provision+$('#dr'+vector[i]+' #provision').val()+';';
                    moneda_pro=moneda_pro+$('#dr'+vector[i]+' #tmoneda_pro :selected').val()+';';
                    importe=importe+$('#dr'+vector[i]+' #importe').val()+';';
                    moneda_imp=moneda_imp+$('#dr'+vector[i]+' #tmoneda_imp :selected').val()+';';
                    vigencia=vigencia+$('#dr'+vector[i]+' #vigencia').val()+';';
                    etapa=etapa+$('#dr'+vector[i]+' #etapa').val()+';';
                    objeto=objeto+$('#dr'+vector[i]+' #objeto').val()+';';
                    nro_licitacion=nro_licitacion+$('#dr'+vector[i]+' #nro_licitacion').val()+';';
                    estado_contrato=estado_contrato+$('#dr'+vector[i]+' #estado_contrato :selected').val()+';';
                    t_contrato=t_contrato+$('#dr'+vector[i]+' #t_contrato :selected').val()+';';
                    id_encargado=id_encargado+$('#dr'+vector[i]+' #id_encargado :selected').val()+';';
                    observacion_contrato=observacion_contrato+$('#dr'+vector[i]+' #observacion_contrato').val()+';';
                   /// id_cliente_contrato=id_cliente_contrato+$('#dr'+vector[i]+' #id_cliente :selected').val()+';';
                }
                //alert($('#id_cliente :selected').val());
                //alert($('#id_proy').val());
               // alert('ids: '+ids_contrato+"\n "+nro_contrato+"\n "+gestion+"\n pro: "+provision+"\n "+importe+"\n "+vigencia+"\n "+etapa+"\n "+objeto+"\n "+estado_contrato+"\n "+moneda_imp);//+"\n "+id_cliente_contrato
                
                
                $.post(burl+"proyecto/guardar_nuevo_proyecto",{
                    
                    
                    
                    //para el proyecto
                    'id_proy':$('#id_proy').val(),
                    'descripcion':$('#desc_proy').val(),
                    'nombre':$('#nom_proy').val(),
                    'estado':$('#estado :selected').val(),
                    'fh_activo':$('#fh_vigencia').val(),
                    'id_cliente':$('#id_cliente :selected').val(),
                    //para el contrato
                    'ids_contrato':ids_contrato,
                    'nro_contrato':nro_contrato,
                    'gestion':gestion,
                    'provision':provision,
                    'moneda_pro': moneda_pro,
                    'importe':importe,
                    'moneda_imp': moneda_imp,
                    'vigencia':vigencia,
                    'etapa':etapa,
                    'objeto':objeto,
                    'nro_licitacion':nro_licitacion,
                    'estado_contrato':estado_contrato,
                    't_contrato':t_contrato,
                    'observacion_contrato':observacion_contrato,
                    'id_encargado':id_encargado
             
                }
                ,function(data){
                    $("#"+div_dialog +" #respuesta").html(data);
                    //if($('#ayudata').val()!=0)
                    setTimeout(function(){
                        nuevadireccion=this.quita_parametros(direccion,1);
                        cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val(),0);
                        search_and_list_proyecto('lista_proyecto');
                    }, 1000);
                    
                });  
            },
            "Cerrar": function() {
               
                $( this ).dialog( "close" );
              //  location.reload();
            }
        }
    });
}
///// adicionado 4/1/16
function add_registro_contrato (){
    var nd= parseInt($('#nro_reg').val())+1;
    $('#nro_reg').val(nd);
    $('#items_select').val($('#items_select').val()+','+nd);
    
    var codigo= $('#grilla_modelo').html();
    codigo=codigo.replace(/XX/gi, nd);
    $('#datos_contrato').append('<div id="dr'+nd+'" class="grid_20">'+codigo+'</div>');
}
/// adicionado 15/1/16
function genera_bloque_observacion(div_resultado){
     burl=$('#b_url').val();
     opc=$("#t_contrato :selected").val();
     if(opc=='c_plazo'){
         $("#"+div_resultado).html('<div class="grid_6" ><input class="input_redond_370" type="text"  placeholder="" ></div><div class="negrilla f10">Observacion Contrato</div>');
     
    
    }
}




/// adicionado 12/09/16 por magali para vista de activos fijo



function search_af(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13')
    {  
        $("#pagina_registros").val(1);
        search_and_list_act_fijo('lista_act_fijo');
    }  
   
}
function search_and_list_act_fijo(div_resultado)
{
    burl=$('#b_url').val();
    buscar=$("#search_af").val();
    cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
       
    $.post(burl+"movimiento_almacen/busqueda_lista_activos_fijos",
    {
                    
        'buscar':$('#search_ov_pf').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val()
    }
                
    ,function(data)
    {          
        $("#"+div_resultado).html(data);                    
    });
                
}




