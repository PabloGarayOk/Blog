<?php

	require_once("ObjetoBlog.php");

	class ManejoObjetos{
		private $conexion;

		public function __construct($conexion){

			$this->setConexion($conexion);
		}

		public function setConexion(PDO $conexion){

			$this->conexion = $conexion;
		}

		// Obtiene el contenido en la bbdd
		public function getContenidoPorFechas(){
			
			$matriz = array();
			$resultado = $this->conexion->query("SELECT * FROM contenido ORDER BY Fecha DESC");

			while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
				
				$blog = new ObjetoBlog();

				$blog->setId($registro["Id"]);
				$blog->setTitulo($registro["Titulo"]);
				$blog->setFecha($registro["Fecha"]);
				$blog->setComentario($registro["Comentario"]);
				$blog->setImagen($registro["Imagen"]);

				$matriz[] = $blog;
			}

			return $matriz;
		}

		// Inserta contenido en la bbdd
		public function insertaContenido(ObjetoBlog $blog){

			$sql = "INSERT INTO contenido (Titulo, Fecha, Comentario, Imagen) VALUES ('" . $blog->getTitulo() . "','" . $blog->getFecha() . "','" . $blog->getComentario() . "','" . $blog->getImagen() . "')";

			$this->conexion->exec($sql);
		}

	} // end class ManejoObjetos

?>