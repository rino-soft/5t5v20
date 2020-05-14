<?php

/*
 * controlador que crea prefactura u orden de venta
 * ademas del detalle del mismo
 * @author Ruben
 */

class credenciales extends CI_Controller {

    function __construct() {
        
        parent::__construct();
       
        $this->load->model('menu_model');
        $this->load->model('nota_fiscal_model'); 
        $this->load->model('dosificaciones_model');
        //$this->load->library('Basicauth');
        // echo "<script>alert('comprobamos si el usuario está logueado');</script>";
        if ($this->auth->is_logged() == FALSE) {
            //echo "esta logueado";
            //echo "<script>alert('NO esta logueado');</script>";
            redirect(base_url('login'));
        }
        //  echo "<script>alert('esta logueado');</script>";
    }

    function index($padre=null, $hijo=null) {


       // echo "lega aqui";
        $data['titulo'] = 'Credenciales';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);

        //$clientes = $this->cliente_model->listar_clientes("");
        //$data['datos_cliente'] = $clientes;//para mostrar en la pantalla cambiar en clientes
        //$contactos_cliente = array();
        //foreach ($clientes as $cli) {
        //  $contactos_cliente[$cli->id_cliente] = $this->cliente_model->lista_contacto_cliente($cli->id_cliente);
        // para mostra en pantalla detalle de los modulos cambiar para contactos
        //}
        //$data['contactos_cliente'] = $contactos_cliente;


        $data['vista_enviada'] = 'credenciales/credenciales_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_lista_nota_fiscal() {
        $this->load->model('proyecto_model');
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $de = $this->input->post("desde");
        $ha = $this->input->post("hasta");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;

        $ov_pfs = $this->nota_fiscal_model->listar_buscar_nota_fiscal($b, $i, $c, $de, $ha);echo "llego hasta aqui ";
        $total_registros = $this->nota_fiscal_model->listar_buscar_nota_fiscal_cantidad($b, $de, $ha);

