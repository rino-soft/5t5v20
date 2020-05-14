<form id="sendemail" action="<?php echo base_url(); ?>autenticacion/login" method="post">

nombre de usuario: <input name="usuario" class="text" id="usuario" value="" size="30" title="Ingrese su Nombre de Usuario" maxlength="2048" />
<br>
Contraseña :<input name="password" type="password" class="text" title="Ingrese su contraseña" 
                       id="password" value="" size="30" maxlength="2048" />

<br>
<input type="submit" value=" I N G R E S A R " class="enviar"/>
</form>