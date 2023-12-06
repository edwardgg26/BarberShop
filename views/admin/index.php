<h1 class="mt-4 mb-4">Panel de Administracion</h1>
<?php include_once "../views/plantillas/barraUsuario.php"?>
<?php include_once "../views/plantillas/barraAdmin.php"?>

<form class="w-100">
    <h2>Buscar Citas</h2>
    <div class="mb-3">
        <label for="fecha" class="form-label">Selecciona la fecha</label>
        <input value="<?php echo $fecha?>" type="date" class="form-control" id="fecha" name="fecha">
    </div>
</form>

<?php 
if(count($citas) === 0){
    echo "<p class='fw-bold text-center'>No se encontraron citas para la fecha...</p>";
}    
?>

<ul class="w-100 list-group">
    <?php 
        $idCita = 0;
        foreach($citas as $key => $cita):
            if($idCita !== $cita->id):
                $total = 0;
            ?>
        <li class="list-group-item list-group-item-action">
            <form method="POST" action="/api/eliminarCita">
                <input type="hidden" name="id" value="<?php echo $cita->id?>">
                <input type="submit" value="Eliminar" class="btn btn-danger mb-2" >
            </form>
            <p class="mb-0"><span class="fw-bold">ID:</span> <?php echo $cita->id?></p>
            <p class="mb-0"><span class="fw-bold">Hora:</span> <?php echo $cita->hora?></p>
            <p class="mb-0"><span class="fw-bold">Barbero:</span> <?php echo $cita->nombreBarbero?></p>
            <p class="mb-0"><span class="fw-bold">Cliente:</span> <?php echo $cita->nombreCliente?></p>
            <p class="mb-0"><span class="fw-bold">Telefono Cliente:</span> <?php echo $cita->telefono?></p>
            <p class="mb-2"><span class="fw-bold">Email Cliente:</span> <?php echo $cita->email?></p>
            <h5 class="mb-2">Servicios</h5> 
            <?php 
                $idCita = $cita->id;
            endif;
                $total+=$cita->precio?>
            <p class="mb-0"><?php echo $cita->nombreServicio.": $".number_format($cita->precio);?></p>

            <?php 
                $actual = $cita->id;
                $proximo = $citas[$key + 1]->id??0;
            if($actual !== $proximo):?>
                <p class="mb-0"><span class="fw-bold">Total:</span> <?php echo "$".number_format($total)?></p>
                </li>
            <?php
            endif; 
        endforeach;?> 
</ul>

<?php $script = "<script src='build/js/buscador.js'></script>";?>