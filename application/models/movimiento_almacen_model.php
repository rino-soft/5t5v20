
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
class movimiento_almacen_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //put your code here


    function save_mov_alm() {
        $respuesta = "";
        $datos = array(
            'razon_social' => $this->input->post('rs'),
            'nit' => $this->input->post('nit'),
            'telefonos' => $this->input->post('tel'),
            'direccion' => $this->input->post('dir'),
            'estado' => "Activo",
            'rubro' => $this->input->post('rub'),
        );
        if ($this->input->post('id_cliente') == 0) {
            $this->db->insert('cliente', $datos);
            $id_cli_nuevo = ($this->db->insert_id());
            $respuesta = "<input type='hidden' id='ayudata' value='$id_cli_nuevo'><input type='hidden' id='proceso' value='INSERT'>";
        } else {
            $this->db->where('id_cliente', $this->input->post('id_cli'));
            $upd = $this->db->update('cliente', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='$upd'><input type='hidden' id='proceso' value='UPDATE'>";
        }
        return($respuesta);
    }

    function save_pro_serv() {
        $respuesta = "";
        $ids = explode("|", $this->input->post("ids"));
        $idps = explode("|", $this->input->post("r_idps"));
        $ma = explode("|", $this->input->post("r_ma"));
        $cant = explode("|", $this->input->post("r_cant"));

        $coments = explode("|", $this->input->post("r_coments"));
        $codp = explode("|", $this->input->post("r_cup"));
        $senum = explode("|", $this->input->post("r_sn"));


        //datos para adicionar datos de inicio
        date_default_timezone_set("Etc/GMT+4");
        $datos = array(
            'id_user_created' => $this->session->userdata('id_admin'),
            // 'cantidad' => $this->input->post('subs'),
            //'estado' => "Iniciado",

            'id_user_er' => $this->input->post('cod_user'),
            'tipo_movimiento' => $this->input->post('tipo_mov'),
            'fh_reg' => date("Y-m-d H:i:s"),
            'id_proyecto' => $this->input->post('proyt'),
            'id_almacen' => $this->input->post('cod_alm'),
            'id_doc_origen' => "",
            'tipo_doc_origen' => $this->input->post('tipo_doc_o'),
            'estado' => $this->input->post('estado'),
            'comentario' => $this->input->post('coment_gral')
        );
        if ($this->input->post('area_adicionar') == 0) {
            $this->db->insert('movimiento_almacen', $datos);
            $id_insert = ($this->db->insert_id());
            //proceso para dal alta de detalle
            $respuesta = "<input type='hidden' id='ayudata' value='$id_insert'><input type='hidden' id='proceso' value='INSERT'><div class='OK'> Ultimo estado : Guardado </div>";

            for ($i = 1; $i < count($ids); $i++) {
                $codigonuevo="";
                $codigonuevo=$codp[$i];
                if($codp[$i]=="")
                    $codigonuevo=$this->siguiente_codigo_propio_empresa($idps[$i]);
                $datos = array(
                    'id_mov_alm' => $id_insert,
                    'item' => $i,
                    'id_articulo' => $idps[$i],
                    'cantidad' => $cant[$i],
                    'observaciones' => $coments[$i],
                    'cod_prop_sts_equipo' => $codigonuevo,
                    'SN' => $senum[$i]
                );
                $this->db->insert('detalle_mov_almacen', $datos);
                $id_insert_det = ($this->db->insert_id());
                //echo 'result' + $result[$i];
                //  $respuesta = "<input type='hidden' id='ayudata' value='$result[$i]'><input type='hidden' id='proceso' value='INSERT'>";
                $this->registro_kardex_nuevo($this->input->post('cod_alm'), $idps[$i], $cant[$i], "Ingreso", $id_insert_det);
            }
        }
        return($respuesta);
    }

    function edita_save_pro_serv($id_mov_alm) {
        $respuesta = "";
        $ids = explode("|", $this->input->post("ids"));
        $idps = explode("|", $this->input->post("r_idps"));
        $ma = explode("|", $this->input->post("r_ma"));
        $cant = explode("|", $this->input->post("r_cant"));

        $coments = explode("|", $this->input->post("r_coments"));
        $codp = explode("|", $this->input->post("r_cup"));
        $senum = explode("|", $this->input->post("r_sn"));
        // echo "mamamamamamamamamama :".$this->input->post("ids")."***";
        //datos para adicionar datos de inicio
        date_default_timezone_set("Etc/GMT+4");
        $datos = array(
            'id_user_created' => $this->session->userdata('id_admin'),
            // 'cantidad' => $this->input->post('subs'),
            //'estado' => "Iniciado",

            'id_user_er' => $this->input->post('cod_user'),
            'tipo_movimiento' => $this->input->post('tipo_mov'),
            'fh_reg' => date("Y-m-d H:i:s"),
            'id_proyecto' => $this->input->post('proyt'),
            'id_almacen' => $this->input->post('cod_alm'),
            'id_doc_origen' => "",
            'tipo_doc_origen' => $this->input->post('tipo_doc_o'),
            'estado' => $this->input->post('estado'),
            'comentario' => $this->input->post('coment_gral')
        );

        $this->db->where('id_mov_alm', $id_mov_alm);
        $upd = $this->db->update('movimiento_almacen', $datos);
        //proceso para dal alta de detalle
        $sql_sel = "select * from detalle_mov_almacen d, movimiento_almacen m where d.id_mov_alm = m.id_mov_alm and d.id_mov_alm=" . $id_mov_alm;
        $resp = $this->db->query($sql_sel);
        foreach ($resp->result() as $kar) {
            $this->registro_kardex_nuevo($kar->id_almacen, $kar->id_articulo, $kar->cantidad, "Salida", -$kar->id_det_mov_alm); //1 id_almacen
        }
        $sqlborrado = "Delete from detalle_mov_almacen where id_mov_alm=" . $id_mov_alm;
        $consulta = $this->db->query($sqlborrado);
        //borra detalle anterior
        for ($i = 1; $i < count($ids); $i++) {
            //   echo "nueva adicion";
            $datos = array(
                'id_mov_alm' => $id_mov_alm,
                'item' => $i,
                'id_articulo' => $ids[$i],
                'cantidad' => $cant[$i],
                'observaciones' => $coments[$i],
                'cod_prop_sts_equipo' => $codp[$i],
                'SN' => $senum[$i]
            );
            $this->db->insert('detalle_mov_almacen', $datos);
            $id_insert_det = ($this->db->insert_id());
            //echo 'result' + $result[$i];
            //  $respuesta = "<input type='hidden' id='ayudata' value='$result[$i]'><input type='hidden' id='proceso' value='INSERT'>";
            $this->registro_kardex_nuevo($this->input->post('cod_alm'), $ids[$i], $cant[$i], "Ingreso", $id_insert_det);
        }
        $respuesta = "<input type='hidden' id='ayudata' value='" . $id_mov_alm . "'>
        <input type='hidden' id='proceso' value='UPDATE'><div class='OK'> La Actualizacion se ha realizado con EXITO !!</div>";

        //echo $respuesta;
        return($respuesta);
    }

//put your code here
    function save_mov_alm1() {



        $respuesta = "";
        $datos = array(
            'id_mov_alm' => $this->input->post('idma'),
            'fh_reg' => $this->input->post('fhr'),
            'tipo_movimiento' => $this->input->post('tm'),
        );
        if ($this->input->post('id_mov_alm') == 0) {
            $this->db->insert('movimiento_almacen', $datos);
            $id_mov_alm = ($this->db->insert_id());
            $respuesta = "<input type='hidden' id='ayudata' value='$id_mov_alm'><input type='hidden' id='proceso' value='INSERT'>";
        } else {
            $this->db->where('id_mov_alm', $this->input->post('idma'));
            $upd = $this->db->update('movimiento_almace', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='$id_mov_alm'><input type='hidden' id='proceso' value='UPDATE'>";
        }
        return($respuesta);
    }

    function guardar_mov_alm() {
        //modificar esta funcion para hacer el guardado crrespondiente
        $respuesta = "";
        $ids = explode("|", $this->input->post("ids"));

        $cods = explode("|", $this->input->post("cods"));
        $tits = explode("|", $this->input->post("tits"));
        $descs = explode("|", $this->input->post("descs"));
        $coments = explode("|", $this->input->post("coments"));
        $cants = explode("|", $this->input->post("cants"));
        $ums = explode("|", $this->input->post("ums"));
        $pus = explode("|", $this->input->post("pus"));
        $subs = explode("|", $this->input->post("subs"));

        //datos para adicionar datos de inicio
        date_default_timezone_set("Etc/GMT+4");
        $datos = array(
            'id_mov_alm' => $this->session->userdata('id_admin'),
            'fh_registro' => date("Y-m-d H:i:s"),
            'tipo_movimiento' => $this->input->post('rs'),
            'id_proyecto' => $this->input->post('totalpf'),
            'comentario' => $this->input->post('comen'),
            'tipo_doc_origen' => $this->input->post('tdo'),
        );
        if ($this->input->post('id_mov_alm') == 0) {
            $this->db->insert('movimiento_almacen', $datos);
            $id_insert = ($this->db->insert_id());
            //proceso para dal alta de detalle

            for ($i = 1; $i < count($ids); $i++) {
                $datos = array(
                    'id_mov_alm' => $id_insert,
                    'fh_reg' => $ids[$i],
                    'tipo_movimiento' => $cods[$i],
                    'id_proyecto' => $tits[$i],
                    'comentario' => $descs[$i],
                    'comentario' => $coments[$i],
                    'tipo_doc_origen' => $pus[$i],
                );
                $result[$i] = $this->db->insert('movimiento_almacen', $datos);
            }
            return($result);
        } else {
            $this->db->where('cod_user', $this->input->post('id_cli'));
            $upd = $this->db->update('usuario', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='$upd'><input type='hidden' id='proceso' value='UPDATE'>";
        }
        return($respuesta);
    }

    function listar_buscar_art($busqueda, $ini, $cant) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select * from detalle_mov_almacen dma ,producto_servicio
         where concat(ma.id_mov_alm,ma.fh_reg,ma.tipo_movimiento,ma.id_proyecto,ma.comentario,ma.tipo_doc_origen, ma.doc_respaldo, U.nombre) LIKE '%$busqueda%'
         order by ma.id_mov_alm ASC limit $ini,$cant";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function list_find_people($ini, $cant) {

        $sql = "select * from movimiento_almacen ma ,usuarios U 
         where  ma.id_user_er=U.cod_user 
         order by ma.id_mov_alm ASC limit $ini,$cant";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function cant_busqueda($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select * from producto_servicio ps WHERE concat(ps.cod_serv_prod,ps.nombre_titulo,ps.descripcion,ps.palabras_clave) LIKE '%$busqueda%'";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function list_find_people_cant() {

        $sql = "select * from movimiento_almacen ma, usuarios U 
            where  ma.id_user_er=U.cod_user
            order by ma.id_mov_alm ASC";


        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function ver_al_detalle($idm) {
        /*$sql = "select U.*, ma.*, dma.*, ps.*, p.id_proy, p.nombre as nombre_proy, p.estado 
        from movimiento_almacen ma ,usuarios U, detalle_mov_almacen dma, producto_servicio ps, proyecto p
        where ma.id_mov_alm='$idm'
        and ma.id_mov_alm=dma.id_mov_alm 
        and U.cod_user=ma.id_user_er
        and ps.id_serv_pro=dma.id_articulo  
        and p.id_proy=ma.id_proyecto";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);*/
	   $sql = "select U.*, ma.*,ma.fh_reg as fecha_registro_mov ,  dma.*,p.id_proy,p.nombre as nombre_proy, p.estado,ps.*
       from   ((((movimiento_almacen ma LEFT JOIN usuarios U ON U.cod_user=ma.id_user_er)
       left join detalle_mov_almacen dma on ma.id_mov_alm=dma.id_mov_alm)
       left join proyecto p on ma.id_proyecto=p.id_proy)
       left join producto_servicio ps on dma.id_articulo=ps.id_serv_pro)
       where ma.id_mov_alm=$idm";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_buscar_al_cantidad_detalle($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select * from movimiento_almacen ma ,usuarios U where ma.id_mov_alm='%$busqueda%'
            order by ma.id_mov_alm";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function obtener_detalle_ovpf($id_mov_alm) {
        $sql = "select * from movimiento_almacen where id_mov_alm=$id_mov_alm";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_mov_alm($id_ov_fp) {
        $sql = "select * from movimiento_almacen where id_mov_alm=$id_ov_fp";
        $consulta = $this->db->query($sql);
        $row = 0;
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row;
    }

    //mensaje
    function mensajes_ingreso() {


        $query = $this->db->get('movimiento_almacen');
        foreach ($query->result() as $fila) {
            $data[] = $fila;
        }
        return $data;
    }

    function obtener_ingreso($id) {
        $this->db->where('id_mov_alm', $id);
        $query = $this->db->get('movimiento_almacen');
        $fila = $query->row();
        return $fila;
    }

    function actualizar_mensaje_ingreso($id_mov_alm, $fh_reg, $tipo_movimiento, $id_proyecto, $comentario, $tipo_doc_origen, $doc_respaldo) {
        $data = array(
            'id_mov_alm' => $id_mov_alm,
            'fh_reg' => $fh_reg,
            'tipo_movimiento' => $tipo_movimiento,
            'id_proyecto' => $id_proyecto,
            'comentario' => $comentario,
            'tipo_doc_origen' => $tipo_doc_origen,
            'doc_respaldo' => $doc_respaldo
        );
        $this->db->where('id_mov_alm', $id_mov_alm);
        return $this->db->update('movimiento_almacen', $data);
    }

    function opc_sel1($busqueda, $ini, $cant, $opcs) {
        //alert("mmm"+$opcs);
        $sql = "select * from contacto_cliente CC where CC.nom_comp LIKE '%$opcs%'";
        $consulta = $this->db->query($sql);

        return($consulta);
    }

    function opc_sel_dinamico($busqueda, $ini, $cant, $opcs) {
        //alert("mmm"+$opcs);
        $sql = "select * from contacto_cliente CC where CC.nom_comp LIKE '%$opcs%'";
        $consulta = $this->db->query($sql);

        return($consulta);
    }

    function opc_sel_prov($busqueda, $ini, $cant, $opcs) {
        //cambiar consulta para proviciones
        $sql = "select * from contacto_cliente CC where CC.nom_comp LIKE '%$opcs%'";
        $consulta = $this->db->query($sql);

        return($consulta);
    }

    function guardar_ingreso_nuevo() {
        //echo"entra modelo";
        $respuesta = "";
        $datos = array(
            'fh_reg' => $this->input->post('fhr'),
            'tipo_movimiento' => $this->input->post('tm'),
            'id_proyecto' => $this->input->post('proy'),
            'comentario' => $this->input->post('com'),
            'tipo_doc_origen' => $this->input->post('tdo'),
            'doc_respaldo' => $this->input->post('dr'),
        );
        if ($this->input->post('id_mov_alm') == 0) {
            $this->db->insert('movimiento_almacen', $datos);
            $id_ma_nuevo = ($this->db->insert_id());
            $respuesta = "<input type='text' id='ayudata' value='$id_ma_nuevo'><input type='text' id='proceso' value='INSERT'>";
        } else {
            $this->db->where('id_mov_alm', $this->input->post('id_i'));
            $upd = $this->db->update('movimiento_almacen', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='$upd'><input type='hidden' id='proceso' value='UPDATE'>";
        }
        return($respuesta);
    }

    function eliminar_ingreso_nuevo() {
        //echo"entra modelo";
        $respuesta = "";
        $datos = array(
            'fh_reg' => $this->input->post('fhr'),
            'tipo_movimiento' => $this->input->post('tm'),
            'id_proyecto' => $this->input->post('proy'),
            'comentario' => $this->input->post('com'),
            'tipo_doc_origen' => $this->input->post('tdo'),
            'doc_respaldo' => $this->input->post('dr'),
        );
        if ($this->input->post('id_mov_alm') == 0) {
            $this->db->delete('movimiento_almacen', $datos);
            $id_ma_nuevo = ($this->db->delete_id());
            $respuesta = "<input type='text' id='ayudata' value='$id_ma_nuevo'><input type='text' id='proceso' value='DELETE'>";
        } else {
            $this->db->where('id_mov_alm', $this->input->post('id_i'));
            $upd = $this->db->delete('movimiento_almacen', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='$upd'><input type='hidden' id='proceso' value='UPDATE'>";
        }
        return($respuesta);
    }

    function insert_imagenes($file_name, $fecha) {
        $data = array(
            'nombre_foto' => $file_name,
            'fecha' => $fecha
        );
        return $this->db->insert('fotos', $data);
    }

    function find_mov_detalle($ini, $cant) {

        $osd = $this->input->post("buscar");
        $sql = "select * from movimiento_almacen ma, usuarios U  where ma.id_user_er=U.cod_user and U.cod_user=$osd
        order by ma.id_mov_alm ASC limit $ini,$cant";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function find_mov_detalle_cant() {
        $osd = $this->input->post("buscar");
        $sql = "select * from movimiento_almacen ma, usuarios U  where ma.id_user_er=U.cod_user and U.cod_user=$osd
        order by ma.id_mov_alm ASC";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function movi_ut($tipo) {
        $t = "ingreso";
        if ($tipo == 1)
            $t = "Salida";

        $sql = "select * from movimiento_almacen a, Usuarios U
                where U.cod_user=a.id_user_er
                and a.tipo_movimiento='$t'";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_detalle_movimiento1($id_mov) {
        $sql = "select * from detalle_mov_almacen dma,  producto_servicio ps
                where dma.id_mov_alm=$id_mov and ps.id_serv_pro=dma.id_articulo";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_detalle_movimiento_almacen($id_detalle_mov) {
        $sql = "select * from detalle_mov_almacen dma,movimiento_almacen ma,subregion_oficina so,proyecto p
                where dma.id_mov_alm=ma.id_mov_alm 
                and ma.id_oficina_reg=so.id_subregion
                and p.id_proy=ma.id_proyecto
                and dma.id_det_mov_alm=" . $id_detalle_mov;
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_nuevo_mov($id_mov) {
        $sql = "select * from movimiento_almacen ma
                where ma.id_mov_alm=$id_mov";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function movi_usuario_tipo($ini, $cant, $tipo, $id_user, $id_proy) {
        // $t = "salida";
        if ($id_proy == 0) {
            $sql = "select ma.*, U.*, p.id_proy, p.nombre as nombre_proy
            from movimiento_almacen ma, Usuarios U, proyecto p 
            where ma.id_user_er=$id_user 
            and U.cod_user=ma.id_user_er 
            and ma.tipo_movimiento='Salida'
            and p.id_proy=ma.id_proyecto 
            order by ma.id_mov_alm DESC limit $ini,$cant";
        } else {
            $sql = "select ma.*, U.*, p.id_proy, p.nombre as nombre_proy
            from movimiento_almacen ma, Usuarios U, proyecto p 
            where ma.id_user_er=$id_user 
            and U.cod_user=ma.id_user_er 
            and ma.tipo_movimiento='Salida'
            and p.id_proy=ma.id_proyecto
            and ma.id_proyecto=$id_proy 
            order by ma.id_mov_alm DESC limit $ini,$cant";
        }
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function movi_usuario_tipo_cantidad($tipo, $id_user, $id_proy) {

        if ($id_proy == 0) {
            $sql = "select ma.*, U.*, p.id_proy, p.nombre as nombre_proy
            from movimiento_almacen ma, Usuarios U, proyecto p 
            where ma.id_user_er=$id_user 
            and U.cod_user=ma.id_user_er 
            and ma.tipo_movimiento='Salida'
            and p.id_proy=ma.id_proyecto 
            order by ma.id_mov_alm DESC";
        } else {
            $sql = "select ma.*, U.*, p.id_proy, p.nombre as nombre_proy
            from movimiento_almacen ma, Usuarios U, proyecto p 
            where ma.id_user_er=$id_user 
            and U.cod_user=ma.id_user_er 
            and ma.tipo_movimiento='Salida'
            and p.id_proy=ma.id_proyecto
            and ma.id_proyecto=$id_proy 
            order by ma.id_mov_alm DESC";
        }
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function movi_usuario_tipo2($tipo, $id_user) {
        $t = "salida";
        if ($tipo == 1)
            $t = "Ingreso";

        $sql = " select U.cod_user from movimiento_almacen a, Usuarios U
                where a.id_user_er=$id_user and U.cod_user=a.id_user_er
                and a.tipo_movimiento='Ingreso'  
                group by U.cod_user ";
        $consulta = $sql;
        return($consulta);
    }

    ///movimiento de almacen

    function listar_buscar_al($busqueda, $ini, $cant) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "Select  ma.estado,proy.nombre as nombre_proy, ma.id_mov_alm, enc.nombre as nombre_user, enc.ap_paterno, enc.ap_materno, ma.fh_reg, ma.tipo_movimiento, ma.id_proyecto, ma.comentario, alm.nombre 
from ((((movimiento_almacen ma left join usuarios enc on ma.id_user_er = enc.cod_user)
    left join proyecto proy on ma.id_proyecto=proy.id_proy)
    left join almacen alm on  alm.id_almacen=ma.id_almacen)
    left join almacen_admin alma on ma.id_almacen=alma.id_almacen)
 where  concat(ma.id_mov_alm, ma.tipo_movimiento,ifnull(proy.nombre,''),alm.nombre,ifnull(enc.nombre,''),ifnull(enc.ap_paterno,''),ifnull(enc.ap_materno,'')) LIKE '%$busqueda%'
 and alma.id_usuario=" . $this->session->userdata('id_admin') . "  order by ma.id_mov_alm DESC limit $ini,$cant";
        //echo "<br>".$sql."<br>";
        /* $sql = "select ma.estado,p.nombre, p.nombre as nombre_proy, ma.id_mov_alm, u.nombre as nombre_user, u.ap_paterno, u.ap_materno, ma.fh_reg, ma.tipo_movimiento, ma.id_proyecto, ma.comentario, a.nombre  
          from movimiento_almacen ma, usuarios U, almacen  a, proyecto p ,usuarios uu, almacen_admin aa
          where ma.id_user_er=U.cod_user
          and uu.cod_user=aa.id_usuario
          and aa.id_almacen=a.id_almacen
          and a.id_almacen=ma.id_almacen
          and p.id_proy=ma.id_proyecto
          and uu.cod_user=".$this->session->userdata('id_admin')."
          and concat(ma.id_mov_alm, ma.tipo_movimiento, ma.id_proyecto, U.nombre, a.nombre) LIKE '%$busqueda%'
          order by ma.id_mov_alm DESC limit $ini,$cant"; */
        // echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_buscar_al_cantidad($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "Select  ma.estado,proy.nombre as nombre_proy, ma.id_mov_alm, enc.nombre as nombre_user, enc.ap_paterno, enc.ap_materno, ma.fh_reg, ma.tipo_movimiento, ma.id_proyecto, ma.comentario, alm.nombre 
from ((((movimiento_almacen ma left join usuarios enc on ma.id_user_er = enc.cod_user)
    left join proyecto proy on ma.id_proyecto=proy.id_proy)
    left join almacen alm on  alm.id_almacen=ma.id_almacen)
    left join almacen_admin alma on ma.id_almacen=alma.id_almacen)
 where  concat(ma.id_mov_alm, ma.tipo_movimiento,ifnull(proy.nombre,''),alm.nombre,ifnull(enc.nombre,''),ifnull(enc.ap_paterno,''),ifnull(enc.ap_materno,'')) LIKE '%$busqueda%'
 and alma.id_usuario=" . $this->session->userdata('id_admin') . "  order by ma.id_mov_alm DESC";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function obtener_user_proy($id_u) {
        $sql = "select distinct apc.id_proy, p.nombre as nombre_proyecto ,p.estado from admin_proyecto_cargo apc, proyecto p
                where apc.id_user=$id_u 
                and apc.id_proy=p.id_proy";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_user_proy_sel($id_u) {
        $sql = "select distinct p.nombre, p.id_proy, apc.id_user
                from admin_proyecto_cargo apc, proyecto p
                where apc.id_user=$id_u
                and apc.id_proy=p.id_proy";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_user_almacen_sel($id_u) {
        $sql = "select distinct a.id_almacen, a.nombre 
                from almacen_admin aa, almacen a
                where aa.id_usuario=$id_u
                and aa.id_almacen=a.id_almacen";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function movi_usuario_tipo_proyecto($ini, $cant, $tipo, $id_user, $id_proy) {
        // $t = "salida";
        if ($tipo == 1)
            $t = "Ingreso";

        $sql = "select * from movimiento_almacen ma, Usuarios U 
            where ma.id_user_er=$id_user 
            and U.cod_user=ma.id_user_er 
            and ma.id_proyecto= ma.tipo_movimiento='Salida' 
            order by ma.id_mov_alm DESC limit $ini,$cant";

        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function movi_usuario_tipo_proyecto_cantidad($tipo, $id_user, $id_proy) {
        $t = "salida";
        if ($tipo == 1)
            $t = "ingreso";

        $sql = "select * from movimiento_almacen ma, Usuarios U
                where ma.id_user_er=$id_user 
                and U.cod_user=ma.id_user_er
                and ma.id_proyecto=$id_proy
                and ma.tipo_movimiento='Salida'
                order by ma.id_mov_alm DESC";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function busqueda_serial_number() {
        $sql = "";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

//paulaaa
    /*  function seriales_registradas_existencia_almacen($id_almacen, $id_producto, $tipo) {
      $sql = "select * from movimiento_almacen m, detalle_mov_almacen d
      where m.id_mov_alm=d.id_mov_alm
      and d.id_articulo=$id_producto
      and m.id_almacen=$id_almacen
      group by d.sn";
      //echo $sql;
      $consulta = $this->db->query($sql);
      $i = 0;
      $respuesta = array();
      foreach ($consulta->result() as $registro) {
      $sql2 = "select * from movimiento_almacen m, detalle_mov_almacen d
      where m.id_mov_alm=d.id_mov_alm
      and d.id_articulo=$id_producto
      and m.id_almacen=$id_almacen
      and d.sn='$registro->SN'
      order by id_det_mov_alm DESC";
      //echo '<br>'.$sql2;
      $consulta2 = $this->db->query($sql2);
      if ($consulta2->num_rows() > 0) {
      if ($tipo != $consulta2->row(0)->tipo_movimiento) {
      $respuesta[$i] = "CP: " . $registro->cod_prop_sts_equipo . "* SN: " . $registro->SN;
      $i++;
      }
      }
      }
      return($respuesta);
      } */

    function seriales_registradas_existencia_almacen_tipo($id_almacen, $id_producto, $tipo) {
        $sql = "select *
                from detalle_mov_almacen det,movimiento_almacen mov
                where det.id_articulo=$id_producto
                and mov.id_almacen=$id_almacen
                group by det.SN";
         echo $sql; 
        $consulta = $this->db->query($sql);
        //$i = 0;
        $respuesta = array();
        $max = 0;
        $row_ultimo = "";
        foreach ($consulta->result() as $registro) {
            $sql2 = "SELECT * 
                FROM   detalle_mov_almacen det, movimiento_almacen mov
                where det.id_mov_alm=mov.id_mov_alm
                and mov.id_almacen=$id_almacen
                and det.id_articulo=$id_producto
                and det.sn='$registro->SN'
                order by det.id_det_mov_alm ASC";
            //echo '<br>'.$sql2;
            $consulta2 = $this->db->query($sql2);
            if ($consulta2->num_rows() > 0) {

                if ($max < $consulta2->row(0)->id_det_mov_alm) {
                    $max = $consulta2->row(0)->id_det_mov_alm;
                    $row_ultimo = $consulta2->row(0)->cod_prop_sts_equipo;
                }
            }
        }
        $respuesta = $row_ultimo;
        return($respuesta);
    }

//paulaaaa
    /*  function guarda_mov_alm_directo_y_kardex() {


      $respuesta = "";
      $ids = explode("|", $this->input->post("ids"));
      $idps = explode("|", $this->input->post("r_idps"));
      $ma = explode("|", $this->input->post("r_ma"));
      $cant = explode("|", $this->input->post("r_cant"));
      $coments = explode("|", $this->input->post("r_coments"));

      //datos para adicionar datos de inicio
      date_default_timezone_set("Etc/GMT+4");
      $datos = array(
      'id_user_created' => $this->session->userdata('id_admin'),
      // 'cantidad' => $this->input->post('subs'),
      //'estado' => "Iniciado",

      'id_user_er' => $this->input->post('cod_user'),
      'tipo_movimiento' => "Salida",
      'fh_reg' => date("Y-m-d H:i:s"),
      'proyecto' => $this->input->post('proyt'),
      'tipo_doc_origen' => "",
      'id_doc_origen' => "",
      'comentario' => $this->input->post('coment_gral'),
      'estado' => "Guardado"
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
      $this->registro_kardex_nuevo(1, $idps[$i], $cant[$i], "Salida", $result[$i]);
      //  $respuesta = "<input type='hidden' id='ayudata' value='$result[$i]'><input type='hidden' id='proceso' value='INSERT'>";
      }

      return($result);
      }
      return($respuesta);
      } */
//psulaaaaa
    /* function registro_kardex_nuevo($id_alm, $id_ps, $cant, $tipo_mov, $id_det_mov) {
      $this->load->model('producto_servicio_model');
      date_default_timezone_set("Etc/GMT+4");
      $saldo = $this->producto_servicio_model->obtinene_stock_disponible_individual($id_ps, $id_alm);
      $cin = 0;
      $csal = 0;
      if ($tipo_mov == "Salida") {
      $csal = $cant;
      $saldo = $saldo - $cant;
      } else {
      $cin = $cant;
      $saldo = $saldo + $cant;
      }
      $array_datos = array(
      'id_alm' => $id_alm,
      'id_ps' => $id_ps,
      'cantidad' => $cant,
      'tipo_mov' => $tipo_mov,
      'cant_ingreso' => $cin,
      'cant_salida' => $csal,
      'saldo' => $saldo,
      'fh_registro' => date("Y-m-d H:i:s"),
      'id_admin' => $this->session->userdata('id_admin'),
      'id_det_mov' => $id_det_mov);
      $this->db->insert('kardex_producto_almacen', $array_datos);
      } */

    //  movimiento de almacen ingreso con solicitud de devolucion de material

    function obterner_sol_dev_ingreso($id_dev_mat) {
        $sql = "select p.id_proy, p.nombre as nombre_proyecto, U.cod_user, U.nombre as nombre_user, U.ap_paterno, U.ap_materno, ma.id_mov_alm
            from solicitud_devolucion sd, usuarios U, movimiento_almacen ma, proyecto p
            where sd.id_solicitud_dev=$id_dev_mat
            and ma.id_mov_alm=sd.id_movi_alm
            and sd.id_cod_user=U.cod_user
            and ma.id_proyecto=p.id_proy ";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obterner_sol_dev_alm_ingreso($id_dev_mat) {
        $sql = "select a.id_almacen, a.nombre as nombre_alm,a.id_proy,sd.id_movi_alm
            from solicitud_devolucion sd, almacen_admin al, almacen a
            where sd.id_solicitud_dev=$id_dev_mat
            and al.id_usuario=sd.id_cod_user 
            and a.id_almacen=al.id_almacen";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obterner_sol_dev_det_mov_alm_ingreso($id_dev_mat) {
        $sql = "select sd.id_solicitud_dev, ps.id_serv_pro, ps.cod_serv_prod, ps.nombre_titulo, ps.descripcion, dd.cantidad_asignada, 
           dd.cantidad_utilizada, dd.cantidad_devuelto,sd.comentario_dev, dma.id_mov_alm, dma.cod_prop_sts_equipo, dma.cantidad, dma.SN,
           dd.justificacion_dev as justificacion, dd.observacion_producto as observaciones, 
           ps.unidad_medida
           from solicitud_devolucion sd, detalle_devolucion  dd, detalle_mov_almacen dma, producto_servicio ps
           where sd.id_solicitud_dev=$id_dev_mat
           and sd.id_movi_alm=dma.id_mov_alm 
           and ps.id_serv_pro=dma.id_articulo
           and dd.id_solicitud_dev=sd.id_solicitud_dev";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    //rubennnnnnnn
    //nueva funcion ruben modelo agrega el retiro directo con todas las variables asignadas
    function busq_user_proy($id_u) {
        $sql = "select distinct p.nombre, p.id_proy, apc.id_user
                from admin_proyecto_cargo apc, proyecto p
                where apc.id_user=$id_u
                and apc.id_proy=p.id_proy";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function guarda_mov_alm_directo_y_kardex() {


        $respuesta = "";
        $ids = explode("|", $this->input->post("ids"));
        $idps = explode("|", $this->input->post("r_idps"));
        $ma = explode("|", $this->input->post("r_ma"));
        $cant = explode("|", $this->input->post("r_cant"));
        $coments = explode("|", $this->input->post("r_coments"));
        $sns = explode("|", $this->input->post("r_sn"));
        $cps = explode("|", $this->input->post("r_cp"));

        //datos para adicionar datos de inicio
        date_default_timezone_set("Etc/GMT+4");
        $datos = array(
            'id_user_created' => $this->session->userdata('id_admin'),
            // 'cantidad' => $this->input->post('subs'),
            //'estado' => "Iniciado",

            'id_user_er' => $this->input->post('cod_user'),
            'tipo_movimiento' => "Salida",
            'fh_reg' => date("Y-m-d H:i:s"),
            'id_proyecto' => $this->input->post('proyt'),
            'id_oficina_reg' => $this->input->post('id_oficina'),
            'tipo_doc_origen' => "",
            'id_doc_origen' => "",
            'comentario' => $this->input->post('coment_gral'),
            'id_almacen' => $this->input->post('almacen'),
            'estado' => "Guardado"
        );
        if ($this->input->post('area_adicionar') == 0) {
            $this->db->insert('movimiento_almacen', $datos);
            $id_insert = ($this->db->insert_id());
            //proceso para dal alta de detalle
            $respuesta = "<input type='hidden' id='ayudata' value='$id_insert'><input type='hidden' id='proceso' value='INSERT'><div class='OK'> El registro se ha realizado con EXITO !!</div>";
            for ($i = 1; $i < count($ids); $i++) {
                $datos = array(
                    'id_mov_alm' => $id_insert,
                    'item' => $i,
                    'id_articulo' => $idps[$i],
                    'cod_prop_sts_equipo' => $cps[$i],
                    'cantidad' => $cant[$i],
                    'observaciones' => $coments[$i],
                    'SN' => $sns[$i],
                );
                $this->db->insert('detalle_mov_almacen', $datos);
                $r = ($this->db->insert_id());
                $this->registro_kardex_nuevo($this->input->post('almacen'), $idps[$i], $cant[$i], "Salida", $r);
            }
        }
        return($respuesta);
    }

    function edita_mov_alm_directo_y_kardex($id_mov_alm) {


        $respuesta = "";
        $ids = explode("|", $this->input->post("ids"));
        $idps = explode("|", $this->input->post("r_idps"));
        $ma = explode("|", $this->input->post("r_ma"));
        $cant = explode("|", $this->input->post("r_cant"));
        $coments = explode("|", $this->input->post("r_coments"));
        $sns = explode("|", $this->input->post("r_sn"));
        $cps = explode("|", $this->input->post("r_cp"));
        //datos para adicionar datos de inicio
        date_default_timezone_set("Etc/GMT+4");
        $datos = array(
            'id_user_created' => $this->session->userdata('id_admin'),
            // 'cantidad' => $this->input->post('subs'),
            //'estado' => "Iniciado",

            'id_user_er' => $this->input->post('cod_user'),
            'tipo_movimiento' => "Salida",
            'fh_reg' => date("Y-m-d H:i:s"),
            'id_proyecto' => $this->input->post('proyt'),
            'comentario' => $this->input->post('coment_gral'),
            'id_almacen' => $this->input->post('almacen'),
            'id_oficina_reg' => $this->input->post('id_oficina'),
            'estado' => "Guardado"
        );


        $this->db->where('id_mov_alm', $id_mov_alm);
        $upd = $this->db->update('movimiento_almacen', $datos);


        //proceso para dal alta de detalle


        $sql_sel = "select * from detalle_mov_almacen d,movimiento_almacen m where d.id_mov_alm = m.id_mov_alm and d.id_mov_alm=" . $id_mov_alm;
        $resp = $this->db->query($sql_sel);
        foreach ($resp->result() as $kar) {
            $this->registro_kardex_nuevo($kar->id_almacen, $kar->id_articulo, $kar->cantidad, "Ingreso", -$kar->id_det_mov_alm); //1 id_almacen
        }


        $sqlborrado = "Delete from detalle_mov_almacen where id_mov_alm=" . $id_mov_alm;
        $consulta = $this->db->query($sqlborrado);
        //borra detalle anterior


        for ($i = 1; $i < count($ids); $i++) {
            $datos = array(
                'id_mov_alm' => $id_mov_alm,
                'item' => $i,
                'id_articulo' => $idps[$i],
                'cantidad' => $cant[$i],
                'observaciones' => $coments[$i],
                'SN' => $sns[$i],
                'cod_prop_sts_equipo' => $cps[$i]
            );
            $this->db->insert('detalle_mov_almacen', $datos);
            $r = ($this->db->insert_id());
            $this->registro_kardex_nuevo($this->input->post('almacen'), $idps[$i], $cant[$i], "Salida", $r);
        }

        $respuesta = "<input type='hidden' id='ayudata' value='" . $id_mov_alm . "'>
            <input type='hidden' id='proceso' value='UPDATE'><div class='OK'> La Actualizacion se ha realizado con EXITO !!</div>";

//echo $respuesta;
        return($respuesta);
    }

    //funcion de ruben creado para adicionar kardex
    function registro_kardex_nuevo($id_alm, $id_ps, $cant, $tipo_mov, $id_det_mov) {
        $this->load->model('producto_servicio_model');
        date_default_timezone_set("Etc/GMT+4");
        $saldo = $this->producto_servicio_model->obtinene_stock_disponible_individual($id_ps, $id_alm);
        $cin = 0;
        $csal = 0;
        if ($tipo_mov == "Salida") {
            $csal = $cant;
            $saldo = $saldo - $cant;
        } else {
            $cin = $cant;
            $saldo = $saldo + $cant;
        }
        $array_datos = array(
            'id_alm' => $id_alm,
            'id_ps' => $id_ps,
            'cantidad' => $cant,
            'tipo_mov' => $tipo_mov,
            'cant_ingreso' => $cin,
            'cant_salida' => $csal,
            'saldo' => $saldo,
            'fh_registro' => date("Y-m-d H:i:s"),
            'id_admin' => $this->session->userdata('id_admin'),
            'id_det_mov' => $id_det_mov);
        $this->db->insert('kardex_producto_almacen', $array_datos);
    }

    function seriales_registradas_existencia_almacen($id_almacen, $id_producto, $tipo) {
        $alma = "";
        if ($tipo == "Salida")
            $alma = "and m.id_almacen=$id_almacen";
        $sql = "select * from movimiento_almacen m, detalle_mov_almacen d 
            where m.id_mov_alm=d.id_mov_alm
            and d.id_articulo=$id_producto
            $alma
            group by d.cod_prop_sts_equipo";
        //
        //echo $sql;
        $consulta = $this->db->query($sql);
        $i = 0;
        $respuesta = array();
        foreach ($consulta->result() as $registro) {
            $sql2 = "select * from movimiento_almacen m, detalle_mov_almacen d 
                where m.id_mov_alm=d.id_mov_alm
                and d.id_articulo=$id_producto
               
                and d.cod_prop_sts_equipo='$registro->cod_prop_sts_equipo'
                order by id_det_mov_alm DESC";
            //and m.id_almacen=$id_almacen
            // echo $sql2;
            $consulta2 = $this->db->query($sql2);
            if ($consulta2->num_rows() > 0) {
                if ($tipo != $consulta2->row(0)->tipo_movimiento) {
                    $respuesta[$i] = "CP: ".$registro->cod_prop_sts_equipo . "* SN: " . $registro->SN;
                    $i++;
                }
            }
        }
        return($respuesta);
    }

    //rubennn
    function obt_per_encargado_ru($id_ma) {

        $sql = "select * from movimiento_almacen ma, usuarios u 
        where ma.id_user_er=u.cod_user and ma.id_mov_alm=$id_ma";
        // echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function cambiar_estado_retiro($estado, $idma) {

        // $respuesta="";
        $datos = array(
            'estado' => $estado,
        );
        $this->db->where('id_mov_alm', $idma);
        $upd = $this->db->update('movimiento_almacen', $datos);

        //echo 'FUNCIONA';
        //echo $upd;
    }

    //nuevas consultas para las impresiones

    function encargado_almacen($idma) {
        $sql = "  
        select u.nombre,u.ap_paterno,u.ap_materno,al.nombre as nombre_almacen 
        from movimiento_almacen mov, almacen al,usuarios u
        where mov.id_mov_alm=$idma
        and mov.id_almacen=al.id_almacen
        and mov.id_user_created=u.cod_user
        ";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtenet_id_ma($id_doc_origen, $doc_origen) {
        $sql = "select * from movimiento_almacen 
              where id_doc_origen=" . $id_doc_origen . " and tipo_doc_origen='$doc_origen'";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0)
            return($consulta->row()->id_mov_alm);
        else {
            return(0);
        }
    }

    function obtener_id_mov_alm($idma) {
        $sql = "select * from movimiento_almacen ma, detalle_mov_almacen dma, producto_servicio ps
                where ma.id_mov_alm=$idma
                and ma.id_mov_alm=dma.id_mov_alm
                and ps.id_serv_pro=dma.id_articulo";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    // adicionado 12/09/16

    function listar_buscar_materiales_cod_ser($busqueda, $ini, $cant) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select mov.id_mov_alm,det.id_det_mov_alm,pro.id_serv_pro, pro.cod_serv_prod,pro.id_serv_pro,
        mov.tipo_movimiento, det.cod_prop_sts_equipo,det.SN,mov.fh_reg,pro.nombre_titulo,
        us.ap_paterno,us.ap_materno,us.nombre,det.observaciones,pro.descripcion,mov.id_proyecto,p.nombre as nombre_proyecto
        from producto_servicio pro, detalle_mov_almacen det, movimiento_almacen mov,usuarios us, proyecto p
        where pro.id_serv_pro=det.id_articulo
        and det.id_mov_alm=mov.id_mov_alm
        and mov.id_user_er=us.cod_user
        and pro.respuesta='1'
        and mov.id_proyecto=p.id_proy
        and concat(mov.id_mov_alm,det.id_det_mov_alm,pro.id_serv_pro,pro.cod_serv_prod,det.cod_prop_sts_equipo,det.SN)LIKE '%$busqueda%'
        order by  mov.id_mov_alm DESC,det.id_articulo ASC limit $ini,$cant";

        $sql = "select mov.id_mov_alm,det.id_det_mov_alm,pro.id_serv_pro, pro.cod_serv_prod,pro.id_serv_pro, mov.tipo_movimiento, 
det.cod_prop_sts_equipo,det.SN,mov.fh_reg,pro.nombre_titulo, 
us.ap_paterno,us.ap_materno,us.nombre,det.observaciones,pro.descripcion,mov.id_proyecto,p.nombre as nombre_proyecto 
from producto_servicio pro, detalle_mov_almacen det, movimiento_almacen mov,usuarios us, proyecto p 
where 
pro.id_serv_pro=det.id_articulo 
and det.id_mov_alm=mov.id_mov_alm 
and mov.id_user_er=us.cod_user 
and pro.respuesta='1' 
and mov.id_proyecto=p.id_proy and 
concat(mov.id_mov_alm,det.id_det_mov_alm,pro.id_serv_pro,pro.cod_serv_prod,det.cod_prop_sts_equipo)LIKE '%$busqueda%' 
order by mov.id_mov_alm DESC,det.id_articulo ASC limit $ini,$cant";
       // echo $sql;
        $consulta = $this->db->query($sql);

        return($consulta);
    }

    function listar_buscar_materiales_cod_ser_cantidad($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select mov.id_mov_alm,det.id_det_mov_alm,pro.id_serv_pro, pro.cod_serv_prod,pro.id_serv_pro, mov.tipo_movimiento, 
det.cod_prop_sts_equipo,det.SN,mov.fh_reg,pro.nombre_titulo, 
us.ap_paterno,us.ap_materno,us.nombre,det.observaciones,pro.descripcion,mov.id_proyecto,p.nombre as nombre_proyecto 
from producto_servicio pro, detalle_mov_almacen det, movimiento_almacen mov,usuarios us, proyecto p 
where 
pro.id_serv_pro=det.id_articulo 
and det.id_mov_alm=mov.id_mov_alm 
and mov.id_user_er=us.cod_user 
and pro.respuesta='1' 
and mov.id_proyecto=p.id_proy and 
concat(mov.id_mov_alm,det.id_det_mov_alm,pro.id_serv_pro,pro.cod_serv_prod,det.cod_prop_sts_equipo)LIKE '%$busqueda%' 
order by mov.id_mov_alm DESC,det.id_articulo ASC";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }
    
    function obtener_comentario_articulo_serie($cp, $sn) {
        $ssn = '';
        if ($sn != "")
            $ssn = 'and dma.sn="' . $sn . '" ';
        $sql = 'select * from detalle_mov_almacen dma
                where dma.cod_prop_sts_equipo = "' . $cp . '"'
                . $ssn . ' order by id_det_mov_alm DESC';
       // echo $sql;
        $consulta = $this->db->query($sql);
        $observaciones = '';
        if ($consulta->num_rows() > 0) {
            $fila = $consulta->row(0);
            $observaciones = $fila->observaciones;
        }
        return(ltrim($observaciones));
    }

    function siguiente_codigo_propio_empresa($articulo) {

        $sql = "select cod_prop_sts_equipo as codigo,sc.cod_propio
                from (detalle_mov_almacen dma left join producto_servicio ps on dma.id_articulo=ps.id_serv_pro) left join subcategoria sc on ps.id_subcategoria=sc.id_subcategoria 
                where ps.id_subcategoria=(select ps2.id_subcategoria from producto_servicio ps2 where ps2.id_serv_pro=$articulo)
                order by dma.cod_prop_sts_equipo DESC";
        echo $sql."<br>";
        $consulta = $this->db->query($sql);
        $codigo = 0;
        if ($consulta->num_rows() > 0) {
            // echo "entro por verdadero numrows mayor a cero<br>";
            $fila = $consulta->row(0);

            $prefijo = $fila->cod_propio;
            echo "ya no pasa";
              echo "*".$prefijo."*<br>";
             echo "---".$fila->codigo."---<br>";
            echo "-substr--".substr($fila->codigo, 5)."---<br>";
            echo "-+1--".(substr($fila->codigo, 5)+1)."---<br>";
            $codigo = substr($fila->codigo, 5) + 1;
            echo "****".$codigo."***<br>";
            //strlen($codigo);
            $resultado = substr($prefijo . "0000", 0, 9 - strlen($codigo)) . $codigo;
        } else {
            $sql = "select cod_propio
                from  producto_servicio ps left join subcategoria sc on ps.id_subcategoria=sc.id_subcategoria 
                where ps.id_serv_pro=$articulo";
            $consulta = $this->db->query($sql);
            $prefijo = $consulta->row()->cod_propio;
            $resultado = $prefijo . "0001";
        }
        return($resultado);
    }
    //add movimiento de articulo 12/12/2016
    function obtener_articulo_respuesta_uno(){
        $sql="select *
                from producto_servicio pro
                where pro.respuesta=1";
         $consulta = $this->db->query($sql);
         return $consulta;
     
         }
    function obtener_lista_articulos_res1($id) {
        $sql = "select DISTINCT  (det.id_articulo,det.cod_prop_sts_equipo,det.sn)
                from detalle_mov_almacen det,movimiento_almacen mov, producto_servicio pro
                where det.id_mov_alm=mov.id_mov_alm 
                and det.id_articulo=pro.id_serv_pro
                and det.id_articulo = $id ";
        $consulta = $this->db->query($sql);
        return $consulta;
    }
    function obtener_movimientos_cod_prop($cod_prop)
    {
        $sql='SELECT mov.id_user_er, concat(u.ap_paterno," ",u.ap_materno,", ",u.nombre)as nomcomp 
        ,mov.id_mov_alm,  mov.tipo_movimiento,mov.comentario,mov.id_proyecto,p.nombre as proyecto,sro.*,mov.fh_reg,
        det.id_det_mov_alm,det.cod_prop_sts_equipo,det.SN,det.observaciones,det.cantidad,
        ps.nombre_titulo,ps.descripcion,cate.nombre as categoria ,scate.*,scate.nombre as subcategoria
        FROM ((((((movimiento_almacen mov left join usuarios u on (mov.id_user_er=u.cod_user)) 
              left join proyecto p on (p.id_proy=mov.id_proyecto))
              left join subregion_oficina sro on(sro.id_subregion=mov.id_oficina_reg))
              LEFT join detalle_mov_almacen det on (mov.id_mov_alm=det.id_mov_alm)) 
              left join producto_servicio ps on(ps.id_serv_pro=det.id_articulo))
              left join categoria_serv_prod cate on (cate.id_categoria=ps.id_categoria))
              left join subcategoria scate on (scate.id_subcategoria=ps.id_subcategoria)

        where det.id_mov_alm=mov.id_mov_alm

        and det.cod_prop_sts_equipo="'.$cod_prop.'"
        order by mov.id_mov_alm DESC';
         $consulta = $this->db->query($sql);
        return $consulta;
    }

}
?>


