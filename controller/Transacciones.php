<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Transacciones</title>
</head>
<body>

	<?php

		require_once("model/ObjetoBlog.php");
		require_once("model/ManejoObjetos.php");
		require_once("model/config.php");

		try {

			$conexion = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NOMBRE."; charset=".DB_CHARSET."", DB_USUARIO, DB_CONTRA);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			

			//Verificamos si la imagen se envio correctamente
			if($_FILES['imagen']['error']){

				switch ($_FILES['imagen']['error']){
					case 1: // 	Error por exceso de tamaño en archivo php.ini
						echo "<p>El tama&ntilde;o del archivo excede lo permitido por el servidor</p>";
						break;
					case 2: // 	Error tamaño de archivo marcado en el formulario
						echo "<p>El tama&ntilde;o del archivo excede 2M</p>";
						break;
					case 3: // 	Error en el envio del archivo
						echo "<p>El env&iacute;o del archivo se interrumpi&oacute; y no fu&eacute; subido</p>";
						break;
					case 4: // 	No hay archivo
						echo "<p>El se ha enviado ning&uacute;n archivo</p>";
						break;
				}

				require_once("view/Formulario.php");

			}else{

				echo "<br><br><p>No hay error en la transferencia del archivo.</p><br/>";

				if ((isset($_FILES['imagen']['name']) && ($_FILES['imagen']['error'] == UPLOAD_ERR_OK))) {
					
					$destino_de_ruta = "Assets/images/";
					$nombre_temporal = $_FILES['imagen']['tmp_name'];
					$nombre_final = $_FILES['imagen']['name'];

					// Movemos el archivo a la carpeta final
					move_uploaded_file($nombre_temporal, $destino_de_ruta . $nombre_final);

					echo "<p>El archivo <i>" . $nombre_final . "</i> se ha copiado en el directorio de im&aacute;genes.</p><br>";
				
				}else{
					echo "<p>El archivo no se ha podido copiar en el directorio de im&aacute;genes.</p>";
				}

			}

			// Creamos nuestro objeto que tiene la conexion
			$ManejoObjetos = new ManejoObjetos($conexion);

			// Creamos un objeto de tipo blog para acceder a sus propiedades y metodos para almacenar las entradas

			$blog = new ObjetoBlog(); // Como esta clase no tiene constructor se utiliza el constructor por defecto, es decir sin ningun parametro.

			// Rescatamos los valores del formulario y los almacenamos en nuestro objeto $blog
			
			date_default_timezone_set('America/Argentina/Buenos_Aires'); // Seteamos la hora

			// Ver si conviene reemplazar "htmlentities" por "htmlspecialchars"
			$blog->setTitulo(htmlentities(addslashes($_POST['campo_titulo']), ENT_QUOTES));
			$blog->setFecha(date("Y-m-d H:i:s"));
			$blog->setComentario(htmlentities(addslashes($_POST['area_comentarios']), ENT_QUOTES));
			$blog->setImagen($_FILES['imagen']['name']);

			// Ahora insertamos en la bbdd nuestra entrada
			$ManejoObjetos->insertaContenido($blog);

			echo "<p><strong>Entrada de blog agregada con &eacute;xito.</strong></p><br><br>";

			require_once("view/Formulario.php");

		} catch (Exception $e) {
			
			die("Error: " . $e->getMessage());
		}

	?>

</body>
</html>