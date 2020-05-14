<?php

class horarios_model extends CI_Model
{

    function _construct()
    {
        parent::Model();
    }

    function datos_horarios()
    {
        $ssql = "select * from horario";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function datos_hora_min()
    {
        $ssql = "SELECT PK_HORARIO, NOMBRE, COMENTARIO, MINUTE(TOLERANCIA) AS tolerancia,
                    HOUR(Hora_ingreso_ma)AS hora_ing_ma,MINUTE(Hora_ingreso_ma)AS min_ing_ma,
                    HOUR(hora_salida_ma) AS hora_sal_ma,MINUTE(hora_salida_ma) AS min_sal_ma,
                    HOUR(hora_ingreso_ta)AS hora_ing_ta,MINUTE(hora_ingreso_ta) AS min_ing_ta,
                    HOUR(hora_salida_ta) AS hora_sal_ta,MINUTE(hora_salida_ta) AS min_sal_ta
                    FROM HORARIO";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function obtHorario_por_id($id)
    {
        $ssql = "SELECT NOMBRE, COMENTARIO, MINUTE(TOLERANCIA) AS tolerancia,
                    HOUR(Hora_ingreso_ma)AS hora_ing_ma,MINUTE(Hora_ingreso_ma)AS min_ing_ma,
                    HOUR(hora_salida_ma) AS hora_sal_ma,MINUTE(hora_salida_ma) AS min_sal_ma,
                    HOUR(hora_ingreso_ta)AS hora_ing_ta,MINUTE(hora_ingreso_ta) AS min_ing_ta,
                    HOUR(hora_salida_ta) AS hora_sal_ta,MINUTE(hora_salida_ta) AS min_sal_ta
                    FROM HORARIO WHERE PK_HORARIO=$id";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function guardar_editar_horario()
    {
        $id = $this->input->post('tipo');
        $datos = array(
            'NOMBRE' => $this->input->post('nombre'),
            'Hora_ingreso_ma' => $this->input->post('hora_ingreso_ma'),
            'hora_salida_ma' => $this->input->post('hora_salida_ma'),
            'hora_ingreso_ta' => $this->input->post('hora_ingreso_ta'),
            'hora_salida_ta' => $this->input->post('hora_salida_ta'),
            'COMENTARIO' => $this->input->post('comentario'),
            'TOLERANCIA' => $this->input->post('tolerancia')
        );
        $this->db->where('PK_HORARIO', $id);
        $this->db->update('horario', $datos);
        $query = $this->db->get_where('horario', $datos);
        if ($query->num_rows() > 0)
            return (1);
        else
            return(0);
    }

    function adicionar_nuevo_horario()
    {
        $datos = array(
            'NOMBRE' => $this->input->post('nombre'),
            'Hora_ingreso_ma' => $this->input->post('hora_ingreso_ma'),
            'hora_salida_ma' => $this->input->post('hora_salida_ma'),
            'hora_ingreso_ta' => $this->input->post('hora_ingreso_ta'),
            'hora_salida_ta' => $this->input->post('hora_salida_ta'),
            'COMENTARIO' => $this->input->post('comentario'),
            'TOLERANCIA' => $this->input->post('tolerancia')
        );
        $this->db->insert('horario', $datos);
        return ($this->db->insert_id());
    }

    //function elborada por ruben payrumani ino 
    // obtiene una fila con los datos del horario asignado a ese dia , segun la fecha

    function obtener_datos_horario_x_fecha($id_admin, $fecha_solicitada)
    {
        $sql_dia = "select case DAYOFWEEK('" . $fecha_solicitada . "') 
                when 1 then 'Domingo'
                when 2 then 'Lunes'
                when 3 then 'Martes'
                when 4 then 'Miercoles'
                when 5 then 'Jueves'
                when 6 then 'Viernes'
                when 7 then 'Sabado'
                end as Dia_semana";
        $res_fecha = $this->db->query($sql_dia)->row()->Dia_semana;

        $sql = "select aah.DIA as dia_semana ,aah.ID_HORARIO,h.NOMBRE,h.Hora_ingreso_ma,h.hora_salida_ma,h.hora_ingreso_ta,h.hora_salida_ta ,h.TOLERANCIA
                from asig_admin_horario aah, horario h 
                where aah.DIA='$res_fecha'
                and h.PK_HORARIO=aah.ID_HORARIO
                and aah.ID_PERSONA='" . $id_admin . "'
                and '" . $fecha_solicitada . "' between aah.fec_ini_horario and aah.fec_fin_horario
                and aah.Estado='activo' ";
        $resultado = $this->db->query($sql);
        return ($resultado);
    }

    function obtener_marcado_x_hora($id_admin, $fecha_solicitada, $hora, $tipo, $tolerancia)
    {
        $result = array();
        $sql = "select TIME(rm.MARCADO)as hora_marcado
                FROM registro_marcado rm
                where rm.ID_PERSONA='$id_admin'
                and DATE(rm.MARCADO)='$fecha_solicitada'
                and TIME(rm.MARCADO) between (ADDTIME('$hora', '-01:00:00'))and (ADDTIME('$hora', '01:00:00'))";
        if ($tipo == "ingreso")
            $sql.=" order by rm.marcado ASC";
        else
            $sql.=" order by rm.marcado DESC";

        $resultado = $this->db->query($sql);
        if ($resultado->num_rows() > 0)
        {
            $m = $resultado->row()->hora_marcado;
            $sql_multa = "select ADDTIME('$m',ADDTIME('-$hora','-$tolerancia')) as multa";
            $res_multa = $this->db->query($sql_multa);
            $multa = $res_multa->row()->multa;
            if (substr($multa, 0, 1) == "-" or $tipo == "salida")
                $result = array('marcado' => $m, 'multa' => '---');
            else
                $result = array('marcado' => $m, 'multa' => $multa);
        }
        else
            $result = array('marcado' => '---', 'multa' => '---');

        return($result);
    }

}

