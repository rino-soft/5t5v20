<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class notificaciones_libres extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model("notificacion_email_model");
    }

    function notificacion_correo_cheques() {
       $this->notificacion_email_model->enviar_notificacion_cheques_proveedores();
    }
    

}
