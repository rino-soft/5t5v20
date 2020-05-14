<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Home extends CI_Controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		
		//comprobamos si el usuario está logueado
		if($this->auth->is_logged() == FALSE)
		{
			
			redirect(base_url('login'));
			
		}
		
	}
	
	public function index()
	{
		
		$data = array('titulo' => 'Has creado tu librería para loguear usuarios!');
		$this->load->view('home',$data);
		
	}
	
	//cerramos sesión llamando a la función logout
	//nuestra librería
	public function logout_user()
	{
		
		$this->auth->logout();

	}
	
}
/*
 * end controllers/home.php
 */