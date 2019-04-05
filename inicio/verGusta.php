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
				
				
				

				<?php
					$idPublicacion = (int)$_GET['idPublicacion'];
					$todo = '';
					// echo "idPublicacion: " . $idPublicacion . "</br>";
					include("../php/dataBase.php");
					// $usuario = $_POST['usuario'];
					// $contrasenna = $_POST['contrasenna'];
					// echo $usuario . " - " . $contrasenna;
					$objeto = new dataBase();
					$usuarioLogueado = (int)$_SESSION['id'];
					$consulta = "select * from likes inner join usuario on idUsuario=idUsuarioLike where idPublicacion=" . $idPublicacion . ";";
					// echo "con: " . $consulta;
					$result = $objeto->consultar($consulta);

					$flag = True;
					$contador = 0;
					// $todo = "";
					while (($fila = mysqli_fetch_array($result)) and $flag )
					{
						$contador = $contador+1;
						$todo = $todo . '<p>' . $fila['nombreUsuario'] . " " . $fila['apellidoUsuario'] . '</p></br>';
					}
					if($contador==0)
					{
						$todo = $todo . '<p>A nadie le gusta esta publicacion</p>';
					}

					else
					{
						if($contador==1)
						{
							$todo = $todo . '<p>A una persona le gusta esta publicacion</p>';
						}
						else
						{
							$todo = $todo . '<p>A ' . $contador . ' personas les gusta esta publicacion</p>';
						}
					}
						
					
					echo $todo;
					
					
				?>
				<a href="./">Regresar</a>
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