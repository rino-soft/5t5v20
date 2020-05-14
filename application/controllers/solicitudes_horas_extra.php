<?php

class solicitudes_horas_extra extends CI_Controller {

    function __construct() {
        parent::__construct();

        //$this->load->helper('url');
        $this->load->model('horas_extra_model');
        $this->load->model('menu_model');
        $this->load->model('usuario_model');
         if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }
   

    function form_nueva_hora_extra() {
        //echo 'funciona';
        $this->load->model('usuario_model');
        $this->load->model('destino_model');
        
        //$data['horasVacacion'] = $this->calcular_diasVacacion();
       // $matriz = $this->basicauth->datosSession();
        $data['deptos'] = $this->destino_model->devolverDeptos();
        $data['proyectos_usuario'] = $this->usuario_model->obtProyectoUser($this->session->userdata('id_admin')); //obtiene los proyectos activos del personal (el el caso de que sea 2 o mas proyectos)
        $this->load->view('horas_extras/registro_horas_extra_view', $data);
         //echo 'funciona';
    }
    function form_edit_hora_extra($padre)
    {
        $this->load->model('usuario_model');
        $this->load->model('destino_model');
        $this->load->model('auxiliar_model');
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        //$data['horasVacacion'] = $this->calcular_diasVacacion();
        //$matriz = $this->basicauth->datosSession();
        $data['datos_formulario']=$this->horas_extra_model->obtRegistroHe($this->input->post('indice'));
        $d=$data['datos_formulario']->row();
        
        $data['depsel']=$this->destino_model->ver_depto($d->lugar_he);
        
        $data['provsel']=$this->destino_model->ver_provincia($d->provincia);
       
        $data['deptos'] = $this->destino_model->devolverDeptos();
       $data['not']=$this->auxiliar_model->option_hora($d->fhnotificacion);
       $data['via']=$this->auxiliar_model->option_hora($d->fhviaje);
       $data['sit']=$this->auxiliar_model->option_hora($d->fhatencion);
       $data['fin']=$this->auxiliar_model->option_hora($d->fhconclusion);
        $data['provincias'] = $this->destino_model->obtener_provincias_depto($d->lugar_he);
       
        
        
        $this->load->view('horas_extras/editar_horas_extra_view', $data);
    }
        
  
    
    function ver_hora_extra()
    {
        $this->load->model('destino_model');
        $data['datos_horaE'] = $this->horas_extra_model->obtRegistroHe($this->input->post('indice')); //obtiene los proyectos activos del personal (el el caso de que sea 2 o mas proyectos)
        $datanow=$data['datos_horaE']->row();
        if($datanow->area==1)
        {
            $data['lugar']=$this->destino_model->ver_provincia($datanow->provincia);
        }
        else
            $data['lugar']=$this->destino_model->ver_depto($datanow->lugar_he);
        $this->load->view('horas_extras/ver_hora_extra_view', $data);
    }

    function guardar() {
        //$matriz = $this->basicauth->datosSession();

        $resultado = $this->horas_extra_model->nuevo_registro_he($this->session->userdata('id_admin'));

        //RUBEN PAYRUMANI INO Adicion de Registro de historial y de estados//
        echo "el resultado es " . $resultado;
        if ($resultado > 0) {
            //$this->load->model('historial_jus_per_vac_bm_model');
            //$this->load->model('qr_cod_model');
            //$evento = $this->input->post('estado');
            //$codigo = $this->historial_jus_per_vac_bm_model->adicionar_nuevo_evento($resultado, $evento);
            //$this->qr_cod_model->generar_firma_QR($codigo);  
            echo "ok se ha guardado la consulta";
        }
        // Ruben Payrumani Cierre de codigo modificado

        if ($resultado > 0)
            echo " se guardo correctamente";
        else
            echo " Hubo un error al guardar en la base de datos";
    }
    
    function editar() {
        //$matriz = $this->basicauth->datosSession();

        $resultado = $this->horas_extra_model->editar_registro_he($this->input->post("indice"));

        //RUBEN PAYRUMANI INO Adicion de Registro de historial y de estados//
        echo "el resultado es " . $resultado;
        if ($resultado > 0) {
            //$this->load->model('historial_jus_per_vac_bm_model');
            //$this->load->model('qr_cod_model');
            //$evento = $this->input->post('estado');
            //$codigo = $this->historial_jus_per_vac_bm_model->adicionar_nuevo_evento($resultado, $evento);
            //$this->qr_cod_model->generar_firma_QR($codigo);  
            echo "ok se ha guardado la consulta";
        }
        // Ruben Payrumani Cierre de codigo modificado

        if ($resultado > 0)
            echo " se guardo correctamente";
        else
            echo " Hubo un error al guardar en la base de datos";
    }
    

