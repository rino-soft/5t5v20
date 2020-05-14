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








        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo base_url(); ?>vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="<?php echo base_url(); ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="<?php echo base_url(); ?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="<?php echo base_url(); ?>vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="<?php echo base_url(); ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?php echo base_url(); ?>/build/css/custom.min.css" rel="stylesheet">


    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">


                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="index.html" class="site_title"><span>STS Bolivia Ltda</span></a>
                            <input type="hidden" value="<?php echo base_url(); ?>" id="b_url">
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2>John Doe</h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>General</h3>
                                <ul class="nav side-menu">
                                    <?php
                                    echo "esto esta fallando";
                                    echo $datos_menu_detallado;
                                    ?>
                                </ul>
                            </div>

                        </div>
                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->

                        <!-- /menu footer buttons -->
                    </div>
                </div>

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
                                        <img src="images/img.jpg" alt="">John Doe
                                        <span class=" fa fa-angle-down"></span>
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
                                        <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
                <div class="right_col " role="main">
                    <!-- top tiles -->
                    <?php $this->load->view($vista_enviada); ?>
                </div>
                <!-- /page content -->
                <div id="ayuda_origen" class="formulario_nuevo_menu ocultar container_20" style="height: 300px; width: 400px;">cargando...</div>
                <!-- footer content -->

                <!-- /footer content -->
            </div>
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

        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick - ->
        <script src="<?php echo base_url(); ?>vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -  ->
        <script src="<?php echo base_url(); ?>vendors/nprogress/nprogress.js"></script>
        <!-- Chart.js - ->
        <script src="<?php echo base_url(); ?>vendors/Chart.js/dist/Chart.min.js"></script>
        <!-- gauge.js - ->
        <script src="<?php echo base_url(); ?>vendors/gauge.js/dist/gauge.min.js"></script>
        <!-- bootstrap-progressbar - ->
        <script src="<?php echo base_url(); ?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck - ->
        <script src="<?php echo base_url(); ?>vendors/iCheck/icheck.min.js"></script>
        <!-- Skycons - ->
        <script src="<?php echo base_url(); ?>vendors/skycons/skycons.js"></script>
        <!-- Flot - ->
        <script src ="<?php echo base_url(); ?>vendors/Flot/jquery.flot.js"></script>
        <script src="<?php echo base_url(); ?>vendors/Flot/jquery.flot.pie.js"></script>
        <script src="<?php echo base_url(); ?>vendors/Flot/jquery.flot.time.js"></script>
        <script src="<?php echo base_url(); ?>vendors/Flot/jquery.flot.stack.js"></script>
        <script src="<?php echo base_url(); ?>vendors/Flot/jquery.flot.resize.js"></script>
        <!-- Flot plugins - ->
        <script src="<?php echo base_url(); ?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="<?php echo base_url(); ?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/flot.curvedlines/curvedLines.js"></script>
        <!-- DateJS - ->
        <script src="<?php echo base_url(); ?>vendors/DateJS/build/date.js"></script>
        <!-- JQVMap - ->
        <script src="<?php echo base_url(); ?>vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="<?php echo base_url(); ?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="<?php echo base_url(); ?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <!-- bootstrap-daterangepicker - ->
        <script src="<?php echo base_url(); ?>vendors/moment/min/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
        <!-- Custom Theme Scripts-->

        <script src="<?php echo base_url(); ?>/build/js/custom.min.js"></script>

        <script src='<?php echo base_url(); ?>JS/control_proyecto.js'></script>
        <script src='<?php echo base_url(); ?>JS/paula.js'></script>
        <script src='<?php echo base_url(); ?>JS/magali.js'></script>
       <!-- <script src='<?php echo base_url(); ?>JS/jquery-1.js'></script>
        <script src='<?php echo base_url(); ?>JS/jquery-ui.js'></script>-->
        <script src='<?php echo base_url(); ?>JS/erp_sg_v1_0.js'></script>
        <script src='<?php echo base_url(); ?>JS/funcionesRRHH.js'></script>
        <script src='<?php echo base_url(); ?>JS/funcionesSAV.js'></script>
        <script src='<?php echo base_url(); ?>JS/erp_sg_v1_0anterior.js'></script>
        <!---<script src='<?php echo base_url(); ?>JS/highcharts.js'></script>
        <script src='<?php echo base_url(); ?>JS/estadisticas.js'></script>
        <script src='<?php echo base_url(); ?>JS/exporting.js'></script>
        <script src='<?php echo base_url() . 'JS/drilldown.js'; ?>'></script>
        <script src='<?php echo base_url(); ?>JS/jquery.min.js'></script>-->
        <script src='<?php echo base_url(); ?>JS/adriana.js'></script>

        <!--<link rel='stylesheet' href='<?php //echo base_url();        ?>utilidades/calendar/css/jquery.ui.all.css' type='text/css'>-->
        <link rel='stylesheet' href='<?php echo base_url(); ?>utilidades/jqueryConfirm/jquery.confirm.css' type='text/css'>

        <script src='<?php echo base_url(); ?>utilidades/subirArchivos/jquery.min.js'></script>
        <!--<script type='text/javascript' src='<?php echo base_url(); ?>JS/jquery-1.9.1.js'></script>-->
        <script type='text/javascript' src='<?php echo base_url(); ?>utilidades/jqueryConfirm/jquery.confirm.js'></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>JS/funcionesRRHH.js'></script>

        <!--<link rel='stylesheet' href='<?php //echo base_url();        ?>utilidades/modForm/jquery-ui.css'>-->
        <script src='<?php echo base_url(); ?>utilidades/modForm/jquery-1.js'></script>
        <script src='<?php echo base_url(); ?>utilidades/modForm/jquery-ui.js'></script>
        <link rel='stylesheet' href='<?php echo base_url(); ?>utilidades/modForm/style.css'>
        <link  href=' <?php echo base_url(); ?>utilidades/JqueryArboles/jquery.treeview.css' rel='stylesheet'/>
        <script src='<?php echo base_url(); ?>utilidades/JqueryArboles/jquery.treeview.js' type='text/javascript'></script>
        <script src='<?php echo base_url(); ?>JS/contabilidad_v1.11.js'></script>
        <script src='<?php echo base_url(); ?>JS/rendicion.js'></script>
        <script src='<?php echo base_url(); ?>JS/rendiciones_r_v1.11.js'></script>
        <!--<script src='<?php echo base_url(); ?>JS/pago_proveedor.js'></script>-->
        <script src='<?php echo base_url(); ?>JS/lineas_servicios_telecom.js'></script>
        <script src='<?php echo base_url(); ?>JS/almacen.js'></script>
        <script src='<?php echo base_url(); ?>JS/chequera_electronica_v1.1.js'></script>
        <script src='<?php echo base_url(); ?>JS/centro_costos.js'></script>
        <script src='<?php echo base_url(); ?>JS/usuario.js'></script>
        <script src='<?php echo base_url(); ?>JS/factura_venta.js'></script>
        <script src='<?php echo base_url(); ?>JS/nota_fiscal.js'></script>
        <script src='<?php echo base_url(); ?>JS/credencial.js'></script>
        <script src='<?php echo base_url(); ?>JS/viaticos_extra.js'></script>

        <script src='<?php echo base_url(); ?>JS/jquery-barcode.js'></script>









    </body>
</html>