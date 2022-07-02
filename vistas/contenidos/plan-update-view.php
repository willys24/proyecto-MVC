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

                        <div class="opciones">
                            <div class="opc_left">
                                
                                <a href="<?php echo SERVERURL; ?>plan-new/" class="button_prim"><i class="fa fa-plus"></i> Nuevo plan parcial</a>
                                
                            </div>
                            
                        </div>

                        <?php
						require_once "./controladores/planControlador.php";
						$ins_plan = new planControlador();
						$datos_plan = $ins_plan->datos_plan_controlador($pagina[1]);
						if ($datos_plan->rowCount()==1) {
							$campos = $datos_plan->fetch();

                            $crono = explode("-", $campos['plan_cronograma']);
                            
						?>

                        <div class="nuevo_contenido">

                        	<form action="<?php echo SERVERURL ?>ajax/planAjax.php" class="form-neon FormularioAjax" method="POST" data-form="update" autocomplete="off">
                        		<input type="hidden" name="plan_id_up"  value="<?php echo $pagina[1]; ?>">

                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <h3>Información General - Plan Parcial</h3>
                                    </div>
                                    <div class="col-4 mb-2">                                        
                                        <input type="text" class="form-control" name="plan_nombre_up" required="" placeholder="Nombre plan parcial" value="<?php echo $campos['plan_nombre']; ?>">
                                    </div>
                                    <div class="col-4 mb-2">
                                        <input type="text" class="form-control" name="plan_constructora_up" required=""  placeholder="Constructora" value="<?php echo $campos['plan_constructora']; ?>">
                                    </div>
                                    <div class="col-4 mb-2">
                                        <input type="text" class="form-control" name="plan_decreto_up" required=""  placeholder="Decreto Adopción" value="<?php echo $campos['plan_decreto']; ?>">
                                    </div>
                                    <div class="col-4 mb-2">
                                        <label for="unidades_gestion" class="form-label">Unidades de gestión</label>
                                        <input type="text" class="form-control" name="plan_unidades_up" id="unidades_gestion" value="<?php echo $campos['plan_unidades']; ?>">
                                    </div>
                                    <div class="col-4 mb-2">
                                        <label for="unidades_gestion" class="form-label">Zona</label>
                                        <input type="text" class="form-control" name="plan_zona_up" required="" id="zona" value="<?php echo $campos['plan_zona']; ?>">
                                    </div>
                                    <div class="col-4 mb-2">
                                        <label  class="form-label">Cronograma ejecución (Año inicial - Año final)</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" pattern="\d{4}" class="form-control" min="1990" value="<?php echo $crono[0]; ?>"  name="plan_cronograma1_up" required="" >
                                            </div>_
                                            <div class="col">
                                                <input type="text" pattern="\d{4}" class="form-control" min="1990" value="<?php echo $crono[1]; ?>"  name="plan_cronograma2_up" required=""   >
                                            </div>
                                        </div>
                                            
                                        
                                    </div>
                                    <div class="col-8 mb-2">
                                        <textarea class="form-control" name="plan_transferencia_up" rows="4" placeholder="Transferencia de Dominio"><?php echo $campos['plan_transferencia']; ?></textarea>
                                    </div>
                                    <div class="col-4 mb-2">
                                        <input type="text" class="form-control mb-2" name="plan_departamento_up" required="" placeholder="Departamento" value="<?php echo $campos['plan_departamento']; ?>">
                                        <input type="text" class="form-control mb-2" name="plan_ciudad_up" required="" placeholder="Ciudad" value="<?php echo $campos['plan_ciudad']; ?>">
                                    </div>
                                    <div class="col-12 mb-2">
                                        <h3>Instrumentos de gestión</h3>
                                    </div>
                                    <div class="col-3 mb-2">
                                        <input type="text" class="form-control" name="plan_AreaNeta_up" placeholder="Área Neta" value="<?php echo $campos['plan_AreaNeta']; ?>">
                                    </div>
                                    <div class="col-3 mb-2">
                                        <input type="text" class="form-control" name="plan_AreaUtil_up" placeholder="Área Útil" value="<?php echo $campos['plan_AreaUtil']; ?>">
                                    </div>
                                    <div class="col-3 mb-2">
                                        <input type="text" class="form-control" name="plan_certificado_up" placeholder="Certificado de Ocupación" value="<?php echo $campos['plan_certificado']; ?>">
                                    </div>
                                    <div class="col-3 mb-2">
                                        <input type="text" class="form-control" name="plan_preexistencia_up" placeholder="Preexistencia" value="<?php echo $campos['plan_preexistencia']; ?>">
                                    </div>
                                    <div class="col-12 mb-2">
                                        <h3>Instrumentos de financiación</h3>
                                    </div>
                                    <div class="col-3 mb-2">
                                        <input type="text" class="form-control" name="plan_EfectoP_up" placeholder="Efecto Plusvalía" value="<?php echo $campos['plan_EfectoP']; ?>">
                                    </div>
                                    <div class="col-3 mb-2">
                                        <input type="text" class="form-control" name="plan_ParticipacionP_up" placeholder="Participación Plusvalía" value="<?php echo $campos['plan_ParticipacionP']; ?>">
                                    </div>
                                    <div class="col-3 mb-2">
                                        <input type="text" class="form-control" name="plan_PParticipacionP_up" placeholder="% Participación Plusvalía" value="<?php echo $campos['plan_PParticipacionP']; ?>">
                                    </div>
                                    <div class="col-3 mb-2">
                                        <input type="text" class="form-control" name="plan_ValorP_up" placeholder="Valor Plusvalía" value="<?php echo $campos['plan_ValorP']; ?>">
                                    </div>
                                    <div class="col-4 mb-2">
                                        <textarea class="form-control" name="plan_AnotacionP_up" rows="4" placeholder="Anotación Plusvalía
                                        "><?php echo $campos['plan_AnotacionP']; ?></textarea>
                                    </div>
                                    <div class="col-4 mb-2">
                                        <textarea class="form-control" name="plan_CancelacionP_up" rows="4" placeholder="Cancelación Plusvalía"><?php echo $campos['plan_CancelacionP']; ?></textarea>
                                    </div>
                                    <div class="col-4 mb-2">
                                        <textarea class="form-control" name="plan_Observacion_up" rows="4" placeholder="Observación"><?php echo $campos['plan_Observacion']; ?></textarea>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <button type="submit" class="button_prim float-end mt-3 mb-2">Guardar</button>
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