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
	
				<div class="nuevo_contenido">
					<form class="form-neon FormularioAjax" action="<?php echo SERVERURL ?>ajax/usuarioAjax.php" method="POST" data-form="save" autocomplete="off">
						<div class="row">
	                        <div class="col-12 mb-3">
	                            <h3>INFORMACIÓN GENERAL - USUARIO</h3>
	                        </div>
	                        <div class="col-6 mb-3">
	                            
	                            <label for="usuario_nombre" class="bmd-label-floating">Nombre</label>
								<input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,50}" class="form-control" name="usuario_nombre_reg" required="" id="usuario_nombre" maxlength="50">
	                        </div>
	                        <div class="col-6 mb-3">
	                            <label for="usuario_email" class="bmd-label-floating">Email</label>
								<input type="email" class="form-control" name="usuario_email_reg" id="usuario_email" maxlength="70">
	                        </div>
	                        <div class="col-6 mb-3">
	                            <label for="usuario_telefono" class="bmd-label-floating">Teléfono</label>
								<input type="text"  class="form-control" name="usuario_telefono_reg" id="usuario_telefono" maxlength="20">
	                        </div>
	                        <div class="col-6 mb-3">
	                            <label for="usuario_ciudad" class="bmd-label-floating">Ciudad</label>
	                            <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,35}" class="form-control" name="usuario_ciudad_reg" required="" id="usuario_ciudad" maxlength="50">
	                        </div>
	                       
	                        <div class="col-6 mb-3">
	                            <label for="unidades_gestion" class="form-label">Perfil</label>
	                            <select class="form-select" name="usuario_privilegio_reg">
	                                <option value="2" selected>Usuario</option>
	                                <option value="1" >Administrador</option>
	                            </select>
	                        </div>
	                        <div class="col-6 mb-3">
	                            <label for="usuario_usuario" class="bmd-label-floating">Nombre de usuario</label>
								<input type="text" pattern="[a-zA-Z0-9]{1,50}" class="form-control" name="usuario_usuario_reg" id="usuario_usuario" maxlength="35">
	                        </div>
	                        <div class="col-6 mb-3">
	                            <label for="usuario_clave_1" class="bmd-label-floating">Contraseña</label>
								<input type="password" class="form-control" name="usuario_clave_1_reg" id="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{6,100}" maxlength="100" required="" >
	                        </div>
	                        <div class="col-6 mb-3">
	                            <label for="usuario_clave_2" class="bmd-label-floating">Repetir contraseña</label>
								<input type="password" class="form-control" name="usuario_clave_2_reg" id="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{6,100}" maxlength="100" required="" >
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