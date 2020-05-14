//funciones de destino y lugares************************************************
function ruralurbano()
{
    //alert('ingresa a la funcion');
    var $elegido =$("input[name=lugar_trabajo]:checked");
   
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
function registrarLugares(baseurl)
{
    
    if($("input[name=lugar_trabajo]:checked").val()==1)//area rural
    {
        areaTrab='rural';
        id_dep=$('#departamento').val();
        id_prov=$('#provincia').val();
        sit_esp=$('#sitioEsp').val();
        actSit=$('#actividadSitio').val();
    }   
    if($("input[name=lugar_trabajo]:checked").val()==2)//area Urbano
    {
        areaTrab='urbano';
        id_dep=$('#departamento').val();
        id_prov=1;//$('#provincia').val();
        sit_esp="urbano";//$('#sitioEsp').val();
        actSit=$('#actividadSitio').val();
    }    
    if(id_dep==0){
        alert('Debe Seleccionar un Departamento para adicionar los lugares de trabajo');
    }
    else
    {
        if(id_prov==0)
        {
            alert('Debe Seleccionar un Departamento para adicionar los lugares de trabajo');
        }
        else{
            if(sit_esp=="" || actSit=="") {
                alert('Los campos de escritura,*SITIO ESPECIFICO* y *ACTIVIDAD EN EL SITIO* son obligatorios, es posible que no haya escrito nada en algunos de esos dos campos');              
            }else{
                $.ajax({
                    type:'POST',
                    url:baseurl+'destino/adicionarDestivoSUV',
                    data:{
                        id_suv:0,
                        area_trabajo:areaTrab,
                        id_departamento:id_dep,
                        id_provincia:id_prov,
                        sitio_especifico:sit_esp,
                        actividad_realizar:actSit
                    }
                });
                setTimeout(function(){
                    mostrarlugares(baseurl,81);// cambiar el 81
                } ,'200');
                $('#sitioEsp').val('');
                $('#actividadSitio').val('');
                $('#llave_lugartrabajo').val(parseInt($('#llave_lugartrabajo').val())+1);
                validarLugtra();
            }
        }
    }
}
function eliminarLugares(baseurl,id)
{
    //alert('ingreso a elimiar lugares');
    $.ajax({
        type:'POST',
        url:baseurl+'destino/eliminarDestivoSUV',
        data:{
            id_lug:id
        }
    });
    //alert ('se ha eliminado exitosamente id => '+id);
    setTimeout(function(){
        mostrarlugares(baseurl,81);//cambiar el 81
    } ,'200');
    $('#llave_lugartrabajo').val(parseInt($('#llave_lugartrabajo').val())-1);
    validarLugtra();
}
function mostrarlugares(baseurl,codigoactivacion){
    $.post(baseurl+'destino/mostrar_destinos',{
        'cod_act':codigoactivacion
    }, function(data){
        $("#destinosAlmacenados").html(data)
    });
    
}
function devolverProvincias()
{
    //   alert ('ingresa a la funcion devolver provincias jason');
    var departamento=$('#departamento').val();
    //alert ('departamento es '+departamento);
    var base_url=$('#burl').val();
    $.getJSON(base_url+'destino/devolverProvincias', {
        d: departamento
    }, function(resp)
    {
        $('#provincia').empty();
        $.each(resp, function (indice, valor)
        {
            opcion=$('<option></option>',{
                value:indice,
                text:valor
            } );
            $('#provincia').append(opcion);
        });
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
//******************************************************************************
//funciones de carga de la pagina***********************************************
function cargarEnlaces(direccion,valor)
{   
    //alert("la direccion es :"+direccion+",  y el valor enviado es :"+valor);
    $.post(direccion, {
        'padre':valor
    }, function(data){
        $("#divmenuHijos").html(data)
    });
    
}
function cargarCuerpo(direccion,valor)
{   
    //alert("la direccion es :" + direccion + ",  y el valor enviado es :" + valor);
    $.post(direccion, function(data){
        $("#cuerpo").html(data)
    });
    
}
function cargarControladorMetodoEnCuerpo(baseurl,controlador,metodo)
{   
    //alert("la direccion es :" + direccion + ",  y el valor enviado es :" + valor);
    $.post(baseurl+controlador+"/"+metodo, function(data){
        $("#cuerpo").html(data)
    });
    
}
//******************************************************************************
// funciones para Solicitud de uso vehicular validaciones y pantallas modales***
function HabilitarFechaLlegada(nombreFecha1,nombreFecha2)
{
    
}
function modal_formulario_anulacion_de_solicitudUSOvehicular(idsol)
{
    mensaje='Usted esta solicitando el rechazo de la solicitud de uso vehicular Nro <strong>'+idsol+'</strong> <br/>\n\
        Esta seguro que quiere Rechazar esta Solicitud ?';
    $.confirm({
        
        'title'	 : 'Confirmacion de Rechazo de Solicitud',
        'message': mensaje,
        'buttons': {
            'SI': {
                'class': 'blue',
                'action': function(){}
            },
            'NO': {
                'class': 'gray',
                'action': function(){}
            }
        }
    });
}

function validarCamposSolicitud()
{
    error=0;
    estiloError={
        'box-shadow': '#F00 0px 0px 15px'
    };
    estiloSinError={
        'box-shadow': ''
    };
    if($('#proyecto').val()==0) {
        error++;
        $('#proyecto').css(estiloError);
        $("#proyecto").change(function () {
            validarCamposSolicitud();
        });
    } else   {
        $('#proyecto').css(estiloSinError);
    }
    if($('#regional').val()==0){
        error++;
        $('#regional').css(estiloError);
        $("#regional").change(function () {
            validarCamposSolicitud();
        });
    }else{
        $('#regional').css(estiloSinError);
    }
    if($('#fechaSalida').val()=="" ){
        error++;
        $('#fechaSalida').css(estiloError);         
        $("#fechaSalida").change(function () {
            validarCamposSolicitud();
        });
    }else
    {
        if ( restarfechas ( $('#fechaSalida').val() , $('#fechaElaborado').val()) <=0)
        {
            alert('la fecha de Salida deve ser posterior a HOY');
            error++;
            $('#fechaSalida').css(estiloError);         
            $("#fechaSalida").change(function () {
                validarCamposSolicitud();
            });
            
        }
        else
        {
            $('#fechaSalida').css(estiloSinError);
        }
    }
    if($('#fechaRetorno').val()==""){
        error++;
        $('#fechaRetorno').css(estiloError);         
        $("#fechaRetorno").change(function () {
            validarCamposSolicitud();
        });
    }else{
        
        if(restarfechas ( $('#fechaSalida').val() , $('#fechaRetorno').val())>0)
        {
            alert('la fecha de Retorno deve ser mayor a la fecha de Salida');
            error++;
            $('#fechaRetorno').css(estiloError);         
            $("#fechaRetorno").change(function () {
                validarCamposSolicitud();
            });
        }
        else{
            $('#fechaRetorno').css(estiloSinError);
        }
    }
    var elegido =$("input[name=tipo_trabajo]:checked").val();
    
    if(elegido!='Preventivo' && elegido!='Correctivo' && elegido!='Instalacion' && elegido!='ExtraWorks' && elegido!='Comision' && elegido!='Supervision') {
        
        error++;
        $('input[name=tipo_trabajo]').css(estiloError);         
        $('input[name=tipo_trabajo]').change(function () {
            validarCamposSolicitud();
        });
    }
    else
    {
        $('input[name=tipo_trabajo]').css(estiloSinError);
    }
    if($('#llave_lugartrabajo').val()<=0)
    {
        error++;
        $('#lugtra').css(estiloError);
        $('#lugtra').change(function () {
            validarCamposSolicitud();
        });
    }else {       
        $('#lugtra').css(estiloSinError);
    }
    if($('#NombreConductor').val()=='')
    {
        $('#NombreConductor').css(estiloError);
        error++;
        $('#NombreConductor').change(function () {
            validarCamposSolicitud();
        });
    }else{
        $('#NombreConductor').css(estiloSinError)
    }
    if($('#NoLicencia').val()=='')
    {
        $('#NoLicencia').css(estiloError);
        error++;
        $('#NoLicencia').change(function () {
            validarCamposSolicitud();
        });
    }else{
        $('#NoLicencia').css(estiloSinError)
    }
    if($('#celular').val()=='')
    {
        $('#celular').css(estiloError);
        error++;
        $('#celular').change(function () {
            validarCamposSolicitud();
        });
    }else{
        $('#celular').css(estiloSinError)
    }
    var nro_pasajeros=$('#nropasajeros').val();
    
    for(i=1;i<=nro_pasajeros;i++)
    {
        if($('#pasajero'+i).val()==''){
            error++;
            $('#pasajero'+i).css(estiloError);
            $('#pasajero'+i).change(function () {
                validarCamposSolicitud();
            });
        }
        else
        {
            $('#pasajero'+i).css(estiloSinError);
        }      
    }
    return error;
}
function obtenerDeestinosenTABLAparaMODAL(baseurl,codigoactivacion)
{
    $.ajax({
        url:'destino/obtenerDestinos_JSON', 
        dataType:'json', 
        success: function(data){
            tabla='';
            $.each(data, function(index) {
                tabla = tabla +'<div class="grid_8 alpha omega"><strong class="negrilla">';
                tabla+=(data[index].nro+1)+'.- '+ data[index].dep +' , '+ data[index].prov +' </strong>, '+ data[index].esp +' ( '+data[index].act+')</div>';
            })
            $("#destinos").html(tabla);
        }
    });
        
}
function modalsolicitudUsoVehicular()
{
    //obtencion de datos para el modal
    var baseurl=$('#urlbase').val();
    var proyecto= $('#proyecto :selected').text();
    var regional= $('#regional :selected').text();
    var fec_sal=$('#fechaSalida').val();
    var fec_ret=$('#fechaRetorno').val();
    var tipotrabajo=$("input[name='tipo_trabajo']:checked").val();
    var fec_elab=$('#fechaElaborado').val();
    var conductor=$('#NombreConductor').val();
    var lic=$('#NoLicencia').val();
    var categoria=$('#categoriaConductor').val();
    var telefono=$('#celular').val();
   
    var proyectoID= $('#proyecto :selected').val();
    var regionalID= $('#regional :selected').val();
    var pas=new Array();
           
    var nro_pasajeros=$('#nropasajeros').val();
    var pasajeros="";
    for(i=1;i<=nro_pasajeros;i++)
    {
        pas[i]=$('#pasajero'+i).val();
        alert('i'+i +" / "+ pas[i]);
        pasajeros = pasajeros +'<div class="grid_8 alpha omega"> Pasajero '+i+'.- <strong class="azul text">'+ $('#pasajero'+i).val() +'</strong> </div>';
    }
    var mensaje ='Solicitud de vehículo para:<br/>\n\
                 Proyecto: <strong class="negrilla">'+proyecto+'</strong> Regional:<strong class="negrilla">'+regional +'</strong> <br/>\n\
                 Del <strong class="negrilla">'+fec_sal +'</strong> al <strong class="negrilla"> '+fec_ret +'</strong> <br/>\n\
                 Para realizar trabajos de tipo <strong class="negrilla">'+ tipotrabajo +'</strong> <br/>\n\
                 En los lugares y realizando las actividades que describe en la siguiente tabla <br/>\n\
                 <div id="destinos" class="prefix_1 grid_8 suffix_1 espaciado"></div><br/>\n\
                 y las siguiente personas que tripularan el vehículo<br/>\n\
                 Conductor: <strong class="negrilla">'+conductor +'</strong> , con licencia de conducir:<strong class="negrilla">'+lic+'</strong> , categoría <strong class="negrilla">'+ categoria+'</strong> \n\
                ,teléfono: <strong class="negrilla">'+telefono+'</strong> <br/><div class="prefix_1 grid_8 suffix_1 espaciado">'+pasajeros+'</div>\n\
                 Revise los datos que ha ingresado, una vez guardado no podrá modificarlo!<br/><br/>\n\
                 ¿Desea guardar y enviar la Solicitud de uso de vehículo?';
    //cuerpo del modal 
    obtenerDeestinosenTABLAparaMODAL(baseurl,81);
    $.confirm({
        'title'	 : 'CONFIRMACION',
        'message': mensaje,
        'buttons': {
            'Si': {
                'class': 'blue',
                'action': function(){
                    alert ('usted dijo que si');
                    $.ajax({
                        type:'POST',
                        url:baseurl+'solicitud/adicionarSolicitudUsoVehicular',
                        data:{
                            proyecto:proyectoID,
                            regional:regionalID,
                            fechaElaborado:fec_elab,
                            fechaSalida:fec_sal,
                            fechaRetorno:fec_ret,
                            tipo_trabajo:tipotrabajo,
                            nropasajeros:nro_pasajeros,
                            nomConductor:conductor,
                            NroLicencia:lic,
                            categoria:categoria,
                            Cel:telefono,
                            PasajerosARRAY:pas                           
                        }
                    });
                    cargarControladorMetodoEnCuerpo(baseurl,'solicitud','misSolicitudes'); 
                }
            },
            'No': {
                'class': 'gray',
                'action': function(){
                   
                }
            }
        }
    });
}
function manejarFechas(fechacolocada,days)
{
    milisegundos=parseInt(35*24*60*60*1000);
    
    fecha=new Date(fechacolocada); 
    day=fecha.getDate();
    month=fecha.getMonth()+1; 
    year=fecha.getFullYear();
    // alert("Fecha actual: "+day+"/"+month+"/"+year);
    tiempo=fecha.getTime(); 
    milisegundos=parseInt(days*24*60*60*1000); 
    total=fecha.setTime(tiempo+milisegundos); 
    day=fecha.getDate();
    month=fecha.getMonth()+1;
    year=fecha.getFullYear();
    //  alert("Fecha modificada: "+day+"/"+month+"/"+year);
    mes=month;
    dia=day;
    if(month<10)
        mes='0'+month;
    if(day<10)
        dia='0'+day;
    
    return(year+"-"+mes+"-"+dia); 
}
function restarfechas ( fec1 , fec2 )
{//resta las fechas para determinar quien es el mayor si fecha1>fecha2 fecha1-fecha2=positivo si fecha1<fecha2 entonces fecha1-fecha2=negativo si fecha1=fecha2 fecha1-fecha2=0
    var fecha1 = new Fecha( fec1 );   
    var fecha2 = new Fecha( fec2 );
   
    //Obtiene objetos Date
    var miFecha1 = new Date( fecha1.anio, fecha1.mes, fecha1.dia );
    var miFecha2 = new Date( fecha2.anio, fecha2.mes, fecha2.dia );

    //Resta fechas y redondea
    var diferencia = miFecha1.getTime() - miFecha2.getTime();
    var dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
    var segundos = Math.floor(diferencia / 1000);
    if(segundos>0)
        a=1;
    if(segundos<0)
        a=-1;
    if(segundos==0)
        a=0
    return a;
   
//  alert ('La diferencia es de ' + dias + ' dias,\no ' + segundos + ' segundos.')
   
}
function restarfechasDias ( fec1 , fec2 )
{//resta las fechas para determinar quien es el mayor si fecha1>fecha2 fecha1-fecha2=positivo si fecha1<fecha2 entonces fecha1-fecha2=negativo si fecha1=fecha2 fecha1-fecha2=0
    var fecha1 = new Fecha( fec1 );   
    var fecha2 = new Fecha( fec2 );
   
    //Obtiene objetos Date
    var miFecha1 = new Date( fecha1.anio, fecha1.mes, fecha1.dia );
    var miFecha2 = new Date( fecha2.anio, fecha2.mes, fecha2.dia );

    //Resta fechas y redondea
    //alert("fecha 1 "+ fecha1.anio+","+fecha1.mes+","+ fecha1.dia );
    // alert("fecha 2 "+fecha2.anio+","+ fecha2.mes+","+fecha2.dia)
    
    var diferencia = miFecha1.getTime() - miFecha2.getTime();
    // alert(miFecha1.getTime()+"-"+miFecha2.getTime()+'='+diferencia);
    var dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
    var segundos = Math.floor(diferencia / 1000);
    return dias;
   
//  alert ('La diferencia es de ' + dias + ' dias,\no ' + segundos + ' segundos.')
   
}
function Fecha( cadena ) {

    //Separador para la introduccion de las fechas
    var separador = "/"

    //Separa por dia, mes y año
    if ( cadena.indexOf( separador ) != -1 ) {
        var posi1 = 0
        var posi2 = cadena.indexOf( separador, posi1 + 1 )
        var posi3 = cadena.indexOf( separador, posi2 + 1 )
        this.dia = cadena.substring( posi1, posi2 )
        this.mes = cadena.substring( posi2 + 1, posi3 )
        this.anio = cadena.substring( posi3 + 1, cadena.length )
    } else {
        this.dia = 0
        this.mes = 0
        this.anio = 0   
    }
}


function obtenervectorfecha(fecha1,fecha2)
{
    fec1=fecha1.substring(8, 10)+"/"+fecha1.substring(5, 7)+"/"+fecha1.substring(0, 4);
    fec2=fecha2.substring(8, 10)+"/"+fecha2.substring(5, 7)+"/"+fecha2.substring(0, 4);
    dias=restarfechasDias ( fec2 , fec1 );
    // alert('cantidad en dias entre '+fec1+' y '+fec2+' es '+dias);
    var vector=new Array;
    vector[0]=fecha1;
    for(i=0; i<=dias;i++){
        
        dia=manejarFechas(fecha1,i);
        vector[i]=dia.substring(0, 4)+"/"+dia.substring(5, 7)+"/"+dia.substring(8, 10);       
    }
    return vector;    
}


function obtenervectorcalendariosolicitud(soluso,vector)
{  
    var vector2=new Array();
    $.ajax({
        url:'../solicitud/obtenercalendarioSolicituddeusovehicular', 
        data:{
            nroSol:soluso,
            vectorfechas:vector
        },
        dataType:'json', 
        success: function(data){
            $.each(data, function(index) {
                vector2[index]=data[index].placa;
            //            alert('vector2['+index+'] >>> '+vector2[index]);
                
            })
           
        }
    });
    var a="";
    for(e=0;e<=vector2.length;e++)
        a=a+vector2[e]+' , ';
    // alert (a);
  
    alert (a);
                
    return(vector2);  
}
function obtenervectorcalendarioVehiculo(placa,vector)
{  
    var vector3=new Array();
    $.ajax({
        url:'../vehiculo/obtenercalendarioVehiculo_solicitud', 
        data:{
            placa_vehiculo:placa,
            vectorfechas:vector
        },
        dataType:'json', 
        success: function(data){
            $.each(data, function(index) {
                vector3[index]=data[index].soluso;
            })
        }  
    });
    
    var a="";
    for(e=0;e<=vector3.length;e++)
        a=a+vector3[e]+' , ';
    alert (a);
    return(vector3);  
}
function tabla_vectores_para_modalFormularioAsignarSolicitud(Idsolicitud,placa,desde,hasta){
    
    var vectorFecha=new Array();
    var vectorSolicitud=new Array();
    var vectorVehiculo=new Array();
    
    vectorFecha=obtenervectorfecha(desde.replace("-", "/").replace("-", "/") , hasta.replace("-", "/").replace("-", "/"));
    vectorSolicitud=obtenervectorcalendariosolicitud(Idsolicitud,vectorFecha);
    vectorVehiculo=obtenervectorcalendarioVehiculo(placa,vectorFecha);
    
    var tab="<table><tr><td class='bordeadoDerecha negrilla espaciadochico letrachica' >Fechas</td>";
    var tab2="<tr><td class='bordeadoDerecha negrilla espaciadochico letrachica' >Solicitud</td>";
    var tab3="<tr><td class='bordeadoDerecha negrilla espaciadochico letrachica' >"+placa+"</td>"
    for(i=0; i<vectorFecha.length;i++)
    {
        tab=tab+' <td class="bordeadoDerecha negrilla espaciadochico letrachica"> '+vectorFecha[i].substring(8, 10)+'</td>';
        if(vectorSolicitud[i]!='0')
            tab2=tab2+'<td class="bordeadoDerecha espaciadochico letrachica"> <a href=#>'+vectorSolicitud[i]+'</a></td>';
        else 
            tab2=tab2+'<td class="bordeadoDerecha espaciadochico letrachica"><a href=#>&nbsp;</a></td>';
      
        if(vectorVehiculo[i]!='0')
            tab3=tab3+'<td class="bordeadoDerecha espaciadochico letrachica"> '+vectorVehiculo[i]+'</td>';
        else 
            tab3=tab3+'<td class="bordeadoDerecha espaciadochico letrachica">&nbsp;</td>';
    }
    tab+="</tr>";
    tab2+="</tr>";
    tab3+="</tr>";
    ad=tab+tab2+tab3+"</table>";
    return (ad);
    
}

function modalFormularioAsignarSolicitud(baseurl,indiceplaca,indiceSolicitud,iif)
{
    placa=$('#placa'+indiceplaca).val();
    Idsolicitud=$('#solicitudnro'+indiceSolicitud).val();
    desde2=desde=$('#desdem'+indiceSolicitud).val();
    hasta=$('#hastam'+indiceSolicitud).val();
   
    
    tabla=tabla_vectores_para_modalFormularioAsignarSolicitud(Idsolicitud,placa,desde,hasta);
    
    fechaselecIni="<select id='fechainiciounico'>";
    fechaselecFin="<select id='fechafinalunico'>";
    sw=1;
    sel="selected"
    while(sw)
    {
        if(desde2==hasta)
            sw=0;
                   
        fechaselecIni+="<option value='"+desde2+"' "+sel+">"+desde2+"</option>";
        if(sw==0)
            sel="selected";
        else
            sel="";
        fechaselecFin+="<option value='"+desde2+"' "+sel+">"+desde2+"</option>";
        desde2=desde2.replace("-", "/").replace("-", "/");
        desde2=manejarFechas(desde2,1); 
          
    }
    fechaselecIni+="</select>";
    fechaselecFin+="</select>";
   
    var mensaje ='<div class="grid_3  ">\n\
                    <div class="grid_3 fondoplomoblanco espizquierda espabajo"> \n\
                    <div class="grid_3 esparriba negrilla">FORMULARIO DE ASIGNACION '+iif+'</div>\n\
                     <div class="grid_3 esparriba">Usted quiere asignar el vehiculo '+placa+' a la solicitud de Uso Nro '+Idsolicitud+'</div>\n\
                     <div class="grid_3 esparriba">del '+fechaselecIni+'al '+fechaselecFin+'</div>\n\
                     <div class="grid_3 esparriba"><div class="grid_1">Comentario :</div><div class="grid_3"><textarea id="comentariounico" class="text_area" placeholder="Escriba su comentario..." ></textarea></div> </div>\n\
                   </div>\n\
</div>\n\
<div class="grid_6 espizquierda">\n\
                           '+tabla+' \n\
<div class="grid_2"><img src="'+baseurl+'imagenesweb/fotosvehiculos/fotos_vehiculos_sts_320x200/'+placa+'.jpg" height="120"></div>\n\
                            <div class="grid_1"><img src="'+baseurl+'imagenesweb/recursos/asig.gif" height="50"></div>\n\
                            <div class="grid_2 fondoblanco centrartexto"> \n\
                                 <div class="grid_2">Solicitud de uso vehicular Nro</div>\n\
                                 <div class="grid_2 negrilla letra35">'+Idsolicitud+'</div>\n\
                            </div>\n\
                          </div>\
                   <div class="grid_10"> ¿Desea guardar la asignacion? </div>';
    
   
    $.confirm({
        'title'	 : 'Asignacion de Vehiculo a Solicitud',
        'message': mensaje,
        'buttons': {
            'Guardar': {
                'class': 'blue',
                'action': function(){
                    $.post(baseurl+'vehiculo/RegistrarAsignacionVehiculoSolicitud',{
                        'comentario_asignacion':$('#comentariounico').val(),
                        'placa_vehiculo':placa,
                        'fechaSalida':$('#fechainiciounico :selected').val(),
                        'fechaRetorno':$('#fechafinalunico :selected').val(),
                        'soluso':Idsolicitud
                    }, function(data){
                        $("#destinosAlmacenados").html(data)
                    });
                    setTimeout(function(){
                        cargarCuerpo(baseurl+"solicitud/lista_solicitudes_uso_para_asignar",9)
                        mostrarSolicitudSUV(baseurl,indiceSolicitud,Idsolicitud,0, 1);
                        cargaFormAsigVehSolUso(baseurl,indiceSolicitud,Idsolicitud,0);
                        buscarVehiculos(baseurl,indiceSolicitud)
                    } ,'500');          
                    
                }
            },
            'Cancelar': {
                'class': 'gray',
                'action': function(){}
            }
        }
    });
   
   
    
   
}//********************fin modal fromulario de asignacio de vehiculo********************



function nroPasajero(){
    var nroPasajeros =$("#nropasajeros").val();
    for(i=1;i<=4;i++){
        if(i<=nroPasajeros)
            $("#pasajero"+i).css("display", "block");
        else
        {
            $("#pasajero"+i).css("display", "none");
            $("#pasajero"+i).val('');
        }
           
    }
}
function validar_modal()
{
    if(validarCamposSolicitud()<=0)
        modalsolicitudUsoVehicular();
}
//******************************************************************************   
function cargarMisSolicitudes()
{
    var baseurl=$('#baseurl').val();
    $.post(baseurl+'solicitud/misSolicitudes',{
        'cod_act':codigoactivacion
    }, function(data){
        $("#BusquedaSolicitud").html(data)
    });
}

function mostrarSolicitudSUV(baseurl,i,nro,sw, tipo)
{   //tipo  = 0 solo ver sin opcion a nada // tipo = 1 puede ver las opciones de buscar vehiculo,editar y rechazar  // tipo = 2 No definido  // tipo = 3 No definido    
    $("#contenidotitulo"+i).css("color","black");    
    /* $('#abajo'+i).attr({
        src:baseurl+"imagenesweb/icono/arrib.png",
        title: 'Ocultar'
    });
     */ 
    if(sw==0){
        $.post(baseurl+'solicitud/verSolicitudEspecifica',{
            'nroSol':nro,
            'indice':i,
            'tipo':tipo
        }, function(data){
            $("#contenido"+i).html(data)
        });
        setTimeout(function(){
            $("#contenido"+i).slideDown(1000);
        } ,'200');
        sw=1;
    }
    else
        $("#contenido"+i).slideDown(1000);
    $('#abajo'+i).removeAttr('onclick').click(function () {
        mostrarSolicitudSUV(baseurl,i,nro,sw,tipo);
    });
}
function ocultarSolicitudSUV(baseurl,i,nro,sw,tipo)
{
    //$("#contenido"+i).css("display", "none");
    //      var options = { to: { width: 200, height: 60 } };
    $("#contenido"+i).slideUp(1000);
    $("#contenidotitulo"+i).css("color","dimgray");
/*  $('#abajo'+i).attr({
        src:baseurl+"imagenesweb/icono/abajo.png",
        title: 'Mostrar'
    });*/
// $('#abajo'+i).removeAttr('onclick').click(function () {
////       mostrarSolicitudSUV(baseurl,i,nro,sw,tipo);
//   });
}
function ocultarSolicitudSUV2(baseurl,i)
{
    //$("#contenido"+i).css("display", "none");
    var options = {
        to: {
            width: 200, 
            height: 60
        }
    };
    $("#contenido"+i).toggle("Blind",options,500);
    $("#contenidotitulo"+i).css("color","dimgray");
    $('#abajo'+i).attr({
        src:baseurl+"imagenesweb/icono/abajo.png",
        title: 'Mostrar'
    });
    
}
// funciones de vales de gasolina
function BuscarUsuario()
{
    var baseurl=$('#burl').val();
    // alert (baseurl);
    // alert(baseurl+'usuario/buscarusuarioporci');
    if($('#cedula').val().length>5){
        $.getJSON(baseurl+'usuario/buscarusuarioporci', {
            ci: $('#cedula').val()
        }, function(resp) {
            $('#idsolicitante').val(resp[0]);
            $('#usuario').val(resp[1]);
        });
    }
   
}
function ColocarCIcampo(ci,nombre){
    if(ci==0)
        $('#usuario').val(nombre);
    $('#cedula').val(ci);
    
    BuscarUsuario();
}

function cargaFormModalAsigVale(){
    //var baseurl=$('#burl').val();
    //alert("ingresa al 1er post");
    baseurl=$('#baseurl').val();
    $.post(baseurl+"solicitud/confirmacion_Asignacio_vale",
    {
        'v50':$("#vale50").val(),
        'v100':$("#vale100").val(),
        'solicitante':$("#usuario").val(),
        'proyecto':$("#proyecto :selected").text(),
        'vehiculo':$("#placa").val(),
        'comentario':$("#observaciones").val()
    },function(data){
        // alert("ingresa al 1er post");
        //alert(data);
        $( "#mensajeConfirmacion" ).html(data);
        
    });
}

function modalasignarValesGasolinaUsuario(base){
    titulo="Confirmacion de asignacion";
    var baseurl=base;
    alert(baseurl);
    cargaFormModalAsigVale();
 
    $( "#mensajeConfirmacion" ).dialog({
        title:titulo,
        autoOpen: true,
        height: 450,
        width: 530,
        modal: true,
        buttons: {
            "Aceptar": function() {
                //alert("cedula =>"+$("#cedula").val());
                $.post(baseurl+'solicitud/adicionar_Solicitud_gasolina',
                {
                    'proy':$("#proyecto").val(),
                    'cedula':$("#cedula").val(),
                    'idsolicitante':$("#idsolicitante").val(),
                    'usuario':$("#usuario").val(),
                    'placa':$("#placa").val(),
                    'obs':$("#observaciones").val(),
                    'v100':$("#vale100").val(),
                    'v50':$("#vale50").val(),
                    'total':$("#total").val()
                }, function(data) {
                    alert("El registro se ha completado exitosamente!");
                  location.reload();
                    //$(location).attr('href',baseurl+'solicitud/solGasolina'); 
            });
                
             
            },
            "Cancelar": function() {
                $(this).dialog( "close" );
            }
        }
    });
    
  
/* vales="";
    if($("#vale100").val()>0)
    {
        val100='Vale de 100 Bs.- ';
        for(i=0;i<$("#vale100").val();i++)
        {
            v=$("#vale100_"+i).text();
            //alert('vale '+ v);
            val100=val100+v+" , ";
        }
        vales="<div class='grid_10'><h1 class='verde'>"+val100+"</h1></div>";
    }
    if($("#vale50").val()>0)
    {
        val50='Vale de 50 Bs.- ';
        for(i=0;i<$("#vale50").val();i++)
        {
            v=$("#vale50_"+i).text();
            //alert('vale '+ v);
            val50=val50+v+" , ";
        }
        vales=vales+"<div class='grid_10 '><h1 class='verde'>"+val50+"</h1></div>"
    }
    
    
    mensaje="<div class='grid_10'>Compare los vales asignados con los vales REALES </div>"+vales+"<br>\n\
        se asiganara los vales al Sr: "+$("#usuario").val()+" del proyecto ";
    
    $.confirm({
        'title'	 : 'CONFIRMACION',
        'message': mensaje,
        'buttons': {
            'Si': {
                'class': 'blue',
                'action': function(){
                    // alert ('usted dijo que si');
                    $.ajax({
                        type:'POST',
                        url:baseurl+'solicitud/adicionar_Solicitud_gasolina',
                        data:{
                            proy:$("#proyecto").val(),
                            cedula:$("#cedula").val(),
                            idsolicitante:$("#idsolicitante").val(),
                            usuario:$("#usuario").val(),
                            placa:$("#placa").val(),
                            obs:$("#observaciones").val(),
                            v100:$("#vale100").val(),
                            v50:$("#vale50").val(),
                            total:$("#total").val()
                        },
                        success: function() { 
                            cargarControladorMetodoEnCuerpo(baseurl,'solicitud','solGasolina'); 
           
                        }
                    });
                }
            },
            'No': {
                'class': 'gray',
                'action': function(){
                    alert ('Ahora puede cambiar los datos');
                }
            }
        }
    });
 
 */
 
}
function validarCamposAsignarValesGasolina()
{
    baseurl=$('#baseurl').val();
    alert(baseurl);
    proyeto=$('#proyecto :selected').val();
    s=0;
    
    if(proyeto=='0')
    {
        alert ('Por favor elija un proyecto para asignar el vale');
        s++;
    }
    if($('#usuario').val()==""){
        alert('Debe escribir el nombre de la persona a la cual se asignara el vale');
        s++;
    }
    if($('#placa').val()==""){
        alert('Debe escribir la placa del vehiculo para el cual se esta asignando el vale');
        s++;
    }
    if($('#observaciones').val()==""){
        alert('Debe escribir alguna referencia de destino del vale');
        s++;
    }
    aa=(parseInt($('#vale100').val(),10)+parseInt($('#vale50').val(),10));
    //alert(aa);
    if(aa==0)
    {
        alert('Debe colocar la cantidad de vales que requiere para la asignacion');
        s++;
    }
        
    if(s==0)
        modalasignarValesGasolinaUsuario(baseurl);
    
        
    
}

function registrarvalesGasolina(baseurl)
{
    // alert('minimo ='+ $('#minimo').val() + ' maximo='+ $('#maximo').val() + ' valor'+$('#valor').val());
    $('#mensajes').css("display", "block");
    $('#boton').css("display", "none");
   
    $.ajax({
        type:'POST',
        url:baseurl+'registros/registrar_vales_gasolina',
        data:{
            minimo:$("#minimo").val(),
            maximo:$("#maximo").val(),
            valor:$("#valor").val()
        },
        success: function() { 
            $('#mensajes').css("display", "none");
            $("#minimo").val('0');
            $("#maximo").val('0');
            $("#valor").val('0');
            $('#boton').css("display", "block");
        //alert('re han registrado todos los datos exitosamente ');//
           
        }
    });
    
    
                    
}
function calculamontosolicitudGasolina()
{
    var a=$('#vale100').val()*100;
    var b=$('#vale50').val()*50;
    // alert ('a'+a+'b'+b+"="+c);
    var c=a+b;
    $('#total').val(c);
}
function listarValesestado(baseurl,iddestino,estado,monto,ini,tam){
    $.post(baseurl+'Registros/ListaValesEstado',{
        'estado':estado,
        'monto':monto,
        'inicio':ini,
        'cantidad':tam
    }, function(data){
        $("#"+iddestino).html(data)
    });
}
function genera_vector_anulacion(baseurl)
{
    var cadena=$("#valesanular").val()+"?";
    var lc= cadena.length;
    var indice=0;
    var sw = 1;
    var sig='';
    var a='';
    var b='';
    while(sw){
        if(cadena[indice]=='-' || cadena[indice]==',' || cadena[indice]=='?')
        {
            sw=0;
            sig=cadena[indice];
        }
        else
            a+=cadena[indice];
        indice++;
    }
    k=0;
    c=b;
    b=a;
    a="";
    signo=sig;
    vector=[];
    sww=0;
   
    for(i=indice;i<lc;i++)    {
        sww=1;
        if(cadena[i]=='-' || cadena[i]==','|| cadena[i]=='?')
        {
            c=b;
            b=a;
            a="";
        
            if(signo=='-'){
                for(j=c;j<b;j++){
                    vector[k]=j;
                    k++;
                   
                }
            }
            else{
                if(signo==',') {
                    vector[k]=c;
                    k++;
                }
            }
            signo=cadena[i];
            if(signo=="?"){
                vector[k]=b;
                k++;
            }
         
        }
        else
        {
            a+=cadena[i];
        }
         
    }
    if(sww==0)
    {
        vector[k]=b;
        k++;
    }
    for(i=0;i < vector.length;i++)
    {
        a+=vector[i]+' , ';
    }
    alert("el vector es >> "+a);
    
    return(vector);
}
function anularvales(baseurl)
{
    monto=$("#monto").val();
    vector=[];
    vector=genera_vector_anulacion(baseurl);
    $.ajax({
        type:'POST',
        url:baseurl+'Registros/anularValesdeGasolina',
        data:{
            vectorEnviado:vector,
            montoEnviado:monto
        }
    });
    setTimeout(function(){
        ini=0;
        tam=100;
        iddestino='valesanuladoslista50';
        listarValesestado(baseurl,iddestino,'Anulado',50,ini,tam);
        iddestino='valesanuladoslista100';
        listarValesestado(baseurl,iddestino,'Anulado',100,ini,tam);
    } ,'200');
    $('#valesanular').val('');
    
}
function listabalesanulado(baseurl)
{
    ini=0;
    tam=100;
    iddestino='valesanuladoslista50';
    listarValesestado(baseurl,iddestino,'Anulado',50,ini,tam);
    iddestino='valesanuladoslista100';
    listarValesestado(baseurl,iddestino,'Anulado',100,ini,tam);
}
function listarAsignaciones()//de gasolina 
{
    baseurl=$('#baseurl').val();
    // alert('proyecto='+proyecto);
    //alert(baseurl+'solicitud/lista_Asignacion_vales_gasolina_proyecto');
    $.post(baseurl+"solicitud/lista_Asignacion_vales_gasolina_proyecto",{
        'proy':$('#proyecto').val(),
        'i':0,
        'c':40,
        'proyecto':$('#proyecto :selected').text()
    }, function(data){
        $("#asignadas").html(data);
    });
    
}
function cargaFormAsigVehSolUso(baseurl,i,nro,sw)
{
    $("#asignar"+i).removeClass('gg').addClass('grid_3');
    // alert('se esta asignando a class a ASIGNAR');
    //mostrarSolicitudSUV(baseurl,i,nro,sw);
    $("#asignar"+i).css("display", "block");
    
    /* $("#contenidotitulo"+i).css("color","white");
     $('#abajo'+i).attr({
            src:baseurl+"imagenesweb/icono/arrib.png",
            title: 'Ocultar'
        });
     */  
    if(sw==0)
    {
        $.post(baseurl+'solicitud/formulario_asignacion_sol_uso_vehiculo',{
            'nroSol':nro,
            'i':i
        }, function(data){
            $("#asignar"+i).html(data)
        });
        sw=1;
    }
/*
    $('#abajo'+i).removeAttr('onclick').click(function () {
        ocultarformulario(baseurl,i,nro,sw);
    });*/
}
function buscarVehiculos(baseurl,i)
{
    // alert("traccion: "+$("#traccion"+i).val()+", desde : "+$("#desde"+i).val()+", hasta : "+$("#hasta"+i).val()+", lugar :"+$("#lugar"+i+" :selected" ).text()+", tipo: "+$("#tipoVehiculo"+i).val()+"capacidad : "+$("#cantPasajeros"+i).val())
    $.post(baseurl+'vehiculo/buscar_vehiculo_parametros',{
        'tracc' : $("#traccion"+i).val(),
        'des' :$("#desde"+i).val(),
        'cap' :$("#cantPasajeros"+i).val(),
        'has' :$("#hasta"+i).val(),
        'lug' :$("#lugar"+i +" :selected").text(),
        'tipo' :$("#tipoVehiculo"+i).val(),
        'indic':i

    }, function(data){
        $("#divResultado_Busqeda"+i).html(data)
    });
    sw=1;
}
//**************************************************

function modalanularLiberarSolyvales(baseurl,libe_anu,Sol)
{
    if(libe_anu==0)
    {
        titulo="Anular SOLICITUD Nº "+ Sol;
        mensaje=" Usted desea anular la solicitud de Gasolina <br/>\n\
                        <br/> <div class='grid_10'>¿ Que desea hacer con los vales de esta Solicitud ?</div>\n\
                         <div class='grid_4 prefix_3 suffix_3'><input type='radio' name='anularliberar' value='1'> Anular  </div>\n\
                         <div class='grid_4 prefix_3 suffix_3'><input type='radio' name='anularliberar' value='2'> Liberar</div><br/> <br/>.\n\
 "
    }
    else
    {
        titulo="Liberar Vales de SOLICITUD Nº "+ Sol;
        mensaje ="Usted deseliberar algunos de los vales que tiene esta solicitud\n\
<br/> Marque el vale que desea liberar <br/>\n\
vale Nro  0001  <input type='checkbox'> de 100 Bs.-<br/>\n\
vale Nro  0002  <input type='checkbox'> de 100 Bs.-<br/>\n\
vale Nro  0003  <input type='checkbox'> de 100 Bs.-<br/>\n\
vale Nro  0004  <input type='checkbox'> de 100 Bs.-<br/>\n\
 \n\
  "
    }
    
   
   
    $.confirm({
        'title'	 : titulo,
        'message': mensaje,
        'buttons': {
            'Aceptar': {
                'class': 'blue',
                'action': function(){
                    if(libe_anu==0)
                    {
                        anulado=$('input[name=anularliberar]:checked').val();
                        alert('anulado 1 liberar 2 ====>>>>> '+anulado);
                    }
                }
            },
            'Cancelar': {
                'class': 'gray',
                'action': function(){
                //alert ('Ahora puede cambiar los datos');
                }
            }
        }
    });
}

//**************************************************