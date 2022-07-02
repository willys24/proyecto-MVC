<?php

$peticionAjax = true;
require_once "../config/app.php";


if (isset($_POST['plan_nombre_reg']) || isset($_POST['plan_id_delete']) || isset($_POST['plan_id_up'])) {
	// instancia al controlador

	require_once "../controladores/planControlador.php";
	$ins_plan = new planControlador();


	// Agregar un usuario
	if (isset($_POST['plan_nombre_reg']) && isset($_POST['plan_decreto_reg'])) {
		echo $ins_plan->agregar_plan_controlador();
	}

	// Actualizar un usuario
	if (isset($_POST['plan_id_up'])) {
		echo $ins_plan->actualizar_plan_controlador();
	}

	// Eliminar un usuario
	if (isset($_POST['plan_id_delete']) && !isset($_POST['plan_id_up'])) {
		echo $ins_plan->eliminar_plan_controlador();
	}

}else{
	//si acceden al archivo desde la url
	session_start(['name'=>'SPM']);
	session_unset();
	session_destroy();
	header("Location: ".SERVERURL."login/");
	exit();
}