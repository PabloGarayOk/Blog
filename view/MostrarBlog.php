<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="Assets/css/main.css" />
	<link rel="stylesheet" type="text/css" href="Assets/css/blog.css" />
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet"/>
	<title>Mostrar Blog</title>
</head>
<body>
	<div class="main">
		
		<section class="blogs">

			<h1 class="blog__principal-title">MINI BLOG</h1>

			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<a class="bot__goform" href="#"><input type='submit' name='go_form' id='' value="Ir al formulario de carga"></a>
			</form>	

			<?php

				require_once("model/ManejoObjetos.php");
				require_once("model/config.php");

				try {

					$conexion = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NOMBRE."; charset=".DB_CHARSET."", DB_USUARIO, DB_CONTRA);
					$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$ManejoObjetos = new ManejoObjetos($conexion);

					// Creamos una variable/objeto en donde almacenamos nuestra array con todas las entradas de blog
					$tabla_blog = $ManejoObjetos->getContenidoPorFechas();

					if(empty($tabla_blog)): 

						echo "<h2>No hay entradas de blog</h2>";
					
					else: ?>
									
						<?php foreach($tabla_blog as $elemento): ?>
							
									<div class="blog">
										<h2 class="blog__title"><?=$elemento->getTitulo()?></h2>
										<p class="blog__date"><i><?=$elemento->getFecha()?></i></p>
										<div class="blog__comment">
											<?=$elemento->getComentario()?>
										</div>

								<?php if($elemento->getImagen() != ""): ?>

										<img src='Assets/images/<?= $elemento->getImagen() ?>' />

								<?php endif; ?>

								</div> <!-- End class blog -->
						
						<?php endforeach;

					endif;
					
				} catch (Exception $e) {

					die("Error: " . $e->getMessage());			
				}

			?>
			
		</section><!-- End Section blogs -->
	</div><!-- End Main -->
</body>
</html>