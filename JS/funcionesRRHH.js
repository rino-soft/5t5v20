/* 
 * Funciones elaboradas por Ruben Payrumani Ino 
 * $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
 */
function formulario_nuevo_menu(indice)
{
    baseurl=$("#burl").val();   
    $.post(baseurl+"menus/formulario_adicion_edicion",{
        'ind':indice
    },function(data){
        $("#div_form_adicion_edicion").html(data)
    });
}
function adicionar_editar_menu()
{
    baseurl=$("#burl").val();
    
    $.post(baseurl+"menus/adicionar_editar_menus_item",
    {
        'tipo':$("#adicion_edicion_menu").val() ,
        'titulo':$("#titulomenu").val(),
        'controlador':$("#controladormenu").val(),
        'metodo':$("#metodomenu").val(),
        'padre':$("#padremenu").val(),
        'estado':$("#estadomenu").val()
    }
    ,function(data){
        $("#div_form_adicion_edicion").html(data)
    });
    setTimeout(function(){
        //window.location = baseurl+"menus/gestionar_menu";
         location.reload();
    }, 2000);
}


function buscar_personal_en_todo(){
    quebuscar=$("#quebuscar").val();
    baseurl=$("#burl").val();
    id_proyecto=$('#proyecto :selected').val();
    $.post(baseurl+"usuario/busqueda_usuario_arbol",
    {
        'busqueda':quebuscar,
        'proyecto':id_proyecto
    }
    ,function(data){
        $("#resultado_busqueda_personal").html(data)
        
    });
}

function obtener_jefes_proyectos(id_jefe)
{
    
    $('#proyecto_empleado').val($('#proyecto :selected').text());
    proyectoSeleccionado=$("#proyecto :selected").val();
    $.post(baseurl+"usuario/obtener_padres_arbol",
    {
        'id_proy':proyectoSeleccionado,
        'id_jefe':id_jefe
    }
    ,function(data){
        $("#div_jefesProyecto").html(data);
        
    });
}
function mostrar_nuevo_cargo()
{
    if($('#cargos :selected').val()=="0otro0")
        $('#cargo_empleado_otro').css('display', 'block');
    else
        $('#cargo_empleado_otro').css('display', 'none');
}
function cambiar_estilo_select_disabled(i,sw)
{
    //color de la seleccion :3399FF
    if(sw==1)      
        $("#opCargoPad"+i).css({
            'background':'#3399FF', 
            'color':'#FFF'
        });
    else
        
        $("#opCargoPad"+i).css({
            'background':'#FFF', 
            'color':'#6D6D6D'
        });
       
}
function mostrarSeleccionado(idseleccion)
{
    alert("de el select " +idseleccion+'se ha seleccionado el item >>> '+$('#'+idseleccion+' :selected').val());
}
function limpiarDatos_Dialog()
{
    estilo_borrado={
        'border':'1px solid #c0c0c0',
        'background-color':'#fff'
    }
    
    $('#ci_empleado').val('');
    $('#ci_empleado').css(estilo_borrado);
     
    $('#nombre_empleado').val('');
    $('#nombre_empleado').css(estilo_borrado);
        
    $('#proyecto_empleado').val('');
    $('#proyecto_empleado').css(estilo_borrado);
    // $('#superiorImediato> option[value="'+resp[4]+'"]').attr('selected', 'selected');
    $('#regional> option[value="0"]').attr('selected', 'selected');
    $('#regional').css(estilo_borrado);
    //$('#cargos> option[value="'+resp[6]+'"]').attr('selected', 'selected');
    $('#depend').html("SI<input type='radio' name='dependiente'  value='1'> NO <input type='radio' name='dependiente' value='0'>");
    $('#depend').css({
        'border':'none', 
        'background-color':'#fff'
    });
 
    $('#Fecha_alta').val('');
    $('#Fecha_alta').css(estilo_borrado);
       
    $('#id_registro').val('');
       
    $('#comentario').val('');
    $('#comentario').css(estilo_borrado);
    $('#tiene_dependientes').html("<input type='hidden' id='tieneDependientes' value='no'>");
    
}
function obtenerDatosUsuario_JSON_p_edit(reg){
    limpiarDatos_Dialog();
    vector = new Array();
    baseurl=$("#burl").val();
    direccion=baseurl+'usuario/obtenerDatos_Admin_Proyecto'
    $.getJSON(direccion, {
        Nro_registro: reg
    }, function(resp) {
        //array($fila->ci, $fila->Nomcomp, $fila->proy, $fila->id_proy, $fila->id_padre,$fila->regional, $fila->cargo, $fila->es_padre, $fila->fecha_asignacion, $fila->idpk, $fila->codadm_pk);         
        //                 0               1                     2                    3                       4                5                      6                   7                      8                              9                   10
        $('#ci_empleado').val(resp[0]);
        $('#nombre_empleado').val(resp[1]);
        $('#proyecto_empleado').val(resp[2]);
        $('#superiorImediato> option[value="'+resp[4]+'"]').attr('selected', 'selected');
        $('#regional> option[value="'+resp[5]+'"]').attr('selected', 'selected');
        $('#cargos> option[value="'+resp[6]+'"]').attr('selected', 'selected');
        if(resp[7]==1)
            cod="SI<input type='radio' name='dependiente'  value='1' checked='checked'\n\
                        onclick='detectar_dependientes_usuario_JSON_p_edit("+resp[10]+","+resp[3]+")'    >\n\
                     NO <input type='radio' name='dependiente' value='0' \n\
                        onclick='detectar_dependientes_usuario_JSON_p_edit("+resp[10]+","+resp[3]+")'>\n\
                    ";
        else
            cod="SI<input type='radio' name='dependiente'  value='1' \n\
                        onclick='detectar_dependientes_usuario_JSON_p_edit("+resp[10]+","+resp[3]+")'    >\n\
                     NO <input type='radio' name='dependiente' value='0' checked='checked' \n\
                        onclick='detectar_dependientes_usuario_JSON_p_edit("+resp[10]+","+resp[3]+")'>\n\
                    ";
        $('#depend').html(cod);
        $('#Fecha_alta').val(resp[8]);
        $('#id_registro').val(resp[9]);
    });
}
//funcion que detecta si tiene dependientes y muestra formulario _en Dialog para saber que hacer con los dependientes
// darlos de baja o pasarlos al inmediato superior del modificado 
function cargar_formulario(tipo,id_jefe,id_employe,id_registro)
{
    baseurl=$("#burl").val();
    proy_sel=$("#proyecto :selected").val();
  // alert("proyecto seleccionado :"+proy_sel+$("#proyecto :selected").text()+", id_jefe :"+id_jefe+", id_employe : "+id_employe+"id_registro : "+id_registro);
    $.post(baseurl+"Arbol_de_dependientes/carga_formulariosVarios_formDialog",
    {
        'tipo':tipo,
        'proyecto':proy_sel,
        'nombre_proyecto':$("#proyecto :selected").text(),
        'id_jefe':id_jefe,
        'id_employe':id_employe,
        'id_registro':id_registro
    }
    ,function(data){
        $("#dialog-form").html(data);
    });
}

function detectar_dependientes_usuario_JSON_p_edit(usuarioX , id_proyecto)
{
    if($('input[name=dependiente]:checked').val()==0)
    {
        baseurl=$("#burl").val();
        direccion=baseurl+'usuario/obtener_dependientes_Directos'
        $.getJSON(direccion, {
            dependiente: usuarioX,
            proyecto:id_proyecto
        }, function(resp) {
            // la funcion devuelde un array de arrays  de este tipo array[1]['id_admin']=x,array[1]['nombre']=juanX;
            dependientes='';
            for(i=0;i<resp.length;i++)
            {//alert('ingresa a la function for i');
                dependientes+=(i+1)+' .- '+resp[i]['nombre']+'<br/>';   
            }
            if(dependientes!='')
            {
                codigo="<div class='grid_6 fondoplomoblanco bordeado1'>\n\
                                <div class='grid_6 NO negrilla' style='border:none;'><input type='hidden' id='tieneDependientes' value='si'>Atencion !!</div>\n\
                                <div class='grid_6 letrachica azulmarino'>Usted ha indicado que el usuario <span class='rojo'>NO TENGA PERSONAL DEPENDIENTE DE ÉL</span> pero, se ha detectado que el usuario tiene dependientes , seleccione una de las opciones  para el destino de los dependientes.</div>    \n\
                                <div class='prefix_1 grid_5 letrachica'>"+dependientes+"</div> \n\
                                <div class='grid_6 fondoplomoclaro' id='accion_dependientes'>\n\
                                    <div class='grid_5 letrachica alinearDerecha '>Mover los dependientes al inmediato superior</div>\n\
                                    <div class='grid_1'><input type='radio' name='acciondependientes' value='1' > </div>\n\
                                    <div class='grid_5 letrachica alinearDerecha '>Dar de baja en el proyecto a los dependietes y sus dependientes </div>\n\
                                    <div class='grid_1 '> <input type='radio' name='acciondependientes' value='0' > </div> \n\
                                </div>\n\
                            </div>"
            }
            else
                codigo="<input type='hidden' id='tieneDependientes' value='no'>";
        
            $('#tiene_dependientes').html(codigo);
        });
    }
    else{
        $('#tiene_dependientes').html(' ');
    }
}
//function que obtine los datos y los muestra
function obtiene_datos_fecha_especifica()
{
    if($('#fechaJustificacion').val()!='')
    {
        baseurl=$("#burl").val();
        
        $.post(baseurl+"justificacion_marcado/obtener_informacion_fecha_justificar", {
            'fecha_justificar':$('#fechaJustificacion').val()
        } ,function(data){
            $("#datos_fecha_especifica").html(data);
        });
    }
}

