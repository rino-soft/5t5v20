<?php

class movimiento_almacen extends CI_Controller {

    public $selected = "";

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('almacen_model');
        $this->load->model('movimiento_almacen_model');
        $this->load->model('usuario_model');
        $this->load->model('detalle_mih_model');
        $this->load->model('producto_servicio_model');
        $this->load->model('uploadify_model');


        if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }

//$padre,$hijo


    function index($padre) {
        $data['titulo'] = 'Movimiento Almacen';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);



        //$clientes = $this->cliente_model->listar_clientes("");
        // $data['datos_cliente'] = $clientes;//para mostrar en la pantalla cambiar en clientes
        // $contactos_cliente = array();
        // foreach ($clientes as $cli) {
        //     $contactos_cliente[$cli->id_cliente] = $this->cliente_model->lista_contacto_cliente($cli->id_cliente);
        // para mostra en pantalla detalle de los modulos cambiar para contactos
        //  }
        //   $data['contactos_cliente'] = $contactos_cliente;


        $data['vista_enviada'] = 'movimiento_almacen/movimiento_almacen_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    //paramet of data base


    function ver_mov_alm($id_ov_fp) {
        echo "funciona";
        $data['id_send'] = $id_ov_fp;
        $this->load->view('movimiento_almacen/nuevo_almacen_view', $data);
    }

    function almacen_nuevo($id_ma) {
        $data['id_sendma'] = $id_ma;

        $this->load->model('usuario_model');
        $this->load->model('almacen_model');
        // $id_user = $this->input->post('id_personal');
        $data['personal_datos'] = $this->usuario_model->lista_usuarios_activos();
        //$data['busqueda_proy'] = $this->movimiento_almacen_model->busq_user_proy($id_user);
        $data['almacen_datos'] = $this->almacen_model->listar_almacen_responsable_almacen($this->session->userdata('id_admin'));

        $data['id_send'] = $id_ma;
        //echo "el id enviado es ". $id_ar;
        if ($id_ma != 0) {
            $data['inf_ingreso'] = $this->movimiento_almacen_model->obtener_mov_alm($id_ma); //utilizacion tabla mov.almacen
            $data['inf_detalle_ingreso'] = $this->movimiento_almacen_model->obtener_detalle_movimiento1($id_ma);

            // echo "el id enviado es ". $id_ma;
        }
        $this->load->view('movimiento_almacen/nuevo_almacen_view', $data);
    }

    function almacen_ver($id_mov_alm) {
        $data['$id_mov_alm'] = $this->movimiento_almacen_model->obtener_mov_alm($id_mov_alm);
        $data['id_send'] = $id_mov_alm;
        $this->load->view('movimiento_almacen/mov_almacen_view', $data);
    }

    function almacen_retiro($id_ar) {
        $data['id_send'] = $id_ar;
        $this->load->view('movimiento_almacen/nuevo_almacen_view_retiro', $data);
    }

    function guardar_almacen() {
        $respuesta = $this->cliente_model->guardar_cliente_nuevo();
        echo $respuesta;
    }

    function guardar_ingreso() {
        $respuesta = $this->movimiento_almacen_model->guardar_ingreso_nuevo();
        echo $respuesta;
    }

    function eliminar_ingreso() {
        $respuesta = $this->movimiento_almacen_model->eliminar_ingreso_nuevo();
        echo $respuesta;
    }

    function mov_alm_save() {
        $this->movimiento_almacen_model->save_mov_alm1();
    }

    function guardar_mov_alm_nuevo() {
        $respuesta = $this->movimiento_almacen_model->guardar_mov_alm();
        echo $respuesta;
    }

    function find_selected() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $s = $this->input->post("opc1");
        // alert("mmm"+$s);
        //-----------------------------listar_buscar_ov_pf($b,$i,$c);
        $opcs = $this->movimiento_almacen_model->opc_sel1($b, $i, $c, $s);
        //-------------------------------------listar_buscar_ov_pf_cantidad($b);
        // $total_registros=$this->almacen_model->listar_buscar_al_cantidad($b);
        // $os->result();
        $data['registros'] = $opcs;
        // $data['mostrar_X']=$c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $data['mostrar_X'] = $s;
        $this->load->view('movimiento_almacen/ops_sel_view', $data);
    }

    function find_selected1() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $s = $this->input->post("opc1");
        //-----------------------------listar_buscar_ov_pf($b,$i,$c);
        $opcs = $this->movimiento_almacen_model->opc_sel_prov($b, $i, $c, $s);
        //-------------------------------------listar_buscar_ov_pf_cantidad($b);
        // $total_registros=$this->almacen_model->listar_buscar_al_cantidad($b);
        // $os->result();
        $data['registros'] = $opcs;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $data['mostrar_X'] = $s;

        $this->load->view('movimiento_almacen/ops_sel_view1', $data);
    }

    function busqueda_mih_detalle() {
        $busqueda = $this->input->post('busqueda');
        $cant = $this->input->post('cant');
        $pag = $this->input->post('pag');
        $ini = ($pag * $cant) - $cant;
        $data['ind'] = $ini;
        $data['no_reg'] = $this->detalle_mih_model->cant_busqueda($busqueda);
        $data['mostrar'] = $cant;
        $data['pagina'] = $pag;
        $data['consulta'] = $this->detalle_mih_model->busqueda_obj1($busqueda);
        $data['busqueda'] = $busqueda;
        $data['ids'] = $this->input->post('selecionados');
        $this->load->view('movimiento_almacen/resultado_busqueda_mih_view1', $data);
    }

    function listar_usuario() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $s = $this->input->post("opc1");
        // alert("mmm"+$s);
        //-----------------------------listar_buscar_ov_pf($b,$i,$c);
        $opcs = $this->movimiento_almacen_model->opc_sel_dinamico($b, $i, $c, $s);
        //-------------------------------------listar_buscar_ov_pf_cantidad($b);
        // $total_registros=$this->almacen_model->listar_buscar_al_cantidad($b);
        // $os->result();

        $data['registros'] = $opcs;
        // $data['mostrar_X']=$c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $data['mostrar_X'] = $s;
        $this->load->view('movimiento_almacen/ops_sel_view', $data);
    }

    function ingreso_ver($id_i) {
        $data['d_i'] = $this->movimiento_almacen_model->obtener_mov_alm($id_i);
        $data['id_send'] = $id_i;
        $this->load->view('movimiento_almacen/nuevo_ingreso_view', $data); //aun no 
    }

    function ingreso_baja($id_i) {
        $data['d_i'] = $this->movimiento_almacen_model->obtener_mov_alm($id_i);
        $data['id_send'] = $id_i;
        $this->load->view('movimiento_almacen/baja_ingreso_view', $data); //aun no 
    }

    function ingreso_editar() {
        $data['movimiento_almacen'] = $this->movimiento_almacen_model->mensajes_ingreso();


        $this->load->view('movimiento_almacen/nuevo_ingreso_edit_view', $data); //aun no 
    }

    function salidas_u() {

        $data['movimiento'] = $this->movimiento_almacen_model->movi_ut(1); //tipo 1 entrada 2 salida
        $this->load->view('movimiento_almacen/lista_movimiento_p_ingresos', $data);
    }

    function add_articulo() {

        $lp1 = $this->usuario_model->find_ser_prov_detalle();
        $data['registros2'] = $lp1;
        $data['ids'] = $this->input->post('selecionados');
        $this->load->view('movimiento_almacen/list_find_alm_serv_pro_view', $data);
    }

    //función encargada de actualizar los datos    
    function actualizar_datos() {
        $id_mov_alm = $this->input->post('id_mov_alm');
        $fh_reg = $this->input->post('fh_reg');
        $tipo_movimiento = $this->input->post('tipo_movimiento');
        $proyecto = $this->input->post('proyecto');
        $comentario = $this->input->post('comentario');
        $tipo_doc_origen = $this->input->post('tipo_doc_origen');
        $doc_respaldo = $this->input->post('doc_respaldo');

        $actualizar = $this->almacen_model->actualizar_mensaje_ingreso($id_mov_alm, $fh_reg, $tipo_movimiento, $proyecto, $comentario, $tipo_doc_origen, $doc_respaldo);        //si la actualización ha sido correcta creamos una sesión flashdata para decirlo
        if ($actualizar) {
            $this->session->set_flashdata('actualizado', 'El mensaje se actualizó correctamente');
            // redirect('../almacen', 'refresh');
        }
    }

