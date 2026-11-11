<?php
include "conexion.php";

$id = (int) $_GET["id"];

$resultado = mysqli_query($con, "SELECT portada, tipo_imagen FROM libros WHERE id = $id");
$libro = mysqli_fetch_assoc($resultado);

if (!$libro) {
    http_response_code(404);
    exit();
}

header("Content-Type: " . $libro["tipo_imagen"]);
echo $libro["portada"];