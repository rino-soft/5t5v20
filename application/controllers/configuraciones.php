<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of configuraciones
 *
 * @author COMPUTER
 */
class configuraciones extends CI_Controller {

    function __construct() {
        parent::__construct();
       // $this->load->model('vehiculo_model');
        $this->load->model('menu_model');
             if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }
    
//$padre,$hijo
    function index($padre) {
        $data['titulo'] = 'configuraciones';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
    
 }

?>
