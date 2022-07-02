<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo COMPANY; ?></title>

	<?php 
	 error_reporting(E_ALL); ini_set('display_errors', '1');
		include "./vistas/inc/style.php";
	?>


</head>
<body>

	<?php 
	if(!isset($_GET['views']) || $_GET['views']=="home"){
		require_once "./vistas/contenidos/home-view.php";
	}else{
		$peticionAjax = false;
		require_once "./controladores/vistasControlador.php";
		$iv = new vistasControlador();

		$vistas = $iv->obtener_vistas_controlador();
		if ($vistas=="login" || $vistas=="404") {
			require_once "./vistas/contenidos/".$vistas."-view.php";
		}else{

			session_start(['name'=>'SPM']);

			//parametros paginador
			$pagina = explode("/", $_GET['views']);


			require_once "./controladores/loginControlador.php";
			//instancia
			$lc = new loginControlador();

			if (!isset($_SESSION['token_spm']) || !isset($_SESSION['usuario_spm']) || !isset($_SESSION['privilegio_spm']) || !isset($_SESSION['id_spm'])) {
				echo $lc->cerrar_sesion_controlador();
				exit();
			}
			
	?>
	
	<!-- Main container -->
	<div class="contenido_body">
		<!-- Nav lateral -->
		<?php 
			include "./vistas/inc/navLateral.php";

			include $vistas;
		?>

	</div>
	
	<?php 
			
		}
	}
		include "./vistas/inc/script.php";
		
	?>
	
</body>
</html>