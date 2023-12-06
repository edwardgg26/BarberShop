<h1 class="text-center mb-4 mt-4">Crear Cita</h1>
<?php include_once "../views/plantillas/barraUsuario.php"?>
<p class="text-center h6 mb-4">Elige tus servicios e ingresa tus datos.</p>
<div class="container contenido-citas">
    <nav>
        <ul class="pagination pagination-md w-100 text-center container-fluid">
            <li class="page-item w-100">
                <button class="page-link w-100" data-paso="1">Servicios</button> 
            </li>
            <li class="page-item  w-100">
                <button class="page-link w-100" data-paso="2">Fecha</button> 
            </li>
            <li class="page-item w-100">
                <button class="page-link w-100" data-paso="3">Resumen</button> 
            </li>
        </ul>
    </nav>

    <div id="contenedor-alertas">
    </div>

    <div id="seccion-cita-1" class="ocultar">
        <h2>Barberos</h2>
        <p>Selecciona un barbero con el que deseas la cita.</p>
        <select id="select-barbero"class="form-select mb-4">
            <option value="null" selected>Selecciona un barbero...</option>
        </select>
        <h2>Servicios</h2>
        <p>Haz click en los servicios que deseas reservar para seleccionarlos.</p>
        <div id="contenedor-servicios" class="container-fluid p-0 mb-4 text-center">

        </div>
    </div>

    <div id="seccion-cita-2" class="ocultar">
        <h2>Fecha y Hora</h2>
        <p>Ingresa la fecha y la hora en la que deseas la cita.</p>
        
        <form method="POST" action="/crear-cuenta">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input value="<?php echo $nombre?>" type="text" class="form-control" id="nombre" name="nombre" disabled>
            </div>
            <div>
                <input value="<?php echo $id?>" type="hidden" id="id_usuario" name="id_usuario" disabled>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input min="<?php echo date("Y-m-d")?>" type="date" class="form-control" id="fecha" name="fecha">
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora</label>
                <input min=<?php echo date("H:i")?> type="time" class="form-control" id="hora" name="hora">
            </div>
        </form>
    </div>

    <div id="seccion-cita-3" class="ocultar">
    </div>

    <div class="d-flex justify-content-between">
        <button type="button" id="anterior" class="btn btn-primary">&laquo; Atras</button>
        <button type="button" id="siguiente" class="btn btn-primary">Siguiente &raquo;</button>
    </div>
</div>

<?php $script = "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script src='build/js/app.js'></script>
            ";?>