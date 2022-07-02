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


                <?php
                    require_once "./controladores/planControlador.php";
                    $ins_plan = new planControlador();
                    $conNomPlan = $ins_plan->datos_plan_controlador($pagina[1]);
                    $resNomPlan = $conNomPlan->fetch(); 

                ?>

                <div class="opciones">
                    <div class="opc_left">
                        <div class="titulo_prim"><?php echo $resNomPlan["plan_nombre"]; ?></div>
                        
                        <a href="<?php echo SERVERURL; ?>licencia-new/<?php echo $pagina[1]; ?>" class="button_prim"><i class="fa fa-plus"></i> Nueva licencia</a>
                        
                    </div>
                    
                </div>
                
	
				<div class="nuevo_contenido">
					<form class="form-neon FormularioAjax" action="<?php echo SERVERURL ?>ajax/licenciaAjax.php" method="POST" data-form="save" autocomplete="off">
                        <input type="hidden" value="<?php echo $pagina[1]; ?>" name="licencia_plan_id">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <h3>Información General - Licencia</h3>
                            </div>
                            <div class="col-4 mb-3">
                                
                                <input type="text" class="form-control"  placeholder="Número Licencia" name="licencia_numero_reg" required="">
                            </div>
                            <div class="col-4 mb-3">
                                <input type="text" class="form-control"  placeholder="Nombre del Proyecto" name="licencia_nombre_reg" required="">
                            </div>
                            <div class="col-4 mb-3">
                                <input type="text" class="form-control"  placeholder="Promotor" name="licencia_promotor_reg" required="">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="unidades_gestion" class="form-label">Tipo de licencia</label>
                                <input type="text" class="form-control" id="unidades_gestion" name="licencia_tipo_reg" required="">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="unidades_gestion" class="form-label">Modalidad</label>
                                <input type="text" class="form-control" id="zona"  name="licencia_modalidad_reg" required="">
                            </div>
                                                        
                           
                            <div class="col-12 mb-3">
                                <h3>Instrumentos de gestión</h3>
                            </div>
                            <div class="col-4 mb-3">
                                <input type="text" class="form-control"  placeholder="Areas de Cesión" name="licencia_areaCesion_reg" >
                            </div>
                            <div class="col-4 mb-3">
                                <input type="text" class="form-control"  placeholder="Areas Equipamiento Colectivo" name="licencia_areaEquip_reg" >
                            </div>
                            <div class="col-4 mb-3">
                                <input type="text" class="form-control"  placeholder="Área del Proyecto" name="licencia_areaProy_reg" >
                            </div>
                            
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control"  placeholder="Viviendas VIS" name="licencia_viviendas_reg" >
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control"  placeholder="Cargas" name="licencia_cargas_reg" >
                            </div>
                            <div class="col-6 mb-3">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Descripción Proyecto" name="licencia_descripcion_reg"></textarea>
                            </div>
                            <div class="col-6 mb-3">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Distribución" name="licencia_distribucion_reg"></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <button type="submit" class="button_prim float-end mt-3 mb-3">Guardar</button>
                            </div>
                           
                        </div>	
						
					</form>


				</div>
		</div>
	</div>
</div>