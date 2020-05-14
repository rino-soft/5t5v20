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

    function imprimir_boleta_Permiso_vacaciones($id_jus){
       // echo 'funciona';
        $this->load->library('pdf');
        $this->load->model('justificaciones_model');
        $this->load->model('historial_jus_per_vac_bm_model');
       // $data['sesion'] = $this->basicauth->datosSession();
        $data['id_jus']=  $id_jus;
        $data['rs_datos']=$this->justificaciones_model->obtenerInformacionJustificacionPermiso($id_jus);
        $data['rs_historial_datos']=$this->historial_jus_per_vac_bm_model->obtenerHistorial_justificacion_firmas($id_jus);
      $this->load->view('generador_pdf/boleta_permiso_vacacion_view',$data);
    }
    
    function reporte_horas_extra_por_proyecto($mes,$anio,$proyecto)
    {
        
        $this->load->library('pdf');
        $this->load->model('usuario_model');
        $this->load->model('destino_model');
        $this->load->model('horas_extra_model');
        $this->load->model('proyecto_model');
        

      //  $matriz = $this->basicauth->datosSession();
        
        $data['mes']=$mes;
        $data['anio']=$anio;
        $data['proyecto']=$proyecto;
        $data['reporte']=$this->horas_extra_model->rep_he_ok_por_proyecto($mes,$anio,$proyecto);//consulta
        $data['reporteSQL']=$this->horas_extra_model->rep_he_ok_por_proyectoSQL($mes,$anio,$proyecto);//consulta
        $data['totales_reporte']=$this->horas_extra_model->rep_he_ok_por_proyecto_suma($mes,$anio,$proyecto);//consulta
        $data['totales_tipo_trabajo']=$this->horas_extra_model->rep_he_ok_por_proyecto_suma_tipo_trabajo($mes,$anio,$proyecto);//consulta
        
        
        $data['datos_proyecto']=$this->proyecto_model->obtener_datos_proyecto($proyecto);//row    // no existe la funcion
        $data['datos_usuario']=$this->usuario_model->obtiene_datos_usuarioX( $this->session->userdata('id_admin'));//row   //no existe la funcion
        
         $this->load->view('generador_pdf/reporte_horas_extra_por_proyecto_pdf_view',$data);
    }
    
    
    
    function reporte_horas_extra_personal($mes,$anio)
    {
        $this->load->library('pdf');
        $this->load->model('usuario_model');
        $this->load->model('destino_model');
        $this->load->model('horas_extra_model');
        $this->load->model('proyecto_model');
        

      //  $matriz = $this->basicauth->datosSession();
        
        $data['mes']=$mes;
        $data['anio']=$anio;
        $data['proyecto']=9;
        $data['reporte']=$this->horas_extra_model->rep_he_ok_por_proyecto($mes,$anio,9);//consulta
        $data['reporteSQL']=$this->horas_extra_model->rep_he_ok_por_proyectoSQL($mes,$anio,9);//consulta
        $data['totales_reporte']=$this->horas_extra_model->rep_he_ok_por_proyecto_suma($mes,$anio,9);//consulta
        $data['totales_tipo_trabajo']=$this->horas_extra_model->rep_he_ok_por_proyecto_suma_tipo_trabajo($mes,$anio,9);//consulta
        
        
        $data['datos_proyecto']=$this->proyecto_model->obtener_datos_proyecto(9);//row
        $data['datos_usuario']=$this->usuario_model->obtiene_datos_usuarioX($this->session->userdata('id_admin'));//row
        
         $this->load->view('generador_pdf/reporte_horas_extra_personal_pdf_view',$data);
    }
    
    
    
    /*function GeneraPDF3(){
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

}

?>
