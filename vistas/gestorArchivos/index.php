		<!-- jQuery and jQuery UI (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="modulos/gestorArchivos/css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="modulos/gestorArchivos/css/theme.css">

		<!-- elFinder JS (REQUIRED) -->
		<script type="text/javascript" src="modulos/gestorArchivos/js/elfinder.min.js"></script>

		<!-- elFinder translation (OPTIONAL) -->
		<script type="text/javascript" src="modulos/gestorArchivos/js/i18n/elfinder.es.js"></script>

	
        
 <script type="text/javascript" charset="utf-8">
    $().ready(function() {
    var elf = $('#elfinder').elfinder({
		url : 'modulos/gestorArchivos/php/connector.php', 
        getFileCallback : function(file) {
                $( "#featured_image", window.opener.document ).val(file.url);
                window.close();
        },
        resizable: false
 	   }).elfinder('instance');
	});
        
</script>		
	
		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder" ></div>
	