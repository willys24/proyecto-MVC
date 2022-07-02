<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

		<!-- jQuery and jQuery UI (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="modulos/gestorArchivos/css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="modulos/gestorArchivos/css/theme.css">

		<!-- elFinder JS (REQUIRED) -->
		<script type="text/javascript" src="modulos/gestorArchivos/js/elfinder.min.js"></script>

		<!-- elFinder translation (OPTIONAL) -->
		<script type="text/javascript" src="modulos/gestorArchivos/js/i18n/elfinder.es.js"></script>
        
        
<script type="text/javascript" charset="utf-8">
jQuery.noConflict();
jQuery().ready(function() {
	
    var opt = {      // Must change variable name
		url : 'modulos/gestorArchivos/php/connector.php', 
    lang : 'en',
    getFileCallback : function(url) {document.getElementById('ruta').value=url; 
									 document.getElementById('rutaImagen').src=url;    
									 mostrarImagen();
									 cerrar();
									 },    // Must change the form field id
    closeOnEditorCallback : true,
    docked : true,
    dialog : { title : 'File Manager', height: 500 },
    }

    jQuery('#abrir').click(function() {                        // Debe cambiar el ID del botón
    	jQuery('#editor').elfinder(opt)                // Debe actualizar la Identificación del campo de formulario
   		jQuery('#editor').elfinder(jQuery(this).attr('id'));   //Debe actualizar la Identificación del campo de formulario
		mostrar();
    })
});
    jQuery(document).ready(function(){
        jQuery('.taslak').click(function(){
            jQuery('#k').val("Taslak");
        });
    })
//Funciones para desaparecer los divs
function mostrar() {
	div = document.getElementById('cerrar');
	div.style.display ='';
}
function mostrarImagen() {
	div = document.getElementById('rutaImagen');
	div.style.display ='';
}
function mostrarEditor() {
	div = document.getElementById('editor');
	div.style.display ='';
}
function cerrar() {
	div = document.getElementById('editor');
	div.style.display='none';
	div = document.getElementById('cerrar');
	div.style.display='none';
}


</script>
</head>
<body>
<div id="cerrar" style="display:none;"><a href="javascript:cerrar();">Cerrar</a></div>

    <div id="editor"></div>
    <input type="text" id="ruta" name="img" value="" />
    <a href="javascript:mostrarEditor();" ><input type="button" id="abrir" value="Buscar" /></a>
	<img style="display:none;" id="rutaImagen" src="" width="150" height="150" />
    
    
</body>
</html>