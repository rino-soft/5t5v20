/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function registrar_nueva_cuenta(){
    {
      
   
    informacion={
       /// "id_plan": $('#id_plan').val(),
        "codigo":  $('#codigo').val(),
        "titulo":  $('#titulo').val(),
        "imputable":  $('#imputable :selected').val(),
        "id_padre":  $('#id_padre').val(),
        "comentario":  $('#comentario').val()
    };
    baseurl=$("#b_url").val();
    
    $.post(baseurl+"contabilidad_plan_cuentas/guardar_nuevo_registro_cuenta",informacion             
        ,function(data){
            alert( "Los datos ha registrado correctamente");
            location.reload();
                
        });
}
}


////// rendiciion
function dialog_nuevo_for_rendicion(div_dialog,direccion,titulo){

    //alert('funciona');
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve alert('funciona');
    $( "#"+div_dialog ).dialog({
        title:titulo,
        autoOpen: true,
        height: 632,
        width: 860,
        modal: true,
        closeOnEscape: false,
       
        buttons:
        {
        
            
            "Reset":function(){
                cargar_contenido_html(div_dialog,direccion,0);//alert('funciona');
            },
            "Guardar": function() {
                // alert ("entra"+$('#uni_med :selected').val());
                
               /*
                var nombre_unidad = $('#uni_med :selected').val();
                if(nombre_unidad=="otro")
                    nombre_unidad= $('#nueva_opcion').val();*/
               var items_select = $('#items_select').val();
               
               var id_tipo_gasto="";
               var c_s_factura="";
               var monto="";
               var nro_fac="";
               var vector=items_select.split(",");
               //alert(vector.length);
               for(i=1;i<vector.length;i++)
               {
                   id_tipo_gasto=id_tipo_gasto+$('#dr'+vector[i]+' #tipo_gasto :selected').val()+';';
                   monto=monto+$('#dr'+vector[i]+' #monto').val()+';';
                   if($('#dr'+vector[i]+' #fac').is(':checked'))
                   c_s_factura=c_s_factura+'1;';
               else
                   c_s_factura=c_s_factura+'0;';
                   nro_fac=nro_fac+$('#dr'+vector[i]+' #nro_fact').val()+';';
               }
              
               alert(id_tipo_gasto+' \n '+monto+' \n '+c_s_factura+' \n '+nro_fac);
               
               
               
                $.post(burl+"contabilidad_plan_cuentas/guardar_nueva_rendicion",{
                  
                    
                    'tipo':id_tipo_gasto,
                    'monto':monto,
                    'fac':nro_fac,
                    'f_s':c_s_factura,
                    'id_rend':$('#id_rend').val(),
                    'id_proy':$('#proyecto_seleccionado :selected').val(),
                    'id_usu':$('#tecnico_seleccionado :selected').val(),
                    'desc':$('#desc').val(),
                    'fec_reg':$('#fechaS').val()
                   
                }
                
                ,function(data){
                    // alert ("entra ");
                    $("#"+div_dialog +" #respuesta").html(data);
                    if($('#ayudata').val()!=0)
                    //alert('se ha adicionado categoria , con nro de Id : '+$('#ayudata').val())
                    setTimeout(function(){
                        nuevadireccion=this.quita_parametros(direccion,1);
                        //alert('direccion,'+direccion+",nueva_direccion,"+nuevadireccion);
                        cargar_contenido_html(div_dialog,nuevadireccion+$('#ayudata').val(),0);
                    }, 1000);//alert('funciona'); 
                    
                });  
            },
            /*"Enviar":function(){
                $( this ).dialog( "close" );
                 baseurl=$("#b_url").val()+'impresiones_pdf/imp_form_rendiciones/'+$('#id_rend').val();  
                miven=window.open (baseurl, "mywindow","menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");
            }
            ,*/
            "Cerrar": function() {
               
                $( this ).dialog( "close" );
                location.reload();
            }
        }
       
       
    
    });
}
//generar reporte
function Imp_reporte_de_rendicion(id_rend)
{
    // alert (registro);
    //alert($("#burl").val());
    baseurl=$("#b_url").val()+'impresiones_pdf/imp_form_rendiciones/'+id_rend;  
    miven=window.open (baseurl, "mywindow","menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");
    
}
function Imp_reporte_de_rendicion_asiento(id_rend)
{
    // alert (registro);
    //alert($("#b_url").val());
    baseurl=$("#b_url").val()+'impresiones_pdf/imp_form_rendiciones_asiento/'+id_rend;  
    miven=window.open (baseurl, "mywindow","menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");
    
}


