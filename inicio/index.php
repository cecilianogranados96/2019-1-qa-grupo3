<?php
session_start();
// include 'lib/config.php';

if(!isset($_SESSION['usuario']))
{
  header("Location: ../");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Añadir Usuario</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	</head>
	<body>
		<div class="row pt-5">
		</div>
		<div class="row">
			<div class="col-2"></div>
			<div class="col-8">
			<form action="../php/cerrarSesion.php" method="post">
				<!-- <div class="form-group row">
					<label for="flname" class="col-sm-12 col-form-label labels">Usuario</label>
					<input type="text" name="usuario" class="form-control" placeholder="Usuario">
				</div>

				<div class="form-group row">
					<label for="flname" class="col-sm-12 col-form-label labels">Usuario</label>
					<input type="password" name="contrasenna" class="form-control" placeholder="Contraseña...">
				</div> -->
				<div class="form-group row">
					<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
					<input type="submit" name="boton" value="Cerrar Sesion" class="form-control">
				</div>
			</form>
			</div>
			<div class="col-2"></div>
		</div>
		<?php
			// session_start();
			echo "Usuario: " . $_SESSION['usuario'] . "</br>ID: " . $_SESSION['id'] . "</br>";
		?>
    	<script src="js/script.js"/>
	</body>
</html>