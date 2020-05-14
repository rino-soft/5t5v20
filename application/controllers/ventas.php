<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ventas
 *
 * @author RubenPayrumani
 */
class ventas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->library('Basicauth');
       // echo "<script>alert('comprobamos si el usuario está logueado');</script>";
        if ($this->auth->is_logged() == FALSE) {
            //echo "esta logueado";
            //echo "<script>alert('NO esta logueado');</script>";

            redirect(base_url('login'));
        }
      //  echo "<script>alert('esta logueado');</script>";
    }
     function index($padre) {
//*** EN TODOS LOS CONTROLADORES*//
        $data['titulo'] = 'Ventas';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        if ($padre != 0) {
            $data['datos_item_padre'] = $padre;
            $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        }
        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
///*************************************//
    }
    
    

 
    
}

?>