function Dialog_ModPersonalProyecto(reg)
{
    baseurl=$("#burl").val();
    titulo='Modificaciones de Personal en el Proyecto';
    cargar_formulario('Modificar',0,0,reg);//tipo: Adicionar,Modificar,Baja,Historial
    // obtener_jefes_proyectos();
    //obtenerDatosUsuario_JSON_p_edit(reg);
    
    $( "#dialog-form" ).dialog({
        title:titulo,
        autoOpen: true,
        height: 700,
        width: 550,
        modal: true,
        buttons: {
            "Aceptar": function() {
                val =validarDialogForm_altaPers_proyecto();
                if(val==0){
                    if($('#cargos :selected').val()=="0otro0"){
                        cargo=$('#cargo_empleado_otro_campo').val();
                    }
                    else {
                        cargo=$('#cargos :selected').val();
                    }
                    if($('#tieneDependientes').val()=='si')
                        datos_envio={
                            'registro_editar':reg,
                            'cargoj':cargo,
                            'fecha_asignacionj':$('#Fecha_alta').val(),
                            'id_padrej':$('#superiorImediato :selected').val() ,
                            'regionalj':$('#regional :selected').val(),
                            'es_padrej':$('input[name=dependiente]:checked').val(),
                            'comentarioj':$('#comentario').val(),
                            'tiene_dependientesj':$('#tieneDependientes').val(),
                            'solucion_dependientes':$('input[name=acciondependientes]:checked').val()
                        };
                    else
                        datos_envio={
                            'registro_editar':reg,
                            'cargoj':cargo,
                            'fecha_asignacionj':$('#Fecha_alta').val(),
                            'id_padrej':$('#superiorImediato :selected').val() ,
                            'regionalj':$('#regional :selected').val(),
                            'es_padrej':$('input[name=dependiente]:checked').val(),
                            'comentarioj':$('#comentario').val(),
                            'tiene_dependientesj':'no',
                            'solucion_dependientes':'ninguna'
                        };
                    
                    $.post(baseurl+"Arbol_de_dependientes/editar_registro_de_personal_proyecto_cargo",datos_envio ,function(data){
                        //   $("#div_form_adicion_edicion").html(data)
                        alert('se ha procedido a modificar los datos del registro');
                    });
                    //hasta aqui se adiciona y se busca
                    $( this ).dialog( "close" );
                   
                    setTimeout(function(){
                        //muestra_arbol_dependientes_de_proyecto_seleccionado();
                       // window.location = baseurl+"arbol_de_dependientes/mostrar_arbolDependientes";
                        location.reload();
                    }, 2000);
                }
            },
            "Cancelar": function() {
               
                $( this ).dialog( "close" );
            }
        }
    });
    
    
    
}
function Dialog_BajaPersonalProyecto(reg)
{
    baseurl=$("#burl").val();
    titulo='Baja de Personal en el Proyecto';
    cargar_formulario('Baja',0,0,reg);//tipo: Adicionar,Modificar,Baja,Historial
    
    $( "#dialog-form" ).dialog({
        title:titulo,
        autoOpen: true,
        height: 700,
        width: 550,
        modal: true,
        buttons: {
            "Aceptar": function() {
                val = validarDialogForm_BajaPers_proyecto();
                if(val==0){
                    datos_envio={
                        'registro_editar':reg,
                        'fecha_bajaj':$('#Fecha_baja').val(),
                        'comentarioj':$('#comentario').val(),
                        'solucion_dependientes':$('input[name=acciondependientes]:checked').val()
                    };
                    $.post(baseurl+"Arbol_de_dependientes/Baja_registro_de_personal_proyecto_cargo",datos_envio ,function(data){
                        //   $("#div_form_adicion_edicion").html(data)
                        alert('se ha procedido a dar baja a los datos del registro');
                    });
                    //hasta aqui se adiciona y se busca
                    $( this ).dialog( "close" );
                   
                    setTimeout(function(){
                        //muestra_arbol_dependientes_de_proyecto_seleccionado();
                       // window.location = baseurl+"arbol_de_dependientes/mostrar_arbolDependientes";
                       location.reload();
                    }, 2000);
                }
            },
            "Cancelar": function() {
               
                $( this ).dialog( "close" );
            }
        }
    });
    
    
    
}
function Dialog_historialPersonalProyecto(reg)
{
    baseurl=$("#burl").val();
    titulo='Historial de Personal en el Proyecto';
    cargar_formulario('Historial',0,0,reg);//tipo: Adicionar,Modificar,Baja,Historial
    
    $( "#dialog-form" ).dialog({
        title:titulo,
        autoOpen: true,
        height: 700,
        width: 550,
        modal: true,
  
        buttons: {
            "Cerrar": function() {
               
                $( this ).dialog( "close" );
            }
        }
    });
    
    
    
}
function Dialog_permisos_personal(reg)
{
    baseurl=$("#burl").val();
    titulo='Permisos de Personal en el Proyecto';
    cargar_formulario('Permisos',0,0,reg);//tipo: Adicionar,Modificar,Baja,Historial,Permisos
    
    $( "#dialog-form" ).dialog({
        title:titulo,
        autoOpen: true,
         height: 700,
        width: 550,
        modal: true,
     
        buttons: {
            "Guardar" : function(){
                datos_envio={
                    'id_registro':reg,
                    'p_vac_per':$('input[name=pbandeja_vacaciones]:checked').val(),
                    'p_jus':$('input[name=pbandeja_justificacion]:checked').val(),
                    'p_baj_med':$('input[name=pbandeja_baja_medica]:checked').val(),
                    'p_rev_rend':$('input[name=prev_rend]:checked').val(),
                    'env_a':$('input[name=env_rend]:checked').val(),
                    'p_adicionar':$('input[name=parbol_adicionar]:checked').val(),
                    'p_baja':$('input[name=parbol_baja]:checked').val(),
                    'p_editar':$('input[name=parbol_editar]:checked').val(),
                    'p_ver_historial':$('input[name=parbol_historial]:checked').val(),
                    'p_otorgar_permisos':$('input[name=parbol_permisos]:checked').val(),
                    'pp_vac_per':$('input[name=ppp_vac_per]:checked').val(),
                    'pp_jus':$('input[name=ppp_jus]:checked').val(),
                    'pp_baj_med':$('input[name=ppp_baj_med]:checked').val(),
                    'pp_add':$('input[name=ppp_add]:checked').val(),
                    'pp_ba':$('input[name=ppp_baj]:checked').val(),
                    'pp_edit':$('input[name=ppp_edit]:checked').val(),
                    'pp_hist':$('input[name=ppp_hist]:checked').val(),
                    'pp_perm':$('input[name=ppp_perm]:checked').val()
                };
                $.post(baseurl+"Arbol_de_dependientes/editar_permisos_de_personal_proyecto_cargo",datos_envio ,function(data){
                    //   $("#div_form_adicion_edicion").html(data)
                    alert('se ha procedido a modificar los permisos del registro');
                });
                $( this ).dialog( "close" );
                   
                setTimeout(function(){
                    //muestra_arbol_dependientes_de_proyecto_seleccionado();
                    //window.location = baseurl+"arbol_de_dependientes/mostrar_arbolDependientes";
                    location.reload();
                }, 2000);
            },
            "Cerrar": function() {
                $( this ).dialog( "close" );
            }
           
        }
    });
    
    
    
}
function Dialog_altaPersonalProyecto(indice)
{
    baseurl=$("#burl").val();
    titulo='Alta de Personal en el Proyecto';
    
    cargar_formulario('Adicionar',0,indice);//tipo: Adicionar,Modificar,Baja,Historial
    
    //indiceS=indice.toString(); 
    //obtener_jefes_proyectos();
    //recupera datos en variables para utilizarlos
    // nombrecompleto=$('#nombreResultado'+indice).val();
    //ci=$('#CiResultado'+indice).val();
    proyecto=$('#proyecto :selected').text();
    id_proyecto=$('#proyecto :selected').val();
    //escribe los datos para su visualizacio en pantalla
    // $('#ci_empleado').val(ci);
    /* $('#ci_empleado').attr({
        'readonly':'readonly'
    });*/
    //$('#nombre_empleado').val(nombrecompleto);
    // $('#proyecto_empleado').val(proyecto);
    $('#id_empleado').val(indice);
    
    $( "#dialog-form" ).dialog({
        title:titulo,
        autoOpen: true,
       height: 700,
        width: 550,
        modal: true,
        buttons: {
            "Aceptar": function() {
                val =validarDialogForm_altaPers_proyecto();
                if(val==0)
                {
                    if($('#cargos :selected').val()=="0otro0"){
                        cargo=$('#cargo_empleado_otro_campo').val();
                    //       alert('el cargo que se esta colocando es '+cargo);
                    }
                    else
                    {
                        cargo=$('#cargos :selected').val();
                    //      alert('el cargo que se esta colocando es '+cargo);
                    }
                    // alert('cargo:'+cargo+',fecalta:'+$('#Fecha_alta').val()+', superiorInmediato:'+$('#superiorImediato :selected').text() +',regional:'+$('#regional :selected').text()+',espadre:'+$('input[name=dependiente]:checked').val() );
                    $.post(baseurl+"Arbol_de_dependientes/adicionar_nuevo_registro_de_alta_personal",
                    {
                        'id_adminj':indice,
                        'id_proyj':id_proyecto,
                        'cargoj':cargo,
                        'fecha_asignacionj':$('#Fecha_alta').val(),
                        'id_padrej':$('#superiorImediato :selected').val() ,
                        'regionalj':$('#regional :selected').val(),
                        'es_padrej':$('input[name=dependiente]:checked').val() ,
                        'comentarioj':$('#comentario').val()
                    }
                    ,function(data){
                        //   $("#div_form_adicion_edicion").html(data)
                        alert('se ha procedido con el alta del personal');
                    });
                    //hasta aqui se adiciona y se busca
                    $( this ).dialog( "close" );
                    limpiarDatos_Dialog();
                    setTimeout(function(){
                        muestra_arbol_dependientes_de_proyecto_seleccionado();
                        buscar_personal_en_todo();
                        
                    }, 2000);
                }
            },
            "Cancelar": function() {
               // alert("se cerro")
                $( this ).dialog( "close" );
            }
        }
    });
}
function Dialog_altaPersonalProyecto_jefeDirecto(id_jefe)
{
    baseurl=$("#burl").val();
    titulo='Alta de Personal en el Proyecto';
    cargar_formulario('Adicionar',id_jefe);//tipo: Adicionar,Modificar,Baja,Historial
    $('#ci_empleado').removeAttr('readonly');
    // alert('se ha cambiado el atributo readonly ')
    //indiceS=indice.toString(); 
    //obtener_jefes_proyectos(id_jefe);// modificar para que solo aparesca un solo jefe en esta funcion con el id Jefe introducido
    //recupera datos en variables para utilizarlos
    proyecto=$('#proyecto :selected').text();
    id_proyecto=$('#proyecto :selected').val();
    //escribe los datos para su visualizacio en pantalla
    //limpiarDatos_Dialog();
    // $('#id_registro').val('');
    // $('#id_empleado').val('');
    // $('#ci_empleado').val('');
  
   
    
    //  $('#nombre_empleado').val('');
    $('#proyecto_empleado').val(proyecto);
    
    
    $( "#dialog-form" ).dialog({
        title:titulo,
        autoOpen: true,
        height: 700,
        width: 550,
        modal: true,
        buttons: {
            "Aceptar": function() {
                val =validarDialogForm_altaPers_proyecto();
                if(val==0)
                {
                    if($('#cargos :selected').val()=="0otro0"){
                        cargo=$('#cargo_empleado_otro_campo').val();
                    //       alert('el cargo que se esta colocando es '+cargo);
                    }
                    else
                    {
                        cargo=$('#cargos :selected').val();
                    //      alert('el cargo que se esta colocando es '+cargo);
                    }
                    // alert('cargo:'+cargo+',fecalta:'+$('#Fecha_alta').val()+', superiorInmediato:'+$('#superiorImediato :selected').text() +',regional:'+$('#regional :selected').text()+',espadre:'+$('input[name=dependiente]:checked').val() );
                    $.post(baseurl+"Arbol_de_dependientes/adicionar_nuevo_registro_de_alta_personal",
                    {
                        'id_adminj':$('#id_empleado').val(),
                        'id_proyj':id_proyecto,
                        'cargoj':cargo,
                        'fecha_asignacionj':$('#Fecha_alta').val(),
                        'id_padrej':$('#superiorImediato :selected').val() ,
                        'regionalj':$('#regional :selected').val(),
                        'es_padrej':$('input[name=dependiente]:checked').val() ,
                        'comentarioj':$('#comentario').val()
                    }
                    ,function(data){
                        //   $("#div_form_adicion_edicion").html(data)
                        alert('se ha procedido con el alta del personal');
                    });
                    //hasta aqui se adiciona y se busca
                    $( this ).dialog( "close" );
                    limpiarDatos_Dialog();
                    setTimeout(function(){
                        muestra_arbol_dependientes_de_proyecto_seleccionado();
                        buscar_personal_en_todo();
                    }, 2000);
                }
            },
            "Cancelar": function() {
             //   alert("se cerro")
                $( this ).dialog( "close" );
            }
        }
    });
}


function validarDialogForm_altaPers_proyecto()// esta funcion valida el formulario generado por la funcion Dialog_altaPersonalProyecto
{
    estiloError={
        'border': 'solid 1px #E47474',
        'background':'#FFCDCE'
    };
    estiloSinError={
        'border': 'solid 1px #7BA17B',
        'background':'#C3F9CC'
        
    };
    vectorError1="<div Class='letrachica grid_5_5 negrilla '>ATENCION !!!  se produjeron los siguientes errores</div>";
    vectorError="";
    i=1;
    sw=1;
    
    if($('#id_empleado').val()<=0)
    {
        vectorError+="<div class='grid_5_5 letrachica'>"+i+".- Error en usuario</div>";
        i++;
        $('#nombre_empleado').css(estiloError);
        sw=0;
    }
    else
        $('#nombre_empleado').css(estiloSinError);    
        
        
    if($('#proyecto_empleado').val()=="Seleccione un proyecto")
    {
        vectorError+="<div class='grid_5_5 letrachica'>"+i+".- Debe Seleccionar un proyecto de la Lista</div>";
        i++;
        $('#proyecto_empleado').css(estiloError);
        sw=0;
    }
    else
        $('#proyecto_empleado').css(estiloSinError);    
        
    if(sw==1){
        if($('#proyecto_empleado').val()=="")
        {
            vectorError+="<div class='grid_5_5 letrachica'>"+i+".- Ha ocurrido un error, los proyectos no han sido cargados , conactese con el admiistrador del sistema</div>";
            i++;
            $('#proyecto_empleado').css(estiloError);
        }
        else
            $('#proyecto_empleado').css(estiloSinError);
    }
   
    // alert('valor de check SI 1 , No 0 >>>> '+ $('input[name=dependiente]:checked').val());
    if($('#regional :selected').val()=="0")
    {
        vectorError+="<div class='grid_5_5 letrachica'>"+i+".- Debe Seleccionar la regional en la cual trabajara el Personal</div>";
        i++;
        $('#regional').css(estiloError);
    }
    else
        $('#regional').css(estiloSinError);
          
    if($('#cargos :selected').val()=="0otro0")
    {
        //alert('dato del cargoempleado >>> '+$('#cargo_empleado_otro_campo').val()+', cantidad >>'+$('#cargo_empleado_otro_campo').val().length);
        if($('#cargo_empleado_otro_campo').val().length<=5)
        {
            vectorError+="<div class='grid_5_5 letrachica'>"+i+".- Debe escribir el nuevo Cargo (minimo 6 caracteres)</div>";
            i++;
            $('#cargo_empleado_otro_campo').css(estiloError);
        }
        else
            $('#cargo_empleado_otro_campo').css(estiloSinError);
    }
 
    if($('input[name=dependiente]:checked').val()!='1' && $('input[name=dependiente]:checked').val()!='0' )
    {
        vectorError+="<div class='grid_5_5 letrachica'>"+i+".- Debe seleccionar si el personal tendra dependientes a su cargo</div>";
        i++;
        $('#depend').css(estiloError);
    }
    else
        $('#depend').css(estiloSinError);
          
   
    if($('#Fecha_alta').val()=="")
    {
        vectorError+="<div class='grid_5_5 letrachica '>"+i+".- Debe Colocar una fecha de Alta en su proyecto</div>";
        i++;
        $('#Fecha_alta').css(estiloError);
    }
    else
        $('#Fecha_alta').css(estiloSinError);
          
    //valida para la edicion de registros , si cambia el si tendra dependientes a NO y tiene dependientes  la accion para los dependientes que estan en el aire
    if($('#tieneDependientes').val()=='si')
    {
        if($('input[name=acciondependientes]:checked').val()!='1'&& $('input[name=acciondependientes]:checked').val()!='0' )
        {
            vectorError+="<div class='grid_5_5 letrachica'>"+i+".- Debe seleccionar alguna de las acciones para los dependientes del personal</div>";
            i++;
            $('#accion_dependientes').css(estiloError);
        }
        else
            $('#accion_dependientes').css(estiloSinError);
           
    }
    if($('#comentario').val()=="")
    {
        vectorError+="<div class='grid_5_5 letrachica '>"+i+".- por favor describa las actividades que realizara el personal</div>";
        i++;
        $('#comentario').css(estiloError);
    }
    else
        $('#comentario').css(estiloSinError);
   
   
    if(i!=1){
        vectorError= vectorError1+vectorError;
        $('#error_de_formulario').html(vectorError);
        $('#error_de_formulario').css({
            'display':'block'
        });
    }
    else
        $('#error_de_formulario').css({
            'display':'none'
        });
    if(i!=1)
        return(1);
    else
        return(0);
}

function validarDialogForm_BajaPers_proyecto()
{
    estiloError={
        'border': 'solid 1px #E47474',
        'background':'#FFCDCE'
    };
    estiloSinError={
        'border': 'solid 1px #7BA17B',
        'background':'#C3F9CC'
        
    };
    vectorError1="<div Class='letrachica grid_5_5 negrilla '>ATENCION !!!  se produjeron los siguientes errores</div>";
    vectorError="";
    i=1;
    sw=1;
    
    if($('#id_registro').val=="")
    {
        vectorError+="<div class='grid_5_5 letrachica'>"+i+".- Ha sucedido un error en la carga del registro , cierre y vuelva a intentarlo.</div>";
        i++;
        //$('#nombre_empleado').css(estiloError);
        sw=0;
    }
    if($('#id_empleado').val=="")
    {
        vectorError+="<div class='grid_5_5 letrachica'>"+i+".- Ha sucedido un error en la carga del registro , cierre y vuelva a intentarlo.</div>";
        i++;
        //$('#nombre_empleado').css(estiloError);
        sw=0;
    }
    
    if($('#Fecha_baja').val()=="")
    {
        vectorError+="<div class='grid_5_5 letrachica '>"+i+".- Debe Colocar una fecha de baja en su proyecto</div>";
        i++;
        $('#Fecha_baja').css(estiloError);
    }
    else
        $('#Fecha_baja').css(estiloSinError);
          
    if($('input[name=acciondependientes]:checked').val()!='1'&& $('input[name=acciondependientes]:checked').val()!='0' )
    {
        vectorError+="<div class='grid_5_5 letrachica'>"+i+".- Debe seleccionar alguna de las acciones para los dependientes del personal</div>";
        i++;
        $('#accion_dependientes').css(estiloError);
    }
    else
        $('#accion_dependientes').css(estiloSinError);
    if($('#comentario').val()=="")
    {
        vectorError+="<div class='grid_5_5 letrachica '>"+i+".- por favor describa las actividades que realizara el personal</div>";
        i++;
        $('#comentario').css(estiloError);
    }
    else
        $('#comentario').css(estiloSinError);
   
   
    if(i!=1){
        vectorError= vectorError1+vectorError;
        $('#error_de_formulario').html(vectorError);
        $('#error_de_formulario').css({
            'display':'block'
        });
    }else
        $('#error_de_formulario').css({
            'display':'none'
        });
    if(i!=1)
        return(1);
    else
        return(0);
    
}

