<?php

if ($peticionAjax) {
	//si es una peticion ajax se ejecuta en la carpeta ajax
	require_once "../modelos/loginModelo.php";
}else{
	//sino se ejecuta en el index
	require_once "./modelos/loginModelo.php";
}

class loginControlador extends loginModelo{
	// controlador iniciar sesion
	public function iniciar_sesion_controlador(){
		$usuario=mainModel::limpiar_cadena($_POST['usuario_log']);
		$clave=mainModel::limpiar_cadena($_POST['clave_log']);
		

		if($usuario=="" || $clave==""){
			echo '<script>
			Swal.fire({
				icon: "error",
				title: "Ha ocurrido un error",
				text: "Hay campos sin llenar",
				confirmButtonText : "Aceptar"
			});
			</script>';
			exit();
		}

		//verificando integridad de los datos

		if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}",$usuario)) {
			echo '<script>
			Swal.fire({
				icon: "error",
				title: "Ha ocurrido un error",
				text: "El nombre de usuario no tiene el formato solicitado",
				confirmButtonText : "Aceptar"
			});
			</script>';
			exit();
		}

		if (mainModel::verificar_datos("[a-zA-Z0-9$@.-]{5,100}",$clave)) {
			echo '<script>
			Swal.fire({
				icon: "error",
				title: "Ha ocurrido un error",
				text: "La clave no tiene el formato solicitado",
				confirmButtonText : "Aceptar"
			});
			</script>';
			exit();
		}

		$clave = mainModel::encryption($clave);
		$datos_login = [
			"Usuario"=> $usuario,
			"Clave"=>$clave
		];

		$datos_cuenta=loginModelo::iniciar_sesion_modelo($datos_login);

		if ($datos_cuenta->rowCount()==1) {
			$row = $datos_cuenta->fetch();

			session_start(['name'=>'SPM']);
			$_SESSION['id_spm']=$row['usuario_id'];
			$_SESSION['nombre_spm']=$row['usuario_nombre'];
			$_SESSION['usuario_spm']=$row['usuario_usuario'];
			$_SESSION['privilegio_spm']=$row['usuario_privilegio'];
			$_SESSION['token_spm']=md5(uniqid(mt_rand(),true));

			$configuracion_plan = [
				"Nombre"=>"1",
				"Constructora"=>"1",
				"Decreto"=>"1",
				"Cronograma"=>"1",
				"Unidades"=>"1",
				"Zona"=>"1",
				"Transferencia"=>"0",
				"Departamento"=>"0",
				"Ciudad"=>"0",
				"Anotacion"=>"0",
				"Cancelacion"=>"0",
				"Efecto"=>"0",
				"Participacion"=>"0",
				"PParticipacion"=>"0",
				"AreaNeta"=>"0",
				"AreaUtil"=>"0",
				"Preexistencia"=>"0",
				"ValorP"=>"0",
				"Certificado"=>"0",
				"Observaciones"=>"0"
			];

			$configuracion_licencia = [
				"Numero"=>"1",
				"Nombre"=>"1",
				"Promotor"=>"1",
				"Tipo"=>"1",
				"Modalidad"=>"1",
				"AreaCesion"=>"1",
				"AreaEquip"=>"0",
				"AreaProy"=>"0",
				"Viviendas"=>"0",
				"Cargas"=>"0",
				"Descripcion"=>"0",
				"Distribucion"=>"0"
			];

			$_SESSION['conf_plan']=$configuracion_plan;
			$_SESSION['conf_licencia']=$configuracion_licencia;

			return header("Location: ".SERVERURL."user-list/");

		} else {
			echo '<script>
			Swal.fire({
				icon: "error",
				title: "Ha ocurrido un error",
				text: "Usuario o clave incorrectos",
				confirmButtonText : "Aceptar"
			});
			</script>';
			exit();
		}
		

	}

	// controlador cerrar sesion

	public function cerrar_sesion_controlador(){
		session_unset();
		session_destroy();
		if (headers_sent()) {
			return "<script>window.location.href ='".SERVERURL."login/';</script>";
		} else {
			return header("Location: ".SERVERURL."login/");
		}
		
	}

	// controlador btn cerrar sesion

	public function btncerrar_sesion_controlador(){
		session_start(['name'=>'SPM']);
		$token = mainModel::decryption($_POST['token']);
		$usuario = mainModel::decryption($_POST['usuario']);

		if ($token==$_SESSION['token_spm'] && $usuario == $_SESSION['usuario_spm']) {
			session_unset();
			session_destroy();
			$alerta=[
				"Alerta"=>"redireccionar",
				"URL"=>SERVERURL."login/"
			];
			
		} else {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No se pudo cerrar la sesion",
				"Tipo"=>"error"
			];
			
			
		}
		echo json_encode($alerta);
	}


}