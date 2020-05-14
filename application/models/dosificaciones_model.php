<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dosificaciones_model
 *
 * @author POMA RIVERO
 */
class dosificaciones_model extends CI_Model {

    function __construct() {
        parent::__construct();
            }
            
            
            
    function guardar_datos_dosificaciones() 
    {
        $respuesta = "";
        $datos = array(
            'fh_registro' =>  date("Y-m-d H:i:s"),
            'id_user_registred' => $this->session->userdata('id_admin'),
            'nro_autorizacion' => $this->input->post('nro_autorizacion'),
            'NIT' => $this->input->post('NIT'),
            'actividad' => $this->input->post('actividad'),
            'llave_cod_control' => $this->input->post('llave_cod_control'),
            'fl_emision' => $this->input->post('fl_emision'),
            'fecha_inicial' => $this->input->post('fecha_inicial'),
            'fecha_final' => $this->input->post('fecha_final'),
            'nro_inicial' => $this->input->post('nro_inicial'),
            'nro_actual' => $this->input->post('nro_actual'),
            'estado' => $this->input->post('estado'),
            'leyenda_factura' => $this->input->post('leyenda'),
            'tipo_dosificacion' => $this->input->post('tipo_dosificacion'),
        );
        if ($this->input->post('id_dosificacion') == 0) {
            $this->db->insert('dosificacion_factura', $datos);
            $id_dosi = ($this->db->insert_id());
            $respuesta = "<input type='text' id='ayudata' value='$id_dosi'><input type='text' id='proceso' value='INSERT'><div class='OK'>Estado:Guardado</div>";
        } else {
            $this->db->where('id_dosificacion', $this->input->post('id_dosificacion'));
            $upd = $this->db->update('dosificacion_factura', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='".$this->input->post('id_dosificacion')."'><input type='hidden' id='proceso' value='UPDATE'><div class='OK'>Estado:Editado</div>";
        }
        return($respuesta);
     }
     
     function obtener_dosificaciones($id_dosificaciones) {
        $sql = "select * from dosificacion_factura d where d.id_dosificacion=$id_dosificaciones";
        $consulta = $this->db->query($sql);
        $row = 0;
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row;
    }
    
    function listar_dosificacion_buscar_cantidad($busqueda)
    {
        $busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select * from dosificacion_factura ps 
            WHERE concat(ps.id_dosificacion,nro_autorizacion,NIT,nro_actual) LIKE '%$busqueda%'
        order by ps.id_dosificacion asc";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }
    function listar_dosificacion_buscar($busqueda,$can,$ini)
    {
        $busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select * from dosificacion_factura ps 
            WHERE concat(ps.id_dosificacion,nro_autorizacion,NIT,nro_actual) LIKE '%$busqueda%' 
            order by ps.id_dosificacion asc limit $can,$ini";
       
        $consulta = $this->db->query($sql);
        return($consulta);
    }
    function lista_dosificacion_activa($tipo)
    {
        //$busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select * from dosificacion_factura df 
            WHERE df.estado='Activo' and df.tipo_dosificacion='$tipo' Order by df.actividad ";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    }
