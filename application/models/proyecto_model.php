<?php

class Proyecto_model extends CI_Model {

    function obtProyectos() {
        $sql = "SELECT D.id_proy,D.nombre FROM proyecto D order by nombre";
        $consulta = $this->db->query($sql);
        $data[0] = 'Seleccione un proyecto';
        foreach ($consulta->result() as $reg) {
            $data[$reg->id_proy] = $reg->nombre;
        }
        return $data;
    }

    function obtener_datos_proyecto($id) {
       // echo 'esto es el ID'.$id;
        $sql = "select * from proyecto d where d.id_proy = $id ";
        $consulta = $this->db->query($sql);
        return $consulta;
    }
     function obtener_datos_proyecto_2($id) {
        $sql = "select * from proyecto d where d.id_proy =$id";
        
        //echo 'consulta'.$sql;
        $consulta = $this->db->query($sql);
        $row = 0;
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row;
    }

    function obtener_datos_contrato($id) {
        $sql = "select * from registro_contrato_proyecto rcp where rcp.id_contrato = $id ";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function seleccionar_proyecto_nombre() {
        $sql = "select DISTINCT(nombre),id_proy from proyecto where 1 ";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    // adicionando 4/1/16
    function obtener_inf_proyecto($id_proy) {
        $sql = "select *
                from proyecto proy
                where proy.id_proy=$id_proy";

        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function obtener_detalle_datos_contrato($id_proy) {
        $sql = "select *
                    from proyecto p, registro_contrato_proyecto reg
                    where p.id_proy=reg.id_proyecto
                    and p.id_proy=$id_proy";

        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function listar_proyectos_all() {
        $sql = "select * 
                from proyecto p 
                where p.estado='Activo'
                order by p.nombre asc";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_proyecto_buscar_cantidad($busqueda) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select * 
                from proyecto p 
                WHERE concat(p.id_proy,p.nombre,p.descripcion) LIKE '%$busqueda%'
                order by p.id_proy desc";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function listar_proyecto_buscar($busqueda, $can, $ini) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select * 
                from proyecto p 
                WHERE concat(p.id_proy,p.nombre,p.descripcion) LIKE '%$busqueda%' 
                order by p.id_proy desc limit $can,$ini";

        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function guardar_datos_proyecto() {
        $respuesta = "";

        $ids_contrato = explode(";", $this->input->post("ids_contrato"));
        $nro_contrato = explode(";", $this->input->post("nro_contrato"));
        $gestion = explode(";", $this->input->post("gestion"));
        $provision = explode(";", $this->input->post("provision"));
        $moneda_pro = explode(";", $this->input->post("moneda_pro"));
        $importe = explode(";", $this->input->post("importe"));
        $moneda_imp = explode(";", $this->input->post("moneda_imp"));
        $vigencia = explode(";", $this->input->post("vigencia")); //quitar dato
        $etapa = explode(";", $this->input->post("etapa"));
        $objeto = explode(";", $this->input->post("objeto"));
        $nro_licitacion = explode(";", $this->input->post("nro_licitacion"));
        $estado_contrato = explode(";", $this->input->post("estado_contrato"));
        $t_contrato = explode(";", $this->input->post("t_contrato"));
        $observacion_contrato = explode(";", $this->input->post("observacion_contrato"));
        $id_encargado = explode(";", $this->input->post("id_encargado"));
        // $id_cliente_contrato = explode(";",  $this->input->post("id_cliente_contrato"));


        $datos = array(
            'fh_reg_proy' => date("Y-m-d H:i:s"),
            'id_user_registred' => $this->session->userdata('id_admin'),
            'id_cliente' => $this->input->post('id_cliente'),
            'nombre' => $this->input->post('nombre'),
            'descripcion' => $this->input->post('descripcion'),
            'estado' => $this->input->post('estado'),
            'fh_activo' => $this->input->post('fh_activo'),
        );

        if ($this->input->post('id_proy') == 0) {
            $this->db->insert('proyecto', $datos);
            $id_proyecto = ($this->db->insert_id());
            $respuesta = "<input type='text' id='ayudata' value='$id_proyecto'><input type='text' id='proceso' value='INSERT'><div class='OK'>Se ha guardado correctamente!!!...</div>";

            for ($i = 0; $i < count($etapa) - 1; $i++) {
                echo $moneda_imp[$i];
                echo $moneda_pro[$i];
                $datos = array(
                    'id_cliente' => $this->input->post('id_cliente'),
                    'nro_contrato' => $nro_contrato[$i],
                    'gestion_contrato' => $gestion[$i],
                    'provision' => $provision[$i],
                    'tmoneda_pro' => $moneda_pro[$i],
                    'importe' => $importe[$i],
                    'tmoneda_imp' => $moneda_imp[$i],
                    'vigencia' => $vigencia[$i],
                    'etapa_proyecto' => $etapa[$i],
                    'objeto' => $objeto[$i],
                    'nro_licitacion' => $nro_licitacion[$i],
                    'estado' => $estado_contrato[$i],
                    'tipo_contrato' => $t_contrato[$i],
                    'observacion_contrato' => $observacion_contrato[$i],
                    'encargado_proy' => $id_encargado[$i],
                    'id_proyecto' => $id_proyecto,
                    'fh_reg_contrato' => date("Y-m-d H:i:s"),
                );

                $this->db->insert('registro_contrato_proyecto', $datos);
                $id_insert_det = ($this->db->insert_id());
            }
        } else {
            //echo 'actuaizandooooooooooooo';
            $this->db->where('id_proy', $this->input->post('id_proy'));
            $upd = $this->db->update('proyecto', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_proy') . "'><input type='hidden' id='proceso' value='UPDATE'><div class='NO'>Se ha editado correctamente!!!...</div>";

            /* $sql="DELETE from registro_contrato_proyecto where id_proyecto=".$this->input->post('id_proy');
              $consulta=  $this->db->query($sql); */

            for ($i = 0; $i < count($etapa) - 1; $i++) {
                $datos = array(
                    'id_cliente' => $this->input->post('id_cliente'),
                    'nro_contrato' => $nro_contrato[$i],
                    'gestion_contrato' => $gestion[$i],
                    'provision' => $provision[$i],
                    'tmoneda_pro' => $moneda_pro[$i],
                    'importe' => $importe[$i],
                    'tmoneda_imp' => $moneda_imp[$i],
                    'vigencia' => $vigencia[$i],
                    'etapa_proyecto' => $etapa[$i],
                    'objeto' => $objeto[$i],
                    'nro_licitacion' => $nro_licitacion[$i],
                    'estado' => $estado_contrato[$i],
                    'tipo_contrato' => $t_contrato[$i],
                    'observacion_contrato' => $observacion_contrato[$i],
                    'encargado_proy' => $id_encargado[$i],
                    'id_proyecto' => $this->input->post('id_proy')
                );
                if ($ids_contrato[$i] == 0) {
                    $this->db->insert('registro_contrato_proyecto', $datos);
                    $id_insert_det = ($this->db->insert_id());
                } else {
                    $this->db->where('id_contrato', $ids_contrato[$i]);
                    $upd = $this->db->update('registro_contrato_proyecto', $datos);
                }
                //echo ', '.$id_insert_det;
            }
        }
        return($respuesta);
    }

    ////para los contratos proyectos

    function seleccionar_persona_asignar_proyecto() {
        $sql = "select * 
                from usuarios us
                order by us.ap_paterno ASC  ";
        $consulta = $this->db->query($sql);
        //return ($consulta->row());
        return($consulta);
    }

    /* function guardar_contrato_cliente(){

      }
      function guardar_contrato_de_proyecto()
      {
      $respuesta = "";
      $datos = array(
      // 'fh_registro' =>  date("Y-m-d H:i:s"),
      //'id_user_registred' => $this->session->userdata('id_admin'),
      'nombre' => $this->input->post('nom_proy'),
      'descripcion' => $this->input->post('desc_proy'),
      'estado' => $this->input->post('estado'),
      'fh_reg_proy' => date("Y-m-d H:i:s"),
      'id_user_registred' => $this->session->userdata('id_admin'),
      'gestion_proyecto' => $this->input->post('gestion'),
      'provision' => $this->input->post('provision'),
      'encargado_proy' => $this->input->post('id_encargado'),
      'etapa_proyecto' => $this->input->post('etapa'),
      'nro_contrato' => $this->input->post('nro_contrato'),
      'objeto' => $this->input->post('objeto'),
      'importe' => $this->input->post('importe'),
      'vigencia' => $this->input->post('vigencia'),
      'id_cliente' => $this->input->post('id_cliente')
      );
      if ($this->input->post('id_proy') == 0) {
      $this->db->insert('proyecto', $datos);
      $id_proy_contrato = ($this->db->insert_id());
      $respuesta = "<input type='text' id='ayudata' value='$id_proy_contrato'><input type='text' id='proceso' value='INSERT'><div class='OK'>Estado:Guardado</div>";
      } else {
      $this->db->where('id_proy', $this->input->post('id_proy'));
      $upd = $this->db->update('proyecto', $datos);
      if ($upd != 0)
      $respuesta = "<input type='hidden' id='ayudata' value='".$this->input->post('id_proy')."'><input type='hidden' id='proceso' value='UPDATE'><div class='OK'>Estado:Editado</div>";
      }
      return($respuesta);
      } */

    function listar_proyecto_cliente($id_cli) {
        $sql = "select * 
                from proyecto p
                where p.id_cliente=$id_cli
                and p.estado <> 'Inactivo'
                order by p.nombre ASC  ";
        $consulta = $this->db->query($sql);
        //return ($consulta->row());
        return($consulta);
    }

    function obtener_contrato_id($id_cont) {
        $sql = "select * 
                from registro_contrato_proyecto p
                where p.id_contrato=" . $id_cont
        ;
        $consulta = $this->db->query($sql);
        return ($consulta);
        //return($consulta);
    }

    function listar_contrato_proyecto_cliente($id_proy,$sel) {
        
        if($sel==0)
        {      $sql = " select * 
                from registro_contrato_proyecto p
                where p.id_proyecto=$id_proy
                order by p.nro_contrato ASC ";
        }
        else
        {
                $id_proy=$this->obtener_contrato_id($sel)->row()->id_proyecto;
            $sql = " select * 
                from registro_contrato_proyecto p
                where p.id_proyecto=$id_proy
                order by p.nro_contrato ASC ";
        }
        $consulta = $this->db->query($sql);
        //return ($consulta->row());
        return($consulta);
    }
    
    // function nueva para lineas servicios de telecomunicaciones
    function obtProyectosActivos()
    {
        $sql="SELECT D.id_proy,D.nombre FROM proyecto D where D.estado LIKE 'Activo' order by D.nombre ASC";
        $consulta = $this->db->query($sql);
        return($consulta);
    
    }

}