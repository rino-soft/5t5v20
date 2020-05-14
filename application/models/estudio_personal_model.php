<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of estudio_personal_model
 *
 * @author RubenPayrumani
 */
class estudio_personal_model extends CI_Model{

    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function registra_edita_datos_estudios_academicos() {
          $datos = array(
            'id_usuario' => $this->session->userdata('id_admin'),
            'fecha_inicio' => $this->input->post('fec_ini'),
            'fecha_fin' => $this->input->post('fec_fin'),
            'institucion' => $this->input->post('institucion'),
            'nivel_formacion' => $this->input->post('nivel'),
            'carrera' => $this->input->post('carrera'),
            'Mension' => $this->input->post('mencion'),
            'registro_profesional' => $this->input->post('nro_reg'),
            'descripcion_estudio' => $this->input->post('desc_logro'));
             
          if ($this->input->post('id_logro') == 0) {
            $this->db->insert('estudios_personal', $datos);
            $id_nuevo = ($this->db->insert_id());
            //echo $id_user_nuevo;
            $respuesta = $id_nuevo;
           // echo  $respuesta."por nuevo insert";
        } else {
            $this->db->where('id_estudios_personal', $this->input->post('id_logro'));
            $upd = $this->db->update('estudios_personal', $datos);
            $respuesta = $this->input->post('id_logro'); 
              //echo  $respuesta."por editar";
        }
        return($respuesta);
            
       
    }
    function asigna_respaldo_estudios($id_logro,$nombre_archivo)
    {
         $datos = array(
            'documento_adjunto' => $nombre_archivo);
         $this->db->where('id_estudios_personal', $id_logro);
            $upd = $this->db->update('estudios_personal', $datos);
            return($upd);
         
    }
    function obtener_logro_academico($id_buscado)
    {
        $sql="select * from estudios_personal where id_estudios_personal = ".$id_buscado;
        $consulta = $this->db->query($sql);
        return($consulta);
    }
    
    function lista_logro_academico($id_usuario)
    {
        $sql="select * from estudios_personal where id_usuario = ".$id_usuario." order by fecha_inicio";
        $consulta = $this->db->query($sql);
        return($consulta);
    }
    
    function del_registro_estudio($reg)
    {
       $this->db->where('id_estudios_personal', $reg);
        $this->db->delete('estudios_personal'); 
    }
	//adri
	function lista_logro_academico2($id_usuario)
    {
        $sql="select * from estudios_personal where id_usuario = ".$id_usuario." order  by fecha_fin desc";
      //  echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }
}

?>
