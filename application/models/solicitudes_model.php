<?php

class solicitudes_model extends CI_Model {

    function registro_asignacion_vale_gasolina($codUser) {
        $datos = array(
            'id_proy' => $this->input->post('proy'),
            'id_user' => $codUser,
            'id_solicitante' => $this->input->post('idsolicitante'),
            'NomComp' => $this->input->post('usuario'),
            'placa' => $this->input->post('placa'),
            'observacion' => $this->input->post('obs'),
            'monto' => $this->input->post('total'),
            'fecha' => date('Y-m-d'),
            'estado' => 'abierto'
        );
        echo 'se ha llenado el array';
        $this->db->insert('solicitud_gasolina', $datos);
        return ($this->db->insert_id());
    }

    //registros de vales de gasolina******************************************************************************************
    function listar_todos_registros($ini, $cant) {
        $sql = "Select sg.* ,d.nombre as proyecto  FROM solicitud_gasolina sg, proyecto d WHERE d.id_proy=sg.id_proy order by id DESC";
        if ($cant != 0)
            $sql.=" LIMIT $ini , $cant";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

    function obtenerCantidadRegistrosasigvales() {
        $sql = "Select COUNT(*) as cant FROM solicitud_gasolina WHERE  1 ";
        $consulta = $this->db->query($sql);
        $cantidad = $consulta->row();
        return $cantidad->cant;
    }

    //***************************************************************************************************************************************

    function Lista_asignaciones_vg($proyecto, $ini, $cant) {
        $sql = "select sg.id, sg.NomComp, sg.id_solicitante , sg.placa , d.nombre as Proyecto , sg.fecha, sg.monto, sg.observacion
        from solicitud_gasolina sg , proyecto d
        WHERE sg.id_proy=d.id_proy
        and d.id_proy='$proyecto' ORDER BY sg.id DESC ";
        if ($cant > 0)
            $sql.=" LIMIT $ini , $cant";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

//functiones de solicitudes de uso vehicular $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    function registro_solicitud($codUser) {
        $cantdias = ((strtotime($this->input->post('fechaRetorno')) - strtotime($this->input->post('fechaSalida'))) / 86400) + 1;
        $datos = array(
            'id_user' => $codUser,
            'id_proy' => $this->input->post('proyecto'),
            'id_regional' => $this->input->post('regional'),
            'fecha_elaboracion' => $this->input->post('fechaElaborado'),
            'fecha_salida' => $this->input->post('fechaSalida'),
            'fecha_retorno' => $this->input->post('fechaRetorno'),
            'tipo_trabajo' => $this->input->post('tipo_trabajo'),
            'nro_pasajeros' => $this->input->post('nropasajeros'),
            'estado' => 'Solicitado',
            'cant_dias' => $cantdias,
            'id_user_destino' => 0
        );
        $this->db->insert('solicitud_uso_vehicular', $datos);

        return ($this->db->insert_id());
    }

    function consultasql($sql) {
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function solicitudes_uso_vehicular_lista() {
        $sql = "SELECT SUV.id,D.nombre as Proyecto,C.nombre as Regional,SUV.tipo_trabajo,
        SUV.fecha_elaboracion,SUV.fecha_salida,SUV.fecha_retorno,
        P.nombre_completo,SUV.estado
        FROM solicitud_uso_vehicular SUV,proyecto D,
        pasajeros_sav P, ciudad C
        WHERE D.id_proy=SUV.id_proy
        AND P.id_suv=SUV.id
        AND C.codciudad_pk=SUV.id_regional
        AND P.tipo='Conductor' ORDER BY SUV.id DESC ";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function mis_solicitudes_uso_vehicular($codUser) {
        $sql = "SELECT SUV.id,D.nombre as Proyecto,C.nombre as Regional,SUV.tipo_trabajo,
        SUV.fecha_elaboracion,SUV.fecha_salida,SUV.fecha_retorno,
        P.nombre_completo,SUV.estado
        FROM solicitud_uso_vehicular SUV,proyecto D,
        pasajeros_sav P, ciudad C
        WHERE SUV.id_user = $codUser
        AND D.id_proy=SUV.id_proy
        AND P.id_suv=SUV.id
        AND C.codciudad_pk=SUV.id_regional
        AND P.tipo='Conductor'";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function obtenerSolicitud($idsolicitud) {
        //$sql = "Select * FROM Solicitud_uso_vehicular WHERE id='$idsolicitud'";

        $sql = "SELECT SUV.id,D.nombre as Proyecto,SUV.id_regional,C.nombre as Regional,SUV.tipo_trabajo,
        SUV.fecha_elaboracion,SUV.fecha_salida,SUV.fecha_retorno,SUV.estado
        FROM solicitud_uso_vehicular SUV,proyecto D,
        ciudad C
        WHERE D.id_proy=SUV.id_proy
        AND C.codciudad_pk=SUV.id_regional
        AND SUV.id='$idsolicitud'";


        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            $fila = $consulta->row();
        }
        return $fila;
        //retorna la fila obtenida 
    }

    function obtenerCantidadDias($soluso) {
        $sql = "select cant_dias from solicitud_uso_vehicular where id='$soluso'";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            $fila = $consulta->row();
            return($fila->cant_dias);
        }
        else
            return 0;
    }

    function cambiarestadoSOLUSO() {
        $soluso = $this->input->post('soluso');
        echo "Soluso : $soluso";
        $cantidadD = $this->obtenerCantidadDias($soluso);
        $sql = "select SUM(veh.cant_dias) as TotalDias from vehiculo_estado_historial veh where veh.id_solicitud_uso='$soluso'";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            $fila = $consulta->row();
            $sql2 = "UPDATE solicitud_uso_vehicular SET estado='Solicitado' WHERE id='$soluso'";
            if ($fila->TotalDias >= $cantidadD) {
                $sql2 = "UPDATE solicitud_uso_vehicular SET estado='Asignado' WHERE id='$soluso'";
            } else {
                if ($fila->TotalDias > 0 and $fila->TotalDias < $cantidadD)
                    $sql2 = "UPDATE solicitud_uso_vehicular SET estado='Parcialmente Asignado' WHERE id='$soluso'";
            }
            $consulta = $this->db->query($sql2);
        }
    }

    function obtenerocupadofechaSolicitudusovehicularJSON($soluso, $calendario) {
        $vectorSolicitud = array();
        for ($i = 0; $i < count($calendario); $i++) {
            $sql = "select placa_vehiculo FROM vehiculo_estado_historial WHERE id_solicitud_uso='$soluso' and '$calendario[$i]' between fecha_inicio and fecha_fin";
            //echo '<br/>' . $calendario[$i];
            $consulta = $this->db->query($sql);
            if ($consulta->num_rows() > 0) {
                $fila = $consulta->row();
                $vectorSolicitud[] = array('placa'=>$fila->placa_vehiculo);
            } else {
                $vectorSolicitud[] = array('placa'=>'0');
            }
        }
        header('Content-type: application/json');
        echo json_encode($vectorSolicitud);
    }

    function obtener_placa_dia_solicitado($soluso, $dia) {
        $placa = array();
        $sql = "select placa_vehiculo FROM vehiculo_estado_historial WHERE id_solicitud_uso='$soluso' and '$dia' between fecha_inicio and fecha_fin";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            $fila = $consulta->row();
            $placa[0] = $fila->placa_vehiculo;
        } else {
            $placa[0] = '0';
        }
        header('Content-type: application/json');
        echo json_encode($placa);
    }

    //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
}
