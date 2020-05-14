<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of autenticacion
 *
 * @author Ruben
 */
class autenticacion extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->library('Basicauth');
        $this->load->model('menu_model');
    }

    function index()
    {
        $this->login();
    }
    function login() {
        $data = array();
        $data['user'] = '';
        // $data['datos_menu'] =$this->menus_model->obtenerMenuPadre(0);
        $data['menu_completo'] = "";
        $this->form_validation->set_rules('usuario', 'usuario', 'required|trim');
        $this->form_validation->set_rules('password', 'contraseña', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            //$data['datos_menu'] = $this->menus_model->obtenerMenuPadre(0);
            $data['main_menu'] = 'bienvenida';
            //$data['main_conten'] = 'autenticacion/login_view';
            $data['error'] = '';
            $data['titulo'] = 'Autenticación de Usuario';
            $data['menu_completo'] = "";
            $this->load->view('autenticacion/login_view', $data);
           // redirect('autenticacion/login');
        } else {
            $respuesta = $this->basicauth->login($this->input->post('usuario'), $this->input->post('password'));
            if (!isset($respuesta['error'])) {
                $padre=0;
                $data['vista_enviada'] = 'bienvenida';
                $data['titulo'] = 'Inicio';
                $matriz = $this->basicauth->datosSession();
                $data['user'] = $matriz['nombres'] . ' ' . $matriz['apellidos'];
                $data['id_user'] = $matriz['id'];
                $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
                $data['datos_item_padre']=$padre;
                $data['datos_menu_detallado']=$this->menu_model->obtereMenuDetallado(0,  $padre );
                $data['main_menu'] = 'menus/menu_hijos';
                $this->load->view('Plantilla/Plantilla_vista', $data);
                redirect('Inicio/index/0');
            } else {
                $data['menu_completo'] = "";
                $data['error'] = $respuesta['error'];
                $data['main_menu'] = 1;
                //$data['main_conten'] = 'autenticacion/login_view';
                $data['titulo'] = 'Autenticación de Usuario';
                //$this->menus_model->obtenerMenuPadre(0);
                $this->load->view('autenticacion/login_view', $data);
                 //redirect('autenticacion/login');
            }
        }

        /*
          $data['main_conten'] = 'usuario/login';
          $data['titulo'] = 'Autenticación de Usuario';
          $this->load->view('includes/template', $data);
         */
    }

    function logout() {
        $this->basicauth->logout();
        redirect('usuario/login');
    }

}

?>
