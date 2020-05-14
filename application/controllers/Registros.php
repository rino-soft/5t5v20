<?php

class registros extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('registros_model');
         $this->load->model('menu_model');//Adicionado por magali
             if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }
      function index($padre) {
        $data['titulo'] = 'Registos';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function FormularioregistroValesGasolina($padre,$hijo) {
 //tados template*************************************************************
        //$data['main_menu'] = 'menus/EnlacesHijos';                                                             //**
        $data['titulo'] = 'Registro de Vales de Gasolina';                                                         //**
        //$matriz = $this->basicauth->datosSession();                                                            //**
        $data['user'] = $this->session->userdata('nombres').' '.$this->session->userdata('apellidos'); 
        //**
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
       // $data['menu_completo']=$this->menus_model->obtenerMenuCompleto($this->session->userdata('id_admin'));//**
        //***********************************************************************
        $data['vale100'] = $this->registros_model->obtener_vales_monto_libre(100, 0, 0)->result();
        $data['vale50'] = $this->registros_model->obtener_vales_monto_libre(50, 0, 0)->result();
       
          //carga en template //***********************************
        $data['vista_enviada'] = "registros/registro_vale_gasolina_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
        // ****************************************************
    }

    function FormListaAsignacionesValeGasolina($padre,$hijo) {
       //tados template*************************************************************
       // $data['main_menu'] = 'menus/EnlacesHijos';                                                             //**
        $data['titulo'] = 'Asignaciones de  Vales de Gasolina';                                                   //**
        //$matriz = $this->basicauth->datosSession();                                                            //**
        $data['user'] = $this->session->userdata('nombres').' '.$this->session->userdata('apellidos');                                      //**
       // $data['menu_completo']=$this->menus_model->obtenerMenuCompleto($this->session->userdata('id_admin'));//**
        //***********************************************************************
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        
        $this->load->model('solicitudes_model');
        $data['cantidaddevales'] = $this->solicitudes_model->obtenerCantidadRegistrosasigvales();
        //$nroPag=ceil($cantidaddevales/100);
        $listaAsig = $this->solicitudes_model->listar_todos_registros(0, 100);
        $data['regAsigGas'] = $listaAsig;
        $data['listalavesregistros'] = $this->registros_model->obtenerVectorRegValesAsignados($listaAsig);
        //$data['vales']=;
        $data['pagina'] = 1;
        //carga en template //***********************************
        $data['vista_enviada'] = "registros/LiberarVales_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
        // ****************************************************
  
    }

    function registrar_vales_gasolina($padre,$hijo) {
        $this->registros_model->registrar_valesGasolina();
    }

    function FormularioAnulacionValesGasolina($padre,$hijo) {
//tados template*************************************************************
      //  $data['main_menu'] = 'menus/EnlacesHijos';                                                             //**
        $data['titulo'] = 'Anulacion de Vales de Gasolina'; 
        //**
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
      //  $matriz = $this->basicauth->datosSession();                                                            //**
        $data['user'] = $this->session->userdata('nombres').' '.$this->session->userdata('apellidos');                                     //**
     //   $data['menu_completo']=$this->menus_model->obtenerMenuCompleto($this->session->userdata('id_admin'));//**
        //***********************************************************************
        //carga en template //***********************************
        $data['vista_enviada'] = "registros/anulacion_vales_gasolina_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
        // ****************************************************
  
    }

    function ListaValesEstado() {
        $estado = $this->input->post('estado');
        $monto = $this->input->post('monto');
        $ini = $this->input->post('inicio');
        $cant = $this->input->post('cantidad');
        $data['valores'] = $this->registros_model->Listar_Vales_Estado($estado, $monto, $ini, $cant);
        $this->load->view('registros/listarVales_view', $data);
    }

    function anularValesdeGasolina() {
        
        $vector = $this->input->post('vectorEnviado');
        $monto = $this->input->post('montoEnviado');
        $this->registros_model->anularValesGasolinaVector($vector, $monto);
    }

}

?>