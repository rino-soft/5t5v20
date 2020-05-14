<?php

class dependientes_model extends CI_Model {

    function _construct() {
        parent::Model();
    }

    function obtiene_jefes() {
        $ssql = "select distinct a.cod_user, a.nombre, a.ap_paterno from usuarios a, admin_proyecto_cargo apc
                where apc.id_admin = a.cod_user and apc.id_padre=0;";
        /* $resultado = mysqli_query($ssql);an naZQWE0XDS
          return $resultado; */
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function obtiene_dependientes($cod_padre) {
        $ssql = "SELECT distinct a.* FROM usuarios a, (SELECT * FROM admin_proyecto_cargo WHERE
                 $cod_padre=id_padre) b WHERE a.cod_user= b.id_admin;";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

// funcion que ayuda a generar codigo
    function codigoSINOcheck($name, $value, $permiso) {
        $chec1 = "";
        $chec2 = "checked=checked";
        //  $disabled="";
        if ($value > 0) {
            $chec1 = "checked=checked"; //permisos del registro a modificar
            $chec2 = "";
        }
        $codigo_genera = '<div class="grid_2">SI<input type="radio" name="' . $name . '" value="1" ' . $chec1 . ' > NO<input type="radio" name="' . $name . '" value="0" ' . $chec2 . '></div>';
        if ($permiso < 1) {
            //$disabled = "disabled='disabled'"; // permisos del due;o de la cuenta
            $codigo_genera = '<div class="grid_2 rojo">Sin Permiso</div>';
        }
        return($codigo_genera);
    }

    function obtener_jefe_superior($id_usuario, $id_padre, $proyecto, $tipo) {//buscar el jefe superior inmediato con permiso de forma recursiva
        //    oo     ooooooo    oo        oo
        //  oo  oo      oo    oo  oo      oo
        //  oo  oo      oo    oo  oo    oooooo
        //  oo  oo   o  oo    oo  oo     oooo
        //    oo      ooo       oo        oo
        //todavia falta la busqueda pr tipo de permiso, 
        //   echo "ingresa a la funcion recursiva";
        echo "<br> datos :<br> usuario:$id_usuario,<br> Padre: $id_padre, <br> Proyecto:$proyecto";
        if ($id_padre == $id_usuario) {
            $sql = "SELECT * FROM admin_proyecto_cargo apc WHERE apc.estado='Activo'AND apc.id_admin=$id_usuario and apc.id_proy=$proyecto";
            $resultado = $this->db->query($sql);
            if ($resultado->num_rows() > 0) {
                $row = $resultado->row();
                return($this->obtener_jefe_superior($id_usuario, $row->id_padre, $proyecto, $tipo));
            }
        } else {
            $sql = "SELECT * FROM admin_proyecto_cargo apc WHERE apc.estado='Activo'AND apc.id_admin=$id_padre and apc.id_proy=$proyecto";
            $resultado = $this->db->query($sql);
            if ($resultado->num_rows() > 0) {
                $row = $resultado->row();
                if ($row->p_vac_per > 0) {
                    return($row->id_admin);
                } else {
                    return($this->obtener_jefe_superior($id_usuario, $row->id_padre, $proyecto, $tipo));
                }
            }
        }
    }

    function obtener_superior_permiso_proyecto($id_usuario, $id_padre, $proyecto, $tipo) {

        // echo "<br> datos :<br> usuario:$id_usuario,<br> Padre: $id_padre, <br> Proyecto:$proyecto";
        if ($id_padre == $id_usuario) {
            $sql = "SELECT * FROM admin_proyecto_cargo apc WHERE apc.estado='Activo'AND apc.id_admin=$id_usuario and apc.id_proy=$proyecto";
            $resultado = $this->db->query($sql);
            if ($resultado->num_rows() > 0) {
                $row = $resultado->row();
                return($this->obtener_superior_permiso_proyecto($id_usuario, $row->id_padre, $proyecto, $tipo));
            }
        } else {
            $sql = "SELECT * FROM admin_proyecto_cargo apc WHERE apc.estado='Activo'AND apc.id_admin=$id_padre and apc.id_proy=$proyecto";
            $resultado = $this->db->query($sql);
            if ($resultado->num_rows() > 0) {
                $row = $resultado->row();
                if ($row->p_rev_rend > 0) {
                    $sql2 = "select * from usuarios where cod_user=$row->id_admin";
                    $inf_user = $this->db->query($sql2);
                    $sql3 = "select * from ciudad where codciudad_pk=$row->regional";
                    $inf_reg = $this->db->query($sql3);
                    return($row->id_admin . "|" . $row->cargo . "|" .$inf_reg->row()->nombre . "|" .$inf_user->row()->nombre . "|" . $inf_user->row()->ap_paterno. "|" . $inf_user->row()->ap_materno);
                } else {
                    return($this->obtener_superior_permiso_proyecto($id_usuario, $row->id_padre, $proyecto, $tipo));
                }
            }
        }
    }

    /* se ha cambiado estas funciones por las de arriba, solo estan utilizando sin el RESULT
     * //////////////////////////////////////////////////////////////////////////////////////
     * 
      function obtiene_jefes() {
      $ssql = "select distinct a.codadm_pk, a.nombre, a.apellidos from administrador a, admin_proyecto_cargo apc
      where apc.id_admin = a.codadm_pk and apc.id_padre=0;";

      $resultado = $this->db->query($ssql);
      return $resultado->result();
      }


      function obtiene_dependientes($cod_padre) {
      $ssql = "SELECT distinct a.* FROM administrador a, (SELECT * FROM admin_proyecto_cargo WHERE
      $cod_padre=id_padre) b WHERE a.codadm_pk= b.id_admin;";
      $resultado = $this->db->query($ssql);                   sas an
      return $resultado->result();
      } */

    function contar_subdependientes($cod_padre) {
        $ssql = "SELECT a.* FROM usuarios a, (SELECT * FROM admin_proyecto_cargo WHERE
		$cod_padre=id_padre) b WHERE a.cod_user= b.id_admin;";
        $resultado = $this->db->query($ssql);
        return $resultado->num_rows();
    }

