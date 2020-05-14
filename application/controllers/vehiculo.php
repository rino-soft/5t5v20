<?php

class vehiculo extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('vehiculo_model');
        $this->load->model('proyecto_model');
        $this->load->model('generar_grafica_model');
        $this->load->model('menu_model');
        if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
        $this->load->helper('url');
        $data['home'] = strtolower(__CLASS__) . '/';
        $this->load->vars($data);
    }

//$padre,$hijo
    function index($padre) {
        $data['titulo'] = 'Transportes';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'graficas_estadisticas/vista_principal_graficas_total';
        //$data['vista_enviada'] = 'graficas_estadisticas/vistas_fusionadas_graficas_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function nuevo_vehiculo($padre) {
        $data['titulo'] = 'Administración Nacional';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'vehiculos/vista_vehiculo_view'; //colocar la vista
        $data['$selec_depar'] = 0;

        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function adicionar_nuevo_vehiculo($id_vehiculo) {
        $data['vehiculo'] = $this->vehiculo_model->adicionar_nuevo_vehiculo_for($id_vehiculo);
        $data['proyectos'] = $this->vehiculo_model->seleccionar_proyecto();
        $data['id_send'] = $id_vehiculo;
        $this->load->view('vehiculos/adicionar_nuevo_vehiculo_view', $data);
    }

    function guardar_nuevo_vehiculo() {
        $respuesta = $this->vehiculo_model->guardar_nuevo_vehiculo_for();
        echo $respuesta;
    }

    function busqueda_lista_vehiculo() {

        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $se_dep = $this->input->post("selec_depar");
        $asig = $this->input->post("asignado"); // para lo de estado aignacion nacional
        $proy = $this->input->post("proyecto"); // para lo de estado asignacion regional por proyecto

        $i = ($p * $c) - $c;
        $ov_pfs = $this->vehiculo_model->listar_buscar_vehiculo($b, $i, $c);
        $total_registros = $this->vehiculo_model->listar_buscar_vehiculo_cantidad($b);
        //$disponibilidad =  $this->vehiculo_model->buscar_disponibilidad($b,$i,$c);
        $nacional = array();
        $regional = array();
        // $regional_sub=array();
        $departamento = array();
        $estado_vehicular = array();
        // $marcar_por_estado=array();
        $data['t_vehi'] = $ov_pfs->num_rows();
        $data['t_alq'] = $this->vehiculo_model->cant_contrato_estado('Alquilado', 'Activo');
        $data['t_prop'] = $this->vehiculo_model->cant_contrato_estado('Propio', '%ctivo');
        $data['t_act_pro'] = $this->vehiculo_model->cant_contrato_estado('Propio', 'Activo');
        $data['t_inac_pro'] = $this->vehiculo_model->cant_contrato_estado('Propio', 'Inactivo');
        $data['t_veh_bue'] = 0;
        $data['t_veh_reg'] = 0;
        $data['t_veh_pes'] = 0;

        foreach ($ov_pfs->result()as $reg) {
            $nacional[$reg->id_vehiculo] = $this->vehiculo_model->buscar_registro_responsable_asignado($reg->id_vehiculo);
            $regional[$reg->id_vehiculo] = $this->vehiculo_model->buscar_registro_proyecto_o_taller($reg->id_vehiculo);
            //  $regional_sub[$reg->id_vehiculo]=  $this->vehiculo_model->buscar_subcentro_asignado($reg->id_vehiculo);
            $departamento[$reg->id_vehiculo] = $this->vehiculo_model->buscar_departamento_asignado($reg->id_vehiculo);
            $est = $estado_vehicular[$reg->id_vehiculo] = $this->vehiculo_model->buscar_estado_vehicular($reg->id_vehiculo);
            // $data['t_alq'][$reg->id_vehiculo]=  $this->vehiculo_model->promedio_estado_vehicular($reg->id_vehiculo);
            if ($est[0] != 'Sin estado') {
                $promedio_est = round(($est[0] + $est[1]) / 2);
                if ($promedio_est < 4)
                    $data['t_veh_pes']++;
                if ($promedio_est >= 4 && $promedio_est < 8)
                    $data['t_veh_reg']++;
                if ($promedio_est >= 8)
                    $data['t_veh_bue']++;
            }
        }

        $data['asig_departamento'] = $departamento;
        $data['asig_nacional'] = $nacional;
        $data['asig_regional'] = $regional;
        $data['estado_vehi'] = $estado_vehicular;
        $data['total_registros'] = $total_registros;
        $data['registros'] = $ov_pfs;
        $data['selec_ciudad'] = $this->vehiculo_model->seleccionar_ciudad_asignar();
        $data['muestra_taller'] = $this->vehiculo_model->nombre_taller();
        $data['selec_proyecto'] = $this->proyecto_model->seleccionar_proyecto_nombre();
        $data['busqueda'] = $b;
        $data['selec_depar'] = $se_dep;
        $data['asigna'] = $asig;
        $data['proyecto_selec'] = $proy;

        $this->load->view('vehiculos/list_find_vehiculo_view', $data);
    }

    function asignar_responsable_vehiculo($id_vehiculo, $id_asignacion) {


        if ($id_asignacion == 0) {
            $data['per_a_asignar'] = $this->vehiculo_model->seleccionar_persona_asignar_vehiculo();
            $data['selec_ciudad'] = $this->vehiculo_model->seleccionar_ciudad_asignar();
            $data['asig_resp'] = $this->vehiculo_model->datos_asigna_respon();
            $data['estado_vehi'] = $this->vehiculo_model->ultimo_estado_vehiculo($id_vehiculo);
            $data['id_send'] = $id_vehiculo;
            $data['id_asignacion_dato'] = $id_asignacion;
            $this->load->view('vehiculos/asignar_vehiculo_responsable_view', $data);
        } else {
            $data['per_a_asignar'] = $this->vehiculo_model->seleccionar_persona_asignar_vehiculo();
            $data['selec_ciudad'] = $this->vehiculo_model->seleccionar_ciudad_asignar();
            $data['asig_resp'] = $this->vehiculo_model->datos_asigna_respon();
            $data['datos_vehi_asig'] = $this->vehiculo_model->registro_vehiculo_asignado($id_asignacion);
            $data['estado_vehi'] = $this->vehiculo_model->nuevo_estado_de_vehiculo($data['datos_vehi_asig']->id_estado_asig); //obt. dato de lo guardado
            $data['id_send'] = $id_vehiculo;
            $data['id_asignacion_dato'] = $id_asignacion;

            $this->load->view('vehiculos/asignar_vehiculo_responsable_view', $data);
        }
    }

    function guardar_vehiculo_asignado_responsable() {
        $respuesta = $this->vehiculo_model->guardar_vehiculo_asignado();
        echo $respuesta;
    }

    function nuevo_estado_vehiculo($id_vehiculo, $id_estado) {
        $data['estado_vehiculo'] = $this->vehiculo_model->nuevo_estado_de_vehiculo($id_estado);
        $data['dato_vehiculo'] = $this->vehiculo_model->obtener_dato_vehiculo($id_vehiculo);
        $data['id_vehi'] = $id_vehiculo;
        $data['id_esta'] = $id_estado;

        $this->load->view('vehiculos/nuevo_estado_de_vehiculo_view', $data);
    }

    function guardar_nuevo_estado_vehiculo() {
        $respuesta = $this->vehiculo_model->guardar_nuevo_estado();

        echo $respuesta;
    }

    function edita_devolucion_asignado_responsable($id_vehiculo, $id_asignado) {
        if ($id_asignado != 0) {
            $data['id_vehiculo'] = $id_vehiculo;
            $data['id_asignado'] = $id_asignado;
            $data['per_a_asignar'] = $this->vehiculo_model->seleccionar_persona_asignar_vehiculo_edita($id_asignado);
            $data['selec_ciudad'] = $this->vehiculo_model->seleccionar_ciudad_asignar_edita($id_asignado);
            $data['dato_asignado'] = $this->vehiculo_model->registro_vehiculo_asignado($id_asignado);
            $data['estado_vehi'] = $this->vehiculo_model->obtener_estado_asignado($id_asignado);
            $data['id_send'] = $id_vehiculo;
            $data['id_asignacion_dato'] = $id_asignado;
        }

        $this->load->view('vehiculos/editar_devolucion_asig_responsable_view', $data);
    }

    function guardar_vehiculo_asignado_responsable_editado() {
        $respuesta = $this->vehiculo_model->guardar_vehiculo_asignado_editado();
        echo $respuesta;
    }

    function guardar_vehiculo_asignado_responsable_devolucion() {
        $respuesta_editar = $this->vehiculo_model->guardar_vehiculo_asignado_editado_prueb();
        $respuesta = $this->vehiculo_model->guardar_vehiculo_asignado_prueb();
        echo $respuesta;
    }

    function guardar_imagenes_vehiculo() {
        $respuesta = $this->vehiculo_model->guardar_datos_imagen();
        echo $respuesta;
    }

    function nuevo_imagen_vehiculo($id_vehiculo) {

        $data['imagenes'] = $this->vehiculo_model->buscar_dato_ima($id_vehiculo);
        $data['dir_ayuda'] = $this->input->post('modulo');
        $data['id_vehi'] = $id_vehiculo;
        // $data['id_imagen']=$id_imagen_veh;
        $this->load->view('vehiculos/subida_de_imagenes_vehiculo_view', $data);
    }

    function ver_historial_de_asig_vehiculos($id_vehiculo) {
        $this->load->model("usuario_model");
        //echo 'este el id'.$id_vehiculo;
        $data['ver_registros'] = $this->vehiculo_model->obtener_historial_vehiculo($id_vehiculo);
        $resultado = $data['ver_registros'];
        $datos_depar = array();
        $datos_user = array();
        foreach ($resultado->result()as $reg) {
            $datos_depar[$reg->id_asig_reponsable] = $this->vehiculo_model->obtener_departamento_hist($reg->id_asig_reponsable);

            if ($reg->tipo_asignacion != "Taller") {
                $user = $this->usuario_model->obtener_user_norow($reg->id_responsable);
                if ($user->num_rows()>0) {
                    $datos_user[$reg->id_asig_reponsable] = $user->row()->ap_paterno . " " . $user->row()->ap_materno . ", " . $user->row()->nombre;
                } else {
                    $datos_user[$reg->id_asig_reponsable] = "";
                }
                //    echo $reg->id_asig_reponsable."=>".$datos_user[$reg->id_asig_reponsable]."<br>";
            } else {
                $datos_user[$reg->id_asig_reponsable] = "<span class='colorGuindo negrilla'>Taller: </span>" . $reg->nombre_taller . " (" . $reg->nombre_tecnico . ")<br> <span class='negrilla'>Reemplazado por: <br> </span><span class='colorcel negrilla'>" . $reg->reemplazo . "</span>";
            }
            // echo "cont - ".$reg->id_asig_reponsable."=".$datos_depar[$reg->id_asig_reponsable]."<br>";
        }
        // $data['asignados']=  $this->vehiculo_model->buscar_asignado_vehiculo_por_proyecto();
        //echo ''.$asignados;
        //  $data['obtener_depar']= $this->vehiculo_model->obtener_departamento_hist($id_asig_responsable);
        $data['obtener_depar'] = $datos_depar;
        $data['responsa'] = $datos_user;
        $data['id_send'] = $id_vehiculo;

















        $this->load->view('vehiculos/mostrar_historial_vehiculo_view', $data); //// arreglar
        //echo 'funciona maga';
    }

    /////probando si funciona
}