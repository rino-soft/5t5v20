<?php

class menus extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menus_model');
    }
    function menu_hijos(){
        $matriz = $this->basicauth->datosSession();
        $data["enlaces"] = $this->menus_model->obtenerMenuHijo($matriz['id'],$this->input->post('padre'));
        //$data["datos"] contendrá un array del tipo Array("0" => Array("value" => value1, "name" => name1), "1" => Array("value" => value2, "name" => name2)...)
         $this->load->view('menus/EnlacesHijos',$data);
    }
   
    
    

}

?>
