<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class linea_servicio extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('linea_servicio_model');
        if ($this->auth->is_logged() == FALSE) {

            redirect(base_url('login'));
        }
    }

    function index($padre) {

        $data['titulo'] = 'Lineas y Servicios de Telecomunicacion';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);

        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function lineas_registradas($padre, $hijo=null) {
        $data['titulo'] = 'Lineas y Servicios de Telecomunicacion';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);

        $data['vista_enviada'] = 'linea_servicios_telecom/lineas_registradas_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function formulario_registro_linea_servicio_telecom($id_linea) {
        $data['id_linea'] = $id_linea;
        $this->load->model('vehiculo_model');
        $this->load->model('usuario_model');
        $this->load->model('proyecto_model');
        $data['selec_ciudad'] = $this->vehiculo_model->seleccionar_ciudad_asignar();
        $data['dato_form'] = $this->linea_servicio_model->obtener_registro_linea($id_linea);
        $data['lista_usuarios'] = $this->usuario_model->lista_usuarios_activos();
        $data['lista_proyectos'] = $this->proyecto_model->obtProyectosActivos();
        $data['lista_numeros'] = $this->linea_servicio_model->lista_solo_lineas();


        $this->load->view('linea_servicios_telecom/formulario_linea_telecom_view', $data);
    }

    function guarda_registro_linea_servicio() {
        $respuesta = $this->linea_servicio_model->guardar_registro_linea_servicio_telecom();
        echo $respuesta;
    }

    function encontrar_list_lineas() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $registros = $this->linea_servicio_model->listar_buscar_linea_servicio($b, $i, $c);
        $total_registros = $this->linea_servicio_model->listar_buscar_linea_servicio_cantidad($b);
        $data['total_registros'] = $total_registros;
        $data['registros'] = $registros;
        $detalles_registros = array();
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('linea_servicios_telecom/list_find_lineas_servicios_view', $data);
    }

    function verifica_linea() {
        $resultado = $this->linea_servicio_model->obtener_registro_linea_x_instancia($this->input->post("instancia"));
        $id_lin = 0;
        if ($resultado->num_rows() > 0) {
            $id_lin = $resultado->row()->id_lin_serv;
        }
        echo $id_lin;
    }

    function contrato_oficinas($padre, $hijo=null) {
        $this->load->model('proyecto_model');
        $data['titulo'] = 'Contratos de Alquiler de Oficinas';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['lista_proyectos'] = $this->proyecto_model->obtProyectosActivos();
        $data['vista_enviada'] = 'contratos/contrato_alquiler_registradas_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function formulario_registro_contrato_alquiler($id_contrato) {
        $data['id_contrato'] = $id_contrato;
        //$this->load->model('vehiculo_model');
        //$this->load->model('usuario_model');
        $this->load->model('proyecto_model');
        //$data['selec_ciudad']=  $this->vehiculo_model->seleccionar_ciudad_asignar();
        $data['dato_form'] = $this->linea_servicio_model->obtener_registro_contrato_alquiler($id_contrato);
        $data['dato_relacion_proyecto_contrato'] = $this->linea_servicio_model->obtener_registro_proyecto_contrato_alquiler($id_contrato);

        //$data['lista_usuarios']=$this->usuario_model->lista_usuarios_activos();
        $data['lista_proyectos'] = $this->proyecto_model->obtProyectosActivos();
        //$data['lista_numeros']=$this->linea_servicio_model->lista_solo_lineas();


        $this->load->view('contratos/formulario_contrato_alquiler_view', $data);
    }

    function guarda_registro_contrato_alquiler() {
        $respuesta = $this->linea_servicio_model->guardar_registro_contrato_alquiler();
        echo $respuesta;
    }

    function encontrar_contrato_alquiler() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $pro = $this->input->post("proyecto");
        $i = ($p * $c) - $c;

        $this->load->model('proyecto_model');

        $registros = $this->linea_servicio_model->listar_buscar_contrato_alquiler($b, $i, $c, $pro);
        $total_registros = $this->linea_servicio_model->listar_buscar_contrato_alquiler_cantidad($b, $pro);
        $data['total_registros'] = $total_registros;
        $data['registros'] = $registros;
        if ($pro == 0)
            $data['proyectoN'] = "TODOS LOS PROYECTOS";
        else {
            $data['proyectoN'] = $this->proyecto_model->obtener_inf_proyecto($pro)->row()->nombre;
            
        }
        if ($b == "")
            $b = "Ninguno";
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('contratos/list_find_contrato_alquiler_view', $data);
    }

    function obtener_archivos_contrato_alquiler($id_contrato) {
        $data['dato_relacion_archivo_contrato'] = $this->linea_servicio_model->obtener_registro_archivo_contrato_alquiler($id_contrato);
        $this->load->view('contratos/archivos_contratos', $data);
    }

}
