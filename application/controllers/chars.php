<?php

class chars extends CI_Controller {

    public $selected = "";

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }

//$padre,$hijo
    function reporte_rend_sitios() {
        $data['mesesg']=$this->input->post('meses');
        $data['posdata']=$this->input->post('poS');
        $data['rendiciones']=$this->input->post('rend');
        $data['utilidad']=$this->input->post('util');
        
        $this->load->view('char/rep_colum_sitio',$data);
    }
    function colum_stack() {
              
        $this->load->view('char/columnas_agrupadas_stack');
    }

}

?>
