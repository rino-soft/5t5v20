<?php

class RegistroMarcados extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('menus_model');
        $this->load->model('usuario_model');
        $this->load->model('RegistroMarcados_model');
    }

    function index()
    {
        $matriz = $this->basicauth->datosSession();
        $data['user'] = $matriz['nombres'] . ' ' . $matriz['apellidos'];

        $data['main_menu'] = 'menus/EnlacesHijos';
        $data['titulo'] = 'Control Marcados';
        $data['menu_completo'] = $this->menus_model->obtenerMenuCompleto($matriz['id']);

        $data['datos_modelo_usuario'] = $this->RegistroMarcados_model->datosUsuario($matriz['id']);

        $data['meses'] = $this->RegistroMarcados_model->meses($matriz['id']);
        $data['años'] = $this->RegistroMarcados_model->años($matriz['id']);
        $data['fec'] = $this->RegistroMarcados_model->obfecha($matriz['id']);

        $data['main_conten'] = "RegistroMarcados/RegistroMarcados_view";
        $this->load->view('includes/template', $data);
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
        return date("H:i:s", strtotime("00:00:00") + strtotime($horaFin) - strtotime($horaIni));
    }

    function calcular_retrasos($horaEjemplar, $hora_marcada)
    {
        if ($hora_marcada > $horaEjemplar)
            $sol = $this->restaHoras($hora_marcada, $horaEjemplar);
        else
            $sol = '00:00:00';
        return $sol;
    }

    function calcular_abandonos($horaEjemplar, $hora_marcada)
    {
        if ($hora_marcada < $horaEjemplar)
            $sol = $this->restarHoras($horaEjemplar, $hora_marcada);
        else
            $sol = '00:00:00';
        return $sol;
    }

    function mostrar_tabla_calendario_marcados_usuario()
    {
        date_default_timezone_set("Etc/GMT+4");
        $matriz = $this->basicauth->datosSession();

        $vector_dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
        $Y = $this->input->post('anio');
        $m = $this->input->post('mes');

        $mes = mktime(0, 0, 0, $m, 1, $Y);
        $nroDias = intval(date("t", $mes));

        $fecin = date($Y . '-' . $m . '-01');
        $fecfin = date($Y . '-' . $m . '-' . $nroDias);
        //$fecfindate('Y-m-d'); // Y=año actual m=mes actual d=dia actual
        $datos_vista['sw'] = 0;
        $total_retrasoMes = '00:00:00';
        for ($i = 0; $i < $nroDias; $i++)
        {
            $datos_vista['fecha'] = $fecin;

            $dia = strtotime($fecin);
            $diaSemana = $vector_dias[date("w", mktime(0, 0, 0, date("m", $dia), date("d", $dia), date("Y", $dia)))];
            $datos_vista['diaSemana'] = $diaSemana;

            $registro = $this->RegistroMarcados_model->tipo_horario_dia($matriz['id'], $diaSemana, $fecin);
            if ($registro->num_rows() > 0)
            {
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
            } else
            {
                $datos_vista['hora_inima'] = "-";
                $datos_vista['hora_finma'] = "-";
                $datos_vista['hora_inita'] = "-";
                $datos_vista['hora_finta'] = "-";
            }

            $marcado_porFecha = $this->RegistroMarcados_model->marcado_fecha_usuario($matriz['id'], $fecin);

            $datos_vista['marcado_inima'] = '-';
            $datos_vista['marcado_finma'] = '-';
            $datos_vista['marcado_inita'] = '-';
            $datos_vista['marcado_finta'] = '-';
            $retraso = '-';
            //$abandono = '-';

            if ($marcado_porFecha->num_rows() > 0)
            {
                //echo $marcado_porFecha->num_rows();
                $registro2 = $marcado_porFecha->result();
                $sw_m = 0;
                $sw_t = 0;
                $retraso = '00:00:00';
                //$abandono = '00:00:00';

                foreach ($registro2 as $fila2)
                {
                    $dato = $fila2->hora_marcado;

                    if ($dato < $this->sumarHoras($him, '01:00:00') && $sw_m == 0)
                    {
                        $datos_vista['marcado_inima'] = $dato;
                        $sw_m = 1;
                        $horaHorario_mas_tolernacia = $this->sumarHoras($him, $tolerancia);
                        if ($dato > $horaHorario_mas_tolernacia)
                            $retraso = $this->sumarHoras($retraso, $this->calcular_retrasos($horaHorario_mas_tolernacia, $dato));
                    } elseif ($dato >= $this->restaHoras($hfm, '01:00:00') && $dato < $this->sumarHoras($hfm, '01:00:00'))
                    {
                        $datos_vista['marcado_finma'] = $dato;
                        //$abandono = $this->sumarHoras($abandono, $this->calcular_abandonos($hfm, $dato));
                    }
                    elseif ($dato >= $this->restaHoras($hit, '01:00:00') && $dato < $this->sumarHoras($hit, '01:00:00') && $sw_t == 0)
                    {
                        $datos_vista['marcado_inita'] = $dato;
                        $sw_t = 1;
                        $horaHorario_mas_tolernacia = $this->sumarHoras($hit, $tolerancia);
                        if ($dato > $horaHorario_mas_tolernacia)
                            $retraso = $this->sumarHoras($retraso, $this->calcular_retrasos($horaHorario_mas_tolernacia, $dato));
                    } elseif ($dato >= $this->restaHoras($hft, '01:00:00'))
                    {
                        $datos_vista['marcado_finta'] = $dato;
                        //$abandono = $this->sumarHoras($abandono, $this->calcular_abandonos($hft, $dato));
                    }
                }
                $total_retrasoMes = $this->sumarHoras($total_retrasoMes, $retraso);
            }

            $datos_vista['retraso_dia'] = $retraso;

            $dia_es_feriado = $this->RegistroMarcados_model->dia_esFeriado($fecin);
            if ($dia_es_feriado->num_rows() > 0)
            {
                $datos_vista['sw_esFeriado'] = 1;
                $datos_vista['nombre_feriado'] = $dia_es_feriado->row()->nombre;
            }
            else
            {
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
