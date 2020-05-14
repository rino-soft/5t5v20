<?php

class menu_model extends CI_Model {

    function obtenerMenuPadre($id_user) {

        $sql = "SELECT  p.padre FROM menu_sistema p, key_user_menu kum
            WHERE  kum.id_user=$id_user
            and kum.id_menu=p.id
            and p.estado='Activo'
            and kum.estado='Activo'
            group by p.padre";
        $query = $this->db->query($sql);
        //echo "1er sql: ".$sql."<br>";
        $cad = "";
        $i = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $res) {
                if ($i >= 1)
                    $cad.= ' or p.id=' . $res->padre;
                else
                    $cad.= ' p.id=' . $res->padre;
                $i++;
            }
            $cad = 'and (' . $cad . ')';
        }
        if ($cad != "") {
            $sql = "SELECT * FROM menu_sistema p
         WHERE  p.padre='0' $cad";
        } else {
            $sql = "SELECT * FROM menu_sistema p
         WHERE  p.padre='-1'";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    function obtereMenuDetallado($id_user, $padre) {
        $padres = $this->obtenerMenuPadre($id_user);
        $cadena = "";
        foreach ($padres as $fila) {

          //  console_log("$padre");
           // echo $padre;
            $cadena.= "<li><a href=#>$fila->titulo</a>";
            $hijos = $this->obtenerMenuHijo2($id_user, $fila->id);
            $cant = count($hijos);
            if ($cant > 0) {
                $stilo = '';
                if ($fila->id == $padre)
                    $stilo = "display :block;";
                $cadena.= "<ul class='nav child_menu' $stilo >";
                for ($c = 0; $c < $cant; $c++) {
                    $reg = $hijos[$c];
                    $cadena.= "<li><a href='" . base_url() . $reg['controlador'] . "/" . $reg['metodo'] . "/" . $reg['padre'] ."' >" . $reg['titulo'] . "</a></li>";
                }
                $cadena.= "</ul>";
            }
        }
        $cadena.= "";
        // echo $cadena;
        return($cadena);
    }

    /* function obtereMenuDetallado($id_user, $padre) { ANTIGUOooo
      /* $sql ="SELECT * FROM permisos_sav p, permiso_usuario_sav pus
      WHERE pus.idusuario='$id_user'
      AND pus.idpermisoSAV = p.id
      AND p.padre='$padre'"; */
    /* $sql = "SELECT * FROM menu_sistema p, key_user_menu kum 
      WHERE  p.padre=$padre
      and kum.id_user=$id_user
      and kum.id_menu=p.id"; */

    /* $sql = "SELECT * FROM menu_sistema p 
      WHERE p.padre='$padre'"; *
      $sql="SELECT p.id, p.titulo, p.descripcion, p.controlador, p.metodo, p.se_muestra, p.padre, p.estado FROM menu_sistema p, key_user_menu kum
      WHERE  p.id=kum.id_menu
      and p.estado='Activo'
      and kum.estado='Activo'
      and kum.id_user=$id_user
      and p.padre=$padre
      group by p.id ";
      // echo $sql;
      $query = $this->db->query($sql);
      return $query->result();
      } */

    function obtereMenuDetallado_todo($id_user, $padre) {
        /* $sql ="SELECT * FROM permisos_sav p, permiso_usuario_sav pus 
          WHERE pus.idusuario='$id_user'
          AND pus.idpermisoSAV = p.id
          AND p.padre='$padre'"; */
        /* $sql = "SELECT * FROM menu_sistema p, key_user_menu kum 
          WHERE  p.padre=$padre
          and kum.id_user=$id_user
          and kum.id_menu=p.id"; */

        $sql = "SELECT * FROM menu_sistema p 
          WHERE p.padre='$padre'";

        $query = $this->db->query($sql);
        return $query->result();
    }

    Function lista_menus_hijos($padre) {
        $vectorInformacion = array();
        $sql = "SELECT * FROM menu_sistema p
            WHERE p.padre='$padre'";
        $query = $this->db->query($sql);
        $i = 0;
        foreach ($query->result() as $registro) {
            $vectorInformacion[$i] = Array('id' => $registro->id,
                'titulo' => $registro->titulo,
                'controlador' => $registro->controlador,
                'metodo' => $registro->metodo,
                'estado' => $registro->estado);
            $i++;
        }
        return($vectorInformacion);
    }

    Function obtenerMenuHijo2($id_user, $padre) {
        $vectorInformacion = array();

        $sql = "SELECT * FROM menu_sistema ms, key_user_menu kum
                WHERE kum.id_user=$id_user
                AND kum.id_menu= ms.id
                AND ms.padre=$padre";

        $query = $this->db->query($sql);
        $i = 0;
        foreach ($query->result() as $registro) {
            $vectorInformacion[$i] = Array(
                'id' => $registro->id,
                'titulo' => $registro->titulo,
                'controlador' => $registro->controlador,
                'metodo' => $registro->metodo,
                'estado' => $registro->estado,
                'padre' => $registro->padre);
            $i++;
        }
        return($vectorInformacion);
    }

    function obtenerMenuCompleto($id_user) {
        $padres = $this->obtenerMenuPadre($id_user);
        $cadena = "<ul>";
        foreach ($padres as $fila) {
            $cadena.= "<li class='active'><a href=#>$fila->titulo</a>";
            $hijos = $this->obtenerMenuHijo2($id_user, $fila->id);
            $cant = count($hijos);
            if ($cant > 0) {
                $cadena.= "<ul>";
                for ($c = 0; $c < $cant; $c++) {
                    $reg = $hijos[$c];
                    $cadena.= "<li><a href='" . base_url() . $reg['controlador'] . "/" . $reg['metodo'] . "'>" . $reg['titulo'] . "</a></li>";
                }
                $cadena.= "</ul>";
            }
        }
        $cadena.= "</ul>";
        // echo $cadena;
        return($cadena);
    }

    function obtener_datos_menu($menu) {
        $sql = "select * from permisos_sav p WHERE p.id='$menu' ";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row;
    }

    function adicionar_nuevo_menu_item() {
        $datos = array(
            'titulo' => $this->input->post('titulo'),
            'controlador' => $this->input->post('controlador'),
            'metodo' => $this->input->post('metodo'),
            'padre' => $this->input->post('padre'),
            'estado' => $this->input->post('estado'),
            'tipo' => 1
        );
        $this->db->insert('permisos_sav', $datos);
        return ($this->db->insert_id());
        //$this->db->update('mytable', $data, "id = 4");
    }

    function editar_menu_item() {
        $id = $this->input->post('tipo');
        $datos = array(
            'titulo' => $this->input->post('titulo'),
            'controlador' => $this->input->post('controlador'),
            'metodo' => $this->input->post('metodo'),
            'padre' => $this->input->post('padre'),
            'estado' => $this->input->post('estado')
        );
        $this->db->where('id', $id);
        $this->db->update('permisos_sav', $datos);
        $query = $this->db->get_where('permisos_menu_rrhh', $datos);
        if ($query->num_rows() > 0)
            return (1);
        else
            return(0);
    }

    function lista_menus_padres() {
        $sql = "SELECT * FROM permisos_menu_rrhh p
            WHERE p.padre='0'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function obtenerMenuPadre_todo($id_user) {

        $sql = "SELECT * FROM menu_sistema p
          WHERE  p.padre='0'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function listar_controles_menu($id_menu) {
        $sql = "select * from controles_menu WHERE id_menu=" . $id_menu;
        $query = $this->db->query($sql);
        return $query->result();
    }

}
