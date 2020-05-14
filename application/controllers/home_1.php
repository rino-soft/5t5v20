<?php

class home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menus_model');
    }

    function index() {
        $data['main_menu'] = 'menus/EnlacesHijos';
       
        $data['titulo'] = 'Home';
        $matriz = $this->basicauth->datosSession();
        $data['user'] = $matriz['nombres'] . ' ' . $matriz['apellidos'];
        //$data['datos_menu'] = $this->menus_model->obtenerMenuPadre($matriz['id']);
         $data['menu_completo']=$this->menus_model->obtenerMenuCompleto($matriz['id']);
        $data['main_conten'] = "home";
        $this->load->view('includes/template', $data);
    }
                

}

?>
