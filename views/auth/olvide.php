<div class="w-75 mt-5">
    <h1 class="text-center mb-4">Recuperar Contraseña</h1>
    <p class="text-center h5 mb-4">Ingresa tú email si olvidaste tu contraseña.</p>

    <form method="POST" action="/olvide">
        <?php include_once "../views/plantillas/alertas.php" ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <input type="submit" class="btn btn-primary" value="Enviar Correo"/>
    </form>

    <div class="d-flex justify-content-between mt-3">
        <p class="text-body-secondary">¿Volver? <a href="/" class="link-primary">Inicia Sesión</a></p>
        <p class="text-body-secondary">¿Aún no tienes una cuenta? <a href="/crear-cuenta" class="link-primary">Crea Una</a></p>
    </div>
</div>