<?php
include "conexion.php";

$mensaje = "";

// Este bloque solo se ejecuta cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titulo = trim($_POST["titulo"]);
    $autor  = trim($_POST["autor"]);
    $fecha  = trim($_POST["fecha_publicacion"]);


    // Datos del archivo subido
    $archivo = $_FILES["portada"];

    if ($archivo["error"] != 0) {
        $mensaje = '<div class="alert alert-danger">No se pudo subir la imagen (máximo 2 MB).</div>';
    } elseif (strpos($archivo["type"], "image/") !== 0) {
        $mensaje = '<div class="alert alert-danger">El archivo debe ser una imagen.</div>';
    } else {
        $imagen = file_get_contents($archivo["tmp_name"]);


        $tipo = $archivo["type"];   

        $sql = "INSERT INTO libros (autor, titulo, fecha_publicacion, portada, tipo_imagen)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $autor, $titulo, $fecha, $imagen, $tipo);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: registro.php?ok=1");
            exit();
        } else {
            $mensaje = '<div class="alert alert-danger">Error al guardar: ' . mysqli_error($con) . '</div>';
        }
    }
}

if (isset($_GET["ok"])) {
    $mensaje = '<div class="alert alert-success">¡Libro registrado correctamente!</div>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería - Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="container mt-4 col-lg-7">
        <h1 class="mb-4">Registrar libro</h1>

        <?php echo $mensaje; ?>

        <div class="card">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <input type="text" class="form-control" id="autor" name="autor" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_publicacion" class="form-label">Fecha de publicación</label>
                        <input type="date" class="form-control" id="fecha_publicacion" name="fecha_publicacion" required>
                    </div>
                    <div class="mb-3">
                        <label for="portada" class="form-label">Imagen de portada</label>
                        <input type="file" class="form-control" id="portada" name="portada" accept="image/*" required>
                        <div class="form-text">JPG o PNG, máximo 2 MB.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar libro</button>
                    <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>