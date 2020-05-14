<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cliente_model
 *
 * @author Ruben
 */
class cliente_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function guardar_cliente_nuevo() {
        $respuesta="";
        $datos = array(
            'razon_social' => $this->input->post('rs'),
            'nit' => $this->input->post('nit'),
            'telefonos' => $this->input->post('tel'),
            'direccion' => $this->input->post('dir'),
            'estado' => "Activo",
            'rubro' => $this->input->post('rub'),
        );
        if ($this->input->post('id_cli') == 0) {
            $this->db->insert('cliente', $datos);
            $id_cli_nuevo = ($this->db->insert_id());
            $respuesta = "<input type='hidden' id='ayudata' value='$id_cli_nuevo'><input type='hidden' id='proceso' value='INSERT'>"
                    . "<div class='OK espaciado'>El Cliente se ha registrado exitosamente...!</div>";
        } else {
            $this->db->where('id_cliente', $this->input->post('id_cli'));
            $upd = $this->db->update('cliente', $datos);
            if ($upd != 0)
                $respuesta= "<input type='hidden' id='ayudata' value='".$this->input->post('id_cli')."'><input type='hidden' id='proceso' value='UPDATE'>"
                    . "<div class='OK espaciado'>El Cliente se ha Editado exitosamente...!</div>";

            
        }
        return($respuesta);
    }
    function buscar_nit() {
        
    }

    function obtener_cliente($id_cliente) {
        $sql = "select * from cliente where id_cliente=$id_cliente";
        $consulta = $this->db->query($sql);
        $row = 0;
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row;
    }

    function busqueda_cliente_mini($nit,$emp) {
        $sql="select * from cliente where concat(nit,razon_social) LIKE '%$nit%$emp%'";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    
    function listar_clientes($cliente) {
        $cliente = "%" . str_replace(" ", "%", $cliente) . "%";
        $sql = "select * from cliente c where concat(c.razon_social,c.nit) LIKE '$cliente' order by c.razon_social";
        $consulta = $this->db->query($sql);
        return ($consulta->result());
    }

    // funciones contactos de Cliente
    function guardar_contacto_nuevo_cliente() {
       $respuesta="";
        $datos = array(
            'id_cliente' => $this->input->post('id_cli'),
            'nom_comp' => $this->input->post('nom_com'),
            'telefonos' => $this->input->post('tel'),
            'cargo' => $this->input->post('cargo'),
            'direccion' => $this->input->post('dir'),
            'estado' => "Activo");
        if($this->input->post('id_cont') != 0){
            
             $this->db->where('id_contacto', $this->input->post('id_cont'));
            $upd = $this->db->update('contacto_cliente', $datos);
            if ($upd != 0)
                $respuesta= "<input type='hidden' id='ayudata' value='$upd'><input type='hidden' id='proceso' value='UPDATE'>";

        }
        else {
            $this->db->insert('contacto_cliente', $datos);
            $id_con_nuevo=$this->db->insert_id();
            $respuesta = "<input type='hidden' id='ayudata' value='$id_con_nuevo'><input type='hidden' id='proceso' value='INSERT'>";
        }
        
        return ($respuesta);
    }
 function obtener_contacto($id_contacto){
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
    
    function listar_clientes_contacto($busqueda, $ini, $cant) {
    $busqueda = str_replace(" ", "%", $busqueda);
    
        $sql_contac='select distinct(cc.id_cliente) from contacto_cliente cc
                    where Concat(cc.nom_comp,cc.cargo)LIKE "%'.$busqueda.'%"';
         $consulta = $this->db->query($sql_contac);
         $cond="";
       if($consulta->num_rows()>0)
       {    
            foreach ($consulta->result()as $c)
            {
                $cond.=" or id_cliente=".$c->id_cliente;
            }   
       } 
       $sql_cliente="select * from cliente c where concat(c.razon_social,c.nit,c.rubro) LIKE '%$busqueda%' $cond Order by c.razon_social limit $ini,$cant";
       $consulta = $this->db->query($sql_cliente);
       return($consulta);
    }
    function listar_clientes_contacto_cantidad($busqueda) {
    $busqueda = str_replace(" ", "%", $busqueda);
    
        $sql_contac='select distinct(cc.id_cliente) from contacto_cliente cc
                    where Concat(cc.nom_comp,cc.cargo)LIKE "%'.$busqueda.'%"';
         $consulta = $this->db->query($sql_contac);
         $cond="";
       if($consulta->num_rows()>0)
       {    
            foreach ($consulta->result()as $c)
            {
                $cond.=" or id_cliente=".$c->id_cliente;
            }   
       } 
       $sql_cliente="select * from cliente c where concat(c.razon_social,c.nit,c.rubro) LIKE '%$busqueda%' $cond Order by c.razon_social ";
       $consulta = $this->db->query($sql_cliente);
       return($consulta->num_rows());
    }
	// adicionado para el modulo de proyecto
	
	////////////adicionado el 11/1/16
     function obtener_inf_cliente(){
        $sql="select c.id_cliente,c.razon_social 
              from cliente c
             ";
      
        $consulta =$this->db->query($sql);
        return $consulta;
    }

}
?>





