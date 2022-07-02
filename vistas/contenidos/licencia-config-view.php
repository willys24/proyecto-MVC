<!-- Page header -->
<?php
if ($_SESSION['privilegio_spm']!=1) {	
	echo $ins_login->iniciar_sesion_controlador();
	exit();
}				
?>
<div class="contenido">
		
		
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col">
                <img src="<?php echo SERVERURL; ?>vistas/img/logo.png" width="250px">
            </div>
        </div>
        <div class="row">
            <div class="col">

                <div class="titulo">
                    <h3>Plan parcial</h3>
                    <a href="">
                        <i class="fa-solid fa-gear"></i> Configuración cuenta
                    </a>
                </div>

                
	
				<div class="nuevo_contenido">
					
                        <div class="row">
                            <div class="col-12 mb-3">
                                <a class="btn btn-secondary mb-2" href="<?php echo SERVERURL; ?>licencia-list/<?php echo $pagina[1]; ?>/">Volver</a>
                                <h3 class="config"><i class="fa-solid fa-sliders"></i> Configuración mostrar columnas </h3>
                            </div>
                            <?php 
                            //print_r($_SESSION['conf_licencia']);

                            if (isset($_POST['module'])) {


                                function val($val) { return "0"; }
                                $_SESSION['conf_licencia'] = array_map( 'val' , $_SESSION['conf_licencia'] );

                                foreach($_POST['module'] as $selected) {                                    
                                    $_SESSION['conf_licencia'][$selected] = "1";
                                }

                                ?>

                                <script>
                                Swal.fire({
                                    icon: "success",
                                    title: "Configuración guardada",
                                    confirmButtonText : "Aceptar"
                                });
                                </script>

                                <?php

                                
                            }
                            
                            ?>
                            <div class="col-6 mb-3">
                                <form method="POST" action="">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_licencia']['Numero']=="1") { echo "checked"; } ?> value="Numero"  name="module[]">
                                        <label>Número Licencia</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_licencia']['Nombre']=="1") { echo "checked"; } ?> value="Nombre" name="module[]">
                                        <label>Nombre del Proyecto</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_licencia']['Promotor']=="1") { echo "checked"; } ?> value="Promotor" name="module[]">
                                        <label>Promotor</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_licencia']['Tipo']=="1") { echo "checked"; } ?> value="Tipo" name="module[]">
                                        <label>Tipo de licencia</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_licencia']['Modalidad']=="1") { echo "checked"; } ?> value="Modalidad" name="module[]">
                                        <label>Modalidad</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_licencia']['AreaCesion']=="1") { echo "checked"; } ?> value="AreaCesion" name="module[]">
                                        <label>Areas de Cesión</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_licencia']['AreaEquip']=="1") { echo "checked"; } ?> value="AreaEquip" name="module[]">
                                        <label>Areas Equipamiento Colectivo</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_licencia']['AreaProy']=="1") { echo "checked"; } ?> value="AreaProy" name="module[]">
                                        <label>Área del Proyecto</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_licencia']['Viviendas']=="1") { echo "checked"; } ?> value="Viviendas" name="module[]">
                                        <label>Viviendas VIS</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_licencia']['Cargas']=="1") { echo "checked"; } ?> value="Cargas" name="module[]">
                                        <label>Cargas</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_licencia']['Descripcion']=="1") { echo "checked"; } ?> value="Descripcion" name="module[]">
                                        <label>Descripción Proyecto</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_licencia']['Distribucion']=="1") { echo "checked"; } ?> value="Distribucion" name="module[]">
                                        <label>Distribución</label>
                                    </div>
                                    
                                    <div class="col-12 mb-2">
                                        <button type="submit" class="button_prim float-end mt-3 mb-2">Guardar</button>
                                    </div>

                                </div>
                            </form>
                            </div>
                           
                           
                            
                            
                           
                        </div>
						

				</div>
		</div>
	</div>
</div>