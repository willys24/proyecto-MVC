<?php

$peticionAjax = true;
require_once "../config/app.php";


if (isset($_POST['usuario_usuario_reg']) || isset($_POST['usuario_id_delete']) || isset($_POST['usuario_id_up'])) {
	// instancia al controlador

	require_once "../controladores/usuarioControlador.php";
	$ins_usuario = new usuarioControlador();


	// Agregar un usuario
	if (isset($_POST['usuario_usuario_reg']) && isset($_POST['usuario_nombre_reg'])) {
		echo $ins_usuario->agregar_usuario_controlador();
	}

	// Actualizar un usuario
	if (isset($_POST['usuario_id_up'])) {
		echo $ins_usuario->actualizar_usuario_controlador();
	}

	// Eliminar un usuario
	if (isset($_POST['usuario_id_delete'])) {
		echo $ins_usuario->eliminar_usuario_controlador();
	}

}else{
	//si acceden al archivo desde la url
	session_start(['name'=>'SPM']);
	session_unset();
	session_destroy();
	header("Location: ".SERVERURL."login/");
	exit();
}