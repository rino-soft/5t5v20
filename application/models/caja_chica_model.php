
<?php
class caja_chica_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function obtener_cc_user($user)
    {
         $sql="Select cc.*,p.nombre from caja_chica cc left join proyecto p on cc.id_proyecto=p.id_proy where id_usuario=$user";
        $consulta = $this->db->query($sql);
        
        return $consulta;
        
    }
    function obtener_datos_cajc_chica($id_cc)
    {
        $sql="Select * from caja_chica where idcaja_chica=$id_cc";
        $consulta = $this->db->query($sql);
        return $consulta;
        
    }
    function listar_buscar_caja_chica($proyecto)
    {
         $this->load->model('usuario_model');

        if ($proyecto == 0) {
            $proyectos = $this->usuario_model->obtProyectoUserResult($this->session->userdata('id_admin'));
            $codigo = "";
            $sw = 0;
            foreach ($proyectos->result() as $p) {
                if ($sw == 1) {
                    $codigo.=" or ";
                }
                $sw = 1;
                $codigo.=" p.id_proy=" . $p->id_proy;
            }
        } else
            $codigo = "p.id_proy=" . $id_proy;
            $codigo .= " or cc.id_user_registred=" . $this->session->userdata('id_admin');
        $sql = '';

        $sql = 'select cc.*,p.nombre as proyecto,concat(u.nombre," ",u.ap_paterno," ",u.ap_materno) as username
                , concat(u2.nombre," ",u2.ap_paterno," ",u2.ap_materno) as usercreated
             from ((caja_chica cc left join proyecto p on cc.id_proyecto=p.id_proy) 
                left join usuarios u on cc.id_usuario=u.cod_user)
                left join usuarios u2 on cc.id_user_registred=u2.cod_user 

                where (' . $codigo . ' )
                order by cc.idcaja_chica DESC';
        //  echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }
    
    function actualizar_saldo($id_cc,$tipo,$monto)
    {
        $cc=$this->obtener_datos_cajc_chica($id_cc);
        $saldo_actual=$cc->row()->saldo;
        if($tipo=="credito")
            $nuevo_saldo=$saldo_actual+$monto;
        if($tipo=="debito")
            $nuevo_saldo=$saldo_actual-$monto;
                
        $sql="update caja_chica set saldo=$nuevo_saldo where idcaja_chica=$id_cc";
        $consulta = $this->db->query($sql);
        return $consulta;
    }
    
    function save_scc()
    {
         $respuesta = "";
       // $det_factura = explode(";", $this->input->post("id_det_factura"));
        // $tipo = explode(";", $this->input->post("tipo"));
        //$monto = explode(";", $this->input->post("monto"));
        // $fac = explode(";", $this->input->post("fac"));
        //$f_s = explode(";", $this->input->post("f_s"));
        //$glosa = explode("*|*", $this->input->post("glo_f"));
        //$pla_f = explode(";", $this->input->post("pla_f"));
        //$fec_f = explode(";", $this->input->post("fec_f"));
        //$cob_f = explode(";", $this->input->post("cob_f"));
        //$adj_f = explode(";", $this->input->post("adj_f"));
        //$proyectos = explode(";", $this->input->post("id_proy"));
        //$estaciones = explode(";", $this->input->post("estaciones_selec"));
        //$ids_delete = explode(",", $this->input->post("ids_delete"));




        date_default_timezone_set("Etc/GMT+4");
        $datos = array(
            'fh_registro' => date("Y-m-d H:m:s"),
            'comentario_global' => $this->input->post('desc'),
            'monto' => $this->input->post('monto'),
            'estado' => $this->input->post('estado'),
            'id_proyecto' => $this->input->post('id_proy'),
            'id_user_registred' => $this->session->userdata('id_admin'),
            'id_usuario' => $this->input->post('id_usu'),
            'id_cuenta_banco' => $this->input->post('id_cuenta'));
            //'titulo' => $this->input->post('titulo'));

        if ($this->input->post('id_cc') == 0) {
            $this->db->insert('caja_chica', $datos);
            //$sql = $this->db->last_query();
            $id_red = ($this->db->insert_id());
        } else {
            $this->db->where('idcaja_chica', $this->input->post('id_cc'));
            $udp = $this->db->update('caja_chica', $datos);
            $id_red = $this->input->post('id_cc');
        }


        
        $respuesta = "<input type='hidden' id='ayudata' value='$id_red'><input type='hidden' id='mensajeayudata' value='Rendicion $id_red Guardado exitosamente!!!'><input type='hidden' id='proceso' value='INSERT'>";

        return($respuesta);
        
    }
}
?>


