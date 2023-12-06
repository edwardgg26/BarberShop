<h1 class="text-center mb-4 mt-4">Agregar Barbero</h1>
<?php include_once "../views/plantillas/barraUsuario.php" ?>
<?php include_once "../views/plantillas/barraAdmin.php" ?>

<form method="POST" class="w-100" action="/barberos/crear">
    <?php include_once "../views/plantillas/alertas.php" ?>
    <?php include_once "formulario_barberos.php"?>
    
    <input type="submit" class="btn btn-primary" value="Guardar" />
</form>