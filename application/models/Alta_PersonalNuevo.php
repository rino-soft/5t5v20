<?php

class Alta_PersonalNuevo extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('dependientes_model');
        $this->load->model('menus_model');
        $this->load->model('usuario_model');
    }

    function index()
    {
        $this->load->model('usuario_model');
        $this->load->model('destino_model');

        $matriz = $this->basicauth->datosSession();
        $data['user'] = $matriz['nombres'] . ' ' . $matriz['apellidos'];
        $data['main_menu'] = 'menus/EnlacesHijos';
        $data['titulo'] = 'Altas de Personal Nuevo';
        $data['menu_completo'] = $this->menus_model->obtenerMenuCompleto($matriz['id']);
        $data['main_conten'] = "usuario/Alta_PersonalNuevo_view";
        $this->load->view('includes/template', $data);
    }

    function registrar_personalNuevo()
    {
        $resp = $this->usuario_model->altaPersonal_aEmpresa();
        if ($resp != 0)
        {
            $data['mensaje'] = "Se ha dado de alta correctamente a un nuevo usuario";
            $data['respuesta'] = "OK";
        }
        else
        {
            $data['mensaje'] = "Se ha detectado un error";
            $data['respuesta'] = "NO";
        }
        $this->load->view('menus/mensajesFormulario', $data);
    }

}

?>
