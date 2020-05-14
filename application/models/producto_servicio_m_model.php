
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
class producto_servicio_m_model extends CI_Model {
    //put your code here
    
    
    function __construct() {
        parent::__construct();
    }
     //todo esto es de almacen model esto debe estar producto servicio
    
    function listar_buscar_serv_pro_cantidad($busqueda)
    {
         $busqueda=  str_replace(" ", "%", $busqueda);
        
        $sql="select * from producto_servicio ma
            where concat(ma.id_serv_pro,ma.cod_serv_prod,ma.id_categoria,ma.nombre_titulo,ma.descripcion,ma.palabras_clave,ma.precio_unitario,ma.unidad_medida,ma.tipo) lIKE '%$busqueda%'
             order by ma.id_serv_pro DESC";
         $consulta = $this->db->query($sql);
        return($consulta->num_rows());
        
    }
     
     
    function listar_buscar_serv_pro($busqueda,$ini,$cant)
    {
         $busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select * from producto_servicio ma
            where concat(ma.id_serv_pro,ma.cod_serv_prod,ma.id_categoria,ma.nombre_titulo,ma.descripcion,ma.palabras_clave,ma.precio_unitario,ma.unidad_medida,ma.tipo) lIKE '%$busqueda%'
             order by ma.id_serv_pro DESC limit $ini,$cant";
         $consulta = $this->db->query($sql);
        return($consulta);
    }
    function obtener_detalle_serv_prod($id_serv_pro)
    {
        $sql="select * from producto_servicio cc
              where cc.id_serv_pro='$id_serv_pro'";
        $consulta = $this->db->query($sql);
        return($consulta);
    }
    
    
        
     function lista_servicio_producto($id_serv_pro) {
        $vectorInformacion = array();
        $sql = "SELECT * FROM producto_servicio cc
            WHERE cc.id_serv_pro='$id_serv_pro'";
        $query = $this->db->query($sql);
        $i = 0;
        foreach ($query->result() as $registro) {
            $vectorInformacion[$i] = Array(
                'cod' => $registro->cod_serv_prod,
                'tipo' => $registro->tipo,
                'cate' => $registro->categoria,
                'nom' => $registro->nombre_titulo,
                'desc' => $registro->descripcion,
                'palbus' => $registro->palabras_clave,
                'uni_med' => $registro->unidad_medida,
                'preref' => $registro->precio_unitario);
            $i++;
        }
        return($vectorInformacion);
    }
   /////hasta aqui de almacen_model
    
    
    
    
    
     function obtener_serv_prod($id_ser_pro) {
        // echo 'esto funciona';
         //echo $id_ser_pro;
        $sql = "select p.*, su.nombre from producto_servicio p left join subcategoria su on  p.id_subcategoria=su.id_subcategoria where  id_serv_pro=$id_ser_pro";
        $consulta = $this->db->query($sql);
       // echo $sql;
        $row = 0;
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row;
    }
    
