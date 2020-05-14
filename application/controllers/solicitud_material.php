<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of solicitud_material
 *
 * @author COMPUTER
 */
class solicitud_material extends CI_Controller {

    public $selected = "";

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('almacen_model');
        $this->load->model('solicitud_material_model');
        $this->load->model('usuario_model');
        $this->load->model('detalle_mih_model');
        $this->load->model('producto_servicio_model');
        $this->load->model('movimiento_almacen_model');


        if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }
//$padre,$hijo
    function index($padre) {
        $data['titulo'] = 'Solicitud Material';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'solicitud_material/solicitud_material_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
    function obt_solicitud_mat_estado() {
        $data['consul1'] = $this->solicitud_material_model->obt_estado();
        $this->load->view('solicitud_material/list_solicitud_mat_view', $data);
    }
    function entregar_sol_mat($id_sm, $id_ma) {
        $this->load->model('proyecto_model');
        $data['id_sm'] = $id_sm;
        $data['id_ma'] = $id_ma;
        $data['consul3'] = $this->almacen_model->listar_almacen_responsable_almacen($this->session->userdata('id_admin'));
        if ($id_ma == 0) {
            //echo "hola mundo ma=0";
            $data['consul2'] = $this->solicitud_material_model->obt_sol_mat($id_sm);//devuelve consulta 
            $data['consul4'] = $this->usuario_model->obt_user_encargado($data['consul2']->row()->id_user_encargado);
            $data['detalle'] = $this->solicitud_material_model->obtener_detalle_sol_mat($id_sm);
            $data['movimiento2'] = $this->solicitud_material_model->obtener_nuevo_mov1();
           
       } else {
           
            $data['consul2'] = $this->solicitud_material_model->obt_sol_mat($id_sm);
            $data['detallesm'] = $this->solicitud_material_model->obtener_detalle_sol_mat($id_sm);
            $data['movimiento2'] = $this->solicitud_material_model->obtener_nuevo_mov1();
            $data['mov_alm']=  $this->movimiento_almacen_model->obtener_mov_alm($id_ma);//devuelve un ROW 
            $data['proy']=$this->proyecto_model->obtener_datos_proyecto($data['mov_alm']->id_proyecto);
            $data['detalle'] = $this->movimiento_almacen_model->obtener_id_mov_alm($id_ma); 
            
            $data['consul4'] = $this->usuario_model->obt_user_encargado($data['mov_alm']->id_user_er);// obtiene datos usuario encargado de material
         
        }
        $this->load->view('solicitud_material/nuevo_solicitud_material_view', $data);
        // echo "antes de la vista";
    }

    function ver_lista_sol_mat_detalle() {

        $id_mov = $this->input->post('id_mov');
        $data['id_send'] = $id_mov;
        $this->load->view('solicitud_material/adicionar_solicitud_material_view', $data);
    }

    function busqueda_lista_art2() {
        // echo  '';
        $busqueda = $this->input->post('busqueda');
        $cant = $this->input->post('cant');
        $pag = $this->input->post('pag');
        $ini = ($pag * $cant) - $cant;
        $data['ind'] = $ini;
        $data['no_reg'] = $this->producto_servicio_model->cant_busqueda($busqueda);
        $data['mostrar'] = $cant;
        $data['pagina'] = $pag;


        $data['consulta_art'] = $this->producto_servicio_model->busqueda_prod_serv_p($busqueda, $cant, $ini);
        $data['busqueda'] = $busqueda;
        $data['ids'] = $this->input->post('selecionados');

        $this->load->view('solicitud_material/articulo_view2', $data);
    }

    function sol_mat_save() {
        $this->solicitud_material_model->save_sol_mat();
    }

    function sol_mat_entregar() {

        $this->solicitud_material_model->entregar_sol_mat();
        $this->load->view('solicitud_material/articulo_view2', $data);
    }

    function codigo_ope_sol_mat($id_sm) {
                                                                                                                                                                                                                                                   
        $data['consul5'] = $this->solicitud_material_model->obt_per_encargado($id_sm);
        $data["mensaje"] = "";
        $this->load->view('solicitud_material/cod_ope_view', $data);
    }

    function codigo_ope_sol_ma() {
        $cope = $this->input->post('cod_oper');
        $cuse = $this->input->post('cod_user');
        $tmov = $this->input->post('tipo_mov');

        $data['consul5'] = $this->solicitud_material_model->obt_per_encargado1($cuse);
        echo ('mensaje' . $this->solicitud_material_model->codigo_sol_mat($cope, $cuse));

        $this->load->view('solicitud_material/cod_ope_view', $data);
    }

    function index_r($padre, $hijo) {
        $data['titulo'] = 'Mis Solicitudes de material';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        ;
        $data['vista_enviada'] = 'solicitud_material/lista_solicitud_material_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function solicitudes_enviadas($padre, $hijo) {
        $data['titulo'] = 'Solicitudes de material recibidas';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'solicitud_material/lista_solicitud_material_enviada_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_lista_sol_mat() {

        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;

        $sol_mats = $this->solicitud_material_model->listar_sol_mats_user($b, $i, $c);
        $total_registros = $this->solicitud_material_model->listar_sol_mats_user_cantidad($b);

        $data['total_registros'] = $total_registros;
        $data['registros'] = $sol_mats;

        /* $detalles_registros = array();
          foreach ($ov_pfs->result() as $reg) {
          $detalles_registros[$reg->id_ovpf] = $this->oventa_prefactura_model->obtener_detalle_ovpf($reg->id_ovpf);
          } */
        //$data['detalle_registros'] = $detalles_registros;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('solicitud_material/busqueda_lista_sol_mat_view', $data);
    }

    function busqueda_lista_sol_mat_enviada() {

        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;

        $sol_mats = $this->solicitud_material_model->listar_sol_mats_user_enviada($b, $i, $c);
        $total_registros = $this->solicitud_material_model->listar_sol_mats_user_cantidad_enviada($b);
        $arrayuda = array();
        $i = 0;
        foreach ($sol_mats->result() as $in) {
            $arrayuda[$in->id_solicitud_mat] = $this->movimiento_almacen_model->obtenet_id_ma($in->id_solicitud_mat, "Solicitud_material");
        }
        $data['ids_movs'] = $arrayuda;
        $data['total_registros'] = $total_registros;
        $data['registros'] = $sol_mats;

        /* $detalles_registros = array();
          foreach ($ov_pfs->result() as $reg) {
          $detalles_registros[$reg->id_ovpf] = $this->oventa_prefactura_model->obtener_detalle_ovpf($reg->id_ovpf);
          } */
        //$data['detalle_registros'] = $detalles_registros;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('solicitud_material/busqueda_lista_sol_mat_enviado_view', $data);
    }

    function sol_mat_add_mod($id_sol_mat) {
        $this->load->model('devolucion_material_model');
        if ($id_sol_mat != 0) {
            //echo "aun falta para la edicion";
            //obtiene datos solmat y su detalle
            $data['data_sol_mat'] = $this->solicitud_material_model->obt_sol_mat($id_sol_mat)->row();
            $data['detalle_sol_mat'] = $this->solicitud_material_model->obtener_detalle_sol_mat($id_sol_mat);
        }
        //obtiene informacion de proyectos del dueño de la sesion
        $data['proyectos_res'] = $this->usuario_model->obtProyectoUsuario($this->session->userdata('id_admin'));
        //obtiene dependientes del dueño de la sesion dependiendo del pryecto
        // $data['dependientes']=  $this->usuario_model->obtiene_ependientes_usuarioX_PHP($this->session->userdata('id_admin'));
        $data['enviar_a'] = $this->devolucion_material_model->obtener_encargado_almacen();
        $data['id_send'] = $id_sol_mat;
        $this->load->view('solicitud_material/form_sol_mat_add_mod_view', $data);
    }

    function guardar_sol_mat() {
        echo $this->solicitud_material_model->guardar_solmat();
    }

    function cambiar_estado_sol_mat() {
        $e = $this->input->post('estado');
        $id_sm = $this->input->post('id_sol_mat');

        echo $this->solicitud_material_model->cambiar_estado_sol_mat($id_sm, $e);
    }

    function cambiar_estado_sm() {
        //echo 'FUNCIONA';
        $estado = $this->input->post('estado');
        $id_mov_alm = $this->input->post('id_ma');
        $data['cambio'] = $this->solicitud_material_model->cambiar_estado_solicitud($estado, $id_mov_alm);
    }
    function guardar_solicitud_ma() {
     //   echo 'guadar solicitud';
      //  echo "<br>".$this->input->post('id_devolucion')."<br>";
        if ($this->input->post('id_mov_almacen') == 0) {
           // echo 'guardar';
            echo $this->solicitud_material_model->save_sol_mat();
        } else {
        //    echo 'editar';
            echo $this->solicitud_material_model->editar_solicitud_material($this->input->post('id_mov_almacen'));
        }
    }
    
}

?>
