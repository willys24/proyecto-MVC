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

                <div class="opciones">
                    <div class="opc_left">
                        
                        <a href="<?php echo SERVERURL; ?>plan-new/" class="button_prim"><i class="fa fa-plus"></i> Nuevo plan parcial</a>
                        
                    </div>
                    
                </div>
                
	
				<div class="nuevo_contenido">
					<form class="form-neon FormularioAjax" action="<?php echo SERVERURL ?>ajax/planAjax.php" method="POST" data-form="save" autocomplete="off">
						<div class="row">
                            <div class="col-12 mb-2">
                                <h3>Información General - Plan Parcial</h3>
                            </div>
                            <div class="col-4 mb-2">
                                
                                <input type="text" class="form-control" name="plan_nombre_reg" required="" placeholder="Nombre plan parcial">
                            </div>
                            <div class="col-4 mb-2">
                                <input type="text" class="form-control" name="plan_constructora_reg" required=""  placeholder="Constructora">
                            </div>
                            <div class="col-4 mb-2">
                                <input type="text" class="form-control" name="plan_decreto_reg" required=""  placeholder="Decreto Adopción">
                            </div>
                            <div class="col-4 mb-2">
                                <label for="unidades_gestion" class="form-label">Unidades de gestión</label>
                                <input type="text" class="form-control" name="plan_unidades_reg" id="unidades_gestion">
                            </div>
                            <div class="col-4 mb-2">
                                <label for="unidades_gestion" class="form-label">Zona</label>
                                <input type="text" class="form-control" name="plan_zona_reg" required="" id="zona" >
                            </div>
                            <div class="col-4 mb-2">
                            	<label  class="form-label">Cronograma ejecución (Año inicial - Año final)</label>
                            	<div class="row">
                            		<div class="col">
                            			<input type="text" pattern="\d{4}" class="form-control" min="1990" value="2022"  name="plan_cronograma1_reg" required="" >
                            		</div>_
                            		<div class="col">
                            			<input type="text" pattern="\d{4}" class="form-control" min="1990" value="2022"  name="plan_cronograma2_reg" required=""   >
                            		</div>
                            	</div>
                            		
                            	
                            </div>
                            <div class="col-8 mb-2">
                                <textarea class="form-control" name="plan_transferencia_reg" rows="4" placeholder="Transferencia de Dominio"></textarea>
                            </div>
                            <div class="col-4 mb-2">
                                <input type="text" class="form-control mb-2" name="plan_departamento_reg" required="" placeholder="Departamento">
                                <input type="text" class="form-control mb-2" name="plan_ciudad_reg" required="" placeholder="Ciudad">
                            </div>
                            <div class="col-12 mb-2">
                                <h3>Instrumentos de gestión</h3>
                            </div>
                            <div class="col-3 mb-2">
                                <input type="text" class="form-control" name="plan_AreaNeta_reg"  placeholder="Área Neta">
                            </div>
                            <div class="col-3 mb-2">
                                <input type="text" class="form-control" name="plan_AreaUtil_reg"  placeholder="Área Útil">
                            </div>
                            <div class="col-3 mb-2">
                                <input type="text" class="form-control" name="plan_certificado_reg"  placeholder="Certificado de Ocupación">
                            </div>
                            <div class="col-3 mb-2">
                                <input type="text" class="form-control" name="plan_preexistencia_reg"  placeholder="Preexistencia">
                            </div>
                            <div class="col-12 mb-2">
                                <h3>Instrumentos de financiación</h3>
                            </div>
                            <div class="col-3 mb-2">
                                <input type="text" class="form-control" name="plan_EfectoP_reg"  placeholder="Efecto Plusvalía">
                            </div>
                            <div class="col-3 mb-2">
                                <input type="text" class="form-control" name="plan_ParticipacionP_reg" placeholder="Participación Plusvalía">
                            </div>
                            <div class="col-3 mb-2">
                                <input type="text" class="form-control" name="plan_PParticipacionP_reg"  placeholder="% Participación Plusvalía">
                            </div>
                            <div class="col-3 mb-2">
                                <input type="text" class="form-control" name="plan_ValorP_reg" placeholder="Valor Plusvalía">
                            </div>
                            <div class="col-4 mb-2">
                                <textarea class="form-control" name="plan_AnotacionP_reg" rows="4" placeholder="Anotación Plusvalía
                                "></textarea>
                            </div>
                            <div class="col-4 mb-2">
                                <textarea class="form-control" name="plan_CancelacionP_reg" rows="4" placeholder="Cancelación Plusvalía"></textarea>
                            </div>
                            <div class="col-4 mb-2">
                                <textarea class="form-control" name="plan_Observacion_reg" rows="4" placeholder="Observación"></textarea>
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