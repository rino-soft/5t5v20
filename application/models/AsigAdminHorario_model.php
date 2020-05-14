<?php

class AsigAdminHorario_model extends CI_Model
{

    function _construct()
    {
        parent::Model();
    }

    function busqueda_personal_1_parametro($cadena)
    {//necesita un parametro de busqueda que se obtiene por post//
        
        echo 'funciona2';
        $parametro = $this->input->post('busqueda');
        $parametro = str_replace(' ', '%', $parametro);
        $sql = "SELECT *
        FROM usuarios aa, (SELECT a.cod_user, CONCAT(a.nombre,a.ap_paterno,a.ap_materno,a.username,a.ci) as lineaBusqueda FROM usuarios a) bb
        WHERE aa.cod_user =bb.cod_user
        and bb.lineaBusqueda LIKE '%$parametro%' 
        and aa.username  not LIKE '%BAJA%'
        and ci!=0 ";
        if ($cadena != '')
            $sql.= "and ($cadena)";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

    function datos_usuario($cod)
    {
        $ssql = "SELECT *,DAY(fecha_inicio) AS dia, MONTH(fecha_inicio) AS mes, YEAR(fecha_inicio) AS anio FROM usuarios WHERE cod_user=$cod";
         //echo $ssql;
         $resultado = $this->db->query($ssql);
       
        
        return $resultado;
        
    }

    function datos_horario($id)
    {
        $ssql = "SELECT * FROM horario WHERE PK_HORARIO=$id";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function sumarHoras($h1, $h2)
    {
        $h2h = date('H', strtotime($h2));
        $h2m = date('i', strtotime($h2));
        $h2s = date('s', strtotime($h2));
        $hora2 = $h2h . "hour" . $h2m . "min" . $h2s . "second";
        $horas_sumadas = $h1 . " + " . $hora2;
        $text = date('H:i:s', strtotime($horas_sumadas));
        return $text;
    }

    function guardar_asignacion($vector_dias, $fecha_ini, $fecha_fin)
    {
        $cadena_ids = $this->input->post('ids_personal');
        $tam_cad = strlen($cadena_ids);

        $i = 0;

        $vector_ids = array();
        while ($i < $tam_cad)
        {
            if ($cadena_ids[$i] == "'")
            {
                $j = $i + 1;
                $k = 0;
                $i++;
                while ($cadena_ids[$i] != "'")
                {
                    $i++;
                    $k++;
                }
                for ($dia = 0; $dia < count($vector_dias); $dia++)
                {
                    if ($vector_dias[$dia][1] != 0)
                    {
                        $id = substr($cadena_ids, $j, $k);
                        $back_fecha_ini = $fecha_ini;
                        $back_fecha_fin = $fecha_fin;
                        if ($fecha_ini == '' && $fecha_fin == '')
                        {
                            $datos = $this->datos_usuario($id)->row();
                            if ($datos->fecha_inicio == '0000-00-00')
                            {
                                $back_fecha_ini = date("Y-m-d");
                                $dato = strtotime($back_fecha_ini);
                                $back_fecha_fin = date((date("Y", $dato) + 20) . '-' . date("m", $dato) . '-' . date("d", $dato));
                            }
                            else
                            {
                                $d = $datos->dia;
                                $m = $datos->mes;
                                $a = $datos->anio;

                                $back_fecha_ini = $datos->fecha_inicio;
                                $back_fecha_fin = ($a + 20) . '-' . $m . '-' . $d;
                            }
                        }
                        $datos = array(
                            'ID_PERSONA' => substr($cadena_ids, $j, $k),
                            'DIA' => $vector_dias[$dia][0],
                            'ID_HORARIO' => $vector_dias[$dia][1],
                            'fec_ini_horario' => $back_fecha_ini,
                            'fec_fin_horario' => $back_fecha_fin,
                            'Estado' => 'activo'
                        );
//$this->resuelve_conflicto_de_asignaciones($datos);
                        $this->db->insert('asig_admin_horario', $datos);
                    }
                }
                $vector_ids[] = substr($cadena_ids, $j, $k);
            }
            $i++;
        }
        return ($vector_ids);
    }

    function obtiene_fechas_asignacion($id)
    {
        $ssql = "SELECT DISTINCT fec_ini_horario, fec_fin_horario FROM asig_admin_horario
                WHERE id_persona=$id
                AND Estado='activo'
                ORDER BY fec_ini_horario";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function obtiene_horario_deFecha($id, $fechaini, $fechafin, $nombre_dia)
    {
        $ssql = "SELECT b.nombre FROM asig_admin_horario a, horario b
                    WHERE id_persona=$id
                    AND fec_ini_horario='$fechaini'
                    AND fec_fin_horario='$fechafin'
                    AND dia='$nombre_dia'
                    AND Estado='activo'
                    AND b.pk_horario=a.id_horario";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function busca_conflictos($id, $fecha_inicio, $fecha_fin, $nombre_dia)
    {
        if ($fecha_inicio == '' && $fecha_fin == '')
        {
            $datos = $this->datos_usuario($id)->row();
            if ($datos->fecha_inicio == '0000-00-00')
            {
                $fecha_inicio = date("Y-m-d");
                $dato = strtotime($fecha_inicio);
                $fecha_fin = date((date("Y", $dato) + 20) . '-' . date("m", $dato) . '-' . date("d", $dato));
            }
            else
            {
                $d = $datos->dia;
                $m = $datos->mes;
                $a = $datos->anio;

                $fecha_inicio = $datos->fecha_inicio;
                $fecha_fin = ($a + 20) . '-' . $m . '-' . $d;
            }
        }


        $ssql = "SELECT a.*, h.nombre AS nombre_horario FROM asig_admin_horario a,horario h
                 WHERE fec_ini_horario ='$fecha_inicio' AND fec_fin_horario='$fecha_fin'
                 AND h.pk_horario=a.id_horario
                 AND id_persona=$id
                 AND Estado='activo'
                 AND dia='$nombre_dia'";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function existe_conflictos($id, $fecha_inicio, $fecha_fin)
    {
        if ($fecha_inicio == '' && $fecha_fin == '')
        {
            $datos = $this->datos_usuario($id)->row();
            if ($datos->fecha_inicio == '0000-00-00')
            {
                $fecha_inicio = date("Y-m-d");
                $dato = strtotime($fecha_inicio);
                $fecha_fin = date((date("Y", $dato) + 20) . '-' . date("m", $dato) . '-' . date("d", $dato));
            }
            else
            {
                $d = $datos->dia;
                $m = $datos->mes;
                $a = $datos->anio;

                $fecha_inicio = $datos->fecha_inicio;
                $fecha_fin = ($a + 20) . '-' . $m . '-' . $d;
            }
        }

        $ssql = "SELECT DISTINCT fec_ini_horario,fec_fin_horario FROM asig_admin_horario
                 WHERE (
                        (fec_ini_horario BETWEEN '$fecha_inicio' AND '$fecha_fin') 
                        OR ( fec_fin_horario BETWEEN '$fecha_inicio' AND '$fecha_fin')
                        OR (
                             ('$fecha_inicio' BETWEEN fec_ini_horario AND fec_fin_horario) 
                             AND ('$fecha_fin' BETWEEN fec_ini_horario AND fec_fin_horario)
                           )
                       )
                       AND Estado='activo'
                       AND id_persona=$id";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    /*
     * $resp = arrreglo de ids
     * $vector_dias = matriz con los nombres de los dias y sus horarios seleccionados
     * $fecha_ini = fecha inicio de la nueva asignacion
     * $fecha_fin = fecha final de la nueva asignaciuon
     */

    function solucionar_conflictos($dias_horario, $fecha_ini, $fecha_fin)
    {

        $cadena_ids = $this->input->post('ids_personal');
        $tam_cad = strlen($cadena_ids);
        $i = 0;
        $resp = array();
        while ($i < $tam_cad)
        {
            if ($cadena_ids[$i] == "'")
            {
                $j = $i + 1;
                $k = 0;
                $i++;
                while ($cadena_ids[$i] != "'")
                {
                    $i++;
                    $k++;
                }
                $resp[] = substr($cadena_ids, $j, $k);
            }
            $i++;
        }
        for ($i = 0; $i < count($resp); $i++)
        {
            //echo "<div class='grid_10'>usuario: '.$resp[$i].'</div>";
            for ($j = 0; $j < 6; $j++)
            {
                //echo "<div class='grid_10'>dia: " . $dias_horario[$j][0] . "-------->" . $dias_horario[$j][1] . "</div>";
                if ($dias_horario[$j][1] != 0)
                {
                    //(inicio codigo) para controlar si las fechas son de forma permanente
                    if ($fecha_ini == '' && $fecha_fin == '')
                    {
                        $datos = $this->datos_usuario($resp[$i])->row();
                        if ($datos->fecha_inicio == '0000-00-00')
                        {
                            $fecha_ini = date("Y-m-d");
                            $dato = strtotime($fecha_ini);
                            $fecha_fin = date((date("Y", $dato) + 20) . '-' . date("m", $dato) . '-' . date("d", $dato));
                        }
                        else
                        {
                            $d = $datos->dia;
                            $m = $datos->mes;
                            $a = $datos->anio;

                            $fecha_ini = $datos->fecha_inicio;
                            $fecha_fin = ($a + 20) . '-' . $m . '-' . $d;
                        }
                    }
                    //(fin codigo) para controlar si las fechas son de forma permanente

                    $ssql = '';

                    //==================primer caso (fec_fin dentro del nuevo horario)(nuevo horario detras de asig en conflicto)

                    $consulta = "SELECT * FROM asig_admin_horario WHERE id_persona=$resp[$i]
                        AND (fec_fin_horario BETWEEN '$fecha_ini' AND '$fecha_fin')
                        AND (fec_ini_horario NOT BETWEEN '$fecha_ini' AND '$fecha_fin')
                        AND dia='" . $dias_horario[$j][0] . "'";
                    $resultado = $this->db->query($consulta);

                    if ($resultado->num_rows() > 0)
                    {
                        $ssql = "UPDATE asig_admin_horario SET fec_fin_horario = DATE_SUB('$fecha_ini', INTERVAL 1 DAY)
                            WHERE id_persona=$resp[$i]
                            AND (fec_fin_horario BETWEEN '$fecha_ini' AND '$fecha_fin')
                            AND (fec_ini_horario NOT BETWEEN '$fecha_ini' AND '$fecha_fin')
                            AND dia='" . $dias_horario[$j][0] . "'";
                    }
                    $this->db->query($ssql);

                    //==================segundo caso (fec_ini dentro del nuevo horario)(nuevo horario por delante de asig en conflicto)

                    $consulta = "SELECT * FROM asig_admin_horario
                        WHERE id_persona=$resp[$i]
                        AND (fec_ini_horario BETWEEN '$fecha_ini' AND '$fecha_fin')
                        AND (fec_fin_horario NOT BETWEEN '$fecha_ini' AND '$fecha_fin')
                        AND dia='" . $dias_horario[$j][0] . "'";
                    $resultado = $this->db->query($consulta);

                    if ($resultado->num_rows() > 0)
                    {
                        $ssql = "UPDATE  asig_admin_horario SET fec_ini_horario = DATE_ADD('$fecha_fin', INTERVAL 1 DAY)
                            WHERE id_persona=$resp[$i]
                            AND (fec_ini_horario BETWEEN '$fecha_ini' AND '$fecha_fin')
                            AND (fec_fin_horario NOT BETWEEN '$fecha_ini' AND '$fecha_fin')
                            AND dia='" . $dias_horario[$j][0] . "'";
                    }
                    $this->db->query($ssql);

                    //==================Tercer caso (fec_ini Y fec_fin dentro del nuevo horario)(nuevo horario mas grande)

                    $consulta = "SELECT * FROM asig_admin_horario
                           WHERE id_persona=$resp[$i]
                           AND fec_ini_horario BETWEEN '$fecha_ini' AND '$fecha_fin'
                           AND fec_fin_horario BETWEEN '$fecha_ini' AND '$fecha_fin'
                           AND estado='activo'
                           AND dia='" . $dias_horario[$j][0] . "'";
                    $resultado = $this->db->query($consulta);

                    if ($resultado->num_rows() > 0)
                    {
                        $ssql = "UPDATE  asig_admin_horario SET Estado='inactivo'
                            WHERE id_persona=$resp[$i]
                            AND fec_ini_horario BETWEEN '$fecha_ini' AND '$fecha_fin'
                            AND fec_fin_horario BETWEEN '$fecha_ini' AND '$fecha_fin'
                            AND estado='activo'
                            AND dia='" . $dias_horario[$j][0] . "'";
                    }
                    $this->db->query($ssql);

                    //==================Cuarto caso ( nuevo horario dentro de fec_ini Y fec_fin)(nuevo horario mas pequeño que otras asign)
                    $consulta = "SELECT * FROM asig_admin_horario
                        WHERE id_persona=$resp[$i]
                        AND ('$fecha_ini' BETWEEN fec_ini_horario AND fec_fin_horario)
                        AND ('$fecha_fin' BETWEEN fec_ini_horario AND fec_fin_horario)
                        AND estado='activo'
                        AND dia='" . $dias_horario[$j][0] . "'";
                    $resultado = $this->db->query($consulta);
                    if ($resultado->num_rows() > 0)
                    {
                        $sql = "INSERT INTO asig_admin_horario(ID_PERSONA, DIA, ID_HORARIO, fec_ini_horario, fec_fin_horario, Estado)
                            SELECT ID_PERSONA, DIA, ID_HORARIO,DATE_ADD('$fecha_fin', INTERVAL 1 DAY), fec_fin_horario, Estado FROM asig_admin_horario
                            WHERE DIA='" . $dias_horario[$j][0] . "'
                            AND ID_PERSONA=$resp[$i]
                            AND '$fecha_ini' BETWEEN fec_ini_horario AND fec_fin_horario
                            AND '$fecha_fin' BETWEEN fec_ini_horario AND fec_fin_horario";
                        mysqli_query($sql);

                        $ssql = " UPDATE  asig_admin_horario SET fec_fin_horario = DATE_SUB('$fecha_ini', INTERVAL 1 DAY)
                            WHERE id_persona=$resp[$i]
                            AND ('$fecha_ini' BETWEEN fec_ini_horario AND fec_fin_horario)
                            AND ('$fecha_fin' BETWEEN fec_ini_horario AND fec_fin_horario)
                            AND estado='activo'
                            AND dia='" . $dias_horario[$j][0] . "'";
                    }
                    $this->db->query($ssql);
                }
            }
        }
    }

}

?>
