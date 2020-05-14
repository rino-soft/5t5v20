<?php
class perfiles extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('perfiles_model');

        if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }
//$padre,$hijo
    function index($padre) {
        $data['titulo'] = 'Perfiles';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'perfiles/perfiles_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
    function listar_perfiles() {

        //$id_u = $this->input->post('id_usuario');
        $ra = $this->perfiles_model->listar_p();
        $total_registros = $this->perfiles_model->listar_p_cantidad();
        $data['total_registros'] = $total_registros;
        $data['registros'] = $ra;

        $data['menu_superior'] = $this->menu_model->obtenerMenuPadre_todo(0); //obtiene los menus asignados a 0 // en este caso no hay usuari
        $rec_padres = $data['menu_superior'];
        $detalles_menu = array();
        $i = 0;
        foreach ($rec_padres as $recorrido) {
            $detalles_menu[$i] = $this->menu_model->obtereMenuDetallado_todo(0, $recorrido->id);
            $i++;
        }
        $data['menu_detallado'] = $detalles_menu;
        $data['consulta1'] = $this->perfiles_model->obt_perfil();
        $this->load->view('perfiles/list_find_perfiles_view', $data);
    }

    function obtener_detalle_perfiles() {
        $id_p = $this->input->post('id_pe');

        $res= $this->perfiles_model->obtener_detalle_perf($id_p);
        $cad="";
        foreach ($res->result() as $reg)
        {
            $cad.=$reg->id_menu.",";
        }
        echo($cad);
        /*
        $data['menu_superior'] = $this->menu_model->obtenerMenuPadre($id_p); //obtiene los menus asignados a 0 // en este caso no hay usuari
        $rec_padres = $data['menu_superior'];
        $detalles_menu = array();
        $i = 0;
        foreach ($rec_padres as $recorrido) {
            $detalles_menu[$i] = $this->menu_model->obtereMenuDetallado($id_p, $recorrido->id);
            $i++;
        }
        $data['menu_detallado'] = $detalles_menu;
        //$data['ids'] = $this->input->post('selecionados');
        $this->load->view('perfiles/detalle_perfiles', $data);*/
    }

    function guardar_nuevo_perfiles() {
        $data['consulta1'] = $this->perfiles_model->obt_perfiles();
        $this->load->view('perfiles/nuevo_perfil_view', $data);
    }
    function perfiles_menu_save() {
        $this->perfiles_model->save_perfiles();
    }
     function busqueda_lista_usuario() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        //$data['ind'] = $i;
        $ra = $this->perfiles_model->listar_buscar_u($b, $i, $c);
        $total_registros = $this->perfiles_model->listar_buscar_u_cantidad($b);
        $data['total_registros'] = $ra->num_rows();
        $data['registros_usuarios'] = $ra;
        $data['registros_asignacion_usuarios'] =$this-> perfiles_model->listar_asignacion_usuario();
        $data['mostrar_u'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $data['ids_u'] = $this->input->post("selecionados");
        $this->load->view('perfiles/list_find_user_view', $data);
    }
    function perfiles_asignar_permiso_save(){
        $this->perfiles_model->save_asignar_perfiles();
    }

//nueva funcion implementada en RINO_P1_v1 // lista los menus y los padres en un formaulario segun la base de datos y buscando los controles tambien
    function form_asigna_perfiles($id_usuario)
    {	//echo "ingresa a la funcion del controlador";
         //$id_u = $this->input->post('id_usuario');
        $data['menu_superior'] = $this->menu_model->obtenerMenuPadre_todo(0); //obtiene los menus asignados a 0 // en este caso no hay usuari
        $rec_padres = $data['menu_superior'];
        $this->load->model('usuario_model');
        $data['d_usuario']=  $this->usuario_model->obtener_user($id_usuario);
		
        $detalles_menu = array(); 
        $data['men_con_sel']=  $this->perfiles_model->obtener_permisos($id_usuario);
        $data['lista_perfiles']=$this->perfiles_model->obt_perfil();
        $i = 0;
		$d=array();
		//echo "ingresa a la funcion del controlador";
        foreach ($rec_padres as $recorrido) {
            $men=$detalles_menu[$i][0] = $this->menu_model->obtereMenuDetallado_todo(0, $recorrido->id);
            
            foreach ($men as $m)
            {
                $d[$m->id]=$this->menu_model->listar_controles_menu($m->id);
            }
            $detalles_menu[$i][1]=$d;
            $i++;
        }
		//echo "ingresa a la funcion del controlador";
        $data['menu_detallado'] = $detalles_menu;
       /// echo "llego a antes de la vista";
        $this->load->view('permisos/form_permiso_view', $data);
    }
    
    function obtener_lista_controles($id_menu)
    {
     $data['controles']=$this->menu_model->listar_controles_menu($id_menu);
     $this->load->view('permisos/controles_menu_result_view', $data);
    }
    
    function guardar_permisos_usuario()
    {
        $this->perfiles_model->save_menus_control_user();
    }
   
	function obtener_perfil($id_perfil)
	{
		$perfil=$this->perfiles_model->obtener_perfil_id($id_perfil);
		echo $perfil->menus."|".$perfil->controles;
	}

    

}

?>