function limitecaracter(textarea,cant)
{
    if($('#'+textarea).val().length>cant)
    {  
        $('#'+textarea).val($('#'+textarea).val().substring(0,cant));
    }
    ncar=cant-$('#'+textarea).val().length;
    $('#'+textarea+'ref').html('<div>disponibles ,'+ncar+' caracteres</div>');
    
}
function muestra_arbol_dependientes_de_proyecto_seleccionado()
{
    baseurl=$("#burl").val();
    id_proyecto=$('#proyecto :selected').val();
   
    $.post(baseurl+"Arbol_de_dependientes/mostrararboldeproyectoIndicado",
    {
        'id_proyecto':id_proyecto
                        
    }
    ,function(data){
        $("#arbol_dependientes_div_treeView").html(data);
       
    });
    
}
function BuscarUsuario(campo_busqueda,campo_dev_nom,campo_dev_ci)
{
    baseurl=$("#burl").val();
    direccion=baseurl+'usuario/buscarusuarioporci'
    if($('#'+campo_busqueda).val().length>5){
        $.getJSON(direccion, {
            ci: $('#'+campo_busqueda).val()
        }, function(resp) {
            if(resp[0]==0)
            {
                $('#error_de_formulario').html("<div Class='letrachica grid_5_5 negrilla '>ATENCION !!!  se produjeron los siguientes errores</div>\n\
                                                                <div Class='letrachica grid_5_5 '>NO SE HA ENCONTRADO ningun resultado, verifique que el nro CI, ingresado es correcto</div>");
                $('#error_de_formulario').css({
                    'display':'block'
                });
            }
            if(resp[0]==-1)
            {
                $('#error_de_formulario').html("<div Class='letrachica grid_5_5 negrilla '>ATENCION !!!  se produjeron los siguientes errores</div>\n\
                                                                <div Class='letrachica grid_5_5 '>El personal se encuentra en OTRO PROYECTO, para dar de alta a este empleado, su proyecto actual debe darle de Baja </div>");
                $('#error_de_formulario').css({
                    'display':'block'
                });
            }
            if(resp[0]>0)
                $('#error_de_formulario').css({
                    'display':'none'
                });
            
            $('#'+campo_dev_ci).val(resp[0]);
            $('#'+campo_dev_nom).val(resp[1]);
        });
    }
   
}
//functiones de justificacione
function enableTime(id_campo,campocondicion)
{
    // alert ("ingresa a la functio");
    if($('#'+campocondicion).val()!="")
    {
        $('#'+id_campo+'H').removeAttr('disabled');
        $('#'+id_campo+'M').removeAttr('disabled');
        
        if(campocondicion=='fecha_inicio_p') 
        {
            $("#fecha_fin_p").removeAttr('disabled');
            $("#fecha_fin_p").datepicker("option", "minDate", $('#'+campocondicion).val());
            if($("#fecha_fin_p").val()=="")
                $("#fecha_fin_p").val($("#fecha_inicio_p").val());
            enable_hora();
            enableTime('horafin',"fecha_fin_p");
                 
            p = new Date(Date.parse($("#fecha_inicio_p").val()) + (604800000*10));
            newdate = p.getFullYear()+ "/" +p.getMonth()+1 + "/" + p.getDate() ;

            $("#fecha_fin_p").datepicker("option", 'maxDate', newdate); 
        }
        else
        {
            enable_hora();
        }
    }
    else
    {
        $('#'+id_campo+'H').attr({
            'disabled':'true'
        });
        $('#'+id_campo+'M').attr({
            'disabled':'true'
        });
        $('#'+id_campo+'M').attr({
            'disabled':'true'
        });
        $("#fecha_fin_p").datepicker("option", "minDate", "");
        
    }
  
        
}

//function que devuelve JSON con las fechas del usuario y del sistema
function json_obtener_fechas(tipo,anio)
{
    baseurl=$("#burl").val();
    direccion=baseurl+'justificacion_marcado/obtener_fechas_solicitadas'
    resultado=new Array();
    $.getJSON(direccion, {
        tipo: tipo,
        anio:anio
    }, function(resp) {
        j=0;
        //alert('el tamaño del vector es '+resp.length);
        for(i=0;i<resp.length*2; i=i+2)
        {   
            resultado[i]=resp[j]['fec'];
            resultado[i+1]=resp[j]['tit'];
            j++;
        // alert(resultado[i]+' es '+resultado[i+1]);
        }
        alert('tamaño '+resultado.length)
        return(resultado);
    });
    
}

function obtener_fechas_de_bloqueo(){
    baseurl=$("#burl").val();
    direccion=baseurl+'justificacion_marcado/obtener_fechas_bloqueadas'
    //alert('ingresa a la funcion de cargar fechas boleadas '+ direccion);
    $.post(direccion,{}
        ,function(data){
            $("#fechas_boqueadas").html(data);
       
        });
}
function bloquear_fechas(fecha,fin_de_semana,vacaciones_user,feriados,viaticos_user)
{
    
    //alert('ingresa a la funcion con' +fecha);
    var vacaciones=$("#jusfec").val().split(',');
    var viaticos=$("#viaticosfec").val().split(',');
    var feriado=$("#feriadofec").val().split(',');              
    
    estilo="";
    titulo="";                                
    var current = $.datepicker.formatDate('yy-mm-dd', fecha);
    var fec = new Date(current);
    //current=fec;
    alert(fec);
    if(fin_de_semana &&(fec.getDay()==5 || fec.getDay()==6))
    {
        estilo="ui-state-disabled ui-datepicker-unselectable";
        titulo="fin de Semana"
    }
                            
    if(vacaciones_user && $.inArray(current, vacaciones) != -1) {
        estilo="ui-state-vacacion ui-datepicker-unselectable";
        titulo=vacaciones[$.inArray(current, vacaciones)+1];
    }
   
    if(feriados && $.inArray(current, feriado)!= -1) {
        estilo="ui-state-hover ui-datepicker-unselectable";
        titulo=feriado[$.inArray(current, feriado)+1];
    }
    if(viaticos_user && $.inArray(current, viaticos) != -1) {
        estilo="ui-state-viatico ui-datepicker-unselectable";
        titulo+=viaticos[$.inArray(current, viaticos)+1];
    }
    return([true, estilo,titulo]);
}
function enable_hora()
{   
    if( $("#fecha_fin_p").val()== $("#fecha_inicio_p").val())
    {
        for(i=0;i<24;i++)
        {
            c='0';
            if(i>9)
                c='';
            //alert("condicion -- "+$("#horainicioH").val()+" > "+$('#horafinH option[value="'+c+i+'"]').val());
            if($("#horainicioH").val()>=$('#horafinH option[value="'+c+i+'"]').val())
            {
                $('#horafinH option[value="'+c+i+'"]').attr({
                    'disabled':'true'
                });
                //   alert('inhabilitado '+i);
                sw=0;
            }
            else
            {
                if(sw==0)
                {
                    //alert("condicion ==> "+$("#horainicioH").val()+"<="+$('#horafinH :selected').val()+" >>");
                    if($("#horainicioH").val()>=$("#horafinH :selected").val())
                        $('#horafinH option[value="'+c+i+'"]').attr("selected",true);
                    sw=1;
                }
                $('#horafinH option[value="'+c+i+'"]').removeAttr('disabled');
            //   alert('habilitado'+i);
            }
        }
    }
    else
    {
        for(i=0;i<24;i++)
        {
            c='0';
            if(i>9)
                c='';
            $('#horafinH option[value="'+c+i+'"]').removeAttr('disabled');
        //   alert('habilitado'+i);
        }
    }
}

function cargar_formularios_justificacion(ventana)
{
    baseurl=$("#burl").val();
    direccion="";
    if(ventana==1)
    { 
        direccion=baseurl+"justificacion_marcado/form_nueva_justificacion";
    }
    // alert(direccion);
    $.post(direccion, {} ,function(data){
        $("#ventana_modal_contenedor_contenidos").html(data);
    });
}

function mostrarseguncambios()
{
    //alert("switch :"+$('#tipo_jp :selected').val());
    switch ($('#tipo_jp :selected').val()) 
    {
        case "justificacion":
            $("#div_datosVacacion").css({
                'display':'none'
            });
            $("#div_licencia").css({
                'display':'none'
            });
            $("#titulo_comentario").removeAttr('disabled');
            $("#fecha_div").css({
                'display':'block'
            });
            $("#rangoFechas_div").css({
                'display':'none'
            });
            $("#respaldo_div").css({
                'display':'block'
            });
            //$("#mensaje_respaldo").html('OBLIGATORIO');
            $("#justificacion_div").css({
                'display':'block'
            });
            $("#boton_guardar").css({
                'display':'block'
            });
            //alert('ingresa a justificacion'+$('#tipo_jp :selected').val());
            break
        case "Permiso Vacacion":
            $("#div_datosVacacion").css({
                'display':'block'
            });
            $("#div_licencia").css({
                'display':'none'
            });
            $("#titulo_comentario").removeAttr('disabled');
            $("#fecha_div").css({
                'display':'none'
            });
            $("#rangoFechas_div").css({
                'display':'block'
            });
            $("#respaldo_div").css({
                'display':'none'
            });
            // $("#mensaje_respaldo").html('OPCIONAL');
            $("#justificacion_div").css({
                'display':'block'
            });
            $("#boton_guardar").css({
                'display':'block'
            });
            // alert('ingresa a Permiso '+$('#tipo_jp :selected').val());
            break
        case "Baja Medica":
            $("#div_datosVacacion").css({
                'display':'none'
            });
            $("#div_licencia").css({
                'display':'none'
            });
            $("#titulo_comentario").removeAttr('disabled');
            $("#fecha_div").css({
                'display':'none'
            });
            $("#rangoFechas_div").css({
                'display':'block'
            });
            $("#respaldo_div").css({
                'display':'block'
            });
            // $("#mensaje_respaldo").html('OBLIGATORIO');
            $("#justificacion_div").css({
                'display':'block'
            });
            $("#boton_guardar").css({
                'display':'block'
            });
            // alert('ingresa a Baja Media '+$('#tipo_jp :selected').val());
            break
        case "Licencia":
            
            $("#div_datosVacacion").css({
                'display':'none'
            });
            $("#div_licencia").css({
                'display':'block'
            });
            $('#comentario_justificacion').attr({
                "placeholder":"Nota. \n En todos los casos solo familiares de 1° grado"
            })
            $("#titulo_comentario").attr({
                "disabled":"true"
            });
            $("#fecha_div").css({
                'display':'none'
            });
            $("#rangoFechas_div").css({
                'display':'none'
            });
            $("#respaldo_div").css({
                'display':'none'
            });
            // $("#mensaje_respaldo").html('OPCIONAL');
            $("#justificacion_div").css({
                'display':'block'
            });  
            $("#boton_guardar").css({
                'display':'block'
            });
            //  alert('ingresa a Vacaciones '+$('#tipo_jp :selected').val());
            break
        default:
            $("#div_datosVacacion").css({
                'display':'none'
            });
            $("#div_licencia").css({
                'display':'none'
            });
            $("#titulo_comentario").removeAttr('disabled');
            $("#fecha_div").css({
                'display':'none'
            });
            $("#rangoFechas_div").css({
                'display':'none'
            });
            $("#respaldo_div").css({
                'display':'none'
            });
            // $("#mensaje_respaldo").html('OBLIGATORIO');
            $("#justificacion_div").css({
                'display':'none'
            });
            $("#boton_guardar").css({
                'display':'none'
            });
    // alert('ingresa a default '+$('#tipo_jp :selected').val());
        
    } 
}

function mostrarDependientes(baseurl,i,cod_padre,sw, destino,b)
{
    if(b==0)
    {
        $("#"+destino+i).css('display','block');
        $("#abajo"+i).css('display',"none");
        $("#arriba"+i).css('display','block');
        $.post(baseurl+'Arbol_de_dependientes/listar_dependientes',
        {
            'padre':cod_padre
        } , function(data) {
            $("#"+destino+i).html(data)
        });
    }
    else
    {
        $("#"+destino+i).css('display','none');
        $("#abajo"+i).css('display','block');
        $("#arriba"+i).css('display','none');
    }   
}

