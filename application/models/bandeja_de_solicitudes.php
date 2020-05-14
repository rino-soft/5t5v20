<?php

class bandeja_de_solicitudes extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('justificaciones_model');
        $this->load->model('menus_model');
        $this->load->model('usuario_model');
    }

    function index($padre) {
        $this->load->model('usuario_model');
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre(0); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado(0, $padre);
        //$this->load->model('destino_model');

        //$matriz = $this->basicauth->datosSession();
        $data['user'] = $this->session->userdata('nombres').' '.$this->session->userdata('apellidos');
       //$data['main_menu'] = 'menus/EnlacesHijos';
        $data['titulo'] = 'Bandeja de Solicitudes ';
      //  $data['menu_completo'] = $this->menus_model->obtenerMenuCompleto($matriz['id']);

        $data['vista_enviada'] = "solicitudes/bandeja_de_solicitudes_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function lista_de_justificaciones() {
        // echo "dep>>>".$this->input->post('dependientes');
        $data['mostrar_datos'] = $this->justificaciones_model->obtener_justificaciones_sup();
        $this->load->view('solicitudes/listaSolicitudesJustificaciones_view', $data);
    }

    function verSolicitudJustificacion() {
        $data['indice'] = $this->input->post('indice');
        $this->load->model('justificaciones_model');
        $this->load->model('historial_jus_per_vac_bm_model');
        $data['datos'] = $this->justificaciones_model->justificacion($this->input->post('id'));
        $dat = $data['datos']->row();

        if ($dat->estado == "Enviado" or $dat->estado == "Obtenido") {

            $this->justificaciones_model->cambio_estado_justificacion($this->input->post('id'), 'Leido');
            $this->historial_jus_per_vac_bm_model->adicionar_nuevo_evento($this->input->post('id'), 'Leido');
        }
        
        $this->load->view('solicitudes/solicitudJustificacion_view', $data);
    }

    function tomarAccion() {
        $this->load->model('historial_jus_per_vac_bm_model');
        $this->justificaciones_model->cambio_estado_justificacion($this->input->post('id'), 'Obtenido');
        $this->historial_jus_per_vac_bm_model->adicionar_nuevo_evento($this->input->post('id'), 'Obtenido');
    }

    function cambiarEstado() {
        $this->load->model('historial_jus_per_vac_bm_model');
        $this->load->model('qr_cod_model');
        $this->justificaciones_model->cambio_estado_justificacion($this->input->post('id'), $this->input->post('estado'));
        $codigo = $this->historial_jus_per_vac_bm_model->adicionar_nuevo_evento($this->input->post('id'), $this->input->post('estado'));
        echo '<br>CODIGO >>>>>>>>'.$codigo.'<br>';
        if ($this->input->post('firma')==1) {
           echo('ingreso a la function con firma');
            $this->qr_cod_model->generar_firma_QR($codigo);
        }
    }

    function obtener_estado() {
        echo $this->justificaciones_model->estado_justificacion($this->input->post('id'));
    }

}

?>
