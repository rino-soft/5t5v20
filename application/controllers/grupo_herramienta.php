<?php

/*
 * Producto servicio controlador que maneja los ABM y selecciones de producto yo servicios
 * and open the template in the editor.
 */

class grupo_herramienta extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
         $this->load->model('grupo_equi_rep_model');// controlador gupo equipo repuesto herramienta
      
        if ($this->auth->is_logged() == FALSE) {
           
            redirect(base_url('login'));
        }
        
    }
    //nueva vista nuevo_equipo_repuesto
   function index ($padre)
   {
       
       
       $data['titulo'] = 'Nuevo Equipo Repuesto';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre); 
        $data['vista_enviada'] = 'repuesto_herramienta/grupo_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
       
   }
      function guardar_detalle_prod()//no estoy usando aun nose cmo
    {
        $respuesta=$this->grupo_equi_rep_model->guardar_detalle_nuevo();
        
        echo $respuesta;
    }
      function nuevo_grupo($id_grupo)
    {
       
      $data['d_grupo']=$this->grupo_equi_rep_model->obtener_grupo($id_grupo); //estoy aumentando
      $data['id_send']=$id_grupo; //estoy ambiando id_ov_fp
     // $data['d_detalle']= $this->grupo_equi_rep_model->obtener_detalle($id_detalle);//aumentado para detalle //no estoy usando aun nose cmo
      //$data['id_send']=$id_detalle;                                                 //aumentado para detalle //no estoy usando aun nose cmo
      $this->load->view('repuesto_herramienta/nuevo_equi_rep_view',$data);
    }
    function guardar_grupo()
    {
        $respuesta=$this->grupo_equi_rep_model->guardar_grupo_nuevo();
        
        echo $respuesta;
    }
    function nuevo_grupo_save()
    {
        $this->grupo_equi_rep_model->save_nuevo_grupo();
    }
    function   busqueda_grupo_de_herramienta()
    {
       
        $b=$this->input->post("buscar");
        $p=$this->input->post("pagina");
        $c=$this->input->post("cant");
        $i=($p*$c)-$c;
        $ov_pfs=$this->grupo_equi_rep_model->listar_grupo_buscar($b,$i,$c);
        $total_registros=$this->grupo_equi_rep_model->listar_grupo_buscar_cantidad($b);
        $data['total_registros']=$total_registros;
        $data['registros_grupo']=$ov_pfs;
        $data['mostrar_X']=$c;
        $data['pagina_actual']=$p;
        $data['busqueda']=$b;
        //echo 'funciona maga 1';
        $this->load->view('repuesto_herramienta/list_find_grupo_view', $data);
      
       
    }
     function ver_detalle_grupo($id_grupo)
    {
       
        $data['cant_registro']=$this->grupo_equi_rep_model->obtener_detalle_grupo($id_grupo);
         
        $data['id_send']=$id_grupo;
        $this->load->view('repuesto_herramienta/mostrar_grupo_view',$data);//// arreglar
        
        //echo 'funciona maga';
    }
    

   

}

?>
