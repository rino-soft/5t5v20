<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categoria_model
 *
 * @author GHERY
 */
class categoria_model extends CI_Model {
    //put your code here
    
    
    function __construct() {
        parent::__construct();
    }
    function listar_categoria()
    {
       $sql='select * from categoria_serv_prod where 1 order by nombre';
        $consulta = $this->db->query($sql);
        return($consulta);
    }
  
    function guardar_categoria_nuevo() {
        $respuesta="";
        $datos = array(
            'nombre' => $this->input->post('nom'),
            'descripcion' => $this->input->post('desc'),
            'cod_propio' => $this->input->post('cod_pro'),
           
        );
        if ($this->input->post('id_cate') == 0) {
            $this->db->insert('categoria_serv_prod', $datos);
            $id_cat_nuevo = ($this->db->insert_id());
            $respuesta = "<input type='text' id='ayudata' value='$id_cat_nuevo'><input type='hidden' id='proceso' value='INSERT'>";
        } else {
            $this->db->where('id_categoria', $this->input->post('id_cate'));
            $upd = $this->db->update('categoria_serv_prod', $datos);
            if ($upd != 0)
                $respuesta= "<input type='hidden' id='ayudata' value='".$this->input->post('id_cate')."'><input type='hidden' id='proceso' value='UPDATE'>";

            
        }
        return($respuesta);
    }
     function obtener_categoria($id_categoria) {
        $sql = "select * from categoria_serv_prod where id_categoria=$id_categoria";
        $consulta = $this->db->query($sql);
        $row = 0;
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row;
    }
    function listar_cate_buscar_detalle_cantidad($busqueda)
    {
        $busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select * from categoria_serv_prod ps 
            WHERE concat(ps.id_categoria,ps.nombre,ps.descripcion,ps.cod_propio) LIKE '%$busqueda%'
        order by ps.id_categoria asc";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }
    function listar_cate_buscar_detalle_serv($busqueda,$can,$ini)
    {
        $busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select * from categoria_serv_prod ps 
            WHERE concat(ps.id_categoria,ps.nombre,ps.descripcion,ps.cod_propio) LIKE '%$busqueda%' 
            order by ps.id_categoria asc limit $can,$ini";
       
        $consulta = $this->db->query($sql);
        return($consulta);
    }
    
    
    function obtener_cod_gen($id_cat)
    {
       
         $sql = "select * from producto_servicio where id_categoria=$id_cat order By  cod_serv_prod desc";
         $consulta = $this->db->query($sql);
         
        if ($consulta->num_rows()>0) {
            $row = $consulta->row(0)->cod_serv_prod;
            $row=  intval(substr($row,-5)) ;
            $row++;
            $row=  substr('0000'.strval($row),-5);
            
            
        }else{
            $row='00001';
        }
         $sql = "select * from categoria_serv_prod where id_categoria=$id_cat ";
         $consulta = $this->db->query($sql);
         $cat = $consulta->row()->cod_propio;
         $cat=$cat.$row;
         return($cat);
    }
   
     
    //function que obtiene las subcategorias de cada articulo por rubenn 12/10/2016
    
    function obtener_subcategorias_producto_servicio($id_categoria)
    {
        $sql="select * from subcategoria sc where id_categoria=$id_categoria";
        $consulta = $this->db->query($sql);
        return $consulta;
    }
    
    
}

?>
