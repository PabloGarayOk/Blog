<?php

	class ObjetoBlog{
		private $id;
		private $titulo;
		private $comentario;
		private $fecha;
		private $imagen;

		// Como esta clase no tiene constructor se utiliza el constructor por defecto, es decir sin nungun parametro

		// Metodos getters y setters

		public function getId(){
			return $this->id;
		}

		public function getTitulo(){
			return $this->titulo;
		}

		public function getComentario(){
			return $this->comentario;
		}

		public function getFecha(){
			return $this->fecha;
		}

		public function getImagen(){
			return $this->imagen;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function setTitulo($titulo){
			$this->titulo = $titulo;
		}

		public function setComentario($comentario){
			$this->comentario = $comentario;
		}

		public function setFecha($fecha){
			$this->fecha = $fecha;
		}

		public function setImagen($imagen){
			$this->imagen = $imagen;
		}

	} // end class ObjetoBlog

?>