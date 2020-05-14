<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of oventa_prefactura_model
 *
 * @author RubenPayrumani
 */
class linea_servicio_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //put your code here

    function guardar_registro_linea_servicio_telecom() {

        $respuesta = "";
        // $selec = $this->input->post('tipo_asignacion');
        $id_linea = $this->input->post('id_lin_servicio');
        // echo 'mostrando telef_ta-->'.$telef_ta;
        // echo 'mostrando telef_pro-->'.$telef_pro;
        //echo 'mostrando'.;
        $datos = array(
            'plan_datos' => $this->input->post('datos'),
            'plan_voz' => $this->input->post('voz'),
            'monto_pago_linea' => $this->input->post('pago'),
            'win' => $this->input->post('win'),
            'observaciones' => $this->input->post('observaciones'),
            'contrato' => $this->input->post('contrato'),
            'estado' => $this->input->post('estado'),
            'proveedor' => $this->input->post('proveedor'),
            'servicio' => $this->input->post('tipo'),
            'lugar' => $this->input->post('lugar'),
            'id_ciudad' => $this->input->post('ciudad'),
            'id_personal' => $this->input->post('id_user'),
            'id_proyecto' => $this->input->post('proyect'),
            'aclaracion_user' => $this->input->post('aclaracion')
        );
        if ($id_linea == 0) {
            $datos = array(
                'instancia' => $this->input->post('instacia'),
                'plan_datos' => $this->input->post('datos'),
                'plan_voz' => $this->input->post('voz'),
                'monto_pago_linea' => $this->input->post('pago'),
                'win' => $this->input->post('win'),
                'observaciones' => $this->input->post('observaciones'),
                'contrato' => $this->input->post('contrato'),
                'proveedor' => $this->input->post('proveedor'),
                'servicio' => $this->input->post('tipo'),
                'estado' => $this->input->post('estado'),
                'lugar' => $this->input->post('lugar'),
                'id_ciudad' => $this->input->post('ciudad'),
                'id_personal' => $this->input->post('id_user'),
                'id_proyecto' => $this->input->post('proyect'),
                'aclaracion_user' => $this->input->post('aclaracion')
            );
        }

        if ($id_linea == 0) {
            $this->db->insert('linea_servicio', $datos);
            $id_linea = ($this->db->insert_id());
            $respuesta = "<input type='hidden' id='ayudata' value='$id_linea'><input type='hidden' id='proceso' value='INSERT'><div class='OK'>Se ha ADICIONADO correctamente!!!</div>";
        } else {
            $this->db->where('id_lin_serv', $this->input->post('id_lin_servicio'));
            $upd = $this->db->update('linea_servicio', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_lin_servicio') . "'><input type='hidden' id='proceso' value='Actualizacion' ><div class='OK'>Se ha EDITADO correctamente!!!</div>";
        }
        return($respuesta);
    }

    function listar_buscar_linea_servicio($busqueda, $ini, $cant) {

        $busqueda = str_replace(" ", "%", $busqueda);

        $sql = 'select ls.*, u.nombre,u.ap_paterno, u.ap_materno, u.ci,p.nombre as proyecto ,c.nombre as ciudad, 
                concat(
                if(isnull(ls.instancia),"",ls.instancia)," ",if(isnull(ls.servicio),"",ls.servicio)," ",
                if(isnull(ls.proveedor),"",ls.proveedor)," ",if(isnull(ls.contrato),"",ls.contrato)," ",
                if(isnull(ls.observaciones),"",ls.observaciones)," ",if(isnull(ls.monto_pago_linea),"",ls.monto_pago_linea)," ",
                if(isnull(u.nombre),"",u.nombre)," ",if(isnull(u.ap_paterno),"",u.ap_paterno)," ",
                if(isnull(u.ap_materno),"",u.ap_materno)," ",if(isnull(u.ci),"",u.ci)," ",if(isnull(p.nombre),"",p.nombre)," ",
                if(isnull(c.nombre),"",c.nombre)," ",if(isnull(ls.lugar),"",ls.lugar)
                ) as todo
                from ((linea_servicio ls left join  usuarios u on ls.id_personal=u.cod_user)left join proyecto p on ls.id_proyecto=p.id_proy )
                left join ciudad c on ls.id_ciudad = c.codciudad_pk
                where concat(
                if(isnull(ls.instancia),"",ls.instancia)," ",if(isnull(ls.servicio),"",ls.servicio)," ",
                if(isnull(ls.proveedor),"",ls.proveedor)," ",if(isnull(ls.contrato),"",ls.contrato)," ",
                if(isnull(ls.observaciones),"",ls.observaciones)," ",if(isnull(ls.monto_pago_linea),"",ls.monto_pago_linea)," ",
                if(isnull(u.nombre),"",u.nombre)," ",if(isnull(u.ap_paterno),"",u.ap_paterno)," ",
                if(isnull(u.ap_materno),"",u.ap_materno)," ",if(isnull(u.ci),"",u.ci)," ",if(isnull(p.nombre),"",p.nombre)," ",
                if(isnull(c.nombre),"",c.nombre)," ",if(isnull(ls.lugar),"",ls.lugar)
                )LIKE "%' . $busqueda . '%"
                order by ls.id_lin_serv DESC limit ' . $ini . ',' . $cant;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_buscar_linea_servicio_cantidad($busqueda) {

        $busqueda = str_replace(" ", "%", $busqueda);

        $sql = 'select ls.*, u.nombre,u.ap_paterno, u.ap_materno, u.ci,p.nombre as proyecto ,c.nombre as ciudad, 
                concat(
                if(isnull(ls.instancia),"",ls.instancia)," ",if(isnull(ls.servicio),"",ls.servicio)," ",
                if(isnull(ls.proveedor),"",ls.proveedor)," ",if(isnull(ls.contrato),"",ls.contrato)," ",
                if(isnull(ls.observaciones),"",ls.observaciones)," ",if(isnull(ls.monto_pago_linea),"",ls.monto_pago_linea)," ",
                if(isnull(u.nombre),"",u.nombre)," ",if(isnull(u.ap_paterno),"",u.ap_paterno)," ",
                if(isnull(u.ap_materno),"",u.ap_materno)," ",if(isnull(u.ci),"",u.ci)," ",if(isnull(p.nombre),"",p.nombre)," ",
                if(isnull(c.nombre),"",c.nombre)," ",if(isnull(ls.lugar),"",ls.lugar)
                ) as todo
                from ((linea_servicio ls left join  usuarios u on ls.id_personal=u.cod_user)left join proyecto p on ls.id_proyecto=p.id_proy )
                left join ciudad c on ls.id_ciudad = c.codciudad_pk
                where concat(
                if(isnull(ls.instancia),"",ls.instancia)," ",if(isnull(ls.servicio),"",ls.servicio)," ",
                if(isnull(ls.proveedor),"",ls.proveedor)," ",if(isnull(ls.contrato),"",ls.contrato)," ",
                if(isnull(ls.observaciones),"",ls.observaciones)," ",if(isnull(ls.monto_pago_linea),"",ls.monto_pago_linea)," ",
                if(isnull(u.nombre),"",u.nombre)," ",if(isnull(u.ap_paterno),"",u.ap_paterno)," ",
                if(isnull(u.ap_materno),"",u.ap_materno)," ",if(isnull(u.ci),"",u.ci)," ",if(isnull(p.nombre),"",p.nombre)," ",
                if(isnull(c.nombre),"",c.nombre)," ",if(isnull(ls.lugar),"",ls.lugar)
                )LIKE "%' . $busqueda . '%"
                order by ls.id_lin_serv DESC ';
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function obtener_registro_linea($id_linea) {
        $sql = 'select ls.*, u.nombre,u.ap_paterno, u.ap_materno, u.ci,p.nombre as proyecto ,c.nombre as ciudad                
                from ((linea_servicio ls left join  usuarios u on ls.id_personal=u.cod_user)left join proyecto p on ls.id_proyecto=p.id_proy )
                left join ciudad c on ls.id_ciudad = c.codciudad_pk
                where ls.id_lin_serv=' . $id_linea;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function lista_solo_lineas() {//devuelve la consula de la lista de Todos los numeros
        $sql = 'select * from linea_servicio';
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_registro_linea_x_instancia($instancia) {
        $sql = 'select ls.*, u.nombre,u.ap_paterno, u.ap_materno, u.ci,p.nombre as proyecto ,c.nombre as ciudad                
                from ((linea_servicio ls left join  usuarios u on ls.id_personal=u.cod_user)left join proyecto p on ls.id_proyecto=p.id_proy )
                left join ciudad c on ls.id_ciudad = c.codciudad_pk
                where ls.instancia=' . $instancia;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function guardar_registro_contrato_alquiler() {

        $respuesta = "";
        // $selec = $this->input->post('tipo_asignacion');
        $id_contrato = $this->input->post('id_contrato_alq');
        // echo 'mostrando telef_ta-->'.$telef_ta;
        // echo 'mostrando telef_pro-->'.$telef_pro;
        //echo 'mostrando'.;
        $datos = array(
            'departamento' => $this->input->post('departamento'),
            'Provincia' => $this->input->post('provincia'),
            'latitud' => $this->input->post('latitud'),
            'longitud' => $this->input->post('longitud'),
            'direccion_objeto' => $this->input->post('direccion_obj'),
            'descripcion_obj' => $this->input->post('descripcion_obj'),
            'nombre_c_prop' => $this->input->post('propietario'),
            'ci_prop' => $this->input->post('ci_prop'),
            'telefono' => $this->input->post('telefono'),
            'celular' => $this->input->post('Celular'),
            'direccion_prop' => $this->input->post('direccion_prop'),
            'fec_inicio' => $this->input->post('fec_ini'),
            'duracion' => $this->input->post('duracion'),
            'fec_final' => $this->input->post('fec_fin'),
            'monto_garantia' => $this->input->post('monto_garantia'),
            'pago_mensual' => $this->input->post('monto_mes'),
            'monto_previsto' => $this->input->post('monto_previsto'),
            'agua' => $this->input->post('agua'),
            'luz' => $this->input->post('luz'),
            'tel' => $this->input->post('telefonia'),
            'inter' => $this->input->post('internet'),
            'chequeinfo' => $this->input->post('cheque_dato'),
            'estado_contrato' => $this->input->post('estado')
        );
        if ($id_contrato == 0) {
            $datos = array(
                'departamento' => $this->input->post('departamento'),
                'Provincia' => $this->input->post('provincia'),
                'latitud' => $this->input->post('latitud'),
                'longitud' => $this->input->post('longitud'),
                'direccion_objeto' => $this->input->post('direccion_obj'),
                'descripcion_obj' => $this->input->post('descripcion_obj'),
                'nombre_c_prop' => $this->input->post('propietario'),
                'ci_prop' => $this->input->post('ci_prop'),
                'telefono' => $this->input->post('telefono'),
                'celular' => $this->input->post('Celular'),
                'direccion_prop' => $this->input->post('direccion_prop'),
                'fec_inicio' => $this->input->post('fec_ini'),
                'duracion' => $this->input->post('duracion'),
                'fec_final' => $this->input->post('fec_fin'),
                'monto_garantia' => $this->input->post('monto_garantia'),
                'pago_mensual' => $this->input->post('monto_mes'),
                'monto_previsto' => $this->input->post('monto_previsto'),
                'agua' => $this->input->post('agua'),
                'luz' => $this->input->post('luz'),
                'tel' => $this->input->post('telefonia'),
                'inter' => $this->input->post('internet'),
                'chequeinfo' => $this->input->post('cheque_dato'),
                'estado_contrato' => $this->input->post('estado')
            );
        }

        if ($id_contrato == 0) {
            $this->db->insert('contrato_alquiler', $datos);
            $id_contrato = ($this->db->insert_id());

            $cadena_relacion = $this->input->post('cadena_relacion_proyecto_contrato');
            $vector_cad = explode(";", $cadena_relacion);
            for ($i = 1; $i < count($vector_cad); $i++) {
                $campos_vector = explode("|", $vector_cad[$i]);
                $datos_relacion = array(
                    'id_contrato_fk' => $id_contrato,
                    'id_proyecto_fk' => $campos_vector[0],
                    'participacion' => $campos_vector[1],
                    'costo_participacion' => $campos_vector[2]);
                $this->db->insert('contrato_alq_proyecto', $datos_relacion);
                $id_relacion = ($this->db->insert_id());
            }


            $respuesta = "<input type='hidden' id='ayudata' value='$id_contrato'><input type='hidden' id='proceso' value='INSERT'><div class='OK'>Se ha ADICIONADO correctamente!!!</div>";
        } else {
            $this->db->where('id_contrato', $this->input->post('id_contrato_alq'));
            $upd = $this->db->update('contrato_alquiler', $datos);


            $sql = 'delete from contrato_alq_proyecto           
                    where id_contrato_fk=' . $id_contrato;
            $consulta = $this->db->query($sql);

            $cadena_relacion = $this->input->post('cadena_relacion_proyecto_contrato');
            $vector_cad = explode(";", $cadena_relacion);
            for ($i = 1; $i < count($vector_cad); $i++) {
                $campos_vector = explode("|", $vector_cad[$i]);
                $datos_relacion = array(
                    'id_contrato_fk' => $id_contrato,
                    'id_proyecto_fk' => $campos_vector[0],
                    'participacion' => $campos_vector[1],
                    'costo_participacion' => $campos_vector[2]);
                $this->db->insert('contrato_alq_proyecto', $datos_relacion);
                $id_relacion = ($this->db->insert_id());
            }


            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_contrato_alq') . "'><input type='hidden' id='proceso' value='Actualizacion' ><div class='OK'>Se ha EDITADO correctamente!!!</div>";
        }
        return($respuesta);
    }

    function guardar_datos_archivo($id_contrato, $nom_archivo, $ruta, $tipo1) {

        $respuesta = "";
        $datos = array(
            'id_contrato' => $id_contrato,
            'nombre_arch' => $nom_archivo,
            'tipo' => $tipo1,
            'fecha_arch' => date("Y-m-d H:i:s"),
            'ruta_arch' => $ruta
// sentencia naterior ----------&& $this->input->post('id_devolucion_veh')==$this->input->post('id_asig')
        );

        $this->db->insert('contrato_alq_archivo', $datos);
        $id_ima = ($this->db->insert_id());
        $respuesta = "<input type='hidden' id='ayudata' value='$id_ima'><input type='hidden' id='proceso' value='INSERT'><div class='OK'>Se ha ADICIONADO correctamente!!!</div>";

        return($id_ima);
    }

    function obtener_registro_contrato_alquiler($id_contrato) {
        $sql = 'select *             
                from contrato_alquiler 
                where id_contrato=' . $id_contrato;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_registro_proyecto_contrato_alquiler($id_contrato) {
        $sql = 'select *             
                from contrato_alq_proyecto cap , proyecto p
                where p.id_proy=cap.id_proyecto_fk and id_contrato_fk=' . $id_contrato;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_registro_archivo_contrato_alquiler($id_contrato) {
        $sql = 'select *             
                from contrato_alq_archivo caa 
                where caa.id_contrato=' . $id_contrato;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_buscar_contrato_alquiler($busqueda, $ini, $cant, $proyecto) {

        $parte = "";
        if ($proyecto != 0)
            $parte = " and cap.id_proyecto_fk=$proyecto ";

        $busqueda = str_replace(" ", "%", $busqueda);

        $sql = 'select *
                from (contrato_alquiler ca left join contrato_alq_proyecto cap on ca.id_contrato=cap.id_contrato_fk)
                        left join proyecto p on cap.id_proyecto_fk=p.id_proy
                where   
                concat(
                    if(isnull(ca.id_contrato),"",ca.id_contrato),if(isnull(ca.departamento),"",ca.departamento)," ",if(isnull(ca.Provincia),"",ca.Provincia)," ",
                    if(isnull(ca.direccion_objeto),"",ca.direccion_objeto)," ",if(isnull(ca.nombre_c_prop),"",ca.nombre_c_prop)," ",
                    if(isnull(ca.direccion_prop),"",ca.direccion_prop)," ",if(isnull(ca.estado_contrato),"",ca.estado_contrato)
                    ) LIKE "%' . $busqueda . '%" ' . $parte . ' 
                order by ca.id_contrato DESC
                limit ' . $ini . ',' . $cant;
        // echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_buscar_contrato_alquiler_cantidad($busqueda, $proyecto) {

        $parte = "";
        if ($proyecto != 0)
            $parte = " and cap.id_proyecto_fk=$proyecto ";

        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = 'select *
                from (contrato_alquiler ca left join contrato_alq_proyecto cap on ca.id_contrato=cap.id_contrato_fk)
                        left join proyecto p on cap.id_proyecto_fk=p.id_proy
                where   
                concat(
                    if(isnull(ca.id_contrato),"",ca.id_contrato),if(isnull(ca.departamento),"",ca.departamento)," ",if(isnull(ca.Provincia),"",ca.Provincia)," ",
                    if(isnull(ca.direccion_objeto),"",ca.direccion_objeto)," ",if(isnull(ca.nombre_c_prop),"",ca.nombre_c_prop)," ",
                    if(isnull(ca.direccion_prop),"",ca.direccion_prop)," ",if(isnull(ca.estado_contrato),"",ca.estado_contrato)
                    ) LIKE "%' . $busqueda . '%" ' . $parte . ' 
                order by ca.id_contrato DESC';
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

}

?>
