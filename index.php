<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="container mt-4">

        <div class="p-5 mb-4 bg-light rounded-3">
            <h1 class="display-5 fw-bold">Bienvenido a la Librería</h1>
            <p class="fs-5">
                Sistema para registrar y consultar los libros de nuestro catálogo:
                autor, título, fecha de publicación e imagen de portada.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title h4">Registro</h2>
                        <p class="card-text">Da de alta un libro nuevo con sus datos y su portada.</p>
                        <a href="registro.php" class="btn btn-primary">Registrar libro</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title h4">Consulta</h2>
                        <p class="card-text">Revisa todos los libros guardados en la base de datos.</p>
                        <a href="consulta.php" class="btn btn-outline-primary">Ver catálogo</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>