        $data['total_registros'] = $total_registros;
        $data['registros'] = $ov_pfs;
        //$detalles_registros = array();
        $proyectos_fact = array();
        $contrato_fact = array();
        foreach ($ov_pfs->result() as $reg) {
            $proyectos_fact[$reg->id_nf] = $this->proyecto_model->obtener_datos_proyecto($reg->id_proyecto);
            $contrato_fact[$reg->id_nf] = $this->proyecto_model->obtener_contrato_id($reg->id_contrato);
        }
        // $data['detalle_registros'] = $detalles_registros;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $data['proy_fac'] = $proyectos_fact;
        $data['cont_fac'] = $contrato_fact;
        
        
        $this->load->view('nota_fiscal/list_nota_fiscal_view', $data);
    }

    function credencial_nuevo($id_nf) {
        $this->load->model('cliente_model');
        if ($id_nf != 0) {
            $data['data_fac'] = $this->nota_fiscal_model->obtener_nota_fiscal($id_nf);
            $data['detalle_facOrg'] = $this->nota_fiscal_model->obtener_detalle_nota_fiscal($id_nf,'Original');
            $data['detalle_facDev'] = $this->nota_fiscal_model->obtener_detalle_nota_fiscal($id_nf,'devolucion');
        }

        $this->load->model('proyecto_model');
        $data['proyecto_resultado'] = $this->proyecto_model->seleccionar_proyecto_nombre();
        $data['lista_dosificacion'] = $this->dosificaciones_model->lista_dosificacion_activa('NOTA DE CRÉDITO - DÉBITO');
        $data['lista_clientes'] = $this->cliente_model->listar_clientes('');
        $data['id_send'] = $id_nf;

        $this->load->view('credenciales/credencial_new_view', $data);
    }
    function qr_masivo_credencial($codigo_cre)
    {
       $this->load->model('credencial_model');
       echo $this->credencial_model->qrmasivo($codigo_cre);
    }

    

    function ver_ovpf($id_ovpf) {


        $data['datos_ovpf'] = $this->oventa_prefactura_model->obtener_ovpf($id_ovpf);
        $data['detalle_ovpf'] = $this->oventa_prefactura_model->obtener_detalle_ovpf($id_ovpf);
        $data['$id_registro'] = $id_ovpf;
        $this->load->view('oventa_prefactura/ver_ovpf_view', $data);
    }

    function anular_factura_comentario() {

        echo $this->factura_venta_model->anular_factura($this->input->post('id_factura'));
    }

    function select_proyecto_cli($id_cliente, $id_select, $id_elemento) {
        $this->load->model('proyecto_model');
        $res = $this->proyecto_model->obtener_proyecto_cliente($id_cliente); // res devuelde la consulta
        //
        $codigo = "";
        if ($res->num_rows() > 0) {
            foreach ($res->result() as $r) {
                if ($id_select == $r->id_proyecto)
                    $codigo.="<option value='$r->id_proyecto' selected='selected'>$r->nombre</option>";
                else
                    $codigo.="<option value='$r->id_proyecto'>$r->nombre</option>";
            }
        }
        else {
            $codigo.="<option value='-1'>Cliente sin proyectos</option>";
        }
        $codigo = "<select id='$id_elemento'>" . $codigo . "</select>";
        echo $codigo;
    }

    function select_contrato_cliente($id_cliente) {
        $this->load->model('proyecto_model');
        $res = $this->proyecto_model->obtener_contrato_cliente($id_cliente);
        $codigo = "";
        if ($res->num_rows() > 0) {
            foreach ($res->result() as $r) {
                if ($id_select == $r->id_proyecto)
                    $codigo.="<option value='$r->id_proyecto' selected='selected'>$r->nombre</option>";
                else
                    $codigo.="<option value='$r->id_proyecto'>$r->nombre</option>";
            }
        }
        else {
            $codigo.="<option value='-1'>Cliente sin Contratos</option>";
        }
        $codigo = "<select id='$id_elemento'>" . $codigo . "</select>";
        echo $codigo;
    }

    function select_contrato_proy($id_proy, $id_select, $id_elemento) {
        $this->load->model('proyecto_model');
        $res = $this->proyecto_model->obtener_contrato_proyecto($id_proy);
        $codigo = "";
        if ($res->num_rows() > 0) {
            foreach ($res->result() as $r) {
                if ($id_select == $r->id_proyecto)
                    $codigo.="<option value='$r->id_proyecto' selected='selected'>$r->nombre</option>";
                else
                    $codigo.="<option value='$r->id_proyecto'>$r->nombre</option>";
            }
        }
        else {
            $codigo.="<option value='-1'>Cliente sin proyectos</option>";
        }
        $codigo = "<select id='$id_elemento'>" . $codigo . "</select>";
        echo $codigo;
    }

    function select_proyecto_contrato($id_proy, $id_select, $id_elemento) {
        $this->load->model('proyecto_model');
        $res = $this->proyecto_model->obtener_contrato_proyecto($id_proy);
        $codigo = "";
        if ($res->num_rows() > 0) {
            foreach ($res->result() as $r) {
                if ($id_select == $r->id_proyecto)
                    $codigo.="<option value='$r->id_proyecto' selected='selected'>$r->nombre</option>";
                else
                    $codigo.="<option value='$r->id_proyecto'>$r->nombre</option>";
            }
        }
        else {
            $codigo.="<option value='-1'>Cliente sin proyectos</option>";
        }
        $codigo = "<select id='$id_elemento'>" . $codigo . "</select>";
        echo $codigo;
    }

    function cert_cod_cont() {
        $this->load->model('codigo_control_model');
        echo "Certificacion ....<br>";

        $auto = array('1904004847976', '7004009317724', '1004002631348', '2904008255823', '2004008078126', '7004002487450', '2004008518280', '3004008087693', '4004005759382', '1004001809773');
        $numfa = array('651637', '419232', '392651', '834052', '488249', '597977', '658265', '976306', '167106', '404299');
        $nit = array('1479341', '2882052', '2975061', '2880017', '3268659', '1606078', '5360323', '1032994019', '2642735017', '1489250017');
        $fec = array('2007/05/10', '2008/03/13', '2008/12/25', '2007/03/02', '2007/12/06', '2007/10/19', '2007/11/29', '2007/05/27', '2008/11/29', '2007/12/04');
        $monto = array('59956', '5666', '32822', '23984', '76643', '9461', '39651', '61631', '49057', '34457,60');
        $llave = array('*TCic$hnLzBYEU@GURd*vYwT3gF}{M*$SJXg$2FkeiUzRrHa%nLTkR#+[QeYHSin', 'ffMf_%a_MVAe4]*TNNhJWFWr6AItH4-EXS4U9JL$%UvNs@G]LPE=zaPjqcI92S6s', 'hi$(WxneIWZGfCLNr+5}TfL]q3w-M6G@r3Q9V=ZSasL3JID(i6HxemFIjtur+=d_', 'b2D4%=m}Pe@vKRcKjGWC}{hwGBQ33+JIcAg29z+3Z+%A(_b8Js$z3*irCb6@n(E*', 'DDaAtHqctyZ+6-J3X{5HXzSFL7R+tZAk6pUk7_5Q@NGnCa4bcJ4[JAKXI*]Vqz8y', '2fY(upNXPq=E%Q%QY%7fBT{v*p(86Dw9_{N}NS4C57P%8SiWh(zvy4@+DL{y*5eF', 'HUh\Xj4wZ{29wsq(@dbhPsvdV\CQe*w$NLMg$sX7%w5g_\3(}sW$CBTjUuP{Tytw', '#fSF}C3%t4vsyx8Uv3=RYB+7kD=#}[8@AV5J$G[B_k\atMFZtGDXRYKYtE3_59$+', '(kRsmp=nX@Wh6G4peE_QbLz5={3zpwdY@=Yqi27J[G#SnkGidW[pJMLrfSaJTQ6W', 'nbkrbZLyJ]LBdjuUty7vpDeJ{7[M$Z#qGTqLgXci%Y6neHc)5C[5n)Yhfd{Y_AXY');

        for ($i = 0; $i <= 9; $i++) {
            /* $fecha=str_replace('/', '', $fec[$i]);
              $fecha="2003-10-05"; // El formato que te entrega MySQL es Y-m-d */
            $fecha = date("Ymd", strtotime($fec[$i]));
            $plata = round(str_replace(',', '.', $monto[$i]), 0);
            // echo "ciclo";
            $codigo = $this->codigo_control_model->generar_CodControl_parametros($auto[$i], $numfa[$i], $nit[$i], $fecha, $plata, $llave[$i]);
            echo ($i + 1) . " >>> " . $codigo . "<br>";
        }
    }
    function formulario_registro_pago($id_factura)
    {
        $data['info_fac']=$this->factura_venta_model->obtener_factura_venta($id_factura);
        $data['detalle_fac']=$this->factura_venta_model->obtener_detalle_factura_venta($id_factura);
     
        $this->load->view('factura_venta/formulario_factura_cobro',$data);
        
    }
    function registrar_cobro_factura()
    {
        
    }
    

}

?>
