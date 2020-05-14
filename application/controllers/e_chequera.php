<?php

/*
 * controlador que crea prefactura u orden de venta
 * ademas del detalle del mismo
 * @author Ruben
 */

class e_chequera extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('e_chequera_model');
        //$this->load->library('Basicauth');
        // echo "<script>alert('comprobamos si el usuario está logueado');</script>";
        if ($this->auth->is_logged() == FALSE) {
            //echo "esta logueado";
            //echo "<script>alert('NO esta logueado');</script>";
            redirect(base_url('login'));
        }
        //  echo "<script>alert('esta logueado');</script>";
    }

    ////************************** NUEVO *************************************//

    function obtenersolpagocheque() {
        $proveedore = $this->e_chequera_model->obtener_prov_solpago($this->input->post('buscar'));
        $cheques = array();
        $sp = "";
        $sps = "";

        $montos = "";
        $estado = "";
        $montocheque = 0;
        $comentario = "";
        $proveedor = "";
        $dirigido = "";


        foreach ($proveedore->result() as $p) {
            $datsp = $this->e_chequera_model->obtener_solpago_prov($this->input->post('buscar'), $p->idproveedor);
            $swagrupado = 0;
            foreach ($datsp->result() as $datps) {
                if ($this->input->post("agrupar") == "si") {
                    if ($swagrupado == 1) {
                        $sp.= "_";
                        $montos.= "|";
                        $estado.= "|";
                        $comentario.="|\r\n";
                    }
                    $swagrupado = 1;
                    $sp.=$datps->id;
                    $montos.=$datps->monto;
                    $montocheque+=$datps->monto;
                    $estado.=$datps->estado;
                    $comentario.="SOL.PAGO " . $datps->id . " :" . $datps->concepto;
                    $proveedor = $datps->nomprov;


                    $dirigido = $datps->nombre_banco . " Cta:" . $datps->cuenta_bancaria;
                    if ($datps->tipo_pago_prov == 1)
                        $dirigido = $datps->nombre_para_cheque;
                } else {
                    $sps.=$datps->id . "*";
                    $dirigido = $datps->nombre_banco . " Cta:" . $datps->cuenta_bancaria;
                    if ($datps->tipo_pago_prov == 1)
                        $dirigido = $datps->nombre_para_cheque;
                    $cheques[$datps->id] = array($datps->id, $datps->monto, $datps->monto, "SOL.PAGO " . $datps->id . ":" . $datps->concepto, $datps->estado, $datps->nomprov, $dirigido);
                }
            }
            if ($this->input->post("agrupar") == "si") {

                $cheques[$sp] = array($sp, $montos, $montocheque, $comentario, $estado, $proveedor, $dirigido);
                $sps.=$sp . "*";

                $sp = "";
                $montos = "";
                $estado = "";
                $montocheque = 0;
                $comentario = "";
                $proveedor = "";
                $dirigido = "";
            }
        }
        $data["datos_cheques"] = $cheques;
        $data["solpagos"] = $sps;


        // $data['d_solpago'] = $this->e_chequera_model->obtener_solpago_para_cheque($this->input->post('buscar'));
        $data["inicial"] = $this->input->post("inicial_cheque");
        $data["fecha_cheque"] = $this->input->post("fecha_todos");
        $comp_reg = explode("*", $this->input->post("comprobantes"));
        $comprobantes = array();
        for ($i = 0; $i < count($comp_reg); $i++) {
            if ($comp_reg[$i] != "") {
                $reg_comp = explode("|", $comp_reg[$i]);
                $comprobantes[$reg_comp[0]] = $reg_comp[1];
            }
        }
        $data["comprobantes"] = $comprobantes;

        $this->load->view("chequera/solpagocheque_view", $data);
    }

    function registrar_cheques_varios() {

        $respuesta = $this->e_chequera_model->registrar_cheques_varios();
        echo $respuesta;
    }

    function obtenerFondosRendircheque() {
        $usuarios = $this->e_chequera_model->obtener_user_fr($this->input->post('buscar'));
        $cheques = array();
        $sp = "";
        $sps = "";

        $montos = "";
        $estado = "";
        $montocheque = 0;
        $comentario = "";
        $proveedor = "";
        $dirigido = "";


        foreach ($usuarios->result() as $u) {
            $datsp = $this->e_chequera_model->obtener_fr_user($this->input->post('buscar'), $u->id_usuario);
            $swagrupado = 0;
            foreach ($datsp->result() as $datps) {
                if ($this->input->post("agrupar") == "si") {
                    if ($swagrupado == 1) {
                        $sp.= "_";
                        $montos.= "|";
                        $estado.= "|";
                        $comentario.="|\r\n";
                    }
                    $swagrupado = 1;
                    $sp.=$datps->id_sol_frendir;
                    $montos.=$datps->monto;
                    $montocheque+=$datps->monto;
                    $estado.=$datps->estado;
                    $comentario.="SOL.FONDOS A RENDIR :" . $datps->id_sol_frendir . " :" . $datps->comentario_global;
                    $proveedor = $datps->nomuser;


                    $dirigido = $datps->banco . " Cta:" . $datps->cuenta;
                    //if ($datps->tipo_pago_prov == 1)
                    //  $dirigido = $datps->nombre_para_cheque;
                } else {
                    $sps.=$datps->id_sol_frendir . "*";
                    $dirigido = $datps->banco . " Cta:" . $datps->cuenta;
                    //if ($datps->tipo_pago_prov == 1)
                    //  $dirigido = $datps->nombre_para_cheque;
                    $cheques[$datps->id_sol_frendir] = array($datps->id_sol_frendir, $datps->monto, $datps->monto, "SOL.FONDOS A RENDIR :" . $datps->id_sol_frendir . " :" . $datps->comentario_global, $datps->estado, $datps->nomuser, $dirigido);
                }
            }
            if ($this->input->post("agrupar") == "si") {

                $cheques[$sp] = array($sp, $montos, $montocheque, $comentario, $estado, $proveedor, $dirigido);
                $sps.=$sp . "*";

                $sp = "";
                $montos = "";
                $estado = "";
                $montocheque = 0;
                $comentario = "";
                $proveedor = "";
                $dirigido = "";
            }
        }
        $data["datos_cheques"] = $cheques;
        $data["solpagos"] = $sps;


        // $data['d_solpago'] = $this->e_chequera_model->obtener_solpago_para_cheque($this->input->post('buscar'));
        $data["inicial"] = $this->input->post("inicial_cheque");
        $data["fecha_cheque"] = $this->input->post("fecha_todos");
        $comp_reg = explode("*", $this->input->post("comprobantes"));
        $comprobantes = array();
        for ($i = 0; $i < count($comp_reg); $i++) {
            if ($comp_reg[$i] != "") {
                $reg_comp = explode("|", $comp_reg[$i]);
                $comprobantes[$reg_comp[0]] = $reg_comp[1];
            }
        }
        $data["comprobantes"] = $comprobantes;

        $this->load->view("chequera/solpagocheque_view", $data);
    }

    function obtenerRendcheque() {
        $usuarios = $this->e_chequera_model->obtener_user_rend($this->input->post('buscar'));
        $cheques = array();
        $sp = "";
        $sps = "";

        $tipo = "";
        $monto_doc = "";
        $saldo = "";
        $montos = "";
        $estado = "";
        $montocheque = 0;
        $comentario = "";
        $proveedor = "";
        $dirigido = "";
        $nota = "";


        foreach ($usuarios->result() as $u) {
            $datsp = $this->e_chequera_model->obtener_rend_user($this->input->post('buscar'), $u->id_tecnico_asignado);

            //***************************************************************
            // obtener informacion FOndos a Rendir 
            // comparar montos para generar saldos a favor o en contra 
            // consultar con saldo mostrar TIPO 
            // si saldo < monto rendido generar cheque  del saldo a favor 
            // si saldo >= monto rendido solo registrar y mostrar mensaje de que solo se registrara 
            //***************************************************************

            $swagrupado = 0;
            foreach ($datsp->result() as $datps) {

                if ($this->input->post("agrupar") == "si") {
                    if ($swagrupado == 1) {
                        $sp.= "_";
                        $montos.= "|";
                        $tipo.= "|";
                        $estado.= "|";
                        $comentario.="|\r\n";
                    }
                    $swagrupado = 1;
                    $sp.=$datps->idreg_ren;
                    if ($datps->tipo_rend == "Rendicion") {
                        $monto_parcial = $datps->monto - $datps->monto_documento;
                        $nota = "EL monto Rendido <span class='negrilla' style='color:black' >NO</span> Supera el monto de los fondos a rendir este cheque solo se registrara para actualizar el estado de cuentas del usuario";
                        if ($monto_parcial > 0) {
                            $montoParcial = $datps->monto_documento - $datps->monto;
                            $nota = "la Rendicion tiene <span class='negrilla' style='color:blue' >Saldo a favor </span> del Tecnico el monto del cheque es solo del saldo a Favor";
                        }
                        $montos.=$monto_parcial . "";
                    } else {
                        $montos.=$datps->monto;
                    }
                    $tipo.=$datps->tipo_rend;
                    $montocheque+=$datps->monto;
                    $estado.=$datps->estado;
                    $comentario.="RENDICION :" . $datps->idreg_ren . " :" . $datps->observacion;
                    $proveedor = $datps->nomuser;


                    $dirigido = $datps->banco . " Cta:" . $datps->cuenta;
                    //if ($datps->tipo_pago_prov == 1)
                    //  $dirigido = $datps->nombre_para_cheque;
                } else {
                    $sps.=$datps->idreg_ren . "*";
                    $dirigido = $datps->banco . " Cta:" . $datps->cuenta;

                    if ($datps->tipo_rend == "Rendicion") {
                        
                            //AREGLAR OBTENER SALDO REAL CON el ID CODUMENTO y RESTAR AL SALDO EGISTRADO
                        
                        
                        
                        $this->load->model('fondosRendir_model');
                        $fr=$this->fondosRendir_model->obtener_datos_sol_fondos($datps->id_documento);
                        $saldofr=$fr->row()->saldo;
                        
                        $monto_parcial = $datps->monto - $saldofr;
                        if ($monto_parcial > 0) {
                            $monto_parcial =  $datps->monto-$saldofr;
                            $nota = "la Rendicion tiene <span class='negrilla' style='color:blue' >Saldo a favor </span>del Tecnico el monto del cheque es solo del saldo a Favor";
                        } else {
                            $nota = "EL monto Rendido <span class='negrilla' style='color:black' >NO</span> Supera el monto de los fondos a rendir este cheque solo se registrara para actualizar el estado de cuentas del Usuario";
                            $monto_parcial = -$datps->monto;
                        }
                        $montos = $monto_parcial;
                    } else {
                        $montos = $datps->monto;
                        $nota = "";
                    }

                    //if ($datps->tipo_pago_prov == 1)
                    //  $dirigido = $datps->nombre_para_cheque;
                    $cheques[$datps->idreg_ren] = array($datps->idreg_ren, $datps->monto, $montos, "RENDICION:" . $datps->idreg_ren . " :" . $datps->observacion, $datps->estado, $datps->nomuser, $dirigido, $datps->tipo_rend, $nota);
                }
            }
            if ($this->input->post("agrupar") == "si") {

                $cheques[$sp] = array($sp, $montos, $montocheque, $comentario, $estado, $proveedor, $dirigido, $tipo, $nota);
                $sps.=$sp . "*";

                $sp = "";
                $tipo = "";
                $montos = "";
                $estado = "";
                $montocheque = 0;
                $comentario = "";
                $proveedor = "";
                $dirigido = "";
                $nota = "";
            }
        }
        $data["datos_cheques"] = $cheques;
        $data["solpagos"] = $sps;


        // $data['d_solpago'] = $this->e_chequera_model->obtener_solpago_para_cheque($this->input->post('buscar'));
        $data["inicial"] = $this->input->post("inicial_cheque");
        $data["fecha_cheque"] = $this->input->post("fecha_todos");
        $comp_reg = explode("*", $this->input->post("comprobantes"));
        $comprobantes = array();
        for ($i = 0; $i < count($comp_reg); $i++) {
            if ($comp_reg[$i] != "") {
                $reg_comp = explode("|", $comp_reg[$i]);
                $comprobantes[$reg_comp[0]] = $reg_comp[1];
            }
        }
        $data["comprobantes"] = $comprobantes;

        $this->load->view("chequera/solpagocheque_view", $data);
    }

    ////************************** NUEVO *************************************///








    function index($padre) {


        $data['titulo'] = 'Chequera Electronica';
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


        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function form_cheques_sp($id_cheque) {

        $this->load->view("chequera/form_cheque_sp_view");
    }

    function form_cheques_fr($id_cheque) {

        $this->load->view("chequera/form_cheque_fr_view");
    }

    function form_cheques_rend($id_cheque) {

        $this->load->view("chequera/form_cheque_rend_view");
    }

    function cuentas_empresa($padre, $hijo) {


        $data['titulo'] = 'Cuentas de Personal STS';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);

        $data['vista_enviada'] = 'chequera/cuentas_empresa_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_lista_cuentas_empresa() {

        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;

        $registros = $this->e_chequera_model->listar_buscar_cuentas_empresa($b, $i, $c);
        $total_registros = $this->e_chequera_model->listar_buscar_cuentas_empresa_cantidad($b);

        $data['total_registros'] = $total_registros;
        $data['registros'] = $registros;
        //$detalles_registros = array();
        // $data['detalle_registros'] = $detalles_registros;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;

        $this->load->view('chequera/lista_cuentas_empresa_view', $data);
    }

    function form_add_cuenta_banco($id_user) {
        $this->load->model('usuario_model');
        $data['cuenta'] = $this->e_chequera_model->cuentas_banco_usuarios($id_user);
        $data['usuario'] = $this->usuario_model->obtener_user($id_user);
        $this->load->view('chequera/formulario_adicionar_edicion_cuentas_empresa_view', $data);
    }

    function guardar_registro_cuenta() {
        $mensaje = $this->e_chequera_model->registrar_cuenta_banco_empresa();
        echo $mensaje;
    }

    function eliminar_cuenta_empresa($id_cuenta) {
        $this->e_chequera_model->eliminar_cuenta_banco_empresa($id_cuenta);
    }

    function cuentas_proveedores($padre, $hijo) {


        $data['titulo'] = 'Cuentas de Banco de proveedores(GCO v3)';
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


        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function lista_cheques_generados($padre, $hijo = null) {


        $data['titulo'] = 'Lista de cheques';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['registros_ch'] = $this->e_chequera_model->listar_cheques();


        //$clientes = $this->cliente_model->listar_clientes("");
        //$data['datos_cliente'] = $clientes;//para mostrar en la pantalla cambiar en clientes
        //$contactos_cliente = array();
        //foreach ($clientes as $cli) {
        //  $contactos_cliente[$cli->id_cliente] = $this->cliente_model->lista_contacto_cliente($cli->id_cliente);
        // para mostra en pantalla detalle de los modulos cambiar para contactos
        //}
        //$data['contactos_cliente'] = $contactos_cliente;


        $data['vista_enviada'] = 'chequera/chequera_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_cuentas() {
        $tipo = $this->input->post('tipo');
        $busqueda = $this->input->post('buscar');


        $resultado = $this->e_chequera_model->busqueda_cuentas($tipo, $busqueda);
        if ($tipo == 'libre') {
            echo "<span class='bordeabajo milink link NO' >con la opcion LIBRE la busqueda queda inhabilitada</span><br>";
        } else {
            foreach ($resultado->result() as $reg) {
                if ($tipo == 'proveedor') {
                    if ($reg->tipo_pago_prov == 2) {
                        echo "<span class='bordeabajo milink link' onclick='$(\"#dirigido_a\").val(\"" . $reg->nombre_banco . " Cta.: " . $reg->cuenta_bancaria . "\");$(\"#det_dirigido\").val(\"" . $reg->nombre . "\");'><span class='negrilla f10'>" . $reg->nombre . "</span><span class='rojoText f10'>(" . $reg->nombre_banco . " - " . $reg->cuenta_bancaria . ")</span></span><br>";
                    } else {
                        echo "<span class='bordeabajo milink link' onclick='$(\"#dirigido_a\").val(\"" . $reg->nombre_para_cheque . "\");$(\"#det_dirigido\").val(\"" . $reg->nombre . "\");'><span class='negrilla f10'>" . $reg->nombre . "</span><span class='azulmarino f10'>(" . $reg->nombre_para_cheque . ")</span></span><br>";
                    }
                }
                if ($tipo == 'personal') {
                    echo "<span class='bordeabajo milink link' onclick='$(\"#dirigido_a\").val(\"" . $reg->nombre_banco . " Cta.: " . $reg->cuenta_bancaria . "\");$(\"#det_dirigido\").val(\"" . $reg->nombre . "\");'><span class='negrilla f10'>" . $reg->nombre . "</span><span class='rojoText f10'>(" . $reg->nombre_banco . " - " . $reg->cuenta_bancaria . ")</span></span><br>";
                }
            }
        }
    }

    function registrar_cheque() {

        $respuesta = $this->e_chequera_model->registrar_cheque();
        echo $respuesta;
    }

    function busqueda_lista_chequera() {
        //$this->load->model('proyecto_model');
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;

        $registros = $this->e_chequera_model->listar_buscar_cheques($b, $i, $c);
        $total_registros = $this->e_chequera_model->listar_buscar_cheques_cantidad($b);

        $data['total_registros'] = $total_registros;
        $data['registros'] = $registros;
        //$detalles_registros = array();
        // $data['detalle_registros'] = $detalles_registros;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;

        $this->load->view('chequera/lista_cheques_view', $data);
    }

    ////-*************************************************************************************************************************
    ////-*************************************************************************************************************************
    ////-*************************************************************************************************************************
    ////-*************************************************************************************************************************
    ////-*************************************************************************************************************************
    ////-*************************************************************************************************************************
    ////-*************************************************************************************************************************
    ////-*************************************************************************************************************************
    ////-*************************************************************************************************************************
    ////-*************************************************************************************************************************
    ////-*************************************************************************************************************************
    ////-*************************************************************************************************************************



    function busqueda_lista_factura_venta() {
        $this->load->model('proyecto_model');
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $de = $this->input->post("desde");
        $ha = $this->input->post("hasta");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;

        $ov_pfs = $this->factura_venta_model->listar_buscar_factura_venta($b, $i, $c, $de, $ha);
        $total_registros = $this->factura_venta_model->listar_buscar_factura_venta_cantidad($b, $de, $ha);

        $data['total_registros'] = $total_registros;
        $data['registros'] = $ov_pfs;
        //$detalles_registros = array();
        $proyectos_fact = array();
        $contrato_fact = array();
        foreach ($ov_pfs->result() as $reg) {
            $proyectos_fact[$reg->id_factura] = $this->proyecto_model->obtener_datos_proyecto($reg->id_proyecto);
            $contrato_fact[$reg->id_factura] = $this->proyecto_model->obtener_contrato_id($reg->id_contrato);
        }
        // $data['detalle_registros'] = $detalles_registros;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $data['proy_fac'] = $proyectos_fact;
        $data['cont_fac'] = $contrato_fact;
        $this->load->view('factura_venta/list_find_factura_venta_view', $data);
    }

    function factura_venta_nuevo($id_fac) {
        $this->load->model('cliente_model');
        if ($id_fac != 0) {
            $data['data_fac'] = $this->factura_venta_model->obtener_factura_venta($id_fac);
            $data['detalle_fac'] = $this->factura_venta_model->obtener_detalle_factura_venta($id_fac);
        }

        $this->load->model('proyecto_model');
        $data['proyecto_resultado'] = $this->proyecto_model->seleccionar_proyecto_nombre();
        $data['lista_dosificacion'] = $this->dosificaciones_model->lista_dosificacion_activa();
        $data['lista_clientes'] = $this->cliente_model->listar_clientes('');
        $data['id_send'] = $id_fac;

        $this->load->view('factura_venta/factura_venta_new_view', $data);
    }

    function factura_venta_save() {
        $data["id"] = $this->factura_venta_model->save_factura_venta();
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

}

?>
