		<!-- jQuery and jQuery UI (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo SERVERURL; ?>vistas/gestorArchivos/css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo SERVERURL; ?>vistas/gestorArchivos/css/theme.css">

		<!-- elFinder JS (REQUIRED) -->
		<script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/gestorArchivos/js/elfinder.min.js"></script>

		<!-- elFinder translation (OPTIONAL) -->
		<script type="text/javascript" src="<?php echo SERVERURL; ?>vistas/gestorArchivos/js/i18n/elfinder.es.js"></script>

	
        
 <script type="text/javascript" charset="utf-8">
    $().ready(function() {
    var elf = $('#elfinder').elfinder({
		url : '<?php echo SERVERURL; ?>vistas/gestorArchivos/php/connector.php', 
        getFileCallback : function(file) {
                $( "#featured_image", window.opener.document ).val(file.url);
                window.close();
        },
        resizable: false
 	   }).elfinder('instance');
	});
        
</script>		
	
<div class="contenido">
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col">
                <img src="<?php echo SERVERURL; ?>vistas/img/logo.png" width="300px">
            </div>
        </div>
        <div class="row">
            <div class="col">

                <div class="titulo">
                    <h3>Gestor de archivos</h3>
                    <a href="">
                        <i class="fa-solid fa-gear"></i> Configuración cuenta
                    </a>
                </div>
                <div class="nuevo_contenido">
					<!-- Element where elFinder will be created (REQUIRED) -->
					<div id="elfinder" ></div>
				</div>
			</div>
		</div>
	</div>
</div>
				