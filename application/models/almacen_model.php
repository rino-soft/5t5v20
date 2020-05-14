
<?php
class almacen_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function listar_almacen_responsable_almacen($id_user) {
        $sql = "select * from almacen_admin aa,almacen a where aa.id_almacen=a.id_almacen and aa.id_usuario=$id_user";
         $consulta = $this->db->query($sql);
        return($consulta);   
    }
    function obtenen_almacen($id_almacen)
    {
        $sql="select * from almacen a where a.id_almacen=".$id_almacen;
        $consulta = $this->db->query($sql);
        return($consulta);   
    }
    function obt_alm_user($id_user_encar) {

        $sql = "select * from  almacen a 
                where a.id_encargado=$id_user_encar";
        $consulta = $this->db->query($sql);
        return($consulta);
    }
    function lista_region_oficinas()
    {
        $sql = "select * from  subregion_oficina s order by s.nombre_region ASC";
                
        $consulta = $this->db->query($sql);
        return($consulta);
    }
}
?>


