<!-- funciones síncronas  -->
<?php
require_once 'cnn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: inventario.php");
    } catch (PDOException $e) {
        echo "Error al eliminar el producto: " . $e->getMessage();
    }
}
?>