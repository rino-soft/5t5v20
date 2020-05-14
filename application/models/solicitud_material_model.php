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
class solicitud_material_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function obt_estado() {
        $id_sol = 1;
        $sql = "select * from solicitud_material where id_solicitud_mat=$id_sol";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obt_sol_mat($id_sol) {

        $sql = "select sm.*,p.nombre from solicitud_material sm, proyecto p where sm.id_solicitud_mat=$id_sol and sm.id_proy=p.id_proy";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function movi_sm($id_sol) {

        $sql = "select * from movimiento_almacen a, solicitud_material sm 
                where sm.id_user_encargado=a.id_user_er and  sm.id_solicitud_mat=$id_sol";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_detalle_sol_mat($id_sol) {
        $sql = "select * from detalle_solicitud_material dsm,  producto_servicio ps
                where dsm.id_solicitud_mat=$id_sol and ps.id_serv_pro=dsm.id_producto_serv";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_nuevo_sol_mat($id_mov) {
        $sql = "select * from solicitud_material sm
                where sm.id_solicitud_mat=$id_mov";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obt_per_encargado($id_sol_mat) {
        $sql = "select * from solicitud_material sm, usuarios u
                where sm.id_user_encargado=u.cod_user
                and sm.id_solicitud_mat=$id_sol_mat";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    /* function save_sol_mat() {

      $respuesta = "";

      $ids = explode("|", $this->input->post("ids"));
      $idps = explode("|", $this->input->post("r_idps"));
      $sm = explode("|", $this->input->post("r_sm"));
      $cant = explode("|", $this->input->post("r_cant"));
      $coments = explode("|", $this->input->post("r_coments"));

      //datos para adicionar datos de inicio
      date_default_timezone_set("Etc/GMT+4");
      $datos = array(
      'id_user_created' => $this->session->userdata('id_admin'),
      //'id_user_er' => $this->input->post('cod_user'),
      'id_user_er' => $this->input->post('cod_er'),
      'tipo_movimiento' => $this->input->post('tipo_mov'),
      'id_doc_origen' => $this->input->post('cod_sm'),
      'tipo_doc_origen' => $this->input->post('nom_cod_sm'),
      'fh_reg' => date("Y-m-d H:i:s"),
      'proyecto' => $this->input->post('proyt'),
      'id_almacen'=> $this->input->post('id_almacen'),
      'comentario' => $this->input->post('coment_gral')
      );
      if ($this->input->post('area_adicionar') == 0) {
      $this->db->insert('movimiento_almacen', $datos);
      $id_insert = ($this->db->insert_id());
      //proceso para dal alta de detalle

      for ($i = 1; $i < count($ids); $i++) {
      $datos = array(
      'id_mov_alm' => $id_insert,
      'id_articulo' => $idps[$i],
      'cantidad' => $cant[$i],
      'observaciones' => $coments[$i]
      );
      $result[$i] = $this->db->insert('detalle_mov_almacen', $datos);
      //  $respuesta = "<input type='hidden' id='ayudata' value='$result[$i]'><input type='hidden' id='proceso' value='INSERT'>";
      }

      return($result);
      }
      return($respuesta);
      }
     */

    function obtener_nuevo_mov1() {
        $sql = "select * from movimiento_almacen ma
                where 1";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function entregar_sol_mat() {

        $respuesta = "";

        $ids = explode("|", $this->input->post("ids"));
        $idps = explode("|", $this->input->post("r_idps"));
        $sm = explode("|", $this->input->post("r_sm"));
        $cant = explode("|", $this->input->post("r_cant"));
        $coments = explode("|", $this->input->post("r_coments"));

        //datos para adicionar datos de inicio
        date_default_timezone_set("Etc/GMT+4");
        $datos = array(
            'id_user_created' => $this->session->userdata('id_admin'),
            'id_user_er' => $this->input->post('cod_user'),
            'tipo_movimiento' => $this->input->post('tipo_mov'),
            'fh_reg' => date("Y-m-d H:i:s"),
            'id_proyecto' => $this->input->post('proyt'),
            'comentario' => $this->input->post('coment_gral')
        );
        if ($this->input->post('area_adicionar') == 0) {
            $this->db->insert('movimiento_almacen', $datos);
            $id_insert = ($this->db->insert_id());
            //proceso para dal alta de detalle

            for ($i = 1; $i < count($ids); $i++) {
                $datos = array(
                    'id_mov_alm' => $id_insert,
                    'id_articulo' => $idps[$i],
                    'cantidad' => $cant[$i],
                    'observaciones' => $coments[$i]
                );
                $result[$i] = $this->db->insert('detalle_mov_almacen', $datos);
                //  $respuesta = "<input type='hidden' id='ayudata' value='$result[$i]'><input type='hidden' id='proceso' value='INSERT'>";
            }

            return($result);
        }
        return($respuesta);
    }

    function codigo_sol_mat($cope, $cuse) {

        $sql = "select * from usuarios U where u.cod_operacional=$cope and u.cod_user=$cuse";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {

            $codigo = '<input type="hidden" value="1" id="llave"> <input type="hidden" value="el codigo se encontro" id="mensaje" >';

            $respuesta = "";

            $ids = explode("|", $this->input->post("ids"));
            $idps = explode("|", $this->input->post("r_idps"));
            $sm = explode("|", $this->input->post("r_sm"));
            $cant = explode("|", $this->input->post("r_cant"));
            $coments = explode("|", $this->input->post("r_coments"));

            //datos para adicionar datos de inicio
            date_default_timezone_set("Etc/GMT+4");
            $datos = array(
                'id_user_created' => $this->session->userdata('id_admin'),
                'id_user_er' => $this->input->post('cod_user'),
                'tipo_movimiento' => $this->input->post('tipo_mov'),
                'fh_reg' => date("Y-m-d H:i:s"),
                'proyecto' => $this->input->post('proyt'),
                'comentario' => $this->input->post('coment_gral'),
                'id_doc_origen' => $this->input->post('cod_sm'),
                'tipo_doc_origen' => $this->input->post('nom_cod_sm'),
                'estado' => $this->input->post('est')
            );
            if ($this->input->post('area_adicionar') == 0) {
                $this->db->insert('movimiento_almacen', $datos);
                $id_insert = ($this->db->insert_id());
                //proceso para dal alta de detalle

                for ($i = 1; $i < count($ids); $i++) {
                    $datos = array(
                        'id_mov_alm' => $id_insert,
                        'id_articulo' => $idps[$i],
                        'cantidad' => $cant[$i],
                        'observaciones' => $coments[$i]
                    );
                    $this->db->insert('detalle_mov_almacen', $datos);
                }
            }
            return($codigo);
        }
        else
            $codigo = '<input type="hidden" value="0" id="llave"> <input type="hidden" value="el codigo no se encontro" id="mensaje" >';
        return $codigo;
    }

    function obt_per_encargado1($cuse) {

        $sql = "select * from solicitud_material sm, usuarios u 
where sm.id_user_encargado=u.cod_user and u.cod_user=$cuse";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function save_sol_mat() {

        $respuesta = "";
        $ids = explode("|", $this->input->post("ids"));
        $idps = explode("|", $this->input->post("r_idps"));
        $sm = explode("|", $this->input->post("r_sm"));
        $cant = explode("|", $this->input->post("r_cant"));
        $coments = explode("|", $this->input->post("r_coments"));
        //datos para adicionar datos de inicio

        date_default_timezone_set("Etc/GMT+4");
        $datos = array(
            'id_user_created' => $this->session->userdata('id_admin'),
            //'id_user_er' => $this->input->post('cod_user'),
            'id_user_er' => $this->input->post('cod_user'),
            'tipo_movimiento' => "Salida",
            'id_doc_origen' => $this->input->post('cod_sm'),
            'tipo_doc_origen' => "Solicitud_material",
            'fh_reg' => date("Y-m-d H:i:s"),
            'id_proyecto' => $this->input->post('proyt'),
            'id_almacen' => $this->input->post('id_almacen'),
            'comentario' => $this->input->post('coment_gral'),
            'estado' => "Guardado",
        );

        $this->db->insert('movimiento_almacen', $datos);
        $id_insert = ($this->db->insert_id());
        //proceso para dal alta de detalle
        $respuesta = "<input type='hidden' id='ayudata' value='$id_insert'><input type='hidden' id='proceso' value='INSERT'> Se ha registrado correctamente!!!";
        
        for ($i = 1; $i < count($ids); $i++) {
            $datos = array(
                'id_mov_alm' => $id_insert,
                'id_articulo' => $idps[$i],
                'cantidad' => $cant[$i],
                'observaciones' => $coments[$i],
                'id_det_doc_origen' => $sm[$i],
                'det_doc_origen' => "detalle solicitud material",
            );
            $this->db->insert('detalle_mov_almacen', $datos);
        }
        return($respuesta);
    }
    function editar_solicitud_material($id_det) {

        $respuesta = "";
        $ids = explode("|", $this->input->post("ids"));
        $idps = explode("|", $this->input->post("r_idps"));
        $sm = explode("|", $this->input->post("r_sm"));
        $cant = explode("|", $this->input->post("r_cant"));
        $coments = explode("|", $this->input->post("r_coments"));

        //datos para adicionar datos de inicio

        date_default_timezone_set("Etc/GMT+4");
        $datos = array(
            'id_user_created' => $this->session->userdata('id_admin'),
            //'id_user_er' => $this->input->post('cod_user'),
            'id_user_er' => $this->input->post('cod_user'),
            'tipo_movimiento' => $this->input->post('tipo_mov'),
            'id_doc_origen' => $this->input->post('cod_sm'),
            'tipo_doc_origen' => $this->input->post('nom_cod_sm'),
            'fh_reg' => date("Y-m-d H:i:s"),
            'id_proyecto' => $this->input->post('proyt'),
            'id_almacen' => $this->input->post('id_almacen'),
            'comentario' => $this->input->post('coment_gral'),
            'estado' => "Guardado",
        );
        $this->db->where('id_mov_alm', $id_det);
        $this->db->update('movimiento_almacen', $datos);
        //$id_insert = ($this->db->insert_id());
        //proceso para dal alta de detalle
        $sql2 = 'select * from detalle_mov_almacen dma where dma.id_mov_alm=' . $id_det;
        $consulta2 = $this->db->query($sql2);
        for ($i = 1; $i < count($ids); $i++) {
            $datos = array(
                'id_mov_alm' => $id_det,
                'id_articulo' => $idps[$i],
                'cantidad' => $cant[$i],
                'observaciones' => $coments[$i],
                'id_det_doc_origen' => $sm[$i],
                'det_doc_origen' => "detalle solicitud material",
            );
            // echo "porque o funciona waaaa!!!!" . $consulta2->row($i - 1)->id_detalle_dev;
            $this->db->where('id_det_mov_alm', $consulta2->row($i - 1)->id_det_mov_alm);
            $this->db->update('detalle_mov_almacen', $datos);

            $respuesta = "<input type='hidden' id='ayudata' value='$id_det'><input type='hidden' id='proceso' value='INSERT'>
                    <div class='f11 fondo_verde'> Actualización finalizada!!! </div> ";
        }
        return($respuesta);
    }

    function listar_sol_mats_user($b, $i, $c) {
        $busqueda = str_replace(" ", "%", $b);
        $sesion_owner = $this->session->userdata('id_admin');
        $sql = "select sm.*,u.cod_user,u.nombre,u.ap_paterno,u.ap_materno  from solicitud_material sm , usuarios u
            where  u.cod_user=sm.id_user_encargado
            and concat(sm.id_solicitud_mat,sm.comentario_obs,sm.fh_registro,sm.estado,u.nombre,u.ap_paterno,u.ap_materno ) LIKE '%$busqueda%'
            and sm.id_user_created = $sesion_owner
            order by sm.id_solicitud_mat DESC 
            limit $i,$c";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_sol_mats_user_cantidad($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sesion_owner = $this->session->userdata('id_admin');
        $sql = "select sm.*,u.cod_user,u.nombre,u.ap_paterno,u.ap_materno  from solicitud_material sm , usuarios u
            where  u.cod_user=sm.id_user_encargado
            and concat(sm.id_solicitud_mat,sm.comentario_obs,sm.fh_registro,sm.estado,u.nombre,u.ap_paterno,u.ap_materno ) LIKE '%$busqueda%'
            and sm.id_user_created = $sesion_owner
            order by sm.id_solicitud_mat DESC ";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function listar_sol_mats_user_enviada($b, $i, $c) {
        $busqueda = str_replace(" ", "%", $b);
        $sesion_owner = $this->session->userdata('id_admin');
        $sql = "select sm.*,u.cod_user,u.nombre,u.ap_paterno,u.ap_materno  from solicitud_material sm , usuarios u
            where  u.cod_user=sm.id_user_encargado
            and concat(sm.id_solicitud_mat,sm.comentario_obs,sm.fh_registro,sm.estado,u.nombre,u.ap_paterno,u.ap_materno ) LIKE '%$busqueda%'
            and sm.id_personal_destino = $sesion_owner
                and (sm.estado<>'Guardado' or sm.estado<>'Anulado')
            order by sm.id_solicitud_mat DESC 
            limit $i,$c";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_sol_mats_user_cantidad_enviada($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sesion_owner = $this->session->userdata('id_admin');
        $sql = "select * from solicitud_material sm , usuarios u
            where  u.cod_user=sm.id_user_encargado
            and concat(sm.id_solicitud_mat,sm.comentario_obs,sm.fh_registro,sm.estado,u.nombre,u.ap_paterno,u.ap_materno ) LIKE '%$busqueda%'
             and sm.id_personal_destino = $sesion_owner
                and (sm.estado<>'Guardado' or sm.estado<>'Anulado')
            order by sm.id_solicitud_mat DESC ";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function cambiar_estado_sol_mat($id_sm, $e) {
        $sql = "update solicitud_material set estado='$e' where id_solicitud_mat='$id_sm'";
        $consulta = $this->db->query($sql);
        if ($consulta != 0)
            return('<div class="OK"> se ha enviado correctamente!</div>');
        else
            return '<div class="NO"> Error !! no se pudo enviar , comuniquese con el administrador</div>';
    }

    function guardar_solmat() {
       // echo "ingresa a la funcion";
        $respuesta = "";
        $ids = explode("|", $this->input->post("ids"));

        $coments = explode("|", $this->input->post("coments"));
        $cants = explode("|", $this->input->post("cants"));
        $ums = explode("|", $this->input->post("ums"));
        //datos para adicionar datos de inicio

        date_default_timezone_set("Etc/GMT+4");
        $datos = array(
            'id_user_created' => $this->session->userdata('id_admin'),
            'id_proy' => $this->input->post('id_proyecto'), //falta dimanizar
            'id_user_encargado' => $this->input->post('id_per_resp'), //falta dinamizar,
            'fh_registro' => date("Y-m-d H:i:s"),
            'titulo' => $this->input->post('titulo_sm'),
            'tipo_trabajo' => $this->input->post('tipo_trabajo'),
            'estado' => "Guardado",
            'comentario_obs' => $this->input->post('coment_gral'),
            'id_personal_destino' => $this->input->post('resp_alm_envio')//lucho
        );

        if ($this->input->post('id_sol_mat') == 0) {
            $this->db->insert('solicitud_material', $datos);
            $id_insert = ($this->db->insert_id());
            //proceso para dal alta de detalle

            for ($i = 1; $i < count($ids); $i++) {
                $datos = array(
                    'id_solicitud_mat' => $id_insert,
                    'id_producto_serv' => $ids[$i],
                    'id_equipo_herra' => 0,
                    'cantidad_sol' => $cants[$i],
                    'comentario' => $coments[$i],
                    'item' => $i,
                    'cantidad_entregada' => $cants[$i],
                    'estado' => "Activo",
                );
                $this->db->insert('detalle_solicitud_material', $datos);
            }
            $respuesta = "<input type='hidden' id='ayudata' value='$id_insert'><input type='hidden' id='proceso' value='INSERT'>";
        } else {/// falta hay que revisar RUBEN PAYRUMANI INO
            $sql = "delete from detalle_solicitud_material where id_solicitud_mat=" . $this->input->post('id_sol_mat');
            $consulta = $this->db->query($sql);

            $this->db->where('id_solicitud_mat', $this->input->post('id_sol_mat'));
            $upd = $this->db->update('solicitud_material', $datos);
            for ($i = 1; $i < count($ids); $i++) {
                $datos = array(
                    'id_solicitud_mat' => $this->input->post('id_sol_mat'),
                    'id_producto_serv' => $ids[$i],
                    'id_equipo_herra' => 0,
                    'cantidad_sol' => $cants[$i],
                    'comentario' => $coments[$i],
                    'item' => $i,
                    'cantidad_entregada' => $cants[$i],
                    'estado' => "Activo",
                );
                $this->db->insert('detalle_solicitud_material', $datos);
            }
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_sol_mat') . "'><input type='hidden' id='proceso' value='UPDATE'><div class='OK'> Actualizando...</div>";
        }
        return($respuesta);
    }

    function cambiar_estado_solicitud($estado, $idsm) {

        // $respuesta="";
        $datos = array(
            'estado' => $estado,
        );
        $this->db->where('id_mov_alm', $idsm);
        $upd = $this->db->update('movimiento_almacen', $datos);

        //echo 'FUNCIONA';
        //echo $upd;
    }

    function obtener_cantidad($id_sol_mat) {
        $sesion_owner = $this->session->userdata('id_admin');
        $sql = "";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function cambiar_estado_ma($estado, $idsm) {

        // $respuesta="";
        $datos = array(
            'estado' => $estado,
        );
        $this->db->where('id_mov_alm', $idsm);
        $upd = $this->db->update('movimiento_almacen', $datos);

        //echo 'FUNCIONA';
        //echo $upd;
    }

}

?>
