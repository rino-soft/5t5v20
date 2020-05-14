<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asignacionrd_vehiculo_regional
 *
 * @author POMA RIVERO
 */
class asignacion_vehiculo_regional extends CI_Controller {
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('vehiculo_model');
        $this->load->model('proyecto_model');
        $this->load->model('asignacion_vehi_regional_model');
        $this->load->model('usuario_model');
        $this->load->model('menu_model');
             if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }
    function index_admi_regional($padre) {
        $data['titulo'] = 'Administracion Regional';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        $data['vista_enviada'] = 'asignacion_vehi_regional/vista_vehiculo_regional_view';//colocar la vista
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
    //view regional
    /*
      function  busqueda_lista_asig_regional(){
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;
        $ov_pfs = $this->asignacion_vehi_regional_model->listar_buscar_asig_regional($b, $i, $c);
        $total_registros = $this->asignacion_vehi_regional_model->listar_buscar_asig_regional_cantidad($b);
        $data['total_registros'] = $total_registros;
        $data['registros'] = $ov_pfs;
        //$detalles_registros = array();
        $data['mostrar_X'] = $c;
        $data['pagina_actual'] = $p;
        $data['busqueda'] = $b;
       
        $this->load->view('asignacion_vehi_regional/list_find_asig_regional_view', $data);
    }*/
    //new
    
    
        /*foreach ($asig->result() as $r)
        {
             $reg[$r->id_mov_alm]= $this->almacen_model->obtenen_almacen($r->id_almacen);
        }
        $data['data_almacen']=$reg;
        $resultado=$data['asignaciones'] ;
        $var = array();
        foreach ($resultado->result()as $reg)
        {
            $var[$reg->id_mov_alm]= $this->devolucion_material_model->obtener_solicitud_devolucion($reg->id_mov_alm);
        }
        $data['sol_dev']=$var;*/
    
     function guardar_vehiculo_taller_proyecto(){
        // $id_asig_resp;
         $respuesta=$this->vehiculo_model->guardar_vehiculo_asig_taller_proyecto();
        
        echo $respuesta;
    }
      function asignar_vehiculo_proy_ta($id_vehiculo,$id_asignacion_proy_ta){
         // echo 'mostrando id_vehi'.$id_vehiculo; 
        //  echo 'mostrand id_asig'.$id_asignacion_proy_ta;
       
        if($id_asignacion_proy_ta==0){
            $data['selec_proyecto']= $this->proyecto_model->seleccionar_proyecto_nombre();        //$data['unidad_medida'] = $this->producto_servicio_m_model->listar_unidad_medida();
            $data['per_a_asignar']=  $this->vehiculo_model->seleccionar_persona_asignar_vehiculo();
            $data['selec_ciudad']=  $this->vehiculo_model->seleccionar_ciudad_asignar();
            // echo 'id_ciud' .$data['selec_ciudad'];
            $data['estado_vehi']=  $this->vehiculo_model->ultimo_estado_vehiculo($id_vehiculo);
          // $data['buscar_sub']=  $this->vehiculo_model->buscar_subcentro();
            $data['id_send'] = $id_vehiculo; 
            $data['id_asignacion_dato']=$id_asignacion_proy_ta;
       }else{
        
            $data['selec_proyecto']= $this->proyecto_model->seleccionar_proyecto_nombre();        //$data['unidad_medida'] = $this->producto_servicio_m_model->listar_unidad_medida();
            $data['per_a_asignar']=  $this->vehiculo_model->seleccionar_persona_asignar_vehiculo();
            $data['selec_ciudad']=  $this->vehiculo_model->seleccionar_ciudad_asignar(); 
            //$data['buscar_sub']=  $this->vehiculo_model->buscar_subcentro();
            $data['datos_vehi_asig']=  $this->vehiculo_model->registro_vehiculo_asignado($id_asignacion_proy_ta);
            $data['estado_vehi']=   $this->vehiculo_model->nuevo_estado_de_vehiculo($data['datos_vehi_asig']->id_estado_asig);
            $data['id_send'] = $id_vehiculo; 
            $data['id_asignacion_dato']=$id_asignacion_proy_ta;
        }
         
        $this->load->view('asignacion_vehi_regional/asignar_vehiculo_proy_ta_view',$data);
    }
    function obtener_asignados_regional() {
        $b = $this->input->post("buscar");
        $p = $this->input->post("pagina");
        $c = $this->input->post("cant");
        $i = ($p * $c) - $c;  
        
        $se_dep=  $this->input->post("selec_depar");
        $proy=  $this->input->post("proyecto");
        //echo $se_dep;
        $data['asignaciones'] = $this->asignacion_vehi_regional_model->listar_buscar_vehiculo_regional($b, $i, $c); 
        $resultado=$data['asignaciones'];
       
        $estado_vehicular=array();
        $var=array();
        $datos_vehiculo=array();
        // for /estados
        $data['t_veh_bue']=0;
        $data['t_veh_reg']=0;
        $data['t_veh_pes']=0;
        
        foreach ($resultado->result()as $reg)
        {
          
            $var[$reg->id_vehiculo_resp]= $this->asignacion_vehi_regional_model->registro_proyecto_taller_proyecto($reg->id_vehiculo_resp);
            $estado_vehicular[$reg->id_vehiculo_resp]=  $this->vehiculo_model->buscar_estado_vehicular($reg->id_vehiculo_resp);
            $datos_vehiculo[$reg->id_vehiculo_resp]=  $this->asignacion_vehi_regional_model->obtener_datos($reg->id_vehiculo_resp);
            
            $est= $estado_vehicular[$reg->id_vehiculo_resp]=  $this->vehiculo_model->buscar_estado_vehicular($reg->id_vehiculo_resp);
            if($est[0]!='Sin estado')
                {
                 $promedio_est=  round(($est[0]+$est[1])/2);
                 if($promedio_est<4)
                   $data['t_veh_pes']++; 
                 if($promedio_est>=4 && $promedio_est<8)
                    $data['t_veh_reg']++;
                if($promedio_est>=8)
                    $data['t_veh_bue']++;
               
                 
                }
        }
     
        $data['t_vehi_asig']= $resultado->num_rows();
        $data['estado_vehi']=$estado_vehicular;
        $data['dato_asig_proy_ta']=$var;
        $data['datos_vehiculo']=$datos_vehiculo;
        $data['datos_usuario']= $this->usuario_model->obtener_user($this->session->userdata('id_admin'));
       // $data['total_registros'] = $total_registros;
        $data['busqueda'] = $b;
        //para el filtro
      //  $data['asig_departamento']=$departamento;
        $data['selec_ciudad']=  $this->vehiculo_model->seleccionar_ciudad_asignar();
        $data['selec_depar'] =  $se_dep;
        $data['selec_proyecto']= $this->proyecto_model->seleccionar_proyecto_nombre(); 
       $data['proyecto_selec'] =  $proy;
        
        $this->load->view('asignacion_vehi_regional/list_find_asig_regional_view', $data);
    }
    function edita_devolucion_asignado_vehiculo($id_vehiculo,$id_asignado){
        if($id_asignado!=0){
        $data['id_vehiculo']=$id_vehiculo;
        $data['id_asignado']=$id_asignado;
        $data['per_a_asignar']= $this->vehiculo_model->seleccionar_persona_asignar_vehiculo_edita($id_asignado);
        $data['selec_ciudad']=  $this->vehiculo_model->seleccionar_ciudad_asignar_edita($id_asignado);
        $data['dato_asignado']= $this->vehiculo_model->registro_vehiculo_asignado($id_asignado);
        $data['estado_vehi']=  $this->vehiculo_model->obtener_estado_asignado($id_asignado);
        $data['proyecto_seleccionado']=  $this->asignacion_vehi_regional_model->buscar_proyecto_seleccionado($id_asignado);
        $data['id_send'] = $id_vehiculo;
        $data['id_asignacion_dato']=$id_asignado;
        
        }

        $this->load->view('asignacion_vehi_regional/editar_devolucion_asig_vehiculo_view',$data);
    }
     function guardar_vehiculo_asignado_editando(){
         $respuesta=$this->vehiculo_model->guardar_vehiculo_asignado_editado();
         echo $respuesta;
    }
     function guardar_vehiculo_asignado_responsable_devolucion(){
         $respuesta_editar=$this->vehiculo_model->guardar_vehiculo_asignado_editado_prueb();
        //  echo 'entra_editado'.$respuesta_editar.'esta_aqui';
         
         $respuesta=$this->vehiculo_model-> guardar_vehiculo_asignado_prueb();
         echo $respuesta;
    }
     function respuesta_centro_por_ciudad()
    {
        // echo 'entra';
        // echo 'entraaa'.$this->input->post('id_ciudad');
         if($this->input->post('id_ciudad')!=-1){
        $option=$this->asignacion_vehi_regional_model->buscar_subcentro_por_ciudad($this->input->post('id_ciudad'));
        $nombre_camp=$this->input->post("id_campo") ;
        $s=$this->input->post('seleccionado');
        //echo "<br>".$s;
        if($option->num_rows()>0)
        {
          echo "<div class='grid_3 esparriba5'>
              <div class='grid_3'><select id='".$nombre_camp."' onchange='genera_otro(\"otro_tipo\"); '>"; 
                foreach ($option->result() as $reg) {
                if($s==$reg->subcentro)
                    echo "<option selected='selected' value='".$reg->subcentro."'>".$reg->subcentro."</option>";
                else
                    echo "<option value='".$reg->subcentro."'>".$reg->subcentro."</option>";      
                 } 
                echo "<option value='otro'>otro</option>
                 </select>
                 </div>
                 <div class='grid_3 f10 negrilla'>Subcentro:</div></div>";
            
            echo '<div class="grid_3 esparriba5"  id="otro_tipo"></div>';
           
        }
        else
        {
            echo "<div class='grid_3 esparriba5'>
              <div class='grid_3'><select id='".$nombre_camp."' onchange='genera_otro(\"otro_tipo\"); '>"; 
                               echo "<option value='otro'>otro</option>
                 </select>
                 </div>
                 <div class='grid_3 f10 negrilla'>Subcentro:</div></div>";
            
            echo '<div class="grid_3 esparriba5"  id="otro_tipo"><input class="input_redond_150 margin_cero" type="text" id="otro_tipo_subcentro" placeholder="Escriba Subcentro" value=""></div>
                    <div class="grid_3 f10 negrilla">Nuevo subcentro</div>';
         // echo ' <div class="grid_5" ><input class="input_redond_370" type="text" id="otro_tipo_subcentro" placeholder="Escriba Subcentro" value=""></div>';
        }
         }else
        echo '<div class="grid_5 esparriba5"  id="otro_tipo"></div>';
        
       
    }
    
}

?>
