<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of grupo_equi_rep_model
 *
 * @author GHERY
 */
class grupo_equi_rep_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function obtener_grupo($id_grupo) {
        $sql = "select * from c_equi_rep_herra where id_grupo=$id_grupo";
        $consulta = $this->db->query($sql);
        $row = 0;
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row;
    }

    function guardar_grupo_nuevo() {
        $respuesta = "";
        $datos = array(
            'nombre' => $this->input->post('nom'),
            'cod_propio' => $this->input->post('cod'),
            'descripcion' => $this->input->post('descr'),
        );
        if ($this->input->post('id_grupo') == 0) {
            $this->db->insert('c_equi_rep_herra', $datos);
            $id_grupo_nuevo = ($this->db->insert_id());
            $respuesta = "<input type='text' id='ayudata' value='$id_grupo_nuevo'><input type='text' id='proceso' value='INSERT'>";
        } else {
            $this->db->where('id_grupo', $this->input->post('id_grup'));
            $upd = $this->db->update('c_equi_rep_herra', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='$upd'><input type='hidden' id='proceso' value='UPDATE'>";
        }
        return($respuesta);
    }

    // funciones para detalle eq_rep_herra

    function obtener_detalle($id_detalle) {
        $sql = "select * from detalle_eq_rep_herra where id_detalle=$id_detalle";
        $consulta = $this->db->query($sql);
        $row = 0;
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row;
    }

    function guardar_detalle_nuevo() {
        $respuesta = "";
        $datos = array(
            'cantidad' => $this->input->post('cant'),
            'unidad_medida' => $this->input->post('uni_med'),
            'comentario' => $this->input->post('coment'),
            'P_N' => $this->input->post('p_n'),
            'S_N' => $this->input->post('s_n'),
        );
        if ($this->input->post('id_detalle') == 0) {
            $this->db->insert('detalle_eq_rep_herra', $datos);
            $id_detalle_nuevo = ($this->db->insert_id());
            $respuesta = "<input type='text' id='ayudata' value='$id_detalle_nuevo'><input type='text' id='proceso' value='INSERT'>";
        } else {
            $this->db->where('id_detalle', $this->input->post('id_deta'));
            $upd = $this->db->update('detalle_eq_rep_herra', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='$upd'><input type='hidden' id='proceso' value='UPDATE'>";
        }
        return($respuesta);
    }

    function save_nuevo_grupo() {

        //modificar esta funcion para hacer el guardado crrespondiente
        $respuesta = "";
        $ids = explode("|", $this->input->post("ids"));

        // $cods = explode("|", $this->input->post("cods"));
        // $tits = explode("|", $this->input->post("tits"));
        // $descs = explode("|", $this->input->post("descs"));
        $coments = explode("|", $this->input->post("coments"));
        $umeds = explode("|", $this->input->post("umeds"));
        $cants = explode("|", $this->input->post("cants"));
        $pns = explode("|", $this->input->post("pns"));
        $sns = explode("|", $this->input->post("sns"));

        //datos para adicionar datos de inicio
        date_default_timezone_set("Etc/GMT+4");
        $datos = array(
            'cod_propio' => $this->session->userdata('cod_pro'),
            'cod_propio' => $this->input->post('cod_pro'),
            'nombre' => $this->input->post('nomb'),
            'descripcion_grupo' => $this->input->post('descrip'),
        );
        if ($this->input->post('id_ov_pf') == 0) {
            $this->db->insert('c_equi_rep_herra', $datos);
            $id_insert = ($this->db->insert_id());
            //proceso para dal alta de detalle

            for ($i = 1; $i < count($ids); $i++) {
                $datos = array(
                    'id_grupo' => $id_insert,
                    'id_serv_pro' => $ids[$i],
                    //'cod_ps'=>$cods[$i],
                    //'titulo_ps'=>$tits[$i],
                    //'desc_ps'=>$descs[$i],
                    'cantidad' => $cants[$i],
                    'unidad_medida' => $umeds[$i],
                    'comentario' => $coments[$i],
                    'P_N' => $pns[$i],
                    'S_N' => $sns[$i],
                );
                $result[$i] = $this->db->insert('detalle_eq_rep_herra', $datos);
            }
            return($result);
        }
        return($respuesta);
    }

    function listar_grupo_buscar($busqueda, $can, $ini) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select * from c_equi_rep_herra ps 
            WHERE concat(ps.id_grupo,ps.cod_propio,ps.nombre,ps.descripcion_grupo) LIKE '%$busqueda%' 
            order by ps.id_grupo asc limit $can,$ini";

        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_grupo_buscar_cantidad($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select * from c_equi_rep_herra ps 
            WHERE concat(ps.id_grupo,ps.cod_propio,ps.nombre,ps.descripcion_grupo) LIKE '%$busqueda%' 
            order by ps.id_grupo asc";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function obtener_detalle_grupo($id_grupo) {
        /* $sql="select * from c_equi_rep_herra cc
          where cc.id_grupo='$id_grupo'";
          $consulta = $this->db->query($sql);
          return($consulta); */


        $sql = "select * from c_equi_rep_herra eq,detalle_eq_rep_herra de, producto_servicio pro  
        where eq.id_grupo=de.id_grupo 
              and de.id_serv_pro=pro.id_serv_pro
              and eq.id_grupo=$id_grupo";

        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_grupo_editado($id_grupo) {
        // echo 'funciona2';
        $sql = "select * from nuevo_grupo where id_grupo_editado=$id_grupo";
       // echo $sql;
        $consulta = $this->db->query($sql);
        $row = 0;
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row;
    }

    function guardar_grupo_editado_m() {
        $respuesta = "";
        $datos = array(
            
            'codigo_grupo' => $this->input->post('codigo_grupo'),
            'Nombre_grupo' => $this->input->post('Nombre_grupo'),
            'Descripcion' => $this->input->post('Descripcion'),
            'cant_total_pieza' => $this->input->post('cant_total_pieza'),
            'SN' => $this->input->post('SN'),
        );
      if ($this->input->post('id_grup') == 0) {
            $this->db->insert('nuevo_grupo', $datos);
            $id_grupo_nuevo = ($this->db->insert_id());
            $respuesta = "<input type='hidden' id='ayudata' value='$id_grupo_nuevo'><input type='hidden' id='proceso' value='INSERT'> exito en Adicion";
        } else {
            $this->db->where('id_grupo_editado', $this->input->post('id_grup'));
            $upd = $this->db->update('nuevo_grupo', $datos);
            if ($upd != 0)
                $respuesta= "<input type='hidden' id='ayudata' value='".$this->input->post('id_grup')."'><input type='hidden' id='proceso' value='UPDATE'>
                    exito en edicion";
        }
        return($respuesta);
    }
     function listar_grupo_buscar_detalle_cantidad($busqueda)
    {
        $busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select * from nuevo_grupo ps 
            WHERE concat(ps.id_grupo_editado,ps.Nombre_grupo,ps.Descripcion,ps.codigo_grupo,ps.cant_total_pieza,ps.SN) LIKE '%$busqueda%' 
            order by ps.id_grupo_editado asc";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }
    function listar_grupo_buscar_detalle_serv($busqueda,$can,$ini)
    {
        $busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select * from nuevo_grupo ps 
            WHERE concat(ps.id_grupo_editado,ps.Nombre_grupo,ps.Descripcion,ps.codigo_grupo,ps.cant_total_pieza,ps.SN) LIKE '%$busqueda%' 
            order by ps.id_grupo_editado asc limit $can,$ini";
       
        $consulta = $this->db->query($sql);
        return($consulta);
    }
    
    

}

?>
