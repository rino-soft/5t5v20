<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php
    $this->load->view('includes/cabecera');
    ?>
    <body>
        <div class="">
            <div class="header">
                <div class="header_resize main">
                    <div class="logo">
                        <div class="container_12" >
                            
                                    <div class="clear"></div>
                                    <?php
                                    $this->load->view('includes/cabeza');
                                    ?>
                                    <div class="clear"></div>
                                
                        </div>
                    </div>
                    <?php
                    $this->load->view('menus/menu_superior_usuarios');
                    ?>
                </div>
            </div>
           
            <div class="fbg container_12">
                <div class="fbg_resize grid_12" id="cuerpo">
                    <div class="clr"></div>
                    <?php $this->load->view($main_conten); ?>

                </div>
            </div>
            <div class="footer">
                <div class="footer_resize pie">
                    <?php
                    $this->load->view('includes/piedepagina')
                    ?>
                </div>
            </div> 
        </div>    
    </body>
</html>