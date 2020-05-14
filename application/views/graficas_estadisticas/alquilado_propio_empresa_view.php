

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>
        <script src="<?php echo base_url() . "JS/jquery.min.js"; ?>"></script>
        <style type="text/css">

        </style>
        <link href="<?php echo base_url(); ?>CSS/erp_sg_v1_0.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/1000_20_0_0.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/style.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/jquery-ui.css" type="text/css" rel="stylesheet" />
        <script src="<?php echo base_url(); ?>JS/jquery-ui.js"></script>
     
        <script src="<?php echo base_url() . "JS/highstock.js"; ?>"></script>
        <script src="<?php echo base_url() . "JS/exporting.js"; ?>"></script>
         <script src="<?php echo base_url(); ?>JS/estadisticas.js"></script>
        
           

    </head>
    <body>
        <div class="" >
            <div style="width: 100% ">
            <div class=" esparriba20 " style="margin-top:30px ;width: 300px;float: right">
               <div class=" " style="width: 100px; float: left">
                   <input  type="text" title="" class="input_redond_100 margin_cero" id="fecha_inicial" value="<?php echo $fec1;?>"  >
               </div>
               <div class=" " style="width: 100px;float: left">
                   <input type="text" title=""  class="input_redond_100 margin_cero" id="fecha_final" value="<?php echo $fec2;?>" >
               </div>
               <div class=" boton2 milink" style="width: 50px;float: left" onclick="recargar_grafica('fecha_inicial','fecha_final','<?php echo base_url()."generar_grafica_estadisticas/vehiculos_alqui_prop";?>');">
                graficar
               </div>
            </div></div>
        <div class="clear"></div>
            
            <script>
                $(function () {
                    $("#fecha_inicial").datepicker({
                        onClose: function (selectedDate) {
                            $("#fecha_final").datepicker({minDate:selectedDate},{dateFormat:"yy-mm-dd"});
                        }
                    });
                    $("#fecha_final").datepicker({
                        onClose: function (selectedDate) {
                            $("#fecha_inicial").datepicker({maxDate: selectedDate},{dateFormat:"yy-mm-dd"});
                        }
                    });
                });
            </script>
            --
        </div>
        <div id="container"></div>
        <script>
            graf_cantidad_alq_prop_empresa("container","<?php echo $fechasG;?>","<?php echo $canPropG;?>","<?php echo $canAlqG;?>");
        </script>
        

    </body>
</html>
