<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class rendiciones extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('rendiciones_model');
        if ($this->auth->is_logged() == FALSE) {

            redirect(base_url('login'));
        }
    }

    ////comenzando la parte de rendicion
    function registro_rendicion($padre) {
        $data['titulo'] = 'Contabilidad - Rendiciones / Reembolso';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);

        //$data['datos_cuenta_select']=$this->contabilidad_plan_cuenta_model->datos_del_plan_de_cuentas_select(0,''); 

        $data['vista_enviada'] = 'Rendiciones/formu_rendicion_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function nueva_rendicion($id_rendicion) {

        $this->load->model('proyecto_model');
        $this->load->model('usuario_model');
        $data['usuarios'] = $this->usuario_model->lista_usuarios_activos();
        //$data['selec_proyecto'] = $this->usuario_model->obtProyectoUser($this->session->userdata('id_admin'));
        $data['selec_tecnico'] = $this->rendiciones_model->seleccionar_nombre_tecnico();
        $data['selec_tipo_gasto'] = $this->rendiciones_model->seleccionar_tipo_gasto('tra');
        //$data['selec_tipo_gasto_sg']= $this->contabilidad_plan_cuenta_model->seleccionar_tipo_gasto_sg();  
        $data['id_rend'] = $id_rendicion; //estoy cambiando id_ov_f

        $detalle = array();
        if ($id_rendicion != 0) {


            $data['datos_rendicion'] = $this->rendiciones_model->obtener_datos_rendicion($id_rendicion);

            $detalle['datos_rendicion_detalle_traA'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'tra', 1);
            $detalle['datos_rendicion_detalle_traB'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'tra', 0);
            $detalle['datos_rendicion_detalle_sgrA'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'sgr', 1);
            $detalle['datos_rendicion_detalle_sgrB'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'sgr', 0);
            $detalle['datos_rendicion_detalle_sgrC'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'tel', 1);



            //adicionado 14/07/16
            //$data['datos_rendicion_detalle'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion);

            /*  $data['traA']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'tra',1);
              $data['traB']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'tra',0);
              $data['sgrA']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'sgr',1);
              $data['sgrB']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'sgr',0);
              $data['sgrC']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'tel',1);
              /// hasta aqui */
            $data['detalle'] = $detalle;
        }

        $this->load->view('Rendiciones/nueva_rendicion_view', $data);
    }

    function nueva_rendicion_tercero($id_rendicion) {

        $this->load->model('proyecto_model');
        $this->load->model('usuario_model');
        $data['usuarios'] = $this->usuario_model->lista_usuarios_activos();
        $data['selec_proyecto'] = $this->usuario_model->obtProyectoUserResult($this->session->userdata('id_admin'));
        $data['selec_tecnico'] = $this->rendiciones_model->seleccionar_nombre_tecnico();
        $data['selec_tipo_gasto'] = $this->rendiciones_model->seleccionar_tipo_gasto('tra');
        //$data['selec_tipo_gasto_sg']= $this->contabilidad_plan_cuenta_model->seleccionar_tipo_gasto_sg();  
        $data['id_rend'] = $id_rendicion; //estoy cambiando id_ov_f
        $data['sitios'] = "Selecciona un proyecto";
        $detalle = array();
        if ($id_rendicion != 0) {


            $data['datos_rendicion'] = $this->rendiciones_model->obtener_datos_rendicion($id_rendicion);
            $data['sitios'] = $this->cargar_sitios_proyecto_controller($data['datos_rendicion']->row()->id_proy);

            $detalle['datos_rendicion_detalle_traA'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'tra', 1);
            $detalle['datos_rendicion_detalle_traB'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'tra', 0);
            $detalle['datos_rendicion_detalle_sgrA'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'sgr', 1);
            $detalle['datos_rendicion_detalle_sgrB'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'sgr', 0);
            $detalle['datos_rendicion_detalle_sgrC'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'tel', 1);



            //adicionado 14/07/16
            //$data['datos_rendicion_detalle'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion);

            /*  $data['traA']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'tra',1);
              $data['traB']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'tra',0);
              $data['sgrA']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'sgr',1);
              $data['sgrB']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'sgr',0);
              $data['sgrC']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'tel',1);
              /// hasta aqui */
            $data['detalle'] = $detalle;
        }

        $this->load->view('Rendiciones/nueva_rendicion_terceros_view', $data);
    }

    function nueva_rendicion_mio($id_rendicion,$tipo=null,$id_doc=null,$usuario=null) {

        $this->load->model('proyecto_model');
        $this->load->model('usuario_model');
        // $data['usuarios'] = $this->usuario_model->lista_usuarios_activos();
       // $data['selec_proyecto'] = $this->usuario_model->obtProyectoUserResult($this->session->userdata('id_admin'));
        $data['selec_tecnico'] = $this->rendiciones_model->seleccionar_nombre_tecnico();
        $data['selec_tipo_gasto'] = $this->rendiciones_model->seleccionar_tipo_gasto('tra');
        //$data['selec_tipo_gasto_sg']= $this->contabilidad_plan_cuenta_model->seleccionar_tipo_gasto_sg();  
        $data['id_rend'] = $id_rendicion; //estoy cambiando id_ov_f
        $data['sitios'] = "Selecciona un proyecto";
        //$data['caja_chica'] = $this->rendiciones_model->obtener_creditos("Reembolso", $this->session->userdata('id_admin'),"mio");
        //$data['fondos_rendir'] = $this->rendiciones_model->obtener_creditos("Rendicion", $this->session->userdata('id_admin'),"mio");
        $data['caja_chica'] = $this->rendiciones_model->obtener_creditos("Reembolso", $usuario,"mio");
        $data['fondos_rendir'] = $this->rendiciones_model->obtener_creditos("Rendicion", $usuario,"mio");
        $data['data_user']=$this->usuario_model->obtener_user($usuario);
        $data['tipo'] = $tipo;
        $data['id_doc'] = $id_doc;
        $data['datos_id_doc']=$this->rendiciones_model->obtener_datos_rendcc($tipo,$id_doc);
        $data['selec_proyecto']=$this->rendiciones_model->obtener_proyecto_rendcc($tipo,$id_doc);
        $detalle = array();
        if ($id_rendicion != 0) {


            $data['datos_rendicion'] = $this->rendiciones_model->obtener_datos_rendicion($id_rendicion);
            $data['sitios'] = $this->cargar_sitios_proyecto_controller($data['datos_rendicion']->row()->id_proy);

            $detalle['datos_rendicion_detalle_traA'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'tra', 1);
            $detalle['datos_rendicion_detalle_traB'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'tra', 0);
            $detalle['datos_rendicion_detalle_sgrA'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'sgr', 1);
            $detalle['datos_rendicion_detalle_sgrB'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'sgr', 0);
            $detalle['datos_rendicion_detalle_sgrC'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'tel', 1);



            //adicionado 14/07/16
            //$data['datos_rendicion_detalle'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion);

            /*  $data['traA']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'tra',1);
              $data['traB']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'tra',0);
              $data['sgrA']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'sgr',1);
              $data['sgrB']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'sgr',0);
              $data['sgrC']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'tel',1);
              /// hasta aqui */
            $data['detalle'] = $detalle;
        }

        $this->load->view('Rendiciones/nueva_rendicion_mio_view', $data);
    }

    function obtener_estado_cuentas_usuario() {
        $tipo = $this->input->post('tipo');
        $usuario = $this->input->post('usuario');
        $datos = $this->rendiciones_model->obtener_creditos($tipo, $usuario,"terceros");
        echo $datos;
    }

    function cargar_sitios_proyecto_controller($proyecto) {
        $this->load->model("control_proyecto_model");
        $sitios = $this->control_proyecto_model->listar_sitios_x_proyecto($proyecto);
        if ($sitios->num_rows > 0) {
            $codigo = "<select class='form-control' id='id_sitio' style='padding: 0px; font-size: 12px;'>";
            foreach ($sitios->result() as $sitio) {
                $codigo.="<option value='" . $sitio->idSitioTrabajo . "' >" . $sitio->nombre . "(DUID:" . $sitio->DIUD . ")</option>";
            }
            $codigo .="</select>";
            return $codigo;
        } else {
            return "<spam style='color:red'>No tiene Sitios Registrados en este proyecto, No puede Continuar</spam>";
        }
    }

    function cargar_sitios_proyecto() {
        $this->load->model("control_proyecto_model");
        $sitios = $this->control_proyecto_model->listar_sitios_x_proyecto($this->input->post('proy'));
        if ($sitios->num_rows > 0) {
            $codigo = "<select id='id_sitio'class='form-control' style='padding: 0px; font-size: 12px;'  >";
            $codigo.="<option value='0' >Seleccione Un SITIO</option>";
            foreach ($sitios->result() as $sitio) {
                $codigo.="<option value='" . $sitio->idSitioTrabajo . "' >" . $sitio->nombre . "(" . $sitio->DIUD . ")</option>";
            }
            $codigo .="</select>";
            echo $codigo;
        } else {
            echo "<spam style='color:red'>No tiene Sitios Registrados en este proyecto,No puede Continuar</spam>";
        }
    }

    function cargar_sitios_proyecto_sitio() {
        $this->load->model("control_proyecto_model");
        $sitios = $this->control_proyecto_model->listar_sitios_x_proyecto($this->input->post('proy'));
        $id_sitio = $this->input->post('sitio');
        if ($sitios->num_rows > 0) {
            $codigo = "<select id='id_sitio'class='form-control' style='padding: 0px; font-size: 12px;'  >";
            foreach ($sitios->result() as $sitio) {
                $sel = "";
                if ($sitio->id_sitioTrabajo == $id_sitio)
                    $sel = " selected='selected' ";
                $codigo.="<option value='" . $sitio->idSitioTrabajo . "' " . $sel . " >" . $sitio->nombre . "(" . $sitio->DIUD . ")</option>";
            }
            $codigo .="</select>";
            echo $codigo;
        } else {
            echo "<spam style='color:red'>No tiene Sitios Registrados en este proyecto,No puede Continuar</spam>";
        }
    }

    function abrir_rendicion($id_rendicion) {

        $this->load->model('proyecto_model');
        $this->load->model('usuario_model');

        $data['selec_proyecto'] = $this->proyecto_model->seleccionar_proyecto_nombre();
        $data['selec_tecnico'] = $this->rendiciones_model->seleccionar_nombre_tecnico();
        $data['selec_tipo_gasto'] = $this->rendiciones_model->seleccionar_tipo_gasto('tra');
        $data['id_rend'] = $id_rendicion;
        $data['usuarios'] = $this->usuario_model->lista_usuarios_activos();
        $dat = $data['datos_rendicion'] = $this->rendiciones_model->obtener_datos_rendicion($id_rendicion);

        $data['d_tecnico'] = $this->usuario_model->obtener_user($dat->row()->id_tecnico_asignado);
//        $data['datos_rendicion_detalle'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion);
        $data['datos_rendicion_detalle_traA'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'tra', 1);
        $data['datos_rendicion_detalle_traB'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'tra', 0);
        $data['datos_rendicion_detalle_sgrA'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'sgr', 1);
        $data['datos_rendicion_detalle_sgrB'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'sgr', 0);
        $data['datos_rendicion_detalle_sgrC'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion, 'tel', 1);
        $this->load->view('Rendiciones/abrir_rendicion_view', $data);
    }

    function abrir_rendicion_baul($id_rendicion) {

        $this->load->model('proyecto_model');
        $this->load->model('usuario_model');
        $data['selec_proyecto'] = $this->proyecto_model->seleccionar_proyecto_nombre();
        $data['selec_tecnico'] = $this->rendiciones_model->seleccionar_nombre_tecnico();
        $data['selec_tipo_gasto'] = $this->rendiciones_model->seleccionar_tipo_gasto('tra');
        $data['id_rend'] = $id_rendicion;

        $dat = $data['datos_rendicion'] = $this->rendiciones_model->obtener_datos_rendicion($id_rendicion);
        $data['d_tecnico'] = $this->usuario_model->obtener_user($dat->row()->id_tecnico_asignado);

        $data['datos_rendicion_detalle'] = $this->rendiciones_model->obtener_detalle_datos_rendicion_general($id_rendicion * -1);
        $this->load->view('Rendiciones/abrir_baul_view', $data);
    }

    function guardar_nueva_rendicion() {
        //echo 'funciona2';
        $respuesta = $this->rendiciones_model->guardar_nueva_rendicion_for();

        echo $respuesta;
    }

    function VoBo_rendicion() {
        //echo 'funciona2';
        $respuesta = $this->rendiciones_model->VoBo_rendicion_for();

        echo $respuesta;
    }

