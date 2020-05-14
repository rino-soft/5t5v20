<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of rendiciones_model
 *
 * @author POMA RIVERO
 */
class rendiciones_model extends CI_Model {

    function seleccionar_nombre_tecnico() {
        $sql = "select * from usuarios u order by u.ap_paterno";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function obtener_mis_proyectos_sql($usuario, $idproyecto, $campo) {
        $this->load->model('usuario_model');

        if ($idproyecto == 0) {
            $proyectos = $this->usuario_model->obtProyectoUserResult($usuario);
            $codigo = "";
            $sw = 0;
            foreach ($proyectos->result() as $p) {
                if ($sw == 1) {
                    $codigo.=" or ";
                }
                $sw = 1;
                $codigo.=" " . $campo . "=" . $p->id_proy;
            }
        } else
            $codigo = " " . $campo . "=" . $idproyecto;

        return $codigo;
    }

    function obtener_detalle_tg($id_proy, $tecnico, $tipo, $ab, $mes_ini, $mes_fin) {
        $fi = strtotime($mes_ini);
        $ff = strtotime($mes_fin);

        $codigo_proy = $this->obtener_mis_proyectos_sql($this->session->userdata('id_admin'), $id_proy, "rr.id_proy");
        $usuario = "";
        if ($tecnico != 0)
            $usuario = "and rr.id_tecnico_asignado=" . $tecnico;

        //cambiar id_rpoy por toos los proyectos
        $sql = ' select tg.idg_transporte,tg.descripcion_tra,tg.tipo, rrd.c_s_factura,concat(tg.idg_transporte,tg.tipo,rrd.c_s_factura) as cond
        from (reg_form_rendicion rr left join reg_form_rendicion_detalle rrd on  rr.idreg_ren=rrd.id_reg_rendicion)
        left join tipo_gasto_rendicion tg on rrd.id_tipo_gasto=tg.idg_transporte 
        where (' . $codigo_proy . ') 
            ' . $usuario . ' 
        and tg.tipo="' . $tipo . '"
        and rrd.c_s_factura=' . $ab . '
        and rrd.fecha_factura between "' . date("Y", $fi) . '/' . date("m", $fi) . '/01" and "' . date("Y", $ff) . '/' . date("m", $ff) . '/31"                         
            
        group by  tg.tipo,rrd.c_s_factura,tg.descripcion_tra
      ';
        // echo $sql.";  <br>";

        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function obtener_monto_detalle_ren_tg_mes($id_proy,$tecnico , $tipo, $ab, $mes) {
        $usuario = "";
        if ($tecnico != 0)
            $usuario = "and rr.id_tecnico_asignado=" . $tecnico;
        $codigo_proy = $this->obtener_mis_proyectos_sql($this->session->userdata('id_admin'), $id_proy, "rr.id_proy");
        // echo "mes".$mes."<br>";
        $fa = strtotime($mes);
        //cambiar id_rpoy por toos los proyectos
        $sql = ' select tg.idg_transporte,tg.descripcion_tra,sum(rrd.monto) as monto_mes,tg.tipo,month(rrd.fecha_factura)as mes,
        if(rrd.c_s_factura=1,concat(tg.tipo,"-A"),concat(tg.tipo,"-B")) as todo,  concat(tg.idg_transporte,tg.tipo,rrd.c_s_factura) as cond
        from (reg_form_rendicion rr left join reg_form_rendicion_detalle rrd on  rr.idreg_ren=rrd.id_reg_rendicion)
        left join tipo_gasto_rendicion tg on rrd.id_tipo_gasto=tg.idg_transporte 
        where (' . $codigo_proy . ')   
            ' . $usuario . ' 
          and tg.tipo="' . $tipo . '"
        and rrd.c_s_factura=' . $ab . '
        and year(rrd.fecha_factura)=' . date("Y", $fa) . ' 
        and month(rrd.fecha_factura)=' . date("m", $fa) . '
        group by month(rrd.fecha_factura),tg.tipo,rrd.c_s_factura,tg.descripcion_tra
        order by tg.idg_transporte
      ';
        //echo "<br>***************<br>".$sql."<br>***************<br>";
        $consulta = $this->db->query($sql);
        return $consulta;
    }
    
    //          SSSSSS         TTTTTTTTTTT        SSSSSS
    //        SSSS  SSS        TTTTTTTTTTT      SSSS  SSS 
    //         SSS                 TTT           SSS
    //           SSSSS             TTT             SSSSS
    //             SSSS            TTT               SSSS 
    //         SS    SSS           TTT           SS    SSS   
    //           SSSSS             TTT             SSSSS 
    
    
    

    function obtener_creditos($tipo, $usuario, $accion) {
        if ($tipo == "Rendicion") {
            $sql = "select * from sol_frendir sf
                    where sf.id_usuario=$usuario
                    and sf.saldo>0";
            $consulta = $this->db->query($sql);

            $codigo = '<div class="f16 centrartexto bg-blue negrilla"> fondos a Rendir Solicitados sin Rendir</div> 
        <table class="table"> <thead>
                        <tr>
                          <th>id sol/ Titulo</th>
                          <th>Saldo / Monto</th>
                          <th>seleccione para Rendir</th>
                        </tr>
                      </thead><tbody>';
            foreach ($consulta->result() as $fr) {
                //if($accion=="mio")
                $acc = 'mostrar_fomrulario_nueva_rendicion_mio(0,\'Rendicion\',\'' . $fr->id_sol_frendir . '\',' . $usuario . ' )';
                //if($accion=="terceros")
                //  $acc=1;
                $codigo.='  <tr>
                          <td>id :<span style="color:blue">' . $fr->id_sol_frendir . '</span> / ' . $fr->titulo . '</td>
                          <td><span style="color:blue">' . $fr->saldo . '</span> / <span style="color:red">' . $fr->monto . '</span></td>
                          <td><button class="btn btn-primary btn-xs" onclick=" Imp_sol_fr(' . $fr->id_sol_frendir . ')">ver</button> 
                              <button class="btn btn-success btn-xs" onclick="' . $acc . '" >Rendir</button></td>
                        </tr>';
            }
            $codigo.=" </tbody></table>";
            return $codigo;
        }
        if ($tipo == "Reembolso") {
            $sql = "select * 
                    from caja_chica cc left join proyecto p on cc.id_proyecto = p.id_proy
                    where cc.id_usuario=$usuario
                    and cc.estado LIKE 'activo'";
            $consulta = $this->db->query($sql);

            $codigo = '<div class="f16 centrartexto bg-orange negrilla"> Cajas Chicas Activas</div> 
        <table class="table"> <thead>
                        <tr>
                          <th>id sol/ Proyecto</th>
                          <th>Saldo / Monto</th>
                          <th>seleccione para Rendir</th>
                        </tr>
                      </thead><tbody>';
            foreach ($consulta->result() as $fr) { //if($accion=="mio")
                $acc = 'mostrar_fomrulario_nueva_rendicion_mio(0,\'Reembolso\',\'' . $fr->idcaja_chica . '\',' . $usuario . ' )';
                //if($accion=="terceros")
                //  $acc=1;

                $codigo.='  <tr>
                          <td>id :<span style="color:blue">' . $fr->idcaja_chica . '</span> / ' . $fr->nombre . '</td>
                          <td><span style="color:blue">' . $fr->saldo . '</span> / <span style="color:red">' . $fr->monto . '</span></td>
                          <td>
                              <button class="btn btn-success btn-xs" onclick="' . $acc . ' ">Rendir</button></td>
                        </tr>';
            }
            $codigo.=" </tbody></table>";
            return $codigo;
        }
    }

    function obtener_proyecto_rendcc($tipo, $id_doc) {
        if ($tipo == "Reembolso") {
            $sql = "select * 
                    from caja_chica cc left join proyecto p on cc.id_proyecto = p.id_proy
                    where cc.idcaja_chica=$id_doc";
            $consulta = $this->db->query($sql);
            if ($consulta->row()->id_proyecto == 0) {
                $this->load->model("usuario_model");
                $consulta = $this->usuario_model->obtProyectoUserResult($consulta->row()->id_usuario);
            }
        }
        if ($tipo == "Rendicion") {

            $sql = "select p.*
                    from (sol_frendir sf left join sol_frendir_detalle sfd on sf.id_sol_frendir=sfd.id_sol_fr) 
                    left join proyecto p on sfd.id_proy= p.id_proy
                    where sf.id_sol_frendir=$id_doc
                    group by p.id_proy";

            $consulta = $this->db->query($sql);
        }
        return $consulta;
    }

    function obtener_datos_rendcc($tipo, $id_doc) {
        if ($tipo == "Reembolso") {
            $sql = "select 'caja_chica' as tabla ,cc.* 
                    from caja_chica cc 
                    where cc.idcaja_chica=$id_doc";
            $consulta = $this->db->query($sql);
        }
        if ($tipo == "Rendicion") {

            $sql = "select 'sol_frendir' as tabla,sf.*
                    from sol_frendir sf 
                    where sf.id_sol_frendir=$id_doc";


            $consulta = $this->db->query($sql);
        }
        return $consulta;
    }

    function seleccionar_tipo_gasto($dat) {
        $sql = "select *
                from tipo_gasto_rendicion t
                where t.tipo like '$dat'";

        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function obtener_datos_rendicion($id_rendicion) {
        $sql = "select *
                from reg_form_rendicion reg 
                where reg.idreg_ren=$id_rendicion";

        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function obtener_detalle_datos_rendicion($id_rend, $tipo, $csfact) {
        /* $sql = "select *
          from reg_form_rendicion_detalle reg , tipo_gasto_rendicion tg
          where tg.idg_transporte=reg.id_tipo_gasto
          and reg.id_reg_rendicion=$id_rendicion"; */

        $sql = "    select reg.*, tg.*
                    from reg_form_rendicion_detalle reg , tipo_gasto_rendicion tg
                    where tg.idg_transporte=reg.id_tipo_gasto
                    and reg.id_reg_rendicion=$id_rend
                    and reg.id_tipo_gasto=tg.idg_transporte
                    and tg.tipo='$tipo'";
        if ($tipo != 'tel') {
            $sql .=" and reg.c_s_factura='$csfact'";
        }
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function listar_buscar_rendicionesxsitio($idsitio) {
        $sql = 'select rfr.*, p.nombre as nombreproy, concat(u.ap_paterno," ",u.ap_materno," ",u.nombre) as nomcompleto  FROM (reg_form_rendicion rfr left join proyecto p on rfr.id_proy=p.id_proy) left join usuarios u on rfr.id_tecnico_asignado=u.cod_user where id_sitio=' . $idsitio;

        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_buscar_rendicionesxproyecto($idproyecto,$usuario=0,$sitio=0,$rango=0) {
        $this->load->model('usuario_model');

        if ($idproyecto == 0) {
            $proyectos = $this->usuario_model->obtProyectoUserResult($this->session->userdata('id_admin'));
            $codigo = "";
            $sw = 0;
            foreach ($proyectos->result() as $p) {
                if ($sw == 1) {
                    $codigo.=" or ";
                }
                $sw = 1;
                $codigo.=" rfr.id_proy=" . $p->id_proy;
            }
        } else
            $codigo = "rfr.id_proy=" . $idproyecto;


        $sql = 'select rfr.*, p.nombre as nombreproy, concat(u.ap_paterno," ",u.ap_materno," ",u.nombre) as nomcompleto '
                . ' FROM (reg_form_rendicion rfr left join proyecto p on rfr.id_proy=p.id_proy) left join usuarios u on rfr.id_tecnico_asignado=u.cod_user'
                . ' where ' . $codigo . ' order by rfr.idreg_ren DESC limit 2000';

        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_buscar_rendicionesxproyecto_usuario($idproyecto, $usuario) {
        $this->load->model('usuario_model');

        if ($idproyecto == 0) {
            $proyectos = $this->usuario_model->obtProyectoUserResult($usuario);
            $codigo = "";
            $sw = 0;
            foreach ($proyectos->result() as $p) {
                if ($sw == 1) {
                    $codigo.=" or ";
                }
                $sw = 1;
                $codigo.=" rfr.id_proy=" . $p->id_proy;
            }
        } else
            $codigo = "rfr.id_proy=" . $idproyecto;


        $sql = 'select rfr.*, p.nombre as nombreproy, concat(u.ap_paterno," ",u.ap_materno," ",u.nombre) as nomcompleto '
                . ' FROM (reg_form_rendicion rfr left join proyecto p on rfr.id_proy=p.id_proy) left join usuarios u on rfr.id_tecnico_asignado=u.cod_user'
                . ' where (' . $codigo . ') and  rfr.id_tecnico_asignado=' . $usuario . ' order by rfr.idreg_ren DESC limit 2000';
        echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_detalle_datos_rendicion_general($id_rend) {
        $sql = "select *
                from reg_form_rendicion_detalle reg , tipo_gasto_rendicion tg
                where tg.idg_transporte=reg.id_tipo_gasto
                and reg.id_reg_rendicion=$id_rend";

        /* $sql = "    select reg.*, tg.*
          from reg_form_rendicion_detalle reg , tipo_gasto_rendicion tg
          where tg.idg_transporte=reg.id_tipo_gasto
          and reg.id_reg_rendicion=$id_rend
          and reg.id_tipo_gasto=tg.idg_transporte
          and tg.tipo='$tipo'
          and reg.c_s_factura='$csfact'"; */
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function guardar_nueva_rendicion_for() {
        $respuesta = "";
        $det_factura = explode(";", $this->input->post("id_det_factura"));
        $tipo = explode(";", $this->input->post("tipo"));
        $monto = explode(";", $this->input->post("monto"));
        $fac = explode(";", $this->input->post("fac"));
        $f_s = explode(";", $this->input->post("f_s"));
        $glosa = explode(";", $this->input->post("glo_f"));
        $pla_f = explode(";", $this->input->post("pla_f"));
        $fec_f = explode(";", $this->input->post("fec_f"));
        $cob_f = explode(";", $this->input->post("cob_f"));
        $adj_f = explode(";", $this->input->post("adj_f"));
        $estaciones = explode(";", $this->input->post("estaciones_selec"));
        $ids_delete = explode(",", $this->input->post("ids_delete"));



        if ($this->input->post('estado') == 'Modificado Responsable' || $this->input->post('estado') == 'VoBo Regional') {
            date_default_timezone_set("Etc/GMT+4");
            $datos = array(
                //'cod_serv_prod' => $this->input->post('cod'),

                'id_proy' => $this->input->post('id_proy'),
                // 'fh_registro' => $this->input->post('f_s'),
                'fh_registro' => date("Y-m-d H:i:s"),
                'observacion' => $this->input->post('desc'),
                'tipo_rend' => $this->input->post('tipo_rend'),
                'monto' => $this->input->post('total'),
                'estado' => $this->input->post('estado'),
                    // 'factura' => $this->input->post('fac'),
                    //'id_usuario' => $this->session->userdata('id_admin'),
                    //'id_tecnico_asignado' => $this->session->userdata('id_admin'),
                    //'id_responsable_proy' => $this->input->post('id_resp_destino'),
            );
        } else {


            date_default_timezone_set("Etc/GMT+4");
            $datos = array(
                //'cod_serv_prod' => $this->input->post('cod'),
                'id_sitio' => $this->input->post('id_sitio'),
                'id_proy' => $this->input->post('id_proy'),
                // 'fh_registro' => $this->input->post('f_s'),
                'fh_registro' => date("Y-m-d"),
                'observacion' => $this->input->post('desc'),
                'tipo_rend' => $this->input->post('tipo_rend'),
                'monto' => $this->input->post('total'),
                'estado' => $this->input->post('estado'),
                // 'factura' => $this->input->post('fac'),
                'id_usuario' => $this->session->userdata('id_admin'),
                'id_tecnico_asignado' => $this->input->post('id_usu'), /////////aqui
                'id_responsable_proy' => $this->input->post('id_resp_destino'),
                'id_documento' => $this->input->post('id_documento'),
                'documento' => $this->input->post('tabla'),
                'monto_documento' => $this->input->post('monto_documento'),
                'saldo' => 0,
                'ids_vobos' => $this->input->post('ids_vobos'));
        }

        // echo 'id_servpro '. $this->input->post('id_serv');
        if ($this->input->post('id_rend') == 0) {

            $this->db->insert('reg_form_rendicion', $datos);
            $sql = $this->db->last_query();
            $id_red = ($this->db->insert_id());

            $respuesta = "<input type='hidden' id='ayudata' value='$id_red'><div class='OK'>Rendicion registrada exitosamente!!!</div><input type='hidden' id='proceso' value='INSERT'>";
            //echo $id_red."<br>";   
            for ($i = 0; $i < count($tipo) - 1; $i++) {
                $datos = array(
                    'id_reg_rendicion' => $id_red,
                    'id_tipo_gasto' => $tipo[$i],
                    'monto' => $monto[$i],
                    'nro_fac' => $fac[$i],
                    'c_s_factura' => $f_s[$i],
                    'glosa' => $glosa[$i],
                    'fecha_factura' => $fec_f[$i],
                    'placa_vehiculo' => $pla_f[$i],
                    'adjuntos' => $adj_f[$i],
                    'cobrar_cliente' => $cob_f[$i],
                    'estacion' => $estaciones[$i]
                );
                $this->db->insert('reg_form_rendicion_detalle', $datos);
                $id_insert_det = ($this->db->insert_id());
                //echo 'result' + $result[$i];//
                //  $respuesta = "<input type='hidden' id='ayudata' value='$result[$i]'><input type='hidden' id='proceso' value='INSERT'>";
            }
        } else {
            $this->db->where('idreg_ren', $this->input->post('id_rend'));
            $udp = $this->db->update('reg_form_rendicion', $datos);
            if ($udp != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_rend') . "'><div class='OK'>Se ha editado exitosamente!!!</div><input type='hidden' id='proceso' value='UPDATE'>";

            for ($i = 0; $i < count($tipo) - 1; $i++) {
                $datos = array(
                    'id_reg_rendicion' => $this->input->post('id_rend'),
                    'id_tipo_gasto' => $tipo[$i],
                    'monto' => $monto[$i],
                    'nro_fac' => $fac[$i],
                    'c_s_factura' => $f_s[$i],
                    'glosa' => $glosa[$i],
                    'fecha_factura' => $fec_f[$i],
                    'placa_vehiculo' => $pla_f[$i],
                    'adjuntos' => $adj_f[$i],
                    'cobrar_cliente' => $cob_f[$i],
                    'estacion' => $estaciones[$i]
                );
                if ($det_factura[$i] != 0) {
                    $this->db->where('id_det', $det_factura[$i]);
                    $udp = $this->db->update('reg_form_rendicion_detalle', $datos);
                } else {
                    $this->db->insert('reg_form_rendicion_detalle', $datos);
                    $id_insert_det = ($this->db->insert_id());
                }
                // $this->db->insert('reg_form_rendicion_detalle', $datos);
                //$id_insert_det = ($this->db->insert_id());
                //echo 'result' + $result[$i];
                // $respuesta.= "<input type='hidden' id='ayudata' value='$result[$i]'><input type='hidden' id='proceso' value='INSERT'>";
            }
            if (count($ids_delete) > 1) {
                for ($d = 1; $d < count($ids_delete); $d++) {

                    $sql = "DELETE from reg_form_rendicion_detalle where id_det=" . $ids_delete[$d];
                    $consulta = $this->db->query($sql);
                }
            }
        }
        return($respuesta);
    }

    function VoBo_rendicion_for() {
        $respuesta = "";
        $tipo = explode(";", $this->input->post("tipo"));
        $monto = explode(";", $this->input->post("monto"));
        $fac = explode(";", $this->input->post("fac"));
        $f_s = explode(";", $this->input->post("f_s"));
        $glosa = explode(";", $this->input->post("glo_f"));
        $pla_f = explode(";", $this->input->post("pla_f"));
        $fec_f = explode(";", $this->input->post("fec_f"));
        $cob_f = explode(";", $this->input->post("cob_f"));
        $adj_f = explode(";", $this->input->post("adj_f"));
        $estaciones = explode(";", $this->input->post("estaciones_selec"));



        date_default_timezone_set("Etc/GMT+4");
        $datos = array(
            //'cod_serv_prod' => $this->input->post('cod'),
            'id_proy' => $this->input->post('id_proy'),
            // 'fh_registro' => $this->input->post('f_s'),
            'fh_registro' => date("Y-m-d H:i:s"),
            'observacion' => $this->input->post('desc'),
            'tipo_rend' => $this->input->post('tipo_rend'),
            'monto' => $this->input->post('total'),
            'estado' => $this->input->post('estado'),
            // 'factura' => $this->input->post('fac'),
            //   'id_usuario' => $this->session->userdata('id_admin'),
            // 'id_tecnico_asignado' => $this->session->userdata('id_admin'),
            'id_responsable_proy' => $this->input->post('id_resp_destino'),
            'ids_vobos' => $this->input->post('ids_vobos'));


        // echo 'id_servpro '. $this->input->post('id_serv');
        if ($this->input->post('id_rend') == 0) {
            $this->db->insert('reg_form_rendicion', $datos);
            $id_red = ($this->db->insert_id());
            $respuesta = "<input type='hidden' id='ayudata' value='$id_red'><div class='OK'>Rendicion registrada exitosamente!!!</div><input type='hidden' id='proceso' value='INSERT'>";

            for ($i = 0; $i < count($tipo) - 1; $i++) {
                $datos = array(
                    'id_reg_rendicion' => $id_red,
                    'id_tipo_gasto' => $tipo[$i],
                    'monto' => $monto[$i],
                    'nro_fac' => $fac[$i],
                    'c_s_factura' => $f_s[$i],
                    'glosa' => $glosa[$i],
                    'fecha_factura' => $fec_f[$i],
                    'placa_vehiculo' => $pla_f[$i],
                    'adjuntos' => $adj_f[$i],
                    'cobrar_cliente' => $cob_f[$i],
                    'estacion' => $estaciones[$i]
                );
                $this->db->insert('reg_form_rendicion_detalle', $datos);
                $id_insert_det = ($this->db->insert_id());
                //echo 'result' + $result[$i];
                //  $respuesta = "<input type='hidden' id='ayudata' value='$result[$i]'><input type='hidden' id='proceso' value='INSERT'>";
            }
        } else {
            $this->db->where('idreg_ren', $this->input->post('id_rend'));
            $udp = $this->db->update('reg_form_rendicion', $datos);
            if ($udp != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_rend') . "'><div class='OK'>Se ha editado exitosamente!!!</div><input type='hidden' id='proceso' value='UPDATE'>";

            $sql = "DELETE from reg_form_rendicion_detalle where id_reg_rendicion=" . $this->input->post('id_rend');
            $consulta = $this->db->query($sql);

            for ($i = 0; $i < count($tipo) - 1; $i++) {
                $datos = array(
                    'id_reg_rendicion' => $this->input->post('id_rend'),
                    'id_tipo_gasto' => $tipo[$i],
                    'monto' => $monto[$i],
                    'nro_fac' => $fac[$i],
                    'c_s_factura' => $f_s[$i],
                    'glosa' => $glosa[$i],
                    'fecha_factura' => $fec_f[$i],
                    'placa_vehiculo' => $pla_f[$i],
                    'adjuntos' => $adj_f[$i],
                    'cobrar_cliente' => $cob_f[$i],
                    'estacion' => $estaciones[$i]
                );
                $this->db->insert('reg_form_rendicion_detalle', $datos);
                $id_insert_det = ($this->db->insert_id());
                //echo 'result' + $result[$i];
                //  $respuesta = "<input type='hidden' id='ayudata' value='$result[$i]'><input type='hidden' id='proceso' value='INSERT'>";
            }
        }
        return($respuesta);
    }

    function obtener_detalle_datos_rendicion_agrupado($id_rend, $tipo, $csfact) {
        /* $sql = "select *
          from reg_form_rendicion_detalle reg , tipo_gasto_rendicion tg
          where tg.idg_transporte=reg.id_tipo_gasto
          and reg.id_reg_rendicion=$id_rendicion"; */

        $sql = "    select st.nombre as sitio,reg.*, tg.*,(reg.monto)/(1-(tg.RC_IVA+tg.IT+tg.IUE))as liq_pagable
                    from reg_form_rendicion_detalle reg , tipo_gasto_rendicion tg, sitiotrabajo st
                    where tg.idg_transporte=reg.id_tipo_gasto and   
                    st.idSitioTrabajo=reg.estacion
                    and reg.id_reg_rendicion=$id_rend
                    and reg.id_tipo_gasto=tg.idg_transporte
                    and reg.id_tipo_gasto='$tipo'
                    and reg.c_s_factura='$csfact'";
        $sql.=" order by reg.id_tipo_gasto, reg.placa_vehiculo";
        //echo ($sql."<br>");
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function obtener_montorend_sitio($id_sitio) {
        $sql = "SELECT sum(monto)as montorend FROM reg_form_rendicion_detalle where estacion=$id_sitio group by estacion;";
        $consulta = $this->db->query($sql);
        $resultado = 0;
        if ($consulta->num_rows > 0)
            $resultado = $consulta->row()->montorend;

        return($resultado);
    }

    function obtener_montorend_sitio_mes_proyecto($id_sitio, $mes, $proyecto) {

        $codigo_proy = "";
        $codigo_sitio = "";
        $fa = strtotime($mes);


        if ($proyecto == 0) { //codigo para aumentar los proyecto;
            $proyectos = $this->usuario_model->obtProyectoUserResult($this->session->userdata('id_admin'));

            $sw = 0;
            foreach ($proyectos->result() as $p) {
                if ($sw == 1) {
                    $codigo_proy.=" or ";
                }
                $sw = 1;
                $codigo_proy.="rfr.id_proy=" . $p->id_proy;
            }
        } else
            $codigo_proy = "rfr.id_proy=" . $proyecto;
        if ($id_sitio != 0) {
            //codigo para aumentar el sitio
            $codigo_sitio = "and  rfrd.estacion=" . $id_sitio;
        }


        $sql = "select count(*),ifnull(sum(rfrd.monto),0) as total 
                from reg_form_rendicion_detalle rfrd left join reg_form_rendicion rfr on rfr.idreg_ren=rfrd.id_reg_rendicion
              where 
                 (" . $codigo_proy . ")
                 " . $codigo_sitio . "   
                and 
                month(rfr.fh_registro) =" . date("m", $fa) . " and year(rfr.fh_registro)=" . date("Y", $fa);


        $consulta = $this->db->query($sql);

        $resultado = number_format($consulta->row()->total, 2, ".", "");

        return($resultado);
    }

    /// adicionando ultimo para la busqueda de solicitudes de rendicion
    function listar_buscar_rendicion_cantidad($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        // $id_user_session = $this->session->userdata('id_admin'); 

        $sql = "select reg.idreg_ren,reg.observacion,reg.fh_registro,p.nombre as nombre_proyecto,p.descripcion, u.nombre,u.ap_paterno,u.ap_materno,u.ci,reg.tipo_rend,
            reg.monto,reg.estado
              from reg_form_rendicion reg, proyecto p,usuarios u
              where concat(reg.idreg_ren,reg.observacion,p.nombre,u.ci,u.nombre,tipo_rend) lIKE '%$busqueda%'
              and p.id_proy=reg.id_proy 
              and reg.id_tecnico_asignado=u.cod_user
              and id_responsable_proy like '%|-1|%'
              order by reg.idreg_ren DESC";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function listar_buscar_rendicion($busqueda, $ini, $cant) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select reg.idreg_ren,reg.observacion,reg.fh_registro,p.nombre as nombre_proyecto, reg.tipo_rend,
              p.descripcion, u.nombre,u.ap_paterno,u.ap_materno,u.ci,reg.monto,reg.estado
              from reg_form_rendicion reg, proyecto p,usuarios u
              where concat(reg.idreg_ren,reg.observacion,p.nombre,u.ci,u.nombre,tipo_rend) lIKE '%$busqueda%'
              and p.id_proy=reg.id_proy 
              and reg.id_tecnico_asignado=u.cod_user
              and id_responsable_proy like '%|-1|%'
              order by reg.idreg_ren DESC limit $ini,$cant";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_buscar_rendicion_cantidad_rt($busqueda, $proy) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $id_user_session = $this->session->userdata('id_admin');
        $proyect = "";
        if ($proy != 0)
            $proyect = ' and p.id_proy=' . $proy;

        $sql = "select reg.idreg_ren,reg.observacion,reg.fh_registro,p.nombre as nombre_proyecto,reg.tipo_rend,
            p.descripcion, u.nombre,u.ap_paterno,u.ap_materno,u.ci  ,reg.monto,reg.ids_vobos
              from reg_form_rendicion reg, proyecto p,usuarios u
              where concat(reg.idreg_ren,reg.observacion,p.nombre,u.ci,u.nombre,tipo_rend) lIKE '%$busqueda%'
              and p.id_proy=reg.id_proy 
             and id_responsable_proy like '%|" . $id_user_session . "|%'
              and (reg.estado!='Guardado')
              $proyect 
              and reg.id_tecnico_asignado=u.cod_user
              order by reg.idreg_ren DESC";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function listar_buscar_rendicion_rt($busqueda, $ini, $cant, $proy) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $id_user_session = $this->session->userdata('id_admin');
        $proyect = "";
        if ($proy != 0)
            $proyect = ' and p.id_proy=' . $proy;

        $sql = "select reg.idreg_ren,reg.observacion,reg.fh_registro,p.nombre as nombre_proyecto,reg.tipo_rend,
              p.descripcion, u.nombre,u.ap_paterno,u.ap_materno,u.ci,reg.estado,reg.monto,reg.ids_vobos
              from reg_form_rendicion reg, proyecto p,usuarios u
              where concat(reg.idreg_ren,reg.observacion,p.nombre,u.ci,u.nombre) lIKE '%$busqueda%'
              and p.id_proy=reg.id_proy 
              and id_responsable_proy like '%|" . $id_user_session . "|%'
              and (reg.estado!='Guardado') 
              $proyect 
              and reg.id_tecnico_asignado=u.cod_user
              order by reg.idreg_ren DESC limit $ini,$cant";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    //funciones para las rendiciones de jefe de proyecto

    function listar_buscar_rendicion_cantidad_jp($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $id_user_session = $this->session->userdata('id_admin');

        $sql = "select reg.idreg_ren,reg.observacion,reg.fh_registro,p.nombre as nombre_proyecto,
              p.descripcion, u.nombre,u.ap_paterno,u.ap_materno,u.ci ,reg.estado 
              from reg_form_rendicion reg, proyecto p,usuarios u
              where concat(reg.idreg_ren,reg.observacion,p.nombre,u.ci,u.nombre) lIKE '%$busqueda%'
              and reg.id_proy=p.id_proy 
              and reg.id_usuario=u.cod_user
              and reg.id_usuario= $id_user_session 
              and reg.estado='Guardado'
              order by reg.idreg_ren DESC";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function listar_buscar_rendicion_jp($busqueda, $ini, $cant) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $id_user_session = $this->session->userdata('id_admin');


        $sql = "select reg.idreg_ren,reg.observacion,reg.fh_registro,p.nombre as nombre_proyecto,
              p.descripcion, u.nombre,u.ap_paterno,u.ap_materno,u.ci,reg.estado  
              from reg_form_rendicion reg, proyecto p,usuarios u
              where concat(reg.idreg_ren,reg.observacion,p.nombre,u.ci,u.nombre) lIKE '%$busqueda%'
              and reg.id_proy=p.id_proy 
              and reg.id_usuario=u.cod_user
              and reg.id_usuario=$id_user_session
              and reg.estado='Guardado'
              order by reg.idreg_ren DESC limit $ini,$cant";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    /// funciones para tecnico
    function listar_buscar_rendicion_cantidad_te($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $id_user_session = $this->session->userdata('id_admin');

        $sql = "select reg.idreg_ren,reg.id_responsable_proy,reg.observacion,reg.fh_registro,p.nombre as nombre_proyecto,reg.tipo_rend,reg.monto,
              p.descripcion, u.nombre,u.ap_paterno,u.ap_materno,u.ci,reg.estado
              from reg_form_rendicion reg, proyecto p,usuarios u
              where concat(reg.idreg_ren,reg.observacion,p.nombre,u.ci,u.nombre) lIKE '%$busqueda%'
              and reg.id_proy=p.id_proy 
              and reg.id_usuario=u.cod_user
              and reg.id_usuario= $id_user_session 
              
              order by reg.idreg_ren DESC";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function listar_buscar_rendicion_te($busqueda, $ini, $cant) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $id_user_session = $this->session->userdata('id_admin');


        $sql = "select reg.idreg_ren,reg.id_responsable_proy,reg.observacion,reg.fh_registro,p.nombre as nombre_proyecto,reg.tipo_rend,reg.monto,
              p.descripcion, u.nombre,u.ap_paterno,u.ap_materno,u.ci,reg.estado  
              from reg_form_rendicion reg, proyecto p,usuarios u
              where concat(reg.idreg_ren,reg.observacion,p.nombre,u.ci,u.nombre) lIKE '%$busqueda%'
              and reg.id_proy=p.id_proy 
              and reg.id_usuario=u.cod_user
              and reg.id_usuario=$id_user_session
              
              order by reg.idreg_ren DESC limit $ini,$cant";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    // adicionado 31/03/16
    function dato_rendicion_pro() {
        $sql = " select reg.idreg_ren,p.nombre as nom_proyecto,u.nombre,u.ap_paterno,u.ap_materno
                from reg_form_rendicion reg, usuarios u, proyecto p
                where reg.id_proy=p.id_proy
                and reg.id_usuario=u.cod_user  ";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function buscar_rendiciones_por_proyecto() {
        $id_user_session = $this->session->userdata('id_admin');
        //
        $sql = "select reg.idreg_ren,p.nombre as nom_proyecto,u.nombre,u.ap_paterno,u.ap_materno
                from reg_form_rendicion reg, usuarios u, proyecto p
                where  reg.id_proy=p.id_proy
                and reg.id_usuario=u.cod_user
                and reg.id_usuario=$id_user_session
               
               ";

        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function modificar_detalle_rendicion($id_rechazado) {
        $comen = $this->input->post('obs_rechazo');
        $sql = 'update reg_form_rendicion_detalle '
                . 'set id_reg_rendicion=(id_reg_rendicion*-1),obs_detalle_estado="' . $comen . '" '
                . 'where id_det=' . $id_rechazado;
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    ////nuevo 14/07/2016



    function listado_estaciones_proyecto($id_proyecto) {
        // $comen=  $this->input->post('obs_rechazo');
        $sql = 'select * from estaciones_proyecto ep where ep.id_proy=' . $id_proyecto;
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function anular_toda_rendicion() {
        $id = $this->input->post('id_rend');
        $comentario = $this->input->post('desc');
        $sql = 'update reg_form_rendicion set estado="Rechazado", observacion=concat("*RECHAZADO* \n ' . $comentario . ' \n",observacion) where idreg_ren=' . $id;
        $consulta = $this->db->query($sql);
        $sql = 'update reg_form_rendicion_detalle set obs_detalle_estado="' . $comentario . '", id_reg_rendicion=-' . $id . ' where id_reg_rendicion=' . $id;
        $consulta = $this->db->query($sql);
    }

}
