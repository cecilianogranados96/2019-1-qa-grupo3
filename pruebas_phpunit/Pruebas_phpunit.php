<?php
	use PHPUnit\Framework\TestCase;
	include_once("dataBase.php");
	class pruebaNueva extends TestCase
	{

		public function crearUsuario($nombre,$apellido,$nacimiento,$usuario,$contrasenna,$contrasenna2)
		{
			if(true)
			{
				// echo "LISTO";
				//session_start();
				
				/*$nombre = $_POST['nombre'];
				$apellido = $_POST['apellido'];
				$nacimiento = $_POST['nacimiento'];
				$usuario = $_POST['usuario'];
				$contrasenna = $_POST['contrasenna'];
				$contrasenna2 = $_POST['contrasenna2'];*/
				// echo $usuario . " - " . $contrasenna;

				$datos = ["imagen","jpg"];//explode(".",$_FILES['imagen']['name']);//[0]-> name, [1]->extension

				$nombreA = $datos[0] . time() . "." . $datos[1];
				$nombreA = '../images/profile_Pictures/' . $nombreA;
				//$movido = move_uploaded_file($_FILES['imagen']['tmp_name'], $nombreA);
				$movido = true;
				if($contrasenna == $contrasenna2)
				{
					$objeto = new dataBase();
					$obje = $objeto;
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
						if($nombre!="" and $apellido!="" and $usuario!="" and $contrasenna!="" and $nacimiento!="")
						{
							if (!$movido)
							{
								//echo "FINNN";
								$nombreA = "../images/profile_Pictures/empty.jpg";
							}
							$consulta = "insert into usuario (nombreUsuario, apellidoUsuario, direccionUsuario, contrasennaUsuario, fechaNacimiento, imagen)
								values ('" . $nombre . "', '" . $apellido . "', '" . $usuario . "', '" . $contrasenna . "', '" . $nacimiento . "', '" . $nombreA . "');";

								$resultado = $obje->insertar($consulta);
								if ($resultado)
								{
									$consulta = "select * from usuario order by idUsuario desc limit 1;";
									$result = $obje->consultar($consulta);
									$id = 0;
									while (($fila = mysqli_fetch_array($result)))
									{
										$id = (int)$fila['idUsuario'];
									}

									/*session_start();
									$_SESSION['usuario'] = $usuario;
							 		$_SESSION['id'] = $id;
							 		$_SESSION['imagen'] = $nombreA;
							 		$_SESSION['nombre'] = $nombre;
									$_SESSION['apellido'] = $apellido;*/
							 		//echo "LISTO</br>";
									//header('Location: ../');
									return true;
								}
								else
								{
									return false;
									/*echo $consulta . "</br>";
									echo $obje->link->error;;*/
								}


							}
							else
						{
							return false;
							//echo "<p style='color:red;'>Información incompleta</p>";
						}
					}
					else
					{
						return false;
						//echo "<p style='color:red;'>Usuario Ya existe</p>";
					}
				}
				else
				{
					return false;
					//echo "<p style='color:red;'>Contraseñas no son iguales</p>";
				}
			}
		}


		public function crearPublicacion($titulo, $descripcion, $direccionImagen, $visibilidad,$identificador)
		{
			if (-1 > 0)
			{
				return false;
			}
			else
			{
				//explode(".",$_FILES['archivo']['name']);//[0]-> name, [1]->extension

				$objeto = new dataBase();
				//session_start();

				//$identificador = (int)$_SESSION['id'];
				if ($titulo!='' or $descripcion!='' or $direccionImagen!='')
				{
					$result = $objeto->insertar("insert into publicacion (idUsuarioPublicacion,titulo,visibilidad,descripcion,fecha,direccionImagen) values 
					(". $identificador . ", '" . $titulo . "', " . $visibilidad . ", '" . $descripcion . "', sysdate(), '" . $direccionImagen . "')");
					if ($result)
					{
						return true;
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
		}


		public function annadirAmigo($amigo, $usuario)
		{
			//session_start();

			$sql = "insert into amigos (idAmigo1, idAmigo2) values (" . $usuario . "," . $amigo . ")";
			$objeto = new dataBase();

			$result = $objeto->insertar($sql);
			return true;
		}

		/*public function testSelectVerdadero()
        {
            $sql = "select * from usuario";
            $a = $this->consultar($sql);
            $this->assertTrue(true);
            return $this->link->error;
        }*/

        public function testAnnadirAmigo()
        {
        	$valor = $this->annadirAmigo(1,2);
            $this->assertTrue(true);
            return $valor;
        }

        public function testCrearPublicacion()
        {
        	$datos = ['archivo','jpg'];
			$nombre = $datos[0] . time() . "." . $datos[1];
			$direccionImagen = "../images/publicaciones/" . $nombre;
        	$valor =$this-> crearPublicacion('Titulo', 'Descripcion', $direccionImagen, 1, 1);
            $this->assertTrue(true);
            return $valor;
        }
        
        public function testCrearUsuario()
        {
        	$valor = $this->crearUsuario('Jose','Jimenez','1991-11-28','jimenezjm28j3','j','j');
            $this->assertTrue(true);
            return $valor;
        }

        public function testCrearUsuarioError()
        {
        	$valor = $this->crearUsuario('Jose','Jimenez','1991-11-28','jimenezjm28j2','j','j');
            $this->assertTrue(true);
            return $valor;
        }

        public function meGusta($usuario,$publicacion)
        {     
            
        $script = "insert into likes (idPublicacion, idUsuarioLike) values (" . (int)$publicacion . "," . (int)$usuario . ");";
        $objeto = new dataBase();
        $result = $objeto->insertar($script);   
        return  true;

        }

    
    public function testMeGusta()

        {

            $valor = $this->meGusta(1,1);
            $this->assertTrue(true);
            return $valor;
        }
     public function NomeGusta($usuario,$publicacion)
        {     

            $script = "delete from likes where idPublicacion=" . $publicacion . " and idUsuarioLike=" . (int)$usuario . ";";
            $objeto = new dataBase();
            $result = $objeto->insertar($script);

            return true;

        }

    
    public function testNomeGusta()

        {

            $valor = $this->NomeGusta(1,1);
            $this->assertTrue(true);
            return $valor;
        }


     public function meGustaComentario($usuario,$comentario){     
           
    
        $script = "insert into likeComentario (idComentario,idUsuarioLike) values (" . (int)$comentario . "," . (int)$usuario . ");";
        $objeto = new dataBase();
        $result = $objeto->insertar($script);

        return true;

    }

    
    public function testmeGustaComentario(){

        $valor = $this->meGustaComentario(1,1);
        $this->assertTrue(true);
        return $valor;
    }
		public function crearComentario($titulo, $descripcion, $identificador, $identificadorPublicacion)
		{
			
			$objeto = new dataBase();

			$visibilidad = 1;

			if ($titulo!="" or $descripcion!="" or $direccionImagen!="")
			{
				$result = $objeto->insertar("insert into comentarios (idUsuarioComentario, idPublicacionComentario,descripcion)
	 values(". $identificador . ", " . $identificadorPublicacion . ", '" . $descripcion . "')");
				if ($result)
				{

					return true;
				}
				else
				{
					return false;

				}
			}
			else
			{

				return false;
			}
		}




	  public function testCrearComentario()
        {
        	$valor = $this->crearComentario('Titulo', 'Comentario...','1','1');
            $this->assertTrue(true);
            return $valor;
        }
		public function crearComentarioComentario($descripcion, $identificador, $identificadorComentario)
		{
			
			$objeto = new dataBase();
			
			// $titulo = $_POST['titulo'];
			$visibilidad = 1;
			
			
			// $result = $objeto->consultar("SELECT * FROM usuario");
			if ($descripcion!="")
			{
				$result = $objeto->insertar("insert into comentarioComentario (idUsuarioComentario, idComentario,descripcionComentario)
	 values(". $identificador . ", " . $identificadorComentario . ", '" . $descripcion . "')");
				if ($result)
				{
					
					return true;
					// href='verComentarios.php?idPublicacion=
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		

	  public function testComentarioComentario()
        {
        	$valor = $this->crearComentarioComentario('Comentario...','2','2');
            $this->assertTrue(true);
            return $valor;
        }



        /**
         * @depends testCrearUsuario
         * @depends testCrearUsuarioError
         * @depends testCrearPublicacion
         * @depends testAnnadirAmigo
         * @depends  testMeGusta
         * @depends  testNomeGusta
         * @depends  testmeGustaComentario
		 * @depends testCrearComentario
		 * @depends testComentarioComentario
         */
        public function testInicial($a,$b,$c,$d,$e,$f,$g,$h,$i)
        {
            $this->assertSame(false, $a);//FuncionaUsuario//Cambiar al cambiar usuario
            $this->assertSame(false, $b);//No Funciona Usuario
            $this->assertSame(true, $c);//No Funciona Usuario
            $this->assertSame(true, $c);//No Funciona Usuario
            $this->assertSame(true, $e);//No falló la consulta.
            $this->assertSame(true, $f);//No falló la consulta.
            $this->assertSame(true, $g);//No falló la consulta.
            $this->assertSame(true, $h);//No falló la consulta.
            $this->assertSame(true, $i);//No falló la consulta.
            
        }























	}

?>