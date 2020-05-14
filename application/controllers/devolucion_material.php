<?php

/*
 * Producto servicio controlador que maneja los ABM y selecciones de producto yo servicios
 * and open the template in the editor.
 */

class devolucion_material extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('devolucion_material_model'); // controlador categoria
        $this->load->model('movimiento_almacen_model');
        $this->load->model('asignaciones_personal_model');

        if ($this->auth->is_logged() == FALSE) {

            redirect(base_url('login'));
        }
    }

    //nueva vista devolucion material
    function index ($padre)
      {


      $data['titulo'] = 'Devolucion de Material';
      $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
      $data['datos_item_padre'] = $padre;
      $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
      $data['vista_enviada'] = 'devolucion_mat/devolucion_material_llegado_view';
      $this->load->view('Plantilla/Plantilla_vista', $data);

      } 
    function solicitud_devolucion_listado($id_mov_alm, $id_sol_dev) {
        //$id_mov_alm=77;
        // echo $id_mov_alm;
       $data['id_mov']=$id_mov_alm;
        
        if($id_sol_dev==0)
        {
        $data['registros1'] = $this->movimiento_almacen_model->ver_al_detalle($id_mov_alm);
        $data['registros_prod_alma'] = $this->devolucion_material_model->obtener_detalle_almacen_producto($id_mov_alm);
        //$data['registro_sol_dev'] = $this->devolucion_material_model->obtener_detalle_solicitud($id_sol_dev);
        $data['encargado'] = $this->devolucion_material_model->obtener_encargado_almacen();
        $data['id_sol_dev'] = $id_sol_dev;
        //$data['asignaciones2'] = $this->asignaciones_personal_model->obt_asignaciones2();
        }  else {
            
          //  echo'funciona';
        //$data['registros1'] = $this->devolucion_material_model->ver_al_detalle_solicitud($id_sol_dev);
        $data['registros1'] = $this->movimiento_almacen_model->ver_al_detalle($id_mov_alm);
        $data['registros_prod_alma'] = $this->devolucion_material_model->obtener_detalle_solicitud_enviada($id_sol_dev);
       //agregado de asignaciones....consultas p
        $data['asignaciones'] = $this->asignaciones_personal_model->obt_asignaciones();
      //  $data['asignaciones2'] = $this->asignaciones_personal_model->obt_asignaciones2();
        //////////////////////
        //$data['registro_sol_dev'] = $this->devolucion_material_model->obtener_detalle_solicitud($id_sol_dev);
        $data['encargado'] = $this->devolucion_material_model->obtener_encargado_almacen();
        $data['id_sol_dev'] = $id_sol_dev;  
        }        
        $this->load->view('devolucion_mat/vista_de_devolucion_view', $data);
    }

    function guardar_solicitud() {
     //   echo 'guadar solicitud';
      //  echo "<br>".$this->input->post('id_devolucion')."<br>";
        if ($this->input->post('id_devolucion') == 0) {
           // echo 'guardar';
            echo $this->devolucion_material_model->guardar_solicitud_primero();
        } else {
        //    echo 'editar';
            echo $this->devolucion_material_model->editar_solicitud_devolucion($this->input->post('id_devolucion'));
        }
    }

    /*function comparar_enviado() {
        $id_proy = 1;
        // $cod_user=1;
        $data['usuario'] = $this->devolucion_material_model->comparar_enviado_si($id_proy);
        $this->load->view('devolucion_mat/listado_devolucion_view', $data);
    }*/

    //estoy aumentando 21/04/15
    function ver_devolucion_material($id_mov_alm) {

        $data['cant_registro'] = $this->devolucion_material_model->obtener_detalle_devolucion($id_mov_alm);
        //$data['id_send'] = $$id_mov_alm;
        $this->load->view('devolucion_mat/mostrar_detalle_devolucion_view', $data); //// arreglar
        //echo 'funciona maga';
    }

    function cambiar_estado_devolucion() {
        //echo 'FUNCIONA';
        $estado = $this->input->post('estado');
        $id_sol_dev = $this->input->post('id_detalle_dev');
        $data['cambio'] = $this->devolucion_material_model->cambiar_estado($estado, $id_sol_dev);
    }
    //aumentado 27/04/2015
    function busqueda_lista_devoluciones()
    {
        //echo 'FUNCIONAAAA';
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
      $ov_pfs = $this->devolucion_material_model->listar_buscar_devolucion($b, $i, $c);
        $total_registros = $this->devolucion_material_model->listar_buscar_devolucion_cantidad($b);
        
      // $personal=  $this->devolucion_material_model->buscar_personal();
        $data['total_registros'] = $total_registros;
        $data['registros'] = $ov_pfs;
       // $detalles_registros = array();
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('devolucion_mat/list_find_devolucion_material_view', $data);
    }
    function ver_devolucion_material_enviado($id_sol_devolucion) {

        $data['cant_registro'] = $this->devolucion_material_model->obtener_detalle_devolucion_enviado($id_sol_devolucion);
        //$data['id_send'] = $$id_mov_alm;
        $this->load->view('devolucion_mat/mostrar_detalle_devolucion_enviado_view', $data); //// arreglar
        //echo 'funciona maga';
    }

}

?>
