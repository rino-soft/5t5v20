<?php

class RegistroMarcados extends CI_Controller {

    function __construct() {
        parent::__construct();

        //$this->load->helper('url');

        $this->load->model('usuario_model');
        $this->load->model('RegistroMarcados_model');
        $this->load->model('menu_model'); //Adicionado por magali
        if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }

    function index($padre) {
        $data['titulo'] = 'Registro Marcados';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function RegistroMarcado($padre,$hijo) {
   
        $data['titulo'] = 'Control Marcados';
       $data['user'] = $this->session->userdata('nombres') . ' ' . $this->session->userdata('apellidos');
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);

       $data['datos_modelo_usuario'] = $this->RegistroMarcados_model->datosUsuario($this->session->userdata('id_admin'));

        $data['meses'] = $this->RegistroMarcados_model->meses($this->session->userdata('id_admin'));
        $data['años'] = $this->RegistroMarcados_model->años($this->session->userdata('id_admin'));
        $data['fec'] = $this->RegistroMarcados_model->obfecha($this->session->userdata('id_admin'));

        $data['vista_enviada'] = "RegistroMarcados/RegistroMarcados_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
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

    function restaHoras($horaFin, $horaIni) {
        return date("H:i:s", strtotime("00:00:00") + strtotime($horaFin) - strtotime($horaIni));
    }

    function calcular_retrasos($horaEjemplar, $hora_marcada) {
        if ($hora_marcada > $horaEjemplar)
            $sol = $this->restaHoras($hora_marcada, $horaEjemplar);
        else
            $sol = '00:00:00';
        return $sol;
    }

    function calcular_abandonos($horaEjemplar, $hora_marcada) {
        if ($hora_marcada < $horaEjemplar)
            $sol = $this->restarHoras($horaEjemplar, $hora_marcada);
        else
            $sol = '00:00:00';
        return $sol;
    }

    function mostrar_tabla_calendario_marcados_usuario() {
        
        date_default_timezone_set("Etc/GMT+4");
       // $matriz = $this->basicauth->datosSession();
 
        $vector_dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
        $Y = $this->input->post('anio');
        $m = $this->input->post('mes');
//echo 'funciona';
        $mes = mktime(0, 0, 0, $m, 1, $Y);
        $nroDias = intval(date("t", $mes));
        //echo $nroDias;
        $fecin = date($Y . '-' . $m . '-01');
        $fecfin = date($Y . '-' . $m . '-' . $nroDias);
        //$fecfindate('Y-m-d'); // Y=año actual m=mes actual d=dia actual
        $datos_vista['sw'] = 0;
        $total_retrasoMes = '00:00:00';
        for ($i = 0; $i < $nroDias; $i++) {
            $datos_vista['fecha'] = $fecin;

            $dia = strtotime($fecin);
            $diaSemana = $vector_dias[date("w", mktime(0, 0, 0, date("m", $dia), date("d", $dia), date("Y", $dia)))];
            $datos_vista['diaSemana'] = $diaSemana;
            //echo 'ingresa'.$diaSemana.",".$fecin."<br>";
            $registro = $this->RegistroMarcados_model->tipo_horario_dia($this->session->userdata('id_admin'), $diaSemana, $fecin);
            //echo '********** '.$registro->num_rows()."<br>";
            if ($registro->num_rows() > 0) {
                $fila = $registro->row();

                $him = $fila->hora_ingreso_ma;
                if ($fila->hora_ingreso_ma != '00:00:00')
                    $datos_vista['hora_inima'] = $him;
                else
                    $datos_vista['hora_inima'] = "-";

                $hfm = $fila->hora_salida_ma;
                if ($fila->hora_salida_ma != '00:00:00')
                    $datos_vista['hora_finma'] = $hfm;

                else
                    $datos_vista['hora_finma'] = "-";

                $hit = $fila->hora_ingreso_ta;
                if ($fila->hora_ingreso_ta != '00:00:00')
                    $datos_vista['hora_inita'] = $hit;

                else
                    $datos_vista['hora_inita'] = "-";

                $hft = $fila->hora_salida_ta;
                if ($fila->hora_salida_ta != '00:00:00')
                    $datos_vista['hora_finta'] = $hft;

                else
                    $datos_vista['hora_finta'] = "-";
                $tolerancia = $fila->tolerancia;
            } else {
                $datos_vista['hora_inima'] = "-";
                $datos_vista['hora_finma'] = "-";
                $datos_vista['hora_inita'] = "-";
                $datos_vista['hora_finta'] = "-";
            }

            $marcado_porFecha = $this->RegistroMarcados_model->marcado_fecha_usuario($this->session->userdata('id_admin'), $fecin);

            $datos_vista['marcado_inima'] = '-';
            $datos_vista['marcado_finma'] = '-';
            $datos_vista['marcado_inita'] = '-';
            $datos_vista['marcado_finta'] = '-';
            $retraso = '-';
            //$abandono = '-';

            if ($marcado_porFecha->num_rows() > 0) {
                //echo $marcado_porFecha->num_rows();
                $registro2 = $marcado_porFecha->result();
                $sw_m = 0;
                $sw_t = 0;
                $retraso = '00:00:00';
                //$abandono = '00:00:00';

                foreach ($registro2 as $fila2) {
                    $dato = $fila2->hora_marcado;

                    if ($dato < $this->sumarHoras($him, '01:00:00') && $sw_m == 0) {
                        $datos_vista['marcado_inima'] = $dato;
                        $sw_m = 1;
                        $horaHorario_mas_tolernacia = $this->sumarHoras($him, $tolerancia);
                        if ($dato > $horaHorario_mas_tolernacia)
                            $retraso = $this->sumarHoras($retraso, $this->calcular_retrasos($horaHorario_mas_tolernacia, $dato));
                    } elseif ($dato >= $this->restaHoras($hfm, '01:00:00') && $dato < $this->sumarHoras($hfm, '01:00:00')) {
                        $datos_vista['marcado_finma'] = $dato;
                        //$abandono = $this->sumarHoras($abandono, $this->calcular_abandonos($hfm, $dato));
                    } elseif ($dato >= $this->restaHoras($hit, '01:00:00') && $dato < $this->sumarHoras($hit, '01:00:00') && $sw_t == 0) {
                        $datos_vista['marcado_inita'] = $dato;
                        $sw_t = 1;
                        $horaHorario_mas_tolernacia = $this->sumarHoras($hit, $tolerancia);
                        if ($dato > $horaHorario_mas_tolernacia)
                            $retraso = $this->sumarHoras($retraso, $this->calcular_retrasos($horaHorario_mas_tolernacia, $dato));
                    } elseif ($dato >= $this->restaHoras($hft, '01:00:00')) {
                        $datos_vista['marcado_finta'] = $dato;
                        //$abandono = $this->sumarHoras($abandono, $this->calcular_abandonos($hft, $dato));
                    }
                }
                $total_retrasoMes = $this->sumarHoras($total_retrasoMes, $retraso);
            }

            $datos_vista['retraso_dia'] = $retraso;

            $dia_es_feriado = $this->RegistroMarcados_model->dia_esFeriado($fecin);
            if ($dia_es_feriado->num_rows() > 0) {
                $datos_vista['sw_esFeriado'] = 1;
                $datos_vista['nombre_feriado'] = $dia_es_feriado->row()->nombre;
            } else {
                $datos_vista['sw_esFeriado'] = 0;
                $datos_vista['nombre_feriado'] = 'no es feriado';
            }

            $this->load->view("RegistroMarcados/tablaMarcados_view", $datos_vista);
            $fecin = date("Y-m-d", strtotime("$fecin + 1 day"));
        }
        $datos_vista['sw'] = 1;
        $datos_vista['retraso_mes'] = $total_retrasoMes;
        $this->load->view("RegistroMarcados/tablaMarcados_view", $datos_vista);
    }

}

?>
