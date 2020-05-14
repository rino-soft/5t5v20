

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



//funciones de CONFIGURACIONES SISTEMA
function cargar_contenido_html(div_destino,direccion,modulo)
{
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



/*function dialog_nueva_prod_serv(div_dialog,direccion,titulo)
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
*/
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
        
        $("#"+div_resultado).html('<div class="grid_8" ><input class="input_redond_370" type="text" id="nueva_opcion" placeholder="Escriba nueva unidad de medida" value=""></div>');
    }

}
function otra_opcion_tipo(div_resultado)
{
    
    burl=$('#b_url').val();
    opc=$("#tipo :selected").val();
    if(opc=='otroo')
    {   
        
        $("#"+div_resultado).html('<div class="grid_8" ><input class="input_redond_370" type="text" id="nueva_opcion_tipo" placeholder="Escriba nuevo tipo" value=""></div>');
    }

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
function search_and_list_prod_kardex(div_resultado)
{
    //alert ("hola maga esto no funciona");
    burl=$('#b_url').val();
    buscar=$("#search_prod_kardex").val();
    almacen=$("#id_almacen :selected").val();
    categoria=$("#cate :selected").val();
    cant=$("#mostrarX :selected").val();
    pagina=$("#pagina_registros").val();
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
       
    $.post(burl+"kardex_almacen/busqueda_producto_kardex_almacen",{
                    
        'buscar':buscar,
        'almacen':almacen,
        'categoria':categoria,    
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

/*function dialog_devolucion_material(div_dialog,direccion)
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
            click: function() {
                //var id_sm=$("#id_sm").val()
                // genera("c_o",burl+"solicitud_material/codigo_ope_sol_mat/"+id_sm); 
                genera_devolucion("listado",burl+"devolucion_material/comparar_enviado/");            
            }
        },
        
        {
            id: "save",
            text: "Guardar",
            enable:"true",
            click: function() {
                ids=$("#ids_selec").val();
                data_ids="";
                vec=ids.split(",");
               // data_id_grup="";
                data_can_asig="";
                data_can_uti="";
                data_cantidad_total="";
                data_just="";
                data_sn="";
                for(i=1;i<vec.length;i++)
                { 
                    
                    data_ids+="|"+vec[i];
                  //  data_id_grup+="|"+$("#"+vec[i]+" #id_grup").val();
                    data_can_asig+="|"+$("#"+vec[i]+" #can_asig").val();
                    data_can_uti+="|"+$("#"+vec[i]+" #can_uti").val();
                    data_cantidad_total+="|"+$("#"+vec[i]+" #cantidad_total").val();
                    data_just+="|"+$("#"+vec[i]+" #just").val();
                    data_sn+="|"+$("#"+vec[i]+" #sn").val()
                 
                }  
                //alert('can_asig'+data_can_asig);
                //alert("no funciona"+$("#c_u").val());                
                //  alert("aquii"+data_ids+","+data_idps+","+data_ma+","+data_cant+","+data_comen);
                $.post(burl+"devolucion_material/guardar_solicitud",{
                    
                    'ids':data_ids,
                    'can_a':data_can_asig,
                    'can_u':data_can_uti,
                    'can_t':data_cantidad_total,
                    'jus':data_just,
                    'sn':data_sn,
                   // 'id_grup':data_id_grup,  
                    'comenta':$("#coment").val(),
                    'codigo_user':$("#cod_user").val(),
                    'id_mov':$("#id_mov").val()
           
                //'id_grup':$("#id_grup").val()
                    
                }                
                ,function(data){
                    $("#"+div_dialog +" #respuestas_ayuda").html(data);
                    alert('ayudata >>>>>>'+ $("#ayudata").val());
                    this.cargar_contenido_html(div_dialog,direccion,0)
                // /$("#ayudata").val()
                
                    setTimeout(function(){
                        $("#"+div_dialog).dialog("close");
                        
                    }, 500);
                
                });
            }
        },
        {
            
            id: "reset",
            text: "Restablecer",
            enable:"true",
            click: function() {
                
                cargar_contenido_html(div_dialog,direccion,0); 
            
            }
        },
        
        {
            id: "button-ok",
            text: "Cancelar",
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
}*/

// aumentar modificado
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
            
            id: "reset",
            text: "Restablecer",
            enable:"true",
            click: function() {
                
                cargar_contenido_html(div_dialog,direccion,0); 
            
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







