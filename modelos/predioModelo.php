<?php
//modelo interactua con la bd

require_once "mainModel.php";

class predioModelo extends mainModel{
	// modelo para agregar usuario

	protected static function agregar_predio_modelo($datos){
		$sql = mainModel::conectar()->prepare("INSERT INTO predio (predio_plan_id, predio_numero, predio_matricula, predio_propietario, predio_direccion, predio_areaTerr, predio_areaCons, predio_avaluo, predio_valorDeudaP, predio_estrato, predio_destinoEcon, predio_comentarios, predio_detallesTecn, predio_otras) VALUES (:Id_plan, :Numero, :Matricula, :Propietario, :Direccion, :AreaTerr, :AreaCons, :Avaluo, :ValorDeudaP, :Estrato, :DestinoEcon, :Comentarios, :DetallesTecn, :Otras)");

		$sql->bindParam(":Id_plan",$datos['Id_plan']);
		$sql->bindParam(":Numero",$datos['Numero']);
		$sql->bindParam(":Matricula",$datos['Matricula']);
		$sql->bindParam(":Propietario",$datos['Propietario']);
		$sql->bindParam(":Direccion",$datos['Direccion']);
		$sql->bindParam(":AreaTerr",$datos['AreaTerr']);
		$sql->bindParam(":AreaCons",$datos['AreaCons']);
		$sql->bindParam(":Avaluo",$datos['Avaluo']);
		$sql->bindParam(":ValorDeudaP",$datos['ValorDeudaP']);
		$sql->bindParam(":Estrato",$datos['Estrato']);
		$sql->bindParam(":DestinoEcon",$datos['DestinoEcon']);
		$sql->bindParam(":Comentarios",$datos['Comentarios']);
		$sql->bindParam(":DetallesTecn",$datos['DetallesTecn']);
		$sql->bindParam(":Otras",$datos['Otras']);

		$sql->execute();
		//print_r($datos);
		return $sql;

	}


	// modelo para eliminar usuario

	protected static function eliminar_predio_modelo($id){
		$sql = mainModel::conectar()->prepare("DELETE FROM predio WHERE predio_id = :predio_id");

		$sql->bindParam(":predio_id",$id);
		$sql->execute();
		return $sql;

	}

	protected static function datos_predio_modelo($id){
		
		$sql=mainModel::conectar()->prepare("SELECT * FROM predio WHERE predio_id=:predio_id");
		$sql->bindParam(":predio_id",$id);
		
		$sql->execute();
		return $sql;

	}


	// modelo actualizar usuario
	protected static function actualizar_predio_modelo($datos){
		$sql=mainModel::conectar()->prepare("UPDATE predio SET predio_numero=:Numero, predio_nombre=:Nombre, predio_promotor=:Promotor, predio_tipo=:Tipo, predio_modalidad=:Modalidad, predio_areaCesion=:AreaCesion, predio_areaEquip=:AreaEquip, predio_areaProy=:AreaProy, predio_viviendas=:Viviendas, predio_cargas=:Cargas, predio_descripcion=:Descripcion, predio_distribucion=:Distribucion WHERE predio_id = :ID");

		$sql->bindParam(":ID",$datos['ID']);
		$sql->bindParam(":Numero",$datos['Numero']);
		$sql->bindParam(":Nombre",$datos['Nombre']);
		$sql->bindParam(":Promotor",$datos['Promotor']);
		$sql->bindParam(":Tipo",$datos['Tipo']);
		$sql->bindParam(":Modalidad",$datos['Modalidad']);
		$sql->bindParam(":AreaCesion",$datos['AreaCesion']);
		$sql->bindParam(":AreaEquip",$datos['AreaEquip']);
		$sql->bindParam(":AreaProy",$datos['AreaProy']);
		$sql->bindParam(":Viviendas",$datos['Viviendas']);
		$sql->bindParam(":Cargas",$datos['Cargas']);
		$sql->bindParam(":Descripcion",$datos['Descripcion']);
		$sql->bindParam(":Distribucion",$datos['Distribucion']);

		$sql->execute();
		
		return $sql;

	}
	
}