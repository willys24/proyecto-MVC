<?php

if ($peticionAjax) {
	//si es una peticion ajax se ejecuta en la carpeta ajax
	require_once "../modelos/licenciaModelo.php";
}else{
	//sino se ejecuta en el index
	require_once "./modelos/licenciaModelo.php";
}

class licenciaControlador extends licenciaModelo{
	
	// controlador para agregar usuario

	public function agregar_licencia_controlador(){
		
		$id_plan = mainModel::decryption($_POST['licencia_plan_id']);
		$id_plan=mainModel::limpiar_cadena($id_plan);

		$numero=mainModel::limpiar_cadena($_POST['licencia_numero_reg']);
		$nombre=mainModel::limpiar_cadena($_POST['licencia_nombre_reg']);		
		$promotor=mainModel::limpiar_cadena($_POST['licencia_promotor_reg']);

		$tipo=mainModel::limpiar_cadena($_POST['licencia_tipo_reg']);
		$modalidad=mainModel::limpiar_cadena($_POST['licencia_modalidad_reg']);
		$areaCesion=mainModel::limpiar_cadena($_POST['licencia_areaCesion_reg']);
		$areaEquip=mainModel::limpiar_cadena($_POST['licencia_areaEquip_reg']);

		$areaProy=mainModel::limpiar_cadena($_POST['licencia_areaProy_reg']);
		$viviendas=mainModel::limpiar_cadena($_POST['licencia_viviendas_reg']);
		$cargas=mainModel::limpiar_cadena($_POST['licencia_cargas_reg']);
		$descripcion=mainModel::limpiar_cadena($_POST['licencia_descripcion_reg']);
		$distribucion=mainModel::limpiar_cadena($_POST['licencia_distribucion_reg']);	



		//comprobar campos vacios

		if($numero=="" || $nombre=="" || $promotor=="" || $tipo=="" || $modalidad==""){
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

		$check_numero = mainModel::ejecutar_consulta_simple("SELECT licencia_numero FROM licencia WHERE licencia_numero = '".$numero."'");
		if ($check_numero->rowCount()>0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El licencia ya existe",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}

		
		$datos_licencia_reg=[	
			"Id_plan"=>$id_plan,		
			"Numero"=>$numero,
			"Nombre"=>$nombre,
			"Promotor"=>$promotor,
			"Tipo"=>$tipo,
			"Modalidad"=>$modalidad,
			"AreaCesion"=>$areaCesion,
			"AreaEquip"=>$areaEquip,
			"AreaProy"=>$areaProy,
			"Viviendas"=>$viviendas,
			"Cargas"=>$cargas,
			"Descripcion"=>$descripcion,
			"Distribucion"=>$distribucion
		];	

		$agregar_licencia=licenciaModelo::agregar_licencia_modelo($datos_licencia_reg);

		if ($agregar_licencia->rowCount()==1) {
			$alerta=[
				"Alerta"=>"limpiar",
				"Titulo"=>"Licencia registrada",
				"Texto"=>"Los datos del licencia se han guardado",
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
	public function paginador_licencia_controlador($pagina,$registros,$privilegio,$id,$url,$busqueda,$plan){

		

		$pagina=mainModel::limpiar_cadena($pagina);
		$registros=mainModel::limpiar_cadena($registros);
		$privilegio=mainModel::limpiar_cadena($privilegio);
		$id=mainModel::limpiar_cadena($id);
		$url=mainModel::limpiar_cadena($url);
		
		$url=SERVERURL.$url."/".$plan."/";
		$busqueda=mainModel::limpiar_cadena($busqueda);
		$plan = mainModel::decryption($plan);
		
		$tabla="";

		$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
		$inicio = ($pagina>0) ? (($pagina*$registros)-$registros) : 0;

		if (isset($busqueda) && $busqueda!="") {
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM licencia WHERE (licencia_nombre LIKE '%".$busqueda."%' OR licencia_numero LIKE '%".$busqueda."%' OR licencia_promotor LIKE '%".$busqueda."%' OR licencia_tipo LIKE '%".$busqueda."%') AND licencia_plan_id = '".$plan."' ORDER BY licencia_nombre ASC LIMIT ".$inicio.",".$registros;
		} else {
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM licencia WHERE licencia_plan_id = '".$plan."' ORDER BY licencia_nombre ASC LIMIT ".$inicio.",".$registros;
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
                    
                    <th scope="col" ';if($_SESSION['conf_licencia']['Numero']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Número de licencia</th>
                    <th scope="col" ';if($_SESSION['conf_licencia']['Nombre']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Nombre del Proyecto</th>
                    <th scope="col" ';if($_SESSION['conf_licencia']['Promotor']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Promotor</th>
                    <th scope="col" ';if($_SESSION['conf_licencia']['Tipo']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Tipo de licencia</th>
                    <th scope="col" ';if($_SESSION['conf_licencia']['Modalidad']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Modalidad</th>
                    <th scope="col" ';if($_SESSION['conf_licencia']['AreaCesion']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Áreas de Cesión</th>
                    <th scope="col" ';if($_SESSION['conf_licencia']['AreaEquip']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Áreas Equipamiento Colectivo</th>
                    <th scope="col" ';if($_SESSION['conf_licencia']['AreaProy']=="0"){ $tabla.='class="d-none"'; } $tabla.='>"Área del Proyecto</th>
                    <th scope="col" ';if($_SESSION['conf_licencia']['Viviendas']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Viviendas VIS</th>
                    <th scope="col" ';if($_SESSION['conf_licencia']['Cargas']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Cargas</th>
                    <th scope="col" ';if($_SESSION['conf_licencia']['Descripcion']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Descripción Proyecto</th>
                    <th scope="col" ';if($_SESSION['conf_licencia']['Distribucion']=="0"){ $tabla.='class="d-none"'; } $tabla.='>Distribución</th>


                    <th scope="col"></th>
                </tr>
            </thead>
			<tbody>';

		if ($total>=1 && $pagina<=$Npaginas) {
			$contador = $inicio+1;
			$reg_inicio=$inicio+1;
			foreach ($datos as $rows) {				

				$tabla.='
				<tr class="item_ser">
					<input type="hidden" name="licencia_id_up" value="'.mainModel::encryption($rows["licencia_id"]).'">
					<td ';if($_SESSION['conf_licencia']['Numero']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="licencia_numero_up" value="'.$rows["licencia_numero"].'"></td>
					<td ';if($_SESSION['conf_licencia']['Nombre']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="licencia_nombre_up" value="'.$rows["licencia_nombre"].'"></td>
					<td ';if($_SESSION['conf_licencia']['Promotor']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="licencia_promotor_up" value="'.$rows["licencia_promotor"].'"></td>
					<td ';if($_SESSION['conf_licencia']['Tipo']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="licencia_tipo_up" value="'.$rows["licencia_tipo"].'"></td>
					<td ';if($_SESSION['conf_licencia']['Modalidad']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="licencia_modalidad_up" value="'.$rows["licencia_modalidad"].'"></td>
					<td ';if($_SESSION['conf_licencia']['AreaCesion']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="licencia_areaCesion_up" value="'.$rows["licencia_areaCesion"].'"></td>
					<td ';if($_SESSION['conf_licencia']['AreaEquip']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="licencia_areaEquip_up" value="'.$rows["licencia_areaEquip"].'"></td>
					<td ';if($_SESSION['conf_licencia']['AreaProy']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="licencia_areaProy_up" value="'.$rows["licencia_areaProy"].'"></td>
					<td ';if($_SESSION['conf_licencia']['Viviendas']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="licencia_viviendas_up" value="'.$rows["licencia_viviendas"].'"></td>
					<td ';if($_SESSION['conf_licencia']['Cargas']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="licencia_cargas_up" value="'.$rows["licencia_cargas"].'"></td>
					<td ';if($_SESSION['conf_licencia']['Descripcion']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><textarea class="form-control" name="licencia_descripcion_up" rows="2">'.$rows["licencia_descripcion"].'</textarea></td>
					<td ';if($_SESSION['conf_licencia']['Distribucion']=="0"){ $tabla.='class="d-none"'; } $tabla.='"><input class="form-control" name="licencia_distribucion_up" value="'.$rows["licencia_distribucion"].'"></td>
		
					<td>
                        
                        <form class="FormularioAjax d-inline-block"  action="'.SERVERURL.'ajax/licenciaAjax.php" method="POST" data-form="delete">
							<input type="hidden" value="'.mainModel::encryption($rows['licencia_id']).'" name="licencia_id_delete">
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
			$tabla.='<p class="text-end p-2">Mostrando registros '.$reg_inicio.' al '.$reg_final.' de '.$total.'</p>';
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

	public function eliminar_licencia_controlador(){

		$id_licencia=mainModel::decryption($_POST['licencia_id_delete']);
		$id_licencia=mainModel::limpiar_cadena($id_licencia);
		

		// comprobando que existe
		$check_user=mainModel::ejecutar_consulta_simple("SELECT licencia_id FROM licencia WHERE licencia_id = '".$id_licencia."'");

		if ($check_user->rowCount()<=0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El licencia no existe",
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
		
		$eliminar_licencia=licenciaModelo::eliminar_licencia_modelo($id_licencia);

		if ($eliminar_licencia->rowCount()==1) {
			$alerta=[
				"Alerta"=>"recargar",
				"Titulo"=>"licencia eliminado",
				"Texto"=>"Los datos del licencia se han eliminado correctamente",
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

	public function datos_licencia_controlador($id){
		$id = mainModel::decryption($id);
		$id=mainModel::limpiar_cadena($id);

		return licenciaModelo::datos_licencia_modelo($id);

	}



	// controlador actualizar usuario

	public function actualizar_licencia_controlador(){

		// recibir id
		$id = mainModel::decryption($_POST['licencia_id_up']);
		$id=mainModel::limpiar_cadena($id);

		// comprobar el usuario en la bd
		$check_user=mainModel::ejecutar_consulta_simple("SELECT * FROM licencia WHERE licencia_id = '".$id."'");

		if ($check_user->rowCount()<=0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El licencia no existe",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}else{
			$campos=$check_user->fetch();			

		}

		
		$numero=mainModel::limpiar_cadena($_POST['licencia_numero_up']);
		$nombre=mainModel::limpiar_cadena($_POST['licencia_nombre_up']);		
		$promotor=mainModel::limpiar_cadena($_POST['licencia_promotor_up']);

		$tipo=mainModel::limpiar_cadena($_POST['licencia_tipo_up']);
		$modalidad=mainModel::limpiar_cadena($_POST['licencia_modalidad_up']);
		$areaCesion=mainModel::limpiar_cadena($_POST['licencia_areaCesion_up']);
		$areaEquip=mainModel::limpiar_cadena($_POST['licencia_areaEquip_up']);

		$areaProy=mainModel::limpiar_cadena($_POST['licencia_areaProy_up']);
		$viviendas=mainModel::limpiar_cadena($_POST['licencia_viviendas_up']);
		$cargas=mainModel::limpiar_cadena($_POST['licencia_cargas_up']);
		$descripcion=mainModel::limpiar_cadena($_POST['licencia_descripcion_up']);
		$distribucion=mainModel::limpiar_cadena($_POST['licencia_distribucion_up']);
		

		if($numero=="" || $nombre=="" || $promotor=="" || $tipo=="" || $modalidad==""){
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

		if ($numero!=$campos['licencia_numero']) {
			$check_numero = mainModel::ejecutar_consulta_simple("SELECT licencia_numero FROM licencia WHERE licencia_numero = '".$numero."'");
			if ($check_numero->rowCount()>0) {
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El licencia ya existe",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
		}		

		$datos_licencia_up=[	
			"ID"=>$id,				
			"Numero"=>$numero,
			"Nombre"=>$nombre,
			"Promotor"=>$promotor,
			"Tipo"=>$tipo,
			"Modalidad"=>$modalidad,
			"AreaCesion"=>$areaCesion,
			"AreaEquip"=>$areaEquip,
			"AreaProy"=>$areaProy,
			"Viviendas"=>$viviendas,
			"Cargas"=>$cargas,
			"Descripcion"=>$descripcion,
			"Distribucion"=>$distribucion
		];
		
		if (licenciaModelo::actualizar_licencia_modelo($datos_licencia_up)) {
			$alerta=[
				"Alerta"=>"recargar",
				"Titulo"=>"Licencia modificada",
				"Texto"=>"Los datos de la licencia se han modificado",
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




