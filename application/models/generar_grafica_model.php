<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of generar_grafica_model
 *
 * @author POMA RIVERO
 */
class generar_grafica_model extends CI_Model {

    function buscar_cantidad_vehiculo_asignado() {
        $sql = " select asig.id_asig_reponsable,asig.id_vehiculo_resp,
                 asig.id_ciudad,asig.tipo_asignacion,asig.estado_registro,c.nombre,asig.id_proyecto
                from asigna_vehiculo_usuario asig, ciudad c              
                where asig.tipo_asignacion<>'Responsable'
                and asig.estado_registro='Activo'
                and asig.id_ciudad=c.codciudad_pk";
        echo 'vehiculos asignados' . $sql;
        $consulta = $this->db->query($sql);
        return $consulta->row();
    }

    function contar_cantidad_de_ciudad($id_ciudad) {
        $sql = "select c.codciudad_pk,c.nombre 
              from ciudad c
              where c.codciudad_pk=$id_ciudad";
        // echo $sql;
        $consulta = $this->db->query($sql);
    }

    function listar_vehiculo_estado_activo() {
        $sql = "select * 
              from vehiculo v
              where v.estado='Activo'";
        $consulta = $this->db->query($sql);
        return $consulta;
    }

    function listar_vehiculo_propio_alquilado() {
        $sql = "select count(v.contrato) as cant,v.contrato
                from vehiculo v
                where v.estado='Activo'
                group by v.contrato ";
        $consulta = $this->db->query($sql);

        return $consulta;
    }

    ////////////

    function listado_asignaciones_proyecto() 
    {
        $sql = "select *
               from proyecto pro
               where pro.estado<>'Inactivo'";
        $consulta = $this->db->query($sql);

        $sql3 = "select count(asig.id_proyecto) as cantidad
                 from asigna_vehiculo_usuario asig
                 where asig.estado_registro<>'Inactivo' 
                 and asig.tipo_asignacion='Taller'
                 and asig.id_proyecto=0";
        $consulta3 = $this->db->query($sql3);
        $resultado = array();
        $resultado[0] = array($consulta3->row()->cantidad,0,0);

        $cantidad_total = $consulta3->row()->cantidad;
        if ($consulta->num_rows() > 0) 
         {
            foreach ($consulta->result()as $reg)
              {
                $sql2 = "select count(asig.id_proyecto) as cantidad,v.contrato,asig.id_proyecto
                       from asigna_vehiculo_usuario asig, vehiculo v
                       where asig.estado_registro<>'Inactivo' 
                       and asig.id_proyecto=" . $reg->id_proy."
                       and asig.tipo_asignacion<>'Responsable'   
                       and v.id_vehiculo=asig.id_vehiculo_resp 
                       group by v.contrato";
               // echo $sql2."<br>";
                $consulta2 = $this->db->query($sql2);
                $resultado[$reg->id_proy] = array(0,0,0);
                if($consulta2->num_rows()>0)
                {
                   $vec=array(0,0,0);
                   foreach ($consulta2->result()as $c2)
                        {
                        $vec[0]+=$c2->cantidad;
                        if($c2->contrato=="Propio")
                            $vec[1]=$c2->cantidad;
                       
                        else
                            $vec[2]=$c2->cantidad;

                         }
                $cantidad_total+=$vec[0];
                $resultado[$reg->id_proy] = $vec;
                }
               // echo "--".$vec[0]." | ".$vec[1]." | ".$vec[2]."<br>";
                
              }
        }
        $resultado_final = array();
        if($cantidad_total>0)
            $resultado_final[0] = array("Taller", round(( $resultado[0][0] * 100 / $cantidad_total),2), round(( $resultado[0][0] * 100 / $resultado[0][0]),2),0);
        else
            $resultado_final[0] = array("Taller", 0,0,0);
        $i = 1;
      if($consulta->num_rows()>0){
        foreach ($consulta->result()as $registro) {
           // echo "aquiiiiiii".$registro->id_proy;
          if($cantidad_total>0 && $resultado[$registro->id_proy][0]>0)
             {  
                $resultado_final[$i] = array(
                    $registro->nombre, 
                    round (( $resultado[$registro->id_proy][0] * 100 / $cantidad_total),2),
                    round (( $resultado[$registro->id_proy][1] * 100 /$resultado[$registro->id_proy][0]),2),
                    round (( $resultado[$registro->id_proy][2] * 100 /$resultado[$registro->id_proy][0]),2));
                $i++;
             }
            /* else
                 $resultado_final[$i] = array($registro->nombre,0,0,0);*/
            
          
        }
      }

        return $resultado_final;
    }

    function cantidad_vehiculo_dia_contrato($fecha, $contrato) {
        $sql = "select count(distinct(av.id_vehiculo)) as cantidad from actividad_vehiculo av ,vehiculo v
                    where v.id_vehiculo=av.id_vehiculo
                    and v.contrato LIKE '%$contrato%'   
                    and '$fecha' between av.fecha_act and av.fecha_inac ";
        $consulta = $this->db->query($sql);
        $resultado = $consulta->row()->cantidad;
        return ($resultado);
    }
    
       function buscar_departamento_asignado_proy($id_vehiculo) 
    {
        $sql = " select asig.id_asig_reponsable, ve.id_vehiculo,ve.placa,asig.tipo_asignacion,asig.estado_registro,
               c.nombre as nom_ciudad,asig.id_proyecto
                
              from asigna_vehiculo_usuario asig, vehiculo ve,  ciudad c
              WHERE ve.id_vehiculo=asig.id_vehiculo_resp
              and asig.estado_registro='Activo' 
     
              and asig.id_ciudad=c.codciudad_pk
              and asig.id_vehiculo_resp=$id_vehiculo
              order by asig.id_asig_reponsable DESC ";
        //echo "REG vehiculo id :$id_vehiculo ".$sql."<br>";
        $consulta = $this->db->query($sql);
         $result=array();
        if ($consulta->num_rows() > 0) 
         {
            $fila=$consulta->row();
           
             
              $result[0]=$fila->nom_ciudad;
              $result[1]=$fila->tipo_asignacion;
              $result[2]=$fila->id_proyecto;
              $result[3]=$id_vehiculo;
              if($fila->tipo_asignacion=='Proyecto')
              {
                  $sql2="select *
                        from proyecto pro
                        where pro.id_proy=".$fila->id_proyecto;
                  $consulta2=  $this->db->query($sql2);
                  $result[2]=$consulta2->row()->nombre;
                  $result[3]=$id_vehiculo;
              }
             /* if($fila->tipo_asignacion=='Responsable')
              {
                 $result[2]='Sin asignacion';  
              }*/
              if($fila->tipo_asignacion=='Taller')
              {
                 $result[2]='Taller';  
              }
              
           
        }else{
                    
 
                $result[0]='Sin asignacion';
                $result[1]='Sin asignacion';
                $result[2]='Sin asignacion';  
                $result[3]=$id_vehiculo;  
         
                
        }
          //  echo "desde el modelo". $result[0]." -- ". $result[1]."--". $result[2]."<br>";
        
            return $result ;
    }
    
//        $resultado[0] = array($consulta3->row()->cantidad,0,0);


}

?>