function sumar_dias_fecha(fec,days)
{
    milisegundos=parseInt(35*24*60*60*1000); 
    fecha=new Date(fec); 
    day=fecha.getDate(); 
    // el mes es devuelto entre 0 y 11
    month=fecha.getMonth()+1;
    year=fecha.getFullYear();
    //  alert("Fecha actual: "+year+"/"+month+"/"+day); 
    //Obtenemos los milisegundos desde media noche del 1/1/1970 
    tiempo=fecha.getTime(); //Calculamos los milisegundos sobre la fecha que hay que sumar o restar... 
    milisegundos=parseInt(days*24*60*60*1000); //Modificamos la fecha actual 
    total=fecha.setTime(tiempo+milisegundos);
    day=fecha.getDate();
    month=fecha.getMonth()+1; 
    year=fecha.getFullYear();
    
    if(month<10)
        mes="0"+month;
    else
        mes=month;
    if(day<10)
        dia="0"+day;
    else
        dia=day;
    ////alert("Fecha modificada: "+year+"/"+mes+"/"+dia); 
    return(year+"/"+mes+"/"+dia);
}
function cadena_rango_fechas()
{
    var Fi=$("#fecha_inicio_p").val();
    var Ff=$("#fecha_fin_p").val();
    FiC=Fi;
    cadenafecha="";
    cadenafecha_fds="";
  
    if(Fi==Ff)
    {
        a=new Date(Fi).getDay();
        cadenafecha+=Fi.replace("/","-").replace("/","-")+",";
        if(a==6 ||a ==0)
            cadenafecha_fds+=FiC.replace("/","-").replace("/","-")+",";
    }    
    else
    {
        
        while(Ff!=FiC)
        {
            a=new Date(FiC).getDay();
            
            if(a==6 ||a ==0)
                cadenafecha_fds+=FiC.replace("/","-").replace("/","-")+",";
            cadenafecha+=FiC.replace("/","-").replace("/","-")+",";
            FiC=sumar_dias_fecha(FiC,1);
            
        }
        a=new Date(Ff).getDay();
        if(a==6 ||a ==0)
            cadenafecha_fds+=FiC.replace("/","-").replace("/","-")+",";
        cadenafecha+=Ff.replace("/","-").replace("/","-")+",";
    //cadenafecha+=FiC.replace("/","-").replace("/","-")+",";
    }
     
    $("#fechassolicitado").val(cadenafecha);
    $("#fechas_fds").val(cadenafecha_fds);
            
    
    
    
}
function diferencia_fechas(campo_f1,campo_f2) {
    var d1 = campo_f1.split("/");
    var dat1 = new Date(d1[0], parseFloat(d1[1])-1, parseFloat(d1[2]));
    var d2 = campo_f2.split("/");
    var dat2 = new Date(d2[0], parseFloat(d2[1])-1, parseFloat(d2[2]));
    //alert(d1[2]+"-"+d1[1]+"-"+d1[0]+"-------"+d2[2]+"-"+d2[1]+"-"+d2[0]);
    var fin = dat2.getTime() - dat1.getTime();
    var dias = Math.floor(fin / (1000 * 60 * 60 * 24))
    // alert("los dias debueltos son "+dias)
    return dias;
}
function diferencia_horas(campo_h1,campo_h2) {
    var d1 = campo_h1.split(":");
    var dat1 = new Date(0000,00,00,d1[0],d1[1]);
    var d2 = campo_h2.split(":");
    var dat2 = new Date(0000,00,00,d2[0],d2[1]);
   
 
    var fin = dat2.getTime() - dat1.getTime();
    var horas = (fin / (1000 * 60 * 60 ))//Math.floor()
    //alert("las horas de diferencia son:"+horas);
    //alert(d1[0]+":"+d1[1]+"-"+d2[0]+":"+d2[1]+"="+horas+" h");
    return horas;
}

function calcular_horas_de_justificacion()
{
    this.cadena_rango_fechas();
    var Fi=$("#fecha_inicio_p").val();
    var Ff=$("#fecha_fin_p").val();
    var Hi=$("#horainicioH :selected").val()+":"+$("#horainicioM :selected").val();
    var Hf=$("#horafinH :selected").val()+":"+$("#horafinM :selected").val();
    //las horas seran convertidas a formato 24Hr militar 08:00 ==> 800 
    
    if(diferencia_fechas(Fi,Ff)==0)//si las fechas son iguales
    {
        if(diferencia_horas(Hi,"12:30")>=0)
        {
            if(diferencia_horas(Hf,"12:30")>=0)
                t=diferencia_horas(Hi,Hf);
            else
            {
                if(diferencia_horas(Hf,"14:30")>0)
                    t=diferencia_horas(Hi,"12:30");
                else
                {
                    if(diferencia_horas(Hf,"18:30")>=0)                    
                        t=diferencia_horas(Hi,Hf)-2 ;  
                    else
                        t=diferencia_horas(Hi,"18:30")-2;
                }
                       
            }
        }
        else
        {
            $("#comentario_justificacion").val($("#comentario_justificacion").val()+ "Hora de inicio TARDE");
            if(diferencia_horas(Hi,"14:30")<=0)
            {
                $("#comentario_justificacion").val($("#comentario_justificacion").val()+ "VERDAD Dif("+Hi+",14:30)<=0 >>>"+diferencia_horas(Hi,"14:30"));      
                if(diferencia_horas(Hf,"18:30")<=0)
                    t=diferencia_horas(Hi,"18:30");
                else
                    t=diferencia_horas(Hi,Hf);
            }
            else            
            {
                $("#comentario_justificacion").val($("#comentario_justificacion").val()+ "FALSO Dif("+Hi+",14:30)<=0 >>>"+diferencia_horas(Hi,"14:30"));      
                if(diferencia_horas(Hf,"18:30")>=0)
                    t=diferencia_horas("14:30",Hf);
                else
                    t=diferencia_horas("14:30","18:30");
            }
        }
    }
    else //las fechas no son iguales
    {
        F=diferencia_fechas(Fi,Ff)-1;
        if(diferencia_horas(Hi,"14:30")<=0)
            ti=diferencia_horas(Hi,"18:30");
        else
        {
            if(diferencia_horas(Hi,"12:30")>=0)
                ti=diferencia_horas(Hi,"18:30")-2;
            else
                ti=diferencia_horas("14:30","18:30");
        }
        //ti : calculo de tiempo inicial
        if(diferencia_horas(Hf,"12:30")>=0)
            tf=diferencia_horas("08:30",Hf);
        else
        {
            if(diferencia_horas(Hf,"14:30")<=0)
            {
                if(diferencia_horas(Hf,"18:30")>=0)
                    tf=diferencia_horas("08:30",Hf)-2;
                else
                    tf=diferencia_horas("08:30","18:30")-2;
            }
            else
            {
                tf=diferencia_horas("08:30","12:30");       
            }
        }
        //alert("tiempo Inicial >>"+ti+",tiempo final >>" +tf+", Dias calculados >> "+F);
        t=F*8+ti+tf;
    }
    //buscar coiincidencias en viaticos,permisos anteriores, feriados y fines de semana
    var vacaciones=$("#jusfec").val().split(',');
    cvac=0;
    var viaticos=$("#viaticosfec").val().split(',');
    cvia=0;
    var feriado=$("#feriadofec").val().split(',');  
    cfer=0;
    var fds=$("#fechas_fds").val().split(',');  
    cfds=0;
    var solicitado=$("#fechassolicitado").val().split(',');  
    contFechas="";
    llave=1;
    for(i=0;i<solicitado.length-1;i++)
    {  
        sw=1;
        pos=$.inArray(solicitado[i], feriado);
        if(pos!=-1 && sw)
        {
            cfer++;
            sw=0;
        }
        pos=$.inArray(solicitado[i], fds);
        if(pos!=-1&& sw){
            cfds++;
            sw=0;
        }
        
        pos=$.inArray(solicitado[i], vacaciones);
        if(pos!=-1&& sw){
            cvac++;
            sw=0;
            llave=0;
        }
        
        pos=$.inArray(solicitado[i], viaticos);
        if(pos!=-1&& sw){
            cvia++;
            sw=0;
            llave=0;
        }
        if(sw==1)
        {
            contFechas+=solicitado[i]+",";
        }
        
    }
    codigohtml="";
    if(cfer>0)
        codigohtml+="<div class='OK grid_7'><div class='okimage img_mensages'> </div> Se han encontrado <span class='negrilla'>"+ cfer +" FERIADOS</span>  </div>";
    if(cfds>0)
        codigohtml+="<div class='OK grid_7'><div class='okimage img_mensages'> </div> Se han encontrado <span class='negrilla'>"+ cfds +" Dias del FIN DE SEMANA</span> </div>";
    
    if(cvac>0)
    {
        codigohtml+="<div class='NO grid_7' > <div class='atencionimage img_mensages'>  </div> Se ha detectado que la solicitud contiene\n\
                    <span class='negrilla'>"+ cvac +" dias de PERMISO YA SOLICITADO </span> anteriormente .\n\
                     <br>Las solicitudes no pueden contener otros permisos dentro, si continua la solicitud no se registrara!!! </div>";
    }
    
    if(cvia>0)
    {
        codigohtml+="<div class='NO grid_7' > <div class='atencionimage img_mensages'>  </div> Se ha detectado que la solicitud contiene\n\
                    <span class='negrilla'>"+ cvia +" dias de VIATICOS SOLICITADOS </span> anteriormente .\n\
                     <br>Las solicitudes no pueden contener VIATICOS dentro, si continua los viaticos se anularan !!! </div>";
        
    }
    // alert("t ="+t/8+"dias , cfer="+cfer+" cfds="+cfds);
    t=(t/8)-(cfer)-(cfds);
    
    codigohtml+="<div class='negrilla letraMediana'> Dias calculados para la solicitud :"+ t +" dias / "+t*8+" horas </div>"
    codigohtml="<div class='grid_7 prefix_05 '>"+codigohtml+"</div>"
    $("#mensaje_calculo_dias").html(codigohtml);
    $("#tiempoDias").val(t);
    $("#tiempoHoras").val(t*8);
    $("#contenidoFechas").val(contFechas);
    $("#llave").val(llave);
    
    
    
}

/* 
* Funciones elaboradas por Ruben Payrumani Ino 
* $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
*/
/* 
* Funciones elaboradas por RUBEN PLATA 
* $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
*/

function validar_justificacion()
{
    c=0;
    vectorError="";
    tipo=$('#tipo_jp :selected').val();

    switch (tipo) 
    {
        case "justificacion":
            if($('#fechaJustificacion').val()!="")
            {
                $("#fecha_div").removeClass('estiloError');       
                $("#fecha_div").addClass('estiloSinError');       
            }
            else
            {
                $('#fecha_div').addClass('estiloError');
                vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir la fecha de la justificacion</div>";
                c++;
            }
            if($('#archivos').val()!="")
            {
                $("#respaldo_div").removeClass('estiloError');       
                $("#respaldo_div").addClass('estiloSinError');       
            }
            else
            {
                $('#respaldo_div').addClass('estiloError');
                vectorError+="<div class='grid_5_5 letrachica'>- Debe cargar un arhivo</div>";
                c++;
            }
           
            //alert('ingresa a justificacion'+$('#tipo_jp :selected').val());
            break
        case "Permiso Vacacion":
            if($('#fecha_inicio_p').val()!="")
            {
                $("#div_fecha_ini").removeClass('estiloError');       
                $("#div_fecha_ini").addClass('estiloSinError');       
            }
            else
            {
                $('#div_fecha_ini').addClass('estiloError');
                vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir la fecha de inicio</div>";
                c++;
            }
            if($('#fecha_fin_p').val()!="")
            {
                $("#div_fecha_fin").removeClass('estiloError');       
                $("#div_fecha_fin").addClass('estiloSinError');       
            }
            else
            {
                $('#div_fecha_fin').addClass('estiloError');
                vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir la fecha final</div>";
                c++;
            }
            // alert('ingresa a Permiso '+$('#tipo_jp :selected').val());
            break
        case "Baja Medica":
            if($('#fecha_inicio_p').val()!="")
            {
                $("#div_fecha_ini").removeClass('estiloError');       
                $("#div_fecha_ini").addClass('estiloSinError');       
            }
            else
            {
                $('#div_fecha_ini').addClass('estiloError');
                vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir la fecha de inicio</div>";
                c++;
            }
            if($('#fecha_fin_p').val()!="")
            {
                $("#div_fecha_fin").removeClass('estiloError');       
                $("#div_fecha_fin").addClass('estiloSinError');       
            }
            else
            {
                $('#div_fecha_fin').addClass('estiloError');
                vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir la facha final </div>";
                c++;
            }
            if($('#archivos').val()!="")
            {
                $("#respaldo_div").removeClass('estiloError');       
                $("#respaldo_div").addClass('estiloSinError');       
            }
            else
            {
                $('#respaldo_div').addClass('estiloError');
                vectorError+="<div class='grid_5_5 letrachica'>- Debe cargar un archivo</div>";
                c++;
            }
            // alert('ingresa a Baja Media '+$('#tipo_jp :selected').val());
            break
        case "Licencia":
            if($('#radio_naci').is(':checked') || $('#radio_defu').is(':checked') || $('#radio_matr').is(':checked'))
            {
                $("#div_radiosLicencia").removeClass('estiloError');       
                $("#div_radiosLicencia").addClass('estiloSinError');
            }
            else
            {
                $('#div_radiosLicencia').addClass('estiloError');
                vectorError+="<div class='grid_5_5 letrachica'>- Debe seleccionar un tipo de licencia</div>";
                c++;
            }
            if($('#fechaLicencia').val()!="")
            {
                $("#fechaLicencia").removeClass('estiloError');       
                $("#fechaLicencia").addClass('estiloSinError');       
            }
            else
            {
                $('#fechaLicencia').addClass('estiloError');
                vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir la fecha inicio de la licencia</div>";
                c++;
            }
            //  alert('ingresa a Vacaciones '+$('#tipo_jp :selected').val());
            break
        default:
            break
    // alert('ingresa a default '+$('#tipo_jp :selected').val());
          
    }
    
    if($('#titulo_comentario').val()!="")
    {
        $("#div_tituloComent").removeClass('estiloError');
        $("#div_tituloComent").addClass('estiloSinError');
            
    }
    else
    {
        $('#div_tituloComent').addClass('estiloError');
        vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir un titulo</div>";
        c++;
    }
    if($('#comentario_justificacion').val()!="")
    {
        $("#div_comentario").removeClass('estiloError');      
        $("#div_comentario").addClass('estiloSinError');      
    }
    else
    {
        $('#div_comentario').addClass('estiloError');
        vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir el contenido</div>";
        c++;
    }
    
    if(c==0)
    {
        $('#error_de_formulario_justif').css({
            'display':'none'
        });
        return 0;
    }
    else 
    {
        vectorError= "<div Class='letrachica grid_5_5 negrilla '>ATENCION !!!  se produjeron los siguientes errores</div>"+vectorError;
        $('#error_de_formulario_justif').html(vectorError);
        $("#error de formulario_justif").addClass('estiloError');
        $('#error_de_formulario_justif').css({
            'display':'block'
        });
        return 1;
    }
}