//función para el movimiento de almacen
    function find_list_personal() {

        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $ra = $this->movimiento_almacen_model->list_find_people($i, $c);
        $total_registros = $this->movimiento_almacen_model->list_find_people_cant();

        $data['total_registros'] = $total_registros;
        $data['registros'] = $ra;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;

        $this->load->view('usuario/list_find_usuario_view', $data);
    }

    function ver_lista_al_detalle($idm) {

        $data['registros1'] = $this->movimiento_almacen_model->ver_al_detalle($idm);
        //$data['detalle_registro'] = $this->movimiento_almacen_model->ver_al_detalle_art($idm);
        $data['id_send'] = $idm;
        $this->load->view('movimiento_almacen/ver_ingreso_view', $data);
    }

    function salidas_usuario() {
        //$p = $this->input->post("pagina");
        //$c = $this->input->post("cant");
        // $i = ($p * $c) - $c;
        $id_user = $this->input->post('id_usuario');
        $id_proy = $this->input->post('id_proyecto');
        //echo "user"+$id_user+"proyecto"+$id_proy;
        // $data['movimiento1'] = $this->movimiento_almacen_model->movi_usuario_tipo2(1, $id_user); //tipo 1 entrada 2 salida
        // $data['total_registros'] = $this->movimiento_almacen_model->movi_usuario_tipo_cantidad(1, $id_user, $id_proy);
        // $data['movimiento'] = $this->movimiento_almacen_model->movi_usuario_tipo($i, $c, 1, $id_user, $id_proy); //tipo 1 entrada 2 salida
        // $data['mostrar_X'] = $c;
        //  $data['pagina_actual'] = $p;
        $data['consulta_proy_sel'] = $this->movimiento_almacen_model->obtener_user_proy_sel($id_user);
        $data['consulta_almacen_sel'] = $this->movimiento_almacen_model->obtener_user_almacen_sel($this->session->userdata('id_admin'));
        $data['idp'] = $id_proy;
        //echo $id_proy;   
        // $data['movimiento_sel_proy'] = $this->movimiento_almacen_model->movi_usuario_tipo_proyecto($i, $c, 1, $id_user, $id_proy); //tipo 1 entrada 2 salida
        //$data['total_registros_sel_proy'] = $this->movimiento_almacen_model->movi_usuario_tipo_proyecto_cantidad(1, $id_user, $id_proy);     
        $this->load->view('movimiento_almacen/lista_movimiento_p_ingresos', $data);
    }

    /*  function salidas_usuario_sel() {
      $p = $this->input->post("pagina");
      $c = $this->input->post("cant");
      $i = ($p * $c) - $c;

      $id_user = $this->input->post('id_usuario');
      $id_proy = $this->input->post('id_proyecto');

      $mov = $this->movimiento_almacen_model->movi_usuario_tipo($i, $c, 1, $id_user); //tipo 1 entrada 2 salida
      $total_registros = $this->movimiento_almacen_model->movi_usuario_tipo_cantidad(1, $id_user);
      $mov1 = $this->movimiento_almacen_model->movi_usuario_tipo2(1, $id_user); //tipo 1 entrada 2 salida
      $data['movimiento1'] = $mov1;
      $data['total_registros'] = $total_registros;
      $data['movimiento'] = $mov;
      $data['mostrar_X'] = $c;
      $data['pagina_actual'] = $p;
      //$data['movimiento'] = $this->almacen_model->movi_usuario_tipo(1, $id_user);

      $data['consulta_proy_sel'] = $this->movimiento_almacen_model->obtener_user_proy_sel($id_user);
      $data['consulta_almacen_sel'] = $this->movimiento_almacen_model->obtener_user_almacen_sel($this->session->userdata('id_admin'));



      //$data['movimiento_sel_proy'] = $this->movimiento_almacen_model->movi_usuario_tipo_proyecto($i, $c, 1, $id_user, $id_proy); //tipo 1 entrada 2 salida
      //$data['total_registros_sel_proy'] = $this->movimiento_almacen_model->movi_usuario_tipo_proyecto_cantidad(1, $id_user, $id_proy);

      $this->load->view('movimiento_almacen/lista_movimiento_p_ingresos', $data);
      } */

    function obtener_detalle_movimiento() {
        $id_mov = $this->input->post('id_mov');
        $data['detalle'] = $this->movimiento_almacen_model->obtener_detalle_movimiento1($id_mov);
        $data['ids'] = $this->input->post('selecionados');
        $data['movimiento1'] = $this->movimiento_almacen_model->obtener_nuevo_mov($id_mov);
        $this->load->view('movimiento_almacen/detalle_movimiento', $data);
    }

    function busqueda_lista_art() {
        //  echo 'funciona';
        $busqueda = $this->input->post('busqueda');
        $cant = $this->input->post('cant');
        $pag = $this->input->post('pag');
        $ini = ($pag * $cant) - $cant;
        $data['ind'] = $ini;
        $data['no_reg'] = $this->producto_servicio_model->cant_busqueda($busqueda);
        $data['mostrar'] = $cant;
        $data['pagina'] = $pag;

        // $data['id_send'] = $id_ar;
        $data['consulta_art'] = $this->producto_servicio_model->busqueda_prod_serv_p($busqueda, $cant, $ini);

        //  $data['consulta_sn'] = $this->movimiento_almacen_model->busqueda_serial_number();
        $data['busqueda'] = $busqueda;
        $data['ids'] = $this->input->post('selecionados');

        $idmov = $this->input->post('id_mov');
        $data['idma'] = $idmov;

        //  echo "el id enviado es ". $idmov;
        if ($idmov != 0) {
            $data['consulta_ma'] = $this->movimiento_almacen_model->obtener_mov_alm($idmov); //utilizacion tabla mov.almacen
        }
        $this->load->view('movimiento_almacen/articulo_view', $data);
    }

    function pro_serv_save() {
        // if ($this->input->post('id_ma') == 0) {
        $this->movimiento_almacen_model->save_pro_serv();
        //}  
    }

    function movimiento_almacen_pro_serv_save() {


        // if ($this->input->post('id_ma') == 0) {
        //$this->movimiento_almacen_model->save_pro_serv();

        $id_mov_alm = $this->input->post('id_mov_alm');
        if ($id_mov_alm == 0)
            echo $this->movimiento_almacen_model->save_pro_serv();
        else {
            // echo ">>>>>>>".$id_mov_alm;
            echo $this->movimiento_almacen_model->edita_save_pro_serv($id_mov_alm);
        }

        //}  
    }

    function listar_usuario_mov() {
        $respuesta = $this->usuario_model->listar_usuarios();
        echo $respuesta;
    }

    /* function obtener_user_proy() {
      //$id_per = $this->input->post('id_personal');

      //$data['ids'] = $this->input->post('selecionados');
      //  $data['movimiento1'] = $this->movimiento_almacen_model->obtener_nuevo_mov($id_mov);
      $this->load->view('movimiento_almacen/lista_movimiento_p_ingresos', $data);
      }
     */

    function busqueda_lista_al_ov() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $ra = $this->movimiento_almacen_model->listar_buscar_al($b, $i, $c);
        $total_registros = $this->movimiento_almacen_model->listar_buscar_al_cantidad($b);
        $data['total_registros'] = $total_registros;
        $data['registros'] = $ra;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;

        $this->load->view('movimiento_almacen/list_find_almacen_view', $data);
    }

    function seriales_obtenidos_tipo() {
        $tipo = $this->input->post('tipo_requerido');
        $id_almacen = $this->input->post('almacen');
        $id_producto = $this->input->post('id_sp');
        $cant = $this->input->post('cant');
// echo $id_producto;
        $resultado_array = $this->movimiento_almacen_model->seriales_registradas_existencia_almacen_tipo($id_almacen, $id_producto, $tipo);
        //echo 'entra';
        if ($resultado_array != "")
            echo 'Ultimo cod propio:' . $resultado_array;
        else
            echo 'Ultimo cod propio: no encontrado';
    }

    /// movimiento de almacen ingreso con solicitud de devolucion de material
    function almacen_nuevo_dev($id_dev_mat) {
        $data['id_send'] = $id_dev_mat;
        $data['movimiento_ingreso'] = $this->movimiento_almacen_model->obterner_sol_dev_ingreso($id_dev_mat); //tipo 1 entrada 2 salida
        $data['movimiento_alm'] = $this->movimiento_almacen_model->obterner_sol_dev_alm_ingreso($id_dev_mat); //tipo 1 entrada 2 salida
        $data['movimiento_detalle'] = $this->movimiento_almacen_model->obterner_sol_dev_det_mov_alm_ingreso($id_dev_mat); //tipo 1 entrada 2 salida

        $this->load->view('movimiento_almacen/nuevo_almacen_dev_view', $data);
    }

    //nueva funcion ruben
    //guarda el movimienjto de almacen retiro directo 
    function save_mov_alm_retiro_directo() {


        $id_mov_alm = $this->input->post('id_mov_alm');
        if ($id_mov_alm == 0)
            echo $this->movimiento_almacen_model->guarda_mov_alm_directo_y_kardex();
        else {
            // echo ">>>>>>>".$id_mov_alm;
            echo $this->movimiento_almacen_model->edita_mov_alm_directo_y_kardex($id_mov_alm);
        }
    }

    function almacen_retiro_directo($id_ar) {
        $this->load->model('usuario_model');
        $this->load->model('almacen_model');
        // $id_user = $this->input->post('id_personal');
        $data['personal_datos'] = $this->usuario_model->lista_usuarios_activos();
        //$data['busqueda_proy'] = $this->movimiento_almacen_model->busq_user_proy($id_user);
        $data['almacen_datos'] = $this->almacen_model->listar_almacen_responsable_almacen($this->session->userdata('id_admin'));
        $data['oficinas_datos'] = $this->almacen_model->lista_region_oficinas();

        $data['id_send'] = $id_ar;
        //echo "el id enviado es ". $id_ar;
        if ($id_ar != 0) {
            $data['inf_retiro'] = $this->movimiento_almacen_model->obtener_mov_alm($id_ar); //utilizacion tabla mov.almacen
            $data['inf_detalle_retiro'] = $this->movimiento_almacen_model->obtener_detalle_movimiento1($id_ar);
        }
        $this->load->view('movimiento_almacen/nuevo_almacen_view_retiro_directo', $data);
    }

    //paula
    /* function almacen_retiro_directo($id_ar) {
      $this->load->model('usuario_model');
      $this->load->model('almacen_model');
      $data['id_send'] = $id_ar;
      $data['personal_datos']=$this->usuario_model->lista_usuarios_activos();
      $data['almacen_datos']=$this->almacen_model->listar_almacen_responsable_almacen($this->session->userdata('id_admin'));
      //$this->load->view('movimiento_almacen/nuevo_almacen_view_retiro_directo', $data);
      $this->load->view('movimiento_almacen/nuevo_almacen_view', $data);
      } */

    function seriales_registradas_tipo() {
        $tipo = $this->input->post('tipo_requerido');
        $id_almacen = $this->input->post('almacen');
        $id_producto = $this->input->post('id_sp');
        $cont = $this->input->post('cont');
        $seleccionado = $this->input->post('seleccionado');

        // echo $id_producto;
        $resultado_array = $this->movimiento_almacen_model->seriales_registradas_existencia_almacen($id_almacen, $id_producto, $tipo);

        if (count($resultado_array) > 0) {
            echo "<select id='seriales" . $id_producto . "-" . $cont . "' onchange='asigna_serial_codprop(\"seriales" . $id_producto . "-" . $cont . "\",\"sn\",\"cp\",\"" . $id_producto . "-" . $cont . "\" );genera_otra_opcion(\"otra_opcion\")'>";
            echo "<option value='0'>seleccione...</option>";
            for ($i = 0; $i < count($resultado_array); $i++) {
                $sele = "";
                if ($resultado_array[$i] == $seleccionado)
                    $sele = "selected='selected'";
                echo "<option value='" . $resultado_array[$i] . "' $sele >" . $resultado_array[$i] . "</option>";
            }
            if ($tipo == "Ingreso")
                echo "<option value='SN'>Adicionar nuevo Cod Propio y SN</option>";
            echo "</select>";
        } else {
            if ($tipo == "Ingreso") {
                echo "<select id='seriales" . $id_producto . "' onchange='asigna_serial_codprop(\"seriales" . $id_producto . "-" . $cont . "\",\"sn\",\"cp\",\"" . $id_producto . "-" . $cont . "\" );genera_otra_opcion(\"otra_opcion" . $id_producto . "\"," . $id_producto . ",1)'>";
                echo "<option value='0'>Seleccione una opcion</option>";
                echo "<option value='nuevo'>Adicionar nuevo Cod Propio y SN</option>";
                echo "</select>";
            } else {
                echo "No se han encontrado SERIES debe realizar el ingreso inicialmente";
            }
        }
    }

    //paula
