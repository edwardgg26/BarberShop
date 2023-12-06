<?php foreach ($alertas as $tipo => $alerta): ?>
    <?php foreach ($alerta as $value): ?>
        <div class="alert alert-<?php echo $tipo ?> alert-dismissible fade show" role="alert">
            <p>
                <?php echo $value ?>
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>