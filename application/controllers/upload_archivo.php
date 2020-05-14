<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upload_archivo
 *
 * @author RubenPayrumani
 */
class upload_archivo extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function subir_archivo() {
        $carpeta=$this->input->post("destino");
        $n_file=$this->input->post("file_name");
        //$carpeta="fotouser/";
        $config['upload_path'] = './uploads/'.$carpeta.'/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '5000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
               
        $config['file_name'] =$n_file;
        
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $mensaje = $this->upload->display_errors();
        } else {
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
        echo $mensaje;
    }
    function subir_archivo_rendicion() {
        $carpeta="doc_rendicion";
         $ahora = date("Ymd_Hi")."_";
        $n_file=$this->input->post("file_name");
        //$carpeta="fotouser/";
        $config['upload_path'] = './uploads/'.$carpeta.'/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '5000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        
        $config['file_name'] =  $ahora.$n_file;
        
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $mensaje = "Error|".$this->upload->display_errors();
        } else {
            //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS 
            //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
            //echo "obtubo el archivo";
            $file_info = $this->upload->data();
            //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
            //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA
            $this->_create_thumbnail($file_info['file_name'],$carpeta);
            $imagen = $file_info['file_name'];
            
            $mensaje="OK|".$imagen;
        }
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

   function subir_archivo_vehiculo() 
    {
        $this->load->model('vehiculo_model');
        $carpeta=$this->input->post("destino");
        $n_file=$this->input->post("file_name");
        $titulo=$this->input->post("titulo");
        $id_vehiculo=$this->input->post("id_vehiculo");
        //$carpeta="fotouser/";
        $config['upload_path'] = './uploads/'.$carpeta.'/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '20000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
      //  $config['mimes'] = array('pdf');
       // $config['file_name'] = $n_file;
        $this->load->library('upload', $config);
        
        
        $res=0;
         if (!$this->upload->do_upload()) {
            $mensaje = $this->upload->display_errors();
            echo "se encopntraron errores".$mensaje;
        }
            
            else {
            //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS 
            //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
            //echo "obtubo el archivo";
            $file_info = $this->upload->data();
            
            $tipo=$file_info["file_type"];
            $tipo1=$file_info["file_ext"];
            $tipo2=$file_info["image_type"];
            echo '----------------------------------------';
            echo 'file type'.$tipo;
            echo 'file ext'.$tipo1;
            echo 'image type'.$tipo2;
           // if($tipo==)
            //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
            //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA
        
            $this->_create_thumbnail($file_info['file_name'],$carpeta);
            $imagen = $file_info['file_name'];
            $mensaje=$config['upload_path'].$imagen;
            echo $mensaje;
           
            $res=$this->vehiculo_model->guardar_datos_imagen_parametro($id_vehiculo,$imagen,$config['upload_path'].$imagen,$tipo1);
        }
        //para guardar los datos de vehiculo
        
       if($res==0){
           echo 'No insertado';
       } else{
           echo 'Insertado';
       }
       // echo $mensaje;
    }
    
    function subir_archivo_contrato_alquiler() 
    {
        $this->load->model('linea_servicio_model');
        $carpeta=$this->input->post("destino");
        $n_file=$this->input->post("file_name");
        $titulo=$this->input->post("titulo");
        $id_contrato=$this->input->post("id_contrato");
        

        //$carpeta="fotouser/";
       
        $config['upload_path'] = './uploads/'.$carpeta.'/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '20000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
      //  $config['mimes'] = array('pdf');
       // $config['file_name'] = $n_file;
        $this->load->library('upload', $config);
        
        
        $res=0;
         if (!$this->upload->do_upload()) {
            $mensaje = $this->upload->display_errors();
            echo "se encopntraron errores".$mensaje;
        }
            
            else {
            //EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS 
            //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
            //echo "obtubo el archivo";
            $file_info = $this->upload->data();
            
            $tipo=$file_info["file_type"];
            $tipo1=$file_info["file_ext"];
            $tipo2=$file_info["image_type"];
            echo '----------------------------------------';
            echo 'file type'.$tipo;
            echo 'file ext'.$tipo1;
            echo 'image type'.$tipo2;
           // if($tipo==)
            //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
            //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA
        
            $this->_create_thumbnail($file_info['file_name'],$carpeta);
            $imagen = $file_info['file_name'];
            $mensaje=$config['upload_path'].$imagen;
            echo $mensaje;
           
            $res=$this->linea_servicio_model->guardar_datos_archivo($id_contrato,$imagen,$config['upload_path'].$imagen,$tipo1);
        }
        //para guardar los datos de vehiculo
        
       if($res==0){
           echo 'No insertado';
       } else{
           echo 'Insertado';
       }
       // echo $mensaje;
    }
    
    
}


?>
