<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of experiencia_laboral
 *
 * @author POMA RIVERO
 */
class experiencia_laboral extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('experiencia_laboral_model');// controlador categoria
      
        if ($this->auth->is_logged() == FALSE) {
           
            redirect(base_url('login'));
        }
        
    }
   
   function index ($padre)
   {
       
       
       $data['titulo'] = 'Experiencia Laboral';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre); 
        $data['vista_enviada'] = 'personal_curriculum/experiencia_lab_principal_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
       
   }
   function adicionar_nueva_experiencia_laboral($id_experiencia)
   {
       $data['experiencia']=$this->experiencia_laboral_model->dato_experiencia_laboral($id_experiencia);
       $data['id_exp']=$id_experiencia;
     
       $this->load->view('personal_curriculum/nueva_experiencia_laboral_view',$data);
   }
    function guardar_experiencia_laboral_upload_file()
    {
        $id_nuevo=$this->experiencia_laboral_model->guardar_experiencia_nuevo();
        
       // echo $respuesta;
         $n_file=$this->session->userdata('id_admin')."_".$id_nuevo."_";
        //echo $n_file;
        $carpeta="respaldo_experiencia_laboral/";
        $config['upload_path'] = './uploads/'.$carpeta;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '5000';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';
        $config['file_name'] = $n_file;
         $this->load->library('upload', $config);
        $nocargo=1;
        if (!$this->upload->do_upload()) {
            $nocargo=0;
            $mensaje = $this->upload->display_errors();
            
        } else {
            $cargo=1;
            //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS 
            //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
            //echo "obtubo el archivo";
            $file_info = $this->upload->data();
            //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
            //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA
            $this->_create_thumbnail($file_info['file_name'],$carpeta);
            $imagen = $file_info['file_name'];
            
            $mensaje=$config['upload_path'].$imagen;
        }
        //echo $mensaje;
        $men_carga="El archivo no fue cargado, verifique si su archivo cumple lo indicado"; 
        $estilo="NO";
        if($nocargo==1)
        {   $men_carga="El archivo fue cargado exitosamente";      
            $res=$this->experiencia_laboral_model->asigna_respaldo_experiencia($id_nuevo,$mensaje);
            $estilo="OK";
        }
        $mensaje=$id_nuevo."|".$men_carga."|".$estilo;
        echo $mensaje;
        
        
    }
    function _create_thumbnail($filename,$carpeta){
        $config['image_library'] = 'gd2';
        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
        $config['source_image'] = 'uploads/'.$carpeta.'/'.$filename;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
        $config['new_image']='uploads/'.$carpeta.'/thumbs/';
        $config['width'] = 150;
        $config['height'] = 150;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }
    
    function lista_experiencia_laboral()
    {
        $data["informacion_reg"]=$this->experiencia_laboral_model->lista_experiencia($this->session->userdata('id_admin'));
    
        $this->load->view('personal_curriculum/list_experiencia_laboral_view',$data);
    }
     function del_reg($reg)
    {
        $this->experiencia_laboral_model->del_registro_experiencia($reg);
    }
}

?>
