<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of estudios_personal
 *
 * @author RubenPayrumani
 */
class centro_costos extends CI_Controller{
    //put your code here
    public function __construct() {
        
        parent::__construct();
         $this->load->model('menu_model');
       
        if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }
    
    function index($padre)
    {
        $data['titulo'] = 'Clientes';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
       
        
        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
    
    function costo_proyecto($padre,$hijo)
    {
        $this->load->model('usuario_model');
        $data['titulo'] = 'Clientes';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        $data['mis_proyectos']= $this->usuario_model->obtProyectoUserResult($this->session->userdata('id_admin'));
                
        
        $data['vista_enviada'] = 'centro_costos/centro_proyecto';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
    function grafica_presupuesto()
    {
        $data['id_div']=$this->input->post('div');
        $this->load->view('graficas_estadisticas/presupuestos/grafica_presupuesto',$data);
    }
    
    function grafica_historicos()
    {
        $data['id_div']=$this->input->post('div');
        $this->load->view('graficas_estadisticas/presupuestos/grafica_historico_gastos_cobros',$data);
    }
    
    function resumen_proyectos_botones($id_proyecto)
    {
        $this->load->model('usuario_model');
        $this->load->model('vehiculo_model');
        $data['proyecto_seleccionado']=$id_proyecto;
        $data['resumen_usuario']=$this->usuario_model->resumen_usuario_proyecto($this->session->userdata('id_admin'),$id_proyecto);
        $data['resumen_transportes']=$this->vehiculo_model->listar_vehiculos_proyecto($this->session->userdata('id_admin'),$id_proyecto);
        
        $this->load->view('centro_costos/vista_resumen_panel',$data);
       
    }
    function graficas_proyecto($id_proyecto)
    {
        $this->load->model('pago_proveedor_model');
        $this->load->model('usuario_model');
        
        $data['resumen_compras']=$this->pago_proveedor_model->resumen_pagos($this->session->userdata('id_admin'),$id_proyecto);
        $this->load->view('centro_costos/vista_resumen_dashboard',$data);
       
    }
    
    
}

?>
