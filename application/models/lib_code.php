<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lib_code
 *
 * @author RubenPayrumani
 */
class lib_code extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    //
    function block_cargaImagen($id_bloqueupload,$imagen_ruta,$dimensiones,$destino,$nombre_archivo,$accion)
    {
        $funcion = "$(\"#userfile\").trigger(\"click\");";
        
        $codigo="<div id=\"".$id_bloqueupload."\" class=\" bordeado \" style=\"position: relative; margin: 20px 25px 0px 25px; width:".$dimensiones["ancho"]."px;height: ".$dimensiones["alto"]."px\">
                    <div class=\"grid_3\" id=\"image_load\" >    
                       <img src=\"". base_url() .$imagen_ruta."\" style=\"width:".$dimensiones["ancho"]."px;height: ".$dimensiones["alto"]."px margin: 10px\">
                    </div>
                    <div class=\"edit_simple milink\"  onclick=\"$('#".$id_bloqueupload." #userfile').trigger('click')\" style=\"position: absolute;right: 0px;bottom: 0px; width: 30 px;height: 30px\">
                    </div> 
                    <div class=\"ocultar\">
                    <form id=\"fileform\" enctype=\"multipart/form-data\" method=\"POST\">
                         <input type=\"hidden\" id=\"dest\"  value = \"".$destino."\">
                         <input type=\"hidden\" id=\"dimensiones\"  value = \"".$dimensiones["ancho"]."|".$dimensiones["alto"]."\">                           
                         <input type=\"hidden\" id=\"nombre_file\"  value = \"".$nombre_archivo."\">                           
                         <input type=\"file\" id=\"userfile\"  name=\"userfile\"  style=\"padding-left: 30px\" title=\"Subir Archivo\" onchange=\"subir_archivo_servidor('".$id_bloqueupload."','".$accion."');\">
                    </form>
                    </div>
                </div>";
        return $codigo;
    }
}

?>
