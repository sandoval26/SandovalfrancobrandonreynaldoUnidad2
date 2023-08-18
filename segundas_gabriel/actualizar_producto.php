<?php
require_once 'cnn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT precio, descripcion FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener los detalles del producto: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <title>Tienda de Espejos</title>
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

    <div class="container mt-5">
        <h2>Actualizar Producto</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control" name="precio" step="0.01" value="<?= $producto['precio'] ?>"
                    required>
            </div><br>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" name="descripcion" rows="3"
                    required><?= $producto['descripcion'] ?></textarea>
            </div><br>
            <!-- Eventos del mouse. -->
            <button type="submit" class="btn btn-primary" name="actu">Actualizar</button>
        </form>
    </div>

    <!-- Scripts de Bootstrap (requiere jQuery y Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>
<!-- funciones síncronas  -->
<?php
require_once 'cnn.php';

if (isset($_POST['actu'])) {
    $id = $_POST['id'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];

    try {
        $stmt = $pdo->prepare("UPDATE productos SET precio = ?, descripcion = ? WHERE id = ?");
        $stmt->execute([$precio, $descripcion, $id]);

        header("Location: inventario.php");
    } catch (PDOException $e) {
        echo "Error al guardar las actualizaciones: " . $e->getMessage();
    }
}
?>