function seleccionado(){
    var archivos = document.getElementById("archivos");//Damos el valor del input tipo file
    var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo
    //var texto = document.getElementById("texto").value;
    //El objeto FormData nos permite crear un formulario pasandole clave/valor para poder enviarlo
    var data = new FormData();
    //Como no sabemos cuantos archivos subira el usuario, iteramos la variable y al
    //objeto de FormData con el metodo "append" le pasamos calve/valor, usamos el indice "i" para
    //que no se repita, si no lo usamos solo tendra el valor de la ultima iteracion
    for(i=0; i<archivo.length; i++){
        data.append('archivo'+i,archivo[i]);        
    }
    //data.append('texto',texto);
        
    direccion=$("#burl").val()+"justificacion_marcado/subir";
    $.ajax({
        url:direccion, //Url a donde la enviaremos
        type:'POST', //Metodo que usaremos
        contentType:false, //Debe estar en false para que pase el objeto sin procesar
        data:data, //Le pasamos el objeto que creamos con los archivos
        processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
        cache:false //Para que el formulario no guarde cache
    }).done(function(msg){
        $("#cargados").html(msg); //Mostrara los archivos cargados en el div con el id "Cargados"
    //alert(texto);
    });        
}
function seleccionado_paraServidor(){
    var archivos = document.getElementById("archivos");//Damos el valor del input tipo file
    var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo
    //var texto = document.getElementById("texto").value;
    //El objeto FormData nos permite crear un formulario pasandole clave/valor para poder enviarlo
    var data = new FormData();
    //Como no sabemos cuantos archivos subira el usuario, iteramos la variable y al
    //objeto de FormData con el metodo "append" le pasamos calve/valor, usamos el indice "i" para
    //que no se repita, si no lo usamos solo tendra el valor de la ultima iteracion
    for(i=0; i<archivo.length; i++){
        data.append('archivo'+i,archivo[i]);        
    }
    //data.append('texto',texto);
        
    direccion=$("#burl").val()+"justificacion_marcado/subir_al_servidor";
    $.ajax({
        url:direccion, //Url a donde la enviaremos
        type:'POST', //Metodo que usaremos
        contentType:false, //Debe estar en false para que pase el objeto sin procesar
        data:data, //Le pasamos el objeto que creamos con los archivos
        processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
        cache:false //Para que el formulario no guarde cache
    }).done(function(msg){
        $("#cargados").html(msg); //Mostrara los archivos cargados en el div con el id "Cargados"
    //alert(texto);
    });
//window.location = baseurl+"justificacion_marcado";
}
function tomarAcciones(baseurl,pos,registro){
    //$( "#confirmacion_tomaraaciones .mensaje").html('Esta Seguro que desea tomar accion de la Solicitud ' +solicitud + 'que fue enviada a uno de sus Dependiente');
    $( "#confirmacion_tomaraaciones").dialog({
        title:'Confirme!',
        autoOpen: true,
        height: 200,
        width: 500,
        modal: true,
        buttons: {
            "SI": function() 
            {
                $.post(baseurl+"bandeja_de_solicitudes/tomarAccion",
                {
                    'id':registro
                }
                ,function(data){
                    alert('se ha obtenido la solicitud satisfactoriamente!!');
                    setTimeout(function(){
                        //window.location = baseurl+"bandeja_de_solicitudes/index";
                         location.reload();
                    }, 100); // actualiza tras cuarto segundo
                //alert("Se guardo correctamente el registro de justificacion");
                });
                $( this ).dialog( "close" );
            },
            "NO": function() {
                $( this ).dialog( "close" );
            }
        }
    });
}

function Dialog_nueva_justificacion()
{
    
    baseurl=$("#burl").val();
    cargar_formularios_justificacion(1);
    //  alert('cargo el formulario');
    titulo="Vacaciones/bajas Medicas/licencias";
    $( "#ventana_modal_contenedor_contenidos" ).dialog({
        title:titulo,
        autoOpen: true,
        height: 600,
        width: 700,
        modal: true,
        buttons: {
            "Guardar": function() 
            {
                if($('#llave').val()!=0){
                    
                
                    resp=validar_justificacion();//$('#tipo_jp :selected').val());
                    if(resp==0)
                    {
                        //$("#subir_archivo").trigger("click");
                        if($('#fechaLicencia').val()=="")
                        {
                            if($('#fechaJustificacion').val()!="")
                            {
                                fechaIni=$('#fechaJustificacion').val();
                                fechaFin=$('#fechaJustificacion').val();
                            }
                            else
                            {
                                fechaIni=$('#fecha_inicio_p').val()+" "+$('#horainicioH').val()+":"+$('#horainicioM').val();
                                fechaFin=$('#fecha_fin_p').val()+" "+$('#horafinH').val()+":"+$('#horafinM').val();
                            }
                        }
                        else
                        {
                            fechaIni=$('#fechaLicencia').val();
                            fechaFin=suma_tresDiasHabiles(fechaIni);
                            alert(fechaIni);
                            alert(fechaFin);
                        }
                        $.post(baseurl+"justificacion_marcado/guardar",
                        {
                            'proyecto':$('#proyecto :selected').val(),
                            'tipo':$('#tipo_jp :selected').val(),
                            'respaldo':$('#archivos').val(),
                            'tituloComentario':$('#titulo_comentario').val(),
                            'comentarioJustificacion':$('#comentario_justificacion').val(),
                            'estado':"Enviado", //.............................................................................................adicionado por Ruben
                            'fecha_inicio':fechaIni,
                            'fecha_fin':fechaFin,
                            'tiempo_d':$('#tiempoDias').val(),
                            'tiempo_h':$('#tiempoHoras').val(),
                            'contenido':$('#contenidoFechas').val()
                        }
                        ,function(data){
                            alert('se registro satisfactoriamente!!')
                            seleccionado_paraServidor();
                            setTimeout(function(){
                                //window.location = baseurl+"justificacion_marcado/index";
                                location.reload();
                            }, 250); // actualiza tras cuarto segundo
                        //alert("Se guardo correctamente el registro de justificacion");
                        });
                        $( this ).dialog( "close" );
                    }
                }
                else
                    alert('lo sentimos la solicitud no puede ser guardada por que tiene alertas!!');
            },
            "Cancelar": function() {
                $( this ).dialog( "close" );
            }
        }
    });//window.location.reload();
}

function muestra_justificaciones_realizadas()
{
    //alert ($("#burl").val());
    $("#div_registro_justificacion").html('<div class="cargando_circulo" style="height:40px;background-size: 10%;" ></div><div></div><div class="f10 alin_cen">Buscando...</div>');
    direccion=$("#burl").val()+"justificacion_marcado/mostrar_registro_justificaciones";
    $("#div_registro_justificacion").load(direccion,{});
}




function cargar_solicitudes_justificaciones()
{
    
 
    buscar=$('#quebuscar').val();
    id_user=$('#id_usuario_sesion').val();
    datos=new Array();
    dependientes=0;
    justificacion=1;
    vacacion=1;
    baja=1;
    licencia=1;
    enviado=1;
    leido=1;
    aceptado=1;
    autorizado=1;
    rechazado=1;
    // alert(dependientes);
    if($("#dep").is(':checked')) dependientes=1;
    if(!$("#jus").is(':checked')) justificacion=0;
    if(!$("#vac").is(':checked')) vacacion=0;
    if(!$("#baj").is(':checked')) baja=0;
    if(!$("#lic").is(':checked')) licencia=0;
    if(!$("#env").is(':checked')) enviado=0;
    if(!$("#lei").is(':checked')) leido=0;
    if(!$("#ace").is(':checked')) aceptado=0;
    if(!$("#aut").is(':checked')) autorizado=0;
    if(!$("#rec").is(':checked')) rechazado=0;
    
    // alert(dependientes);
    alert($("#burl").val());
    direccion=$("#burl").val()+"bandeja_de_solicitudes/lista_de_justificaciones";
    $.post(direccion,{
        'dependientes':dependientes,
        'justificacion':justificacion,
        'vacacion':vacacion,
        'baja':baja,
        'licencia':licencia,
        'enviado':enviado,
        'leido':leido,
        'aceptado':aceptado,
        'autorizado':autorizado,
        'rechazado':rechazado
    },function(data){
         alert('ingreso a la funcion para ver la alista de justificaciones');
        $("#div_lista_justificaciones").html(data)
    });
    
   
}

function aceptar_rechazar_solicitud(id, sw, pos)
{
    if(sw)//true or false para saber si Aceptar o Rechazar
    {
        ace_rec='confirmacion_Aceptar';
        estado='Aceptado';
    }
    else// por falso Rechazar
    { 
        ace_rec='confirmacion_Rechazar';
        estado='Rechazado';
    }
    $( "#"+ ace_rec).dialog({
        title:'Confirme!',
        autoOpen: true,
        height: 200,
        width: 500,
        modal: true,
        buttons: {
            "SI": function() 
            {
                $.post(baseurl+"bandeja_de_solicitudes/cambiarEstado",
                {
                    'id':id,
                    'estado':estado,
                    'firma':1
                }
                ,function(data){
                    alert('se ha '+estado+' la solicitud satisfactoriamente!!');
                    actualizar_estado(pos,id)
                });
                $( this ).dialog( "close" );
            },
            "NO": function() {
                $( this ).dialog( "close" );
            }
        }
    });
}
function verSolicitud(baseurl,i,id)
{
    $("#contenidotitulo"+i).css("color","black");    
    $.post(baseurl+'bandeja_de_solicitudes/verSolicitudJustificacion',{
        'id':id,
        "indice":i
    }, function(data){
        $("#contenido"+i).html(data);
    //$("#Div_estado"+i).html('Leido');
    });
    
    $.post(baseurl+'bandeja_de_solicitudes/obtener_Estado',{
        'id':id
    }, function(data){
        $("#Div_estado"+i).html(data);
    });
    setTimeout(function(){
        $("#contenido"+i).slideToggle(1000);
    } ,'200');
}
function actualizar_estado(i,id){
    baseurl=$("#burl").val();
    $.post(baseurl+'bandeja_de_solicitudes/obtener_Estado',{
        'id':id
    }, function(data){
        $("#Div_estado"+i).html(data);
    });
}


function ocultarSolicitudJustificacion(i)
{
    $("#contenidotitulo"+i).css("color","dimgray");
    setTimeout(function(){
        $("#contenido"+i).slideUp(1000);
    },'200');
//  $("#contenido"+i).css("display", "none");
/*  $('#abajo'+i).attr({
        src:baseurl+"imagenesweb/icono/abajo.png",
        title: 'Mostrar'
    });*/
// $('#abajo'+i).removeAttr('onclick').click(function () {
////       mostrarSolicitudSUV(baseurl,i,nro,sw,tipo);
//   });
}

//inicio funciones alta personal nuevo
function soloNumeros(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 38 || charCode > 57))
        return false;
    return true;
}
function soloLetras(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 32 && (charCode < 65 || 90 < charcode < 97 || charCode > 122  ))
        return false;
    return true;
}
function aMayusculas(campo)
{  
    $('#'+campo).val($('#'+campo).val().toUpperCase());    
}
         
function fAgrega()
{
    document.getElementById("login").value = document.getElementById("ci").value;
    document.getElementById("passw").value = document.getElementById("ci").value;
}
    
function guardarDatos_altaPersonal()
{
    if(validar_datosAltaPersonal()==0)
    {
        baseurl=$("#burl").val();
   
        $.post(baseurl+"Alta_PersonalNuevo/registrar_personalNuevo",
        {
            'nombres': $('#nombres').val(),
            'apellidos': $('#apellidos').val(),
            'ci':$('#ci').val(),
            'ciudad': $('#ciudad :selected').val(),
            'login':$('#login').val(),
            'password':$('#passw').val(),
            'domicilio':$('#domicilio').val(),
            'email':$('#email_1').val(),
            'telefono':$('#telefono').val(),
            'nacionalidad':$('#nacionalidad').val(),
            'fechaNac':$('#fecha_nacimiento').val(),
            'sexo': $('#sexo :selected').val(),
            'fechaIngreso': $('#fecha_inicio').val()
        }
        ,function(data){
            $("#mensajeGuardado").html(data);
            $("#mensajeGuardado").dialog({
                autoOpen: true,
                autoresize: true,
                modal: true,
                show: {
                    effect:'slide'
                }
            //buttons:{'Aceptar':function(){$(this).dialog("close"); window.location = baseurl+"horarios";} }
            })
            $(".ui-dialog-titlebar").hide();
            $(".ui-widget-content").css({
                'border':'none', 
                'background':'none'
            });
            setTimeout(function(){
                //window.location = baseurl+"Alta_PersonalNuevo";
                location.reload();
            }, 1500);
            
        }
        );
    }
}    
function validar_datosAltaPersonal()
{
    estiloError={
        'border': 'solid 1px #E47474',
        'background':'#FFCDCE'
    };
    estiloSinError={
        'border': 'solid 0px #7BA17B',
        'background':''
    };
    c=0;
    vectorError="";
    
    if($('#nombres').val()!="")
    
        $('#div_nombres').css(estiloSinError);
    else
    {
        $('#div_nombres').css(estiloError);
        vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir el nombre</div>";
        c++;
    }
    if($('#apellidos').val()!="")
    
        $('#div_apellidos').css(estiloSinError);
    else
    {
        $('#div_apellidos').css(estiloError);
        vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir los apellidos</div>";
        c++;
    }
    if($('#ci').val()!="")
    
        $('#div_ci').css(estiloSinError);
    else
    {
        $('#div_ci').css(estiloError);
        vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir la cedula de identidad</div>";
        c++;
    }
    if($('#login').val()!="")
    
        $('#div_login').css(estiloSinError);
    else
    {
        $('#div_login').css(estiloError);
        vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir un login</div>";
        c++;
    }
    if($('#passw').val()!="")
    
        $('#div_password').css(estiloSinError);
    else
    {
        $('#div_password').css(estiloError);
        vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir el password</div>";
        c++;
    }
    if($('#passw2').val()!="")
    
        $('#div_password2').css(estiloSinError);
    else
    {
        $('#div_password2').css(estiloError);
        vectorError+="<div class='grid_5_5 letrachica'>- Debe repetir el password</div>";
        c++;
    }
    if($('#passw').val()==$('#passw2').val())
    
        $('#div_password2').css(estiloSinError);
    else
    {
        $('#div_password2').css(estiloError);
        vectorError+="<div class='grid_5_5 letrachica'>- los passwords deben ser iguales</div>";
        c++;
    }
    if($('#domicilio').val()!="")
    
        $('#div_domicilio').css(estiloSinError);
    else
    {
        $('#div_domicilio').css(estiloError);
        vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir el domicilio</div>";
        c++;
    }
    if($('#email_1').val()!="")
    
        $('#contenedor').css(estiloSinError);
    else
    {
        $('#contenedor').css(estiloError);
        vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir el email</div>";
        c++;
    }
    if($('#telefono').val()!="")
    
        $('#div_telefono').css(estiloSinError);
    else
    {
        $('#div_telefono').css(estiloError);
        vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir el telefono o celular</div>";
        c++;
    }
    if($('#nacionalidad').val()!="")
    
        $('#div_nacionalidad').css(estiloSinError);
    else
    {
        $('#div_nacionalidad').css(estiloError);
        vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir la nacionalidad</div>";
        c++;
    }
    if($('#fecha_nacimiento').val()!="")
    
        $('#div_nacimiento').css(estiloSinError);
    else
    {
        $('#div_nacimiento').css(estiloError);
        vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir la fecha de nacimiento</div>";
        c++;
    }
    if($("#sexo :selected").val()!="0" )
        $('#div_sexo').css(estiloSinError);
    else
    {
        $('#div_sexo').css(estiloError);
        vectorError+="<div class='grid_5_5 letrachica'>- Debe seleccionar el sexo del usuario</div>";
        c++;
    }
    if($('#fecha_inicio').val()!="")
        $('#div_ingreso').css(estiloSinError);
    else
    {
        $('#div_ingreso').css(estiloError);
        vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir la fecha de alta a la empresa</div>";
        c++;
    }
    
    if(c==0)
    {
        $('#error_de_formularioAlta').css({
            'display':'none'
        });
        return 0;
    }
    else 
    {
        vectorError= "<div Class='letrachica grid_5_5 negrilla '>ATENCION !!!  se produjeron los siguientes errores</div>"+vectorError;
        $('#error_de_formularioAlta').html(vectorError);
        $('#error_de_formularioAlta').css({
            'display':'block'
        });
        return 1;
    }
}
// inicio script jquery para agregar campos de form 
function agregar_campos_texto(campo, tam,tipo)
{
    var MaxInputs= 8; //Número Maximo de Campos
    var x = $("#"+campo+" div").length + 1;    //número de campos existentes en el contenedor
    if(x <= MaxInputs) //max input box allowed
    {
        //agregar campo
        x++; //text box increment
        $("#"+campo).append('<div><input type="text" size="'+tam+'" onkeypress="return '+tipo+'(event)" id="text_'+campo+'_'+ x +'"/><a href="#" class="eliminar_'+campo+'">  x</a></div>');             
    }
                   
    $("body").on("click",".eliminar_"+campo, function(e){ //click en eliminar campo
        if( x > 1 ) {
            $(this).parent('div').remove(); //eliminar el campo
            x--;
        }
        return false;
    });
}
//fin funciones alta personal nuevo

