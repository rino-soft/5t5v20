<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of justificacion_marcado
 *
 * @author Ruben
 */
class justificacion_marcado extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->load->helper('url');
        $this->load->model('dependientes_model');
        //$this->load->model('menus_model');
        $this->load->model('horarios_model');
        $this->load->model('justificaciones_model');
          $this->load->model('menu_model');//Adicionado por magali
             if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }

    function index($padre)
    {
        //   ***************  para verlo en el template **************//
      //  $data['main_menu'] = 'menus/EnlacesHijos';
        $data['titulo'] = 'justificacion de marcados';
        //
          $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        $data['user'] = $this->session->userdata('nombres').' '.$this->session->userdata('apellidos');
        //$data['menu_completo'] = $this->menus_model->obtenerMenuCompleto($this->session->userdata('id_admin'));
        $data['vista_enviada'] = "justificaciones/justificaciones_marcados_view";

        //   ***************  para verlo en el template **************//
        $this->load->view('Plantilla/plantilla_vista', $data);
    }

    function convertir_formatoHora_aDecimal($hora)
    {
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

    function sumarHoras($h1, $h2)
    {
        $h2h = date('H', strtotime($h2));
        $h2m = date('i', strtotime($h2));
        $h2s = date('s', strtotime($h2));
        $hora2 = $h2h . "hour" . $h2m . "min" . $h2s . "second";
        $horas_sumadas = $h1 . " + " . $hora2;
        $text = date('H:i:s', strtotime($horas_sumadas));
        return $text;
    }

    function restaHoras($horaFin, $horaIni)
    {
//        echo '<br>^^^^^^^^^^^^<br>hora_menor: ' . $horaIni;
//        echo '<br>hora_mayor: ' . $horaFin;
        $resta = date("H:i:s", strtotime("00:00:00") + strtotime($horaFin) - strtotime($horaIni));
//        echo '<br>resta: ' . $resta . '<br>^^^^^^^^^^^^<br>';
        return $resta;
    }

    function form_nueva_justificacion()
    {
        $this->load->model('usuario_model');
        $data['horasVacacion'] = $this->calcular_diasVacacion();
        //
      echo $data['horasVacacion'];
        $data['proyectos_usuario'] = $this->usuario_model->obtProyectoUser($this->session->userdata('id_admin'));//obtiene los proyectos activos del personal (el el caso de que sea 2 o mas proyectos)
        $this->load->view('justificaciones/formularios_justificacion/formulario_nueva_justificacion_view', $data);
    }

    function calcular_diasVacacion()
    {
        $vector_dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');

        //
        $aniosTrabajados = $this->justificaciones_model->total_diasTrabajados($this->session->userdata('id_admin'))->row()->diasTrab;
       // echo "años trabajados".$aniosTrabajados;
        $vacacion = 0;
        if ($aniosTrabajados >= 1)
        {
            for ($i = 1; $i <= $aniosTrabajados; $i++)
            {
                if ($i >= 10)
                    $vacacion += 30 * 8;
                else if ($i >= 5)
                    $vacacion += 20 * 8;
                else
                    $vacacion += 15 * 8;
            }
            $restaVacacion = 0;
            $registroJustif = $this->justificaciones_model->dias_justificacion($this->session->userdata('id_admin'))->result();
            foreach ($registroJustif as $fila) // recorre todas las justificaciones
            {
                if ($fila->tipo == 'Permiso Vacacion')
                {
                    $fechaIni = $fila->fecha_inicio;
                    $fechaFin = $fila->fecha_fin;
                    $fecha = $fechaIni;  //inicia en fecha ini
                    //echo '<br>----------------------------------------------<br>fecha inicio' . $fechaIni . '<br>';
                    //echo 'fecha fin' . $fechaFin . '<br>';
                    //echo 'diferncia dias' . $fila->dif_diasPermiso . '<br>';

                    $cant_horasJustif = 0; // cerea para cada justificacion
                    for ($i = 0; $i <= $fila->dif_diasPermiso; $i++) // recorre todos los dias de la justificacion y cuenta las horas
                    {
                        $dia = strtotime($fecha);
                        $diaSemana = $vector_dias[date("w", mktime(0, 0, 0, date("m", $dia), date("d", $dia), date("Y", $dia)))];

                        $registro = $this->justificaciones_model->tipoHorario($this->session->userdata('id_admin'), $diaSemana, $fecha, $fechaFin);
                        if ($registro->num_rows() > 0)
                        {
                            //echo '<br>' . $diaSemana . ' ' . $fecha;
                            $horario = $registro->row();
                            $cant_horasDia = '00:00:00';

                            if (date("Y-m-d", strtotime($fechaIni)) == date("Y-m-d", strtotime($fechaFin))) // para el caso en el que solo es un dia de permiso
                            {
                                //echo 'solo un dia de permiso';
                                $hora_ini = $horario->hora_primerDia;
                                $hora_fin = $horario->hora_ultimoDia;

                                if ($horario->hora_salida_ma == '00:00:00' && $horario->hora_ingreso_ta == '00:00:00' && $hora_ini < $hora_fin)
                                {
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
                                else
                                {
                                    if ($hora_ini <= $horario->hora_salida_ma && $hora_ini < $hora_fin)
                                    {
                                        if ($hora_fin <= $horario->hora_salida_ma && $hora_fin >= $horario->hora_ingreso_ma)
                                        {
                                            if ($hora_ini < $horario->hora_ingreso_ma)
                                                $cant_horasDia = $this->restaHoras($hora_fin, $horario->hora_ingreso_ma);
                                            else
                                                $cant_horasDia = $this->restaHoras($hora_fin, $hora_ini);
                                        }
                                        else
                                        {
                                            if ($hora_ini < $horario->hora_ingreso_ma)
                                                $cant_horasDia = $this->restaHoras($hora_fin, $hora_ini);
                                            else
                                                $cant_horasDia = $this->restaHoras($horario->hora_salida_ma, $hora_ini);
                                        }
                                    }
                                    if ($hora_fin >= $horario->hora_ingreso_ta && $hora_ini < $hora_fin)
                                    {
                                        if ($hora_ini >= $horario->hora_ingreso_ta && $hora_ini <= $horario->hora_salida_ta)
                                        {
                                            if ($hora_fin > $horario->hora_salida_ta)
                                                $cant_horasDia = $this->sumarHoras($cant_horasDia, $this->restaHoras($horario->hora_salida_ta, $hora_ini));
                                            else
                                                $cant_horasDia = $this->sumarHoras($cant_horasDia, $this->restaHoras($hora_fin, $hora_ini));
                                        }
                                        else
                                        {
                                            if ($hora_fin > $horario->hora_salida_ta)
                                                $cant_horasDia = $this->sumarHoras($cant_horasDia, $this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ta));
                                            else
                                                $cant_horasDia = $this->sumarHoras($cant_horasDia, $this->restaHoras($hora_fin, $horario->hora_ingreso_ta));
                                        }
                                    }
                                }
                            }
                            //para casos de varios dias de permiso o vacacion
                            else if ($fecha == $fechaIni && $i == 0)    // cant de horas del primer dia
                            {
                                //echo '<br>primer dia<br>';
                                $hora_ini = $horario->hora_primerDia;
                                if ($horario->hora_salida_ma == '00:00:00' && $horario->hora_ingreso_ta == '00:00:00') // caso tipo horario continuo
                                {
                                    if ($hora_ini < $horario->hora_ingreso_ma)
                                        $cant_horasDia = $this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ma);
                                    else if ($hora_ini > $horario->hora_salida_ta)
                                        $cant_horasDia = 0;
                                    else
                                        $cant_horasDia = $this->restaHoras($horario->hora_salida_ta, $hora_ini);
                                }
                                else if ($hora_ini >= $horario->hora_ingreso_ma && $hora_ini <= $horario->hora_salida_ma) // caso dentro de horario por la mañana
                                {
                                    $cant_horasDia = $this->restaHoras($horario->hora_salida_ma, $hora_ini);
                                    if ($horario->hora_ingreso_ta != '00:00:00' && $horario->hora_salida_ta != '00:00:00') // caso si existe horario por la tarde
                                        $cant_horasDia = $this->sumarHoras($cant_horasDia, $this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ta));
                                }
                                else if ($hora_ini >= $horario->hora_ingreso_ta && $hora_ini <= $horario->hora_salida_ta) // caso dentro del horario por la tarde
                                {
                                    $cant_horasDia = $this->restaHoras($horario->hora_salida_ta, $hora_ini);
                                }
                                else if ($hora_ini > $horario->hora_salida_ta)   // para el caso de que la hora_ini este fuera de los horarios 
                                    $cant_horasDia = 0;
                                else if ($hora_ini > $horario->hora_salida_ma)
                                    $cant_horasDia = $this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ta);
                                else
                                    $cant_horasDia = $this->sumarHoras($this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ta), $this->restaHoras($horario->hora_salida_ma, $horario->hora_ingreso_ma));
                            }
                            else if ($fecha == date("Y-m-d", strtotime($fechaFin)))    // cant de horas del ultimo dia
                            {
                                //echo '<br>ultimo dia<br>';
                                $hora_fin = $horario->hora_ultimoDia;
                                if ($horario->hora_salida_ma == '00:00:00' && $horario->hora_ingreso_ta == '00:00:00') // caso tipo horario continuo
                                {
                                    //echo '<br>caso continuo<br>';
                                    if ($hora_fin > $horario->hora_salida_ta)
                                        $cant_horasDia = $this->restarHoras($horario->hora_salida_ta, $horario->hora_ingreso_ma);
                                    else if ($hora_fin < $horario->hora_ingreso_ma)
                                        $cant_horasDia = 0;
                                    else
                                        $cant_horasDia = $this->restaHoras($hora_fin, $horario->hora_ingreso_ma);
                                }
                                elseif ($hora_fin >= $horario->hora_ingreso_ma && $hora_fin <= $horario->hora_salida_ma) // caso dentro de horario por la mañana
                                {
                                    //echo '<br>caso mañana<br>';
                                    $cant_horasDia = $this->restaHoras($hora_fin, $horario->hora_ingreso_ma);
                                }
                                elseif ($hora_fin >= $horario->hora_ingreso_ta && $hora_fin <= $horario->hora_salida_ta) // caso dentro del horario por la tarde
                                {
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
                            }
                            else if ($fecha != $fechaIni && $fecha != $fechaFin)  //cant de horas de los dias intermedios
                            {
                                //echo '<br>dia intermedio<br>';
                                if ($horario->hora_salida_ma == '00:00:00' && $horario->hora_ingreso_ta == '00:00:00')
                                    $cant_horasDia = $this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ma);
                                else
                                {
                                    $horasMañana = $this->restaHoras($horario->hora_salida_ma, $horario->hora_ingreso_ma);
                                    $horasTarde = $this->restaHoras($horario->hora_salida_ta, $horario->hora_ingreso_ta);
                                    $cant_horasDia = $this->sumarHoras($horasMañana, $horasTarde);
                                }
                            }
                            //echo '<br>cant horas dia: ' . $cant_horasDia;
                            //echo '<br>cant horas dia en formato decimal'.$this->convertir_formatoHora_aDecimal($cant_horasDia);;
                            $cant_horasJustif+=$this->convertir_formatoHora_aDecimal($cant_horasDia);
                            //echo '-------------cant horas justif i:' . $cant_horasJustif . '<br>';
                        }
                        else
                        {
                            //echo '<br>' . $fecha . 'no tiene registro de horario';
                        }

                        $fecha = date("Y-m-d", strtotime("$fecha + 1 days"));
                    }

                    //echo '<br>vacacion: ' . $vacacion;
                    $restaVacacion = $vacacion - $cant_horasJustif;
                    $vacacion = $restaVacacion;
                    //echo '<br>vacacion restada por justificacion permiso i: ' . $restaVacacion . '<br>';
                }
            }
        }
        return $vacacion;
    }

    // funcion que obtiene los datos de 1 fecha enviado los parametros de fecha y usuario
    function obtener_fechas_bloqueadas()
    {   //se recepciona el tipo y se busca en sus respectivos modelos ****** F A L T A
        
        $this->load->model('viaticos_funciones_model');
        $this->load->model('diasEspeciales_y_feriados_model');
        $viaticos=$this->viaticos_funciones_model->obtener_cadena_fechas_viaticos($this->session->userdata('id_admin'),date('Y,m,d'));
        $jus=$this->justificaciones_model->obtenerCadenaFechasJustificacion($this->session->userdata('id_admin'));
        $feriado=$this->diasEspeciales_y_feriados_model->feriados_fechas_bloqueadas(date('Y,m,d'));
        $codigo="<div class='grid_7'>
                    <input type='text' id='viaticosfec' value='$viaticos'>
                    <input type='text' id='jusfec' value='$jus'>
                    <input type='text' id='feriadofec' value='$feriado'>
                        <input type='text' id='fechassolicitado' value=''>
                        <input type='text' id='fechas_fds' value=''>
            
         </div>";
        echo $codigo;
    }
    function obtener_informacion_fecha_justificar()
    {
        
        $fechajustificar = $this->input->post('fecha_justificar');
        $resultado = $this->horarios_model->obtener_datos_horario_x_fecha($this->session->userdata('id_admin'), $fechajustificar);
        $data['horario_asignado'] = $resultado->row();
        $h = $resultado->row();
        $marcados[0] = $this->horarios_model->obtener_marcado_x_hora($this->session->userdata('id_admin'), $fechajustificar, $h->Hora_ingreso_ma, "ingreso", $h->TOLERANCIA);
        $marcados[1] = $this->horarios_model->obtener_marcado_x_hora($this->session->userdata('id_admin'), $fechajustificar, $h->hora_salida_ma, "salida", $h->TOLERANCIA);
        $marcados[2] = $this->horarios_model->obtener_marcado_x_hora($this->session->userdata('id_admin'), $fechajustificar, $h->hora_ingreso_ta, "ingreso", $h->TOLERANCIA);
        $marcados[3] = $this->horarios_model->obtener_marcado_x_hora($this->session->userdata('id_admin'), $fechajustificar, $h->hora_salida_ta, "salida", $h->TOLERANCIA);
        $data['marcados'] = $marcados;
        $this->load->view('justificaciones/formularios_justificacion/datos_horario_marcado_fecha_view', $data);
    }

    function subir()
    {
        foreach ($_FILES as $key)
        {
            if ($key['error'] == UPLOAD_ERR_OK)
            {
                $nombre = $key['name']; //Obtenemos el nombre del archivo
                $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
                $tamano = number_format(($key['size'] / 1048576), 2, ',', '.') . "Mb"; //Obtenemos el tamaño en KB
                echo "
                                <div id='subido'>
                                        <h12><strong>Nombre del archivo: $nombre</strong></h2><br />
                                        <h12><strong>Tamaño del archivo: $tamano</strong></h2><br />
                                </div>
                                "; //El echo es para que lo reciba jquery y lo ponga en el div "cargados"
            }
            else
            {
                echo $key['error']; //Si no se cargo mostramos el error
            }
        }
    }

    function guardar() {
        

        $resultado = $this->justificaciones_model->nuevo_registro_jvp($this->session->userdata('id_admin'));
        
        //RUBEN PAYRUMANI INO Adicion de Registro de historial y de estados//
        echo "el resultado es ". $resultado;
        if ($resultado > 0) {
            $this->load->model('historial_jus_per_vac_bm_model');
            $this->load->model('qr_cod_model');
            $evento = $this->input->post('estado');
            $codigo = $this->historial_jus_per_vac_bm_model->adicionar_nuevo_evento($resultado, $evento);
            $this->qr_cod_model->generar_firma_QR($codigo);            
                       
        }
        // Ruben Payrumani Cierre de codigo modificado

        if ($resultado > 0)
            echo " se guardo correctamente";
        else
            echo " Hubo un error al guardar en la base de datos";
    }

    function subir_al_servidor()
    {
        
        $ruta = "C:\wamp\www\RRHH_v1\uploads/"; // SOLUCIONAR NO FUNCIONA CON $RUTA= BASE_URL(). UPLOADS/

        date_default_timezone_set("Etc/GMT+4");

        foreach ($_FILES as $key)
        {
            if ($key['error'] == UPLOAD_ERR_OK)
            {//Verificamos si se subio correctamente
                $nombre = $this->session->userdata('id_admin') . "_" . date("Ymd") . "_" . $key['name']; //Obtenemos el nombre del archivo
                //$file_name = $i."_".$file_name;
                $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
                move_uploaded_file($temporal, $ruta . $nombre); //Movemos el archivo temporal a la ruta especificada
            }
            else
            {
                echo $key['error']; //Si no se cargo mostramos el error
            }
        }
    }

    function mostrar_registro_justificaciones()
    {
        //
        $datos_vista['registro'] = $this->justificaciones_model->obtener_justificaciones($this->session->userdata('id_admin'));
        $this->load->view("justificaciones/tablaJustificacion_view", $datos_vista);
    }

}

?>