function add_registro (){
    var nd= parseInt($('#nro_reg').val())+1;
    $('#nro_reg').val(nd);
    $('#items_select').val($('#items_select').val()+','+nd);
    
    var codigo= $('#grilla_modelo').html();
    codigo=codigo.replace(/XX/gi, nd);
    $('#add_nuevo_rendicion').append('<div id="dr'+nd+'" class="grid_15">'+codigo+'</div>');
}
/*function funcion_ayuda(){
    var nd= parseInt($('#nro_reg').val())+1;
    $('#nro_reg').val(nd);
    $('#items_select').val($('#items_select').val()+','+nd);
    
    var codigo= $('#grilla_modelo').html();
    codigo=codigo.replace(/XX/gi, nd);
    $('#add_nuevo_rendicion').append('<div id="dr'+nd+'" class="grid_15">'+codigo+'</div>');
}*/
function carga_tipo_gasto(campo_parametro,campo_respuesta,bloque,seleccionado)
{
 //alert($('#'+campo_parametro+' :selected').val());

  $.post(burl+"contabilidad_plan_cuentas/buscar_tipo_gasto",{                    
        'tipo_gasto':$('#'+campo_parametro+' :selected').val(),
        'id_campo':campo_respuesta,
        'seleccionado':seleccionado
    }
    ,function(data){
        // alert(data);
        $("#"+bloque).html(data);
                    
    });
}
function del_registro_rendicion(variable){
    $('#dr'+variable).remove();
    var dato= $('#items_select').val();
    dato=dato.replace(variable+',','');
    $('#items_select').val(dato);
}


//adicionando busqueda 8/12/15

function search_ren(event)
{
    var keycode = (event.keyCode ? event.keyCode : event.which);  
    if(keycode == '13'){  
        $("#pagina_registros").val(1);
        search_and_list_rendicion('lista_rendicion');
    }  
   
}
function search_and_list_rendicion(div_resultado)
{
   /// alert ("ingresando a la funcion!!!!!!!!!!");
    burl=$('#b_url').val();
   /* buscar=$("#search_ren").val();
    cant=$("#cant_reg :selected").val();
    pagina=$("#pagina_registros").val();*/
    $("#"+div_resultado).html('<div class="cargando_circulo" ></div><div></div><div class="f20 alin_cen">Cargando...</div>');
       
    $.post(burl+"contabilidad_plan_cuentas/busqueda_de_rendiciones",{
                    
        'buscar':$('#search_rendicion').val(),
        'cant':$('#mostrarX :selected').val(),
        'pagina':$('#pagina_registros').val() 
    }
                
    ,function(data){          
        $("#"+div_resultado).html(data);                    
    });
                
}
/*function val_numero(evento){
   
alert(String.fromCharCode(evento.which) );

}*/
function val_numero(campo)
{
    valor=$("#"+campo).val();
    c=valor.substring((valor.length)-1);
    //alert("valor "+valor+" c= "+c);
    permitido="0123456789"
    if(c=="," || c==".")
    {
            valor_final=valor.substring(0, (valor.length)-1)+".";
    }
    else
    {
      //  alert("if : "+permitido.indexOf(c));
        if(permitido.indexOf(c)==-1)
        {
            valor_final=valor.substring(0, (valor.length)-1);
        }
        else
            valor_final=valor;
    }    
    $("#"+campo).val(valor_final);
        
}
