<?php

class control_proyecto extends CI_Controller {

    public $selected = "";

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('almacen_model');
        $this->load->model('control_proyecto_model');
        $this->load->model('usuario_model');
        $this->load->model('detalle_mih_model');
        $this->load->model('producto_servicio_model');
        $this->load->model('uploadify_model');


        if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }

//$padre,$hijo
    function index($padre) {
        echo "funciona";
        $data['titulo'] = 'Almacen';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function form_po_register($id_po) {
        if ($id_po != 0) {
            //$data['datos_po'] = $this->control_proyecto_model->obtener_datos_po($id_po);
            $data['datos_po'] = $this->control_proyecto_model->obtener_datos_item_po($id_po);
            $data['detalle_po'] = $this->control_proyecto_model->obtener_detalle_po($id_po);
        }
        $this->load->model('usuario_model');
        $data['personal_datos'] = $this->usuario_model->lista_usuarios_activos();

        $data['id_po'] = $id_po;
        $this->load->view('control_proyecto/formulario_po_register', $data);
    }

    function ordecompra($padre, $proyecto = null) {
        $data['titulo'] = 'Ordenes de Compra';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        //$datosenlace=$data['datos_menu_detallado'];
        $this->load->model('usuario_model');
        $this->load->model('rendiciones_model');

        $data['personal_datos'] = $this->usuario_model->lista_usuarios_activos();
        $data['proyectos'] = $this->usuario_model->obtProyectoUserResult($this->session->userdata('id_admin'));
        $data['registros'] = $this->control_proyecto_model->listar_sitios_x_proyecto($proyecto);
        //$datd['proyectosinternos']=$this->control_proyecto_model->obtener_proyinterno($id_proyecto,$this->session->userdata('id_admin'));


        $data['padre'] = $padre;
        $data['proyectosel'] = $proyecto;
        $montos = Array();
        $rendiciones = Array();
        $utilidad = Array();
        $suma = 0;
        $sumaRend = 0;
        $sumaUtilidad = 0;
        foreach ($data['registros']->result() as $sitio) {

            $montos[$sitio->idSitioTrabajo] = $this->control_proyecto_model->obtener_monto_sitio($sitio->idSitioTrabajo);
            $rendiciones[$sitio->idSitioTrabajo] = $this->rendiciones_model->obtener_montorend_sitio($sitio->idSitioTrabajo);
            $utilidad[$sitio->idSitioTrabajo] = $montos[$sitio->idSitioTrabajo] - $rendiciones[$sitio->idSitioTrabajo];
            $suma+=$montos[$sitio->idSitioTrabajo];
            $sumaRend+=$rendiciones[$sitio->idSitioTrabajo];
            $sumaUtilidad+=$utilidad[$sitio->idSitioTrabajo];
        }//obtiene montos    
        $data['montos'] = $montos;
        $data['rendiciones'] = $rendiciones;
        $data['utilidad'] = $utilidad;
        $data['suma'] = $suma;
        $data['sumaRend'] = $sumaRend;
        $data['sumaUtilidad'] = $sumaUtilidad;


        $data['vista_enviada'] = 'control_proyecto/control_proyecto_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function obtener_proyinterno() {
        $pint = $this->control_proyecto_model->obtener_proyinterno($this->input->post('idproyecto'), $this->session->userdata('id_admin'));
        $apinte = $this->input->post("idproyinte");
        $variables = " <option value='seleccione'>seleccione un Proyecto interno</option>";
        $sw = 0;

        foreach ($pint->result() as $pinterno) {
            //if ($sw == 1)
            //  $variables.=",";
            if ($pinterno->proy_interno != "") {
                $sel = "";
                if ($apinte == $pinterno->proy_interno)
                    $sel = " selected='selected' ";
                $variables.="<option value='$pinterno->proy_interno' $sel>" . $pinterno->proy_interno . "</option>";
            }
            //$sw = 1;
        }
        $variables.= " <option value='otro_nuevo' style='color:red'>Otro Nuevo</option>";
        echo $variables;
    }

    function reg_ordecompra($padre, $id_sitio) {
        $data['titulo'] = 'Registrar items PO';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['padre'] = $padre;
        $data['id_sitio'] = $id_sitio;
        $this->load->model('usuario_model');

        $data['personal_datos'] = $this->usuario_model->lista_usuarios_activos();
        $data['registros'] = $this->control_proyecto_model->obtener_sitios($id_sitio);
        $reg_sitio = $data['registros']->row();
        $data['registros_po'] = $this->control_proyecto_model->listar_buscar_orden_comprasxsitio($reg_sitio->idSitioTrabajo);

        $data['vista_enviada'] = 'control_proyecto/registroPO_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function reg_rend($padre, $id_sitio) {
        $data['titulo'] = 'Rendiciones';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['padre'] = $padre;
        $this->load->model('usuario_model');
        $this->load->model('rendiciones_model');

        $data['personal_datos'] = $this->usuario_model->lista_usuarios_activos();
        $data['registros'] = $this->control_proyecto_model->obtener_sitios($id_sitio);
        $data['id_sitio'] = $id_sitio;
        $reg_sitio = $data['registros']->row();
        $data['registros_rend'] = $this->rendiciones_model->listar_buscar_rendicionesxsitio($reg_sitio->idSitioTrabajo);
        // $data['registros_rend'] = $this->control_proyecto_model->listar_buscar_orden_comprasxsitio($reg_sitio->idSitioTrabajo);

        $data['vista_enviada'] = 'control_proyecto/registroRend_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function obtener_sitio($id_sitio) {
        $datos_sitio = $this->control_proyecto_model->obtener_sitios($id_sitio);
        if ($datos_sitio->num_rows > 0) {
            $sitio = $datos_sitio->row();
            $codido = '...........<input type="hidden" id="AidSitio" value="' . $sitio->idSitioTrabajo . '">
                    <input type="hidden" id="Aduid"  value="' . $sitio->DIUD . '">
                    <input type="hidden" id="Anombre" value="' . $sitio->nombre . '">
                    <input type="hidden" id="Aproy"  value="' . $sitio->id_proyecto . '">
                    <input type="hidden" id="coment"  value="' . $sitio->comentario . '">
                    <input type="hidden" id="Apinte"  value="' . $sitio->proy_interno . '">';
            echo $codido;
        } else {
            $codido = '<input type="hidden" id="AidSitio" value="0">
                    <input type="hidden" id="Aduid"  value="0">
                    <input type="hidden" id="Anombre" value="0">
                    <input type="hidden" id="Aproy"  value="0">
                    <input type="hidden" id="coment"  value="0">
                    <input type="hidden" id="Apinte"  value="0">';
            echo $codido;
        }
    }

    function obtener_sitio_duid($duid) {
        $datos_sitio = $this->control_proyecto_model->obtener_sitios_duid($duid);
        if ($datos_sitio->num_rows > 0) {
            $sitio = $datos_sitio->row();
            $codido = '...........<input type="hidden" id="AidSitio" value="' . $sitio->idSitioTrabajo . '">
                    <input type="hidden" id="Aduid"  value="' . $sitio->DIUD . '">
                    <input type="hidden" id="Anombre" value="' . $sitio->nombre . '">
                    <input type="hidden" id="Aproy"  value="' . $sitio->id_proyecto . '">
                    <input type="hidden" id="coment"  value="' . $sitio->comentario . '">
                    <input type="hidden" id="Apinte"  value="' . $sitio->proy_interno . '">';
            echo $codido;
        } else {
            $codido = '<input type="hidden" id="AidSitio" value="0">
                    <input type="hidden" id="Aduid"  value="0">
                    <input type="hidden" id="Anombre" value="0">
                    <input type="hidden" id="Aproy"  value="0">
                    <input type="hidden" id="coment"  value="0">
                    <input type="hidden" id="Apinte"  value="0">';
            echo $codido;
        }
    }

    function obtener_po($po) {
        $sitio = $this->control_proyecto_model->obtener_po($po)->row();
        $codido = '..***.......
                 <input type="hidden" id="Aidpo" value="' . $sitio->idordenCompra . '">
                 <input type="hidden" id="Anropo" value="' . $sitio->nroPO . '">
                    <input type="hidden" id="Atitulo"  value="' . $sitio->titulo . '">
                    <input type="hidden" id="Amonto" value="' . $sitio->monto . '">
                    <input type="hidden" id="Aproy"  value="' . $sitio->duracion . '">
                    <input type="hidden" id="Aobservaciones"  value="' . $sitio->observaciones . '">';
        echo $codido;
    }

    function lista_sitio() {
        $data['registros'] = $this->control_proyecto_model->listar_sitios();
        $this->load->view('control_proyecto/list_find_orden_compra_view', $data);
    }

    function lista_orden_compraxsitio() {
        $data['registros'] = $this->control_proyecto_model->listar_buscar_orden_comprasxsitio($this->input->post("DUID"));
        $this->load->view('control_proyecto/list_find_orden_compra_view', $data);
    }

    //baja esta funcion
    function busqueda_lista_orden_compra() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $ra = $this->control_proyecto_model->listar_buscar_orden_compra($b, $i, $c);
        $total_registros = $this->control_proyecto_model->listar_buscar_orden_compra_cantidad($b);
        $data['total_registros'] = $total_registros;
        $data['registros'] = $ra;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;

        $this->load->view('control_proyecto/list_find_orden_compra_view', $data);
    }

    function guardar_registro_sitio() {
        // $id = $this->input->post('idsitio');
        // if ($id_oc == 0)
        echo $this->control_proyecto_model->save_sitio();
        // else {
        // echo ">>>>>>>".$id_mov_alm;
        //   echo $this->control_proyecto_model->edita_save_pro_serv($id_oc);
        //}
    }

    function guardar_items_po() {
        // $id = $this->input->post('idsitio');
        // if ($id_oc == 0)
        echo $this->control_proyecto_model->save_item_po_sitio();
        // else {
        // echo ">>>>>>>".$id_mov_alm;
        //   echo $this->control_proyecto_model->edita_save_pro_serv($id_oc);
        //}
    }

    function eliminar_items_po() {
        // $id = $this->input->post('idsitio');
        // if ($id_oc == 0)
        echo $this->control_proyecto_model->delete_item_po_sitio();
        // else {
        // echo ">>>>>>>".$id_mov_alm;
        //   echo $this->control_proyecto_model->edita_save_pro_serv($id_oc);
        //}
    }

    function guardar_registro_po() {
        // $id = $this->input->post('idsitio');
        // if ($id_oc == 0)
        echo $this->control_proyecto_model->save_po();
        // else {
        // echo ">>>>>>>".$id_mov_alm;
        //   echo $this->control_proyecto_model->edita_save_pro_serv($id_oc);
        //}
    }

    function reg_orden_compra_form($id_ma) {
        $data['id_sendma'] = $id_ma;

        $this->load->model('usuario_model');
        //$this->load->model('almacen_model');
        // $id_user = $this->input->post('id_personal');
        $data['personal_datos'] = $this->usuario_model->lista_usuarios_activos();
        //$data['busqueda_proy'] = $this->movimiento_almacen_model->busq_user_proy($id_user);
        //$data['almacen_datos'] = $this->almacen_model->listar_almacen_responsable_almacen($this->session->userdata('id_admin'));

        $data['id_send'] = $id_ma;
        //echo "el id enviado es ". $id_ar;
        if ($id_ma != 0) {
            $data['oc_dat'] = $this->control_proyecto_model->obtener_ordencompra($id_ma); //utilizacion tabla mov.almacen
            //$data['inf_detalle_ingreso'] = $this->movimiento_almacen_model->obtener_detalle_movimiento1($id_ma);
            // echo "el id enviado es ". $id_ma;
        }
        $this->load->view('control_proyecto/nuevo_ordencompra_view', $data);
    }

    function pruebaerrores() {
        $data['param1'] = '0';
        $this->load->view('control_proyecto/prueba_error_view', $data);
    }

    function guardar_registro_orden_compra() {


        // if ($this->input->post('id_ma') == 0) {
        //$this->movimiento_almacen_model->save_pro_serv();

        $id_oc = $this->input->post('idordencompra');
        if ($id_oc == 0)
            echo $this->control_proyecto_model->save_pro_serv();
        else {
            // echo ">>>>>>>".$id_mov_alm;
            echo $this->control_proyecto_model->edita_save_pro_serv($id_oc);
        }

        //}  
    }

    function reporte_control_sitio($padre, $proyecto = 0, $idsitio = 0, $rango = 6, $ini = null, $fin = null) {
        $data['titulo'] = 'reporte control Sitio';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        //$datosenlace=$data['datos_menu_detallado'];
        $this->load->model('usuario_model');
        $this->load->model('rendiciones_model');

        $data['personal_datos'] = $this->usuario_model->lista_usuarios_activos();
        $data['proyectos'] = $this->usuario_model->obtProyectoUserResult($this->session->userdata('id_admin'));
        $data['registros'] = $this->control_proyecto_model->listar_sitios_x_proyecto($proyecto);
        //$datd['proyectosinternos']=$this->control_proyecto_model->obtener_proyinterno($id_proyecto,$this->session->userdata('id_admin'));


        $data['padre'] = $padre;
        $data['proyectosel'] = $proyecto;
        $montos = Array();
        $rendiciones = Array();
        $utilidad = Array();
        $suma = 0;
        $sumaRend = 0;
        $sumaUtilidad = 0;
        foreach ($data['registros']->result() as $sitio) {

            $montos[$sitio->idSitioTrabajo] = $this->control_proyecto_model->obtener_monto_sitio($sitio->idSitioTrabajo);
            $rendiciones[$sitio->idSitioTrabajo] = $this->rendiciones_model->obtener_montorend_sitio($sitio->idSitioTrabajo);
            $utilidad[$sitio->idSitioTrabajo] = $montos[$sitio->idSitioTrabajo] - $rendiciones[$sitio->idSitioTrabajo];
            $suma+=$montos[$sitio->idSitioTrabajo];
            $sumaRend+=$rendiciones[$sitio->idSitioTrabajo];
            $sumaUtilidad+=$utilidad[$sitio->idSitioTrabajo];
        }//obtiene montos    
        $data['montos'] = $montos;
        $data['rendiciones'] = $rendiciones;
        $data['utilidad'] = $utilidad;
        $data['suma'] = $suma;
        $data['sumaRend'] = $sumaRend;
        $data['sumaUtilidad'] = $sumaUtilidad;


        $data['rango'] = $rango;
        $pomes = "";
        $rendmes = "";
        $utimes = "";

        $fecha_actual = date("d-m-Y");
        $arraymes = Array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
        $mesesg = "";
        $me = "";
        $sw = 0;
        for ($i = 0; $i < $rango; $i++) {
            $fa = strtotime($fecha_actual);
            $me = $arraymes[date("m", $fa) - 1];
            if ($sw == 1) {
                $mesesg = "," . $mesesg;
                $pomes = "," . $pomes;
                $rendmes = "," . $rendmes;
                $utimes = "," . $utimes;
            }
            $sw = 1;
            $mesesg = $me . "/" . date("Y", $fa) . $mesesg;
            $pm = $this->control_proyecto_model->obtener_monto_sitio_mes($idsitio, $fecha_actual, $proyecto);
            $rm = $this->rendiciones_model->obtener_montorend_sitio_mes_proyecto($idsitio, $fecha_actual, $proyecto);
            $pomes = $pm . $pomes;
            $rendmes = $rm . $rendmes;
            $utimes = number_format($pm - $rm, 2, ".", "") . $utimes;


            $fecha_actual = date("d-m-Y", strtotime($fecha_actual . "- 1 month"));
        }
        //  echo $pomes . "<br>";

        $data["meses"] = $mesesg;
        $data["pos_monto"] = $pomes;
        $data["rend_monto"] = $rendmes;
        $data["uti_monto"] = $utimes;
        $sitiossel = "<select class='form-control' id='id_sitio'><option value='0'>Seleccione un proyecto primero</option></select>";
        if ($proyecto != 0) {
            $sitiossel = $this->cargar_sitios_proyecto_controller($proyecto, $idsitio);
        }


        $data['sitio_sel'] = $sitiossel;



        $data['vista_enviada'] = 'control_proyecto/control_proyecto_rep_sit_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function reporte_rendicion_info() {
        $this->load->model('usuario_model');
        $this->load->model('rendiciones_model');

        $proy = $this->input->post('id_proyecto');
        $user_selec = $this->input->post('id_usuario');
        $sitio = $this->input->post('id_sitio');
        $rango = $this->input->post('rango');
        
        $data['registros_rend'] = $this->rendiciones_model->listar_buscar_rendicionesxproyecto($proy,$user_selec,$sitio,$rango);
        

        $fecha_actual = date("d-m-Y");
        $arraymes = Array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
        $fecini = $fecha_actual;
        $fecfin = date("d-m-Y", strtotime($fecha_actual . "- " . $rango . " month"));
        $items = Array();
        $meses_t = Array();

        //obtengo el rango de meses solicicitado todo el for
        for ($j = $rango - 1; $j >= 0; $j--) {
            $fecfin = $fecha_actual;
            $fa = strtotime($fecha_actual);
            $me = $arraymes[date("m", $fa) - 1];
            $ye = date("Y", $fa);

            $meses_t[$j][0] = $me;
            $meses_t[$j][1] = $fecha_actual;
            $meses_t[$j][2] = $ye;

            $fecha_actual = date("d-m-Y", strtotime($fecha_actual . "- 1 month"));
        }
        //defino los formularios
        $formularios = Array(
            Array("TRA", 1, "TRA-A"),
            Array("TRA", 0, "TRA-B"),
            Array("SGR", 1, "SGR-A"),
            Array("SGR", 0, "SGR-B"),
            Array("TEL", 1, "SGR-C")
        );
        $resultados = Array();
        $formres = Array();
        $datosfm = Array();
        $montosfm = Array();
        $datos = Array();

        $categoria = "";
        $categoria2 = "";
        $serieData = Array();
        $serieDatadetalle = Array();
        //recorrido de los formularios para generar los arreglos
        $punt = 0;
        for ($i = 0; $i < count($formularios); $i++) {
            $serieData[$i] = "";

            // echo $i."./ formularios ".$formularios[$i][0]."<br>";
            $datos_fm = $this->rendiciones_model->obtener_detalle_tg($proy, $user_selec, $formularios[$i][0], $formularios[$i][1], $fecfin, $fecini);
            //foreach se recorreo los items de todo el rango y se cerea los arreglos
            foreach ($datos_fm->result() as $item) {
                $items[$punt] = $formularios[$i][2] . "*" . $item->descripcion_tra;
                $serieDatadetalle[$punt] = "";
                // echo $items[$punt]."<br>";
                for ($n = 0; $n < count($meses_t); $n++) {
                    $datos[$meses_t[$n][0]][$punt] = 0;
                }

                $punt++;
            }

            // se asigna los datos a los arreglos en la posicion de los items

            for ($j = 0; $j < count($meses_t); $j++) {
                $suma_form = 0;
                $rmontosfm = $this->rendiciones_model->obtener_monto_detalle_ren_tg_mes($proy, $user_selec, $formularios[$i][0], $formularios[$i][1], $meses_t[$j][1]);
                foreach ($rmontosfm->result() as $res_montos) {
                    for ($k = 0; $k < count($items); $k++) {
                        if ($formularios[$i][2] . "*" . $res_montos->descripcion_tra == $items[$k]) {
                            $datos[$meses_t[$j][0]][$k] = $res_montos->monto_mes;
                        }
                    }
                    $suma_form+=$res_montos->monto_mes;
                }
                $serieData[$i] .= number_format($suma_form, 2, ".", "") . ",";
            }
            $serieData[$i] = substr($serieData[$i], 0, strlen($serieData[$i]) - 1);
        }

        for ($n = 0; $n < count($meses_t); $n++) {
            for ($i = 0; $i < count($formularios); $i++) {

                $categoria.="'" . $formularios[$i][2] . " " . $meses_t[$n][0] . "',";

                $cat = "";
                for ($k = 0; $k < count($items); $k++) {

                    //echo "<br>detalle:antes>>" . $serieDatadetalle[$k];
                    $it = explode("*", $items[$k]);
                    $cat = $it[0];
                    if ($cat == $formularios[$i][2]) {
                        if ($serieDatadetalle[$k] != "") {
                            $serieDatadetalle[$k].=",";
                        }
                        $serieDatadetalle[$k].=number_format($datos[$meses_t[$n][0]][$k], 2, ".", "");
                    } else {
                        if ($serieDatadetalle[$k] != "") {
                            $serieDatadetalle[$k].=",";
                        }
                        $serieDatadetalle[$k].=number_format(0, 2, ".", "");
                    }

                    //  echo "<br> detalle despues >>" . $serieDatadetalle[$k];
                }
            }
            //echo "<br>******" . $categoria . "******<br>";
            //echo "<br>*************<br>";
            $categoria2.= "'" . $meses_t[$n][0] . "/" . $meses_t[$n][2] . "',";
        }
        
        for ($i = 0; $i < count($formularios); $i++) {
            $serie_mon_form[$i]=$formularios[$i][2];
        }


        $categoria = substr($categoria, 0, strlen($categoria) - 1);
        $categoria2 = substr($categoria2, 0, strlen($categoria2) - 1);
        
        $graf1d1['categoria']=$categoria2;
        $graf1d1['serie_data']=$serieData;
        $graf1d1['serie_nombre']=$serie_mon_form;
        $graf1d1['titulo']="Grafica 1";
        $graf1d1['contenedor']="Grafica1";
        
        $graf1d2['contenedor']="Grafico2";
        $graf1d2['titulo']="Grafico 2";
        $graf1d2['categoria']=$categoria;
        $graf1d2['serie_data']=$serieDatadetalle;
        $graf1d2['serie_nombre']=$items;
        
        $data['graf1']=$graf1d1;
        $data['graf2']=$graf1d2;

        $data['items'] = $items;
        $data['categoria'] = $categoria;
        $data['categoria2'] = $categoria2;
        $data['serieData'] = $serieData;
        $data['serieDatadetalle'] = $serieDatadetalle;
        
       

        $data['meses_t'] = $meses_t;
        $data['formularios'] = $formularios;
        $data['datos'] = $datos;

        // $data['vista_enviada'] = 'control_proyecto/reporte_rendicion_info_view';
        $this->load->view('control_proyecto/reporte_rendicion_info_view', $data);
    }

    function reporte_rend($padre, $proyecto = 0, $usuario = 0, $idsitio = 0, $rango = 3, $tipo = "agrupado", $ini = null, $fin = null) {
        $data['titulo'] = 'reporte de Rendicion';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        //$datosenlace=$data['datos_menu_detallado'];
        $this->load->model('usuario_model');
        $this->load->model('rendiciones_model');

        $data['personal_datos'] = $this->usuario_model->lista_usuarios_activos();

        $data['proyectos'] = $this->usuario_model->obtProyectoUserResult($this->session->userdata('id_admin'));



        $data['rango'] = $rango;
        $data['padre'] = $padre;
        $data['proyectosel'] = $proyecto;




        $sitiossel = "<select class='form-control' id='id_sitio'><option value='0'>Seleccione un proyecto primero</option></select>";
        if ($proyecto != 0) {
            $sitiossel = $this->cargar_sitios_proyecto_controller($proyecto, $idsitio);
        }


        $data['sitio_sel'] = $sitiossel;



        $data['vista_enviada'] = 'control_proyecto/reporte_rendicion_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    //paramet of data base


    function cargar_sitios_proyecto_controller($proyecto, $sitio_id) {
        $this->load->model("control_proyecto_model");
        $sitios = $this->control_proyecto_model->listar_sitios_x_proyecto($proyecto);
        if ($sitios->num_rows > 0) {
            $codigo = "<select class='form-control' id='id_sitio' style='padding: 0px; font-size: 12px;'>";
            $codigo .="<option value='0' >Seleccione Un SITIO</option>";
            foreach ($sitios->result() as $sitio) {
                $sel = "";
                if ($sitio->idSitioTrabajo == $sitio_id)
                    $sel = " selected='selected' ";
                $codigo.="<option value='" . $sitio->idSitioTrabajo . "' $sel>" . $sitio->nombre . "(DUID:" . $sitio->DIUD . ")</option>";
            }
            $codigo .="</select>";
            return $codigo;
        } else {
            return "<spam style='color:red'>No tiene Sitios Registrados en este proyecto, No puede Continuar</spam>";
        }
    }

    function ver_mov_alm($id_ov_fp) {
        echo "funciona";
        $data['id_send'] = $id_ov_fp;
        $this->load->view('movimiento_almacen/nuevo_almacen_view', $data);
    }

    function almacen_ver($id_mov_alm) {
        $data['$id_mov_alm'] = $this->movimiento_almacen_model->obtener_mov_alm($id_mov_alm);
        $data['id_send'] = $id_mov_alm;
        $this->load->view('movimiento_almacen/mov_almacen_view', $data);
    }

    function almacen_retiro($id_ar) {
        $data['id_send'] = $id_ar;
        $this->load->view('movimiento_almacen/nuevo_almacen_view_retiro', $data);
    }

    function guardar_almacen() {
        $respuesta = $this->cliente_model->guardar_cliente_nuevo();
        echo $respuesta;
    }

    function guardar_ingreso() {
        $respuesta = $this->movimiento_almacen_model->guardar_ingreso_nuevo();
        echo $respuesta;
    }

    function eliminar_ingreso() {
        $respuesta = $this->movimiento_almacen_model->eliminar_ingreso_nuevo();
        echo $respuesta;
    }

    function mov_alm_save() {
        $this->movimiento_almacen_model->save_mov_alm1();
    }

    function guardar_mov_alm_nuevo() {
        $respuesta = $this->movimiento_almacen_model->guardar_mov_alm();
        echo $respuesta;
    }

    function find_selected() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $s = $this->input->post("opc1");
        // alert("mmm"+$s);
        //-----------------------------listar_buscar_ov_pf($b,$i,$c);
        $opcs = $this->movimiento_almacen_model->opc_sel1($b, $i, $c, $s);
        //-------------------------------------listar_buscar_ov_pf_cantidad($b);
        // $total_registros=$this->almacen_model->listar_buscar_al_cantidad($b);
        // $os->result();
        $data['registros'] = $opcs;
        // $data['mostrar_X']=$c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $data['mostrar_X'] = $s;
        $this->load->view('movimiento_almacen/ops_sel_view', $data);
    }

    function find_selected1() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $s = $this->input->post("opc1");
        //-----------------------------listar_buscar_ov_pf($b,$i,$c);
        $opcs = $this->movimiento_almacen_model->opc_sel_prov($b, $i, $c, $s);
        //-------------------------------------listar_buscar_ov_pf_cantidad($b);
        // $total_registros=$this->almacen_model->listar_buscar_al_cantidad($b);
        // $os->result();
        $data['registros'] = $opcs;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $data['mostrar_X'] = $s;

        $this->load->view('movimiento_almacen/ops_sel_view1', $data);
    }

    function busqueda_mih_detalle() {
        $busqueda = $this->input->post('busqueda');
        $cant = $this->input->post('cant');
        $pag = $this->input->post('pag');
        $ini = ($pag * $cant) - $cant;
        $data['ind'] = $ini;
        $data['no_reg'] = $this->detalle_mih_model->cant_busqueda($busqueda);
        $data['mostrar'] = $cant;
        $data['pagina'] = $pag;
        $data['consulta'] = $this->detalle_mih_model->busqueda_obj1($busqueda);
        $data['busqueda'] = $busqueda;
        $data['ids'] = $this->input->post('selecionados');
        $this->load->view('movimiento_almacen/resultado_busqueda_mih_view1', $data);
    }

    function listar_usuario() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $s = $this->input->post("opc1");
        // alert("mmm"+$s);
        //-----------------------------listar_buscar_ov_pf($b,$i,$c);
        $opcs = $this->movimiento_almacen_model->opc_sel_dinamico($b, $i, $c, $s);
        //-------------------------------------listar_buscar_ov_pf_cantidad($b);
        // $total_registros=$this->almacen_model->listar_buscar_al_cantidad($b);
        // $os->result();

        $data['registros'] = $opcs;
        // $data['mostrar_X']=$c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $data['mostrar_X'] = $s;
        $this->load->view('movimiento_almacen/ops_sel_view', $data);
    }

    function ingreso_ver($id_i) {
        $data['d_i'] = $this->movimiento_almacen_model->obtener_mov_alm($id_i);
        $data['id_send'] = $id_i;
        $this->load->view('movimiento_almacen/nuevo_ingreso_view', $data); //aun no 
    }

    function ingreso_baja($id_i) {
        $data['d_i'] = $this->movimiento_almacen_model->obtener_mov_alm($id_i);
        $data['id_send'] = $id_i;
        $this->load->view('movimiento_almacen/baja_ingreso_view', $data); //aun no 
    }

    function ingreso_editar() {
        $data['movimiento_almacen'] = $this->movimiento_almacen_model->mensajes_ingreso();


        $this->load->view('movimiento_almacen/nuevo_ingreso_edit_view', $data); //aun no 
    }

    function salidas_u() {

        $data['movimiento'] = $this->movimiento_almacen_model->movi_ut(1); //tipo 1 entrada 2 salida
        $this->load->view('movimiento_almacen/lista_movimiento_p_ingresos', $data);
    }

    function add_articulo() {

        $lp1 = $this->usuario_model->find_ser_prov_detalle();
        $data['registros2'] = $lp1;
        $data['ids'] = $this->input->post('selecionados');
        $this->load->view('movimiento_almacen/list_find_alm_serv_pro_view', $data);
    }

    //función encargada de actualizar los datos    
    function actualizar_datos() {
        $id_mov_alm = $this->input->post('id_mov_alm');
        $fh_reg = $this->input->post('fh_reg');
        $tipo_movimiento = $this->input->post('tipo_movimiento');
        $proyecto = $this->input->post('proyecto');
        $comentario = $this->input->post('comentario');
        $tipo_doc_origen = $this->input->post('tipo_doc_origen');
        $doc_respaldo = $this->input->post('doc_respaldo');

        $actualizar = $this->almacen_model->actualizar_mensaje_ingreso($id_mov_alm, $fh_reg, $tipo_movimiento, $proyecto, $comentario, $tipo_doc_origen, $doc_respaldo);        //si la actualización ha sido correcta creamos una sesión flashdata para decirlo
        if ($actualizar) {
            $this->session->set_flashdata('actualizado', 'El mensaje se actualizó correctamente');
            // redirect('../almacen', 'refresh');
        }
    }

