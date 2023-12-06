<div class="w-75 mt-5">
    <h1 class="text-center mb-4">Crear Cuenta</h1>
    <p class="text-center h5 mb-4">Ingresa tus datos para registrarte.</p>

    <form method="POST" action="/crear-cuenta">
        
        <?php include_once "../views/plantillas/alertas.php" ?>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input value="<?php echo s($usuario->nombre)?>" type="text" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input value="<?php echo s($usuario->apellido)?>" type="text" class="form-control" id="apellido" name="apellido">
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input  value="<?php echo s($usuario->telefono)?>" type="tel" class="form-control" id="telefono" name="telefono">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input value="<?php echo s($usuario->email)?>" type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <input type="submit" class="btn btn-primary" value="Crear Cuenta"/>
    </form>

    <div class="mt-3">
        <p class="text-body-secondary">¿Ya tienes una cuenta? <a href="/" class="link-primary">Inicia Sesión</a></p>
    </div>
</div>