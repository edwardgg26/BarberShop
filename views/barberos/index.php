<h1 class="text-center mb-4 mt-4">Administrar Barberos</h1>
<?php include_once "../views/plantillas/barraUsuario.php"?>
<?php include_once "../views/plantillas/barraAdmin.php"?>
<a href="/barberos/crear" class="btn btn-primary align-self-start mb-3" >Nuevo Barbero</a> 
<ul class="w-100 list-group">
    <?php foreach($barberos as $barbero):?>
        <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <div>
                <p class="mb-0"><span class="fw-bold">Nombre:</span> <?php echo $barbero->nombre." ".$barbero->apellido?></p>
                <p class="mb-0"><span class="fw-bold">Telefono:</span> <?php echo $barbero->telefono?></p>
                <p class="mb-0"><span class="fw-bold">Email:</span> <?php echo $barbero->email?></p>
            </div>
            <div class="d-flex flex-column">
                <a href="/barberos/actualizar?id=<?php echo $barbero->id?>" class="btn btn-secondary mb-3" >Actualizar</a>
                <form method="POST" action="/barberos/eliminar">
                    <input type="hidden" value="<?php echo $barbero->id?>" name="id"/>
                    <input type="submit" class="btn btn-danger w-100" value="Eliminar"/>
                </form>
            </div>
        </li>
    <?php endforeach;?> 
</ul>