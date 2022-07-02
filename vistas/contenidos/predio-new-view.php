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
                        
                        <a href="<?php echo SERVERURL; ?>predio-new/<?php echo $pagina[1]; ?>" class="button_prim"><i class="fa fa-plus"></i> Nuevo predio</a>
                        
                    </div>
                    
                </div>
                
	
				<div class="nuevo_contenido">
					<form class="form-neon FormularioAjax" action="<?php echo SERVERURL ?>ajax/predioAjax.php" method="POST" data-form="save" autocomplete="off">
                        <input type="hidden" value="<?php echo $pagina[1]; ?>" name="predio_plan_id">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <h3>Información General - Predio</h3>
                            </div>
                            <div class="col-6 mb-3">
                                
                                <input type="text" class="form-control"  placeholder="Número Predial" required="" name="predio_numero_reg">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control"  placeholder="Matrícula" required="" name="predio_matricula_reg">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control"  placeholder="Propietario" required="" name="predio_propietario_reg">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control"  placeholder="Dirección" required="" name="predio_direccion_reg">
                            </div>
                           
                            
                           
                            <div class="col-12 mb-3">
                                <h3>Instrumentos de gestión</h3>
                            </div>
                            <div class="col-3 mb-3">
                                <input type="text" class="form-control"  placeholder="Área Terreno" name="predio_areaTerr_reg">
                            </div>
                            <div class="col-3 mb-3">
                                <input type="text" class="form-control"  placeholder="Área Construida" name="predio_areaCons_reg">
                            </div>
                            <div class="col-3 mb-3">
                                <input type="text" class="form-control"  placeholder="Avaluó" name="predio_avaluo_reg">
                            </div>
                            <div class="col-3 mb-3">
                                <input type="text" class="form-control"  placeholder="Valor Deuda Predial" name="predio_valorDeudaP_reg">
                            </div>
                            
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control"  placeholder="Estrato" name="predio_estrato_reg">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="text" class="form-control"  placeholder="Destino Económico" name="predio_destinoEcon_reg">
                            </div>
                            <div class="col-4 mb-3">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Comentarios" name="predio_comentarios_reg"></textarea>
                            </div>
                            <div class="col-4 mb-3">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Detalles técnicos" name="predio_detallesTecn_reg"></textarea>
                            </div>
                            <div class="col-4 mb-3">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Otras" name="predio_otras_reg"></textarea>
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