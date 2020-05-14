<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dosificaciones
 *
 * @author POMA RIVERO
 */
class dosificaciones extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('dosificaciones_model');

        if ($this->auth->is_logged() == FALSE) {

            redirect(base_url('login'));
        }
       
    }

    function index($padre, $hijo) 
    {
        $data['titulo'] = 'Dosificacion';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        $data['vista_enviada'] = 'oventa_prefactura/dosificacion_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
    
    function   busqueda_de_dosificaciones()
    {
       
        $b=$this->input->post("buscar");
        $p=$this->input->post("pagina");
        $c=$this->input->post("cant");
        $i=($p*$c)-$c;
        $ov_pfs=$this->dosificaciones_model->listar_dosificacion_buscar($b,$i,$c);
        $total_registros=$this->dosificaciones_model->listar_dosificacion_buscar_cantidad($b);
        $data['total_registros']=$total_registros;
        $data['registros']=$ov_pfs;
        $data['mostrar_X']=$c;
        $data['pagina_actual']=$p;
        $data['busqueda']=$b;
        //echo 'funciona maga 1';
        $this->load->view('oventa_prefactura/list_find_dosificacion_view', $data);
      
       
    }
    
    
    function nueva_dosificacion($id_dosificacion){
        //$id_dosificacion=3;
       // echo 'id'.$id_dosificacion;
       //if($id_dosificacion!=0){
              $data['d_dosificacion']=$this->dosificaciones_model->obtener_dosificaciones($id_dosificacion);
        
       //}
        $data['id_dosi']=$id_dosificacion;
        //echo 'pruebaaaaa_cristian'.$id_dosi;
        $this->load->view('oventa_prefactura/nueva_dosificacion_view',$data);
                
    }
    function guardar_nueva_dosificacion(){
         $respuesta=$this->dosificaciones_model->guardar_datos_dosificaciones();      
        echo $respuesta;
    }
     
}