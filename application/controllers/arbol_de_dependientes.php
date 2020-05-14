<?php

class Arbol_de_dependientes extends CI_Controller {

    function __construct() {
        parent::__construct();
        // $this->load->helper('url');
        $this->load->model('dependientes_model');
        // $this->load->model('menus_model');
        $this->load->model('menu_model');
        if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }

    function index($padre) {
        $data['titulo'] = 'Arbol de dependientes';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    //funciones de Ruben payrumani Ino*************************************************************************
    function mostrararboldeproyectoIndicado() {
        $this->load->model('usuario_model');

        //  $matriz = $this->basicauth->datosSession();
        $proyecto_id = $this->input->post('id_proyecto');
        $data['mi_propio_arbol'] = $this->dependientes_model->obtener_arbol_dependientes($proyecto_id, $this->session->userdata('id_admin'), $this->session->userdata('id_admin'));
        $data['datos_usuario_inicial'] = $this->usuario_model->obtiene_datos_usuario_inicial($this->session->userdata('id_admin'), $proyecto_id);
        $data["permisos_usuario"] = $this->dependientes_model->obtener_datos_permisos($proyecto_id, $this->session->userdata('id_admin'));
        $data["permisos_usuario"] = $this->dependientes_model->obtener_datos_permisos($proyecto_id, $this->session->userdata('id_admin'));
        $data['id_user'] = $this->session->userdata('id_admin');
        $this->load->view('Mod_disponibles/dependientes_view', $data);
    }

    function adicionar_nuevo_registro_de_alta_personal() {
        $this->load->model('historial_personal_model');
        //$matriz = $this->basicauth->datosSession();
        $id_adicion = $this->dependientes_model->adicionarNuevoRegistroDeAltaPersonalProyecto($this->session->userdata('id_admin'));
        //datos tomados por defecto
        date_default_timezone_set("Etc/GMT+4");
        $vector = array('id_adm_proy' => $id_adicion, 'tipo_registro' => 'Alta proyecto', 'fecha_registro' => date("Y-m-d H:i:s"), 'comentario' => $this->input->post('comentarioj'));
        $id_adicion_registro = $this->historial_personal_model->registrar_evento_historial_personal($vector);
    }

    function editar_permisos_de_personal_proyecto_cargo() {
        $this->load->model('usuario_model');
        $this->load->model('historial_personal_model');
        $id_registro = $this->input->post('id_registro');
        $datos_modificar = array(
            'p_vac_per' => $this->input->post('p_vac_per'),
            'p_jus' => $this->input->post('p_jus'),
            'p_baj_med' => $this->input->post('p_baj_med'),
            'p_rev_rend' => $this->input->post('p_rev_rend'),
            'env_rend' => $this->input->post('env_a'),
            'p_adicionar' => $this->input->post('p_adicionar'),
            'p_baja' => $this->input->post('p_baja'),
            'p_editar' => $this->input->post('p_editar'),
            'p_ver_historial' => $this->input->post('p_ver_historial'),
            'p_otorgar_permisos' => $this->input->post('p_otorgar_permisos'),
            'pp_vac_per' => $this->input->post('pp_vac_per'),
            'pp_jus' => $this->input->post('pp_jus'),
            'pp_baj_med' => $this->input->post('pp_baj_med'),
            'pp_add' => $this->input->post('pp_add'),
            'pp_ba' => $this->input->post('pp_ba'),
            'pp_edit' => $this->input->post('pp_edit'),
            'pp_hist' => $this->input->post('pp_hist'),
            'pp_perm' => $this->input->post('pp_perm'));
        $obs = $this->dependientes_model->EditarPermisosPersonalProyecto($id_registro, $datos_modificar);
        //datos tomados por defecto
        echo $obs;
        if ($obs != "") {
            date_default_timezone_set("Etc/GMT+4");
            $vector = array('id_adm_proy' => $id_registro, 'tipo_registro' => 'Edicion de Registro', 'fecha_registro' => date("Y-m-d H:i:s"), 'comentario' => 'cambio de permisos', 'observaciones' => $obs);
            $id_adicion_registro = $this->historial_personal_model->registrar_evento_historial_personal($vector);
        }
    }

    //recibe 2 parametros especiales los cuales dan de baja a los usuarios o los manda al inmediato superios
    // recolecta los datos para hacer modificaciones en los dependientes tambien segun lo que indique el usuario de mayor nivel

    function editar_registro_de_personal_proyecto_cargo() {
        $this->load->model('usuario_model');
        $this->load->model('historial_personal_model');

//salvar los datos a editar 
        $copia_datos_principales = array(
            'cargo' => $this->input->post('cargoj'),
            'fecha_asignacion' => $this->input->post('fecha_asignacionj'),
            'id_padre' => $this->input->post('id_padrej'),
            'regional' => $this->input->post('regionalj'),
            'estado' => 'Activo',
            'es_padre' => $this->input->post('es_padrej'));

        $id_registro = $this->input->post('registro_editar');
        if ($this->input->post('tiene_dependientesj') == 'si') {
            $datos_sin_mod = $this->usuario_model->obtenerDatos_Admin_proyecto_cargoPHP($id_registro);
            $dependientes_a_modificar = $this->usuario_model->obtiene_ependientes_usuarioX_PHP($datos_sin_mod->cod_user, $datos_sin_mod->id_proy);
            //1 pasar los usuarios a un nivel superior Editando , 0 dar baja a todos por debajo de el
            if ($this->input->post('solucion_dependientes') == 1) {
                //ha seleccionado que los dependientes del usuario subiran al nivel superior del usuario normal
                foreach ($dependientes_a_modificar->result() as $registros) {

                    $datos_iniDep = $this->usuario_model->obtenerDatos_Admin_proyecto_cargoPHP($registros->idpk);
                    $datos_editar = array(
                        'cargo' => $datos_iniDep->cargo,
                        'fecha_asignacion' => $datos_iniDep->fecha_asignacion,
                        'id_padre' => $datos_sin_mod->id_padre, //datos sin modificar asigna el id_padre del padre
                        'regional' => $datos_iniDep->regional,
                        'estado' => 'Activo',
                        'es_padre' => $datos_iniDep->es_padre);

                    $obs = $this->dependientes_model->EditarRegistroDeAltaPersonalProyecto($registros->idpk, $datos_editar);

                    date_default_timezone_set("Etc/GMT+4");
                    $vector = array('id_adm_proy' => $id_registro, 'tipo_registro' => 'Edicion de Registro', 'fecha_registro' => date("Y-m-d H:i:s"), 'comentario' => 'Cambio de Inmediato Superior , por motivo de cancelacion de dependiente en anterior inmediato superior', 'observaciones' => $obs);
                    $id_adicion_registro = $this->historial_personal_model->registrar_evento_historial_personal($vector);
                }
            } else {
                //echo 'ha seleccionado que de se baja a los registros';
                foreach ($dependientes_a_modificar->result() as $registros) {
                    $datos_iniDep = $this->usuario_model->obtenerDatos_Admin_proyecto_cargoPHP($registros->idpk);
                    // $this->input->post('fecha_bajaj') = 
                    //colocar vector para naja
                    date_default_timezone_set("Etc/GMT+4");
                    $datos = array(
                        'fecha_baja' => date("Y-m-d"),
                        'estado' => 'Inactivo',
                        'es_padre' => 0);
                    $obs = $this->dependientes_model->BajaPersonalProyecto_c_dep_d_dep_recursivo($registros->idpk, $datos);
                }
            }
        }


        $obs = $this->dependientes_model->EditarRegistroDeAltaPersonalProyecto($id_registro, $copia_datos_principales);
        //datos tomados por defecto
        if ($obs != "") {
            date_default_timezone_set("Etc/GMT+4");
            $vector = array('id_adm_proy' => $id_registro, 'tipo_registro' => 'Edicion de Registro', 'fecha_registro' => date("Y-m-d H:i:s"), 'comentario' => $this->input->post('comentarioj'), 'observaciones' => $obs);
            $id_adicion_registro = $this->historial_personal_model->registrar_evento_historial_personal($vector);
        }
    }

    function Baja_registro_de_personal_proyecto_cargo() {
        $this->load->model('usuario_model');
        $this->load->model('historial_personal_model');

//salvar los datos a editar 
        $copia_datos_principales = array(
            'fecha_baja' => $this->input->post('fecha_bajaj'),
            'estado' => 'Inactivo',
            'es_padre' => 0);
        $comentario_movimiento = $this->input->post('comentarioj');
        $id_registro = $this->input->post('registro_editar');

        $datos_sin_mod = $this->usuario_model->obtenerDatos_Admin_proyecto_cargoPHP($id_registro);

        $dependientes_a_modificar = $this->usuario_model->obtiene_ependientes_usuarioX_PHP($datos_sin_mod->cod_user, $datos_sin_mod->id_proy);
        //1 pasar los usuarios a un nivel superior Editando , 0 dar baja a todos por debajo de el
        if ($this->input->post('solucion_dependientes') == 1) {
            foreach ($dependientes_a_modificar->result() as $registros) {

                $datos_iniDep = $this->usuario_model->obtenerDatos_Admin_proyecto_cargoPHP($registros->idpk);
                $datos_editar = array(
                    'cargo' => $datos_iniDep->cargo,
                    'fecha_asignacion' => $datos_iniDep->fecha_asignacion,
                    'id_padre' => $datos_sin_mod->id_padre, //datos sin modificar asigna el id_padre del padre
                    'regional' => $datos_iniDep->regional,
                    'estado' => 'Activo',
                    'es_padre' => $datos_iniDep->es_padre);

                $obs = $this->dependientes_model->EditarRegistroDeAltaPersonalProyecto($registros->idpk, $datos_editar);

                date_default_timezone_set("Etc/GMT+4");
                $vector = array('id_adm_proy' => $id_registro,
                    'tipo_registro' => 'Edicion de Registro',
                    'fecha_registro' => date("Y-m-d H:i:s"),
                    'comentario' => 'Cambio de Inmediato Superior , por motivo de BAJA en anterior inmediato superior',
                    'observaciones' => $obs);
                $id_adicion_registro = $this->historial_personal_model->registrar_evento_historial_personal($vector);
            }
        } else {
            //echo 'ha seleccionado que de se baja a los registros';
            foreach ($dependientes_a_modificar->result() as $registros) {
                $datos_iniDep = $this->usuario_model->obtenerDatos_Admin_proyecto_cargoPHP($registros->idpk);
                // $this->input->post('fecha_bajaj') = 
                //colocar vector para naja
                date_default_timezone_set("Etc/GMT+4");
                $datos = array(
                    'fecha_baja' => date("Y-m-d"),
                    'estado' => 'Inactivo',
                    'es_padre' => 0);
                $obs = $this->dependientes_model->BajaPersonalProyecto_c_dep_d_dep_recursivo($registros->idpk, $datos);
            }
        }



        $obs = $this->dependientes_model->BajaRegistroDeAltaPersonalProyecto($id_registro, $copia_datos_principales);
        //datos tomados por defecto
        if ($obs != "") {
            date_default_timezone_set("Etc/GMT+4");
            $vector = array('id_adm_proy' => $id_registro,
                'tipo_registro' => 'Baja de proyecto',
                'fecha_registro' => date("Y-m-d H:i:s"),
                'comentario' => $this->input->post('comentarioj'),
                'observaciones' => $obs);
            $id_adicion_registro = $this->historial_personal_model->registrar_evento_historial_personal($vector);
        }
    }

    //funciones de Ruben payrumani Ino**************************************************************************

    function carga_formulariosVarios_formDialog() {
        $this->load->model('usuario_model');
        $this->load->model('destino_model');

        $data['permisos_usuario'] = $this->dependientes_model->obtener_datos_permisos($this->input->post('proyecto'), $this->session->userdata('id_admin'));
        $data['bloqueo'] = ' readonly="readonly" ';
        $tipo = $this->input->post('tipo');
        $proyec = $this->input->post('proyecto');
        $id_j = $this->input->post('id_jefe');
       // echo "prtoyectyo".$proyec."   --- ".$this->input->post('nombre_proyecto');
       // echo "idregistro ".$proyec."   --- ".$this->input->post('id_registro');
        $data['proy_nom']=$this->input->post('nombre_proyecto');
        $data['nombreProyecto'] = $this->input->post('nombre_proyecto');
        $data['deptos'] = $this->destino_model->devolverDeptos();
        $data['cargo_empleado'] = $this->usuario_model->obtener_cargos();
        $data['datos_personal'] = $this->usuario_model->obtiene_datos_usuarioXmodificado($this->input->post('id_employe'));
        $data['datos_registro'] = $this->usuario_model->obtenerDatos_Admin_proyecto_cargoPHP_modificado($this->input->post('id_registro'));
        if($this->input->post('id_registro')!=0)
        {
            $data['datos_personal'] = $this->usuario_model->obtiene_datos_usuarioXmodificado($data['datos_registro']['cod_user']);
        }
        //echo "nombrecompleto :".$data['datos_registro']['cod_user'];
        $data['nombreProyecto'] = $data['datos_registro']['proy'];
        $data['listajefes'] = $this->usuario_model->obtener_padres_proyecto_selec($proyec,$this->session->userdata('id_admin'), $data['datos_registro']['id_padre']);
        $data['depto_seleccionado'] = $data['datos_registro']['regional'];
        $data['cargo_seleccionado'] = $data['datos_registro']['cargo'];
        $data['espadre'] = $data['datos_registro']['es_padre'];
        $data['fecha_asig'] = $data['datos_registro']['fecha_asignacion'];
        $data['event_edit_es_padre'] = " onclick='detectar_dependientes_usuario_JSON_p_edit(" . $data['datos_registro']['cod_user'] . "," . $data['datos_registro']['id_proy'] . ")' ";
        //$data['listajefes'] = $this->usuario_model->obtenerPadresProyecto($proyec, $id_j, $data['datos_registro']['id_padre']);
        
        /*$data['depto_seleccionado'] = 0;
        $data['cargo_seleccionado'] = 0;
        $data['espadre'] = 2; // 2 para que no seleccione ni 1/si , ni,  0/no 
        $data['fecha_asig'] = '';
        $data['event_edit_es_padre'] = "";*/



        if ($tipo == "Adicionar" or $tipo == "Modificar") {

            if ($id_j != 0)
                $data['bloqueo'] = " placeholder='CI dependiente' onkeyup=\"BuscarUsuario( 'ci_empleado','nombre_empleado','id_empleado');\" ";
            $this->load->view('Mod_disponibles/formDialog_Mod_disponibles/fd_alta_personal_usuario_desde_busqueda_view', $data);
        }
        if ($tipo == "Baja") {

            $data['datos_registro'] = $this->usuario_model->obtenerDatos_Admin_proyecto_cargoPHP($this->input->post('id_registro'));
            $this->load->view('Mod_disponibles/formDialog_Mod_disponibles/fd_baja_personal_usuario_view', $data);
        }
        if ($tipo == "Historial") {

            $data['datos_registro'] = $this->usuario_model->obtenerDatos_Admin_proyecto_cargoPHP($this->input->post('id_registro'));
            $data['Historial'] = $this->usuario_model->obtenerDatosHistorial($data['datos_registro']->cod_user);

            $this->load->view('Mod_disponibles/formDialog_Mod_disponibles/fd_historial_personal_usuario', $data);
        }
        if ($tipo == "Permisos") {

            $data['datos_registro'] = $this->usuario_model->obtenerDatos_Admin_proyecto_cargoPHP($this->input->post('id_registro'));

            $this->load->view('Mod_disponibles/formDialog_Mod_disponibles/fd_permisos_personal_usuario_view', $data);
        }
        //tipo: Adicionar,Modificar,Baja,Historial
    }

    function mostrar_arbolDependientes($padre, $hijo=null) {

        $this->load->model('usuario_model');
        $hijos_por_padre = array();
        //$data['main_menu'] = 'menus/EnlacesHijos';
        $data['titulo'] = 'Arbol de Dependientes';

        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'), $padre);
        // $matriz = $this->basicauth->datosSession();
        $data['user'] = $this->session->userdata('nombres') . ' ' . $this->session->userdata('apellidos');
        $data['id_user'] = $this->session->userdata('id_admin');

        // $data['menu_completo'] = $this->menus_model->obtenerMenuCompleto($this->session->userdata('id_admin'));
        $data['proyectos_usuario'] = $this->usuario_model->obtProyectoUser($this->session->userdata('id_admin'));

        //$data['menu_padres'] = $this->menu_model->lista_menus_padres();
        //echo 'llego';
        //$padres = $data['menu_padres'];
        /* foreach ($padres as $p) {
          $hijos_por_padre[$p->id] = $this->menu_model->lista_menus_hijos($p->id);
          } */
        // $data['menu_hijos'] = $hijos_por_padre;
        //$data['mi_propio_arbol'] = $this->dependientes_model->obtener_arbol_dependientes(1, $matriz['id']);
        //
        // Ruben Plata
        $jefes = $this->dependientes_model->obtiene_jefes();

        //$datos_vista=array('rs_jefes'=>$jefes);
        $data['rs_jefes'] = $jefes;

        $num_dep = array();


        foreach ($jefes->result() as $fila) {
            $num_dep[] = $this->dependientes_model->contar_subdependientes($fila->cod_user);
        }

        $data['nro_dep'] = $num_dep;

        $data['vista_enviada'] = "Mod_disponibles/arbol_de_dependientes_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function listar_jefes() {
        $jefes = $this->dependientes_model->obtiene_jefes();


        $datos_vista['rs_jefes'] = $jefes;
        $datos_vista['titulo'] = "cualquier cosa";
        $num_dep = array();
        foreach ($jefes->result() as $fila) {
            $num_dep[] = $this->dependientes_model->contar_subdependientes($fila->cod_user);
        }
        $datos_vista['nro_dep'] = $num_dep;
        $this->load->view('Mod_disponibles/Arbol_de_dependientes_view', $datos_vista);
    }

    function listar_dependientes() {
        $pers_depend = $this->dependientes_model->obtiene_dependientes($this->input->post('padre'));

        $datos_vista['personal'] = $pers_depend;
        $num_dep = array();
        foreach ($pers_depend->result() as $fila) {
            $num_dep[] = $this->dependientes_model->contar_subdependientes($fila->cod_user);
        }
        $datos_vista['nro_dep'] = $num_dep;
        $this->load->view('Mod_disponibles/dependientes_view', $datos_vista);
    }

}

?>
