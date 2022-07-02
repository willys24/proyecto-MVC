<?php

class vistasModelo{

	/* modelo para obtener las vistas*/
	protected static function obtener_vistas_modelo($vistas){
		$listaBlanca=["home","user-list", "user-update", "user-new", "plan-list", "plan-new", "plan-update", "gestor-archivos", "licencia-list", "licencia-update", "licencia-new", "predio-list", "predio-new", "predio-update", "predio-config", "plan-config", "licencia-config"];
		if (in_array($vistas, $listaBlanca)) {
			if(is_file("./vistas/contenidos/".$vistas."-view.php")){
				$contenido="./vistas/contenidos/".$vistas."-view.php";
			}else{
				$contenido="404";
			}
			
		}elseif ($vistas=="login") {
			$contenido="login";
		}else{
			$contenido="404";
		}

		return $contenido;
	}
	
}