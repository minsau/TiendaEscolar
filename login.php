<?php
session_start();
$path = 'static/';
?>

<!DOCTYPE html>
<html lang="en" ng-app="loginApp">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $path; ?>css/bootstrap.css">
</head>
<body ng-controller="loginController">

	<form>
	<div id="formLogin" class="col-md-6 col-md-offset-3" >
		<div class="panel panel-default">
			<div class="panel-heading">
				Ingresar al sistema
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="user">Correo:</label>
					<input type="email" name="user" class="form-control" ng-model="usuario.correo">
				</div>

				<div class="form-group">
					<label for="pass">Password:</label>
					<input type="password" name="pass" class="form-control" ng-model="usuario.pass">
				</div>

				<div class="alertas">
					{{login.mensaje}}
				</div>
				<button id="ingresar" ng-click="loguear()">Ingresar</button>
			</div>
		</div>
	</div>
</form>
	<script type="text/javascript" src="<?php echo $path; ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo $path; ?>js/angular.js"></script>
	<script type="text/javascript" src="controllers/loginApp.js"></script>
</body>
</html>
