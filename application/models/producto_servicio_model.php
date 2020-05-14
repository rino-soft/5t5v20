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
class producto_servicio_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //put your code here
    function cant_busqueda($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select * from producto_servicio ps WHERE concat(ps.cod_serv_prod,ps.nombre_titulo,ps.descripcion,ps.palabras_clave) LIKE '%$busqueda%'";

        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function busqueda_prod_serv_p($busqueda, $can, $ini) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select * from producto_servicio ps WHERE concat(ps.cod_serv_prod,ps.nombre_titulo,ps.descripcion,ps.palabras_clave) LIKE '%$busqueda%' limit $ini,$can";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function busqueda_prod_serv_c_categoria($busqueda, $can, $ini, $cat) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $catego = "";
        if ($cat != 0) {
            $catego = "and ps.id_categoria=" . $cat;
        }

        $sql = "select * from producto_servicio ps WHERE concat(ps.cod_serv_prod,ps.nombre_titulo,ps.descripcion,ps.palabras_clave) LIKE '%$busqueda%' $catego ORDER by ps.nombre_titulo limit $ini,$can";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function busqueda_prod_serv_c_categoria_cant($busqueda, $cat) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $catego = "";
        if ($cat != 0) {
            $catego = "and ps.id_categoria=" . $cat;
        }

        $sql = "select * from producto_servicio ps WHERE concat(ps.cod_serv_prod,ps.nombre_titulo,ps.descripcion,ps.palabras_clave) LIKE '%$busqueda%' $catego ORDER by ps.nombre_titulo";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function obtinene_stock_disponible($ids, $id_almacen) {
        $respuesta = array();
        for ($i = 0; $i < count($ids); $i++) {
            $sql = "select * from kardex_producto_almacen kpa 
                    where kpa.id_alm=$id_almacen
                    and kpa.id_ps=$ids[$i]
                    order by id_kardex DESC";

            $consulta = $this->db->query($sql);

            //  echo "<br>**** ".$consulta->num_rows(); 
            if ($consulta->num_rows() > 0)
                $respuesta[$i] = $consulta->row(0)->saldo;
            else
                $respuesta[$i] = 0;
            // echo $sql." => $respuesta[$i] <br>";
        }
        return($respuesta);
    }

    function obtinene_stock_disponible_individual($id, $id_almacen) {

        $sql = "select * from kardex_producto_almacen kpa 
                    where kpa.id_alm=$id_almacen
                    and kpa.id_ps=$id
                    order by id_kardex DESC";

        $consulta = $this->db->query($sql);

        //  echo "<br>**** ".$consulta->num_rows(); 
        if ($consulta->num_rows() > 0)
            $respuesta = $consulta->row(0)->saldo;
        else
            $respuesta = 0;
        // echo $sql." => $respuesta[$i] <br>";


        return($respuesta);
    }
/////////////////////////////desde aqui
    function obtener_articulo_respuesta_uno() {
        $sql = "select *
                from producto_servicio pro
                where pro.respuesta=1";
        $consulta = $this->db->query($sql);
        //echo $sql."<br>------------------------------------------------------------<br>";
        return $consulta;
    }

    function obtener_lista_articulos_res1($id) {
        $sql = "select DISTINCT det.id_articulo , det.cod_prop_sts_equipo,det.SN
                from detalle_mov_almacen det,movimiento_almacen mov, producto_servicio pro
                where det.id_mov_alm=mov.id_mov_alm 
                and det.id_articulo=pro.id_serv_pro
                and det.id_articulo = $id ";
        $consulta = $this->db->query($sql);
       // echo $sql."<br><br>";
        return $consulta;
    }

    function obtener_movimientos_cod_prop($cod_prop,$sn,$id_sp) {
        if($sn!="")
            $sn="and det.SN='".$sn."' ";
        $sql = 'SELECT mov.id_user_er, concat(u.ap_paterno," ",u.ap_materno,", ",u.nombre)as nomcomp 
        ,mov.id_mov_alm,  mov.tipo_movimiento,mov.comentario,mov.id_proyecto,p.nombre as proyecto,p.*,sro.*,mov.fh_reg,
        det.id_det_mov_alm,det.cod_prop_sts_equipo,det.SN,det.observaciones,det.cantidad,det.id_articulo,
        ps.nombre_titulo,ps.descripcion,cate.nombre as categoria ,scate.*,scate.nombre as subcategoria
        FROM ((((((movimiento_almacen mov left join usuarios u on (mov.id_user_er=u.cod_user)) 
              left join proyecto p on (p.id_proy=mov.id_proyecto))
              left join subregion_oficina sro on(sro.id_subregion=mov.id_oficina_reg))
              LEFT join detalle_mov_almacen det on (mov.id_mov_alm=det.id_mov_alm)) 
              left join producto_servicio ps on(ps.id_serv_pro=det.id_articulo))
              left join categoria_serv_prod cate on (cate.id_categoria=ps.id_categoria))
              left join subcategoria scate on (scate.id_subcategoria=ps.id_subcategoria)

        where det.id_mov_alm=mov.id_mov_alm

        and det.cod_prop_sts_equipo="' . $cod_prop .'" '.$sn. ' 
        and det.id_articulo='.$id_sp.'    
        order by mov.id_mov_alm DESC';
        /*if($id_sp==25 or $id_sp==28  )
            echo $sql."<br>";*/
        $consulta = $this->db->query($sql);
        return $consulta;
    }

}

?>
