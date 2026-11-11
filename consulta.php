<?php
include "conexion.php";

// --- Paginación ---
$porPagina = 3;   // libros por página

$pagina = isset($_GET["pagina"]) ? (int) $_GET["pagina"] : 1;
if ($pagina < 1) {
    $pagina = 1;
}

$total = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(*) FROM libros"))[0];
$totalPaginas = max(1, ceil($total / $porPagina));
if ($pagina > $totalPaginas) {
    $pagina = $totalPaginas;
}

$inicio = ($pagina - 1) * $porPagina;

$sql = "SELECT id, autor, titulo, fecha_publicacion FROM libros
        ORDER BY id DESC LIMIT $inicio, $porPagina";
$resultado = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería - Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Catálogo de libros</h1>
            <span class="badge bg-secondary fs-6"><?php echo $total; ?> libro(s)</span>
        </div>

        <?php if ($total == 0) { ?>
            <div class="alert alert-info">
                Aún no hay libros registrados. <a href="registro.php" class="alert-link">Registra el primero</a>.
            </div>
        <?php } ?>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php while ($libro = mysqli_fetch_assoc($resultado)) { ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="ratio ratio-1x1 bg-light">
                            <img src="portada.php?id=<?php echo $libro["id"]; ?>"
                                 class="object-fit-contain p-2"
                                 alt="Portada de <?php echo htmlspecialchars($libro["titulo"]); ?>">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($libro["titulo"]); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($libro["autor"]); ?></p>
                        </div>
                        <div class="card-footer d-flex justify-content-between small text-secondary">
                            <span>ID: <?php echo $libro["id"]; ?></span>
                            <span>Publicado: <?php echo date("d/m/Y", strtotime($libro["fecha_publicacion"])); ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php if ($totalPaginas > 1) { ?>
            <ul class="pagination justify-content-center mt-4">
                <li class="page-item <?php if ($pagina == 1) echo "disabled"; ?>">
                    <a class="page-link" href="?pagina=<?php echo $pagina - 1; ?>">Anterior</a>
                </li>
                <?php for ($i = 1; $i <= $totalPaginas; $i++) { ?>
                    <li class="page-item <?php if ($i == $pagina) echo "active"; ?>">
                        <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
                <li class="page-item <?php if ($pagina == $totalPaginas) echo "disabled"; ?>">
                    <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>">Siguiente</a>
                </li>
            </ul>
        <?php } ?>
    </div>
</body>
</html>