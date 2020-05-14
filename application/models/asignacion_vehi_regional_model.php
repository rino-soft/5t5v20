<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asignacion_vehi_regional_model
 *
 * @author POMA RIVERO
 */
class asignacion_vehi_regional_model extends CI_Model {

    //put your code here
    //function for view Regional
    /* function listar_buscar_asig_regional($busqueda, $ini, $cant) {
      $busqueda = str_replace(" ", "%", $busqueda);
      $sql = "select * from vehiculo ve
      where concat(ve.id_vehiculo,ve.placa,ve.modelo,ve.nro_motor,ve.chasis,ve.traccion,
      ve.capacidad,ve.accesorios,ve.marca,ve.anio,ve.color,ve.tipo,ve.estado,ve.fecha_adquirida) lIKE '%$busqueda%'
      order by ve.id_vehiculo DESC limit  $ini,$cant";
      $consulta = $this->db->query($sql);
      return($consulta);
      } */
    function listar_buscar_vehiculo_regional($busqueda, $ini, $cant) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $id_user_session = $this->session->userdata('id_admin');
        $sql = "
            SELECT *
                FROM asigna_vehiculo_usuario asig, vehiculo v
                WHERE asig.estado_registro='Activo'
                and asig.tipo_asignacion='Responsable'
                and asig.id_responsable=$id_user_session
                