//modificado 12/07/2016 ruben 
    //*************************************************
    function buscar_tipo_gasto() {
        $tipo_gasto = $this->input->post("tipo_gasto");
        //echo $tipo_gasto;
        $id_campo = $this->input->post("id_campo");
        $campo_parametro = $this->input->post("campo_parametro");
        $seleccionado = $this->input->post("seleccionado");
        $tipo = 'ninguno';

        if ($tipo_gasto == 1)
            $tipo = 'tra';
        if ($tipo_gasto == 2)
            $tipo = 'sgr';

        if ($tipo_gasto == 3)
            $tipo = 'tel';
        if ($tipo_gasto != -1) {
            $selec_tipo_gasto = $this->rendiciones_model->seleccionar_tipo_gasto($tipo);

            $parametro = explode('#', $campo_parametro);
            echo "
                <div class='gcol-md-12 col-sm-12 col-xs-12 letraChica  centrartexto negrilla'>
                        Apropiacion
                </div>
                <div class='gcol-md-12 col-sm-12 col-xs-12 esparriba5'> 
                            <select id='tipo_gasto' class='form-control' style='font-size: 10px;' onchange='$(\"#" . $parametro[0] . " #id_apropiacion\").val($(\"#" . $parametro[0] . " #tipo_gasto :selected\").val());'> ";
            //<?php
            foreach ($selec_tipo_gasto->result() as $dato2) {
                if ($dato2->idg_transporte == $seleccionado)
                    echo "<option selected='selected' value='" . $dato2->idg_transporte . "'>" . $dato2->descripcion_tra . "</option>";
                else
                    echo "<option value='" . $dato2->idg_transporte . "'>" . $dato2->descripcion_tra . "</option>";
            }



            echo "</select> <script>$(\"#" . $parametro[0] . " #id_apropiacion\").val($(\"#" . $parametro[0] . " #tipo_gasto :selected\").val());</script>
        </div>";
        }
        else {
            echo "<div class='gcol-md-12 col-sm-12 col-xs-12 letraChica  centrartexto negrilla'>
                        Apropiacion
                </div>
                <div class='gcol-md-12 col-sm-12 col-xs-12 esparriba5'>debe seleccionar el tipo de gasto</div>";
        }
    }

    /*     * ******************************************************************************
     * *////////////////////////////////
    //// adiicionando nuevo busqueda 8/12/15

    function busqueda_de_rendiciones() {

        //echo "funciona1";

        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $rendicion = $this->rendiciones_model->listar_buscar_rendicion($b, $i, $c);
        $total_registros = $this->rendiciones_model->listar_buscar_rendicion_cantidad($b);
        $data['total_registros'] = $total_registros;
        $data['registros'] = $rendicion;
        $detalles_registros = array();
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('Rendiciones/list_find_rendicion_view', $data);
    }

    /// adicionado 17/02/16
    /*
      function rendicion_personal($padre){
      $data['titulo']='Rendiciones Personal';
      $data['datos_menu_superior']=  $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
      $data['datos_item_padre']=$padre;
      $data['datos_menu_detallado']=  $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);

      //$data['datos_cuenta_select']=$this->contabilidad_plan_cuenta_model->datos_del_plan_de_cuentas_select(0,'');

      $data['vista_enviada']='contabilidad_basico/formu_rendicion_tecnico_view';
      $this->load->view('Plantilla/Plantilla_vista',$data);
      }
      function index_v_jefe($padre){
      $data['titulo']='Listado Rendiciones';
      $data['datos_menu_superior']=  $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
      $data['datos_item_padre']=$padre;
      $data['datos_menu_detallado']=  $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
      $data['vista_enviada']='contabilidad_basico/formu_rendicion_proyecto_view';
      $this->load->view('Plantilla/Plantilla_vista',$data);
      }
      function busqueda_de_rendiciones_jp() {

      //echo "funciona1";

      $b = $this->input->post("buscar");
      $p = $this->input->post("pagina");
      $c = $this->input->post("cant");
      $i = ($p * $c) - $c;
      $rendicion = $this->contabilidad_plan_cuenta_model->listar_buscar_rendicion($b, $i, $c);
      $total_registros = $this->contabilidad_plan_cuenta_model->listar_buscar_rendicion_cantidad($b);
      $data['total_registros'] = $total_registros;
      $data['registros'] = $rendicion;
      $detalles_registros = array();
      $data['mostrar_X'] = $c;
      $data['pagina_actual'] = $p;
      $data['busqueda'] = $b;
      $this->load->view('contabilidad_basico/list_find_rendicion_jp_view', $data);
      }
     */