//inicio funciones registro marcados
function muestra_calendario_marcado()
{
    baseurl=$("#burl").val();
    mes=$('#lista_mes :selected').val();
    anio=$('#lista_anio :selected').val();
                  
    //alert(baseurl+"RegistroMarcados/mostrar_tabla_calendario_marcados_usuario");
    $.post(baseurl+"RegistroMarcados/mostrar_tabla_calendario_marcados_usuario",
    {
        'mes':$('#lista_mes :selected').val(),
        'anio':$('#lista_anio :selected').val()
    }
    ,function(data){
        $("#div_registro_marcados").html(data);
    //alert(mes+' '+anio);               
    });
}
//fin funciones registro marcado

//inicio funciones horarios
function mostrar_datosHorario(id)
{
    //$("#basic_"+id).css({"display":"block"});
    a=$('#datosHorario_'+id).html();
    $('#con').html(a);
        
    baseurl=$("#burl").val();                 
    $.post(baseurl+"horarios/muestraScrollHorarios",{
        'indice_horario':id
    }
    ,function(data){
        $("#div_horario").html(data);
    //alert(mes+' '+anio);               
    });
        
}
function muestraDivHorarios()
{
    baseurl=$("#burl").val();                 
    $.post(baseurl+"horarios/muestraHorarios",{}
        ,function(data){
            $("#div_horario").html(data);
        //alert(mes+' '+anio);               
        });
}
function editarHorarios(id)
{
    baseurl=$("#burl").val();   
    $.post(baseurl+"horarios/edicion_horarios",{
        'indice_horario':id
    },function(data){
        $("#div_edicion_horarios").html(data)
    });
}
    
function guardar_datos_horario(cod)
{
    baseurl=$("#burl").val();
    $.post(baseurl+"horarios/guardar_edicion_horario",
    {
        'tipo':cod,   
        'nombre':$("#nombreHorario").val(),
        'hora_ingreso_ma':$("#lst_him").val()+":"+ $("#lst_mim").val()+":00",
        'hora_salida_ma':$("#lst_hsm").val()+":"+ $("#lst_msm").val()+":00",
        'hora_ingreso_ta':$("#lst_hit").val()+":"+ $("#lst_mit").val()+":00",
        'hora_salida_ta':$("#lst_hst").val()+":"+ $("#lst_mst").val()+":00",
        'tolerancia':"00:"+$("#tolerancia_ingreso").val()+":00",
        'comentario':$("#txtcomentario").val()
    }
    ,function(data){
        $("#mensaje").html(data);
        $("#mensaje").dialog({
            autoOpen: true,
            autoresize: true,
            modal: true,
            show: {
                effect:'slide'
            }
        //buttons:{'Aceptar':function(){$(this).dialog("close"); window.location = baseurl+"horarios";} }
        })
        $(".ui-dialog-titlebar").hide();
        $(".ui-widget-content").css({
            'border':'none', 
            'background':'none'
        });
        setTimeout(function(){
           // window.location = baseurl+"horarios";
            location.reload();
        }, 1500);
            
    });
}
//fin funciones horarios

//inicio funciones asig_admin_horario
function buscar_personalHorario_en_todo()
{
    quebuscar=$("#quebuscar").val();
        
    baseurl=$("#burl").val();
    $.post(baseurl+"AsigAdminHorario/busqueda_usuario",
    {
        'busqueda':quebuscar,
        'no_ids':$("#ids").val()
            
    }
    ,function(data){
        $("#resultado_busqueda_personal").html(data)
    });
} 
function muestraDivAsigna()
{
    baseurl=$("#burl").val();                 
    $.post(baseurl+"AsigAdminHorario/Asigna",{}
        ,function(data){
            $("#Div_asignaHorario").html(data);
        //alert(mes+' '+anio);               
        });
}
    
function seleccionar_usuario(id)
{
    $("#titulo_selec").css({
        "display":"block"
    });
    if($("#chk_"+id).is(':checked'))
    {
        //$("#chk_"+id).html({"checked":"true"});
        //$("#chk_"+id).prop("checked")
        baseurl=$("#burl").val();   
        $.post(baseurl+"AsigAdminHorario/listarUsuario",{
            'cod_personal':id
        },function(data){
            $("#div_usuarios_seleccionados").append(data)
        });
        if($("#ids").val()=='')
            $("#ids").val($("#ids").val()+"aa.cod_user!='"+id+"'");
        else            
            $("#ids").val($("#ids").val()+" and aa.cod_user!='"+id+"'");
    }
    else
    {
        $( "#selec"+id ).remove();
        $("#ids").val($("#ids").val().replace(" and aa.cod_user!='"+id+"'",""));
        $("#ids").val($("#ids").val().replace("aa.cod_user!='"+id+"'",""));
        if($("#ids").val().substring(0,5)==' and ')
            $("#ids").val($("#ids").val().substring(5));    
    }
    if($("#ids").val()=='')
    {
        $("#titulo_selec").css({
            "display":"none"
        });
        $("#Div_asignaHorario").css({
            "display":"none"
        });
        muestraDivAsigna();
    }
    else
    {
        $("#titulo_selec").css({
            "display":"block"
        });
        $("#Div_asignaHorario").css({
            "display":"block"
        });
        muestraDivAsigna();
    }
}
    
function de_seleccionar(id)
{
    $("#selec"+id).remove();
    $("#chk_"+id).attr('checked',false);
    $("#ids").val($("#ids").val().replace(" and aa.codadm_pk!='"+id+"'",""));
    $("#ids").val($("#ids").val().replace("aa.codadm_pk!='"+id+"'",""));
    if($("#ids").val().substring(0,5)==' and ')
        $("#ids").val($("#ids").val().substring(5));    
    if($("#ids").val()=='')
    {
        $("#titulo_selec").css({
            "display":"none"
        });
        $("#Div_asignaHorario").css({
            "display":"none"
        });
        muestraDivAsigna();
    }
    else
    {
        $("#titulo_selec").css({
            "display":"block"
        });
        $("#Div_asignaHorario").css({
            "display":"block"
        });
        muestraDivAsigna();
    }
}
    
function habilitarFecha()
{
    if($("#radio_intervalo").is(':checked'))
    {
        $("#fechaIntervalo").css({
            "display":"block"
        });
        $("#lunes select").attr({
            "disabled":"true"
        });        
        $("#martes select").attr({
            "disabled":"true"
        });        
        $("#miercoles select").attr({
            "disabled":"true"
        });        
        $("#jueves select").attr({
            "disabled":"true"
        });        
        $("#viernes select").attr({
            "disabled":"true"
        });        
        $("#sabado select").attr({
            "disabled":"true"
        }); 
    }
    else
    {
        $("#fechaIntervalo").css({
            "display":"none"
        });
    }
}
    

function duracion_fija()
{
    if($("#radio_fijo").is(':checked'))
    {  
        $("#fechaIntervalo").css({
            "display":"none"
        });
        $("#lunes select").removeAttr("disabled");
        $("#martes select").removeAttr("disabled");
        $("#miercoles select").removeAttr("disabled");
        $("#jueves select").removeAttr("disabled");
        $("#viernes select").removeAttr("disabled");
        $("#sabado select").removeAttr("disabled");
    }
         
    else
    {
        $("#fechaIntervalo").css({
            "display":"block"
        });
    }
}
    
function mostrar_div_dias(sw)
{ 
    $("#lunes select").attr({
        "disabled":"true"
    });        
    $("#martes select").attr({
        "disabled":"true"
    });        
    $("#miercoles select").attr({
        "disabled":"true"
    });        
    $("#jueves select").attr({
        "disabled":"true"
    });        
    $("#viernes select").attr({
        "disabled":"true"
    });        
    $("#sabado select").attr({
        "disabled":"true"
    });  
    if(sw==0)
    {
        $("#txt_fecha_fin").datepicker("option", "minDate", $("#txt_fecha_ini").val());
        $("#txt_fecha_fin").val('');
    }
          
    else
    { 
        fecha_fin=new Date($("#txt_fecha_fin").val());
        fecha_ini=new Date($("#txt_fecha_ini").val());
        dif = Math.floor((fecha_fin.getTime()-fecha_ini.getTime()) / (1000*60*60*24)); // (2013/11/19 - 2013/11/14)=5
        if(dif==0)
        {
            dayName = $.datepicker.formatDate('DD', fecha_ini);   
            if(dayName!='Domingo')
                $("#"+dayName.toLowerCase()+" select").removeAttr("disabled");
        }
        else if( dif<6 )
        {
            back_fecha_ini=fecha_ini;
            i=1;
            while(fecha_ini<=fecha_fin)
            {
                dayName = $.datepicker.formatDate('DD', back_fecha_ini);   
                if(dayName!='Domingo')
                {
                    $("#"+dayName.toLowerCase()+" select").removeAttr("disabled");
                    i++;
                }
                back_fecha_ini.setTime(back_fecha_ini.getTime()+(1000*60*60*24));
            }
        }
        else
        {
            $("#lunes select").removeAttr("disabled");
            $("#martes select").removeAttr("disabled");
            $("#miercoles select").removeAttr("disabled");
            $("#jueves select").removeAttr("disabled");
            $("#viernes select").removeAttr("disabled");
            $("#sabado select").removeAttr("disabled");
        }
            
    }
}
   
function guardarDatosAsigna()
{
    if(validar_campos_dialog()==0)
    {
        baseurl=$("#burl").val();
        if($("#radio_fijo").is(':checked'))
        {
            //-------------------------------------------ojo (fecha de tiempo fijo)
            fechaIni='';
            fechaFin='';
        }
        else
        {
            fechaIni=$("#txt_fecha_ini").val();
            fechaFin=$("#txt_fecha_fin").val();
        }
     
        $.getJSON(baseurl+"AsigAdminHorario/muestra_conflictos",
        {
            'horarioLunes':$("#lunes select option:selected").val(),
            'horarioMartes':$("#martes select option:selected").val(),
            'horarioMiercoles':$("#miercoles select option:selected").val(),
            'horarioJueves':$("#jueves select option:selected").val(),
            'horarioViernes':$("#viernes select option:selected").val(),
            'horarioSabado':$("#sabado select option:selected").val(),
            'fechaRangoIni':fechaIni,
            'fechaRangoFin':fechaFin,
            'ids_personal':$("#ids").val() 
        }
        ,function(resp){
            if(resp['sw']==0)
            {
                guardarDatos(0);
            //no existe ningun conflicto
            }
            else
            {
                $("#mensajeConflicto").html(resp['conflictos']);
                $("#mensajeConflicto").dialog({ 
                    autoOpen: true, 
                    title:'Conflicto de Asignacion de Horarios', 
                    height:550, 
                    width:800,
                    modal: true,
                    buttons:{
                        'Aceptar':function()
                        {
                            $(this).dialog("close"); 
                            guardarDatos(1);
                        //existe conflicto y solucionar
                        },
                        'Cancelar':function()
                        {
                            $(this).dialog("close"); 
                        }
                    }
                }); 
            }
        });
    }
}

function guardarDatos(conflicto)
{
    if(validar_campos_dialog()==0)
    {
        baseurl=$("#burl").val();
        if($("#radio_fijo").is(':checked'))
        {
            fechaIni='';
            fechaFin='';
        }
        else
        {
            fechaIni=$("#txt_fecha_ini").val();
            fechaFin=$("#txt_fecha_fin").val();
        }
         
        $.post(baseurl+"AsigAdminHorario/guardar_Asignacion",
        {
            'horarioLunes':$("#lunes select option:selected").val(),
            'horarioMartes':$("#martes select option:selected").val(),
            'horarioMiercoles':$("#miercoles select option:selected").val(),
            'horarioJueves':$("#jueves select option:selected").val(),
            'horarioViernes':$("#viernes select option:selected").val(),
            'horarioSabado':$("#sabado select option:selected").val(),
            'fechaRangoIni':fechaIni,
            'fechaRangoFin':fechaFin,
            'ids_personal':$("#ids").val(),
            'conflicto':conflicto
        }
        ,function(data){
            $("#mensajeGuardar").html(data);
            $("#mensajeGuardar").dialog({ 
                autoOpen: true, 
                //autoresize: true,
                heidht:700,
                width:540,
                //resizable: true,
                modal: true, 
                //show: {effect:'slide'},
                buttons:{
                    'Aceptar':function()
                    {
                        $(this).dialog("close"); 
                        location.reload();
                      //  window.location = baseurl+"AsigAdminHorario";
                    }
                }
            });
            $(".ui-dialog-titlebar").hide();
            $(".ui-widget-content").css({
                'border':'none', 
                'background':'none'
            });
        });
    }
            
}
    
