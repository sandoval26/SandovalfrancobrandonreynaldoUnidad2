<!DOCTYPE html>
<html>

<head>
    <title>Registrar Producto</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@5.3.0/dist/simplebar.min.css">
    <script src="https://cdn.jsdelivr.net/npm/simplebar@5.3.0/dist/simplebar.min.js"></script>

    <style>
        .card:hover {
            transform: translateY(-10px);
            transition: transform 0.3s ease-in-out;
        }

        .product-image {
            max-width: 100%;
            height: auto;
        }

        /* Animaciones y transiciones */
        .scroll-container {
            max-height: 600px;
            overflow-y: scroll;
        }

        .card {
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .product-image {
            max-width: 100%;
            height: auto;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover .product-image {
            transform: scale(1.1);
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- funcion asíncrona -->
    <script>
        $(document).ready(function () {
            $('#busqueda').on('keyup', function () {
                var searchText = $(this).val().toLowerCase();
                $('.card').each(function () {
                    var productDescription = $(this).find('.card-title').text().toLowerCase();
                    if (productDescription.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>


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
                        <a class="nav-link" href="page_user.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cerrar.php">Cerrar sesion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    require_once 'cnn.php';

    // Obtener la lista de productos de la base de datos
    try {
        $stmt = $pdo->query("SELECT * FROM productos");
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener la lista de productos: " . $e->getMessage();
    }
    ?>

    <div class="container mt-5">
        <form class="mb-3" method="get">
            <div class="input-group">
                <input type="search" class="form-control" id="busqueda" name="busqueda"
                    placeholder="Buscar producto...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </div>
        </form>
        <div class="row scroll-container">

            <?php
            // Obtener la búsqueda del formulario
            $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

            foreach ($productos as $producto) {
                $id = $producto['id'];
                $precio = $producto['precio'];
                $descripcion = $producto['descripcion'];
                $codigoImagen = $producto['codigo_imagen'];

                // Mostrar todas las tarjetas inicialmente
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card h-100">';
                echo '<img src="imagenes/' . $codigoImagen . '.jpg" class="card-img-top product-image" alt="Imagen del Producto">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $descripcion . '</h5>';
                echo '<p class="card-text">Precio: $' . $precio . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>


    <!-- Scripts de Bootstrap (requiere jQuery y Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>


</body>

</html>