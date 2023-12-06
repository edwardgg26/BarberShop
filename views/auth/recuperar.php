<div class="w-75 mt-5">
    <h1 class="text-center mb-4">Recuperar Contraseña</h1>
    <p class="text-center h5 mb-4">Ingresa tú nueva contraseña.</p>

    <form method="POST" >
        <?php include_once "../views/plantillas/alertas.php" ?>
        <?php if(!$errorToken):?>
            <div class="mb-3">
                <label for="password" class="form-label">Password Nuevo</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <input type="submit" class="btn btn-primary" value="Reestablecer"/>
        <?php endif;?>
    </form>

    <div class="d-flex justify-content-between mt-3">
    <a href="/" class="link-primary">Volver al Login</a>
    </div>
</div>