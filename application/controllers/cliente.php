<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cliente
 *
 * @author RubenPayrumani
 */
class cliente extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('cliente_model');
       
        if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }

    //funcion Lista de clientes_contactos_ invita a la vista maestra de clientes
    function index($padre, $hijo) {
        $data['titulo'] = 'Clientes';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
       
        
        
        $clientes = $this->cliente_model->listar_clientes("");
        $data['datos_cliente'] = $clientes;//para mostrar en la pantalla cambiar en clientes
        $contactos_cliente = array();

        foreach ($clientes as $cli) {
           $contactos_cliente[$cli->id_cliente] = $this->cliente_model->lista_contacto_cliente($cli->id_cliente);
            // para mostra en pantalla detalle de los modulos cambiar para contactos
        }
        $data['contactos_cliente'] = $contactos_cliente;
         
        
        $data['vista_enviada'] = 'clientes/clientes_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
    //funciones de cliente
    function cliente_nuevo($id_cliente)
    {
        $data['d_cliente']=$this->cliente_model->obtener_cliente($id_cliente);
        $data['id_send']=$id_cliente;
        $this->load->view('clientes/nuevo_cliente_view',$data);
    }
    
    
    function guardar_cliente()
    {
        $respuesta=$this->cliente_model->guardar_cliente_nuevo();
        
        echo $respuesta;
    }
    
    
    
    
    
    //funciones de contacto
    function contacto_nuevo($id_cliente,$id_contacto)
    {   $data['d_cliente']=$this->cliente_model->obtener_cliente($id_cliente);
        $data['d_contacto']=$this->cliente_model->obtener_contacto($id_contacto);
        $data['l_contactos']=$this->cliente_model->lista_contacto_cliente($id_cliente);
        $this->load->view('clientes/nuevo_contacto_view',$data);
    }
    function guardar_contacto_cliente_nuevo()
    {
         $respuesta=$this->cliente_model->guardar_contacto_nuevo_cliente();
        echo $respuesta;
        
    }
     function busqueda_cliente_mini()
    {
        $nit =$this->input->post("nit");
        $nom_emp=$this->input->post("emp");
        $data['resultado']=$this->cliente_model->busqueda_cliente_mini($nit,$nom_emp);
        $this->load->view('clientes/res_client_view',$data);
        
    }
    
    function busqueda_lista_cliente()
    {
       $b=$this->input->post("buscar");
        $p=$this->input->post("pagina");
        $c=$this->input->post("cant");
        $i=($p*$c)-$c;
        $client=$this->cliente_model->listar_clientes_contacto($b,$i,$c);
        $total_client=$this->cliente_model->listar_clientes_contacto_cantidad($b);
        $data['total_registros']=$total_client;
        $data['datos_cliente']=$client;
        $data['mostrar_X']=$c;
        $data['pagina_actual']=$p;
        $data['busqueda']=$b;
        
        $contactos_cliente = array();

        foreach ($client->result() as $cli) {
           $contactos_cliente[$cli->id_cliente] = $this->cliente_model->lista_contacto_cliente($cli->id_cliente);
            // para mostra en pantalla detalle de los modulos cambiar para contactos
        }
        $data['contactos_cliente'] = $contactos_cliente;
         
        
        
        //echo 'funciona maga 1';
        $this->load->view('clientes/lista_busqueda_cliente_view', $data);
    }
    

}

?>
