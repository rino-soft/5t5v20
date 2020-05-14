<?php

class historial_jus_per_vac_bm_model extends CI_Model {

    function __construct() {
        
    }

    function obtener_historial_ultimo($jus) {
        $sql = 'select hpf.*, a.nombre , a.ap_paterno 
            from historial_permisos_firma hpf,usuarios a
            WHERE a.cod_user=hpf.id_admin_firma
            AND hpf.id_per_jus=' . $jus . ' 
            ORDER BY hpf.id_his_per DESC';
        $res = $this->db->query($sql)->row();
        if ($res->estado == "Enviado") {
            $ssql = 'select jp.*,a.nombre, a.ap_paterno 
            from justificacion_permiso jp , usuarios a 
            where a.cod_user= jp.id_user_destino
             and jp.id_jus=' . $jus;
           //echo $ssql;
            $res2 = $this->db->query($ssql)->row();
            //echo $res2;
            $resultado = "Enviado a <span class='negrilla'>" . $res2->nombre ." ".$res2->ap_paterno.'</span>';
        }
        else
            $resultado = "$res->estado por <span class='letramuyChica negrilla'>" . $res->nombre ." ".$res->ap_paterno. '</span>';
        return $resultado;
    }

    function adicionar_nuevo_evento($id_justificacion, $evento) {
        //$matriz = $this->basicauth->datosSession();
        date_default_timezone_set("Etc/GMT+4");
        $ahora = date("Y-m-d H:i:s");
        //echo "ingreso a la funcion de guardar un nuevo evento";

        $datos = array(
            'id_per_jus' => $id_justificacion,
            'estado' => $evento,
            'id_admin_firma' => $this->session->userdata('id_admin'),
            'direccion_QR' => $id_justificacion . "_" . $this->session->userdata('id_admin') . "_" . str_replace(":", "", str_replace(" ", "_", $ahora)),
            'fechaHora_evento' => $ahora,
            'comentario' => $this->input->post('comentario')
        );
        //echo "se lleno el array";
        $id = $this->db->insert('historial_permisos_firma', $datos);
        //componer el mensaje con datos 
        $id_ingresado = $this->db->insert_id();
       /* $sql_informacion = "select jp.id_jus,jp.tipo,HPF.id_his_per,HPF.estado, a.codadm_pk, a.nombre, a.apellidos, a.ci ,jp.fecha_elaborado ,hpf.fechaHora_evento
                                        FROM historial_permisos_firma HPF,Administrador a , justificacion_permiso jp
                                        WHERE a.codadm_pk = HPF.id_admin_firma
                                        and a.codadm_pk=jp.id_admin
                                        and jp.id_jus=hpf.id_per_jus 
                                        and jp.id_jus='" . $id_justificacion . "'";*/
        
          $sql_informacion = "select jp.id_jus,jp.tipo,HPF.id_his_per,HPF.estado, a.cod_user, a.nombre, a.ap_paterno, a.ci ,jp.fecha_elaborado ,hpf.fechaHora_evento
                                        FROM historial_permisos_firma HPF,usuarios a , justificacion_permiso jp
                                        WHERE a.cod_user = HPF.id_admin_firma
                                        and jp.id_jus=hpf.id_per_jus 
                                        and jp.id_jus='" . $id_justificacion . "'
                                        ORDER BY HPF.id_his_per DESC ";
        //echo $sql_informacion;
        $resultado = $this->db->query($sql_informacion)->row();
        // echo $resultado->tipo;
        switch ($resultado->tipo) {
            case "Baja Medica":
                $mmm = "Solicitud Baja medica";
                break;
            case "Permiso Vacacion":
                $mmm = "la solicitud de Permiso a cuenta de Vacacion";
                break;
            case "Licencia":
                $mmm = "Solicitud de Licencia sin cargo a Vacacion";
                break;
            case "justificacion":
                $mmm = "Justificacion de Marcado";
                break;
        }

        $nombre_archivo = $resultado->id_jus . "_" . $resultado->id_his_per . "_" . $resultado->cod_user . "_" . str_replace(":", "", str_replace(" ", "_", $resultado->fechaHora_evento));
        $codigoQR = $resultado->nombre . " " . $resultado->ap_paterno . ", " . str_replace("ado", "o", $resultado->estado) . " la " . $mmm . " con CODIGO " . $resultado->id_jus . "-" . $resultado->id_his_per . " en fecha " . $resultado->fechaHora_evento;
        //codigo de Seguridad md5 del nombre concatenado al codigo QR
        $mensaje_retorno = $nombre_archivo . "?" . $codigoQR . " *Codigo de Seguridad >> " . md5($nombre_archivo) . "*";
        //echo $mensaje_retorno;
        if ($id > 0){
             $datos = array(
                 'codigoQR' => $mensaje_retorno );
             $this->db->where('id_his_per', $id_ingresado);
            $this->db->update('historial_permisos_firma', $datos); 
            return ($mensaje_retorno);
            
            }
        else
            return 0;
    }
    function obtenerHistorial_justificacion_firmas($id_jus)
    {
        $sql="select *
        FROM historial_permisos_firma 
        WHERE id_per_jus='$id_jus'";
         $resultado = $this->db->query($sql);
        return $resultado;
    }
    
    

}

?>
