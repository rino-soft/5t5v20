<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of oventa_prefactura_model
 *
 * @author RubenPayrumani
 */
class detalle_mih_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    //put your code here
    function cant_busqueda($busqueda)
    {
        $busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select * from movimiento_almacen ma WHERE concat(ma.id_mov_alm,ma.fh_reg,ma.tipo_movimiento,ma.proyecto,ma.comentario) LIKE '%$busqueda%'";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }
    function busqueda_obj($busqueda,$can,$ini)
    {
        $busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select * from movimiento_almacen ma WHERE concat(ma.id_mov_alm,ma.fh_reg,ma.tipo_movimiento,ma.proyecto,ma.comentario) LIKE '%$busqueda%' limit $ini,$can";
        $consulta = $this->db->query($sql);
        return($consulta);
    }
    function busqueda_obj1($busqueda)
    {
        $busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select * from producto_servicio ps WHERE concat(ps.id_serv_pro, ps.cod_serv_prod, ps.nombre_titulo) LIKE '%$busqueda%'";
        $consulta = $this->db->query($sql);
        return($consulta);
    }
}

?>
