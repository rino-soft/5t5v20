<?php

/**
 * 
 * excel
 */
class excel_export extends CI_Controller {

    /**
     * 
     * __construct
     */
    public function __construct() {
        parent::__construct();

        // inicializamos la librería
        $this->load->library('Classes/PHPExcel.php');
        if ($this->auth->is_logged() == FALSE) {
            //echo "esta logueado";
            //echo "<script>alert('NO esta logueado');</script>";
            redirect(base_url('login'));
        }
    }

    // end: construc

    /**
     * 
     * setExcel
     */
    public function libroVentasFacilito($desde, $hasta, $busqueda) {

        $this->load->model('proyecto_model');
        $this->load->model('factura_venta_model');


        $ov_pfs = $this->factura_venta_model->listar_buscar_factura_venta_no_restringido($busqueda, $desde, $hasta);
        $data['sql'] = $this->factura_venta_model->listar_buscar_factura_venta_no_restringido_sql($busqueda, $desde, $hasta);
//        //$total_registros = $this->factura_venta_model->listar_buscar_factura_venta_cantidad($b, $de, $ha);
//
//       // $data['total_registros'] = $total_registros;
        $data['registros'] = $ov_pfs;
//        //$detalles_registros = array();
        $proyectos_fact = array();
        $contrato_fact = array();
        foreach ($ov_pfs->result() as $reg) {
            $proyectos_fact[$reg->id_factura] = $this->proyecto_model->obtener_datos_proyecto($reg->id_proyecto);
            $contrato_fact[$reg->id_factura] = $this->proyecto_model->obtener_contrato_id($reg->id_proyecto);
        }

        // $data['detalle_registros'] = $detalles_registros;
        //$data['mostrar_X'] = $c;
        //$data['pagina_actual'] = $p;
        //$data['busqueda'] = $b;
        $data['b'] = $busqueda;
        $data['d'] = $desde;
        $data['h'] = $hasta;
        $data['proy_fac'] = $proyectos_fact;
        $data['cont_fac'] = $contrato_fact;
        $this->load->view('export_excel/libro_ventas_fac', $data);
    }

    public function libroVentas_interno($desde, $hasta, $busqueda) {

        $this->load->model('proyecto_model');
        $this->load->model('factura_venta_model');


        $ov_pfs = $this->factura_venta_model->listar_buscar_factura_venta_no_restringido($busqueda, $desde, $hasta);
        $data['sql'] = $this->factura_venta_model->listar_buscar_factura_venta_no_restringido_sql($busqueda, $desde, $hasta);
//        //$total_registros = $this->factura_venta_model->listar_buscar_factura_venta_cantidad($b, $de, $ha);
//
//       // $data['total_registros'] = $total_registros;
        $data['registros'] = $ov_pfs;
//        //$detalles_registros = array();
        $proyectos_fact = array();
        $contrato_fact = array();
        $glosa_fact = array();
        foreach ($ov_pfs->result() as $reg) {
            $proyectos_fact[$reg->id_factura] = $this->proyecto_model->obtener_datos_proyecto($reg->id_proyecto);
            $contrato_fact[$reg->id_factura] = $this->proyecto_model->obtener_contrato_id($reg->id_contrato);
            $glosa_fact[$reg->id_factura] = $this->factura_venta_model->obtener_glosa_factura_texto($reg->id_factura);
        }


        //$data['img_cabecera']=$objDrawing;
        // $data['detalle_registros'] = $detalles_registros;
        //$data['mostrar_X'] = $c;
        //$data['pagina_actual'] = $p;
        //$data['busqueda'] = $b;
        $data['b'] = $busqueda;
        $data['d'] = $desde;
        $data['h'] = $hasta;
        $data['proy_fac'] = $proyectos_fact;
        $data['cont_fac'] = $contrato_fact;
        $data['glos_fac'] = $glosa_fact;
        $this->load->view('export_excel/reporte_ventas', $data);
    }

