<?php

if ($peticionAjax) {
	//si es una peticion ajax se ejecuta en la carpeta ajax
	require_once "../modelos/predioModelo.php";
}else{
	//sino se ejecuta en el index
	require_once "./modelos/predioModelo.php";
}

class predioControlador extends predioModelo{
	
	// controlador para agregar usuario

	public function agregar_predio_controlador(){
		
		$id_plan = mainModel::decryption($_POST['predio_plan_id']);
		$id_plan=mainModel::limpiar_cadena($id_plan);

		$numero=mainModel::limpiar_cadena($_POST['predio_numero_reg']);
		$matricula=mainModel::limpiar_cadena($_POST['predio_matricula_reg']);		
		$propietario=mainModel::limpiar_cadena($_POST['predio_propietario_reg']);

		$direccion=mainModel::limpiar_cadena($_POST['predio_direccion_reg']);
		$areaTerr=mainModel::limpiar_cadena($_POST['predio_areaTerr_reg']);
		$areaCons=mainModel::limpiar_cadena($_POST['predio_areaCons_reg']);
		$avaluo=mainModel::limpiar_cadena($_POST['predio_avaluo_reg']);

		$valorDeudaP=mainModel::limpiar_cadena($_POST['predio_valorDeudaP_reg']);
		$estrato=mainModel::limpiar_cadena($_POST['predio_estrato_reg']);
		$destinoEcon=mainModel::limpiar_cadena($_POST['predio_destinoEcon_reg']);
		$comentarios=mainModel::limpiar_cadena($_POST['predio_comentarios_reg']);
		$detallesTecn=mainModel::limpiar_cadena($_POST['predio_detallesTecn_reg']);	

		$otras=mainModel::limpiar_cadena($_POST['predio_otras_reg']);	



		//comprobar campos vacios

		if($numero=="" || $matricula=="" || $propietario=="" || $direccion==""){
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

		$check_numero = mainModel::ejecutar_consulta_simple("SELECT predio_numero FROM predio WHERE predio_numero = '".$numero."'");
		if ($check_numero->rowCount()>0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El predio ya existe",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}
		
		$datos_predio_reg=[	
			"Id_plan"=>$id_plan,		
			"Numero"=>$numero,
			"Matricula"=>$matricula,
			"Propietario"=>$propietario,
			"Direccion"=>$direccion,
			"AreaTerr"=>$areaTerr,
			"AreaCons"=>$areaCons,
			"Avaluo"=>$avaluo,
			"ValorDeudaP"=>$valorDeudaP,
			"Estrato"=>$estrato,
			"DestinoEcon"=>$destinoEcon,
			"Comentarios"=>$comentarios,
			"DetallesTecn"=>$detallesTecn,
			"Otras"=>$otras
		];	

		$agregar_predio=predioModelo::agregar_predio_modelo($datos_predio_reg);

		if ($agregar_predio->rowCount()==1) {
			$alerta=[
				"Alerta"=>"limpiar",
				"Titulo"=>"Predio registrado",
				"Texto"=>"Los datos del predio se han guardado",
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
	public function paginador_predio_controlador($pagina,$registros,$privilegio,$id,$url,$busqueda,$plan){

		
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
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM predio WHERE (predio_matricula LIKE '%".$busqueda."%' OR predio_numero LIKE '%".$busqueda."%' OR predio_propietario LIKE '%".$busqueda."%' OR predio_direccion LIKE '%".$busqueda."%') AND predio_plan_id = '".$plan."' ORDER BY predio_numero ASC LIMIT ".$inicio.",".$registros;
		} else {
			$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM predio WHERE predio_plan_id = '".$plan."' ORDER BY predio_numero ASC LIMIT ".$inicio.",".$registros;
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
                    <th scope="col">Número predial</th>
                    <th scope="col">Propietario</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Área Terreno</th>
                    <th scope="col">Área Construida</th>
                    <th scope="col">Avaluó</th>
                    <th scope="col"></th>
                </tr>
            </thead>
			<tbody>';

		if ($total>=1 && $pagina<=$Npaginas) {
			$contador = $inicio+1;
			$reg_inicio=$inicio+1;
			foreach ($datos as $rows) {				

				$tabla.='
				<tr >
					
					<td>'.$rows['predio_numero'].'</td>
					<td>'.$rows['predio_propietario'].'</td>
					<td>'.$rows['predio_direccion'].'</td>
					<td>'.$rows['predio_areaTerr'].'</td>
					<td>'.$rows['predio_areaCons'].'</td>	
					<td>'.$rows['predio_avaluo'].'</td>			
					<td>
                        
                        
                        <form class="FormularioAjax d-inline-block"  action="'.SERVERURL.'ajax/predioAjax.php" method="POST" data-form="delete">
							<input type="hidden" value="'.mainModel::encryption($rows['predio_id']).'" name="predio_id_delete">
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

	public function eliminar_predio_controlador(){

		$id_predio=mainModel::decryption($_POST['predio_id_delete']);
		$id_predio=mainModel::limpiar_cadena($id_predio);
		

		// comprobando que existe
		$check_user=mainModel::ejecutar_consulta_simple("SELECT predio_id FROM predio WHERE predio_id = '".$id_predio."'");

		if ($check_user->rowCount()<=0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El predio no existe",
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
		
		$eliminar_predio=predioModelo::eliminar_predio_modelo($id_predio);

		if ($eliminar_predio->rowCount()==1) {
			$alerta=[
				"Alerta"=>"recargar",
				"Titulo"=>"predio eliminado",
				"Texto"=>"Los datos del predio se han eliminado correctamente",
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

	public function datos_predio_controlador($id){
		$id = mainModel::decryption($id);
		$id=mainModel::limpiar_cadena($id);

		return predioModelo::datos_predio_modelo($id);

	}



	// controlador actualizar usuario

	public function actualizar_predio_controlador(){

		// recibir id
		$id = mainModel::decryption($_POST['predio_id_up']);
		$id=mainModel::limpiar_cadena($id);

		// comprobar el usuario en la bd
		$check_user=mainModel::ejecutar_consulta_simple("SELECT * FROM predio WHERE predio_id = '".$id."'");

		if ($check_user->rowCount()<=0) {
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error inesperado",
				"Texto"=>"El predio no existe",
				"Tipo"=>"error"
			];
			echo json_encode($alerta);
			exit();
		}else{
			$campos=$check_user->fetch();			

		}

		
		$numero=mainModel::limpiar_cadena($_POST['predio_numero_up']);
		$nombre=mainModel::limpiar_cadena($_POST['predio_nombre_up']);		
		$promotor=mainModel::limpiar_cadena($_POST['predio_promotor_up']);

		$tipo=mainModel::limpiar_cadena($_POST['predio_tipo_up']);
		$modalidad=mainModel::limpiar_cadena($_POST['predio_modalidad_up']);
		$areaCesion=mainModel::limpiar_cadena($_POST['predio_areaCesion_up']);
		$areaEquip=mainModel::limpiar_cadena($_POST['predio_areaEquip_up']);

		$areaProy=mainModel::limpiar_cadena($_POST['predio_areaProy_up']);
		$viviendas=mainModel::limpiar_cadena($_POST['predio_viviendas_up']);
		$cargas=mainModel::limpiar_cadena($_POST['predio_cargas_up']);
		$descripcion=mainModel::limpiar_cadena($_POST['predio_descripcion_up']);
		$distribucion=mainModel::limpiar_cadena($_POST['predio_distribucion_up']);
		

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

		if ($numero!=$campos['predio_numero']) {
			$check_numero = mainModel::ejecutar_consulta_simple("SELECT predio_numero FROM predio WHERE predio_numero = '".$numero."'");
			if ($check_numero->rowCount()>0) {
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"El predio ya existe",
					"Tipo"=>"error"
				];
				echo json_encode($alerta);
				exit();
			}
		}		

		$datos_predio_up=[	
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
		
		if (predioModelo::actualizar_predio_modelo($datos_predio_up)) {
			$alerta=[
				"Alerta"=>"recargar",
				"Titulo"=>"predio modificada",
				"Texto"=>"Los datos de la predio se han modificado",
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




