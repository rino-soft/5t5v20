<?php

class viaticos_extra extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('proyecto_model');
        $this->load->model('cliente_model');
        // controlador categoria

        if ($this->auth->is_logged() == FALSE) {

            redirect(base_url('login'));
        }
    }

    function index($padre) {


        $data['titulo'] = 'Viaticos Extraordinarios';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

     function reporte_viaticos_extraordinarios($padre,$hijo) {


        $data['titulo'] = 'Viaticos Extraordinarios';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        
        $data['vista_enviada'] = 'viaticos_extra_supervision/reporte_viatico_extra_form_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
        
    }
    
    
    
    
    function busqueda_de_proyecto() {

        $b = $this->input->post("buscar");
        $est = $this->input->post("estado");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $ov_pfs = $this->proyecto_model->listar_proyecto_buscar($b, $i, $c, $est);
        $total_registros = $this->proyecto_model->listar_proyecto_buscar_cantidad($b, $est);
        $data['total_registros'] = $total_registros;
        $data['registros'] = $ov_pfs;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;

        $this->load->view('proyecto/list_find_proyecto_view', $data);
    }

    function nueva_proyecto($id_proyecto) {
        $data['d_proyecto'] = $this->proyecto_model->obtener_inf_proyecto($id_proyecto);
        $data['d_contrato'] = $this->proyecto_model->obtener_detalle_datos_contrato($id_proyecto);
        $data['dato_cliente'] = $this->cliente_model->obtener_inf_cliente();
        $data['id_proy'] = $id_proyecto;
        $data['per_a_asignar'] = $this->proyecto_model->seleccionar_persona_asignar_proyecto();
        $this->load->view('proyecto/nuevo_proyecto_view', $data);
    }

    function guardar_nuevo_proyecto() {
        $respuesta = $this->proyecto_model->guardar_datos_proyecto();
        echo $respuesta;
    }

    // adicionado pro ruben 10-2-2016
    ////////////////////////////////////////////////////---------------------------------------
    function lista_proyecto_cliente() {
        $respuesta = $this->proyecto_model->listar_proyecto_cliente($this->input->post('id_cliente'));
        $p_selec = $this->input->post('p_seleccionado');
        $codigo = "";
        if ($respuesta->num_rows() > 0) {
            foreach ($respuesta->result() as $reg) {
                $sel = '';
                if ($p_selec == $reg->id_proy)
                    $sel = ' selected="selected" ';
                $codigo.="<option value='" . $reg->id_proy . "' " . $sel . ">$reg->nombre</option>";
            }
        } else
            $codigo.="<option value='-1'>NO tiene Proyectos asignados al cliente</option>";
        echo $codigo;
    }

    function lista_contrato_proyecto() {
        $respuesta = $this->proyecto_model->listar_contrato_proyecto_cliente($this->input->post('proyecto'), $this->input->post('c_seleccionado'));
        $c_selec = $this->input->post('c_seleccionado');
        $codigo = "";
        if ($respuesta->num_rows() > 0) {
            foreach ($respuesta->result() as $reg) {
                $sel = '';
                if ($c_selec == $reg->id_contrato)
                    $sel = ' selected="selected" ';
                $codigo.="<option value='" . $reg->id_contrato . "' " . $sel . " >$reg->nro_contrato ($reg->nro_licitacion $reg->objeto )</option>";
            }
        } else
            $codigo.="<option value='-1'>NO tiene Contratos registrados al proyecto</option>";
        echo $codigo;
    }

    function listar_proyecto_select() {
        $lista = $this->proyecto_model->listar_proyectos_all();
        if ($lista->num_rows() > 0) {
            echo "<select id='id_proyecto' style='width:240px;'>";
            foreach ($lista->result() as $reg) {
                //  if($s==$reg->id_proy)
                //    echo "<option selected='selected' value='".$reg->id_proy."'>".$reg->nombre."</option>";
                //else
                echo "<option value='" . $reg->id_proy . "'>" . $reg->nombre . "</option>";
            }
            echo "</select>";
        }
    }

}
