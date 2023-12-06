<h1 class="text-center mb-4 mt-4">Crear Servicio</h1>
<?php include_once "../views/plantillas/barraUsuario.php" ?>
<?php include_once "../views/plantillas/barraAdmin.php" ?>

<form method="POST" class="w-100" action="/servicios/crear">
    <?php include_once "../views/plantillas/alertas.php" ?>
    <?php include_once "formulario_servicios.php"?>
    
    <input type="submit" class="btn btn-primary" value="Guardar" />
</form>