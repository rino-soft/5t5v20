<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of prueba_otra_bd
 *
 * @author RubenPayrumani
 */
class prueba_otra_bd extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    function lista_proveedores()
    {
        $conecB=$this->load->database("gco",TRUE);
        $sql="select * from factura_compra where idpk<100";
        $consulta =$conecB->query($sql);
        echo "consultaa <br> ";
        foreach ($consulta->result() as $reg)
        {
            echo "idpk :".$reg->idpk."<br>";
        }       
        $sql2="select * from proyecto where 1";
        $consulta2 =$this->db->query($sql2);
       foreach ($consulta2->result() as $reg)
        {
            echo "id proy :".$reg->id_proy."<br>";
        }
        
    }
    //put your code here
}

?>
