<?php
//modelo interactua con la bd

require_once "mainModel.php";

class licenciaModelo extends mainModel{
	// modelo para agregar usuario

	protected static function agregar_licencia_modelo($datos){
		$sql = mainModel::conectar()->prepare("INSERT INTO licencia (licencia_plan_id, licencia_numero, licencia_nombre, licencia_promotor, licencia_tipo, licencia_modalidad, licencia_areaCesion, licencia_areaEquip, licencia_areaProy, licencia_viviendas, licencia_cargas, licencia_descripcion, licencia_distribucion) VALUES (:Id_plan, :Numero, :Nombre, :Promotor, :Tipo, :Modalidad, :AreaCesion, :AreaEquip, :AreaProy, :Viviendas, :Cargas, :Descripcion, :Distribucion)");

		$sql->bindParam(":Id_plan",$datos['Id_plan']);
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
		//print_r($datos);
		return $sql;

	}


	// modelo para eliminar usuario

	protected static function eliminar_licencia_modelo($id){
		$sql = mainModel::conectar()->prepare("DELETE FROM licencia WHERE licencia_id = :licencia_id");

		$sql->bindParam(":licencia_id",$id);
		$sql->execute();
		return $sql;

	}

	protected static function datos_licencia_modelo($id){
		
		$sql=mainModel::conectar()->prepare("SELECT * FROM licencia WHERE licencia_id=:licencia_id");
		$sql->bindParam(":licencia_id",$id);
		
		$sql->execute();
		return $sql;

	}


	// modelo actualizar usuario
	protected static function actualizar_licencia_modelo($datos){
		$sql=mainModel::conectar()->prepare("UPDATE licencia SET licencia_numero=:Numero, licencia_nombre=:Nombre, licencia_promotor=:Promotor, licencia_tipo=:Tipo, licencia_modalidad=:Modalidad, licencia_areaCesion=:AreaCesion, licencia_areaEquip=:AreaEquip, licencia_areaProy=:AreaProy, licencia_viviendas=:Viviendas, licencia_cargas=:Cargas, licencia_descripcion=:Descripcion, licencia_distribucion=:Distribucion WHERE licencia_id = :ID");

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