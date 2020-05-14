<?php

class e_chequera_model extends CI_Model {

    function obtener_prov_solpago($solpago) {
        $sps = explode(",", $solpago);
        $codigo = "";
        $sw = 0;
        //  echo count($sps);
        if (count($sps) >= 1) {
            for ($i = 0; $i < count($sps); $i++) {
                if ($sps[$i] != "") {
                    if ($sw == 1)
                        $codigo.=" or ";
                    $codigo.=" opp.id=" . $sps[$i];
                    $sw = 1;
                }
            }
        }
        $conecB = $this->load->database("gco", TRUE);

        $sql = "select opp.idproveedor
from orden_pago_proveedor opp  where ($codigo) group by opp.idproveedor";
        $consulta = $conecB->query($sql);
        return $consulta;
    }

    function obtener_user_fr($solpago) {
        //solpago=conjunto de fondos a rendir
        $sps = explode(",", $solpago);
        $codigo = "";
        $sw = 0;
        //  echo count($sps);
        if (count($sps) >= 1) {
            for ($i = 0; $i < count($sps); $i++) {
                if ($sps[$i] != "") {
                    if ($sw == 1)
                        $codigo.=" or ";
                    $codigo.=" sfr.id_sol_frendir=" . $sps[$i];
                    $sw = 1;
                }
            }
        }


        //$conecB = $this->load->database("gco", TRUE);

        $sql = "select sfr.id_usuario
                from sol_frendir sfr where ($codigo) group by sfr.id_usuario";
        $consulta = $this->db->query($sql);
        return $consulta;
    }
    function obtener_user_rend($solpago) {
        //solpago=conjunto de fondos a rendir
        $sps = explode(",", $solpago);
        $codigo = "";
        $sw = 0;
        //  echo count($sps);
        if (count($sps) >= 1) {
            for ($i = 0; $i < count($sps); $i++) {
                if ($sps[$i] != "") {
                    if ($sw == 1)
                        $codigo.=" or ";
                    $codigo.=" rfr.idreg_ren=" . $sps[$i];
                    $sw = 1;
                }
            }
        }


        //$conecB = $this->load->database("gco", TRUE);

        $sql = "select rfr.id_tecnico_asignado
                from reg_form_rendicion rfr where ($codigo) group by rfr.id_tecnico_asignado";
        
        echo $sql."<br>";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function obtener_fr_user($fr, $user) {
        $sps = explode(",", $fr);
        $codigo = "";
        $sw = 0;
        //echo count($sps);
        if (count($sps) >= 1) {
            for ($i = 0; $i < count($sps); $i++) {
                if ($sps[$i] != "") {
                    if ($sw == 1)
                        $codigo.=" or ";
                    $codigo.=" sfr.id_sol_frendir=" . $sps[$i];
                    $sw = 1;
                }
            }
        }
        //$conecB = $this->load->database("gco", TRUE);

        $sql = 'select sfr.*,
                concat(u.nombre," ",u.ap_paterno," ",u.ap_materno) as nomuser ,
                cb.banco,
                cb.cuenta
                from (sol_frendir sfr left join usuarios u on sfr.id_usuario=u.cod_user)left join cuentabanco cb on sfr.id_cuenta_banco=cb.id_cuenta 
                where 
                u.cod_user= ' . $user . '
                and  (' . $codigo . ') order by u.cod_user';
        //   echo $sql;
        $consulta = $this->db->query($sql);
        return $consulta;
    }
     function obtener_rend_user($fr, $user) {
        $sps = explode(",", $fr);
        $codigo = "";
        $sw = 0;
        //echo count($sps);
        if (count($sps) >= 1) {
            for ($i = 0; $i < count($sps); $i++) {
                if ($sps[$i] != "") {
                    if ($sw == 1)
                        $codigo.=" or ";
                    $codigo.=" rfr.idreg_ren=" . $sps[$i];
                    $sw = 1;
                }
            }
        }
        //$conecB = $this->load->database("gco", TRUE);

        $sql = 'select rfr.*,
                concat(u.nombre," ",u.ap_paterno," ",u.ap_materno) as nomuser ,
                cb.banco,
                cb.cuenta
                from (reg_form_rendicion rfr left join usuarios u on rfr.id_tecnico_asignado=u.cod_user)left join cuentabanco cb on u.cod_user=cb.id_usuario 
                where 
                u.cod_user= ' . $user . '
                and  (' . $codigo . ') order by u.cod_user';
        //
        //   
        echo $sql;
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function obtener_solpago_prov($solpago, $proveedor) {
        $sps = explode(",", $solpago);
        $codigo = "";
        $sw = 0;
        //echo count($sps);
        if (count($sps) >= 1) {
            for ($i = 0; $i < count($sps); $i++) {
                if ($sps[$i] != "") {
                    if ($sw == 1)
                        $codigo.=" or ";
                    $codigo.=" opp.id=" . $sps[$i];
                    $sw = 1;
                }
            }
        }
        $conecB = $this->load->database("gco", TRUE);

        $sql = "select opp.*,p.nombre as nomprov , p.tipo_pago_prov,p.nombre_banco,p.cuenta_bancaria,p.titular_cta_bancaria,p.nombre_para_cheque,p.nombre
from orden_pago_proveedor opp left join proveedor p on opp.idproveedor=p.id where idproveedor=$proveedor and  ($codigo) order by opp.idproveedor";
        //   echo $sql;
        $consulta = $conecB->query($sql);
        return $consulta;
    }

    function obtener_solpago_para_cheque($solpago) {
        $sps = explode(",", $solpago);
        $codigo = "";
        $sw = 0;
        echo count($sps);
        if (count($sps) >= 1) {
            for ($i = 0; $i < count($sps); $i++) {
                if ($sps[$i] != "") {
                    if ($sw == 1)
                        $codigo.=" or ";
                    $codigo.=" opp.id=" . $sps[$i];
                    $sw = 1;
                }
            }
        }
        $conecB = $this->load->database("gco", TRUE);

        $sql = "select opp.*, p.tipo_pago_prov,p.nombre_banco,p.cuenta_bancaria,p.titular_cta_bancaria,p.nombre_para_cheque,p.nombre
from orden_pago_proveedor opp left join proveedor p on opp.idproveedor=p.id where ($codigo) order by opp.idproveedor";
        $consulta = $conecB->query($sql);
        return $consulta;
    }

    function busqueda_cuentas($tipo, $busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        if ($tipo == "personal") {
            $sql = "select concat(u.nombre,' ',u.ap_paterno,' ',u.ap_materno)as nombre, "
                    . "cb.banco as nombre_banco,cb.cuenta as cuenta_bancaria,"
                    . "concat(u.nombre,' ',u.ap_paterno,' ',u.ap_materno)as nombre_para_cheque "
                    . "from cuentabanco cb , usuarios u "
                    . "where cb.id_usuario=u.cod_user and concat(u.nombre,u.ap_paterno,u.ap_materno,u.ci) like '%$busqueda%'";
            $consulta = $this->db->query($sql);
            return $consulta;
        }
        if ($tipo == "proveedor") {
            /*             * ***************************************************
             * *             I M P O R T A N T E !!!!!!          **
             * *  para acceder a la otra base de datos de GCO v3 **
             * *  $conecB=$this->load->database("gco",TRUE);     **
             * *************************************************** */
            $conecB = $this->load->database("gco", TRUE);

            $sql = "select p.nombre as nombre, p.nombre_banco, p.cuenta_bancaria,p.tipo_pago_prov,p.nombre_para_cheque from proveedor p
            where concat(p.nombre,' ',p.nombre) LIKE '%$busqueda%'
       order by p.nombre";
            $consulta = $conecB->query($sql);
            return $consulta;
        }
        if ($tipo == "libre") {

            $sql = "select * from usuarios where cod_user=-999;";
            $consulta = $this->db->query($sql);
            return $consulta;
        }
    }

    function registrar_cheque() {
        $respuesta = "";
        date_default_timezone_set("Etc/GMT+4");
        $datos = array(
//            'nro_cheque' => $this->input->post(''),
            'dirigido' => strtoupper($this->input->post('dirigido_a')),
            'monto' => $this->input->post('monto'),
            'fecha_cheque' => $this->input->post('fecha_cheque'),
            'fecha_registro' => date('Y-m-d H:i:s'),
            'id_registrer' => $this->session->userdata('id_admin'),
            'comentario' => $this->input->post('comentario'),
            'tipo_cheque' => $this->input->post('tipo'),
            'detalle_dirigido_a' => $this->input->post('detalle_dirigido')
        );
        $this->db->insert('cheques', $datos);
        $id_cheque = ($this->db->insert_id());
        $respuesta = "<input type='hidden' id='ayudata' value='$id_cheque'><input type='hidden' id='proceso' value='INSERT'>"
                . "<div class='OK espaciado'>El Cliente se ha registrado exitosamente...!</div>";
        return($respuesta);
    }

    function registrar_cheques_varios() {
        $respuesta = "";
        $dirigido = explode("|", $this->input->post("dirigido_a"));
        $monto = explode("|", $this->input->post("monto"));
        $fechas = explode("|", $this->input->post("fecha_cheque"));
        $comentario = explode("|", $this->input->post("comentario"));
        $detalle_dirigido = explode("|", $this->input->post("detalle_dirigido"));
        $nro_cheque = explode("|", $this->input->post("nro_cheque"));
        $comprobante = explode("|", $this->input->post("comprobante"));
        $id_documento = explode("|", $this->input->post("ids_documentos"));
        date_default_timezone_set("Etc/GMT+4");
        $codigo_reg_grupal = $this->session->userdata('id_admin') . date('YmdHis');

        for ($i = 0; $i < count($dirigido); $i++) {
            $datos = array(
//            'nro_cheque' => $this->input->post(''),
                'dirigido' => $dirigido[$i],
                'monto' => $monto[$i],
                'fecha_cheque' => $fechas[$i],
                'fecha_registro' => date('Y-m-d H:i:s'),
                'id_registrer' => $this->session->userdata('id_admin'),
                'comentario' => $comentario[$i],
                'comprobante' => $comprobante[$i],
                //'tipo_cheque' => $this->input->post('tipo'),
                'detalle_dirigido_a' => $detalle_dirigido[$i],
                'nro_cheque' => $nro_cheque[$i],
                'documento' => $this->input->post("documento"),
                'id_documento' => $id_documento[$i],
                'tipo_cheque' => $this->input->post("tipo"),
                'cod_imp_grupal' => $codigo_reg_grupal
            );
            $this->db->insert('cheques', $datos);
            $id_cheque = ($this->db->insert_id());
            $respuesta = "<input type='hidden' id='ayudata' value='$id_cheque'><input type='hidden' id='proceso' value='INSERT'>"
                    . "<div class='OK espaciado'>El Cliente se ha registrado exitosamente...!</div>";
        }
        $respuesta = $codigo_reg_grupal;



        return($respuesta);
    }

    function obtener_registro_cheque($id_cheque) {
        $sql = "select c.*,u.nombre as name from cheques c,usuarios u where c.id_registrer=u.cod_user and c.id_cheque=" . $id_cheque;
        $consulta = $this->db->query($sql);

        return($consulta->row());
    }

    function obtener_registro_cheque_dia($fecha) {

        $sql = "select c.*,u.nombre from cheques c,usuarios u 
                where c.id_registrer=u.cod_user and date(c.fecha_registro)='" . $fecha . "'
                order by c.id_cheque desc";
        $consulta = $this->db->query($sql);

        return($consulta);
    }

    function obtener_cheque_grupal($cod_grupal) {
        $sql = "select c.*,u.nombre as name from cheques c,usuarios u where c.id_registrer=u.cod_user and c.cod_imp_grupal=" . $cod_grupal;
        $consulta = $this->db->query($sql);

        return($consulta);
    }

    function listar_buscar_cheques_cantidad($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select * from cheques c ,usuarios u 
            where c.id_registrer=u.cod_user 
            and concat(c.monto,c.dirigido,u.nombre,ap_paterno,u.ap_materno,c.comentario) lIKE '%$busqueda%'
             order by c.id_cheque DESC";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function listar_cheques() {

        $sql = "select * from cheques c ,usuarios u 
            where c.id_registrer=u.cod_user order by c.id_cheque DESC limit 3000";

        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_buscar_cheques($busqueda, $ini, $cant) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $busqueda = str_replace("_", "", $busqueda);
        $sql = "select * from cheques c ,usuarios u 
            where c.id_registrer=u.cod_user 
            and concat(c.monto,c.dirigido,u.nombre,ap_paterno,u.ap_materno,c.comentario) lIKE '%$busqueda%'
             order by c.id_cheque DESC limit $ini,$cant";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_cheques_hoy() {
        date_default_timezone_set("Etc/GMT+4");
        $hoy = date("Y/m/d");
        $sql = "select c.*, concat(u.nombre,' ',u.ap_paterno) as usuario from cheques c left join usuarios u on c.id_registrer=u.cod_user where c.fecha_cheque = '$hoy' and c.tipo_cheque<>'personal' order by c.tipo_cheque desc";
        echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_buscar_cuentas_empresa($busqueda, $ini, $cant) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $busqueda = str_replace("_", "%", $busqueda);
        $sql = "select u.cod_user,u.ci,u.nombre,u.ap_paterno,u.ap_materno,  c.* from usuarios u left join cuentabanco c on u.cod_user=c.id_usuario
where  concat(u.cod_user,u.ci,u.nombre,u.ap_paterno,u.ap_materno,ifnull(c.banco,''),ifnull(c.cuenta,''),ifnull(c.comentario,'')) like '%" . $busqueda . "%'
order by u.ap_paterno ASC limit $ini,$cant";
        $consulta = $this->db->query($sql);
        //echo $sql;
        return($consulta);
    }

    function listar_buscar_cuentas_empresa_cantidad($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $busqueda = str_replace("_", "%", $busqueda);
        $sql = "select u.cod_user,u.ci,u.nombre,u.ap_paterno,u.ap_materno,  c.* from usuarios u left join cuentabanco c on u.cod_user=c.id_usuario
where  concat(u.cod_user,u.ci,u.nombre,u.ap_paterno,u.ap_materno,ifnull(c.banco,''),ifnull(c.cuenta,''),ifnull(c.comentario,'')) like '%" . $busqueda . "%'
order by u.ap_paterno ASC";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function cuentas_banco_usuarios($id_user) {
        $sql = "select * from cuentabanco c where c.id_usuario = " . $id_user;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function registrar_cuenta_banco_empresa() {
        $respuesta = "";
        date_default_timezone_set("Etc/GMT+4");
        $datos = array(
            'banco' => $this->input->post('banco'),
            'cuenta' => $this->input->post('cuenta'),
            'id_usuario' => $this->input->post('usuario'),
            'comentario' => $this->input->post('comentario'),
            'id_registrador' => $this->session->userdata('id_admin'),
            'fecha_registrer' => date('Y-m-d H:i:s'),
            'estado' => $this->input->post('estado')
        );
        if ($this->input->post('id_cuenta') == 0) {
            $this->db->insert('cuentabanco', $datos);
            $id_nuevo = ($this->db->insert_id());
            $respuesta = "La CUENTA DE BANCO se ha registrado exitosamente...! Nro de id $id_nuevo";
        } else {
            $this->db->where('id_cuenta', $this->input->post('id_cuenta'));
            $upd = $this->db->update('cuentabanco', $datos);
            if ($upd != 0)
                $respuesta = "El CUENTA DE BANCO se ha Editado exitosamente...!";
        }
        return($respuesta);
    }

    function eliminar_cuenta_banco_empresa($id_cuenta) {
        $sql = "delete from cuentabanco where id_cuenta=$id_cuenta";
        $consulta = $this->db->query($sql);
    }

}