function validar_campos_dialog()
{
    estiloError={
        'border': 'solid 1px #E47474',
        'background':'#FFCDCE'
    };
    estiloSinError={
        'border': 'solid 0px #7BA17B',
        'background':''
    };
    c=0;
    vectorError="";
    if($("#radio_fijo").is(':checked') || $("#radio_intervalo").is(':checked'))
        $('#div_radio_duracion').css(estiloSinError);
    else
    {
        $('#div_radio_duracion').css(estiloError);
        vectorError+="<div class='grid_5_5 letrachica'>- Debe seleccionar el tipo de duracion de los horarios</div>";
        c++;
    }
    if($("#radio_intervalo").is(':checked'))
    {
        if($("#txt_fecha_ini").val()=="")
        {
            $('#txt_fecha_ini').css(estiloError); 
            vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir la fecha de inicio</div>";
            c++; 
        }
        else
            $('#txt_fecha_ini').css(estiloSinError);
          
        if($("#txt_fecha_fin").val()=="")
        {
            $('#txt_fecha_fin').css(estiloError);
            c++; 
            vectorError+="<div class='grid_5_5 letrachica'>- Debe introducir la fecha termino</div>";
        }
        else
            $('#txt_fecha_fin').css(estiloSinError);
    }
    if($("#lunes select option:selected").val()!=0 ||
        $("#martes select option:selected").val()!=0 ||
        $("#miercoles select option:selected").val()!=0 ||
        $("#jueves select option:selected").val()!=0 ||
        $("#viernes select option:selected").val()!=0 ||
        $("#sabado select option:selected").val()!=0 )
        $('#dias_select').css(estiloSinError);
    else
    {
        $('#dias_select').css(estiloError);
        c++;
        vectorError+="<div class='grid_5_5 letrachica'>- Debe seleccionar el tipo de horario de al menos un dia</div>";
    }
    if(c==0)
    {
        $('#error_de_formulario').css({
            'display':'none'
        });
        return 0;
    }
    else 
    {
        vectorError= "<div Class='letrachica grid_5_5 negrilla '>ATENCION !!!  se produjeron los siguientes errores</div>"+vectorError;
        $('#error_de_formulario').html(vectorError);
        $('#error_de_formulario').css({
            'display':'block'
        });
        return 1;
    }
}
    
function verAsigHorario(cod)
{
    if($('#AsigAdminHorario_'+cod).is (':visible'))
    {
        $('#AsigAdminHorario_'+cod).css({
            "display":"none"
        });
    //alert('display block');
    }
    else
    {
        $('#AsigAdminHorario_'+cod).css({
            "display":"block"
        });   
    //alert('display none');
    }
    baseurl=$("#burl").val();
    $.post(baseurl+"AsigAdminHorario/mostrar_asignaciones_de_horarios",
    {
        'id':cod
    }
    ,function(data){
        $('#AsigAdminHorario_'+cod).html(data)
    });
}
//fin funciones asig_admin_horario
// inicio funciones para TREEVIEW
 
/*$(document).ready(function(){
    $("#browser").treeview();
    
    
});*/
// fin funciones para TREEVIEW
function selecLicencia()
{
    if($("#radio_naci").is(':checked'))
    {
        $("#titulo_comentario").val('Licencia por '+$("#radio_naci").val()); 
    }
    else if($("#radio_defu").is(':checked'))
    {
        $("#titulo_comentario").val('Licencia por '+$("#radio_defu").val()); 
    }
    else if($("#radio_matr").is(':checked'))
    {
        $("#titulo_comentario").val('Licencia por '+$("#radio_matr").val()); 
    }
}
/* Funciones elaboradas por RUBEN PLATA 
* $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
*/
$(document).ready(function() 
{
    $('#buscar_usuario2').click(function() 
    {
        if ($('#txFechaIngreso').get(0).value!="")
        {
            var fecha_i = $('#txFechaIngreso').get(0).value;
            var fecha = fecha_i.split("/");
            var fecha_ingreso = new Date(fecha[2],fecha[1]-1,fecha[0]);
            var i=0;
            while(i<10)
            {
                fecha_ingreso.setTime(fecha_ingreso.getTime()+24*60*60*1000);
                if ((fecha_ingreso.getDay()!=0) && (fecha_ingreso.getDay()!=6))
                    i++;
            //Convirtiendo la fecha al formato que requerimos
            }
            var mes = fecha_ingreso.getMonth()+1;
            //Si el mes es menor a 10 pues lo concatenamos con un cero por delante
            if (mes<10) mes = '0'+ mes;
            var fechaf = fecha_ingreso.getDate()+ '/' + mes + '/' + fecha_ingreso.getFullYear();
            //alert(fecha);
            $('#txFechaVen').attr('value',fechaf);
        }
    });
});

function suma_tresDiasHabiles(fecha)
{
    fecha=new Date(fecha);
    i=0;
    fecha_fin= new Date();
    while(i<3)
    {
        if(i==0)
            fecha_fin.setTime(fecha.getTime());
        else
            fecha_fin.setTime(fecha_fin.getTime()+24*60*60*1000);
        if(fecha_fin.getDay()!=0)//es diferente de 0 (domingo)
            i++;
    }
    fecha_fin=new Date(fecha_fin);
    var mes = fecha_fin.getMonth()+1;
    //Si el mes es menor a 10 pues lo concatenamos con un cero por delante
    if (mes<10) mes = '0'+ mes;
    fecha_fin = fecha_fin.getFullYear()+ '/' + mes + '/' + fecha_fin.getDate();
    return(fecha_fin);
}
    
function de_seleccionar_fecha(fec)
{
    $("#selec"+fec).remove();
    
    fec=new Date(fec);
     
    var d = fec.getDate();
    var m = fec.getMonth()+1;
    var y = fec.getFullYear();
    cad_fecha=y;
    if(m<10)
        cad_fecha+="/0"+m;
    else
        cad_fecha+="/"+m;
    if (d<10)
        cad_fecha+="/0"+d;
    else
        cad_fecha+="/"+d;
    //alert (cad_fecha);
    $("#ids_fechas").val($("#ids_fechas").val().replace("'"+cad_fecha+"'",""));
    
    //var array = [2, 5, 9];
    cad_datepicker=m+"/"+d+"/"+y;
    var index = RangeDates.indexOf(cad_datepicker);
    //    for(i =0; i< RangeDates.length; i++)
    //        alert(RangeDates[i]);
    //    alert (index);
    if (index > -1) 
    {
        RangeDates.splice(index, 1);
    }
    $("#div_fecha").datepicker("refresh");
//    for(i =0; i< RangeDates.length; i++)
//        alert(RangeDates[i]);
}

function adiciona_div_diasEspeciales(fecha)
{
    baseurl=$("#burl").val();   
    var dias_semana = new Array("Do","Lu","Ma","Mi","Ju","Vi","Sa");
    var meses = new Array ("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");

    fec=new Date(fecha);
    lista_tipo="<select id='tipo'><option value=8 >Dia Entero</option><option value=4 >Medio Dia Mañana</option><option value=4 >Medio Dia Tarde</option></select>"
    lista_ciudades="<select id='ciudad'><option value='Nacional'>Nacional</option><option value='LaPaz'>La Paz</option><option value='Cochabamba'>Cochabamba</option><option value='SantaCruz'>Santa cruz</option><option value='Oruro'>Oruro</option><option value='Potosi'>Potosi</option><option value='Sucre'>Sucre</option><option value='Beni'>Beni</option><option value='Tarija'>Tarija</option><option value='Pando'>Pando</option></select>";
    vista_div_fecha="<div class='grid_7' id='selec"+fec.getTime()+"'><div class='grid_6_5'>"+ dias_semana[fec.getDay()]+" " +fec.getDate()+ "/" + meses[fec.getMonth()] + "/" + fec.getFullYear()+"<div style='float:right'>"+lista_ciudades+"</div><div style='float:right'>"+lista_tipo+"</div><div style='float:right'><input type='text' size=25 placeholder='Descripcion del dia'></div></div><div class='grid_05 centrartexto'> <div class='boton_deseleccionar milink' title='¿Quitar?' onclick='de_seleccionar_fecha("+ fec.getTime() +" )'; ></div></div>";
    $("#div_fechas_seleccionados").append(vista_div_fecha);
    if($("#ids_fechas").val()=='')
    {
        $("#ids_fechas").val("'"+fecha+"'");
        $("#div_guardarFeriados").css({
            "display":"block"
        });
    }
    else            
        $("#ids_fechas").val($("#ids_fechas").val()+",'"+fecha+"'");
    
}

function guardar_diasFeriados()
{
    baseurl=$("#burl").val();
    cadFechas=$("#ids_fechas").val();
    tam_cad = cadFechas.length;
    i = 0;

    while (i < tam_cad)
    {
        if (cadFechas.charAt(i) == "'")
        {
            j = i + 1;
            k = 0;
            i++;
            while (cadFechas.charAt(i) != "'")
            {
                i++;
                k++;
            }
            fecha = cadFechas.substr(j, k);
            
            fec=new Date(fecha).getTime();
            $.post(baseurl+"diasEspeciales_y_feriados/guardarFechas",
            {
                'fecha':fecha,
                'nombre':$("#selec"+fec+" :text").val(),
                'region':$("#selec"+fec+" #ciudad option:selected").val(),
                'tipo':$("#selec"+fec+" #tipo option:selected").val()
            });
        }
        i++;
    }

    setTimeout(function(){
        //window.location = baseurl+"diasEspeciales_y_feriados/index";
        location.reload();
    }, 250); // actualiza tras cuarto segundo
//alert("Se guardo correctamente el registro de justificacion");
}


function desabilitar_dia_datepicker(fecha) // ingresa fecha en formato aaaa/mm/dd
{
    fec=new Date(fecha);
    var m = fec.getMonth()+1;
    var d = fec.getDate();
    var y = fec.getFullYear();
    RangeDates.push(m+"/"+d+"/"+y); //   guarda en formato mm/dd/aaaa para el bloqueo
}

function buscar_feriados_bd() // modelo de uso JSON
{ 
    $.getJSON($("#burl").val()+"diasEspeciales_y_feriados/buscar_feriados_bd",
    {
        'sw':0 
    }
    ,function(resp){
        cadFechas_bd=resp['cadena_fechasBD']
        //alert("fechas a bloquear"+cadFechas_bd);
        
        baseurl=$("#burl").val();
        tam_cad = cadFechas_bd.length;
        i = 0;

        while (i < tam_cad)
        {
            if (cadFechas_bd.charAt(i) == "'")
            {
                j = i + 1;
                k = 0;
                i++;
                while (cadFechas_bd.charAt(i) != "'")
                {
                    i++;
                    k++;
                }
                fecha_bd = cadFechas_bd.substr(j, k);
                fec=new Date(fecha_bd).getTime();
                fec=fec+(4*60*60*1000); // sumamos las 4 horas restadas por (gmt-4)
                fec=new Date(fec);
                var m = fec.getMonth()+1;
                var d = fec.getDate();
                var y = fec.getFullYear();
                RangeDates.push(m+"/"+d+"/"+y); //   guarda en formato mm/dd/aaaa para el bloqueo
            }
            i++;
        }
    });
}

function bloquear_diasDatepicker_bd()
{
    RangeDates = [];    //["2/11/2013, 2/12/2013", "1/1/2013"]
    RangeDatesIsDisable = true;
    buscar_feriados_bd();
}



function DisableDays(date) {  
    var isd = RangeDatesIsDisable;
    var rd = RangeDates;
    var m = date.getMonth();
    var d = date.getDate();
    var y = date.getFullYear();
    for (i = 0; i < rd.length; i++) {
        var ds = rd[i].split(',');
        var di, df;
        var m1, d1, y1, m2, d2, y2;

        if (ds.length == 1) {
            di = ds[0].split('/');
            m1 = parseInt(di[0]);
            d1 = parseInt(di[1]);
            y1 = parseInt(di[2]);
            if (y1 == y && m1 == (m + 1) && d1 == d) return [!isd];
        } else if (ds.length > 1) {
            di = ds[0].split('/');
            df = ds[1].split('/');
            m1 = parseInt(di[0]);
            d1 = parseInt(di[1]);
            y1 = parseInt(di[2]);
            m2 = parseInt(df[0]);
            d2 = parseInt(df[1]);
            y2 = parseInt(df[2]);

            if (y1 >= y || y <= y2) {
                if ((m + 1) >= m1 && (m + 1) <= m2) {
                    if (m1 == m2) {
                        if (d >= d1 && d <= d2) return [!isd];
                    } else if (m1 == (m + 1)) {
                        if (d >= d1) return [!isd];
                    } else if (m2 == (m + 1)) {
                        if (d <= d2) return [!isd];
                    }
                    else return [!isd];
                }
            }
        }
    }
    return [isd];
}
                    
function mostrar_diasFeriados()
{
    direccion=$("#burl").val()+"diasEspeciales_y_feriados/mostrar_feriados_actuales";
    $("#dias_feriados_bd_actuales").load(direccion,{});
}

function ver_permisos_a_otorgar(val)
{
    if(val!=0)
        $("#permisos_a_otorgar").css({
            "display":"block"
        });
    else
        $("#permisos_a_otorgar").css({
            "display":"none"
        });
      
}
//fin datepicker de feriados

function letras(e){
    
    if (e.which === 13) {
        alert('enter');
    }
}


//functiones para mostrar impresiones PDF

function Imp_boleta_permiso_vacacion(registro)
{
    baseurl=$("#burl").val()+'impresiones_pdf/imprimir_boleta_Permiso_vacaciones/'+registro;  
    miven=window.open (baseurl, "mywindow","menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");
}
//////////////////////////////////////////////////////////////////funciones para horas extras ////////////////////////

function ruralurbano()
{
    
    var $elegido =$("input[name=area_lugar]:checked");
   
    if($elegido.val()==1)//area rural
    {
        $(".rural").css("display", "block");
    } 
    if($elegido.val()==2)//area urbana
    {
        $(".rural").css("display", "none");
    }
    else
    {
        $(".rural").css("display", "block");
    }
           
}

