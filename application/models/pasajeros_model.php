<?php

// autor Ruben Payrumani Ino
//modelo que sirve para adicionar a la base de datos de pasajeros de una solicitud vehicular
class pasajeros_model extends CI_Model {

    function Adicionar_tripulacion($idsuv) {
        $nro_pasajeros = $this->input->post('nropasajeros');
        $pasajeros = $this->input->post('PasajerosARRAY');
        $datos = array(
            'id_suv' => $idsuv,
            'tipo' => 'conductor',
            'categoria' => $this->input->post('categoria'),
            'nro_licencia' => $this->input->post('NroLicencia'),
            'telefono_conductor' => $this->input->post('Cel'),
            'nombre_completo' => $this->input->post('nomConductor'),
        );
        $this->db->insert('pasajeros_sav', $datos);

        
        for ($i = 1 ; $i<= $nro_pasajeros ;$i++ ) 
        {
           echo $pasajeros[$i];
            $pasaj = array(
            'id_suv' => $idsuv,
            'tipo' => 'pasajero',
            'nombre_completo' => $pasajeros[$i]
            );
            $this->db->insert('pasajeros_sav', $pasaj);
        }
    }
    function obtenerConductorSUV($suv)
    {
        $sql = "Select * FROM pasajeros_sav WHERE id_suv='$suv' and tipo='conductor'";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            $fila = $consulta->row();
        }
        return $fila;
    }
    function obtenerPasajerosSUV($suv)
    {
        $sql = "Select * FROM pasajeros_sav WHERE id_suv='$suv' and tipo='pasajero'";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

}
