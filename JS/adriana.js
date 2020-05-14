/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function dialog_ver_usuario(div_dialog,direccion)
{
    burl=$('#b_url').val();
    this.cargar_contenido_html(div_dialog,direccion,0);//modulo=0 no sirve
    // saber si es nuevo o es edicion
    
    d=direccion.split("/");
    dc=d.length-1
    titulo="Ver Datos Del Usuario";
    if(d[dc]!=0)
        titulo="Ver Usuario";
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
                location.reload();
                
            }
        }
    });
}
//IMPRIMIR DATOS, ESTUDIOS Y EXPERIENCIA LABORAL DEL USUARIO
function Imp_detalle_usuario(registro)
{
    // alert (registro);
    //alert($("#burl").val());
    baseurl=$("#b_url").val()+'impresiones_pdf/imprimir_detalle_usuario/'+registro;  
    miven=window.open (baseurl, "mywindow","menubar=0,location=1,status=1,scrollbars=0, width=800,height=600");
}
