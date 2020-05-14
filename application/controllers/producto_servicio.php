<?php

/*
 * Producto servicio controlador que maneja los ABM y selecciones de producto yo servicios
 * and open the template in the editor.
 */

class producto_servicio extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('producto_servicio_model');
        $this->load->model('producto_servicio_m_model');
        $this->load->model('categoria_model');

        if ($this->auth->is_logged() == FALSE) {
 
            redirect(base_url('login'));
        }
    }

    //controlador producto_servicio
    function index($padre) {
        $data['titulo'] = 'Producto / Servicio';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
$data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre); 
        
        $data['vista_enviada'] = 'producto_servicio/producto_servicio_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_prod_serv() {

        $busqueda = $this->input->post('busqueda');
        $cant = $this->input->post('cant');
        $pag = $this->input->post('pag');
        $ini = ($pag * $cant) - $cant;
        $data['ind'] = $ini;
        $data['no_reg'] = $this->producto_servicio_model->cant_busqueda($busqueda);
        $data['mostrar'] = $cant;
        $data['pagina'] = $pag;


        $data['consulta'] = $this->producto_servicio_model->busqueda_prod_serv_p($busqueda, $cant, $ini);
        //almacena en un vector el stock disponible 
        // 
      
        $data['disponible'] = $this->producto_servicio_model->obtinene_stock_disponible($arreglo,$id_almacen);
        
        //
        
        
        $data['busqueda'] = $busqueda;
        $data['ids'] = $this->input->post('selecionados');
        $this->load->view('producto_servicio/resultado_busqueda_oventa_prefactura_view', $data);
    }
    
    

    function busqueda_lista_serv_prod() {

        //echo "funciona1";

        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $ov_pfs = $this->producto_servicio_m_model->listar_buscar_serv_pro($b, $i, $c);
        $total_registros = $this->producto_servicio_m_model->listar_buscar_serv_pro_cantidad($b);
        $data['total_registros'] = $total_registros;
        $data['registros'] = $ov_pfs;
        $detalles_registros = array();
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('producto_servicio/list_find_almacen_view', $data);
    }

   
    
    
    
    
    
    function busqueda_lista_detalle_serv() {
        $busqueda = $this->input->post('busqueda');
        $cant = $this->input->post('cant');
        $pag = $this->input->post('pag');
        $ini = ($pag * $cant) - $cant;
        $data['ind'] = $ini;
        $data['no_reg'] = $this->producto_servicio_m_model->listar_buscar_detalle_cantidad($busqueda);
        $data['mostrar'] = $cant;
        $data['pagina'] = $pag;
        $data['consulta'] = $this->producto_servicio_m_model->listar_buscar_detalle_serv($busqueda, $cant, $ini);
        $data['busqueda'] = $busqueda;
        $data['ids'] = $this->input->post('selecionados');
        $this->load->view('repuesto_herramienta/list_find_detalle_view', $data);
    }

    function nuevo_serv_prod($id_ser_pro) {

        //para llamar a categoria model
       // echo $id_ser_pro;
        $data['categoria'] = $this->categoria_model->listar_categoria();
        $data['producto_servi'] = $this->producto_servicio_m_model->listar_tipo();
        $data['unidad_medida'] = $this->producto_servicio_m_model->listar_unidad_medida();
        $data['d_serv_prod'] = $this->producto_servicio_m_model->obtener_serv_prod($id_ser_pro); //estoy aumentando
        $data['id_send'] = $id_ser_pro; //estoy cambiando id_ov_fp

        $this->load->view('producto_servicio/nuevo_serv_prod_view', $data);
    }

    function guardar_serv_pro() {
        //echo 'funciona2';
        $respuesta = $this->producto_servicio_m_model->guardar_serv_pro_nuevo();

        echo $respuesta;
    }

    function ver_serv_prod($id_serv_pro) {

        $data['cant_registro'] = $this->producto_servicio_m_model->obtener_detalle_serv_prod($id_serv_pro);

        $data['id_send'] = $id_serv_pro;
        $this->load->view('producto_servicio/mostrar_serv_prod_view', $data); //// arreglar
        //echo 'funciona maga';
    }

    function generar() {


        $data['generado'] = $this->producto_servicio_m_model->poner_cod_serv_prod();

        $this->load->view('producto_servicio/mostrar_serv_prod_view', $data); //// arreglar
        //echo 'funciona maga';
    }
    //made for ruben 
 function busqueda_prod_serv_tipo_grilla() {
        //echo'funcionaaaaaa';
        $busqueda = $this->input->post('busqueda');
        $cant = $this->input->post('cant');
        $pag = $this->input->post('pag');
        $ini = ($pag * $cant) - $cant;
        $data['ind'] = $ini;
        $data['no_reg'] = $this->producto_servicio_model->cant_busqueda($busqueda);
        $data['mostrar'] = $cant;
        $data['pagina'] = $pag;
       

        $data['consulta'] = $this->producto_servicio_model->busqueda_prod_serv_p($busqueda, $cant, $ini);
        $data['busqueda'] = $busqueda;
        $data['ids'] = $this->input->post('selecionados');
        $this->load->view('producto_servicio/resultado_busqueda_sol_mat_view', $data);
    }
    function busqueda_prod_serv_almacen() {
       //echo "entraaaaaas";
        $busqueda = $this->input->post('busqueda');
        $cant = $this->input->post('cant');
        $pag = $this->input->post('pag');
        $ini = ($pag * $cant) - $cant;
        $data['ind'] = $ini;
        $data['no_reg'] = $this->producto_servicio_model->cant_busqueda($busqueda);
        $data['mostrar'] = $cant;
        $data['pagina'] = $pag;
        $data['id_almacen'] = 1; //$this->input->post('id_almacen');//colocar el id del almacen acutal
        
        $data['consulta'] = $this->producto_servicio_model->busqueda_prod_serv_p($busqueda, $cant, $ini);
        $prod=$data['consulta'];
        $ps_array =array();
        
        foreach ($prod->result() as $reg )
        {
              $ps_array[]=$reg->id_serv_pro;
        }
        
        
        $data['stock_array'] = $this->producto_servicio_model->obtinene_stock_disponible($ps_array,$data['id_almacen'] ); 
        
        $data['busqueda'] = $busqueda;
        $data['ids'] = $this->input->post('selecionados');
        $this->load->view('producto_servicio/resultado_busqueda_producto_disponible_almacen_view', $data);
    }


}

?>
