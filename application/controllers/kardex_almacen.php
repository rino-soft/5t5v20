<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kardex_almacen
 *
 * @author COMPUTER
 */
class kardex_almacen extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("menu_model");
        $this->load->model("almacen_model");
        $this->load->model("categoria_model");
        $this->load->model("kardex_almacen_model");
        $this->load->model("producto_servicio_model");
        $this->load->model("producto_servicio_m_model");
        if ($this->auth->is_logged() == FALSE) {

            redirect(base_url('login'));
        }
    }

    function index($padre, $hijo) {
        $data['titulo'] = 'Kardex almacen';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'kardex_almacen/kardex_almacen_view';
        $data['almacen_datos'] = $this->almacen_model->listar_almacen_responsable_almacen($this->session->userdata('id_admin'));
        $data['categoria'] = $this->categoria_model->listar_categoria();
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_producto_kardex_almacen() {
        $b = $this->input->post("buscar");
        $a = $this->input->post("almacen");
        $cat = $this->input->post("categoria");
        $cant = $this->input->post("cant");
        $pag = $this->input->post("pagina");
        $ini = ($pag * $cant) - $cant;
        $data['pagina_actual']=$pag;
        $data["mostrar_X"]=$cant;
        /*  $data['resultado'] = $this->kardex_almacen_model->busqueda_producto_kardex_almacen();
          $data['res_cant'] = $this->kardex_almacen_model->busqueda_producto_kardex_almacen_cantidad();
         */
        
        
        $prod_consulta = $data["registros"] = $this->producto_servicio_model->busqueda_prod_serv_c_categoria($b, $cant, $ini, $cat);
        $data["total_registros"] = $this->producto_servicio_model->busqueda_prod_serv_c_categoria_cant($b, $cat);
        $saldos = array();
        if ($a == 0) {
            $almace = $this->almacen_model->listar_almacen_responsable_almacen($this->session->userdata("id_admin"));
        }
        else{
            $almace=$this->almacen_model->obtenen_almacen($a);
        }
            
        foreach ($prod_consulta->result() as $registro) {
            if ($a == 0) {
                $alm_cant = array();
               // echo "numero de filas ".$almace->num_rows();
                foreach ($almace->result() as $r) {
                    $alm_cant[$r->id_almacen] = $this->producto_servicio_model->obtinene_stock_disponible_individual($registro->id_serv_pro, $r->id_almacen);
                                 
               }
               
                $saldos[$registro->id_serv_pro] = $alm_cant;
               
             
            } else {
                $saldos[$registro->id_serv_pro] = $this->producto_servicio_model->obtinene_stock_disponible_individual($registro->id_serv_pro, $a);
            }
        }
        $data["saldos"] = $saldos;
        $data["almacen_sel"]=$a;
        $data["datos_almacen"]=$almace;
        //obtinene_stock_disponible_individual($id, $id_almacen)
        $this->load->view("kardex_almacen/list_find_kardex_almacen",$data);
    }
    
    function ver_kardex_producto_almacen_detalle($id_producto,$almacen)
    {
        
        $data["datos_articulo"]=$this->producto_servicio_m_model->obtener_serv_prod($id_producto);//devuelbe un row
        $data["datos_almacen"]=$this->almacen_model->obtenen_almacen($almacen);
        $data['kardex_inf']=$this->kardex_almacen_model->lista_kardex_producto_almacen($id_producto,$almacen);//devuelbe una consulta
        $this->load->view("kardex_almacen/kardex_producto_almacen_view",$data);
                
    }

}

?>
