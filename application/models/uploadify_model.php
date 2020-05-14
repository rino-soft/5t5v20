<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Uploadify_model extends CI_Model
{
    public function construct()
    {
        parent::__construct();
    }
        //insertamos los datos en la tabla fotos
    function insert_imagenes($file_name,$fecha)
    {
         $data = array(
                'nombre_arch' => $file_name,
                'fecha' =>    $fecha          
            );
           return $this->db->insert('archivos', $data);
    }
}
