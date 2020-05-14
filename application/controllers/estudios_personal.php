<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of estudios_personal
 *
 * @author RubenPayrumani
 */
class estudios_personal extends CI_Controller{
    //put your code here
    public function __construct() {
        
        parent::__construct();
         $this->load->model('menu_model');
         $this->load->model('estudio_personal_model');
        if ($this->auth->is_logged() == FALSE) {
            redirect(base_url('login'));
        }
    }
    function logros_academicos($padre,$hijo) {
        
        $data['titulo'] = 'Formación Académica';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        
        $data['vista_enviada'] = 'personal_curriculum/logros_academicos_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
     
        
    }
    function form_logro_acad($id_enviado)
    {
        $data['id_enviado']=$id_enviado;
        //echo "hasta aqui ok1";
        $data["informacion_reg"]=$this->estudio_personal_model->obtener_logro_academico($id_enviado);
      //  echo "hasta aqui 2";
            
        $this->load->view('personal_curriculum/form_logro_academico_view',$data);
    }
    
    
    function guardar_registro_upload_file() {
        
        $id_nuevo=$this->estudio_personal_model->registra_edita_datos_estudios_academicos();
        
        
        
        
        
        $n_file=$this->session->userdata('id_admin')."_".$id_nuevo."_";
        //echo $n_file;
        $carpeta="respaldo_academico_personal/";
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
            $res=$this->estudio_personal_model->asigna_respaldo_estudios($id_nuevo,$mensaje);
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
    
    function lista_logros_academicos()
    {
        $data["informacion_reg"]=$this->estudio_personal_model->lista_logro_academico($this->session->userdata('id_admin'));
    
        $this->load->view('personal_curriculum/list_logro_academico_view',$data);
    }
    function del_reg($reg)
    {
        $this->estudio_personal_model->del_registro_estudio($reg);
    }
}

?>
