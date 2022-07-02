<?php

$peticionAjax = true;
require_once "../config/app.php";


if (isset($_POST['predio_matricula_reg']) || isset($_POST['predio_id_delete']) || isset($_POST['predio_id_up'])) {
	// instancia al controlador

	require_once "../controladores/predioControlador.php";
	$ins_predio = new predioControlador();


	// Agregar un usuario
	if (isset($_POST['predio_matricula_reg']) && isset($_POST['predio_numero_reg'])) {
		echo $ins_predio->agregar_predio_controlador();
	}

	// Actualizar un usuario
	if (isset($_POST['predio_id_up'])) {
		echo $ins_predio->actualizar_predio_controlador();
	}

	// Eliminar un usuario
	if (isset($_POST['predio_id_delete'])) {
		echo $ins_predio->eliminar_predio_controlador();
	}

}else{
	//si acceden al archivo desde la url
	session_start(['name'=>'SPM']);
	session_unset();
	session_destroy();
	header("Location: ".SERVERURL."login/");
	exit();
}