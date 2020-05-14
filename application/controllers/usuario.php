<?php

class usuario extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('usuario_model');
        $this->load->model('movimiento_almacen_model');
        $this->load->model('detalle_mih_model');
        $this->load->model('producto_servicio_model');
        if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }

    function buscarusuarioporci() {
        $ci = $this->input->get('ci');
        $this->usuario_model->obtenerAdministradorCI($ci);
    }

    function obtener_cuentas_usuario() {

        $cuentas = $this->usuario_model->obtener_cuentas_banco($this->input->post('id_user'));
        $cuenta_sel = $this->input->post('id_sel');

        $codigo = "Cuenta de banco del usuario:<br><select class='form-control' id='cuenta_banco_usuario' >";
        if ($cuentas->num_rows() > 0) {
            foreach ($cuentas->result() as $cuenta) {
                $sel = "";
                if ($cuenta_sel == $cuenta->id_cuenta)
                    $sel = "selected='selected'";
                $codigo.="<option value='$cuenta->id_cuenta' $sel>$cuenta->Banco cta:$cuenta->cuenta</option>";
            }
        } else
            $codigo.="<option value='0'>NO tiene cuentas de banco registrados</option>";
        $codigo.="<option value='-1' class='bg-green' >Registrar Otra Cuenta de Banco</option>";
        $codigo.="</select>";
        echo $codigo;
    }

    //funcion Lista de clientes_contactos_ invita a la vista maestra de clientes
    function index($padre, $hijo = null) {

        $data['titulo'] = 'Usuarios';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);



        // $usuario = $this->usuario_model->listar_usuarios();
        //$data['datos_usuario'] = $usuario; //para mostrar en la pantalla cambiar en usuarios
        // $contactos_usuario = array();
        // foreach ($usuarios as $us) {
        //     $contactos_usuario[$us->cod_user] = $this->usuario_model->lista_contacto_cliente($cli->id_cliente);
        // para mostra en pantalla detalle de los modulos cambiar para contactos
        // }
        // $data['contactos_cliente'] = $contactos_cliente;


        $data['vista_enviada'] = 'usuario/usuario_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    //funciones de cliente
    function usuario_nuevo($id_usuario) {
        $data['d_usuario'] = $this->usuario_model->obtener_user($id_usuario);
        $data['id_send'] = $id_usuario;
        $this->load->view('usuario/nuevo_usuario_view', $data);
    }

    function guardar_usuario() {
        $respuesta = $this->usuario_model->guardar_usuario_nuevo();

        echo $respuesta;
    }

    function listar_usuario() {
        $respuesta = $this->usuario_model->listar_usuarios();
        echo $respuesta;
    }

    function busqueda_usuario() {

        $lp1 = $this->movimiento_almacen_model->find_mov_detalle($i, $c);
        $total_registros = $this->movimiento_almacen_model->find_mov_detalle_cant();

        $data['total_registros'] = $total_registros;
        $data['registros'] = $lp1;
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $this->load->view('usuario/list_find_usuario_view', $data);
    }

    //funciones de contacto
    function contacto_nuevo($id_cliente, $id_contacto) {
        $data['d_cliente'] = $this->cliente_model->obtener_cliente($id_cliente);
        $data['d_contacto'] = $this->cliente_model->obtener_contacto($id_contacto);
        $data['l_contactos'] = $this->cliente_model->lista_contacto_cliente($id_cliente);
        $this->load->view('clientes/nuevo_contacto_view', $data);
    }

    function guardar_contacto_cliente_nuevo() {
        $respuesta = $this->cliente_model->guardar_contacto_nuevo_cliente();
        echo $respuesta;
    }

    function busqueda_usuario_arbol() {
        $this->load->model('dependientes_model');
        //$matriz = $this->basicauth->datosSession();
        $data['permisos_usuario'] = $this->dependientes_model->obtener_datos_permisos($this->input->post('proyecto'), $this->session->userdata('id_admin'));
        echo 'funciona';
        $data['tabla_resultado'] = $this->usuario_model->busqueda_personal_1_parametro();


        $resultados = $data['tabla_resultado'];

        $tabla_estados = array();
        $i = 0;
        foreach ($resultados as $res) {
            $tabla_estados[$i] = $this->dependientes_model->verificar_ultimo_estado($res->cod_user);
            //echo "idpara veificar esado".$res->codadm_pk. " estado ". $tabla_estados[$i];
            $i++;
        }
        $data['tabla_estados'] = $tabla_estados;
        $this->load->view('usuario/resultado_busqueda_lista_view', $data);
    }

    //nueva funcion ruben
    function respuesta_propyecto_por_usuario() {
        $option = $this->usuario_model->obtProyectoUsuario($this->input->post('id_usuario'));
        $nombre_camp = $this->input->post("id_campo");
        $s = $this->input->post('seleccionado');
        //echo "<br>".$s;
        if ($option->num_rows() > 0) {
            echo " select id='" . $nombre_camp . "'>";
            foreach ($option->result() as $reg) {
                if ($s == $reg->id_proy)
                    echo "<option selected='selected' value='" . $reg->id_proy . "'>" . $reg->nombre . "</option>";
                else
                    echo "<option value='" . $reg->id_proy . "'>" . $reg->nombre . "</option>";
            }
            echo "</select>";
            echo "<script>$('#save').button('enable');</script>";
        }
        else {
            echo "<script>$('#save').button('disable');</script> no tiene proyectos asignados";
        }
    }

    function select_personal_dependiente() {
        $idProy = $this->input->post('proy');
        $usuarioX = $this->session->userdata('id_admin');
        $seleccionado = $this->input->post('seleccionado');
        $id_elemento = $this->input->post('id_elemento');

        //echo $seleccionado;
        $resp = $this->usuario_model->obtener_dependientes_bajo_nivel($usuarioX, $idProy);
        if ($resp->num_rows() > 0) {
            echo "<select id='$id_elemento'>";
            foreach ($resp->result() as $dep) {
                if ($seleccionado == $dep->cod_user)
                    echo "<option value ='$dep->cod_user' selected='selected'> $dep->ap_paterno $dep->ap_materno, $dep->nombre</option>";
                else
                    echo "<option value ='$dep->cod_user'> $dep->ap_paterno $dep->ap_materno, $dep->nombre</option>";
            }
            echo "</select>";
        } else {
            echo "no se han encontrado dependientes , configure en el arbol de dependientes o comuniquese con su inmediato superior con permiso de asignacion de personal";
        }
    }

    //USUARIOSSSSSSS      
    function find_list_user() {
        $bajas = $this->input->post("conbajas");
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        // echo $bajas."<br>";
        $data['total_registros'] = $this->usuario_model->listar_usuarios_all_cantidad($b, $bajas);

        $data['registros'] = $this->usuario_model->listar_usuarios_all($b, $i, $c, $bajas);
        $registros = $data['registros'];
        $proyxuser = array();

        foreach ($registros as $reg) {
            $proyxuser[$reg->cod_user] = $this->usuario_model->obtProyectoUsuario($reg->cod_user);
        }

        $data['proy'] = $proyxuser;


        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('usuario/list_find_usuario_all_view', $data);
    }

    function file_personal_form($padre, $hijo) {
        $this->load->model('lib_code');
        $this->load->model('proyecto_model');
        $data["datos_usuario"] = $this->usuario_model->obtener_user($this->session->userdata('id_admin'));
        $inf_user = $data["datos_usuario"]; //echo "hasta aqui";
        $data['titulo'] = 'Mi informacion personal';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);

        //parte del formulario para carga de imagenes
        $imgcif = "imagenesweb/icono/cifron.png";
        $imgcit = "imagenesweb/icono/citra.png";
        $imgusr = "imagenesweb/icono/user_64.png";
        $imglic = "imagenesweb/icono/licencia.png";
        $imgfir = "imagenesweb/icono/firma.png";
        if ($inf_user->ruta_ci_fron != "")
            $imgcif = $inf_user->ruta_ci_fron;
        if ($inf_user->ruta_ci_tra != "")
            $imgcit = $inf_user->ruta_ci_tra;
        if ($inf_user->fotografia_actual != "")
            $imgusr = $inf_user->fotografia_actual;
        if ($inf_user->adj_licencia != "")
            $imglic = $inf_user->adj_licencia;


        $data['up_ci_frontal'] = $this->lib_code->block_cargaImagen("up_ci_fron", $imgcif, array("alto" => '100', "ancho" => '150'), "ci_user", $this->session->userdata('id_admin') . "_ci_f" . $inf_user->ap_paterno, "cifront");
        $data['up_ci_trasero'] = $this->lib_code->block_cargaImagen("up_ci_tras", $imgcit, array("alto" => '100', "ancho" => '150'), "ci_user", $this->session->userdata('id_admin') . "_ci_t" . $inf_user->ap_paterno, "citra");
        $data['up_foto_user'] = $this->lib_code->block_cargaImagen("up_foto_user", $imgusr, array("alto" => '150', "ancho" => '150'), "fotouser", $this->session->userdata('id_admin') . "_foto_" . $inf_user->ap_paterno, "foto_user");
        $data['up_licencia'] = $this->lib_code->block_cargaImagen("up_licencia", $imglic, array("alto" => '100', "ancho" => '150'), "ci_user", $this->session->userdata('id_admin') . "_lic_" . $inf_user->ap_paterno, "licen_user");
        $data['up_firma'] = $this->lib_code->block_cargaImagen("up_firma", $imgfir, array("alto" => '100', "ancho" => '150'), "ci_user", $this->session->userdata('id_admin') . "_firma_" . $inf_user->ap_paterno, "firma_user");

        //carga informacion del formulario previo


        $data["proyecto_seleccion"] = $this->proyecto_model->obtProyectos();
        $data['vista_enviada'] = 'usuario/file_personal_formulario_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function actualizar_rutas_adjuntas() {
        $this->usuario_model->actualizar_daactualizar_rutas_archivos_adjuntos_personal($this->session->userdata('id_admin'));
    }

    function actualizar_informacion_faltante() {

        $this->usuario_model->actualizar_datos_personal($this->session->userdata('id_admin'));
    }

    //adri
    function ver_usuario($id_usuario) {
        $this->load->model('experiencia_laboral_model');
        $this->load->model('estudio_personal_model');
        $this->load->model('proyecto_model');
        $data['d_usuario'] = $this->usuario_model->obtener_user($id_usuario);
        echo 'esto es una vista' . $data['d_usuario']->id_proyecto_actual;
        $data['exp_usuario'] = $this->experiencia_laboral_model->lista_experiencia($id_usuario);
        $data['est_usuario'] = $this->estudio_personal_model->lista_logro_academico($id_usuario);

        if ($data['d_usuario']->id_proyecto_actual != "") {
            // echo 'INGRESA POR VERDAD';
            // echo 'esto es una vista'.$data['d_usuario']->id_proyecto_actual;

            $data['proyecto'] = $this->proyecto_model->obtener_datos_proyecto_2($data['d_usuario']->id_proyecto_actual);
            echo 'esto es una segunda vista' . $data['proyecto']->descripcion;
        } else {
            $data['proyecto'] = '0';
        }
        //echo 'esto es proyecto'.$data['proyecto']->descripcion;    
        $data['id_send'] = $id_usuario;
        $this->load->view('usuario/ver_usuario_view', $data);
    }

    function index_proyecto($padre, $hijo) {

        $data['titulo'] = 'Lista de Personal (proyectos)';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);

        $data['lista_proyectos'] = $this->usuario_model->obtProyectoUsuario($this->session->userdata('id_admin'));

        // $usuario = $this->usuario_model->listar_usuarios();
        //$data['datos_usuario'] = $usuario; //para mostrar en la pantalla cambiar en usuarios
        // $contactos_usuario = array();
        // foreach ($usuarios as $us) {
        //     $contactos_usuario[$us->cod_user] = $this->usuario_model->lista_contacto_cliente($cli->id_cliente);
        // para mostra en pantalla detalle de los modulos cambiar para contactos
        // }
        // $data['contactos_cliente'] = $contactos_cliente;


        $data['vista_enviada'] = 'usuario/usuario_view_responsable';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function find_list_user_proyecto() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $proy = $this->input->post("id_proyecto");
        $i = ($p * $c) - $c;

        $data['total_registros'] = $this->usuario_model->listar_usuarios_proyectos_cantidad($b, $this->session->userdata('id_admin'), $proy);

        $data['registros'] = $this->usuario_model->listar_usuarios_proyectos($b, $i, $c, $this->session->userdata('id_admin'), $proy);
        $registros = $data['registros'];
        $proyxuser = array();

        foreach ($registros as $reg) {
            $proyxuser[$reg->cod_user] = $this->usuario_model->obtProyectoUsuario($reg->cod_user);
        }

        $data['proy'] = $proyxuser;

        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('usuario/list_find_usuario_proyectos_view', $data);
    }

    /////////////////////////////////////////
    /// FUNCIONES QUE AYUDAN A VACACIONES ///
    ///     ruben payrumani ino           ///
    ////////////////////////////////////////
    function restaHoras($horaFin, $horaIni) {
//        echo '<br>^^^^^^^^^^^^<br>hora_menor: ' . $horaIni;
//        echo '<br>hora_mayor: ' . $horaFin;
        $resta = date("H:i:s", strtotime("00:00:00") + strtotime($horaFin) - strtotime($horaIni));
//        echo '<br>resta: ' . $resta . '<br>^^^^^^^^^^^^<br>';
        return $resta;
    }

    function sumarHoras($h1, $h2) {
        $h2h = date('H', strtotime($h2));
        $h2m = date('i', strtotime($h2));
        $h2s = date('s', strtotime($h2));
        $hora2 = $h2h . "hour" . $h2m . "min" . $h2s . "second";
        $horas_sumadas = $h1 . " + " . $hora2;
        $text = date('H:i:s', strtotime($horas_sumadas));
        return $text;
    }

    function convertir_formatoHora_aDecimal($hora) {
        $hor = date('H', strtotime($hora));
        $min = date('i', strtotime($hora));
        if ($min == 15)
            return ($hor + 0.25);
        elseif ($min == 30)
            return ($hor + 0.5);
        elseif ($min == 45)
            return( $hor + 0.75);
        else
            return $hor;
    }

    function calculo_vacaciones() {
        $this->load->model('justificaciones_model');
        $usuario = $this->input->post('user');

        $vector_dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');

        //
        $aniosTrabajados = $this->justificaciones_model->total_diasTrabajados($usuario)->row()->diasTrab;
        // echo "años trabajados".$aniosTrabajados;
        $vacacion = 0;
        $vacacion_saldo = 0;
        $dias_trabajados_vac = 0;
        if ($aniosTrabajados >= 1) {
            for ($i = 1; $i <= $aniosTrabajados; $i++) {
                if ($i >= 10)
                    $vacacion += 30 * 8;
                else if ($i >= 5)
                    $vacacion += 20 * 8;
                else
                    $vacacion += 15 * 8;
            }
            $dias_trabajados_vac = $vacacion;
            $restaVacacion = 0;
            $registroJustif = $this->justificaciones_model->dias_justificacion($usuario)->result();

            foreach ($registroJustif as $fila) { // recorre todas las justificaciones
                // echo "Vacacion inicial : " . $vacacion . "<br>";
                // echo "Tipo_permiso : " . $fila->tipo . "<br>";
                if ($fila->tipo == 'Permiso Vacacion') {
                    $fechaIni = $fila->fecha_inicio;
                    $fechaFin = $fila->fecha_fin;
                    $fecha = $fechaIni;  //inicia en fecha ini
//                    echo '<br>----------------------------------------------<br>fecha inicio' . $fechaIni . '<br>';
//                    echo 'fecha fin' . $fechaFin . '<br>';
//                    echo 'diferncia dias' . $fila->dif_diasPermiso . '<br>';

                    $cant_horasJustif = 0; // cerea para cada justificacion
                    for ($i = 0; $i <= $fila->dif_diasPermiso; $i++) { // recorre todos los dias de la justificacion y cuenta las horas
                        $dia = strtotime($fecha);

                        $diaSemana = $vector_dias[date("w", mktime(0, 0, 0, date("m", $dia), date("d", $dia), date("Y", $dia)))];

                        $registro = $this->justificaciones_model->tipoHorario($usuario, $diaSemana, $fecha, $fechaFin);
                        if ($registro->num_rows() > 0) {
                            //echo '<br>' . $diaSemana . ' ' . $fecha;
                            $horario = $registro->row();
                            $cant_horasDia = '00:00:00';
                            // echo "llega hasta aqui y pregunta " . date("Y-m-d", strtotime($fechaIni)) . "==" . date("Y-m-d", strtotime($fechaFin)) . "<br>";
                            if (date("Y-m-d", strtotime($fechaIni)) == date("Y-m-d", strtotime($fechaFin))) { // para el caso en el que solo es un dia de permiso
                                // echo 'solo un dia de permiso<br>';
                                $hora_ini = $horario->hora_primerDia;
                                $hora_fin = $horario->hora_ultimoDia;

                                if ($horario->hora_salida_ma == '00:00:00' && $horario->hora_ingreso_ta == '00:00:00' && $hora_ini < $hora_fin) {
                                    if ($hora_ini >= $horario->hora_ingreso_ma && $hora_ini <= $horario->hora_salida_ta &&
                                            $hora_fin >= $horario->hora_ingreso_ma && $hora_fin <= $horario->hora_salida_ta)
                                        $cant_horasDia = $this->restaHoras($hora_fin, $hora_ini);
                                    elseif ($hora_ini < $horario->hora_ingreso_ma &&
                                            $hora_fin >= $horario->hora_ingreso_ma && $hora_fin <= $horario->hora_salida_ta)
                                        $cant_horasDia = $this->restaHoras($hora_fin, $horario->hora_ingreso_ma);
                                    elseif ($hora_fin > $horario->hora_salida_ta &&
                                            $hora_ini >= $horario->hora_ingreso_ma && $hora_ini <= $horario->hora_salida_ta)
                                        $cant_horasDia = $this->restaHoras($horario->hora_salida_ta, $hora_ini);
                                    elseif ($hora_ini < $horario->hora_ingreso_ma && $hora_fin > $horario->hora_salida_ta)
                                        $cant_horasDia = $this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ma);
                                    else
                                        $cant_horasDia = 0; // caso donde estan fuera de los horarios
                                }
                                else {
                                    if ($hora_ini <= $horario->hora_salida_ma && $hora_ini < $hora_fin) {
                                        if ($hora_fin <= $horario->hora_salida_ma && $hora_fin >= $horario->hora_ingreso_ma) {
                                            if ($hora_ini < $horario->hora_ingreso_ma)
                                                $cant_horasDia = $this->restaHoras($hora_fin, $horario->hora_ingreso_ma);
                                            else
                                                $cant_horasDia = $this->restaHoras($hora_fin, $hora_ini);
                                        }
                                        else {
                                            if ($hora_ini < $horario->hora_ingreso_ma)
                                                $cant_horasDia = $this->restaHoras($hora_fin, $hora_ini);
                                            else
                                                $cant_horasDia = $this->restaHoras($horario->hora_salida_ma, $hora_ini);
                                        }
                                    }
                                    if ($hora_fin >= $horario->hora_ingreso_ta && $hora_ini < $hora_fin) {
                                        if ($hora_ini >= $horario->hora_ingreso_ta && $hora_ini <= $horario->hora_salida_ta) {
                                            if ($hora_fin > $horario->hora_salida_ta)
                                                $cant_horasDia = $this->sumarHoras($cant_horasDia, $this->restaHoras($horario->hora_salida_ta, $hora_ini));
                                            else
                                                $cant_horasDia = $this->sumarHoras($cant_horasDia, $this->restaHoras($hora_fin, $hora_ini));
                                        }
                                        else {
                                            if ($hora_fin > $horario->hora_salida_ta)
                                                $cant_horasDia = $this->sumarHoras($cant_horasDia, $this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ta));
                                            else
                                                $cant_horasDia = $this->sumarHoras($cant_horasDia, $this->restaHoras($hora_fin, $horario->hora_ingreso_ta));
                                        }
                                    }
                                }
                            }
                            //para casos de varios dias de permiso o vacacion
                            else if ($fecha == $fechaIni && $i == 0) {    // cant de horas del primer dia
                                //  echo '<br>primer dia<br>';
                                $hora_ini = $horario->hora_primerDia;

                                if ($horario->hora_salida_ma == '00:00:00' && $horario->hora_ingreso_ta == '00:00:00') { // caso tipo horario continuo
                                    //  echo "caso tipo horario continuo<br>";
                                    if ($hora_ini < $horario->hora_ingreso_ma)
                                        $cant_horasDia = $this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ma);
                                    else if ($hora_ini > $horario->hora_salida_ta)
                                        $cant_horasDia = 0;
                                    else
                                        $cant_horasDia = $this->restaHoras($horario->hora_salida_ta, $hora_ini);
                                }
                                else if ($hora_ini >= $horario->hora_ingreso_ma && $hora_ini <= $horario->hora_salida_ma) { // caso dentro de horario por la mañana
                                    $cant_horasDia = $this->restaHoras($horario->hora_salida_ma, $hora_ini);

                                    if ($horario->hora_ingreso_ta != '00:00:00' && $horario->hora_salida_ta != '00:00:00') // caso si existe horario por la tarde
                                        $cant_horasDia = $this->sumarHoras($cant_horasDia, $this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ta));
                                }
                                else if ($hora_ini >= $horario->hora_ingreso_ta && $hora_ini <= $horario->hora_salida_ta) { // caso dentro del horario por la tarde
                                    $cant_horasDia = $this->restaHoras($horario->hora_salida_ta, $hora_ini);
                                } else if ($hora_ini > $horario->hora_salida_ta)   // para el caso de que la hora_ini este fuera de los horarios 
                                    $cant_horasDia = 0;
                                else if ($hora_ini > $horario->hora_salida_ma)
                                    $cant_horasDia = $this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ta);
                                else
                                    $cant_horasDia = $this->sumarHoras($this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ta), $this->restaHoras($horario->hora_salida_ma, $horario->hora_ingreso_ma));

                                //  echo "1 cant_horas_dia " . $cant_horasDia . "<br>";
                            }
                            else if ($fecha == date("Y-m-d", strtotime($fechaFin))) {    // cant de horas del ultimo dia
                                //echo '<br>ultimo dia<br>';
                                $hora_fin = $horario->hora_ultimoDia;
                                if ($horario->hora_salida_ma == '00:00:00' && $horario->hora_ingreso_ta == '00:00:00') { // caso tipo horario continuo
                                    //echo '<br>caso continuo<br>';
                                    if ($hora_fin > $horario->hora_salida_ta)
                                        $cant_horasDia = $this->restarHoras($horario->hora_salida_ta, $horario->hora_ingreso_ma);
                                    else if ($hora_fin < $horario->hora_ingreso_ma)
                                        $cant_horasDia = 0;
                                    else
                                        $cant_horasDia = $this->restaHoras($hora_fin, $horario->hora_ingreso_ma);
                                }
                                elseif ($hora_fin >= $horario->hora_ingreso_ma && $hora_fin <= $horario->hora_salida_ma) { // caso dentro de horario por la mañana
                                    //echo '<br>caso mañana<br>';
                                    $cant_horasDia = $this->restaHoras($hora_fin, $horario->hora_ingreso_ma);
                                } elseif ($hora_fin >= $horario->hora_ingreso_ta && $hora_fin <= $horario->hora_salida_ta) { // caso dentro del horario por la tarde
                                    //echo '<br>caso tarde<br>';
                                    $cant_horasDia = $this->restaHoras($hora_fin, $horario->hora_ingreso_ta);
                                    if ($horario->hora_ingreso_ma != '00:00:00' && $horario->hora_salida_ma != '00:00:00') // caso si existe horario por la mañana
                                        $cant_horasDia = $this->sumarHoras($cant_horasDia, $this->restaHoras($horario->hora_salida_ma, $horario->hora_ingreso_ma));
                                }
                                else if ($hora_fin < $horario->hora_ingreso_ma)
                                    $cant_horasDia = 0;
                                else if ($hora_fin < $horario->hora_ingreso_ta)
                                    $cant_horasDia = $this->restaHoras($horario->hora_salida_ma, $horario->hora_ingreso_ma);
                                else
                                    $cant_horasDia = $this->sumarHoras($this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ta), $this->restaHoras($horario->hora_salida_ma, $horario->hora_ingreso_ma));

                                // echo "2 cant_horas_dia " . $cant_horasDia . "<br>";
                            }
                            else if ($fecha != $fechaIni && $fecha != $fechaFin) {  //cant de horas de los dias intermedios
                                //  echo '<br>dia intermedio<br>';
                                if ($horario->hora_salida_ma == '00:00:00' && $horario->hora_ingreso_ta == '00:00:00')
                                    $cant_horasDia = $this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ma);
                                else {
                                    $horasMañana = $this->restaHoras($horario->hora_salida_ma, $horario->hora_ingreso_ma);
                                    $horasTarde = $this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ta);
                                    $cant_horasDia = $this->sumarHoras($horasMañana, $horasTarde);
                                }
                            }
                            //  echo " 3 cant_horas_dia " . $cant_horasDia . "<br>";
                            //echo '<br>cant horas dia: ' . $cant_horasDia;
                            //echo '<br>cant horas dia en formato decimal'.$this->convertir_formatoHora_aDecimal($cant_horasDia);;
                            $cant_horasJustif+=$this->convertir_formatoHora_aDecimal($cant_horasDia);
                            //echo '-------------cant horas justif i:' . $cant_horasJustif . '<br>';
                        } else {
                            // echo '<br>' . $fecha . 'no tiene registro de horario';
                        }
                        //echo "<br>fecha_anterior".$fecha."<br>";
                        $fecha = date("Y-m-d", strtotime("$fecha + 1 days"));
                        // echo "<br>fecha_nueva".$fecha."<br>";
                    }
                    // echo '-------------cant horas justif i:' . $cant_horasJustif . '<br>';
                    //echo '<br>vacacion: ' . $vacacion;
                    $restaVacacion = $vacacion - $cant_horasJustif;
                    $vacacion_saldo+=$cant_horasJustif;

                    $vacacion = $restaVacacion;
                    //echo '<br>vacacion restada por justificacion permiso i: ' . $restaVacacion . '<br>';
                }
            }
        }
        $codigo = '<div class="f10 negrilla alin_cen" style="width: 100%;float: left; display: inline-block">Vacación</div>
                        <div class="bordeado" style="width: 31%;float: left; display: inline-block">
                            <div class="alin_cen f10">Utilizadas</div><div class="alin_cen negrilla">' . ($vacacion_saldo / 8) . '</div>
                        </div>
                        <div class="bordeado" style="width: 33%;float: left; display: inline-block">
                            <div class="alin_cen f10">Sobrantes</div><div class="alin_cen negrilla">' . ($vacacion / 8) . '</div>
                        </div>
                        <div class="bordeado" style="width: 31%;float: left; display: inline-block">
                            <div class="alin_cen f10">Calculado</div><div class="alin_cen negrilla">' . ($dias_trabajados_vac / 8) . '</div>
                </div>';

        echo $codigo;
    }

    function pruebarecursividad() {
        echo "prueba<br>";
        $jefes = $this->usuario_model->obtener_padres_proyecto(10, 1, 0, "");
        $jefes = substr($jefes, 0, (strlen($jefes) - 1));
        $jefes = str_replace("|", " or a.coduser=", $jefes);

        echo $jefes;
        echo $this->usuario_model->obtener_padres_proyecto_selec(10, 1, 0);
        echo "<br>fin prueba<br>";
    }

    function apropiacion_personal($padre, $hijo) {

        $data['titulo'] = 'Apropiacion del Personal';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $this->load->model('proyecto_model');
        $data['lista_proyectos'] = $this->proyecto_model->listar_proyectos_all();

        $data['vista_enviada'] = 'usuario/apropiacion_personal_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function find_list_user_apropiacion() {

        $bajas = $this->input->post("conbajas");
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        // echo $bajas."<br>";
        $data['total_registros'] = $this->usuario_model->listar_usuarios_all_cantidad($b, $bajas);

        $data['registros'] = $this->usuario_model->listar_usuarios_all($b, $i, $c, $bajas);
        $registros = $data['registros'];
        $proyxuser = array();
        $apropiacionxuser = array();

        foreach ($registros as $reg) {
            $proyxuser[$reg->cod_user] = $this->usuario_model->obtProyectoUsuario($reg->cod_user);
            $apropiacionxuser[$reg->cod_user] = $this->usuario_model->obtener_informacion_apropiacion_usuario($reg->cod_user);
        }

        $data['proy'] = $proyxuser;
        $data['apropi'] = $apropiacionxuser;


        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('usuario/list_find_usuario_apropiacion_view', $data);
    }

    function pruebas_fechas() {
        $this->usuario_model->obtener_informacion_apropiacion_usuario(1, 10);
    }

}

?>
  