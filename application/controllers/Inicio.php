<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Inicio
 *
 * @author Ruben
 */
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inicio extends CI_Controller {

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

    public function user_logout() {
        $this->auth->logout();
    }

    function index() {
        //*** EN TODOS LOS CONTROLADORES*//
        //$matriz = $this->basicauth->datosSession();
       // $data['d_sesion'] = $this->session->userdata('id'); //." ".$matriz['apellidos'];
        $data['titulo'] = 'Inicio';
        //$data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), 0);
        
        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
        ///*************************************//
        
        
    }

}

?>
