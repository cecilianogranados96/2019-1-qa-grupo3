<?php
session_start();
// include 'lib/config.php';

if(isset($_SESSION['usuario']))
{
  header("Location: inicio/");
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
			<form action="" method="post">
				<div class="form-group row">
					<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
					<input type="text" name="usuario" class="form-control" placeholder="Usuario">
				</div>

				<div class="form-group row">
					<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
					<input type="password" name="contrasenna" class="form-control" placeholder="Contraseña...">
				</div>
				<div class="form-group row">
					<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
					<input type="submit" name="boton" value="Ingresar" class="form-control">
				</div>
			</form>
			<?php
				if(isset($_POST['boton']))
				{
					// echo "LISTO";
					// session_start();
					include("php/dataBase.php");
					$usuario = $_POST['usuario'];
					$contrasenna = $_POST['contrasenna'];
					// echo $usuario . " - " . $contrasenna;
					$objeto = new dataBase();
					$result = $objeto->consultar("SELECT * FROM usuario");
					$todo = "";
					$objeto = 0;
					$flag = True;
					while (($fila = mysqli_fetch_array($result)) and $flag )
					{
						$todo = $todo . ", " . $fila['nombreUsuario'];
						if ($fila['direccionUsuario'] == $usuario)
						{
							$objeto = $fila;
							$flag = False;
						}
					}
					
					if ($flag)
					{
						echo "Usuario Incorrecto";
					}
					else
					{
						if ($objeto['contrasennaUsuario'] == $contrasenna)
						{
							$_SESSION['usuario'] = $objeto['nombreUsuario'];
							$_SESSION['id'] = $objeto['idUsuario'];
							// echo $objeto['nombreUsuario'] . "," . $objeto['apellidoUsuario'] . "," .  $objeto['direccionUsuario'] . "," .  $objeto['contrasennaUsuario'];
							header('Location: inicio/');
						}
						else
						{
							echo "Contraseña incorrecta";
						}
					}
				}
			?>
			</div>
			<div class="col-2"></div>

		</div>
		
    	<script src="js/script.js"/>
	</body>
</html>