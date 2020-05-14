<?php

class destino_model extends CI_Model {

    function devolverDeptos() {
        $sql = "select C.codciudad_pk as id, C.nombre FROM ciudad C";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

    function obtener_provincias_depto($depto) {
        $sql = "select D.id_lugar, D.provincia FROM destinoviaticos D, ciudad C Where D.depto=C.nombre and C.codciudad_pk='$depto'";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

    function obtener_provincias_option($depto) {
        $sql = "select D.id_lugar, D.provincia FROM destinoviaticos D,ciudad C WHERE D.depto=C.nombre AND C.codciudad_pk='$depto'";
        
        $consulta = $this->db->query($sql);
        $codigo = "";
        foreach ($consulta->result() as $reg) {
            $codigo.="<option value='" . $reg->id_lugar . "'>" . $reg->provincia . "</option>";
        }
        $codigo = '<div class="grid_6 letramuyChica " >Provincia:</div>
             <div class="grid_6 "><select id="provincia"><option value="0">seleccione una Provincia...</option>' . $codigo . '</select></div>';
        echo $codigo;
        //return ($codigo);
    }
     function ver_provincia($id)
    {
        $sql = "select dv.id_lugar, dv.depto,dv.provincia from destinoviaticos dv where dv.id_lugar=$id";
        //echo $sql;
        $consulta = $this->db->query($sql);
        if($consulta->num_rows()>0)
        {
        $res['dep']=$consulta->row()->depto;
        $res['prov']=$consulta->row()->provincia;
        }
        else
        {$res['dep']="";
        $res['prov']="";
        }   
        return $res;

    }
    function ver_depto($id)
    {
        
        $sql = "select c.codciudad_pk, c.nombre from ciudad c where c.codciudad_pk=$id";
        
        $consulta = $this->db->query($sql);
        $res['dep']=$consulta->row()->nombre;
        $res['prov']=$consulta->row()->nombre;
        return $res;
    }
    function obtener_provincias($depto) {
        $sql = "select D.id_lugar, D.provincia FROM destinoviaticos D Where id_ciudad='$depto'";
        $consulta = $this->db->query($sql);
        foreach ($consulta->result() as $reg) {
            $data[$reg->id_lugar] = $reg->provincia;
        }
        header('Content-type: application/json');
        echo json_encode($data);
    }
    
    
    function obtener_destinosJSON($codigo_actividad) {
        $sql = "Select L.id as id_L ,C.nombre as Dep ,D.provincia as prov ,L.sitio_especifico as esp, L.actividad_realizar as act
        FROM lugar_trabajo_sav L,ciudad C,destinoviaticos D
        WHERE C.codciudad_pk =L.id_departamento
        and D.id_lugar=L.id_provincia
        and L.id_suv=0
        and L.cod_actividad='$codigo_actividad'";
        $consulta = $this->db->query($sql);
        $i=0;
        foreach ($consulta->result() as $reg) {
            $salida[] = array ( 'nro'=> $i ,'dep'=> $reg->Dep ,'prov'=> $reg->prov ,'esp'=> $reg->esp ,'act'=> $reg->act );
            $i++;
        }
        header('Content-type: application/json');
        echo json_encode($salida);
    }

    function adicionarLugarDetrabajoSAV($cod_Act) {

        if (!empty($_POST)) {
            $datos = array(
                'id_suv' => $this->input->post('id_suv'),
                'area_trabajo' => $this->input->post('area_trabajo'),
                'id_departamento' => $this->input->post('id_departamento'),
                'id_provincia' => $this->input->post('id_provincia'),
                'sitio_especifico' => $this->input->post('sitio_especifico'),
                'actividad_realizar' => $this->input->post('actividad_realizar'),
                'cod_actividad' => $cod_Act
                    
            );

            $this->db->insert('lugar_trabajo_SAV', $datos);
            return $this->mostrardatos($this->input->post('cod_actividad'));
        }
    }
    function eliminarLugardetrabajo(){
        $id=$this->input->post('id_lug');
        $this->db->delete('lugar_trabajo_SAV', array('id' => $id)); 
    }

    function mostrardatos($codigo_actividad) {
        $sql = "Select L.id as id_L ,C.nombre as Dep ,D.provincia as prov ,L.sitio_especifico as esp, L.actividad_realizar as act
        FROM lugar_trabajo_sav L,ciudad C,destinoviaticos D
        WHERE C.codciudad_pk =L.id_departamento
        and D.id_lugar=L.id_provincia
        and L.id_suv=0
        and L.cod_actividad='$codigo_actividad'";
        $consulta = $this->db->query($sql);
        return $consulta;
    }
    
     function ObtenerDestinosSUV ($suv) {
        $sql = "Select L.id as id_L ,C.nombre as Dep ,D.provincia as prov ,L.sitio_especifico as esp, L.actividad_realizar as act
        FROM lugar_trabajo_sav L,ciudad C,destinoviaticos D
        WHERE C.codciudad_pk =L.id_departamento
        and D.id_lugar=L.id_provincia
        and L.id_suv='$suv'";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    
    function EnlazarDestinos($id_sol,$codigo_actividad)
    {
        $sql = "UPDATE lugar_trabajo_sav SET id_suv='$id_sol' WHERE id_suv=0  and cod_actividad='$codigo_actividad'";
        $this->db->query($sql);
      
    } 

}