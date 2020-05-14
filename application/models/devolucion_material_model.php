<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of devolucion_material_model
 *
 * @author COMPUTER
 */
class devolucion_material_model extends CI_Model {

    //put your code here


    function __construct() {
        parent::__construct();
    }

    function listar_proyecto() {
        $sql = 'select distinct nombre from proyecto where 1';
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_detalle_almacen_producto($id_mov_alm) {
        //echo $id_mov_alm;
        $sql = "select det.item, pro.cod_serv_prod,pro.nombre_titulo,det.id_articulo,
            mov.id_mov_alm,pro.id_serv_pro,det.SN,det.cod_prop_sts_equipo,
        pro.descripcion,pro.tipo, det.observaciones,det.cantidad,mov.comentario
    from  movimiento_almacen mov, detalle_mov_almacen det, producto_servicio pro
    where mov.id_mov_alm=det.id_mov_alm
      and det.id_articulo=pro.id_serv_pro 
      and mov.id_mov_alm=$id_mov_alm";
//echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    // aumentar arreglado 22/04/2015
    function guardar_solicitud_primero() {
        //$respuesta = "";
        $ids = explode("|", $this->input->post("ids"));
        // $id_sol=explode("|", $this->input->post("id_sol"));
        $id_grup = explode("|", $this->input->post("id_grup"));
        //$id_pro=explode("|", $this->input->post("id_pro"));
        $can_a = explode("|", $this->input->post("can_a"));
        $can_u = explode("|", $this->input->post("can_u"));
        $cant_t = explode("|", $this->input->post("can_t"));
        $just = explode("|", $this->input->post("jus"));
        $sn = explode("|", $this->input->post("sn"));
        $cn = explode("|", $this->input->post("cn"));
        //$proy = explode("|", $this->input->post(""));
        $obser = explode("|", $this->input->post("obser"));
        date_default_timezone_set("Etc/GMT+4");


        $datos = array(
            'id_cod_user' => $this->session->userdata('id_admin'),
            //'id_cod_user' => $this->input->post('id_admin'),// no esta guardando bien
            'id_movi_alm' => $this->input->post('id_mov'),
            'estado_devolucion' => "Guardado",
            'fh_registro_dev' => date("Y-m-d H:i:s"), /// falta definir
            'comentario_dev' => $this->input->post('comenta'),
            'id_usuario_enc' => $this->input->post('encar'),
            'id_proyecto_sol' => $this->input->post('proy'),
        );

        $this->db->insert('solicitud_devolucion', $datos);
        $id_insert = ($this->db->insert_id());
        //proceso para dal alta de detalle

        for ($i = 1; $i < count($ids); $i++) {
            $datos = array(
                'id_solicitud_dev' => $id_insert,
                //'id_equipo_herra_dev' => $this->input->post('id_grup'),
                // 'id_equipo_herra_dev' =>  $id_grup[$i],
                'id_producto_servicio' => $ids[$i],
                'cantidad_asignada' => $can_a[$i],
                'cantidad_utilizada' => $can_u[$i],
                'cantidad_devuelto' => $cant_t[$i],
                'justificacion_dev' => $just[$i],
                'SN' => $sn[$i],
                'CN' => $cn[$i],
                'observacion_producto' => $obser[$i],
                'item' => $i
                    //'id_producto_servicio' => $coments[$i]
            );
            $result[$i] = $this->db->insert('detalle_devolucion', $datos);

            $respuesta = "<input type='hidden' id='ayudata' value='$id_insert'><input type='hidden' id='proceso' value='INSERT'>
                    <div class='fondo_verde'> El registro ha sido guardado correctamente...!!! </div> ";
        }
        return($respuesta);
    }

    function editar_solicitud_devolucion($id_det) {

        $ids = explode("|", $this->input->post("ids"));
        // $id_sol=explode("|", $this->input->post("id_sol"));
        $id_grup = explode("|", $this->input->post("id_grup"));
        //$id_pro=explode("|", $this->input->post("id_pro"));
        $can_a = explode("|", $this->input->post("can_a"));
        $can_u = explode("|", $this->input->post("can_u"));
        $cant_t = explode("|", $this->input->post("can_t"));
        $just = explode("|", $this->input->post("jus"));
        $sn = explode("|", $this->input->post("sn"));
        $cn = explode("|", $this->input->post("cn"));
        $obser = explode("|", $this->input->post("obser"));
        date_default_timezone_set("Etc/GMT+4");


        $datos = array(
            'id_cod_user' => $this->session->userdata('id_admin'),
            //'id_cod_user' => $this->input->post('id_admin'),// no esta guardando bien
            'id_movi_alm' => $this->input->post('id_mov'),
            'estado_devolucion' => "Guardado",
            'fh_registro_dev' => date("Y-m-d H:i:s"), /// falta definir
            'comentario_dev' => $this->input->post('comenta'),
            'id_proyecto_sol' =>$this->input->post('proy'),
            'id_usuario_enc' => $this->input->post('encar'),
        );

        $this->db->where('id_solicitud_dev', $id_det);
        $this->db->update('solicitud_devolucion', $datos);
        //$id_insert = ($this->db->insert_id());
        //proceso para dal alta de detalle
        $sql2 = 'select * from detalle_devolucion det where det.id_solicitud_dev=' . $id_det;
        $consulta2 = $this->db->query($sql2);
        for ($i = 1; $i < count($ids); $i++) {
            $datos = array(
                'id_solicitud_dev' => $id_det,
                //'id_equipo_herra_dev' => $this->input->post('id_grup'),
                // 'id_equipo_herra_dev' =>  $id_grup[$i],
                'id_producto_servicio' => $ids[$i],
                'cantidad_asignada' => $can_a[$i],
                'cantidad_utilizada' => $can_u[$i],
                'cantidad_devuelto' => $cant_t[$i],
                'justificacion_dev' => $just[$i],
                'SN' => $sn[$i],
                'CN' => $cn[$i],
                'observacion_producto' => $obser[$i],
                'item' => $i
                    //'id_producto_servicio' => $coments[$i]
            );
           // echo "porque o funciona waaaa!!!!" . $consulta2->row($i - 1)->id_detalle_dev;
            $this->db->where('id_detalle_dev', $consulta2->row($i - 1)->id_detalle_dev);
            $result[$i] = $this->db->update('detalle_devolucion', $datos);

            $respuesta = "<input type='hidden' id='ayudata' value='$id_det'><input type='hidden' id='proceso' value='INSERT'>
                    <div class='fondo_verde'> Actualización finalizada!!! </div> ";
        }
        return($respuesta);
    }

    //funciones para el doc. listado.
    function comparar_enviado_si($id_proy) {
        $sql = "select nombre from proyecto p
              where p.id_proy='$id_proy' ";
        $consulta = $this->db->query($sql);
        return($consulta);

        //$estado='enviado';
    }

    function obtener_detalle_solicitud($id_sol_dev) {
        $sql = "select det.item ,  pro.cod_serv_prod, pro.nombre_titulo,pro.descripcion, pro.tipo, 
            det.cantidad_asignada,det.cantidad_utilizada,det.cantidad_devuelto,
            det.justificacion_dev,sol.comentario_dev

            from solicitud_devolucion sol,
            detalle_devolucion det,
            producto_servicio pro


            where 
            det.id_producto_servicio=pro.id_serv_pro
            and sol.id_solicitud_dev=det.id_solicitud_dev 
            and sol.id_solicitud_dev='$id_sol_dev'";
        $consulta = $this->db->query($sql);
        return($consulta);

        //$estado='enviado';
    }

    //estoy aumentando 21/04/15
    function obtener_detalle_devolucion($id_mov_alm) {
        $sql = "SELECT pro.cod_serv_prod,pro.nombre_titulo,pro.tipo,det.cantidad_asignada,sol.estado_devolucion,
        det.cantidad_utilizada,det.cantidad_devuelto,det.justificacion_dev
FROM solicitud_devolucion sol, detalle_devolucion det,producto_servicio pro
where  sol.id_solicitud_dev=det.id_solicitud_dev
        and det.id_producto_servicio= pro.id_serv_pro
        and sol.id_movi_alm=$id_mov_alm";
        $consulta = $this->db->query($sql);
        //echo $sql;
        return($consulta);
    }

    function cambiar_estado($estado, $id_sol_dev) {

        // $respuesta="";
        $datos = array(
            'estado_devolucion' => $estado,
        );
        $this->db->where('id_solicitud_dev', $id_sol_dev);
        $upd = $this->db->update('solicitud_devolucion', $datos);
        echo "<input type='hidden' id='ayudata' value='$id_sol_dev'>";
        //echo 'FUNCIONA';
        //echo $upd;
    }

    function obtener_encargado_almacen() {
        $sql = "select al.id_usuario,u.nombre,u.ap_paterno,u.ap_materno
                 from almacen_admin al,usuarios u
                 where u.cod_user=al.id_usuario
                  and  al.estado_asig=1
                  group by al.id_usuario";
        $consulta = $this->db->query($sql);
        // echo $sql;
        return($consulta);
    }

    function ver_al_detalle_solicitud() {
        
    }

    function obtener_detalle_solicitud_enviada($id_solicitud_dev) {
        $sql = "select mov.id_movi_alm, det.item, pro.cod_serv_prod,pro.nombre_titulo,
            det.id_producto_servicio,mov.id_solicitud_dev,pro.id_serv_pro,det.SN,det.CN,
        pro.descripcion,pro.tipo, det.observacion_producto,det.cantidad_asignada,mov.estado_devolucion,
        det.cantidad_utilizada,det.cantidad_devuelto  ,mov.comentario_dev,det.justificacion_dev 
    from  solicitud_devolucion mov, detalle_devolucion det, producto_servicio pro
    where mov.id_solicitud_dev=det.id_solicitud_dev
      and det.id_producto_servicio=pro.id_serv_pro 
      and mov.id_solicitud_dev=$id_solicitud_dev";
       // echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
        //echo $sql;
    }

    //aumentado el 27/04/2015
    function listar_buscar_devolucion($busqueda, $ini, $cant) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select det.* ,us.*, pro.nombre as nombre_proy
from solicitud_devolucion det, usuarios us, proyecto pro
where det.id_proyecto_sol=pro.id_proy
and us.cod_user=det.id_cod_user
and det.estado_devolucion <>'guardado'
and concat(det.id_solicitud_dev,det.comentario_dev,us.nombre,us.ap_paterno,us.ap_materno,pro.nombre) lIKE '%$busqueda%'
order by det.id_solicitud_dev DESC limit $ini,$cant";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_buscar_devolucion_cantidad($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
       //echo 'esta funcionando incorrectamente';
        $sql = "select det.* ,us.*, pro.nombre as nombre_proy
from solicitud_devolucion det, usuarios us, proyecto pro
where det.id_proyecto_sol=pro.id_proy
and us.cod_user=det.id_cod_user
and det.estado_devolucion <>'guardado'
and concat(det.id_solicitud_dev,det.comentario_dev,us.nombre,us.ap_paterno,us.ap_materno,pro.nombre) lIKE '%$busqueda%'
order by det.id_solicitud_dev  DESC ";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function buscar_personal($id_cod_user) {
        $sql = "select u.nombre,u.ap_paterno,u.ap_materno
                from solicitud_devolucion sol, usuarios u
                where sol.id_cod_user=u.cod_user";
        $consulta=  $this->db->query($sql);
        return ($consulta);
    }
     function obtener_detalle_devolucion_enviado($id_sol_devolucion) {
        $sql = "SELECT us.nombre,us.ap_paterno,us.ap_materno,pro.nombre as nombre_proy,sol.fh_registro_dev,sol.comentario_dev,
ser.nombre_titulo,dd.cantidad_asignada,dd.cantidad_utilizada,dd.cantidad_devuelto,dd.justificacion_dev,ser.cod_serv_prod
FROM solicitud_devolucion sol,usuarios us, proyecto pro, detalle_devolucion dd,producto_servicio ser
where sol.id_solicitud_dev=$id_sol_devolucion
and sol.id_cod_user=us.cod_user
and sol.id_proyecto_sol=pro.id_proy
and dd.id_solicitud_dev=sol.id_solicitud_dev
and dd.id_producto_servicio=ser.id_serv_pro";
        $consulta = $this->db->query($sql);
        //echo $sql;
        return($consulta);
    }
    ////para cambio
    function  obtener_solicitud_devolucion($id_mov_alm)
    {
        $sql="select *
                from solicitud_devolucion sol
                where sol.id_movi_alm=$id_mov_alm";
        $consulta=$this->db->query($sql);
        if($consulta->num_rows()>0)
        {
            return ($consulta->row(0)->id_solicitud_dev);
            
        }
        return(0);
    }

}

?>
