<?php

class vehiculo_model extends CI_Model {

    function obtener_tipoVehiculo() {
        $sql = "select Tipo from Vehiculo where 1 group by tipo";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

    function busqueda_vehiculos_aptos() {
        $lugar = $this->input->post('lug');
        $traccion = $this->input->post('tracc');
        $nro_pasajeros = $this->input->post('cap');
        $tipo = $this->input->post('tipo');
        //$desde = $this->input->post('des');
        // $hasta = $this->input->post('has');

        $sql = "select * FROM vehiculo WHERE propio=1 ";
        if ($lugar != "Todos...")
            $sql.=" and lugar LIKE '$lugar' ";
        if ($traccion != "Todos")
            $sql.=" and  traccion ='$traccion' ";
        if ($nro_pasajeros != 0)
            $sql.=" and nro_pasajeros>=$nro_pasajeros";
        if ($tipo != "Todos")
            $sql.=" and tipo='$tipo' ";
        // echo $sql;
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

    function verifica_vehiculo_ocupado($placa) {
        $inicio = $this->input->post('des');
        $fin = $this->input->post('has');
        $sql = "SELECT * FROM vehiculo_estado_historial veh WHERE placa_vehiculo = '$placa'
                   and (fecha_inicio between '$inicio' and '$fin'
                   or fecha_fin between '$inicio' and '$fin'
                   or '$inicio' between fecha_inicio and fecha_fin
                   or '$fin' between fecha_inicio and fecha_fin )";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            //    echo $placa.'  Ocupado';
            return "Ocupado";
        } else {
            //  echo $placa."libre";
            return "Libre";
        }
    }

    function obtener_cronograma_vehiculo_vector($placa) {
        $fecinicio = $this->input->post('des');
        $fecfinal = $this->input->post('has');
        $vectorCalendario = array();
        $indice = 0;
        $segundos = strtotime($fecfinal) - strtotime($fecinicio);
        $nro = $nroDias = intval($segundos / 60 / 60 / 24) + 1;
        //echo "nro de dias=> $nro </br>";
        $antes = 15;
        $despues = 15;
        if ($nroDias % 2 != 0) {
            $nro = $nro - 1;
            $antes = $antes - 1;
        }
        $antes-=($nro / 2);
        $despues-=($nro / 2);

        $fecInigrande = date("Y-m-d", strtotime("$fecinicio -$antes day"));
        $fecFinGrande = date("Y-m-d", strtotime("$fecfinal +$despues day"));

        for ($i = 0; $i < 30; $i++) {
            $vectorCalendario[$i] = $this->vericifar_ocupado_en_diaX($placa, $fecInigrande);
            $fecInigrande = date("Y-m-d", strtotime("$fecInigrande +1 day"));
        }
        return $vectorCalendario;
    }

    function obtenerCalendario() {
        $fecinicio = $this->input->post('des');
        $fecfinal = $this->input->post('has');
        $vectorCalendario = array();
        $indice = 0;
        $segundos = strtotime($fecfinal) - strtotime($fecinicio);
        $nro = $nroDias = intval($segundos / 60 / 60 / 24) + 1;
        $antes = 15;
        $despues = 15;
        if ($nroDias % 2 != 0) {
            $nro = $nro - 1;
            $antes = $antes - 1;
        }
        $antes-=($nro / 2);
        $despues-=($nro / 2);

        $fecInigrande = date("Y-m-d", strtotime("$fecinicio -$antes day"));
        $fecFinGrande = date("Y-m-d", strtotime("$fecfinal +$despues day"));
        for ($i = 0; $i < 30; $i++) {
            $dia = substr($fecInigrande, 8, 2);
            $mes = substr($fecInigrande, 5, 2);
            $vectorCalendario[$i] = $dia . "/" . $mes;
            $fecInigrande = date("Y-m-d", strtotime("$fecInigrande +1 day"));
        }
        return $vectorCalendario;
    }

    function obtenerVectorParaestilo() {
        $fecinicio = $this->input->post('des');
        $fecfinal = $this->input->post('has');
        $vectorCalendario = array();
        $indice = 0;
        $segundos = strtotime($fecfinal) - strtotime($fecinicio);
        $nro = $nroDias = intval($segundos / 60 / 60 / 24) + 1;
        $antes = 15;
        $despues = 15;
        if ($nroDias % 2 != 0) {
            $nro = $nro - 1;
            $antes = $antes - 1;
        }
        $antes-=($nro / 2);
        $despues-=($nro / 2);

        $fecInigrande = date("Y-m-d", strtotime("$fecinicio -$antes day"));
        $fecFinGrande = date("Y-m-d", strtotime("$fecfinal +$despues day"));
        $x = 0;
        for ($i = 0; $i < 30; $i++) {

            if ($fecInigrande == $fecinicio)
                $x = 1;
            $vectorCalendario[$i] = $x;
            if ($fecInigrande == $fecfinal)
                $x = 0;


            $fecInigrande = date("Y-m-d", strtotime("$fecInigrande +1 day"));
        }
        return $vectorCalendario;
    }

    function vericifar_ocupado_en_diaX($placa, $dia) {
        $sql = " select veh.id_solicitud_uso from vehiculo_estado_historial veh
                WHERE veh.placa_vehiculo='$placa'
                and '$dia' Between veh.fecha_inicio and veh.fecha_fin";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            $fila = $consulta->row();
            return $fila->id_solicitud_uso;
        } else {
            return "0";
        }
    }

