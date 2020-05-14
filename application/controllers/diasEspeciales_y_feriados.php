<?php

class diasEspeciales_y_feriados extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
       // $this->load->helper('url');
       // $this->load->model('menus_model');
        $this->load->model('diasEspeciales_y_feriados_model');
        $this->load->model('menu_model');
             if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
        
    }

    function index($padre,$hijo)
    {
        $this->load->model('usuario_model');
       //$data['user'] = ;
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        //$data['main_menu'] = 'menus/EnlacesHijos';
        $data['titulo'] = 'Seleccion de dias especiales y feriados';
       // $data['menu_completo'] = $this->menus_model->obtenerMenuCompleto($matriz['id']);
        $data['vista_enviada'] = "DiasEspeciales/diasEspeciales_y_feriados_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function guardarFechas()
    {
        $resultado = $this->diasEspeciales_y_feriados_model->establece_diasFeriados();
    }

    function buscar_feriados_bd()
    {
        $resultado = $this->diasEspeciales_y_feriados_model->busca_feriados_en_bd();
        $cadena = "";
        foreach ($resultado->result() as $fila)
            $cadena.="'" . $fila->fecha . "',";
        $sw = $this->input->get('sw');
        $resp['cadena_fechasBD'] = $cadena;
        header('Content-type: application/json');
        echo json_encode($resp);
    }

    function mostrar_feriados_actuales()
    {
        $resultado = $this->diasEspeciales_y_feriados_model->busca_feriados_en_bd();
        $data['fechas'] = $resultado->result();
        $this->load->view('diasEspeciales/diasFeriados_view', $data);
    }
    
}

?>