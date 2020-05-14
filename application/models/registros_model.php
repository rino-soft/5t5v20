<?php

class registros_model extends CI_Model {

    function registrar_valesGasolina() {

        $val = $this->input->post('valor');
        $data = array();
        for ($i = $this->input->post('minimo'); $i <= $this->input->post('maximo'); $i++) {
            $datos = array(
                'nro_vale' => $i . $val,
                'valor' => $val,
                'id_sol' => 0,
                'estado' => "Libre",
                'reg' => $i,
                'fechaReg'=>date("Y-m-d H:i:s")
            );

            $this->db->insert('vale_Gasolina', $datos);
            if ($this->db->_error_message() != "") {
                $data[] = "Nro Vale $i .-" . $this->db->_error_message() . "<br>";
            }
        }
    }

    function asignarvalegasolinausuario($id_sol) {
        $vale100 = $this->input->post('v100');
        $vale50 = $this->input->post('v50');
        if ($vale100 > 0) {
            $object = $this->obtener_vales_monto_libre(100, 0, $vale100);
            foreach($object->result() as $reg)
            {
                $sql="UPDATE vale_gasolina SET id_sol='$id_sol', estado='asignado' where nro_vale='$reg->nro_vale' ";
                $consulta = $this->db->query($sql);
                echo $consulta;
            }
            
        }
        
        if ($vale50 > 0) {
            $object = $this->obtener_vales_monto_libre(50, 0, $vale50);
            foreach($object->result() as $reg)
            {
                $sql="UPDATE vale_gasolina SET id_sol='$id_sol', estado='asignado' where nro_vale='$reg->nro_vale' ";
                $consulta = $this->db->query($sql);
                echo $consulta;
            }
        }
    }

    function obtener_vales_monto_libre($monto, $ini, $cant) {
        $sql = "select * from vale_Gasolina where valor='$monto' and estado='libre' order by fechaReg";
        if ($cant != 0)
            $sql.=" LIMIT $ini , $cant";
        $consulta = $this->db->query($sql);
        return $consulta;
    }
    
    function anularValesGasolinaVector($vector,$monto)
    {
        $where="WHERE ";
        for($i=0;$i<count($vector);$i++){
            if($i<=0)
            {    $where.=" nro_vale='$vector[$i]$monto' ";
                echo $vector[$i].$monto.",";
            }
            else
            {
                $where.=" OR  nro_vale='$vector[$i]$monto' ";
                echo $vector[$i].$monto.",";
            }
        }
        $ahora=date("Y-m-d H:i:s");
        $sql="UPDATE vale_Gasolina SET estado='Anulado', fechaReg='$ahora' ".$where;
        echo $sql;
        $consulta = $this->db->query($sql);
       
    }
    /*function obtener_vales_monto_Anulados($monto, $ini, $cant) {
        $sql = "select * from vale_Gasolina where valor='$monto' and estado='Anulado' order by reg";
        if ($cant != 0)
            $sql.=" LIMIT $ini , $cant";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }*/
    function Listar_Vales_Estado($estado ,$monto, $ini, $cant){
        $sql="Select * FROM vale_Gasolina WHERE estado='$estado' AND valor='$monto' order by fechaReg DESC";
        if ($cant != 0)
            $sql.=" LIMIT $ini , $cant";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    function listar_vales_registro($idReg)
    {
        $sql="Select * FROM vale_Gasolina WHERE  id_sol='$idReg' order by fechaReg DESC";
        $consulta = $this->db->query($sql);
        $vector=array();
        $i=0;
        foreach ($consulta->result() as $fila){
            $vector[$i]="<span class='negrilla negrocolor'>".$fila->reg."</span> / ".$fila->valor;
           // echo ', '.$vector[$i];
              $i++;
        }
        return $vector;
    }
    function obtenerVectorRegValesAsignados($listaAsig){
       $valesvector=array();
       $j=0;
        foreach ($listaAsig as $fila)
        { 
            
            $valesvector[$j]=$this->listar_vales_registro($fila->id);
            $j++;
        }
        return($valesvector);
    }
    

}