<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class justificaciones_model extends CI_Model {

    function _construct() {
        parent::Model();
        // $this->load->model('justificaciones_model');
    }

    function obtener_justificaciones($id) {
        $ssql = "SELECT * FROM justificacion_permiso WHERE id_admin=$id";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function total_diasTrabajados($id) {
        
        
//        $ssql = "SELECT fh_registro,now() as ahora FROM usuarios WHERE cod_user=$id";
//        $resultado = $this->db->query($ssql);
//        echo $resultado->row()->fh_registro."---".$resultado->row()->ahora;
        $ssql = "SELECT TIMESTAMPDIFF(YEAR,(SELECT fh_registro FROM usuarios WHERE cod_user=$id),NOW()) AS diasTrab";
        $ssql = "SELECT TIMESTAMPDIFF(YEAR,(SELECT fecha_inicio FROM usuarios WHERE cod_user=$id),NOW()) AS diasTrab";
        // echo $ssql;
         $resultado = $this->db->query($ssql);
         return $resultado;
    }

    function dias_justificacion($id) {
        //DATEDIFF--->solo diferencias de fechas
        $ssql = "SELECT DATEDIFF(a.fecha_fin,a.fecha_inicio) AS dif_diasPermiso, a.* 
                FROM justificacion_permiso AS a 
                WHERE id_admin=$id and a.estado='aceptado'";
       // echo $ssql."<br>";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function tipoHorario($id_pk, $dia, $fecha_ini, $fecha_fin) {
        $ssql = "SELECT nombre, hora_ingreso_ma, hora_salida_ma, hora_ingreso_ta, hora_salida_ta, fec_ini_horario, fec_fin_horario, estado, 
                DATE_FORMAT('$fecha_ini', '%T') AS hora_primerDia, DATE_FORMAT('$fecha_fin', '%T') AS hora_ultimoDia
                FROM horario h, asig_admin_horario a
                WHERE a.id_persona=$id_pk AND a.dia='$dia' AND a.id_horario=h.pk_horario AND estado='activo'
                AND '$fecha_ini' BETWEEN a.fec_ini_horario AND a.fec_fin_horario";
       // echo $ssql;
        $resultado = $this->db->query($ssql);

        //echo $ssql."<br/>";
        return $resultado;
    }

    function nuevo_registro_jvp($id) {//,$archivo,$tipo)
        $this->load->model('dependientes_model');
        // $matriz = $this->basicauth->datosSession();
        date_default_timezone_set("Etc/GMT+4");
        $archivo = "";
        if ($this->input->post('respaldo') != "")
            $archivo = $this->session->userdata('id_admin') . "_" . date("Ymd") . "_" . $this->input->post('respaldo');
        $id_user_destino = $this->dependientes_model->obtener_jefe_superior($id, $id, $this->input->post('proyecto'), 1); //cambiar el proyecto enviar por proyecto enviado desde el formulario
        echo "<script>alert('el id user destino es >>>>>" . $id_user_destino . "');</script>";
        $datos = array(
            'id_admin' => $id,
            'fecha_elaborado' => date("Y-m-d H:i:s"),
            'tipo' => $this->input->post('tipo'),
            'rutaficheroadjunto' => $archivo,
            'titulo_jp' => $this->input->post('tituloComentario'),
            'comentario_jp' => $this->input->post('comentarioJustificacion'),
            'fecha_inicio' => $this->input->post('fecha_inicio'),
            'fecha_fin' => $this->input->post('fecha_fin'),
            'estado' => $this->input->post('estado'),
            'id_user_destino' => $id_user_destino,
            'tiempo_d' => $this->input->post('tiempo_d'),
            'tiempo_h' => $this->input->post('tiempo_h'),
            'contenido' => $this->input->post('contenido')
        );
        // return $this->db->insert('justificacion_permiso', $datos);
        $id = $this->db->insert('justificacion_permiso', $datos);
        if ($id > 0)
            return $this->db->insert_id(); //*****************************corregido por Ruben Payrumani Ino
        else
            return 0;
    }

    function obtener_lista_justificaciones() {
        $ssql = "SELECT j.*, a.nombre, a.ap_paterno FROM justificacion_permiso j, usuarios a
                WHERE j.id_admin = a.cod_user
                ORDER BY j.fecha_elaborado DESC";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function obtener_justificaciones_sup() {//aqui llevar todos los dependientes
        echo 'funciona model';
        $this->load->model('usuario_model');
        // $matriz = $this->basicauth->datosSession();
        //envio cadena vacia devielve una cadena
        //echo "<br>*** ".$ids."***<br>";
        $dependientes_sql = "and j.id_user_destino=" . $this->session->userdata('id_admin') . "";
        // echo "envio dependientj.ies".$this->input->post('dependientes');
        if ($this->input->post('dependientes') == 1) {
            $ids = $this->usuario_model->obtener_dependientes_todos($this->session->userdata('id_admin'));
            //echo "and (id_user_destino =".$ids.")";
            $dependientes_sql = "and (id_user_destino=" . $ids . ")";
        }


        $ssql = "SELECT j.*, a.nombre, a.ap_paterno FROM justificacion_permiso j, usuarios a
                WHERE j.id_admin = a.cod_user
                $dependientes_sql
                ORDER BY j.fecha_elaborado DESC";
        //echo "SSQWL>>>>>>>>>>>".$ssql;
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function justificacion($id_justif) {
        $ssql = "SELECT a.*, b.nombre, b.ap_paterno, c.cargo, d.nombre AS proyecto, e.nombre AS ciudad 
            FROM justificacion_permiso a, usuarios b, admin_proyecto_cargo c, proyecto d, ciudad e
            WHERE a.id_jus=$id_justif
            AND a.id_admin=b.cod_user
            AND b.cod_user=c.id_admin
            AND c.id_proy=d.id_proy
            AND c.regional=e.codciudad_pk";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function estado_justificacion($id) {
        $this->load->model('historial_jus_per_vac_bm_model');
        $sql = "SELECT * FROM justificacion_permiso j WHERE j.id_jus='$id'";
        $resultado = $this->db->query($sql);
        if ($resultado->num_rows() > 0) {
            $row = $resultado->row();
        }
        $hist = $this->historial_jus_per_vac_bm_model->obtener_historial_ultimo($id);
        return ($row->estado . '<br><span class="letramuyChica">' . $hist . '</span>');
    }

    function cambio_estado_justificacion($id, $estado) {
        //$matriz = $this->basicauth->datosSession();
        $sql = "UPDATE justificacion_permiso SET estado='$estado' WHERE id_jus=$id";
        if ($estado == "Obtenido")
            $sql = "UPDATE justificacion_permiso SET estado='$estado' , id_user_destino='" . $this->session->userdata('id_admin') . " ' WHERE id_jus=$id";
        echo $sql;
        $resultado = $this->db->query($sql);
    }

    function obtenerInformacionJustificacionPermiso($id_jus) {

        $sql = "SELECT j.*, a.nombre, a.ap_paterno ,a.ci ,a.exp FROM justificacion_permiso j, usuarios a
                WHERE j.id_admin = a.cod_user
                AND j.id_jus=$id_jus";
        $resultado = $this->db->query($sql);
        return $resultado;
    }

    function obtenerFechasJustificacionJSON($id_user) {

        $sql = "select date(fecha_inicio)as fi,Date(fecha_fin)as ff,j.* from justificacion_permiso j where estado='Aceptado' and id_admin=$id_user";
        $resultado = $this->db->query($sql);
        $i = 0;
        foreach ($resultado->result() as $res) {
            if ($res->fi != $res->ff) {
                $fechainf = $res->fi;
                while ($fechainf != $res->ff) {
                    $data[$i] = Array('fec' => $fechainf, 'tit' => $res->tipo . "(" . $res->id_jus . ")");
                    $i++;
                    $fecha_new = strtotime('+1 day', strtotime($fechainf));
                    $fechainf = date('Y-m-d', $fecha_new);
                    // echo "<br>".$fechainf."==".$res->ff."*********";
                }
                $data[$i] = Array('fec' => $res->ff, 'tit' => $res->tipo . "(" . $res->id_jus . ")");
            } else {
                $data[$i] = Array('fec' => $res->ff, 'tit' => $res->tipo . "(" . $res->id_jus . ")");
            }
            $i++;
        }
        header('Content-type: application/json');
        echo json_encode($data);
    }

    function obtenerCadenaFechasJustificacion($id_user) {

        $sql = "select date(fecha_inicio)as fi,Date(fecha_fin)as ff,j.* from justificacion_permiso j where estado='Aceptado' and id_admin=$id_user";
        $resultado = $this->db->query($sql);
        $cadena = "";
        foreach ($resultado->result() as $res) {
            if ($res->fi != $res->ff) {
                $fechainf = $res->fi;
                while ($fechainf != $res->ff) {
                    $cadena.=$fechainf . "," . $res->tipo . "(" . $res->id_jus . "),";
                    $fecha_new = strtotime('+1 day', strtotime($fechainf));
                    $fechainf = date('Y-m-d', $fecha_new);
                    // echo "<br>".$fechainf."==".$res->ff."*********";
                }
                $cadena.=$res->ff . "," . $res->tipo . "(" . $res->id_jus . "),";
            } else {
                $cadena.=$res->ff . "," . $res->tipo . "(" . $res->id_jus . "),";
            }
        }
        return($cadena);
    }

}

?>