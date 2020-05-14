<?php

class diasEspeciales_y_feriados extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('menus_model');
        $this->load->model('diasEspeciales_y_feriados_model');
    }

    function index()
    {
        $this->load->model('usuario_model');

        $matriz = $this->basicauth->datosSession();
        $data['user'] = $matriz['nombres'] . ' ' . $matriz['apellidos'];
        $data['main_menu'] = 'menus/EnlacesHijos';
        $data['titulo'] = 'Seleccion de dias especiales y feriados';
        $data['menu_completo'] = $this->menus_model->obtenerMenuCompleto($matriz['id']);
        $data['main_conten'] = "DiasEspeciales/diasEspeciales_y_feriados_view";
        $this->load->view('includes/template', $data);
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