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
                        <a href="<?php echo SERVERURL; ?>predio-new/<?php echo $pagina[1]; ?>" class="button_prim"><i class="fa fa-plus"></i> Nuevo predio</a>
                        
                    </div>
                    <div class="opc_right">
                        <?php
                        $busq = "";
                        if (!isset($_SESSION['busqueda_predio']) && empty($_SESSION['busqueda_predio'])) {
                            $busq = "";
                        
                        ?>
                        <form class="form-neon FormularioAjax" action="<?php echo SERVERURL ?>ajax/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
                            <input type="hidden" name="modulo" value="predio">
                            <input type="hidden" name="id_url" value="<?php echo $pagina[1]; ?>">
                            <div class="input-group">
                                <input type="text" class="form-control" name="busqueda_inicial" id="inputSearch" placeholder="Buscador" aria-label="Buscador" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2"><button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button></span>
                            </div>
                         
                            
                        </form>
                        <?php
                        } 
                        ?>
                        <a href="<?php echo SERVERURL; ?>predio-config/<?php echo $pagina[1]; ?>" class="button_prim3"><i class="fa-solid fa-sliders"></i></a>
                        <button class="button_prim3"><i class="fa-solid fa-download"></i></button>
                    </div>
                </div>

                <div class="tablas_contenido">

                    <?php
                    if (isset($_SESSION['busqueda_predio']) && !empty($_SESSION['busqueda_predio'])) {
                    $busq = $_SESSION['busqueda_predio'];
                    ?>
                    <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
                        <input type="hidden" name="modulo" value="predio">
                        <input type="hidden" name="eliminar_busqueda" value="eliminar">
                        <input type="hidden" name="id_url" value="<?php echo $pagina[1]; ?>">
                        <div class="container-fluid">
                            <div class="row justify-content-md-center">
                                <div class="col-12 col-md-6">
                                    <p class="text-center" style="font-size: 20px;">
                                        Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_predio']; ?>”</strong>
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
					require_once "./controladores/predioControlador.php";
					$ins_predio = new predioControlador();
                    
                    

					echo $ins_predio->paginador_predio_controlador($pagina[2],15,$_SESSION['privilegio_spm'],$_SESSION['id_spm'],$pagina[0],$busq,$pagina[1]);
				?>			

				</div>
            </div>
        </div>
    </div>
</div>

