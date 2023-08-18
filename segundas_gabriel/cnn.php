<?php
$host = 'localhost'; // Cambia esto al nombre de tu servidor MySQL
$dbname = 'tienda_espejos';
$username = 'root'; // Cambia esto a tu nombre de usuario de MySQL
$password = ''; // Cambia esto a tu contraseña de MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
?>