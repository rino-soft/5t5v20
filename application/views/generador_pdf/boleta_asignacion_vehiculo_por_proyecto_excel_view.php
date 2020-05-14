<?php /* header(“Content-Type: application/vnd.ms-excel”);

  header(“Expires: 0″);

  header(“Cache-Control: must-revalidate, post-check=0, pre-check=0″);

  header(“content-disposition: attachment;filename=NOMBRE.xls”);

 */
?>
<?php
//header("Content-Type: application//vnd.ms-excel"); 
header("Content-Type: application//vnd.ms-excel");
header("Expires: 0");
Header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=NOMBRE.xls");
?>


<html>

    <head>

        <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />

        <title>comolohago.clt</title>

        <style type=”text/css”>



            .style1 
            {

                font-family: Verdana, Arial, Helvetica, sans-serif;

                font-weight: bold;

            }

            .style2 {font-family: Verdana, Arial, Helvetica, sans-serif}



        </style>

    </head>

    <body>

        <table width=”200″  border="3px" >

            <tr>
                <td colspan="11" align="right">Generado en el Sistema de Gesion OnLine</td>

<!--<td rowspan="2">------</td>
<th colspan="11" align="right">--</th> 
<th colspan="11" align="right">---</th>--> 
            </tr>
            <tr>
                <td colspan="11" rowspan="2" align="center">Asignación vehicular</td>
            </tr>
            <tr>

            </tr>





            <tr>

   <!-- <td><span class="style1" >Item </span></td>--->
                <td><span class="style1" <font color="151A4F"><b>Depto</b></font></span></td>
                <td><span class="style1"><font color="151A4F"><b>Subcentro</b></font></span></td>
                <td><span class="style1"><font color="151A4F"><b>Placa</b></font></span></td>
                <td><span class="style1"><font color="151A4F"><b>Modelo</b></font></span></td>
                <td><span class="style1"><font color="151A4F"><b>Marca</b></font></span></td>
                <td><span class="style1"><font color="151A4F"><b>Tipo</b></font></span></td>
                <td><span class="style1"><font color="151A4F"><b>Color</b></font></span></td>
                <td><span class="style1"><font color="151A4F"><b>Contrato</b></font></span></td>
                <td><span class="style1"><font color="151A4F"><b>Estado</b></font></span></td>
                <td><span class="style1"><font color="151A4F"><b>Asignado a:</b></font></span></td>
                <td><span class="style1"><font color="151A4F"><b>Observaciones</b></font></span></td>

            </tr>
            <?php
            foreach ($asignados_proyecto->result() as $registro) {
               // $res = $asignados_proyecto[$reg->id_proy];
                //foreach ($res->result() as $registro)
                    $estado = 'malo';
                if ($registro->suma_estado > 3) {
                    $estado = 'Regular';
                }
                if ($registro->suma_estado > 6) {
                    $estado = 'Bueno';
                } 
                    ?>
                    <tr> 
                        <td><span class="style2"><?php echo $registro->nom_ciudad; ?></span></td>
                        <td><span class="style2"><?php echo $registro->subcentro; ?></span></td>
                        <td><span class="style2"><?php echo $registro->placa; ?></span></td>
                        <td><span class="style2"><?php echo $registro->modelo; ?></span></td>
                        <td><span class="style2"><?php echo $registro->marca; ?></span></td>
                        <td><span class="style2"><?php echo $registro->tipo; ?></span></td>
                        <td><span class="style2"><?php echo $registro->color; ?></span></td>
                        <td><span class="style2"><?php echo $registro->contrato; ?></span></td>
                        <td><span class="style2"><?php echo $estado; ?></span></td>
                        <td><span class="style2"><?php echo $registro->nombre; ?></span></td>
                        <td><span class="style2"><?php echo $registro->observaciones; ?></span></td>
                       <!-- <td><span class=”style2″>20</span></td>-->
                    </tr>
                    <?php
                }
                ?>

            <?php
            

            foreach ($datos_taller->result() as $reg) {
                $esta = 'malo';
                if ($reg->suma_estado > 3) {
                    $esta = 'Regular';
                }
                if ($reg->suma_estado > 6) {
                    $esta = 'Bueno';
                }
                ?>

                <tr> 
                    <td><span class="style2"><?php echo $reg->nom_ciudad; ?></span></td>
                    <td><span class="style2"><?php echo $reg->subcentro; ?></span></td>
                    <td><span class="style2"><?php echo $reg->placa; ?></span></td>
                    <td><span class="style2"><?php echo $reg->modelo; ?></span></td>
                    <td><span class="style2"><?php echo $reg->marca; ?></span></td>
                    <td><span class="style2"><?php echo $reg->tipo; ?></span></td>
                    <td><span class="style2"><?php echo $reg->color; ?></span></td>
                    <td><span class="style2"><?php echo $reg->contrato; ?></span></td>
                    <td><span class="style2"><?php echo $esta ?></span></td>
                    <td><span class="style2"><?php echo $reg->nombre_taller; ?></span></td>
                    <td><span class="style2"><?php echo $reg->observaciones; ?></span></td>
                   <!-- <td><span class=”style2″>20</span></td>-->
                </tr>
            <?php
            }

            for ($i = 0; $i < count($datos_no_asig); $i++) {
                $esta = 'malo';
                $no_asig = 'Sin asignacion';
                if ($datos_no_asig[$i]->suma_estado > 3) {
                    $esta = 'Regular';
                }
                if ($datos_no_asig[$i]->suma_estado > 6) {
                    $esta = 'Bueno';
                }
                ?>

                <tr> 
                    <td><span class="style2"><?php echo $datos_no_asig[$i]->nom_ciudad; ?></span></td>
                    <td><span class="style2"><?php echo $datos_no_asig[$i]->subcentro; ?></span></td>
                    <td><span class="style2"><?php echo $datos_no_asig[$i]->placa; ?></span></td>
                    <td><span class="style2"><?php echo $datos_no_asig[$i]->modelo; ?></span></td>
                    <td><span class="style2"><?php echo $datos_no_asig[$i]->marca; ?></span></td>
                    <td><span class="style2"><?php echo $datos_no_asig[$i]->tipo; ?></span></td>
                    <td><span class="style2"><?php echo $datos_no_asig[$i]->color; ?></span></td>
                    <td><span class="style2"><?php echo $datos_no_asig[$i]->contrato; ?></span></td>
                    <td><span class="style2"><?php echo $esta ?></span></td>
                    <td bgcolor="#C7F77B"><span class="style2">Sin Asignacion proyecto</span></td>
                    <td><span class="style2"><?php echo $datos_no_asig[$i]->observaciones; ?></span></td>
                   <!-- <td><span class=”style2″>20</span></td>-->
                </tr>   


                <?php }
                 /*
                for ($i = 0; $i < 3; $i++) {
                    $esta = 'malo';

                    if ($datos_no_asig_dos[$i]->suma_estado > 3) {
                        $esta = 'Regular';
                    }
                    if ($datos_no_asig_dos[$i]->suma_estado > 6) {
                        $esta = 'Bueno';
                    }
                */

                //foreach ($datos_no_asig_dos->result() as $reg) {


                ?>
                                <tr> 
                                                <td><span class="style2"><?php //echo $datos_no_asig_dos[$i]->nom_ciudad; ?></span></td>
                                                <td><span class="style2"><?php // echo $datos_no_asig_dos[$i]->subcentro; ?></span></td>
                                                <td><span class="style2"><?php //echo $datos_no_asig_dos[$i]->placa; ?></span></td>
                                                <td><span class="style2"><?php //echo $datos_no_asig_dos[$i]->modelo; ?></span></td>
                                                <td><span class="style2"><?php //echo $datos_no_asig_dos[$i]->marca; ?></span></td>
                                                <td><span class="style2"><?php //echo $datos_no_asig_dos[$i]->tipo; ?></span></td>
                                                <td><span class="style2"><?php //echo $datos_no_asig_dos[$i]->color; ?></span></td>
                                                <td><span class="style2"><?php //echo $datos_no_asig_dos[$i]->contrato; ?></span></td>
                                                <td><span class="style2"><?php //echo $esta ?></span></td>
                                                <td bgcolor="#C7F77B"><span class="style2">Sin Asignacion</span></td>
                                                <td><span class="style2"><?php //echo $datos_no_asig_dos[$i]->observaciones; ?></span></td>
                                               <!-- <td><span class=”style2″>20</span></td>-->
                               </tr>              



                <? //} ?>

        </table>

    </body>

</html>
