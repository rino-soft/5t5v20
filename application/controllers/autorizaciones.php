<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of autorizaciones
 *
 * @author COMPUTER
 */
class autorizaciones extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('solicitudes_model');
       // $this->load->model('registros_model');
        
          $this->load->model('menu_model');//Adicionado por magali
             if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }
    
    //$padre,$hijo
    function index($padre) {
        $data['titulo'] = 'Autorizaciones';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
     function lista_solicitudes_uso_para_asignar($padre,$hijo) /// arreglado por magali
    {
          //tados template*************************************************************
        $this->load->model('proyecto_model');                                                                    //**
        $this->load->model('usuario_model');                                                                       //**
        $this->load->model('destino_model');                                                                       //**
        //$data['main_menu'] = 'menus/EnlacesHijos';                                                             //**
        $data['titulo'] = 'Solicitud de uso vehicular';                                                         //**
        //$matriz = $this->basicauth->datosSession();                                                            //**
        $data['user'] = $this->session->userdata('nombres').' '.$this->session->userdata('apellidos');                                      //**
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);

//$data['menu_completo']=$this->menu_model->obtenerMenuCompleto($this->session->userdata('id_admin'));//**
        //***********************************************************************
       
        $data['mostrarDatos'] = $this->solicitudes_model->solicitudes_uso_vehicular_lista($this->session->userdata('id_admin'));
        
         //carga en template //***********************************
        $data['vista_enviada'] = "solicitudes/lista_solicitudes_uso_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
        // ****************************************************
    }
}