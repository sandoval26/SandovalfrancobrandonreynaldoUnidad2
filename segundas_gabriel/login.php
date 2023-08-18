<?php
session_start();
require_once 'cnn.php';

if (isset($_POST['enviar'])) {

    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $sql = $pdo->prepare('SELECT * from usuarios WHERE correo=:correo AND password=:password');
    $sql->bindParam(':correo', $correo);
    $sql->bindParam(':password', $password);
    $sql->execute();
    $count = $sql->rowCount();

    if ($count == 1) {
        $query = $pdo->prepare('SELECT * from usuarios WHERE correo=:correo');
        $query->bindParam(':correo', $correo);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $tipo_usuario = $row['tipo_usuario'];
        $id_usuario = $row['id_usuario'];
        $nombre = $row['nombre'];

        if ($tipo_usuario == "admin") {
            $_SESSION['id_usuario'] = $id_usuario;
            $_SESSION['tipo_usuario'] = $tipo_usuario;
            $_SESSION['nombre'] = $nombre;
            header("location: page_admin.php");
            echo $tipo_usuario;
            exit;
        } else if ($tipo_usuario == "usuario") {
            $_SESSION['id_usuario'] = $id_usuario;
            $_SESSION['tipo_usuario'] = $tipo_usuario;
            $_SESSION['nombre'] = $nombre;
            header("location: page_user.php");
            echo $tipo_usuario;
            exit;
        }
    } else {

        echo "Usuario incorrecto!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Iniciar sesión</title>
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
                <h2 class="text-center">Iniciar sesión</h2>
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
                    <a href="register.php" class="btn btn-link">Registrate !</a>
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