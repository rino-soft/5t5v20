<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth {

    protected $ci;

    //titulmos una instancia del super objeto de codeigniter
    //en el constructor para poder tenerlo disponible las veces
    //que necesitemos sin repetir la misma línea
    public function __construct() {

        $this->ci = & get_instance();
    }

    //creamos una token para nuestros formularios
    public function token() {

        $token = md5(uniqid(rand(), true));
        $this->ci->session->set_userdata('token', $token);
        return $token;
    }

    //función para comprobar si el usuario está logueado
    public function is_logged() {

        return $this->ci->session->userdata('username') !== FALSE ? TRUE : FALSE;
    }

    //creamos un array con los campos del formulario
    public function campos_formulario() {

        $campos = array('username' =>
            array('name' => 'username',
                'id' => 'username',
                'type' => 'text',
                'class' => 'username',
                'placeholder' => 'Introduce nombre de usuario',
                'maxlength' => '100'),
            'input_password' =>
            array('name' => 'password',
                'id' => 'password',
                'class' => 'password',
                'placeholder' => 'Introduce un password',
                'maxlength' => '100',
                'value' => set_value('password')
            )
        );

        return $campos;
    }

    //función para validar los formularios
    public function validate() {

        //si es el formulario de registro validamos el captcha
        /* 	if($this->ci->input->post('recaptcha_challenge_field'))
          {

          $this->ci->form_validation->set_rules('recaptcha_response_field', 'codigo captcha','callback_verifica_captcha|xss_clean');

          }
         */
        $this->ci->form_validation->set_rules('username', 'username', 'required|trim|min_length[2]|max_length[100]|xss_clean');
        $this->ci->form_validation->set_rules('password', 'password', 'required|trim|min_length[2]|max_length[100]|xss_clean');

        $this->ci->form_validation->set_message('required', 'El %s es requerido');
        //$this->ci->form_validation->set_message('valid_email', 'El %s no es correcto');
        $this->ci->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
        $this->ci->form_validation->set_message('max_length', 'El %s debe tener al menos %s carácteres');

        if ($this->ci->form_validation->run() == FALSE) {

            return FALSE;
        }

        return TRUE;
    }

    //función para registrar a los usuarios encriptando
    //los passwords con bcrypt
    public function register($email, $password) {

        $query = $this->ci->db->get_where('users', array('email' => $email));

        if ($query->num_rows() == 1) {

            return TRUE;
        } else {

            $hash = $this->ci->bcrypt->hash_password($password);

            //comprobamos si el password se ha encriptado
            if ($this->ci->bcrypt->check_password($password, $hash)) {

                $data = array('email' => $email, 'password' => $hash);
                $this->ci->db->insert('users', $data);
            }
        }
    }

    //función para loguear a los usuarios
    public function login_user($username, $password) {

        //$this->ci->db->where('username',$username);
        //$query = $this->ci->db->get('usuarios');
         echo "<script>alert('entro a la funcion de autenticacion');</script>";
        $query = $this->ci->db->get_where('usuarios', array('username' => $username, 'password' => md5($password))); //RUBEN
        
        echo "<script>alert('numrows '".$query->num_rows().");</script>";
        if ($query->num_rows() == 0) {
              echo "<script>alert('no encontrado');</script>";

            return FALSE;
        } else {
             echo "<script>alert('SI encontrado');</script>";

            return TRUE;
        }



        //si el nombre de usuario coincide y sólo existe uno procedemos
        /*       if($query->num_rows() == 1)
          {
          $user = $query->row();
          //en pass guardamos el hash del usuario que tenemos en la base
          //de datos para comprobarlo con el método check_password de Bcrypt
          $pass = $user->password;

          //esta es la forma de comprobar si el password del
          //formulario coincide con el codificado de la base de datos
          if($this->ci->bcrypt->check_password($password, $pass))
          {
          $query = $this->ci->db->get_where('users', array('email' => $email,'password' => $pass));

          if($query->num_rows() == 0)
          {

          return FALSE;

          }else{

          return TRUE;

          }
          }

          }
         */
    }

    //función para crear sesiones
    public function crear_sesiones($username, $password) {

        $query = $this->ci->db->get_where('usuarios', array('username' => $username, 'password' => $password)); //RUBEN
        $datos = $query->row();
        $apellido=$datos->ap_paterno . " " . $datos->ap_materno;
        $data = array('username' => $username,
            'password' => $password,
            'id_admin' =>$datos->cod_user,
            'nombres' => $datos->nombre,
            'apellidos' => $apellido,
            'imagen' => $datos->fotografia_actual,
            'email' => $datos->correo_corp,
            'estado' => $datos->estado); //$this->ci->bcrypt->hash_password($password)

        $this->ci->session->set_userdata($data);
    }

    //función para enviar emails al registrarse
    public function send_mail($email, $password) {

        $config['useragent'] = "CodeIgniter";
        $config['mailpath'] = "/usr/sbin/sendmail"; // Sendmail path
        $config['protocol'] = "smtp"; // mail/sendmail/smtp
        $config['smtp_host'] = "ssl://smtp.gmail.com";  // SMTP Server.  Example: mail.earthlink.net
        $config['smtp_user'] = "israelparraconejero1981@gmail.com";  // SMTP Username
        $config['smtp_pass'] = "carlamelissa12";  // SMTP Password
        $config['smtp_port'] = "465";  // SMTP Port
        $config['mailtype'] = "html"; // text/html  Defines email formatting
        $config['charset'] = "utf-8"; // Default char set: iso-8859-1 or us-ascii			

        $this->ci->load->library('email', $config);
        $this->ci->email->set_newline("\r\n");
        $this->ci->email->from('Codeigniter', 'Librería de login');
        $this->ci->email->to($email);
        $this->ci->email->subject('Se ha registrado correctamente.');
        $this->ci->email->message('Sus datos de acceso:<br /><br />Email: ' . $email . '<br />Password: ' . $password);
        $this->ci->email->send();
    }

    //función para cerrar sesión
    public function logout() {

        echo "<script>alert('ingresa a la funcion para cerrar la sesion')</script>";
        $this->ci->session->unset_userdata(array('username', 'password'));
        $this->ci->session->sess_destroy();
        $this->ci->session->sess_create();
        $this->ci->session->set_flashdata('cerrada', 'La sessión se ha cerrado correctamente.');
        echo "<script>alert('se esta cerrando la sesion se esta enviando a LOGIN')</script>";

        redirect(base_url('login/user_login', 'refresh'));
    }

}

/*
 * end libraries/auth.php
 */
