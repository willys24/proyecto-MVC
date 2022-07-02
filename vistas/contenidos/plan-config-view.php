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
                                <h3 class="config"><i class="fa-solid fa-sliders"></i> Configuración mostrar columnas </h3>
                            </div>
                            <?php 
                            //print_r($_SESSION['conf_plan']);

                            if (isset($_POST['module'])) {


                                function val($val) { return "0"; }
                                $_SESSION['conf_plan'] = array_map( 'val' , $_SESSION['conf_plan'] );

                                foreach($_POST['module'] as $selected) {                                    
                                    $_SESSION['conf_plan'][$selected] = "1";
                                }

                                ?>

                                <script>
                                Swal.fire({
                                    icon: "success",
                                    title: "Configuración guardada",
                                    confirmButtonText : "Aceptar"
                                }).then(function() {
                                    window.location.href ="<?php echo SERVERURL; ?>plan-list/";
                                });
                                </script>

                                <?php

                                
                            }
                            
                            ?>
                            <div class="col-6 mb-3">
                                <form method="POST" action="">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Nombre']=="1") { echo "checked"; } ?> value="Nombre"  name="module[]">
                                        <label>Plan Parcial</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Constructora']=="1") { echo "checked"; } ?> value="Constructora" name="module[]">
                                        <label>Constructora</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Decreto']=="1") { echo "checked"; } ?> value="Decreto" name="module[]">
                                        <label>Decreto Adopción</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Unidades']=="1") { echo "checked"; } ?> value="Unidades" name="module[]">
                                        <label>Unidades de gestión</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Cronograma']=="1") { echo "checked"; } ?> value="Cronograma" name="module[]">
                                        <label>Cronograma ejecución</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Zona']=="1") { echo "checked"; } ?> value="Zona" name="module[]">
                                        <label>Zona</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Transferencia']=="1") { echo "checked"; } ?> value="Transferencia" name="module[]">
                                        <label>Transferencia de Dominio</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Departamento']=="1") { echo "checked"; } ?> value="Departamento" name="module[]">
                                        <label>Departamento</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Ciudad']=="1") { echo "checked"; } ?> value="Ciudad" name="module[]">
                                        <label>Ciudad</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Anotacion']=="1") { echo "checked"; } ?> value="Anotacion" name="module[]">
                                        <label>Anotación Plusvalía</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Cancelacion']=="1") { echo "checked"; } ?> value="Cancelacion" name="module[]">
                                        <label>Cancelación Plusvalía</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Efecto']=="1") { echo "checked"; } ?> value="Efecto" name="module[]">
                                        <label>Efecto Plusvalía</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Participacion']=="1") { echo "checked"; } ?> value="Participacion" name="module[]">
                                        <label>Participación Plusvalía</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['PParticipacion']=="1") { echo "checked"; } ?> value="PParticipacion" name="module[]">
                                        <label>% Participación Plusvalía</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['AreaNeta']=="1") { echo "checked"; } ?> value="AreaNeta" name="module[]">
                                        <label>Área Neta</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['AreaUtil']=="1") { echo "checked"; } ?> value="AreaUtil" name="module[]">
                                        <label>Área Útil</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Preexistencia']=="1") { echo "checked"; } ?> value="Preexistencia" name="module[]">
                                        <label>Preexistencia</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['ValorP']=="1") { echo "checked"; } ?> value="ValorP" name="module[]">
                                        <label>Valor Plusvalía</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Certificado']=="1") { echo "checked"; } ?> value="Certificado" name="module[]">
                                        <label>Certificado de Ocupación</label>
                                    </div>
                                    <div class="col-6 d-flex align-items-center config_cols">
                                        <input type="checkbox" <?php if($_SESSION['conf_plan']['Observaciones']=="1") { echo "checked"; } ?> value="Observaciones" name="module[]">
                                        <label>Observaciones</label>
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