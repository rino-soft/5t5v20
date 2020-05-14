<?php

class diasEspeciales_y_feriados_model extends CI_Model {

    function _construct() {
        parent::Model();
    }

    function establece_diasFeriados() {
        $datos = array(
            'fecha' => $this->input->post('fecha'),
            'nombre' => $this->input->post('nombre'),
            'region' => $this->input->post('region'),
            'tipo' => $this->input->post('tipo'),
            'estado'=>"Activo"
        );
        $this->db->insert('feriado', $datos);
    }

    function busca_feriados_en_bd() {
        $ssql = "SELECT * from feriado ORDER BY fecha";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function feriados_fechas_bloqueadas($hoy) {
        $sql = "select * from feriado f where estado='Activo' and fecha between DATE_ADD('$hoy', INTERVAL -10 DAY) and    DATE_ADD('$hoy', INTERVAL 365 DAY)";
        //echo $sql;
        $resultado = $this->db->query($sql);
        $cadena = "";
        foreach ($resultado->result() as $res) {
            $cadena.=$res->fecha . "," . $res->nombre . "(" . $res->region . "),";
        }
        return($cadena);
    }
    function findesemana()
    {
        
    }

}

?>