//función para el movimiento de almacen
    function find_list_personal() {

        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $ra = $this->movimiento_almacen_model->list_find_people($i, $c);
        $total_registros = $this->movimiento_almacen_model->list_find_people_cant();

        $data['total_registros'] = $total_registros;
        $data['registros'] = $ra;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;

        $this->load->view('usuario/list_find_usuario_view', $data);
    }

    function ver_lista_al_detalle($idm) {

        $data['registros1'] = $this->movimiento_almacen_model->ver_al_detalle($idm);
        //$data['detalle_registro'] = $this->movimiento_almacen_model->ver_al_detalle_art($idm);
        $data['id_send'] = $idm;
        $this->load->view('movimiento_almacen/ver_ingreso_view', $data);
    }

    function salidas_usuario() {
        //$p = $this->input->post("pagina");
        //$c = $this->input->post("cant");
        // $i = ($p * $c) - $c;
        $id_user = $this->input->post('id_usuario');
        $id_proy = $this->input->post('id_proyecto');
        //echo "user"+$id_user+"proyecto"+$id_proy;
        // $data['movimiento1'] = $this->movimiento_almacen_model->movi_usuario_tipo2(1, $id_user); //tipo 1 entrada 2 salida
        // $data['total_registros'] = $this->movimiento_almacen_model->movi_usuario_tipo_cantidad(1, $id_user, $id_proy);
        // $data['movimiento'] = $this->movimiento_almacen_model->movi_usuario_tipo($i, $c, 1, $id_user, $id_proy); //tipo 1 entrada 2 salida
        // $data['mostrar_X'] = $c;
        //  $data['pagina_actual'] = $p;
        $data['consulta_proy_sel'] = $this->movimiento_almacen_model->obtener_user_proy_sel($id_user);
        $data['consulta_almacen_sel'] = $this->movimiento_almacen_model->obtener_user_almacen_sel($this->session->userdata('id_admin'));
        $data['idp'] = $id_proy;
        //echo $id_proy;   
        // $data['movimiento_sel_proy'] = $this->movimiento_almacen_model->movi_usuario_tipo_proyecto($i, $c, 1, $id_user, $id_proy); //tipo 1 entrada 2 salida
        //$data['total_registros_sel_proy'] = $this->movimiento_almacen_model->movi_usuario_tipo_proyecto_cantidad(1, $id_user, $id_proy);     
        $this->load->view('movimiento_almacen/lista_movimiento_p_ingresos', $data);
    }

    /*  function salidas_usuario_sel() {
      $p = $this->input->post("pagina");
      $c = $this->input->post("cant");
      $i = ($p * $c) - $c;

      $id_user = $this->input->post('id_usuario');
      $id_proy = $this->input->post('id_proyecto');

      $mov = $this->movimiento_almacen_model->movi_usuario_tipo($i, $c, 1, $id_user); //tipo 1 entrada 2 salida
      $total_registros = $this->movimiento_almacen_model->movi_usuario_tipo_cantidad(1, $id_user);
      $mov1 = $this->movimiento_almacen_model->movi_usuario_tipo2(1, $id_user); //tipo 1 entrada 2 salida
      $data['movimiento1'] = $mov1;
      $data['total_registros'] = $total_registros;
      $data['movimiento'] = $mov;
      $data['mostrar_X'] = $c;
      $data['pagina_actual'] = $p;
      //$data['movimiento'] = $this->almacen_model->movi_usuario_tipo(1, $id_user);

      $data['consulta_proy_sel'] = $this->movimiento_almacen_model->obtener_user_proy_sel($id_user);
      $data['consulta_almacen_sel'] = $this->movimiento_almacen_model->obtener_user_almacen_sel($this->session->userdata('id_admin'));



      //$data['movimiento_sel_proy'] = $this->movimiento_almacen_model->movi_usuario_tipo_proyecto($i, $c, 1, $id_user, $id_proy); //tipo 1 entrada 2 salida
      //$data['total_registros_sel_proy'] = $this->movimiento_almacen_model->movi_usuario_tipo_proyecto_cantidad(1, $id_user, $id_proy);

      $this->load->view('movimiento_almacen/lista_movimiento_p_ingresos', $data);
      } */

    function obtener_detalle_movimiento() {
        $id_mov = $this->input->post('id_mov');
        $data['detalle'] = $this->movimiento_almacen_model->obtener_detalle_movimiento1($id_mov);
        $data['ids'] = $this->input->post('selecionados');
        $data['movimiento1'] = $this->movimiento_almacen_model->obtener_nuevo_mov($id_mov);
        $this->load->view('movimiento_almacen/detalle_movimiento', $data);
    }

    function busqueda_lista_art() {
        //  echo 'funciona';
        $busqueda = $this->input->post('busqueda');
        $cant = $this->input->post('cant');
        $pag = $this->input->post('pag');
        $ini = ($pag * $cant) - $cant;
        $data['ind'] = $ini;
        $data['no_reg'] = $this->producto_servicio_model->cant_busqueda($busqueda);
        $data['mostrar'] = $cant;
        $data['pagina'] = $pag;

        // $data['id_send'] = $id_ar;
        $data['consulta_art'] = $this->producto_servicio_model->busqueda_prod_serv_p($busqueda, $cant, $ini);

        //  $data['consulta_sn'] = $this->movimiento_almacen_model->busqueda_serial_number();
        $data['busqueda'] = $busqueda;
        $data['ids'] = $this->input->post('selecionados');

        $idmov = $this->input->post('id_mov');
        $data['idma'] = $idmov;

        //  echo "el id enviado es ". $idmov;
        if ($idmov != 0) {
            $data['consulta_ma'] = $this->movimiento_almacen_model->obtener_mov_alm($idmov); //utilizacion tabla mov.almacen
        }
        $this->load->view('movimiento_almacen/articulo_view', $data);
    }

    function pro_serv_save() {
        // if ($this->input->post('id_ma') == 0) {
        $this->movimiento_almacen_model->save_pro_serv();
        //}  
    }

    function listar_usuario_mov() {
        $respuesta = $this->usuario_model->listar_usuarios();
        echo $respuesta;
    }

    /* function obtener_user_proy() {
      //$id_per = $this->input->post('id_personal');

      //$data['ids'] = $this->input->post('selecionados');
      //  $data['movimiento1'] = $this->movimiento_almacen_model->obtener_nuevo_mov($id_mov);
      $this->load->view('movimiento_almacen/lista_movimiento_p_ingresos', $data);
      }
     */

    function seriales_obtenidos_tipo() {
        $tipo = $this->input->post('tipo_requerido');
        $id_almacen = $this->input->post('almacen');
        $id_producto = $this->input->post('id_sp');
        $cant = $this->input->post('cant');
// echo $id_producto;
        $resultado_array = $this->movimiento_almacen_model->seriales_registradas_existencia_almacen_tipo($id_almacen, $id_producto, $tipo);
        //echo 'entra';
        if ($resultado_array != "")
            echo 'Ultimo cod propio:' . $resultado_array;
        else
            echo 'Ultimo cod propio: no encontrado';
    }

    /// movimiento de almacen ingreso con solicitud de devolucion de material
    function almacen_nuevo_dev($id_dev_mat) {
        $data['id_send'] = $id_dev_mat;
        $data['movimiento_ingreso'] = $this->movimiento_almacen_model->obterner_sol_dev_ingreso($id_dev_mat); //tipo 1 entrada 2 salida
        $data['movimiento_alm'] = $this->movimiento_almacen_model->obterner_sol_dev_alm_ingreso($id_dev_mat); //tipo 1 entrada 2 salida
        $data['movimiento_detalle'] = $this->movimiento_almacen_model->obterner_sol_dev_det_mov_alm_ingreso($id_dev_mat); //tipo 1 entrada 2 salida

        $this->load->view('movimiento_almacen/nuevo_almacen_dev_view', $data);
    }

    //nueva funcion ruben
    //guarda el movimienjto de almacen retiro directo 
    function save_mov_alm_retiro_directo() {


        $id_mov_alm = $this->input->post('id_mov_alm');
        if ($id_mov_alm == 0)
            echo $this->movimiento_almacen_model->guarda_mov_alm_directo_y_kardex();
        else {
            // echo ">>>>>>>".$id_mov_alm;
            echo $this->movimiento_almacen_model->edita_mov_alm_directo_y_kardex($id_mov_alm);
        }
    }

    function almacen_retiro_directo($id_ar) {
        $this->load->model('usuario_model');
        $this->load->model('almacen_model');
        // $id_user = $this->input->post('id_personal');
        $data['personal_datos'] = $this->usuario_model->lista_usuarios_activos();
        //$data['busqueda_proy'] = $this->movimiento_almacen_model->busq_user_proy($id_user);
        $data['almacen_datos'] = $this->almacen_model->listar_almacen_responsable_almacen($this->session->userdata('id_admin'));
        $data['oficinas_datos'] = $this->almacen_model->lista_region_oficinas();

        $data['id_send'] = $id_ar;
        //echo "el id enviado es ". $id_ar;
        if ($id_ar != 0) {
            $data['inf_retiro'] = $this->movimiento_almacen_model->obtener_mov_alm($id_ar); //utilizacion tabla mov.almacen
            $data['inf_detalle_retiro'] = $this->movimiento_almacen_model->obtener_detalle_movimiento1($id_ar);
        }
        $this->load->view('movimiento_almacen/nuevo_almacen_view_retiro_directo', $data);
    }

    //paula
    /* function almacen_retiro_directo($id_ar) {
      $this->load->model('usuario_model');
      $this->load->model('almacen_model');
      $data['id_send'] = $id_ar;
      $data['personal_datos']=$this->usuario_model->lista_usuarios_activos();
      $data['almacen_datos']=$this->almacen_model->listar_almacen_responsable_almacen($this->session->userdata('id_admin'));
      //$this->load->view('movimiento_almacen/nuevo_almacen_view_retiro_directo', $data);
      $this->load->view('movimiento_almacen/nuevo_almacen_view', $data);
      } */

    function seriales_registradas_tipo() {
        $tipo = $this->input->post('tipo_requerido');
        $id_almacen = $this->input->post('almacen');
        $id_producto = $this->input->post('id_sp');
        $cont = $this->input->post('cont');
        $seleccionado = $this->input->post('seleccionado');

        // echo $id_producto;
        $resultado_array = $this->movimiento_almacen_model->seriales_registradas_existencia_almacen($id_almacen, $id_producto, $tipo);

        if (count($resultado_array) > 0) {
            echo "<select id='seriales" . $id_producto . "-" . $cont . "' onchange='asigna_serial_codprop(\"seriales" . $id_producto . "-" . $cont . "\",\"sn\",\"cp\",\"" . $id_producto . "-" . $cont . "\" );genera_otra_opcion(\"otra_opcion\")'>";
            echo "<option value='0'>seleccione...</option>";
            for ($i = 0; $i < count($resultado_array); $i++) {
                $sele = "";
                if ($resultado_array[$i] == $seleccionado)
                    $sele = "selected='selected'";
                echo "<option value='" . $resultado_array[$i] . "' $sele >" . $resultado_array[$i] . "</option>";
            }
            if ($tipo == "Ingreso")
                echo "<option value='SN'>Adicionar nuevo Cod Propio y SN</option>";
            echo "</select>";
        } else {
            if ($tipo == "Ingreso") {
                echo "<select id='seriales" . $id_producto . "' onchange='asigna_serial_codprop(\"seriales" . $id_producto . "-" . $cont . "\",\"sn\",\"cp\",\"" . $id_producto . "-" . $cont . "\" );genera_otra_opcion(\"otra_opcion" . $id_producto . "\"," . $id_producto . ",1)'>";
                echo "<option value='0'>Seleccione una opcion</option>";
                echo "<option value='nuevo'>Adicionar nuevo Cod Propio y SN</option>";
                echo "</select>";
            } else {
                echo "No se han encontrado SERIES debe realizar el ingreso inicialmente";
            }
        }
    }

    //paula
