<?php  

class generar_graficos extends CI_Controller {

	function __construct()
	{
		parent::__construct();  
             $this->load->model('menu_model');
           
             if ($this->auth->is_logged() == FALSE) {
                redirect(base_url('login'));
		
               
	}
	 $this->load->helper('url');
	 $data['home'] = strtolower(__CLASS__).'/';
	 $this->load->vars($data);
        }
	/**
	 * index function.
	 * Very basic example: juste draw some data
	 */
	
        function index($padre) {
        $data['titulo'] = '';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        $data['vista_enviada'] = 'bienvenida';
        $this->load->view('Plantilla/Plantilla_vista', $data);
    }
     function index1($padre) {
        $data['titulo'] = 'Genera';
        $data['datos_menu_superior'] = $this->menu_model->obtenerMenuPadre($this->session->userdata('id_admin')); //obtiene los menus asignados a 0 // en este caso no hay usuario
        $data['datos_item_padre'] = $padre;
        $data['datos_menu_detallado'] = $this->menu_model->obtereMenuDetallado($this->session->userdata('id_admin'),$padre);
        
        $this->load->library('highcharts');
        $serie['data']	= array(
			array('value one', 33), 
			array('value two', 33), 
			array('other value', 34)
		);
		$callback = "function() { return '<b>'+ this.point.name +'</b>: '+ this.y +' %'}";
		
		@$tool->formatter = $callback;
		@$plot->pie->dataLabels->formatter = $callback;
		
		$this->highcharts
			->set_type('pie')
			->set_serie($serie)
			->set_tooltip($tool)
			->set_plotOptions($plot);
		
        $data['charts'] = $this->highcharts->render();
        
        $data['vista_enviada'] = 'vehiculos/charts';//colocar la vista

        
        
        
        $this->load->view('Plantilla/Plantilla_vista', $data);
    
    }
    
	
	/**
	 * pie function.
	 * Draw a Pie, and run javascript callback functions
	 * 
	 * @access public
	 * @return void
	 */
	function pie()
	{
		$this->load->library('highcharts');
		$serie['data']	= array(
			array('value one', 33), 
			array('value two', 33), 
			array('other value', 34)
		);
		$callback = "function() { return '<b>'+ this.point.name +'</b>: '+ this.y +' %'}";
		
		@$tool->formatter = $callback;
		@$plot->pie->dataLabels->formatter = $callback;
		
		$this->highcharts
			->set_type('pie')
			->set_serie($serie)
			->set_tooltip($tool)
			->set_plotOptions($plot);
		
		$data['charts'] = $this->highcharts->render();
		$this->load->view('vehiculos/charts', $data);
	}
	
	
	

}