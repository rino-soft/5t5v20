//función para eliminar los espacios del nombre de las imágenes
function trim(cadena)
{
    return cadena.replace(/\s/g, "");
}

//script que procesa la subida de las imagenes
$(document).ready(function() {
    var maxQueueSize = 8;//máximo de imagenes a subir
    var queueSize = 0;// es cero porque todavía no se ha subido ninguna imagen
    
    var base_url = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
    var uploadfolder = $('#uploadfolder').val();//campo oculto del formulario con la carpeta
    $('#subir_imagen').uploadify({
        'uploader'  : base_url + 'flash/uploadify/uploadify.swf',//archivo flash que procesa la subida
        'queueSizeLimit' : 8,//límite de subidas a la vez
        'height'      : '26',//alto del botón
        'width'       : '109', //ancho del botón
        'displayData' : 'percentage',//si queremos mostrar un porcentaje o lo que queramos
        'script'    : base_url + 'uploadify/subir_fotos',//el script que procesa la subida
        //Para pasar variables del form a la función uploadify del controlador se hace del siguiente modo
        
        /*'scriptData' : {'nombrevariable': $("#id en el formulario").val(),'nombrevariable': $("#lo mismo").val()},*/
        
        //y después en el controlador las recuperamos con el nombre que le dimos aquí 
        //ej: $nombrevariable=$_POST['nombrevariable'];
        'cancelImg' : base_url + 'imagenes/cancel.png',//imagen cancelar subida
        'buttonText': 'Seleccionar',//nombre del botón
        'sizeLimit': 400000000,//tamaño máximo
        'folder'    : 'uploads',//la carpeta
        'fileExt'     : '*.jpg;*.gif;*.jpeg*;*.png;*.JPG;*.JEPG;*.bmp;',//extensiones aceptadas
        'auto'      : false,//si queremos que suban automáticamente
        'multi'		: true,//si queremos que se pueda subir más de una a la vez
  
        //cuando seleccionamos un archivo, si no cumple con el filtro creado
        //nos saldra un alert que nos informará
        'onSelect'    : function(event,ID,fileObj) {
            var filter = /(.jpg|.jpeg|.png|.gif|.bmp|.JPG;|.JEPG;)/;
            // utilizamos test para comprobar si el parametro valor cumple la regla
            if(!(filter.test(fileObj.type.toLowerCase()))){
                jAlert('Sólo se aceptan archivos .jpg, .jpeg,.png, .bmp y .gif');
                return false;
            }
            //si queuesize es menor que maxQueueSize lo incrementamos cada vez que subamos
            //una imagen, lo que quiere decir que todavía no hemos subido las imagenes
            //que tenemos disponibles
            if (queueSize < maxQueueSize) {
                queueSize++;
            } else {
                //en otro caso será que si que hemos superado el límite y lo informamos
                //con un alert
                alert("Sólo se pueden cargar " + maxQueueSize + " imagenes!");
                $('#subir_imagen').fileUploadCancel(b);
                return false;
            }          
        },  
        //cuando se haya completado la subida de la imagen utilizamos la función $.ajax de jQuery
        //para crear la miniatura de la imagen subida con la función oncomplete y la mostramos en 
        //el div con id displayFiles usando slideDown, desplegado hacía abajo con jQuery

        'onComplete'  : function(event, ID, fileObj, response, data) {
            $.ajax({
                url : base_url + 'uploadify/filemanipulation/' + fileObj.type +'/'+trim(fileObj.name).toLowerCase(),
                success : function(response){
               
                    if(response == 'image')
                    {
                    
                        var images = $('<img src="'+base_url + 'uploads/'+trim(fileObj.name).toLowerCase()+
                            '" alt="" width="100" height="100" style="margin-left: -20px; float:left; margin: 10px" />');
                        $(images).hide().insertBefore('#displayFiles').slideDown('slow')
                    }                  
                }
            })
        }
    });
});