<html>
    <head>
        <title>STS GO! | <?php echo $titulo; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="<?php echo base_url(); ?>imagenesweb/recursos/icono.png">
        <link href="<?php echo base_url(); ?>CSS/style.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/jquery-ui.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/erp_sg_v1_0.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/1000_20_0_0.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/paula.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/menus_paula.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/magali.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/styles_propios_rrhh.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/styles_propios.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/1008.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/style_sav.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>CSS/esqueleto_.css" type="text/css" rel="stylesheet" />      
        <link href="<?php echo base_url(); ?>CSS/botonesImages.css" type="text/css" rel="stylesheet" /> 
        <link href="<?php echo base_url(); ?>CSS/adriana.css" type="text/css" rel="stylesheet" />  	

        <link href='<?php echo base_url();?>/CSS/bootstrap/dist/css/bootstrap.min.css' rel="stylesheet">
<link href='<?php echo base_url();?>/CSS/font-awesome/css/font-awesome.min.css' rel="stylesheet">
<link href='<?php echo base_url();?>/css/custom.css' rel="stylesheet">


        <script src="<?php echo base_url(); ?>JS/control_proyecto.js"></script>
        <script src="<?php echo base_url(); ?>JS/paula.js"></script>
        <script src="<?php echo base_url(); ?>JS/magali.js"></script>
        <script src="<?php echo base_url(); ?>JS/jquery-1.js"></script>
        <script src="<?php echo base_url(); ?>JS/jquery-ui.js"></script>
        <script src="<?php echo base_url(); ?>JS/erp_sg_v1_0.js"></script>
        <script src="<?php echo base_url(); ?>JS/funcionesRRHH.js"></script>
        <script src="<?php echo base_url(); ?>JS/funcionesSAV.js"></script>
        <script src="<?php echo base_url(); ?>JS/erp_sg_v1_0anterior.js"></script> 
        <!---<script src="<?php echo base_url(); ?>JS/highcharts.js"></script>
        <script src="<?php echo base_url(); ?>JS/estadisticas.js"></script>
        <script src="<?php echo base_url(); ?>JS/exporting.js"></script>
        <script src="<?php echo base_url() . "JS/drilldown.js"; ?>"></script>-->
        <script src="<?php echo base_url(); ?>JS/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>JS/adriana.js"></script>

        <!--<link rel="stylesheet" href='<?php //echo base_url();       ?>utilidades/calendar/css/jquery.ui.all.css' type="text/css">-->
        <link rel="stylesheet" href='<?php echo base_url(); ?>utilidades/jqueryConfirm/jquery.confirm.css' type="text/css">

        <script src="<?php echo base_url(); ?>utilidades/subirArchivos/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>JS/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>utilidades/jqueryConfirm/jquery.confirm.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>JS/funcionesRRHH.js"></script>

        <!--<link rel="stylesheet" href="<?php //echo base_url();       ?>utilidades/modForm/jquery-ui.css">-->
        <script src="<?php echo base_url(); ?>utilidades/modForm/jquery-1.js"></script>
        <script src="<?php echo base_url(); ?>utilidades/modForm/jquery-ui.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>utilidades/modForm/style.css">
        <link  href=" <?php echo base_url(); ?>utilidades/JqueryArboles/jquery.treeview.css" rel="stylesheet"/>
        <script src="<?php echo base_url(); ?>utilidades/JqueryArboles/jquery.treeview.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>JS/contabilidad_v1.11.js"></script>
        <script src="<?php echo base_url(); ?>JS/rendicion.js"></script>
        <script src="<?php echo base_url(); ?>JS/rendiciones_r_v1.11.js"></script>
        <!--<script src="<?php echo base_url(); ?>JS/pago_proveedor.js"></script>-->
        <script src="<?php echo base_url(); ?>JS/lineas_servicios_telecom.js"></script>
        <script src="<?php echo base_url(); ?>JS/almacen.js"></script>
        <script src="<?php echo base_url(); ?>JS/chequera_electronica_v1.1.js"></script>
        <script src="<?php echo base_url(); ?>JS/centro_costos.js"></script>
        <script src="<?php echo base_url(); ?>JS/usuario.js"></script>
        <script src="<?php echo base_url(); ?>JS/factura_venta.js"></script>
        <script src="<?php echo base_url(); ?>JS/nota_fiscal.js"></script>
        <script src="<?php echo base_url(); ?>JS/credencial.js"></script>
        <script src="<?php echo base_url(); ?>JS/viaticos_extra.js"></script>
        
        <script src="<?php echo base_url(); ?>JS/jquery-barcode.js"></script>






    </head>
    <body >
    <div class='fondo_parte'>
    
        <div class="na-md">
        <div class="container body">

        <div id="bloqueo_pagina" class="ocultar" style="width: 100% ;height: 100% ; position: fixed ;background-color: rgba(10, 10, 10, 0.5) ; z-index: 200">
            <div style="width: 20%; height: 200px; margin: 10% 40% 0 40%; position: relative;" class="" > 
                <div style="position: absolute; top:35px; left: 3px; " class="div_b3 imgr" > </div>


                <!--            <div style="position: absolute; top:60px; left: 140px; " class="div_b2 imgr" ></div> -->
                <div style="position: absolute; top:65px; left: 90px; " class="div_b2 imgr" id="rueda"></div>

                <!-- <div style="position: absolute; top:45px; left: 95px; " id='rueda' class="div_b4 imgr" ></div>-->

                <div style="position: absolute; top:60px; left: 160px; color: #FFF" class="f30 negrilla" ></div>

            </div>

        </div>
        
                        
            <div class="content right_col">
                <div class="top_block fondo_cabecera top_nav">
                    <div class="ancho25 menu_superior " style="display: inline-block; float: right">
                        <div class="content">
                            <div style="display: inline; float: left" class="alin_der"><div><?php echo $this->session->userdata('nombres') . " " . $this->session->userdata('apellidos') ?> </div>
                                <div id="liveclock" class="negrilla f14"> </div>
                            </div>
                            <input type="hidden" value="<?php echo base_url(); ?>" id="b_url">

                            <div style="display: inline;margin: 0 5px 0 10px;"><img style="border-radius: 5px" src="<?php echo base_url() . $this->session->userdata('imagen') ?>" height="27"></div>

