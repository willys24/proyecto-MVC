<?php

if ($peticionAjax) {
	//si es una peticion ajax se ejecuta en la carpeta ajax
	require_once "../modelos/usuarioModelo.php";
}else{
	//sino se ejecuta en el index
	require_once "./modelos/usuarioModelo.php";
}

class usuarioControlador extends usuarioModelo{
	
	// controlador para agregar usuario

	public function agregar_usuario_controlador(){

		
		$nombre=mainModel::limpiar_cadena($_POST['usuario_nombre_reg']);
		$ciudad=mainModel::limpiar_cadena($_POST['usuario_ciudad_reg']);
		$telefono=mainModel::limpiar_cadena($_POST['usuario_telefono_reg']);

		$usuario=mainModel::limpiar_cadena($_POST['usuario_usuario_reg']);
		$email=mainModel::limpiar_cadena($_POST['usuario_email_reg']);
		$clave1=mainModel::limpiar_cadena($_POST['usuario_clave_1_reg']);
		$clave2=mainModel::limpiar_cadena($_POST['usuario_clave_2_reg']);

		$privilegio=mainModel::limpiar_cadena($_POST['usuario_privilegio_reg']);

		//comprobar campos vacios

		if($ciudad=="" || $nombre=="" || $email=="" || $usuario=="" || $clave1=="" || $clave2==""){
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"Hay campos sin llenar",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		//verificando integridad de los datos

		if (mainModel::verificar_datos("[a-zA-Z0-9]{1,50}",$usuario)) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El DNI no tiene formato solicitado",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}",$nombre)) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El nombre no tiene formato solicitado",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		// comprobar DNI

		$check_email = mainModel::ejecutar_consulta_simple("SELECT usuario_email FROM usuario WHERE usuario_email = '".$email."'");
		if ($check_email->rowCount()>0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El correo ya existe",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		//comprobar usuario

		$check_user = mainModel::ejecutar_consulta_simple("SELECT usuario_usuario FROM usuario WHERE usuario_usuario = '".$usuario."'");
		if ($check_user->rowCount()>0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El usuario ya existe",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		// comprobar claves
		if ($clave1!=$clave2) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"Las claves no coinciden",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		} else {
			$clave=mainModel::encryption($clave1);			
		}

		//comprobar privilegio

		if ($privilegio<1 || $privilegio>3) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El privilegio no es válido",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}
		
		$datos_usuario_reg=[			
			"Nombre"=>$nombre,
			"Ciudad"=>$ciudad,
			"Telefono"=>$telefono,
			"Email"=>$email,
			"Usuario"=>$usuario,			
			"Clave"=>$clave,
			"Privilegio"=>$privilegio
		];

		$agregar_usuario=usuarioModelo::agregar_usuario_modelo($datos_usuario_reg);

		if ($agregar_usuario->rowCount()==1) {
			$alerta=[
				"Alerta"=>"limpiar",
				"Titulo"=>"Usuario registrado",
				"Texto"=>"Los datos del usuario se han guardado",
				"Tipo"=>"success"
			];
		} else {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No se ha podido realizar el registro",
				"Tipo"=>"error"
			];
		}
		
