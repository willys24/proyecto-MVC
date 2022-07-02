<?php
//modelo interactua con la bd

require_once "mainModel.php";

class planModelo extends mainModel{
	// modelo para agregar usuario

	protected static function agregar_plan_modelo($datos){
		$sql = mainModel::conectar()->prepare("INSERT INTO plan (plan_nombre, plan_constructora, plan_decreto, plan_unidades, plan_zona, plan_cronograma, plan_transferencia, plan_departamento, plan_ciudad, plan_AreaNeta, plan_AreaUtil, plan_certificado, plan_preexistencia, plan_EfectoP, plan_ParticipacionP, plan_PParticipacionP, plan_ValorP, plan_AnotacionP, plan_CancelacionP, plan_Observacion) VALUES (:Nombre, :Constructora, :Decreto, :Unidades, :Zona, :Cronograma, :Transferencia, :Departamento, :Ciudad, :AreaNeta, :AreaUtil, :Certificado, :Preexistencia, :EfectoP, :ParticipacionP, :PParticipacionP, :ValorP, :AnotacionP, :CancelacionP, :Observacion)");

		$sql->bindParam(":Nombre",$datos['Nombre']);
		$sql->bindParam(":Constructora",$datos['Constructora']);
		$sql->bindParam(":Decreto",$datos['Decreto']);
		$sql->bindParam(":Unidades",$datos['Unidades']);
		$sql->bindParam(":Zona",$datos['Zona']);
		$sql->bindParam(":Cronograma",$datos['Cronograma']);
		$sql->bindParam(":Transferencia",$datos['Transferencia']);
		$sql->bindParam(":Departamento",$datos['Departamento']);
		$sql->bindParam(":Ciudad",$datos['Ciudad']);
		$sql->bindParam(":AreaNeta",$datos['AreaNeta']);
		$sql->bindParam(":AreaUtil",$datos['AreaUtil']);
		$sql->bindParam(":Certificado",$datos['Certificado']);
		$sql->bindParam(":Preexistencia",$datos['Preexistencia']);
		$sql->bindParam(":EfectoP",$datos['EfectoP']);
		$sql->bindParam(":ParticipacionP",$datos['ParticipacionP']);
		$sql->bindParam(":PParticipacionP",$datos['PParticipacionP']);
		$sql->bindParam(":ValorP",$datos['ValorP']);
		$sql->bindParam(":AnotacionP",$datos['AnotacionP']);
		$sql->bindParam(":CancelacionP",$datos['CancelacionP']);
		$sql->bindParam(":Observacion",$datos['Observacion']);

		$sql->execute();
		//print_r($datos);
		return $sql;

	}


	// modelo para eliminar usuario

	protected static function eliminar_plan_modelo($id){
		$sql = mainModel::conectar()->prepare("DELETE FROM plan WHERE plan_id = :Plan_id");

		$sql->bindParam(":Plan_id",$id);
		$sql->execute();
		return $sql;

	}

	protected static function datos_plan_modelo($id){
		
		$sql=mainModel::conectar()->prepare("SELECT * FROM plan WHERE plan_id=:Plan_id");
		$sql->bindParam(":Plan_id",$id);
		
		$sql->execute();
		return $sql;

	}


	// modelo actualizar usuario
	protected static function actualizar_plan_modelo($datos){
		$sql=mainModel::conectar()->prepare("UPDATE plan SET plan_nombre=:Nombre, plan_constructora=:Constructora, plan_decreto=:Decreto, plan_unidades=:Unidades, plan_zona=:Zona, plan_cronograma=:Cronograma, plan_transferencia=:Transferencia, plan_departamento=:Departamento, plan_ciudad=:Ciudad, plan_AreaNeta=:AreaNeta, plan_AreaUtil=:AreaUtil, plan_certificado=:Certificado, plan_preexistencia=:Preexistencia, plan_EfectoP=:EfectoP, plan_ParticipacionP=:ParticipacionP, plan_PParticipacionP=:PParticipacionP, plan_ValorP=:ValorP, plan_AnotacionP=:AnotacionP, plan_CancelacionP=:CancelacionP, plan_Observacion=:Observacion WHERE plan_id = :ID");

		$sql->bindParam(":ID",$datos['ID']);
		$sql->bindParam(":Nombre",$datos['Nombre']);
		$sql->bindParam(":Constructora",$datos['Constructora']);
		$sql->bindParam(":Decreto",$datos['Decreto']);
		$sql->bindParam(":Unidades",$datos['Unidades']);
		$sql->bindParam(":Zona",$datos['Zona']);
		$sql->bindParam(":Cronograma",$datos['Cronograma']);
		$sql->bindParam(":Transferencia",$datos['Transferencia']);
		$sql->bindParam(":Departamento",$datos['Departamento']);
		$sql->bindParam(":Ciudad",$datos['Ciudad']);
		$sql->bindParam(":AreaNeta",$datos['AreaNeta']);
		$sql->bindParam(":AreaUtil",$datos['AreaUtil']);
		$sql->bindParam(":Certificado",$datos['Certificado']);
		$sql->bindParam(":Preexistencia",$datos['Preexistencia']);
		$sql->bindParam(":EfectoP",$datos['EfectoP']);
		$sql->bindParam(":ParticipacionP",$datos['ParticipacionP']);
		$sql->bindParam(":PParticipacionP",$datos['PParticipacionP']);
		$sql->bindParam(":ValorP",$datos['ValorP']);
		$sql->bindParam(":AnotacionP",$datos['AnotacionP']);
		$sql->bindParam(":CancelacionP",$datos['CancelacionP']);
		$sql->bindParam(":Observacion",$datos['Observacion']);

		$sql->execute();
		
		return $sql;

	}
	
}