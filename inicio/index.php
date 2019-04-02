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
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	</head>
	<body>
		<div class="row pt-5">
		</div>
		<div class="row">
			<div class="col-2"></div>
			<!-- <div class="col-8"> -->
			
			


			<!-- Historias -->
			<div class="col-8">
				<form action="../php/cerrarSesion.php" method="post" class="width:100%;">
					<div class="form-group row">
						<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
						<input type="submit" name="boton" value="Cerrar Sesion" class="form-control">
					</div>
				</form>
				
				<form action="../php/crearPublicacion.php" method="post" class="width:100%;" enctype="multipart/form-data">
					<div class="form-group row">
						<label for="flname" class="col-sm-12 col-form-label labels">Titulo</label>
						<input type="text" name="titulo" value="" class="form-control" placeholder="Título...">
					</div>

					<div class="form-group row">
						<label for="flname" class="col-sm-12 col-form-label labels">Descripción</label>
						<textarea type="text" name="descripcion" value="" class="form-control" placeholder="Descripcion..."></textarea>
					</div>

					<div class="form-group row">
						<label for="flname" class="col-sm-12 col-form-label labels">Subir Imagen</label>
						<input type="file" name="archivo" id="archivo"></input>
					</div>

					<select name="visibilidad" class="">
						<option value="1">Pública</option>
						<option value="0">Privada</option>
					</select>

					<div class="form-group row">
						<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
						<input type="submit" name="boton" value="Crear" class="form-control">
					</div>

				</form>

				<?php
					$todo = '';
					include("../php/dataBase.php");
					// $usuario = $_POST['usuario'];
					// $contrasenna = $_POST['contrasenna'];
					// echo $usuario . " - " . $contrasenna;
					$objeto = new dataBase();
					$usuarioLogueado = (int)$_SESSION['id'];
					$consulta = "SELECT * FROM publicacion as p inner join amigos as a on a.idAmigo1=p.idUsuario or a.idAmigo2=p.idUsuario inner join usuario as u on p.idUsuario = u.idUsuario where a.idAmigo1=". $usuarioLogueado . " or a.idAmigo2=". $usuarioLogueado ." or p.visibilidad=0  order by p.idPublicacion desc;";
					
					$consulta = "SELECT idPublicacion, idUsuarioPublicacion, titulo,
						 visibilidad, descripcion, fecha, direccionImagen, idUsuario, nombreUsuario, apellidoUsuario,, 1 as amigo
						 FROM publicacion as p
						 inner join amigos as a on a.idAmigo1=p.idUsuarioPublicacion or a.idAmigo2=p.idUsuarioPublicacion
						 inner join usuario as u on p.idUsuarioPublicacion = u.idUsuario 
						 where a.idAmigo1=" . $usuarioLogueado . " or a.idAmigo2=" . $usuarioLogueado ."
						 
						 union
						 
						 select idPublicacion, idUsuarioPublicacion, titulo,
						 visibilidad, descripcion, fecha, direccionImagen, idUsuario, nombreUsuario, apellidoUsuario, 0 as amigo
						 from publicacion as p
						  inner join usuario as u on p.idUsuarioPublicacion = u.idUsuario
						 where visibilidad = 0 or idUsuarioPublicacion=" . $usuarioLogueado . "
						  order by idPublicacion desc;";

					//echo $consulta;
					//$consulta = "SELECT * FROM publicacion as p inner join usuario as u on p.idUsuario = u.idUsuario order by p.idPublicacion desc";
					$result = $objeto->consultar($consulta);
					// $todo = "";
					// $objeto = 0;
					$flag = True;
					while (($fila = mysqli_fetch_array($result)) and $flag )
					{
						$todo = $todo . '<div class="my-2 mx-auto p-relative bg-white shadow-1" style="width: 100%; overflow: hidden; border-radius: 1px;">';
						// $idAnnadir = 4;

						// if(!((int)$fila['idAmigo1'] == $usuarioLogueado))
						// {
						// 	$usuarioLogueado = (int)$fila['idAmigo1'];
						// }
						
						$todo = $todo . $fila['nombreUsuario'] . " " . $fila['apellidoUsuario'] . " - " . $fila['fecha'] . " Visibilidad: " . $fila['visibilidad'];// . " ID: " . $usuarioLogueado;
						$todo = $todo . '<h4 class="card-title">' . $fila['titulo'] . '</h4>';
						//$todo = $todo . $fila['direccionImagen'] ;
						$todo = $todo . '<img src="' . $fila['direccionImagen'] . '" alt="' . $fila['titulo'] . '" height="50%" width="50%">';

						$todo = $todo . '<p class="card-description">' . $fila['descripcion'] . '</p>';

						$todo = $todo . "<a href='../php/annadirAmigo.php?identificadorAmigo=" . $usuarioLogueado . "' style='color:red;'><i class='fas fa-user-plus'></i></i></a>";//No like
						$todo = $todo . "<a href='#' style='color:red;'><i class='far fa-thumbs-up'></i></a>";

						// $todo = $todo . "<a href='#' style='color:red;'><i class='fas fa-thumbs-up'></i></a>";//Like

						$todo = $todo . '</div>';

					// 	if ($fila['direccionUsuario'] == $usuario)
					// 	{
					// 		// $objeto = $fila;
					// 		$flag = False;
					// 	}
					// }
					}
						
					
					echo $todo;
				?>
			</div>





			<!-- </div> -->
			<div class="col-2"></div>
		</div>
		<?php
			// session_start();
			echo "Usuario: " . $_SESSION['usuario'] . "</br>ID: " . $_SESSION['id'] . "</br>";
		?>
    	<script src="../js/script.js"/>
	</body>
</html>