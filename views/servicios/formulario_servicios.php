<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input value="<?php echo $servicio->nombre?>" type="text" class="form-control" id="nombre" name="nombre">
</div>
<div class="mb-3">
    <label for="precio" class="form-label">Precio</label>
    <input value="<?php echo $servicio->precio?>" min="0" step="any" type="number" class="form-control" id="precio" name="precio">
</div>
<div class="mb-3">
    <label for="duracion" class="form-label">Duracion</label>
    <input value="<?php echo $servicio->duracion?>" min="1" max="999" type="number" class="form-control" id="duracion" name="duracion">
</div>