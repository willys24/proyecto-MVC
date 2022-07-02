
<div class="container-fluid p-0">
    <div class="login">
        <form action="" method="POST">
            <div class="row">
                <div class="col-12 mb-3">
                    <img src="<?php echo SERVERURL; ?>vistas/img/logo.png">
                </div>
                <div class="col-12 mb-3">
                	<h2 class="text-light">INICIA SESIÓN</h2>
                </div>
                <div class="col-12 mb-3">
                    <label for="UserName" class="form-label text-light">Usuario</label>
                    <input type="text" class="form-control" id="UserName" name="usuario_log" pattern="[a-zA-Z0-9]{1,35}" maxlength="35" required="" >
                </div>
                <div class="col-12 mb-3">
                    <label for="UserPassword" class="form-label text-light">Contraseña</label>
                    <input type="password" class="form-control" id="UserPassword" name="clave_log" pattern="[a-zA-Z0-9$@.-]{5,100}" maxlength="100" required="">
                </div>
                <div class="col-12 mb-3">
                    <button type="submit" class=" btn btn-danger mt-3 mb-3">Entrar</button>
                </div>
            </div>

        </form>
    </div>
</div>
<?php
	if (isset($_POST['usuario_log']) && isset($_POST['clave_log'])) {
		require_once "./controladores/loginControlador.php";

		$ins_login = new loginControlador();

		echo $ins_login->iniciar_sesion_controlador();
	}
	
?>