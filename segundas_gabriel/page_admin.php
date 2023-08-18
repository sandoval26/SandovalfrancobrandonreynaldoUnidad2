<!DOCTYPE html>
<html>

<head>
    <title>Registrar Producto</title>
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
        <h2>Registrar Nuevo Producto</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control" name="precio" step="0.01" required>
            </div><br>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" name="descripcion" rows="3" required></textarea>
            </div><br>
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="imagen" name="imagen" required>
                    <label class="custom-file-label" for="imagen">Seleccionar archivo</label>
                </div><br>
            </div>
            <button type="submit" class="btn btn-primary" name="reg">Registrar Producto</button>
        </form>
    </div>


    <!-- Scripts de Bootstrap (requiere jQuery y Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>


</body>

</html>

<?php
require_once 'cnn.php';

if (isset($_POST['reg'])) {
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];

    $codigoImagen = uniqid();
    $rutaImagen = "imagenes/" . $codigoImagen . ".jpg";

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO productos (precio, descripcion, codigo_imagen) VALUES (?, ?, ?)");
            $stmt->execute([$precio, $descripcion, $codigoImagen]);

            echo "Producto registrado exitosamente.";
        } catch (PDOException $e) {
            echo "Error al registrar el producto: " . $e->getMessage();
        }
    } else {
        echo "Error al subir la imagen.";
    }
}
?>