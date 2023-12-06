<div class="w-75 mt-5">
    <h1 class="text-center mb-4">Login</h1>
    <p class="text-center h5 mb-4">Inicia sesión con tus datos.</p>

    <form method="POST" action="/">
        <?php include_once "../views/plantillas/alertas.php" ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <input type="submit" class="btn btn-primary" value="Ingresar"/>
    </form>

    <div class="d-flex justify-content-between mt-3">
        <p class="text-body-secondary">¿Aún no tienes una cuenta? <a href="/crear-cuenta" class="link-primary">Crea Una</a></p>
        <a href="/olvide" class="link-primary">Olvidé mi Contraseña</a>
    </div>
</div>

