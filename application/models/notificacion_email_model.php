<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of notificacion_email
 *
 * @author Computer
 */
class notificacion_email_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library("email");
    }

    function enviar_notificacion_rendiciones($id_rendicon) {
        $this->load->model('rendiciones_model');
        $this->load->model('usuario_model');
        $this->load->model('proyecto_model');

        $datos_rendicion = $this->rendiciones_model->obtener_datos_rendicion($id_rendicon);
        $fila = $datos_rendicion->row();
        $inf_usuario = $this->usuario_model->obtener_user($fila->id_usuario);
        $inf_proyecto = $this->proyecto_model->obtener_datos_proyecto($fila->id_proy)->row();

        $supervisor = $fila->id_responsable_proy;


        echo $supervisor . "<br>";
        $ids_sup = explode("|", $supervisor);
        echo $ids_sup[0] . " - " . $ids_sup[1] . " - " . $ids_sup[2] . " - " . $ids_sup[3] . "<br>";
        echo count($ids_sup) . "<br>";
        echo $ids_sup[count($ids_sup) - 2] . "<br>";
        $ultimo_resp = $ids_sup[count($ids_sup) - 2];
        if ($ultimo_resp > 0) {
            $info_resp = $this->usuario_model->obtener_user($ultimo_resp);


            if ($info_resp->correo_corp != "") {

                $mensaje = '<html>
                            <body>
                            <p style="font-family:Verdana, Geneva, sans-serif; font-size:12px">&nbsp;</p>
                            <table width="693" border="0">
                              <tr>
                                <td width="215" rowspan="3"><span style="font-family:Verdana, Geneva, sans-serif; font-size:12px">
                                <img src="http://200.87.107.68/ImagenesInicio/logomail.png" width="196" height="302" /></span></td>
                                <td width="468" height="74">
                                <span style="font-family:Verdana, Geneva, sans-serif;font-size:16px;font-weight:bold;color:#A40000">Notificación Módulo Rendiciones</span></td>
                              </tr>
                              <tr>
                                <td height="113"><span style="font-family:Verdana, Geneva, sans-serif; font-size:12px">
                                 ' . $info_resp->nombre . ', se ha detectado que su buzon de rendiciones tienen  nuevas entradas de ' . $inf_usuario->nombre . ' ' . $inf_usuario->ap_paterno . '
                            <br>         
                            <span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;font-weight:bold;color:#A40000"> ' . $fila->tipo_rend . ' Nro : ' . $fila->idreg_ren . ' Proyecto: ' . $inf_proyecto->nombre . '  </span>
                            <br>
                            te invitamos a ingresar al sistema para que puedas proceder a darles tu visto  bueno </span>
                            <br><a href="http://200.87.107.68/ERP_SG_v1_0/">click aqui para ingresar al sistema</a><br>
                            </td>
                              </tr>
                              <tr>
                                <td valign="top"><p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #003;">
                                <span style="font-size:14px; font-weight:bold">Departamento TIC</span><br>
                                 Tel Oficina :+591 2 2406667 -  Int 113 <br>Tel corp: +591 670 02488  <br>Av. Mcal Santa Cruz, esq. Yanacocha Edif. Hansa Piso 4 </p>
                                <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px">&nbsp;</p></td>
                              </tr>
                            </table>
                            </body>
                            </html>';


                //configuracion para email
                $configEmail = array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://mail.sts.com.bo',
                    'smtp_port' => 465,
                    'smtp_user' => 'notificaciones.go@sts.com.bo',
                    'smtp_pass' => '6121976',
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'newline' => "\r\n"
                );

                //cargamos la configuración para enviar con gmail
                $this->email->initialize($configEmail);

                $this->email->from('notificaciones.go@sts.com.bo');

                //esto es variable Correo electronico

                $this->email->to($info_resp->correo_corp);
                //   $this->email->bcc('rpayrumani@sts.com.bo','r.payrumani@gmail.com');

                $this->email->subject($info_resp->nombre . ', tienes entradas en tu Bandeja de Rendiciones');
                $this->email->message($mensaje);
                $this->email->send();
                //con esto podemos ver el resultado
                var_dump($this->email->print_debugger());
            }
        }
    }

    function enviar_notificacion_rendiciones_vobo($id_rendicon) {
        $this->load->model('rendiciones_model');
        $this->load->model('usuario_model');
        $this->load->model('proyecto_model');

        $datos_rendicion = $this->rendiciones_model->obtener_datos_rendicion($id_rendicon);
        $fila = $datos_rendicion->row();
        $inf_usuario = $this->usuario_model->obtener_user($fila->id_usuario);
        $inf_proyecto = $this->proyecto_model->obtener_datos_proyecto($fila->id_proy)->row();

        $supervisor = $fila->id_responsable_proy;
        $ids_sup = explode("|", $supervisor);
        $ids_vobos = explode("|", $fila->ids_vobos);
        $vobo_ultimo = $ids_vobos[count($ids_vobos) - 2];


        $ultimo_resp = $ids_sup[count($ids_sup) - 2];
        if ($ultimo_resp > 0) {
            $info_resp = $this->usuario_model->obtener_user($ultimo_resp);
            $info_vobo = $this->usuario_model->obtener_user($vobo_ultimo);


            if ($info_resp->correo_corp != "") {

                $mensaje = '<html>
                            <body>
                            <p style="font-family:Verdana, Geneva, sans-serif; font-size:12px">&nbsp;</p>
                            <table width="693" border="0">
                              <tr>
                                <td width="215" rowspan="3"><span style="font-family:Verdana, Geneva, sans-serif; font-size:12px">
                                <img src="http://200.87.107.68/ImagenesInicio/logomail.png" width="196" height="302" /></span></td>
                                <td width="468" height="74">
                                <span style="font-family:Verdana, Geneva, sans-serif;font-size:16px;font-weight:bold;color:#A40000">Notificación Módulo Rendiciones</span></td>
                              </tr>
                              <tr>
                                <td height="113"><span style="font-family:Verdana, Geneva, sans-serif; font-size:12px">
                                 ' . $info_resp->nombre . ', se ha detectado que su buzon de rendiciones tienen  nuevas entradas de<span style="font-weight:bold;"> ' . $inf_usuario->nombre . ' ' . $inf_usuario->ap_paterno . '</span>
                            <br>         
                            <br>         
                            <span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;font-weight:bold;color:#A40000"> ' . $fila->tipo_rend . ' Nro : ' . $fila->idreg_ren . ' Proyecto: ' . $inf_proyecto->nombre . '  </span>
                            <br>
                            con el visto bueno de ' . $info_vobo->nombre . ' ' . $info_vobo->ap_paterno . '                            <br>
                            <br>
                            te invitamos a ingresar al sistema para que puedas proceder a darles tu visto  bueno </span>
                            <br><a href="http://200.87.107.68/ERP_SG_v1_0/">click aqui para ingresar al sistema</a><br>
                            </td>
                              </tr>
                              <tr>
                                <td valign="top"><p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: #003;">
                                <span style="font-size:14px; font-weight:bold">Departamento TIC</span><br>
                                 Tel Oficina :+591 2 2406667 -  Int 113 <br>Tel corp: +591 670 02488  <br>Av. Mcal Santa Cruz, esq. Yanacocha Edif. Hansa Piso 4 </p>
                                <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px">&nbsp;</p></td>
                              </tr>
                            </table>
                            </body>
                            </html>';


                //configuracion para email
                $configEmail = array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://mail.sts.com.bo',
                    'smtp_port' => 465,
                    'smtp_user' => 'notificaciones.go@sts.com.bo',
                    'smtp_pass' => '6121976',
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'newline' => "\r\n"
                );

                //cargamos la configuración para enviar con gmail
                $this->email->initialize($configEmail);

                $this->email->from('notificaciones.go@sts.com.bo');

                //esto es variable Correo electronico

                $this->email->to($info_resp->correo_corp);
                //  $this->email->bcc('rpayrumani@sts.com.bo','r.payrumani@gmail.com');

                $this->email->subject($info_resp->nombre . ', tienes entradas en tu Bandeja de Rendiciones');
                $this->email->message($mensaje);
                $this->email->send();
                //con esto podemos ver el resultado
                var_dump($this->email->print_debugger());
            }
        }
    }

    function enviar_notificacion_cheques_proveedores() {
        $this->load->model('e_chequera_model');
        $this->load->model('pago_proveedor_model');
   
        $lista_cheques = $this->e_chequera_model->listar_cheques_hoy();
        $cheques = "";
        $estilo = "style='background:#FFFFA0; border-bottom:solid #999;'";
        $tipo_cheque = "";
        if ($lista_cheques->num_rows() > 0) {
            foreach ($lista_cheques->result() as $cheque) {
                if ($estilo == "style='background:#FFFFA0; border-bottom:solid 1px #999;font-size:11px;'")
                    $estilo = "style='background:#A0FFFF; border-bottom:solid 1px #999;font-size:11px;'";
                else
                    $estilo = "style='background:#FFFFA0; border-bottom:solid 1px #999;font-size:11px;'";
                if ($tipo_cheque != $cheque->tipo_cheque) {
                    $cheques .= "<tr><td colspan='5' style='background:#000000; color:#FFFFFF;font-size:16px;' class='negrilla' > Tipo Cheque $cheque->tipo_cheque </td></tr>
                              <tr class='negrilla ' style='background:#000000; color:#FFFFFF;font-size:12px;'>
                                
                                <td>a nombre de </td>
                                <td>Cuenta</td>
                                <td>monto</td>
                                <td>Elaborado por </td>
                                <td>Glosa de pago</td>
                              </tr>";
                    $tipo_cheque = $cheque->tipo_cheque;
                }

                $cheques .= '<tr ' . $estilo . ' >
                                
                                <td>' . $cheque->detalle_dirigido_a . '</td>
                                <td>' . $cheque->dirigido . '</td>
                                <td>' . $cheque->monto . '</td>
                                <td>' . $cheque->usuario . '</td>
                                <td>' . $cheque->comentario . '</td>
                       </tr>';
                if ($cheque->documento == "orden_pago_proveedor") {
                    echo "aquie error";
                    $this->pago_proveedor_model->pagar_solpago($cheque->id_documento,$cheque->monto);
                }
                
                if ($cheque->documento == "rendiciones") {
                    echo "<br>** aquie error<br>";
                    $this->pago_proveedor_model->pagar_rendicion($cheque->id_documento,$cheque->monto);
                    //registrar estado_cuenta_tecnico
                    //actualizar registro de rendicion
                    //
                    
                    //$this->pago_proveedor_model->pagar_solpago($cheque->id_documento);
                }
                
            }

            $mensaje = '<html>
            <head>
            <style  type="text/css">
                body{font-family:Verdana, Geneva, sans-serif;}
                table{font-family:Verdana, Geneva, sans-serif;}
                .negrilla {font-weight:bold; font-size:12px;}
                .filas {background:#FFFFF2; border-bottom:solid #999;}
                .filas:hover{background:#FFFF5B}
                .f11{ font-size:11px;}
            </style>
            </head>
                            <body>
                            
                            <table width="1000" border="0">
                              <tr>
                                <td width="553" height="47" colspan="5">
                                <span style="font-family:Verdana, Geneva, sans-serif;font-size:16px;font-weight:bold;color:#A40000">Notificación Modulo Chequera Electronica</span><br>
                                <span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;">
Los Cheques emitidos el dia de hoy <span class="negrilla">' . date("d - m - Y") . ' </span>son :
</span></td>
                              </tr>
                              
                            
                              ' . $cheques . ' 
                            
                            </table>
                            </body>
                            </html>';

            echo $mensaje;
            //configuracion para email
            $configEmail = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://mail.sts.com.bo',
                'smtp_port' => 465,
                'smtp_user' => 'notificaciones.go@sts.com.bo',
                'smtp_pass' => '6121976',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            );

            //cargamos la configuración para enviar con gmail
            $this->email->initialize($configEmail);

            $this->email->from('notificaciones.go@sts.com.bo');

            //esto es variable Correo electronico

            $this->email->to('rpayrumani@sts.com.bo');//,jtarqui@sts.com.bo,amgutierrez@sts.com.bo,lugarte@sts.com.bo,ccanaviri@sts.com.bo
            //$this->email->bcc('rpayrumani@sts.com.bo','r.payrumani@gmail.com');

            $this->email->subject('Boletin de emision de cheques de hoy ' . date("d-m-Y"));
            $this->email->message($mensaje);
            $this->email->send();
            //con esto podemos ver el resultado
            var_dump($this->email->print_debugger());
        }
    }

    function enviar_not_sol_fr() {
        $id_fr = $this->input->post('fr_id');

        //$this->load->model('e_chequera_model');

        $this->load->model('fondosRendir_model');

        // $lista_cheques = $this->e_chequera_model->listar_cheques_hoy();
        $fr = $this->fondosRendir_model->obtener_datos_sol_fondos($id_fr);
        //   echo "pasa";
        $detalle_fr = $this->fondosRendir_model->obtener_datos_sol_fondos_detalle($id_fr);

        $detalle = "";
        $estilo = "style='background:#FFFFA0; border-bottom:solid #999;'";
        //  $tipo_cheque = "";
        $sw = 1;
        $item = 1;
        if ($detalle_fr->num_rows() > 0) {
            foreach ($detalle_fr->result() as $det) {
                if ($estilo == "style='background:#FFFFA0; border-bottom:solid 1px #999;font-size:11px;'")
                    $estilo = "style='background:#A0FFFF; border-bottom:solid 1px #999;font-size:11px;'";
                else
                    $estilo = "style='background:#FFFFA0; border-bottom:solid 1px #999;font-size:11px;'";
                if ($sw == 1) {
                    $detalle .= "<tr><td colspan='5' style='color:#000;font-size:16px; text-align: center' class='negrilla' > Detalle de la Solicitud </td></tr>
                              <tr class='negrilla ' style='color:#666666; border-bottom: solid 3px #000;font-size:12px;'>
                                
                                <td style='text-align:right'><br></td>
                                <td>detalle</td>
                                <td>monto</td>
                                <td>Proyecto</td>
                                <td>Sitio</td>
                              </tr>";
                    $sw = 0;
                }

                $detalle .= '<tr style="color:#777777; border-bottom: #777777    solid 1px ;font-size:10px;" >
                                
                                <td style="text-align:right">' . $item . ' ) </td>
                                <td>' . $det->detalle . '</td>
                                <td>' . $det->monto_detalle . '</td>
                                <td>' . $det->proyecto . '</td>
                                <td>' . $det->sitio . '</td>
                       </tr>';
                $item++;
            }

            $mensaje = '<html>
            <head>
            <style  type="text/css">
                body{font-family:Verdana, Geneva, sans-serif;}
                table{font-family:Verdana, Geneva, sans-serif;}
                .negrilla {font-weight:bold; font-size:12px;}
                .filas {background:#FFFFF2; border-bottom:solid #999;}
                .filas:hover{background:#FFFF5B}
                .f11{ font-size:11px;}
            </style>
            </head>
                            <body>
                            
                            <table width="70%   " border="0">
                              <tr>
                              
                                <td width="553" height="60" colspan="5">
                                <span style="font-family:Verdana, Geneva, sans-serif;font-size:16px;font-weight:bold;color:#A40000">Notificación Nueva Solicitud de Fondos a Rendir</span><br><br>
                                <span style="font-family:Verdana, Geneva, sans-serif;font-size:12px;">
se ha solicitado Fondos a Rendir a nombre de :<span class="negrilla">' . $fr->row()->asignado . ' </span> en fecha  <span class="negrilla">' . date("d - m - Y") . ' </span> segun el siguiente detalle:
</span></td>
                              </tr>
                              <tr>
                              <td> id solicitud:' . $fr->row()->id_sol_frendir . '
                              </td>
                              <td> estado :' . $fr->row()->estado . '
                              </td>
                              </tr>
                              
                              <tr>
                              <td> <br>
                              </td>
                              </tr>
                              
                            
                              ' . $detalle . ' 
                            <tr>
                            <td colspan="2" style="text-align: right" class="negrilla f11"> TOTAL .- <br><br> </td>
                            <td colspan="3" class="negrilla"> ' . $fr->row()->monto . ' <br><br></td>
                            </tr>
                            <tr>
                            
                            <td colspan="5"  style="background:#EEE" class="f11">
                            <br>
                            <spam class="negrilla">Comentario:</spam>' . $fr->row()->comentario_global . ' </span> 
                                <br>
                            </td>
                            </tr>
                            <tr>
                            
                            <td colspan="5">
                            <br>
                            solicitando Fondos a la cuenta de <span class="negrilla">' . $fr->row()->asignado . '(' . $fr->row()->Banco . ' cta : ' . $fr->row()->cuenta . ')</span >
                            por  <span class="negrilla"> Bs .- ' . $fr->row()->monto . ' </span>
                            <br>
                            </td>
                            </tr>
                            <tr>
                            <td colspan="5">
                            <br>
                            solicitado por <span class="negrilla">' . $fr->row()->registrado . ' </span>                            
                                <br>
                            </td>
                            </tr>
                            <tr>
                            <td><br></td>
                            <td><br></td>
                            <td  style="background:#ACFF66;text-align:center" ><br><a href="#"> Aprobar</a><br></td>
                            <td  style="background:#ACFF66;text-align:center" ><br><a href="#"> Devolver</a><br></td>
                            <td  style="background:#FF7262;text-align:center" ><br><a href="#"> Rechazar</a><br></td>
                            <td  style="background:#F6FF2F;text-align:center" ><br><a href="#"> Editar</a><br></td>
                           
                            
                            </tr>
                            </table>
                            </body>
                            </html>';

            echo $mensaje;
            //configuracion para email
            $configEmail = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://mail.sts.com.bo',
                'smtp_port' => 465,
                'smtp_user' => 'notificaciones.go@sts.com.bo',
                'smtp_pass' => '6121976',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            );

            //cargamos la configuración para enviar con gmail
            $this->email->initialize($configEmail);

            $this->email->from('notificaciones.go@sts.com.bo');

            //esto es variable Correo electronico

            $this->email->to('rpayrumani@sts.com.bo');
            //$this->email->bcc('rpayrumani@sts.com.bo','r.payrumani@gmail.com');

            $this->email->subject($fr->row()->id_sol_frendir . ' .- Solicitud fondos a Rendir ' . $fr->row()->asignado . ' fecha ' . date("d-m-Y"));
            $this->email->message($mensaje);
            $this->email->send();
            //con esto podemos ver el resultado
            var_dump($this->email->print_debugger());
        }
    }

}