                and asig.id_vehiculo_resp=v.id_vehiculo 
                and CONCAT(v.placa,v.id_vehiculo) LIKE '%$busqueda%'
                ORDER BY asig.id_vehiculo_resp DESC ";
        $consulta = $this->db->query($sql);
        return $consulta;
        // return($consulta->num_rows());
    }

    /* function listar_buscar_asig_regional_cantidad($busqueda) {
      $busqueda = str_replace(" ", "%", $busqueda);

      $sql = "select * from vehiculo ve
      where concat(ve.id_vehiculo,ve.placa,ve.modelo,ve.nro_motor,ve.chasis,ve.traccion,
      ve.capacidad,ve.accesorios,ve.marca,ve.anio,ve.color,ve.tipo,ve.estado,ve.fecha_adquirida) lIKE '%$busqueda%'
      order by ve.id_vehiculo DESC";
      $consulta = $this->db->query($sql);
      return($consulta->num_rows());
      } */

    //new
    function obt_asignaciones_usuarios() {
        $id_user_session = $this->session->userdata('id_admin');
        $sql = " SELECT *
                FROM asigna_vehiculo_usuario asig
                WHERE asig.estado_registro='Activo'
                and asig.tipo_asignacion='Responsable'
                and asig.id_responsable=$id_user_session";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function buscar_vehiculo_estado_asignado_reasignar($id_vehiculo) {
        $sql = "
                select *
                from estado_vehicular est, asigna_vehiculo_usuario asig
                where est.id_vehiculo_est=$id_vehiculo
                and asig.estado_registro='Activo'
                and  asig.id_estado_asig=est.id_estado_vehi
                ORDER BY  est.id_estado_vehi DESC";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    /* function registro_proyecto_taller($id_vehiculo) {
      $sql = "select us.nombre,us.ap_paterno,us.ap_materno
      from asigna_vehiculo_usuario asig,usuarios us
      where asig.tipo_asignacion<>'Responsable'
      and asig.estado_registro='Activo'
      and asig.id_responsable=us.cod_user
      and asig.id_vehiculo_resp=$id_vehiculo";
      //  echo "REG : ".$sql."<br>";
      $consulta = $this->db->query($sql);
      $resul2 = array();
      if ($consulta->num_rows() > 0) {


      // echo "Nacional:".$consulta->num_rows()."<br><br>";
      $resul2[1] = $consulta->row(0)->nombre . ' ' . $consulta->row(0)->ap_paterno . ' ' . $consulta->row(0)->ap_materno;
      } else {
      $resul2[0] = 0;
      $resul2[1] = 'Libre';

      // echo "Nacional: 0";
      }
      return $resul2;
      }
     */

    ///propb
    function registro_proyecto_taller_proyecto($id_vehiculo) {
        // echo 'funcion'.$id_vehiculo;
        $sql = "select *
                from asigna_vehiculo_usuario asig, ciudad c
                where asig.tipo_asignacion<>'Responsable' 
                and asig.estado_registro='Activo'
                and asig.id_ciudad=c.codciudad_pk
                and asig.id_vehiculo_resp=$id_vehiculo";
        // echo "REG : ".$sql."<br>";
        //echo '<br>'.$sql;
        $consulta = $this->db->query($sql);
        $resul2 = array();
        //  echo 'nu rows'.$consulta->num_rows();
        if ($consulta->num_rows() > 0) {
            // echo 'entra'.$consulta->row(0)->tipo_asignacion;
            if ($consulta->row(0)->tipo_asignacion == 'Proyecto') {
                $sql1 = "select us.nombre,us.ap_paterno,us.ap_materno
                      from usuarios us
                      where us.cod_user=" . $consulta->row(0)->id_responsable;
                $consulta2 = $this->db->query($sql1);
                $nombrec = '';
                if ($consulta2->num_rows() > 0) {
                    $nombrec = $consulta2->row(0)->nombre . ' ' . $consulta2->row(0)->ap_paterno . ' ' . $consulta2->row(0)->ap_materno;
                }
                $sql2 = "select proy.nombre
                      from proyecto proy
                      where proy.id_proy=" . $consulta->row(0)->id_proyecto;
                $consulta3 = $this->db->query($sql2);

                if ($consulta3->num_rows() > 0) {
                    $nombrep = $consulta3->row(0)->nombre;
                    $sucursal = $consulta->row(0)->subcentro;
                }
                /* $sql3 = "select c.nombre as nom_ciudad
                  from ciudad c
                  where c.codciudad_pk=" . $consulta->row(0)->id_ciudad;
                  // echo $sql3;
                  $consulta4 = $this->db->query($sql3);
                  if ($consulta4->num_rows() > 0) {
                  $ciudad = $consulta4->row(0)->nom_ciudad;
                  }
                 */


                $resul2[0] = $consulta->row(0)->id_asig_reponsable;
                $resul2[1] = $nombrep;
                $resul2[2] = $nombrec;
                $resul2[3] = $sucursal;
                $resul2[4] = $consulta->row(0)->nombre;
                $resul2[5] = $consulta->row(0)->fecha_hora_devolucion;
                $resul2[6] = $consulta->row(0)->observaciones;
                $resul2[7] = $consulta->row(0)->tipo_asignacion;
            } else {

                // echo 'taler'.$consulta->row(0)->tipo_asignacion;
                $resul2[0] = $consulta->row(0)->id_asig_reponsable;
                $resul2[1] = $consulta->row(0)->nombre_taller;
                $resul2[2] = $consulta->row(0)->nombre_tecnico;
                $resul2[3] = '--';
                $resul2[4] = $consulta->row(0)->nombre;
                $resul2[5] = $consulta->row(0)->fecha_hora_devolucion;
                $resul2[6] = $consulta->row(0)->observaciones;
                $resul2[7] = $consulta->row(0)->tipo_asignacion;
            }
            //$resul2[1]='Libre';
        } else {
            $resul2[0] = 0;
            $resul2[1] = 'Libre';
            $resul2[2] = 'Libre';
            $resul2[3] = 'Libre';
            $resul2[4] = 'Sin asignacion';
            $resul2[5] = 'Libre';
            $resul2[6] = 'Libre';
            $resul2[7] = 'Libre';
        }
        return $resul2;
    }

    /* function registro_proyecto_taller_nombre($id_vehiculo) {
      echo 'asig taller'.$id_vehiculo;
      $sql = " select asig.nombre_taller,asig.nombre_tecnico
      from asigna_vehiculo_usuario asig
      where asig.tipo_asignacion='taller'
      and asig.estado_registro='Activo'
      and asig.id_vehiculo_resp=$id_vehiculo";
      // echo "REG : ".$sql."<br>";
      $consulta = $this->db->query($sql);
      $resul2 = array();
      if ($consulta->num_rows() > 0) {

      // echo "Nacional:".$consulta->num_rows()."<br><br>";
      $resul2[1] = $consulta->row(0)->nombre_tecnico;
      } else {
      $resul2[0] = 0;
      $resul2[1] = '';

      // echo "Nacional: 0";
      }
      return $resul2;
     * 
      } */

    function buscar_subcentro_por_ciudad($id_ciudad) {
        $sql = "select asig.id_ciudad,asig.subcentro
                  from asigna_vehiculo_usuario asig
                  where asig.id_ciudad=$id_ciudad
                  group by asig.subcentro";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function buscar_proyecto_seleccionado($id_asignado) {
        $sql = "   
                 select  pro.nombre
                 from asigna_vehiculo_usuario asig, proyecto pro
                 where asig.id_proyecto=pro.id_proy
                 and asig.id_asig_reponsable=$id_asignado ";
        $consulta = $this->db->query($sql);
        return $consulta->row();
    }

    function obtener_datos($id_vehiculo) {
        $sql = "   
                 select asig.id_asig_reponsable,v.placa
                from asigna_vehiculo_usuario asig, vehiculo v
                where  asig.estado_registro='Activo'
                and asig.id_vehiculo_resp=v.id_vehiculo
                and asig.id_vehiculo_resp=$id_vehiculo ";
        // echo $sql;
        $consulta = $this->db->query($sql);
        $resul = array();
        if ($consulta->num_rows() > 0) {
            $resul[0] = $consulta->row(0)->placa;
        } else {
            $result[0] = '-';
        }
        return $resul;
    }

}

?>
