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
                        <a href="<?php echo SERVERURL; ?>licencia-new/<?php echo $pagina[1]; ?>" class="button_prim"><i class="fa fa-plus"></i> Nueva licencia</a>
                        
                    </div>
                    <div class="opc_right">
                        <?php
                        $busq = "";
                        if (!isset($_SESSION['busqueda_licencia']) && empty($_SESSION['busqueda_licencia'])) {
                            $busq = "";
                        
                        ?>
                        <form class="form-neon FormularioAjax" action="<?php echo SERVERURL ?>ajax/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
                            <input type="hidden" name="modulo" value="licencia">
                            <input type="hidden" name="id_url" value="<?php echo $pagina[1]; ?>">
                            <div class="input-group">
                                <input type="text" class="form-control" name="busqueda_inicial" id="inputSearch" placeholder="Buscador" aria-label="Buscador" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2"><button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button></span>
                            </div>
                         
                            
                        </form>
                        <?php
                        } 
                        ?>
                        <a href="<?php echo SERVERURL; ?>licencia-config/<?php echo $pagina[1]; ?>" class="button_prim3"><i class="fa-solid fa-sliders"></i></a>
                        <button class="button_prim3"><i class="fa-solid fa-download"></i></button>
                    </div>
                </div>

                <div class="tablas_contenido">

                    <?php
                    if (isset($_SESSION['busqueda_licencia']) && !empty($_SESSION['busqueda_licencia'])) {
                    $busq = $_SESSION['busqueda_licencia'];
                    ?>
                    <form class="FormularioAjax" action="<?php echo SERVERURL ?>ajax/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
                        <input type="hidden" name="modulo" value="licencia">
                        <input type="hidden" name="eliminar_busqueda" value="eliminar">
                        <input type="hidden" name="id_url" value="<?php echo $pagina[1]; ?>">
                        <div class="container-fluid">
                            <div class="row justify-content-md-center">
                                <div class="col-12 col-md-6">
                                    <p class="text-center" style="font-size: 20px;">
                                        Resultados de la busqueda <strong>“<?php echo $_SESSION['busqueda_licencia']; ?>”</strong>
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
					
                    require_once "./controladores/licenciaControlador.php";
                    $ins_licencia = new licenciaControlador();

					echo $ins_licencia->paginador_licencia_controlador($pagina[2],15,$_SESSION['privilegio_spm'],$_SESSION['id_spm'],$pagina[0],$busq,$pagina[1]);
				?>			

				</div>
            </div>

            <div class="d_alert"></div>
            <script type="text/javascript">
                $(".item_ser input, textarea").on("change", function(){

                    var datas = $(this).parents(".item_ser").find("input, textarea").serialize();
                    
                    var method = "POST";
                    var action = "<?php echo SERVERURL ?>ajax/licenciaAjax.php";
                    var tipo = "update";

                    $.ajax({

                        type: method,
                        url: action,
                        data: datas, 
                        cache: false,

                        success: function(f){
                            
                            var alert = $.parseJSON(f);
                           
                            Swal.fire({
                                icon: alert.Tipo,
                                title: alert.Titulo,
                                text: alert.Texto,
                                confirmButtonText : 'Aceptar'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        }
                    });

                    console.log(datas);
                })
            </script>
        </div>
    </div>
</div>