<!--<img src="<?php // echo base_url() . "imagenesweb/icono/user-alt-2b.png"       ?>" onclick="dialog_contenidos_nuevo_usuario('ayuda_origen','<?php //echo base_url() . "usuario/usuario_nuevo/" . $this->session->userdata('id_admin');       ?>')" height="25">-->
                            <div style="display: inline;margin: 0 5px 0 5px;"><a class="milink fondo_cabecera colorBlanco" href='<?php echo base_url() . "inicio/user_logout" ?>'><img src="<?php echo base_url() . "imagenesweb/icono/doorb.png" ?>" title="¿Seguro que desea SALIR?" height="25">
                                </a></div>
                        </div>
                    </div>
                    <div class=" ancho75 menu_superior"  >
                        <div class="content">
                            <div class="menu">
                                <?php $this->load->view('menu_views/menu_superior_view'); ?>
                            </div>
                        </div>
                    </div>         
                </div>
                <div class="left_block menu_detallado fondo_izquierda " style="margin-top: 40px;height: 100%">
                    <div class="content">
                        <div class="campo_logotipo " style="margin-top: 25px;">
                            <br>
                        </div>
                        <div class="content f12 negrilla " style="margin-top: 25px;" >
                            <?php $this->load->view('menu_views/menu_sidebar_view'); ?>
                        </div>
                    </div>
                </div>

                <div class="background contenido_cuerpo right_col"  style="margin: 50px 1% 0px 170px; ">
                    

                        <?php $this->load->view($vista_enviada); ?>  
                     
                </div>  


            </div>  

            <div id="ayuda_origen" class="formulario_nuevo_menu ocultar container_20" style="height: 300px; width: 400px;">cargando...</div>
            
        </div>



        <div id='cargando_grande' class='ocultar' >

            <div class=' ' style="width: 20%; height: 100px; margin: 0 40% 0 40%;"> 
                <div style="position: absolute;" class="div_lgo" > 
                    <div style="position: absolute; top:50px; left: 70px; " id='rueda' class="div_e1 imgr" > </div>
                    <div style="position: absolute; top:40px; left: 110px; " class="div_e2 imgr" ></div> 
                    <div style="position: absolute; top:60px; left: 130px; " id='rueda' class="div_e4 imgr" ></div>
                </div>
            </div>

        </div>
</div>
            </div>

    </body>
</html>