<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of contabilidad_plan_cuenta_model
 *
 * @author POMA RIVERO
 */
class contabilidad_plan_cuenta_model  extends CI_Model{
    
  
    //put your code here
    function datos_del_plan_de_cuentas(){
      $sql = "select * from plan_de_cuentas";
        $consulta = $this->db->query($sql);
        $row = 0;
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row;  
    }
    
    
    
    function guardar_nuevo_registro(){
         $respuesta = "";
       // date_default_timezone_set("Etc/GMT+4");
        $datos = array(
            'codigo' => $this->input->post('codigo'),
            'titulo' => $this->input->post('titulo'),
            'imputable' => $this->input->post('imputable'),
            'id_padre' => $this->input->post('id_padre'),
            'fh_registro' => date("Y-m-d H:i:s"),
            'comentario' => $this->input->post('comentario'),
        );
        if ($this->input->post('id_plan') == 0) {
            $this->db->insert('plan_de_cuentas', $datos);
            $id_cuenta_nuevo = ($this->db->insert_id());
            //echo $id_user_nuevo;
            $respuesta = "<input type='hidden' id='ayudata' value='$id_cuenta_nuevo'><input type='hidden' id='proceso' value='INSERT'><div class='OK'>Estado:Guardado</div>";
            //echo  $respuesta;
        } else{
             $this->db->where('id_plan_cuenta', $this->input->post('id_plan'));
            $upd = $this->db->update('plan_de_cuentas', $datos);
            if ($upd != 0)
                $respuesta= "<input type='hidden' id='ayudata' value='".$this->input->post('id_plan')."'><input type='hidden' id='proceso' value='UPDATE'>Editado!!!";

        }
        return($respuesta);
    }
    function obtener_cuentas_registradas($padre,$esp)
     {
       $sql="select * from plan_de_cuentas p where p.id_padre=$padre
        order by codigo";
     //  echo $sql.'<br>';
        $consulta=$this->db->query($sql);
        $codigo_padre="";
        $code="";
      // echo $consulta->num_rows();
        if($consulta->num_rows()>0)
            {
            foreach ($consulta->result() as $reg)
                {
                $imp="";
                //$color="";
                
                if($reg->imputable=='no')
                 $imp='negrilla colorverde mayusculas';
                // $color=' ';
                 $codigo_padre.='<div class="grid_20 filas_cu f12 '.$imp.'"><div class="grid_2" ><div class="delete_cuenta milink " style="margin-right:10px" onclick="del_cuenta('.($reg->id_plan_cuenta).')"></div><div class="editarDoc_c milink" onclick="edita_cuenta('.($reg->id_plan_cuenta).')"></div></div><div class="prefix_'.$esp.' grid_'.(18-$esp).'">'.$reg->codigo.' '.$reg->titulo.'</div></div>';
                 $code=$this->obtener_cuentas_registradas($reg->id_plan_cuenta,($esp+1));
                 $codigo_padre.=''.$code;
                }  
            }
            else{
                return $codigo_padre;
            }
            return $codigo_padre;
    }
    
    
    
    
    function datos_del_plan_de_cuentas_select($padre,$esp){
        $sql="select * from plan_de_cuentas p where p.id_padre=$padre";
     //  echo $sql.'<br>';
        $consulta=$this->db->query($sql);
        $codigo_padre="";
        $code="";
      // echo $consulta->num_rows();
        if($consulta->num_rows()>0)
            {
            foreach ($consulta->result() as $reg)
                {
               // echo 'lo q sea';
                 
                 $codigo_padre.='<option value="'.$reg->id_plan_cuenta.'">'.$esp.$reg->codigo.' '.$reg->titulo.'</option>';
                // echo 'cod'.$codigo_padre;
                 $code=$this->datos_del_plan_de_cuentas_select($reg->id_plan_cuenta,$esp."&nbsp;&nbsp;");
                 $codigo_padre.=''.$code;
                }  
            }
            else{
                return $codigo_padre;
            }
            return $codigo_padre;
        
    }
    function del_registro_cuenta($reg)
    {
       $this->db->where('id_plan_cuenta', $reg);
        $this->db->delete('plan_de_cuentas'); 
    }
    function obtener_registro_cuenta($reg){
        $sql="select * from plan_de_cuentas p where p.id_plan_cuenta=$reg";
        $consulta=$this->db->query($sql);
      
        $row = 0;
        if ($consulta->num_rows() > 0) {
            $row = $consulta->row();
        }
        return $row; 
    }
	/// add para rendicion
    
