<?php

class historial_personal_model extends CI_Model {

    function registrar_evento_historial_personal($datos) {
        $this->db->insert('registro_historial_personal', $datos);
        return ($this->db->insert_id());
    }

}

