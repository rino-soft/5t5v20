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

        <link href='<?php echo base_url(); ?>/CSS/bootstrap/dist/css/bootstrap.min.css' rel="stylesheet">
        <link href='<?php echo base_url(); ?>/CSS/font-awesome/css/font-awesome.min.css' rel="stylesheet">
        <link href='<?php echo base_url(); ?>/css/custom.css' rel="stylesheet">


       
        <script src="<?php echo base_url(); ?>JS/jquery-1.js"></script>
        <script src="<?php echo base_url(); ?>JS/jquery-ui.js"></script>
        
        <script src="<?php echo base_url(); ?>JS/erp_sg_v1_0.js"></script>
        
         <script src="<?php echo base_url(); ?>JS/control_proyecto.js"></script>
        <script src="<?php echo base_url(); ?>JS/paula.js"></script>
        <script src="<?php echo base_url(); ?>JS/magali.js"></script>
        
        
        <script src="<?php echo base_url(); ?>JS/funcionesRRHH.js"></script>
        <script src="<?php echo base_url(); ?>JS/funcionesSAV.js"></script>
        <script src="<?php echo base_url(); ?>JS/erp_sg_v1_0anterior.js"></script> 
        <!---<script src="<?php echo base_url(); ?>JS/highcharts.js"></script>
        <script src="<?php echo base_url(); ?>JS/estadisticas.js"></script>
        <script src="<?php echo base_url(); ?>JS/exporting.js"></script>
        <script src="<?php echo base_url() . "JS/drilldown.js"; ?>"></script>-->
        <script src="<?php echo base_url(); ?>JS/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>JS/adriana.js"></script>

        <!--<link rel="stylesheet" href='<?php //echo base_url();                        ?>utilidades/calendar/css/jquery.ui.all.css' type="text/css">-->
        
        
        
        
        

        <script src="<?php echo base_url(); ?>utilidades/subirArchivos/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>JS/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>utilidades/jqueryConfirm/jquery.confirm.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>JS/funcionesRRHH.js"></script>

        <!--<link rel="stylesheet" href="<?php //echo base_url();                        ?>utilidades/modForm/jquery-ui.css">-->
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
    <body class="nav-md" >
        <div id="bloqueo_pagina" class="ocultar" style="width: 100% ;height: 100% ; position: fixed ;background-color: rgba(10, 10, 10, 0.5) ; z-index: 200">
            <div style="width: 20%; height: 200px; margin: 10% 40% 0 40%; position: relative;" class="" > 
                <div style="position: absolute; top:35px; left: 3px; " class="div_b3 imgr" > </div>


                <!--            <div style="position: absolute; top:60px; left: 140px; " class="div_b2 imgr" ></div> -->
                <div style="position: absolute; top:65px; left: 90px; " class="div_b2 imgr" id="rueda"></div>

                <!-- <div style="position: absolute; top:45px; left: 95px; " id='rueda' class="div_b4 imgr" ></div>-->

                <div style="position: absolute; top:60px; left: 160px; color: #FFF" class="f30 negrilla" ></div>

            </div>
        </div>


        <div class="container body">
            <div class="main_container">
                <!-- columna de la izquierda Menu sidebar-->       
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">

                        <div class="navbar nav_title" style="border: 0;">
                            <a href="index.html" class="site_title"><span>STS Bolivia Ltda</span></a> <input type="hidden" value="<?php echo base_url(); ?>" id="b_url">
                        </div>
                        <div class="clearfix"></div>
                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Bienvenido,</span>
                                <h2><?php echo $this->session->userdata('nombres') . " " . $this->session->userdata('apellidos') ?> </h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>General</h3>
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="index.html">Dashboard</a></li>
                                            <li><a href="index2.html">Dashboard2</a></li>
                                            <li><a href="index3.html">Dashboard3</a></li>
                                        </ul>
                                    </li>
                                       <?php echo $datos_menu_detallado;?> 

                                </ul>
                            </div>


                        </div>

                        <!--fin sidebas menu-->

                    </div>
                </div>

                <!--fin lado derecho -->


                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="images/img.jpg" alt=""><?php echo $this->session->userdata('nombres') . " " . $this->session->userdata('apellidos') ?> 
                                        <span class=" fa fa-angle-down">STS</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a href="javascript:;"> Profile</a></li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="badge bg-red pull-right">50%</span>
                                                <span>Settings</span>
                                            </a>
                                        </li>
                                        <li><a href="javascript:;">Help</a></li>
                                        <li><a href="<?php echo base_url() . "inicio/user_logout" ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                    </ul>
                                </li>

                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge bg-green">6</span>
                                    </a>
                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="text-center">
                                                <a>
                                                    <strong>See All Alerts</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="nain">

                    <div class="">


                        <?php 
                            echo $vista_enviada;
                            $this->load->view($vista_enviada); ?>  

                    </div>  

                </div>
                <!--  /page content -->



            </div>
        </div>

        <div id="ayuda_origen" class="formulario_nuevo_menu ocultar container_20" style="height: 300px; width: 400px;">cargando...</div>
        <div id='cargando_grande' class='ocultar' >

            <div class=' ' style="width: 20%; height: 100px; margin: 0 40% 0 40%;"> 
                <div style="position: absolute;" class="div_lgo" > 
                    <div style="position: absolute; top:50px; left: 70px; " id='rueda' class="div_e1 imgr" > </div>
                    <div style="position: absolute; top:40px; left: 110px; " class="div_e2 imgr" ></div> 
                    <div style="position: absolute; top:60px; left: 130px; " id='rueda' class="div_e4 imgr" ></div>
                </div>
            </div>

        </div>

        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Custom Theme Scripts-->

        <script src="<?php echo base_url(); ?>/build/js/custom.min.js"></script>
    </body>
</html>