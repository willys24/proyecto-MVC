<?php

session_start(['name'=>'SPM']);

require_once "../config/app.php";

if (isset($_POST['busqueda_inicial']) || isset($_POST['eliminar_busqueda'])) {
	
	$data_url=[
		"usuario"=>"user-list",
		"plan"=>"plan-list",
		"licencia"=>"licencia-list",
		"predio"=>"predio-list"
	];

	if (isset($_POST['modulo'])) {
		$modulo = $_POST['modulo'];
		if (!isset($data_url[$modulo])) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No se pudo continuar con la busqueda",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}
	} else {
		$alerta=[
			"Alerta"=>"simple",
			"Titulo"=>"Ocurrió un error inesperado",
			"Texto"=>"No se pudo continuar con la busqueda",
			"Tipo"=>"error"
		];
		echo json_encode($alerta);
		exit();
	}


	

	$name_var="busqueda_".$modulo;

	// iniciar busqueda general
	if (isset($_POST['busqueda_inicial'])) {
		if ($_POST['busqueda_inicial']=="") {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"Introduzca un valor para la busqueda",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		$_SESSION[$name_var]=$_POST['busqueda_inicial'];
	}

	//eliminar busqueda general
	if (isset($_POST['eliminar_busqueda'])) {
		unset($_SESSION[$name_var]);
	}
	


	// redireccionar


	if (isset($_POST['id_url']) && $_POST['id_url']!="") {
		$url=$data_url[$modulo]."/".$_POST['id_url'];
	} else {
		$url=$data_url[$modulo];
	}

	
	$alerta=[
		"Alerta"=>"redireccionar",
		"URL"=>SERVERURL.$url."/"
	];
	echo json_encode($alerta);
	

} else {
	session_start(['name'=>'SPM']);
	session_unset();
	session_destroy();
	header("Location: ".SERVERURL."login/");
	exit();
}


