<?php

class AsigAdminHorario extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        //$this->load->helper('url');
       // $this->load->model('menus_model');
        $this->load->model('horarios_model');
        $this->load->model('usuario_model');
        $this->load->model('AsigAdminHorario_model');
        $this->load->model('menu_model');
             if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }

    function index($padre,$hijo)
    {
        //$matriz = $this->basicauth->datosSession();
        //$data['user'] = $matriz['nombres'] . ' ' . $matriz['apellidos'];
        //$data['main_menu'] = 'menus/EnlacesHijos';
         $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        $data['titulo'] = 'Asigna Horarios a los Usuarios';
       // $data['menu_completo'] = $this->menus_model->obtenerMenuCompleto($matriz['id']);
        $data['vista_enviada'] = "AsigAdminHorario/AsigAdminHorario_view";

        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function busqueda_usuario()
    {
        $menos_estos = $this->input->post('no_ids');
        $data['tabla_resultado'] = $this->AsigAdminHorario_model->busqueda_personal_1_parametro($menos_estos);
        $this->load->view('AsigAdminHorario/ListaUsuariosBusqueda_view', $data);
    }

    function muestraHorarios()
    {
        $horarios = $this->horarios_model->datos_hora_min();
        $data['datosHorarios'] = $horarios->result();
        $this->load->view('AsigAdminHorario/muestraHorarios_view', $data);
    }

    function listarUsuario()
    {
        //echo 'funciona';
        $cod_id = $this->input->post('cod_personal');
        $personal = $this->AsigAdminHorario_model->datos_usuario($cod_id);
        $data['datospersonal'] = $personal->result();
        $this->load->view('AsigAdminHorario/UsuariosSeleccionados_view', $data);
    }

    function Asigna()
    {
        $horarios = $this->horarios_model->datos_horarios();
        $data['datosHorarios'] = $horarios->result();
        $this->load->view('AsigAdminHorario/AsignaHorarioDias_view', $data);
    }

    function mostrar_asignaciones_de_horarios()
    {
        $id_admin = $this->input->post('id');
        $fechas = $this->AsigAdminHorario_model->obtiene_fechas_asignacion($id_admin);
        $dias = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
        $imprimir = '';
        if ($fechas->num_rows() > 0)
        {
            $imprimir = array();
            $fila_matriz[] = 'Dia \ Fecha';
            $c = 0;
            foreach ($fechas->result() as $fila)
            {
                $rango_fechas[$c][] = $fila->fec_ini_horario;
                $rango_fechas[$c][] = $fila->fec_fin_horario;
                $c++;
                $fila_matriz[] = ' <STRONG>DE</STRONG> ' . $fila->fec_ini_horario . ' <STRONG   >AL</STRONG> ' . $fila->fec_fin_horario;
            }
            $imprimir[] = $fila_matriz;
            for ($j = 0; $j < 6; $j++)
            {
                $fila_matriz = array();
                $fila_matriz[] = $dias[$j];
                for ($i = 0; $i < count($rango_fechas); $i++)
                {
                    $variable = $this->AsigAdminHorario_model->obtiene_horario_deFecha($id_admin, $rango_fechas[$i][0], $rango_fechas[$i][1], $dias[$j]);
                    if ($variable->num_rows() > 0)
                        $fila_matriz[] = $variable->row()->nombre;
                    else
                        $fila_matriz[] = '-';
                }
                $imprimir[] = $fila_matriz;
            }
        }
        $data['imprimir'] = $imprimir;
        $this->load->view('AsigAdminHorario/listaAsignaciones_porFecha_view', $data);
    }

    function guardar_Asignacion()
    {
        $horario_LUNES = $this->input->post('horarioLunes');
        $horario_MARTES = $this->input->post('horarioMartes');
        $horario_MIERCOLES = $this->input->post('horarioMiercoles');
        $horario_JUEVES = $this->input->post('horarioJueves');
        $horario_VIERNES = $this->input->post('horarioViernes');
        $horario_SABADO = $this->input->post('horarioSabado');
        $dias_horario = array(array('LUNES', $horario_LUNES), array('MARTES', $horario_MARTES), array('MIERCOLES', $horario_MIERCOLES), array('JUEVES', $horario_JUEVES), array('VIERNES', $horario_VIERNES), array('SABADO', $horario_SABADO));
        $dias_horario2 = $dias_horario;

        $conflicto = $this->input->post('conflicto');

        $fecha_ini = $this->input->post('fechaRangoIni');
        $fecha_fin = $this->input->post('fechaRangoFin');

        /*
         * obtenemos en :
         * $fecha_ini= la fecha inicio que se inserto
         * $fecha_fin= la fecha fin del nuevo horario
         * $dias_horario= vector que contiene los dias de la semana con las asignaciones dadas
         * $resp=los ids en un arreglo.
         */
        if ($conflicto == 1)
            $this->AsigAdminHorario_model->solucionar_conflictos($dias_horario, $fecha_ini, $fecha_fin);

        $resp = $this->AsigAdminHorario_model->guardar_asignacion($dias_horario, $fecha_ini, $fecha_fin);
        $cant_ids = count($resp);

        for ($i = 0; $i < $cant_ids; $i++)
        {
            $fila = $this->AsigAdminHorario_model->datos_usuario($resp[$i])->row();
            $resp[$i] = $fila->nombre . ' ' . $fila->ap_paterno;
        }
        for ($i = 0; $i < count($dias_horario); $i++)
        {
            $fila = $this->AsigAdminHorario_model->datos_horario($dias_horario[$i][1])->row();
            $dias_horario[$i][1] = $fila;
        }
        if ($cant_ids != 0)
        {
            $data['mensaje'] = "Se ha establecido a:";
            $data['respuesta'] = "OK";

            $data['sw'] = 1;
            $data['vector_ids'] = $resp;
            $data['vector_dias'] = $dias_horario;
            $data['vector_dias2'] = $dias_horario2;
            $data['fecha_ini'] = $fecha_ini;
            $data['fecha_fin'] = $fecha_fin;

            $horarios = $this->horarios_model->datos_horarios();
            $data['datosHorarios'] = $horarios->result();
        }
        else
        {
            $data['mensaje'] = "Se ha detectado un error";
            $data['respuesta'] = "NO";
            $data['sw'] = 0;
        }

        $this->load->view('AsigAdminHorario/mensaje_guardar', $data);
    }

    function muestra_conflictos()
    {
        $horario_LUNES = $this->input->get('horarioLunes');
        $horario_MARTES = $this->input->get('horarioMartes');
        $horario_MIERCOLES = $this->input->get('horarioMiercoles');
        $horario_JUEVES = $this->input->get('horarioJueves');
        $horario_VIERNES = $this->input->get('horarioViernes');
        $horario_SABADO = $this->input->get('horarioSabado');
        $dias_horario = array(array('LUNES', $horario_LUNES), array('MARTES', $horario_MARTES), array('MIERCOLES', $horario_MIERCOLES), array('JUEVES', $horario_JUEVES), array('VIERNES', $horario_VIERNES), array('SABADO', $horario_SABADO));

        $fecha_ini = $this->input->get('fechaRangoIni');
        $fecha_fin = $this->input->get('fechaRangoFin');

        $cadena_ids = $this->input->get('ids_personal');

        $tam_cad = strlen($cadena_ids);
        $i = 0;
        $sw = 0;
        $c = 0;
        $nombre_dias = array('lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado');
        while ($i < $tam_cad)
        {
            if ($cadena_ids[$i] == "'")
            {
                $j = $i + 1;
                $k = 0;
                $i++;
                while ($cadena_ids[$i] != "'")
                {
                    $i++;
                    $k++;
                }
                $id = substr($cadena_ids, $j, $k);

                $datos = $this->AsigAdminHorario_model->existe_conflictos($id, $fecha_ini, $fecha_fin);
                if ($datos->num_rows() > 0)
                {
                    foreach ($datos->result() as $fila)
                    {
                        for ($dia = 0; $dia < count($nombre_dias); $dia++)
                        {
                            if ($dia == 0)
                            {
                                $registro[$c][0] = $id;
                                $registro[$c][1] = $fila->fec_ini_horario;
                                $registro[$c][2] = $fila->fec_fin_horario;
                            }
                            $datos2 = $this->AsigAdminHorario_model->busca_conflictos($id, $fila->fec_ini_horario, $fila->fec_fin_horario, $nombre_dias[$dia]);

                            if ($datos2->num_rows() > 0)
                            {
                                $registro[$c][$dia + 3] = $datos2->row()->nombre_horario;
                                $sw = 1;
                            }
                            else
                            {
                                $registro[$c][$dia + 3] = '-';
                            }
                        }
                        $c++;
                    }
                }
                // $registro[] = $registro[];
            }
            $i++;
        }
        $cadena = '';
        if ($c != 0)
        {
            //--------inicio codigo mensajeConflictos_view
            $nombre_ant = 0;
            $cadena = '<div class="grid_8"> 
                        <div class="grid_8"><br><H6>LA ASIGNACION DE HORARIO QUE QUIERE ASIGNAR</H6></div>
                        <div class="grid_3 negrilla">De:  ' . $fecha_ini . ' a: ' . $fecha_fin . '</div>                       
                        <div class="grid_2 letramuyChica">';
            if ($horario_LUNES != 0)
                $cadena = $cadena . '<div class="grid_1">Lunes</div><div class="grid_1">' . $this->AsigAdminHorario_model->datos_horario($horario_LUNES)->row()->NOMBRE . '</div>';
            if ($horario_MARTES != 0)
                $cadena = $cadena . '<div class="grid_1">Martes</div><div class="grid_1">' . $this->AsigAdminHorario_model->datos_horario($horario_MARTES)->row()->NOMBRE . '</div>';
            if ($horario_MIERCOLES != 0)
                $cadena = $cadena . '<div class="grid_1">miercoles</div><div class="grid_1">' . $this->AsigAdminHorario_model->datos_horario($horario_MIERCOLES)->row()->NOMBRE . '</div>';
            if ($horario_JUEVES != 0)
                $cadena = $cadena . '<div class="grid_1">Jueves</div><div class="grid_1">' . $this->AsigAdminHorario_model->datos_horario($horario_JUEVES)->row()->NOMBRE . '</div>';
            if ($horario_VIERNES != 0)
                $cadena = $cadena . '<div class="grid_1">Viernes</div><div class="grid_1">' . $this->AsigAdminHorario_model->datos_horario($horario_VIERNES)->row()->NOMBRE . '</div>';
            if ($horario_SABADO != 0)
                $cadena = $cadena . '<div class="grid_1">Sabado</div><div class="grid_1">' . $this->AsigAdminHorario_model->datos_horario($horario_SABADO)->row()->NOMBRE . '</div>';
            $cadena = $cadena . '</div>
            <div class = "grid_8"><br><H6>TIENE CONFLICTO CON OTRAS ASIGNACIONES DE HORARIO PARA LOS USUARIOS</H6></div>
            </div>';
            for ($i = 0; $i < count($registro); $i++)
            {
                if (count($registro[$i]) > 0)
                {
                    if ($registro[$i][0] != $nombre_ant)
                    {
                        $usuario = $this->AsigAdminHorario_model->datos_usuario($registro[$i][0])->row();
                        $cadena = $cadena . '<div class = "grid_8 negrilla">' . $usuario->nombre . ' ' . $usuario->ap_paterno . '</div>
            <div class = "prefix_05 grid_8 letrachica negrilla">
            <div class = "grid_1 letrachica">Fecha Inicio</div>
            <div class = "grid_1 letrachica">Fecha Final</div>
            <div class = "grid_1 letrachica">Lunes</div>
            <div class = "grid_1 letrachica">Martes</div>
            <div class = "grid_1 letrachica">Miercoles</div>
            <div class = "grid_1 letrachica">Jueves</div>
            <div class = "grid_1 letrachica">Viernes</div>
            <div class = "grid_1 letrachica">Sabado</div>
            </div><br>';
                        $nombre_ant = $registro[$i][0];
                    }
                    $cadena = $cadena . '<div class = "prefix_05 grid_8 letraChica ">

            <div class = "grid_1 letrachica">' . $registro[$i][1] . '</div>
            <div class = "grid_1 letrachica">' . $registro[$i][2] . '</div>
            <div class = "grid_1 letrachica">' . $registro[$i][3] . '</div>
            <div class = "grid_1 letrachica">' . $registro[$i][4] . '</div>
            <div class = "grid_1 letrachica">' . $registro[$i][5] . '</div>
            <div class = "grid_1 letrachica">' . $registro[$i][6] . '</div>
            <div class = "grid_1 letrachica">' . $registro[$i][7] . '</div>
            <div class = "grid_1 letrachica">' . $registro[$i][8] . '</div>
            </div>';
                }
            }
            $cadena = $cadena . '</div><div class = "grid_4 centrartexto" style = "float:right"><br>¿Desea Continuar de todas Formas?</div><br class = "clear">
            <div class = "grid_4 letramuyChica centrartexto" style = "float:right">(Se recortara las fechas en conflicto de las asignaciones)</div>';
            //--------fin codigo mensajeConflictos_view
        }
        $resp['sw'] = $sw;
        $resp['conflictos'] = $cadena;
        header('Content-type: application/json');
        echo json_encode($resp);
    }

}

?>