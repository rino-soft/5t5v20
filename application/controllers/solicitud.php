<?php

/* clase controlador de solicitudes de uso vehicular, gasolina, alquileres
 * autor : Ruben Payrumani Ino
 * descripcion : controlador de vistas de solicitudes , formularios uso de librerias codeIgniter y Jquery
 */

class solicitud extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('solicitudes_model');
        $this->load->model('registros_model');
        
          $this->load->model('menu_model');//Adicionado por magali
             if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }
    
    //$padre,$hijo
    function index($padre) {
        $data['titulo'] = 'Solicitud SAV';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
   
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$                                       S O L I C  I T U D   D E   G A S O L I N A                                              $$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    function solGasolina($padre,$hijo){
        //tados template*************************************************************
        $this->load->model('proyecto_model');                                                                    //**
        $this->load->model('usuario_model');                                                                       //**
        $this->load->model('destino_model');                                                                       //**
        //$data['main_menu'] = 'menus/EnlacesHijos';                                                             //**
        $data['titulo'] = 'Solicitud de vales de Gasolina';                                                         //**
        //$matriz = $this->basicauth->datosSession();                                                            //**
        $data['user'] = $this->session->userdata('nombres').' '.$this->session->userdata('apellidos');                                      //**
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
//$data['menu_completo']=$this->menu_model->obtenerMenuCompleto($this->session->userdata('id_admin'));//**
        //***********************************************************************
        
        //$matriz = $this->basicauth->datosSession();
        //$data['user']=$matriz['id'];
        $data['proyectos']=  $this->proyecto_model->obtProyectos();
        $data['vale100']=$this->registros_model->obtener_vales_monto_libre(100,0,10)->result();//valor 100, registro inicial 0 y cantidad de registros 10
        $data['vale50']=$this->registros_model->obtener_vales_monto_libre(50,0,10)->result();   
        
        //carga en template //***********************************
        $data['vista_enviada'] = "solicitudes/solicitud_gasolina_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
        // ****************************************************
    }
    
     function C_AsignacionDirectaVehiculos(){
        //tados template*************************************************************
        $this->load->model('proyecto_model');                                                                    //**
        $this->load->model('usuario_model');                                                                       //**
        $this->load->model('destino_model');                                                                       //**
       // $data['main_menu'] = 'menus/EnlacesHijos';                                                             //**
        $data['titulo'] = 'Asignacion Directa de Vehiculos';                                                     //**
        //$matriz = $this->basicauth->datosSession();                                                            //**
        $data['user'] = $this->session->userdata('nombres').' '.$this->session->userdata('apellidos');                                     //**
        $data['menu_completo']=$this->menu_model->obtenerMenuCompleto($this->session->userdata('id_admin'));//**
        //***********************************************************************
        
        
        
        //carga en template //***********************************
        $data['vista_enviada'] = "solicitudes/asignacionDirectaVehiculo_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
        // ****************************************************
    }
    
    
    
    function adicionar_Solicitud_gasolina()
    {  
      //$matriz = $this->basicauth->datosSession();        
       $id_solGas = $this->solicitudes_model->registro_asignacion_vale_gasolina($this->session->userdata('id_admin'));
       $this->registros_model->asignarvalegasolinausuario($id_solGas);       
    }
    
    
    function confirmacion_Asignacio_vale()
    {
        $data['cantV50']=$cv50=$this->input->post('v50');  
        
        $data['cantV100']=$cv100=$this->input->post('v100');
        
        $data['vale50']=$this->registros_model->obtener_vales_monto_libre(50,0,$cv50); 
        $data['vale100']=$this->registros_model->obtener_vales_monto_libre(100,0,$cv100);
        $mensaje100=$mensaje50="NO";
        if($data['vale100']->num_rows()==$cv100)
            $mensaje100="OK";
        if($data['vale50']->num_rows()==$cv50)
            $mensaje50="OK";
        
         $data['mensaje50']   =$mensaje50;
         $data['mensaje100']   =$mensaje100;
         $data['total50']=$cv50*50;
         $data['total100']=$cv100*100;
         $data['total']=$cv50*50+$cv100*100;
        $data['solicitante']=$this->input->post('solicitante');
        $data['Proyecto']=$this->input->post('proyecto');
        $data['vehiculo']=$this->input->post('vehiculo');
        $data['comentario']=$this->input->post('comentario');
        $this->load->view('solicitudes/mod_asignacion_vales', $data);
    }
    
    function lista_Asignacion_vales_gasolina_proyecto()
    {
         $this->load->model('usuario_model');
        $proyecto= $this->input->post('proy');
        $ini=  $this->input->post('i');
        $cant= $this->input->post('c');
        $data['proyNombre']=$this->input->post('proyecto');
        $consulta=$this->solicitudes_model->Lista_asignaciones_vg($proyecto,$ini,$cant);
        $data['datos']=$consulta;
        $vectorCI=array();
        $j=0;
        foreach ($consulta as $value) {
            $vectorCI[$j]=$this->usuario_model->obtenerCI_admin($value->id_solicitante);
            $j++;
        }
        
        $data['ci_s']=$vectorCI;
        $this->load->view('solicitudes/lista_asignaciones_view', $data);
        
        
        
    }
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$                                  SOLICITUD DE USO DE VEHICULO fORMULARIO                                                      $$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    
    function solUsoVeh($padre,$hijo) { //arreglado por magali
         //tados template*************************************************************
        $this->load->model('proyecto_model');                                                                    //**
        $this->load->model('usuario_model');                                                                       //**
        $this->load->model('destino_model');                                                                       //**
        //$data['main_menu'] = 'menus/EnlacesHijos';                                                             //**
        $data['titulo'] = 'Solicitud de Uso Vehicular';                                                         //**
       // $matriz = $this->basicauth->datosSession();                                                            //**
        $data['user'] = $this->session->userdata('nombres').' '.$this->session->userdata('apellidos');                                      //**
        
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
    //$data['menu_completo']=$this->menu_model->obtenerMenuCompleto($this->session->userdata('id_admin'));//**
        //***********************************************************************
        
        $data['proyectos'] = $this->usuario_model->obtProyectoUser($this->session->userdata('id_admin'));
        $data['deptos'] = $this->destino_model->devolverDeptos();
        //carga en template //***********************************
        $data['vista_enviada'] = "solicitudes/solicitud_uso_vehicular_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
        // ****************************************************
        
    }

    function misSolicitudes($padre,$hijo) {    /// arreglado por magali
         //tados template*************************************************************
        $this->load->model('proyecto_model');                                                                    //**
        $this->load->model('usuario_model');                                                                       //**
        $this->load->model('destino_model');                                                                       //**
        //$data['main_menu'] = 'menus/EnlacesHijos';                                                             //**
        $data['titulo'] = 'Mis Solicitudes de uso';                                                         //**
        //$matriz = $this->basicauth->datosSession();                                                            //**
        $data['user'] = $this->session->userdata('nombres').' '.$this->session->userdata('apellidos');                                       //**
        
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);

//$data['menu_completo']=$this->menu_model->obtenerMenuCompleto($this->session->userdata('id_admin'));//**
        //***********************************************************************
        //mis solicitudes de Uso Vehcular
       // $matriz = $this->basicauth->datosSession();
        $data['mostrarDatos'] = $this->solicitudes_model->mis_solicitudes_uso_vehicular($this->session->userdata('id_admin'));
        //carga en template //***********************************
        $data['vista_enviada'] = "solicitudes/mis_solicitudes_view";
        $this->load->view('Plantilla/Plantilla_vista', $data);
        // ****************************************************
    }

   
    function verSolicitudEspecifica() {
        //modelos  que se nesecita ************************************
        $this->load->model('destino_model');
        $this->load->model('pasajeros_model');
        $this->load->model('vehiculo_model');
        
        // ************************************************************* 
        $nroSolicitud = $this->input->post('nroSol');
        $indice=$this->input->post('indice');
        $solicitud = $this->solicitudes_model->obtenerSolicitud($nroSolicitud);
        $data['solicitud'] = $solicitud;
        $data['ii']=$indice;
        $data['tipo']=$this->input->post('tipo');
        //$data['nro_solicitud']=$nroSolicitud;
        //tipo  = 0 solo ver sin opcion a nada
        // tipo = 1 puede ver las opciones de buscar vehiculo,editar y rechazar
        // tipo = 2 No definido
        // tipo = 3 No definido
        
        $data['destinos'] = $this->destino_model->ObtenerDestinosSUV($nroSolicitud);
        $data['conductor'] = $this->pasajeros_model->obtenerConductorSUV($nroSolicitud);
        $data['pasajeros'] = $this->pasajeros_model->obtenerPasajerosSUV($nroSolicitud);
        $data['vehiculos_asignados']=$this->vehiculo_model->obtener_vehiculos_asignados_a_solicitud($nroSolicitud);
        $this->load->view('solicitudes/verSolicitud', $data);
    }
    
    function formulario_asignacion_sol_uso_vehiculo() {
        $this->load->model('destino_model');
        $this->load->model('vehiculo_model');
        //************************* carga de Modelos a utiliar ***************
        $data['destinos'] = $this->destino_model->devolverDeptos();
        $data['tipovehiculo']= $this->vehiculo_model->obtener_tipoVehiculo();
        $nroSolicitud = $this->input->post('nroSol');
        $data['indice'] = $this->input->post('i');
        $data['solicitud'] = $this->solicitudes_model->obtenerSolicitud($nroSolicitud);
        $this->load->view('solicitudes/form_asignacion_vehiculo', $data);
    }

    function adicionarSolicitudUsoVehicular() 
    {
        //modelos  que se nesecita ************************************
        $this->load->model('destino_model');
        $this->load->model('pasajeros_model');
        // ************************************************************* 
        //$matriz = $this->basicauth->datosSession();
        $cod_actividad = $this->session->userdata('id_admin');
        $id_sol = $this->solicitudes_model->registro_solicitud($cod_actividad);
        echo $id_sol;
        $this->destino_model->EnlazarDestinos($id_sol, $cod_actividad);
        echo "se ha editado los destinos correctamente";
        $this->pasajeros_model->Adicionar_tripulacion($id_sol);
        echo "se ha adicionado la tripulacion correctamente";
        $this->solUsoVeh();
    }
    function obtenercalendarioSolicituddeusovehicular()
    {
        $soluso = $this->input->get('nroSol');
        $calendario = $this->input->get('vectorfechas');
       // echo "se envia los datos soluso => $soluso y calendario => $calendario";
        $this->solicitudes_model->obtenerocupadofechaSolicitudusovehicularJSON($soluso, $calendario);
    }
    function obtenerPlacaVehiculoDiaSolicitudUso()
    {
        $soluso = $this->input->get('nroSol');
        $dia = $this->input->get('dia');
       // echo "se envia los datos soluso => $soluso y calendario => $dia <br/>";
        $this->solicitudes_model->obtener_placa_dia_solicitado($soluso, $dia);
    }

//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
}

?>