//    function seriales_registradas_tipo_in() { 
//       $tipo = $this->input->post('tipo_requerido');
//        $id_almacen = $this->input->post('almacen');
//        $id_producto = $this->input->post('id_sp');
//        $cont = $this->input->post('cont');
//
//        // echo $id_producto;
//        $resultado_array = $this->movimiento_almacen_model->seriales_registradas_existencia_almacen($id_almacen, $id_producto, $tipo);
//
//        if (count($resultado_array) > 0) {
//            echo "<select id='seriales" . $id_producto . "-" . $cont . "' onchange='asigna_serial_codprop(\"seriales" . $id_producto . "-" . $cont . "\",\"sn\",\"cp\",\"".$id_producto. "-" . $cont ."\" );genera_otra_opcion(\"otra_opcion" . $id_producto . "-" . $cont . "\"," . $id_producto . ",1,$cont)'>";
//            echo "<option value='0'>Seleccione una opcion</option>";
//            for ($i = 0; $i < count($resultado_array); $i++) {
//                if($resultado_array[$i]!=" * SN: ")
//                    echo "<option value='" . $resultado_array[$i] . "'>" . $resultado_array[$i] . "</option>";
//            }
//            if ($tipo == "Ingreso")
//                echo "<option value='SN'>Adicionar nuevo Cod Propio y SN</option>";
//            echo "</select>";
//        } else {
//            if ($tipo == "Ingreso") {
//                echo "<select id='seriales" . $id_producto . "-" . $cont . "' onchange='asigna_serial_codprop(\"seriales" . $id_producto. "-" . $cont  . "\",\"sn\",\"cp\",\"".$id_producto. "-" . $cont ."\" );genera_otra_opcion(\"otra_opcion" . $id_producto . "-" . $cont . "\"," . $id_producto . ",1,$cont)'>";
//                echo "<option value='0'>Seleccione una opcion</option>";
//                echo "<option value='SN'>Adicionar nuevo Cod Propio y SN</option>";
//                echo "</select>";
//            } else {
//                echo "No se han encontrado SERIES debe realizar el ingreso inicialmente";
//            }
//        }
//    }

    function seriales_registradas_tipo_in() {
        $tipo = $this->input->post('tipo_requerido');
        $id_almacen = $this->input->post('almacen');
        $id_producto = $this->input->post('id_sp');
        $cont = $this->input->post('cont');

        // echo $id_producto;
        $resultado_array = $this->movimiento_almacen_model->seriales_registradas_existencia_almacen($id_almacen, $id_producto, $tipo);
        $codigo_autocomplete = "";
        if (count($resultado_array) > 0) {
            /*    echo "<select id='seriales" . $id_producto . "-" . $cont . "' 
             * onchange='asigna_serial_codprop(\"seriales" . $id_producto . "-" . $cont . "\",\"sn\",\"cp\",\"" . $id_producto . "-" . $cont . "\" );
             * genera_otra_opcion(\"otra_opcion" . $id_producto . "-" . $cont . "\"," . $id_producto . ",1,$cont)'>";
              echo "<option value='0'>Seleccione una opcion</option>";
              for ($i = 0; $i < count($resultado_array); $i++) {
              if ($resultado_array[$i] != " * SN: ")
              echo "<option value='" . $resultado_array[$i] . "'>" . $resultado_array[$i] . "</option>";
              }
              if ($tipo == "Ingreso")
              echo "<option value='SN'>Adicionar nuevo Cod Propio y SN</option>";
              echo "</select>"; */

            $lista = '';
            $sw = 1;
            for ($i = 0; $i < count($resultado_array); $i++) {
                if ($resultado_array[$i] != " * SN: ") {
                    if ($sw == 1) {
                        $lista.="'" . $resultado_array[$i] . "'";
                        $sw = 0;
                    } else
                        $lista.=",'" . $resultado_array[$i] . "'";
                }
            }

            $codigo_autocomplete = '<div class="grid_6">'
                    . '<input type="text" class="input_redond_250" style="margin:0 0 0 0;" '
                    . 'value="" id="seriales' . $id_producto . "-" . $cont . '"'
                    . 'onchange="asigna_serial_codprop(\'seriales' . $id_producto . '-' . $cont . '\',\'sn\',\'cp\',\'' . $id_producto . '-' . $cont . '\' )" >'
                    . '<div class="nuevoCod milink" title="Nuevo Codigo Personal y Nro de Serie"'
                    . ' onclick="genera_otra_opcion(\'otra_opcion' . $id_producto . '-' . $cont . '\',' . $id_producto . ',1,' . $cont . ')" ></div>'
                    . '<script>$("#seriales' . $id_producto . "-" . $cont . '").autocomplete({source:[' . $lista . ']});</script> </div>';
            echo $codigo_autocomplete;
        } else {
            if ($tipo == "Ingreso") {
                echo "<select id='seriales" . $id_producto . "-" . $cont . "' onchange='asigna_serial_codprop(\"seriales" . $id_producto . "-" . $cont . "\",\"sn\",\"cp\",\"" . $id_producto . "-" . $cont . "\" );genera_otra_opcion(\"otra_opcion" . $id_producto . "-" . $cont . "\"," . $id_producto . ",1,$cont)'>";
                echo "<option value='0'>Seleccione una opcion</option>";
                echo "<option value='SN'>Adicionar nuevo Cod Propio y SN</option>";
                echo "</select>";
            } else {
                echo "No se han encontrado SERIES debe realizar el ingreso inicialmente";
            }
        }
    }

    function codigo_ope_sol_mat_ru($id_ma) {
        //echo $id_ma;
        $data['consul5'] = $this->movimiento_almacen_model->obt_per_encargado_ru($id_ma);
        $data["mensaje"] = "";
        $this->load->view('movimiento_almacen/cod_ope_view_retiro', $data);
    }

    function cambiar_estado_retiro() {
        //echo 'FUNCIONA';
        $estado = $this->input->post('estado');
        $id_mov_alm = $this->input->post('id_ma');
        $data['cambio'] = $this->movimiento_almacen_model->cambiar_estado_retiro($estado, $id_mov_alm);
    }

    function desde_otra_bd() {
        echo "entra a la funcion";

        $this->load->model("prueba_otra_bd");
        $this->prueba_otra_bd->lista_proveedores();
    }

    //adicionado 12/09/16


    function index_af($padre, $hijo) {
        $data['titulo'] = 'KARDEX Activos Fijos';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;
        $data['datos_item_hijo'] = $hijo;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'movimiento_almacen/listado_materiales_cod_ser_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function index_af_ingresos($padre, $hijo) {
        $data['titulo'] = 'KARDEX Activos Fijos';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre'] = $padre;
        $data['datos_item_hijo'] = $hijo;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'movimiento_almacen/listado_materiales_cod_ser_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_lista_activos_fijos() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $ra = $this->movimiento_almacen_model->listar_buscar_materiales_cod_ser($b, $i, $c);
        $total_registros = $this->movimiento_almacen_model->listar_buscar_materiales_cod_ser_cantidad($b);
        $data['total_registros'] = $total_registros;
        $data['registros'] = $ra;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('movimiento_almacen/list_find_materiales_cod_serial_view', $data);
    }

