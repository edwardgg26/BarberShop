<!DOCTYPE html>
<html lang="en">
<!-- <html lang="en" data-bs-theme="dark"> -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Cortesito</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col d-block d-xl-none text-center">
                <img class="img-fluid" src="/build/img/barber-image.jpg"/>
            </div>
            <div class="col d-none d-xl-block">
                <img class="img-fluid position-fixed" src="/build/img/barber-image.jpg"/>
            </div>
            <div class="col-lg-6 d-flex align-items-center flex-column p-3">
                <?php echo $contenido; ?>
            </div>
        </div>
    </div>
    <script src='/build/js/bootstrap.bundle.min.js'></script>
    <?php 
        echo $script??null;
    ?>
</body>
</html>