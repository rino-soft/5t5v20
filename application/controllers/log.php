<?php
class Log extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    function index()
    {
        $data['main_conten']='log'; 
        $data['titulo']='Autenticacion de Usuario';
        $this->load->view('includes/template',$data);
    }
    function login()
    {
        print_r($_POST);
        
    }
}

?>
