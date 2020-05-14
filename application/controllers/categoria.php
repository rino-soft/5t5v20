<?php

/*
 * Producto servicio controlador que maneja los ABM y selecciones de producto yo servicios
 * and open the template in the editor.
 */

class categoria extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('categoria_model');// controlador categoria
      
        if ($this->auth->is_logged() == FALSE) {
           
            redirect(base_url('login'));
        }
        
    }
    //nueva vista categoria serv prod
   function index ($padre)
   {
       
       
       $data['titulo'] = 'Categoria Servicio / Producto';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre); 
        $data['vista_enviada'] = 'categoria/categoria_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
       
   }
   function   busqueda_categoria_lista_detalle_serv()
    {
       
        $b=$this->input->post("buscar");
        $p=$this->input->post("pagina");
        $c=$this->input->post("cant");
        $i=($p*$c)-$c;
        $ov_pfs=$this->categoria_model->listar_cate_buscar_detalle_serv($b,$i,$c);
        $total_registros=$this->categoria_model->listar_cate_buscar_detalle_cantidad($b);
        $data['total_registros']=$total_registros;
        $data['registros1']=$ov_pfs;
        $data['mostrar_X']=$c;
        $data['pagina_actual']=$p;
        $data['busqueda']=$b;
        //echo 'funciona maga 1';
        $this->load->view('categoria/list_find_categoria_view', $data);
      
       
    }
     function nueva_categoria($id_categoria)
    {
       
      $data['d_categoria']=$this->categoria_model->obtener_categoria($id_categoria); //estoy aumentando
       $data['id_send']=$id_categoria; //estoy cambiando id_ov_fp
       $this->load->view('categoria/nuevo_categoria_view',$data);
    }
     function guardar_categoria()
    {
        $respuesta=$this->categoria_model->guardar_categoria_nuevo();
        
        echo $respuesta;
    }
     function obtener_codigo_generado()
    {
        
        $this->load->model('categoria_model');
      
        echo $this->categoria_model->obtener_cod_gen($this->input->post('id_cat'));
    }
    
     //funcion agregada para la obtencion de subcategorias 12/10/2016

    function obtener_subcategoria_lista()
    {
        $id_categoria=$this->input->post('subcategoria');
        $subcategoria=$this->categoria_model->obtener_subcategorias_producto_servicio($id_categoria);
        $codigo="";
        foreach ($subcategoria->result() as $subcat)
        {
            $codigo.="<option value='".$subcat->id_subcategoria."' title='".$subcat->descripcion."'>".$subcat->nombre."</option>";
        }
        if($codigo=="")
            $codigo="<option value='0' >Esta categoria no tiene subcategorias</option>";
        echo $codigo;        
                
    }

   

}

?>