function devolverProvinciasOption()
{
    //   alert ('ingresa a la funcion devolver provincias jason');
    var departamento=$('#departamento :selected').val();
    
    baseurl=$("#burl").val();
    //alert ('departamento es '+departamento);
    $.post(baseurl+'destino/devolverProvinciasOption', {
        'd': departamento
    }, function(data)
    {
        $("#provincia_Load").html(data);
    });
}
function validarLugtra()
{
    estiloError={
        'box-shadow': '#F00 0px 0px 15px'
    };
    estiloSinError={
        'box-shadow': ''
    };
    if($('#llave_lugartrabajo').val()<1)
    {
        $('#lugtra').css(estiloError);
    }
    else
    {
        $('#lugtra').css(estiloSinError);
    }
}
function cargar_registro_horas_extras()
{
    //funcion que carga el contenido de las horas extras registradas en el mes actual
    //alert('ingresa a la funcion de carga de datos a la tabla');
    //alert ($("#burl").val());
    direccion=$("#burl").val()+"solicitudes_horas_extra/registros_horaExtra";
    $.post(direccion,{
        'mes':$('#mes_actual :selected').val(),
        'anio':$('#ano_actual :selected').val()
    }
    ,function(data){
        $("#cotenido_registros").html(data);
    // alert('supuestamente ha cargado el contenido correctamente');
    });
}

function cargar_solicitudes_horas_extras()
{
   // alert('supuestamente ha cargado el contenido correctamente');
    
    direccion=$("#burl").val()+"solicitudes_horas_extra/registro_solicitudes_horaExtra";
    $.post(direccion,{
        'mes':$('#mes_actual :selected').val(),
        'anio':$('#ano_actual :selected').val()
    }
    ,function(data){
        $("#cotenido_registros").html(data);
   
    });
}

function cambiarfecha(origen,clase)
{
    // alert("origen:"+origen+" clase:"+clase);
    $("."+clase).val($('#'+origen).val());
    
}

function cargar_formularios_horas_extras()
{
    baseurl=$("#burl").val();
   
    direccion=baseurl+"solicitudes_horas_extra/form_nueva_hora_extra";
  
    // alert(direccion);
    $.post(direccion, {} ,function(data){
        $("#ventana_modal_contenedor_contenidos").html(data);
    });
}

function validar_formularioHe()
{
    error=0;
    //proyecto=$('#proyecto').val();
    mensajes="<span class='negrilla'>ERRORES DETECTADOS EN EL FORMULARIO DE SOLICITUD</span> <br>";
    i=1;
    estiloError={
        'box-shadow': '#F00 0px 0px 5px',
        'color':'red'
    };
    estiloSinError={
        'box-shadow': '',
        'color':'black'
    };
    tipo_trabajo=$('#tipo_trabajo :selected').val();
    if(tipo_trabajo=="0"){
        $('#tipo_trabajo :selected').css(estiloError);
        error=1;
        mensajes+=i+".- Debe seleccionar el tipo de trabajo. <br>";
        i++;
    }
    else
        $('#tipo_trabajo :selected').css(estiloSinError);
        
    departamento=$('#departamento :selected').val();
    if(departamento=="0")
    {
        $('#departamento :selected').css(estiloError);
        error=1;
        mensajes+=i+".- Debe seleccionar el departamento. <br>";
        i++;
    }
    else
        $('#departamento :selected').css(estiloSinError);
    
    area_lugar=$('input[name=area_lugar]:checked').val();
    if(area_lugar==1)
    {
        provincia=$('#provincia :selected').val();
        if(provincia=="0")
        {
            $('#provincia :selected').css(estiloError);
            error=1;
            mensajes+=i+".- Debe seleccionar la provincia. <br>";
            i++;
        }
        else
            $('#provincia :selected').css(estiloSinError);
    }
    
    sitioespecifico=$('#sitioEsp').val();
    if(sitioespecifico=="")
    {
        $('#sitioespecifico').css(estiloError);
        error=1;
        mensajes+=i+".- Debe escribir el nombre del sitio o estacion. <br>";
        i++;
    }
    else
        $('#sitioespecifico').css(estiloSinError);
        
    if($('#notificacion').val()=="" || $('#viaje').val()=="" || $('#sitio').val()=="" || $('#conclusion').val()=="")
    {
        $('#divfechas').css(estiloError);
        error=1;
        mensajes+=i+".- Todos los campos de fecha son requeridos. <br>";
        i++;
    }
    else
        $('#divfechas').css(estiloSinError);
    
    
    falla=$('#falla').val();
    if(falla.length<20)
    {
        $('#falla').css(estiloError);
        error=1;
        mensajes+=i+".- La descricion de la falla es muy Corta. <br>";
        i++;
    }
    else
        $('#falla').css(estiloSinError);
    
    intervencion=$('#intervencion').val();
    if(intervencion.length<20)
    {
        $('#intervencion').css(estiloError);
        error=1;
        mensajes+=i+".- La descricion de la intervencion es muy Corta. <br>";
        i++;
    }
    else
        $('#intervencion').css(estiloSinError);
    observaciones=$('#observaciones').val();
    if(observaciones.length<20)
    {
        $('#observaciones').css(estiloError);
        error=1;
        mensajes+=i+".- La observacion es muy Corta. <br>";
        i++;
    }
    else
        $('#observaciones').css(estiloSinError);
    
    if(error==1)
    {
        $("#error_de_formulario").html(mensajes);
        $("#error_de_formulario").css("display", "block");
          
    }
    else
        $("#error_de_formulario").css("display", "none"); 
    
    return (error);
}

function Dialog_nueva_Hora_Extra()
{
    //alert('funciona');
    baseurl=$("#burl").val();
    cargar_formularios_horas_extras();
    //  alert('cargo el formulario');
    titulo="Registro de Solicitud de Horas Extra";
    $( "#ventana_modal_contenedor_contenidos" ).dialog({
        title:titulo,
        autoOpen: true,
        height: 680,
        width: 700,
        modal: true,
        buttons: {
            "Guardar": function() 
            {
                  
                resp=validar_formularioHe();//$('#tipo_jp :selected').val());
                if(resp==0)
                {
                    if($('#confirmacion').is(':checked'))

                    {
                        
                        $.post(baseurl+"solicitudes_horas_extra/guardar",
                        {
                            'proyecto':$('#proyecto :selected').val(),
                            'tipo_trab':$('#tipo_trabajo :selected').val(),
                            'departamento':$('#departamento :selected').val(),
                            'provincia':$('#provincia :selected').val(),
                            'area_lugar':$('input[name=area_lugar]:checked').val(),
                            'sitioEspecifico':$('#sitioEsp').val(),
                            'fhnotificacion':$('#notificacion').val()+" "+$('#notificacionH :selected').val()+":"+$('#notificacionM :selected').val()+":00",
                            'fhviaje':$('#viaje').val()+" "+$('#viajeH :selected').val()+":"+$('#viajeM :selected').val()+":00",
                            'fhsitio':$('#sitio').val()+" "+$('#sitioH :selected').val()+":"+$('#sitioM :selected').val()+":00",
                            'fhconclusion':$('#conclusion').val()+" "+$('#conclusionH :selected').val()+":"+$('#conclusionM :selected').val()+":00",
                            'falla':$('#falla').val(),
                            'intervencion':$('#intervencion').val(),
                            'observaciones':$('#observaciones').val()
                            
                        }
                        ,function(data){
                            alert('se registro satisfactoriamente!!')
                            //seleccionado_paraServidor();
                            setTimeout(function(){
                                //window.location = baseurl+"solicitudes_horas_extra/index";
                                location.reload();
                            }, 2000); // actualiza tras cuarto segundo
                        //alert("Se guardo correctamente el registro de justificacion");
                        });
                        $( this ).dialog( "close" );
                    }
                    else
                    {
                        $("#div_confirmacion").css("display", "block");
                    //alert('Debe dar el visto bueno de que verifico la informacion!!');
                    }
                
                }
            },
            "Cancelar": function() {
                $( this ).dialog( "close" );
            }
        }
    });//window.location.reload();
}


function cargar_contenido_ver(indice)
{
    baseurl=$("#burl").val();
    direccion=baseurl+"solicitudes_horas_extra/ver_hora_extra";
    $.post(direccion, {
        "indice":indice
    } ,function(data){
        $("#ventana_ver").html(data);
    });
}
function editar_he_dialog(indice)
{
    baseurl=$("#burl").val();
    cargar_form_edit_horas_extras(indice);
    titulo="Editar Registro de Solicitud de Horas Extra";
    $("#ventana_ver").dialog({
        title:titulo,
        autoOpen: true,
        height: 680,
        width: 700,
        modal: true,
        buttons:{
            "Restaurar":function(){
                cargar_form_edit_horas_extras(indice);
            },
            "Guardar": function(){
                $.post(baseurl+"solicitudes_horas_extra/editar",
                {
                    'indice':indice,
                    'proyecto':$('#proyecto :selected').val(),
                    'tipo_trab':$('#tipo_trabajo :selected').val(),
                    'departamento':$('#departamento :selected').val(),
                    'provincia':$('#provincia :selected').val(),
                    'area_lugar':$('input[name=area_lugar]:checked').val(),
                    'sitioEspecifico':$('#sitioEsp').val(),
                    'fhnotificacion':$('#notificacion').val()+" "+$('#notificacionH :selected').val()+":"+$('#notificacionM :selected').val()+":00",
                    'fhviaje':$('#viaje').val()+" "+$('#viajeH :selected').val()+":"+$('#viajeM :selected').val()+":00",
                    'fhsitio':$('#sitio').val()+" "+$('#sitioH :selected').val()+":"+$('#sitioM :selected').val()+":00",
                    'fhconclusion':$('#conclusion').val()+" "+$('#conclusionH :selected').val()+":"+$('#conclusionM :selected').val()+":00",
                    'falla':$('#falla').val(),
                    'intervencion':$('#intervencion').val(),
                    'observaciones':$('#observaciones').val()
                            
                }
                ,function(data){
                    $("#ventana_ver").html('<div class="cargando_circulo grid_7"></div><div class="clear"></div><div class="letra25 grid_7 centrartexto">Guardando...</div>')
                    //seleccionado_paraServidor();
                    setTimeout(function(){
                        cargar_form_edit_horas_extras(indice);
                    }, 1000); // actualiza tras cuarto segundo
                //alert("Se guardo correctamente el registro de justificacion");
                });
                
                
                
            },
            "Cancelar/cerrar":function(){
                //window.location = baseurl+"solicitudes_horas_extra/bandeja_autorizacion";
                location.reload();
                $( this ).dialog( "close" );
            }
        }
    });
}
     
 
function cargar_form_edit_horas_extras(indice)
{
    baseurl=$("#burl").val();
   
    direccion=baseurl+"solicitudes_horas_extra/form_edit_hora_extra";
  
    // alert(direccion);
    $.post(direccion, {
        'indice':indice
    } ,function(data){
        $("#ventana_ver").html(data);
    });
}


function Dialog_ver_he(indice)
{
    
    baseurl=$("#burl").val();
    cargar_contenido_ver(indice);
    // 
    titulo="Ver Registro de Solicitud de Horas Extra";
    $("#ventana_ver").dialog({
        title:titulo,
        autoOpen: true,
        height: 500,
        width: 450,
        modal: true,
        buttons:{}
    });
}


function Dialog_ver_he_controles(indice)
{
    
    baseurl=$("#burl").val();
    cargar_contenido_ver(indice);
    // 
    titulo="Ver Registro de Solicitud de Horas Extra";
    $("#ventana_ver").dialog({
        title:titulo,
        autoOpen: true,
        height: 500,
        width: 450,
        modal: true,
        buttons:{
            'Aceptar':function(){
                $.post(baseurl+"solicitudes_horas_extra/cambiarEstado",

                {
                        'id':indice,
                        'estado':'Aceptado',
                        'firma':1
                    }
                    ,function(data){
                        // alert('se ha '+estado+' la solicitud satisfactoriamente!!');
                        cargar_contenido_ver(indice);
                    //actualizar_estado(pos,id)
                    });
            },
            'Rechazar':function(){
                $.post(baseurl+"solicitudes_horas_extra/cambiarEstado",
                {
                    'id':indice,
                    'estado':'Rechazado',
                    'firma':1
                }
                ,function(data){
                    //alert('se ha '+estado+' la solicitud satisfactoriamente!!');
                    cargar_contenido_ver(indice);//actualizar_estado(pos,id)
                });
            },
            'editar':function(){
                $( this ).dialog( "close" );
                editar_he_dialog(indice);
            },
            'cerrar ventana':function(){
                setTimeout(function(){
                    //window.location = baseurl+"solicitudes_horas_extra/bandeja_autorizacion";
                    location.reload();
                }, 2000);
                $( this ).dialog( "close" );
            }
            
        }
    });
}
function cambiar_estado_he(sw,id)
{
    baseurl=$("#burl").val();
    if(sw)//true or false para saber si Aceptar o Rechazar
    {
        ace_rec='confirmacion_Aceptar';
        estado='Aceptado';
    }
    else// por falso Rechazar
    { 
        ace_rec='confirmacion_Rechazar';
        estado='Rechazado';
    }
    $( "#"+ ace_rec).dialog({
        title:'Confirme!',
        autoOpen: true,
        height: 200,
        width: 500,
        modal: true,
        buttons: {
            "SI": function() 
            {
                $.post(baseurl+"solicitudes_horas_extra/cambiarEstado",
                {
                    'id':id,
                    'estado':estado,
                    'firma':1
                }
                ,function(data){
                    setTimeout(function(){
                        //window.location = baseurl+"solicitudes_horas_extra/bandeja_autorizacion";
                        location.reload();
                    }, 2000);
                //alert('se ha '+estado+' la solicitud satisfactoriamente!!');
                //actualizar_estado(pos,id)
                });
                $( this ).dialog( "close" );
            },
            "NO": function() {
                $( this ).dialog( "close" );
            }
        }
    });

}
function carga_reporte_pdf_he_x_proy()
{
    mes=$('#mes_actual :selected').val();
    anio=$('#ano_actual :selected').val();
    proy=$('#proyecto :selected').val();
    baseurl=$("#burl").val();
    direccion=baseurl+"impresiones_pdf/reporte_horas_extra_por_proyecto/"+mes+"/"+anio+"/"+proy;
    //alert("antes de mostrar PDF direccion "+direccion);
    $('#contenido_de_carga').html('<object data="'+direccion+'" type="application/pdf" width="100%" height="100%"></object>');//cargar_contenido_ver(indice);//actualizar_estado(pos,id)
           
     
    
}

function carga_reporte_pdf_he_personal()
{
    mes=$('#mes_actual :selected').val();
    anio=$('#ano_actual :selected').val();
   // proy=$('#proyecto :selected').val();
    baseurl=$("#burl").val();
    direccion=baseurl+"impresiones_pdf/reporte_horas_extra_personal/"+mes+"/"+anio;
    $('#contenido_de_carga').html('<object data="'+direccion+'" type="application/pdf" width="100%" height="100%"></object>');//cargar_contenido_ver(indice);//actualizar_estado(pos,id)
           
     
    
}