    function obtiene_proyectos_de_jefe($cod_padre) {
        $ssql = "SELECT b.nombre, b.descripcion FROM admin_proyecto_cargo a, proyecto b WHERE a.id_admin=$cod_padre AND a.id_proy=b.id_proy;";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    //////////////////////////// Funciones Ruben Payrumani Ino//////////////////////////////
    function verificar_ultimo_estado($id_usuario) {
        $sql = "SELECT * FROM admin_proyecto_cargo apc
                where apc.id_admin='$id_usuario'
                order by idpk DESC ";
        $consulta = $this->db->query($sql);
        $estado = 'Sin Registro';
        if ($consulta->num_rows() > 0) {
            $fila = $consulta->row();
            if ($fila->estado == 'Activo')
                $estado = "Ocupado";
            else
                $estado = "Libre";
        }
        return $estado;
    }

    function adicionarNuevoRegistroDeAltaPersonalProyecto($codUser) {
        //se ha adicionado id_user= id del usuario que ha registrado a este personal
        $datos = array(
            'id_admin' => $this->input->post('id_adminj'),
            'id_user' => $codUser,
            'id_proy' => $this->input->post('id_proyj'),
            'cargo' => $this->input->post('cargoj'),
            'fecha_asignacion' => $this->input->post('fecha_asignacionj'),
            'id_padre' => $this->input->post('id_padrej'),
            'estado' => 'Activo',
            'regional' => $this->input->post('regionalj'),
            'es_padre' => $this->input->post('es_padrej')
        );
        //echo 'se ha cargado el vector';
        $this->db->insert('admin_proyecto_cargo', $datos);
        return ($this->db->insert_id());
    }

    //function que edita el registro de alta de algun personal, ademas de dar de baja o editar a tambien a sus dependientes en un primer nivel

    function EditarRegistroDeAltaPersonalProyecto($idregistro, $datos) {
        $sql = "select apc.idpk , a.ci, CONCAT(a.nombre,' ' ,a.ap_paterno) as Nomcomp, d.nombre as proy, d.id_proy as id_proy , apc.id_padre ,apc.regional,apc.cargo, apc.es_padre, apc.fecha_asignacion
            from admin_proyecto_cargo apc, usuarios a, proyecto d
            where apc.id_admin=a.cod_user
            and d.id_proy=apc.id_proy
            and apc.estado='activo'
            and apc.idpk=$idregistro ";
        $consulta = $this->db->query($sql);
        $fila = $consulta->row();
        $datos_iniciales = array(
            'cargo' => $fila->cargo,
            'fecha_asignacion' => $fila->fecha_asignacion,
            'id_padre' => $fila->id_padre,
            'estado' => 'Activo',
            'regional' => $fila->regional,
            'es_padre' => $fila->es_padre
        ); // se carga los daton iniciales antes de hacer la edicion de los datos
        $vectornombre = array('cargo', 'fecha_asignacion', 'id_padre', 'estado', 'regional', 'es_padre');
        /* $datos = array(
          'cargo' => $this->input->post('cargoj'),
          'fecha_asignacion' => $this->input->post('fecha_asignacionj'),
          'id_padre' => $this->input->post('id_padrej'),
          'estado' => 'Activo',
          'regional' => $this->input->post('regionalj'),
          'es_padre' => $this->input->post('es_padrej')
          ); // se carga los datos nuevos */
        $cadena = ""; //cadena obs, para registrar los cambios
        for ($i = 0; $i < count($vectornombre); $i++) {
            if ($datos_iniciales[$vectornombre[$i]] != $datos[$vectornombre[$i]])
                $cadena.='- Se cambia el campo ' . $vectornombre[$i] . ' de : <<' . $datos_iniciales[$vectornombre[$i]] . '>> a :<<' . $datos[$vectornombre[$i]] . '>><br/>';
        }
        if ($cadena != "") {
            $cadena = "Se Realizaron los siguientes cambios.<br/>" . $cadena;
            $this->db->where('idpk', $idregistro);
            $this->db->update('admin_proyecto_cargo', $datos);
        }
        return $cadena;
    }

    function EditarPermisosPersonalProyecto($idregistro, $datos) {
        $sql = "select *
            from admin_proyecto_cargo apc
            where apc.estado='activo'
            and apc.idpk='$idregistro' ";
        $consulta = $this->db->query($sql);
        $fila = $consulta->row();
        $datos_iniciales = array(
            'p_vac_per' => $fila->p_vac_per,
            'p_jus' => $fila->p_jus,
            'p_baj_med' => $fila->p_baj_med,
            'p_rev_rend' => $fila->p_rev_rend,
            'env_rend' => $fila->env_rend,
            'p_adicionar' => $fila->p_adicionar,
            'p_baja' => $fila->p_baja,
            'p_editar' => $fila->p_editar,
            'p_ver_historial' => $fila->p_ver_historial,
            'p_otorgar_permisos' => $fila->p_otorgar_permisos,
            'pp_vac_per' => $fila->pp_vac_per,
            'pp_jus' => $fila->pp_jus,
            'pp_baj_med' => $fila->pp_baj_med,
            'pp_add' => $fila->pp_add,
            'pp_ba' => $fila->pp_ba,
            'pp_edit' => $fila->pp_edit,
            'pp_hist' => $fila->pp_hist,
            'pp_perm' => $fila->pp_perm); // se carga los daton iniciales antes de hacer la edicion de los datos

        $vectornombre = array('permiso para dar vacaciones', 'permiso para dar Justificaciones', 'permiso para dar bajas medicas', 'permiso para revisar rendiciones', 'envia rendicion a ', 'permiso para poder adicionar', 'permiso para poder dar baja del proyecto',
            'permiso para poder editar los registros', 'permiso para ver el historial del dependiente', 'permiso para otorgar_permisos', 'permiso para dar permiso de autorizar vacaciones',
            'permiso para dar permiso de justificaciones', 'permiso para dar permiso de bajas medicas', 'permiso para dar permiso de adicionar dependientes', 'permiso para dar permiso de dar baja a depedientes',
            'permiso para dar permiso de editar a los dependientes', 'permiso para dar permiso de ver historial de dependientes', 'permiso para dar permiso de dar permisos');
        $vector_campos = array('p_vac_per', 'p_jus', 'p_baj_med', 'p_rev_rend','env_rend', 'p_adicionar', 'p_baja', 'p_editar', 'p_ver_historial', 'p_otorgar_permisos',
            'pp_vac_per', 'pp_jus', 'pp_baj_med', 'pp_add', 'pp_ba', 'pp_edit', 'pp_hist', 'pp_perm');
        /* $datos = array(
          'cargo' => $this->input->post('cargoj'),
          'fecha_asignacion' => $this->input->post('fecha_asignacionj'),
          'id_padre' => $this->input->post('id_padrej'),
          'estado' => 'Activo',
          'regional' => $this->input->post('regionalj'),
          'es_padre' => $this->input->post('es_padrej')
          ); // se carga los datos nuevos */
        $cadena = ""; //cadena obs, para registrar los cambios
        for ($i = 0; $i < count($vector_campos); $i++) {
            echo $vector_campos[$i] . '>>>>>' . $datos[$vector_campos[$i]] . '<br/>';
            if ($datos_iniciales[$vector_campos[$i]] != $datos[$vector_campos[$i]])
                $cadena.=' - ' . $vectornombre[$i] . ' de : <<' . $datos_iniciales[$vector_campos[$i]] . '>> a :<<' . $datos[$vector_campos[$i]] . '>><br/>';
        }
        if ($cadena != "") {
            $cadena = "cambios en los permisos del registro $idregistro.<br/>" . $cadena;
            $this->db->where('idpk', $idregistro);
            $res = $this->db->update('admin_proyecto_cargo', $datos);
            echo $this->db->last_query();
        }
        return $cadena;
    }

    //funcion que da de baja a una persona y sus dependietes del proyecto RECURSIVO
    function BajaPersonalProyecto_c_dep_d_dep_recursivo($id_registro, $datos) {
        $this->load->model('usuario_model');
        $datos_registros = $this->usuario_model->obtenerDatos_Admin_proyecto_cargoPHP($id_registro);
        $dependientes_baja = $this->usuario_model->obtiene_ependientes_usuarioX_PHP($datos_registros->cod_user, $datos_registros->id_proy);
        if ($dependientes_baja->num_rows() > 0) {
            foreach ($dependientes_baja->result() as $registro) {
                $this->BajaPersonalProyecto_c_dep_d_dep_recursivo($registro->idpk, $datos);
            }
        } else {
            $this->db->where('idpk', $id_registro);
            echo "<script>alert('se cargaron los datos');</script>";
            $this->db->update('admin_proyecto_cargo', $datos);

            date_default_timezone_set("Etc/GMT+4");
            $vector = array('id_adm_proy' => $id_registro,
                'tipo_registro' => 'Baja Proyecto',
                'fecha_registro' => date("Y-m-d H:i:s"),
                'comentario' => 'Baja , por motivo de Baja de  inmediato superior',
                'observaciones' => 'Baja de usuario en proyecto');
            $id_adicion_registro = $this->historial_personal_model->registrar_evento_historial_personal($vector);
        }
    }

    function BajaRegistroDeAltaPersonalProyecto($id_registro, $datos) {
        $this->load->model('usuario_model');

        $datos_registros = $this->usuario_model->obtenerDatos_Admin_proyecto_cargoPHP($id_registro);
        $this->db->where('idpk', $id_registro);
        // echo "<script>alert('se cargaron los datos');</script>";
        $this->db->update('admin_proyecto_cargo', $datos);
        return('Baja de Personal en proyecto');
        /* date_default_timezone_set("Etc/GMT+4");
          $vector = array('id_adm_proy' => $id_registro,
          'tipo_registro' => 'Baja Proyecto',
          'fecha_registro' => date("Y-m-d H:i:s"),
          'comentario' => 'Baja , por motivo de Baja de  inmediato superior',
          'observaciones' => 'Baja de usuario en proyecto');
          $id_adicion_registro = $this->historial_personal_model->registrar_evento_historial_personal($vector); */
    }

    function tiene_permiso_para_otorgar_permiso($proyecto, $id) {
        $sql = "SELECT * FROM admin_proyecto_cargo apc
            WHERE apc.id_proy='$proyecto' AND
            apc.estado='Activo'
             and apc.da_permisos ='1'
            AND apc.id_admin='$id'";
        $resultado = $this->db->query($sql);
        if ($resultado->num_rows() > 0)
            return (1);
        else
            return(0);
    }

    function obtener_datos_permisos($proyecto, $id) {
        $sql = "SELECT * FROM admin_proyecto_cargo apc
            WHERE apc.id_proy='$proyecto' AND
            apc.estado='Activo'
            AND apc.id_admin='$id'";
        $resultado = $this->db->query($sql);
        return($resultado);
    }

//funcion recursiva de obtension de arbol de dependientes, obtiene el codigo entero desde el <ul>
    function obtener_arbol_dependientes($proyecto, $jefe, $primero) {
        // $primero ==> id_del primero en la lista el mas alto

        $codigo = '';
        $sql = "SELECT apc.idpk as id_registro ,a.cod_user, CONCAT(a.nombre,' ',a.ap_paterno) as nombreCompleto,apc.cargo,c.nombre as regional ,d.nombre as proyecto ,apc.es_padre
            FROM admin_proyecto_cargo apc, usuarios a ,ciudad c,proyecto d
            WHERE apc.id_admin=a.cod_user AND apc.id_proy='$proyecto' AND id_padre='$jefe' AND apc.estado='Activo' AND c.codciudad_pk=apc.regional AND d.id_proy=apc.id_proy;";
        // echo "<br>RRRRRRRR:::::".$sql."<br>";
        $resultado = $this->db->query($sql);
        $permisos_primero = $this->obtener_datos_permisos($proyecto, $primero);
        $llave = FALSE;
        if ($permisos_primero->num_rows > 0) {
            $llave = TRUE;
            $per = $permisos_primero->row();
        }

        if ($resultado->num_rows() > 0) {
            $codigo = '<ul>';
            foreach ($resultado->result() as $niveles) {
                $subcodigo = "";
                $claseimagen = "";
                $div_ultimo = "";
                $nombreCompleto = ucwords(strtolower($niveles->nombreCompleto));
                $estilofinal = '';
                $botonAdicionar = "";
                $botonpermiso = "";
                $botonBaja = "";
                $botonEditar = "";
                $botonHistorial = "";
                if ($llave) {

                    if ($niveles->es_padre == 1) {
                        $estilofinal = " class='collapsable' ";
                        $div_ultimo = "<div class='hitarea collapsable-hitarea'></div>";
                        $claseimagen = "class='folder' ";

                        if ($per->p_adicionar > 0)
                            $botonAdicionar = "<div class='menubotones_adicionar milink' title='Adicionar dependiente directo del personal' onclick='Dialog_altaPersonalProyecto_jefeDirecto($niveles->cod_user) '></div>";
                        if ($per->p_otorgar_permisos > 0)
                            $botonpermiso = "<div class='menubotones_permiso milink' title='Otorgar Permisos' onclick='Dialog_permisos_personal($niveles->id_registro) '></div>";
                    }
                    else {
                        $claseimagen = "class='file' ";
                    }

                    if ($per->p_baja > 0)
                        $botonBaja = "<div class='menubotones_eliminar milink' title='Baja personal proyecto' onclick='Dialog_BajaPersonalProyecto($niveles->id_registro)'></div>";
                    if ($per->p_editar > 0)
                        $botonEditar = "<div class='menubotones_editar milink' title='Editar Registro' onclick='Dialog_ModPersonalProyecto($niveles->id_registro)'></div>";
                    if ($per->p_ver_historial > 0)
                        $botonHistorial = "<div class='menubotones_historial milink' title='historial personal' onclick='Dialog_historialPersonalProyecto($niveles->id_registro)'></div>";
                }

                $codigo.="<li $estilofinal >$div_ultimo
                  <span $claseimagen >
                    <div class='fondocambiable' >
                       <div id='menubotones'>
                          <div class='menu_personal oculto'>  " . $botonpermiso . $botonHistorial . $botonBaja . $botonEditar . $botonAdicionar . " </div> 
                       </div>
                       <span class='negrilla negrocolor'>$niveles->cod_user $nombreCompleto </span><br/>
                       <span class='letrachica'>$niveles->cargo $niveles->proyecto (Regional: $niveles->regional)</span>
                    </div>
                  </span>";

                if ($niveles->es_padre == 1) {
                    $subcodigo = $this->obtener_arbol_dependientes($proyecto, $niveles->cod_user, $primero);
                }
                $codigo.=$subcodigo . "</li>";
            }
            $codigo.="</ul>";
        }
        return $codigo;
    }

    //////////////////////////// Funciones Ruben Payrumani Ino//////////////////////////////
}

?>