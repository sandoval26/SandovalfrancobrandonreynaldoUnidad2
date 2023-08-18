<!DOCTYPE html>
<html>

<head>
    <title>Registro de Usuarios</title>
    <!-- Agregar enlace a los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            /* Fondo de color de respaldo */
        }

        .background-image {
            width: 900px;
            height: 900px;
            background-image: url('imagenes/logo.jpeg');
            /* Ruta relativa a la imagen */
            background-size: cover;
            background-position: center;
            opacity: 0.7;
            /* Opacidad de la imagen de fondo */
            position: absolute;
        }

        /* Estilos para el marco del formulario */
        .form-frame {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.9);
            /* Fondo blanco transparente */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body>
    <!-- Utilizar la clase "center" para centrar el contenido -->
    <div class="center">
        <div class="background-image"></div>
        <div class="col-md-4">
            <div class="form-frame"> <!-- Agregar la clase para el marco -->
                <h2 class="text-center">Registro de usuarios</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="correo">Correo electrónico:</label>
                        <input type="email" class="form-control" name="correo" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <!-- Eventos del mouse. -->
                    <button type="submit" class="btn btn-primary" name="enviar">Iniciar sesión</button>
                    <a href="login.php" class="btn btn-link">Registrate !</a>
                </form>
            </div>
        </div>
    </div>
    <!-- Agregar los scripts de Bootstrap al final del cuerpo -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
require_once 'cnn.php';
// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $tipo_usuario = "usuario";

    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (correo, password, tipo_usuario) VALUES (?, ?, ?)");
        $stmt->execute([$correo, $password, $tipo_usuario]);

        echo "Usuario registrado exitosamente.";
    } catch (PDOException $e) {
        echo "Error al registrar el usuario: " . $e->getMessage();
    }
}
?>