////hasta aqui

    function index_rt($padre) {
        $this->load->model('usuario_model');
        $data['titulo'] = 'Recepcion de Rendiciones';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;

        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'Rendiciones/rendiciones_rt_view';
        $data['lista_proyectos'] = $this->usuario_model->obtProyectoUsuario($this->session->userdata('id_admin'));
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_de_rendiciones_rt() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $proy = $this->input->post("proy");
        $i = ($p * $c) - $c;
        $rendicion = $this->rendiciones_model->listar_buscar_rendicion_rt($b, $i, $c, $proy);
        $total_registros = $this->rendiciones_model->listar_buscar_rendicion_cantidad_rt($b, $proy);
        $inf_detalle = array();
        foreach ($rendicion->result() as $red) {
            $inf_detalle[$red->idreg_ren] = $this->rendiciones_model->obtener_detalle_datos_rendicion_general(($red->idreg_ren * -1));
        }

        $data['rechazados'] = $inf_detalle;
        $data['total_registros'] = $total_registros;
        $data['registros'] = $rendicion;
        $detalles_registros = array();
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('Rendiciones/list_find_rendicion_rt_view', $data);
    }

    ////// for Mis rendiciones T
    function index_jp($padre) {
        $data['titulo'] = 'Mis rendiciones';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'Rendiciones/rendiciones_jp_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_de_rendiciones_jp() {

        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $rendicion = $this->rendiciones_model->listar_buscar_rendicion_jp($b, $i, $c);
        $total_registros = $this->rendiciones_model->listar_buscar_rendicion_cantidad_jp($b);
        $data['total_registros'] = $total_registros;
        $data['registros'] = $rendicion;
        $detalles_registros = array();
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('Rendiciones/list_find_rendicion_jp_view', $data);
    }

    //// for Mis rendiciones T
    function index_te($padre, $proyecto = 0) {
        $data['titulo'] = 'Mis rendiciones';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['registros_rend'] = $this->rendiciones_model->listar_buscar_rendicionesxproyecto_usuario($proyecto, $this->session->userdata('id_admin'));
        $data['proyectos'] = $this->usuario_model->obtProyectoUserResult($this->session->userdata('id_admin'));
        $data['caja_chica'] = $this->rendiciones_model->obtener_creditos("Reembolso", $this->session->userdata('id_admin'),"mio");
        $data['fondos_rendir'] = $this->rendiciones_model->obtener_creditos("Rendicion", $this->session->userdata('id_admin'),"mio");


        $data['vista_enviada'] = 'Rendiciones/mis_rendiciones_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function index_terceros($padre, $proyecto = 0) {
        $this->load->model('usuario_model');
        $data['titulo'] = 'Rendiciones de Terceros';
        // $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;
        $data['usuarios'] = $this->usuario_model->lista_usuarios_activos();
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['registros_rend'] = $this->rendiciones_model->listar_buscar_rendicionesxproyecto($proyecto);
        $data['proyectos'] = $this->usuario_model->obtProyectoUserResult($this->session->userdata('id_admin'));
        $data['padre'] = $padre;
        $data['proy_selec'] = $proyecto;

        $data['vista_enviada'] = 'Rendiciones/rendiciones_terceros_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_de_rendiciones_te() {

        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $rendicion = $this->rendiciones_model->listar_buscar_rendicion_te($b, $i, $c);
        $total_registros = $this->rendiciones_model->listar_buscar_rendicion_cantidad_te($b);
        $data['total_registros'] = $total_registros;
        $data['registros'] = $rendicion;
        $detalles_registros = array();
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('Rendiciones/list_find_rendicion_tec_view', $data);
    }

    //////////////////////////////////////////////rubbbebebebeenenennene                      funcion para obtener el feje con permiso para poder revizar las rendiciones

    function obtener_superior_permiso_proyecto() {
        $this->load->model('dependientes_model');
        $id_user = $this->session->userdata('id_admin');
        $proyecto = $this->input->post('id_proy');
        $mis_permisos = $this->dependientes_model->obtener_datos_permisos($proyecto, $id_user);
        //echo "aqui";

        if ("superior" == $mis_permisos->row()->env_rend) {
            $resp_dato = $this->dependientes_model->obtener_superior_permiso_proyecto($id_user, $id_user, $proyecto, 1); //1 = tipo que no esta funcionando para otros typos de autorizacion
        } else {
            $resp_dato = "-1|Depto de Contabilidad|La Paz|CONTABILIDAD||";
        }
        echo $resp_dato;
    }

    ////////////////////////***************************************/////////////////////////////////////
    //// for Mis rendiciones RR
    function index_res_r($padre) {
        $data['titulo'] = 'Mis rendiciones';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'Rendiciones/rendiciones_reg_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_de_rendiciones_rr() {

        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $rendicion = $this->rendiciones_model->listar_buscar_rendicion_te($b, $i, $c);
        $total_registros = $this->rendiciones_model->listar_buscar_rendicion_cantidad_te($b);
        $data['total_registros'] = $total_registros;
        $data['registros'] = $rendicion;
        $detalles_registros = array();
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('Rendiciones/list_find_rendicion_reg_view', $data);
    }

    ///for R.Rendiciones/Regionales

    function index_rr($padre) {
        $data['titulo'] = 'Recepcion Rendiciones Regionales';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'Rendiciones/rendiciones_recep_regional_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_de_rendiciones_recep_rr() {

        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $rendicion = $this->rendiciones_model->listar_buscar_rendicion_te($b, $i, $c);
        $total_registros = $this->rendiciones_model->listar_buscar_rendicion_cantidad_te($b);
        $data['total_registros'] = $total_registros;
        $data['registros'] = $rendicion;
        $detalles_registros = array();
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('Rendiciones/list_find_rendicion_recep_reg_view', $data);
    }

    function mover_a_baul_rechazados() {
        $id_rechazado = $this->input->post('id_det');
        $id_rendicion = $this->input->post('id_reg_rend');
        $this->rendiciones_model->modificar_detalle_rendicion($id_rechazado, $id_rendicion);
    }

    function obtener_estaciones_proyecto() {
        $id_proy = $this->input->post('id_proy');
        $resultado = $this->rendiciones_model->listado_estaciones_proyecto($id_proy);
        $codigo = "var etiquetas = [";
        $i = 0;
        foreach ($resultado->result()as $est) {
            if ($i == 0) {
                $codigo.="'" . $est->nombre_estacion . "-" . $est->depto . "'";
                $i++;
            } else
                $codigo.=",'" . $est->nombre_estacion . "-" . $est->depto . "'";
        }
        $codigo.="];";
        echo "<script>" . $codigo . "</script>";
    }

    function enviar_correo() {
        $this->load->model("notificacion_email_model");
        //$responsable_superior=$this->input->post('id_recepcion');
        $id_rendicion = $this->input->post('id_rendicion');
        //$this->notificacion_email->enviar_notificacion_rendiciones($id_rendicion);
        $this->notificacion_email_model->enviar_notificacion_rendiciones($id_rendicion);
    }

    function enviar_correo_vobo() {
        $this->load->model("notificacion_email_model");
        //$responsable_superior=$this->input->post('id_recepcion');
        $id_rendicion = $this->input->post('id_rendicion');
        //$this->notificacion_email->enviar_notificacion_rendiciones($id_rendicion);
        $this->notificacion_email_model->enviar_notificacion_rendiciones_vobo($id_rendicion);
    }

    function rechazar_rendicion() {
        $this->rendiciones_model->anular_toda_rendicion();
    }

}
