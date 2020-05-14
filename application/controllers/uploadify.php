<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Uploadify extends CI_Controller {
 
    public function __construct() {
        parent::__construct();
        $this->load->model('uploadify_model');
        $this->load->model('menu_model');
        $this->load->model('almacen_model');
        
    }
 
// End Construct
 
    public function index($padre) {
        $data['titulo'] = 'uploadify';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);



      
        $data['vista_enviada'] = 'almacen/uploadify_view';
        $this->load->view('Plantilla/Plantilla_vista', $data);
        
    }
 
    function subir_fotos() {
    //aquí se deben realizar las validaciones de la cantidad de imagenes que queremos
    //permitir que se puedan subir por cada post, entrada o lo que sea.
        if (!empty($_FILES)) {
                $tempFile = $_FILES['Filedata']['tmp_name'];
                $carpeta = './uploads/';
                $targetFile = str_replace('//', '/', $carpeta) . strtolower(str_replace(" ", "", $_FILES['Filedata']['name']));
 
                if (!@copy($tempFile, $targetFile)) {
                    if (!@move_uploaded_file($tempFile, $targetFile)) {
                        echo "error";
                    }
                    else
                        echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $targetFile);
                }
                else
                    echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $targetFile);
                $file_name = strtolower(str_replace(" ", "", $_FILES['Filedata']['name']));
                date_default_timezone_set("Europe/Madrid");
                $fecha = date('Y-m-d');
                $imagenes = $this->uploadify_model->insert_imagenes($file_name, $fecha);  
        }
    }
 
    function filemanipulation($extension, $filename) {
        if ($this->is_image($extension)) {
            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/' . $filename;
            $config['new_image'] = './uploads/miniaturas/';
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['thumb_marker'] = '';
            $config['width'] = 200;
            $config['height'] = 200;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            echo 'image';
        }
        else
            echo 'file';
    }
 
    private function is_image($imagetype) {
        $ext = array(
            '.jpg',
            '.gif',
            '.png',
            '.bmp',
            '.jpeg',
            '.JPG',
            '.JEPG',
            '.JPEG'
        );
        if (in_array($imagetype, $ext))
            return true;
        else
            return false;
    }
    function arch_ingreso()
    {
        $data['d_i']=$this->Uploadify_model->insert_imagenes();
        //$data['id_send']=$file_name;
        //$data['id_send']=$fecha;
        $this->load->view('almacen/uploadify_view',$data);//aun no 
        
    }
}
/*application/controllers/uploadify.php
* el controlador
*/