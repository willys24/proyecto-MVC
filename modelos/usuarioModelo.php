<?php
//modelo interactua con la bd

require_once "mainModel.php";

class usuarioModelo extends mainModel{
	// modelo para agregar usuario

	protected static function agregar_usuario_modelo($datos){
		$sql = mainModel::conectar()->prepare("INSERT INTO usuario (usuario_nombre, usuario_ciudad, usuario_telefono, usuario_email, usuario_usuario, usuario_clave, usuario_privilegio) VALUES (:Nombre, :Ciudad, :Telefono, :Email, :Usuario, :Clave, :Privilegio)");

		$sql->bindParam(":Nombre",$datos['Nombre']);
		$sql->bindParam(":Ciudad",$datos['Ciudad']);
		$sql->bindParam(":Telefono",$datos['Telefono']);
		$sql->bindParam(":Email",$datos['Email']);
		$sql->bindParam(":Usuario",$datos['Usuario']);
		$sql->bindParam(":Clave",$datos['Clave']);
		$sql->bindParam(":Privilegio",$datos['Privilegio']);

		$sql->execute();
		//print_r($datos);
		return $sql;

	}


	// modelo para eliminar usuario

	protected static function eliminar_usuario_modelo($id){
		$sql = mainModel::conectar()->prepare("DELETE FROM usuario WHERE usuario_id = :Usuario_id");

		$sql->bindParam(":Usuario_id",$id);
		$sql->execute();
		return $sql;

	}

	// modelo datos usuario

	protected static function datos_usuario_modelo($tipo,$id){
		if ($tipo=="Unico") {
			$sql=mainModel::conectar()->prepare("SELECT * FROM usuario WHERE usuario_id=:Usuario_id");
			$sql->bindParam(":Usuario_id",$id);

		} else {
			$sql=mainModel::conectar()->prepare("SELECT usuario_id FROM usuario WHERE usuario_id != 1");
		}
		
		$sql->execute();
		return $sql;

	}

	// modelo actualizar usuario
	protected static function actualizar_usuario_modelo($datos){
		$sql=mainModel::conectar()->prepare("UPDATE usuario SET usuario_nombre=:Nombre, usuario_ciudad=:Ciudad, usuario_telefono=:Telefono, usuario_email=:Email, usuario_usuario=:Usuario, usuario_clave=:Clave, usuario_privilegio=:Privilegio WHERE usuario_id = :ID");

		$sql->bindParam(":ID",$datos['ID']);
		$sql->bindParam(":Nombre",$datos['Nombre']);
		$sql->bindParam(":Ciudad",$datos['Ciudad']);
		$sql->bindParam(":Telefono",$datos['Telefono']);
		$sql->bindParam(":Email",$datos['Email']);
		$sql->bindParam(":Usuario",$datos['Usuario']);
		$sql->bindParam(":Clave",$datos['Clave']);
		$sql->bindParam(":Privilegio",$datos['Privilegio']);

		$sql->execute();
		return $sql;

	}
	
}