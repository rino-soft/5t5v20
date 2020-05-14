<?php
//autor Ruben Payrumani Ino
class destino extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model("destino_model");
        
    }
    
    function devolverProvinciasOption(){
        $dep = $this->input->post('d');
      //  echo 'ingreso a la funcion';
       $this->destino_model->obtener_provincias_option($dep);
    }
    function devolverProvincias(){
        $dep = $this->input->get('d');
        $resultado = $this->destino_model->obtener_provincias($dep);
    }
    function adicionarDestivoSUV()
    {
        $matriz = $this->basicauth->datosSession();
        $cod_actividad=$matriz['id'];
        $this->destino_model->adicionarLugarDetrabajoSAV($cod_actividad);
        
    }
    function eliminarDestivoSUV()
    {
        $this->destino_model->eliminarLugardetrabajo();
        
    }
    function mostrar_destinos(){
        $data['destinos_SUV']=$this->destino_model->mostrardatos($this->input->post('cod_act'));
        $this->load->view('destino/mostrar_destinos_SUV_view',$data);
        
    }
    function obtenerDestinos_JSON()
    {
        $matriz = $this->basicauth->datosSession();
        $cod_actividad=$matriz['id'];
        $resultado=$this->destino_model->obtener_destinosJSON($cod_actividad);
    }
    
}
?>
