<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of experiencia_laboral_model
 *
 * @author POMA RIVERO
 */

class experiencia_laboral_model extends CI_Model {
    


function dato_experiencia_laboral($id_experiencia){
      $sql = "select *
            from experiencia_laboral_personal ex
            where ex.id_experiencia_lab=$id_experiencia";
        $consulta = $this->db->query($sql);
      return ($consulta);
        
        
}
function guardar_experiencia_nuevo() {
        $respuesta="";
        $datos = array
        (
            'id_usuario' => $this->session->userdata('id_admin'),
            'fecha_inicio' => $this->input->post('fe_ini'),
            'fecha_fin' => $this->input->post('fe_fin'),
            'institucion' => $this->input->post('nom_inst'),
            'rubro_institucion' => $this->input->post('rubro'),
            'area' => $this->input->post('area'),
            'cargo' => $this->input->post('nom_puesto'),
            'nro_personas_dependientes' => $this->input->post('cant_pe'),
            'actividades' => $this->input->post('actividades'),
            'persona_referencia' => $this->input->post('nomb_ref'),
            'numero_referencia' => $this->input->post('num_ref'),
          
      
        );
        if ($this->input->post('id_expe') == 0) {
            $this->db->insert('experiencia_laboral_personal', $datos);
            $id_nuevo = ($this->db->insert_id());
            //echo $id_user_nuevo;
            $respuesta = $id_nuevo;
           // echo  $respuesta."por nuevo insert";
        } else {
            $this->db->where('id_experiencia_lab', $this->input->post('id_expe'));
            $upd = $this->db->update('experiencia_laboral_personal', $datos);
            $respuesta = $this->input->post('id_expe'); 
              //echo  $respuesta."por editar";
        }
        return($respuesta);

}


 function asigna_respaldo_experiencia($id_expe,$nombre_archivo)
    {
         $datos = array(
            'documento_adjunto' => $nombre_archivo);
         $this->db->where('id_experiencia_lab', $id_expe);
            $upd = $this->db->update('experiencia_laboral_personal', $datos);
            return($upd);
         
    }
    function lista_experiencia($id_usuario)
    {
        $sql="select * from experiencia_laboral_personal where id_usuario = ".$id_usuario." order by fecha_inicio";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }
    function del_registro_experiencia($reg)
    {
       $this->db->where('id_experiencia_lab', $reg);
        $this->db->delete('experiencia_laboral_personal'); 
    }



}

?>
