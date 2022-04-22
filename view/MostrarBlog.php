<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mostrar Blog</title>
</head>
<body>

	<?php

		require_once("model/ManejoObjetos.php");

		try {

			$conexion = new PDO('mysql:host=localhost; dbname=ddbb_blog', 'root', '');
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$ManejoObjetos = new ManejoObjetos($conexion);

			// Creamos una variable/objeto en donde almacenamos nuestra array con todas las entradas de blog
			$tabla_blog = $ManejoObjetos->getContenidoPorFechas();

			if(empty($tabla_blog)){

				echo "No hay entradas de blog";
			
			}else{
				// Recorremos el array y extraemos cada valor de cada elemento
				foreach($tabla_blog as $elemento){

					echo "<h2>" . $elemento->getTitulo() . "</h2>";
					echo "<h4>" . $elemento->getFecha() . "</h4>";
					echo "<div style='width:400px'>";
					echo $elemento->getComentario() . "</div>";

					if($elemento->getImagen() != ""){
						echo "<img src='Assets/images/";
						echo $elemento->getImagen() . "' width='300px' height='200px'/>";
					}

					echo "<hr/>";
				}
			}

			
		} catch (Exception $e) {

			die("Error: " . $e->getMessage());			
		}

	?>

	<br>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<a href="#"><input type='submit' name='go_form' id='' value='Volver al formulario de carga'></a>
	</form>
</body>
</html>