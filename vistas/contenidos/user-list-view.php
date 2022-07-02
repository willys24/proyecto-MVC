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
                        <?php
                        $busq = "";
                        if (!isset($_SESSION['busqueda_usuario']) && empty($_SESSION['busqueda_usuario'])) {
                            $busq = "";
                        
                        ?>
                        <form class="form-neon FormularioAjax" action="<?php echo SERVERURL ?>ajax/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
                            <input type="hidden" name="modulo" value="usuario">
                            <div class="input-group">
                                <input type="text" class="form-control" name="busqueda_inicial" id="inputSearch" placeholder="Buscador" aria-label="Buscador" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2"><button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button></span>
                            </div>
                         
                            
                        </form>
                        <?php
                        } 
                        ?>
                    </div>
                    <div class="opc_right">
                        <a href="" class="button_prim gray">Orden Asc</a>
                    </div>
                </div>

                <div class="tablas_contenido">

                    <?php
                    if (isset($_SESSION['busqueda_usuario']) && !empty($_SESSION['busqueda_usuario'])) {
                    $busq = $_SESSION['busqueda_usuario'];
                    ?>
                    <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
                        <input type="hidden" name="modulo" value="usuario">
                        <input type="hidden" name="eliminar_busqueda" value="eliminar">
                        <div class="container-fluid">
                            <div class="row justify-content-md-center">
                                <div class="col-12 col-md-6">
                                    <p class="text-center" style="font-size: 20px;">
                                        Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_usuario']; ?>”</strong>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <p class="text-center" style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-raised btn-danger"><i class="far fa-trash-alt"></i> &nbsp; ELIMINAR BÚSQUEDA</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                   
				<?php
                    }
					require_once "./controladores/usuarioControlador.php";
					$ins_usuario = new usuarioControlador();
                    

					echo $ins_usuario->paginador_usuario_controlador($pagina[1],15,$_SESSION['privilegio_spm'],$_SESSION['id_spm'],$pagina[0],$busq);
				?>			

				</div>
            </div>
        </div>
    </div>
</div>

