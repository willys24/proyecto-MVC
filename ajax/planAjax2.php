<?php

$peticionAjax = true;
require_once "../config/app.php";


if (isset($_POST['plan_id_up'])) {
	// instancia al controlador

	require_once "../controladores/planControlador.php";
	$ins_plan = new planControlador();


/*
	if (isset($_POST['plan_id_up'])) {
		echo $ins_plan->actualizar_plan_controlador();
	}
*/

	echo $_POST['plan_id_up'];

}else{
	//si acceden al archivo desde la url
	/*session_start(['name'=>'SPM']);
	session_unset();
	session_destroy();
	header("Location: ".SERVERURL."login/");
	exit();*/
}