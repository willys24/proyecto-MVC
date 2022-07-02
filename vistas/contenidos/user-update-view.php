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
                            <h3>Usuarios</h3>
                            <a href="">
                                <i class="fa-solid fa-gear"></i> Configuración cuenta
                            </a>
                        </div>

                        <div class="opciones">
                            <div class="opc_left">
                                
                                <a href="<?php echo SERVERURL; ?>user-new/" class="button_prim"><i class="fa fa-plus"></i> Nuevo usuario</a>
                                
                            </div>
                            
                        </div>

                        <?php
						require_once "./controladores/usuarioControlador.php";
						$ins_usuario = new usuarioControlador();
						$datos_usuarios = $ins_usuario->datos_usuario_controlador("Unico",$pagina[1]);
						if ($datos_usuarios->rowCount()==1) {
							$campos = $datos_usuarios->fetch();

						?>

                        <div class="nuevo_contenido">

                        	<form action="<?php echo SERVERURL ?>ajax/usuarioAjax.php" class="form-neon FormularioAjax" method="POST" data-form="update" autocomplete="off">
                        		<input type="hidden" name="usuario_id_up"  value="<?php echo $pagina[1]; ?>">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <h3>INFORMACIÓN GENERAL - USUARIO</h3>
                                    </div>
                                    <div class="col-6 mb-3">
                                    	<label for="usuario_nombre" class="form-label">Nombre</label>                                        
                                        <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,80}" class="form-control" name="usuario_nombre_up" id="usuario_nombre" maxlength="35" value="<?php echo $campos['usuario_nombre']; ?>" required >
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="usuario_email_up" class="form-label">Correo</label>
                                        <input type="email" class="form-control" name="usuario_email_up" id="usuario_correo" maxlength="35" value="<?php echo $campos['usuario_email']; ?>" required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="usuario_telefono" class="form-label">Teléfono</label>
                                        <input type="text" pattern="[0-9()+]{8,20}" class="form-control" name="usuario_telefono_up" id="usuario_telefono" maxlength="20" value="<?php echo $campos['usuario_telefono']; ?>">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="usuario_usuario" class="form-label">Ciudad</label>
                                        <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,80}" class="form-control" name="usuario_ciudad_up" id="usuario_ciudad" maxlength="35" value="<?php echo $campos['usuario_ciudad']; ?>">

                                    </div>
                                   
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Perfil</label>
                                        <select class="form-select" name="usuario_privilegio_up" >
                                            <option <?php if($campos['usuario_privilegio']=='2'){ echo "selected "; }; ?> value='2'>Usuario</option>
                                            <option <?php if($campos['usuario_privilegio']=='1'){ echo "selected  "; }; ?> value='1'>Administrador</option>
                                        </select>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="usuario_usuario" class="form-label">Usuario</label>
                                        <input type="text" pattern="[a-zA-Z0-9]{1,50}" class="form-control" name="usuario_usuario_up" id="usuario_usuario" maxlength="50" value="<?php echo $campos['usuario_usuario']; ?>">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="unidades_gestion" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" name="usuario_clave_nueva_1" id="usuario_clave_nueva_1" pattern="[a-zA-Z0-9$@.-]{6,100}" maxlength="100" >
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="unidades_gestion" class="form-label">Repita Contraseña</label>
                                        <input type="password" class="form-control" name="usuario_clave_nueva_2" id="usuario_clave_nueva_2" pattern="[a-zA-Z0-9$@.-]{6,100}" maxlength="100" >
                                    </div>
                                    
                                 
                                    <div class="col-12 mb-3">
                                        <button type="submit" class="button_prim float-end mt-3 mb-3">Actualizar</button>
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