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
class oventa_prefactura_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //put your code here
    function save_oventa_prefactura() {

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
            'id_user_created' => $this->session->userdata('id_admin'),
            'id_cliente' => $this->input->post('rs'),
            'fh_registro' => date("Y-m-d H:i:s"),
            'monto_total' => $this->input->post('totalpf'),
            'estado' => "Iniciado",
            'comentario' => $this->input->post('coment_gral'),
        );
        if ($this->input->post('id_ov_pf') == 0) {
            $this->db->insert('oventa_prefactura', $datos);
            $id_insert = ($this->db->insert_id());
           //proceso para dal alta de detalle
            
            for($i=1;$i<count($ids);$i++)
            {
                $datos=array(
                    'id_ovpf'=>$id_insert,
                    'id_prod_serv'=>$ids[$i],
                    'cod_ps'=>$cods[$i],
                    'titulo_ps'=>$tits[$i],
                    'desc_ps'=>$descs[$i],
                    'comentario'=>$coments[$i],
                    'precio_u_ps'=>$pus[$i],
                    'cantidad_ps'=>$cants[$i],
                    'importe_bs'=>$subs[$i],
                    'item'=>$i
                );
                $result[$i]=$this->db->insert('ov_pf_detalle', $datos);
                        
            }
            return($result);
            
        } else {
            $this->db->where('id_cliente', $this->input->post('id_cli'));
            $upd = $this->db->update('cliente', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='$upd'><input type='hidden' id='proceso' value='UPDATE'>";
        }
        return($respuesta);
    }
    
    function listar_buscar_ov_pf_cantidad($busqueda)
    {
         $busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select * from oventa_prefactura OVPF ,cliente C ,usuarios U 
            where OVPF.id_cliente=C.id_cliente 
            and U.cod_user=OVPF.id_user_created
            and concat(OVPF.id_ovpf,OVPF.monto_total,OVPF.comentario,C.id_cliente,C.razon_social,C.nit) lIKE '%$busqueda%'
             order by OVPF.id_ovpf DESC";
         $consulta = $this->db->query($sql);
        return($consulta->num_rows());
        
    }
    
    function listar_buscar_ov_pf($busqueda,$ini,$cant)
    {
         $busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select * from oventa_prefactura OVPF ,cliente C,usuarios U 
            where OVPF.id_cliente=C.id_cliente 
            and U.cod_user=OVPF.id_user_created
            and concat(OVPF.id_ovpf,OVPF.monto_total,OVPF.comentario,C.id_cliente,C.razon_social,C.nit) lIKE '%$busqueda%'
             order by OVPF.id_ovpf DESC limit $ini,$cant";
         $consulta = $this->db->query($sql);
        return($consulta);
    }
    function obtener_detalle_ovpf($id_ovpf)
    {
        $sql="select * from ov_pf_detalle where id_ovpf=$id_ovpf";
        $consulta = $this->db->query($sql);
        return($consulta);
    }
    ////´para las rendiciones
    function obtener_datos_oventa_prefactura(){
        
    }

}

?>