    // end: setExcel
    //add 12/12/2016 xcel almacen
    public function movimientos_articulos_serial_codigos() {
        $this->load->model('movimiento_almacen_model');
        $this->load->model('producto_servicio_model');
        $this->load->model('usuario_model');

        $art_respuesta = $this->movimiento_almacen_model->obtener_articulo_respuesta_uno();
        $data['respuesta_uno'] = $art_respuesta;
        $articulos_res_uno = array();
        $cod_props = array();

        foreach ($art_respuesta->result() as $reg) {
            $lista_art = $this->movimiento_almacen_model->obtener_lista_articulos_res1($reg->id_serv_pro);

            foreach ($lista_art->result() as $art) {
                $articulos_res_uno[$art->cod_prop_sts_equipo] = $this->movimiento_almacen_model->obtener_movimientos_cod_prop($art->cod_prop_sts_equipo);
                array_push($cod_props, $art->cod_prop_sts_equipo);
            }
        }
        $data["vec_mov"] = $articulos_res_uno;
        $data["cod_props"] = $cod_props;
        // segundo foreach
        //echo "antes de la vista excel";
        $data['d'] = 'ss';
        echo "hasta aqui llega todo ok";
        $this->load->view('export_excel/reporte_movimientos_articulo', $data);
    }

    public function mov_art_serial_codigos() {


        // $this->load->model('movimiento_almacen_model');
        $this->load->model('producto_servicio_model');
        $this->load->model('usuario_model');
//
        $art_respuesta = $this->producto_servicio_model->obtener_articulo_respuesta_uno();
        $data['respuesta_uno'] = $art_respuesta;
        $articulos_res_uno = array();
        $cod_props = array();
        //  $i=0;
        foreach ($art_respuesta->result() as $reg) {
            //  echo $reg->id_serv_pro . "-" . $reg->cod_serv_prod . "-" . $reg->nombre_titulo . "<br>";
            $lista_art = $this->producto_servicio_model->obtener_lista_articulos_res1($reg->id_serv_pro);

            foreach ($lista_art->result() as $art) {
                //if ($art->id_articulo == 90)
                //    $i++;
                //      echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" .$i.".-". $art->cod_prop_sts_equipo . "," . $art->SN . "," . $reg->id_serv_pro . "<br>";
                $articulos_res_uno[$art->cod_prop_sts_equipo] = $this->producto_servicio_model->obtener_movimientos_cod_prop($art->cod_prop_sts_equipo, $art->SN, $reg->id_serv_pro);

                array_push($cod_props, $art->cod_prop_sts_equipo);
            }
            //echo "**********************************************************<br>";
        }
        $data["vec_mov"] = $articulos_res_uno;
        $data["cod_props"] = $cod_props;
        // segundo foreach
        //echo "antes de la vista excel";
        $data['d'] = 'ss';
        //echo "hasta aqui llega todo ok";
        $this->load->view('export_excel/libro_ventas_fac2', $data);
        //
        // $this->load->model('proyecto_model');
        // $this->load->model('factura_venta_model');
        // $ov_pfs = $this->factura_venta_model->listar_buscar_factura_venta_no_restringido($busqueda, $desde, $hasta);
        //$data['sql'] = $this->factura_venta_model->listar_buscar_factura_venta_no_restringido_sql($busqueda, $desde, $hasta);
//        //$total_registros = $this->factura_venta_model->listar_buscar_factura_venta_cantidad($b, $de, $ha);
//
//       // $data['total_registros'] = $total_registros;
        //$data['registros'] = $ov_pfs;
//        //$detalles_registros = array();
        //$proyectos_fact = array();
        //$contrato_fact = array();
        // foreach ($ov_pfs->result() as $reg) {
        //    $proyectos_fact[$reg->id_factura] = $this->proyecto_model->obtener_datos_proyecto($reg->id_proyecto);
        //   $contrato_fact[$reg->id_factura] = $this->proyecto_model->obtener_contrato_id($reg->id_proyecto);
        //}
        // $data['detalle_registros'] = $detalles_registros;
        //$data['mostrar_X'] = $c;
        //$data['pagina_actual'] = $p;
        //$data['busqueda'] = $b;
        //$data['b'] = $busqueda;
        //$data['d'] = $desde;
        // $data['h'] = "ssssssss";
        //$data['proy_fac'] = $proyectos_fact;
        //$data['cont_fac'] = $contrato_fact;
        //$this->load->view('export_excel/libro_ventas_fac2', $data);
    }

