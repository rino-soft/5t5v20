<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kardex_almacen_model
 *
 * @author COMPUTER
 */
class kardex_almacen_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function busqueda_producto_kardex_almacen() {
        $this->load->model("almacen_model");
        $b = $this->input->post("buscar");
        $a = $this->input->post("almacen");
        $cat = $this->input->post("categoria");
        $cant = $this->input->post("cant");
        $pag = $this->input->post("pagina");
        $ini = ($pag * $cant) - $cant;
        $condalm = "";
        $catego = "";

        if ($a == 0) {
            $almace = $this->almacen_model->listar_almacen_responsable_almacen($this->session->userdata("id_admin"));
            $sw = 0;
            foreach ($almace->result() as $r) {
                if ($sw == 1)
                    $condalm.=" or ";
                $condalm.="id_almacen=" . $r->id_almacen;
                $sw = 1;
            }
        }
        if ($cat != 0) {
            $catego = "and p.id_categoria=" . $cat;
        }
        $sql = "select * 
            from kardex_producto_almacen kar,almacen a,producto_servicio p 
            where kar.id_ps=p.id_serv_pro 
            and kar.id_alm=a.id_almacen 
            and (" . $condalm . ") " . $catego
                . " Order by p.nombre_titulo
            limit $ini,$cant";
        // echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function busqueda_producto_kardex_almacen_cantidad() {
        $this->load->model("almacen_model");
        $b = $this->input->post("buscar");
        $a = $this->input->post("almacen");
        $cat = $this->input->post("categoria");
        $cant = $this->input->post("cant");
        $pag = $this->input->post("pagina");
        $condalm = "";
        $catego = "";
        if ($a == 0) {
            $almace = $this->almacen_model->listar_almacen_responsable_almacen($this->session->userdata("id_admin"));
            $sw = 0;
            foreach ($almace->result() as $r) {
                if ($sw == 1)
                    $condalm.=" or ";
                $condalm.="id_almacen=" . $r->id_almacen;
                $sw = 1;
            }
        }
        if ($cat != 0) {
            $catego = "and p.id_categoria=" . $cat;
        }
        $sql = "select * 
            from kardex_producto_almacen kar,almacen a,producto_servicio p 
            where kar.id_ps=p.id_serv_pro 
            and kar.id_alm=a.id_almacen 
            and (" . $condalm . ") " . $catego . " Order by p.nombre_titulo";

        $consulta = $this->db->query($sql);
        echo $consulta->num_rows();
        return($consulta->num_rows());
    }

    function lista_kardex_producto_almacen($prod, $alm) {
//        $sql = "select kpa.fh_registro, kpa.tipo_mov,kpa.cantidad,dma.observaciones,dma.SN,dma.cod_prop_sts_equipo,
//                kpa.cant_ingreso,kpa.cant_salida,kpa.saldo, ma.id_mov_alm,p.nombre,
//                concat(u.ap_paterno,u.ap_materno,', ',u.nombre)as nombreComp,ma.comentario 
//                
//                from kardex_producto_almacen kpa,
//                detalle_mov_almacen dma,movimiento_almacen ma,usuarios u,proyecto p 
//
//                where kpa.id_det_mov=dma.id_det_mov_alm
//                and p.id_proy=ma.id_proyecto
//                and ma.id_mov_alm=dma.id_mov_alm
//                and ma.id_user_er=u.cod_user
//                and kpa.id_ps=$prod
//                and kpa.id_alm=$alm";
        $sql = "select kpa.fh_registro, kpa.tipo_mov,kpa.cantidad,dma.observaciones,dma.SN,dma.cod_prop_sts_equipo,
kpa.cant_ingreso,kpa.cant_salida,kpa.saldo, ma.id_mov_alm,p.nombre,
concat(u.ap_paterno,' ',u.ap_materno,', ',u.nombre)as nombreComp,ma.comentario 
                
from (((kardex_producto_almacen kpa left join detalle_mov_almacen dma on kpa.id_det_mov=dma.id_det_mov_alm) left join movimiento_almacen ma on  ma.id_mov_alm=dma.id_mov_alm)
left join usuarios u on ma.id_user_er=u.cod_user) left join proyecto p on p.id_proy=ma.id_proyecto
               where kpa.id_ps=$prod
                and kpa.id_alm=$alm";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

}

?>
