<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Elaborado por Ruben Payrumani Ino, Proyecto SAV (Sistema de Administracion vehicular)
 * Libreria para Logeo
 */

class Basicauth {

    function __construct() {
        $this->CI = & get_instance();
    }

    function login($usuario, $password) {
        echo "<script>alert('ingresa a la funcion login');</script>";
        $data = array();
        //md5($password))
        //echo $usuario.",".$password;
        $query = $this->CI->db->get_where('usuarios', array('username' => $usuario, 'password' => $password));
        if($query->num_rows()>0)
            echo "<script>alert('". $query->row()->nombres." se ha encontrado exitosamente');</script>";
        
        if ($query->num_rows() > 0) {
            
            $this->CI->session->sess_destroy();
            //$this->CI->session->sess_created();
            // lista de datos que guardara la SESION***********************
            $datosSesion = array();
            $datosSesion['logged_in']=TRUE;
            $datosSesion['usuario']=$usuario;
            $datosSesion['id']=$query->row()->cod_user;
            $datosSesion['apellidos']=$query->row()->ap_paterno." ".$query->row()->ap_materno;
            $datosSesion['nombres']=$query->row()->nombre;
            $datosSesion['estado']=$query->row()->estado;
            //*************************************************************
            $this->CI->session->set_userdata($datosSesion);
            
        } else {
            echo "<script>alert('". $datosSesion['usuario']."No se ha encontrado');</script>";
            $data['error'] = 'Usuarios y contraseña Erradas';
        }
        return $data;
    }
    
    function datosSession()
    {
        return($this->CI->session->all_userdata());
    }

    function logout() {
        $this->CI->session->sess_destroy();
    }

}

?>
