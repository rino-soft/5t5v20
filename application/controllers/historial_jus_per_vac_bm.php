<?php
class historial_jus_per_vac_bm extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('historial_jus_per_vac_bm_model');
        
    }
    function evento_nuevo()
    {
       $evento=  $this->input->post('evento');
       $inf= $this->historial_jus_per_vac_bm_model->adicionar_nuevo_evento();
    }
    
}
?>
           

