<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of oventa_prefactura_model
 *
 * @author RubenPayrumani
 */
class nota_fiscal_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function obtener_dosificacion_activa($hoy) {
        $sql = 'select * from dosificacion_factura df where df.estado LIKE "activo"';
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_dosificacion($id_d) {
        $sql = 'select * from dosificacion_factura df where df.id_dosificacion=' . $id_d;

        // echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function actualizar_nro_fac_actual($id_dosificacion, $nro_fac) {
        $datos = array("nro_actual" => $nro_fac);
        $this->db->where('id_dosificacion', $id_dosificacion);
        $upd = $this->db->update('dosificacion_factura', $datos);
    }

    function actualiza_qr_ruta_nf($id_factura, $name, $cc) {
        $datos = array("codigo_qr_name" => $name, "codigo_control" => $cc);
        $this->db->where('id_nf', $id_factura);
        $upd = $this->db->update('nota_fiscal', $datos);
    }

    //put your code here
    function save_nota_fiscal() {
        //$cc=$this->load->library('CodigoControl');
        $this->load->model('codigo_control_model');
        date_default_timezone_set("Etc/GMT+4");
        //modificar esta funcion para hacer el guardado crrespondiente
        $respuesta = "";
        //$ids = explode("|", $this->input->post("ids"));
        //$dosi_fac = $this->obtener_dosificacion_activa('a');
        $dosi_fac = $this->obtener_dosificacion($this->input->post('id_dosificacion'));
        //echo "antes de guardar ok";
        if ($dosi_fac->num_rows() > 0) {
            $id_dosi = $dosi_fac->row()->id_dosificacion;
            $autorizacion = $dosi_fac->row()->nro_autorizacion;
            $nit = $dosi_fac->row()->NIT;
            $fl_emision = $dosi_fac->row()->fl_emision;
            $nro_factura = ($dosi_fac->row()->nro_actual) + 1;
            $llave = $dosi_fac->row()->llave_cod_control;
        } else {
            1; //se puede mostrar error al guardar ya que no existe dosificacion activa
            $autorizacion = 0;
            $nit = 0;
            $fl_emision = 0;
            $nro_factura = 0;
            $llave = 0;
        }

        $fecha_hora = date("Y-m-d H:i:s");
        $fecha_horanameQR = date("Ymd_Hi");
        $fecha = date("Ymd");
        $fechaQR = date("Y/m/d");
        $monto = round(str_replace(',', '.', $this->input->post('totalpf_dev')), 0);
        $montoQR = round(str_replace(',', '.', $this->input->post('totalpf_dev')), 2);

        $nit_cliente = $this->input->post('nit_cli');
        $codCont = $this->codigo_control_model->generar_CodControl_parametros($autorizacion, $nro_factura, $nit_cliente, $fecha, $monto, $llave);
        $intentos = 0;
        $controlcod = "";
        echo "<br> cantidad de digitos :" . strlen($codCont) . "<br> codigo inicial : " . $codCont;
        while (strlen($codCont) > 14 and $intentos < 500) {
            $controlcod.= "intentos [$intentos]=" . $codCont . "<br>";
            $codCont = $this->codigo_control_model->generar_CodControl_parametros($autorizacion, $nro_factura, $nit_cliente, $fecha, $monto, $llave);
            $intentos++;
        }
        echo "<br> desc ".$this->input->post("descs")."<br>";
        $descs = explode("|", $this->input->post("descs"));
        $cants = explode("|", $this->input->post("cants"));
        $pus = explode("|", $this->input->post("pus"));
        $subs = explode("|", $this->input->post("subs"));
        
        $descs_dev = explode("|", $this->input->post("descs_dev"));
        $cants_dev = explode("|", $this->input->post("cants_dev"));
        $pus_dev = explode("|", $this->input->post("pus_dev"));
        $subs_dev = explode("|", $this->input->post("subs_dev"));
        
        echo "<br>desc Dev ".$this->input->post("descs_dev")."<br>";
        
        
        $cadenaQR = $nit . "|" . $nro_factura . "|" . $autorizacion . "|" . $fechaQR . "|" . $montoQR . "|" . $montoQR . "|" . $codCont . "|" . $nit_cliente . "|0|0|0|0 ";
        //**********

        

        $datos = array(
            'num_factura' => $nro_factura,
            'id_dosificacion' => $id_dosi,
            'id_user_created' => $this->session->userdata('id_admin'),
            'fh_registro' => $fecha_hora,
            'id_cliente' => $this->input->post('id_cli'),
            'id_proyecto' => $this->input->post('id_proyecto'),
            'id_contrato' => $this->input->post('contrato'),
            'subtotal_bs' => $this->input->post('totalpf'),
            'monto_total_bs' => $this->input->post('totalpf'),
            'monto_devolucion' => $this->input->post('totalpf_dev'),
            'saldo_a_cobrar' => $this->input->post('totalpf'),
            'descuento_bs' => 0,
            'monto_cobrado' => 0,
            'estado' => 'Valido',
            'nit_cliente' => $nit_cliente,
            'razon_social' => $this->input->post('razon_social'),
            'comentario' => $this->input->post('coment_gral'),
            'factura_original' => $this->input->post('nro_fac_org'),
            'autorizacion_original' => $this->input->post('nro_autorizacion'),
            'fecha_original' => $this->input->post('fecha_emision'),
            'iteraciones_codigo_control' => $controlcod
        );

        if ($this->input->post('id_ov_pf') == 0) {
            $this->db->insert('nota_fiscal', $datos);
            $id_insert = ($this->db->insert_id());
            //proceso para dal alta de detalle
            $nombre_QR = $id_insert . '_' . $nro_factura . "_" . $fecha_horanameQR;

            $this->load->model('qr_cod_model');
            $this->qr_cod_model->generar_QR_nota_fiscal($nombre_QR . "?" . $cadenaQR);
            $this->actualizar_nro_fac_actual($id_dosi, $nro_factura);
            $this->actualiza_qr_ruta_nf($id_insert, $nombre_QR, $codCont);
            //echo "que paso<br>".count($descs);
            for ($i = 1; $i < count($descs); $i++) {
                $datos = array(
                    'id_nf' => $id_insert,
                    // 'id_prod_serv'=>$ids[$i],
                    // 'cod_ps'=>$cods[$i],
                    // 'titulo_ps'=>$tits[$i],
                    'detalle_ps' => $descs[$i],
                    // 'comentario'=>$coments[$i],
                    'precio' => $pus[$i],
                    'cantidad' => $cants[$i],
                    'importe' => $subs[$i],
                    'item' => $i,
                    'tipo_detalle'=>'original'
                );
                $result[$i] = $this->db->insert('nota_fiscal_detalle', $datos);
                echo "<br>PASO HASTA AQUI<br>";
            }
            for ($i = 1; $i < count($descs_dev); $i++) {
                $datos = array(
                    'id_nf' => $id_insert,
                    // 'id_prod_serv'=>$ids[$i],
                    // 'cod_ps'=>$cods[$i],
                    // 'titulo_ps'=>$tits[$i],
                    'detalle_ps' => $descs_dev[$i],
                    // 'comentario'=>$coments[$i],
                    'precio' => $pus_dev[$i],
                    'cantidad' => $cants_dev[$i],
                    'importe' => $subs_dev[$i],
                    'item' => $i,
                    'tipo_detalle'=>'devolucion'
                );
                $result[$i] = $this->db->insert('nota_fiscal_detalle', $datos);
                echo "<br>PASO HASTA AQUI 2<br>";
            }
            $respuesta = "<input type='hidden' id='ayudata' value='$id_insert'><div class='OK'>Nota Fiscal exitosamente!!!</div><input type='hidden' id='proceso' value='INSERT'>";
            return($respuesta);
        } else {

            $segu = $this->input->post('comentarios_seguimiento_old');
            if ($this->input->post('comentarios_seguimiento') != "")
                $segu = $this->input->post('comentarios_seguimiento_old') . "-" . $fecha_hora . " >> " . $this->input->post('comentarios_seguimiento') . "*";
            $datos = array(
                'id_proyecto' => $this->input->post('id_proyecto'),
                'id_contrato' => $this->input->post('contrato'),
                'estado' => 'Valido',
                'comentario' => $this->input->post('coment_gral'),
               
            );
            $this->db->where('id_nf', $this->input->post('id_ov_pf'));
            $upd = $this->db->update('nota_fiscal', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_ov_pf') . "'><input type='hidden' id='proceso' value='UPDATE'>";
        }

        return($respuesta);
    }

    function anular_factura($id_factura) {

        $datos = array(
            'estado' => 'Anulado',
            'comentario' => $this->input->post('coment_gral')
        );
        $this->db->where('id_factura', $id_factura);
        $respuesta = "<div class='NO espaciado'>ERROR en la Actualizacion !!! </div><input type='hidden' id='ayudata' value='$id_factura'><input type='hidden' id='proceso' value='ERROR de UPDATE'>";
        $upd = $this->db->update('factura_venta', $datos);
        if ($upd != 0)
            $respuesta = "<div class='OK espaciado'>Actualizacion realizada con EXITO!! </div><input type='hidden' id='ayudata' value='$id_factura'><input type='hidden' id='proceso' value='UPDATE'>";
        return($respuesta);
    }

    function listar_buscar_nota_fiscal_cantidad($busqueda, $de, $ha) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $sql = "select * from nota_fiscal fv ,cliente C,usuarios U 
            where fv.id_cliente=C.id_cliente 
            and U.cod_user=fv.id_user_created
            and concat(fv.id_nf,fv.monto_devolucion,fv.comentario,fv.id_contrato,C.razon_social,C.nit) lIKE '%$busqueda%'
                and fv.fh_registro between '" . $de . "' and '" . $ha . "'
             order by fv.id_nf DESC";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta->num_rows());
    }

