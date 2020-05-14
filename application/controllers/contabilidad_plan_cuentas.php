<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of contabilidad_basico
 *
 * @author POMA RIVERO
 */
class contabilidad_plan_cuentas extends CI_Controller {
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('contabilidad_plan_cuenta_model');
        if ($this->auth->is_logged() == FALSE) {
           
            redirect(base_url('login'));
        }
        
    }
    function index($padre){
       // echo 'padreeeee'.$padre;
        $data['titulo'] = 'Contabilidad';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre); 
        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
    function plan_de_cuentas($padre,$hijo)
    { 
       // echo $padre;
        $data['titulo'] = 'Plan de Cuentas';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre); 
       $data['padre']=$padre;
       $data['hijo']=$hijo;
        $data['datos_cuenta']=$this->contabilidad_plan_cuenta_model->datos_del_plan_de_cuentas();  
        $data['datos_cuenta_select']=$this->contabilidad_plan_cuenta_model->datos_del_plan_de_cuentas_select(0,''); 
        $data['id_plan_cuenta']=0;
        
        $data['arbol_cuentas']=$this->contabilidad_plan_cuenta_model->obtener_cuentas_registradas(0,0);
        
        $data['vista_enviada'] = 'contabilidad_basico/plan_de_cuentas_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    } 
    
     function guardar_nuevo_registro_cuenta()
    {
        
        $this->contabilidad_plan_cuenta_model->guardar_nuevo_registro();
    }
 
    function eliminar_cuenta($reg){
        $this->contabilidad_plan_cuenta_model->del_registro_cuenta($reg);
         $data['datos_cuenta']=$this->contabilidad_plan_cuenta_model->datos_del_plan_de_cuentas();  
        $data['datos_cuenta_select']=$this->contabilidad_plan_cuenta_model->datos_del_plan_de_cuentas_select(0,''); 
        $data['id_plan_cuenta']=$padre;
        
        $data['arbol_cuentas']=$this->contabilidad_plan_cuenta_model->obtener_cuentas_registradas(0,0);
        
        $data['vista_enviada'] = 'contabilidad_basico/plan_de_cuentas_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
     function obtener_datos_cuenta($reg){
        $dc=$this->contabilidad_plan_cuenta_model->obtener_registro_cuenta($reg);
        $a=$dc->id_plan_cuenta."|".$dc->codigo."|".$dc->titulo."|".$dc->imputable."|".$dc->id_padre."|".$dc->comentario;
        echo $a;
    }
    //registro de cuentas
    function registro_asiento($padre){
        $data['titulo']='Registro de asientos contables';
        $data['datos_menu_superior']=  $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre']=$padre;
        $data['datos_menu_detallado']=  $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
               
        $data['datos_cuenta_select']=$this->contabilidad_plan_cuenta_model->datos_del_plan_de_cuentas_select(0,''); 

        $data['vista_enviada']='contabilidad_basico/registro_asiento_view';
        $this->load->view('Plantilla/Plantilla_vista',$data);
    }
    
    
    
    
    ///modificacion 20/11/15
    ////comenzando la parte de rendicion
     function registro_rendicion($padre){
        $data['titulo']='Registro de Rendicion';
        $data['datos_menu_superior']=  $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin'));
        $data['datos_item_padre']=$padre;
        $data['datos_menu_detallado']=  $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
               
        //$data['datos_cuenta_select']=$this->contabilidad_plan_cuenta_model->datos_del_plan_de_cuentas_select(0,''); 

        $data['vista_enviada']='contabilidad_basico/formu_rendicion_view';
        $this->load->view('Plantilla/Plantilla_vista',$data);
    }
    function nueva_rendicion($id_rendicion) {
    
        $this->load->model('proyecto_model');
        $data['selec_proyecto']= $this->proyecto_model->seleccionar_proyecto_nombre();  
        $data['selec_tecnico']= $this->contabilidad_plan_cuenta_model->seleccionar_nombre_tecnico();  
        $data['selec_tipo_gasto']= $this->contabilidad_plan_cuenta_model->seleccionar_tipo_gasto('tra');  
        //$data['selec_tipo_gasto_sg']= $this->contabilidad_plan_cuenta_model->seleccionar_tipo_gasto_sg();  
        $data['id_rend'] = $id_rendicion; //estoy cambiando id_ov_f
       
        
        if($id_rendicion!=0)
        {
            
            $data['datos_rendicion']= $this->contabilidad_plan_cuenta_model->obtener_datos_rendicion($id_rendicion);  
            $data['datos_rendicion_detalle']= $this->contabilidad_plan_cuenta_model->obtener_detalle_datos_rendicion($id_rendicion);  
        }
        $this->load->view('contabilidad_basico/nueva_rendicion_view', $data);
    }
    function guardar_nueva_rendicion() {
        //echo 'funciona2';
        $respuesta = $this->contabilidad_plan_cuenta_model->guardar_nueva_rendicion_for();

        echo $respuesta;
    }
    
    
    function buscar_tipo_gasto(){
         $tipo_gasto=$this->input->post("tipo_gasto") ;
         //echo $tipo_gasto;
         $id_campo=$this->input->post("id_campo") ;
         $seleccionado=$this->input->post("seleccionado") ;
         $tipo='sgr';
        
         if( $tipo_gasto==1)
               $tipo='tra';
         
         if($tipo_gasto==3)
               $tipo='tel';
           
            $selec_tipo_gasto= $this->contabilidad_plan_cuenta_model->seleccionar_tipo_gasto($tipo);
            echo "
                <div class='letraChica'>
                        Tipo de Gasto
                </div>
                <div class='esparriba5'> 
                            <select id='tipo_gasto'>"; 
                                //<?php
                                foreach($selec_tipo_gasto->result() as $dato2)
                                {
                                    if($dato2->idg_transporte == $seleccionado)
                                        echo "<option selected='selected' value='" . $dato2->idg_transporte . "'>" . $dato2->descripcion_tra . "</option>";
                                    else
                                        echo "<option value='" . $dato2->idg_transporte . "'>" . $dato2->descripcion_tra . "</option>";    
                                }


                               
                         echo   "</select> 
              </div>";


             
             
    }
    
    //// adiicionando nuevo busqueda 8/12/15
    function busqueda_de_rendiciones() {

        //echo "funciona1";

        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $rendicion = $this->contabilidad_plan_cuenta_model->listar_buscar_rendicion($b, $i, $c);
        $total_registros = $this->contabilidad_plan_cuenta_model->listar_buscar_rendicion_cantidad($b);
        $data['total_registros'] = $total_registros;
        $data['registros'] = $rendicion;
        $detalles_registros = array();
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
        $this->load->view('contabilidad_basico/list_find_rendicion_view', $data);
    }


 
    
}

?>
