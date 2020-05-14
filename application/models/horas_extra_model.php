<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class horas_extra_model extends CI_Model {

    function _construct() {
        parent::Model();
        // $this->load->model('justificaciones_model');
    }

    function dia_laboral($fecha) {
        $dia = date("w", strtotime($fecha));
        if ($dia == 0 or $dia == 6)
            return(true);
        return (false);
    }

    function diferencia_hrs($fh_Ini, $fh_Fin) {
        $segundos = strtotime($fh_Fin) - strtotime($fh_Ini);
        $diferencia_min = ($segundos / 60) / 60;
        echo "<br>***diferecia de hrs = $fh_Fin - $fh_Ini = $diferencia_min ***<br>";
        return($diferencia_min);
    }

    function fec_mayor($f1, $f2) {
        if ($this->diferencia_hrs($f2, $f1) >= 0)//fecha 1 es mayor
            return (true);
        return(false);
    }

    function calculo_he($fh_inicial, $fh_final) {
        $hi = "19:00:00";
        $hf = "08:00:00";
        $t = 0;
        $fi = date("Y/m/d", strtotime($fh_inicial));
        $ff = date("Y/m/d", strtotime($fh_final));
        echo "<br>hora inicial : " . $fh_inicial . ", fhfinal" . $fh_final . "<br>" .
        "hora I:$hi, hroa F: $hf , fechaI: $fi , Fecha F: $ff";



        if ($this->dia_laboral($fh_inicial)) {

            if ($this->dia_laboral($fh_final)) {

                $t = $this->diferencia_hrs($fh_inicial, $fh_final);
            } else {
                if ($this->fec_mayor($fh_final, $ff . " " . $hf)) {
                    if ($this->fec_mayor($fh_final, $ff . " " . $hi)) {
                        $t = $this->diferencia_hrs($ff . " " . $hi, $fh_final) + $this->diferencia_hrs($fh_inicial, $fi . " " . $hf);
                    } else {
                        $t = $this->diferencia_hrs($fh_inicial, $ff . " " . $hf);
                    }
                } else {
                    $t = $this->diferencia_hrs($fh_inicial, $fh_final);
                }
            }
        } else {

            if ($this->dia_laboral($fh_final)) {
                echo "<br> el dia final es feriado Sabado o Domingo y pregunta $fh_inicial > $fi $hf<br>";
                if ($this->fec_mayor($fh_inicial, $fi . " " . $hf)) {
                    echo "<br>$fh_inicial es mayor ahora pregunta $fh_inicial > $fi $hi) <br>";
                    if ($this->fec_mayor($fh_inicial, $fi . " " . $hi)) {
                        echo " <br>$fh_inicial es mayor calcula t<br>";
                        $t = $this->diferencia_hrs($fh_inicial, $fh_final);
                    } else {
                        echo " <br>$fi $hi  es mayor calcula t<br>";
                        $t = $this->diferencia_hrs($fi . " " . $hi, $fh_final);
                    }
                } else {
                    echo "<br> $fi $hf  es mayor calcula t<br>";

                    $t = $this->diferencia_hrs($fi . " " . $hi, $fh_final) + $this->diferencia_hrs($fh_inicial, $fi . " " . $hf);
                }//fin proceso 2
            } else {

                if ($fi == $ff) {
                    if ($this->fec_mayor($fh_inicial, $fi . " " . $hf)) {
                        if ($this->fec_mayor($fh_inicial, $fi . " " . $hi)) {
                            $t = $this->diferencia_hrs($fh_inicial, $fh_final);
                        } else {
                            if ($this->fec_mayor($fh_final, $ff . " " . $hi)) {
                                $t = $this->diferencia_hrs($ff . " " . $hi, $fh_final);
                            } else {
                                $t = 0;
                            }
                        }
                    } else {
                        if ($this->fec_mayor($fh_final, $ff . " " . $hf)) {
                            if ($this->fec_mayor($fh_final, $ff . " " . $hi))
                                $t = $this->diferencia_hrs($fi . " " . $hi, $fh_final) + $this->diferencia_hrs($fh_inicial, $fi . " " . $hf);
                            else
                                $t = $this->diferencia_hrs($fh_inicial, $ff . " " . $hf);
                        }
                        else {
                            $t = $this->diferencia_hrs($fh_inicial, $fh_final);
                        }
                    }
                } else {
                    //proceso mas largo y comun proceso nro 1
                    if ($this->fec_mayor($fh_inicial, $fi . " " . $hf)) {
                        if ($this->fec_mayor($fh_inicial, $fi . " " . $hi)) {
                            if ($this->fec_mayor($fh_final, $ff . " " . $hf)) {
                                if ($this->fec_mayor($fh_final, $ff . " " . $hi)) {
                                    $t = $this->diferencia_hrs($ff . " " . $hi, $fh_final) + $this->diferencia_hrs($fh_inicial, $fi . " " . $hf);
                                } else {
                                    $t = $this->diferencia_hrs($fh_inicial, $ff . " " . $hf);
                                }
                            } else {
                                $t = $this->diferencia_hrs($fi . " " . $hi, $fh_final);
                            }
                        } else {
                            if ($this->fec_mayor($fh_final, $ff . " " . $hf)) {
                                if ($this->fec_mayor($fh_final, $ff . " " . $hi)) {
                                    $t = $this->diferencia_hrs($ff . " " . $hi, $fh_final) + $this->diferencia_hrs($fi . " " . $hi, $ff . " " . $hf);
                                } else {
                                    $t = $this->diferencia_hrs($fi . " " . $hi, $ff . " " . $hf);
                                }
                            } else {
                                $t = $this->diferencia_hrs($fi . " " . $hi, $fh_final);
                            }
                        }
                    } else {
                        if ($this->fec_mayor($fh_final, $ff . " " . $hf)) {
                            if ($this->fec_mayor($fh_final, $ff . " " . $hi)) {
                                $t = $this->diferencia_hrs($ff . " " . $hi, $fh_final) + $this->diferencia_hrs($fi . " " . $hi, $ff . " " . $hf) + $this->diferencia_hrs($fh_inicial, $fi . " " . $hf);
                            } else {
                                $t = $this->diferencia_hrs($fi . " " . $hi, $ff . " " . $hf) + $this->diferencia_hrs($fh_inicial, $fi . " " . $hf);
                            }
                        } else {
                            $t = $this->diferencia_hrs($ff . " " . $hi, $fh_final) + $this->diferencia_hrs($fh_inicial, $fi . " " . $hf);
                        }
                    }


                    //fin proceso 1
                }
            }
        }
        return ($t);
    }

    function nuevo_registro_he($id) {//,$archivo,$tipo)
        $this->load->model('dependientes_model');
        //$matriz = $this->basicauth->datosSession();
        date_default_timezone_set("Etc/GMT+4");

        //$archivo = "";
        //if ($this->input->post('respaldo') != "")
        //    $archivo = $matriz['id'] . "_" . date("Ymd") . "_" . $this->input->post('respaldo');
        $id_user_destino = $this->dependientes_model->obtener_jefe_superior($id, $id, $this->input->post('proyecto'), 1); //cambiar el proyecto enviar por proyecto enviado desde el formulario
        //echo "<script>alert('el id user destino es >>>>>" . $id_user_destino . "');</script>";
        $v_c = $this->calculo_he($this->input->post('fhviaje'), $this->input->post('fhconclusion'));
        $s_c = $this->calculo_he($this->input->post('fhsitio'), $this->input->post('fhconclusion'));
        $v_s = $this->calculo_he($this->input->post('fhviaje'), $this->input->post('fhsitio'));

        //  echo "v_c" . $v_c;
        $datos = array(
            'id_usuario' => $id,
            'id_proyecto' => $this->input->post('proyecto'),
            'tipo_trabajo' => $this->input->post('tipo_trab'),
            'lugar_he' => $this->input->post('departamento'),
            'provincia' => $this->input->post('provincia'),
            'sitio' => $this->input->post('sitioEspecifico'),
            'area' => $this->input->post('area_lugar'),
            'fhnotificacion' => $this->input->post('fhnotificacion'),
            'fhviaje' => $this->input->post('fhviaje'),
            'fhatencion' => $this->input->post('fhsitio'),
            'fhconclusion' => $this->input->post('fhconclusion'),
            'falla' => $this->input->post('falla'),
            'intervencion' => $this->input->post('intervencion'),
            'observaciones' => $this->input->post('observaciones'),
            'id_jefe_autorizado' => $id_user_destino,
            'historial' => 1,
            'fh_registro' => date("Y-m-d H:i:s"),
            'cantidad_horas_v_c' => $v_c,
            'cantidad_horas_s_c' => $s_c,
            'cantidad_horas_v_s' => $v_s,
            'estado' => 'solicitado'
        );
        /*  $nombres=array('id_usuario','id_proyecto','tipo_trabajo','lugar_he', 'provincia',
          'sitio', 'area' ,'fhnotificacion' ,'fhviaje' ,'fhatencion' ,'fhconclusion','falla',
          'intervencion' ,
          'observaciones',
          'id_jefe_autorizado' ,
          'historial' ,
          'fhregistro' ,
          'cantidad_horas_v_c',
          'cantidad_horas_s_c',
          'cantidad_horas_v_s');
          for ($i = 0; $i < count($datos); $i++)
          echo $nombres[$i] . ".- " . $datos[$nombres[$i]] . ",<br>"; */
        // return $this->db->insert('justificacion_permiso', $datos);
        $id = $this->db->insert('solicitud_horas_extra', $datos);
        // var_dump($this->db->last_query());
        //echo $this->db->_error_message();
        if ($id > 0)
            return $this->db->insert_id(); //*****************************corregido por Ruben Payrumani Ino
        else
            return 0;
    }

    function editar_registro_he($indice) {//,$archivo,$tipo)
        $this->load->model('dependientes_model');
        //$matriz = $this->basicauth->datosSession();
        date_default_timezone_set("Etc/GMT+4");

        //$archivo = "";
        //if ($this->input->post('respaldo') != "")
        //    $archivo = $matriz['id'] . "_" . date("Ymd") . "_" . $this->input->post('respaldo');
        //$id_user_destino = $this->dependientes_model->obtener_jefe_superior($id, $id, $this->input->post('proyecto'), 1); //cambiar el proyecto enviar por proyecto enviado desde el formulario
        //echo "<script>alert('el id user destino es >>>>>" . $id_user_destino . "');</script>";
        $v_c = $this->calculo_he($this->input->post('fhviaje'), $this->input->post('fhconclusion'));
        $s_c = $this->calculo_he($this->input->post('fhsitio'), $this->input->post('fhconclusion'));
        $v_s = $this->calculo_he($this->input->post('fhviaje'), $this->input->post('fhsitio'));

        //  echo "v_c" . $v_c;
        $datos = array(
            'tipo_trabajo' => $this->input->post('tipo_trab'),
            'lugar_he' => $this->input->post('departamento'),
            'provincia' => $this->input->post('provincia'),
            'sitio' => $this->input->post('sitioEspecifico'),
            'area' => $this->input->post('area_lugar'),
            'fhnotificacion' => $this->input->post('fhnotificacion'),
            'fhviaje' => $this->input->post('fhviaje'),
            'fhatencion' => $this->input->post('fhsitio'),
            'fhconclusion' => $this->input->post('fhconclusion'),
            'falla' => $this->input->post('falla'),
            'intervencion' => $this->input->post('intervencion'),
            'observaciones' => $this->input->post('observaciones'),
            'fh_registro' => date("Y-m-d H:i:s"),
            'cantidad_horas_v_c' => $v_c,
            'cantidad_horas_s_c' => $s_c,
            'cantidad_horas_v_s' => $v_s
        );

        $this->db->where('id_he', $indice);
        $id = $this->db->update('solicitud_horas_extra', $datos);
        // var_dump($this->db->last_query());
        //echo $this->db->_error_message();
        if ($id > 0)
            return $this->db->insert_id(); //*****************************corregido por Ruben Payrumani Ino
        else
            return 0;
    }

    function obtRegistroHe($indice) {
        
        $ssql = "select concat(a.nombre,' ',a.ap_paterno)as nombrecompleto,d.nombre as proyecto,she.*
    from solicitud_horas_extra she,
    usuarios a,proyecto d
    where she.id_usuario=a.cod_user
    and she.id_proyecto=d.id_proy
    and she.id_he=$indice";
        $resultado = $this->db->query($ssql);

        return $resultado;
    }

    function obtener_registros_hora_extra($mont, $year) {

       // $matriz = $this->basicauth->datosSession();
        $ssql = "SELECT she.*, a.nombre, a.ap_paterno ,d.nombre as proy
        FROM solicitud_horas_extra she, usuarios a,proyecto d
        WHERE she.id_usuario = a.cod_user
        and d.id_proy=she.id_proyecto
        and a.cod_user=" . $this->session->userdata('id_admin') . "
        and MONTH(she.fhatencion)=$mont
        and YEAR(she.fhatencion)=$year";



        $resultado = $this->db->query($ssql);
        // var_dump($this->db->last_query());
        return $resultado;
    }

    function obtener_registros_solicitudes_hora_extra($mont, $year) {
        //$matriz = $this->basicauth->datosSession();
        $ssql = "SELECT she.*, a.nombre, a.ap_paterno ,d.nombre as proy
        FROM solicitud_horas_extra she, usuarios a,proyecto d
        WHERE she.id_usuario = a.cod_user
        and d.id_proy=she.id_proyecto
        and she.id_jefe_autorizado=" . $this->session->userdata('id_admin') . "
        and MONTH(she.fhatencion)=$mont
        and YEAR(she.fhatencion)=$year
                order by id_he DESC";

        $resultado = $this->db->query($ssql);
        // var_dump($this->db->last_query());
        return $resultado;
    }

    function cambio_estado_he($id, $estado) {
       // $matriz = $this->basicauth->datosSession();
        $sql = "UPDATE solicitud_horas_extra SET estado='$estado' WHERE id_he=$id";
        //if ($estado == "Obtenido")
        //    $sql = "UPDATE justificacion_permiso SET estado='$estado' , id_user_destino='" . $matriz['id'] . " ' WHERE id_jus=$id";
        echo $sql;
        $resultado = $this->db->query($sql);
    }

    function rep_he_ok_por_proyecto($mes, $anio, $proyecto) {
        $mes_anterior = 0;
        $anio_ant = 0;
        if ($mes == 1) {
            $mes_anterior = 12;
            $anio_anterior = $anio - 1;
        } else {
            $mes_anterior = $mes - 1;
            $anio_anterior = $anio;
        }//$matriz = $this->basicauth->datosSession();
        $ssql = "select a.nombre,a.ap_paterno,she.* 
            from solicitud_horas_extra she, usuarios a 
                where she.estado='Aceptado'
                and she.id_usuario=a.cod_user
                and she.id_jefe_autorizado=" . $this->session->userdata('id_admin'). "
                and she.id_proyecto=$proyecto
                and fhatencion between '$anio_anterior/$mes_anterior/26' and '$anio/$mes/25'
                order by a.ap_paterno ";
        //echo $ssql;
        $resultado = $this->db->query($ssql);
        return $resultado;
    }
    function rep_he_ok_por_proyectoSQL($mes, $anio, $proyecto) {
        $mes_anterior = 0;
        $anio_ant = 0;
        if ($mes == 1) {
            $mes_anterior = 12;
            $anio_anterior = $anio - 1;
        } else {
            $mes_anterior = $mes - 1;
            $anio_anterior = $anio;
        }//$matriz = $this->basicauth->datosSession();
        $ssql = "select a.nombre,a.ap_paterno,she.* 
            from solicitud_horas_extra she, usuarios a 
                where she.estado='Aceptado'
                and she.id_usuario=a.cod_user
                and she.id_jefe_autorizado=" . $this->session->userdata('id_admin') . "
                and she.id_proyecto=$proyecto
                and fhatencion between '$anio_anterior/$mes_anterior/26' and '$anio/$mes/25'
                order by a.ap_paterno ";
        
        return $ssql;
    }
    
    

    function rep_he_ok_por_proyecto_suma($mes, $anio, $proyecto) {
        $mes_anterior = 0;
        $anio_anterior = 0;
        if ($mes == 1) {
            $mes_anterior = 12;
            $anio_anterior = $anio - 1;
        } else {
            $mes_anterior = $mes - 1;
            $anio_anterior = $anio;
        }
       // $matriz = $this->basicauth->datosSession();
        $ssql = "select she.id_usuario ,a.nombre,a.ap_paterno,sum(she.cantidad_horas_s_c)as horas_sc,
            sum(she.cantidad_horas_v_s)as horas_vs,
            sum(she.cantidad_horas_v_c)as horas_vc
            from solicitud_horas_extra she, usuarios a 
                where she.estado='Aceptado'
                and she.id_usuario=a.cod_user
                and she.id_jefe_autorizado=" . $this->session->userdata('id_admin') . "
                and she.id_proyecto=$proyecto
                and fhatencion between '$anio_anterior/$mes_anterior/26' and '$anio/$mes/25'
                group by a.ap_paterno ";
        echo $ssql;
        $resultado = $this->db->query($ssql);
        return $resultado;
    }
    function rep_he_ok_por_proyecto_suma_tipo_trabajo($mes, $anio, $proyecto) {
        $mes_anterior = 0;
        $anio_anterior = 0;
        if ($mes == 1) {
            $mes_anterior = 12;
            $anio_anterior = $anio - 1;
        } else {
            $mes_anterior = $mes - 1;
            $anio_anterior = $anio;
        }
       // $matriz = $this->basicauth->datosSession();
        $ssql = "select she.tipo_trabajo,sum(she.cantidad_horas_s_c)as horas_sc,
            sum(she.cantidad_horas_v_s)as horas_vs,
            sum(she.cantidad_horas_v_c)as horas_vc
            from solicitud_horas_extra she
                where she.estado='Aceptado'               
                and she.id_jefe_autorizado=" . $this->session->userdata('id_admin') . "
                and she.id_proyecto=$proyecto
                and fhatencion between '$anio_anterior/$mes_anterior/26' and '$anio/$mes/25'
                group by she.tipo_trabajo ";
        //echo $ssql;
        $resultado = $this->db->query($ssql);
        return $resultado;
    }
    

    /////////////////////////////////////////////////////////////////////////////////////////////////////





    function obt_justificaciones($id) {
        $ssql = "SELECT * FROM justificacion_permiso WHERE id_admin=$id";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function total_diasTrabajados($id) {
        $ssql = "SELECT TIMESTAMPDIFF(YEAR,(SELECT fh_registro FROM usuarios WHERE cod_user=$id),NOW()) AS diasTrab";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function dias_justificacion($id) {
        //DATEDIFF--->solo diferencias de fechas
        $ssql = "SELECT DATEDIFF(a.fecha_fin,a.fecha_inicio) AS dif_diasPermiso, a.* 
                FROM justificacion_permiso AS a 
                WHERE id_admin=$id and a.estado='aceptado'";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function tipoHorario($id_pk, $dia, $fecha_ini, $fecha_fin) {
        $ssql = "SELECT nombre, hora_ingreso_ma, hora_salida_ma, hora_ingreso_ta, hora_salida_ta, fec_ini_horario, fec_fin_horario, estado, 
                DATE_FORMAT('$fecha_ini', '%T') AS hora_primerDia, DATE_FORMAT('$fecha_fin', '%T') AS hora_ultimoDia
                FROM horario h, asig_admin_horario a
                WHERE a.id_persona=$id_pk AND a.dia='$dia' AND a.id_horario=h.pk_horario AND estado='activo'
                AND '$fecha_ini' BETWEEN a.fec_ini_horario AND a.fec_fin_horario";
        $resultado = $this->db->query($ssql);

        //echo $ssql."<br/>";
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

    function obtenerInformacionJustificacionPermiso($id_jus) { // se adiciono EXP a la tabla de usuarios

        $sql = "SELECT j.*, a.nombre, a.ap_paterno ,a.ci,a.EXP
                FROM justificacion_permiso j, usuarios a
                WHERE j.id_admin = a.cod_user
                AND j.id_jus='$id_jus'";
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