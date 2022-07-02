<!--=============================================
	=            Include JavaScript files           =
	==============================================-->




	
    <?php
	if(!isset($_GET['views'])){
		?>
		<script src="<?php echo SERVERURL; ?>vistas/plugins/owl-carousel/owl.carousel.min.js"></script>
		<script src="<?php echo SERVERURL; ?>vistas/js/themeCore.js"></script>
    	<script src="<?php echo SERVERURL; ?>vistas/js/theme.js"></script>

		<?php
		
	}else{
		if($_GET['views']=="" || $_GET['views']=="home"){
			?>
			<script src="<?php echo SERVERURL; ?>vistas/plugins/owl-carousel/owl.carousel.min.js"></script>
		<script src="<?php echo SERVERURL; ?>vistas/js/themeCore.js"></script>
    	<script src="<?php echo SERVERURL; ?>vistas/js/theme.js"></script>

			<?php
		}else{
			include "logOut.php";
		}
	}
	?>


	<script src="<?php echo SERVERURL; ?>vistas/js/main.js" ></script>
	<script src="<?php echo SERVERURL; ?>vistas/js/alertas.js" ></script>