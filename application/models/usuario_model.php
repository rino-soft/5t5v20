<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario_model
 *
 * @author Ruben
 */
class usuario_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /* function guardar_usuario_nuevo() {
      $respuesta = "";
      $datos = array(
      'nombre' => $this->input->post('nom'),
      'ap_paterno' => $this->input->post('app'),
      'ap_materno' => $this->input->post('apm'),
      'ci' => $this->input->post('ci'),
      'username' => $this->input->post('user'),
      'password' => $this->input->post('pass'),
      'estado' => $this->input->post('est'),
      'fh_registro' => $this->input->post('fhr'),
      );
      if ($this->input->post('cod_user') == 0) {
      $this->db->insert('usuarios', $datos);
      $id_user_nuevo = ($this->db->insert_id());
      $respuesta = "<input type='hidden' id='ayudata' value='$id_user_nuevo'><input type='hidden' id='proceso' value='INSERT'>";
      } else {
      $this->db->where('cod_user', $this->input->post('id_user'));
      $upd = $this->db->update('usuarios', $datos);
      if ($upd != 0)
      $respuesta = "<input type='hidden' id='ayudata' value='$upd'><input type='hidden' id='proceso' value='UPDATE'>";
      }
      return($respuesta);
      } */

    function buscar_nit() {
        
    }
    function obtener_cuentas_banco($id_usuario)
    {
        
        $sql = "select * from cuentabanco where id_usuario=$id_usuario";

        //echo 'consulta'.$sql;
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function obtener_user($id_usuario) {
        $sql = "select * from usuarios where cod_user=$id_usuario";

        //echo 'consulta'.$sql;
        $consulta = $this->db->query($sql);
        $row = 0;
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row;
    }

    function obtener_user_norow($id_usuario) {
        $sql = "select * from usuarios where cod_user=$id_usuario";
        $consulta = $this->db->query($sql);

        return $consulta;
    }

    function obt_user_encargado($id_user_encargado) {

        $sql = "select * from  usuarios u 
where u.cod_user=$id_user_encargado";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtiene_datos_usuarioX($id_usuario) {
        $sql = "SELECT a.cod_user, CONCAT(a.nombre,' ',a.ap_paterno,' ',a.ap_materno)as nomComp , a.ci
                    FROM usuarios a
                    WHERE a.cod_user='$id_usuario' ";
        //echo $sql;
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            $fila = $consulta->row();
            return($fila);
        }
        return(0);
    }

    function obtiene_datos_usuarioXmodificado($id_usuario) {//modificado por magali poma rivero
        $sql = "SELECT a.cod_user, CONCAT(a.nombre,' ',a.ap_paterno,' ',a.ap_materno)as nomComp , a.ci
                    FROM usuarios a
                    WHERE a.cod_user='$id_usuario' ";
        // echo $sql;
        $vector = array();
        $vector['cod_user'] = '';
        $vector['comComp'] = '';
        $vector['ci'] = '';
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            $vector['cod_user'] = $consulta->row()->cod_user;
            $vector['comComp'] = $consulta->row()->nomComp;
            $vector['ci'] = $consulta->row()->ci;
        }
        return($vector);
    }

    function listar_usuarios() {

        $mens = "Seleccione un Usuario";
        $sql = "select * from usuarios u where 1 order by u.nombre";
        $consulta = $this->db->query($sql);
        $codigo = " ";
        $codigo.="<option>$mens</option>";
        foreach ($consulta->result() as $con) {
            $codigo.="<option value='$con->cod_user'>$con->ap_paterno $con->ap_materno, $con->nombre </option>";
        }

        $codigo = "Nombres: <select id='id_personal' onchange='lista_mov_usuario(); $(\"#detalle_ov_pf\").html(\"\");'>" . $codigo . "</select>";

        return $codigo;
    }

    function find_ser_prov_detalle() {

        $osd = $this->input->post("buscar");
        $sql = "select * from movimiento_almacen ma, detalle_mov_almacen dma, producto_servicio ps 
            where ma.id_user_er=$osd 
                and ma.id_mov_alm=dma.id_mov_alm 
                and dma.id_articulo=ps.id_serv_pro";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function cant_find_ser_prov_detalle() {
        $osd = $this->input->post("buscar");
        $sql = "select * from movimiento_almacen ma, detalle_mov_almacen dma, producto_servicio ps where ma.id_user_er=$osd and ma.id_mov_alm=dma.id_mov_alm and dma.id_articulo=ps.id_serv_pro";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function find_usuarios() {
        //$busqueda = "%" . str_replace(" ", "%", $busqueda) . "%";
        $os = $this->input->post("buscar");

        $sql = "select * from usuarios where cod_user=$os";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function listar_buscar_u_cantidad($busqueda) {
        $busqueda = "%" . str_replace(" ", "%", $busqueda) . "%";
        $sql = "select * from usuarios u where u.cod_user='%$busqueda%'";
        $consulta = $this->db->query($sql);



        return($consulta->num_rows());
    }

    // funciones contactos de Cliente
    function guardar_contact_nuevo_cliente() {
        $respuesta = "";
        $datos = array(
            'id_cliente' => $this->input->post('id_cli'),
            'nom_comp' => $this->input->post('nom_com'),
            'telefonos' => $this->input->post('tel'),
            'cargo' => $this->input->post('cargo'),
            'direccion' => $this->input->post('dir'),
            'estado' => "Activo");
        if ($this->input->post('id_cont') != 0) {

            $this->db->where('id_contacto', $this->input->post('id_cont'));
            $upd = $this->db->update('contacto_cliente', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='$upd'><input type='hidden' id='proceso' value='UPDATE'>";
        }
        else {
            $this->db->insert('contacto_cliente', $datos);
            $id_con_nuevo = $this->db->insert_id();
            $respuesta = "<input type='hidden' id='ayudata' value='$id_con_nuevo'><input type='hidden' id='proceso' value='INSERT'>";
        }

        return ($respuesta);
    }

    function obtener_contacto($id_contacto) {
        $sql = "select * from contacto_cliente where id_contacto=$id_contacto";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function lista_contacto_cliente($cliente) {
        $vectorInformacion = array();
        $sql = "SELECT * FROM contacto_cliente cc
            WHERE cc.id_cliente='$cliente' order by cc.nom_comp";
        $query = $this->db->query($sql);
        $i = 0;
        foreach ($query->result() as $registro) {
            $vectorInformacion[$i] = Array(
                'id_contacto' => $registro->id_contacto,
                'nombre_c' => $registro->nom_comp,
                'cargo' => $registro->cargo,
                'estado' => $registro->estado,
                'dir' => $registro->direccion,
                'tel' => $registro->telefonos);
            $i++;
        }
        return($vectorInformacion);
    }

    // sav
    function obtProyectoUser($admin) {
        $sql = "SELECT D.id_proy,D.nombre FROM admin_proyecto_cargo APC, proyecto D 
            WHERE D.id_proy=APC.id_proy AND APC.id_admin='$admin' and D.estado='Activo' and APC.estado='Activo' order by d.nombre ASC";
        // echo $sql;
        $consulta = $this->db->query($sql);
        //$data[0]='Seleccione un proyecto';
        foreach ($consulta->result() as $reg) {
            $data[$reg->id_proy] = $reg->nombre;
        }
        return $data;
    }

    function obtProyectoUserResult($admin) {
        $sql = "SELECT D.id_proy,D.nombre FROM admin_proyecto_cargo APC, proyecto D 
            WHERE D.id_proy=APC.id_proy AND APC.id_admin='$admin' and D.estado='Activo' and APC.estado='Activo' order by d.nombre ASC";
        // echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtenerCI_admin($id_user) {
        $sql = "select a.ci from usuarios a WHERE a.cod_user='$id_user' ";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
            $ci = $row->ci;
        } else {
            $ci = 0;
        }

        //echo 'id: '.$id_user." ci :".$ci;
        return $ci;
    }

    function obtenerAdministradorCI($ci) {
        $sql = "select a.cod_user as iduser, CONCAT(a.nombre,' ', a.ap_paterno,' ',a.ap_materno)as nomComp, a.ci from usuarios a WHERE a.ci='$ci' ";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
            $resultado[0] = $row->iduser;
            $resultado[1] = $row->nomComp;
        } else {
            $resultado[0] = 0;
            $resultado[1] = 'No encontrado';
        }
        header('Content-type: application/json');
        echo json_encode($resultado);
    }

    function obtenerAdministradorCI____Vanterior($ci) {
        $sql = "select a.codadm_pk as iduser, CONCAT(a.nombre,' ', a.apellidos)as nomComp, a.ci from administrador a WHERE a.ci='$ci' ";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
            $resultado[0] = $row->iduser;
            $resultado[1] = $row->nomComp;
        } else {
            $resultado[0] = 0;
            $resultado[1] = 'No encontrado';
        }
        header('Content-type: application/json');
        echo json_encode($resultado);
    }

    function obtener_dependientes_todos($jefe) {

        $sql = 'select * from admin_proyecto_cargo apc WHERE apc.estado="Activo" and apc.id_padre="' . $jefe . '"';
        $consulta = $this->db->query($sql);

        $cod = "";
        if ($consulta->num_rows() > 0) {

            foreach ($consulta->result() as $fila) {
                //cambiar por - y reeplazar en justificaciones_model
                $cod .= 'OR id_user_destino=' . $this->obtener_dependientes_todos($fila->id_admin);
            }
            $cod = $jefe . " " . $cod;
        } else {

            $cod .= " " . $jefe . " ";
        }
        return($cod);
    }

    function obtiene_datos_usuario_inicial($id_usuario, $id_proy) {
        $sql = "SELECT a.cod_user, CONCAT(a.nombre,' ',a.ap_paterno)as nomComp , a.ci,
                apc.cargo,apc.id_proy,d.nombre as proy,apc.fecha_asignacion,apc.regional,c.nombre as reg,apc.estado, apc.es_padre
                FROM usuarios a,admin_proyecto_cargo apc,proyecto d ,ciudad c
                WHERE a.cod_user='$id_usuario'
                and a.cod_user=apc.id_admin
                and apc.regional=c.codciudad_pk
                and apc.id_proy=d.id_proy
                and apc.id_proy='$id_proy' ";
        $consulta = $this->db->query($sql);

        if ($consulta->num_rows() > 0) {
            $fila = $consulta->row();
            return($fila);
        }
        return(0);
    }

    function busqueda_personal_1_parametro() {//necesita un parametro de busqueda que se obtiene por post//
        $parametro = $this->input->post('busqueda');
        $parametro = str_replace(' ', '%', $parametro);
        $sql = "SELECT *
        FROM usuarios aa, (SELECT a.cod_user, CONCAT(a.nombre,a.ap_paterno,a.ap_materno,a.username,a.ci) as lineaBusqueda
                                                FROM usuarios a) bb
        WHERE aa.cod_user =bb.cod_user
        and bb.lineaBusqueda LIKE '%$parametro%' 
        and aa.username  not LIKE '%BAJA%'
        and ci!=0 
        Order by ap_paterno";

        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

    function obtener_cargos() {
        $sql = "select distinct cargo FROM admin_proyecto_cargo WHERE 1 order by cargo ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

    //idem function arriba pero para PHP
    function obtenerDatos_Admin_proyecto_cargoPHP($idregistro) {
        $sql = "select apc.idpk , a.cod_user ,a.ci, CONCAT(a.nombre,' ' ,a.ap_paterno) as Nomcomp, d.nombre as proy, d.id_proy as id_proy , apc.id_padre ,apc.regional,apc.cargo, apc.es_padre, apc.fecha_asignacion,apc.*
            from admin_proyecto_cargo apc, usuarios a, proyecto d
            where apc.id_admin=a.cod_user
            and d.id_proy=apc.id_proy
            and apc.estado='activo'
            and apc.idpk='$idregistro' ";
        //    echo $sql;

        $consulta = $this->db->query($sql);

        if ($consulta->num_rows() > 0)
            $fila = $consulta->row();
        return($fila);
    }

    function obtenerDatos_Admin_proyecto_cargoPHP_modificado($idregistro) {
        $sql = "select apc.idpk , a.cod_user ,a.ci, CONCAT(a.nombre,' ' ,a.ap_paterno) as Nomcomp, d.nombre as proy, d.id_proy as id_proy , apc.id_padre ,apc.regional,apc.cargo, apc.es_padre, apc.fecha_asignacion,apc.*
            from admin_proyecto_cargo apc, usuarios a, proyecto d
            where apc.id_admin=a.cod_user
            and d.id_proy=apc.id_proy
            and apc.estado='activo'
            and apc.idpk='$idregistro' ";

        //echo $sql;
        $vector = array();

        $vector['idpk'] = '';
        $vector['cod_user'] = '';
        $vector['ci'] = '';
        $vector['Nomcomp'] = '';
        $vector['proy'] = '';
        $vector['id_proy'] = '';
        $vector['id_padre'] = '';
        $vector['regional'] = '';
        $vector['cargo'] = '';
        $vector['es_padre'] = '';
        $vector['fecha_asignacion'] = '';


        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            $vector['idpk'] = $consulta->row()->idpk;
            $vector['cod_user'] = $consulta->row()->cod_user;
            $vector['ci'] = $consulta->row()->ci;
            $vector['Nomcomp'] = $consulta->row()->Nomcomp;
            $vector['proy'] = $consulta->row()->proy;
            $vector['id_proy'] = $consulta->row()->id_proy;
            $vector['id_padre'] = $consulta->row()->id_padre;
            $vector['regional'] = $consulta->row()->regional;
            $vector['cargo'] = $consulta->row()->cargo;
            $vector['es_padre'] = $consulta->row()->es_padre;
            $vector['fecha_asignacion'] = $consulta->row()->fecha_asignacion;
        }

        //echo $vector['Nomcomp']."".$vector['ci'];
        return($vector);
    }

    // verifica si es padre para poder mostrar en lista de asignacion de padres a un personal,  *se utiliza para mostrar la lista de padres del formulario de registro de alta a un proyecto*
    function obtenerPadresProyecto($iproy, $ijefe, $selected) {
        $sql = "select ad.id_admin 
            ,a.nombre 
            ,a.ap_paterno
            ,a.ci
            ,ad.cargo
            ,d.nombre 
            as proyecto,
            c.nombre as regional
from admin_proyecto_cargo ad , usuarios a, proyecto d,ciudad c 
where ad.id_proy='$iproy'
and ad.regional=c.codciudad_pk
and d.id_proy=ad.id_proy
and ad.estado='activo'
and ad.es_padre=1
and a.cod_user=ad.id_admin";
        if ($ijefe != 0)
            $sql .= " and a.cod_user='$ijefe'";
        //  echo $sql;
        $consulta = $this->db->query($sql);

        $cadena = "<select id='superiorImediato' style='width:350px;' >"; //onchange='javascript:mostrarSeleccionado(\"superiorImediato\");'
        $i = 0;
        foreach ($consulta->result() as $fila) {
            $seleccionado = '';
            if ($selected == $fila->id_admin)
                $seleccionado = ' selected="selected" ';
            $cadena.="<option class='bordeArriba'  $seleccionado  value='$fila->id_admin' onmouseover='cambiar_estilo_select_disabled($i,1)' onmouseout='cambiar_estilo_select_disabled($i,0)'>$fila->nombre $fila->ap_paterno</option>";
            $cadena.="<option id='opCargoPad$i' disabled='disabled' class='letrachica'>$fila->cargo , $fila->proyecto,$fila->regional</option>";
            $i++;
        }
        $cadena.="</select>";
        return $cadena;
    }

    function obtener_padres_proyecto($iproy, $ijefe, $resultado) {
        $sql = "select * from admin_proyecto_cargo apc , usuarios u, proyecto p , ciudad c
                where u.cod_user=apc.id_admin
                and p.id_proy=apc.id_proy
                and apc.regional=c.codciudad_pk
                and apc.id_padre=$ijefe
                and apc.id_proy=$iproy
                and apc.es_padre=1
                and apc.estado='Activo'";
        $consulta = $this->db->query($sql);
        if ($consulta->num_rows() > 0) {
            foreach ($consulta->result() as $hijos) {
                $resultado.= ($this->obtener_padres_proyecto($iproy, $hijos->id_admin, $resultado));
            }
            $resultado = ($ijefe . "|" . $resultado);
        } else
            $resultado = ($ijefe . "|");

        return($resultado);
    }

    function obtener_padres_proyecto_selec($iproy, $ijefe, $selected) {
        $ids_padres = $this->obtener_padres_proyecto($iproy, $ijefe, '');
        $ids_padres = substr($ids_padres, 0, (strlen($ids_padres) - 1));
        $ids_padres = str_replace("|", " or a.cod_user=", $ids_padres);

        $sql = 'select ad.id_admin, a.nombre, a.ap_paterno, a.ci, ad.cargo, d.nombre as proyecto, c.nombre as regional
        from admin_proyecto_cargo ad, usuarios a, proyecto d, ciudad c
        where ad.id_proy = ' . $iproy . ' 
        and ad.regional = c.codciudad_pk
        and d.id_proy = ad.id_proy
        and ad.estado = "Activo"
        and a.cod_user = ad.id_admin
        and (a.cod_user=' . $ids_padres . ')';
        //echo $sql;
        $consulta = $this->db->query($sql);

        $cadena = "<select id='superiorImediato' style='width:350px;' >"; //onchange='javascript:mostrarSeleccionado(\"superiorImediato\");'
        $i = 0;
        foreach ($consulta->result() as $fila) {
            $seleccionado = '';
            if ($selected == $fila->id_admin)
                $seleccionado = ' selected="selected" ';
            $cadena.="<option class='bordeArriba'  $seleccionado  value='$fila->id_admin' onmouseover='cambiar_estilo_select_disabled($i,1)' onmouseout='cambiar_estilo_select_disabled($i,0)'>$fila->nombre $fila->ap_paterno</option>";
            $cadena.="<option id='opCargoPad$i' disabled='disabled' class='letrachica'>$fila->cargo , $fila->proyecto,$fila->regional</option>";
            $i++;
        }
        $cadena.="</select>";
        return $cadena;
    }

    function obtenerDatosHistorial($id_cod_adm) {
        $sql = "select rhp.fecha_registro,rhp.tipo_registro,d.nombre as proyecto,apc.cargo ,
                rhp.comentario,rhp.observaciones 
                FROM registro_historial_personal rhp, usuarios a,
                admin_proyecto_cargo apc, proyecto d
                where a.cod_user=apc.id_admin
                and apc.idpk=rhp.id_adm_proy
                and d.id_proy=apc.id_proy
                and a.cod_user='$id_cod_adm' ";
        $consulta = $this->db->query($sql);


        return($consulta);
    }

    function obtiene_ependientes_usuarioX_PHP($usuarioX, $idProy) {
        $sql = "SELECT apc.idpk, apc.id_admin, CONCAT(a.nombre,' ',a.ap_paterno)as nomComp
                    FROM admin_proyecto_cargo apc, usuarios a
                    WHERE apc.id_admin=a.cod_user
                    AND apc.id_padre='$usuarioX'
                    AND apc.id_proy='$idProy'";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function lista_usuarios_activos() {
        $sql = "select * from usuarios u where u.estado='Activo' order by u.ap_paterno";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

//rubennn
    function obtProyectoUsuario($admin) {
        $sql = "SELECT D.id_proy,D.nombre FROM admin_proyecto_cargo APC, proyecto D 
            WHERE D.id_proy=APC.id_proy AND APC.id_admin='$admin' and APC.estado<>'Inactivo' ";
        //echo $sql;
        $consulta = $this->db->query($sql);
        //$data[0]='Seleccione un proyecto';
        return $consulta;
    }

    function obtener_dependientes_bajo_nivel($usuario, $proy) {
        $cods_users = $this->obtener_dependientes_todos_proy($usuario, $proy);
        $sql = "select * from usuarios where cod_user=" . $cods_users . " order by ap_paterno";
        $consulta = $this->db->query($sql);
        //echo $sql;
        return($consulta);
    }

    function obtener_dependientes_todos_proy($jefe, $proy) {

        $sql = 'select * from admin_proyecto_cargo apc WHERE apc.estado="Activo" and apc.id_proy=' . $proy . ' and apc.id_padre="' . $jefe . '"';
        // echo "<br>". $sql."<br>";

        $consulta = $this->db->query($sql);

        $cod = "";
        if ($consulta->num_rows() > 0) {

            foreach ($consulta->result() as $fila) {
                //cambiar por - y reeplazar en justificaciones_model
                $cod .= 'OR cod_user=' . $this->obtener_dependientes_todos_proy($fila->id_admin, $proy);
            }
            $cod = $jefe . " " . $cod;
        } else {

            $cod .= " " . $jefe . " ";
        }
        // echo "<br>".$jefe."Hijos >>>>>>".$cod;
        return($cod);
    }

///// modificado paula
    function guardar_usuario_nuevo() {
        $respuesta = "";
        date_default_timezone_set("Etc/GMT+4");
        $datos = array(
            'nombre' => $this->input->post('nom'),
            'ap_paterno' => $this->input->post('app'),
            'ap_materno' => $this->input->post('apm'),
            'ci' => $this->input->post('ci'),
            'exp' => $this->input->post('exp'),
            'telefono' => $this->input->post('tel'),
            'direccion' => $this->input->post('dir'),
            'username' => $this->input->post('user'),
            'password' => md5($this->input->post('pass')),
            'sexo' => $this->input->post('gen'),
            'cod_operacional' => $this->input->post('co'),
            'estado' => "Activo",
            'fh_registro' => date("Y-m-d H:i:s"),
            'fecha_inicio' => $this->input->post('fecha_u'),
        );
        if ($this->input->post('id_user') == 0) {
            $this->db->insert('usuarios', $datos);
            $id_user_nuevo = ($this->db->insert_id());
            //echo $id_user_nuevo;
            $respuesta = "<input type='hidden' id='ayudata' value='$id_user_nuevo'><input type='hidden' id='proceso' value='INSERT'><div class='OK'>Estado:Guardado</div>";
            //echo  $respuesta;
        } else {
            $this->db->where('cod_user', $this->input->post('id_user'));
            $upd = $this->db->update('usuarios', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_user') . "'><input type='hidden' id='proceso' value='UPDATE'><div class='OK'>Estado:Editado Correctamente!!!</div>";
            //   echo  $respuesta;
        }
        return($respuesta);
    }

    function actualizar_datos_personal($id_usuario) {

        $respuesta = "";
        date_default_timezone_set("Etc/GMT+4");
        echo "ingreso al modelo";
        $datosant = $this->obtener_user($id_usuario);

        if ($this->input->post('contrasenia') != "")
            $contra = md5($this->input->post('contrasenia'));
        else
            $contra = $datosant->password;

        if ($this->input->post('clave_opera') != "")
            $cod_ope = md5($this->input->post('clave_opera'));
        else
            $cod_ope = $datosant->cod_operacional;

        $datos = array(
            'nombre' => $this->input->post('nom'),
            'ap_paterno' => $this->input->post('ap_pat'),
            'ap_materno' => $this->input->post('ap_mat'),
            'ci' => $this->input->post('ci'),
            'exp' => $this->input->post('exp'),
            //'telefono' => $this->input->post('tel'),
            //'direccion' => $this->input->post('dir'),
            'username' => $this->input->post('user_name'),
            'password' => $contra,
            'sexo' => $this->input->post('gen'),
            'cod_operacional' => $cod_ope,
            'estado' => "Activo",
            // 'fh_registro' => date("Y-m-d H:i:s"),
            //'fecha_inicio' => $this->input->post('fecha_u'),
            'fecha_nacimiento' => $this->input->post('fec_naci'),
            'estado_civil' => $this->input->post('est_civ'),
            'dependientes' => $datosant->dependientes . $this->input->post('dependientes'),
            //'no_lib_militar' => $this->input->post(''),
            //'ruta_ci_fron' => $this->input->post(''),
            'correo_per' => $this->input->post('email_p'),
            'correo_corp' => $this->input->post('email_c'),
            //'ruta_ci_tra' => $this->input->post(''),
            'cat_licencia_conducir' => $this->input->post('cate_licencia'),
            'direccion_domicilio' => $this->input->post('direccion'),
            //'adjunto_domicilio' => $this->input->post(''),
            'telefonos' => "domicilio :" . $this->input->post('tel_dom') . "; Personal:" . $this->input->post('telf_per'),
            //'referencia_personal' => $this->input->post('emergencia'),
            'emergencia' => $this->input->post('emergencia'), //concatena a las personas de emergencia
            'aportes_afp' => $this->input->post('afp_emp'),
            'nua_cua' => $this->input->post('nua_cua'),
            'camisa' => $this->input->post('camisa'),
            'pantalon' => $this->input->post('pantalon'),
            'botin' => $this->input->post('botin'),
            'chaleco' => $this->input->post('chaleco'),
            'overol_p' => $this->input->post('ov_pilo'),
            'overol_t' => $this->input->post('ov_term'),
            'parka' => $this->input->post('parka'),
            'ropa_agua' => $this->input->post('ropa_agua'),
            //'fotografia_actual' => $this->input->post(''),
            //'croquis_domicilio' => $this->input->post(''),
            'id_proyecto_actual' => $this->input->post('proy_actu'),
            'nacionalidad' => $this->input->post('nacio'),
            'cargo_actual' => $this->input->post('cargo_actu'),
            'funcion_actual' => $this->input->post('funciones_actu'),
            'departamento' => $this->input->post('depto')
        );
        echo "ingreso al modelo";
        $this->db->where('cod_user', $id_usuario);
        $upd = $this->db->update('usuarios', $datos);
        if ($upd != 0)
            $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_user') . "'><input type='hidden' id='proceso' value='UPDATE'><div class='OK'>Estado:Editado Correctamente!!!</div>";


        return($respuesta);
    }

    function actualizar_daactualizar_rutas_archivos_adjuntos_personal($id_usuario) {

        $datos = array($this->input->post('campo') => $this->input->post('valor'));

        $this->db->where('cod_user', $id_usuario);
        $upd = $this->db->update('usuarios', $datos);
    }

    /* function listar_usuarios_all($busqueda, $ini, $cant) {
      $busqueda = "%" . str_replace(" ", "%", $busqueda) . "%";
      // $busqueda = str_replace(" ", "%", $busqueda);
      $sql = "select * from usuarios u
      where concat(u.cod_user,u.nombre,u.ap_paterno,u.ap_materno) LIKE '$busqueda' order by u.cod_user DESC limit $ini,$cant";
      $consulta = $this->db->query($sql);
      return ($consulta->result());
      } */

    function listar_usuarios_all_cantidad($busqueda, $baja) {
        if ($baja == "no")
            $baja = " and (estado='Activo' and username NOT LIKE '%BAJA%') ";
        else
            $baja = "";
        $busqueda = "%" . str_replace(" ", "%", $busqueda) . "%";
        //$busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select * from usuarios u 
                where concat(ifnull(u.cod_user,''),ifnull(u.username,''),ifnull(u.nombre,''),ifnull(u.ap_paterno,''),ifnull(u.ap_materno,''),ifnull(u.cargo_actual,''),ifnull(u.ci,'')) LIKE '$busqueda' $baja order by u.cod_user DESC  ";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    //adri
    function listar_usuarios_all($busqueda, $ini, $cant, $baja) {
        if ($baja == "no")
            $baja = " and (estado='Activo' and username NOT LIKE '%BAJA%') ";
        else
            $baja = "";
        $busqueda = "%" . str_replace(" ", "%", $busqueda) . "%";
        // $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select cod_user,nombre,ap_paterno,ap_materno,ci,username,estado, u.cargo_actual, u.ci, u.exp,u.username,u.estado, u.fotografia_actual,u.fh_registro,u.fecha_inicio, u.fecha_nacimiento,u.departamento
                 from usuarios u 
                where concat(ifnull(u.cod_user,''),ifnull(u.username,''),ifnull(u.nombre,''),ifnull(u.ap_paterno,''),ifnull(u.ap_materno,''),ifnull(u.cargo_actual,''),ifnull(u.ci,'')) LIKE '$busqueda' 
                $baja
                order by u.ap_paterno limit $ini,$cant";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return ($consulta->result());
    }

    function listar_usuarios_proyectos_cantidad($busqueda, $id_usuario, $proy_busqueda) {
        //busca los proyectos del usuario seccion
        if ($proy_busqueda == 0) {
            $sql = "select apc.id_proy from admin_proyecto_cargo apc 
                     where apc.id_admin=$id_usuario
                and estado='Activo'";
            $consulta = $this->db->query($sql);
            $proyectos_condicion = "";
            $sw = 1;
            foreach ($consulta->result() as $proyectos) {
                if ($sw == 0) {
                    $proyectos_condicion.=" or ";
                }
                $proyectos_condicion.=" apc.id_proy=" . $proyectos->id_proy;
                $sw = 0;
            }
            if ($sw == 0)
                $proyectos_condicion = " and (" . $proyectos_condicion . ") group by u.cod_user  ";
            // hasta aqui para completar el codigo sql siguiente
        }
        else {
            $proyectos_condicion = " and apc.id_proy=" . $proy_busqueda;
        }

        $busqueda = "%" . str_replace(" ", "%", $busqueda) . "%";
        //$busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select apc.id_proy ,u.* from usuarios u left join admin_proyecto_cargo apc on u.cod_user=apc.id_admin
                where concat(ifnull(u.cargo_actual,''),ifnull(u.cod_user,''),ifnull(u.nombre,''),ifnull(u.ap_paterno,''),ifnull(u.ap_materno,''),ifnull(u.ci,''),ifnull(u.fotografia_actual,'')) LIKE '$busqueda'
                 and u.usuario_contable='SI'  
                 and apc.estado<>'Inactivo'
                 $proyectos_condicion
               
                order by u.ap_paterno";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    //adri
    function listar_usuarios_proyectos($busqueda, $ini, $cant, $id_usuario, $proy_busqueda) {
        //busca los proyectos del usuario seccion
        if ($proy_busqueda == 0) {
            $sql = "select apc.id_proy from admin_proyecto_cargo apc 
                where apc.id_admin=$id_usuario
                and estado='Activo'";
            $consulta = $this->db->query($sql);
            $proyectos_condicion = "";
            $sw = 1;
            foreach ($consulta->result() as $proyectos) {
                if ($sw == 0) {
                    $proyectos_condicion.=" or ";
                }
                $proyectos_condicion.="  apc.id_proy=" . $proyectos->id_proy;
                $sw = 0;
            }
            if ($sw == 0)
                $proyectos_condicion = " and (" . $proyectos_condicion . ")  group by u.cod_user ";
        }
        else {
            $proyectos_condicion = "and apc.id_proy=" . $proy_busqueda;
        }
        // hasta aqui para completar el codigo sql siguiente
        $busqueda = "%" . str_replace(" ", "%", $busqueda) . "%";
        // $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select apc.id_proy ,u.* from usuarios u left join admin_proyecto_cargo apc on u.cod_user=apc.id_admin
              where concat(ifnull(u.cargo_actual,''),ifnull(u.cod_user,''),ifnull(u.nombre,''),ifnull(u.ap_paterno,''),ifnull(u.ap_materno,''),ifnull(u.ci,''),ifnull(u.fotografia_actual,'')) LIKE '$busqueda'
                and u.usuario_contable='SI'   
               and apc.estado<>'Inactivo'
               $proyectos_condicion
               
                order by u.cod_user DESC limit $ini,$cant";
        // echo $sql;
        $consulta = $this->db->query($sql);
        return ($consulta->result());
    }

    function obtener_informacion_apropiacion_usuario($id_usuario) {

        $sql = "select * from admin_proyecto_cargo apc where apc.id_admin=$id_usuario";
        //$resultado = $sql . "<br>";
        $consulta = $this->db->query($sql);
        $resultado= array();
        $hoy = date('Y-m-d');
        $diainimes = date('Y-m-01');
        $diayuda = date("d", (mktime(0, 0, 0, date("m") + 1, 1, date("Y")) - 1));
        $diafinmes = $d13 = date('Y-m-' . $diayuda);

        foreach ($consulta->result() as $reg_proy_admin) {
            //estado  $reg_proy_admin->estado
            $alta = $reg_proy_admin->fecha_asignacion;
            $baja = $reg_proy_admin->fecha_baja;

            if ($reg_proy_admin->estado == "Activo") {
                $ffinal = $hoy;
                $finicial = $alta;

                if ($finicial < $diainimes)
                    $finicial = $diainimes;
            } else {
                $ffinal = $baja;
                $finicial = $alta;
                if ($finicial < $diainimes)
                    $finicial = $diainimes;
                if ($ffinal > $hoy)
                    $ffinal = $hoy;
                if ($ffinal < $diainimes) {
                    $diaanterior = date("Y-m-d", (mktime(0, 0, 0, date('m'), 1, date("Y")) - 1));
                    $ffinal = $diaanterior;
                }
            }
            $segundos = strtotime($ffinal) - strtotime($finicial);
            $diferencia_dias = intval($segundos / 60 / 60 / 24) + 1;
            
            $resultado[$reg_proy_admin->id_proy]= array($finicial, $ffinal, $diferencia_dias);
        }
        return $resultado;
    }

    function resumen_usuario_proyecto($id_usuario, $id_proyecto) {
        //echo $id_proyecto;
        if ($id_proyecto == 0) {
            $sql = "select apc.id_proy from admin_proyecto_cargo apc 
                where apc.id_admin=$id_usuario
                and estado='Activo'";
            $consulta = $this->db->query($sql);

            $proyectos_condicion = "";
            $sw = 1;
            foreach ($consulta->result() as $proyectos) {
                if ($sw == 0) {
                    $proyectos_condicion.=" or ";
                }
                $proyectos_condicion.=" apc.id_proy=" . $proyectos->id_proy;
                $sw = 0;
            }

            if ($sw == 0)
                $proyectos_condicion = " and (" . $proyectos_condicion . ") ";
            // hasta aqui para completar el codigo sql siguiente
        }
        else {
            $proyectos_condicion = " and apc.id_proy=" . $id_proyecto;
        }


        // $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select u.* from usuarios u left join admin_proyecto_cargo apc on u.cod_user=apc.id_admin
                where 1
                 $proyectos_condicion
                and u.usuario_contable='SI' 
                 and apc.estado<>'Inactivo'
                group by u.cod_user 
                order by u.cod_user DESC ";
        // echo $sql;
        $consulta = $this->db->query($sql);
        //echo $consulta->num_rows();
        $dedicado = 0;
        $compartido = 0;
        foreach ($consulta->result() as $registro) {
            $mas_proys = $this->obtProyectoUsuario($registro->cod_user);
            if ($mas_proys->num_rows() > 1)
                $compartido++;
            else
                $dedicado++;
        }

        return($dedicado . "|" . $compartido);
    }

}

?>
