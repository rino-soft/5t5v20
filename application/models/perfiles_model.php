<?php

class perfiles_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function listar_p() {

        $sql = "select * from perfil p 
            where 1  order by p.id_perfil ASC";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_p_cantidad() {

        $sql = "select * from perfil p 
            where 1  order by p.id_perfil ASC";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function obtener_detalle_perf($id_p) {
        $sql = "select * from menu_perfil mp,  menu_sistema ms
                where mp.id_menu=ms.id 
                and mp.id_perfil=$id_p";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_menu_perfil_detalles() {

        $sql = "SELECT * FROM menu_sistema ms
            WHERE ms.padre='0' order by ms.id ASC";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_menu_perfil_detalles_cantidad() {

        $sql = "SELECT * FROM menu_sistema ms
            WHERE ms.padre='0' order by ms.id ASC";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function listar_usuario_perfiles($id_u, $padre) {
        $sql = "SELECT kym.id_user, u.cod_user, ms.id, ms.titulo, ms.descripcion, ms.controlador, ms.metodo, ms.se_muestra, ms.padre
                FROM menu_sistema ms, key_user_menu kym , usuarios u
                WHERE ms.padre=$padre
                and kym.id_user=u.cod_user 
                and u.cod_user=$id_u
                order by ms.id ASC";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function obt_perfiles() {

        $sql = "select * from perfil p , menu_sistema ms, menu_perfil mp
            where p.id_perfil=mp.id_perfil
            and ms.id=mp.id_menu";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obt_perfil() {

        $sql = "select * from perfil p";
        $consulta = $this->db->query($sql);
        return($consulta);
    }
    function obtener_perfil_id($id) {

        $sql = "select * from perfil p where id_perfil=".$id;
        $consulta = $this->db->query($sql);
        return($consulta->row());
    }

    function obt_usuarios_permisos() {
        $sql = "select * from usuarios u, key_user_menu kum, menu_sistema ms
                where u.cod_user=kum.id_user
                and kum.id_menu=ms.id";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function save_perfiles() {

        $respuesta = "";
        $datos = array(
            'nombre' => $this->input->post('nombre_perfil'),
            'menus' => $this->input->post('menus_selec'),
            'controles' => $this->input->post('control_selec')
        );
        $this->db->insert('perfil', $datos);
    }

    function obtereMenuDetallado_perfil($id_user, $padre) {
        $sql = "SELECT * FROM menu_sistema p, menu_perfil mp 
            WHERE 
            p.padre='$padre' 
            and mp.id_perfil='$id_user' 
            and mp.id_menu=p.id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function listar_buscar_u($busqueda, $ini, $cant) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select * from usuarios U
            where concat( U.nombre, U.ap_paterno) LIKE '%$busqueda%'
         order by U.ap_paterno ASC";

        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_buscar_u_cantidad($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select * from usuarios U, key_user_menu kum
            where u.cod_user=kum.id_user and concat(U.cod_user, U.nombre, U.ap_paterno, U.ap_materno) LIKE '%$busqueda%'
         order by U.cod_user ASC";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function save_asignar_perfiles() {

        $respuesta = "";
        $idsp = explode("|", $this->input->post("idsp"));
        $idsu = explode("|", $this->input->post("idsu"));
        $idsm = explode("|", $this->input->post("idsm"));
        echo 'idsp:' . $this->input->post("idsp") . "<br>";

        if ($this->input->post('lista_perfiles') == 0) {
            $id_insert = ($this->db->insert_id());
            //proceso para dal alta de detalle
            for ($i = 1; $i < count($idsp); $i++) {
                for ($f = 1; $f < count($idsu); $f++) {
                    for ($k = 1; $k < count($idsm); $k++) {
                        date_default_timezone_set("Etc/GMT+4");
                        $datos = array(
                            // 'id_perfil' => $id_insert,
                            'id_user' => $idsu[$f],
                            'id_perfil' => $idsp[$i],
                            'id_menu' => $idsm[$k],
                            'fh_registro' => date("Y-m-d H:i:s"),
                            'estado' => "Activo"
                        );
                        $this->db->insert('key_user_menu', $datos);
                    }
                }
            }
        }
        return($respuesta);
    }

    function listar_asignacion_usuario() {
        $sql = "select kum.id_user from key_user_menu kum, usuarios u
            where kum.id_user=u.cod_user   
            group by id_user";

        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function save_menus_control_user() {
        $id_user = $this->input->post('id_user');
        $sql="delete from key_user_menu WHERE id_user=".$id_user;
        $consulta = $this->db->query($sql);
        $sql="delete from key_user_control WHERE id_usuario=".$id_user;
        $consulta = $this->db->query($sql);
        
        $menus = explode(",", $this->input->post('menus_selec'));
        $control = explode(",", $this->input->post('control_selec'));

        for ($k = 1; $k < count($menus); $k++) {
            date_default_timezone_set("Etc/GMT+4");
            $datos = array(
                // 'id_perfil' => $id_insert,
                'id_user' => $id_user,
                'id_perfil' => 0,
                'id_menu' => $menus[$k],
                'fh_registro' => date("Y-m-d H:i:s"),
                'estado' => "Activo"
            );
            $this->db->insert('key_user_menu', $datos);
        }
        
        for ($k = 1; $k < count($control); $k++) {
            date_default_timezone_set("Etc/GMT+4");
            $datos = array(
                // 'id_perfil' => $id_insert,
                'id_usuario' => $id_user,
                'id_control' => $control[$k],
                'id_user_asig' => $this->session->userdata('id_admin'),
                'estado' => "Activo"
            );
            $this->db->insert('key_user_control', $datos);
        }
        
    }
    function obtener_permisos($id_user)
    {
        $sql="select * from key_user_menu where id_user=".$id_user;
        $consulta = $this->db->query($sql);
        $sql2="select * from key_user_control where id_usuario=".$id_user;
        $consulta2 = $this->db->query($sql2);
        $menus="";
        $control="";
        foreach ($consulta->result() as $men)
        {
            $menus.=",".$men->id_menu;
        }
        
        foreach ($consulta2->result() as $con)
        {
            $control.=",".$con->id_control;
        }
        return (array($menus,$control));
    }
    function obtener_permisos_especifico($id_user,$control)
    {
        $sql2="select * from key_user_control k, controles_menu c where k.id_usuario=".$id_user." and k.id_control=c.id_control and nombre_control='$control'";
        $consulta2 = $this->db->query($sql2);
        if($consulta2->num_rows()>0)
            return(true);
        else 
            return(false);
       
    }
    

}

?>