    function listar_buscar_nota_fiscal($busqueda, $ini, $cant, $de, $ha) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $busqueda = str_replace("_", "", $busqueda);
        $sql = "select * from nota_fiscal fv ,cliente C,usuarios U 
            where fv.id_cliente=C.id_cliente 
            and U.cod_user=fv.id_user_created
            and concat(fv.id_nf,fv.monto_devolucion,fv.comentario,fv.id_contrato,C.razon_social,C.nit) lIKE '%$busqueda%'
                and fv.fh_registro between '" . $de . "' and '" . $ha . "'
             order by fv.id_nf DESC limit $ini,$cant";
        //echo $sql;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function listar_buscar_factura_venta_no_restringido($busqueda, $de, $ha) {

        $busqueda = str_replace(" ", "%", $busqueda);
        $de = str_replace("-", "/", $de);
        $ha = str_replace("-", "/", $ha);
        $sql = "select *,fv.fh_registro as fec_reg , fv.estado as est_factura ,df.nro_autorizacion
from factura_venta fv ,cliente C,usuarios U ,dosificacion_factura df
            where fv.id_cliente=C.id_cliente 
            and df.id_dosificacion=fv.id_dosificacion

            and U.cod_user=fv.id_user_created
            and concat(fv.id_factura,fv.monto_total_bs,fv.comentario,fv.id_contrato,C.razon_social,C.nit) lIKE '%$busqueda%'
                and fv.fh_registro between '" . $de . "' and ADDDATE('" . $ha . "', INTERVAL 1 DAY)
             order by fv.id_factura";
        $consulta = $this->db->query($sql);
        // echo "<script >alert(".$sql.");<script>";
        return($consulta);
    }

    function listar_buscar_factura_venta_no_restringido_sql($busqueda, $de, $ha) {
        $busqueda = str_replace(" ", "%", $busqueda);
        $de = str_replace("-", "/", $de);
        $ha = str_replace("-", "/", $ha);
        $sql = "select *,fv.fh_registro as fec_reg , fv.estado as est_factura from factura_venta fv ,cliente C,usuarios U 
            where fv.id_cliente=C.id_cliente 
            and U.cod_user=fv.id_user_created
            and concat(fv.id_factura,fv.monto_total_bs,fv.comentario,fv.id_contrato,C.razon_social,C.nit) lIKE '%$busqueda%'
                and fv.fh_registro between '" . $de . "' and '" . $ha . "'
             order by fv.id_factura";
        //$consulta = $this->db->query($sql);
        //echo "<script >alert(".$sql.");<script>";
        return($sql);
    }

    function num_letra($num, $fem = false, $dec = true) {
//if (strlen($num) > 14) die("El n?mero introducido es demasiado grande"); 
        $matuni[2] = "dos";
        $matuni[3] = "tres";
        $matuni[4] = "cuatro";
        $matuni[5] = "cinco";
        $matuni[6] = "seis";
        $matuni[7] = "siete";
        $matuni[8] = "ocho";
        $matuni[9] = "nueve";
        $matuni[10] = "diez";
        $matuni[11] = "once";
        $matuni[12] = "doce";
        $matuni[13] = "trece";
        $matuni[14] = "catorce";
        $matuni[15] = "quince";
        $matuni[16] = "dieciseis";
        $matuni[17] = "diecisiete";
        $matuni[18] = "dieciocho";
        $matuni[19] = "diecinueve";
        $matuni[20] = "veinte";
        $matunisub[2] = "dos";
        $matunisub[3] = "tres";
        $matunisub[4] = "cuatro";
        $matunisub[5] = "quin";
        $matunisub[6] = "seis";
        $matunisub[7] = "sete";
        $matunisub[8] = "ocho";
        $matunisub[9] = "nove";

        $matdec[2] = "veint";
        $matdec[3] = "treinta";
        $matdec[4] = "cuarenta";
        $matdec[5] = "cincuenta";
        $matdec[6] = "sesenta";
        $matdec[7] = "setenta";
        $matdec[8] = "ochenta";
        $matdec[9] = "noventa";
        $matsub[3] = 'mill';
        $matsub[5] = 'bill';
        $matsub[7] = 'mill';
        $matsub[9] = 'trill';
        $matsub[11] = 'mill';
        $matsub[13] = 'bill';
        $matsub[15] = 'mill';
        $matmil[4] = 'millones';
        $matmil[6] = 'billones';
        $matmil[7] = 'de billones';
        $matmil[8] = 'millones de billones';
        $matmil[10] = 'trillones';
        $matmil[11] = 'de trillones';
        $matmil[12] = 'millones de trillones';
        $matmil[13] = 'de trillones';
        $matmil[14] = 'billones de trillones';
        $matmil[15] = 'de billones de trillones';
        $matmil[16] = 'millones de billones de trillones';

        $num = trim((string) @$num);
        echo "trim_num" . $num . "<br>";
        if ($num[0] == '-') {
            $neg = 'menos ';
            $num = substr($num, 1);
        } else
            $neg = '';
        while ($num[0] == '0')
            $num = substr($num, 1);
        echo "num[0]" . $num[0] . "<br>";
        if ($num[0] < '1' or $num[0] > 9)
            $num = '0' . $num;
        $zeros = true;
        $punt = false;
        $ent = '';
        $fra = '';
        for ($c = 0; $c < strlen($num); $c++) {
            echo "entra for";
            $n = $num[$c];
            if (!(strpos(".,'''", $n) === false)) {
                if ($punt)
                    break;
                else {
                    $punt = true;
                    continue;
                }
            } elseif (!(strpos('0123456789', $n) === false)) {
                if ($punt) {
                    if ($n != '0')
                        $zeros = false;
                    $fra .= $n;
                } else
                    $ent .= $n;
            } else
                break;
        }
        $ent = '     ' . $ent;
        if ($dec and $fra and ! $zeros) {
            $fin = ' coma';
            for ($n = 0; $n < strlen($fra); $n++) {
                if (($s = $fra[$n]) == '0')
                    $fin .= ' cero';
                elseif ($s == '1')
                    $fin .= $fem ? ' una' : ' un';
                else
                    $fin .= ' ' . $matuni[$s];
            }
        } else
            $fin = '';
        if ((int) $ent === 0)
            return 'Cero ' . $fin;
        $tex = '';
        $sub = 0;
        $mils = 0;
        $neutro = false;
        echo "<br>" . $ent . "ojo<br>";
        while (($num = substr($ent, -3)) != '   ') {
            $ent = substr($ent, 0, -3);
            echo "<br> nummmm" . $num . "<br>";
            if (++$sub < 3 and $fem) {
                $matuni[1] = 'una';
                $subcent = 'as';
            } else {
                $matuni[1] = $neutro ? 'un' : 'uno';
                $subcent = 'os';
            }
            $t = '';
            $n2 = substr($num, 1);
            if ($n2 == '00') {
                
            } elseif ($n2 < 21)
                $t = ' ' . $matuni[(int) $n2];
            elseif ($n2 < 30) {
                $n3 = $num[2];
                if ($n3 != 0)
                    $t = 'i' . $matuni[$n3];
                $n2 = $num[1];
                $t = ' ' . $matdec[$n2] . $t;
            }else {
                $n3 = $num[2];
                if ($n3 != 0)
                    $t = ' y ' . $matuni[$n3];
                $n2 = $num[1];
                $t = ' ' . $matdec[$n2] . $t;
            }
            $n = $num[0];
            if ($n == 1) {
                echo $ent . "==100";
                if ($num == 100) {
                    $t = ' cien' . $t;
                    echo $ent . "<br>";
                } else {
                    $t = ' ciento' . $t;
                }
                echo $t . "<br>";
            } elseif ($n == 5) {
                $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
            } elseif ($n != 0) {
                $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
            }
            if ($sub == 1) {
                
            } elseif (!isset($matsub[$sub])) {
                if ($num == 1) {
                    $t = ' un mil';
                } elseif ($num > 1) {
                    $t .= ' mil';
                }
            } elseif ($num == 1) {
                //Antes $t .= ' ' . $matsub[$sub] . '?n'; lo modifique a 'ón'
                $t .= ' ' . $matsub[$sub] . 'ón';
            } elseif ($num > 1) {
                $t .= ' ' . $matsub[$sub] . 'ones';
            }
            if ($num == '000')
                $mils++;
            elseif ($mils != 0) {
                if (isset($matmil[$sub]))
                    $t .= ' ' . $matmil[$sub];
                $mils = 0;
            }
            $neutro = true;
            $tex = $t . $tex;
        }
        $tex = $neg . substr($tex, 1) . $fin;
        echo $tex;
        return ucfirst($tex);
    }

    function obtener_detalle_ovpf($id_ovpf) {
        $sql = "select * from ov_pf_detalle where id_ovpf=$id_ovpf";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_ovpf($ovpf) {

        $sql = "select * from oventa_prefactura OVPF ,cliente C ,usuarios U 
            where OVPF.id_cliente=C.id_cliente 
            and U.cod_user=OVPF.id_user_created
            and id_ovpf=$ovpf ";
        echo 'consulta de cliente' . $sql;
        $consulta = $this->db->query($sql);
        return($consulta->row());
    }

    function obtener_nota_fiscal($id_nf) {
        $sql = "select * from nota_fiscal nf where nf.id_nf=$id_nf";
        $consulta = $this->db->query($sql);
        return($consulta->row());
    }

    function obtener_factura_venta_bloque($bloque) {
        $bloque = substr($bloque, 1);
        $ids_factura = str_replace("-", " or fv.id_factura=", $bloque);
        $sql = "select * from factura_venta fv where fv.id_factura= $ids_factura";
        //echo $sql."<br>";
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_detalle_nota_fiscal($id_nf,$tipo) {
        $sql = "select * from nota_fiscal_detalle nfd where nfd.id_nf=$id_nf and nfd.tipo_detalle LIKE '$tipo'" ;
        $consulta = $this->db->query($sql);
        return($consulta);
    }

    function obtener_glosa_factura_texto($id_factura) {
        $sql = "select * from factura_venta_detalle fvd where fvd.id_factura=$id_factura";
        $consulta = $this->db->query($sql);
        $detalle_factura = "";
        foreach ($consulta->result() as $detalle) {
            $detalle_factura.=$detalle->detalle_ps . "(Bs.-" . $detalle->importe . ")\n";
        }
        return($detalle_factura);
    }

    function save_cobro_factura_venta() {
        //$cc=$this->load->library('CodigoControl');
        $this->load->model('codigo_control_model');
        date_default_timezone_set("Etc/GMT+4");
        //modificar esta funcion para hacer el guardado crrespondiente
        $respuesta = "";
        //$ids = explode("|", $this->input->post("ids"));
        //$dosi_fac = $this->obtener_dosificacion_activa('a');
        $dosi_fac = $this->obtener_dosificacion($this->input->post('id_dosificacion'));
        //echo "antes de guardar ok";
        if ($dosi_fac->num_rows() > 0) {
            $id_dosi = $dosi_fac->row()->id_dosificacion;
            $autorizacion = $dosi_fac->row()->nro_autorizacion;
            $nit = $dosi_fac->row()->NIT;
            $fl_emision = $dosi_fac->row()->fl_emision;
            $nro_factura = ($dosi_fac->row()->nro_actual) + 1;
            $llave = $dosi_fac->row()->llave_cod_control;
        } else {
            1; //se puede mostrar error al guardar ya que no existe dosificacion activa
            $autorizacion = 0;
            $nit = 0;
            $fl_emision = 0;
            $nro_factura = 0;
            $llave = 0;
        }

        $fecha_hora = date("Y-m-d H:i:s");
        $fecha_horanameQR = date("Ymd_Hi");
        $fecha = date("Ymd");
        $fechaQR = date("Y/m/d");
        $monto = round(str_replace(',', '.', $this->input->post('totalpf')), 0);
        $montoQR = round(str_replace(',', '.', $this->input->post('totalpf')), 2);

        $nit_cliente = $this->input->post('nit_cli');
        $codCont = $this->codigo_control_model->generar_CodControl_parametros($autorizacion, $nro_factura, $nit_cliente, $fecha, $monto, $llave);
        $intentos = 0;
        $controlcod = "";
        echo "<br> cantidad de digitos :" . strlen($codCont) . "<br> codigo inicial : " . $codCont;
        while (strlen($codCont) > 14 and $intentos < 100) {
            $controlcod.= "intentos [$intentos]=" . $codCont . "<br>";
            $codCont = $this->codigo_control_model->generar_CodControl_parametros($autorizacion, $nro_factura, $nit_cliente, $fecha, $monto, $llave);
            $intentos++;
        }


        //$cods = explode("|", $this->input->post("cods"));
        //$tits = explode("|", $this->input->post("tits"));
        $descs = explode("|", $this->input->post("descs"));
        //$coments = explode("|", $this->input->post("coments"));
        $cants = explode("|", $this->input->post("cants"));
        //$ums = explode("|", $this->input->post("ums"));
        $pus = explode("|", $this->input->post("pus"));
        $subs = explode("|", $this->input->post("subs"));

        //datos para adicionar datos de inicio
        //cadena QR
        //echo "datos--->>".$this->input->post('id_cli').",".$this->input->post('totalpf').", ".$this->input->post('coment_gral');
        //echo "<br>".$codCont."<br>";    
        //$cadenaQR = $nit . "|" . $nro_factura . "|" . $autorizacion . "|" . $fechaQR . "|" . $this->input->post('totalpf') . "|" . $this->input->post('totalpf') . "|" . $codCont . "|" . $nit_cliente . "|0|0|0|0 ";
        $cadenaQR = $nit . "|" . $nro_factura . "|" . $autorizacion . "|" . $fechaQR . "|" . $montoQR . "|" . $montoQR . "|" . $codCont . "|" . $nit_cliente . "|0|0|0|0 ";
        //**********



        $datos = array(
            'num_factura' => $nro_factura,
            'id_dosificacion' => $id_dosi,
            'id_user_created' => $this->session->userdata('id_admin'),
            'fh_registro' => $fecha_hora,
            'id_cliente' => $this->input->post('id_cli'),
            'id_proyecto' => $this->input->post('id_proyecto'),
            'id_contrato' => $this->input->post('contrato'),
            'subtotal_bs' => $this->input->post('totalpf'),
            'monto_total_bs' => $this->input->post('totalpf'),
            'saldo_a_cobrar' => $this->input->post('totalpf'),
            'descuento_bs' => 0,
            'monto_cobrado' => 0,
            'estado' => 'Valido',
            'nit_cliente' => $nit_cliente,
            'razon_social' => $this->input->post('razon_social'),
            'comentario' => $this->input->post('coment_gral'),
            'iteraciones_codigo_control' => $controlcod,
            'penalidad' => $this->input->post('penalidad'),
            'comentarios_penalidad' => $this->input->post('comentario_penalidad'),
            'tipo_trabajo' => $this->input->post('tipo_factura'),
            'fecha_prevista_cobro' => $this->input->post('fecha_prov_pago'),
            'comentarios_seguimiento' => $fecha_hora . " >> Factura Registrada - " . $this->input->post('comentarios_seguimiento') . "*"
        );

        if ($this->input->post('id_ov_pf') == 0) {
            $this->db->insert('factura_venta', $datos);
            $id_insert = ($this->db->insert_id());
            //proceso para dal alta de detalle
            $nombre_QR = $id_insert . '_' . $nro_factura . "_" . $fecha_horanameQR;

            $this->load->model('qr_cod_model');
            $this->qr_cod_model->generar_QR_factura_venta($nombre_QR . "?" . $cadenaQR);
            $this->actualizar_nro_fac_actual($id_dosi, $nro_factura);
            $this->actualiza_qr_ruta($id_insert, $nombre_QR, $codCont);

            for ($i = 1; $i < count($descs); $i++) {
                $datos = array(
                    'id_factura' => $id_insert,
                    // 'id_prod_serv'=>$ids[$i],
                    // 'cod_ps'=>$cods[$i],
                    // 'titulo_ps'=>$tits[$i],
                    'detalle_ps' => $descs[$i],
                    // 'comentario'=>$coments[$i],
                    'precio' => $pus[$i],
                    'cantidad' => $cants[$i],
                    'importe' => $subs[$i],
                    'item' => $i
                );
                $result[$i] = $this->db->insert('factura_venta_detalle', $datos);
            }
            $respuesta = "<input type='hidden' id='ayudata' value='$id_insert'><div class='OK'>Factura registrada exitosamente!!!</div><input type='hidden' id='proceso' value='INSERT'>";
            return($respuesta);
        } else {

            $segu = $this->input->post('comentarios_seguimiento_old');
            if ($this->input->post('comentarios_seguimiento') != "")
                $segu = $this->input->post('comentarios_seguimiento_old') . "-" . $fecha_hora . " >> " . $this->input->post('comentarios_seguimiento') . "*";
            $datos = array(
                //'num_factura' => $nro_factura,
                //'id_dosificacion' => $id_dosi,
                //'id_user_created' => $this->session->userdata('id_admin'),
                //'fh_registro' => $fecha_hora,
                //'id_cliente' => $this->input->post('id_cli'),
                'id_proyecto' => $this->input->post('id_proyecto'),
                'id_contrato' => $this->input->post('contrato'),
                //'subtotal_bs' => $this->input->post('totalpf'),
                //'monto_total_bs' => $this->input->post('totalpf'),
                //'saldo_a_cobrar' => $this->input->post('totalpf'),
                //'descuento_bs' => 0,
                //'monto_cobrado' => 0,
                'estado' => 'Valido',
                //'nit_cliente' => $nit_cliente,
                //'razon_social' => $this->input->post('razon_social'),
                'comentario' => $this->input->post('coment_gral'),
                //'iteraciones_codigo_control' => $controlcod,
                'penalidad' => $this->input->post('penalidad'),
                'comentarios_penalidad' => $this->input->post('comentario_penalidad'),
                'tipo_trabajo' => $this->input->post('tipo_factura'),
                'fecha_prevista_cobro' => $this->input->post('fecha_prov_pago'),
                'comentarios_seguimiento' => $segu
            );

            $this->db->where('id_factura', $this->input->post('id_ov_pf'));
            $upd = $this->db->update('factura_venta', $datos);
            if ($upd != 0)
                $respuesta = "<input type='hidden' id='ayudata' value='" . $this->input->post('id_ov_pf') . "'><input type='hidden' id='proceso' value='UPDATE'>";
        }

        return($respuesta);
    }

}

?>
