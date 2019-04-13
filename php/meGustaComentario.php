<?php
	session_start();
	// include 'lib/config.php';

	if(!isset($_SESSION['usuario']))
	{
	  header("Location: ../");
	}
	else
	{
		include("dataBase.php");
		$usuario = $_SESSION['id'];
		$idPub = $_SESSION['idPublicacion'];
		unset($_SESSION['idPublicacion']);
		$comentario = $_GET['idComentario'];
		$script = "insert into likeComentario (idComentario,idUsuarioLike) values (" . (int)$comentario . "," . (int)$usuario . ");";
		$objeto = new dataBase();
		$result = $objeto->insertar($script);
		header("Location: ../inicio/verComentarios.php?idPublicacion=" . $idPub);
	}
?>
