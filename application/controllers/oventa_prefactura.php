<?php

/*
 * controlador que crea prefactura u orden de venta
 * ademas del detalle del mismo
 * @author Ruben
 */

class oventa_prefactura extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('oventa_prefactura_model');
        //$this->load->library('Basicauth');
        // echo "<script>alert('comprobamos si el usuario está logueado');</script>";
        if ($this->auth->is_logged() == FALSE) {
            //echo "esta logueado";
            //echo "<script>alert('NO esta logueado');</script>";
            redirect(base_url('login'));
        }
        //  echo "<script>alert('esta logueado');</script>";
    }

    function index($padre, $hijo) {
        $data['titulo'] = 'Orden de Venta/Pre-Factura';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre(0); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado(0, $padre);



        //$clientes = $this->cliente_model->listar_clientes("");
        //$data['datos_cliente'] = $clientes;//para mostrar en la pantalla cambiar en clientes
        //$contactos_cliente = array();
        //foreach ($clientes as $cli) {
        //  $contactos_cliente[$cli->id_cliente] = $this->cliente_model->lista_contacto_cliente($cli->id_cliente);
        // para mostra en pantalla detalle de los modulos cambiar para contactos
        //}
        //$data['contactos_cliente'] = $contactos_cliente;


        $data['vista_enviada'] = 'oventa_prefactura/oventa_prefactura_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_lista_pf_ov() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;

        $ov_pfs = $this->oventa_prefactura_model->listar_buscar_ov_pf($b, $i, $c);
        $total_registros = $this->oventa_prefactura_model->listar_buscar_ov_pf_cantidad($b);

        $data['total_registros'] = $total_registros;
        $data['registros'] = $ov_pfs;
        $detalles_registros = array();
        foreach ($ov_pfs->result() as $reg) {
            $detalles_registros[$reg->id_ovpf] = $this->oventa_prefactura_model->obtener_detalle_ovpf($reg->id_ovpf);
        }
        $data['detalle_registros'] = $detalles_registros;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('oventa_prefactura/list_find_ov_pf_view', $data);
    }

    function ov_pf_nuevo($id_ov_fp) {
        if ($id_ov_fp != 0) {
            $data['data_ov_pf'] = $this->oventa_prefactura_model->obtener_ovpf($id_ov_fp);
            $data['detalle_ov_pf'] = $this->oventa_prefactura_model->obtener_detalle_ovpf($id_ov_fp);
        }

        $data['id_send'] = $id_ov_fp;
        
        $this->load->view('oventa_prefactura/oventa_prefac_new_view', $data);
        
    }

    function ov_pf_save() {
        $data["id"] = $this->oventa_prefactura_model->save_oventa_prefactura();
        if ($data["id"] == 0) {
            $data["mensaje"] = "Se ha producido un error en el registro , consulte con el Administrador del sistema";
            $data["estilo"] = "Error";
        } else {
            $data["mensaje"] = "El registro fue registrado , Exitosamente!!";
            $data["estilo"] = "Ok";
        }
        

        $this->load->view("oventa_prefactura/ov_pf_mensajes", $data);
    }

    function ver_ovpf($id_ovpf) {
        $data['datos_ovpf'] = $this->oventa_prefactura_model->obtener_ovpf($id_ovpf);
        $data['detalle_ovpf'] = $this->oventa_prefactura_model->obtener_detalle_ovpf($id_ovpf);
        $data['$id_registro'] = $id_ovpf;
        $this->load->view('oventa_prefactura/ver_ovpf_view', $data);
    }

}

?>
