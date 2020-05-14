<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php echo $titulo ?></title>
	</head>
	
	<body>

		<h2>Login codeigniter con nuestra librería</h2>
		
		<?php echo anchor('../home/logout_user','Cerrar sesión') ?><br />
		
		<div>
			Tu usuario es: <?php echo $this->session->userdata('username') ?><br />
			Tu password encriptado es: <?php echo $this->session->userdata('password') ?>
		</div>
	</body>
</html>
