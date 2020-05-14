<?php

class grupo_de_herramienta_nuevo extends CI_Controller {

    

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('grupo_equi_rep_model');
             if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }
//$padre,$hijo
    function index($padre) {
        $data['titulo'] = 'Grupo de Herramienta';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'repuesto_herramienta/vista_principal_listado_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
       
    function nuevo_grupo($id_grupo)
    {
            //echo 'funciona';
       
      $data['d_grupo']=$this->grupo_equi_rep_model->obtener_grupo_editado($id_grupo); 
      $data['id_send2']=$id_grupo;                           
      $this->load->view('repuesto_herramienta/nuevo_grupo_editado_view',$data);
    }
    function guardar_grupo_editado()
    {
        echo 'funciona';
           $respuesta=$this->grupo_equi_rep_model->guardar_grupo_editado_m();
        echo $respuesta;
    }
    function   busqueda_grupo_de_herramienta()
    {
       
        $b=$this->input->post("buscar");
        $p=$this->input->post("pagina");
        $c=$this->input->post("cant");
        $i=($p*$c)-$c;
        $ov_pfs=$this->grupo_equi_rep_model-> listar_grupo_buscar_detalle_serv($b,$i,$c);
        $total_registros=$this->grupo_equi_rep_model->listar_grupo_buscar_detalle_cantidad($b);
        $data['total_registros']=$total_registros;
        $data['registros_grupo']=$ov_pfs;
        $data['mostrar_X']=$c;
        $data['pagina_actual']=$p;
        $data['busqueda']=$b;
        //echo 'funciona maga 1';
        $this->load->view('repuesto_herramienta/list_find_grupo_editado_view', $data);
      
    }
  
  }

?>
