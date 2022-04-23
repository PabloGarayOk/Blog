<?php

	if (isset($_POST['go_form'])) {

		require_once("view/Formulario.php");
	
	}elseif (isset($_POST['btn_enviar'])) {

		require_once("Transacciones.php");
	
	}else {

		require_once("view/MostrarBlog.php");
	}
