<h1 class="text-center mb-4 mt-4">Actualizar Barbero</h1>
<?php include_once "../views/plantillas/barraUsuario.php"?>
<?php include_once "../views/plantillas/barraAdmin.php"?>

<form method="POST" class="w-100">
    <?php include_once "../views/plantillas/alertas.php";
        if($error === false){
            include_once "formulario_barberos.php";
        }?>
    <input type="submit" class="btn btn-primary" value="Actualizar" />
</form>