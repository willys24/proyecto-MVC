<?php

$peticionAjax = true;
require_once "../config/app.php";


if (isset($_POST['licencia_nombre_reg']) || isset($_POST['licencia_id_delete']) || isset($_POST['licencia_id_up'])) {
	// instancia al controlador

	require_once "../controladores/licenciaControlador.php";
	$ins_licencia = new licenciaControlador();


	// Agregar un usuario
	if (isset($_POST['licencia_nombre_reg']) && isset($_POST['licencia_numero_reg'])) {
		echo $ins_licencia->agregar_licencia_controlador();
	}

	// Actualizar un usuario
	if (isset($_POST['licencia_id_up'])) {
		echo $ins_licencia->actualizar_licencia_controlador();
	}

	// Eliminar un usuario
	if (isset($_POST['licencia_id_delete']) && !isset($_POST['licencia_id_up'])) {
		echo $ins_licencia->eliminar_licencia_controlador();
	}

}else{
	//si acceden al archivo desde la url
	session_start(['name'=>'SPM']);
	session_unset();
	session_destroy();
	header("Location: ".SERVERURL."login/");
	exit();
}