    function bandeja_salida($padre) {
        
        $this->load->model('usuario_model');
        //$this->load->model('destino_model');
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
       // $matriz = $this->basicauth->datosSession();
        $data['user'] = $this->session->userdata('nombres').' '.$this->session->userdata('apellidos'); 
        //$data['user'] = $matriz['nombres'] . ' ' . $matriz['apellidos'];
        //$data['main_menu'] = 'menus/EnlacesHijos';
        $data['titulo'] = 'Mis Horas Extra ';
        //$data['menu_completo'] = $this->menus_model->obtenerMenuCompleto($matriz['id']);

        $data['vista_enviada'] = "horas_extras/mis_horas_extra_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
      function index($padre) {
        $data['titulo'] = 'Horas Extras';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }

    function registros_horaExtra() {
        // echo "anio>>>".$this->input->post('anio')." mes>>".$this->input->post('mes');
        $data['mostrar_datos'] = $this->horas_extra_model->obtener_registros_hora_extra($this->input->post('mes'),$this->input->post('anio'));
         $this->load->view('horas_extras/datos_registro_horas_extra_view', $data);
    }
    
    function registro_solicitudes_horaExtra()
    {
         //echo 'funciona';
         $data['mostrar_datos'] = $this->horas_extra_model->obtener_registros_solicitudes_hora_extra($this->input->post('mes'),$this->input->post('anio'));
         $this->load->view('horas_extras/registros_solicitudes_horas_extra_view', $data);
    }

    function bandeja_autorizacion($padre){
        $this->load->model('usuario_model');
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        //$this->load->model('destino_model');

        //$matriz = $this->basicauth->datosSession();
        $data['user'] = $this->session->userdata('nombres').' '.$this->session->userdata('apellidos');
        //$data['main_menu'] = 'menus/EnlacesHijos';
        $data['titulo'] = 'Bandeja de Solicitudes de Horas extra';
        //$data['menu_completo'] = $this->menus_model->obtenerMenuCompleto($this->session->userdata('id_admin'));

        $data['vista_enviada'] = "horas_extras/bandeja_autorizacion_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
        
    }
    function reporte_he_proy($padre)
    {
        $this->load->model('usuario_model');
        
         $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        //$this->load->model('destino_model');

        //$matriz = $this->basicauth->datosSession();
        $data['user'] = $this->session->userdata('nombres').' '.$this->session->userdata('apellidos');
        //$data['main_menu'] = 'menus/EnlacesHijos';
        $data['titulo'] = 'Bandeja de Solicitudes de Horas extra';
        //$data['menu_completo'] = $this->menus_model->obtenerMenuCompleto($matriz['id']);     
        $data['proyectos_usuario'] = $this->usuario_model->obtProyectoUser($this->session->userdata('id_admin')); 
        
        $data['vista_enviada'] = "horas_extras/reporte_he_proyecto_jefe_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
    
     function reporte_he_personal($padre,$hijo)
    {
        $this->load->model('usuario_model');
         $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        //$this->load->model('destino_model');

        //$matriz = $this->basicauth->datosSession();
        $data['user'] = $this->session->userdata('nombres').' '.$this->session->userdata('apellidos');
        //$data['main_menu'] = 'menus/EnlacesHijos';
        $data['titulo'] = 'Bandeja de Solicitudes de Horas extra';
        //$data['menu_completo'] = $this->menus_model->obtenerMenuCompleto($this->session->userdata('id_admin'));     
       
        
        $data['vista_enviada'] = "horas_extras/reporte_he_personal_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
    
     function cambiarEstado() {
        //$this->load->model('historial_jus_per_vac_bm_model');
        //$this->load->model('qr_cod_model');                           despues 2da fase
        $this->horas_extra_model->cambio_estado_he($this->input->post('id'), $this->input->post('estado'));
       // $codigo = $this->historial_jus_per_vac_bm_model->adicionar_nuevo_evento($this->input->post('id'), $this->input->post('estado'));
       // echo '<br>CODIGO >>>>>>>>' . $codigo . '<br>';
       // if ($this->input->post('firma') == 1) {
        //    echo('ingreso a la function con firma');
           // $this->qr_cod_model->generar_firma_QR($codigo);
        //}
    }
    
    
    
    
    function verSolicitudJustificacion() {
        $data['indice'] = $this->input->post('indice');
        $this->load->model('justificaciones_model');
        $this->load->model('historial_jus_per_vac_bm_model');
        $data['datos'] = $this->justificaciones_model->justificacion($this->input->post('id'));
        $dat = $data['datos']->row();

        if ($dat->estado == "Enviado" or $dat->estado == "Obtenido") {

            $this->justificaciones_model->cambio_estado_justificacion($this->input->post('id'), 'Leido');
            $this->historial_jus_per_vac_bm_model->adicionar_nuevo_evento($this->input->post('id'), 'Leido');
        }

        $this->load->view('solicitudes/solicitudJustificacion_view', $data);
    }
    
    
    

    function tomarAccion() {
        $this->load->model('historial_jus_per_vac_bm_model');
        $this->justificaciones_model->cambio_estado_justificacion($this->input->post('id'), 'Obtenido');
        $this->historial_jus_per_vac_bm_model->adicionar_nuevo_evento($this->input->post('id'), 'Obtenido');
    }

   

    function obtener_estado() {
        echo $this->justificaciones_model->estado_justificacion($this->input->post('id'));
    }

}

?>
