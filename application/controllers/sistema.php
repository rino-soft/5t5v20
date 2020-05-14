<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sistema
 *
 * @author Ruben
 */
class sistema extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        
        if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }

    function index($padre) {
//*** EN TODOS LOS CONTROLADORES*//
        $data['titulo'] = 'Configuracion de Sistema';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        if ($padre != 0) {
            $data['datos_item_padre'] = $padre;
            $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        }
        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
///*************************************//
    }

    function menu_configuracion($padre, $hijo) {
        $data['titulo'] = 'Configuracion de Sistema';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        $modulo = $this->menu_model->lista_menus_padre();
        $data['datos_menu_pantalla'] = $modulo;
        $menu_dependientes = array();

        foreach ($modulo as $mod) {
            // echo "padre=>".$mod->id;
            $menu_dependientes[$mod->id] = $this->menu_model->lista_menus_hijos($mod->id);
        }
        $data['menu_modulos'] = $menu_dependientes;
        echo "hola@";
        $data['vista_enviada'] = 'sistema_views/menu_configuracion_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function formulario_nuevo_menu() {
        $datos['modulo'] = $this->input->post('modulo');
        $this->load->view('sistema_views/nuevo_menu_view', $datos);
    }

}

?>
