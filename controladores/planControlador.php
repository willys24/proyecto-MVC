<?php

if ($peticionAjax) {
	//si es una peticion ajax se ejecuta en la carpeta ajax
	require_once "../modelos/planModelo.php";
}else{
	//sino se ejecuta en el index
	require_once "./modelos/planModelo.php";
}

class planControlador extends planModelo{
	
	// controlador para agregar usuario

	public function agregar_plan_controlador(){
		
		$nombre=mainModel::limpiar_cadena($_POST['plan_nombre_reg']);
		$constructora=mainModel::limpiar_cadena($_POST['plan_constructora_reg']);
		$decreto=mainModel::limpiar_cadena($_POST['plan_decreto_reg']);

		$unidades=mainModel::limpiar_cadena($_POST['plan_unidades_reg']);
		$zona=mainModel::limpiar_cadena($_POST['plan_zona_reg']);
		$cronograma1=mainModel::limpiar_cadena($_POST['plan_cronograma1_reg']);
		$cronograma2=mainModel::limpiar_cadena($_POST['plan_cronograma2_reg']);

		$transferencia=mainModel::limpiar_cadena($_POST['plan_transferencia_reg']);
		$departamento=mainModel::limpiar_cadena($_POST['plan_departamento_reg']);
		$ciudad=mainModel::limpiar_cadena($_POST['plan_ciudad_reg']);
		$AreaNeta=mainModel::limpiar_cadena($_POST['plan_AreaNeta_reg']);
		$AreaUtil=mainModel::limpiar_cadena($_POST['plan_AreaUtil_reg']);
		$certificado=mainModel::limpiar_cadena($_POST['plan_certificado_reg']);
		$preexistencia=mainModel::limpiar_cadena($_POST['plan_preexistencia_reg']);
		$EfectoP=mainModel::limpiar_cadena($_POST['plan_EfectoP_reg']);
		$ParticipacionP=mainModel::limpiar_cadena($_POST['plan_ParticipacionP_reg']);
		$PParticipacionP=mainModel::limpiar_cadena($_POST['plan_PParticipacionP_reg']);
		$valorP=mainModel::limpiar_cadena($_POST['plan_ValorP_reg']);
		$anotacionP=mainModel::limpiar_cadena($_POST['plan_AnotacionP_reg']);
		$cancelacionP=mainModel::limpiar_cadena($_POST['plan_CancelacionP_reg']);
		$observacion=mainModel::limpiar_cadena($_POST['plan_Observacion_reg']);

		

		//comprobar campos vacios

		if($cronograma1 > $cronograma2 ){
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El cronograma no tiene un valor válido",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		if($ciudad=="" || $nombre=="" || $constructora=="" || $decreto=="" || $unidades=="" || $zona==""){
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"Hay campos sin llenar",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		
		// comprobar DNI

		$check_nombre = mainModel::ejecutar_consulta_simple("SELECT plan_nombre FROM plan WHERE plan_nombre = '".$nombre."'");
		if ($check_nombre->rowCount()>0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El plan ya existe",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		$datos_plan_reg=[			
			"Nombre"=>$nombre,
			"Constructora"=>$constructora,
			"Decreto"=>$decreto,
			"Unidades"=>$unidades,
			"Zona"=>$zona,
			"Cronograma"=>$cronograma1."-".$cronograma2,
			"Transferencia"=>$transferencia,
			"Departamento"=>$departamento,
			"Ciudad"=>$ciudad,
			"AreaNeta"=>$AreaNeta,
			"AreaUtil"=>$AreaUtil,
			"Certificado"=>$certificado,
			"Preexistencia"=>$preexistencia,
			"EfectoP"=>$EfectoP,
			"ParticipacionP"=>$ParticipacionP,
			"PParticipacionP"=>$PParticipacionP,
			"ValorP"=>$valorP,
			"AnotacionP"=>$anotacionP,			
			"CancelacionP"=>$cancelacionP,
			"Observacion"=>$observacion
		];

		$agregar_plan=planModelo::agregar_plan_modelo($datos_plan_reg);

		if ($agregar_plan->rowCount()==1) {
			$alerta=[
				"Alerta"=>"limpiar",
				"Titulo"=>"Usuario registrado",
				"Texto"=>"Los datos del plan se han guardado",
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
	public function paginador_plan_controlador($pagina,$registros,$privilegio,$id,$url,$busqueda){

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
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM plan WHERE (plan_nombre LIKE '%".$busqueda."%' OR plan_constructora LIKE '%".$busqueda."%') ORDER BY plan_nombre ASC LIMIT ".$inicio.",".$registros;
		} else {
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM plan ORDER BY plan_nombre ASC LIMIT ".$inicio.",".$registros;
		}

		$conexion = mainModel::conectar();
		$datos = $conexion->query($consulta);
		$datos = $datos->fetchAll();

		$total = $conexion->query("SELECT FOUND_ROWS()");
		$total = (int) $total->fetchColumn();
		
		$Npaginas = ceil($total/$registros);

		
		$tabla.='
		<table class="table table-hover">
			<thead>
                <tr>
                	<th scope="col" ';if($_SESSION['conf_plan']['Nombre']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Plan parcial</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['Constructora']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Constructora</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['Decreto']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Decreto Adopción</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['Cronograma']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Cronograma ejecución</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['Unidades']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Unidades de gestión</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['Zona']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Zona</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['Transferencia']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Transferencia de Dominio</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['Departamento']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Departamento</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['Ciudad']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Ciudad</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['Anotacion']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Anotación Plusvalía</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['Cancelacion']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Cancelación Plusvalía</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['Efecto']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Efecto Plusvalía</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['Participacion']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Participación Plusvalía</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['PParticipacion']=="0"){ $tabla.='class="d-none"'; } $tabla.='>% Participación Plusvalía</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['AreaNeta']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Área Neta</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['AreaUtil']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Área útil</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['Preexistencia']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Preexistencia</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['ValorP']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Valor Plusvalía</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['Certificado']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Certificado de Ocupación</th>
                	<th scope="col" ';if($_SESSION['conf_plan']['Observaciones']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Observaciones</th>
                	
                	<th scope="col"></th>
                </tr>
            </thead>
			<tbody>';

		if ($total>=1 && $pagina<=$Npaginas) {
			$contador = $inicio+1;
			$reg_inicio=$inicio+1;
			foreach ($datos as $rows) {				

				$tabla.='<tr class="item_ser" >
				<input type="hidden" name="plan_id_up" value="'.mainModel::encryption($rows["plan_id"]).'">
					<td ';if($_SESSION['conf_plan']['Nombre']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_nombre_up" value="'.$rows["plan_nombre"].'"></td>
					<td ';if($_SESSION['conf_plan']['Constructora']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_constructora_up" value="'.$rows["plan_constructora"].'"></td>
					<td ';if($_SESSION['conf_plan']['Decreto']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_decreto_up" value="'.$rows["plan_decreto"].'"></td>
					<td ';if($_SESSION['conf_plan']['Cronograma']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_cronograma_up" value="'.$rows["plan_cronograma"].'"></td>
					<td ';if($_SESSION['conf_plan']['Unidades']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_unidades_up" value="'.$rows["plan_unidades"].'"></td>
					<td ';if($_SESSION['conf_plan']['Zona']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_zona_up" value="'.$rows["plan_zona"].'"></td>
					<td ';if($_SESSION['conf_plan']['Transferencia']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_transferencia_up" value="'.$rows["plan_transferencia"].'"></td>
					<td ';if($_SESSION['conf_plan']['Departamento']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_departamento_up" value="'.$rows["plan_departamento"].'"></td>
					<td ';if($_SESSION['conf_plan']['Ciudad']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_ciudad_up" value="'.$rows["plan_ciudad"].'"></td>
					<td ';if($_SESSION['conf_plan']['Anotacion']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_AnotacionP_up" value="'.$rows["plan_AnotacionP"].'"></td>
					<td ';if($_SESSION['conf_plan']['Cancelacion']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_CancelacionP_up" value="'.$rows["plan_CancelacionP"].'"></td>
					<td ';if($_SESSION['conf_plan']['Efecto']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_EfectoP_up" value="'.$rows["plan_EfectoP"].'"></td>
					<td ';if($_SESSION['conf_plan']['Participacion']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_ParticipacionP_up" value="'.$rows["plan_ParticipacionP"].'"></td>
					<td ';if($_SESSION['conf_plan']['PParticipacion']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_PParticipacionP_up" value="'.$rows["plan_PParticipacionP"].'"></td>
					<td ';if($_SESSION['conf_plan']['AreaNeta']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_AreaNeta_up" value="'.$rows["plan_AreaNeta"].'"></td>
					<td ';if($_SESSION['conf_plan']['AreaUtil']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_AreaUtil_up" value="'.$rows["plan_AreaUtil"].'"></td>
					<td ';if($_SESSION['conf_plan']['Preexistencia']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_preexistencia_up" value="'.$rows["plan_preexistencia"].'"></td>
					<td ';if($_SESSION['conf_plan']['ValorP']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_ValorP_up" value="'.$rows["plan_ValorP"].'"></td>
					<td ';if($_SESSION['conf_plan']['Certificado']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_certificado_up" value="'.$rows["plan_certificado"].'"></td>
					<td ';if($_SESSION['conf_plan']['Observaciones']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="plan_Observacion_up" value="'.$rows["plan_Observacion"].'"></td>
				
					<td class="d-flex align-items-center">
                        
                        <a href="'.SERVERURL.'galeria-list/'.mainModel::encryption($rows['plan_id']).'/"  title="Galeria" class="button_prim3"><i class="fa-regular fa-file-lines"></i></a>
                        <a href="'.SERVERURL.'licencia-list/'.mainModel::encryption($rows['plan_id']).'/"  title="Licencias" class="button_prim3"><i class="fa-solid fa-file-lines"></i></a>
                        <a href="'.SERVERURL.'predio-list/'.mainModel::encryption($rows['plan_id']).'/"  title="Predios" class="button_prim3"><i class="fa-solid fa-grip-vertical"></i></a>
                        <form class="FormularioAjax d-inline-block"  action="'.SERVERURL.'ajax/planAjax.php" method="POST" data-form="delete">
							<input type="hidden" value="'.mainModel::encryption($rows['plan_id']).'" name="plan_id_delete">
							<button type="submit" class="button_prim3">
								<i class="fa-regular fa-trash-can"></i>
							</button>
						</form>
                        
                    </td>
					
				</tr>
				
				';
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
			$tabla.='<p class="text-end p-2">Mostrando planes '.$reg_inicio.' al '.$reg_final.' de '.$total.'</p>';
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

	public function eliminar_plan_controlador(){

		$id_plan=mainModel::decryption($_POST['plan_id_delete']);
		$id_plan=mainModel::limpiar_cadena($id_plan);
		

		// comprobando que existe
		$check_user=mainModel::ejecutar_consulta_simple("SELECT plan_id FROM plan WHERE plan_id = '".$id_plan."'");

		if ($check_user->rowCount()<=0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El plan no existe",
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
		
		$eliminar_plan=planModelo::eliminar_plan_modelo($id_plan);

		if ($eliminar_plan->rowCount()==1) {
			$alerta=[
				"Alerta"=>"recargar",
				"Titulo"=>"Plan eliminado",
				"Texto"=>"Los datos del plan se han eliminado correctamente",
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

	public function datos_plan_controlador($id){
		$id = mainModel::decryption($id);
		$id=mainModel::limpiar_cadena($id);

		return planModelo::datos_plan_modelo($id);

	}



	// controlador actualizar usuario

	public function actualizar_plan_controlador(){

		// recibir id
		$id = mainModel::decryption($_POST['plan_id_up']);
		$id=mainModel::limpiar_cadena($id);

		// comprobar el usuario en la bd
		$check_user=mainModel::ejecutar_consulta_simple("SELECT * FROM plan WHERE plan_id = '".$id."'");

		if ($check_user->rowCount()<=0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El plan no existe",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}else{
			$campos=$check_user->fetch();			

		}

		$nombre=mainModel::limpiar_cadena($_POST['plan_nombre_up']);
		$constructora=mainModel::limpiar_cadena($_POST['plan_constructora_up']);
		$decreto=mainModel::limpiar_cadena($_POST['plan_decreto_up']);

		$unidades=mainModel::limpiar_cadena($_POST['plan_unidades_up']);
		$zona=mainModel::limpiar_cadena($_POST['plan_zona_up']);
		$cronograma=mainModel::limpiar_cadena($_POST['plan_cronograma_up']);

		$transferencia=mainModel::limpiar_cadena($_POST['plan_transferencia_up']);
		$departamento=mainModel::limpiar_cadena($_POST['plan_departamento_up']);
		$ciudad=mainModel::limpiar_cadena($_POST['plan_ciudad_up']);
		$AreaNeta=mainModel::limpiar_cadena($_POST['plan_AreaNeta_up']);
		$AreaUtil=mainModel::limpiar_cadena($_POST['plan_AreaUtil_up']);
		$certificado=mainModel::limpiar_cadena($_POST['plan_certificado_up']);
		$preexistencia=mainModel::limpiar_cadena($_POST['plan_preexistencia_up']);
		$EfectoP=mainModel::limpiar_cadena($_POST['plan_EfectoP_up']);
		$ParticipacionP=mainModel::limpiar_cadena($_POST['plan_ParticipacionP_up']);
		$PParticipacionP=mainModel::limpiar_cadena($_POST['plan_PParticipacionP_up']);
		$valorP=mainModel::limpiar_cadena($_POST['plan_ValorP_up']);
		$anotacionP=mainModel::limpiar_cadena($_POST['plan_AnotacionP_up']);
		$cancelacionP=mainModel::limpiar_cadena($_POST['plan_CancelacionP_up']);
		$observacion=mainModel::limpiar_cadena($_POST['plan_Observacion_up']);
		

		

		if($ciudad=="" || $nombre=="" || $constructora=="" || $decreto=="" || $unidades=="" || $zona==""){
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"Hay campos sin llenar",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		
		// comprobar DNI

		if ($nombre!=$campos['plan_nombre']) {
			$check_nombre = mainModel::ejecutar_consulta_simple("SELECT plan_nombre FROM plan WHERE plan_nombre = '".$nombre."'");
			if ($check_nombre->rowCount()>0) {
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El plan ya existe",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
		}		

		$datos_plan_up=[	
			"ID"=>$id,		
			"Nombre"=>$nombre,
			"Constructora"=>$constructora,
			"Decreto"=>$decreto,
			"Unidades"=>$unidades,
			"Zona"=>$zona,
			"Cronograma"=>$cronograma,
			"Transferencia"=>$transferencia,
			"Departamento"=>$departamento,
			"Ciudad"=>$ciudad,
			"AreaNeta"=>$AreaNeta,
			"AreaUtil"=>$AreaUtil,
			"Certificado"=>$certificado,
			"Preexistencia"=>$preexistencia,
			"EfectoP"=>$EfectoP,
			"ParticipacionP"=>$ParticipacionP,
			"PParticipacionP"=>$PParticipacionP,
			"ValorP"=>$valorP,
			"AnotacionP"=>$anotacionP,			
			"CancelacionP"=>$cancelacionP,
			"Observacion"=>$observacion
		];

		
		if (planModelo::actualizar_plan_modelo($datos_plan_up)) {
			$alerta=[
				"Alerta"=>"recargar",
				"Titulo"=>"Plan modificado",
				"Texto"=>"Los datos del plan se han modificado",
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




