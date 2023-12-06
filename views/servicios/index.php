<h1 class="text-center mb-4 mt-4">Administrar Servicios</h1>
<?php include_once "../views/plantillas/barraUsuario.php"?>
<?php include_once "../views/plantillas/barraAdmin.php"?>
<a href="/servicios/crear" class="btn btn-primary align-self-start mb-3" >Nuevo Servicio</a> 
<ul class="w-100 list-group">
    <?php foreach($servicios as $servicio):?>
        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <div>
                <p class="mb-0"><span class="fw-bold">Nombre:</span> <?php echo $servicio->nombre?></p>
                <p class="mb-0"><span class="fw-bold">Precio:</span> <?php echo "$".number_format($servicio->precio)?></p>
                <p class="mb-0"><span class="fw-bold">Duración:</span> <?php echo $servicio->duracion?> minutos</p>
            </div>
            <div class="d-flex flex-column">
                <a href="/servicios/actualizar?id=<?php echo $servicio->id?>" class="btn btn-secondary mb-3" >Actualizar</a>
                <form method="POST" action="/servicios/eliminar">
                    <input type="hidden" value="<?php echo $servicio->id?>" name="id"/>
                    <input type="submit" class="btn btn-danger w-100" value="Eliminar"/>
                </form>
            </div>
        </li>
    <?php endforeach;?> 
</ul>