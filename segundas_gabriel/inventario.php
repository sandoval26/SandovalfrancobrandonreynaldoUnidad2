<?php
require_once 'cnn.php';

// Obtener la lista de productos de la base de datos
try {
    $stmt = $pdo->query("SELECT id, precio, descripcion, codigo_imagen FROM productos");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al obtener la lista de productos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Lista de Productos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Tienda de Espejos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="page_admin.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inventario.php">Inventario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cerrar.php">Cerrar sesion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Resto del contenido de tu página aquí -->
    <div class="container mt-5">
        <h2>Lista de Productos Registrados</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto) { ?>
                    <tr>
                        <td>
                            <?= $producto['id'] ?>
                        </td>
                        <td>
                            <?= $producto['precio'] ?>
                        </td>
                        <td>
                            <?= $producto['descripcion'] ?>
                        </td>
                        <td><img src="imagenes/<?= $producto['codigo_imagen'] ?>.jpg" alt="Imagen del Producto" width="100">
                        </td>
                        <td><a href="actualizar_producto.php?id=<?= $producto['id'] ?>"
                                class="btn btn-primary">Actualizar</a></td>
                        <td><a href="eliminar_producto.php?id=<?= $producto['id'] ?>" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Scripts de Bootstrap (requiere jQuery y Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>