//    function seriales_registradas_tipo_in() { 
//       $tipo = $this->input->post('tipo_requerido');
//        $id_almacen = $this->input->post('almacen');
//        $id_producto = $this->input->post('id_sp');
//        $cont = $this->input->post('cont');
//
//        // echo $id_producto;
//        $resultado_array = $this->movimiento_almacen_model->seriales_registradas_existencia_almacen($id_almacen, $id_producto, $tipo);
//
//        if (count($resultado_array) > 0) {
//            echo "<select id='seriales" . $id_producto . "-" . $cont . "' onchange='asigna_serial_codprop(\"seriales" . $id_producto . "-" . $cont . "\",\"sn\",\"cp\",\"".$id_producto. "-" . $cont ."\" );genera_otra_opcion(\"otra_opcion" . $id_producto . "-" . $cont . "\"," . $id_producto . ",1,$cont)'>";
//            echo "<option value='0'>Seleccione una opcion</option>";
//            for ($i = 0; $i < count($resultado_array); $i++) {
//                if($resultado_array[$i]!=" * SN: ")
//                    echo "<option value='" . $resultado_array[$i] . "'>" . $resultado_array[$i] . "</option>";
//            }
//            if ($tipo == "Ingreso")
//                echo "<option value='SN'>Adicionar nuevo Cod Propio y SN</option>";
//            echo "</select>";
//        } else {
//            if ($tipo == "Ingreso") {
//                echo "<select id='seriales" . $id_producto . "-" . $cont . "' onchange='asigna_serial_codprop(\"seriales" . $id_producto. "-" . $cont  . "\",\"sn\",\"cp\",\"".$id_producto. "-" . $cont ."\" );genera_otra_opcion(\"otra_opcion" . $id_producto . "-" . $cont . "\"," . $id_producto . ",1,$cont)'>";
//                echo "<option value='0'>Seleccione una opcion</option>";
//                echo "<option value='SN'>Adicionar nuevo Cod Propio y SN</option>";
//                echo "</select>";
//            } else {
//                echo "No se han encontrado SERIES debe realizar el ingreso inicialmente";
//            }
//        }
//    }

    function seriales_registradas_tipo_in() {
        $tipo = $this->input->post('tipo_requerido');
        $id_almacen = $this->input->post('almacen');
        $id_producto = $this->input->post('id_sp');
        $cont = $this->input->post('cont');

        // echo $id_producto;
        $resultado_array = $this->movimiento_almacen_model->seriales_registradas_existencia_almacen($id_almacen, $id_producto, $tipo);
        $codigo_autocomplete = "";
        if (count($resultado_array) > 0) {
            /*    echo "<select id='seriales" . $id_producto . "-" . $cont . "' 
             * onchange='asigna_serial_codprop(\"seriales" . $id_producto . "-" . $cont . "\",\"sn\",\"cp\",\"" . $id_producto . "-" . $cont . "\" );
             * genera_otra_opcion(\"otra_opcion" . $id_producto . "-" . $cont . "\"," . $id_producto . ",1,$cont)'>";
              echo "<option value='0'>Seleccione una opcion</option>";
              for ($i = 0; $i < count($resultado_array); $i++) {
              if ($resultado_array[$i] != " * SN: ")
              echo "<option value='" . $resultado_array[$i] . "'>" . $resultado_array[$i] . "</option>";
              }
              if ($tipo == "Ingreso")
              echo "<option value='SN'>Adicionar nuevo Cod Propio y SN</option>";
              echo "</select>"; */

            $lista = '';
            $sw = 1;
            for ($i = 0; $i < count($resultado_array); $i++) {
                if ($resultado_array[$i] != " * SN: ") {
                    if ($sw == 1) {
                        $lista.="'" . $resultado_array[$i] . "'";
                        $sw = 0;
                    }
                    else
                        $lista.=",'" . $resultado_array[$i] . "'";
                }
            }

            $codigo_autocomplete = '<div class="grid_6">'
                    . '<input type="text" class="input_redond_250" style="margin:0 0 0 0;" '
                    . 'value="" id="seriales' . $id_producto . "-" . $cont . '"'
                    . 'onchange="asigna_serial_codprop(\'seriales' . $id_producto . '-' . $cont . '\',\'sn\',\'cp\',\'' . $id_producto . '-' . $cont . '\' )" >'
                    . '<div class="nuevoCod milink" title="Nuevo Codigo Personal y Nro de Serie"'
                    . ' onclick="genera_otra_opcion(\'otra_opcion' . $id_producto . '-' . $cont . '\',' . $id_producto . ',1,' . $cont . ')" ></div>'
                    . '<script>$("#seriales' . $id_producto . "-" . $cont . '").autocomplete({source:[' . $lista . ']});</script> </div>';
            echo $codigo_autocomplete;
        } else {
            if ($tipo == "Ingreso") {
                echo "<select id='seriales" . $id_producto . "-" . $cont . "' onchange='asigna_serial_codprop(\"seriales" . $id_producto . "-" . $cont . "\",\"sn\",\"cp\",\"" . $id_producto . "-" . $cont . "\" );genera_otra_opcion(\"otra_opcion" . $id_producto . "-" . $cont . "\"," . $id_producto . ",1,$cont)'>";
                echo "<option value='0'>Seleccione una opcion</option>";
                echo "<option value='SN'>Adicionar nuevo Cod Propio y SN</option>";
                echo "</select>";
            } else {
                echo "No se han encontrado SERIES debe realizar el ingreso inicialmente";
            }
        }
    }

    function codigo_ope_sol_mat_ru($id_ma) {
        //echo $id_ma;
        $data['consul5'] = $this->movimiento_almacen_model->obt_per_encargado_ru($id_ma);
        $data["mensaje"] = "";
        $this->load->view('movimiento_almacen/cod_ope_view_retiro', $data);
    }

    function cambiar_estado_retiro() {
        //echo 'FUNCIONA';
        $estado = $this->input->post('estado');
        $id_mov_alm = $this->input->post('id_ma');
        $data['cambio'] = $this->movimiento_almacen_model->cambiar_estado_retiro($estado, $id_mov_alm);
    }

    function desde_otra_bd() {
        echo "entra a la funcion";

        $this->load->model("prueba_otra_bd");
        $this->prueba_otra_bd->lista_proveedores();
    }

    //adicionado 12/09/16


    function index_af($padre, $hijo) {
        $data['titulo'] = 'KARDEX Activos Fijos';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;
        $data['datos_item_hijo'] = $hijo;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'movimiento_almacen/listado_materiales_cod_ser_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
    function index_af_ingresos($padre, $hijo) {
        $data['titulo'] = 'KARDEX Activos Fijos';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;
        $data['datos_item_hijo'] = $hijo;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'movimiento_almacen/listado_materiales_cod_ser_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_lista_activos_fijos() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $ra = $this->movimiento_almacen_model->listar_buscar_materiales_cod_ser($b, $i, $c);
        $total_registros = $this->movimiento_almacen_model->listar_buscar_materiales_cod_ser_cantidad($b);
        $data['total_registros'] = $total_registros;
        $data['registros'] = $ra;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('movimiento_almacen/list_find_materiales_cod_serial_view', $data);
    }

////funcion agregada para copiar del ingreso a la salida

    function almacen_copia_ingreso_retiro($id_ar) {
        
        //echo "<br>***".$id_ar."***<br>";
        $this->load->model('usuario_model');
        $this->load->model('almacen_model');
        // $id_user = $this->input->post('id_personal');
        $data['personal_datos'] = $this->usuario_model->lista_usuarios_activos();
        //$data['busqueda_proy'] = $this->movimiento_almacen_model->busq_user_proy($id_user);
        $data['almacen_datos'] = $this->almacen_model->listar_almacen_responsable_almacen($this->session->userdata('id_admin'));
        $data['oficinas_datos'] = $this->almacen_model->lista_region_oficinas();

        $data['id_send_copi'] = $id_ar;
        $data['id_send'] = 0;
        //echo "el id enviado es ". $id_ar;
        if ($id_ar != 0) {
            $data['inf_retiro'] = $this->movimiento_almacen_model->obtener_mov_alm($id_ar); //utilizacion tabla mov.almacen
            $data['inf_detalle_retiro'] = $this->movimiento_almacen_model->obtener_detalle_movimiento1($id_ar);
        }
        $this->load->view('movimiento_almacen/nuevo_almacen_view_retiro_copia', $data);
    }

    //funcion que devuelde el comentario final del articulo comp tal 30/09/2016

    function obtener_comentario_articulo_serie() {
        $sn = $this->input->post('sn');
        $cp = $this->input->post('cp');
        //echo 'pasa';
        $comentario = $this->movimiento_almacen_model->obtener_comentario_articulo_serie($cp, $sn);
        echo $comentario;
    }
//funcion que copia informacion a un movimiento de tipo RETIRO TRASPASO
    
    function almacen_copia_ingreso_retiro_traspaso($id_ar) {
        
        //echo "<br>***".$id_ar."***<br>";
        $this->load->model('usuario_model');
        $this->load->model('almacen_model');
        // $id_user = $this->input->post('id_personal');
        $data['personal_datos'] = $this->usuario_model->lista_usuarios_activos();
        //$data['busqueda_proy'] = $this->movimiento_almacen_model->busq_user_proy($id_user);
        $data['almacen_datos'] = $this->almacen_model->listar_almacen_responsable_almacen($this->session->userdata('id_admin'));
        $data['oficinas_datos'] = $this->almacen_model->lista_region_oficinas();

        $data['id_send_copi'] = $id_ar;
        $data['id_send'] = 0;
        //echo "el id enviado es ". $id_ar;
        if ($id_ar != 0) {
            $data['inf_retiro'] = $this->movimiento_almacen_model->obtener_mov_alm($id_ar); //utilizacion tabla mov.almacen
            $data['inf_detalle_retiro'] = $this->movimiento_almacen_model->obtener_detalle_movimiento1($id_ar);
        }
        $this->load->view('movimiento_almacen/nuevo_almacen_view_retirotraspaso_copia', $data);
    }
    

}