    public function usuarios_vacacion() {

        $this->load->model('usuario_model');
        //$this->load->model('factura_venta_model');

        $data['registros'] = $this->usuario_model->listar_usuarios_all('', 0, 5000,'no');
        $registros=$data['registros'];
        $proyxuser=array();
        $uservac=array();
        
        foreach ($registros as $reg)
        {
            $proyxuser[$reg->cod_user] =$this->usuario_model->obtProyectoUsuario($reg->cod_user);
            $uservac[$reg->cod_user] =$this->calculo_vacaciones_excel($reg->cod_user);
        }
        $data['vacaciones']=$uservac;
         $this->load->view('export_excel/libro_ventas_fac3', $data);
        
        
        

//        $ov_pfs = $this->factura_venta_model->listar_buscar_factura_venta_no_restringido($busqueda, $desde, $hasta);
//        $data['sql'] = $this->factura_venta_model->listar_buscar_factura_venta_no_restringido_sql($busqueda, $desde, $hasta);
////        //$total_registros = $this->factura_venta_model->listar_buscar_factura_venta_cantidad($b, $de, $ha);
////
////       // $data['total_registros'] = $total_registros;
//        $data['registros'] = $ov_pfs;
////        //$detalles_registros = array();
//        $proyectos_fact = array();
//        $contrato_fact = array();
//        foreach ($ov_pfs->result() as $reg) {
//            $proyectos_fact[$reg->id_factura] = $this->proyecto_model->obtener_datos_proyecto($reg->id_proyecto);
//            $contrato_fact[$reg->id_factura] = $this->proyecto_model->obtener_contrato_id($reg->id_contrato);
//        }
//
//
//        //$data['img_cabecera']=$objDrawing;
//        // $data['detalle_registros'] = $detalles_registros;
//        //$data['mostrar_X'] = $c;
//        //$data['pagina_actual'] = $p;
//        //$data['busqueda'] = $b;
//        $data['b'] = $busqueda;
//        $data['d'] = $desde;
//        $data['h'] = $hasta;
//        $data['proy_fac'] = $proyectos_fact;
//        $data['cont_fac'] = $contrato_fact;
       
    }

    /////////////////////////////////////////
    /// FUNCIONES QUE AYUDAN A VACACIONES ///
    ///     ruben payrumani ino           ///
    ////////////////////////////////////////
    function restaHoras($horaFin, $horaIni)
    {
//        echo '<br>^^^^^^^^^^^^<br>hora_menor: ' . $horaIni;
//        echo '<br>hora_mayor: ' . $horaFin;
        $resta = date("H:i:s", strtotime("00:00:00") + strtotime($horaFin) - strtotime($horaIni));
//        echo '<br>resta: ' . $resta . '<br>^^^^^^^^^^^^<br>';
        return $resta;
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
    
    
    function calculo_vacaciones_excel($usuario) {
       // return("si entra");
        $this->load->model('justificaciones_model');
        //$usuario = $this->input->post('user');

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
            $dias_trabajados_vac=$vacacion;
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
        /*$codigo='<div class="f10 negrilla alin_cen" style="width: 100%;float: left; display: inline-block">Vacación</div>
                        <div class="bordeado" style="width: 31%;float: left; display: inline-block">
                            <div class="alin_cen f10">Utilizadas</div><div class="alin_cen negrilla">'.($vacacion_saldo/8).'</div>
                        </div>
                        <div class="bordeado" style="width: 33%;float: left; display: inline-block">
                            <div class="alin_cen f10">Sobrantes</div><div class="alin_cen negrilla">'.($vacacion/8).'</div>
                        </div>
                        <div class="bordeado" style="width: 31%;float: left; display: inline-block">
                            <div class="alin_cen f10">Calculado</div><div class="alin_cen negrilla">'.($dias_trabajados_vac/8).'</div>
                </div>';
        */
        return(($vacacion_saldo/8)."|".($vacacion/8)."|".($dias_trabajados_vac/8));
    }
    
    
    
    
}
// end: excel
?>
