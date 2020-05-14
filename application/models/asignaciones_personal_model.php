<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of solicitud_material_model
 *
 * @author COMPUTER
 */
class asignaciones_personal_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
     function obt_asignaciones() {
        $id_user_session=$this->session->userdata('id_admin');
        $sql = "select * from usuarios u, movimiento_almacen ma
        where u.cod_user=ma.id_user_er
        and ma.estado <> 'Guardado'
        and u.cod_user=$id_user_session";
        echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }
     function obtener_datos_de_mis_asignaciones(){
        $id_user_session=$this->session->userdata('id_admin');
        $sql="select mov.id_mov_alm, mov.fh_reg, al.nombre,mov.comentario,mov.estado
                from movimiento_almacen mov, almacen al, usuarios us
                where mov.estado<>'Guardado'
                and us.cod_user=mov.id_user_er
                and mov.id_almacen=al.id_almacen
                and us.cod_user=$id_user_session";
        $consulta = $this->db->query($sql);
        return($consulta);
        
    }

    

      
}

?>

