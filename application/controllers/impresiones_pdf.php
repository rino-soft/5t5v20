<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fpdf_controler
 *
 * @author Ruben
 */
class impresiones_pdf extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function imprimir_boleta_Permiso_vacaciones($id_jus) {
        $this->load->library('pdf');
        $this->load->model('justificaciones_model');
        $this->load->model('historial_jus_per_vac_bm_model');
        $data['sesion'] = $this->basicauth->datosSession();
        $data['id_jus'] = $id_jus;
        $data['rs_datos'] = $this->justificaciones_model->obtenerInformacionJustificacionPermiso($id_jus);
        $data['rs_historial_datos'] = $this->historial_jus_per_vac_bm_model->obtenerHistorial_justificacion_firmas($id_jus);
        $this->load->view('generador_pdf/boleta_permiso_vacacion_view', $data);
    }

    function reporte_horas_extra_por_proyecto($mes, $anio, $proyecto) {
        $this->load->library('pdf');
        $this->load->model('usuario_model');
        $this->load->model('destino_model');
        $this->load->model('horas_extra_model');
        $this->load->model('proyecto_model');


        //$matriz = $this->basicauth->datosSession();

        $data['mes'] = $mes;
        $data['anio'] = $anio;
        $data['proyecto'] = $proyecto;
        $data['reporte'] = $this->horas_extra_model->rep_he_ok_por_proyecto($mes, $anio, $proyecto); //consulta
        $data['reporteSQL'] = $this->horas_extra_model->rep_he_ok_por_proyectoSQL($mes, $anio, $proyecto); //consulta
        $data['totales_reporte'] = $this->horas_extra_model->rep_he_ok_por_proyecto_suma($mes, $anio, $proyecto); //consulta
        $data['totales_tipo_trabajo'] = $this->horas_extra_model->rep_he_ok_por_proyecto_suma_tipo_trabajo($mes, $anio, $proyecto); //consulta


        $data['datos_proyecto'] = $this->proyecto_model->obtener_datos_proyecto($proyecto); //row

        $data['datos_usuario'] = $this->usuario_model->obtiene_datos_usuarioX($this->session->userdata('id_admin')); //row
        //echo "<br>Ingresa<br>";
        $this->load->view('generador_pdf/reporte_horas_extra_por_proyecto_pdf_view', $data);
    }

    function reporte_horas_extra_personal($mes, $anio) {
        $this->load->library('pdf');
        $this->load->model('usuario_model');
        $this->load->model('destino_model');
        $this->load->model('horas_extra_model');
        $this->load->model('proyecto_model');


        // $matriz = $this->basicauth->datosSession();

        $data['mes'] = $mes;
        $data['anio'] = $anio;
        $data['proyecto'] = 9;
        $data['reporte'] = $this->horas_extra_model->rep_he_ok_por_proyecto($mes, $anio, 9); //consulta
        $data['reporteSQL'] = $this->horas_extra_model->rep_he_ok_por_proyectoSQL($mes, $anio, 9); //consulta
        $data['totales_reporte'] = $this->horas_extra_model->rep_he_ok_por_proyecto_suma($mes, $anio, 9); //consulta
        $data['totales_tipo_trabajo'] = $this->horas_extra_model->rep_he_ok_por_proyecto_suma_tipo_trabajo($mes, $anio, 9); //consulta


        $data['datos_proyecto'] = $this->proyecto_model->obtener_datos_proyecto(9); //row
        $data['datos_usuario'] = $this->usuario_model->obtiene_datos_usuarioX($this->session->userdata('id_admin')); //row

        $this->load->view('generador_pdf/reporte_horas_extra_personal_pdf_view', $data);
    }

    /* function GeneraPDF3(){
      $this->load->library('pdf');
      $this->load->view('ImprimirBoleta');
      }
      function generapdf2(){
      // Se carga el modelo alumno
      //this->load->model('alumno_modelo');
      // Se carga la libreria fpdf
      $this->load->library('pdf');

      // Se obtienen los alumnos de la base de datos
      // $alumnos = $this->alumno_modelo->obtenerListaAlumnos();

      // Creacion del PDF


      //  Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
      // heredó todos las variables y métodos de fpdf

      $this->pdf = new pdf();
      // Agregamos una página
      $this->pdf->AddPage();
      // Define el alias para el número de página que se imprimirá en el pie
      $this->pdf->AliasNbPages();

      //Se define el titulo, márgenes izquierdo, derecho y
      //el color de relleno predeterminado
      //
      $this->pdf->SetTitle("Lista de alumnos");
      $this->pdf->SetLeftMargin(15);
      $this->pdf->SetRightMargin(15);
      $this->pdf->SetFillColor(200,200,200);

      // Se define el formato de fuente: Arial, negritas, tamaño 9
      $this->pdf->SetFont('Arial', 'B', 9);
      //
      // TITULOS DE COLUMNAS
      //
      // $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
      //

      $this->pdf->Cell(15,7,'NUM','TBL',0,'C','1');
      $this->pdf->Cell(25,7,'PATERNO','TB',0,'L','1');
      $this->pdf->Cell(25,7,'MATERNO','TB',0,'L','1');
      $this->pdf->Cell(25,7,'NOMBRE','TB',0,'L','1');
      $this->pdf->Cell(40,7,'FECHA DE NACIMIENTO','TB',0,'C','1');
      $this->pdf->Cell(25,7,'GRADO','TB',0,'L','1');
      $this->pdf->Cell(25,7,'GRUPO','TBR',0,'C','1');
      $this->pdf->Ln(7);
      // La variable $x se utiliza para mostrar un número consecutivo
      for ($x=1;$x<=100;$x++) {
      // se imprime el numero actual y despues se incrementa el valor de $x en uno
      $this->pdf->Cell(15,5,$x,'BL',0,'C',0);
      // Se imprimen los datos de cada alumno
      // $this->pdf->Cell(25,5,$alumno->paterno,'B',0,'L',0);
      $this->pdf->Cell(25,5,$alumno->materno,'B',0,'L',0);
      $this->pdf->Cell(25,5,$alumno->nombre,'B',0,'L',0);
      $this->pdf->Cell(40,5,$alumno->fec_nac,'B',0,'C',0);
      $this->pdf->Cell(25,5,$alumno->grado,'B',0,'L',0);
      $this->pdf->Cell(25,5,$alumno->grupo,'BR',0,'C',0);
      //Se agrega un salto de linea//
      $this->pdf->Ln(5);
      }
      /*
     * Se manda el pdf al navegador
     *
     * $this->pdf->Output(nombredelarchivo, destino);
     *
     * I = Muestra el pdf en el navegador
     * D = Envia el pdf para descarga
     *
     */

    // $this->pdf->Output("Lista de alumnos.pdf", 'I');
    // }
    //SE ESTA ADICIONANDO ESTAS NUEVAS FUNCIONES PARA IMPRESION RPM
    function imprimir_detalle_boleta_movimiento_almacen($id_mov_alm) {
        //echo $id_mov_alm;
        $this->load->library('pdf');
        $this->load->model('movimiento_almacen_model');
        //$this->load->model('historial_jus_per_vac_bm_model');
        $data['sesion'] = $this->basicauth->datosSession();
        // $data['id_jus']=  $id_jus;
        $data['registros1'] = $this->movimiento_almacen_model->ver_al_detalle($id_mov_alm);
        $data['registros2'] = $this->movimiento_almacen_model->encargado_almacen($id_mov_alm);

        $data['id_ma'] = $id_mov_alm;
        //  $data['rs_datos']=$this->justificaciones_model->obtenerInformacionJustificacionPermiso($id_mov_alm);
        //  $data['rs_historial_datos']=$this->historial_jus_per_vac_bm_model->obtenerHistorial_justificacion_firmas($id_mov_alm);
        $this->load->view('generador_pdf/boleta_detalle_movimiento_almacen_view', $data);
    }

    // add function by: POMA RIVERO
    function imprimir_asignacion_vehiculo_proyecto() {
        $this->load->library('pdf');
        $this->load->model('vehiculo_model');
        $this->load->model('proyecto_model');

        $this->load->model('asignacion_vehi_regional_model');
        $proyecto = $this->proyecto_model->seleccionar_proyecto_nombre();
        $asignados_proyecto = array();
        foreach ($proyecto->result()as $reg) {
            $asignados_proyecto[$reg->id_proy] = $this->vehiculo_model->buscar_asignado_vehiculo_por_proyecto($reg->id_proy);
        }
        // echo 'entraaa';
        $data['asignados_proyecto'] = $asignados_proyecto;
        $data['proyecto'] = $proyecto;
        //echo ''.$asignados;
        $this->load->view('generador_pdf/boleta_asignacion_vehiculo_por_proyecto_view', $data);
    }

    function imprimir_asignacion_vehiculo_proyecto_2() {
        //$this->load->library('pdf');
        $this->load->model('vehiculo_model');
        $this->load->model('proyecto_model');
        $this->load->model('generar_grafica_model');

        $this->load->model('asignacion_vehi_regional_model');
        $proyecto = $this->proyecto_model->seleccionar_proyecto_nombre();
        $datos_taller = $this->vehiculo_model->buscar_asignado_taller();


        $lista_vehiculo = $this->generar_grafica_model->listar_vehiculo_estado_activo();
        $datos = array();
        $datos2 = array();
        $i = 0;
        $j = 0;
        foreach ($lista_vehiculo->result()as $reg) {
            $datos_no_asig = $this->vehiculo_model->buscar_vehiculos_no_asig($reg->id_vehiculo);

            if ($datos_no_asig == "Sin asignacion") {
                $datos2[$j] = $reg;
                $j++;
            } else {
                if ($datos_no_asig != '') {
                    $datos[$i] = $datos_no_asig;
                    $i++;
                }
            }
        }

        //$asignados_proyecto=array();
        // foreach ($proyecto->result()as $reg)
        // {
        $asignados_proyecto = $this->vehiculo_model->buscar_asignado_vehiculo_por_proyecto();
        //}

        $data['asignados_proyecto'] = $asignados_proyecto;
        $data['proyecto'] = $proyecto;
        $data['datos_taller'] = $datos_taller;

        $data['datos_no_asig'] = $datos;
        $data['datos_no_asig_dos'] = $datos2;

        $this->load->view('generador_pdf/boleta_asignacion_vehiculo_por_proyecto_excel_view', $data);
    }

    function imprimir_detalle_usuario($id_usuario) {

        //echo 'esto es el ID USUARIO'.$id_usuario;
        $this->load->library('pdf');
        $this->load->model('usuario_model');
        $this->load->model('experiencia_laboral_model');
        $this->load->model('estudio_personal_model');
        $data['d_usuario'] = $this->usuario_model->obtener_user($id_usuario);
        $data['exp_usuario'] = $this->experiencia_laboral_model->lista_experiencia($id_usuario);
        $data['est_usuario'] = $this->estudio_personal_model->lista_logro_academico2($id_usuario);
        $data['id_send'] = $id_usuario;
        $this->load->view('generador_pdf/boleta_detalle_usuario_view', $data);
    }

    //rendiciones....
    function imp_form_rendiciones($id_rendicion) {
        $this->load->model('usuario_model');
        $this->load->model('proyecto_model');
        $this->load->model('contabilidad_plan_cuenta_model');
        $this->load->model('rendiciones_model');

        // $data['d_usuario'] = $this->usuario_model->obtener_user($id_usuario);
        $data['datos_rendicion'] = $this->contabilidad_plan_cuenta_model->obtener_datos_rendicion_guardados($id_rendicion);
        $data['dato_usuario_resp'] = $this->contabilidad_plan_cuenta_model->obtener_usuario_responsable_registro($id_rendicion);
        $data['dato_usuario_tecnico'] = $this->contabilidad_plan_cuenta_model->obtener_usuario_tecnico($id_rendicion);

        // obtener dats transport
        // $data['datos_rendicion_detalle_traA'] = $this->rendiciones_model->obtener_detalle_datos_rendicion_agrupado($id_rendicion,'tra',1);
        //  $data['datos_rendicion_detalle_traB'] = $this->rendiciones_model->obtener_detalle_datos_rendicion_agrupado($id_rendicion,'tra',0);
        $data['traA'] = $dato_traA = $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion, 'tra', 1);
        $data['traB'] = $dato_traB = $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion, 'tra', 0);
        $data['sgrA'] = $dato_sgrA = $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion, 'sgr', 1);
        $data['sgrB'] = $dato_sgrB = $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion, 'sgr', 0);
        $data['sgrC'] = $dato_sgrC = $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion, 'tel', 1);

        $datos_rendicion_detalle_traA = array();
        foreach ($dato_traA->result() as $registro) {
            $datos_rendicion_detalle_traA[$registro->id_tipo_gasto] = $this->rendiciones_model->obtener_detalle_datos_rendicion_agrupado($registro->id_reg_rendicion, $registro->id_tipo_gasto, 1);
        }
        $data['datos_rendicion_detalle_traA'] = $datos_rendicion_detalle_traA;

        $datos_rendicion_detalle_traB = array();
        foreach ($dato_traB->result() as $registro) {
            $datos_rendicion_detalle_traB[$registro->id_tipo_gasto] = $this->rendiciones_model->obtener_detalle_datos_rendicion_agrupado($registro->id_reg_rendicion, $registro->id_tipo_gasto, 0);
        }
        $data['datos_rendicion_detalle_traB'] = $datos_rendicion_detalle_traB;

        $datos_rendicion_detalle_sgrA = array();
        foreach ($dato_sgrA->result() as $registro) {
            $datos_rendicion_detalle_sgrA[$registro->id_tipo_gasto] = $this->rendiciones_model->obtener_detalle_datos_rendicion_agrupado($registro->id_reg_rendicion, $registro->id_tipo_gasto, 1);
        }
        $data['datos_rendicion_detalle_sgrA'] = $datos_rendicion_detalle_sgrA;

        $datos_rendicion_detalle_sgrB = array();
        foreach ($dato_sgrB->result() as $registro) {
            $datos_rendicion_detalle_sgrB[$registro->id_tipo_gasto] = $this->rendiciones_model->obtener_detalle_datos_rendicion_agrupado($registro->id_reg_rendicion, $registro->id_tipo_gasto, 0);
        }
        $data['datos_rendicion_detalle_sgrB'] = $datos_rendicion_detalle_sgrB;

        $datos_rendicion_detalle_sgrC = array();
        foreach ($dato_sgrC->result() as $registro) {
            $datos_rendicion_detalle_sgrC[$registro->id_tipo_gasto] = $this->rendiciones_model->obtener_detalle_datos_rendicion_agrupado($registro->id_reg_rendicion, $registro->id_tipo_gasto, 1);
        }
        $data['datos_rendicion_detalle_sgrC'] = $datos_rendicion_detalle_sgrC;



        $this->load->library('pdf');
        $this->load->view('generador_pdf/boleta_de_rendicion_view', $data);
    }

    function imp_form_rendiciones_asiento($id_rendicion) {
        echo 'entraaaaaaaaaaa';
        $this->load->model('usuario_model');
        $this->load->model('proyecto_model');
        $this->load->model('contabilidad_plan_cuenta_model');

        // $data['d_usuario'] = $this->usuario_model->obtener_user($id_usuario);
        $data['datos_rendicion'] = $this->contabilidad_plan_cuenta_model->obtener_datos_rendicion_guardados($id_rendicion);
        $data['dato_usuario_resp'] = $this->contabilidad_plan_cuenta_model->obtener_usuario_responsable_registro($id_rendicion);
        $data['dato_usuario_tecnico'] = $this->contabilidad_plan_cuenta_model->obtener_usuario_tecnico($id_rendicion);
        $data['traA'] = $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion, 'tra', 1);
        $data['traB'] = $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion, 'tra', 0);
        $data['sgrA'] = $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion, 'sgr', 1);
        $data['sgrB'] = $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion, 'sgr', 0);
        $data['sgrC'] = $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion, 'tel', 1);
        $this->load->library('pdf');
        $this->load->view('generador_pdf/boleta_de_rendicion_asiento_view', $data);
    }

    function factura_venta_impresion($id) {

        $this->load->library('pdf');
        $this->load->model('factura_venta_model');
        $this->load->model('proyecto_model');
        $data['id'] = $id;

        $data['dato_factura'] = $this->factura_venta_model->obtener_factura_venta($id);
        $d = $data['dato_factura'];
        $data['detalle_factura'] = $this->factura_venta_model->obtener_detalle_factura_venta($id);
        $data['datos_dosificacion'] = $this->factura_venta_model->obtener_dosificacion($d->id_dosificacion);
        //echo 'entraaaaa'; 
        $data['proy'] = $this->proyecto_model->obtener_datos_proyecto($d->id_proyecto)->row();
        //echo "idcontrato=".	
        $data['cont'] = $this->proyecto_model->obtener_datos_contrato($d->id_contrato)->row();
        //echo 'entraaaaa'; 
        $numero = explode(".", $d->monto_total_bs);
        $num = $numero[0];
        $centavo = $numero[1];

        $tex = $this->factura_venta_model->num_letra($num, $fem = false, $dec = true);
        $literal = $tex . " " . $centavo . "/100 ";


        $data['literal'] = $literal;


        $this->load->view('generador_pdf/impresion_de_factura_view', $data);
    }

    function nota_fiscal_impresion($id) {

        $this->load->library('pdf');
        $this->load->model('nota_fiscal_model');
        $this->load->model('proyecto_model');
        $data['id'] = $id;

        $data['dato_factura'] = $this->nota_fiscal_model->obtener_nota_fiscal($id);
        $d = $data['dato_factura'];
        $data['detalle_factura_org'] = $this->nota_fiscal_model->obtener_detalle_nota_fiscal($id, "original");
        $data['detalle_factura_dev'] = $this->nota_fiscal_model->obtener_detalle_nota_fiscal($id, "devolucion");

        $data['datos_dosificacion'] = $this->nota_fiscal_model->obtener_dosificacion($d->id_dosificacion);
        //echo 'entraaaaa'; 
        $data['proy'] = $this->proyecto_model->obtener_datos_proyecto($d->id_proyecto)->row();
        //echo "idcontrato=".	
        $data['cont'] = $this->proyecto_model->obtener_datos_contrato($d->id_contrato)->row();
        //echo 'entraaaaa'; 
        $numero = explode(".", $d->monto_devolucion);
        $num = $numero[0];
        $centavo = $numero[1];

        $tex = $this->nota_fiscal_model->num_letra($num, $fem = false, $dec = true);
        $literal = $tex . " " . $centavo . "/100 ";


        $data['literal'] = $literal;


        $this->load->view('generador_pdf/impresion_nota_fiscal', $data);
    }

    function imp_rendicion_por_proyecto($ids) {
        // echo 'estos son los Ids'.$ids;
        $this->load->library('pdf');
        $this->load->model('rendiciones_model');
        $this->load->model('proyecto_model');

        $data['datos_rendicion'] = $this->rendiciones_model->dato_rendicion_pro();

        // para generar por proyecto
        $proyecto = $this->proyecto_model->seleccionar_proyecto_nombre();
        $rendiciones_proyecto = array();
        foreach ($proyecto->result()as $reg) {
            $rendiciones_proyecto[$reg->id_proy] = $this->rendiciones_model->buscar_rendiciones_por_proyecto();
        }

        $data['proyecto'] = $proyecto;
        $data['rendiciones_proyecto'] = $rendiciones_proyecto;



        /*
          $this->load->model('usuario_model');
          $this->load->model('proyecto_model');
          $this->load->model('contabilidad_plan_cuenta_model');

          // $data['d_usuario'] = $this->usuario_model->obtener_user($id_usuario);

          $data['dato_usuario_resp'] = $this->contabilidad_plan_cuenta_model->obtener_usuario_responsable_registro($id_rendicion);
          $data['dato_usuario_tecnico'] = $this->contabilidad_plan_cuenta_model->obtener_usuario_tecnico($id_rendicion);
          $data['traA']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'tra',1);
          $data['traB']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'tra',0);
          $data['sgrA']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'sgr',1);
          $data['sgrB']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'sgr',0);
          $data['sgrC']= $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion,'tel',1);
         */


        $this->load->view('generador_pdf/boleta_de_rendicion_proy_view', $data);
    }

    function imp_form_rendiciones_tecnico($id_rendicion) {
        //echo 'entraaaaaaaaaaa';
        $this->load->model('usuario_model');
        $this->load->model('proyecto_model');
        $this->load->model('contabilidad_plan_cuenta_model');

        // $data['d_usuario'] = $this->usuario_model->obtener_user($id_usuario);
        $data['datos_rendicion'] = $this->contabilidad_plan_cuenta_model->obtener_datos_rendicion_guardados($id_rendicion);
        $data['dato_usuario_resp'] = $this->contabilidad_plan_cuenta_model->obtener_usuario_responsable_registro($id_rendicion);
        $data['dato_usuario_tecnico'] = $this->contabilidad_plan_cuenta_model->obtener_usuario_tecnico($id_rendicion);
        $data['traA'] = $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion, 'tra', 1);
        $data['traB'] = $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion, 'tra', 0);
        $data['sgrA'] = $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion, 'sgr', 1);
        $data['sgrB'] = $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion, 'sgr', 0);
        $data['sgrC'] = $this->contabilidad_plan_cuenta_model->obtener_form_tipo($id_rendicion, 'tel', 1);
        $this->load->library('pdf');
        $this->load->view('generador_pdf/boleta_de_rendicion_tecnico_view', $data);
    }

    function imp_etiqueta_activos($salida, $detalle) {
        //echo 'entraaaaaaaaaaa';
        $this->load->library('pdf');
        $this->load->model('movimiento_almacen_model');
        //$this->load->model('');
        $data['datos_salida'] = $this->movimiento_almacen_model->obtener_detalle_movimiento_almacen($detalle);
        $this->load->view('generador_pdf/etiqueta_activo_fijo_view', $data);
    }

    function factura_venta_impresion_bloque($bloque) {

        $this->load->library('pdf');
        $this->load->model('factura_venta_model');
        $this->load->model('proyecto_model');
        $detalles = array();
        $dosificaciones = array();
        $proyectos = array();
        $contratos = array();
        $literales = array();
        $data['bloque'] = $bloque;

        $data['datos_factura'] = $this->factura_venta_model->obtener_factura_venta_bloque($bloque);
        $d = $data['datos_factura'];

        foreach ($d->result() as $facturas) {

            $detalles[$facturas->id_factura] = $this->factura_venta_model->obtener_detalle_factura_venta($facturas->id_factura);
            $dosificaciones[$facturas->id_factura] = $this->factura_venta_model->obtener_dosificacion($facturas->id_dosificacion);
            $proyectos[$facturas->id_factura] = $this->proyecto_model->obtener_datos_proyecto($facturas->id_proyecto)->row();
            $contratos[$facturas->id_factura] = $this->proyecto_model->obtener_datos_contrato($facturas->id_contrato)->row();

            $numero = explode(".", $facturas->monto_total_bs);
            $num = $numero[0];
            $centavo = $numero[1];

            $tex = $this->factura_venta_model->num_letra($num, $fem = false, $dec = true);
            $literal = $tex . " " . $centavo . "/100 ";

            $literales[$facturas->id_factura] = $literal;
        }

        $data['detalles'] = $detalles;
        $data['dosificaciones'] = $dosificaciones;
        $data['proyectos'] = $proyectos;
        $data['contratos'] = $contratos;

        $data['literales'] = $literales;


        $this->load->view('generador_pdf/impresion_de_factura_bloque_view', $data);
    }

    function reporte_viaticos_extraordinarios_proyecto($mes, $anio, $proy) {

        $this->load->library('pdf');
        $this->load->model('calculosvextra_model');
        $reporte = $this->calculosvextra_model->reporte_proyecto($mes, $anio, $proy);
        $resultado = $reporte[0];
        $literales = array();
        foreach ($resultado->result() as $proy) {
            foreach ($reporte[$proy->id_proyecto]->result() as $viatico) {
                $numero = number_format($viatico->monto_calculado / 0.87, 2, '.', '');
                $num = explode('.', $numero);
                $literales[$viatico->id_viatico_extra] = strtoupper($this->calculosvextra_model->num_letra($num[0]) . " " . $num[1] . "/100 Bolivianos");
            }
        }
        $data['literales'] = $literales;
        $data['reporte'] = $reporte;
        $data['fecha'] = '20/06/2018';


        $this->load->view('generador_pdf/reporte_viatico_extraordinario_proyecto', $data);
    }

    function reporte_viaticos_extraordinarios_persona($mes, $anio, $proy) {

        $this->load->library('pdf');
        $this->load->model('calculosvextra_model');
        $reporte = $this->calculosvextra_model->reporte_viatextra_persona($mes, $anio, $proy);
        $resultado = $reporte[0];
        $literales = array();
        foreach ($resultado->result() as $usuario) {
            foreach ($reporte[$usuario->cod_user]->result() as $viatico) {
                $numero = number_format($viatico->monto_calculado / 0.87, 2, '.', '');
                $num = explode('.', $numero);
                $literales[$viatico->id_viatico_extra] = strtoupper($this->calculosvextra_model->num_letra($num[0]) . " " . $num[1] . "/100 Bolivianos");
            }
        }
        $data['literales'] = $literales;
        $data['reporte'] = $reporte;
        $data['fecha'] = '20/06/2018';


        $this->load->view('generador_pdf/reporte_viatico_extraordinario_usuario', $data);
    }

    function imprimir_cheque($id_cheque) {



        $this->load->library('pdf');
        $this->load->model('e_chequera_model');
        $this->load->model('factura_venta_model');
        //echo "hasta aqui ok";
        $d_cheques = $this->e_chequera_model->obtener_registro_cheque($id_cheque);
        $data['cheque'] = $d_cheques;
        $literal = "";


        $numero = explode(".", $d_cheques->monto);
        $num = $numero[0];
        $centavo = $numero[1];

        $tex = $this->factura_venta_model->num_letra($num, $fem = false, $dec = true);
        $literal = $tex . " " . $centavo . "/100 ";


        $data["literal"] = $literal;




        $this->load->view('generador_pdf/impresion_cheques_varios_view', $data);
        //$this->load->view('generador_pdf/impresion_cheques_varios_continuo', $data);
    }
    
     function imprimir_cheque_resumen($fecha) {



        $this->load->library('pdf');
        $this->load->model('e_chequera_model');
       
        //echo "hasta aqui ok";
        $d_cheques = $this->e_chequera_model->obtener_registro_cheque_dia($fecha);
        $data['cheque'] = $d_cheques;
        $data['fecha_sol'] = $fecha;
       
        $this->load->view('generador_pdf/impresion_resumen_cheques_dia', $data);
        //$this->load->view('generador_pdf/impresion_cheques_varios_continuo', $data);
    }


    function imprimir_cheque_varios($cod_grupal) {



        $this->load->library('pdf');
        $this->load->model('e_chequera_model');
        $this->load->model('factura_venta_model');
        //echo "hasta aqui ok";
        $d_cheques = $this->e_chequera_model->obtener_cheque_grupal($cod_grupal);
        $data['cheques'] = $d_cheques;
        $literal = array();


        foreach ($d_cheques->result() as $cheque) {

            $numero = explode(".", $cheque->monto);
            $num = $numero[0];
            $centavo = $numero[1];

            $tex = $this->factura_venta_model->num_letra($num, $fem = false, $dec = true);
            $literal[$cheque->id_cheque] = $tex . " " . $centavo . "/100 ";
        }

        $data["literal"] = $literal;




        $this->load->view('generador_pdf/impresion_cheques_varios_view2', $data);
        //$this->load->view('generador_pdf/impresion_cheques_varios_continuo', $data);
    }

    // add 04/01/2018
    function imp_etiqueta_mov_ingreso($ingreso, $detalle) {
        //echo 'entraaaaaaaaaaa';
        $this->load->library('pdf');
        $this->load->model('movimiento_almacen_model');
        //$this->load->model('');
        $data['datos_ingreso'] = $this->movimiento_almacen_model->obtener_detalle_movimiento_almacen($detalle);
        $this->load->view('generador_pdf/etiqueta_ingreso_mat_view', $data);
    }

    function imp_etiqueta_activo_inicial($ingreso, $detalle) {
        //echo 'entraaaaaaaaaaa';
        $this->load->library('pdf');
        $this->load->model('movimiento_almacen_model');
        //$this->load->model('');
        $data['datos_ingreso'] = $this->movimiento_almacen_model->obtener_detalle_movimiento_almacen($detalle);
        $this->load->view('generador_pdf/etiqueta_ingreso_activo_inicial', $data);
    }

    function cod_bar() {
        //echo 'entraaaaaaaaaaa';
        $this->load->library('pdf');
        //$this->load->model('movimiento_almacen_model');
        //$this->load->model('');
        //$data['datos_ingreso'] = $this->movimiento_almacen_model->obtener_detalle_movimiento_almacen($detalle);
        $this->load->view('generador_pdf/cod_bar_credenciales_view');
    }

    function imp_form_solicitud_Fondos($id_rendicion) {
        $this->load->model('usuario_model');
        $this->load->model('proyecto_model');
        $this->load->model('factura_venta_model');
        $this->load->model('rendiciones_model');
        $this->load->model('fondosRendir_model');

        // $data['d_usuario'] = $this->usuario_model->obtener_user($id_usuario);
        // $data['datos_rendicion'] = $this->contabilidad_plan_cuenta_model->obtener_datos_rendicion_guardados($id_rendicion);
        $data['datos_solicitud'] = $this->fondosRendir_model->obtener_datos_sol_fondos($id_rendicion);
        $data['detalle_solicitud'] = $this->fondosRendir_model->obtener_datos_sol_fondos_detalle($id_rendicion);
        $data['dato_usuario_resp'] = $this->usuario_model->obtener_user($data['datos_solicitud']->row()->user_register);
        $data['dato_usuario_tecnico'] = $this->usuario_model->obtener_user($data['datos_solicitud']->row()->id_usuario);

        
        $literal = "";
        $numero = explode(".", $data['datos_solicitud']->row()->monto);
        $num = $numero[0];
        $centavo = $numero[1];

        $tex = $this->factura_venta_model->num_letra($num, $fem = false, $dec = true);
        $literal = $tex . " " . $centavo . "/100 ";


        $data["literal"] = $literal;
        



        $this->load->library('pdf');
        $this->load->view('generador_pdf/impresion_sol_fr_view', $data);
    }

}

?>