////funcion agregada para copiar del ingreso a la salida

    function almacen_copia_ingreso_retiro($id_ar) {

        //echo "<br>***".$id_ar."***<br>";
        $this->load->model('usuario_model');
        $this->load->model('almacen_model');
        // $id_user = $this->input->post('id_personal');
        $data['personal_datos'] = $this->usuario_model->lista_usuarios_activos();
        //$data['busqueda_proy'] = $this->movimiento_almacen_model->busq_user_proy($id_user);
        $data['almacen_datos'] = $this->almacen_model->listar_almacen_responsable_almacen($this->session->userdata('id_admin'));
        $data['oficinas_datos'] = $this->almacen_model->lista_region_oficinas();

        $data['id_send_copi'] = $id_ar;
        $data['id_send'] = 0;
        //echo "el id enviado es ". $id_ar;
        if ($id_ar != 0) {
            $data['inf_retiro'] = $this->movimiento_almacen_model->obtener_mov_alm($id_ar); //utilizacion tabla mov.almacen
            $data['inf_detalle_retiro'] = $this->movimiento_almacen_model->obtener_detalle_movimiento1($id_ar);
        }
        $this->load->view('movimiento_almacen/nuevo_almacen_view_retiro_copia', $data);
    }

    //funcion que devuelde el comentario final del articulo comp tal 30/09/2016

    function obtener_comentario_articulo_serie() {
        $sn = $this->input->post('sn');
        $cp = $this->input->post('cp');
        //echo 'pasa';
        $comentario = $this->movimiento_almacen_model->obtener_comentario_articulo_serie($cp, $sn);
        echo $comentario;
    }

