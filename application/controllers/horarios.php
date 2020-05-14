<?php

class horarios extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
       // $this->load->model('menus_model');
        $this->load->model('horarios_model');
          $this->load->model('menu_model');//Adicionado por magali
             if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }

    function index($padre)
    {
        $this->load->model('usuario_model');
         $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);

       // $matriz = $this->basicauth->datosSession();
        $data['user'] = $this->session->userdata('nombres').' '.$this->session->userdata('apellidos');

        //$data['main_menu'] = 'menus/EnlacesHijos';
        $data['titulo'] = 'Altas de Personal Nuevo';
        //$data['menu_completo'] = $this->menus_model->obtenerMenuCompleto($this->session->userdata('id_admin'));

        $data['tiposHorarios'] = $this->horarios_model->datos_horarios();

        $data['vista_enviada'] = "Horarios/horarios_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function edicion_horarios()
    {
        $ed_horario = $this->input->post('indice_horario');
        $data['datosHorario'] = $this->horarios_model->obtHorario_por_id($ed_horario);
        $data['edit'] = $ed_horario; // 1=editar horario
        $data['id_horario'] = $ed_horario;
        $this->load->view('Horarios/edicionNuevo_Horario_view', $data);
    }

    function guardar_edicion_horario()
    {
        //tipo 0=nuevo  otro= edicion
        echo($this->input->post('tipo'));
        if ($this->input->post('tipo') == 0)
        {
            $resp = $this->horarios_model->adicionar_nuevo_horario();
            if ($resp != 0)
            {
                $data['mensaje'] = "Se ha adicionado un nuevo Horario";
                $data['respuesta'] = "OK";
            } else
            {
                $data['mensaje'] = "Se ha detectado un error";
                $data['respuesta'] = "NO";
            }
            $this->load->view('menus/mensajesFormulario', $data);
        } else
        {
            $resp = $this->horarios_model->guardar_editar_horario();
            if ($resp != 0)
            {
                $data['mensaje'] = "Se ha modificado el horario";
                $data['respuesta'] = "OK";
            } else
            {
                $data['mensaje'] = "Se ha detectado un error";
                $data['respuesta'] = "NO";
            }

            $this->load->view('menus/mensajesFormulario', $data);
        }
    }

    function muestraHorarios()
    {
        $horarios = $this->horarios_model->datos_hora_min();
        $data['idSeleccionado'] = 0;
        $data['datosHorarios'] = $horarios->result();
        $this->load->view('Horarios/muestraHorarios_view', $data);
    }

    function muestraScrollHorarios()
    {
        $data['idSeleccionado'] = $this->input->post('indice_horario');

        $horarios = $this->horarios_model->datos_hora_min();
        $data['datosHorarios'] = $horarios->result();
        $this->load->view('Horarios/muestraHorarios_view', $data);
    }

}

?>
