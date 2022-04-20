<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Transacciones</title>
</head>
<body>

	<?php

		require_once("../model/ObjetoBlog.php");
		require_once("../model/ManejoObjetos.php");

		try {

			$conexion = new PDO('mysql:host=localhost; dbname=ddbb_blog', 'root', '');
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			

			//Verificamos si la imagen se envio correctamente
			if($_FILES['imagen']['error']){

				switch ($_FILES['imagen']['error']){
					case 1: // 	Error por exceso de tamaño en archivo php.ini
						echo "El tama&ntilde;o del archivo excede lo permitido por el servidor";
						break;
					case 2: // 	Error tamaño de archivo marcado en el formulario
						echo "El tama&ntilde;o del archivo excede 2M";
						break;
					case 3: // 	Error en el envio del archivo
						echo "El env&iacute;o del archivo se interrumpi&oacute; y no fu&eacute; subido";
						break;
					case 4: // 	No hay archivo
						echo "El se ha enviado ning&uacute;n archivo";
						break;
				}
			}else{

				echo "<br><br>No hay error en la transferencia del archivo.<br/>";

				if ((isset($_FILES['imagen']['name']) && ($_FILES['imagen']['error'] == UPLOAD_ERR_OK))) {
					
					$destino_de_ruta = "../Assets/images/";
					$nombre_temporal = $_FILES['imagen']['tmp_name'];
					$nombre_final = $_FILES['imagen']['name'];

					// Movemos el archivo a la carpeta final
					move_uploaded_file($nombre_temporal, $destino_de_ruta . $nombre_final);

					echo "El archivo " . $nombre_final . " se ha copiado en el directorio de im&aacute;genes.<br>";
				
				}else{
					echo "El archivo no se ha podido copiar en el directorio de im&aacute;genes.";
				}
			}

			// Creamos nuestro objeto que tiene la conexion
			$ManejoObjetos = new ManejoObjetos($conexion);

			// Creamos un objeto de tipo blog para acceder a sus propiedades y metodos para almacenar las entradas

			$blog = new ObjetoBlog(); // Como esta clase no tiene constructor se utiliza el constructor por defecto, es decir sin ningun parametro.

			// Rescatamos los valores del formulario y los almacenamos en nuestro objeto $blog
			
			date_default_timezone_set('America/Argentina/Buenos_Aires'); // Seteamos la hora
			
			/*
			$el_titulo = $_POST['campo_titulo'];
			$la_fecha = date("Y-m-d H:i:s");
			$el_comentario = $_POST['area_comentarios'];
			$la_imagen = $nombre_final;

			$blog->setTitulo($el_titulo);
			$blog->setFecha($la_fecha);
			$blog->setComenrario($el_comentario);
			$blog->setImagen($la_imagen);
			*/

			// Ver si conviene reemplazar "htmlentities" por "htmlspecialchars"
			$blog->setTitulo(htmlentities(addslashes($_POST['campo_titulo']), ENT_QUOTES));
			$blog->setFecha(date("Y-m-d H:i:s"));
			$blog->setComentario(htmlentities(addslashes($_POST['area_comentarios']), ENT_QUOTES));
			$blog->setImagen($_FILES['imagen']['name']);

			// Ahora insertamos en la bbdd nuestra entrada
			$ManejoObjetos->insertaContenido($blog);

			echo "Entrada de blog agregada con &eacute;xito<br>";

		} catch (Exception $e) {
			
			die("Error: " . $e->getMessage());
		}

	?>

</body>
</html>