    function registrar_vehiculo_a_solicitud_de_uso($codUser) {
        $cantdias = ((strtotime($this->input->post('fechaRetorno')) - strtotime($this->input->post('fechaSalida'))) / 86400) + 1;
        $datos = array(
            'fecha_act' => date('Y-m-d'),
            'id_admin' => $codUser,
            'estado' => 'abierto',
            'comentario' => $this->input->post('comentario_asignacion'),
            'placa_vehiculo' => $this->input->post('placa_vehiculo'),
            'fecha_inicio' => $this->input->post('fechaSalida'),
            'fecha_fin' => $this->input->post('fechaRetorno'),
            'id_solicitud_uso' => $this->input->post('soluso'),
            'cant_dias' => $cantdias
        );
        $this->db->insert('vehiculo_estado_historial', $datos);
        return ($this->db->insert_id());
    }

    function obtener_vehiculos_asignados_a_solicitud($solicitud) {
        $sql = "SELECT * FROM vehiculo_estado_historial WHERE id_solicitud_uso= '$solicitud' ";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtenerocupadofechaVehiculoJSON($placa, $calendario) {
        $vectorSolicitud = array();
        for ($i = 0; $i < count($calendario); $i++) {
            $sql = "select veh.id_solicitud_uso FROM vehiculo_estado_historial veh WHERE veh.placa_vehiculo='$placa' and '$calendario[$i]' between fecha_inicio and fecha_fin";
            //echo '<br/>' . $calendario[$i];
            $consulta = $this->db->query($sql);
            if ($consulta->num_rows() > 0) {
                $fila = $consulta->row();
                $vectorSolicitud[] = array('soluso' => $fila->placa_vehiculo);
            } else {
                $vectorSolicitud[] = array('soluso' => '0');
            }
        }
        header('Content-type: application/json');
        echo json_encode($vectorSolicitud);
    }

    //realizando area de transportes// Autor:Magali Poma Rivero

    function adicionar_nuevo_vehiculo_for($id_vehiculo) {
        $sql = "select * from vehiculo where id_vehiculo=$id_vehiculo";
        $consulta = $this->db->query($sql);
        $row = 0;
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row;
    }

    function adicionar_nuevo_actividad_vehiculo($id_actividad) {
        $sql = "select * from actividad_vehiculo where id_actividad=$id_actividad";
        echo '' . $sql;
        $consulta = $this->db->query($sql);
        $row = 0;
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row;
    }

    function seleccionar_proyecto() {
        $sql = "select nombre from proyecto";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function guardar_nuevo_vehiculo_for() {
        $respuesta = "";

        $datos = array(
            'placa' => $this->input->post('placa'),
            'marca' => $this->input->post('marca'),
            'anio' => $this->input->post('anio'),
            'modelo' => $this->input->post('mod'),
            'tipo' => $this->input->post('tipo_vehi'),
            'estado' => $this->input->post('estado'),
            'color' => $this->input->post('color'),
            'nro_motor' => $this->input->post('motor'),
            'chasis' => $this->input->post('chasis'),
            'traccion' => $this->input->post('traccion'),
            'capacidad' => $this->input->post('cap_per'),
            'fecha_adquirida' => $this->input->post('fecha_ad'),
            'accesorios' => $this->input->post('accesorios'),
            'med_llanta' => $this->input->post('med_llanta'),
            'contrato' => $this->input->post('contrato'),
            'med_llanta' => $this->input->post('med_llanta'),
            'cilindrada' => $this->input->post('cilin'),
        );
        // para vehiculo
        // echo $this->input->post('id_vehi')."==0 ?";
        if ($this->input->post('id_vehi') == 0) {

            $this->db->insert('vehiculo', $datos);
            $id_vehi_nuevo = ($this->db->insert_id());
            // para movimiento
            // strtotime('+100 year',strtotime($this->input->post('fecha_cierre');
            //  echo 'strtotime....'.strtotime($this->input->post('fecha_cierre'));

            if ($this->input->post('estado') == 'Activo') {
                $datos = array(
                    'id_vehiculo' => $id_vehi_nuevo,
                    'fecha_act' => $this->input->post('fecha_inicio'),
                    'fecha_inac' => date('Y-m-d', strtotime('+20 year', strtotime($this->input->post('fecha_inicio')))),
                    'fecha_registro' => date("Y-m-d H:i:s"),
                    'motivo' => $this->input->post('motivo'),
                    'estado_mov' => $this->input->post('estado'),
                );
                $this->db->insert('actividad_vehiculo', $datos);
            }
            $respuesta = "<input type='hidden' id='ayudata' value='$id_vehi_nuevo'><input type='hidden' id='proceso' value='INSERT'><div class='OK'>El nuevo registro se ha adicionado correctamente!!!</div>";
        } else {
            //se esta editando los datos del vehiculo
            $datos_anterior = $this->obtener_dato_vehiculo($this->input->post('id_vehi'));
            ///echo "edita y el id es ".$this->input->post('id_vehi');
            $this->db->where('id_vehiculo', $this->input->post('id_vehi'));
            $upd = $this->db->update('vehiculo', $datos);
            //hasta aqui se modificaron datos del vehiculos
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_vehi') . "'><input type='hidden' id='proceso' value='UPDATE'><div class='OK'>Se ha Actualizado correctamente!!!</div>";
            // echo 'fecha'.$this->input->post('fecha_inicio');
            // echo 'fecha str'.strtotime($this->input->post('fecha_inicio'));
            // echo 'fecha+100 '.strtotime('+1 year',strtotime($this->input->post('fecha_inicio')));
            // echo 'datos......'.date('Y-m-d',  strtotime('+1 year',strtotime($this->input->post('fecha_inicio'))));
            if (($datos_anterior->row()->estado) != $this->input->post('estado')) {
                if ($this->input->post('estado') == 'Activo') {
                    $datos = array
                        (
                        'id_vehiculo' => $this->input->post('id_vehi'),
                        'fecha_registro' => date("Y-m-d H:i:s"),
                        'fecha_act' => $this->input->post('fecha_inicio'),
                        'fecha_inac' => date('Y-m-d', strtotime('+20 year', strtotime($this->input->post('fecha_inicio')))),
                        'motivo' => $this->input->post('motivo'),
                        'estado_mov' => $this->input->post('estado'),
                    );
                    $this->db->insert('actividad_vehiculo', $datos);
                } else {
                    $sql = "select * from actividad_vehiculo ac
                            where ac.id_vehiculo=" . $this->input->post('id_vehi') . " ORDER BY ac.id_actividad desc";
                    $consulta = $this->db->query($sql);
                    $datos = array('fecha_inac' => $this->input->post('fecha_cierre'),
                        'motivo' => $consulta->row()->motivo . " * " . $this->input->post('motivo'),
                        'estado_mov' => $consulta->row()->estado_mov . " * " . $this->input->post('estado_mov'),
                    );
                    $this->db->where('id_actividad', $consulta->row()->id_actividad);
                    $this->db->update('actividad_vehiculo', $datos);
                }
            }
        }
        return($respuesta);
    }

    function listar_buscar_vehiculo($busqueda, $ini, $cant) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select * from vehiculo ve
            where  concat(ve.id_vehiculo,ve.placa,ve.modelo,ve.nro_motor,ve.chasis,ve.traccion,
            ve.capacidad,ve.accesorios,ve.marca,ve.anio,ve.contrato,ve.tipo,ve.estado,ve.fecha_adquirida) lIKE '%$busqueda%'
             order by ve.id_vehiculo DESC ";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_buscar_vehiculo_cantidad($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);

        $sql = "select * from vehiculo ve
            where concat(ve.id_vehiculo,ve.placa,ve.modelo,ve.nro_motor,ve.chasis,ve.traccion,
            ve.capacidad,ve.accesorios,ve.marca,ve.anio,ve.contrato,ve.tipo,ve.estado,ve.fecha_adquirida) lIKE '%$busqueda%'
             order by ve.id_vehiculo DESC";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function datos_asigna_respon() {
        $sql = "select * from asigna_vehiculo_usuario ";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function seleccionar_persona_asignar_vehiculo() {
        $sql = "select * 
from usuarios us
order by us.ap_paterno ASC  ";
        $consulta = $this->db->query($sql);
        //return ($consulta->row());
        return($consulta);
    }

    function mostrar_estado_vehiculo($id_vehiculo) {
        $sql = "select * from estado_vehicular est where est.id_vehiculo_est=$id_vehiculo";
        $consulta = $this->db->query($sql);
        // return($consulta);
        return ($consulta->row());
    }

    function guardar_vehiculo_asignado() {

        $respuesta = "";
        //echo 'ciudad_asig'.$this->input->post('ciudad_asig').'<br>';
        $datos = array(
            'id_vehiculo_resp' => $this->input->post('id_vehiculo_resp'),
            'id_estado_asig' => $this->input->post('id_estado_asig'),
            'fecha_hora_asig' => $this->input->post('fecha_hora_asig'),
            'fecha_hora_devolucion' => $this->input->post('fecha_hora_dev'),
            'id_responsable' => $this->input->post('id_responsable'),
            'id_encargado' => $this->session->userdata('id_admin'),
            'id_ciudad' => $this->input->post('ciudad_asig'),
            'observaciones' => $this->input->post('observaciones'),
            'estado_registro' => $this->input->post('estado_registro'),
            'tipo_asignacion' => $this->input->post('tipo_asignacion'),
            'id_devolucion_veh' => $this->input->post('id_devolucion_veh')
// sentencia naterior ----------&& $this->input->post('id_devolucion_veh')==$this->input->post('id_asig')
        );
        if ($this->input->post('id_asig') == 0) {
            $this->db->insert('asigna_vehiculo_usuario', $datos);
            $id_vehi_resp_asig = ($this->db->insert_id());
            $respuesta = "<input type='hidden' id='ayudata' value='$id_vehi_resp_asig'><input type='hidden' id='proceso' value='INSERT'><div class='OK'>Se ha ADICIONADO correctamente!!!</div>";
        } else {
            $this->db->where('id_asig_reponsable', $this->input->post('id_asig'));
            $upd = $this->db->update('asigna_vehiculo_usuario', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_asig') . "'><input type='hidden' id='proceso' value='UPDATE'><div class='OK'>Se ha EDITADO correctamente!!!</div>";
        }
        return($respuesta);
    }

    function nuevo_estado_de_vehiculo($id_estado) {
        $sql = "select *  from estado_vehicular est 
             where est.id_estado_vehi=$id_estado";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function guardar_nuevo_estado() {

        $respuesta = "";
        $datos = array(
            'id_vehiculo_est' => $this->input->post('id_vehi'),
            'estado_mecanico' => $this->input->post('est_mec'),
            'estado_carroceria' => $this->input->post('est_carr'),
            'estado_llantas' => $this->input->post('est_llan'),
            'fh_registro' => date("Y-m-d H:i:s"),
            'kilometraje' => $this->input->post('kilom'),
            'observacion_estado' => $this->input->post('obser_estado'),
        );
        if ($this->input->post('id_estado_vehi') == 0) {
            $this->db->insert('estado_vehicular', $datos);
            $id_vehi_est = ($this->db->insert_id());
            $respuesta = "<input type='hidden' id='ayudata' value='$id_vehi_est'><input type='hidden' id='proceso' value='INSERT'><div class='OK'>El nuevo registro se ha adicionado correctamente!!!</div>";
        } else {
            $this->db->where('id_estado_vehi', $this->input->post('id_estado_vehi'));
            $upd = $this->db->update('id_estado_vehi', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_estado_vehi') . "'><input type='hidden' id='proceso' value='UPDATE'>";
        }
        return($respuesta);
    }

    function ultimo_estado_vehiculo($id_vehiculo) {

        if ($id_vehiculo != 0)
            $sql = "select *
                from estado_vehicular est
                where est.id_vehiculo_est=$id_vehiculo
                ORDER BY  est.id_estado_vehi DESC";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function seleccionar_ciudad_asignar() {
        $sql = 'select * from ciudad where 1';
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function registro_vehiculo_asignado($id_asignacion) {
        $sql = "select *
                from asigna_vehiculo_usuario asig
                where asig.id_asig_reponsable=$id_asignacion";
        $consulta = $this->db->query($sql);
        return $consulta->row();
    }

    function guardar_vehiculo_asig_taller_proyecto() {

        $respuesta = "";
        $selec = $this->input->post('tipo_asignacion');
        // echo 'mostrando telef_ta-->'.$telef_ta;
        // echo 'mostrando telef_pro-->'.$telef_pro;
        //echo 'mostrando'.;
        $datos = array(
            'id_vehiculo_resp' => $this->input->post('id_vehiculo_resp'),
            'id_estado_asig' => $this->input->post('id_estado_asig'),
            'fecha_hora_asig' => $this->input->post('fecha_hora_asig'),
            'fecha_hora_devolucion' => $this->input->post('fecha_hora_dev'),
            'id_responsable' => $this->input->post('id_responsable'),
            'id_ciudad' => $this->input->post('ciudad_asig'),
            'observaciones' => $this->input->post('observaciones'),
            'estado_registro' => $this->input->post('estado_registro'),
            'tipo_asignacion' => $this->input->post('tipo_asignacion'),
            'telefono_celular' => $this->input->post('telefono'),
            'nombre_taller' => "",
            'nombre_tecnico' => "",
            'id_proyecto' => $this->input->post('id_proyecto'),
            'subcentro' => $this->input->post('selec_subcentro'),
            'id_encargado' => $this->session->userdata('id_admin')
        );
        if ($selec == "Taller") {
            $datos = array(
                'id_vehiculo_resp' => $this->input->post('id_vehiculo_resp'),
                'id_estado_asig' => $this->input->post('id_estado_asig'),
                'fecha_hora_asig' => $this->input->post('fecha_hora_asig'),
                'fecha_hora_devolucion' => $this->input->post('fecha_hora_dev'),
                'id_responsable' => $this->input->post('id_responsable'),
                'id_ciudad' => $this->input->post('ciudad_asig'),
                'observaciones' => $this->input->post('observaciones'),
                'estado_registro' => $this->input->post('estado_registro'),
                'tipo_asignacion' => $this->input->post('tipo_asignacion'),
                'telefono_celular' => $this->input->post('telefono'),
                'nombre_taller' => $this->input->post('nombre_taller'),
                'nombre_tecnico' => $this->input->post('nombre_tecnico'),
                'id_proyecto' => "",
                'id_responsable' => "",
                'subcentro' => "",
                'reemplazo' => $this->input->post('reemplazo'),
                'id_encargado' => $this->session->userdata('id_admin')
            );
        }

        if ($this->input->post('id_asig_resp') == 0) {
            $this->db->insert('asigna_vehiculo_usuario', $datos);
            $id_vehi_resp_asig = ($this->db->insert_id());
            $respuesta = "<input type='hidden' id='ayudata' value='$id_vehi_resp_asig'><input type='hidden' id='proceso' value='INSERT'><div class='OK'>Se ha ADICIONADO correctamente!!!</div>";
        } else {
            $this->db->where('id_asig_reponsable', $this->input->post('id_asig_resp'));
            $upd = $this->db->update('asigna_vehiculo_usuario', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_asig_resp') . "'><input type='hidden' id='proceso' value='UPDATE'><div class='OK'>Se ha EDITADO correctamente!!!</div>";
        }
        return($respuesta);
    }

    /* function vehi_asig_responsables(){
      $sql="select *
      from asigna_vehiculo_usuario asig
      WHERE asig.estado_registro='asignado_responsable'";
      } */

    //busca en la tabla asiignados si es activo y responsable
    function buscar_registro_responsable_asignado($id_vehiculo) {
        $sql = "select asig.id_asig_reponsable, ve.id_vehiculo,asig.tipo_asignacion,asig.estado_registro, us.nombre,us.ap_paterno,us.ap_materno
              from asigna_vehiculo_usuario asig, vehiculo ve, usuarios us
              WHERE ve.id_vehiculo=asig.id_vehiculo_resp
              and asig.estado_registro='Activo' 
              and asig.tipo_asignacion='Responsable'
              and asig.id_responsable=us.cod_user 
              and asig.id_vehiculo_resp=$id_vehiculo";

        $consulta = $this->db->query($sql);
        $resul2 = array();
//         if ($consulta->num_rows() > 1)
//         {
//            echo "NAL : ".$sql."<br>"; 
//         }

        if ($consulta->num_rows() > 0) {
            // echo "Nacional:".$consulta->num_rows()."<br><br>";
            $resul2[0] = $consulta->row(0)->id_asig_reponsable;
            $resul2[1] = $consulta->row(0)->nombre . ' ' . $consulta->row(0)->ap_paterno . ' ' . $consulta->row(0)->ap_materno;
        } else {
            $resul2[0] = 0;
            $resul2[1] = 'Libre';

// echo "Nacional: 0";
        }
        return $resul2;
    }

    function buscar_registro_proyecto_o_taller($id_vehiculo) {
        $sql = "select asig.id_asig_reponsable, ve.id_vehiculo,asig.tipo_asignacion,asig.estado_registro,asig.nombre_taller,asig.id_proyecto,asig.subcentro
              from asigna_vehiculo_usuario asig, vehiculo ve
              WHERE ve.id_vehiculo=asig.id_vehiculo_resp
              and asig.estado_registro='Activo' 
              and asig.tipo_asignacion<>'Responsable'
              and asig.id_vehiculo_resp=$id_vehiculo order by asig.id_asig_reponsable DESC";
        //echo $sql;
        $consulta = $this->db->query($sql);
        $result = array();

        if ($consulta->num_rows() > 0) {
            // echo "REG : ".$sql."<br>";
            //echo $consulta->num_rows()."  id --->".$id_vehiculo."<br>";
            if ($consulta->row(0)->tipo_asignacion == 'Proyecto') {
                $sql1 = "select proy.nombre
                    from proyecto proy
                    where proy.id_proy=" . $consulta->row(0)->id_proyecto;
                // echo $sql1;
                $consulta2 = $this->db->query($sql1);
                // return $consulta->row(0)->nombre;
                $result[0] = $consulta2->row(0)->nombre;
                $result[1] = $consulta->row(0)->tipo_asignacion;
                $result[2] = $consulta->row(0)->subcentro;
            } else {
                $result[0] = $consulta->row(0)->nombre_taller;
                $result[1] = $consulta->row(0)->tipo_asignacion;
                $result[2] = '--';
            }

            // echo 'result0'.$result[0];
            // echo 'result1'.$result[1];
            // return 'Taller:'.$consulta->row(0)->nombre_taller;
        } else {
            $result[0] = 'Libre';
            $result[1] = 'no corresponde';
            $result[2] = 'Ninguno';
        }
        return $result; //return 'Libre';
    }

    function buscar_departamento_asignado($id_vehiculo) {
        $sql = " select asig.id_asig_reponsable, ve.id_vehiculo,asig.tipo_asignacion,asig.estado_registro, us.nombre,us.ap_paterno,us.ap_materno,c.nombre as nom_ciudad
              from asigna_vehiculo_usuario asig, vehiculo ve, usuarios us, ciudad c
              WHERE ve.id_vehiculo=asig.id_vehiculo_resp
              and asig.estado_registro='Activo' 
              and (asig.tipo_asignacion='Responsable'or asig.tipo_asignacion='Proyecto')
              and asig.id_responsable=us.cod_user 
              and asig.id_ciudad=c.codciudad_pk
              and asig.id_vehiculo_resp=$id_vehiculo
        order by asig.id_asig_reponsable DESC";
        //echo "REG : ".$sql."<br>";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            //if($consulta->row(0)->tipo_asignacion=='Proyecto')
            // {
            return $consulta->row(0)->nom_ciudad;
            ///  }
            // else 
            //   return $consulta->row(0)->nom_ciudad;
        } else
            return 'Sin asignacion';
    }

    function buscar_estado_vehicular($id_vehiculo) {

        //echo 'entra';
        $sql = "select *
                from estado_vehicular est
                where est.id_vehiculo_est=$id_vehiculo
                ORDER BY  est.id_estado_vehi DESC";
        ///echo $sql;
        $consulta = $this->db->query($sql);
        $result = array();
        if ($consulta->num_rows() > 0) {
            $result[0] = $consulta->row(0)->estado_mecanico;
            $result[1] = $consulta->row(0)->estado_carroceria;
            //  $result[2]=$consulta->row(0)->kilometraje;
            $result[3] = $consulta->row(0)->estado_llantas;
            //return $consulta->row(0)->estado_mecanico.' '.$consulta->row(0)->estado_carroceria.' '.$consulta->row(0)->kilometraje.' '.$consulta->row(0)->estado_llantas;
        } else {
            $result[0] = 'Sin estado';
            $result[1] = '-';
            // $result[2]='-';
            $result[3] = '-';
        }

        return $result;  //return 'Sin estado';
    }

    function obtener_datos_asignacion($id_asignacion) {
        $sql = "select *
              from asigna_vehiculo_usuario asig, vehiculo ve
              where asig.id_vehiculo_resp=ve.id_vehiculo
            and asig.id_asig_reponsable=$id_asignacion";
        $consulta = $this->db->query($sql);
        return $consulta->row();
    }

    function seleccionar_persona_asignar_vehiculo_edita($id_asignacion) {
        $sql = "select u.nombre,u.ap_paterno,u.ap_materno
                from usuarios u, asigna_vehiculo_usuario asig
                where    asig.id_responsable=u.cod_user
                and asig.id_asig_reponsable=$id_asignacion";
        $consulta = $this->db->query($sql);
        //return ($consulta->row());
        return $consulta->row();
    }

    function seleccionar_ciudad_asignar_edita($id_asignado) {
        $sql = "   
                 select c.nombre
                 from ciudad c, asigna_vehiculo_usuario asig
                 where asig.id_ciudad=c.codciudad_pk
                 and asig.id_asig_reponsable=$id_asignado ";
        $consulta = $this->db->query($sql);
        return $consulta->row();
    }

    function buscar_vehiculo_estado($id_vehiculo) {
        $sql = "select *
                from estado_vehicular est, asigna_vehiculo_usuario asig
                where est.id_vehiculo_est=$id_vehiculo
                and  asig.id_estado_asig=est.id_estado_vehi
                ORDER BY  est.id_estado_vehi DESC";
        $consulta = $this->db->query($sql);
        return $consulta->row();
    }

    function obtener_estado_asignado($id_asignacion) {


        $sql = "select us.id_estado_asig,est.id_estado_vehi,est.estado_mecanico,est.estado_carroceria,est.estado_llantas
                from estado_vehicular est, asigna_vehiculo_usuario us
                where us.id_estado_asig=est.id_estado_vehi
                and us.id_asig_reponsable=$id_asignacion";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function guardar_vehiculo_asignado_editado() {

        $respuesta = "";

        $datos = array(
            'id_encargado' => $this->session->userdata('id_admin'),
            'fecha_hora_devolucion' => $this->input->post('fecha_hora_dev'),
            'observaciones' => $this->input->post('observaciones'),
            'estado_registro' => $this->input->post('estado_registro'),
        );
        if ($this->input->post('id_asig') != 0) {
            $this->db->where('id_asig_reponsable', $this->input->post('id_asig'));
            $upd = $this->db->update('asigna_vehiculo_usuario', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_asig') . "'><input type='hidden' id='proceso' value='UPDATE'><div class='OK'>Se ha EDITADO correctamente!!!</div>";
        }
        return($respuesta);
    }

    //probando otra opcion de editado
    function guardar_vehiculo_asignado_editado_prueb() {

        $respuesta = "";

        $datos = array(
            'id_encargado' => $this->session->userdata('id_admin'),
            'fecha_hora_devolucion' => $this->input->post('fecha_hora_dev'),
            // 'observaciones' => $this->input->post('observaciones'),
            'estado_registro' => 'Inactivo',
        );
        if ($this->input->post('id_asig') != 0) {
            $this->db->where('id_asig_reponsable', $this->input->post('id_asig'));
            $upd = $this->db->update('asigna_vehiculo_usuario', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_asig') . "'><input type='hidden' id='proceso' value='UPDATE'><div class='OK'>Se ha EDITADO correctamente!!!</div>";
        }
        return($respuesta);
    }

    function guardar_vehiculo_asignado_prueb() {

        $respuesta = "";
        $datos = array(
            'id_vehiculo_resp' => $this->input->post('id_vehiculo_resp'),
            'id_estado_asig' => $this->input->post('id_estado_asig'),
            'fecha_hora_asig' => $this->input->post('fecha_hora_asig'),
            'fecha_hora_devolucion' => $this->input->post('fecha_hora_dev'),
            'id_responsable' => $this->input->post('id_responsable'),
            'id_encargado' => $this->session->userdata('id_admin'),
            'id_ciudad' => $this->input->post('ciudad_asig'),
            'observaciones' => $this->input->post('observaciones'),
            'estado_registro' => $this->input->post('estado_registro'),
            'tipo_asignacion' => $this->input->post('tipo_asignacion'),
            'id_devolucion_veh' => $this->input->post('id_devolucion_veh')
// sentencia naterior ----------&& $this->input->post('id_devolucion_veh')==$this->input->post('id_asig')
        );
        if ($this->input->post('id_asig') != 0) {
            $this->db->insert('asigna_vehiculo_usuario', $datos);
            $id_vehi_resp_asig = ($this->db->insert_id());
            $respuesta = "<input type='hidden' id='ayudata' value='$id_vehi_resp_asig'><input type='hidden' id='proceso' value='INSERT'><div class='OK'>Se ha ADICIONADO correctamente!!!</div>";
        }
        return($respuesta);
    }

    //adicionando

    function nombre_taller() {
        $sql = 'select distinct asig.nombre_taller, asig.tipo_asignacion from asigna_vehiculo_usuario asig where 1';
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function guardar_datos_imagen() {

        $respuesta = "";
        $datos = array(
            'id_vehiculo_ima' => $this->input->post('id_vehi'),
            'nom_archivo' => $this->input->post('titulo'),
            'fecha_imagen' => date("Y-m-d H:i:s")
// sentencia naterior ----------&& $this->input->post('id_devolucion_veh')==$this->input->post('id_asig')
        );
        if ($this->input->post('id_imagen') != 0) {
            $this->db->insert('imagenes_vehiculo', $datos);
            $id_ima = ($this->db->insert_id());
            $respuesta = "<input type='hidden' id='ayudata' value='$id_ima'><input type='hidden' id='proceso' value='INSERT'><div class='OK'>Se ha ADICIONADO correctamente!!!</div>";
        }
        return($respuesta);
    }

    function buscar_dato_ima($id_vehiculo) {
        $sql = "select *  from imagenes_vehiculo ima 
             where ima.id_vehiculo_ima=$id_vehiculo";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function guardar_datos_imagen_parametro($id_vehiculo, $nom_archivo, $ruta, $tipo1) {

        $respuesta = "";
        $datos = array(
            'id_vehiculo_ima' => $id_vehiculo,
            'nom_archivo' => $nom_archivo,
            'tipo_archivo' => $tipo1,
            'fecha_imagen' => date("Y-m-d H:i:s"),
            'ruta' => $ruta
// sentencia naterior ----------&& $this->input->post('id_devolucion_veh')==$this->input->post('id_asig')
        );

        $this->db->insert('imagenes_vehiculo', $datos);
        $id_ima = ($this->db->insert_id());
        $respuesta = "<input type='hidden' id='ayudata' value='$id_ima'><input type='hidden' id='proceso' value='INSERT'><div class='OK'>Se ha ADICIONADO correctamente!!!</div>";

        return($id_ima);
    }

    function obtener_dato_vehiculo($id_vehiculo) {
        $sql = "select *
                from vehiculo v
                where v.id_vehiculo=$id_vehiculo";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    //ultimo adicionado
    function obtener_historial_vehiculo($id_vehiculo) {
        $sql = "select asig.nombre_taller,asig.reemplazo,asig.nombre_tecnico,asig.id_asig_reponsable,v.placa, asig.id_responsable, 
        asig.fecha_hora_asig,asig.fecha_hora_devolucion,asig.observaciones,asig.id_vehiculo_resp,
        es.estado_mecanico,es.estado_carroceria,es.estado_llantas,asig.tipo_asignacion ,asig.estado_registro
        from asigna_vehiculo_usuario asig, vehiculo v, estado_vehicular es
        where 
        asig.id_vehiculo_resp=v.id_vehiculo
        and asig.id_estado_asig=es.id_estado_vehi
        and asig.id_vehiculo_resp=$id_vehiculo";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    //ultimo adicionando
    function obtener_departamento_hist($id_asig_responsable) {

        $sql = "  select asig.id_ciudad,asig.id_asig_reponsable,asig.tipo_asignacion 
                    from asigna_vehiculo_usuario asig
                    where asig.id_asig_reponsable=$id_asig_responsable";

        //  echo 'obte <br>'.$sql;

        $consulta = $this->db->query($sql);

        if ($consulta->num_rows() > 0) {
            if ($consulta->row()->tipo_asignacion == "Proyecto") {
                $sql1 = "select c.nombre 
                             from ciudad c
                             where c.codciudad_pk=" . $consulta->row()->id_ciudad;
                //   echo 'ciudad <br>'.$sql1;
                $consulta2 = $this->db->query($sql1);
                $nombre_ciudad = '';
                //echo $consulta2->row()->nombre."*****";
                if ($consulta2->num_rows() > 0) {
                    $resul2 = $consulta2->row()->nombre;
                    //   echo 'nombre_ciu <br>'.$nombre_ciudad;
                } else {
                    $resul2 = '-';
                }
            } else
                $resul2 = "";
        }
        // echo $resul2;
        return $resul2;
    }

    ///// add function for pdf
    function buscar_asignado_vehiculo_por_proyecto() {

        $sql2 = "select us.subcentro, v.placa, v.modelo, v.marca,v.tipo, v.anio, v.color, us.id_vehiculo_resp,
                    pro.nombre,v.contrato, c.nombre as nom_ciudad,us.observaciones, us.id_estado_asig,
                   TRUNCATE((es.estado_mecanico+es.estado_carroceria)/2,0) as suma_estado
                    from asigna_vehiculo_usuario us, vehiculo v, proyecto pro, ciudad c, estado_vehicular es
                    where us.tipo_asignacion='Proyecto'
                    and us.estado_registro='Activo'
                    and us.id_vehiculo_resp=v.id_vehiculo
                    and us.id_proyecto=pro.id_proy
                    and us.id_ciudad=c.codciudad_pk
                    and us.id_estado_asig=es.id_estado_vehi";
        // echo '----'.$sql2;
        $consulta2 = $this->db->query($sql2);

        return $consulta2;
    }

    function buscar_asignado_taller() {
        $sql = "select us.subcentro, v.placa, v.modelo,v.marca,v.tipo,v.anio,v.color,
                us.nombre_taller,v.contrato, c.nombre as nom_ciudad,us.observaciones,
                TRUNCATE((es.estado_mecanico+es.estado_carroceria)/2,0) as suma_estado
                from asigna_vehiculo_usuario us, vehiculo v, ciudad c, estado_vehicular es
                where us.tipo_asignacion='Taller'
                and us.estado_registro='Activo'
                and c.codciudad_pk=us.id_ciudad
                and us.id_vehiculo_resp=v.id_vehiculo
                and es.id_estado_vehi=us.id_estado_asig";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function buscar_vehiculos_no_asig($id_vehiculo) {
        //echo $id_vehiculo;
        $sql = "select us.subcentro, v.placa, v.modelo,v.marca,v.tipo,v.anio,v.color,us.tipo_asignacion,us.id_vehiculo_resp,
                            us.nombre_taller,v.contrato, c.nombre as nom_ciudad,us.observaciones,
                            TRUNCATE((es.estado_mecanico+es.estado_carroceria)/2,0) as suma_estado
                            from asigna_vehiculo_usuario us, vehiculo v, ciudad c, estado_vehicular es
                            where us.estado_registro='Activo'
                           
                             and us.id_vehiculo_resp=v.id_vehiculo
                            and c.codciudad_pk=us.id_ciudad
                            and es.id_estado_vehi=us.id_estado_asig
                            and us.id_vehiculo_resp=$id_vehiculo
                            order by us.id_asig_reponsable DESC";
        $consulta = $this->db->query($sql);
        //$result=array();
        $result = "";
        if ($consulta->num_rows() > 0) {

            if ($consulta->row()->tipo_asignacion == "Responsable") {
                $result = $consulta->row();
            }
        } else {
            $result = 'Sin asignacion';
        }


        return $result;
    }

    function promedio_estado_vehicular($id_vehiculo) {
        $sql = "select TRUNCATE((est.estado_mecanico+est.estado_carroceria)/2,0) as suma_estado
              from estado_vehicular est
              where est.id_vehiculo_est=$id_vehiculo";
        $consulta = $this->db->query($sql);
    }

    function cant_contrato_estado($contr, $est) {
        $sql = "select count(*) as cantidad
            from vehiculo v
            where v.estado like '$est'
            and v.contrato like '$contr' ";
        $consulta = $this->db->query($sql);
        return $consulta->row()->cantidad;
    }

    function lista_vehiculo_contrato_estado($contr, $est) {
        $sql = "select *
            from vehiculo v
            where v.estado like '$est'
            and v.contrato like '$contr' ";
        $consulta = $this->db->query($sql);
        //echo $sql;
        return $consulta;
    }

    function listar_vehiculos_proyecto($id_usuario, $id_proyecto) {
        if ($id_proyecto == 0) {
            $sql = "select apc.id_proy, p.nombre
                    from admin_proyecto_cargo apc , proyecto p
                    where apc.id_admin=$id_usuario
                    and p.id_proy=apc.id_proy and apc.estado='Activo'";
            $consulta = $this->db->query($sql);

            $proyectos_condicion = "";
            $sw = 1;
            foreach ($consulta->result() as $proyectos) {
                if ($sw == 0) {
                    $proyectos_condicion.=" or ";
                }
                $proyectos_condicion.=" avu.id_proyecto = " . $proyectos->id_proy;
                $sw = 0;
            }

            if ($sw == 0)
                $proyectos_condicion = " and (" . $proyectos_condicion . ") ";
            // hasta aqui para completar el codigo sql siguiente
        }
        else {
           
            $proyectos_condicion = "and  avu.id_proyecto = " . $id_proyecto;
        }
        $ssql = "select count(v.contrato) as cantidad, v.contrato
                from asigna_vehiculo_usuario avu, vehiculo v
                where avu.id_vehiculo_resp=v.id_vehiculo  
                $proyectos_condicion
                and avu.estado_registro LIKE 'Activo'
                group by contrato";
        //echo "si llega<br>".$ssql;
        $consulta = $this->db->query($ssql);
        return($consulta);
    }

}
