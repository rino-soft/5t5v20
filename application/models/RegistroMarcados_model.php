<?php

class RegistroMarcados_model extends CI_Model {

    function _construct() {
        parent::Model();
    }

    function datosUsuario($id_pk) {
        $ssql = "SELECT a.cod_user, a.nombre, a.ap_paterno,a.ap_materno, a.ci, a.exp, apc.cargo, a.fecha_inicio FROM usuarios a, admin_proyecto_cargo apc
                WHERE a.cod_user=$id_pk AND a.cod_user=apc.id_admin";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function meses_año_hora($id_pk) {
        $ssql = "SELECT day(marcado) as dia, MONTH(marcado) as mes, YEAR(marcado) as año, TIME(marcado) as hora FROM registro_marcado";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function meses($id_pk) {
        $ssql = "SELECT distinct DATE_FORMAT(marcado, '%m') as mes FROM registro_marcado where id_persona=$id_pk order by mes asc";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function años($id_pk) {
        $ssql = "SELECT distinct YEAR(marcado) as año FROM registro_marcado where id_persona= $id_pk order by año asc";
        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function obfecha($id_pk) {
        $ssql = "SELECT distinct date(marcado) as fecha FROM registro_marcado where id_persona= $id_pk order by fecha asc";

        $resultado = $this->db->query($ssql);
        return $resultado;
    }

    function tipo_horario_dia($id_pk, $dia, $fecha_buscar) {
        $ssql = "SELECT nombre, hora_ingreso_ma, hora_salida_ma, hora_ingreso_ta, hora_salida_ta, id_horario, tolerancia, fec_ini_horario, fec_fin_horario, estado 
                FROM horario h, asig_admin_horario a
                WHERE a.id_persona=$id_pk AND a.dia='$dia' AND a.id_horario=h.pk_horario AND estado='activo'
                AND '$fecha_buscar' BETWEEN a.fec_ini_horario AND a.fec_fin_horario";
        //echo $ssql;
        $resultado = $this->db->query($ssql);
        //echo $ssql."<br/>";
        return $resultado;
    }
    
    function marcado_fecha_usuario($id_pk, $fecha_buscar)
    {
        $ssql = "SELECT id_persona, TIME(marcado) as hora_marcado FROM registro_marcado
                    WHERE DATE(marcado) = '$fecha_buscar' AND id_persona=$id_pk ORDER BY hora_marcado asc";
        //echo "<br>****".$ssql."<br>";
        $resultado = $this->db->query($ssql);
        //echo $ssql."<br/>";
        return $resultado;
    }

    function dia_esFeriado($fecha)
    {
        $ssql = "SELECT * FROM feriado WHERE tipo='Nacional' AND fecha='$fecha'";

        $resultado = $this->db->query($ssql);
        return $resultado;
    }
}

?>
