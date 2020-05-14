<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of solicitud_material
 *
 * @author COMPUTER
 */
class asignaciones_personal extends CI_Controller {

    public $selected = "";

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('almacen_model');
        $this->load->model('solicitud_material_model');
         $this->load->model('asignaciones_personal_model');
        $this->load->model('usuario_model');
        $this->load->model('detalle_mih_model');
        $this->load->model('producto_servicio_model');
        $this->load->model('movimiento_almacen_model');
       $this->load->model('devolucion_material_model');

        if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }

//$padre,$hijo
    function index($padre) {
        $data['titulo'] = 'Asignacion Personal';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        $data['vista_enviada'] = 'asignaciones_personal/asignaciones_personal_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
    /*function obt_mov_alm_per() {
        
        $asig=$data['asignaciones'] = $this->asignaciones_personal_model->obt_asignaciones();
        $alm=array();
        foreach ($asig->result() as $r)
        {
             $alm[$r->id_mov_alm]= $this->almacen_model->obtenen_almacen($r->id_almacen);
        }
        $data['data_almacen']=$alm;
        $resultado=$data['asignaciones'] ;
        $var = array();
        foreach ($resultado->result()as $reg)
        {
            $var[$reg->id_mov_alm]= $this->devolucion_material_model->obtener_solicitud_devolucion($reg->id_mov_alm);
        }
        $data['sol_dev']=$var;
        $this->load->view('asignaciones_personal/list_asignaciones_per_view', $data);
    }*/
    // modificado en20/09/2016
    function obt_mov_alm_per() 
    {
       /* 
        $asig=$data['asignaciones'] = $this->asignaciones_personal_model->obt_asignaciones(); // la asignacion a la persona
        $alm=array();
        foreach ($asig->result() as $r)
        {
             $alm[$r->id_mov_alm]= $this->almacen_model->obtenen_almacen($r->id_almacen);
        }
        $data['data_almacen']=$alm;
        $resultado=$data['asignaciones'] ;
        $var = array();
        foreach ($resultado->result()as $reg)
        {
            $var[$reg->id_mov_alm]= $this->devolucion_material_model->obtener_solicitud_devolucion($reg->id_mov_alm);
        }
        $data['sol_dev']=$var;*/
         $var=array();
         $solicitud_dev=array();
         $data['asignaciones'] = $this->asignaciones_personal_model->obtener_datos_de_mis_asignaciones();
         $id_movimientos= $data['asignaciones'];
         foreach($id_movimientos->result()as $reg)
         {
             $var[$reg->id_mov_alm]= $this->movimiento_almacen_model->obtener_detalle_movimiento1($reg->id_mov_alm);
             $solicitud_dev[$reg->id_mov_alm]= $this->devolucion_material_model->obtener_solicitud_devolucion($reg->id_mov_alm);
         }
         $data['detalle_mat_asignados']=$var;
         $data['sol_dev']=$solicitud_dev;
         $this->load->view('asignaciones_personal/list_asignaciones_per_view', $data);
        
    }
   
}

?>
