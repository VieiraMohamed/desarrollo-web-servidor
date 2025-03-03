<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}

include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID del asistente a borrar
    $id = $_POST['id'];

    // Preparar la consulta para borrar al asistente
    $sql = "DELETE FROM asistentes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    try {
        // Ejecutar la consulta
        $stmt->execute();
        header("Location: admin.php"); // Redirigir nuevamente a la página de administración
        exit();
    } catch (PDOException $e) {
        // Mostrar error si ocurre algún problema
        echo 'Error al eliminar asistente: ' . $e->getMessage();
    }
}
?>