    /*function guardar_serv_pro_nuevo() {
        $respuesta="";
        $datos = array(
            'cod_serv_prod' => $this->input->post('cod'),
            'tipo' => $this->input->post('tipo'),
            'id_categoria' => $this->input->post('cate'),
            'nombre_titulo' => $this->input->post('nom'),
            'descripcion' => $this->input->post('desc'),
            'palabras_clave' => $this->input->post('palbus'),
            'unidad_medida' => $this->input->post('uni_med'),
            'precio_unitario' => $this->input->post('preref'),
            'respuesta'=>$this->input->post('resp'),
        );
       // echo 'id_servpro '. $this->input->post('id_serv');
        if ($this->input->post('id_serv') == 0) {
            $this->db->insert('producto_servicio', $datos);
            $id_serv_nuevo = ($this->db->insert_id());
            $respuesta = "<input type='hidden' id='ayudata' value='$id_serv_nuevo'><div class='OK'>Se ha registrado exitosamente!!!</div><input type='hidden' id='proceso' value='INSERT'>";
            
        } else {
            $this->db->where('id_serv_pro', $this->input->post('id_serv'));
            $upd = $this->db->update('producto_servicio', $datos);
            if ($upd != 0)
                $respuesta= "<input type='hidden' id='ayudata' value='".$this->input->post('id_serv')."'><div class='OK'>Se ha editado correctamente!!!</div><input type='hidden' id='proceso' value='UPDATE'>";

            
        }
        return($respuesta);
    }*/
    function guardar_serv_pro_nuevo() 
    {
        $respuesta="";
        if ($this->input->post('id_serv') == 0) {
        $datos = array(
            'cod_serv_prod' => $this->input->post('cod'),//codigo que se debe verificar
            'tipo' => $this->input->post('tipo'),
            'id_categoria' => $this->input->post('cate'),
            'id_subcategoria' => $this->input->post('subcate'),
            'nombre_titulo' => $this->input->post('nom'),
            'descripcion' => $this->input->post('desc'),
            'palabras_clave' => $this->input->post('palbus'),
            'unidad_medida' => $this->input->post('uni_med'),
            'precio_unitario' => $this->input->post('preref'),
            'respuesta'=>$this->input->post('resp'),
         );
        }else{
             $datos = array(
            'cod_serv_prod' => $this->input->post('cod'),//codigo que se debe verificar
            'tipo' => $this->input->post('tipo'),
           // 'id_categoria' => $this->input->post('cate'),
           // 'id_subcategoria' => $this->input->post('subcate'),
            'nombre_titulo' => $this->input->post('nom'),
            'descripcion' => $this->input->post('desc'),
            'palabras_clave' => $this->input->post('palbus'),
            'unidad_medida' => $this->input->post('uni_med'),
            'precio_unitario' => $this->input->post('preref'),
            'respuesta'=>$this->input->post('resp'),
        );
        }
        
                    
        if ($this->input->post('id_serv') == 0) {
            
                    $dato=$this->input->post('cod') ;
                    $sql="select *
                          from producto_servicio p
                          where p.cod_serv_prod='$dato'";
                     //echo 'este es la consulta'.$sql;
                     $consulta = $this->db->query($sql);
                     if($consulta->num_rows()>0){
                        //echo 'volver a generar';
                        $respuesta="<input type='hidden' id='' ><div class='NO f12 esparriba10 espabajo10'><span class='f18 negrilla'>ATENCION!!!...</span> El codigo ya existe, Se ha Generado un nuevo codigo, Guarde nuevamente..<script>codigo_generado('cod','cate');</script></div>";
                        return($respuesta);
                                   
                     }else{
                         //echo 'No encontrado';
    
                        $this->db->insert('producto_servicio', $datos);
                        $id_serv_nuevo = ($this->db->insert_id());
                        $respuesta = "<input type='hidden' id='ayudata' value='$id_serv_nuevo'><div class='OK'>Se ha registrado exitosamente!!!</div><input type='hidden' id='proceso' value='INSERT'>";
                    }        
                
                
            
        } else {
            $this->db->where('id_serv_pro', $this->input->post('id_serv'));
            $upd = $this->db->update('producto_servicio', $datos);
            if ($upd != 0)
                $respuesta= "<input type='hidden' id='ayudata' value='".$this->input->post('id_serv')."'><div class='OK'>Se ha editado correctamente!!!</div><input type='hidden' id='proceso' value='UPDATE'>";

            
        }
        return($respuesta);
    }
   
 
    function ver_servicio_producto($id_serv_prod)
    {
        $sql="select * from producto_servicio where id_serv_pro=$id_serv_prod";
        $consulta = $this->db->query($sql);
        $row = 0;
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row;
        
       
    }
   
     function listar_unidad_medida()
    {
       $sql='select distinct unidad_medida as nombre_unidad from producto_servicio where 1 order by unidad_medida asc';
        $consulta = $this->db->query($sql);
        return($consulta);
    }
      function listar_tipo()
    {
       $sql='select distinct tipo from producto_servicio where 1';
        $consulta = $this->db->query($sql);
        return($consulta);
    }
    
      function listar_buscar_detalle_cantidad($busqueda)
    {
        $busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select * from producto_servicio ps 
            WHERE concat(ps.cod_serv_prod,ps.nombre_titulo,ps.descripcion,ps.palabras_clave) LIKE '%$busqueda%'";
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }
    function listar_buscar_detalle_serv($busqueda,$can,$ini)
    {
        $busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select * from producto_servicio ps WHERE concat(ps.cod_serv_prod,ps.nombre_titulo,ps.descripcion,ps.palabras_clave) LIKE '%$busqueda%' limit $ini,$can";
        $consulta = $this->db->query($sql);
        return($consulta);
    }
    
    
    
      
}
?>
