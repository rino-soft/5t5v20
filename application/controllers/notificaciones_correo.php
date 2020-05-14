<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class notificaciones_correo extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model("notificacion_email_model");
           if ($this->auth->is_logged() == FALSE) {

            redirect(base_url('login'));
        }
    }
    

    function notificacion_solFR() {
       $this->notificacion_email_model->enviar_not_sol_fr();
    }
    

}