//funcion que copia informacion a un movimiento de tipo RETIRO TRASPASO

    function almacen_copia_ingreso_retiro_traspaso($id_ar) {

        //echo "<br>***".$id_ar."***<br>";
        $this->load->model('usuario_model');
        $this->load->model('almacen_model');
        // $id_user = $this->input->post('id_personal');
        $data['personal_datos'] = $this->usuario_model->lista_usuarios_activos();
        //$data['busqueda_proy'] = $this->movimiento_almacen_model->busq_user_proy($id_user);
        $data['almacen_datos'] = $this->almacen_model->listar_almacen_responsable_almacen($this->session->userdata('id_admin'));
        $data['oficinas_datos'] = $this->almacen_model->lista_region_oficinas();

        $data['id_send_copi'] = $id_ar;
        $data['id_send'] = 0;
        //echo "el id enviado es ". $id_ar;
        if ($id_ar != 0) {
            $data['inf_retiro'] = $this->movimiento_almacen_model->obtener_mov_alm($id_ar); //utilizacion tabla mov.almacen
            $data['inf_detalle_retiro'] = $this->movimiento_almacen_model->obtener_detalle_movimiento1($id_ar);
        }
        $this->load->view('movimiento_almacen/nuevo_almacen_view_retirotraspaso_copia', $data);
    }

}