		echo json_encode($alerta);

	}


	//controlador paginar usuarios
	public function paginador_usuario_controlador($pagina,$registros,$privilegio,$id,$url,$busqueda){

		$pagina=mainModel::limpiar_cadena($pagina);
		$registros=mainModel::limpiar_cadena($registros);
		$privilegio=mainModel::limpiar_cadena($privilegio);
		$id=mainModel::limpiar_cadena($id);
		$url=mainModel::limpiar_cadena($url);
		$url=SERVERURL.$url."/";
		$busqueda=mainModel::limpiar_cadena($busqueda);

		$tabla="";

		$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
		$inicio = ($pagina>0) ? (($pagina*$registros)-$registros) : 0;

		if (isset($busqueda) && $busqueda!="") {
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario WHERE (usuario_nombre LIKE '%".$busqueda."%' OR usuario_email LIKE '%".$busqueda."%' OR usuario_usuario LIKE '%".$busqueda."%') ORDER BY usuario_nombre ASC LIMIT ".$inicio.",".$registros;
		} else {
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario ORDER BY usuario_privilegio ASC LIMIT ".$inicio.",".$registros;
		}

		$conexion = mainModel::conectar();
		$datos = $conexion->query($consulta);
		$datos = $datos->fetchAll();

		$total = $conexion->query("SELECT FOUND_ROWS()");
		$total = (int) $total->fetchColumn();
		$tpriv = "";

		$Npaginas = ceil($total/$registros);
		
		$tabla.='
		<table class="table table-hover">
			<thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Perfil</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col"></th>
                </tr>
            </thead>
			<tbody>';

		if ($total>=1 && $pagina<=$Npaginas) {
			$contador = $inicio+1;
			$reg_inicio=$inicio+1;
			foreach ($datos as $rows) {
				if($rows['usuario_privilegio']=='1'){
					$tpriv = '<div class="perf">Administrador</div>';
				}else{
					$tpriv = '<div class="perf disable">Usuario</div>';
				}

				$tabla.='
				<tr >
					
					<td>'.$rows['usuario_nombre'].'</td>
					<td>'.$rows['usuario_usuario'].'</td>
					<td>'.$tpriv.'</td>
					<td>'.$rows['usuario_email'].'</td>
					<td>'.$rows['usuario_telefono'].'</td>					
					<td>'.$rows['usuario_ciudad'].'</td>
					<td>
                        <a href="'.SERVERURL.'user-update/'.mainModel::encryption($rows['usuario_id']).'/" class="button_prim3"><i class="fa-solid fa-pencil"></i></a>
                        <form class="FormularioAjax d-inline-block"  action="'.SERVERURL.'ajax/usuarioAjax.php" method="POST" data-form="delete">
							<input type="hidden" value="'.mainModel::encryption($rows['usuario_id']).'" name="usuario_id_delete">
							<button type="submit" class="button_prim3">
								<i class="fa-regular fa-trash-can"></i>
							</button>
						</form>
                        
                    </td>
					
				</tr>';
				$contador++;
			}
			$reg_final = $contador-1;

		} else {
			if ($total>=1) {
				$tabla.='<tr class="text-center" ><td colspan="9">
				<a href="'.$url.'" class="btn btn-raised btn-primary">Recargar listado</a>
				</td></tr>';
			} else {
				$tabla.='<tr class="text-center" ><td colspan="9">No hay registros en el sistema</td></tr>';
			}
						
		}

		if ($total>=1 && $pagina<=$Npaginas) {
			$tabla.='<p class="text-end p-2">Mostrando usuarios '.$reg_inicio.' al '.$reg_final.' de '.$total.'</p>';
		}

		$tabla.='</tbody>
			</table>
		</div>';

		if ($total>=1 && $pagina<=$Npaginas) {
			$tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,5);
		}
		

		return $tabla;

	}

	//controlador eliminar usuario

	public function eliminar_usuario_controlador(){

		$id_usuario=mainModel::decryption($_POST['usuario_id_delete']);
		$id_usuario=mainModel::limpiar_cadena($id_usuario);
		

		if($id_usuario==1){
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No se puede eliminar el administrador",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		// comprobando que existe
		$check_user=mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_id = '".$id_usuario."'");

		if ($check_user->rowCount()<=0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El usuario no existe",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		// comprobando que no este relacionado en otra tabla
		$check_prestamo=mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM prestamo WHERE usuario_id = '".$id_usuario."' LIMIT 1");

		if ($check_prestamo->rowCount()>0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El usuario tiene uno o varios prestamos",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		//comprobar privilegio
		session_start(['name'=>'SPM']);
		if ($_SESSION['privilegio_spm']!=1) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No tiene permisos necesarios para esta acción",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}



		// eliminado usuario
		
		$eliminar_usuario=usuarioModelo::eliminar_usuario_modelo($id_usuario);

		if ($eliminar_usuario->rowCount()==1) {
			$alerta=[
				"Alerta"=>"recargar",
				"Titulo"=>"Usuario eliminado",
				"Texto"=>"Los datos del usuario se han eliminado correctamente",
				"Tipo"=>"success"
			];
		} else {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No se ha podido eliminar el registro",
				"Tipo"=>"error"
			];
		}
		
		echo json_encode($alerta);

	}


	// controlador datos usuario

	public function datos_usuario_controlador($tipo,$id){
		$tipo=mainModel::limpiar_cadena($tipo);
		$id = mainModel::decryption($id);
		$id=mainModel::limpiar_cadena($id);

		return usuarioModelo::datos_usuario_modelo($tipo,$id);

	}

	// controlador actualizar usuario

	public function actualizar_usuario_controlador(){

		// recibir id
		$id = mainModel::decryption($_POST['usuario_id_up']);
		$id=mainModel::limpiar_cadena($id);

		// comprobar el usuario en la bd
		$check_user=mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE usuario_id = '".$id."'");

		if ($check_user->rowCount()<=0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El usuario no existe",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}else{
			$campos=$check_user->fetch();			

		}


		$nombre=mainModel::limpiar_cadena($_POST['usuario_nombre_up']);
		$ciudad=mainModel::limpiar_cadena($_POST['usuario_ciudad_up']);
		$telefono=mainModel::limpiar_cadena($_POST['usuario_telefono_up']);
		$usuario=mainModel::limpiar_cadena($_POST['usuario_usuario_up']);
		$email=mainModel::limpiar_cadena($_POST['usuario_email_up']);


		if (isset($_POST['usuario_privilegio_up'])) {
			$privilegio=mainModel::limpiar_cadena($_POST['usuario_privilegio_up']);
		} else {
			$privilegio = $campos['usuario_privilegio'];
		}
		
		

		if ($ciudad =="" || $nombre =="" || $email =="" || $usuario =="" ) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No ha llenado todos los campos obligatorios",
				"Tipo"=>"error"
			];

			echo json_encode($alerta);
			exit();
		}


		if ($privilegio<1 || $privilegio>2) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El privilegio no es válido",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		// comprobar DNI
		if ($email!=$campos['usuario_email']) {
			$check_dni = mainModel::ejecutar_consulta_simple("SELECT usuario_email FROM usuario WHERE usuario_email = '".$email."'");
			if ($check_dni->rowCount()>0) {
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El correo ya existe",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
		}
		

		//comprobar usuario
		if ($usuario!=$campos['usuario_usuario']) {
			$check_user = mainModel::ejecutar_consulta_simple("SELECT usuario_usuario FROM usuario WHERE usuario_usuario = '".$usuario."'");
			if ($check_user->rowCount()>0) {
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El usuario ya existe",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
		}


		// comprobar claves
		if ($_POST['usuario_clave_nueva_1']!="" || $_POST['usuario_clave_nueva_2']!="") {
			if ($_POST['usuario_clave_nueva_1']!=$_POST['usuario_clave_nueva_2']) {
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"Las claves no coinciden",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			} else {
				if (mainModel::verificar_datos("[a-zA-Z0-9$@.-]{6,100}",$_POST['usuario_clave_nueva_1'])) {
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La clave no tiene el formato solicitado",
						"Tipo"=>"error"
					];
					echo json_encode($alerta);
					exit();
				}
				$clave=mainModel::encryption($_POST['usuario_clave_nueva_1']);
			}
			
		} else {
			$clave = $campos['usuario_clave'];
		}


		
		// enviando datos al modelo
		$datos_usuario_up=[
			"ID"=>$id,			
			"Nombre"=>$nombre,
			"Ciudad"=>$ciudad,
			"Telefono"=>$telefono,
			"Email"=>$email,
			"Usuario"=>$usuario,
			"Clave"=>$clave,
			"Privilegio"=>$privilegio
		];

		
		if (usuarioModelo::actualizar_usuario_modelo($datos_usuario_up)) {
			$alerta=[
				"Alerta"=>"recargar",
				"Titulo"=>"Usuario modificado",
				"Texto"=>"Los datos del usuario se han modificado",
				"Tipo"=>"success"
			];
		} else {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"No se ha podido realizar la acción",
				"Tipo"=>"error"
			];
		}
		
		echo json_encode($alerta);

	}

}




