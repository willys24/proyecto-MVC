<!-- Normalize V8.0.1 -->
	<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/normalize.css">

	<!-- Bootstrap V4.3 -->
	<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/bootstrap.min.css">
	<!-- General Styles -->
	<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/css.css">
	<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/plugins/owl-carousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/sweetalert2.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

	<!-- Bootstrap V4.3 -->
	<script src="<?php echo SERVERURL; ?>vistas/js/bootstrap.bundle.min.js" ></script>

	

	
	<!-- Sweet Alert V11 JS file-->
	<script src="<?php echo SERVERURL; ?>vistas/js/sweetalert2.all.min.js" ></script>

	<!-- Bootstrap Material Design V4.0 -->

	<!-- Font Awesome V5.9.0 -->
	<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/all.min.css">

	<!-- jQuery V3.4.1 -->
	<?php
	if(!isset($_GET['views'])){
		?><script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script><?php
		
	}else{
		if($_GET['views']=="" || $_GET['views']=="home"){
			?><script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script><?php
		}else{
			?> <script src="<?php echo SERVERURL; ?>vistas/js/jquery-3.4.1.min.js" ></script> <?php
		}
	}
	?>

	


	

	
	

