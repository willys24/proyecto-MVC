<div class="menu_laterlal">
    <div class="menu_top">
        <?php
        $act = explode("-",$_GET['views']);
        
        ?>
        <a href="<?php echo SERVERURL; ?>user-list/" <?php if($act[0]=="user"){ ?> class="activo" <?php } ?>><i class="far fa-user"></i></a>
        <a href="<?php echo SERVERURL; ?>plan-list/" <?php if($act[0]=="plan"){ ?> class="activo" <?php } ?>><i class="fa-solid fa-map-location-dot"></i></i></a>
        <a href="<?php echo SERVERURL; ?>gestor-archivos/" <?php if($act[0]=="gestor"){ ?> class="activo" <?php } ?>><i class="fa-regular fa-file-lines"></i></a>
        <a href=""><i class="fa-solid fa-chart-column"></i></a>
    </div>
    <div class="menu_bot">
        <a href="" class=""><i class="fa-solid fa-gear"></i></a>
        <a href="" class="btn-exit-system"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
    </div>
    
</div>