    function seleccionar_tipo_gasto($dat){
        $sql="select *
                from tipo_gasto_rendicion t
                where t.tipo like '$dat'";
      
        $consulta =$this->db->query($sql);
        return $consulta;
    }
    function seleccionar_nombre_tecnico()
    {
        $sql="select * from usuarios u order by u.ap_paterno";
        $consulta=$this->db->query($sql);
        return $consulta;
    }
    
            function obtener_datos_rendicion($id_rendicion){
        $sql="select *
                from reg_form_rendicion reg
                where reg.idreg_ren=$id_rendicion";
      
        $consulta =$this->db->query($sql);
        return $consulta;
    }
    function obtener_detalle_datos_rendicion($id_rendicion){
        $sql="select *
                from reg_form_rendicion_detalle reg , tipo_gasto_rendicion tg
                where tg.idg_transporte=reg.id_tipo_gasto
                and reg.id_reg_rendicion=$id_rendicion";
      
        $consulta =$this->db->query($sql);
        return $consulta;
    }
    
    
        
    
     function guardar_nueva_rendicion_for(){
        $respuesta="";
        $tipo = explode(";", $this->input->post("tipo"));
        $monto = explode(";", $this->input->post("monto"));
        $fac = explode(";", $this->input->post("fac"));
        $f_s = explode(";", $this->input->post("f_s"));
        
        
        $datos = array(
            //'cod_serv_prod' => $this->input->post('cod'),
            'id_proy' => $this->input->post('id_proy'),
           // 'fh_registro' => $this->input->post('f_s'),
            'fh_registro' => $this->input->post('fec_reg'),
            'observacion' => $this->input->post('desc'),
            //'id_tipo_gasto' => $this->input->post('tipo'),
           // 'monto' => $this->input->post('monto'),
           // 'factura' => $this->input->post('fac'),
            'id_usuario' => $this->session->userdata('id_admin'),
            'id_tecnico_asignado' => $this->input->post('id_usu'),
            
        );
        
       
       // echo 'id_servpro '. $this->input->post('id_serv');
        if ($this->input->post('id_rend') == 0) {
            $this->db->insert('reg_form_rendicion', $datos);
            $id_red = ($this->db->insert_id());
            $respuesta = "<input type='hidden' id='ayudata' value='$id_red'><div class='OK'>Rendicion registrada exitosamente!!!</div><input type='hidden' id='proceso' value='INSERT'>";
            
            for($i=0;$i<count($tipo)-1;$i++)
            {
                $datos = array(
                'id_reg_rendicion' => $id_red,
                    'id_tipo_gasto' => $tipo[$i],
                    'monto' => $monto[$i],
                    'nro_fac' => $fac[$i],
                    'c_s_factura' => $f_s[$i]
                );
                $this->db->insert('reg_form_rendicion_detalle', $datos);
                $id_insert_det = ($this->db->insert_id());
                //echo 'result' + $result[$i];
                //  $respuesta = "<input type='hidden' id='ayudata' value='$result[$i]'><input type='hidden' id='proceso' value='INSERT'>";
           
            
           }
        }else{
             $this->db->where('idreg_ren',$this->input->post('id_rend'));
             $udp=$this->db->update('reg_form_rendicion',$datos);
             if ($udp != 0)
                    $respuesta = "<input type='hidden' id='ayudata' value='".$this->input->post('id_rend')."'><div class='OK'>Se ha editado exitosamente!!!</div><input type='hidden' id='proceso' value='UPDATE'>";
             
             $sql="DELETE from reg_form_rendicion_detalle where id_reg_rendicion=".$this->input->post('id_rend'); 
             $consulta =$this->db->query($sql);

             for($i=0;$i<count($tipo)-1;$i++)
            {
                $datos = array(
                'id_reg_rendicion' =>$this->input->post('id_rend'),
                    'id_tipo_gasto' => $tipo[$i],
                    'monto' => $monto[$i],
                    'nro_fac' => $fac[$i],
                    'c_s_factura' => $f_s[$i]
                );
                $this->db->insert('reg_form_rendicion_detalle', $datos);
                $id_insert_det = ($this->db->insert_id());
                //echo 'result' + $result[$i];
                //  $respuesta = "<input type='hidden' id='ayudata' value='$result[$i]'><input type='hidden' id='proceso' value='INSERT'>";
           
            
           }
        }
        return($respuesta);
    
        }
        
        
        
        
        function  obtener_datos_rendicion_guardados($id_rendicion){
           $sql="select reg.*,u.*,p.nombre as nom_proy
                from reg_form_rendicion reg, usuarios u , proyecto p
                where reg.idreg_ren=$id_rendicion
                and p.id_proy=reg.id_proy
               ";
                
        $consulta =$this->db->query($sql);
        return $consulta;
    }
    function obtener_usuario_responsable_registro($id_rendicion){
        $sql="select u.nombre,u.ap_paterno,u.ap_materno 
                from reg_form_rendicion reg, usuarios u
                where reg.idreg_ren=$id_rendicion
                and reg.id_usuario=u.cod_user";
        $consulta =$this->db->query($sql);
        return $consulta;
    }
     function obtener_usuario_tecnico($id_rendicion){
        $sql="select u.nombre,u.ap_paterno,u.ap_materno 
                from reg_form_rendicion reg, usuarios u
                where reg.idreg_ren=$id_rendicion
                and reg.id_tecnico_asignado=u.cod_user";
        $consulta =$this->db->query($sql);
        return $consulta;
    }       
    function obtener_form_tipo($id_rend,$tipo,$csfact)
    {
        $sql="Select reg.id_reg_rendicion,reg.id_tipo_gasto, count(tgr.idg_transporte) as cantidad ,
        reg.c_s_factura, tgr.*,round(sum(reg.monto)*tgr.IVA,2) as IVA_calc,ROUND(sum(reg.monto),2)as total,
        ROUND(ROUND(sum(reg.monto)/(1-(tgr.RC_IVA+tgr.IT+tgr.IUE)),2)*tgr.IUE,2)as IUE_calc,ROUND(ROUND(sum(reg.monto)/(1-(tgr.RC_IVA+tgr.IT+tgr.IUE)),2)*tgr.IT,2)as IT_calc,
        ROUND(ROUND(sum(reg.monto)/(1-(tgr.RC_IVA+tgr.IT+tgr.IUE)),2)*tgr.RC_IVA,2)as RC_IVA_calc , 
        ROUND(sum(reg.monto)/(1-(tgr.RC_IVA+tgr.IT+tgr.IUE)),2) as Neto,
        1-(tgr.RC_IVA+tgr.IT+tgr.IUE) as uno_menos_sum_impuesto

         from reg_form_rendicion_detalle reg, tipo_gasto_rendicion tgr
         where tgr.idg_transporte= reg.id_tipo_gasto
         
          and reg.id_reg_rendicion = $id_rend
          and tgr.tipo='$tipo'       ";
		  if($tipo!="tel")
			  $sql.=" and reg.c_s_factura=$csfact ";
 $sql.=" group by reg.id_tipo_gasto order by tgr.tipo_factura";
        $consulta =$this->db->query($sql);
        return ($consulta);
    }
    
    
    /// adicionando ultimo para la busqueda de solicitudes de rendicion
    function listar_buscar_rendicion_cantidad($busqueda)
    {
         $busqueda=  str_replace(" ", "%", $busqueda);
        
        $sql="select reg.idreg_ren,reg.observacion,reg.fh_registro,p.nombre as nombre_proyecto,p.descripcion, u.nombre,u.ap_paterno,u.ap_materno,u.ci  
              from reg_form_rendicion reg, proyecto p,usuarios u
              where concat(reg.idreg_ren,reg.observacion,p.nombre,u.ci,u.nombre) lIKE '%$busqueda%'
              and p.id_proy=reg.id_proy 
              and reg.id_tecnico_asignado=u.cod_user
              order by reg.idreg_ren DESC";
         $consulta = $this->db->query($sql);
        return($consulta->num_rows());
        
    }
     
     
    function listar_buscar_rendicion($busqueda,$ini,$cant)
    {
         $busqueda=  str_replace(" ", "%", $busqueda);
        $sql="select reg.idreg_ren,reg.observacion,reg.fh_registro,p.nombre as nombre_proyecto,p.descripcion, u.nombre,u.ap_paterno,u.ap_materno,u.ci  
              from reg_form_rendicion reg, proyecto p,usuarios u
              where concat(reg.idreg_ren,reg.observacion,p.nombre,u.ci,u.nombre) lIKE '%$busqueda%'
              and p.id_proy=reg.id_proy 
               and reg.id_tecnico_asignado=u.cod_user
              order by reg.idreg_ren DESC limit $ini,$cant";
         $consulta = $this->db->query($sql);
        return($consulta);
    }
    
    
    
}

?>
