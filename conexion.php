<?php
$con = mysqli_connect("db", "usuario", "M@riavairo8", "libreria");

if (mysqli_connect_errno()) {
    echo "Error al conectar con MySQL: " . mysqli_connect_error();
    exit();
}

mysqli_set_charset($con, "utf8mb4");