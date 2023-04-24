<!DOCTYPE html>
<html lang="en">
<head>
	<title>supermercado</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="view/bootstrap/otros/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="view/bootstrap/otros/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="view/bootstrap/otros/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="view/bootstrap/otros/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="view/bootstrap/otros/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="view/bootstrap/otros/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="view/bootstrap/otros/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="view/bootstrap/otros/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="view/bootstrap/otros/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="view/bootstrap/otros/login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(view/bootstrap/otros/login/images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Recuperar Contraseña
					</span>
				</div>

				<form class="login100-form validate-form" action="<?php echo $helper->url("Usuarios","resetear_clave_inicio"); ?>" method="post" >
					
					<div class="wrap-input100 validate-input m-b-26" data-validate="Ingrese Cedula">
						<span class="label-input100">Usuario:</span>
						<input class="input100" type="text" name="cedula_usuarios" id="cedula_usuarios" placeholder="cedula..">
						<span class="focus-input100"></span>
					</div>

					
					<div class="container-login100-form-btn">
						<input  type="submit" id="Login" class="login100-form-btn" value="Recuperar">
						
						 <a class="login100-form-btn" href="<?php echo $helper->url("Usuarios","Inicio"); ?>">Volver</a>
						
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="view/bootstrap/otros/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="view/bootstrap/otros/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="view/bootstrap/otros/login/vendor/bootstrap/js/popper.js"></script>
	<script src="view/bootstrap/otros/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="view/bootstrap/otros/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="view/bootstrap/otros/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="view/bootstrap/otros/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="view/bootstrap/otros/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="view/bootstrap/otros/login/js/main.js"></script>

</body>
</html>