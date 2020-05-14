<?php

class menus extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('menus_model');
    }

    /* function menu_hijos(){
      $matriz = $this->basicauth->datosSession();
      $data["enlaces"] = $this->menus_model->obtenerMenuHijo($matriz['id'],$this->input->post('padre'));
      //$data["datos"] contendrá un array del tipo Array("0" => Array("value" => value1, "name" => name1), "1" => Array("value" => value2, "name" => name2)...)
      $this->load->view('menus/EnlacesHijos',$data);
      } */

    function index() {
        1;
    }

    function gestionar_menu() {
        $hijos_por_padre = array();
        $data['main_menu'] = 'menus/EnlacesHijos';
        $data['titulo'] = 'Gestion de menu SRRHH_v1.0';
        $matriz = $this->basicauth->datosSession();
        $data['user'] = $matriz['nombres'] . ' ' . $matriz['apellidos'];
        //$data['datos_menu'] = $this->menus_model->obtenerMenuPadre($matriz['id']);
        $data['menu_completo'] = $this->menus_model->obtenerMenuCompleto($matriz['id']);
        $data['menu_padres'] = $this->menus_model->lista_menus_padres();
        $padres = $data['menu_padres'];
        foreach ($padres as $p) {
            $hijos_por_padre[$p->id] = $this->menus_model->lista_menus_hijos($p->id);
        }
        $data['menu_hijos'] = $hijos_por_padre;

        $data['main_conten'] = "menus/gestion_menu_view";
        $this->load->view('includes/template', $data);
    }

    function formulario_adicion_edicion() {
        $adicion_edicion = $this->input->post('ind');
        $data['padreslista'] = $this->menus_model->lista_menus_padres();
        $data['ind'] = $adicion_edicion;
        if ($adicion_edicion != 0) {
            $data['menu_datos'] = $this->menus_model->obtener_datos_menu($adicion_edicion);
        }
        $this->load->view('menus/formularioNuevoMenu', $data);
    }

    function adicionar_editar_menus_item() {
        //tipo 0=nuevo  otro= edicion
        if ($this->input->post('tipo') == 0) {
            $resp = $this->menus_model->adicionar_nuevo_menu_item();
            if ($resp != 0) {
                $data['mensaje'] = "Se ha procedido a Adicionar un nuevo menu,  La pagina se actualizara en un instante";
                $data['respuesta'] = "OK";
            } else {
                $data['mensaje'] = "Se ha detectado un error , lo sentimos No se pudo registrar el menu";
                $data['respuesta'] = "NO";
            }
            $this->load->view('menus/mensajesFormulario', $data);
        } 
        else
        {
            $resp = $this->menus_model->editar_menu_item();
            if ($resp != 0) {
                $data['mensaje'] = "Se ha procedido a modificar el menu solicitado,La pagina se actualizara en un instante";
                $data['respuesta'] = "OK";
            } else {
                $data['mensaje'] = "Se ha detectado un error , lo sentimos No se pudo editar el menu solicitado";
                $data['respuesta'] = "NO";
            }
            $this->load->view('menus/mensajesFormulario', $data);
        }
    }

}

?>
