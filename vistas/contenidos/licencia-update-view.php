<!-- Page header -->
<?php

	if ($lc->encryption($_SESSION['id_spm'])!=$pagina[1]) {
		if ($_SESSION['privilegio_spm']!=1) {
			echo $lc->cerrar_sesion_controlador();
			exit();
		}
		
	}

?>
	
	
	<!-- Content -->
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
                            <h3>Plan parcial</h3>
                            <a href="">
                                <i class="fa-solid fa-gear"></i> Configuración cuenta
                            </a>
                        </div>


                        

                        <?php
						require_once "./controladores/licenciaControlador.php";
						$ins_licencia = new licenciaControlador();
						$datos_licencia = $ins_licencia->datos_licencia_controlador($pagina[1]);
						if ($datos_licencia->rowCount()==1) {
							$campos = $datos_licencia->fetch();
                            
                            
						?>

                        <div class="nuevo_contenido">

                        	<form action="<?php echo SERVERURL ?>ajax/licenciaAjax.php" class="form-neon FormularioAjax" method="POST" data-form="update" autocomplete="off">
                        		<input type="hidden" name="licencia_id_up"  value="<?php echo $pagina[1]; ?>">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <h3>Información General - Licencia</h3>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label  class="form-label">Número Licencia</label>
                                        <input type="text" class="form-control"  placeholder="Número Licencia" name="licencia_numero_up" required="" value="<?php echo $campos['licencia_numero']; ?>">
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="form-label">Nombre del Proyecto</label>
                                        <input type="text" class="form-control"  placeholder="Nombre del Proyecto" name="licencia_nombre_up" required="" value="<?php echo $campos['licencia_nombre']; ?>">
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="form-label">Promotor</label>
                                        <input type="text" class="form-control"  placeholder="Promotor" name="licencia_promotor_up" required="" value="<?php echo $campos['licencia_promotor']; ?>">
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label for="tipo" class="form-label">Tipo de licencia</label>
                                        <input type="text" class="form-control" id="tipo" name="licencia_tipo_up" required="" value="<?php echo $campos['licencia_tipo']; ?>">
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label for="modalidad" class="form-label">Modalidad</label>
                                        <input type="text" class="form-control" id="modalidad"  name="licencia_modalidad_up" required="" value="<?php echo $campos['licencia_modalidad']; ?>">
                                    </div>
                                                                
                                   
                                    <div class="col-12 mb-3">
                                        <h3>Instrumentos de gestión</h3>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="form-label">Áreas de Cesión</label>
                                        <input type="text" class="form-control"  placeholder="Areas de Cesión" name="licencia_areaCesion_up" value="<?php echo $campos['licencia_areaCesion']; ?>" >
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="form-label">Áreas Equipamiento Colectivo</label>
                                        <input type="text" class="form-control"  placeholder="Areas Equipamiento Colectivo" name="licencia_areaEquip_up" value="<?php echo $campos['licencia_areaEquip']; ?>" >
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="form-label">Área del Proyecto</label>
                                        <input type="text" class="form-control"  placeholder="Área del Proyecto" name="licencia_areaProy_up" value="<?php echo $campos['licencia_areaProy']; ?>" >
                                    </div>
                                    
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Viviendas VIS</label>
                                        <input type="text" class="form-control"  placeholder="Viviendas VIS" name="licencia_viviendas_up" value="<?php echo $campos['licencia_viviendas']; ?>" >
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Cargas</label>
                                        <input type="text" class="form-control"  placeholder="Cargas" name="licencia_cargas_up" value="<?php echo $campos['licencia_cargas']; ?>" >
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Descripción Proyecto</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Descripción Proyecto" name="licencia_descripcion_up"><?php echo $campos['licencia_descripcion']; ?></textarea>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Distribución</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Distribución" name="licencia_distribucion_up"><?php echo $campos['licencia_distribucion']; ?></textarea>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <button type="submit" class="button_prim float-end mt-3 mb-3">Guardar</button>
                                    </div>
                                   
                                </div>  


                            </form>

						<?php
						} else {
							
						?>

					<div class="alert alert-danger text-center" role="alert">
						<p><i class="fas fa-exclamation-triangle fa-5x"></i></p>
						<h4 class="alert-heading">¡Ocurrió un error inesperado!</h4>
						<p class="mb-0">Lo sentimos, no podemos mostrar la información solicitada debido a un error.</p>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>