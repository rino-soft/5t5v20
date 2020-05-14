<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $titulo ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('CSS/login_styles_v1.2.css') ?>" />
    </head>

    <body>
        <div class="div_centro_cabeza " class='alin_cen'>

            <p id="sesion_cerrada"> 
                <?php echo $this->session->flashdata('cerrada') !== FALSE ? $this->session->flashdata('cerrada') : '' ?>
            </p>

            <div id="errores_formulario"><?php echo validation_errors(); ?></div>

            <p id="error_login"> 
                <?php echo "mensaje error :" . $this->session->flashdata('noexiste') ? $this->session->flashdata('noexiste') : '' ?>	
            </p>

        </div>
        <div class="div_centro fondo_blanco " style="position: relative">


            <div  class="div_form" style=" position: absolute ; top: 50px; left: 200px;width:340px; height: 80px;" > </div>
            <div  class="" style=" position: absolute ; top: 50px; left: 200px" > 

                <div id="formulario_login" style=" opacity: 1; filter: alpha(opacity=100); width: 340px;" >

                    <?php echo form_open(base_url('login/user_login')) ?>

                    <div class="espaciado" style="float: left; width: 100px;font-weight: 400; font-size: 20px;text-align: right;">Usuario</div>
                    <div class="espaciado" style="float: left; width: 150px;">    <?php echo form_input($campos['username']); ?></div>
                    <div class="espaciado" style="float: left; width: 100px;font-weight: 400; font-size: 20px; text-align: right;">Contraseña</div>
                    <div class="espaciado" style="float: left; width: 150px;"><?php echo form_password($campos['input_password']); ?></div>

                    <?php echo form_hidden('token', $token); ?>
                    <div class="espaciado" style="float: right">
                        <?php echo form_submit('submit', 'Ingresar', 'class="boton_ingresar"'); ?>
                    </div>

                    <?php echo form_close() ?>
                </div>
            </div>
            <div style="position: absolute; "class="div_logo" > 
                <div style="position: absolute; top:35px; left: 3px; " class="div_e3 imgr"  > </div>

                <div style="position: absolute; top:50px; left: 70px; " id='rueda' class="div_e1 imgr" > </div>
                <div style="position: absolute; top:40px; left: 110px; " class="div_e2 imgr" ></div> 

                <div style="position: absolute; top:60px; left: 130px; " id='rueda' class="div_e4 imgr" > 


                </div>
            </div>



        </div>

        <div class="div_centropeque  " style="text-align: center; color: #cccccc; font-family: monospace; font-size: 12px; font-weight: bold">
            Departamento TIC STS Bolivia Ltda<br>Copyrigth <?php echo date("Y") ?> &copy; 
        </div>
        <div class="div_centro_pie ">
            <div id='imagen1'></div>
            <div id="imagen2"></div>
            <div style="text-align: left; color: #cccccc; font-family: monospace; font-size: 12px;">
                <br><span style="font-size: 13px; font-weight: bold ; color: #c1e0ff">Desarrollo de Software</span> <br>
                <span style="font-weight: bold; color: #eeeeee" >* Ruben Payrumani Ino / * Magali Poma Rivero </span>/ Corp : 67002488 Telf: 240 6667 Int 113 <br>
                <span style="font-size: 13px; font-weight: bold; color: #ffecc1">Soporte & mantenimiento de Hardware</span><br>
                <span style="font-weight: bold">*Crissthiam Galvez Claros </span>/ Corp 67002488 Telf: 240 6667 int 132 </div>
        </div>
    </body>
</html>
