<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>conexion</title>

        <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php
        $con = mysqli_connect("db", "usuario", "M@riavairo8", "libreria");

        if (mysqli_connect_errno()) {
            echo "Error al conectar con MySQL: " . mysqli_connect_error();
            exit();
        }

        mysqli_set_charset($con, "utf8mb4");
    ?>
</body>
</html>