<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario_model
 *
 * @author Ruben
 */
class pago_proveedor_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function resumen_pagos($id_usuario, $id_proyecto) {
        if ($id_proyecto == 0) {
            $sql = "select apc.id_proy, p.nombre
                    from admin_proyecto_cargo apc , proyecto p
                    where apc.id_admin=$id_usuario
                    and p.id_proy=apc.id_proy and apc.estado='Activo'";
            $consulta = $this->db->query($sql);

            $proyectos_condicion = "";
            $sw = 1;
            foreach ($consulta->result() as $proyectos) {
                if ($sw == 0) {
                    $proyectos_condicion.=" or ";
                }
                $proyectos_condicion.=" dfc.dimension1 LIKE '" . $proyectos->nombre . "'";
                $sw = 0;
            }

            if ($sw == 0)
                $proyectos_condicion = " and (" . $proyectos_condicion . ") ";
            // hasta aqui para completar el codigo sql siguiente
        }
        else {
            $this->load->model('proyecto_model');
            $datos_proyecto = $this->proyecto_model->obtener_datos_proyecto($id_proyecto);
            $proyectos_condicion = "and  dfc.dimension1 LIKE '" . $datos_proyecto->row()->nombre . "'";
        }



        $conecB = $this->load->database("gco", TRUE);


        $sql = "select sum(dfc.importe_bs) as todo
            from ((factura_compra fc left join  detalle_factura_compra dfc on fc.idpk=dfc.id_factura) left join orden_detalle_pago_proveedor odpp on fc.idpk=odpp.idfactura) left join orden_pago_proveedor opp on opp.id=odpp.idpago
            where opp.estado<>-1
            $proyectos_condicion";
        $todo = $conecB->query($sql);

        $sql2 = "select sum(dfc.importe_bs) as pagado
            from ((factura_compra fc left join  detalle_factura_compra dfc on fc.idpk=dfc.id_factura) left join orden_detalle_pago_proveedor odpp on fc.idpk=odpp.idfactura) left join orden_pago_proveedor opp on opp.id=odpp.idpago
            where opp.estado<>1
            $proyectos_condicion";
        $pagado = $conecB->query($sql2);

        $sql3 = "select sum(dfc.importe_bs) as por_pagar
            from ((factura_compra fc left join  detalle_factura_compra dfc on fc.idpk=dfc.id_factura) left join orden_detalle_pago_proveedor odpp on fc.idpk=odpp.idfactura) left join orden_pago_proveedor opp on opp.id=odpp.idpago
            where opp.estado<>0
            $proyectos_condicion";
        $por_pagar = $conecB->query($sql3);

        return($todo->row()->todo . "|" . $pagado->row()->pagado . "|" . $por_pagar->row()->por_pagar);
    }

    function pagar_solpago($sp) {
        $ssp = explode("_", $sp);
        for ($i = 0; $i < count($ssp); $i++) {
            $this->actualizar_sol_pago($ssp[$i]);
            $this->actualizar_factura_compra($ssp[$i]);
        }
    }

    function pagar_rendicion($sp,$monto_cheque) {
        $this->load->model("rendiciones_model");
      
        $ssp = explode("_", $sp);
          
        for ($i = 0; $i < count($ssp); $i++) {
            $rend = $this->rendiciones_model->obtener_datos_rendicion($ssp[$i]);
            if ($rend->row()->tipo_rend == "Reembolso") {
                $this->load->model("caja_chica_model");
                $this->caja_chica_model->actualizar_saldo($rend->row()->id_documento, 'credito', $monto_cheque);
            }
            if ($rend->row()->tipo_rend == "Rendicion") {
                $this->load->model("fondosRendir_model");

                $this->fondosRendir_model->actualizar_fondosRendir($rend->row()->id_documento, 'debito', $monto_cheque);
            }
            echo "<br>pagar rendicion error<br>";
          //  $this->actualizar_rendicion($ssp[$i]);
        }
    }

    function actualizar_sol_pago($sp) {
        echo "orden pago proveedor=" . $sp . "<br>";
        $conecB = $this->load->database("gco", TRUE);

        date_default_timezone_set("Etc/GMT+4");
//        $datos = array(
//            'estado' => 1
//        );
//       
//        $conecB->set('estado', 1);
//        $conecB->where('id', $sp);
//         echo "error al cargar?";
//        $upd = $conecB->update('orden_pago_proveedor');
        $sql = "update orden_pago_proveedor set estado=1 where id=" . $sp;
        $conecB->query($sql);


        echo "error aqui adentro?";

        $sp_r = $this->obtener_sp($sp);

        // $tc = $this->obtener_tc_hoy($sp);

        $datos = array(
            'idproveedor' => $sp_r->row()->idproveedor,
            'fecha' => date('Y-m-d'),
            'idadmin' => 1,
            'monto' => $sp_r->row()->monto,
            'idsucursal' => 3,
            'concepto' => $sp_r->row()->concepto,
            'id_tc' => $sp_r->row()->id_tc,
            'codigo_caja' => "CAJA",
            'idorden_de_pago' => $sp_r->row()->id,
            'saldo' => 0,
            'saldo_usd' => 0,
            'tipo_moneda' => $sp_r->row()->tipo_moneda,
            'nombre_medio_pago' => "cheque",
            'estado' => 0
        );
        $conecB->insert('pago_proveedor', $datos);
        $id_nuevo = ($conecB->insert_id());

        $facturas = $this->obtener_detalle_pago_proveedor($sp);

        foreach ($facturas->result() as $f) {
            $datos = array(
                'idfactura' => $f->idfactura,
                'idpago' => $id_nuevo,
                'importe' => $f->importe,
                'estado' => 0);
            $conecB->insert('detalle_pago_proveedor', $datos);
        }
    }

    function obtener_sp($sp) {
        $conecB = $this->load->database("gco", TRUE);
        $sql = "Select * from orden_pago_proveedor where id=" . $sp;
        $consulta = $conecB->query($sql);
        return($consulta);
    }

    function obtener_detalle_pago_proveedor($sp) {
        $conecB = $this->load->database("gco", TRUE);
        $sql = "Select * from orden_detalle_pago_proveedor where idpago=" . $sp;
        $consulta = $conecB->query($sql);
        return($consulta);
    }

    function obtener_factura_compra($fc) {
        $conecB = $this->load->database("gco", TRUE);
        $sql = "Select * from factura_compra where idpk=" . $fc;
        $consulta = $conecB->query($sql);
        return($consulta);
    }

    function actualizar_factura_compra($sp) {
        $facturas = $this->obtener_detalle_pago_proveedor($sp);
        $conecB = $this->load->database("gco", TRUE);
        foreach ($facturas->result() as $f) {
            $fac = $this->obtener_factura_compra($f->idfactura);
            $nsbs = $fac->row()->saldo_bs - $f->importe;
            $nsusd = $fac->row()->saldo_usd - ($f->importe / 6.96);
            // $upd = $conecB->update('factura_compra', $datos);
            $sql = "update factura_compra set saldo_bs=" . $nsbs . ", saldo_usd=" . $nsusd . " where idpk=" . $f->idfactura;
            $conecB->query($sql);
        }
    }

}
