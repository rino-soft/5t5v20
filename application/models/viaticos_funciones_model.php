<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of viaticos_funciones_model
 *
 * @author RubenPayrumani
 */
class viaticos_funciones_model extends CI_Model {

    function obtener_cadena_fechas_viaticos($id_user, $hoy) {
        $sql = "SELECT * FROM solicitud_viaticos sv WHERE sv.id_admin=81 and
                sv.fec_salida between DATE_ADD('$hoy', INTERVAL -60 DAY) and    DATE_ADD('$hoy', INTERVAL 20 DAY)";
        $consulta = $this->db->query($sql);
        $cadena = "";
        if ($consulta->num_rows() > 0) {
            foreach ($consulta->result()as $fila) {
                if ($fila->fec_salida != $fila->fec_llegada) 
                    {
                    $fechainf = $fila->fec_salida;
                    $subcadena="";
                    while ($fechainf != $fila->fec_llegada) {
                        $subcadena.=$fechainf.",viatico(".$fila->id_viatico."),";
                        $fecha_new = strtotime('+1 day', strtotime($fechainf));
                        $fechainf = date('Y-m-d', $fecha_new);
                        // echo "<br>".$fechainf."==".$res->ff."*********";
                    }
                    $cadena.=$subcadena;
                }
                else
                    $cadena.=$fila->fec_salida.",";
            }
        }
        return($cadena);
    }
    

}

?>
