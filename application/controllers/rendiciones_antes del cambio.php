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
        $data['selec_proyecto'] = $this->proyecto_model->seleccionar_proyecto_nombre();
        $data['selec_tecnico'] = $this->rendiciones_model->seleccionar_nombre_tecnico();
        $data['selec_tipo_gasto'] = $this->rendiciones_model->seleccionar_tipo_gasto('tra');
        //$data['selec_tipo_gasto_sg']= $this->contabilidad_plan_cuenta_model->seleccionar_tipo_gasto_sg();  
        $data['id_rend'] = $id_rendicion; //estoy cambiando id_ov_f


        if ($id_rendicion != 0) {

            $data['datos_rendicion'] = $this->rendiciones_model->obtener_datos_rendicion($id_rendicion);
            $data['datos_rendicion_detalle'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion);
        }
        $this->load->view('Rendiciones/nueva_rendicion_view', $data);
    }

    function abrir_rendicion($id_rendicion) {

        $this->load->model('proyecto_model');
        $this->load->model('usuario_model');
        
        $data['selec_proyecto'] = $this->proyecto_model->seleccionar_proyecto_nombre();
        $data['selec_tecnico'] = $this->rendiciones_model->seleccionar_nombre_tecnico();
        $data['selec_tipo_gasto'] = $this->rendiciones_model->seleccionar_tipo_gasto('tra');
        $data['id_rend'] = $id_rendicion;
      
        $dat=$data['datos_rendicion'] = $this->rendiciones_model->obtener_datos_rendicion($id_rendicion);
        $data['d_tecnico']=$this->usuario_model->obtener_user($dat->row()->id_tecnico_asignado);
             
        $data['datos_rendicion_detalle'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion);
        $this->load->view('Rendiciones/abrir_rendicion_view', $data);
    }
    function abrir_rendicion_baul($id_rendicion) {

        $this->load->model('proyecto_model');
        $this->load->model('usuario_model');
        $data['selec_proyecto'] = $this->proyecto_model->seleccionar_proyecto_nombre();
        $data['selec_tecnico'] = $this->rendiciones_model->seleccionar_nombre_tecnico();
        $data['selec_tipo_gasto'] = $this->rendiciones_model->seleccionar_tipo_gasto('tra');
        $data['id_rend'] = $id_rendicion;
      
       $dat=$data['datos_rendicion'] = $this->rendiciones_model->obtener_datos_rendicion($id_rendicion);
        $data['d_tecnico']=$this->usuario_model->obtener_user($dat->row()->id_tecnico_asignado);
        
        $data['datos_rendicion_detalle'] = $this->rendiciones_model->obtener_detalle_datos_rendicion($id_rendicion*-1);
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

    function buscar_tipo_gasto() {
        $tipo_gasto = $this->input->post("tipo_gasto");
        //echo $tipo_gasto;
        $id_campo = $this->input->post("id_campo");
        $seleccionado = $this->input->post("seleccionado");
        $tipo = 'sgr';

        if ($tipo_gasto == 1)
            $tipo = 'tra';

        if ($tipo_gasto == 3)
            $tipo = 'tel';

        $selec_tipo_gasto = $this->rendiciones_model->seleccionar_tipo_gasto($tipo);
        echo "
                <div class='letraChica  centrartexto negrilla'>
                        Apropiacion
                </div>
                <div class='esparriba5'> 
                            <select id='tipo_gasto' style='width:145px;'> ";
        //<?php
        foreach ($selec_tipo_gasto->result() as $dato2) {
            if ($dato2->idg_transporte == $seleccionado)
                echo "<option selected='selected' value='" . $dato2->idg_transporte . "'>" . $dato2->descripcion_tra . "</option>";
            else
                echo "<option value='" . $dato2->idg_transporte . "'>" . $dato2->descripcion_tra . "</option>";
        }



        echo "</select> 
              </div>";
    }

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
        $data['titulo'] = 'Recepcion de Rendiciones';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'Rendiciones/rendiciones_rt_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_de_rendiciones_rt() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $rendicion = $this->rendiciones_model->listar_buscar_rendicion_rt($b, $i, $c);
        $total_registros = $this->rendiciones_model->listar_buscar_rendicion_cantidad_rt($b);
        $inf_detalle=  array();
        foreach ($rendicion->result() as $red)
        {
            $inf_detalle[$red->idreg_ren]=$this->rendiciones_model->obtener_detalle_datos_rendicion(($red->idreg_ren*-1));
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
    function index_te($padre) {
        $data['titulo'] = 'Mis rendiciones';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'Rendiciones/rendiciones_tec_view';
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
            $resp_dato="-1|Depto de Contabilidad|La Paz|CONTABILIDAD||";
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
    
    function mover_a_baul_rechazados()
    {
        $id_rechazado=$this->input->post('id_det');
        $id_rendicion=$this->input->post('id_reg_rend');
        $this->rendiciones_model->modificar_detalle_rendicion($id_rechazado,$id_rendicion);
                
    }

}
